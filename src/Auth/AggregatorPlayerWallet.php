<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

interface AggregatorPlayerWallet
{

    /**
     * @return mixed The id on the Operator Side
     */
    function getId();

    /**
     * @return string The id on the Aggregator/Provider Side
     */
    function getExternalId();

    /**
     * @return int The current balance of the player in operator.
     * Attempt that balance must be represented by a Int64/Long. Ex.: $ 23.69 must be represented by 23690000
     */
    function getBalance();

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
    function isAvailable();

    /**
     * @param string $currency
     * @return boolean
     */
    function isAValidCurrency($currency);

}