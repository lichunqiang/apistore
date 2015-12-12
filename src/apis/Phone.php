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

/**
 * 手机号码归属地查询
 * @see http://apistore.baidu.com/apiworks/servicedetail/117.html
 */
class Phone extends Api
{
    /**
     * @var string API address
     */
    private $address = 'http://apis.baidu.com/apistore/mobilephoneservice/mobilephone?';
    /**
     * 获取手机信息.
     *
     * @param string $tel
     *
     * @return array
     */
    public function get($tel)
    {
        $query_str = http_build_query(['tel' => $tel]);

        return $this->fetch($this->address . $query_str);
    }
}
