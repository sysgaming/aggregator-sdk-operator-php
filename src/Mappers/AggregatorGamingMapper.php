<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers;

use Exception;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;

interface AggregatorGamingMapper {

    /**
     * @param $payload array|string
     * @return AggregatorBalance
     */
    function balanceFromRequest($payload);

    /**
     * @param $payload array|string
     * @return AggregatorBet
     */
    function betFromRequest($payload);

    /**
     * @param $payload array|string
     * @return AggregatorBalance
     */
    function winFromRequest($payload);

    /**
     * @param $payload array|string
     * @return AggregatorBalance
     */
    function rollbackFromRequest($payload);

    /**
     * @param AggregatorHttpResponse $response
     * @return AggregatorStartPlayingResponse
     * @throws AggregatorGamingException|Exception
     */
    function startPlayingResponse(AggregatorHttpResponse $response);

}