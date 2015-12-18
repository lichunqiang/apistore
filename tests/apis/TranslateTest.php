<?php

namespace light\apistore;

use light\apistore\ApiStore;

class TranslateTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->translate;
    }

    public function testNormal()
    {
        $result = $this->api->get('Hell world.');

        $this->assertEquals(0, $result['errcode']);

        $this->assertArrayHasKey('trans_result', $result['data']);
    }

    public function testSpecialParams()
    {
        $result = $this->api->get(['Hello world', 'en', 'zh']);
        $this->assertEquals(0, $result['errcode']);
        $this->assertArrayHasKey('trans_result', $result['data']);
    }
}
