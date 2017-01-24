<?php

namespace Emmetog\ProxyPool\ProxyFilter;

use Emmetog\ProxyPool\Entity\Proxy;

interface ProxyFilterInterface
{
    /**
     * @param Proxy[] $proxies
     * @return Proxy[]
     */
    public function filterProxies(array $proxies);
}