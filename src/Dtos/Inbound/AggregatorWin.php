<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorWin
{
    private $requestUUID;
    private $transactionId;
    private $token;
    private $playerId;
    private $roundId;
    private $amount;
    private $currency;
    private $productCode;

    protected $payload;

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param mixed $requestUUID
     * @return AggregatorWin
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param mixed $transactionId
     * @return AggregatorWin
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     * @return AggregatorWin
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param mixed $playerId
     * @return AggregatorWin
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoundId()
    {
        return $this->roundId;
    }

    /**
     * @param mixed $roundId
     * @return AggregatorWin
     */
    public function setRoundId($roundId)
    {
        $this->roundId = $roundId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return AggregatorWin
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return AggregatorWin
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param mixed $productCode
     * @return AggregatorWin
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     * @return AggregatorWin
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

}