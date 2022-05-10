<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorBalance
{
    private $requestUUID;
    private $token;
    private $playerId;
    private $currency;
    private $productCode;

    private $payload;

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param mixed $requestUUID
     * @return AggregatorBalance
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
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
     * @return AggregatorBalance
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
     * @return AggregatorBalance
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
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
     * @return AggregatorBalance
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
     * @return AggregatorBalance
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
     * @return AggregatorBalance
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }



}