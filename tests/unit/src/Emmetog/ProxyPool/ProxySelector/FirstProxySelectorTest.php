<?php

namespace Emmetog\ProxyPool\ProxyListSelector;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\ProxyListSorter\NoSorter;

class FirstProxySelectorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBestProxy()
    {
        $sampleProxies = [
            new Proxy('test_proxy_id_1', '10.0.0.1', 10000),
            new Proxy('test_proxy_id_2', '10.0.0.2', 10000),
            new Proxy('test_proxy_id_3', '10.0.0.3', 10000),
            new Proxy('test_proxy_id_4', '10.0.0.4', 10000),
            new Proxy('test_proxy_id_5', '10.0.0.5', 10000),
            new Proxy('test_proxy_id_6', '10.0.0.6', 10000),
            new Proxy('test_proxy_id_7', '10.0.0.7', 10000),
        ];

        $proxySelector = new NoSorter();

        $this->assertEquals($sampleProxies, $proxySelector->sortProxies($sampleProxies));
    }
}