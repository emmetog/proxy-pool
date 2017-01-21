<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\ProxySelector\ProxySelectorInterface;
use Emmetog\ProxyPool\Repository\ProxyRepositoryInterface;

class ProxyPool {

    /**
     * @var ProxyRepositoryInterface
     */
    private $proxyRepository;

    /**
     * @var ProxySelectorInterface
     */
    private $proxySelector;

    public function __construct(ProxyRepositoryInterface $proxyRepository, ProxySelectorInterface $proxySelector)
    {
        $this->proxyRepository = $proxyRepository;
        $this->proxySelector = $proxySelector;
    }

    public function getBestProxyFromPool()
    {
        $aliveProxies = $this->proxyRepository->findAllAlive();

        return $this->proxySelector->selectBestProxy($aliveProxies);
    }

    public function incrementFailedRequestForProxy(Proxy $proxy)
    {
        $this->insertNewProxyUse(false);
    }

    public function incrementSuccessfulRequestForProxy(Proxy $proxy)
    {
        $this->insertNewProxyUse(true);
    }

    /**
     * @param $succeeded
     */
    private function insertNewProxyUse($succeeded)
    {
        $proxyUseId = $this->proxyRepository->getNextIdProxyUse();

        $proxyUse = new ProxyUse($proxyUseId, new \DateTime(), $succeeded);

        $this->proxyRepository->insertUse($proxyUse);
    }
}