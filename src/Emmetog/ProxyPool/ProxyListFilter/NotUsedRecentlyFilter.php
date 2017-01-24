<?php

namespace Emmetog\ProxyPool\ProxyListFilter;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;

class NotUsedRecentlyFilter implements ProxyListFilterInterface
{
    /**
     * Proxies used less than $limit seconds ago are discarded.
     *
     * @var integer
     */
    private $limit = 3600;

    /**
     * @param integer $limit Proxies used less than $limit seconds ago are discarded
     */
    public function __construct($limit = 3600)
    {
        $this->limit = $limit;
    }

    /**
     * @param Proxy[] $proxies
     * @return Proxy[]
     */
    public function filterProxies(array $proxies)
    {
        $filteredProxies = [];

        foreach($proxies as $proxy)
        {
            $lastUsedDate = $this->getLastUsedDate($proxy->getUses());

            if(time() > ($lastUsedDate->getTimestamp() + $this->limit))
            {
                $filteredProxies[] = $proxy;
            }
        }

        return $filteredProxies;
    }

    /**
     * @param ProxyUse[] $proxyUses
     */
    private function getLastUsedDate(array $proxyUses)
    {
        $lastUsedDate = new \DateTime('10 years ago');

        foreach($proxyUses as $proxyUse)
        {
            if($proxyUse->getTime() > $lastUsedDate)
            {
                $lastUsedDate = $proxyUse->getTime();
            }
        }

        return $lastUsedDate;
    }
}