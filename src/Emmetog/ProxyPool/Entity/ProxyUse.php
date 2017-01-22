<?php

namespace Emmetog\ProxyPool\Entity;

class ProxyUse {

    /**
     * @var string
     */
    private $idProxyUse;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var boolean
     */
    private $succeeded;

    public function __construct($idProxyUse, \DateTime $time, $succeeded)
    {
        $this->idProxyUse;
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