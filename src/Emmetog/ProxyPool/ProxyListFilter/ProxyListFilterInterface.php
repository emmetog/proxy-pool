<?php

namespace Emmetog\ProxyPool\ProxyListFilter;

use Emmetog\ProxyPool\Entity\Proxy;

interface ProxyListFilterInterface
{
    /**
     * @param Proxy[] $proxies
     * @return Proxy[]
     */
    public function filterProxies(array $proxies);
}