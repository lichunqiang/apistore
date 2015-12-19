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
 * 汇率转换.
 *
 * @see http://apistore.baidu.com/apiworks/servicedetail/119.html
 */
class Currency extends Api
{
    /**
     * @var string 汇率转换地址
     */
    private $address = 'http://apis.baidu.com/apistore/currencyservice/currency?';

    /**
     * @var string 币种查询地址
     */
    private $fetchTypesUrl = 'http://apis.baidu.com/apistore/currencyservice/type?';

    /**
     * 获取汇率转换结果.
     *
     * @param array $queryParams
     *                           ~~~
     *                           $queryParams = [
     *                           'fromCurrency' => 'CNY', //待转化的币种
     *                           'toCurrency' => 'USD',   //转化后的币种
     *                           'amount' => 2            //转化金额
     *                           ];
     *                           ~~~
     *                           或者
     *                           ~~~
     *                           $queryParams = ['CNY', 'USD', 2];
     *                           ~~~
     *
     * @return array
     */
    public function get($queryParams)
    {
        if (!isset($queryParams['fromCurrency'])) {
            $queryParams = array_combine(['fromCurrency', 'toCurrency', 'amount'], $queryParams);
        }

        return $this->fetch($this->address . http_build_query($queryParams));
    }

    public function getTypes()
    {
        return $this->fetch($this->fetchTypesUrl);
    }
}
