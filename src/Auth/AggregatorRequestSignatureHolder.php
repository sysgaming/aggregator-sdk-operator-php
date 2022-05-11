<?php


namespace Sysgaming\AggregatorSdkPhp\Auth;


class AggregatorRequestSignatureHolder
{

    private $signature;
    private $user;
    private $password;

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     * @return AggregatorRequestSignatureHolder
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
     * @return AggregatorRequestSignatureHolder
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
     * @return AggregatorRequestSignatureHolder
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}