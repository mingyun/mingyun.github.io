<?php
//客户端使用整体情况
function client($req) {
	$db = DbFactory::getInstance()->getDB();
	$count_sql = '';
	$result_sql = '';
	$today = date('Y-m-d',strtotime('-1 days'));
	$start_date = isset($req['start_date']) && !empty($req['start_date']) ? $req['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
	$end_date = isset($req['end_date']) && !empty($req['end_date']) ? $req['end_date'] : $today;
    $shop_id = $db->escape($req['shop_id']);
	$sql = "select app_id, version,count(id) count from tbl_staff_launch group by app_id,version order by launch_time desc";
	if (isset($req['shop_id']) && !empty($req['shop_id'])) {
    	$sql = "select app_id, version,count(id) count from tbl_staff_launch  where date between '{$start_date}' and '{$end_date}' and staff_id in (select distinct staff_id from tbl_staff where shop_id ={$shop_id}) group by app_id,version order by launch_time desc";
	}
	$result_sql =$sql." limit {$req['iDisplayStart']}, {$req['iDisplayLength']}";
	$result_count = $db->getData($sql);
	$result = $db->getData($result_sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                $row['app_id'],
                $row['version'],
                $row['count']
            ));
        }
    }
    return $ret;
}
// 客户端使用详情
function client_detail($req) {
	$db = DbFactory::getInstance()->getDB();
	$staff_id = trim($db->escape($req['sSearch']));
	$shop_id = trim($db->escape($req['shop_id']));
	$today = date('Y-m-d',strtotime('-1 days'));
	$start_date = isset($req['start_date']) && !empty($req['start_date']) ? $req['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
	$end_date = isset($req['end_date']) && !empty($req['end_date']) ? $req['end_date'] : $today;
	$sql = "select staff_id,app_id, version,launch_time from tbl_staff_launch order by launch_time desc";
	if (isset($req['shop_id']) && !empty($req['shop_id'])) {
    	$sql = "select staff_id,app_id,version,launch_time from tbl_staff_launch where date between '{$start_date}' and '{$end_date}' and  staff_id in(select distinct staff_id from tbl_staff where shop_id ={$shop_id}) order by launch_time desc";
	}
	if (is_numeric($staff_id)) {
    	$sql = "select staff_id,app_id, version,launch_time from tbl_staff_launch where staff_id ={$staff_id} order by launch_time desc";
	}
	//if (!empty($staff_id) && isset($req['shop_id']) && !empty($req['shop_id'])) {
    	//$sql = 'select b.staff_id,app_id, version,launch_time from tbl_staff a ,tbl_staff_launch b where a.staff_id=b.staff_id and shop_id ='.$db->escape($req['shop_id']). ' and b.staff_id ='.$staff_id.' order by launch_time desc';api_log($sql);
	//}
	$result_sql =$sql." limit {$req['iDisplayStart']}, {$req['iDisplayLength']}";
	$result_count = $db->getData($sql);
	$result = $db->getData($result_sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
				$row['staff_id'],
                $row['app_id'],
                $row['version'],
                $row['launch_time']
            ));
        }
    }
    return $ret;
}
// 获取店铺id，用于搜索
function fetch_shop($req){
	$db = DbFactory::getInstance()->getDB();
	//$db_life = DbFactory::getInstance()->getLifeDB();
	//$shop_sql = "select shop_id,name from shop";
	$table = isset($req['table']) && !empty($req['table']) ? $req['table'] : 'tbl_staff';
	$staff_sql = "select shop_id from {$table}";
	$ret = array();
	//$shop_result = $db_life->getData($shop_sql);
	$staff_result = $db->getData($staff_sql);
	/* 根据id查对应shop name
	if ($shop_result != false) {
		foreach ($shop_result as $value) {
			if (!in_array($value['shop_id'],$ret)) {
				$shop_ret[$value['shop_id']] = $value['name']; 
			}
		}
		foreach ($staff_result as $value) {
			if (!in_array($value['shop_id'],$ret)) {
				$staff_ret[] = $value['shop_id']; 
			}
		}
	}
	foreach ($shop_ret as $k=>$value) {
		if (array_key_exists($k,$staff_ret)) {
			$ret[$k] = $value; 
		}
	}*/
	if ($staff_result != false) {
		foreach ($staff_result as $value) {
			if (!in_array($value['shop_id'],$ret)) {
				$ret[] = $value['shop_id'];
			}
		}
	}
	return $ret;
}
// 测试账号
function test_account($req) {
	$db = DbFactory::getInstance()->getDB();
	$phone = $db->escape($req['sSearch']);
	$sql = "select *from tbl_test";
	if (!empty($phone)) {
    	$sql .= " where sign like '%{$phone}%'";
	}
    $count_sql =$sql." order by date desc";
	$result_sql =$sql." order by date desc limit {$req['iDisplayStart']}, {$req['iDisplayLength']}";api_log($count_sql);api_log($result_sql);
	$result_count = $db->getData($count_sql);
	$result = $db->getData($result_sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
				$row['type'],
                $row['sign'],
                $row['source_type'],
                $row['date'],
				'',
				$row['id']
            ));
        }
    }
    return $ret;
}
// 删除测试账号
function delete_account($req){
	$db = DbFactory::getInstance()->getDB();
	$id = $req['id'];
	$sql = "delete from tbl_test where id={$id}";api_log($sql);
	$ret = array();
	$ret['return'] = 1;
	if ($db->runSql($sql)){
		$ret['return'] = 0;
	}
	return $ret;
}
// 添加测试账号
function add_account($req){
	$db = DbFactory::getInstance()->getDB();
	$phone = $db->escape($req['phone']);
	$date = date('Y-m-d');
	$ret = array();
	$ret['return'] = 1;
	$sql = "select id from tbl_test where type=1 and sign=".$phone;
	$result = $db->getLine($sql);
	if ($result == false) {
		$sql = "insert into tbl_test(type,sign,date) values(1,{$phone},'{$date}')";
		api_log($sql);
		if ($db->runSql($sql)){
			$ret['return'] = 0;
		}
	}
	return $ret;
}
function avg_price($req) {
	$db = DbFactory::getInstance()->getLifeDB();
	$shop_id = isset($req['shop_id']) && !empty($req['shop_id']) ? $req['shop_id'] : 0;
    $sql = "select app_id, version, launch_time,count(b.id) count from tbl_staff a,tbl_staff_launch b where a.staff_id = b.staff_id  and a.shop_id= {$shop_id} group by app_id,version order by b.date desc";
    $result_count = $db->getData($sql);
	$sql = "select app_id, version, launch_time,count(b.id) count  from tbl_staff a,tbl_staff_launch b where a.staff_id = b.staff_id  and a.shop_id= {$shop_id} group by app_id,version order by b.date desc limit {$req['iDisplayStart']}, {$req['iDisplayLength']}";
	$result = $db->getData($sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$_REQUEST['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                $row['app_id'],
                $row['version'],
                $row['count']
            ));
        }
    }
    return $ret;
}

// 每日下单走势，每日完成订单走势，每日首次下单数走势
 function order($req) {
	$db = DbFactory::getInstance()->getDB();
    $today = date('Y-m-d',strtotime('-1 days'));
	$start_date  = isset($req['start_date']) && !empty($req['start_date']) ? $req['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
	$end_date  = isset($req['end_date']) && !empty($req['end_date']) ? $req['end_date'] : $today;
	// 默认查店铺id为3的数据
	$shop_id = isset($req['shop_id']) && !empty($req['shop_id']) ? $req['shop_id'] : 3;
    $result = array();
	//$order_sql = "select count(order_id) count, date from tbl_order  where status >= 0  group by date having date between '".$start_date."' and '".$end_date."' order by date asc";
    $data = $db->getData("select count(order_id) count, date from tbl_order  where shop_id = {$shop_id} group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$data_first = $db->getData("select count(order_id) count, date from tbl_order  where shop_id = {$shop_id} and is_first=1 group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$data_success = $db->getData("select count(order_id) count, date from tbl_order where shop_id = {$shop_id} and status in(3,4) group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$result['code'] = 0;
	$categories = array();
	$series = array();
	$series_report = array();
	$date_arr = getDatesBetweenTwoDate($start_date, $end_date);
	if (!empty($date_arr)) {
		foreach ($date_arr as $key_date => $value_date) {
			$categories[] = $value_date;
			if (false != $data) {
				$i = 0;
				$len = count($data);
				foreach ($data as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series[] = 0;
					}
				}
			} else {
				$series[] = 0;
			}
			if (false != $data_first) {
				$i = 0;
				$len = count($data_first);
				foreach ($data_first as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series_first[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series_first[] = 0;
					}
				}
			} else {
				$series_first[] = 0;
			}
			if (false != $data_success) {
				$i = 0;
				$len = count($data_success);
				foreach ($data_success as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series_success[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series_success[] = 0;
					}
				}
			} else {
				$series_success[] = 0;
			}
		}
			$result['data']['categories'] =  $categories;
			$result['data']['series'] = $series;
			$result['data']['series_first'] = $series_first;
			$result['data']['series_success'] = $series_success;
			return $result;
        } else {
			$result['code'] = 1;
			return $result;
       }
    
} 

// 每日新增关注数，每日首次下单数 首次下单 is_first=1 新用户 where user_id in (select user_id from tbl_shop_follow)
 function user($req) {
	$db = DbFactory::getInstance()->getDB();
    $today = date('Y-m-d',strtotime('-1 days'));
	$start_date  = isset($req['start_date']) && !empty($req['start_date']) ? $req['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
	$end_date  = isset($req['end_date']) && !empty($req['end_date']) ? $req['end_date'] : $today;
	// 默认查店铺id为3的数据
	$shop_id = isset($req['shop_id']) && !empty($req['shop_id']) ? $req['shop_id'] : 3;
    $result = array();
    $data = $db->getData("select count(distinct user_id) count, date from tbl_shop_follow  where shop_id = {$shop_id} group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$data_first = $db->getData("select count(order_id) count, date from tbl_order  where shop_id = {$shop_id} and is_first=1 group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$result['code'] = 0;
	$categories = array();
	$series = array();
	$series_report = array();
	$date_arr = getDatesBetweenTwoDate($start_date, $end_date);
	if (!empty($date_arr)) {
		foreach ($date_arr as $key_date => $value_date) {
			$categories[] = $value_date;
			if (false != $data) {
				$i = 0;
				$len = count($data);
				foreach ($data as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series[] = 0;
					}
				}
			} else {
				$series[] = 0;
			}
			if (false != $data_first) {
				$i = 0;
				$len = count($data_first);
				foreach ($data_first as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series_first[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series_first[] = 0;
					}
				}
			} else {
				$series_first[] = 0;
			}
		}
			$result['data']['categories'] =  $categories;
			$result['data']['series'] = $series;
			$result['data']['series_first'] = $series_first;
			return $result;
        } else {
			$result['code'] = 1;
			return $result;
       }
    
}
function getDatesBetweenTwoDate($start,$end) {
    $dt_start = strtotime($start);
    $dt_end = strtotime($end);
    while ($dt_start <= $dt_end) {
		$date_arr[] = date('Y-m-d',$dt_start);
		$dt_start += 86400;
    }
	return $date_arr;
}
// 商品外卖
function getItems($req){
	$db = DbFactory::getInstance()->getLifeDB();
	$count_sql = '';
	$result_sql = '';
	// 默认按销量排序
	$sort_num = $req['iSortCol_0'];
	$sort = $req['mDataProp_'.$sort_num];
	$sort_type = $req['sSortDir_0'];
	$sql_sort = "order by {$sort} {$sort_type}";
	if (isset($req['iDisplayStart']) && isset($req['iDisplayLength']) && !empty($req['iDisplayLength'])) {
	    $limit = "limit {$req['iDisplayStart']},{$req['iDisplayLength']}";
	}

	$condition = '';
	//查询店铺
    if (isset($req['shop']) && $req['shop'] !=-1) {
		 if (!is_numeric($req['shop'])) {
			$condition = " and b.shop_id in( select id from shop where name = '".$req['shop']."')";
		 } else {
			$condition = " and b.shop_id=".$req['shop'];
		 }
	}
	
	//查询分类商品
	if (isset($req['cat_id']) && $req['cat_id'] !=-1) {
		/*$cat_sql = "select parent_id from category where id =".$req['cat_id'];
		$result_cat = $db->getLine($cat_sql);api_log($cat_sql);
		if ($result_cat['parent_id'] == 0) {
			$condition .= ' and cat_id = '.$result_cat['parent_id'];
		} else {
			$condition .= ' and cat_id = '.$req['cat_id'];
		}*/
		$condition .= ' and top_cat_id = '.$req['cat_id'];
	}
	// 查询订单状态
	$torder = 'select id from torder where 1=1 ';
	if (isset($req['status']) && $req['status'] !=-1) {
	    $torder .= ' and status = '.$req['status'];
	}
	if (isset($req['start_date']) && !empty($req['start_date']) && isset($req['end_date']) && !empty($req['end_date'])) {
		$start_date = str_replace('T', ' ', $req['start_date']);
        $end_date = str_replace('T', ' ', $req['end_date']);
		$start = strtotime($start_date);
		$end = strtotime($end_date);
	    $torder .= ' and created >= '.$start.' and created <= '.$end;
	}
	if (isset($req['sSearch']) && !empty($req['sSearch'])) {
		$sql_search = "and (a.title like '%{$req['sSearch']}%' or b.bn like '%{$req['sSearch']}%') ";
	} else {
		$sql_search = '';
	}

	$sql_total = "select a.title,b.bn,a.price ,sum(a.buy_count) buy_count,sum(buy_count*a.price) total,cat_id from torder_item a,item b where a.item_id=b.id and a.price>0 {$condition} and order_id in (".$torder.") {$sql_search} group by item_id ";
	$sql = "select a.title,a.price ,item_id,sum(a.buy_count) buy_count,bn,sum(buy_count*a.price) total from torder_item a,item b where a.item_id=b.id and a.price>0 {$condition} and order_id in (".$torder.") {$sql_search} group by item_id {$sql_sort} ".$limit;
	api_log($sql_total);api_log($sql);
	$result_count = $db->getData($sql_total);
	$result = $db->getData($sql);
	foreach($result_count as $k => $v) {
		$cat_arr[] = $v['buy_count'];
		$total_arr[] = $v['total'];
	}
	$cat = array_sum($cat_arr);
	$num = array_sum($total_arr);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			'count'=>$row_count,
			'cat'=>$cat,
			'num'=>$num,
			"aaData"=>array()
		);
	if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                'title'=>$row['title'],
                'bn'=>$row['bn'],
                'price'=>$row['price'],
				'buy_count'=>$row['buy_count'],
				'total'=>$row['total'],
				'count'=>$cat,
				'cat'=>$row_count,
				'num'=>$num
            ));
        }
    }
    return $ret;
}


// 关注店铺用户
function getFollower($req){
	$db = DbFactory::getInstance()->getLifeDB();
	$count_sql = '';
	$result_sql = '';
	$limit = "limit {$req['iDisplayStart']},{$req['iDisplayLength']}";
	$condition = '';
	//查询店铺
    if (isset($req['shop']) && $req['shop'] !=-1) {
		if (!is_numeric($req['shop'])) {
			$condition = " and a.shop_id in( select id from shop where name = '".$req['shop']."')";
		 } else {
			$condition = " and a.shop_id=".$req['shop'];
		 }
	}
	
	if (isset($req['start_date']) && !empty($req['start_date']) && isset($req['end_date']) && !empty($req['end_date'])) {
		$start_date = str_replace('T', ' ', $req['start_date']);
        $end_date = str_replace('T', ' ', $req['end_date']);
		$start = strtotime($start_date);
		$end = strtotime($end_date);
	    $date = ' and lasttime >= '.$start.' and lasttime <= '.$end;
	}
	if (isset($req['sSearch']) && !empty($req['sSearch'])) {
		$sql_search = " and a.wx_id in (select wx_id from weixin where nick_name like '%{$req['sSearch']}%')";
	} else {
		$sql_search = '';
	}

	$sql_total = "select a.wx_id from followers a,shop b where a.shop_id=b.id   {$date} {$condition} {$sql_search}";
	$sql = "select a.wx_id ,lasttime,name from followers a,shop b where a.shop_id=b.id {$date} {$condition} {$sql_search} order by lasttime desc ".$limit;
	api_log($sql_total);api_log($sql);
	$result_count = $db->getData($sql_total);
	$result = $db->getData($sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                $row['wx_id'],
                $row['lasttime'],
                $row['name']
            ));
        }
    }api_log_array($result);
    return $ret;
}


// 下单用户
function getOrder($req){
	$db = DbFactory::getInstance()->getLifeDB();
	$count_sql = '';
	$result_sql = '';
	$sort_num = $req['iSortCol_0'];
	$sort = $req['mDataProp_'.$sort_num];
	$sort_type = $req['sSortDir_0'];
	$sql_sort = "order by {$sort} {$sort_type}";
	$limit = "limit {$req['iDisplayStart']},{$req['iDisplayLength']}";
	$condition = '';
	//查询店铺
    if (isset($req['shop']) && $req['shop'] !=-1) {
		if (!is_numeric($req['shop'])) {
			$condition = " and a.shop_id in( select id from shop where name = '".$req['shop']."')";
		 } else {
			$condition = " and a.shop_id=".$req['shop'];
		 }
	}
	
	if (isset($req['start_date']) && !empty($req['start_date']) && isset($req['end_date']) && !empty($req['end_date'])) {
		$start_date = str_replace('T', ' ', $req['start_date']);
        $end_date = str_replace('T', ' ', $req['end_date']);
		$start = strtotime($start_date);
		$end = strtotime($end_date);
	    $date = ' and a.created >= '.$start.' and a.created <= '.$end;
	}
	$sql_search = '';
	if (isset($req['sSearch']) && !empty($req['sSearch'])) {
		//$sql_search = " and (nick_name like '%{$req['sSearch']}%' or phone like '%{$req['sSearch']}%')";
		$sql_search = " and a.user_id in (select user_id from user_address where is_default=1 and (nick like '%{$req['sSearch']}%' or phone like '%{$req['sSearch']}%'))";
	}
	if (isset($req['status']) && $req['status'] !=-1) {
		$condition.= " and status={$req['status']}";
	}
	// 获取订单的地址
	$info_sql = "select user_id,nick,phone,address from user_address where is_default=1";
	$info = $db->getData($info_sql);
	$nick = $phone = $address = array();
	foreach($info as $v) {
		$nick[$v['user_id']] = $v['nick'];
		$phone[$v['user_id']] = $v['phone'];
		$address[$v['user_id']] = $v['address'];
	}
	$sql_total = "select a.user_id from torder a,user b where a.user_id=b.id {$date} {$condition} {$sql_search} group by a.user_id";
	$sql = "select a.user_id,nick_name,phone,city,count(a.id) count from torder a,user b where a.user_id=b.id {$date} {$condition} {$sql_search}  group by a.user_id {$sql_sort} ".$limit;
	api_log($sql_total);api_log($sql);
	$result_count = $db->getData($sql_total);
	$result = $db->getData($sql);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                'nick_name'=>$nick[$row['user_id']],
                'phone'=>$phone[$row['user_id']],
                'city'=>$address[$row['user_id']],
				'count'=>$row['count']
            ));
        }
    }
    return $ret;
}

// 分类商品排行 先查外卖商品属于哪个分类，然后对分类进行分组排序
function getCategory($req){
	$db = DbFactory::getInstance()->getLifeDB();
	$count_sql = '';
	$result_sql = '';
	$sort_num = $req['iSortCol_0'];
	$sort = $req['mDataProp_'.$sort_num];
	$sort_type = $req['sSortDir_0'];
	$sql_sort = "order by {$sort} {$sort_type}";
	if (isset($req['iDisplayStart']) && isset($req['iDisplayLength']) && !empty($req['iDisplayLength'])) {
	    $limit = "limit {$req['iDisplayStart']},{$req['iDisplayLength']}";
	}
	$condition = '';

	if (isset($req['cat_id']) && $req['cat_id'] !=-1) {
		$condition= " and top_cat_id={$req['cat_id']}";
	}
	$torder = 'select id from torder where 1=1 ';
	if (isset($req['status']) && $req['status'] !=-1) {
	    $torder .= ' and status = '.$req['status'];
	}
	if (isset($req['start_date']) && !empty($req['start_date']) && isset($req['end_date']) && !empty($req['end_date'])) {
		$start_date = str_replace('T', ' ', $req['start_date']);
        $end_date = str_replace('T', ' ', $req['end_date']);
		$start = strtotime($start_date);
		$end = strtotime($end_date);
	    $torder .= ' and created >= '.$start.' and created <= '.$end;
	}
	//查询商品
    if (isset($req['shop']) && !empty($req['shop'])) {
		if (!is_numeric($req['shop'])) {
			$torder .= " and shop_id in( select id from shop where name = '".$req['shop']."')";
		 } else {
			$torder .= " and shop_id=".$req['shop'];
		 }
	}
	$sql_search = '';
	if (isset($req['sSearch']) && !empty($req['sSearch'])) {
		$sql_search = " and top_cat_id = {$req['sSearch']}";//
	}
	$sql_total = "select top_cat_id,sum(a.buy_count) buy_count,sum(buy_count*a.price) total from torder_item a,item b where a.item_id=b.id and order_id in (".$torder.")  {$condition} {$sql_search} group by top_cat_id";
	$sql = "select top_cat_id,sum(a.buy_count) buy_count,sum(buy_count*a.price) total from torder_item a,item b where a.item_id=b.id and order_id in (".$torder.")  {$condition} {$sql_search} group by top_cat_id {$sql_sort} ".$limit;
	api_log($sql_total);api_log($sql);
	$result_count = $db->getData($sql_total);
	$result = $db->getData($sql);api_log_array($result);
	foreach($result_count as $k => $v) {
		$buy_arr[] = $v['buy_count'];
		$total_arr[] = $v['total'];
	}
	$buy = array_sum($buy_arr);
	$total = array_sum($total_arr);api_log($total);
	$row_count = !empty($result_count) ? count($result_count) : 0;
    $ret = array(
			'sEcho'=>(int)$req['sEcho'],
			"iTotalRecords"=>$row_count,
			"iTotalDisplayRecords"=>$row_count,
			"aaData"=>array()
		);
	if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                'cat_id'=>$row['top_cat_id'],
                'buy_count'=>$row['buy_count'],
                'total'=>$row['total'],
				'buy'=>$row['buy_count']/$buy,
				'amount'=>$row['total']/$total
            ));
        }
    }
    return $ret;
}

// 获取分类列表
function getCate() {
    $db = DbFactory::getInstance()->getLifeDB();
    $cate_result = $db->getData("select * from category");
	$return = array();
	$return['code'] = 1;
	if (false != $cate_result) {
		foreach ($cate_result as $k => $v) {
			$return['code'] = 0;
			$result[$v['id']] = $v['name'];
			$return['cate_list'] = $result;
		}
	}
	return $return;

}
// 获取店铺
function getShop() {
    $db = DbFactory::getInstance()->getLifeDB();
    $result = $db->getData("select id,name from shop");
	$return = array();
	$return['code'] = 1;
	if (false != $result) {
		foreach ($result as $k => $v) {
			$return['code'] = 0;
			$result[$v['id']] = $v['name'];
			$return['shop_list'] = $result;
		}
	}
	return $return;

}