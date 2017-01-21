<?php

namespace Emmetog\ProxyPool\Entity;

class Proxy
{
    /**
     * @var integer
     */
    private $idProxy;

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

    /**
     * @var ProxyUse[]
     */
    private $uses = [];

    public function __construct($idProxy, $ip, $port, $uses = [])
    {
        $this->idProxy = $idProxy;
        $this->ip = $ip;
        $this->port = $port;
        $this->uses = $uses;
    }

    /**
     * @return int
     */
    public function getIdProxy()
    {
        return $this->idProxy;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return ProxyUse[]
     */
    public function getUses()
    {
        return $this->uses;
    }
}