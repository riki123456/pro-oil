<?php

namespace App\Model\Repositories;

class RepositoryOrders {

    /** @var Repository */
    private $repo;

    /**
     * 
     * @param \App\Model\Repositories\Repository $repo
     */
    public function __construct(Repository $repo) {
        $this->repo = $repo;
    }

    /**
     * vrati vsechny zaznamy
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @return Table\Selection
     */
    public function findAll($tname) {
        return $this->repo->findAll($tname);
    }

    /**
     * update uzivatele dle ID
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param array $values
     * @param int|string primaryKeyValue
     * @return int number of affected rows
     */
    public function updateByPrimary($tname, array $values, $wherePrimary) {
        return $this->repo->updateByPrimary($tname, $values, $wherePrimary);
    }

    /**
     * vrati pocet objednavek se statutem 1 (nova objednavka)
     * 
     * @param type $tname jmeno hlavni tabulky pro select
     * @return int
     */
    public function getNewOrdersCount($tname) {
        $r = $this->repo->findAllByWhere($tname, 'stav = ?', 1)->count();

        return $r;
    }

    /**
     * vrati data pro graf na dashboardu
     * 
     * @param string $tname nazev tabulky
     * @return Table\Selection
     */
    public function getGrafData($tname) {
        $cols = 'count(*) pocet, sum(cena_bez_dph) cena_bez_dph, sum(cena_s_dph) cena_s_dph, YEAR(datum) y, MONTH(datum) m, stav';
        $where = 'datum >= DATE_ADD(NOW(), INTERVAL -11 MONTH) AND stav = 2';
        $return = $this->repo->findAll($tname)->select($cols)->where($where)->group('4,5,6')->order('4,5,6')->fetchAll();

        return $return;
    }

    /**
     * vrati potrebna data pro detail objednavky + vsechny udaje o zakaznikovi!
     * 
     * @param string $tname nazev tabulky
     * @param itn $id id hlavicky objednavky
     * @return array(
     *      Table\Selection $itemsData, 
     *      Table\Selection $dataZakaznik, 
     *      Table\Selection $dataZakaznikAdresaFakturacni, 
     *      Table\Selection $dataZakaznikAdresaDodaci
     *      )
     */
    public function getDetailDataFull($tname, $id) {
        $itemsData = $this->getDetailData($tname, $id);

        #-- mame definovany urcite alespon jeden radek. 
        #-- muzeme si nacist zakaznik a jeho adresy
        $dataZakaznik = $this->repo->findAll('objednavka_zakaznik')
                        ->where('objednavka_hlavicka_id = ?', $id)->fetch();

        $dataAdresaFakturacni = $this->repo->findAll('objednavka_zakaznik_adresy')
                        ->where('address_type = 1 AND objednavka_zakaznik_id = ?', $dataZakaznik['id'])->fetch();

        $dataAdresaDodaci = $this->repo->findAll('objednavka_zakaznik_adresy')
                        ->where('address_type = 2 AND objednavka_zakaznik_id = ?', $dataZakaznik['id'])->fetch();
        
        return array($itemsData, $dataZakaznik, $dataAdresaFakturacni, $dataAdresaDodaci);
    }

    /**
     * vrati potrebna data pro detail objednavky, vrati JEN RADKY s polozkama.
     * Pokud chces vracet i zakaznika, pouzij getDetailDataFull()
     * 
     * @param string $tname nazev tabulky
     * @param itn $id id hlavicky objednavky
     * @return Table\Selection
     */
    public function getDetailData($tname, $id) {
        #-- sql pro zakladni vyber
        $sql = 'SELECT oh.*, '
                . 'ora.polozka_pocet ora_pocet, ora.polozka_cena_bez_dph ora_cena_bez_dph, ora.polozka_id ora_polozka_id, '
                . 'ora.polozka_cena_s_dph ora_cena_s_dph, ora.polozka_nazev ora_polozka_nazev, ora.polozka_dostupnost ora_polozka_dostupnost, '
                . 'ora.polozka_baleni_pocet ora_polozka_baleni_pocet, ora.polozka_baleni_mj ora_polozka_baleni_mj, ora.polozka_vyrobce_nazev ora_polozka_vyrobce_nazev '
                //. 'p.img p_img ' //, p.nazev p_nazev, p.cena_bez_dph p_cena_bez_dph '
                . 'FROM ' . $this->repo->getDbPrefix() . $tname . ' oh '
                . 'INNER JOIN ' . $this->repo->getDbPrefix() . 'objednavka_radky ora ON oh.id = ora.objednavka_id '
                //. 'INNER JOIN ' . $this->repo->getDbPrefix() . 'polozka p ON ora.polozka_id = p.id '
                . 'WHERE oh.id = ' . $id;

        $return = $this->repo->getDb()->query($sql)->fetchAll();

        return $return;
    }

    /**
     * vrati potrebna data pro zobrazeni tabulky
     * 
     * @param string $tname nazev tabulky
     * @param int $stav stav objednavky
     * @return Table\Selection
     */
    public function getTableData($tname, $stav = null) {
        $sql = 'SELECT oh.id, oh.ciselna_rada, oh.cena_s_dph, oh.datum, oh.stav, oz.firma, oz.ico, oza.jmeno, oza.prijmeni '
                . 'FROM ' . $this->repo->getDbPrefix() . $tname . ' oh '
                . 'LEFT JOIN ' . $this->repo->getDbPrefix() . 'objednavka_zakaznik as oz ON oh.id = oz.objednavka_hlavicka_id '
                . 'LEFT JOIN ' . $this->repo->getDbPrefix() . 'objednavka_zakaznik_adresy as oza ON oz.id = oza.objednavka_zakaznik_id AND oza.address_type = 1 '
                . 'WHERE ' . (($stav != null) ? " oh.stav = $stav " : " 1=1 ")
                . 'GROUP BY 1, 2, 3, 4, 5, 6, 7, 8, 9 ';

        $return = $this->repo->getDb()->query($sql)->fetchAll();

        return $return;
    }

}
