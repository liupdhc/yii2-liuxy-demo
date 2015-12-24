<?php
/**
 * FileName: NodeBalanceHelper.php
 * Author: liupeng
 * Date: 10/9/15
 */

namespace modules\components\helpers;

/**
 * 负载均衡算法工具类
 * Class NodeBalanceHelper
 * @package modules\components\helpers
 */
class NodeBalanceHelper {

    /**
     * 根据权重返回节点
     * @param $data 数据格式：[['weight'=>1,...].['weight'=>2,...]]
     */
    public static function getByWeight($data) {
        if ($data == null || count ( $data ) == 0) {
            return null;
        }
        $weight = 0;
        $tempdata = [ ];
        foreach ( $data as $one ) {
            if (is_array($one)) {
                if (! isset ( $one ['weight'] )) {
                    return $data [0];
                }
                $weight += $one ['weight'];
                for($i = 0; $i < $one ['weight']; $i ++) {
                    $tempdata [] = $one;
                }
            } else {
                $tempdata [] = $one;
            }
        }
        $use = rand ( 0, $weight - 1 );
        return $tempdata [$use];
    }
}