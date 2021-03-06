<?php

namespace light\apistore;

class DistanceTest extends \PHPUnit_Framework_TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = (new ApiStore($GLOBALS['api_key']))->distance;
    }

    public function testNormalFetch()
    {
        $result = $this->api->get('118.77147503233,32.054128923368;116.3521416286, 39.965780080447');
        $this->assertEquals($result['errcode'], 0);
        $this->assertTrue(is_array($result['data']));
    }

    public function testSpecialParams()
    {
        $result = $this->api->get([
            'coord_type' => 'wgs84',
            'waypoints' => '118.77147503233,32.054128923368;116.3521416286, 39.965780080447'
        ]);
        $this->assertEquals($result['errcode'], 0);
        $this->assertTrue(is_array($result['data']));
    }

    public function testSetBadParams()
    {
        $result = $this->api->get([
            'coord_type' => 'test',
            'waypoints' => '123,123;13,132'
        ]);

        $this->assertEquals($result['errcode'], 1);
    }
}
