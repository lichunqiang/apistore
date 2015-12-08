<?php

namespace light\apistore;

use light\apistore\ApiStore;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    public function setUp()
    {
        $this->store = new ApiStore('fsdfsfas');
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ApiStore::className(), $this->store);
    }

    public function testFetchResult()
    {
        $res = $this->store->phone->get('15210234123');
        $this->assertArrayHasKey('errcode', $res);
        $this->assertArrayHasKey('errmsg', $res);

        $this->assertNotEquals(0, $res['errcode']);
        $this->assertEquals(300204, $res['errcode']);
    }

    public function testGlobal()
    {
        var_dump($GLOBALS['foo']);
    }
}
