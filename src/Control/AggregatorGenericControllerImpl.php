<?php

namespace Sysgaming\AggregatorSdkPhp\Control;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
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
     * AggregatorGenericControllerImpl constructor.
     * @param $aggregatorEndpoint string url
     * @param JsonHandler $jsonHandler
     * @param Base64Handler $base64Handler
     * @param AggregatorSignatureChecker $signatureChecker
     * @param AggregatorSignatureMaker $signatureMaker
     * @param AggregatorExceptionMapper $exceptionMapper
     * @param AggregatorGamingMapper $gamingMapper
     */
    public function __construct(
        $aggregatorEndpoint,
        JsonHandler $jsonHandler,
        Base64Handler $base64Handler,
        AggregatorSignatureChecker $signatureChecker,
        AggregatorSignatureMaker $signatureMaker,
        AggregatorExceptionMapper $exceptionMapper,
        AggregatorGamingMapper $gamingMapper
    ) {

        $this->aggregatorEndpoint = $aggregatorEndpoint;
        $this->jsonHandler = $jsonHandler;
        $this->base64Handler = $base64Handler;
        $this->signatureChecker = $signatureChecker;
        $this->signatureMaker = $signatureMaker;
        $this->exceptionMapper = $exceptionMapper;
        $this->gamingMapper = $gamingMapper;
    }

    /**
     * @param AggregatorStartPlaying $startPlaying
     * @return AggregatorStartPlayingResponse
     * @throws AggregatorGamingException|Exception
     */
    function buildGameUrl(AggregatorStartPlaying $startPlaying) {

        $payload = $this->getJsonHandler()->jsonEncode($startPlaying);

        $signature = $this->getSignatureMaker()->sign($payload);

        $encodedSignature = $this->getBase64Handler()->base64Encode($signature);

        $aggRequest = $this->makeAggregatorRequest($this->aggregatorEndpoint, $payload, $encodedSignature);

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
     * @param $handler callable
     * @return AggregatorBalanceResponse|ExceptionDTO
     */
    protected function handleRequest($request, $handler) {

        $jsonContents = $this->getJsonHandler()->jsonDecode($request->getContents());

        try {

            $this->getSignatureChecker()->validate($request);

            return $handler($jsonContents);

        } catch (Exception $ex) {

            $requestUUID = $this->extractRequestUUID($jsonContents);

            return $this->getExceptionMapper()->exceptionToDTO($ex, $requestUUID);

        }

    }

    function balanceFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents) {

            $dto = $this->getGamingMapper()->balanceFromRequest($jsonContents);

            return $this->handleBalance($dto);

        });

    }

    function betFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents) {

            $dto = $this->getGamingMapper()->betFromRequest($jsonContents);

            return $this->handleBet($dto);

        });

    }

    function winFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents) {

            $dto = $this->getGamingMapper()->winFromRequest($jsonContents);

            return $this->handleWin($dto);

        });

    }

    function rollbackFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents) {

            $dto = $this->getGamingMapper()->rollbackFromRequest($jsonContents);

            return $this->handleRollback($dto);

        });

    }


    function getExceptionMapper() {

        return $this->exceptionMapper;

    }

    /**
     * @return AggregatorGamingMapper
     */
    function getGamingMapper() {

        return $this->gamingMapper;

    }

    /**
     * @return AggregatorSignatureChecker
     */
    function getSignatureChecker() {

        return $this->signatureChecker;

    }

    /**
     * @return AggregatorSignatureMaker
     */
    function getSignatureMaker() {

        return $this->signatureMaker;

    }

    function getJsonHandler()
    {
        return $this->jsonHandler;
    }

    function getBase64Handler()
    {
        return $this->base64Handler;
    }

    private function extractRequestUUID(array $jsonContents)
    {

        return array_key_exists('requestUUID', $jsonContents)
            ? $jsonContents['requestUUID']
            : null;

    }

}