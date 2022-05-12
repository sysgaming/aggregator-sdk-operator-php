<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

use Exception;

class AggregatorGamingException extends Exception {

    public function __construct($message = "") {
        parent::__construct($message);
    }

}