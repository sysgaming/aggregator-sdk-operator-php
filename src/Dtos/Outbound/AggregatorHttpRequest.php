<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

interface AggregatorHttpRequest {

    /**
     * @return string
     */
    function getEndpoint();

    /**
     * @return string
     */
    function getSignature();

    /**
     * @return string|array
     */
    function getContents();

}