###jquery 
```php
<form id="formID">
    姓名 <input value="摘取天上星" name="Name" />
    职位 <input value="IT技术" name="position" />
        <input id="button" value="提交" type="button" />
</form>
// 返回json对象：{Name:'摘取天上星',position:'IT技术'}
function getFormJson(form) {
var o = {};
var a = $(form).serializeArray();
$.each(a, function () {
if (o[this.name] !== undefined) {
if (!o[this.name].push) {
o[this.name] = [o[this.name]];
}
o[this.name].push(this.value || '');
} else {
o[this.name] = this.value || '';
}
});
return o;
}
$.ajax({
   type: "POST",
   url:"ajax.php",
   data:getFormJson($("#formID")),//表单数据JSON格式的函数参数里填写表单的ID或要提交的表单
   dataType: 'json',
   success: function(msg) {alert(msg);},
   error: function(error){alert(error);}
});
```
###html字符转义
```php
//获取Html转义字符  
function htmlEncode( html ) {  
  return document.createElement( 'a' ).appendChild(   
         document.createTextNode( html ) ).parentNode.innerHTML;  
};  
//获取Html   
function htmlDecode( html ) {  
  var a = document.createElement( 'a' ); a.innerHTML = html;  
  return a.textContent;  
};  
htmlEncode('>')//"&gt;"
```
###ajax json
```php
$.getJSON('ajax/test.json', function(data) {
      var items = [];
     
      $.each(data, function(key, val) {
        items.push('<li id="' + key + '">' + val + '</li>');
      });
     
      $('<ul/>', {
        'class': 'my-new-list',
        html: items.join('')
      }).appendTo('body');
    });
```
###md5 == 判断
```php
var_dump(md5('240610708') == md5('QNKCDZO'));//bool(true)
var_dump(md5('aabg7XSs') == md5('aabC9RqS'));//bool(true)
var_dump(sha1('aaroZmOk') == sha1('aaK1STfY'));//bool(true)
var_dump(sha1('aaO8zKZF') == sha1('aa3OFF9m'));//bool(true)
var_dump('0010e2' == '1e3');//bool(true)
var_dump('0x1234Ab' == '1193131');//bool(false)
var_dump('0xABCdef' == ' 0xABCdef');//bool(false)
```
###... 运算符
```php
function test(...$args)
{
    print_r($args);
}

test(1,2,3);
```
###foreach list
```php
$array = [
    [1, 2],
    [3, 4],
];

foreach ($array as $key=>list($a, $b)) {
    echo $a.$b;echo '<br>';
}
```
###输出函数
```php
function dd()
    {
       array_map(function($x) { var_dump($x); }, func_get_args()); die;
    }
```
###post json
```php
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array($httpCode, $response);
}

$url = "http://www.example.com/postjson.php";
$jsonStr = json_encode(array('a' => "1", 'b' => "2", 'c' => "2"));
list($returnCode, $returnContent) = http_post_json($url, $jsonStr);
```
###获取调用类名
```php
class A
{
    function __construct()
    {
        echo get_class($this);
    }

    static function name()
    {
        echo get_called_class();
    }
}

class B extends A
{
}

$objB = new B(); // 输出 B
B::name();       // 输出 B
```
###运算符优先级
```php
$a = 3;
$b = 5;
if($a = 5 || $b = 7) {
    $a++;
    $b++;
}
echo $a . " " . $b;//1 6
if($a = 100 && $b = 200) {
    var_dump($a,$b);//true 200
}
```
###二维数组去掉重复值,并保留键值
```php
function array_unique_($array2D){
    foreach ($array2D as $k=>$v){
        $v=join(',',$v);  //降维
        $temp[$k]=$v;
    }
    $temp=array_unique($temp); //去掉重复的字符串,也就是重复的一维数组    
    foreach ($temp as $k => $v){
        $array=explode(',',$v); //再将拆开的数组重新组装
        //下面的索引根据自己的情况进行修改即可
        $temp2[$k]['id'] =$array[0];
        $temp2[$k]['title'] =$array[1];
        $temp2[$k]['keywords'] =$array[2];
        $temp2[$k]['content'] =$array[3];
    }
    return $temp2;
}
function array_unique_c($array2D,$keyArray){
        $temp=array();
        foreach ($array2D as $v){
            $v = join(",",$v);  //降维
            $temp[] = $v;
        }
        $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v){
            //$temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
           $temp[$k]= array_combine($keyArray ,explode(",",trim($v)));
        }
        return $temp;
    }
 
$testArray=array_unique_c(array(array('a'=>1,'b'=>2,'c'=>3),
    array('a'=>1,'b'=>2,'c'=>3),array('a'=>1,'b'=>5,'c'=>3)),array('a','b','c'));
print_r($testArray);
Array
(
    [0] => Array
        (
            [a] => 1
            [b] => 2
            [c] => 3
        )

    [2] => Array
        (
            [a] => 1
            [b] => 5
            [c] => 3
        )

)
```
###中文排序
```php
function utf8_array_asort(&$array) {
  if(!isset($array) || !is_array($array)) {
   return false;
  }
  foreach($array as $k=>$v) {
   $array[$k] = iconv('UTF-8', 'GBK//IGNORE',$v);
  }
  asort($array);
  foreach($array as $k=>$v) {
   $array[$k] = iconv('GBK', 'UTF-8//IGNORE', $v);
  }
  return true;
}
$abc = array('a'=>'猜', 'b'=>'我','c'=>'哦','d'=>'棍','e'=>'f','f'=>'爸','z'=>'州');
utf8_array_asort($abc);print_r($abc);
Array
(
    [e] => f
    [f] => 爸
    [a] => 猜
    [d] => 棍
    [c] => 哦
    [b] => 我
    [z] => 州
)

```
###static self
```php
class A {
    public static function get_self() {
        return new self();
    }

    public static function get_static() {
        return new static();
    }
}

class Bb extends A {}

echo get_class(Bb::get_self());  // A
echo get_class(Bb::get_static()); // B
echo get_class(A::get_static()); // A
```
###二维数组排序
```php
$sorted_array = array(array('ts'=>3,'gold'=>4),
            array('ts'=>8,'gold'=>10),
            array('ts'=>5,'gold'=>7),
            array('ts'=>1,'gold'=>20),
            array('ts'=>9,'gold'=>7),
            array('ts'=>3,'gold'=>7)
        );
print_r(sort_via_key($sorted_array, 'ts'));
function sort_via_key($data, $key)
{
    if(empty($data)) return array();
    $ret = array();
    $sorted_arr = array();
    foreach ($data as $i => $_item) 
    {
        $sorted_arr[$i] = $_item[$key];
    }
    arsort($sorted_arr);
    foreach ($sorted_arr as $i => $_item)
    {
        $ret[] = $data[$i];
    }
    return $ret;
}
function multi_compare($a, $b)
{
    $criteria = array(
        'gold'=>'desc',
        'ts'=>'desc'    //这里还可以根据需要继续加条件 如:'x'=>'asc'等
    );
    foreach($criteria as $what => $order){
        if($a[$what] == $b[$what]){
            continue;
        }
        return (($order == 'desc')?-1:1) * (($a[$what] < $b[$what]) ? -1 : 1);
    }
    return 0;
}
usort($sorted_array, "multi_compare");
print_r($sorted_array);
```
###console.log
```php
function console_log($data)
{
    if (is_array($data) || is_object($data))
    {
        echo("<script>console.log('".json_encode($data)."');</script>");
    }
    else
    {
        echo("<script>console.log('".$data."');</script>");
    }
}
```
###register_shutdown_function
```php
register_shutdown_function('my_shutdown');

function my_shutdown()
{
    echo Console_log::fetch_output();
}

class Console_log {
    private static $output = '';
    static function log($data)
    {
        if (is_array($data) || is_object($data))
        {
            $data = json_encode($data);
        }
        ob_start();
        ?>
        <?php if (self::$output === ''):?>
        <script>
        <?php endif;?>
        console.log('<?=$data;?>');
        <?php
        self::$output .= ob_get_contents();
        ob_end_clean();
    }
    static function fetch_output()
    {
        if (self::$output !== '')
        {
            self::$output .= '</script>';
        }
        return self::$output;
    }
}
```
###判断php数组是否索引数组
```php
function is_assoc($array) {  
    if(is_array($array)) {  
        $keys = array_keys($array);  
        return $keys != array_keys($keys);  
    }  
    return false;
}
```
###session_start
```php 
session_start();
$_SESSION['test'] = 'test';
session_write_close();//保存会话数据并释放文件锁
```
###当月第一天和最后一天
```php
echo  $date = date('Y-m-01 00:00:00',strtotime('this month'));

echo date('Y-m-d 23:59:59',strtotime($date.'+1 month -1 day')); 
```
### json_encode的时候不增加反斜杠
```php
echo str_replace('\\/', '/', json_encode("2011/7/11"));

// 如果php版本是5.4的话：

echo json_encode("2011/7/11", JSON_UNESCAPED_SLASHES);
```
###匿名函数
```php
$f = function () {
    return 100;
};

function testClosure(Closure $callback)
{
    return $callback();
}

$a = testClosure($f);
print_r($a);
// 调用一个类里面的匿名函数
class C {
    public static function testC() {
        return function($i) {
            return $i+100;
        };
    }
}

function testClosure2(Closure $callback)
{
    return $callback(13);
}

$a = testClosure2(C::testC());
print_r($a);
```
###bind
```php
class A {

    public $base = 100;

}

class B {

    private $base = 1000;
}

$f = function () {
    return $this->base + 3;
};


$a = Closure::bind($f, new A);
print_r($a());//103

echo PHP_EOL;

$b = Closure::bind($f, new B , 'B');
print_r($b());//1003
```
###fibonacci
```php
function fibonacci($n) {
    if ($n < 2) {
        return $n; 
    }
    return fibonacci($n - 1) + fibonacci($n - 2); 
}
 
var_dump(fibonacci(10));//55
```
###emoji
```php
$strEncode = '\uF09F\u9881\uF09F\u9884';
 
$length = mb_strlen($str,'utf-8');
 
for ($i=0; $i < $length; $i++) {
    $_tmpStr = mb_substr($str,$i,1,'utf-8');
    if(strlen($_tmpStr) == 4){
        $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
    }else{
        $strEncode .= $_tmpStr;
    }
}
 // \ud83c\udf32
echo $strEncode."\n";// 周梦康123~☺[[EMOJI:%F0%9F%98%81]][[EMOJI:%F0%9F%98%84]]
 $strEncode = '周梦康123~☺[[EMOJI:%F0%9F%98%81]][[EMOJI:%d8%3c%df%32]]';
//转码回去
$strDecode = preg_replace_callback("/\[\[EMOJI:(.*?)\]\]/", function($matches){
    return rawurldecode($matches[1]);
}, $strEncode);
 
echo $strDecode."\n";
```
###mysql 按in排序
```php
select * from tb_user where fid IN (10,33,22,76,13,44) order by FIND_IN_SET(fid,'10,33,22,76,13,44');

select * from tb_user where fid IN (10,33,22,76,13,44) order by field(fid,10,33,22,76,13,44);
```
###无限级联动下拉菜单
```php
<div><select id="demo16" name="demo16"></select></div>

          <input type ='submit' value='commit' id='go'>      
                <script src="http://linkagesel.xiaozhong.biz/js/comm.js"></script>
<script src="http://linkagesel.xiaozhong.biz/js/linkagesel-min.js"></script>
                <script>
                    $(document).ready(function(){
                        var data16 = {
                            1: {gid: 1, value: 'IBM', 
                                sub: { 
                                    10: {gid: 10, value: 'X3650'}, 
                                    11: {gid: 11, value: 'X3860'} 
                                }
                            },
                            3: {gid: 3, value: 'HP', 
                                sub: { 
                                    20: {gid: 20, value: '360'} ,
                                    21: {gid: 21, value: '380'}
                                }
                            },
                            9: {gid: 9, value: 'DELL', 
                                sub: { 
                                    29: {gid: 29, value: 'R710'} ,
                                    30: {gid: 30, value: 'R720'} 
                                }
                            }
                        };
                        var opts = {
                                data: data16,
                                select: "[name='demo16']",
                                dataReader: {id: 'gid', name: 'value', cell: 'sub'}
                        };
                        var ls16 = new LinkageSel(opts);
                        $('#go').click(function(){
                            console.log($('select').eq(1).val());
                        });
                    });
                    </script>
```
###去除bom
```php
function removeAllBOM($str="")
    {
        $tmpstr = $str; 
        while ((substr($tmpstr, 0,3) == pack("CCC",0xef,0xbb,0xbf)))
        {
            $tmpstr=substr($tmpstr, 3);
        }
        //return $tmpstr;
        ob_end_clean();
        ob_start();
        echo $tmpstr;
    }
```
###cors
```php
function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
// echo $_SERVER['REQUEST_METHOD'];echo $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'];
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";
}
cors();
```
###设置session过期时间
```php
function start_session($expire = 0) 
{ 
    if ($expire == 0) { 
        $expire = ini_get('session.gc_maxlifetime'); 
    } else { 
        ini_set('session.gc_maxlifetime', $expire); //Session数据在服务器端储存的时间
    } 
    if (!empty($_COOKIE['PHPSESSID'])) { 
        // session.cookie_lifetime这个代表SessionID在客户端Cookie储存的时间
        session_set_cookie_params($expire); 
        session_start(); 
    } else { 
        session_start(); 
        setcookie('PHPSESSID', session_id(), time() + $expire); 
    } 
} 
start_session(60);//600秒以后过期
```
###数组合并
```php
function array_multiToSingle($array,$clearRepeated=false){
    if(!isset($array)||!is_array($array)||empty($array)){
        return false;
    }
    if(!in_array($clearRepeated,array('true','false',''))){
        return false;
    }
    static $result_array=array();
    foreach($array as $value){
        if(is_array($value)){
            array_multiToSingle($value);
        }else{
            $result_array[]=$value;
        }
    }
    if($clearRepeated){
        $result_array=array_unique($result_array);
    }
    return $result_array;
}
$arr = array(array(1,2,3),array(3,4,5,6));
print_r(array_multiToSingle($arr,true));//
Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [4] => 4
    [5] => 5
    [6] => 6
)
```
###截取浮点数
```php
function getFloatValue($f,$len) 
{ 
  $tmpInt=intval($f); 

  $tmpDecimal=$f-$tmpInt; 
  $str="$tmpDecimal"; 
  $subStr=strstr($str,'.'); 
  if(strlen($subStr)<$len+1) 
 { 
  $repeatCount=$len+1-strlen($subStr); 
  $str=$str."".str_repeat("0",$repeatCount); 

 } 

  return    $tmpInt."".substr($str,1,1+$len); 

} 
echo getFloatValue(12.99,4).'<br>'; //12.9900 
echo getFloatValue(12.9232555553239,4).'<br>'; //12.9232 
```
###生成不重复的10个数
```php
$arr=array();
while(count($arr)<10)
{
    $arr[]=rand(1,10);
    $arr=array_unique($arr);//array_flip(array_flip($return));
}
echo implode(" ",$arr);
```
###删除数组元素
```php
 $data = array('admin',1,2,3,4,54);
array_splice($data,array_search('admin', $data),1);print_r($data);
if (in_array('admin', $data,true)) {
                $key = array_search('admin', $data);
                unset($data[$key]);
            }
print_r($data);
```
###自动执行
```php
call_user_func(function(){
        echo "hello,world";
}); 
$context="hello,world2";
call_user_func(function()use($context){echo $context;});


```
###根据key排序
```php
$data = array();  
$data[] = array("name" => "James");  
$data[] = array("name" => "andrew");  
$data[] = array("name" => "Fred");  

function cmp2($a, $b)  
{  
    return strcasecmp($a["name"], $b["name"]);  
}  

usort($data, "cmp2");  

print_r($data);
class myClass  
{  
    function getData()  
    {  
        $this -> changeOrder($data);
    }  

    function changeOrder(&$data)  
    {  
         // usort($data, "order_new");
         // usort($data, array($this, "order_new")); 
         // usort($data, array("myClass", "order_new")); 
    }

    function order_new($a, $b)  
    {  
        return strcasecmp($a["name"], $b["name"]);  
    }
}
```
###php month
```php
$fecha = '2014-01-31';
//resultado incorrecto
echo date('Y-m-01',strtotime("$fecha next month")).'<br>';//2014-03-01
echo date('Y-m-t',strtotime("$fecha next month")).'<br>';//2014-03-31
//correcto
echo date('Y-m-01',strtotime("$fecha last day of next month")).'<br>';//2014-02-01
echo date('Y-m-t',strtotime("$fecha last day of next month")).'<br>';//2014-02-28

$fecha = '2014-05-31';
//resultado incorrecto
echo date('Y-m-01',strtotime("$fecha next month")).'<br>';//2014-07-01
echo date('Y-m-t',strtotime("$fecha next month")).'<br>';//2014-07-31
//correcto
echo date('Y-m-01',strtotime("$fecha last day of next month")).'<br>';//2014-06-01
echo date('Y-m-t',strtotime("$fecha last day of next month"));//2014-06-28

echo $d = strtotime('-1 day',strtotime("first day of last month"));
echo date( "Y-m-d", strtotime( "2009-01-31 +1 month" ) ).'<br>';//2009-03-03
//SELECT DATE_ADD( '2009-01-31', INTERVAL 1 MONTH ); 2009-02-28
# on 2/8/2010
echo date('m/d/y', strtotime('first day')).'<br>'; # 02/01/10
echo date('m/d/y', strtotime('last day')).'<br>'; # 02/28/10
echo date('m/d/y', strtotime('last day next month')).'<br>'; # 03/31/10
echo date('m/d/y', strtotime('last day last month')).'<br>'; # 01/31/10
echo date('m/d/y', strtotime('2009-12 last day')).'<br>'; # 12/31/09 - this doesn't work if you reverse the order of the year and month
echo date('m/d/y', strtotime('2009-03 last day')).'<br>'; # 03/31/09
echo date('m/d/y', strtotime('2009-03')).'<br>'; # 03/01/09
echo date('m/d/y', strtotime('last day of march 2009')).'<br>'; # 03/31/09
echo date('m/d/y', strtotime('last day of march')).'<br>'; # 03/31/10

$d = new DateTime( '2014-01-08' );
$d->modify( 'first day of +1 month' );//'first day of next month' 
echo $d->format( 'Y-m-d H:i:s' ), "\n";

echo date( "Y-m-d", strtotime( "2009-01-31 +1 month" ) ); // PHP:  2009-03-03
echo date( "Y-m-d", strtotime( "2009-01-31 +2 month" ) ); // PHP:  2009-03-31
```
###二维数组按key去重
```php

function assoc_unique(&$arr, $key,$k2) 
{ 
$rAr=array(); 
for($i=0;$i<count($arr);$i++) 
{ 
	$k = $arr[$i][$key].$arr[$i][$k2];
if(!isset($rAr[$k])) 
{ 
$rAr[$k]=$arr[$i];
} 
} print_r($rAr);
$arr=array_values($rAr); 
} 
assoc_unique($arr,'name','date'); 

function array_multunique($arr,$by = array()) {
	$temp = array();
	foreach($arr as $key => $val) {
		foreach($by as $v) {
			$temp[$key] .= isset($val[$v]) ? $val[$v] : '';
		}
	}
	return array_intersect_key($arr,array_unique($temp));
}
$aa = array (  
    array ('id' => 123, 'name' => '张三' ),   
    array ('id' => 123, 'name' => '李四' ),   
    array ('id' => 124, 'name' => '王五' ),   
    array ('id' => 125, 'name' => '赵六' ),   
    array ('id' => 126, 'name' => '赵六' )   
);  

$bb = array_multunique ($aa, array('id')); 
print_r($bb);
Array
(
    [0] => Array
        (
            [id] => 123
            [name] => 张三
        )

    [2] => Array
        (
            [id] => 124
            [name] => 王五
        )

    [3] => Array
        (
            [id] => 125
            [name] => 赵六
        )

    [4] => Array
        (
            [id] => 126
            [name] => 赵六
        )

)
```
###删除键值对
```php
function array_remove_key_val(&$a,$b,$c){
	foreach ($a as $key=>$value){
		if ( isset($value[$b]) && ($value[$b]==$c) ){
			unset($a[$key]);
		}
	}
}
$a=array(
	array('id'=>1,'num'=>10,'type'=>'news'),
	array('id'=>2,'num'=>100,'type'=>'pic')
);
array_remove_key_val($a,"id","1");
```
###二维数组按照指定字段的值分组
```php
function array_group_by(& $arr, $keyField)
{
    $ret = array();
    foreach ($arr as $row) {
        $key = $row[$keyField];
        $ret[$key][] = $row;
    }
    return $ret;
}
```
###多维数组转一维数组
```php
function rebuild_array($arr){  //rebuild a array
	static $tmp=array();

	for($i=0; $i<count($arr); $i++){
		if(is_array($arr[$i])){
			rebuild_array($arr[$i]);
		}else{
			$tmp[]=$arr[$i];
		}
	}

	return $tmp;
}
$arr=array('123.html','456.html',array('dw.html','fl.html',array('ps.html','fw.html')),'ab.html');
```
###编码转换
```php
function array_iconv($data, $input = 'gbk', $output = 'utf-8') {
	if (!is_array($data)) {
		return iconv($input, $output, $data);
	} else {
		foreach ($data as $key=>$val) {
			if(is_array($val)) {
				$data[$key] = array_iconv($val, $input, $output);
			} else {
				$data[$key] = iconv($input, $output, $val);
			}
		}
		return $data;
	}
}
```
###过滤用户昵称里面的emoji特殊字符

```php

function jsonName($str) {
    if($str){
        $tmpStr = json_encode($str);
        $tmpStr2 = preg_replace("#(\\\ud[0-9a-f]{3})#ie","",$tmpStr);
        $return = json_decode($tmpStr2);
        if(!$return){
            return jsonName($return);
        }
    }else{
        $return = '微信用户-'.time();
    }    
    return $return;
 }
```###if 判断 == 顺序
```php
if($result == true) { // 正确写法 

} 
if($result = true) { // 手抖的错误写法，很多时候新手可能会犯这种错误。 

} 
if(true = $result) { // 这样解析器会直接抛出错误，就算少写了一个=号也不必担心出现永远等于 true 的问题，避免了不必要的寻错成本。 

}
```###[4字节字符插入mysql被截断](http://qsalg.com/?p=533)
```php
//http://stackoverflow.com/questions/8491431/how-to-replace-remove-4-byte-characters-from-a-utf-8-string-in-php
preg_replace('/[\x{10000}-\x{10FFFF}]/u', "\xEF\xBF\xBD", $value);

```
###[根据经纬度计算距离](http://www.cnblogs.com/siqi/archive/2013/04/23/3037888.html)
```php
/**
     * 根据经纬度计算距离 其中A($lat1,$lng1)、B($lat2,$lng2)
         * 注意弧度角度的计算
     * 单位：km
     */
    function _getDistance($lat1,$lng1,$lat2,$lng2)
    {
        //地球半径
        $R = 6378.137; //km
    
        //将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
    
        //结果
        $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
    
        //精度
        $s = round($s* 10000)/10000;
        return  round($s);
    }
    /**
 *根据传入的中心点的经纬度和半径，计算出矩形区域
 * @param float $center_lat
 * @param float $center_lng
 * @param int   $radius unit:km
 */
function getAroundRectangle($center_lat, $center_lng, $radius)
{
    //先来求东西两侧的的范围边界 经度
    $earth_radius = 6378.137;    //km
    $dlng = rad2deg(2 * asin(sin($radius / (2 * $earth_radius)) / cos(deg2rad($center_lat)))); //角度
     
    //然后求南北两侧的范围边界 维度
    $dlat = rad2deg($radius/$earth_radius);
    
    $data = array(
        'lat_min' => $center_lat-$dlat,//维度最小
        'lat_max' => $center_lat+$dlat,//唯独 最大
        'lng_min' => $center_lng-$dlng,//经度最小
        'lng_max' => $center_lng+$dlng,//经度最大
    );
    return $data;
}
```
###[php技巧](http://www.cnblogs.com/siqi/archive/2012/12/02/2798178.html)
```php
/**
 * 获取最后一次出错信息，无论如何也能获取到
 * 
 * error_get_last set_error_handler 都不会受环境配置的影响
 * 
 */
error_reporting(0);
ini_set("display_errors", "off");


set_error_handler(function(){

    print_r(func_get_args());

});

echo $a ;
print_r(error_get_last());
// 输出所有的函数
get_defined_functions();

//获取所定义的常量
get_defined_constants();

//获取所定义的变量
get_defined_vars();
curl获取头信息 （注意包括\r\n）
$response = curl_exec($ch);
 $curl_info = curl_getinfo($ch);
 curl_close($ch);
 $header_size = $curl_info['header_size'];
 $header = substr($response, 0, $header_size);
 $body = substr($response, $header_size); 
设置头信息（Post请求）
1、curl_setopt ( $ch, CURLOPT_HTTPHEADER, array('Content-type:text/plain') );
file_get_contents('php://input', 'r') 获取到
$_POST                                获取不到

2、curl_setopt ( $ch, CURLOPT_HTTPHEADER, array('Content-type:application/x-www-form-urlencoded') );#默认
file_get_contents('php://input', 'r') 获取到
$_POST                                获取到

3、curl_setopt ( $ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data; boundary=----WebKitFormBoundarygAvW9MJkUNVmzDjY') );
file_get_contents('php://input', 'r') 获取不到
$_POST                                获取到
判断一个数组是否是关联数组

function is_assoc($arr) {
    return array_keys($arr) !== range(0, count($arr) - 1);
}
curl 当post超过1024byte时的问题curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
strtr($string, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');
// ?: 匹配但不捕获 加在前面
//? 去贪婪 加在后面
// \1 反向引用
// $1 捕获
$str = 'a a';
preg_match("/(a)(?:\s+)\\1/", $str, $m); #1
echo preg_replace("/(a)(\s+)\\1/", "$1", $str); #a
print_r($m);
#正则中对\的理解

$str = '<a href=\"db.house.qq\"></a>';

#双引号中可以转义的符合会被执行，输出后不在显示转义符
echo "/\\\\\"db.house.qq\\\\\"/" . "\n"; // /\\"db.house.qq\\"/ 总结：在双引号的正则中一个\需要写成 \\

#正则本身的转义符号也需要转义
var_dump(preg_match("/\\\\\"db.house.qq\\\\\"/", $str, $m));

#单引号写法，单引号中的内容不会执行
var_dump(preg_match('/\\\"db.house.qq\\\"/', $str, $m));

print_r($m);
```
###安全base64
```php
function urlsafe_b64encode($string)
{
  $data = base64_encode($string);
  $data = str_replace(array('+','/','='),array('-','_','.'),$data);//strtr($data,'+/=','-_.')
  return $data;
}
function urlsafe_b64decode($string)
{
  $data = str_replace(array('-','_','.'),array('+','/','='),$string);
  $mod4 = strlen($data) % 4;
  if ($mod4) {
    $data .= substr('====', $mod4);
  }
  return base64_decode($data);
}

```
###[nginx跨域代理](https://segmentfault.com/q/1010000007964503)
```php
upstream backend {
    server backend1.example.com:8080;
}

server {
    location /api {
        proxy_pass http://backend;
    }
}
```
###[php随机](http://timoh6.github.io/2013/11/05/Secure-random-numbers-for-PHP-developers.html)
```php
require 'random.php';
$random_compat = new PHP\Random();
$int = $random_compat->int(1000);
```
###[判断页面或图片是否经过gzip压缩](http://blog.csdn.net/fdipzone/article/details/53191442)
```php
ob_start('ob_gzhandler'); // 开启gzip，屏蔽则关闭

$data = array(
    array('name'=>'one','value'=>1),
    array('name'=>'two','value'=>2),
    array('name'=>'three','value'=>3)
);

header('content-type:application/json');
echo json_encode($data);

$url = 'http://www.example.com/';
var_dump(check_gzip($url));

/**
 * 判断url是否经过gzip压缩 当加上ob_gzhandler时，返回true，删除后返回false
 * @param String  $url 来源
 * @param Boolean
 */
function check_gzip($url){
    $header = get_headers($url, 1);
    if(isset($header['Vary']) && $header['Vary']=='Accept-Encoding'){
        return true;
    }
    return false;
}
function check_gzip($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);         // 输出header信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 返回的信息不直接输出
    curl_setopt($ch, CURLOPT_ENCODING, '');      // 不限制编码类型
    $response = curl_exec($ch);
    if(!curl_errno($ch)){
        $info = curl_getinfo($ch);
        // 获取header
        $header_size = $info['header_size'];
        $header_str = substr($response, 0, $header_size);
        $filter = array("\r\n", "\r");
        $header_str = str_replace($filter, PHP_EOL, $header_str);

        // 检查content-encoding
        preg_match('/Content-Encoding: (.*)\s/i', $header_str, $matches);
        if(isset($matches[1]) && $matches[1]=='gzip'){
            return true;
        }
    }
    return false;
}
```
###[调用ffmpeg获取视频信息](http://blog.csdn.net/fdipzone/article/details/53885684)
```php
// 定义ffmpeg路径及命令常量
define('FFMPEG_CMD', '/usr/local/bin/ffmpeg -i "%s" 2>&1');

/**
 * 使用ffmpeg获取视频信息
 * @param  String $file 视频文件
 * @return Array
 */
function getVideoInfo($file){
    ob_start();
    passthru(sprintf(FFMPEG_CMD, $file));
    $video_info = ob_get_contents();
    ob_end_clean();

    // 使用输出缓冲，获取ffmpeg所有输出内容
    $ret = array();

    // Duration: 00:33:42.64, start: 0.000000, bitrate: 152 kb/s
    if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $video_info, $matches)){
        $ret['duration'] = $matches[1]; // 视频长度
        $duration = explode(':', $matches[1]);
        $ret['seconds'] = $duration[0]*3600 + $duration[1]*60 + $duration[2]; // 转为秒数
        $ret['start'] = $matches[2]; // 开始时间
        $ret['bitrate'] = $matches[3]; // bitrate 码率 单位kb
    }

    // Stream #0:1: Video: rv20 (RV20 / 0x30325652), yuv420p, 352x288, 117 kb/s, 15 fps, 15 tbr, 1k tbn, 1k tbc
    if(preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $video_info, $matches)){
        $ret['vcodec'] = $matches[1];     // 编码格式
        $ret['vformat'] = $matches[2];    // 视频格式
        $ret['resolution'] = $matches[3]; // 分辨率
        list($width, $height) = explode('x', $matches[3]);
        $ret['width'] = $width;
        $ret['height'] = $height;
    }

    // Stream #0:0: Audio: cook (cook / 0x6B6F6F63), 22050 Hz, stereo, fltp, 32 kb/s
    if(preg_match("/Audio: (.*), (\d*) Hz/", $video_info, $matches)){
        $ret['acodec'] = $matches[1];      // 音频编码
        $ret['asamplerate'] = $matches[2]; // 音频采样频率
    }

    if(isset($ret['seconds']) && isset($ret['start'])){
        $ret['play_time'] = $ret['seconds'] + $ret['start']; // 实际播放时间
    }

    $ret['size'] = filesize($file); // 视频文件大小
    $video_info = iconv('gbk','utf8', $video_info);
    return array($ret, $video_info);

}

// 输出视频信息
$video_info = getVideoInfo('myvideo.avi');
print_r($video_info[0]);
Array
(
    [duration] => 00:33:42.64
    [seconds] => 2022.64
    [start] => 0.000000
    [bitrate] => 152
    [vcodec] => rv20 (RV20 / 0x30325652)
    [vformat] => yuv420p
    [resolution] => 352x288
    [width] => 352
    [height] => 288
    [acodec] => cook (cook / 0x6B6F6F63)
    [asamplerate] => 22050
    [play_time] => 2022.64
    [size] => 38630744
)
```
###[python识别中文验证码错误](http://stackoverflow.com/questions/14800730/tesseract-running-error#)
```php
//pytesseract.pytesseract.TesseractError: (1, 'Error opening data file chi_sim.traineddata')
从https://github.com/tesseract-ocr/tessdata 下载中文文件
wget https://tesseract-ocr.googlecode.com/files/chi_sim.traineddata.gz
or Github (raw):

wget https://github.com/tesseract-ocr/tessdata/raw/master/chi_sim.traineddata
命令行识别http://layou.iteye.com/blog/2277405  tesseract.exe  vcode.png tess
```
###[MySQL优化](http://www.cnblogs.com/siqi/p/3566771.html)
```php
逆范式：1对多的时候应当尽可能的把冗余放在一那边

#查看语句的执行次数
show status 

show create database;

#设置id自动增长的值
alter table test auto_increment=2;

#mysql myisam 引擎删除的记录不是释放硬盘空间
optimize table table_name;

关心以com开头的命令 show status like 'com%'

show (session) status like 'com_select';  //本次会话

show global status like 'com_select';  //从启动到现在

connextions 试图连接数据库的次数   status like 'com_select';

show status like 'uptime';  服务器启动时间

show status like 'slow_queries';  //慢查询次数，默认是十秒

显示慢查询 show variables like 'long_query_time';设置

关于mysql中的 dual 表可以看错是一个虚拟表，只是为符合 select * from table_name 这一查询格式而已

启动慢查询日志：
mysqld.exe -slow-query-log

数据文件my.ini datadir设置

//设置慢查询时间
set long_query_time = 1;
__________________________________________________
第一步：修改my.ini(mysql配置文件)
  在my.ini中加上下面两句话
  log-slow-queries = D:\wamp\mysql_slow_query.log
  long_query_time=5
  第一句使用来定义慢查询日志的路径（因为是windows，所以不牵涉权限问题）
  第二句使用来定义查过多少秒的查询算是慢查询，我这里定义的是5秒
  第二步：查看关于慢查询的状态
  执行如下SQL语句来查看mysql慢查询的状态
  show variables like '%slow%';
  执行结果会把是否开启慢查询、慢查询的秒数、慢查询日志等信息打印在屏幕上。
  第三步：执行一次慢查询操作
  
  下语句代替：
  SELECT SLEEP(10);
  第四步：查看慢查询的数量
  通过如下sql语句，来查看一共执行过几次慢查询：
  show global status like '%slow%';

explain:分析会不会用到索引，但不能分析出用多少时间

导入大量数据时：
alter table table_name     disable keys;
loading data;
alter table table_name     enable keys;

查看见表SQL:
show create table table_name;

对于 myisam数据库，需要定时清理

optimize table 表名

用连接代替子查询
使用join，mysql不需要在内存中国年创建临时表

如果想要 or 用到索引则，or的条件必须都加索引


在精度要求较高的项目中，用定点数来来保存，以保证准确性
全部用 decimal 更准确

date 函数最多 2038 年  此时的时间戳正好为 int 有符号的最大值

查看索引的使用情况
show status like 'handler_read';

handler_read_key:  高了好
handler_read_rnd_next: 低了好


字段的类型匹配不一致可能会用不到索引：
    字符串型字段 = 123  用不到索引
    字符串型字段 = "123"  可以用索引
1，在创建一个n列的索引时，实际是创建了MySQL可利用的n个索引。
多列索引可起几个索引的作用，因为可利用索引中最左边的列集来匹配行。
 KEY `gb_index_FUid_FCityId_FStatus` (`FUid`,`FCityId`,`FStatus`)
可利用多个索引:
FUid
(FUid, FCityId)
(FUid,FCityId,FStatus)

2，对字符串建立索引后，查询时一定要加引号，否则不能使用索引。

3，mysql对于索引的顺序是有优化的
Where FUid = xxx and FCityId = yyy
和
Where FCityId = yyy and FUid = xxx
Mysql都会使用索引(FUid, FCityId)

4，join on的列加索引，效果很好。

5，in查询中，如果值太多，可以考虑换一种实现方式。

6，对于merg表，如果有join查询，可以将merge表的join查询替换成多个子表的join查询，最后union结果。（原来搜索脚本就是这样进行优化的）。    
```
###[atob](https://segmentfault.com/q/1010000007953476)
```php
decodeURIComponent(escape(window.atob(res.data.content)))
```
###[接收二进制流并生成文件](http://blog.csdn.net/fdipzone/article/details/7473949)
```php
/** 二进制流生成文件 
    * $_POST 无法解释二进制流，需要用到 $GLOBALS['HTTP_RAW_POST_DATA'] 或 php://input 
    * $GLOBALS['HTTP_RAW_POST_DATA'] 和 php://input 都不能用于 enctype=multipart/form-data 
    * @param    String  $file   要生成的文件路径 
    * @return   boolean 
    */  
    function binary_to_file($file){  
        $content = $GLOBALS['HTTP_RAW_POST_DATA'];  // 需要php.ini设置  
        if(empty($content)){  
            $content = file_get_contents('php://input');    // 不需要php.ini设置，内存压力小  
        }  
        $ret = file_put_contents($file, $content, true);  
        return $ret;  
    }  
      
    // demo  
    binary_to_file('photo/test.png'); 
```
###file_get_contents post
```php
$api = 'http://demo.fdipzone.com/server.php';  
  
$postdata = array(  
    'name' => 'fdipzone',  
    'gender' => 'male'  
);  
  
$opts = array(  
    'http' => array(  
        'method' => 'POST',  
        'header' => 'content-type:application/x-www-form-urlencoded',  
        'content' => http_build_query($postdata)  
    )  
);  
  
$context = stream_context_create($opts);  
  
$result = file_get_contents($api, false, $context);  
  
echo $result; 
```
###[fsockopen GET/POST 提交表单及上传文件](http://blog.csdn.net/fdipzone/article/details/11712607)
```php
$host = 'demo.fdipzone.com';  
$port = 80;  
$errno = '';  
$errstr = '';  
$timeout = 30;  
$url = '/socket/getapi.php';  
  
$param = array(  
    'name' => 'fdipzone',  
    'gender' => 'man'  
);  
  
$url = $url.'?'.http_build_query($param);  
  
// create connect  
$fp = fsockopen($host, $port, $errno, $errstr, $timeout);  
  
if(!$fp){  
    return false;  
}  
  
// send request  
$out = "GET ${url} HTTP/1.1\r\n";  
$out .= "Host: ${host}\r\n";  
$out .= "Connection:close\r\n\r\n";  
  
fputs($fp, $out);  
  
// get response  
$response = '';  
while($row=fread($fp, 4096)){  
    $response .= $row;  
}  
  
fclose($fp);  
  
$pos = strpos($response, "\r\n\r\n");  
$response = substr($response, $pos+4);  
  
echo $response;  

$host = 'demo.fdipzone.com';  
$port = 80;  
$errno = '';  
$errstr = '';  
$timeout = 30;  
$url = '/socket/postapi.php';  
  
$param = array(  
    'name' => 'fdipzone',  
    'gender' => 'man',  
    'photo' => file_get_contents('photo.jpg')  
);  
  
$data = http_build_query($param);  
  
// create connect  
$fp = fsockopen($host, $port, $errno, $errstr, $timeout);  
  
if(!$fp){  
    return false;  
}  
  
// send request  
$out = "POST ${url} HTTP/1.1\r\n";  
$out .= "Host:${host}\r\n";  
$out .= "Content-type:application/x-www-form-urlencoded\r\n";  
$out .= "Content-length:".strlen($data)."\r\n";  
$out .= "Connection:close\r\n\r\n";  
$out .= "${data}";  
  
fputs($fp, $out);  
  
// get response  
$response = '';  
while($row=fread($fp, 4096)){  
    $response .= $row;  
}  
  
fclose($fp);  
  
$pos = strpos($response, "\r\n\r\n");  
$response = substr($response, $pos+4);  
  
echo $response;  
//post处理
define('UPLOAD_PATH', dirname(__FILE__).'/upload');  
  
$name = $_POST['name'];  
$gender = $_POST['gender'];  
$photo = $_POST['photo'];  
  
$filename = time().'.jpg';  
file_put_contents(UPLOAD_PATH.'/'.$filename, $photo, true); 

$host = 'demo.fdipzone.com';  
$port = 80;  
$errno = '';  
$errstr = '';  
$timeout = 30;  
$url = '/socket/fileapi.php';  
  
$form_data = array(  
    'name' => 'fdipzone',  
    'gender' => 'man',  
);  
  
$file_data = array(  
    array(  
        'name' => 'photo',  
        'filename' => 'photo.jpg',  
        'path' =>'photo.jpg'  
    )  
);  
  
// create connect  
$fp = fsockopen($host, $port, $errno, $errstr, $timeout);  
  
if(!$fp){  
    return false;  
}  
  
// send request  
srand((double)microtime()*1000000);  
$boundary = "---------------------------".substr(md5(rand(0,32000)),0,10);  
  
$data = "--$boundary\r\n";  
  
// form data  
foreach($form_data as $key=>$val){  
    $data .= "Content-Disposition: form-data; name=\"".$key."\"\r\n";  
    $data .= "Content-type:text/plain\r\n\r\n";  
    $data .= rawurlencode($val)."\r\n";  
    $data .= "--$boundary\r\n";  
}  
  
// file data  
foreach($file_data as $file){  
    $data .= "Content-Disposition: form-data; name=\"".$file['name']."\"; filename=\"".$file['filename']."\"\r\n";  
    $data .= "Content-Type: ".mime_content_type($file['path'])."\r\n\r\n";  
    $data .= implode("",file($file['path']))."\r\n";  
    $data .= "--$boundary\r\n";  
}  
  
$data .="--\r\n\r\n";  
  
$out = "POST ${url} HTTP/1.1\r\n";  
$out .= "Host:${host}\r\n";  
$out .= "Content-type:multipart/form-data; boundary=$boundary\r\n"; // multipart/form-data  
$out .= "Content-length:".strlen($data)."\r\n";  
$out .= "Connection:close\r\n\r\n";  
$out .= "${data}";  
  
fputs($fp, $out);  
  
// get response  
$response = '';  
while($row=fread($fp, 4096)){  
    $response .= $row;  
}  
  
fclose($fp);  
  
$pos = strpos($response, "\r\n\r\n");  
$response = substr($response, $pos+4);  
  
echo $response;  
//上传文件
define('UPLOAD_PATH', dirname(__FILE__).'/upload');  
  
$name = $_POST['name'];  
$gender = $_POST['gender'];  
  
$filename = time().'.jpg';  
  
echo 'name='.$name.'<br>';  
echo 'gender='.$gender.'<br>';  
if(move_uploaded_file($_FILES['photo']['tmp_name'], UPLOAD_PATH.'/'.$filename)){  
    echo '<img src="upload/'.$filename.'">';  
}  
```
