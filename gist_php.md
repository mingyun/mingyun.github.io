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
###中文正则表达式
```php
preg_match('/\p{Han}+/u', '中文正则表达式test',$match);
var_dump($match);//["中文正则表达式上"]
```
###多维数组相同key的value值累加
```php
function array_value_sum()
{
    $res = array();
    foreach (func_get_args() as $arr) {
        foreach ($arr as $k => $v){
            if (!isset($res[$k])){
                $res[$k] = $v;
            }else{
                $res[$k] += $v;
            }
        }
    }
    return $res;
}
$arr1 = array(311=>1, 312=>2, 314=>2);
$arr2 = array(311=>2, 312=>2, 313=>5, 314=>9);
$arr3 = array(314=>10);
$newArr = array_value_sum($arr1, $arr2, $arr3);
[
    311 => 3,
    312 => 4,
    314 => 21,
    313 => 5
]
````
###数组分割合并
```php
$arr = Array (
    'question_id' => Array ( 4, 4, 4, 4, 4),
    'result_branch' => Array (126, 130, 134 ,1232 ,128134),
    'text' => Array (3213,'qweq', 'wdas', 'd ','cxzc' )
);

$idNum = count($arr['question_id']);
$branchNum = count($arr['result_branch']);
$textNum = count($arr['text']);
$countMax = max([$idNum, $branchNum, $textNum]);
$result = array();
for($i=0; $i < $countMax ; $i++){
    $temp = array(
        'question_id' => isset($arr['question_id'][$i]) ? $arr['question_id'][$i] : '',
        'result_branch' =>  isset($arr['result_branch'][$i]) ? $arr['result_branch'][$i] : '',
        'text' =>  isset($arr['text'][$i]) ? $arr['text'][$i] : ''
    );
    $result[] = $temp;
}
 
print_r($result);
[
    [
        "question_id"   => 4,
        "result_branch" => 126,
        "text"          => 3213
    ],
    [
        "question_id"   => 4,
        "result_branch" => 130,
        "text"          => "qweq"
    ],
    [
        "question_id"   => 4,
        "result_branch" => 134,
        "text"          => "wdas"
    ],
    [
        "question_id"   => 4,
        "result_branch" => 1232,
        "text"          => "d "
    ],
    [
        "question_id"   => 4,
        "result_branch" => 128134,
        "text"          => "cxzc"
    ]
]
```
###大数处理
```php
function calc($m,$n,$x){
        $errors=array(
                '被除数不能为零',
                '负数没有平方根'
        );
        switch($x){
                case 'add':
                        $t=bcadd($m,$n);
                        break;
                case 'sub':
                        $t=bcsub($m,$n);
                        break;
                case 'mul':
                        $t=bcmul($m,$n);
                        break;
                case 'div':
                        if($n!=0){
                                $t=bcdiv($m,$n);
                        }else{
                                return $errors[0];
                        }
                        break;
                case 'pow':
                        $t=bcpow($m,$n);
                        break;
                case 'mod':
                        if($n!=0){
                                $t=bcmod($m,$n);
                        }else{
                                return $errors[0];
                        }
                        break;
                case 'sqrt':
                        if($m>=0){
                                $t=bcsqrt($m);
                        }else{
                                return $errors[1];
                        }
                        break;
        }
        $t=preg_replace("/\..*0+$/",'',$t);
        return $t;
}
echo calc('11111111111111111111111111111111110','10','add');//11111111111111111111111111111111120
```
###将邮箱前缀隐藏
```php
$str = '将邮箱前缀隐藏 test001@qq.com  test002@qq.com am test009@aa.com 最后一个邮箱 defse@ff.com';
$replace = "*";
echo preg_replace_callback('/([a-zA-Z0-9]*)@([a-zA-Z0-9]*\.com)/',
    function($matches) use ($replace){
        return str_repeat($replace,strlen($matches[1]))."@".$matches[2];
},$str);//将邮箱前缀隐藏 *******@qq.com  *******@qq.com am *******@aa.com 最后一个邮箱 *****@ff.com
```
###n个月后
```php
echo date('Y-m-d H:i:s',strtotime('- 1 month', strtotime('2016-05-31 23:59:59')));//2016-05-01 23:59:59
function n_month($n, $now = null)
{
    if ($now === null) {
        $now = time();
    }
    return date('Y-m-d H:i:s',strtotime("$n month", strtotime(date('Y-m-01 00:00:01', $now))));
}
```
###二维数组组合
```php
$myarr=[
    [
        "a1",
        "b1",
        "c1"
    ],
    [
        "a2",
        "b2",
        "c2"
    ],
    [
        "a3",
        "b3",
        "c3"
    ]
];
$arr = array_map(function($key) use($myarr) { 
    return array_column($myarr, $key);
}, array_keys($myarr[0]));
  print_r($arr);
  [
    [
        "a1",
        "a2",
        "a3"
    ],
    [
        "b1",
        "b2",
        "b3"
    ],
    [
        "c1",
        "c2",
        "c3"
    ]
]
```
###浮点数
```php
$a = 2.01;
var_dump(sprintf('%.20F', $a * 100));//string(24) "200.99999999999997157829"
var_dump( intval( $a * 100) );//int(200)
// float => int  之前先使用round

var_dump( intval( round($a * 100) ) );//int(201)
```
###获取拼音
```php
use \Overtrue\Pinyin\Pinyin;
//https://github.com/overtrue/pinyin
echo Pinyin::trans('带着希望去旅行，比到达终点更美好');
// dài zhe xī wàng qù lǔ xíng bǐ dào dá zhōng diǎn gèng měi hǎo

//获取首字母
echo Pinyin::letter('带着希望去旅行，比到达终点更美好');
// D Z X W Q L X B D D Z D G M H192.168.120.18
```
###获取地区层级
```php
$area = array(

    array('id'=>1,'name'=>'河南','parent'=>0),

    array('id'=>2,'name'=>'西湖区','parent'=>7),

    array('id'=>3,'name'=>'商水','parent'=>5),

    array('id'=>4,'name'=>'余杭区','parent'=>7),

    array('id'=>5,'name'=>'周口','parent'=>1),

    array('id'=>6,'name'=>'下城区','parent'=>7),

    array('id'=>7,'name'=>'杭州','parent'=>0),

    array('id'=>8,'name'=>'蒋村小区','parent'=>2)

    );
    function _tree($data,$id=0,$lev=0){
//  static属于静态变量。此函数调用几次，这个变量只初始化一次。http://secwhy.com/m/?post=242
  	static $arr = array();
  	foreach ($data as $value) {
  		 if ($value['parent'] == $id) {
  		 	$value['lev'] = $lev;
  		 	$arr[] = $value;  
  		 	_tree($data,$value['id'],$lev+1);
  		 }
  	}
  	return $arr;
  }
  
print_r(_tree($area,0));
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => 河南
            [parent] => 0
            [lev] => 0
        )

    [1] => Array
        (
            [id] => 5
            [name] => 周口
            [parent] => 1
            [lev] => 1
        )

    [2] => Array
        (
            [id] => 3
            [name] => 商水
            [parent] => 5
            [lev] => 2
        )

    [3] => Array
        (
            [id] => 7
            [name] => 杭州
            [parent] => 0
            [lev] => 0
        )

    [4] => Array
        (
            [id] => 2
            [name] => 西湖区
            [parent] => 7
            [lev] => 1
        )

    [5] => Array
        (
            [id] => 8
            [name] => 蒋村小区
            [parent] => 2
            [lev] => 2
        )

    [6] => Array
        (
            [id] => 4
            [name] => 余杭区
            [parent] => 7
            [lev] => 1
        )

    [7] => Array
        (
            [id] => 6
            [name] => 下城区
            [parent] => 7
            [lev] => 1
        )

)
```
###querystring转换json
```php
 var a='account.type=1&account.id=&account.dependFlag=0&account.card.companyId=1&account.name=%E4%B8%AD%E9%93%B6VISA%E5%8D%A1&account.hidden=&account.card.cardNo=&account.moneyTypeId=0&account.card.billDay=1&account.card.repayType=0&account.card.repayDay=20&account.card.alert=2&account.comment=%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
var root={};
a.split('&').sort().map(function(s){
    var p=root;
    s.match(/(.+?)(?:\.|=)/g).map(function(ss){
        var t=ss.slice(0,-1);
        p[t]=p[t]||((ss.slice(-1)==='=')?decodeURIComponent(s.match(/=(.*)$/)[1]):{});
        p=p[t];
    });
});

console.log(root);//{"account":{"card":{"alert":"2","billDay":"1","cardNo":"","companyId":"1","repayDay":"20","repayType":"0"},"comment":"===========","dependFlag":"0","hidden":"","id":"","moneyTypeId":"0","name":"中银VISA卡","type":"1"}}
```
###倒计时
```php
 var xhr = new XMLHttpRequest();
 // http://www.barretlee.com/blog/2013/04/13/cb-readyState_3_interactive/ XMLHttpRequest响应头部的Date来做倒计时
 xhr.open('get', 'testServer.txt', true); //这里的testServer.txt，其实我没有创建，完全可以不需要这个文件，我们只是要时间罢了
 xhr.onreadystatechange = function(){
     if(xhr.readyState == 3){ //状态3响应
      var header = xhr.getAllResponseHeaders(); //获得所有的头信息
      console.log(header);//会弹出一堆信息
      console.log(xhr.getResponseHeader('Date')); //弹出时间，那么可以利用获得的时间做倒计时程序了。
     }
 }
 xhr.send(null);
```
###下载文件
```php
function downloadFile(fileName, content){
    var aLink = document.createElement("a"),
        evt = document.createEvent("HTMLEvents");

    evt.initEvent("click");
    aLink.download = fileName;
    aLink.href = content;

    aLink.dispatchEvent(evt);
}
```
###数组中文排序
```php
 $array = array(
        array("新浪", 'x'),
        array("百度", 'b'),
        array("腾讯", 't')
    );
    //转换编码构造
     foreach ($array as $key => $item) {
         $sort_array[] = iconv("UTF-8", "GB2312", $item[0]);
     }
     array_multisort($sort_array, SORT_STRING, $array);
     print_r($array);
     Array
(
    [0] => Array
        (
            [0] => 百度
            [1] => b
        )

    [1] => Array
        (
            [0] => 腾讯
            [1] => t
        )

    [2] => Array
        (
            [0] => 新浪
            [1] => x
        )

)
```
###php模板
```php
echo strtr("{greeting}! My name is {author.name}.", array(
    '{greeting}' => 'Hi',
    '{author.name}' => 'hsfzxjy',
));//Hi! My name is hsfzxjy.
###根据time组合
```php
$a = [
	['time'=>'2015-11-01','draw'=>900],
	['time'=>'2015-11-02','draw'=>1900],
	['time'=>'2015-11-05','draw'=>9000],
	
];
$b = [
	['time'=>'2015-11-01','data'=>900],
	['time'=>'2015-11-03','data'=>800],
	['time'=>'2015-11-05','data'=>100],
	
];
// http://segmentfault.com/q/1010000004309677 http://www.tantengvip.com/2015/11/php-stdclass/
function setKeyByTime($arr) {
    $res = array();
    foreach($arr as $item) {
        $res[$item['time']] = $item;
    }
    return $res;
}
$c = array_merge_recursive( setKeyByTime($a), setKeyByTime($b) );
[
    "2015-11-01" => [
        "time" => [
            "2015-11-01",
            "2015-11-01"
        ],
        "draw" => 900,
        "data" => 900
    ],
    "2015-11-02" => [
        "time" => "2015-11-02",
        "draw" => 1900
    ],
    "2015-11-05" => [
        "time" => [
            "2015-11-05",
            "2015-11-05"
        ],
        "draw" => 9000,
        "data" => 100
    ],
    "2015-11-03" => [
        "time" => "2015-11-03",
        "data" => 800
    ]
]
```
###call_user_func
```php
class A
{
    public function __Construct($a,$b,$c)
    {
        echo 'Construct'.$a.$b.$c;
    }
 
    public function test($a,$b,$c)
    {
        echo ' test'.$a.$b.$c;
    }
}
 $class = new \ReflectionClass('A'); 
$methods = $class->getMethods(); 
print_r($methods);
// 获取每个 method 的注释
$class->getDocComment();
$a = new A(1,2,3);
$a->test(1,2,3);

call_user_func(['A','test'],1,2,3);
```
###搜索联想词
```php
https://laravist.com/article/36
class Suggest {
    
    const PREFIX = 'word:';
    const WORDS_PREFIX = 'word_scores';
    const RESULT_PREFIX = 'word_result';
    protected $redis = null;
    
    public function __construct($redis)
    {
        $this->redis = $redis;
    }
    
    public function add($word)
    {
        $len = mb_strlen($word, 'UTF-8');
        for ( $i = 1; $i <= $len; $i ++ ) {
            $sub = mb_substr($word, 0, $i, 'UTF-8');
            $this->redis->zAdd(self::PREFIX . $sub, 0, $word);
        }
    }
    
    public function incScore($word, $score = 1)
    {
        return $this->redis->zIncrBy(self::WORDS_PREFIX, $score, $word);
    }
    
    public function search($keyword, $stop = 5)
    {
        $this->redis->zInter(self::RESULT_PREFIX, array(self::PREFIX . $keyword, self::WORDS_PREFIX), array(1, 1));
        
        return $this->redis->zRevRange(self::RESULT_PREFIX, 0, $stop, true);
    }
} 
echo '<pre>';
// $redis = new redis();
// $redis->connect("127.0.0.1",6379);
$suggest = new  Suggest($redis);
$suggest->add('javascript');
$suggest->incScore('javascript');
print_r($suggest->search('s'));
// https://segmentfault.com/a/1190000004973921#articleHeader0
```
###redis频道订阅
```php
function f($redis, $chan, $msg) {  //频道订阅
    switch($chan) {
        case 'chan-1':
            echo $msg;
            break;

        case 'chan-2':
            echo $msg;
            break;

        case 'chan-2':
            echo $msg;
            break;
    }
}

 $redis->subscribe(array('chan-1', 'chan-2', 'chan-3'), 'f'); // subscribe to 3 chans

$redis->publish('chan-1', 'hello, world!'); // send message. 
```
###redis分页
```php
//limit不能用字符串 https://segmentfault.com/a/1190000004973921#articleHeader0
 print_r($redis->zrangebyscore('online',1,'+infinity',['withscores' => TRUE,'limit'=>[0,2]]));
print_r($redis->zrangebyscore('online',1,'+infinity',['withscores' => TRUE,'limit'=>[0,'2']]));
```
###批量操作pipeline
```php
//只是把多个redis指令一起发出去，redis并没有保证这些指定的执行是原子的
$replies = $redis->pipeline(function($pipe) {  
    $pipe->ping();
    $pipe->incrby('counter', 10); //增量操作  
    $pipe->incrby('counter', 30);  
    $pipe->exists('counter');  
    $pipe->get('counter');  
    $pipe->sMembers('skey1');  
});
print_r($replies);
$ret = $redis->multi()
    ->set('key1111', 'val1')
    ->get('key1111')
    ->set('key2222', 'val2')
    ->get('key2222')
    ->exec();


```
###redis zcount
```php
$redis->zAdd('zkey', 0, 'val0');
 $redis->zAdd('zkey', 2, 'val2');
 $redis->zAdd('zkey', 10, 'val10');
 $redis->zCount('zkey', 0, 3); 

 $redis->zAdd('zkey', 2.5, 'val2');
 echo $redis->zScore('zkey', 'val2'); /* 2.5 */
//zcount 统计一个索引区间的元素个数  
 echo $redis->zcount('zkey',3,5);//2  
echo $redis->zcount('zkey','(3',5); //'(3'表示索引值在3-5之间但不含3,同理也可以使用'(5'表示上限为5但不含5  
echo $redis->zRank('tkey', 'A');// 返回集合tkey中元素A的索引值 
$redis->zSize('tkey');  //返回存储在key对应的有序集合中的元素的个数
                      
```
###curl cookie模拟登陆访问
```php
function request($method, $url, $fields = array())
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_COOKIE, '_za=9940ad75-d123-421d-bba5-4e247da577a0;q_cl=e67');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		if ($method === 'POST')
		{
			curl_setopt($ch, CURLOPT_POST, true );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		}
		$result = curl_exec($ch);
		return $result;
	}
```
###删除当前目录文件
`array_map('unlink', glob('*'));`
###获取当前目录所有php文件
```php
$files=glob('./*.php');
$files = array_map('realpath', $files);
print_r($files);
```
###查看当前页面是否有重复id
```php
var tmpId = [];
var result = [];
$('*[id]').each(function() {
    if ($.inArray($(this).attr('id'), tmpId) == -1) {
        tmpId.push($(this).attr('id'));
    } else {
        result.push($(this).attr('id')); 
    }
}) 
if (result.length > 0) {
    console.log('重复的ID为:' + result.join(' || '));
} else {
    console.log('没有重复的ID');
}
```
###补全时间格式
`print  vsprintf ( "%04d-%02d-%02d" ,  explode ( '-' ,  '1988-8-1' ));  // 1988-08-01`
###5位数字ABCDE*4=EDCBA,这5个数字不重复
```php
for($i=12345; $i<25000; $i++){
if( $i*4==strrev($i) && count(array_unique(str_split($i)))==strlen($i) )
echo $i;
}


for($i=10000;$i<25000;$i++){
if(count(array_unique(str_split($i)))==count(str_split($i)) && $i*4==strrev($i)){
echo $i;
}
}

$num = range(12345,24999);
foreach ($num as $val){

$sum = strrev($val);
if($val*4 == $sum){
echo $val;
break;
}
}

$nums=ceil(98765/4);
for($i = 12345;$i<$nums;$i++){
    if($i*4 == strrev($i)){
       echo $i.'<br />';
     }
}
```
###字符串截取
```php
function words_limit( $str, $num, $append_str='' ){
$words = preg_split( '/[\s]+/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE );
 if( isset($words[$num][1]) ){
   $str = substr( $str, 0, $words[$num][1] ).$append_str;
 }
unset( $words, $num );
return trim( $str );
}
 
echo words_limit('阿里巴巴今晚纽交所IPO全程直播', 10,'...'); 
```
###对象转数组
```php
function object_to_array($obj)
{$arr =array();
    $arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($arr as $key => $val)
    {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}
$obj = new stdclass;
print_r(object_to_array($obj));
```
###根据键判断取数组差集
```php
function compr($a, $b) {
    $aVal = is_array($a) ? $a['last_name'] : $a;
    $bVal = is_array($b) ? $b['last_name'] : $b;
    return strcasecmp($aVal, $bVal);
}
$aEmployees = array(
    array('last_name'  => 'Smith',
            'first_name' => 'Joe',
            'phone'      => '555-1000'),
    array('last_name'  => 'Doe',
            'first_name' => 'John',
            'phone'      => '555-2000'),
    array('last_name'  => 'Flagg',
            'first_name' => 'Randall',
            'phone'      => '666-1000')
    );

$aNames = array('Doe', 'Smith', 'Johnson');
    
$result = array_udiff($aEmployees, $aNames, "compr");

print_r($result);
[
    2 => [
        "last_name"  => "Flagg",
        "first_name" => "Randall",
        "phone"      => "666-1000"
    ]
]
```
###获取图片尺寸
`list( $width ,  $height ,  $type ,  $attr ) =  getimagesize ( "base.jpg" );`
###当前日期前15天
`implode(',', range(date("d")-15,date("d")));`//5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
###匹配@和#
```php
$user_arr = array();
 $topic_arr = array();
formatChat('uyu@phpjs#python#', $user_arr, $topic_arr);
print_r($user_arr);
print_r($topic_arr);
function formatChat($content, &$user_arr, &$topic_arr)
    {
        preg_match_all("/\@[\x{4000e00}-\x{9fa5}'a-z'A-Z'0-9'_'-]+/u", $content, $user_arr);//@某人
        preg_match_all("/\#([^\#|.]+)\#/", $content, $topic_arr);
        return true;//#话题#
    }
```
###json格式化输出
```php
 $array = ['Joel', 23, true, ['red', 'blue']];
 echo json_encode($array, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
 {
    "0": "Joel",
    "1": 23,
    "2": true,
    "3": {
        "0": "red",
        "1": "blue"
    }
}
 $array = ['23452', 23452];

echo json_encode($array);
["23452",23452]

echo json_encode($array, JSON_NUMERIC_CHECK);
 [23452,23452]
$array = ["Singin' in Bahrain", "Charlie Wilson's War"];
echo json_encode($array, JSON_HEX_APOS);
 ["Singin\u0027 in Bahrain","Charlie Wilson\u0027s War"]
$array = ['filename' => 'example.txt', 'path' => '/full/path/to/file/'];

echo json_encode($array);
 {"filename":"example.txt","path":"\/full\/path\/to\/file"}

echo json_encode($array, JSON_UNESCAPED_SLASHES);
 {"filename":"example.txt","path":"/full/path/to/file"}
$array = [5.0, 5.5];
echo json_encode($array);
 [5,5.5]

echo json_encode($array, JSON_PRESERVE_ZERO_FRACTION);
 [5.0,5.5]

$jsonString = json_encode("{'Bad JSON':\xB1\x31}");

if (json_last_error() != JSON_ERROR_NONE) {
    printf("JSON Error: %s", json_last_error_msg());
}

```
###use && and || instead of and and or
```php

$e = false || true;// true.

$e = false or true;// false.

#It's because $e = false || true is evaluated as $e = (false || true) and

#$e = false or true is evaluated as ($e = false) or true

```
###json unicode转换
```php
if (!function_exists('codepoint_encode')) {
    function codepoint_encode($str) {
        return substr(json_encode($str), 1, -1);
    }
}

if (!function_exists('codepoint_decode')) {
    function codepoint_decode($str) {
        return json_decode(sprintf('"%s"', $str));
    }
}
http://stackoverflow.com/documentation/php/4472/unicode-support-in-php#t=201609060941458015713
echo "\nUse JSON encoding / decoding\n";
var_dump(codepoint_encode("我好"));
var_dump(codepoint_decode('\u6211\u597d'));
var_dump('\u6211\u597d');
```
