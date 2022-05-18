<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;

class AggregatorBalanceResponse implements AggregatorJsonObject {

    private $requestUUID;
    private $currency;
    private $balance;

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

    function toArray() {

        return [
            'requestUUID' => $this->getRequestUUID(),
            'currency' => $this->getCurrency(),
            'balance' => $this->getBalance(),
        ];

    }


}