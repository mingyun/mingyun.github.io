<?php

// 获取分类列表
function getCategory() {
    $db = DbFactory::getInstance()->getLifeDB();
    $cats_main = $db->getData("select * from category");
    $cats_test = array();
	//一级分类
    foreach ($cats_main as $val_main) {
	    if ($val_main['parent_id'] == 0) {
	        $sub_arr = array();
	        $cats_test[$val_main['id']]['sub'] = $sub_arr;
	        $cats_test[$val_main['id']]['name'] = $val_main['name'];
	    }
	}
	//二级分类
	foreach($cats_main as $val_sub) {
	    if ($val_sub['parent_id'] != 0) {
	        $sub_arr_cate = array();
	        $cats_test[$val_sub['parent_id']]['sub'][$val_sub['id']] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$val_sub['name'];
	    }
	}
	$cate_result = array();
	foreach ($cats_test as $key_cate => $val_cate) {
	    $cate_result[$key_cate] = $cats_test[$key_cate]['name'];
	    if (!empty($cats_test[$key_cate]['sub'])) {
	        foreach ($cats_test[$key_cate]['sub'] as $key_sub => $val_sub) {
	            $cate_result[$key_sub] = $val_sub;
	        }
	    }
	}
	$return = array();
	$return['code'] = 1;
	if (false != $cate_result) {
		$return['code'] = 0;
		$return['cate_list'] = $cate_result;
	}
	return $return;
}
// 获取地区列表
function getAreaList() {
    $db = DbFactory::getInstance()->getLifeDB();
    $return = array();
	$return['code'] = 1;
    $sql = 'select id, name from area';
    $ret = $db->getData($sql);
    if (false != $ret) {
        $return['code'] = 0;
        $return['result'] = $ret;
    }
    return $return;
}