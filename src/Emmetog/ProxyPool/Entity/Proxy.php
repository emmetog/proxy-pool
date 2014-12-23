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

    /**
     * The port of the proxy.
     *
     * @var integer
     */
    private $port;

    public function __construct($ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getPort()
    {
        return $this->port;
    }
}