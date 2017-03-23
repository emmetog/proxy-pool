<?php

namespace Emmetog\ProxyPool\ProxyListSorter;
use Emmetog\ProxyPool\Entity\Proxy;

/**
 * This simple sorter orders by most successes first..
 */
class SuccessTimesProxyListSorter implements ProxyListSorterInterface
{
    /**
     * @param Proxy[] $proxies
     * @return Proxy[]
     */
    public function sortProxies(array $proxies)
    {
        usort(
            $proxies,
            function (Proxy $a, Proxy $b) {
                if ($a->countSuccessfulUses() === $b->countSuccessfulUses()) {
                    return 0;
                }

                return ($a->countSuccessfulUses() < $b->countSuccessfulUses())
                    ? 1
                    : -1;
            }
        );

        return $proxies;
    }
}
