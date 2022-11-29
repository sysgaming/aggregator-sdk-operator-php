<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;

class AggregatorStartPlaying implements AggregatorJsonObject {

    const GAME_MODE_FOR_FUN = "FOR_FUN";
    const GAME_MODE_FOR_REAL = "FOR_REAL";

    /**
     * @var string
     */
    private $requestUUID;

    /**
     * @var string ISO Timestamp
     * @example 2022-01-01T00:00:00Z
     */
    private $timestamp;

    /**
     * @var string
     */
    private $playerId;

    /**
     * @var string
     */
    private $playerName;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $initialBalance;

    /**
     * @var string
     */
    private $productCode;

    /**
     * @var string
     */
    private $gameMode;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $country;

    /**
     * @var AggregatorRedirectUrls
     */
    private $redirectURLs;

    /**
     * @var boolean
     */
    private $openedByLogin;

    /**
     * @return string
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @param string $requestUUID
     * @return AggregatorStartPlaying
     */
    public function setRequestUUID($requestUUID)
    {
        $this->requestUUID = $requestUUID;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return AggregatorStartPlaying
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * @param string $playerId
     * @return AggregatorStartPlaying
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @param string $playerName
     * @return AggregatorStartPlaying
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return AggregatorStartPlaying
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return AggregatorStartPlaying
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getInitialBalance()
    {
        return $this->initialBalance;
    }

    /**
     * @param string $initialBalance
     * @return AggregatorStartPlaying
     */
    public function setInitialBalance($initialBalance)
    {
        $this->initialBalance = $initialBalance;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param string $productCode
     * @return AggregatorStartPlaying
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getGameMode()
    {
        return $this->gameMode;
    }

    /**
     * @param string $gameMode
     * @return AggregatorStartPlaying
     */
    public function setGameMode($gameMode)
    {
        $this->gameMode = $gameMode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return AggregatorStartPlaying
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return AggregatorStartPlaying
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return AggregatorRedirectUrls
     */
    public function getRedirectURLs()
    {
        return $this->redirectURLs;
    }

    /**
     * @param AggregatorRedirectUrls $redirectURLs
     * @return AggregatorStartPlaying
     */
    public function setRedirectURLs($redirectURLs)
    {
        $this->redirectURLs = $redirectURLs;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOpenedByLogin()
    {
        return $this->openedByLogin;
    }

    /**
     * @param bool $openedByLogin
     * @return AggregatorStartPlaying
     */
    public function setOpenedByLogin($openedByLogin)
    {
        $this->openedByLogin = $openedByLogin;
        return $this;
    }

    function toArray() {

        $acc = [];

        if( !is_null($this->getRequestUUID()) )
            $acc['requestUUID'] = $this->getRequestUUID();

        if( !is_null($this->getTimestamp()) )
            $acc['timestamp'] = $this->getTimestamp();

        if( !is_null($this->getPlayerId()) )
            $acc['playerId'] = $this->getPlayerId();

        if( !is_null($this->getPlayerName()) )
            $acc['playerName'] = $this->getPlayerName();

        if( !is_null($this->getToken()) )
            $acc['token'] = $this->getToken();

        if( !is_null($this->getCurrency()) )
            $acc['currency'] = $this->getCurrency();

        if( !is_null($this->getInitialBalance()) )
            $acc['initialBalance'] = $this->getInitialBalance();

        if( !is_null($this->getProductCode()) )
            $acc['productCode'] = $this->getProductCode();

        if( !is_null($this->getGameMode()) )
            $acc['gameMode'] = $this->getGameMode();

        if( !is_null($this->getLanguage()) )
            $acc['language'] = $this->getLanguage();

        if( !is_null($this->getCountry()) )
            $acc['country'] = $this->getCountry();

        if( !is_null($this->getRedirectURLs()) )
            $acc['redirectURLs'] = $this->getRedirectURLs()->toArray();

        if( !is_null($this->isOpenedByLogin()) )
            $acc['openedByLogin'] = $this->isOpenedByLogin();

        return $acc;

    }

}