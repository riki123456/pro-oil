<?php

namespace App\Model\Payment\Hotovost;


class Main extends \Nette\Object implements \App\Model\Payment\IPayment {

    /** @var array */
    private $orderData;

    public function setOrderData(array $orderData) {
        $this->orderData = $orderData;
    }

    public function getOrderData() {
        return $this->orderData;
    }

    public function initRequest() {
        
    }

    public function toHtml() {
        $html = '';

        return $html;
    }

    /**
     * 
     * @return array
     */
    public function getReturnResult() {
        return array('paymentStatus' => 4);
    }

    public function getResponseId() {
        return null;
    }

}
