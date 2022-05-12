<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureHolder;

class AggregatorHttpInboundRequest {

    /**
     * @var string
     */
    private $contents;

    /**
     * @var AggregatorSignatureHolder
     */
    private $signatureHolder;

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     * @return AggregatorHttpInboundRequest
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }



    /**
     * @return AggregatorSignatureHolder
     */
    public function getSignatureHolder()
    {
        return $this->signatureHolder;
    }

    /**
     * @param AggregatorSignatureHolder $signatureHolder
     * @return AggregatorHttpInboundRequest
     */
    public function setSignatureHolder($signatureHolder)
    {
        $this->signatureHolder = $signatureHolder;
        return $this;
    }

}