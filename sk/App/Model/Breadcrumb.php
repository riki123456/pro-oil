<?php

namespace App\Model;

/**
 * Description of Breadcrumb
 *
 */
class Breadcrumb {

    private $breadcrumbArray = array();

    /**
     * nastavi zaklad pro celou radu breadcrumb
     * 
     * @param string $index klic pro pole v breadcrumb
     * @param string $homepageLink link na homepage
     * @param string $homepageLinkName nazev linku
     */
    public function __construct($index, $homepageLink, $homepageLinkName) {
        $this->add($index, $homepageLink, $homepageLinkName);
    }

    /**
     * zjisti, zda uz mame v breadcrumb definovany index (klic) pole
     * 
     * @param string $index
     * @return boolean
     */
    public function hasIndex($index) {
        $ret = false;
        
        if(array_key_exists($index, $this->breadcrumbArray)) {
            $ret = true;
        } 
        
        return $ret;
    }
    
    /**
     * Prida polozku do pole: $this->breadcrumbArray[$link] = $linkName;
     * 
     * @param string $index klic pro pole v breadcrumb
     * @param string $link url adresa
     * @param string $linkName text linku
     * @return \App\Model\Breadcrumb $this
     */
    public function add($index, $link, $linkName) {
        if (array_key_exists($index, $this->breadcrumbArray)) {
            trigger_error("Zadany index [$index] v poli breadcrumb jiz existuje!. Pokud jej chces prepsat, pouzij radeji metodu 'replace'", E_USER_WARNING);
        } else {
            $this->breadcrumbArray[$index] = array($link, $linkName);
        }

        return $this;
    }

    /**
     * Vymeni hodnoty v breadcrumb poli - podle klice $index
     * 
     * @param string $index klic pro pole v breadcrumb
     * @param string $link url adresa
     * @param string $linkName text linku
     * @return \App\Model\Breadcrumb $this
     */
    public function replace($index, $link, $linkName) {
        if(false == array_key_exists($index, $this->breadcrumbArray)) {
            trigger_error("Zadany index [$index] v poli breadcrumb neexistuje!. Pokud jej chces pridat, pouzij radeji metodu 'add'", E_USER_WARNING);
        } else {
            $this->breadcrumbArray[$index] = array($link, $linkName);
        }
        
        return $this;
    }

    /**
     * odebere link z breadcrumb
     * 
     * @param string $index klic pro pole v breadcrumb
     * @return \App\Model\Breadcrumb $this
     */
    public function remove($index) {
        unset($this->breadcrumbArray[$index]);
        
        return $this;
    }

    /**
     * vrati cely breadcrumb
     * 
     * @return array
     */
    public function getBreadcrumb() {
        return $this->breadcrumbArray;
    }

}
