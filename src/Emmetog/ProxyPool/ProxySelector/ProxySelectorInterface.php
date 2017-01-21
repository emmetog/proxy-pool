<?php

namespace Emmetog\ProxyPool\ProxySelector;

interface ProxySelectorInterface
{
    public function selectBestProxy(array $proxies);
}