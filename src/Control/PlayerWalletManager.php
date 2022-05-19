<?php


namespace Sysgaming\AggregatorSdkPhp\Control;


use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;

interface PlayerWalletManager {

    /**
     * @param $token string
     * @return AggregatorPlayerWallet
     */
    function findPlayerByToken($token);

    /**
     * @param AggregatorPlayerWallet $player
     * @return int
     */
    function getFreshBalanceForPlayer(AggregatorPlayerWallet $player);

}