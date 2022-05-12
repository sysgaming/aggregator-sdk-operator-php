<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

class AggregatorStartPlaying
{

    const GAME_MODE_FOR_FUN = "FOR_FUN";
    const GAME_MODE_FOR_REAL = "FOR_REAL";

    const CURRENCY_MULTIPLIER = 1000000;

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

}