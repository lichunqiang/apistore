<?php

namespace light\apistore;

use light\apistore\ApiStore;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    public function setUp()
    {
        $this->store = new ApiStore($GLOBALS['api_key']);
    }

    public function testFetchResult()
    {
        $res = $this->store->phone->get('15210234123');
        $this->assertArrayHasKey('errcode', $res);

        $this->assertEquals(0, $res['errcode']);
        $this->assertArrayHasKey('province', $res['data']);
    }
}
