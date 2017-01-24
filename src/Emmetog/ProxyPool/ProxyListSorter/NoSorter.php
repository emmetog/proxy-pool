<?php

namespace Emmetog\ProxyPool\ProxyListSorter;

/**
 * This sorter doesn't sort at all, it keeps the same order.
 */
class NoSorter implements ProxyListSorterInterface
{
    public function sortProxies(array $proxies)
    {
        return $proxies;
    }
}
