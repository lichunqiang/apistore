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

class Ip extends Api
{
    /**
     * 接口地址
     *
     * @var string
     */
    private $address = 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip=';

    /**
     * Reqeust the api interface, and get the result.
     *
     * @param string $ip_address ip string
     *
     * @return mixed
     */
    public function get($ip_address)
    {
        return $this->fetch($this->address . $ip_address);
    }
}
