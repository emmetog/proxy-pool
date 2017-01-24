<?php

namespace Emmetog\ProxyPool\ProxyFilter;

use Emmetog\ProxyPool\Entity\Proxy;

/**
 * This simple filter doesn't filter anything, it returns all proxies.
 */
class NoProxyFilter implements ProxyFilterInterface
{

    /**
     * @param Proxy[] $proxies
     * @return Proxy[]
     */
    public function filterProxies(array $proxies)
    {
        return $proxies;
    }
}