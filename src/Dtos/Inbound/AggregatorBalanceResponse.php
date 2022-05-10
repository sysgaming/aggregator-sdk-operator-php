<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorBalanceResponse {

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

}