<?php

namespace light\apistore;

use light\apistore\ApiStore;

class PullWordTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    public function setUp()
    {
        $this->store = new ApiStore($GLOBALS['api_key']);
    }

    public function testFetch()
    {
        $api = $this->store->pullword;

        $result = $api->get('清华大学是好学校');
        $this->assertTrue(is_string($result));

        // $result

    }
}
