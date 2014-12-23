<?php

namespace Emmetog\ProxyPool\Repository;

use Emmetog\ProxyPool\Entity\Proxy;

interface ProxyRepositoryInterface
{
    public function findBestAliveProxy();

    public function incrementFailedRequestForProxy(Proxy $proxy);

    public function incrementSuccessfulRequestForProxy(Proxy $proxy);
}