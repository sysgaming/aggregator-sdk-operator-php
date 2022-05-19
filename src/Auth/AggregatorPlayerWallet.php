<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

interface AggregatorPlayerWallet
{
    function getId();

    /**
     * @return int The current balance of the player in operator.
     * Attempt that balance must be represented by a Int64/Long. Ex.: $ 23.69 must be represented by 23690000
     */
    function getBalance();

    /**
     * @return int A really fresh balance after some credits/debits have processed
     * @see AggregatorPlayerWallet::getBalance()
     */
    function freshBalance();

    /**
     * @return string
     */
    function getCurrency();

    /**
     * @return string
     */
    function getToken();

    /**
     * @return boolean
     */
    function canPlay();

    /**
     * @return boolean
     */
    function isAValidCurrency();

}