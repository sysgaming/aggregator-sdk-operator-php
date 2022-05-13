<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

class AggregatorSignatureHolder
{

    private $signature;
    private $user;
    private $password;
    private $test;

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     * @return AggregatorSignatureHolder
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return AggregatorSignatureHolder
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return AggregatorSignatureHolder
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}