<?php

/*
 * This file is part of the light/apistore.
 *
 * (c) lichunqiang <light-li@hotmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace light\apistore;

/**
 * 调用总线
 * ~~~
 * $store = new ApiStore();
 * $result = $store->phone->get('123123123');
 * ~~~.
 */
final class ApiStore
{
    /**
     * The app key of calling the interface.
     *
     * @var string
     */
    public $apikey;

    public static $supportedApis = [
        'ip' => 'light\apistore\apis\Ip',
        'phone' => 'light\apistore\apis\Phone',
        'translate' => 'light\apistore\apis\Translate',
        'idcard' => 'light\apistore\apis\IdCard',
        'currency' => 'light\apistore\apis\Currency',
        'pullword' => 'light\apistore\apis\PullWord',
        'distance' => 'light\apistore\apis\Distance',
    ];

    /**
     * Init.
     *
     * @param string $apikey 调用接口的API key
     */
    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }
    /**
     * Implement the __get magic method.
     *
     * @param string $name The property name or the api name
     *
     * @throws InvalidaCallException
     * @throws UnknownPropertyException
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (isset(static::$supportedApis[$name])) {
            $class = static::$supportedApis[$name];

            return new $class($this->apikey);
        }
        throw new \Exception('Not exists method');
    }

    /**
     * Invoke methods.
     *
     * @param string $name   the name of method try to invoke
     * @param array  $params the params passed to the method
     *
     * @throws InvalidCallException
     *
     * @return mixed the method result of calling
     */
    public function __call($name, $params)
    {
        $obj = $this->{$name};

        return call_user_func_array([$obj, 'get'], $params);
    }
}
