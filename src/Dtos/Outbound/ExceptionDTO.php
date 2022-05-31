<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;

class ExceptionDTO implements AggregatorJsonObject {

    private $requestUUID;
    private $type;
    private $message;
    private $related;

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param mixed $requestUUID
     * @return ExceptionDTO
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ExceptionDTO
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return ExceptionDTO
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * @param mixed $related
     * @return ExceptionDTO
     */
    public function setRelated($related)
    {
        $this->related = $related;
        return $this;
    }

    function toArray() {

        $acc = [];

        if( !is_null($this->getRequestUUID()) )
            $acc['requestUUID'] = $this->getRequestUUID();

        $acc['type'] = $this->getType();

        if( !is_null($this->getMessage()))
            $acc['message'] = $this->getMessage();

        if( !is_null($this->getRelated()))
            $acc['related'] = $this->getRelated();

        return $acc;

    }

}