<?php

namespace Emmetog\ProxyPool\ProxyListSelector;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\Entity\ProxyUse;
use Emmetog\ProxyPool\ProxyListSorter\SuccessTimesProxyListSorter;

class SuccessTimesProxyListSorterTest extends \PHPUnit_Framework_TestCase
{
    private $time;

    public function setUp()
    {
        $this->time = new \DateTime();
    }

    public function testSort()
    {
        $sampleProxies = [
            new Proxy('test_proxy_id_1', '10.0.0.1', 10000, $this->getProxyUses(1, 2)),
            new Proxy('test_proxy_id_2', '10.0.0.2', 10000, $this->getProxyUses(3, 5)),
            new Proxy('test_proxy_id_3', '10.0.0.3', 10000, $this->getProxyUses(2, 0)),
        ];

        $proxySelector = new SuccessTimesProxyListSorter();

        $sortedProxies = $proxySelector->sortProxies($sampleProxies);

        $this->assertEquals('test_proxy_id_2', $sortedProxies[0]->getIdProxy());
        $this->assertEquals('test_proxy_id_3', $sortedProxies[1]->getIdProxy());
        $this->assertEquals('test_proxy_id_1', $sortedProxies[2]->getIdProxy());
    }

    private function getProxyUses($successes, $failures)
    {
        $proxyUses = [];

        for ($i = 0; $i < $successes; $i++) {
            $proxyUses[] = new ProxyUse(
                'id_proxy_use_success_' . $i,
                'test_id_proxy',
                $this->time,
                true,
                2
            );
        }

        for ($i = 0; $i < $failures; $i++) {
            $proxyUses[] = new ProxyUse(
                'id_proxy_use_fail_' . $i,
                'test_id_proxy',
                $this->time,
                false,
                2
            );
        }

        return $proxyUses;
    }
}