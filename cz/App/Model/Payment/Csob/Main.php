<?php

namespace App\Model\Payment\Csob;

use \OndraKoupil\Csob;

class Main extends \Nette\Object implements \App\Model\Payment\IPayment {

    const REDIRECT_TIME = 100;

    /** @var array */
    private $orderData;

    /** @var \OndraKoupil\Csob\Client */
    private $csobClient;

    /** @var \OndraKoupil\Csob\Payment */
    private $csobPayment;
    private $responseId;

    /**
     * 
     * @param \OndraKoupil\Csob\Client $client
     * @param \OndraKoupil\Csob\Payment $payment
     */
    public function __construct(Csob\Client $client, Csob\Payment $payment) {
        $this->csobClient = $client;
        $this->csobPayment = $payment;
    }

    public function setOrderData(array $orderData) {
        $this->orderData = $orderData;
    }

    public function getOrderData() {
        return $this->orderData;
    }

    public function initRequest() {
        try {
            #-- nastavime data
            $this->csobPayment->orderNo = $this->orderData[0][0]->id;
            $this->csobPayment->addCartItem('objednavka', 1, ceil($this->orderData[0][0]->cena_s_dph) * 100);
            if ($this->orderData[0][0]->doprava_cena_s_dph > 0) {
                $this->csobPayment->addCartItem('doprava', 1, ceil($this->orderData[0][0]->doprava_cena_s_dph) * 100);
            }
            
            $this->csobClient->paymentInit($this->csobPayment);

            $this->responseId = $this->csobPayment->getPayId();
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    public function toHtml() {
        $html = '';

        $html.= '<a href="' . $this->csobClient->getPaymentProcessUrl($this->csobPayment) . '"';
        $html.= ' class="btn btn-primary disabled">Přesměrování na platbu za: <span id="paymentTimer">' . self::REDIRECT_TIME . '</span> <span" class="fa fa-angle-double-right"></span></a>';
        $html.= '<a href="' . $this->csobClient->getPaymentProcessUrl($this->csobPayment) . '"';
        $html.= ' class="btn btn-default pull-right" id="paymentManual">Přejit k platbě ihned <span class="fa fa-angle-double-right"></span></a>';

        return $html;
    }

    /**
     * 
     * @return array|null Array with received data or null if no data is present.
     */
    public function getReturnResult() {
        return $this->csobClient->receiveReturningCustomer();
    }

    public function getResponseId() {
        return $this->responseId;
    }

}
