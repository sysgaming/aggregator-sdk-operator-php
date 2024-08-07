<?php

namespace Sysgaming\AggregatorSdkPhp\Mappers\Impls;

use Exception;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\UnknownGamingException;
use Sysgaming\AggregatorSdkPhp\Helpers\ArrayUtils;
use Sysgaming\AggregatorSdkPhp\Helpers\JsonHandler;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorGamingMapper;

class AggregatorGamingMapperImpl implements AggregatorGamingMapper
{

    /**
     * @var JsonHandler
     */
    private $jsonHandler;

    /**
     * AggregatorGamingMapperImpl constructor.
     * @param $jsonHandler JsonHandler
     */
    public function __construct($jsonHandler)
    {
        $this->jsonHandler = $jsonHandler;
    }


    /**
     * @param $payload array|string
     * @return AggregatorBalance
     */
    function balanceFromRequest($payload)
    {
        $jsonPayload = $payload;

        if( !is_array($payload) )
            $jsonPayload = $this->jsonHandler->jsonDecode($payload);

        $dto = (new AggregatorBalance())
            ->setRequestUUID(ArrayUtils::get('requestUUID', $jsonPayload))
            ->setToken(ArrayUtils::get('token', $jsonPayload))
            ->setPlayerId(ArrayUtils::get('playerId', $jsonPayload))
            ->setCurrency(ArrayUtils::get('currency', $jsonPayload))
            ->setProductCode(ArrayUtils::get('productCode', $jsonPayload))
        ;

        $dto->setPayload($payload);

        return $dto;

    }

    /**
     * @param $payload array|string
     * @return AggregatorBet
     */
    function betFromRequest($payload)
    {
        $jsonPayload = $payload;

        if( !is_array($payload) )
            $jsonPayload = $this->jsonHandler->jsonDecode($payload);

        $dto = (new AggregatorBet())
            ->setRequestUUID(ArrayUtils::get('requestUUID', $jsonPayload))
            ->setTransactionId(ArrayUtils::get('transactionId', $jsonPayload))
            ->setToken(ArrayUtils::get('token', $jsonPayload))
            ->setPlayerId(ArrayUtils::get('playerId', $jsonPayload))
            ->setExternalPlayerId(ArrayUtils::get('externalPlayerId', $jsonPayload))
            ->setRoundId(ArrayUtils::get('roundId', $jsonPayload))
            ->setAmount(ArrayUtils::get('amount', $jsonPayload))
            ->setCurrency(ArrayUtils::get('currency', $jsonPayload))
            ->setProductCode(ArrayUtils::get('productCode', $jsonPayload))
            ->setIsFree(ArrayUtils::get('isFree', $jsonPayload))
            ->setRewardId(ArrayUtils::get('rewardId', $jsonPayload))
        ;

        $dto->setPayload($payload);

        return $dto;

    }

    /**
     * @param $payload array|string
     * @return AggregatorWin
     */
    function winFromRequest($payload)
    {
        $jsonPayload = $payload;

        if( !is_array($payload) )
            $jsonPayload = $this->jsonHandler->jsonDecode($payload);

        $dto = (new AggregatorWin())
            ->setRequestUUID(ArrayUtils::get('requestUUID', $jsonPayload))
            ->setTransactionId(ArrayUtils::get('transactionId', $jsonPayload))
            ->setToken(ArrayUtils::get('token', $jsonPayload))
            ->setPlayerId(ArrayUtils::get('playerId', $jsonPayload))
            ->setExternalPlayerId(ArrayUtils::get('externalPlayerId', $jsonPayload))
            ->setRoundId(ArrayUtils::get('roundId', $jsonPayload))
            ->setAmount(ArrayUtils::get('amount', $jsonPayload))
            ->setPromoAmount(ArrayUtils::get('promoAmount', $jsonPayload))
            ->setCurrency(ArrayUtils::get('currency', $jsonPayload))
            ->setProductCode(ArrayUtils::get('productCode', $jsonPayload))
            ->setIsFree(ArrayUtils::get('isFree', $jsonPayload))
            ->setRewardId(ArrayUtils::get('rewardId', $jsonPayload))
        ;

        $dto->setPayload($payload);

        return $dto;

    }

    /**
     * @param $payload array|string
     * @return AggregatorRollback
     */
    function rollbackFromRequest($payload)
    {
        $jsonPayload = $payload;

        if( !is_array($payload) )
            $jsonPayload = $this->jsonHandler->jsonDecode($payload);

        $dto = (new AggregatorRollback())
            ->setRequestUUID(ArrayUtils::get('requestUUID', $jsonPayload))
            ->setTransactionId(ArrayUtils::get('transactionId', $jsonPayload))
            ->setToken(ArrayUtils::get('token', $jsonPayload))
            ->setRoundId(ArrayUtils::get('roundId', $jsonPayload))
            ->setProductCode(ArrayUtils::get('productCode', $jsonPayload))
        ;

        $dto->setPayload($payload);

        return $dto;

    }

    /**
     * @param AggregatorHttpOutboundResponse $response
     * @return AggregatorStartPlayingResponse
     * @throws AggregatorGamingException|Exception
     */
    function startPlayingResponse(AggregatorHttpOutboundResponse $response)
    {

        $statusCode = $response->getStatusCode();

        if( $statusCode < 200 || $statusCode >= 300 )
            throw new UnknownGamingException("Invalid StartPlaying Response: " . $response->getContents());

        $payloadArray = $this->jsonHandler->jsonDecode($response->getContents());

        return new AggregatorStartPlayingResponse(
            ArrayUtils::get('requestUUID', $payloadArray),
            ArrayUtils::get('url', $payloadArray)
        );

    }

}