<?php

namespace App\Modules\Base\Presenters;

use Nette,
    Nette\Security\User,
    App\Components\Controls\LogoutControl\TCreateComponentLogoutControl,
    App\Components\Forms\LoginForm\TCreateComponentLoginForm;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

    /** @persistent */
    public $backlink = '';

    /** @var array seznam presenteru, kterych se netyka ACL a nemusim se prihlasovat */
    private $notRestrictedPresenters = array('Front:Default', 'Front:Error', 'Front:Cron');

    /** @var \App\Model\Breadcrumb @inject */
    public $breadcrumb;

    /** @var \App\Model\Repositories\Repository @inject */
    public $repository;

    //=================== PUBLIC ===============================================

/**
     * Vytvoří komponentu logoutControl
     */
    use TCreateComponentLogoutControl;

/**
     * Vytvori komponentu loginForm
     */
    use TCreateComponentLoginForm;

    /** @var \WebLoader\Nette\LoaderFactory @inject */
    public $webLoader;

    /**
     * staticke css podle moduleName
     * 
     * @return CssLoader 
     */
    protected function createComponentCss() {
        return $this->minifyJsCss('css', $this->getModuleName());
    }

    /**
     * dynamicke css pro ruzne komponenty
     * nacitame oddelene, aby staticke css mohlo jit vzdy z kese
     * 
     * @return CssLoader
     */
    protected function createComponentCssDynamic() {
        return $this->minifyJsCss('css', 'dynamic');
    }

    /**
     * staticke js pro moduleName
     * 
     * @return JavaScriptLoader 
     */
    protected function createComponentJs() {
        return $this->minifyJsCss('js', $this->getModuleName());
    }

    /**
     * dynamicke js pro ruzne komponenty
     * nacitame oddelene, aby staticke js mohlo jit vzdy z kese
     * 
     * @return JavaScriptLoader
     */
    protected function createComponentJsDynamic() {
        return $this->minifyJsCss('js', 'dynamic');
    }

    /**
     * Přihlašovací stránka.
     */
    public function renderLogin() {
        $tfile = __DIR__ . '/../Templates/login.latte';
        $this->template->setFile($tfile);
    }

    //=================== PROTECTED ============================================

    /**
     * uplne prvni metoda presenteru
     * resi nam ACL
     */
    protected function startup() {
        parent::startup();

        // vse jen pokud nejsme na login strance
        if ($this->action != 'login') {
            // pokud neni uzivatel prihlasen (a nejsme v defaultnim FRONT presenteru),
            // tak presmerovavame na login
            if (!$this->user->isLoggedIn() && false == in_array($this->getName(), $this->notRestrictedPresenters)) {
                #-- pokud bych nebyl prihlasen, protoze me aplikace odhlasila pro neaktivitu, tak dam o tom vedet uzivateli
                if ($this->user->getLogoutReason() === User::INACTIVITY) {
                    $this->flashMessage('Byl jste odhlášen z důvodu neaktivity.', FLASH_INFO);
                }

                $this->redirect(':' . $this->getModuleName() .':Default:login', array('backlink'=>$this->storeRequest()));
            }
            // uzivatel je prihlasen (nebo jsme ve FRONT:DEFAULT)
            else {
                // otestujeme ACL
                $authorized = $this->user->isAllowed($this->name, $this->action);
                if (false === $authorized) {
                    $this->flashMessage('Přístup na požadovanou stránku byl odepřen.', FLASH_ERR);

                    #-- presmerujeme na defaultni presenter modulu, pokud ma uziv. pravo
                    #-- pokud ne, tak na default:default
                    if ($this->user->isAllowed($this->getModuleName() . ':Default', 'default')) {
                        $this->redirect('Default:');
                    } else {
                        $this->redirect(':Front:Default:');
                    }
                }
            }
        }
    }

    /**
     * metoda se provede pres samotnym renderovanim
     * - resi nam nastaveni module a presenteru pro template
     */
    protected function beforeRender() {
        #-- zavolame rodice
        parent::beforeRender();

        #-- breadcrumb
        $this->template->breadcrumb = $this->breadcrumb;

        #-- hlavni promenne pro view
        $this->template->viewName = $this->getView();
        $this->template->root = isset($_SERVER['SCRIPT_FILENAME']) ? realpath(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) : NULL;
        $this->template->moduleName = $this->getModuleName();
        $this->template->presenterName = $this->getPresenterName();
    }

    /**
     * vrati presenter name z retezce $module:$presenter 
     * (modul totiz nemusi byt zadan)
     * 
     * @return string
     */
    protected function getPresenterName() {
        $a = strrpos($this->getName(), ':');
        $r = ($a === FALSE) ? $this->getName() : substr($this->getName(), $a + 1);

        return $r;
    }

    /**
     * vrati module name z retezce $module:$presenter 
     * (modul totiz nemusi byt zadan, pak '' == 'Default')
     * 
     * @return string
     */
    protected function getModuleName() {
        $a = strrpos($this->getName(), ':');
        $r = ($a === FALSE) ? '' : substr($this->getName(), 0, $a);

        return $r;
    }

    //=================== PROTECTED ============================================
    /**
     * Sdruzuje akce kolem minifikace js a css
     * 
     * @param string $type css|js
     * @param string $namespace
     * @return WebLoader
     */
    private function minifyJsCss($type, $namespace) {
        #-- JS
        if ('js' == $type) {
            $wl = $this->webLoader->createJavaScriptLoader($namespace);
            $wl->getCompiler()->addFileFilter(function ($content, $cls, $file) {
                $ret = $content;

                if (false === strpos($file, 'min.js')) {
                    $minifier = new \App\Model\JavaScriptPacker($content);
                    $ret = $minifier->pack();
                }

                return $ret;
            });
        }
        #-- CSS
        elseif ('css' == $type) {
            $wl = $this->webLoader->createCssLoader($namespace);
            $wl->getCompiler()->addFileFilter(function ($content, $cls, $file) {
                $ret = $content;

                if (false === strpos($file, 'min.css')) {
                    $minifier = new \MatthiasMullie\Minify\CSS();
                    $minifier->add($content);

                    $ret = $minifier->minify();
                }

                return $ret;
            });
        }
        #-- NOT IMPLEMENTED
        else {
            throw new Nette\NotImplementedException('Pro typ: "' . $type . '" neni minify metoda definovana!');
        }

        #-- out path (web)
        $wl->setTempPath(ROOT_WEB_WWW . '/' . \WebLoader\Nette\Extension::DEFAULT_TEMP_PATH);

        #-- join files only for production mode
        if (false == $this->context->parameters['productionMode']) {
            $wl->getCompiler()->setJoinFiles(false);
        }

        return $wl;
    }

}
