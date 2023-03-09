<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;

class AggregatorBalanceResponse implements AggregatorJsonObject {

    private $requestUUID;
    private $currency;
    private $balance;
    private $timestamp;

    /**
     * AggregatorBalanceResponse constructor.
     * @param $requestUUID string
     * @param $currency string
     * @param $balance int
     */
    public function __construct($requestUUID, $currency, $balance)
    {
        $this->requestUUID = $requestUUID;
        $this->currency = $currency;
        $this->balance = $balance;
        $this->timestamp = floor(microtime(true) * 1000); // timestamp in milliseconds
    }

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    function toArray() {

        return [
            'requestUUID' => $this->getRequestUUID(),
            'currency' => $this->getCurrency(),
            'balance' => $this->getBalance(),
            'timestamp' => $this->getTimestamp()
        ];

    }


}