<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorRollback
{
    private $requestUUID;
    private $transactionId;
    private $token;
    private $roundId;
    private $productCode;

    protected $payload;

    /**
     * @return string
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param string $requestUUID
     * @return AggregatorRollback
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     * @return AggregatorRollback
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return AggregatorRollback
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoundId()
    {
        return $this->roundId;
    }

    /**
     * @param string $roundId
     * @return AggregatorRollback
     */
    public function setRoundId($roundId)
    {
        $this->roundId = $roundId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param string $productCode
     * @return AggregatorRollback
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