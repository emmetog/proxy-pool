<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Repository\ProxyRepositoryInterface;

class ProxyPool {

    /**
     * @var ProxyRepositoryInterface
     */
    private $proxyRepository;

    public function __construct(ProxyRepositoryInterface $proxyRepository)
    {
        $this->proxyRepository = $proxyRepository;
    }

    public function getBestProxyFromPool()
    {
        return $this->proxyRepository->findBestAliveProxy();
    }

    public function incrementFailedRequestForProxy(Proxy $proxy)
    {
        $this->proxyRepository->incrementFailedRequestForProxy($proxy);
    }

    public function incrementSuccessfulRequestForProxy(Proxy $proxy)
    {
        $this->proxyRepository->incrementSuccessfulRequestForProxy($proxy);
    }
}