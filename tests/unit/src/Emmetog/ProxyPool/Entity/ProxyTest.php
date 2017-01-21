<?php

namespace Emmetog\ProxyPool\Entity;

use PHPUnit_Framework_TestCase;

class ProxyTest extends PHPUnit_Framework_TestCase {

    public function testGetId()
    {
        $proxy = $this->getSampleProxy();

        $this->assertEquals('test_proxy_id', $proxy->getIdProxy());
    }

    public function testGetIp()
    {
        $proxy = $this->getSampleProxy();

        $this->assertEquals('127.0.0.1', $proxy->getIp());
    }

    public function testGetPort()
    {
        $proxy = $this->getSampleProxy();

        $this->assertEquals('8080', $proxy->getPort());
    }

    /*
     * -------------- HELPER METHODS FOR TEST --------------.
     */

    private function getSampleProxy()
    {
        return new Proxy('test_proxy_id', '127.0.0.1', '8080');
    }

}
 