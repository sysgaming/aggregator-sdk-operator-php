<?php


namespace Sysgaming\AggregatorSdkPhp\Control;


use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;

interface PlayerWalletManager {

    /**
     * @param $token string
     * @param $gameCode String
     * @return AggregatorPlayerWallet
     */
    function findPlayerByToken($token, $gameCode);

    /**
     * @param AggregatorPlayerWallet $player
     * @return int
     */
    function getFreshBalanceForPlayer(AggregatorPlayerWallet $player, $gameCode);

}