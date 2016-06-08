<?php

namespace App\Model;

/**
 * Description of Payment
 *
 */
class Payment {
    
    private $orderData;
    
    /** @var Repositories\Repository */
    private $repo;

    /**
     * 
     * @param \App\Model\Repositories\Repository $repo
     */
    public function __construct(Repositories\Repository $repo) {
        $this->repo = $repo;
    }
    
    public function setOrderData(array $orderData) {
        $this->orderData = $orderData;
    }
    
    public function finish() {
        $ret = null;
        $pNazev = (isset($this->orderData[0][0])) ? strtoupper($this->orderData[0][0]->platba_nazev) : null;        
        
        #-- paypal        
        if(\Nette\Utils\Strings::contains($pNazev, "PAYPAL")) {
            $ret = $this->_paypal();
        }
        #-- paysec
        else if(\Nette\Utils\Strings::contains($pNazev, "PAYSEC")) {
            $ret = $this->_paysec();
        }
        
        return $ret;
    }
    
    //======================================== PRIVATE ============================================
    private function _paypal() {
        return "";
    }
    
    private function _paysec() {
        return "";
    }
}
