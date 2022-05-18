<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

class AggregatorHttpOutboundRequest {

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var string
     */
    private $contents;

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @return AggregatorHttpOutboundRequest
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return AggregatorHttpOutboundRequest
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
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
     * @return AggregatorHttpOutboundRequest
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }


}