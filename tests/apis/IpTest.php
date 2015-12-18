<?php

namespace light\apistore;

use light\apistore\ApiStore;

class IpComponentTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->ip;
    }

    public function testInstance()
    {
        $result = $this->api->get('117.89.35.58');
        $this->assertEquals($result['errcode'], 0);

        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('中国', $result['data']['country']);
    }
}
