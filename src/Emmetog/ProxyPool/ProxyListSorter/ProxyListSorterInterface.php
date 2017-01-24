<?php

namespace Emmetog\ProxyPool\ProxyListSorter;

interface ProxyListSorterInterface
{
    public function sortProxies(array $proxies);
}