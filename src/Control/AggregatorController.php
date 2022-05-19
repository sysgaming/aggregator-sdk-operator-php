<?php

namespace Sysgaming\AggregatorSdkPhp\Control;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorOperatorTransaction;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorHttpInboundRequest;
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
     * @return string
     */
    function makeRequestUUID();

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
     * @param AggregatorOperatorTransaction|null $existedTr
     * @return AggregatorBalanceResponse
     */
    function handleBet(AggregatorBet $bet, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null);

    /**
     * @param AggregatorWin $win
     * @param AggregatorPlayerWallet $player
     * @param AggregatorOperatorTransaction|null $existedTr
     * @return AggregatorBalanceResponse
     */
    function handleWin(AggregatorWin $win, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null);

    /**
     * @param AggregatorRollback $rollback
     * @param AggregatorPlayerWallet $player
     * @param AggregatorOperatorTransaction|null $existedTr
     * @return AggregatorBalanceResponse
     */
    function handleRollback(AggregatorRollback $rollback, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null);

    /**
     * @param $transactionId string
     * @return AggregatorOperatorTransaction
     */
    function findExistedAggregatorTransaction($transactionId);

    /**
     * @param $tr AggregatorBet|AggregatorWin|AggregatorRollback
     * @param AggregatorPlayerWallet $player
     * @param AggregatorOperatorTransaction|null $existedTr
     * @return AggregatorBalanceResponse
     */
    function handleTransaction($tr, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null);

    /**
     * @param $tr AggregatorBet|AggregatorWin|AggregatorRollback
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     */
    function makeAggregatorFreshBalanceResponse($tr, AggregatorPlayerWallet $player);

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

    /**
     * @return PlayerFromTokenGetter
     */
    function getPlayerFromTokenGetter();

}