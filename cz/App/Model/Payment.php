<?php

namespace App\Model;

/**
 * Description of Payment
 *
 */
class Payment {

    /** @var \App\Model\Payment\Csob\Main */
    private $csobClass;
    
    /** @var \App\Model\Payment\Hotovost\Main */
    private $hotovostClass;

    /** @var \App\Model\Payment\IPayment */
    private $paymentClass = null;

    /** @var array */
    private $orderData = array();

    /** @var mixed */
    private $paymentResponseId = null;

    /**
     * 
     * @param \App\Model\Payment\Csob\Main $csobClass 
     * @param \App\Model\Payment\Hotovost\Main $hotovostClass 
     */
    public function __construct(Payment\Csob\Main $csobClass, Payment\Hotovost\Main $hotovostClass) {
        $this->csobClass = $csobClass;
        $this->hotovostClass = $hotovostClass;
    }

    /**
     * 
     * @param array $data
     */
    public function setOrderData(array $data) {
        $this->orderData = $data;
    }

    /**
     * zavola spravnou obsluznou tridu pro PAYMENT (dle $platba_nazev) a provede vychozi request
     * 
     * @return mixed
     * @desctiption dle implementace obsluzne tridy
     * 
     * @throws \Nette\NotImplementedException
     * @throws Exception
     */
    public function processOrderData() {        
        $this->paymentClass = $this->_getPaymentClass();

        $this->paymentClass->setOrderData($this->orderData);
        $this->paymentClass->initRequest();
        $this->paymentResponseId = $this->paymentClass->getResponseId();

        return $this->paymentClass->toHtml();
    }

    /**
     * vrati jedinecne id, poslane bankou k identifikaci platby
     * 
     * @return null|string|int|false
     */
    public function getPaymentResponseId() {
        return $this->paymentResponseId;
    }

    /**
     * 
     * @return \App\Model\Payment\IPayment $paymentClass
     */
    public function getActivePaymentClass() {
        if (null == $this->paymentClass) {
            $this->paymentClass = $this->_getPaymentClass();
        }

        return $this->paymentClass;
    }

    // ============= PRIVATE ===============
    /**
     * 
     * @return \App\Model\Payment\IPayment $paymentClass
     * @throws \Nette\NotImplementedException
     * @throws \Exception
     */
    private function _getPaymentClass() {
        $pNazev = (isset($this->orderData[0][0])) ? strtoupper($this->orderData[0][0]->platba_nazev) : null;
        
        #-- hotovost - nedelam temer nic ;)
        if (\Nette\Utils\Strings::contains($pNazev, 'HOTOVOST')) {
            $class = $this->hotovostClass;
        }
        #-- csob
        else if (\Nette\Utils\Strings::contains($pNazev, 'PLATBA KARTOU')) {
            $class = $this->csobClass;
        }
        #-- paypal        
        else if (\Nette\Utils\Strings::contains($pNazev, "PAYPAL")) {
            throw new \Nette\NotImplementedException("Trida pro obsluhu sluzby PAYPAL neni implementovana");
        }
        #-- paysec
        else if (\Nette\Utils\Strings::contains($pNazev, "PAYSEC")) {
            throw new \Nette\NotImplementedException("Trida pro obsluhu sluzby PAYSEC neni implementovana");
        } else {
            throw new \Exception("Nepodarilo se najit odpovidajici class, testovany nazev: $pNazev");
        }
        
        return $class;
    }

}
