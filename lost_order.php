<?php

function getAreaList($req){
    /*global $db;*/
    $db = DbFactory::getInstance()->getLifeDB();
    $result = array();
    $result['code'] = 1;
    $sql_area = "select id, name from area";
    $area_result = $db->getData($sql_area);
    if (false != $area_result) {
        $result['code'] = 0;
        $result['areaList'] = $area_result;
    }
    return json_encode($result);
}

function getOrderLostRate($req) {

    /*global $db;*/
    $db = DbFactory::getInstance()->getLifeDB();
    // api_log_array($req);
    $today = date('n');
    $start_date  = isset($req['data']['start_date']) && !empty($req['data']['start_date']) ? strtotime($req['data']['start_date']) : strtotime(date("Y-m-d", strtotime("$today -1 months")));
    $end_date  = isset($req['data']['end_date']) && !empty($req['data']['end_date']) ? strtotime($req['data']['end_date']." +1 days") : time();
    $result = array();
    $areaList = !empty($req['data']['area']) ? 'and s.area_id in ('.$req['data']['area'].')' : '';
    include S_ROOT.'common/filter_test.php';
    $forbidden = array_merge($forbidden_bj,$forbidden_sz);
    $sql_area = "select t.id order_id, t.status status, s.id shop_id, a.id area_id, a.name name, t.created created from torder t, shop s, area a, torder_detail td where t.shop_id = s.id and s.area_id = a.id and t.id = td.order_id and s.id not in (".implode(',',$forbidden).") and td.phone not in (".implode(',',$forbidden_phone).") $areaList and t.created < {$end_date} and t.created >= {$start_date}";
    $area_result = $db->getData($sql_area);

    $sql_sys = "select waiting_time from system";
    $sys_result = $db->getData($sql_sys);
    $waiting_time = $sys_result[0]['waiting_time'];
    $sum = count($area_result);

    $area = array();
    $series = array();
    if (false != $area_result) {
        foreach ($area_result as $value) {
            if (!isset($area[$value['area_id']])) {
                $lost = 0;
                if (intval($value['status']) == 99 || intval($value['status']) == 100 || (intval($value['status']) == 0 && time() - intval($value['created']) > $waiting_time)) {
                    $lost += 1;
                }
                $area[$value['area_id']] = array($value['name'], $lost, 1);
            } else {
                if (intval($value['status']) == 99 || intval($value['status']) == 100 || (intval($value['status']) == 0 && time() - intval($value['created']) > $waiting_time)) {
                    $area[$value['area_id']][1] = intval($area[$value['area_id']][1]) + 1;
                }
                $area[$value['area_id']][2] = intval($area[$value['area_id']][2]) + 1;
            }
        }
        $series = array(array("丢单总数:", 0, 0),array("完成订单总数:", 0, 0));
        $lost_order_num = 0;
        $finish_order_num = 0;
        $sum_order_num = 0;
        foreach($area as $key => $val) {
            $value  =  array_values($val);
            /*$value[0] = $value[0]."  订单总数为：".$value[2]."  订单丢失数为：".$value[1]."  占该区域比例为：".(round((float)$value[1]/$value[2],2) * 100)."%";
            $series[] = $value; */
            $lost_order_num +=  $value[1];
            $finish_order_num += $value[2];
        }
        $sum_order_num = $lost_order_num + $finish_order_num;
        $series[0][0] = $series[0][0].$lost_order_num."  订单总数:".$sum_order_num;
        $series[0][1] = $lost_order_num;
        
        $series[1][0] = $series[1][0].$finish_order_num."  订单总数:".$sum_order_num;
        $series[1][1] = $finish_order_num;
        // api_log_array($series);
        $result['code'] = 0;
        $result['data']['series'] = $series;
        echo json_encode($result);
    } else {
        $result['code'] = 1;
        echo json_encode($result);
    }
    
}