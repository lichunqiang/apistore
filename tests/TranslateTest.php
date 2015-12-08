<?php

namespace light\apistore;

use light\apistore\ApiStore;

class TranslateTest extends \PHPUnit_Framework_TestCase
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
}
