<?php


namespace Sysgaming\AggregatorSdkPhp\Control;


use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;

interface PlayerFromTokenGetter {

    /**
     * @param $token string
     * @return AggregatorPlayerWallet
     */
    function findPlayerByToken($token);

}