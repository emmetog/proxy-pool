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

    /**
     * @var integer
     */
    private $secondsTaken;

    public function __construct($idProxyUse, $idProxy, \DateTime $time, $succeeded, $secondsTaken)
    {
        $this->idProxyUse;
        $this->idProxy;
        $this->time = $time;
        $this->succeeded = $succeeded;
        $this->secondsTaken = $secondsTaken;
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

    /**
     * @return integer
     */
    public function getSecondsTaken()
    {
        return $this->secondsTaken;
    }
}