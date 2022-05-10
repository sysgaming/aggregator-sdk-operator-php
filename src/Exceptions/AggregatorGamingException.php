<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

use Exception;

class AggregatorGamingException extends Exception {

    private $requestUUID;

    public function __construct($message = "") {
        parent::__construct($message);
    }


    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param mixed $requestUUID
     * @return AggregatorGamingException
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
        return $this;
    }



}