<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
use Emmetog\ProxyPool\ProxySelector\FirstProxySelector;
use Emmetog\ProxyPool\Repository\ProxyRepositoryInterface;
use PHPUnit_Framework_TestCase;

class ProxyPoolTest extends PHPUnit_Framework_TestCase
{

    /**
     * The object under test.
     *
     * @var ProxyPool
     */
    private $proxyPool;

    public function testGetProxyFromPoolUsesRepository()
    {
        $proxyRepositoryProphecy = $this->whenRepoReturnsAliveProxy($this->getSampleProxy());

        $proxySelector = new FirstProxySelector();

        $this->proxyPool = new ProxyPool($proxyRepositoryProphecy->reveal(), $proxySelector);
        $this->proxyPool->getBestProxyFromPool();
    }

    public function testGetProxyFromPoolReturnsProxyObjectWhichRepositoryReturned()
    {
        $aliveProxy = $this->getSampleProxy();

        $proxyRepositoryProphecy = $this->whenRepoReturnsAliveProxy($aliveProxy);

        $proxySelector = new FirstProxySelector();

        $this->proxyPool = new ProxyPool($proxyRepositoryProphecy->reveal(), $proxySelector);

        $returnedProxy = $this->proxyPool->getBestProxyFromPool();

        $this->assertEquals($aliveProxy, $returnedProxy);
    }

    /*
     * ------------- HELPER METHODS FOR TEST -------------.
     */

    /**
     * @return Proxy
     */
    private function getSampleProxy()
    {
        return new Proxy('test_id_proxy', '127.0.0.1', 8080);
    }

    /**
     * @param $proxy
     * @return mixed
     */
    private function whenRepoReturnsAliveProxy($proxy)
    {
        $proxyRepositoryProphecy = $this->prophesize(ProxyRepositoryInterface::class);
        $proxyRepositoryProphecy->findAllAlive()
            ->shouldBeCalled()
            ->willReturn([$proxy]);
        return $proxyRepositoryProphecy;
    }
}
 