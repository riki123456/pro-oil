<?php

namespace App\Model\Heureka;

class Overeno {

    /** @var string Heureka API url */
    private $apiUrl;

    /** @var string Shop API key */
    private $apiKey;

    /** @var string Chosen language */
    #private $language;

    /** @var IRequester */
    private $requester;

    /** @var string */
    private $email;

    /** @var array */
    private $products;

    /** @var array */
    private $productsItemId;

    /**
     * @param string $apiUrl
     * @param string $apiKey
     * @param \App\Model\Heureka\Overeno\IRequester $requester
     */
    public function __construct($apiUrl, $apiKey, $requester) {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->requester = $requester;
    }

    /**
     * Adds order ID
     *
     * @param int $orderId
     *
     * @return self
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * Sets customer email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Adds ordered products using name
     *
     * Products names should be provided in UTF-8 encoding. The service can handle
     * WINDOWS-1250 and ISO-8859-2 if necessary
     *
     * @param string $productName
     *
     * @return self
     */
    public function addProduct($productName) {
        $this->products[] = $productName;
        return $this;
    }

    /**
     * Adds ordered products using item ID
     *
     * @param string $itemId Ordered product item ID
     *
     * @return self
     */
    public function addProductItemId($itemId) {
        $this->productsItemId[] = $itemId;
        return $this;
    }

    /**
     * Sends data to Heureka
     *
     * @return bool
     *
     * @throws Overeno\Exception
     */
    public function send() {
        if (!$this->apiKey || empty($this->apiKey)) {
            throw new Overeno\InvalidArgumentException('API key is not set');
        }
 
        if (!$this->apiUrl || empty($this->apiUrl)) {
            throw new Overeno\InvalidArgumentException('API url is not set');
        }

        if (!$this->email || empty($this->email)) {
            throw new Overeno\InvalidArgumentException('Customer email address is not set');
        }

        $url = $this->apiUrl;
        $url = $url . '?id=' . $this->apiKey . '&email=' . urlencode($this->email);

        if ($this->products) {
            foreach ($this->products as $product) {
                $url .= '&produkt[]=' . urlencode($product);
            }
        }

        if ($this->productsItemId) {
            foreach ($this->productsItemId as $itemId) {
                $url .= '&itemId[]=' . urlencode($itemId);
            }
        }

        if (isset($this->orderId)) {
            $url .= '&orderid=' . urlencode($this->orderId);
        }

        $httpCode = $this->requester->request($url);

        if ($httpCode === 200) {
            return true;
        }

        throw new Overeno\Exception(
        sprintf('HTTP error - http code: %d, body: %s', $httpCode, $this->requester->getBody()));
    }

}
