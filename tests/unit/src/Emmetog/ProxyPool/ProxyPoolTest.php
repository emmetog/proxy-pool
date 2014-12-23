<?php

namespace Emmetog\ProxyPool;

use Emmetog\ProxyPool\Entity\Proxy;
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
        $mockProxyRepository = $this->getMock(
                '\Emmetog\ProxyPool\Repository\ProxyRepositoryInterface',
                array(
                        'findBestAliveProxy',
                        'incrementFailedRequestForProxy',
                        'incrementSuccessfulRequestForProxy'
                )
        );
        $mockProxyRepository->expects($this->once())
                ->method('findBestAliveProxy')
                ->will($this->returnValue($this->getSampleProxy()));

        $this->proxyPool = new ProxyPool($mockProxyRepository);

        $this->proxyPool->getBestProxyFromPool();
    }

    public function testGetProxyFromPoolReturnsProxyObjectWhichRepositoryReturned()
    {
        $aliveProxy = $this->getSampleProxy();

        $mockProxyRepository = $this->getMock(
                '\Emmetog\ProxyPool\Repository\ProxyRepositoryInterface',
                array(
                        'findBestAliveProxy',
                        'incrementFailedRequestForProxy',
                        'incrementSuccessfulRequestForProxy'
                )
        );
        $mockProxyRepository->expects($this->once())
                ->method('findBestAliveProxy')
                ->will($this->returnValue($aliveProxy));

        $this->proxyPool = new ProxyPool($mockProxyRepository);

        $returnedProxy = $this->proxyPool->getBestProxyFromPool();

        $this->assertEquals($aliveProxy, $returnedProxy);
    }

    public function testIncrementFailedRequestCounterForwardsToRepository()
    {
        $proxy = $this->getSampleProxy();

        $mockProxyRepository = $this->getMock(
                '\Emmetog\ProxyPool\Repository\ProxyRepositoryInterface',
                array(
                        'findBestAliveProxy',
                        'incrementFailedRequestForProxy',
                        'incrementSuccessfulRequestForProxy'
                )
        );
        $mockProxyRepository->expects($this->once())
                ->method('incrementFailedRequestForProxy')
                ->with($proxy);

        $this->proxyPool = new ProxyPool($mockProxyRepository);

        $this->proxyPool->incrementFailedRequestForProxy($proxy);
    }

    public function testIncrementSuccessfulRequestCounterForwardsToRepository()
    {
        $proxy = $this->getSampleProxy();

        $mockProxyRepository = $this->getMock(
                '\Emmetog\ProxyPool\Repository\ProxyRepositoryInterface',
                array(
                        'findBestAliveProxy',
                        'incrementFailedRequestForProxy',
                        'incrementSuccessfulRequestForProxy'
                )
        );
        $mockProxyRepository->expects($this->once())
                ->method('incrementSuccessfulRequestForProxy')
                ->with($proxy);

        $this->proxyPool = new ProxyPool($mockProxyRepository);

        $this->proxyPool->incrementSuccessfulRequestForProxy($proxy);
    }

    /*
     * ------------- HELPER METHODS FOR TEST -------------.
     */

    /**
     * @return Proxy
     */
    private function getSampleProxy()
    {
        return new Proxy('127.0.0.1', '8080');
    }
}
 