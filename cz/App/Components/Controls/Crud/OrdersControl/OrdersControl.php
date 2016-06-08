<?php

namespace App\Components\Controls\Crud\OrdersControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\RepositoryOrders,
    App\Components\Controls\Crud;

/**
 * Description of OrdersControl
 *
 * @author miroslav.petras
 */
class OrdersControl extends Crud\CrudControl {

    protected $repoTablename = 'objednavka_hlavicka';

    /** @var RepositoryOrders */
    protected $repo;

    /**
     * konfigurace pro bootstrap table
     * 
     * array('dbColumnName' => 'showName', 'dbColumnName' => 'showName', ...)
     * array('name' => 'Jméno', 'surname' => 'Příjmení', ...)
     * 
     * @var array $tableConfig 
     */
    protected $tableConfig = array(
        'datum' => 'Datum',
        'ciselna_rada' => 'Čís. řada',
        'jmeno' => 'Jméno',
        'prijmeni' => 'Příjmení',
        'firma' => 'Firma',
        'ico' => 'IČO',
        'cena_s_dph' => 'Cena s DPH',
        'data-order' => '[[ 0, "desc" ]]', #-- musi byt zadano v apostrovech (a "asc" v uvozovkach), jinak js nefunguje !
        'data-page-length' => 15
    );

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * 
     * @param Repository $repo
     */
    public function __construct(RepositoryOrders $repo) {
        parent::__construct();

        $this->repo = $repo;
    }

    /**
     * renderuje vse potrebne ke grafum
     * Podle typu renderuje jak obsah, tak js skripty ... a vlastne uplne vsechno ;)
     * 
     * @param int $grafType typ grafu - dle toho resim sql dotaz, zpusob zobrazeni apod.
     */
    public function renderGraf($grafType) {
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/raphael/raphael-min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/morrisjs/morris.min.js');
        $fcol->addFile(__DIR__ . '/Scripts/graf-init.js');

        $fcol2 = $this->presenter->getComponent("cssDynamic")->getCompiler()->getFileCollection();
        $fcol2->addFile(ROOT_FS_WWW . '/media/morrisjs/morris.css');

        #-- do view, ridi se tim i skriptovaci cast !
        $this->template->grafType = $grafType;

        #-- ziskame potrebna data
        ##-- data mame (zatim) jen jedna
        $data = $this->repo->getGrafData($this->repoTablename);
        $dataGraf = array();

        #-- ted podle typu zpracujeme do json pro inicializaci v js
        switch ($grafType) {
            case 1:
                $this->template->grafTitle = 'Splněné objednávky za posledních 12 měsíců';
                $this->template->grafTitleIconClass = 'fa-bar-chart';

                $this->template->grafLabel = '["počet"]';
                $this->template->grafXkey = 'y';
                $this->template->grafYkeys = '[2]';

                #-- data - poskladame do formatu pro graf
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                    $dateKey = $row['y'] . '/' . $row['m'];

                    if (false == array_key_exists($dateKey, $dataGraf)) {
                        $dataGraf[$dateKey]['y'] = $dateKey;
                        $dataGraf[$dateKey][$row['stav']] = $row['pocet'];
                    } else {
                        $dataGraf[$dateKey][$row['stav']] = $row['pocet'];
                    }
                }

                $this->template->grafData = \Nette\Utils\Json::encode(array_values($dataGraf));
                break;
            case 2:
                $this->template->grafTitle = 'Peněžní objem (cena bez DPH) v objednávkách za posledních 12 měsíců';
                $this->template->grafTitleIconClass = 'fa-area-chart';

                $this->template->grafLabel = '["suma v kč (bez DPH)"]';
                $this->template->grafXkey = 'y';
                $this->template->grafYkeys = '["a"]';

                ##-- data - poskladame do formatu pro graf
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                    $dateKey = $row['y'] . '/' . $row['m'];

                    if (false == array_key_exists($dateKey, $dataGraf)) {
                        $dataGraf[$dateKey]['y'] = $dateKey;
                        $dataGraf[$dateKey]['a'] = $row['cena_bez_dph'];
                    } else {
                        $dataGraf[$dateKey]['a'] = $row['cena_bez_dph'];
                    }
                }

                $this->template->grafData = \Nette\Utils\Json::encode(array_values($dataGraf));
                break;
            default:
                throw new \Nette\NotImplementedException("Tento typ grafu: '$grafType' neni definovan!", E_USER_ERROR);
        }

        $this->template->setFile(__DIR__ . '/Templates/graf.latte');
        $this->template->render();
    }

    /**
     * info panel - ukazuje jen nove objednavky
     */
    public function renderInfoPanel() {
        $this->template->ordersCount = $this->repo->getNewOrdersCount($this->repoTablename);

        $this->template->setFile(__DIR__ . '/Templates/infoPanel.latte');
        $this->template->render();
    }

    /**
     * zmeni stav objednavky
     * 
     * @param type $id id objednavky
     */
    public function handleChangeType($id, $changeAction) {
        try {
            $this->repo->updateByPrimary($this->repoTablename, array('stav' => $changeAction), $id);
            $this->presenter->flashMessage('Stav objednávky byl změněn.', FLASH_OK);
        } catch (\Exception $e) {
            $this->presenter->flashMessage('Stav objednávky se nepodařilo změnit. Chyba: ' . $e->getMessage(), FLASH_ERR);
        }

        #-- redirect
        $this->presenter->redirect('this', array('type' => $changeAction));
    }

    /**
     * zobrazi detail objednavky + umozni upravit jeji stav pres handler
     * 
     * @param int $id id objednavky
     */
    public function renderDetail($id) {
        #-- filtr na stav objednavek
        $this->template->stavObjednavky = $this->presenter->getParameter('type');

        #-- sql  
        $data = $this->repo->getDetailDataFull($this->repoTablename, $id);
        $this->template->data = $data[0];
        $this->template->dataZakaznik = $data[1];
        $this->template->dataAdresaFakturacni = $data[2];
        $this->template->dataAdresaDodaci = $data[3];
        
        /*
        $this->template->data = $this->repo->getDetailData($this->repoTablename, $id);

        #-- mame definovany urcite alespon jeden radek. 
        #-- muzeme si nacist zakaznik a jeho adresy
        $this->template->dataZakaznik = $this->repo->findAll('objednavka_zakaznik')
                        ->where('objednavka_hlavicka_id = ?', $id)->fetch();

        $this->template->dataAdresaFakturacni = $this->repo->findAll('objednavka_zakaznik_adresy')
                        ->where('address_type = 1 AND objednavka_zakaznik_id = ?', $this->template->dataZakaznik['id'])->fetch();

        $this->template->dataAdresaDodaci = $this->repo->findAll('objednavka_zakaznik_adresy')
                        ->where('address_type = 2 AND objednavka_zakaznik_id = ?', $this->template->dataZakaznik['id'])->fetch();

*/
        
        #-- renderovani
        //$this->template->setFile(__DIR__ . '/Templates/detail.latte');
        $this->template->setFile(__DIR__ . '/Templates/detail-table.latte');
        $this->template->render();
    }

    /**
     * Defaultní pohled - tabulka
     * - upravujeme zde odkazy pro admin tlacitka v radcich
     */
    public function renderDefault() {
        #-- filtr na stav objednavek
        $stav = $this->presenter->getParameter('type');

        #-- filter predany odkazum v radcich (buttonum)
        $this->tableConfig['data-admin-url-params'] = '/?type=' . $stav;

        #-- omezeni na buttony
        $this->newButton = false;
        $this->editButton = false;
        $this->deleteButton = false;

        #-- sql pro vyber
        $this->dataTable = $this->repo->getTableData($this->repoTablename, $stav);

        parent::renderDefault();
    }

    //=================================== PROTECTED ============================
    /**
     * OrdersForm factory.
     * @return Form
     */
    protected function createComponentCrudForm() {
        $form = new Form;

        return $form;
    }

}
