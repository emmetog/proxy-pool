<?php

namespace Emmetog\ProxyPool\Repository;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\Exception\ProxyNotFoundException;

interface ProxyRepositoryInterface
{
    /**
     * Finds all alive proxies.
     *
     * @return Proxy[]
     */
    public function findAllAlive();

    /**
     * Finds a proxy by IP and port.
     *
     * Throws a ProxyNotFoundException if no proxy is found.
     *
     * @param string $ip
     * @param string $port
     * @return Proxy
     * @throws ProxyNotFoundException when the proxy doesn't exist
     */
    public function findByIpAndPort($ip, $port);

    /**
     * Inserts a new proxy.
     *
     * @param Proxy $proxy
     */
    public function insertProxy(Proxy $proxy);

    /**
     * Records a proxy as "used" along with the result.
     *
     * @param ProxyUse $proxyUse
     */
    public function insertUse(ProxyUse $proxyUse);

    /**
     * Gets the next id for a proxy.
     *
     * @return string
     */
    public function getNextIdProxy();

    /**
     * Gets the next id for a proxy use.
     *
     * @return string
     */
    public function getNextIdProxyUse();
}