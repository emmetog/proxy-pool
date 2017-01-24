<?php

namespace Emmetog\ProxyPool\ProxyListFilter;

use Emmetog\ProxyPool\Entity\Proxy;

/**
 * This simple filter doesn't filter anything, it returns all proxies.
 */
class NoFilter implements ProxyListFilterInterface
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