<?php
include '../common/servers.php';
include S_ROOT.'class/class_db_factory.php';
$db = DbFactory::getInstance()->getDB();

$today = date('Y-m-d',strtotime('-1 days'));
$active = isset($_REQUEST['action']) ? trim($_REQUEST['action']).'Action' : '';
$level = isset($_REQUEST['level']) ? $_REQUEST['level'] : 1;
$start_date = isset($_REQUEST['start_date']) && !empty($_REQUEST['start_date']) ? $_REQUEST['start_date'] : date("Y-m-d", strtotime("$today -1 months"));
$end_date = isset($_REQUEST['end_date']) && !empty($_REQUEST['end_date']) ? $_REQUEST['end_date'] : $today;
$shop_id = isset($_REQUEST['shop_id']) && !empty($_REQUEST['shop_id']) ? $_REQUEST['shop_id'] : 0;
echo $active();


//管理员列表
function initAdminAction() {
    global $db;
	global $level;
    $sql = "select id, name, level from admin where level <= {$level} order by level desc";
    $result = $db->getData($sql);
    $ret = array("aaData"=>array());
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                $row['id'],
                $row['name'],
                $row['level'],
				''
            ));
        }
    }
    return json_encode($ret);
}
//取消关注用户信息
function unFollwAction($req) {
	$lifedb = DbFactory::getInstance()->getLifeDB();
    global $db;
	global $start_date;
	global $end_date;
	$start_date = substr(date('Y-m-d',strtotime($start_date)),0,11);
	$end_date = substr(date('Y-m-d',strtotime("$end_date +1 day")),0,11);
    $sql = "select user_id, wx_id, user_name, nick,unsubscribe_time from tbl_user where unsubscribe_time between '{$start_date}' and '{$end_date}' and app_id =104 order by unsubscribe_time desc";
    $result_count = $db->getData($sql);//api_log_array($result_count);
	$sql = "select user_id, wx_id, user_name, nick,unsubscribe_time from tbl_user where unsubscribe_time between '{$start_date}' and '{$end_date}' and app_id =104 order by unsubscribe_time desc limit {$_REQUEST['iDisplayStart']}, {$_REQUEST['iDisplayLength']}";
	$result = $db->getData($sql);
	$user_id = array();
	foreach ($result as $key => $value) {
		if (!in_array($value['user_id'],$user_id)) {
			$user_id[] = $value['user_id'];
		}
	}
	$ids = implode(',',$user_id);
	//取消关注的user_id 去查对应的shop_name 
	$sql = "select b.name,a.user_id from followers a,shop b where b.id=a.shop_id and a.user_id in ($ids)";api_log($sql);
	$data = $lifedb->getData($sql);
	$shop_name = array();
	foreach($data as $item) {
		$shop_name[$item['user_id']] .= $item['name'].'<br>';
	}
	foreach ($result as $key => $item) {
		$exist = array_key_exists($item['user_id'], $shop_name);
		$result[$key]['shop_name'] = $exist ? $shop_name[$item['user_id']] : '';
	}
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
                $row['user_id'],
                $row['wx_id'],
                $row['user_name'],
				$row['nick'],
				$row['unsubscribe_time'],
				$row['shop_name']
            ));
        }
    }
    return json_encode($ret);
}

//pv uv统计
function statisticsAction($req){

	global $db;
	global $start_date;
	global $end_date;
	$sql = "select sum(amount_pv) amount_pv,sum(amount_uv) amount_uv, type from tbl_step_statistics where app_id=104 and date between '{$start_date}' and '{$end_date}' group by type";
	$result = $db->getData($sql);
	foreach ($result as $v) {
		$amount[] = $v['amount_pv'];
	}
	$ret =  array("aaData"=>array());
    if (false != $result) {
        foreach($result as $row) {
            array_push($ret['aaData'], array(
                (int)$row['type'],
                $row['amount_pv'],
				$row['amount_uv'],
				$row['amount_pv']/array_sum($amount)
            ));
        }
    }
    return json_encode($ret);

}
//主路径流程展示
function PathAction() {
    global $db;
	global $start_date;
	global $end_date;
	$sql_shop = "select sum(amount_uv) amount_uv from tbl_step_statistics where app_id=104 and date between '{$start_date}' and '{$end_date}' group by type";
	$result = $db->getData($sql_shop);

    $ret = array("aaData"=>array());
	if (!empty($result)){
		foreach ($result as $v) {
			$amount[] = $v['amount_uv'];
		}
		array_push($ret['aaData'], array(
			0,
			array_sum($amount),
			$result[7]['amount_uv'],
			$result[9]['amount_uv'],
			$result[10]['amount_uv'],
			$result[12]['amount_uv']
		));
	}
    return json_encode($ret);
}
//
function ClientAction() {

	global $db;
	global $shop_id;
    $sql = "select app_id, version, launch_time,count(b.id) count from tbl_staff a,tbl_staff_launch b where a.staff_id = b.staff_id  and a.shop_id= {$shop_id} group by app_id,version order by b.date desc";
    $result_count = $db->getData($sql);api_log_array($sql);
	$sql = "select app_id, version, launch_time,count(b.id) count  from tbl_staff a,tbl_staff_launch b where a.staff_id = b.staff_id  and a.shop_id= {$shop_id} group by app_id,version order by b.date desc limit {$_REQUEST['iDisplayStart']}, {$_REQUEST['iDisplayLength']}";
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
    return json_encode($ret);
}

function ClientDetailAction() {
	global $db;
    $sql = "select staff_id,app_id, version, launch_time from tbl_staff_launch where staff_id = {$_REQUEST['sSearch']} order by date desc";
    $result_count = $db->getData($sql);//api_log_array($sql);
	$sql = "select staff_id,app_id, version, launch_time from tbl_staff_launch where staff_id = {$_REQUEST['sSearch']} order by date desc limit {$_REQUEST['iDisplayStart']}, {$_REQUEST['iDisplayLength']}";
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
				$row['staff_id'],
                $row['app_id'],
                $row['version'],
                $row['launch_time']
            ));
        }
    }
    return json_encode($ret);
}

