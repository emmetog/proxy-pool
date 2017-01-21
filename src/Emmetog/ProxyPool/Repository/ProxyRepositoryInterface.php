<?php

namespace Emmetog\ProxyPool\Repository;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;

interface ProxyRepositoryInterface
{
    public function findAllAlive();

    public function insertProxy(Proxy $proxy);

    public function insertUse(ProxyUse $proxyUse);

    public function getNextIdProxy();

    public function getNextIdProxyUse();
}