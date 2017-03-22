<?php

namespace Emmetog\ProxyPool\ProxyListSorter;

/**
 * This simple sorter shuffles the proxies at random.
 */
class RandomProxyListSorter implements ProxyListSorterInterface
{
    public function sortProxies(array $proxies)
    {
        shuffle($proxies);

        return $proxies;
    }
}
