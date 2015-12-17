<?php

namespace light\apistore\apis;

/**
 * @see http://apistore.baidu.com/apiworks/servicedetail/143.html
 */
class PullWord extends Api
{
    /**
     * @inheritdoc
     */
    private $address = 'http://apis.baidu.com/apistore/pullword/words?';

    /**
     * @inheritdoc
     */
    protected $isJsonResponse = false;

    /**
     * @return string
     */
    public function get($queryParams)
    {
        if (is_string($queryParams)) {
            $queryParams = ['source' => $queryParams, 'param1' => 0, 'param2' => 1];
        } elseif (!isset($queryParams['source'])) {
            $queryParams = array_combine(['source', 'param1', 'param2'], $queryParams);
        }
        return $this->fetch($this->address . http_build_query($queryParams));
    }
}
