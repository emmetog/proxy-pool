<?php

namespace Emmetog\ProxyPool\ProxyFilter;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;

class NotUsedRecentlyProxyFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFilterProxiesRemovesAllProxiesWhenAllRecentlyUsed()
    {
        $proxies = $this->getSampleProxies();

        $threeHours = 3600 * 3;

        $filter = new NotUsedRecentlyProxyFilter($threeHours);

        $filteredProxies = $filter->filterProxies($proxies);

        $this->assertCount(1, $filteredProxies, 'Recently used proxy should be discarded');
        $this->assertEquals('test_id_proxy_1', $filteredProxies[0]->getIdProxy());
    }

    private function getSampleProxies()
    {
        return [
            new Proxy('test_id_proxy_1', 'test_ip_1', 'test_port_1', [
                new ProxyUse('test_id_proxy_use_1', 'test_id_proxy_1', new \DateTime('4 hours ago'), true, 5),
                new ProxyUse('test_id_proxy_use_1', 'test_id_proxy_1', new \DateTime('16 hours ago'), true, 5),
            ]),
            new Proxy('test_id_proxy_2', 'test_ip_2', 'test_port_2', [
                new ProxyUse('test_id_proxy_use_2', 'test_id_proxy_2', new \DateTime('2 hours ago'), true, 5),
                new ProxyUse('test_id_proxy_use_2', 'test_id_proxy_2', new \DateTime('4 hours ago'), true, 5),
            ]),
        ];
    }
}