<?php

namespace Emmetog\ProxyPool\ProxyListSorter;

use Emmetog\ProxyPool\Entity\Proxy;

interface ProxyListSorterInterface
{
    /**
     * @return Proxy[]
     */
    public function sortProxies(array $proxies);
}