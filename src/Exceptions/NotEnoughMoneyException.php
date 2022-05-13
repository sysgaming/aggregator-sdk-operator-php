<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;

class NotEnoughMoneyException extends AggregatorGamingException {

    /**
     * @var AggregatorPlayerWallet
     */
    private $player;

    /**
     * NotEnoughMoneyException constructor.
     * @param AggregatorPlayerWallet $player
     * @param string $message
     */
    public function __construct(AggregatorPlayerWallet $player, $message = "")
    {
        parent::__construct($message);
        $this->player = $player;
    }

}