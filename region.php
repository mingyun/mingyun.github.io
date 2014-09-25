<?php

function getShopRegionAction(){
	global $db;
	$conditions = array();
	api_log_array($_POST);
	// 过滤城市
	if (isset($_POST['city']) && $_POST['city'] != -1) {
	    $result = $db->getData("select name from city where id = ".$_POST['city']);
	    if ($result != false) {
	        $city_name = $result[0]['name'];
	        array_push($conditions, "city_id = ".$_POST['city']);
	    }
	    
	}
	
	if (isset($_POST['area']) && $_POST['area'] != -1) {
	    $result = $db->getData("select name from area where id = ".$_POST['area']);
	    if ($result != false) {
	        $area_name = $result[0]['name'];
	        array_push($conditions, "area_id = ".$_POST['area']);
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
	
	
    $sql = "select longitude, latitude, name, phone from shop $where $date_start_end";
    api_log($sql);
    $shop_region = $db->getData($sql);
    $return = array();
    if (false != $shop_region) {
        $return['code'] = 0;
        $return['data'] = $shop_region;
      //  api_log_array($return);
    } else {
        $return['code'] = 1;
    }
    return  json_encode($return);
}

// 获取用户和店铺分布
function getShopAndUser($req) {
    $db = DbFactory::getInstance()->getLifeDB();
	define('RADIUS', 800);
    $conditions_shop = array();
    $conditions_user = array();
    // 过滤城市
    if (isset($req['city']) && $req['city'] != -1) {
        $result = $db->getData("select name from city where id = ".$req['city']);
        if ($result != false) {
            $city_name = $result[0]['name'];
            array_push($conditions_shop, "city_id = ".$req['city']);
            array_push($conditions_user, "city like '%$city_name%'");
        }
    }
    if (isset($req['area']) && $req['area'] != -1) {
        $result = $db->getData("select name from area where id = ".$req['area']);
        if ($result != false) {
            $area_name = $result[0]['name'];
            array_push($conditions_shop, "area_id = ".$req['area']);
            array_push($conditions_user, "zone like '%$area_name%'");
        }
    }
    
    $where_shop = '';
    if (!empty($conditions_shop)) {
        $where_shop = 'where '.join(' and ', $conditions_shop);
    }
    api_log($where_shop);
    $where_user = '';
    if (!empty($conditions_user)) {
        $where_user = 'where '.join(' and ', $conditions_user);
    }
     api_log($where_user);
    $date_start_end = '';
    $link = '';
    if (isset($req['date_start']) && !empty($req['date_start']) && isset($req['date_end']) && !empty($req['date_end'])) {
        $start = strtotime($req['date_start']);
        $end = strtotime($req['date_end']);
        if (!empty($conditions_shop) && !empty($conditions_user)) {
            $link = "and";
        }
        $date_start_end = " $link created between $start and $end ";
    }
    
    
    $sql_shop = "select longitude, latitude, name, phone from shop $where_shop $date_start_end";
    api_log($sql_shop);
    $shop_region = $db->getData($sql_shop);
    api_log(count($shop_region));
    $sql_user = "select longitude, latitude, user_name from user $where_user $date_start_end";
    api_log($sql_user);
    $user_region = $db->getData($sql_user);
    api_log(count($user_region));
    $result = array();
	if (false != $user_region && false != $shop_region) {
		foreach($shop_region as $key_shop => $value_shop) {
			foreach ($user_region as $key_user => $value_user) {
				$distance = getDistance($value_shop['longitude'], $value_shop['latitude'], $value_user['longitude'], $value_user['latitude']);
			//	api_log($distance);
			    if ($distance <= RADIUS) {
			    	if (isset($user_region[$key_user]['radius']) && $user_region[$key_user]['radius'] == 1) {
			    		continue;
			    	}
			    	$user_region[$key_user]['radius'] = 1;
			    } else {
			    	if (isset($user_region[$key_user]['radius']) && $user_region[$key_user]['radius'] == 1) {
			    		continue;
			    	}
			    	$user_region[$key_user]['radius'] = 0;
			    }	
			}
		}
		$result['code'] = 0;
		$result['radius'] = RADIUS;
		$result['shop'] = $shop_region;
		$result['user'] = $user_region;
	} else {
		$result['code'] = 1;
	}
	return  json_encode($result);
}


function getDistance($lng1, $lat1, $lng2, $lat2) {
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);
    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;
    $s = 2*asin(sqrt(pow(sin($a/2), 2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2), 2)))*6378.137;
    return $s * 1000;
}
