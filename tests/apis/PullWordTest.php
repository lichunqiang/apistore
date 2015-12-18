<?php

namespace light\apistore;

use light\apistore\ApiStore;

class PullWordTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->pullword;
    }

    public function testFetch()
    {
        $result = $this->api->get('清华大学是好学校');
        $this->assertTrue(is_string($result));
    }

    public function testSpecialParams()
    {
        $result = $this->api->get(['清华大学是好学校', 0.5, 1]);
        $this->assertTrue(is_string($result));
    }
}
