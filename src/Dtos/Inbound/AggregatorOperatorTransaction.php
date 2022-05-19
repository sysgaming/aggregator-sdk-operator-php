<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Inbound;

class AggregatorOperatorTransaction {

    const TR_TYPE_BET = 'bet';
    const TR_TYPE_WIN = 'win';
    const TR_TYPE_ROLLBACK = 'rollback';

    private $transactionId;
    private $roundId;
    private $currency;
    private $amount;
    private $playerId;
    private $productCode;
    private $type;

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     * @return AggregatorOperatorTransaction
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
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
     * @return AggregatorOperatorTransaction
     */
    public function setRoundId($roundId)
    {
        $this->roundId = $roundId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return AggregatorOperatorTransaction
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return AggregatorOperatorTransaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     * @return AggregatorOperatorTransaction
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
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
     * @return AggregatorOperatorTransaction
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return AggregatorOperatorTransaction
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}