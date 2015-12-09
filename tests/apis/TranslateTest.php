<?php

namespace light\apistore;

use light\apistore\ApiStore;

class TranslateTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    public function setUp()
    {
        $this->store = new ApiStore($GLOBALS['api_key']);
    }

    public function testNormal()
    {
        $translate = $this->store->translate;

        $result = $translate->get('Hell world.');

        $this->assertEquals(0, $result['errcode']);

        $this->assertArrayHasKey('trans_result', $result['data']);
    }
}
