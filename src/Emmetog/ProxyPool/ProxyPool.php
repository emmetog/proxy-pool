<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\Exception\NoAliveProxiesException;
use Emmetog\ProxyPool\ProxyListFilter\ProxyListFilterInterface;
use Emmetog\ProxyPool\ProxyListSorter\ProxyListSorterInterface;
use Emmetog\ProxyPool\Repository\ProxyRepositoryInterface;

class ProxyPool
{

    /**
     * @var ProxyRepositoryInterface
     */
    private $proxyRepository;

    /**
     * @var ProxyListFilterInterface
     */
    private $proxyFilter;

    /**
     * @var ProxyListSorterInterface
     */
    private $proxySorter;

    public function __construct(
        ProxyRepositoryInterface $proxyRepository,
        ProxyListFilterInterface $proxyFilter,
        ProxyListSorterInterface $proxySorter
    ) {
        $this->proxyRepository = $proxyRepository;
        $this->proxyFilter = $proxyFilter;
        $this->proxySorter = $proxySorter;
    }

    /**
     * @return Proxy
     */
    public function getBestProxyFromPool()
    {
        $aliveProxies = $this->proxyRepository->findAllAlive();

        if (empty($aliveProxies)) {
            throw new NoAliveProxiesException();
        }

        $filteredProxies = $this->proxyFilter->filterProxies($aliveProxies);
        $sortedProxies = $this->proxySorter->sortProxies($filteredProxies);

        return array_shift($sortedProxies);

    }

    public function incrementFailedRequestForProxy(Proxy $proxy, $secondsTaken)
    {
        $this->insertNewProxyUse($proxy, false, $secondsTaken);
    }

    public function incrementSuccessfulRequestForProxy(Proxy $proxy, $secondsTaken)
    {
        $this->insertNewProxyUse($proxy, true, $secondsTaken);
    }

    /**
     * @param $succeeded
     */
    private function insertNewProxyUse(Proxy $proxy, $succeeded, $secondsTaken)
    {
        $proxyUseId = $this->proxyRepository->getNextIdProxyUse();

        $proxyUse = new ProxyUse(
            $proxyUseId,
            $proxy->getIdProxy(),
            new \DateTime(),
            $succeeded,
            $secondsTaken
        );

        $this->proxyRepository->insertUse($proxyUse);
    }
}