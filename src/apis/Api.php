<?php

/*
 * This file is part of the light/apistore.
 *
 * (c) lichunqiang <light-li@hotmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace light\apistore\apis;

abstract class Api
{
    public $apikey;

    /**
     * @var bool If Response is json format, Default is true, will decode to array.
     */
    protected $isJsonResponse = true;

    /**
     * {@inheritdoc}
     *
     * @param string $apikey Api key
     */
    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * Fetch result.
     *
     * @param mixed $params
     *
     * @return mixed
     */
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

    /**
     * Fetch result by $address.
     *
     * @param string $address
     *
     * @return mixed
     */
    final public function fetch($address)
    {
        if (function_exists('curl_init')) {
            $ch = \curl_init();
            $header = $this->prepareHeaders();
            // 添加apikey到header
            \curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // 执行HTTP请求
            \curl_setopt($ch, CURLOPT_URL, $address);
            $res = \curl_exec($ch);
        } else {
            $context = stream_context_create([
                'http' => [
                    'header' => implode(';', $this->prepareHeaders()),
                ],
            ]);
            $res = file_get_contents($address, null, $context);
        }

        return $this->_parseResponse($res);
    }

    /**
     * Parse response to array.
     *
     * @param mixed $result
     *
     * @return array
     */
    protected function _parseResponse($result)
    {
        if (!$this->isJsonResponse) {
            return $result;
        }
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
