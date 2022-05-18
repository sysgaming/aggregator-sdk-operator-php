<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

class AggregatorHttpOutboundResponse {

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $contents;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return AggregatorHttpOutboundResponse
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     * @return AggregatorHttpOutboundResponse
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }

}