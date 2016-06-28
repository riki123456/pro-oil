<?php

namespace App\Components\Controls\Crud\ItemsControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Model,
    App\Components\Controls\Crud;

/**
 * Description of ManufacturersControl
 *
 * @author miroslav.petras
 */
class ItemsControl extends Crud\CrudControl {

    const SQL_BALENI_DALSI_ROWS_IDS = 'GROUP_CONCAT(id ORDER BY cena_bez_dph SEPARATOR \',\') baleni_dalsi_ids';
    const SQL_BALENI_DALSI = 'GROUP_CONCAT(alias,\'#\', baleni_pocet,\'#\',baleni_mj ORDER BY cena_bez_dph SEPARATOR \'|\') baleni_dalsi';

    protected $repoTablename = 'polozka';

    /**
     * @var \Nette\Http\Request $httpRequest
     */
    protected $httpRequest;

    /** @var Repository */
    protected $repo;

    /** @var Model\ImageStorage */
    protected $imageStorage;

    /**
     * @var \Nette\Mail\IMailer $mailer
     */
    protected $mailer;

    /** @var array */
    protected $sqlParams = array();

    /**
     * konfigurace pro bootstrap table
     * 
     * array('dbColumnName' => 'showName', 'dbColumnName' => 'showName', ...)
     * array('name' => 'Jméno', 'surname' => 'Příjmení', ...)
     * 
     * @var array $tableConfig 
     */
    protected $tableConfig = array(
        'nazev' => 'Název',
        'kategorie#nazev' => 'Kategorie', #-- pokud je v name sloupce znak #, pak to znamena, ze nacitame z ref tabulky, tady napr. $data->kategorie->nazev
        'vyrobce#nazev' => 'Výrobce',
        //'kod' => 'Kód',
        //'popis_kratky' => 'Pořadí zobrazení',
        //'popis_dlouhy' => 'Popis - delší',
        //'specifikace' => 'Specifikace',
        'cena_bez_dph' => 'Cena bez DPH', // bez DPH',
        'baleni_pocet' => 'Balení ks',
        'baleni_mj' => 'Balení MJ',
        //'hmotnost' => 'Hmotnost',
        'page_main' => 'Hlavní stránka',
        'page_akce' => 'Je v akci',
            //'img' => 'Obrázek',
            //'alias' => 'Url',
            //'keyword' => 'Klíčová slova',
            //'description' => 'Popis'
    );

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * 
     * @param Repository $repo
     * @param Model\ImageStorage $imageStorage
     * @param \Nette\Http\Request $httpRequest
     */
    public function __construct(Repository $repo, Model\ImageStorage $imageStorage, \Nette\Http\Request $httpRequest, \Nette\Mail\IMailer $mailer) {
        parent::__construct();

        $this->repo = $repo;
        $this->imageStorage = $imageStorage;
        $this->httpRequest = $httpRequest;
        $this->mailer = $mailer;
    }

    /**
     * provede nacteni potrebne polozky a vrati jeji kartu
     * - funguje hlavne pro ajax
     * 
     * @param string $alias webalize url pro ziskani polozky
     * @param string $type jaky typ zobrazeni vracet (full/detail), default 'full'
     */
    public function handleProductSwitch($alias, $type = 'full') {
        $sql = $this->_getItems(array('alias' => $alias));

        if ($this->presenter->isAjax()) {
            $this->redrawControl('productsContainer');

            if ('full' == $type) {
                $this->template->itemData = $this->_appendBaleniDalsi($sql);
                $this->template->setFile(__DIR__ . '/Templates/_products.latte');
            } elseif ('detail' == $type) {
                $this->template->itemData = $this->_appendBaleniDalsi($sql, true);
                $this->template->setFile(__DIR__ . '/Templates/item-detail.latte');
            } else {
                trigger_error('Nedefinovany typ pro renderovani. Type: ' . $type, E_USER_WARNING);
            }
        } else {
            $this->redirect('this');
        }
    }

    /**
     * zpracuje data z vyhledavani
     * -- nerenderuje vyhledavaci form !!
     */
    public function handleItemsSearch() {
        foreach ($this->getPresenter()->getRequest()->getParameters() as $key => $param) {
            if ('' != $param) {
                switch ($key) {
                    case 's-nazev':
                        $this->sqlParams['nazev LIKE'] = "%$param%";
                        break;
                    case 's-kategorie':
                        $this->sqlParams['kategorie_id'] = $param;
                        break;
                    case 's-vyrobce':
                        $this->sqlParams['vyrobce_id'] = $param;
                        break;
                    case 's-sae':
                        $this->sqlParams['specifikace_sae LIKE'] = "%$param%";
                        break;
                    case 's-api':
                        $this->sqlParams['specifikace_api LIKE'] = "%$param%";
                        break;
                    case 's-ace':
                        $this->sqlParams['specifikace_ace LIKE'] = "%$param%";
                        break;
                    case 's-norma-vyrobce':
                        $this->sqlParams['specifikace_vyrobce LIKE'] = "%$param%";
                        break;
                    default:
                        continue;
                }
            }
        }
    }

    /**
     * vyrenderuje detail polozky
     * 
     * @param string $id webalize url pro ziskani polozky
     */
    public function renderPolozkaDetail($id) {
        // fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();

        $fcol->addFile(ROOT_FS_WWW . '/media/colorbox/jquery.colorbox-min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/nette/live-form-validation.min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/bootstrap-dialogConfirm.js');
        $fcol->addFile(__DIR__ . '/../../Scripts/Form.js');
        $fcol->addFile(__DIR__ . '/Scripts/items.js');

        // fileCollection - css
        $fcol2 = $this->presenter->getComponent("cssDynamic")->getCompiler()->getFileCollection();
        $fcol2->addFile(ROOT_FS_WWW . '/media/colorbox/colorbox.css');

        // nejdrive si zjistime polozku dle $id
        $sql = $this->_getItems(array('alias'=>$id));
        $this->template->itemData = $this->_appendBaleniDalsi($sql, true);

        // ted si k ni najdeme vsechny dalsi baleni, ktere existuji (selectujeme uz bez $id)
        if (false !== $this->template->itemData) {
            $data = $this->repo->findAll('polozka')
                    ->where('nazev', $this->template->itemData['nazev'])
                    ->select(self::SQL_BALENI_DALSI)
                    ->group('nazev')
                    ->fetch();

            // a pridame do view
            $this->template->itemDataBaleniDalsi = isset($data['baleni_dalsi']) ? $data['baleni_dalsi'] : '';
        }

        // vyrenderujeme
        $this->template->setFile(__DIR__ . '/Templates/item-detail.latte');
        $this->template->render();
    }

    /**
     * vyrenderuje vyhledavaci formular pro polozky
     * - nezpracovava vyhledavaci data !!
     */
    public function renderItemsSearch() {
        $request = $this->getPresenter()->getRequest();
        $this->template->defVal = array();

        $this->template->defVal['s-nazev'] = $request->getParameter('s-nazev');
        $this->template->defVal['s-kategorie'] = $request->getParameter('s-kategorie');
        $this->template->defVal['s-vyrobce'] = $request->getParameter('s-vyrobce');
        $this->template->defVal['s-sae'] = $request->getParameter('s-sae');
        $this->template->defVal['s-api'] = $request->getParameter('s-api');
        $this->template->defVal['s-acea'] = $request->getParameter('s-acea');
        $this->template->defVal['s-norma-vyrobce'] = $request->getParameter('s-norma-vyrobce');

        $this->template->kategorie = $this->repo->findAllByColumn('kategorie', 'display', 1)->order('poradi')->fetchAll();
        $this->template->vyrobce = $this->repo->findAllByColumn('vyrobce', 'display', 1)->order('poradi')->fetchAll();

        $this->template->setFile(__DIR__ . '/Templates/items-search.latte');
        $this->template->render();
    }

    /**
     * renderuje seznam polozek "v akci". Vyuziva metodu renderItems, ktere jen
     * preda parametry (polozky se renderujou v mini verzi ;) ....)
     * 
     * RENDERUJE VE FORMATU 'mini' - do praveho 'rightbaru'
     */
    public function renderItemsInAction() {
        $this->renderItems(array('page_akce' => 1), true);
    }

    /**
     * renderuje seznam polozek dle zadanych parametru
     * - z url si pripadne prebira sortovani (sortCol, sortType), cislo stranky (pageNum) a pocet stranek pro zobrazeni (pageCount)
     * 
     * @param array $sqlParams filtr pro sql, podle nej vracime seznam polozek
     * @param bool $mini zda zobrazit jen mini verzi (jen nektere udaje - napr. pro bocni panel atd.)
     */
    public function renderItems(array $sqlParams, $mini = false) {
        // pokud bychom meli v clenske promenne nejaka data, znamena to,
        // ze nejake jina metoda chce predat parametry ... takze to radej preberem
        if (false == empty($this->sqlParams)) {
            $sqlParams = $this->sqlParams;
            $this->sqlParams = null;
        }

        // fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/jquery/jquery-bootstrap-paginator.min.js');
        //$fcol->addFile(ROOT_FS_WWW . '/media/colorbox/jquery.colorbox-min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/bootstrap-dialogConfirm.js');
        $fcol->addFile(__DIR__ . '/Scripts/items.js');

        // fileCollection - css
        //$fcol2 = $this->presenter->getComponent("cssDynamic")->getCompiler()->getFileCollection();
        //$fcol2->addFile(ROOT_FS_WWW . '/media/colorbox/colorbox.css');
// nejdrive vsechny polozky. Zaroven si schovame informace o dalsich balenich. Budou se hodit ;)
        $sql = $this->_getItems($sqlParams);

        // rozlisime zda chceme velikost mini nebo normal
        if ($mini) {
            $this->template->setFile(__DIR__ . '/Templates/items-mini.latte');

            #-- no a muzem ziskat data
            $this->template->itemData = $this->_appendBaleniDalsi($sql); //$data->fetchAll();
        } else {
            #-- request
            $request = $this->getPresenter()->getRequest();
            $page = (null == $request->getParameter('page') ? 1 : $request->getParameter('page'));
            $pageRows = (null == $request->getParameter('rows') ? 12 : $request->getParameter('rows'));
            $sortCol = (null == $request->getParameter('sortCol') ? 'cena_bez_dph' : $request->getParameter('sortCol'));
            $sortType = (null == $request->getParameter('sortType') ? 'ASC' : strtoupper($request->getParameter('sortType')));

            #-- jeste si zjistime, kolik polozek            
            $this->template->itemsPageTotal = (false !== $sql) ? ceil($sql->count() / $pageRows) : 0;

            #-- url pro paginator, manipulation, pager ...
            $url = $this->httpRequest->getUrl()->appendQuery(
                    array("page" => $page, "rows" => $pageRows, "sortCol" => $sortCol, "sortType" => $sortType)
            );
            $this->template->itemsUrl = $url;

            #-- a sort
            $sql->order("$sortCol $sortType");

            #-- a ted nejake offsety a limity ... az nakonec !
            $sql->page($page, $pageRows);

            #-- no a muzem ziskat data
            $this->template->itemData = $this->_appendBaleniDalsi($sql); //$data->fetchAll();
            #-- sablona
            $this->template->setFile(__DIR__ . '/Templates/items.latte');
        }

        #-- renderujeme
        $this->template->render();
    }

    /**
     * info panel
     */
    public function renderInfoPanel() {
        $this->template->itemsCount = count($this->repo->findAll($this->repoTablename));

        $this->template->setFile(__DIR__ . '/Templates/infoPanel.latte');
        $this->template->render();
    }

    /**
     * nejdrive zavola rodicovskou metodu - ta nam vse obhospodari.
     * my potom nastavime jen 'description' a vyrenderujeme.
     * 
     * Pouziva se i pro 'renderDetail' !
     * 
     * @param int $id id polozky
     */
    public function renderEdit($id) {
        #-- vypneme rodici renderovani
        $this->renderNow = false;
        #-- zavolame rodicovskou metodu - naplni nam def. hodnoty
        parent::renderEdit($id);

        #-- upravime description at mame i zobrazeny obrazek
        $form = $this['crudForm'];
        if (true !== empty($form->getValues(true)['img'])) {
            $imagePathFs = $this->imageStorage->getFsPathSmall($form->getValues(true)['img'], "/items");

            #-- upravujeme, jen pokud obrazek existuje
            if (file_exists($imagePathFs)) {
                $imagePathWww = $this->imageStorage->getWwwPathSmall($form->getValues(true)['img'], "/items");
                $form[parent::$imageUploadValueName]->setOption('description', \Nette\Utils\Html::el('img')->addAttributes(
                                array('src' => $imagePathWww)
                        )
                );
            }
        }

        #-- renderujeme
        $this->template->crudForm = $this['crudForm'];
        $this->template->setFile(__DIR__ . '/Templates/item-form.latte');
        $this->template->render();
    }

    /**
     * zpracovava odeslani emailu prodejci
     * 
     * @param UI\Form $form
     */
    public function successFormQuestion($form) {
        $values = $form->getValues();

        $mail = new \Nette\Mail\Message();
        $mail->setFrom($values->email, $values->jmeno);
        //$mail->addTo(MAIL_PRODEJCE);
        //$mail->addCc(MAIL_KANCELAR);
        $mail->addTo(MAIL_ESHOP);
        $mail->addBcc(MAIL_ADMIN);
        $mail->setSubject("Dotaz na prodejce");
        $mail->setBody($values->zprava);

        try {
            $this->mailer->send($mail);

            $this->presenter->flashMessage('Email byl v pořádku odeslán.', FLASH_OK);
        } catch (\Exception $e) {
            $this->presenter->flashMessage('Email se nepodařilo odeslat. Zkuste prosím akci opakovat později.', FLASH_ERR);

            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }

    /**
     * zpracovava upload soubor, pote vola parent metodu
     * 
     * @param UI\Form $form
     */
    public function successForm($form) {
        $values = $form->getValues(true);

        #-- upravime 'alias' - je to pro url
        $values['alias'] = \Nette\Utils\Strings::webalize($values['nazev'] . ' ' . $values['baleni_pocet'] . '' . $values['baleni_mj']);

        #-- a ted poresime pripadny obrazek
        if (isset($values[parent::$imageUploadValueName])) {
            $image = $values[parent::$imageUploadValueName];
            $filename = $values['img'];

            #-- kontrola, zda-li byl obrazek skutecne nahran a zda se jedna o obrazek
            if ($image->isOk() && $image->isImage()) {
                $filename = $image->getSanitizedName();

                #-- ted postupne ulozim, cropnem apod.
                #-- nejdrive ulozime original
                $image->move($this->imageStorage->getFsPath($filename, '/items', true));

                #-- omezime velikosti obrazku, mame 3 verze: small (200x100), normal (300x400), large (800x600)
                $cropImage = \Nette\Utils\Image::fromFile($image);
                $cropImage->resize($this->imageStorage->getSizeLargeWidth(), $this->imageStorage->getSizeLargeHeight(), \Nette\Utils\Image::ENLARGE);
                $cropImage->save($this->imageStorage->getFsPathLarge($filename, '/items', true));

                $cropImage1 = \Nette\Utils\Image::fromFile($image);
                $cropImage1->resize($this->imageStorage->getSizeNormalWidth(), $this->imageStorage->getSizeNormalHeight(), \Nette\Utils\Image::ENLARGE);
                $cropImage1->save($this->imageStorage->getFsPathNormal($filename, '/items', true));

                $cropImage2 = \Nette\Utils\Image::fromFile($image);
                $cropImage2->resize($this->imageStorage->getSizeSmallWidth(), $this->imageStorage->getSizeSmallHeight(), \Nette\Utils\Image::ENLARGE);
                $cropImage2->save($this->imageStorage->getFsPathSmall($filename, '/items', true));
            }

            #-- do db ulozime cestu k obrazku - pole 'img' ne 'image'
            $this->removeElementFromForm($form, array('image'));
            $values['img'] = $filename;
            $form->setValues($values);
        }

        #-- a zavolame parent metodu
        parent::successForm($form);
    }

    //=================================== PROTECTED ============================
    /**
     * kompletuje formular pro zaslani zpravy prodejci
     * 
     * @return UI\Form
     */
    protected function createComponentQuestionForm() {
        // fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(__DIR__ . '/../../Scripts/recaptcha.js');
        
        $form = new Form();
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- inputs
        $form->addText('jmeno', 'Vaše jméno:')->setRequired('Jméno musí být vyplněno.');
        $form->addText('email', 'Váš email:')->setType('email')
                ->setRequired('Email musí být vyplněn.')
                ->addRule(Form::EMAIL, "Email nemá správný formát.");
        $form->addTextArea('zprava', 'Vaše zpráva:')->setRequired('Zpráva musí být vyplněna.')
                ->getControlPrototype()->addAttributes(array('rows' => 7));
        $form->addReCaptcha('captcha', NULL, 'Ověření se nezdařilo. Zkuste prosím akci zopakovat.');
        
        #-- buttons
        $form->addSubmit('ok', 'Odeslat');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successFormQuestion');

        #-- return
        return $this->boostrapIt($form);
    }

    /**
     * CrudForm factory.
     * @return Form
     */
    protected function createComponentCrudForm() {
        #-- action
        $_act = $this->getPresenter()->getAction();

        #-- form (dynamicky - dle akce)
        $form = new Form;
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- buttons
        // tlacitka dame jiz tady, protoze kdyz nejsou ve skupine, padnou pekne
        // az na konec ;)
        $form->addSubmit('ok', 'Uložit');
        $form->addButton('cancel', 'Storno')
                ->setOmitted(true)
                ->getControlPrototype()
                ->onclick('window.location=\'' . $this->presenter->link("default") . '\';')
                ->addClass('btn-default');

        #-- pridame inputy dle akce
        if ($_act !== 'add') {
            $form->addHidden('id');
        }

        #-- cely form
        $form->addGroup("g1")->setOption('label', 'Základní údaje');
        $form->addText('nazev', 'Název:')->setRequired('Název musí být vyplněn.');
        //$form->addText('kod', 'Kód položky:')->setRequired('Kod musí být vyplněn.');
        if ($_act == 'detail') {
            $form->addText('alias', 'Název v url:');
        }

        #-- kategorie
        $form->addSelect('kategorie_id', 'Kategorie:', $this->repo->getPairs('kategorie', 'id', 'nazev', 'nazev'))
                ->setPrompt(' -- vyberte kategorii --')->setRequired('Zadejte kategorii.');
        #-- vyrobce
        $form->addSelect('vyrobce_id', 'Výrobce:', $this->repo->getPairs('vyrobce', 'id', 'nazev', 'nazev'))
                ->setPrompt(' -- vyberte výrobce --')->setRequired('Zadejte výrobce.');

        #-- dostupnost
        $form->addSelect('dostupnost_id', 'Dostupnost:', $this->repo->getPairs('dostupnost', 'id', 'nazev', 'nazev'))
                ->setPrompt(' -- vyberte dostupnost --')->setRequired('Zadejte dostupnost.');

        #-- cena za baleni
        $this->formDecimal($form, 'cena_bez_dph', 'Cena za balení:')->setAttribute('placeholder', '100');
        $this->formInteger($form, 'baleni_pocet', ' | ')->setAttribute('placeholder', '20');
        $form->addSelect('baleni_mj', '', $this->repo->getPairs('uom', 'jednotka', 'jednotka', 'jednotka'))
                ->setAttribute('style', 'width: auto;');

        #-- schvaleno OEM
        $form->addText('schvaleno_oem', 'Schváleno OEM:');

        #-- specifikace
        $form->addText('specifikace_sae', 'Specifikace SAE:');
        $form->addText('specifikace_api', 'Specifikace API:');
        $form->addText('specifikace_acea', 'Specifikace ACEA:');
        $form->addText('specifikace_vyrobce', 'Specifikace VÝROBCE:');

        $this->formRadioInline($form, 'page_main', 'Ukázat na hl. stránce:')->setRequired('Pole musí být vyplněno.');
        $this->formRadioInline($form, 'page_akce', 'Položka je v akci:')->setRequired('Pole musí být vyplněno.');

        #-- upload pro obrazek a hidden input pro info do db  
        $this->formImage($form, 'img', 'Obrázek:', false);

        #-- dalsi group
        $form->addGroup("g2")->setOption('label', 'Textové údaje');

        if ($_act != 'detail') {
            $form->addHidden('alias');
        }
        $form->addText('popis_kratky', 'Popis - krátký')->setRequired('Krátký popis je povinný.');
        $form->addText('keywords', 'Klíčová slova');
        $form->addTextArea('popis_dlouhy', 'Popis - dlouhý')->getControlPrototype()->addAttributes(array('rows' => 5));

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

    //====================================== PRIVATE ==========================
    /**
     * vrati zakladni pole polozek. <br/>
     * omezene dle where a groupnute dle nazvu <br/>
     * abychom uchovali informace o vsech balenich jednoho nazvu, pouzijeme mysql prikaz CONCAT_GROUP 
     * a tim si do radku pridame pekne potrebne info -> dle nej pak upravujeme nektere data, at vzdy
     * zobrazujeme nejlevnejsi baleni od vybraneho nazvu
     * 
     * @param array $sqlParams seznam parametru pro where
     * @return \Nette\Database\Table\Selection
     */
    private function _getItems(array $sqlParams) {
        $sql = $this->repo->findAll('polozka')->select('*, ' . self::SQL_BALENI_DALSI_ROWS_IDS . ', ' . self::SQL_BALENI_DALSI);

        #-- ted dle predanych parametru
        foreach ($sqlParams as $pname => $pvalue) {
            if (null != $pvalue) {
                //$sql .= "x.".$pname . " = " . $pvalue . " AND ";
                $sql->where($pname, $pvalue);
            }
        }

        $sql->group('nazev');

        return $sql;
    }

    /**
     * prida nam do vysledku dotazu informace o vsechy balenich polozky <br/>
     * zaroven upravi data tak, aby v pripade vice polozek vracely vzdy nejlevnejsi baleni<br/><br/>
     * pokud vyber polozek podlehal nejakemu dotazu, pak mu podlehaji i "baleni_dalsi"<br/>
     * vyjimka je u detailu polozky - tam nacitame vsechny baleni
     * 
     * @param \Nette\Database\Table\Selection $sql
     * @param bool $fetchOnlyOneRow zda vracet jen jeden radek dotazu (napr. pro detail polozky). Default: false
     * @return array
     */
    private function _appendBaleniDalsi(\Nette\Database\Table\Selection $sql, $fetchOnlyOneRow = false) {
        $data = $sql->fetchAll();

        $ids = array();
        $dataNew = array();
        foreach ($data as $d) {
            #-- a jedem, dle magickeho CONCAT_GROUP ... kura!
            $pom = explode(',', $d->baleni_dalsi_ids);

            #-- vzdy nejdrive vlozime ... jestli se potom budou prepisovat z db nebo ne, ted neresime
            $k = $d->kategorie->toArray();
            $v = $d->vyrobce->toArray();
            $do = $d->dostupnost->toArray();

            $dataNew[$d->nazev] = $d->toArray();
            $dataNew[$d['nazev']]['kategorie'] = $k;
            $dataNew[$d['nazev']]['vyrobce'] = $v;
            $dataNew[$d['nazev']]['dostupnost'] = $do;

            #-- pokud mame v groupu ids jen jedno cislo, pak vime, ze data v radku jsou spravne
            #-- pokud mame vic ids, tak data v radku nebereme a musime se kouknout do db :( ... (dle prvniho ids - nejlevnejsi polozka stejneho nazvu)
            if (count($pom) > 1) {
                array_push($ids, $pom[0]);
            }
        }

        $dataNewDb = $this->repo->findAll('polozka')->where('id IN ?', $ids)->fetchAll();
        foreach ($dataNewDb as $dnd) {
            #-- vzdy nejdrive vlozime ... jestli se potom budou prepisovat z db nebo ne, ted neresime
            $k = $dnd->kategorie->toArray();
            $v = $dnd->vyrobce->toArray();
            $do = $dnd->dostupnost->toArray();
            $_x = $dataNew[$dnd->nazev]['baleni_dalsi'];

            $dataNew[$dnd->nazev] = $dnd->toArray();
            $dataNew[$dnd['nazev']]['kategorie'] = $k;
            $dataNew[$dnd['nazev']]['vyrobce'] = $v;
            $dataNew[$dnd['nazev']]['dostupnost'] = $do;
            $dataNew[$dnd['nazev']]['baleni_dalsi'] = $_x;
        }

        if ($fetchOnlyOneRow) {
            return array_pop($dataNew);
        } else {
            return $dataNew;
        }
    }

}
