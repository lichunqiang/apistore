<?php

namespace light\apistore;

use light\apistore\ApiStore;

class StoreTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributes()
    {
        $store = new ApiStore('testesttseesteste');
        $this->assertClassHasAttribute('apikey', 'light\apistore\ApiStore');
    }

    public function testInstance()
    {
        $store = new ApiStore('testesttseesteste');

        $this->assertInstanceOf('\light\apistore\apis\Ip', $store->ip);
        $this->assertInstanceOf('\light\apistore\apis\Phone', $store->phone);
        $this->assertInstanceOf('\light\apistore\apis\IdCard', $store->idcard);
        $this->assertInstanceOf('\light\apistore\apis\Translate', $store->translate);
    }

    public function testNoInstance()
    {
        $store = new ApiStore('teastaeastsearfaf');

        $this->assertEquals('teastaeastsearfaf', $store->apikey);

        return $store;
    }

    /**
     * @depends testNoInstance
     * @expectedException \Exception
     */
    public function testGetUnknowProperty($store)
    {
        $b = $store->unice;
    }

    /**
     * @depends testNoInstance
     */
    public function testDirectlyCall($store)
    {
        $result = $store->phone('15210340546');

        $this->assertArrayHasKey('errcode', $result);
        $this->assertEquals($result['errcode'], 300204);
    }
}
