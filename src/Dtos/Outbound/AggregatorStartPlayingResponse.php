<?php

namespace Sysgaming\AggregatorSdkPhp\Dtos\Outbound;

class AggregatorStartPlayingResponse
{
    private $requestUUID;
    private $url;

    /**
     * AggregatorStartPlaying constructor.
     * @param $requestUUID
     */
    public function __construct($requestUUID, $url)
    {
        $this->requestUUID = $requestUUID;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getRequestUUID()
    {
        return $this->requestUUID;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

}