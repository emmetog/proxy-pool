<?php

namespace Emmetog\ProxyPool\ProxySelector;

/**
 * This simple proxy selector selects the first alive proxy that is
 * available, no complex logic to choose the proxy here.
 */
class FirstProxySelector implements ProxySelectorInterface
{
    public function selectBestProxy(array $proxies)
    {
        return reset($proxies);
    }
}
