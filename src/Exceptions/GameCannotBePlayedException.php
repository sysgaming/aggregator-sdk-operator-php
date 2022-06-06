<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class GameCannotBePlayedException extends AggregatorGamingException {

    /**
     * GameCannotBePlayedException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}