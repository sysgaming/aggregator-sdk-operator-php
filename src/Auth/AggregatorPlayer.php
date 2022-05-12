<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

class AggregatorPlayer
{

    private $id;

    /**
     * @var int
     */
    private $balance;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AggregatorPlayer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     * @return AggregatorPlayer
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

}