<?php

namespace light\apistore\apis;

class Distance extends Api
{
    /**
     * @inheritdoc
     */
    private $address = 'http://apis.baidu.com/apistore/distance/waypoints?';

    private $supportCoordTypes = [
        'bd09ll', //百度墨卡托坐标, 默认
        'bd09mc',
        'gcj02', //经过国测局加密的坐标
        'wgs84', //gps获取的坐标
    ];

    /**
     * If $queryParams is string:
     *     需要测距的点的经纬度坐标；需传入两个或更多的点。
     *     两个点之间用 “; ”进行分割开，单个点的经纬度用“,”分隔开；
     *     例如： waypoints=118.77147503233,32.054128923368;116.3521416286, 39.965780080447;116.28215586757,39.965780080447
     *
     * Can set [[coord_type]], so $queryParams is array
     * @param  string|array $queryParams
     * @return mixed
     */
    public function get($queryParams)
    {
        $params = [];
        if (!isset($queryParams['coord_type'])) {
            $params['coord_type'] = 'bd09ll';
        }
        if (is_string($queryParams)) {
            $params['waypoints'] = $queryParams;
        } else {
            $params = array_merge($params, $queryParams);
        }
        //must return json.
        $params['output'] = 'json';

        return $this->fetch($this->address . http_build_query($params));
    }

    /**
     * @inheritdoc
     */
    protected function _parseResponse($result)
    {
        $result = json_decode($result, true);
        if ('Success' == $result['status']) {
            return [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => $result['results']
            ];
        }
        return ['errcode' => 1, 'errmsg' => $result['status']];
    }
}
