<?php

namespace light\apistore;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->currency;
    }

    public function testNormalFetch()
    {
        $result = $this->api->get(['USD', 'CNY', 2]);
        $this->assertEquals(0, $result['errcode']);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('convertedamount', $result['data']);
    }

    public function testUnknowCurrencyType()
    {
        $result = $this->api->get(['USG', 'CNY', 3]);

        $this->assertNotEquals(0, $result['errcode']);
    }

    public function testBadParams()
    {
        $result = $this->api->get(['USD', 2, 'CNY']);

        $this->assertNotEquals(0, $result['errcode']);
    }

    public function testGetTypes()
    {
        $result = $this->api->getTypes();
        $this->assertEquals(0, $result['errcode']);
        $this->assertArrayHasKey('data', $result);
    }
}
