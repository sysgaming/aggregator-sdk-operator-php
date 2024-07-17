<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorBet
{
    private $requestUUID;
    private $transactionId;
    private $token;
    private $playerId;
    private $externalPlayerId;
    private $roundId;
    private $amount;
    private $currency;
    private $productCode;
    private $isFree;
    private $rewardId;

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
     * @return AggregatorBet
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
     * @return AggregatorBet
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
     * @return AggregatorBet
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
     * @return AggregatorBet
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExternalPlayerId()
    {
        return $this->externalPlayerId;
    }

    /**
     * @param mixed $externalPlayerId
     * @return AggregatorBet
     */
    public function setExternalPlayerId($externalPlayerId)
    {
        $this->externalPlayerId = $externalPlayerId;
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
     * @return AggregatorBet
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
     * @return AggregatorBet
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
     * @return AggregatorBet
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
     * @return AggregatorBet
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsFree()
    {
        return $this->isFree;
    }

    /**
     * @param bool $isFree
     * @return AggregatorBet
     */
    public function setIsFree($isFree)
    {
        $this->isFree = $isFree;
        return $this;
    }

    /**
     * @return string
     */
    public function getRewardId()
    {
        return $this->rewardId;
    }

    /**
     * @param string $rewardId
     * @return AggregatorBet
     */
    public function setRewardId($rewardId)
    {
        $this->rewardId = $rewardId;
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