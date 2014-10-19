 
<?php
header('content-type:text/html;charset=utf-8');

/**
 * 无限分类 方式一
 * 字段 id path name
 * 通过添加父类到子类的路径的一个字符串来判断，数据库中常用，通过concat查询排序
 * 输出时通过排序得出结果
 */
$arr1 = array(
    array('id' => 1, 'path' => '0', 'name' => '中国'),
    array('id' => 2, 'path' => '0', 'name' => '美国'),
    array('id' => 3, 'path' => '0', 'name' => '英国'),
    array('id' => 4, 'path' => '0-1', 'name' => '北京市'),
    array('id' => 5, 'path' => '0-1', 'name' => '上海市'),
    array('id' => 6, 'path' => '0-1', 'name' => '天津市'),
    array('id' => 7, 'path' => '0-1-4', 'name' => '东城区'),
    array('id' => 8, 'path' => '0-1-4', 'name' => '西城区'),
    array('id' => 9, 'path' => '0-1-5', 'name' => '黄浦区'),
    array('id' => 10, 'path' => '0-1-5', 'name' => '普陀区'),
    array('id' => 11, 'path' => '0-1-5-9', 'name' => '南京西路'),
    array('id' => 12, 'path' => '0-1-5-9-11', 'name' => '人民公园'),
    array('id' => 13, 'path' => '0-1-5-10', 'name' => '真北路'),
    array('id' => 14, 'path' => '0-1-5-10-13', 'name' => '上海番茄研究院')
);

//主要合并path和id并排序，最后安装path长度加空格以便区分
function gettree1($arr) {
    foreach ($arr as $k => $v) {
        $arr[$k]['path'] = $arr[$k]['path'].'-'.$arr[$k]['id'];
    }
    usort($arr, 'gettree1_usort');
    return $arr;
}

function gettree1_usort($a, $b) {
    return strcmp($a['path'], $b['path']);
}

echo 'arr1:<br/>';
echo '<select>';

foreach (gettree1($arr1) as $k => $v) {
    echo '<option>'.str_repeat('&nbsp;&nbsp;&nbsp;', count(explode('-', $v['path']))-2).$v['name'].'</option>';
}
echo '</select>';

/**
 * 无限分类 方式二
 * 字段 id pid name
 * 通过递归转化树形数组
 * 可通过递归输出树形数组
 */
$arr2 = array(
    array('id' => 1, 'pid' => '0', 'name' => '中国'),
    array('id' => 2, 'pid' => '0', 'name' => '美国'),
    array('id' => 3, 'pid' => '0', 'name' => '英国'),
    array('id' => 4, 'pid' => '1', 'name' => '北京市'),
    array('id' => 5, 'pid' => '1', 'name' => '上海市'),
    array('id' => 6, 'pid' => '1', 'name' => '天津市'),
    array('id' => 7, 'pid' => '4', 'name' => '东城区'),
    array('id' => 8, 'pid' => '4', 'name' => '西城区'),
    array('id' => 9, 'pid' => '5', 'name' => '黄浦区'),
    array('id' => 10, 'pid' => '5', 'name' => '普陀区'),
    array('id' => 11, 'pid' => '9', 'name' => '南京西路'),
    array('id' => 12, 'pid' => '11', 'name' => '人民公园'),
    array('id' => 13, 'pid' => '10', 'name' => '真北路'),
    array('id' => 14, 'pid' => '13', 'name' => '上海番茄研究院')
);

//获得树形数组
function gettree2($arr, $pid = 0) {
    $tree = array();
    foreach ($arr as $k => $v) {
        if ($v['pid'] == $pid) {
            $tree[] = $v;
        }
    }
    if (empty($tree)) {
        return null;
    }
    foreach ($tree as $k => $v) {
        $tree[$k]['son'] = gettree2($arr, $v['id']);
    }
    return $tree;
}
echo '<pre>';
print_r(gettree2($arr2));
echo '<br/>arr2:<br/>';
echo '<select>';
inputtree(gettree2($arr2));
echo '</select>';

/**
 * 无限分类 方式三
 * 字段 id pid name
 * 非递归通过引用传值转化树形数组，此种情况pid必须与子数组索引有对应关系，才可以使用，一般不使用
 * 可通过递归输出树形数组
 */
$arr3 = array(
    array('id' => 1, 'pid' => '0', 'name' => '中国'),
    array('id' => 2, 'pid' => '0', 'name' => '美国'),
    array('id' => 3, 'pid' => '0', 'name' => '英国'),
    array('id' => 4, 'pid' => '1', 'name' => '北京市'),
    array('id' => 5, 'pid' => '1', 'name' => '上海市'),
    array('id' => 6, 'pid' => '1', 'name' => '天津市'),
    array('id' => 7, 'pid' => '4', 'name' => '东城区'),
    array('id' => 8, 'pid' => '4', 'name' => '西城区'),
    array('id' => 9, 'pid' => '5', 'name' => '黄浦区'),
    array('id' => 10, 'pid' => '5', 'name' => '普陀区'),
    array('id' => 11, 'pid' => '9', 'name' => '南京西路'),
    array('id' => 12, 'pid' => '11', 'name' => '人民公园'),
    array('id' => 13, 'pid' => '10', 'name' => '真北路'),
    array('id' => 14, 'pid' => '13', 'name' => '上海番茄研究院')
);

//获得树形数组
function gettree3($items, $pid = 0) {
    $r = array();
    foreach ($items as $k => $item) {
        if ($item['pid'] == $pid) {
            $r[] = &$items[$k];
        } else {
            $items[$item['pid']-1]['son'][] = &$items[$k]; //可根据关系修改[$item['pid']-1]
        }
    }
    return isset($r) ? $r : array();
}

echo '<br/>arr3:<br/>';
echo '<select>';
inputtree(gettree3($arr3));
echo '</select>';


/**
 * 输出树形数组 字段 id pid name
 * @param $arr array 要输出的数组
 * @param $num int 输出文字前的空格倍数
 */
function inputtree($arr, $num = 0) {
    static $i;
    $i = $num;
    foreach ($arr as $v) {
        if (isset($v['son'])) {
            echo '<option>'.str_repeat('&nbsp;&nbsp;&nbsp;', $i++).$v['name'].'</option>';
            inputtree($v['son'], $i);
        } else {
            echo '<option>'.str_repeat('&nbsp;&nbsp;&nbsp;', $i).$v['name'].'</option>';
        }
    }
    $i--;
}


?>
//该片段来自于http://www.codesnippet.cn/detail/111020136344.html
