<?php

function getItemRank($param) {
	$db = DbFactory::getInstance()->getLifeDB();
	$total =  0;
	$limit = '';
	if (isset($param['iDisplayStart']) && isset($param['iDisplayLength']) && !empty($param['iDisplayLength'])) {
	    $limit = "limit {$param['iDisplayStart']},{$param['iDisplayLength']}";
	}
	
	$out = array(
	        "sEcho" => intval($param['sEcho']),
	        "iTotalRecords"=> 0,
	        "iTotalDisplayRecords"=> 0,
	        "aaData"=>array());
	include(S_ROOT.'common/filter_test.php');
	$forbidden = array_merge($forbidden_bj,$forbidden_sz);
	$phone_forbidden = implode(',',$forbidden);
	//根据电话号码查询出排除的用户ID
	$sql_filter = 'select id from user where phone in ('.$phone_forbidden.')';
	api_log($sql_filter);
	$ret_filter = $db->getData($sql_filter);
	$arr_filter = array();
	if (false != $ret_filter) {
		foreach ($ret_filter as $val) {
			$arr_filter[] = $val['id'];
		}
	}
	$arr_filter[] = 61;
	$user_forbidden = implode(',',$arr_filter);
	
	$condition_area = 'select id from area_items where 1=1 ';
	//查询出指定商圈商品
    if (isset($param['area_id']) && !empty($param['area_id']) && intval($param['area_id']) != -1) {
    	$condition_area .= 'and  area_id = '.$param['area_id'];
	} 
	
	//查询分类商品
	if (isset($param['category_id']) && !empty($param['category_id'])  && intval($param['category_id']) != -1) {
	    $condition_area .= ' and cat_id = '.$param['category_id'];
	}
	
	//查询热门商品
	if (isset($param['item_type'])  && intval($param['item_type']) != -1) {
	    $condition_area .= ' and item_type = '.$param['item_type'];
	}
	
	//查询需要统计时间段日期
	//$sql_period = "select from_unixtime(created, '%Y-%m-%d') as date  from orders where 1=1 ";
	//查询日期内
	$condition_order = '';
	if (isset($param['start_date']) && !empty($param['start_date']) && isset($param['end_date']) && !empty($param['end_date'])) {
		api_log($param['start_date']);
		api_log($param['end_date']);
		$start = strtotime($param['start_date']);
		$end = strtotime($param['end_date']);
	    $condition_order .= ' and created >= '.$start.' and created <= '.$end;
	    //$sql_period .= " and created > ".$start." and created < ".$end." group by date";
	} else {
		//$sql_period .= "  group by date";
	}
	
	//拼接查询每天时间段内的订单
	if (isset($param['start_period']) && isset($param['end_period']) && !empty($param['end_period'])) {
		/* api_log($_REQUEST['start_period']." : ".$_REQUEST['end_period']);
		$period_arr = array();
		$ret_period = $db->getData($sql_period);
		if (false != $ret_period) {
		    foreach ($ret_period as $val) {
		        $time = strtotime($val['date']);
		        $start_time = $time + 3600 * $_REQUEST['start_period'];
		        $end_time = $time + 3600 * $_REQUEST['end_period'];
		        $str_period = "(created > {$start_time} and created < {$end_time})";
		        $period_arr[] = $str_period;
		    }
		    //api_log("and ( ".implode(" or ", $period_arr)." )");
		    $condition_order = " and ( ".implode(" or ", $period_arr)." )"; */
		    $condition_order .= ' and from_unixtime(created, "%H") >= '.$param['start_period'].' and from_unixtime(created, "%H") <= '.$param['end_period'];
		//}
	}
	
	//排除测试用户订单商品
	$sql_total = 'select orders.id,area.sku_id from orders_items orders,area_items area where orders.order_id in (select id from orders where status > 5 and   user_id not in ('.$user_forbidden.') '.$condition_order.' )  and orders.order_id not in (select order_id id from orders_detail where phone in ('.$phone_forbidden.')) and orders.item_id = area.id  and orders.title  = area.title   and orders.item_id in ('.$condition_area.')  group by area.sku_id';
	
	api_log($sql_total);
	$ret = $db->getData($sql_total);
	if (false != $ret) {
		$total = count($ret);
	}
	
	$sql = 'select sum(orders.total) as total, orders.item_id, orders.title,  orders.pic_url,area.sku_id, cat.name from orders_items orders ,area_items area, category cat where orders.order_id in (select id from orders where status > 5 and  user_id not in ('.$user_forbidden.') '.$condition_order.' )   and orders.order_id not in (select order_id id from orders_detail where phone in ('.$phone_forbidden.'))  and orders.item_id = area.id  and orders.title  = area.title  and area.cat_id = cat.id and orders.item_id in ('.$condition_area.')   group by area.sku_id order by total desc '.$limit;
	api_log($sql);
	$query = $db->getData($sql);
	if (false != $query) {
		$i = $param['iDisplayStart'];
		foreach($query as $key => $val) {
			$query[$key]['rank'] = ++$i;
		}
	    $out['iTotalRecords'] = $total;
	    $out['iTotalDisplayRecords'] = $total;
	    $out['aaData'] = $query;
	}
	return $out;
}
