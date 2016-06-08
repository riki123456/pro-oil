<?php

namespace App\Model\Repositories;

use Nette,
    Nette\Database\Table;

/**
 * Description of Repository
 *
 * @author miroslav.petras
 */
class Repository extends Nette\Object {

    /** @var Nette\Database\Context */
    private $db;

    /** @var string prefix pro db tabulky */
    private $db_prefix = DB_PREFIX;

    /**
     * 
     * @param Nette\Database\Context $database
     */
    public function __construct(Nette\Database\Context $database) {
        $this->db = $database;
    }

    /**
     * @return \Nette\Database\Context $db
     */
    public function getDb() {
        return $this->db;
    }

    /**
     * vrati prefix pro db tabulky
     * 
     * @return string
     */
    public function getDbPrefix() {
        return $this->db_prefix;
    }

    /**
     * vrati vsechny zaznamy
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param bool $disableDbPrefix vypnuti uziti prefixu tabulek
     * @return Table\Selection
     */
    public function findAll($tname, $disableDbPrefix = false) {
        if(false == $disableDbPrefix) {
            $tname = $this->db_prefix . $tname;
        }
        
        return $this->db->table($tname);
    }

    /**
     * vrati vsechny zaznamy omezene dle colName a colValue
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $colName jmeno sloupce pro omezeni
     * @param mixed $colValue hodnota sloupce pro omezeni
     * @return Table\Selection
     */
    public function findAllByColumn($tname, $colName, $colValue) {
        return $this->findAll($tname)->where("$colName = ?", $colValue);
    }

    /**
     * vrati radek na zaklade id
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param int $id id radku
     * @return IRow or FALSE if there is no such row
     */
    public function findOneById($tname, $id) {
        return $this->findAll($tname)->get($id);
    }

    /**
     * vrati radek na zaklade definovaneho sloupce a jeho hodnoty
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $colName nazev radku
     * @param mixed $colValue hodnota radku
     * @return IRow or FALSE if there is no such row
     */
    public function findOneByColumn($tname, $colName, $colValue) {
        return $this->findAll($tname)->where("$colName = ?", $colValue)->fetch();
    }

    /**
     * vrati radek na zaklade where klauzule
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $where where klauzule
     * @param mixed $whereParameters parametry pro where klauzuli
     * @return Table\Selection
     */
    public function findAllByWhere($tname, $where = '', $whereParameters = null) {
        return $this->findAll($tname)->where($where, $whereParameters);
    }

    /**
     * smaze uzivatele
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param type $id id uzivatele
     */
    public function delete($tname, $id) {
        return $this->findOneById($tname, $id)->delete();
    }

    /**
     * vlozi noveho uzivatele
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param array $values
     * @return IRow|int|bool Returns IRow or number of affected rows for Selection or table without primary key
     */
    public function insert($tname, array $values) {
        return $this->findAll($tname)->insert($values);
    }

    /**
     * update uzivatele
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param array $values
     * @param string $where clausule
     * @param mixed $whereParameters parametry pro where klauzuli
     * @return int number of affected rows
     */
    public function update($tname, array $values, $where, $whereParameters = null) {
        return $this->findAll($tname)->where($where, $whereParameters)->update($values);
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
        return $this->findAll($tname)->wherePrimary($wherePrimary)->update($values);
    }

    /**
     * vrati z databaze dvojici sloupcu (tzv. par). Napriklad pro selectlist
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $col1 prvni sloupec z paru
     * @param string $col2 druhy sloupec z paru
     * @param string $order setrizeni
     * @return array
     */
    public function getPairs($tname, $col1, $col2, $order = '') {
        $ret = array();

        if ('' != $order) {
            $ret = $this->findAll($tname)->order($order)->fetchPairs($col1, $col2);
        } else {
            $ret = $this->findAll($tname)->fetchPairs($col1, $col2);
        }

        return $ret;
    }

    /**
     * vrati z databaze dvojici sloupcu (tzv. par), omezeno podle where. Napriklad pro selectlist
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $col1 prvni sloupec z paru
     * @param string $col2 druhy sloupec z paru     
     * @param string $where clausule
     * @param mixed $whereParameters parametry pro where klauzuli
     * @param string $order setrizeni
     * @return array
     */
    public function getPairsByWhere($tname, $col1, $col2, $where, $whereParameters, $order = '') {
        $ret = array();

        if ('' != $order) {
            $ret = $this->findAll($tname)->where($where, $whereParameters)->order($order)->fetchPairs($col1, $col2);
        } else {
            $ret = $this->findAll($tname)->where($where, $whereParameters)->fetchPairs($col1, $col2);
        }

        return $ret;
    }

    /**
     * vrati z databaze dvojici sloupcu (tzv. par), omezeno podle where (napr. pro selectlist).
     * Umoznuje definovat pro $col2 sql funkci CONCAT, ktera umi spojovat (vice sloupcu, sloup a text, apod)
     * 
     * @param string $tname jmeno hlavni tabulky pro select
     * @param string $concat CONCAT prikaz - pro spojeni sloupcu
     * @param string $col1 prvni sloupec z paru
     * @param string $col2 druhy sloupec z paru     
     * @param string $where clausule
     * @param mixed $whereParameters parametry pro where klauzuli
     * @param string $order setrizeni
     * @return array
     */
    public function getPairsConcatByWhere($tname, $concat, $col1, $col2, $where, $whereParameters, $order = '') {
        $ret = array();

        if ('' != $order) {
            $ret = $this->findAll($tname)
                    ->select("$col1, $concat AS $col2")
                    ->where($where, $whereParameters)
                    ->order($order)
                    ->fetchPairs($col1, $col2);
        } else {
            $ret = $this->findAll($tname)
                    ->select("$col1, $concat AS $col2")
                    ->where($where, $whereParameters)
                    ->fetchPairs($col1, $col2);
        }

        return $ret;
    }

}
