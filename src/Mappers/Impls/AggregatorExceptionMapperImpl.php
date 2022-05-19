<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers\Impls;

use ReflectionClass;
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

            $reflect = new ReflectionClass($exception);

            $dto
                ->setRequestUUID($requestUUID)
                ->setType(StringUtils::camelToUnderScore($reflect->getShortName()));

            if( $exception->getMessage() )
                $dto->setMessage($exception->getMessage());

        } else {

            $dto
                ->setRequestUUID($requestUUID)
                ->setMessage($exception->getMessage())
                ->setType("unknown_gaming_exception");

        }

        return $dto;

    }

}