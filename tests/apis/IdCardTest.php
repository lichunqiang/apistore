<?php
namespace light\apistore;

use light\apistore\ApiStore;

class IdCardTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    public function setUp()
    {
        $this->store = new ApiStore($GLOBALS['api_key']);
    }

    public function testInstance()
    {
        $this->assertTrue(true);
    }
}
