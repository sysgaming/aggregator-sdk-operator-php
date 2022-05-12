<?php

namespace Sysgaming\AggregatorSdkPhp\Control;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Helpers\Base64Handler;
use Sysgaming\AggregatorSdkPhp\Helpers\JsonHandler;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorExceptionMapper;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorGamingMapper;

interface AggregatorController {

    const SIGNATURE_INBOUND_HEADER_NAME = 'X-Aggregator-Signature';
    const SIGNATURE_OUTBOUND_HEADER_NAME = 'X-Operator-Signature';

    const CURRENCY_MULTIPLIER = 1000000;

    /**
     * @param AggregatorHttpOutboundRequest $request
     * @return AggregatorHttpOutboundResponse
     */
    function doHttpPost(AggregatorHttpOutboundRequest $request);

    /**
     * @param $aggregatorEndpoint string
     * @param $payload string
     * @param $encodedSignature string
     * @return AggregatorHttpOutboundRequest
     */
    function makeAggregatorRequest($aggregatorEndpoint, $payload, $encodedSignature);

    /**
     * @param AggregatorStartPlaying $startPlaying
     * @return AggregatorStartPlayingResponse
     */
    function buildGameUrl(AggregatorStartPlaying $startPlaying);

    /**
     * @param $request AggregatorHttpInboundRequest
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function balanceFromRequest($request);

    /**
     * @param $request AggregatorHttpInboundRequest
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function betFromRequest($request);

    /**
     * @param $request AggregatorHttpInboundRequest
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function winFromRequest($request);

    /**
     * @param $request AggregatorHttpInboundRequest
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function rollbackFromRequest($request);

    /**
     * @param AggregatorBalance $balance
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleBalance(AggregatorBalance $balance, AggregatorPlayerWallet $player);

    /**
     * @param AggregatorBet $bet
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleBet(AggregatorBet $bet, AggregatorPlayerWallet $player);

    /**
     * @param AggregatorWin $win
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleWin(AggregatorWin $win, AggregatorPlayerWallet $player);

    /**
     * @param AggregatorRollback $rollback
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleRollback(AggregatorRollback $rollback, AggregatorPlayerWallet $player);

    /**
     * @param $token
     * @return AggregatorPlayerWallet
     */
    function getPlayerFromToken($token);

    /**
     * @return JsonHandler
     */
    function getJsonHandler();

    /**
     * @return Base64Handler
     */
    function getBase64Handler();

    /**
     * @return AggregatorExceptionMapper
     */
    function getExceptionMapper();

    /**
     * @return AggregatorGamingMapper
     */
    function getGamingMapper();

    /**
     * @return AggregatorSignatureChecker
     */
    function getSignatureChecker();

    /**
     * @return AggregatorSignatureMaker
     */
    function getSignatureMaker();

}