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
     * AggregatorPlayerWalletImpl constructor.
     * @param $id
     * @param int $balance
     * @param string $currency
     * @param string $token
     */
    public function __construct($id, $balance, $currency, $token)
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->currency = $currency;
        $this->token = $token;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int the current balance of
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    function canPlay() {
        return true;
    }

    function isAvailable() {
        return true;
    }

    function isAValidCurrency($currency) {
        return false;
    }

}