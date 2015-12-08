<?php

namespace light\apistore;

use light\apistore\ApiStore;

class StoreTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributes()
    {
        $store = new ApiStore('testesttseesteste');
        $this->assertClassHasAttribute('apikey', ApiStore::className());
    }

    public function testInstance()
    {
        $store = new ApiStore('testesttseesteste');

        $this->assertInstanceOf('\light\apistore\apis\Ip', $store->ip);
        $this->assertInstanceOf('\light\apistore\apis\Phone', $store->phone);
        $this->assertInstanceOf('\light\apistore\apis\IdCard', $store->idcard);
        $this->assertInstanceOf('\light\apistore\apis\Translate', $store->translate);
    }

    /**
     * @expectedException \yii\base\UnknownPropertyException
     */
    public function testNoInstance()
    {
        $store = new ApiStore('teastaeastsearfaf');

        $store->test;
    }
}
