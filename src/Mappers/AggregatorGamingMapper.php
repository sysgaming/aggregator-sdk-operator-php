<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers;

use Exception;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
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
     * @return AggregatorWin
     */
    function winFromRequest($payload);

    /**
     * @param $payload array|string
     * @return AggregatorRollback
     */
    function rollbackFromRequest($payload);

    /**
     * @param AggregatorHttpOutboundResponse $response
     * @return AggregatorStartPlayingResponse
     * @throws AggregatorGamingException|Exception
     */
    function startPlayingResponse(AggregatorHttpOutboundResponse $response);

}