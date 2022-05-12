<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers\Impls;

use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Helpers\StringUtils;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorExceptionMapper;
use Throwable;

class AggregatorExceptionMapperImpl implements AggregatorExceptionMapper
{

    /**
     * @param $exception Throwable
     * @param string|null $requestUUID
     * @return ExceptionDTO
     */
    function exceptionToDTO($exception, $requestUUID = null)
    {

        $dto = new ExceptionDTO();

        if( $exception instanceof AggregatorGamingException) {

            $dto
                ->setRequestUUID($requestUUID)
                ->setMessage($exception->getMessage())
                ->setType(StringUtils::camelToSnake(get_class($exception)));

            //TODO add related field

        } else {

            $dto
                ->setRequestUUID($requestUUID)
                ->setMessage($exception->getMessage())
                ->setType("unknown_gaming_exception");


        }

        return $dto;

    }

}