<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

interface AggregatorHttpResponse {

    /**
     * @return int
     */
    function getStatusCode();

    /**
     * @return string|array
     */
    function getContents();

}