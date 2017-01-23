<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\Exception\NoAliveProxiesException;
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

        if(empty($aliveProxies))
        {
            throw new NoAliveProxiesException();
        }

        return $this->proxySelector->selectBestProxy($aliveProxies);
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