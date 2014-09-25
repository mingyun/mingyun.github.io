<?php
include '../common/servers.php';
include S_ROOT.'class/class_db_factory.php';
$db = DbFactory::getInstance()->getLifeDB();


$active = isset($_REQUEST['action']) ? trim($_REQUEST['action']).'Action' : '';
echo $active();

function getUserRegionAction(){
	global $db;
	$conditions = array();
	api_log_array($_POST);
	// 过滤城市
	if (isset($_POST['city']) && $_POST['city'] != -1) {
	    $result = $db->getData("select name from city where id = ".$_POST['city']);
	    if ($result != false) {
	        $city_name = $result[0]['name'];
	        array_push($conditions, "city like '%$city_name%'");
	    }
	    
	}
	
	if (isset($_POST['area']) && $_POST['area'] != -1) {
	    $result = $db->getData("select name from area where id = ".$_POST['area']);
	    if ($result != false) {
	        $area_name = $result[0]['name'];
	        array_push($conditions, "zone like '%$area_name%'");
	    }
	}
	
	
	$where = '';
	if (!empty($conditions)) {
	    $where = 'where '.join(' and ', $conditions);
	}
	
	$date_start_end = '';
	$link = '';
	if (isset($_POST['date_start']) && !empty($_POST['date_start']) && isset($_POST['date_end']) && !empty($_POST['date_end'])) {
	    $start = strtotime($_POST['date_start']);
	    $end = strtotime($_POST['date_end']);
	    
	    if (!empty($conditions)) {
	        $link = "and";
	    }
	    $date_start_end = " $link created between $start and $end ";
	}
	
    $sql = "select longitude, latitude, user_name from user $where $date_start_end";
    api_log($sql);
    $user_region = $db->getData($sql);
    $return = array();
    if (false != $user_region) {
        $return['code'] = 0;
        $return['data'] = $user_region;
      //  api_log_array($return);
    } else {
        $return['code'] = 1;
    }
    return  json_encode($return);
}

