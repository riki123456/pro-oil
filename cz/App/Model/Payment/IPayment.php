<?php

namespace App\Model\Payment;

interface IPayment {

    public function setOrderData(array $orderData);
    
    public function getOrderData();
    
    public function initRequest();
    
    public function toHtml();
    
    public function getResponseId();
    
    public function getReturnResult();
}

