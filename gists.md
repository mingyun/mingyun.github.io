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
###
