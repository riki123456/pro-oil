<?php

namespace App\Modules\Front\Presenters;

use App\Modules\Base\Presenters,
    App\Components\Controls\Crud\ItemsControl\TCreateComponentItemsControl,
    App\Components\Controls\CartControl\TCreateComponentCartControl,
    App\Components\Controls\Crud\SlideshowControl\TCreateComponentSlideshowControl;

class DefaultPresenter extends Presenters\BasePresenter {

    /** @var \App\Model\Payment @inject */
    public $paymentClass;

    /**
     * Vytvoří komponentu itemsControl
     */
    use TCreateComponentItemsControl;

/**
     * Vytvoří komponentu cartControl (shopping-cart)
     */
    use TCreateComponentCartControl;

/**
     * Vytvoří komponentu slideshowControl
     */
    use TCreateComponentSlideshowControl;

    /**
     * nacte sidebar menu - ketagorie + vyrobce (jen ty, co obsahuji nejake polozky
     * nacte polozky "v akci"
     */
    public function beforeRender() {
        parent::beforeRender();

        #-- nacteme vsechny kategorie a vyrobce, pro ktere mame definovane polozky
        $menu = array();
        $polozky = $this->repository->findAll('polozka')
                        ->select('kategorie_id, vyrobce_id')
                        ->group('kategorie_id, vyrobce_id')
                        ->order('kategorie_id')->fetchAll();

        #-- ted pole projdeme, nacteme potrebna data a slozime pole, ktere predame view
        #-- musime udelat tak, aby pro kategorie byli jen definovani vyrobci
        #-- a dat pozor na setrizeni dle $row->poradi !!!
        $cat_check = array();
        foreach ($polozky as $p) {
            #-- kategorii jsme jeste nezpracovali
            if (!in_array($p->kategorie_id, $cat_check)) {
                array_push($cat_check, $p->kategorie_id);

                #-- pridame do pole pro menu. Pozor! index je 'poradi' ... at muzem setridit
                $menu[$p->kategorie->poradi]['kategorie'] = $p->kategorie;
            }
            #-- kategorii uz jsme zpracovavali, pridavame jen vyrobce
            #-- jsme si jisti, ze prirazujeme spravne, protoze z db to jde setrizene dle $kategorie_id
            $menu[$p->kategorie->poradi]['vyrobce'][$p->vyrobce->poradi] = $p->vyrobce;

            #-- vyrobce setridime vzdy!
            ksort($menu[$p->kategorie->poradi]['vyrobce'], SORT_NUMERIC); // pozor, setrizeni nic nevraci !
        }

        #-- kategorie setridime jen nakonec
        ksort($menu, SORT_NUMERIC); // pozor, setrizeni nic nevraci !
        $this->template->sidebarMenu = $menu;
    }

    /**
     * Dokonceni zpracování page formuláře (vola se z komponenty).
     * 
     * @param UI\Form $form argumenty predane metoda z komponenty
     * @param int $formId id ulozene objednavky
     */
    public function successZakaznikForm(\Nette\Application\UI\Form $form, $formId) {
        if ($form->isSuccess()) {
            $this->redirect("Default:shoppingCart", $formId);
        }

        /*
          if ($this->presenter->isAjax()) {
          $this->presenter->redrawControl('flash');
          $this->presenter->redrawControl('content');
          } else {
          $this->presenter->redirect('default');
          }
         * 
         */
    }

    /**
     * zpracuje navratove hodnoty z payment sluzby. Co a jak delat dle $id
     * 
     * @param string $id identifikace sluzby
     */
    public function renderPaymentReturn($id) {
        $pom = new \stdClass();
        $pom->platba_nazev = $id = 'csob' ? 'PLATBA KARTOU' : null;
        $this->paymentClass->setOrderData(array(0 => array(0 => $pom)));

        $res = $this->paymentClass->getActivePaymentClass()->getReturnResult();
        if ($res['resultCode'] == 0) {
            switch ($res['paymentStatus']) {
                case 1:
                    $this->template->paymentStatus = 'Platba bylo v pořádku založena.';
                    break;
                case 2:
                    $this->template->paymentStatus = 'Platba přávě probíhá.';
                    break;
                case 3:
                    $this->template->paymentStatus = 'Platba byla zrušena.';
                    break;
                case 5:
                    $this->template->paymentStatus = 'Platba byla odvolána.';
                    break;
                case 6:
                    $this->template->paymentStatus = 'Platba byla zamítnuta.';
                    break;
                case 4:
                case 7:
                    $this->template->paymentStatus = 'Platba proběhla úspěšně. Děkujeme za nákup.';
                    break;
                case 8:
                    $this->template->paymentStatus = 'Platba byla zúčtována.';
                    break;
                case 9:
                    $this->template->paymentStatus = 'Probíhá zpracování vrácení platby.';
                    break;
                case 10:
                    $this->template->paymentStatus = 'Platba byla vrácena.';
                    break;
                default:
                    $this->template->paymentStatus = 'Platba se bohužel nezdařila. ';
            }
        } else {
            throw new \Exception("Spatny result code: " . $res['resultCode'] . ". Mel by byt 0 !");
        }

        $this->template->paymentStatus .= '<br/><br/>';
        $this->template->paymentStatus .= 'V případě jakýkoliv nejasností či možných chyb ';
        $this->template->paymentStatus.= '<a href="' . $this->link('Default:contact', array('id' => 'kontaktni-informace')) . '" style="text-decoration: underline;">';
        $this->template->paymentStatus.= 'kontaktujte</a> prosím naše obchodní oddělení.';

        if (isset($res['payId'])) {
            $this->repository->update('objednavka_hlavicka', array('platba_paymentStatus' => $res['paymentStatus']), 'platba_servicesId = ?', $res['payId']);
        }
    }

    /**
     * stranka s objednavkou
     * - data bere ze session
     * 
     * @param int $formId id ulozene objednavky, muze byt null, pokud teprve renderujeme form pro potvrzeni objednavky
     */
    public function renderShoppingCart($formId = null, $blankCart = null) {
        #-- bradcrumb
        $this->breadcrumb->add('shopping-cart', $this->link("Default:shoppingCart"), 'Nákupní košík');
        #-- template variables
        $this->template->formId = $formId;
        $this->template->blankCart = $blankCart;
    }

    /**
     * renderuje ve rontendu zobrazeni obyc. (CMS) stranky
     * 
     * @param string $id webalize url pro identifikaci stranky
     */
    public function renderPage($id) {
        $this->template->pageData = $this->repository->findOneByColumn('pages', 'alias', $id);

        if (false != $this->template->pageData) {
            $this->breadcrumb->add('page', $this->link("Default:page", $id), $this->template->pageData->name);
        }
    }

    /**
     * renderuje ve frontendu kontakty. Cast je z tabulky 'pages', cast z tabulky 'kontakty'
     * 
     * @param string $id webalize url pri identifikaci v tabulce 'pages'
     */
    public function renderContact($id) {
        $this->template->contactData = $this->repository->findAll('kontakty')->order('poradi');
        $this->template->contactPageData = $this->repository->findOneByColumn('pages', 'alias', $id);

        $this->breadcrumb->add('contacts', $this->link("Default:contact", $id), 'Kontakt');
    }

    /**
     * renderuje seznam polozek tzv. "na hlavni stranku" ... to jsou ty z db co maji page_main = 1
     * - vyuziva k tomu ItemsControl komponentu, ktere predava jen parametry
     */
    public function renderDefault() {
        #-- na uvodni strance breadcrumb nechceme
        $this->template->breadcrumb = null;

        #-- data pro polozky hlavni stranky
        $this->template->itemsSqlParams = array('page_main' => 1);
    }

    /**
     * renderuje seznam polozek tzv. "v akci" ... to jsou ty z db co maji page_akce = 1
     * - vyuziva k tomu ItemsControl komponentu, ktere predava jen parametry
     */
    public function renderItemsInAction() {
        $this->template->itemsSqlParams = array('page_akce' => 1);
        $this->breadcrumb->add('itemsInAction', $this->link("Default:itemsInAction"), 'Akční nabídka');
    }

    /**
     * vyhledavani
     */
    public function renderItemsSearch() {
        $this->template->itemsSqlParams = array();
        $this->breadcrumb->add('itemsSearch', $this->link("Default:itemsSearch"), 'Vyhledávání');
    }

    /**
     * renderuje seznam polozek
     * - vyuziva k tomu ItemsControl komponentu, ktere predava jen parametry
     * 
     * @param string $category webalize url pro identifikaci kategorie
     * @param string $manufacturer webalize url pro identifikaci vyrobce, muze byt null
     */
    public function renderItems($category, $manufacturer = null) {
        $itemsSqlParams = array();

        #-- pridame do parametru - je-li co
        $kategorie = $this->repository->findOneByColumn('kategorie', 'alias', $category);
        if (false !== $kategorie) {
            $itemsSqlParams['kategorie_id'] = $kategorie->id;
            $this->breadcrumb->add('itemsCategory', $this->link("Default:items", array($category)), $kategorie->nazev);

            if (null != $manufacturer) {
                $vyrobce = $this->repository->findOneByColumn('vyrobce', 'alias', $manufacturer);
                if (false !== $vyrobce) {
                    $this->breadcrumb->add('itemsManufacturer', $this->link("Default:items", array($category, $manufacturer)), $vyrobce->nazev);
                    $itemsSqlParams['vyrobce_id'] = $vyrobce->id;
                }
            }
        }

        #-- pokud bychom podle parametru nic nenasli
        if (empty($itemsSqlParams)) {
            throw new \Nette\Application\BadRequestException();
        } else {
            #-- a predavam do template potrebne parametry
            $this->template->itemsSqlParams = $itemsSqlParams;
        }
    }

    /**
     * renderuje ve frontendu zobrazeni detailu polozky
     * - vyuziva k tomu ItemsControl komponentu, ktere predava jen id
     * 
     * @param string $category webalize url pro identifikaci kategorie - pouzivame jen kvuli hezke tvorbe url, jinak selectujem z db dle $id, jenom ;)
     * @param string $manufacturer webalize url pro identifikaci vyrobce - pouzivame jen kvuli hezke tvorbe url, jinak selectujem z db dle $id, jenom ;)
     * @param string $id webalize url pro identifikaci polozky
     */
    public function renderItemDetail($category, $manufacturer, $id) {
        $detail = $this->repository->findOneByColumn('polozka', 'alias', $id);

        #-- pokud bychom detail nenasli
        if (false == $detail) {
            throw new \Nette\Application\BadRequestException();
        }

        #-- pokud by nam nesedela adresa (jina kategorie, jiny vyrobce), tak presmerujem 
        if ($category != $detail->kategorie->alias || $manufacturer != $detail->vyrobce->alias) {
            $this->redirectUrl($this->link('//Default:itemDetail', array($detail->kategorie->alias, $detail->vyrobce->alias, $detail->alias)), 301);
        }

        $this->breadcrumb->add(
                'category', $this->link('Default:items', array($detail->kategorie->alias)), $detail->kategorie->nazev);
        $this->breadcrumb->add(
                'manufacturer', $this->link('Default:items', array($detail->kategorie->alias, $detail->vyrobce->alias)), $detail->vyrobce->nazev);
        $this->breadcrumb->add(
                'itemDetail', $this->link('Default:itemDetail', array($detail->kategorie->alias, $detail->vyrobce->alias, $detail->alias))
                , $detail->nazev);

        $this->template->itemId = $id;
    }

}
