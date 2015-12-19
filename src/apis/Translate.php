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

/**
 * 翻译.
 *
 * @see http://apistore.baidu.com/apiworks/servicedetail/118.html
 */
class Translate extends Api
{
    private $address_translate = 'http://apis.baidu.com/apistore/tranlateservice/translate?';

    /**
     * 目前词典接口只支持zh和en两种语言
     *
     * @param string|array $queryParams
     *
     * @return array
     */
    public function get($queryParams)
    {
        $_using_address = $this->address_translate;

        if (is_string($queryParams)) {
            $queryParams = ['query' => $queryParams, 'from' => 'auto', 'to' => 'auto'];
        } elseif (!isset($queryParams['query'])) {
            $queryParams = array_combine(['query', 'from', 'to'], $queryParams);
        }

        return $this->fetch($_using_address . http_build_query($queryParams));
    }
}
