<?php

namespace Emmetog\ProxyPool\Entity;

class ProxyUse {

    /**
     * @var string
     */
    private $idProxyUse;

    /**
     * @var string
     */
    private $idProxy;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var boolean
     */
    private $succeeded;

    public function __construct($idProxyUse, $idProxy, \DateTime $time, $succeeded)
    {
        $this->idProxyUse;
        $this->idProxy;
        $this->time = $time;
        $this->succeeded = $succeeded;
    }

    /**
     * @return string
     */
    public function getIdProxyUse()
    {
        return $this->idProxyUse;
    }

    /**
     * @return string
     */
    public function getIdProxy()
    {
        return $this->idProxy;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return boolean
     */
    public function isSucceeded()
    {
        return $this->succeeded;
    }
}