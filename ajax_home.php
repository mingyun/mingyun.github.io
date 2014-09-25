<?php

include '../common/servers.php';
include S_ROOT.'class/class_db_factory.php';

// 判断是否登陆
session_start();
if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
	echo '{"code": 1, "message": "请重新登录"}';
	die;
}
$active = isset($_POST['action']) ? trim($_POST['action']).'Action' : '';

api_log($active);

$today = date('Y-m-d',strtotime('-1 days'));
$start_date  = isset($_REQUEST['start_date']) && !empty($_REQUEST['start_date']) ? $_REQUEST['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
$end_date  = isset($_REQUEST['end_date']) && !empty($_REQUEST['end_date']) ? $_REQUEST['end_date'] : $today;
$hour = date('G');
//$date = isset($_REQUEST['date']) && !empty($_REQUEST['date']) ? $_REQUEST['date'] : $today;
//选择用户登录下单时间
$start_period  = isset($_REQUEST['start_period']) && !empty($_REQUEST['start_period']) ? $_REQUEST['start_period'] : $hour-1;
$end_period  = isset($_REQUEST['end_period']) && !empty($_REQUEST['end_period']) ? $_REQUEST['end_period'] : $hour;
echo $active();
function getDatesBetweenTwoDate($start,$end) {
    $dt_start = strtotime($start);
    $dt_end = strtotime($end);
    while ($dt_start <= $dt_end) {
		$date_arr[] = date('Y-m-d',$dt_start);
		$dt_start += 86400;
    }
	return $date_arr;
}

// 获取新增订单
function getNewOrdersAction() {
    global $start_date;
    global $end_date;
    $db = DbFactory::getInstance()->getDB();
    $result = array();
    api_log("select sum(order_count) count, date from tbl_user_record group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
    $data = $db->getData("select sum(order_count) count, date from tbl_user_record group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	//$data_count = $db->getData("select sum(order_success_count) count, date from tbl_user_record group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	//完成订单
	$data_count = $db->getData("select count(order_id) count, date from tbl_order where status in(3,4 ) group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
	$result['code'] = 0;
	$categories = array();
	$series = array();
	$date_arr = getDatesBetweenTwoDate($start_date, $end_date);
	if (!empty($date_arr)) {
		foreach ($date_arr as $val_date) {
			$categories[] = $val_date;
			if ( false !== $data ) {
				$i = 0;
				$len = count($data);
				foreach ($data as $key_user => $value_user) {
					$i++;
					if ($val_date == $value_user['date']) {
						$series[] = (int)$value_user['count'];
						break;
					} else if ($i == $len) {
						$series[] = 0;
					}
				}
			}
			if ( false !== $data_count ) {
				$i = 0;
				$len = count($data_count);
				foreach ($data_count as $key_user => $value_user) {
					$i++;
					if ($val_date == $value_user['date']) {
						$series_count[] = (int)$value_user['count'];
						break;
					} else if ($i == $len) {
						$series_count[] = 0;
					}
				}
			}
		}
		$result['data']['categories'] =  $categories;
		$result['data']['series'] = $series;
		$result['data']['series_count'] = $series_count;
		echo json_encode($result);
	} else {
		$result['code'] = 1;
		echo json_encode($result);
	}
}


// 获取新增用户
function getNewUsersAction() {
    global $start_date;
    global $end_date;
    $result = array();
	api_log("select sum(amount) count, date from tbl_user_summary group by date having date between '".$start_date."' and '".$end_date."'  order by date asc");
    $db = DbFactory::getInstance()->getDB();
    $data = $db->getData("select sum(amount) count, date from tbl_user_summary where type=1  group by date having date between '".$start_date."' and '".$end_date."'  order by date asc");
	$date_arr = getDatesBetweenTwoDate($start_date, $end_date);
	foreach($data as $k =>$v ){
		$new[$v['date']]=$v["count"];
	}
	$data =array();
	foreach($date_arr as $key =>$val ){
		$data[$key]['count'] = isset($new[$val]) ? $new[$val] : 0;
		$data[$key]['date']  = $val;
	}
	$newdata = $data;
	//按date排序
	usort($data, function($a, $b) {
		if($a['date'] == $b['date']) return 0;
		return $a['date'] > $b['date'] ? 1 : -1; 
	});

	$amount = 0;
	foreach($data as &$item) {
		$amount += $item['count'];
		$item['count'] = $amount;
	}
	unset($item);
	$count_data = $data;//总用户数
	$result['code'] = 0;
	$categories = array();
	$series = array();
	$series_count = array();
	
	if (!empty($date_arr)) {
		foreach ($date_arr as $val_date) {
			$categories[] = $val_date;
			if (false != $newdata) {
				$i = 0;
				$len = count($newdata);
				foreach ($newdata as $key_user => $value_user) {
					$i++;
					if ($val_date == $value_user['date']) {
						$series[] = (int)$value_user['count'];
						break;
					} else if ($i == $len) {
						$series[] = 0;
					}
					
				}
			} else {
				$series[] = 0;
			}
			if (false != $count_data) {
				$i = 0;
				$len = count($count_data);
				foreach ($count_data as $key_count => $value_count) {
					$max_count[] = $value_count['count'];
					$i++;
					if ($val_date == $value_count['date']) {
						$series_count[] = (int)$value_count['count'];
						break;
					}else if ($i == $len) {
						$series_count[] = 0;
					}
				}
			} else {
				$series_count[] = 0;
			}
		}
		$result['data']['categories'] = $categories;
		$result['data']['series'] = $series;
		$result['data']['series_count'] = $series_count;
		echo json_encode($result);
	} else {
		$result['code'] = 1;
		echo json_encode($result);
	}
}
 
//新增uv与活跃uv
function getSummaryAction() {
    global $start_date;
    global $end_date;
    $result = array();
    $db = DbFactory::getInstance()->getDB();
	$data = $db->getData("select sum(amount) count,date from tbl_user_summary  where type=1 group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
    $data_report = $db->getData("select sum(amount) count,date from tbl_user_summary  where type=3 group by date having date between '".$start_date."' and '".$end_date."' order by date asc");    
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
			if (false != $data_report) {
				$i = 0;
				$len = count($data_report);
				foreach ($data_report as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['date']) {
						$series_report[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series_report[] = 0;
					}
				}
			} else {
				$series_report[] = 0;
			}
		}
		$result['data']['categories'] =  $categories;
		$result['data']['series'] = $series;
		$result['data']['series_report'] = $series_report;
		echo json_encode($result);
	} else {
		$result['code'] = 1;
		echo json_encode($result);
    }
}
//用户时间段内登陆次数、下单次数与完成订单次数
function getBehaviorAction() {
    global $start_period;
    global $end_period;
	global $start_date;
	global $end_date;
    $result = array();
    $db = DbFactory::getInstance()->getDB();
	//api_log("select sum(amount) count ,time_period from tbl_user_behavior  where  date between '{$start_date}' and '{$end_date}'  and type=2 and amount>1 group by time_period,date");
    $data = $db->getData("select sum(amount) count ,time_period from tbl_user_behavior  where  date  between '{$start_date}' and '{$end_date}'  and type=1 group by time_period");//user_id in (select user_id from tbl_user_behavior where type=2 and amount>1) and
	$data_order = $db->getData("select sum(amount) count ,time_period from tbl_user_behavior  where  date between '{$start_date}' and '{$end_date}'  and type=2  group by time_period,date");
	$data_finish = $db->getData("select sum(amount) count ,time_period from tbl_user_behavior  where   date  between '{$start_date}' and '{$end_date}' and type=3  group by time_period");
	//api_log_array($data);api_log_array($data_order);api_log_array($data_finish);
	$data = getAmountByTime($data);
	$data_order = getAmountByTime($data_order);
	$data_finish = getAmountByTime($data_finish);
	$result['code'] = 0;
	$categories = array();
	$series = array();
	$series_order = array();
	$series_finish = array();
	$date_arr = range(0,23);
	if (!empty($date_arr)) {
		foreach ($date_arr as $key_date => $value_date) {
			$categories[] = $value_date;
			if (false != $data) {
				$i = 0;
				$len = count($data);
				foreach ($data as $key_report => $value_report) {
					$i++;
					if ($value_date == $value_report['time_period']) {
						$series[] = (int)$value_report['count'];
						break;
					} else if ($i == $len) {
						$series[] = 0;
					}
				}
			} else {
				$series[] = 0;
			}
			if (false != $data_order) {
				$i = 0;
				$len = count($data_order);
				foreach ($data_order as $key_order => $value_order) {
					$i++;
					if ($value_date == $value_order['time_period']) {
						$series_order[] = (int)$value_order['count'];
						break;
					} else if ($i == $len) {
						$series_order[] = 0;
					}
				}
			} else {
				$series_order[] = 0;
			}
			if (false != $data_finish) {
				$i = 0;
				$len = count($data_finish);
				foreach ($data_finish as $key_finish => $value_finish) {
					$i++;
					if ($value_date == $value_finish['time_period']) {
						$series_finish[] = (int)$value_finish['count'];
						break;
					} else if ($i == $len) {
						$series_finish[] = 0;
					}
				}
			} else {
				$series_finish[] = 0;
			}
		}
		$result['data']['categories'] =  $categories;
		$result['data']['series'] = $series;
		$result['data']['series_order'] = $series_order;
		$result['data']['series_finish'] = $series_finish;
		echo json_encode($result);
	} else {
		$result['code'] = 1;
		echo json_encode($result);
   }
}

//获取每日订单均价
function getAvgPriceOrderAction() {
	global $start_date;
	global $end_date;
	$db = DbFactory::getInstance()->getLifeDB();
	include(S_ROOT.'common/filter_test.php');
	$forbidden = array_merge($forbidden_bj,$forbidden_sz);
    $forbidden = implode(',',$forbidden);
    $forbidden_phone = implode(',',$forbidden_phone);
	$result = array();
	api_log("avgPrice:   select count(*) count,sum(total_price) sum,from_unixtime(created, '%Y-%m-%d') as date from torder where shop_id not in ({$forbidden}) and id not in (select order_id id from torder_detail where phone  in ({$forbidden_phone})) group by date having date between '".$start_date."' and '".$end_date."'  order by date asc");
	$data = $db->getData("select count(*) count,sum(total_price) sum,from_unixtime(created, '%Y-%m-%d') as date from torder where shop_id not in ({$forbidden}) and id not in (select order_id id from torder_detail where phone  in ({$forbidden_phone})) group by date having date between '".$start_date."' and '".$end_date."'  order by date asc");
	if (false != $data) {
	    $result['code'] = 0;
	    $categories = array();
	    $series = array();
	    $date_arr = getDatesBetweenTwoDate($start_date, $end_date);
	    if (!empty($date_arr)) {
	        foreach ($date_arr as $val_date) {
	            $i = 0;
	            $len = count($data);
	            foreach ($data as $key_user => $value_user) {
	                $i++;
	                if ($val_date == $value_user['date']) {
	                    $categories[] = $value_user['date'];
	                    $series[] = round(floatval($value_user['sum']) / (int)$value_user['count'], 2);
	                    break;
	                } else if ($i == $len) {
	                    $categories[] = $val_date;
	                    $series[] = 0;
	                }
	            }
	        }
	        $result['data']['categories'] =  $categories;
	        $result['data']['series'] = $series;
	        echo json_encode($result);
	    }
	     
	} else {
	    $result['code'] = 1;
	    echo json_encode($result);
	}
}

//获取理投诉
 function getReportAction() {
    global $start_date;
    global $end_date;
    $result = array();
    $db = DbFactory::getInstance()->getLifeDB();
    //未处理
    $data = $db->getData("select count(*) count,from_unixtime(created, '%Y-%m-%d') as date from report  where type = 0 and is_checked = 0 
            group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
    //已经处理
    $data_report = $db->getData("select count(*) count,from_unixtime(created, '%Y-%m-%d') as date from report  where type = 0 and is_checked <> 0
            group by date having date between '".$start_date."' and '".$end_date."' order by date asc");
    
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
                if (false != $data_report) {
                    $i = 0;
                    $len = count($data_report);
                    foreach ($data_report as $key_report => $value_report) {
                        $i++;
                        if ($value_date == $value_report['date']) {
                            $series_report[] = (int)$value_report['count'];
                            break;
                        } else if ($i == $len) {
                            $series_report[] = 0;
                        }
                    }
                } else {
                    $series_report[] = 0;
                }
            }
            $result['data']['categories'] =  $categories;
            $result['data']['series'] = $series;
            $result['data']['series_report'] = $series_report;
            echo json_encode($result);
        } else {
			$result['code'] = 1;
			echo json_encode($result);
       }
    
} 
//第一次关注后行为
function getOperateAction() {
    global $start_date;
    global $end_date;
    $result = array();
	$data = array();
    $db = DbFactory::getInstance()->getDB();
	$data_action = $db->getData("select count(id) count,type from tbl_first_action where type>0 group by type");
	foreach ($data_action as $k=>$v) {
		$data[$v['type']] = $v['count'];
	}
	$arr = array(1,2,3,4,5,6);
	foreach ($arr as $k=>$v) {
		$data[$v] = array_key_exists($v, $data) ? $data[$v] : 0;
	}
	if ($data != false) {
		$series = array(
			array("附近店铺",(int)$data[1]),
			array("我的订单", (int)$data[2]),
			array("帮助", (int)$data[3]),
			array("关于", (int)$data[4]),
			array("上传位置", (int)$data[5]),
			array("图文", (int)$data[6])
			);
		$result['code'] = 0;
		$result['data']['series'] = $series;
	}
	echo json_encode($result);
}
//获取2个时间段的amount
function getAmountByTime($data){
	$temp = array();
	foreach($data as $item) {
		list($n, $p) = array_values($item);
		$temp[$p] =  array_key_exists($p, $temp) ? $temp[$p]+$n : $n;
	}
	$arr = array();
	foreach($temp as $p => $n) {
		$arr[] = array('count'=>$n, 'time_period'=>$p);
	}
	return $arr;
}