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
     * AggregatorHttpInboundRequest constructor.
     * @param string $contents
     * @param AggregatorSignatureHolder $signatureHolder
     */
    public function __construct($contents, AggregatorSignatureHolder $signatureHolder)
    {
        $this->contents = $contents;
        $this->signatureHolder = $signatureHolder;
    }


    /**
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @return AggregatorSignatureHolder
     */
    public function getSignatureHolder()
    {
        return $this->signatureHolder;
    }

}