<?php

/*
 * This file is part of the light/yii2-apistore.
 *
 * (c) lichunqiang <light-li@hotmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace light\apistore\apis;

use yii\base\Object;

abstract class Api extends Object
{
    public $apikey;
    /**
     * {@inheritdoc}
     *
     * @param string $apikey Api key
     * @param array  $config
     */
    public function __construct($apikey, $config = [])
    {
        $this->apikey = $apikey;
        parent::__construct($config);
    }

    abstract public function get($params);

    /**
     * 准备请求头.
     *
     * @return array 默认的请头
     */
    protected function prepareHeaders()
    {
        return [
            'apikey:' . $this->apikey,
        ];
    }

    public function fetch($address)
    {
        $ch = curl_init();
        $header = $this->prepareHeaders();
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $address);
        $res = curl_exec($ch);

        return $this->_parseResponse($res);
    }

    private function _parseResponse($result)
    {
        $result = json_decode($result, true);
        if (!$result || !isset($result['errNum'])) {
            return ['errcode' => 1, 'errmsg' => 'fetch data error'];
        }
        if ($result['errNum'] == 0) {
            return [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => $result['retData'],
            ];
        }

        return ['errcode' => $result['errNum'], 'errmsg' => $result['errMsg']];
    }
}
