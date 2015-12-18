<?php
namespace light\apistore;

use light\apistore\ApiStore;

class IdCardTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->idcard;
    }

    public function testFetch()
    {
        $result = $this->api->get('511700198512145170');
        $this->assertEquals($result['errcode'], 0);

        $this->assertArrayHasKey('sex', $result['data']);
        $this->assertEquals('M', $result['data']['sex']);
    }

    public function testBadCard()
    {
        $result = $this->api->get('130132912333123223');
        $this->assertNotEquals($result['errcode'], 0);

    }
}
