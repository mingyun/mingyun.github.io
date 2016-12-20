###对数字每隔4位空格分隔
```php
$str='111234562727727';
preg_replace('/(\d)(?=(?:\d{4})+$)/','$1 ',$str)#"111 2345 6272 7727"
preg_replace_callback('#[\d]{4}#',function($i){return $i[0].' ';},$str);
//js 
var str = '111234562727727';
str.replace(/[\s\S]{4}/g,function(match){
    return match + " ";
});
str.replace(/(\d)(?=(?:\d{4})+$)/g, '$1 ')
```
###根据平均数排序
```php
Array.prototype.sum=function(){
	var num=0;
	for(var i=0;i<this.length;i++){
	num+=this[i];
	}
	return num;
}
function vhall_sort(arr){
	arr.sort(function(a,b){
		return a.sum()/a.length-b.sum()/b.length;
})
}
arr = [[1,2],[5,1],[3,2]];
vhall_sort(arr);
console.log(arr);//[[1,2],[3,2],[5,1]]
```
###生成零点到23点时间
```php
function createHisRange($hisStart = '00:00:00', $hisEnd = '23:59:59', $range = 3600, $format = 'H:00:00')
{
    $t1 = strtotime($hisStart);
    $t2 = strtotime($hisEnd);
    $arrHis = array();
    while($t1 < $t2){
        $arrHis[] = date($format,$t1);
        $t1 += $range;
    }
    return $arrHis;
    }
>>> createhisrange()
=> [
       "00:00:00",
       "01:00:00",
       "02:00:00",
       "03:00:00",
       "04:00:00",
       "05:00:00",
       "06:00:00",
       "07:00:00",
       "08:00:00",
       "09:00:00",
       "10:00:00",
       "11:00:00",
       "12:00:00",
       "13:00:00",
       "14:00:00",
       "15:00:00",
       "16:00:00",
       "17:00:00",
       "18:00:00",
       "19:00:00",
       "20:00:00",
       "21:00:00",
       "22:00:00",
       "23:00:00"
   ]
```
###联表和子查询
```php
mysql> select id,(select sign from user_profile where user_id=users.id) s from users where id=13;
+----+------------------+
| id | s                |
+----+------------------+
| 13 | 面朝大海春暖花开 |
+----+------------------+
1 row in set (0.02 sec)

mysql> select a.id,b.sign from users a ,user_profile b where a.id=b.user_id and a.id=13;
+----+------------------+
| id | sign             |
+----+------------------+
| 13 | 面朝大海春暖花开 |
+----+------------------+
1 row in set (0.02 sec)
```

###redis分页
```php
$arr = $redis->zRevRange('msg:list',$pos,$pos+$limit-1);
$count = $redis->zSize('msg:list');
```
###翻转字符
```php
echo str_shuffle('str');
echo join('',array_reverse(preg_split('//u', 'redis数据库')));//库据数sider
```
###禁止国内访问
```php
$ip = $_SERVER['REMOTE_ADDR'];
$content = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
$banned = json_decode(trim($content), true);
$lan = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
if((!empty($banned['data']['country_id']) && $banned['data']['country_id'] == 'CN') || strstr($lan, 'zh'))
{
header('HTTP/1.0 404 Not Found');
echo 'HTTP/1.0 404 Not Found';
exit;
}
```
###判断数组是否包含另外一个数组元素
```php
$arr1 = array(1,2,3);
$arr2 = array(1,2,4,5,3);
$arr3 =array_intersect($arr1, $arr2);
print_r($arr3);

if ($arr1 == $arr3) {
	echo 'exists';
} else {
	echo 'not found';
}
$arr5 =array_diff($arr1, $arr3);
if (empty($arr5)) {
	echo 'exists';
} else {
	echo 'not found';
}
$xhs =array(array('111',' 李宁'),array('222','喜得龙'),array('333','安踏'));
$new_xhs=array(array('111',' 李宁'),array('22',' 李3宁'),array('555','富贵鸟'),array('333','安踏'));
function myCmp($a,$b){
    $_a = implode(',',(array)$a);
    $_b = implode(',',(array)$b);
    return strcmp($_a,$_b);
}
print_r(array_uintersect($xhs, $new_xhs,'myCmp'));
Array
(
    [0] => Array
        (
            [0] => 111
            [1] =>  李宁
        )

    [2] => Array
        (
            [0] => 333
            [1] => 安踏
        )

)


```
###按照权重随机
```php
$w = array('a' =>1, 'b'=>10, 'c'=>14, 'e'=>20, 'f'=>30, 'h'=>6, 'g'=>70);
function roll($weight)
{
    $sum = array_sum($weight);
    $j = 0;
    foreach($weight as $k=>$v)
    {
        $j = mt_rand(1,$sum);
        if($j <= $v)
        {
            return $k;
        }else{
            $sum -= $v;
        }
    }
}
$ret = array();
$n = 1000;
for($i=0;$i<$n;$i++)
{
    $v = roll($w);
    $ret[$v] = isset($ret[$v]) ? $ret[$v] + 1 :1;
}
print_r($ret);
Array
(
    [g] => 457
    [f] => 191
    [e] => 135
    [c] => 101
    [h] => 39
    [b] => 68
    [a] => 9
)
foreach($ret as $k=>$v)
{
     printf("real: %f\t", ($v / $n));
     printf("set: %f\n",($w[$k] / array_sum($w)));
}
```
###二维数组分页
```php

$arr_click = array(
array( 'clicks' => 3, 'clickDate' =>'2010-10-11' ),
array( 'clicks' => 2, 'clickDate' =>'2010-10-11' ),
array( 'clicks' => 3, 'clickDate' =>'2010-10-09' ),
array( 'clicks' => 1, 'clickDate' =>'2010-10-08' ),
);

$size=2;
$pages = ceil(count($arr_click) / $size);
if(is_numeric($_REQUEST['page']))
 {
  if($_REQUEST['page']<1){
   $page = 1;
  }elseif($_REQUEST['page']>$pages)
  {
   $page = $pages;
  }else{
  $page = $_REQUEST['page'];
   }
 }else{
  $page = 1;
 }
 //$page=2
$newarr = array_slice($arr_click, ($page-1)*$size, $size,true);

[
    [
        "clicks"    => 3,
        "clickDate" => "2010-10-09"
    ],
    [
        "clicks"    => 1,
        "clickDate" => "2010-10-08"
    ]
]
```

###相同period合并相加
```php
$arr2 = array(
    array('period'=>3,'num'=>5,'sum'=>5),
    array('period'=>3,'num'=>10,'sum'=>5),
    array('period'=>9,'num'=>15,'sum'=>15),
    array('period'=>9,'num'=>15,'sum'=>10)
);
$temp = array();
$temp2 = array();
foreach($arr2 as $item) {
    list($n, $p,$k) = array_values($item);
    if (array_key_exists($item['period'], $temp)) {
    	$temp[$n] = array($temp[$n][0]+$item['num'],$temp[$n][1]+$item['sum']);
    } else {
    	$temp[$n]  = array($item['num'],$item['sum']);
    }
    /*$a = array_key_exists($n, $temp) ? $temp[$n][0]+$p : $p;
    $b = array_key_exists($n, $temp) ? $temp[$n][1]+$k : $k;
    $temp[$n] =  $a;
    $temp2[$n] =  $b;
    $temp  =  array($n=>array($a,$b));*/
    // $temp[] =  array_key_exists($n, $temp) ? $temp[$n]+$k : $k;
}

$arr = array();
foreach($temp as $p => $n){
    $arr[] = array('num'=>$n[0], 'period'=>$p,'sum'=>$n[1]);
}

 
print_r($arr);
Array
(
    [0] => Array
        (
            [num] => 15
            [period] => 3
            [sum] => 10
        )

    [1] => Array
        (
            [num] => 30
            [period] => 9
            [sum] => 25
        )

)
```
###判断数组是否存在对应键值
```php
function check_array($array, $key, $value)
{
    $status = false;

    foreach ($array as $arr) {
        if ($arr[$key] === $value) {
            $status = true;
            break;
        } else {
            continue;
        }
    }
    
    return $status;
}
check_array([['id'=>1]],'id',1)#true
```
