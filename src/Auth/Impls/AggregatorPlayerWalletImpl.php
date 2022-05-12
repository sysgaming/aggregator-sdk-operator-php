<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;

abstract class AggregatorPlayerWalletImpl implements AggregatorPlayerWallet
{

    private $id;

    /**
     * @var int
     */
    private $balance;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $token;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AggregatorPlayerWallet
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int the current balance of
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     * @return AggregatorPlayerWallet
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
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
     * @return AggregatorPlayerWallet
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
     * @return AggregatorPlayerWallet
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

}