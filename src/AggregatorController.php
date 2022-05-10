<?php

namespace Sysgaming\AggregatorSdkPhp;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorGamingMapper;

interface AggregatorController {

    const SIGNATURE_INBOUND_HEADER_NAME = 'X-Aggregator-Signature';
    const SIGNATURE_OUTBOUND_HEADER_NAME = 'X-Operator-Signature';

    /**
     * @param AggregatorHttpRequest $request
     * @return AggregatorHttpResponse
     */
    function doHttpPost(AggregatorHttpRequest $request);

    /**
     * @param AggregatorStartPlaying $startPlaying
     * @return AggregatorStartPlayingResponse
     */
    function buildGameUrl(AggregatorStartPlaying $startPlaying);

    /**
     * @param $payload string
     * @param $signature string
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function balanceFromRequest($payload, $signature);

    /**
     * @param $payload string
     * @param $signature string
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function betFromRequest($payload, $signature);

    /**
     * @param $payload string
     * @param $signature string
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function winFromRequest($payload, $signature);

    /**
     * @param $payload string
     * @param $signature string
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    function rollbackFromRequest($payload, $signature);

    /**
     * @param AggregatorBalance $balance
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleBalance(AggregatorBalance $balance);

    /**
     * @param AggregatorBet $bet
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleBet(AggregatorBet $bet);

    /**
     * @param AggregatorWin $win
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleWin(AggregatorWin $win);

    /**
     * @param AggregatorRollback $rollback
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException|Exception
     */
    function handleRollback(AggregatorRollback $rollback);

    /**
     * @param array|object
     * @return string
     */
    function jsonEncode($value);

    /**
     * @param $raw
     * @return array
     */
    function jsonDecode($raw);

    /**
     * @param $str
     * @return string
     */
    function base64Encode($str);

    /**
     * @param $str
     * @return string
     */
    function base64Decode($str);

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