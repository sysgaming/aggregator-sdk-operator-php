<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers;

use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Throwable;

interface AggregatorExceptionMapper {

    /**
     * @param $exception Throwable
     * @param string|null $requestUUID
     * @return ExceptionDTO
     */
    function exceptionToDTO($exception, $requestUUID = null);

}