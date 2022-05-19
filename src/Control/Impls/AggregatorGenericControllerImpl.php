<?php

namespace Sysgaming\AggregatorSdkPhp\Control\Impls;

use Exception;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorPlayerWallet;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Control\AggregatorController;
use Sysgaming\AggregatorSdkPhp\Control\PlayerWalletManager;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalance;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBalanceResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorBet;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorOperatorTransaction;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorRollback;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorWin;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpOutboundRequest;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlaying;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorStartPlayingResponse;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\ExceptionDTO;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\CurrencyNotSupportedException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidTokenException;
use Sysgaming\AggregatorSdkPhp\Exceptions\NotEnoughMoneyException;
use Sysgaming\AggregatorSdkPhp\Exceptions\TransactionConflictException;
use Sysgaming\AggregatorSdkPhp\Exceptions\UnknownGamingException;
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
     * @var PlayerWalletManager
     */
    private $playerWalletManager;

    /**
     * AggregatorGenericControllerImpl constructor.
     * @param $aggregatorEndpoint string url
     * @param JsonHandler $jsonHandler
     * @param Base64Handler $base64Handler
     * @param AggregatorSignatureChecker $signatureChecker
     * @param AggregatorSignatureMaker $signatureMaker
     * @param AggregatorExceptionMapper $exceptionMapper
     * @param AggregatorGamingMapper $gamingMapper
     * @param PlayerWalletManager $playerWalletManager
     */
    public function __construct(
        $aggregatorEndpoint,
        JsonHandler $jsonHandler,
        Base64Handler $base64Handler,
        AggregatorSignatureChecker $signatureChecker,
        AggregatorSignatureMaker $signatureMaker,
        AggregatorExceptionMapper $exceptionMapper,
        AggregatorGamingMapper $gamingMapper,
        PlayerWalletManager $playerWalletManager
    ) {

        $this->aggregatorEndpoint = $aggregatorEndpoint;
        $this->jsonHandler = $jsonHandler;
        $this->base64Handler = $base64Handler;
        $this->signatureChecker = $signatureChecker;
        $this->signatureMaker = $signatureMaker;
        $this->exceptionMapper = $exceptionMapper;
        $this->gamingMapper = $gamingMapper;
        $this->playerWalletManager = $playerWalletManager;
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

            $player = $this->getPlayerWalletManager()->findPlayerByToken(ArrayUtils::get('token', $jsonContents));

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

    function handleBalance(AggregatorBalance $balance, AggregatorPlayerWallet $player) {

        return new AggregatorBalanceResponse(
            $balance->getRequestUUID(),
            $player->getCurrency(),
            $player->getBalance()
        );

    }

    function betFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->betFromRequest($jsonContents);

            if( $player->getBalance() < $dto->getAmount() )
                throw new NotEnoughMoneyException($player);

            return $this->handleBetOrWin($dto, $player);

        });

    }

    function winFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->winFromRequest($jsonContents);

            return $this->handleBetOrWin($dto, $player);

        });

    }

    function rollbackFromRequest($request) {

        return $this->handleRequest($request, function(array $jsonContents, AggregatorPlayerWallet $player) {

            $dto = $this->getGamingMapper()->rollbackFromRequest($jsonContents);

            $existedTr = $this->findExistedAggregatorTransaction($dto->getTransactionId());

            if( $existedTr ) {

                if(
                    $existedTr->getPlayerId() != $player->getId()
                    || $existedTr->getRoundId() != $dto->getRoundId()
                    || $existedTr->getProductCode() != $dto->getProductCode()
                )
                    throw new TransactionConflictException();

                if(
                    $existedTr->getType() == AggregatorOperatorTransaction::TR_TYPE_WIN
                    && $existedTr->getAmount() > $player->getBalance()
                )
                    throw new NotEnoughMoneyException($player);

            }

            return $this->handleTransaction($dto, $player, $existedTr);

        });

    }

    /**
     * @param AggregatorBet|AggregatorWin $tr
     * @param AggregatorPlayerWallet $player
     * @return AggregatorBalanceResponse
     * @throws AggregatorGamingException
     */
    protected function handleBetOrWin($tr, $player) {

        $existedTr = $this->findExistedAggregatorTransaction($tr->getTransactionId());

        if( !is_null($existedTr) ) {

            // if already canceled before, then do nothing and return idempotent way
            if( $existedTr->getType() == AggregatorOperatorTransaction::TR_TYPE_ROLLBACK )
                return $this->makeAggregatorFreshBalanceResponse($tr, $player);

            else if(
                $existedTr->getType() == ($tr instanceof AggregatorBet ? AggregatorOperatorTransaction::TR_TYPE_WIN : AggregatorOperatorTransaction::TR_TYPE_BET)
                || $existedTr->getAmount() != $tr->getAmount()
                || $existedTr->getRoundId() != $tr->getRoundId()
                || $existedTr->getProductCode() != $tr->getProductCode()
                || $existedTr->getPlayerId() != $player->getId()
            )
                throw new TransactionConflictException();

            // idempotent way (already resolved/processed)
            return $this->makeAggregatorFreshBalanceResponse($tr, $player);

        }

        return $this->handleTransaction($tr, $player, $existedTr);

    }

    function handleTransaction($tr, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) {

        if( $tr instanceof AggregatorBet )
            return $this->handleBet($tr, $player, $existedTr);

        if( $tr instanceof AggregatorWin )
            return $this->handleWin($tr, $player, $existedTr);

        if( $tr instanceof AggregatorRollback )
            return $this->handleRollback($tr, $player, $existedTr);

        throw new UnknownGamingException("Invalid transaction instance to handle");

    }


    function makeAggregatorFreshBalanceResponse($tr, AggregatorPlayerWallet $player) {

        return new AggregatorBalanceResponse(
            $tr->getRequestUUID(),
            $player->getCurrency(),
            $this->getFreshBalance($player)
        );

    }

    protected function getFreshBalance($player) {

        return $this->getPlayerWalletManager()
            ->getFreshBalanceForPlayer($player);

    }

    function makeRequestUUID() {

        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = openssl_random_pseudo_bytes(16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

    }

    private function extractRequestUUID(array $jsonContents) {

        return ArrayUtils::get('requestUUID', $jsonContents);

    }

    function getPlayerWalletManager() {

        return $this->playerWalletManager;

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

}