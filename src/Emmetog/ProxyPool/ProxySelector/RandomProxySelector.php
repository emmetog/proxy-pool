<?php

namespace Emmetog\ProxyPool\ProxySelector;

/**
 * This simple proxy selector selects a random proxy.
 */
class RandomProxySelector implements ProxySelectorInterface
{
    public function selectBestProxy(array $proxies)
    {
        return $proxies[array_rand($proxies)];
    }
}
