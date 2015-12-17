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
 * 身份证查询.
 *
 * @see http://apistore.baidu.com/apiworks/servicedetail/113.html
 */
class IdCard extends Api
{
    private $address = 'http://apis.baidu.com/apistore/idservice/id?';

    /**
     * 获取身份证信息.
     *
     * @param string $id_card 身份证号
     *
     * @return array
     */
    public function get($id)
    {
        return $this->fetch($this->address . http_build_query(compact('id')));
    }
}
