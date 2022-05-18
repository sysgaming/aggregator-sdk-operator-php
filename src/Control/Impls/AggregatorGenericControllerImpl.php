<?php

namespace Sysgaming\AggregatorSdkPhp\Control\Impls;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Control\AggregatorController;
use Sysgaming\AggregatorSdkPhp\Control\PlayerFromTokenGetter;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\CurrencyNotSupportedException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidTokenException;
use Sysgaming\AggregatorSdkPhp\Exceptions\NotEnoughMoneyException;
use Sysgaming\AggregatorSdkPhp\Exceptions\UserCantPlayException;
use Sysgaming\AggregatorSdkPhp\Helpers\ArrayUtils;
use Sysgaming\AggregatorSdkPhp\Helpers\Base64Handler;
use Sysgaming\AggregatorSdkPhp\Helpers\JsonHandler;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorExceptionMapper;
use Sysgaming\AggregatorSdkPhp\Mappers\AggregatorGamingMapper;

abstract class AggregatorGenericControllerImpl implements AggregatorController
{

    /**
     * @var string
     */
    private $aggregatorEndpoint;

    /**
     * @var JsonHandler
     */
    private $jsonHandler;

    /**
     * @var Base64Handler
     */
    private $base64Handler;

    /**
     * @var AggregatorSignatureChecker
     */
    private $signatureChecker;

    /**
     * @var AggregatorSignatureMaker
     */
    private $signatureMaker;

    /**
     * @var AggregatorExceptionMapper
     */
    private $exceptionMapper;

    /**
     * @var AggregatorGamingMapper
     */
    private $gamingMapper;

    /**
     * @var PlayerFromTokenGetter
     */
    private $playerFromTokenGetter;

    /**
     * AggregatorGenericControllerImpl constructor.
     * @param $aggregatorEndpoint string url
     * @param JsonHandler $jsonHandler
     * @param Base64Handler $base64Handler
     * @param AggregatorSignatureChecker $signatureChecker
     * @param AggregatorSignatureMaker $signatureMaker
     * @param AggregatorExceptionMapper $exceptionMapper
     * @param AggregatorGamingMapper $gamingMapper
     * @param PlayerFromTokenGetter $playerFromTokenGetter
     */
    public function __construct(
        $aggregatorEndpoint,
        JsonHandler $jsonHandler,
        Base64Handler $base64Handler,
        AggregatorSignatureChecker $signatureChecker,
        AggregatorSignatureMaker $signatureMaker,
        AggregatorExceptionMapper $exceptionMapper,
        AggregatorGamingMapper $gamingMapper,
        PlayerFromTokenGetter $playerFromTokenGetter
    ) {

        $this->aggregatorEndpoint = $aggregatorEndpoint;
        $this->jsonHandler = $jsonHandler;
        $this->base64Handler = $base64Handler;
        $this->signatureChecker = $signatureChecker;
        $this->signatureMaker = $signatureMaker;
        $this->exceptionMapper = $exceptionMapper;
        $this->gamingMapper = $gamingMapper;
        $this->playerFromTokenGetter = $playerFromTokenGetter;
    }

    /**
     * @param AggregatorStartPlaying $startPlaying
     * @return AggregatorStartPlayingResponse
     * @throws AggregatorGamingException|Exception
     */
    function buildGameUrl(AggregatorStartPlaying $startPlaying) {

        if( !$startPlaying->getRequestUUID() )
            $startPlaying->setRequestUUID($this->makeRequestUUID());

        $payload = $this->getJsonHandler()->jsonEncode($startPlaying);

        $signature = $this->getSignatureMaker()->sign($payload);

        $encodedSignature = $this->getBase64Handler()->base64Encode($signature);

        $pathRequest = '/build-game-url';

        $aggRequest = $this->makeAggregatorRequest($this->aggregatorEndpoint . $pathRequest, $payload, $encodedSignature);

        $aggResponse = $this->doHttpPost($aggRequest);

        return $this->getGamingMapper()->startPlayingResponse($aggResponse);

    }

    function makeAggregatorRequest($aggregatorEndpoint, $payload, $encodedSignature) {

        return (new AggregatorHttpOutboundRequest())
            ->setEndpoint($aggregatorEndpoint)
            ->setContents($payload)
            ->setSignature($encodedSignature);

    }


    /**
     * @param $request AggregatorHttpInboundRequest
     * @param callable $handler
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    protected function handleRequest($request, callable $handler) {

        $jsonContents = $this->getJsonHandler()->jsonDecode($request->getContents());

        try {

            $this->getSignatureChecker()->validate($request);

            $player = $this->getPlayerFromTokenGetter()->findPlayerByToken(ArrayUtils::get('token', $jsonContents));

            if( !$player )
                throw new InvalidTokenException();

            if( !$player->canPlay() )
                throw new UserCantPlayException();

            if( !$player->isAValidCurrency() )
                throw new CurrencyNotSupportedException();

            return $handler($jsonContents, $player);

        } catch (Exception $ex) {

            $requestUUID = $this->extractRequestUUID($jsonContents);

            return $this->getExceptionMapper()->exceptionToDTO($ex, $requestUUID);

        }

    }

    function balanceFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->balanceFromRequest($jsonContents);

            return $this->handleBalance($dto, $player);

        });

    }

    function betFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->betFromRequest($jsonContents);

            if( $player->getBalance() < $dto->getAmount() )
                throw new NotEnoughMoneyException($player);

            return $this->handleBet($dto, $player);

        });

    }

    function winFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->winFromRequest($jsonContents);

            return $this->handleWin($dto, $player);

        });

    }

    function rollbackFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->rollbackFromRequest($jsonContents);

            return $this->handleRollback($dto, $player);

        });

    }

    function getPlayerFromTokenGetter() {

        return $this->playerFromTokenGetter;

    }

    function getExceptionMapper() {

        return $this->exceptionMapper;

    }

    function getGamingMapper() {

        return $this->gamingMapper;

    }

    function getSignatureChecker() {

        return $this->signatureChecker;

    }

    function getSignatureMaker() {

        return $this->signatureMaker;

    }

    function getJsonHandler()
    {
        return $this->jsonHandler;
    }

    function getBase64Handler() {

        return $this->base64Handler;

    }

    private function extractRequestUUID(array $jsonContents) {

        return array_key_exists('requestUUID', $jsonContents) ? $jsonContents['requestUUID'] : null;

    }

}