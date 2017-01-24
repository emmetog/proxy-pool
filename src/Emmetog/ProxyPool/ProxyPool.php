<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\Exception\NoAliveProxiesException;
use Emmetog\ProxyPool\ProxyFilter\ProxyFilterInterface;
use Emmetog\ProxyPool\ProxySelector\ProxySelectorInterface;
use Emmetog\ProxyPool\Repository\ProxyRepositoryInterface;

class ProxyPool
{

    /**
     * @var ProxyRepositoryInterface
     */
    private $proxyRepository;

    /**
     * @var ProxyFilterInterface
     */
    private $proxyFilter;

    /**
     * @var ProxySelectorInterface
     */
    private $proxySelector;

    public function __construct(
        ProxyRepositoryInterface $proxyRepository,
        ProxyFilterInterface $proxyFilter,
        ProxySelectorInterface $proxySelector
    ) {
        $this->proxyRepository = $proxyRepository;
        $this->proxyFilter = $proxyFilter;
        $this->proxySelector = $proxySelector;
    }

    public function getBestProxyFromPool()
    {
        $aliveProxies = $this->proxyRepository->findAllAlive();

        if (empty($aliveProxies)) {
            throw new NoAliveProxiesException();
        }

        $filteredProxies = $this->proxyFilter->filterProxies($aliveProxies);

        return $this->proxySelector->selectBestProxy($filteredProxies);
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