<?php

namespace Emmetog\ProxyPool\Entity;

class Proxy
{

    /**
     * The IP of the proxy.
     *
     * @var string
     */
    private $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function getIp()
    {
        return $this->ip;
    }
}