<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

class AggregatorStartPlaying
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
     * AggregatorBet constructor.
     * @param $requestUUID
     * @param $transactionId
     * @param $token
     * @param $playerId
     * @param $roundId
     * @param $amount
     * @param $currency
     * @param $productCode
     */
    public function __construct($requestUUID, $transactionId, $token, $playerId, $roundId, $amount, $currency, $productCode)
    {
        $this->requestUUID = $requestUUID;
        $this->transactionId = $transactionId;
        $this->token = $token;
        $this->playerId = $playerId;
        $this->roundId = $roundId;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->productCode = $productCode;
    }

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param mixed $requestUUID
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     * @return AggregatorStartPlaying
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
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

}