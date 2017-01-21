<?php

namespace Emmetog\ProxyPool\Entity;

class ProxyUse {

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
}