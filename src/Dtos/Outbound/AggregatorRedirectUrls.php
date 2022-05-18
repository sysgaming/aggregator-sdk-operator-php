<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;

class AggregatorRedirectUrls implements AggregatorJsonObject {

    /**
     * @var string
     */
    private $homeURL;

    /**
     * @var string
     */
    private $lobbyURL;

    /**
     * @var string
     */
    private $cashierURL;

    /**
     * @var string
     */
    private $gameURL;

    /**
     * @return string
     */
    public function getHomeURL()
    {
        return $this->homeURL;
    }

    /**
     * @param string $homeURL
     * @return AggregatorRedirectUrls
     */
    public function setHomeURL($homeURL)
    {
        $this->homeURL = $homeURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getLobbyURL()
    {
        return $this->lobbyURL;
    }

    /**
     * @param string $lobbyURL
     * @return AggregatorRedirectUrls
     */
    public function setLobbyURL($lobbyURL)
    {
        $this->lobbyURL = $lobbyURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getCashierURL()
    {
        return $this->cashierURL;
    }

    /**
     * @param string $cashierURL
     * @return AggregatorRedirectUrls
     */
    public function setCashierURL($cashierURL)
    {
        $this->cashierURL = $cashierURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getGameURL()
    {
        return $this->gameURL;
    }

    /**
     * @param string $gameURL
     * @return AggregatorRedirectUrls
     */
    public function setGameURL($gameURL)
    {
        $this->gameURL = $gameURL;
        return $this;
    }

    function toArray() {

        $acc = [];

        if( !is_null($this->getHomeURL()) )
            $acc['homeURL'] = $this->getHomeURL();

        if( !is_null($this->getLobbyURL()) )
            $acc['lobbyURL'] = $this->getLobbyURL();

        if( !is_null($this->getCashierURL()) )
            $acc['cashierURL'] = $this->getCashierURL();

        if( !is_null($this->getGameURL()) )
            $acc['gameURL'] = $this->getGameURL();

        return $acc;

    }


}