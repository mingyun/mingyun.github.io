###[PHP引用(&)各种使用方法实例详解](http://www.jb51.net/article/48267.htm)
```js
 1.变量的引用
 $a="ABC";
    $b =&$a;
    echo $a;//这里输出:ABC
    echo $b;//这里输出:ABC
    $b="EFG";
    echo $a;//这里$a的值变为EFG 所以输出EFG
    echo $b;//这里输出EFG
 2.函数的引用传递（传址调用）     
      
      function test(&$a)
    {
        $a=$a+100;
    }
    $b=1;
    echo $b;//输出１
    test($b);   //这里$b传递给函数的其实是$b的变量内容所处的内存地址，通过在函数里改变$a的值　就可以改变$b的值了
    在这里test(１);的话就会出错，原因是：PHP规定传递的引用不能为常量（可以看错误提示）。http://www.cnblogs.com/thinksasa/p/3334492.html
    echo "<br>";
    echo $b;//输出101
    但是在函数“call_user_func_array”中，若要引用传参，就得需要 & 符号，如下代码所示：
    
    function a(&$b){
    $b++;
}
$c=0;
call_user_func_array('a',array(&$c));
echo $c;
//输出 1
function &test()
{
    static $b=0;//申明一个静态变量
    $b=$b+1;
    echo $b;
    return $b;
}
$a=test();//这条语句会输出　$b的值　为１
$a=5;
$a=test();//这条语句会输出　$b的值　为2
$a=&test();//这条语句会输出　$b的值　为3
$a=5;
$a=test();//这条语句会输出　$b的值　为6

 $a=test()方式调用函数，只是将函数的值赋给$a而已，　而$a做任何改变，都不会影响到函数中的$b，而通过$a=&test()方式调用函数呢, 他的作用是　将return $b中的　$b变量的内存地址与$a变量的内存地址　指向了同一个地方 即产生了相当于这样的效果($a=&b;) 所以改变$a的值　也同时改变了$b的值　所以在执行了 $a=&test(); $a=5; 以后，$b的值变为了5

```
###[手握两亿条密码，我都干了些什么！](https://zhuanlan.zhihu.com/p/25056106)
###[php 位运算|和逻辑运算||的区别](http://blog.csdn.net/ebw123/article/details/10623731)
```js
位运算符代码:
$a=0;
$b=0;
if($a=3 | $b=3){
$a++;
$b++;
}
echo $a.’,’.$b; //输出 4,4
对比一下代码,以下为逻辑运算符的代码:
$a=0;
$b=0;
if($a=3 || $b=3){
$a++;
$b++;
}
echo $a.’,’.$b; //输出 1,1
在上述两个例子中,第一个例子中,”$a=3 | $b=3″,由于”|”的优先级高于赋值运算符,所以运算顺序可写为 “$a=(3 | $b=3)”,首先$b被赋值为3,而$a被二进制数0100 | 0100 的结果赋值,仍为0100,所以$a此时被赋值为0100,也就是十进制的3,赋值成功,返回true,执行if代码块中的内容,$a自加,$b也自加, 所以,$a=4,$b=4
第二个例子中,同样可以看做是”$a = (3 || $b = 3)”,首先3||$b=3返回true,”||”造成短路,”||”前的3已经为真,”$b=3″不再执行,所以此时$b仍为0,$a为布尔类型的 true,,赋值成功,返回true,执行if代码块中的内容,$a++还为true,$b++为1,所以,$a=1,$b=1
(11)取模运算转化成位运算 (在不产生溢出的情况下)
a % (2^n) 等价于 a & (2^n – 1)
(12)乘法运算转化成位运算 (在不产生溢出的情况下)
a * (2^n) 等价于 a<< n
(13)除法运算转化成位运算 (在不产生溢出的情况下)
a / (2^n) 等价于 a>> n
例: 12/8 == 12>>3
(14) a % 2 等价于 a & 1
```
###[MySQL排序原理与案例分析 ](http://www.cnblogs.com/cchust/p/5304594.html)
```js
假设t1表存在索引key1(key_part1,key_part2),key2(key2)

a.可以利用索引避免排序的SQL

SELECT * FROM t1 ORDER BY key_part1,key_part2;

SELECT * FROM t1 WHERE key_part1 = constant ORDER BY key_part2;

SELECT * FROM t1 WHERE key_part1 > constant ORDER BY key_part1 ASC;

SELECT * FROM t1 WHERE key_part1 = constant1 AND key_part2 > constant2 ORDER BY key_part2;
b.不能利用索引避免排序的SQL

//排序字段在多个索引中，无法使用索引排序

SELECT * FROM t1 ORDER BY key_part1,key_part2, key2;

 

//排序键顺序与索引中列顺序不一致，无法使用索引排序

SELECT * FROM t1 ORDER BY key_part2, key_part1;

 

//升降序不一致，无法使用索引排序

SELECT * FROM t1 ORDER BY key_part1 DESC, key_part2 ASC;

 

//key_part1是范围查询，key_part2无法使用索引排序

SELECT * FROM t1 WHERE key_part1> constant ORDER BY key_part2;
Mysql从5.5迁移到5.6以后，发现分页出现了重复值。
 create table t1(id int primary key, c1 int, c2 varchar(128));
insert into t1 values(1,1,'a');
insert into t1 values(2,2,'b');
insert into t1 values(3,2,'c');
insert into t1 values(4,2,'d');
insert into t1 values(5,3,'e');
insert into t1 values(6,4,'f');
insert into t1 values(7,5,'g');
mysql> select *from t1;
+----+------+------+
| id | c1   | c2   |
+----+------+------+
|  1 |    1 | a    |
|  2 |    2 | b    |
|  3 |    2 | c    |
|  4 |    2 | d    |
|  5 |    3 | e    |
|  6 |    4 | f    |
|  7 |    5 | g    |
+----+------+------+
7 rows in set (0.00 sec)

mysql> select *from t1 order by c1 limit 0,3;
+----+------+------+
| id | c1   | c2   |
+----+------+------+
|  1 |    1 | a    |
|  3 |    2 | c    |
|  4 |    2 | d    |
+----+------+------+
3 rows in set (0.00 sec)

mysql> select *from t1 order by c1 limit 3,3;
+----+------+------+
| id | c1   | c2   |
+----+------+------+
|  4 |    2 | d    |
|  5 |    3 | e    |
|  6 |    4 | f    |
+----+------+------+
3 rows in set (0.00 sec)
id为4的这条记录居然同时出现在两次查询中，这明显是不符合预期的，而且在5.5版本中没有这个问题。产生这个现象的原因就是5.6针对limit M,N的语句采用了优先队列，而优先队列采用堆实现，比如上述的例子order by c1 asc limit 0，3 需要采用大小为3的大顶堆；limit 3，3需要采用大小为6的大顶堆。由于c1为2的记录有3条，而堆排序是非稳定的(对于相同的key值，无法保证排序后与排序前的位置一致)，所以导致分页重复的现象。为了避免这个问题，我们可以在排序中加上唯一值，比如主键id，这样由于id是唯一的，确保参与排序的key值不相同。将SQL写成如下：

select * from t1 order by c1,id asc limit 0,3;
select * from t1 order by c1,id asc limit 3,3;
select id,status,c1,c2 from t2 force index(c1) where c1>='b' order by status;
select id,status from t2 force index(c1) where c1>='b' order by status;
```
###[mysql中，需要通过selct count 统计表记录数目时，使用count(*)或count(1)就好](http://www.cnblogs.com/cchust/p/3264147.html)
###[mysql大小写敏感与校对规则 ](http://www.cnblogs.com/cchust/p/3952821.html)
```js
select * from test where c1 like 'ab%'; 
 +-----+ 
 | c1 | 
 +-----+ 
 | abc | 
 | ABD | 
select * from test where c1 like 'ab%' collate utf8_bin; 
 +-----+ 
 | c1 | 
 +-----+ 
 | abc| 
select * from test where binary c1 like 'ab%'; 
 +-----+ 
 | c1 | 
 +-----+ 
 | abc | 
 +-----+
```
###[深度解析mysql登录原理 ](http://www.cnblogs.com/cchust/p/5025880.html)
 ```js
 Unix socket方式登陆与TCP方式登陆有什么区别和联系？

Unix socket是实现进程间通信的一种方式，mysql支持利用Unix socket来实现客户端-服务端的通信，但要求客户端和服务端在同一台机器上。对于unix socket而言，同样也是一种套接字，监听线程会同时监听TCP socket和Unix socket，接受到请求然后处理，后续的处理逻辑都是一致的，只不过底层通信方式不一样罢了。

mysql  -h127.0.0.1 –P3306 –uxxx –pxxx  [TCP通讯方式]
mysql  -uxxx –pxxx –S/usr/mysql/mysql.sock  [unix socket通信方式]
```
###[mysql执行计划 ](http://www.cnblogs.com/cchust/p/3426927.html)
```js
explain  select ......
 id相同，执行顺序从上到下，下面的执行计划表示，先操作t1表，然后操作t2表，最后操作t3表。
 若存在子查询，则子查询（内层查询）id大于父查询(外层查询)，先执行子查询。id越大，优先级越高。
 a.Using index,表示使用了索引

b.Using where，表示通过where条件过滤

c.Using temporary，表示使用了临时表，常见于分组和排序

d.Using filesort，表示无法使用索引排序，需要文件排序
rows

含义：MySQL根据表统计信息及索引选用情况，估算的找到所需的记录所需要读取的行数,这个值是不准确的，只有参考意义。
```
###[mysql insert execute failed due to >>> Incorrect string value: '\xA1;offl...' for column 'biz_info' at row 1 ](http://www.cnblogs.com/cchust/p/4601536.html)
```js
CREATE TABLE `ggg` (
   `id` int(11) DEFAULT NULL,
   `c` varchar(100) DEFAULT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=gbk;

root@test 06:13:48>insert into ggg values(1,concat('cardName:校园网',char(59),'offlineCardType:campus'));


Query OK, 1 row affected, 1 warning (2.51 sec)


root@test 06:14:36>show warnings\G


*************************** 1. row ***************************

Level: Warning


Code: 1366


Message: Incorrect string value: '\x91;offl...' for column 'c' at row 1 

查看结果


root@test 06:16:06>select * from ggg where id=1;


*************************** 1. row ***************************


id: 1

c: cardName:鏍″洯缃
将char(59)替换成';'


insert into ggg values(1,concat('cardName:校园网',';','offlineCardType:campus'));

     2.设置连接串字符集为GBK

insert into ggg values(1,concat('cardName:校园网',char(59),'offlineCardType:campus'));


果然，两种情况执行结果都是OK的
问题产生的两个关键点

1.连接字符集与表字符集不匹配

2.使用了char函数

解决办法

1.char函数提供了using语法来实现返回特定字符集的字符串，比如：char(59 using utf8)

2.保证连接字符集与表字符集一致。

```
###[mysql优化案例分析 ](http://www.cnblogs.com/cchust/p/3444510.html)
```js
SELECT ID FROM SENDLOG WHERE TO_DAYS(NOW())-TO_DAYS(GMT_CREATE) > 7;
优化后sql：

select id from sendlog where gmt_create < now() - 7
SELECT * FROM SENDLOG where result = 1 and gmt_create > '2013-10-29 12:40:44' limit 2000;
SELECT * FROM SENDLOG where result = '1' and gmt_create > '2013-10-29 12:40:44' limit 2000;
select count(*) from mc_msg where receiver='sun098' and status='UNREAD' and title is not null;
select count(*) from (se
如果大于99条，页面就直接显示为99+lect id from mc_msg where receiver='sun098' and status='UNREAD' and title is not null limit 100) a;
```
###[单点登录 Ucenter 分析](http://blog.csdn.net/ebw123/article/details/9417231)
其实UC的原理很简单 就是某个应用登陆后 然后后台轮询发送给同步登陆的应用的回调文件 回调文件接收到用户ID之后 生成cookie或者session然后进入登陆模式。
###[ php str_replace 替换指定次数方法](http://blog.csdn.net/fdipzone/article/details/45854413#)
```js
$str = 'abcdefgh';  
echo str_replace('abc', '123', $str); // 123defgh  
  
$str = '123456';  
$search = array(1, 2, 3, 4, 5, 6);  
$replace = array('a', 'b', 'c', 'd', 'f', 'g');  
echo str_replace($search, $replace, $str); // abcdefg  
  
$arr = array('abc','bac','cba');  
$result = str_replace('b', 'B', $arr, $count);  
print_r($result); // Array ( [0] => aBc [1] => Bac [2] => cBa )  
echo $count;      // 3 共替换了3次
/** 
 * 对字符串执行指定次数替换 
 * @param  Mixed $search   查找目标值 
 * @param  Mixed $replace  替换值 
 * @param  Mixed $subject  执行替换的字符串／数组 
 * @param  Int   $limit    允许替换的次数，默认为-1，不限次数 
 * @return Mixed 
 */  
function str_replace_limit($search, $replace, $subject, $limit=-1){  
    if(is_array($search)){  
        foreach($search as $k=>$v){  
            $search[$k] = '`'. preg_quote($search[$k], '`'). '`';  
        }  
    }else{  
        $search = '`'. preg_quote($search, '`'). '`';  
    }  
    return preg_replace($search, $replace, $subject, $limit);  
}  
$str = 'user_order_list';  
echo str_replace_limit('_', '/', $str, 1); // user/order_list  
  
$arr = array('abbc','bbac','cbba');  
$result = str_replace_limit('b', 'B', $arr, 1);  
print_r($result); // Array ( [0] => aBbc [1] => Bbac [2] => cBba )  
```
###[php 文件与16进制相互转换](http://blog.csdn.net/fdipzone/article/details/54427275)
```js
/**
 * 将文件内容转为16进制输出
 * @param  String $file 文件路径
 * @return String
 */
function fileToHex($file){
    if(file_exists($file)){
        $data = file_get_contents($file);
        return bin2hex($data);
    }
    return '';
}

/**
 * 将16进制内容转为文件
 * @param String $hexstr 16进制内容
 * @param String $file   保存的文件路径
 */
function hexToFile($hexstr, $file){
    if($hexstr){
        $data = pack('H*', $hexstr);
        file_put_contents($file, $data, true);
    }
}

// 演示
$file = 'test.doc';

// 文件转16进制
$hexstr = fileToHex($file);
echo '文件转16进制<br>';
echo $hexstr.'<br><br>';

// 16进制转文件
$newfile = 'new.doc';
hexToFile($hexstr, $newfile);

echo '16进制转文件<br>';
var_dump(file_exists($newfile));
```
###[php 计算多个集合的笛卡尔积](http://blog.csdn.net/fdipzone/article/details/54312186)
```js
假设集合A={a,b}，集合B={0,1,2}，则两个集合的笛卡尔积为{(a,0),(a,1),(a,2),(b,0),(b,1),(b,2)} 
思路：先计算第一个集合和第二个集合的笛卡尔积，把结果保存为一个新集合。 
然后再用新集合与下一个集合计算笛卡尔积，依此循环直到与最后一个集合计算笛卡尔积。 
/**
 * 计算多个集合的笛卡尔积
 * @param  Array $sets 集合数组
 * @return Array
 */
function CartesianProduct($sets){

    // 保存结果
    $result = array();

    // 循环遍历集合数据
    for($i=0,$count=count($sets); $i<$count-1; $i++){

        // 初始化
        if($i==0){
            $result = $sets[$i];
        }

        // 保存临时数据
        $tmp = array();

        // 结果与下一个集合计算笛卡尔积
        foreach($result as $res){
            foreach($sets[$i+1] as $set){
                $tmp[] = $res.$set;
            }
        }

        // 将笛卡尔积写入结果
        $result = $tmp;

    }

    return $result;

}

// 定义集合
$sets = array(
    array('白色','黑色','红色'),
    array('透气','防滑'),
    array('37码','38码','39码'),
    array('男款','女款')
);

$result = CartesianProduct($sets);
print_r($result);
Array
(
    [0] => 白色透气37码男款
    [1] => 白色透气37码女款
    [2] => 白色透气38码男款
    [3] => 白色透气38码女款
    [4] => 白色透气39码男款
    [5] => 白色透气39码女款
    [6] => 白色防滑37码男款
    [7] => 白色防滑37码女款
    [8] => 白色防滑38码男款
    [9] => 白色防滑38码女款
    [10] => 白色防滑39码男款
    [11] => 白色防滑39码女款
    [12] => 黑色透气37码男款
    [13] => 黑色透气37码女款
    [14] => 黑色透气38码男款
    [15] => 黑色透气38码女款
    [16] => 黑色透气39码男款
    [17] => 黑色透气39码女款
    [18] => 黑色防滑37码男款
    [19] => 黑色防滑37码女款
    [20] => 黑色防滑38码男款
    [21] => 黑色防滑38码女款
    [22] => 黑色防滑39码男款
    [23] => 黑色防滑39码女款
    [24] => 红色透气37码男款
    [25] => 红色透气37码女款
    [26] => 红色透气38码男款
    [27] => 红色透气38码女款
    [28] => 红色透气39码男款
    [29] => 红色透气39码女款
    [30] => 红色防滑37码男款
    [31] => 红色防滑37码女款
    [32] => 红色防滑38码男款
    [33] => 红色防滑38码女款
    [34] => 红色防滑39码男款
    [35] => 红色防滑39码女款
)

```
###[ajax跨域访问cookie丢失的解决方法](http://blog.csdn.net/fdipzone/article/details/54576626)
```js

$name = isset($_POST['name'])? $_POST['name'] : '';

$ret = array(
    'success' => true,
    'name' => $name,
    'cookie' => isset($_COOKIE['data'])? $_COOKIE['data'] : ''
);
服务端header设置Access-Control-Allow-Credentials:true后，Access-Control-Allow-Origin不可以设为*，必须设置为一个域名，否则回返回错误。
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:http://a.fdipzone.com');

// 响应类型
header('Access-Control-Allow-Methods:POST');  

// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

// 是否允许请求带有验证信息
header('Access-Control-Allow-Credentials:true');

header('content-type:application/json');
echo json_encode($ret);

 <script type="text/javascript">
    $(function(){

        $.ajax({
            url: 'http://b.fdipzone.com/server.php', // 跨域
            xhrFields:{withCredentials: true}, // 发送凭据
            dataType: 'json',
            type: 'post',
            data: {'name':'fdipzone'},
            success:function(ret){
                if(ret['success']==true){
                    alert('cookie:' + ret['cookie']);
                }
            }
        });

    })
    </script>
    
```
###[php 整洁之道](https://gold.xitu.io/entry/58a549a161ff4b006c41f9f2?from=singlemessage&isappinstalled=0#table-of-contents)
```js
https://github.com/yangweijie/clean-code-php
使用有意义且可拼写的变量名

Bad:

$ymdstr = $moment->format('y-m-d');
Good:

$currentDate = $moment->format('y-m-d');
Bad:

// What the heck is 86400 for?
addExpireAt(86400);
Good:

// Declare them as capitalized `const` globals.
interface DateGlobal {
  const SECONDS_IN_A_DAY = 86400;
}

addExpireAt(DateGlobal::SECONDS_IN_A_DAY);
使用参数默认值代替短路或条件语句。

Bad:

function createMicrobrewery($name = null) {
  $breweryName = $name ?: 'Hipster Brew Co.';
  // ...
}
Good:

function createMicrobrewery($breweryName = 'Hipster Brew Co.') {
  // ...
}
函数参数最好少于2个
Bad:

function createMenu($title, $body, $buttonText, $cancellable) {
  // ...
}
Good:

class menuConfig() {
  public $title;
  public $body;
  public $buttonText;
  public $cancellable = false;
}

$config = new MenuConfig();
$config->title = 'Foo';
$config->body = 'Bar';
$config->buttonText = 'Baz';
$config->cancellable = true;

function createMenu(MenuConfig $config) {
  // ...
}
通过对象赋值设置默认值

Bad:

$menuConfig = [
  'title'       => null,
  'body'        => 'Bar',
  'buttonText'  => null,
  'cancellable' => true,
];

function createMenu(&$config) {
  $config['title']       = $config['title'] ?: 'Foo';
  $config['body']        = $config['body'] ?: 'Bar';
  $config['buttonText']  = $config['buttonText'] ?: 'Baz';
  $config['cancellable'] = $config['cancellable'] ?: true;
}

createMenu($menuConfig);
Good:

$menuConfig = [
  'title'       => 'Order',
  // User did not include 'body' key
  'buttonText'  => 'Send',
  'cancellable' => true,
];

function createMenu(&$config) {
  $config = array_merge([
    'title'       => 'Foo',
    'body'        => 'Bar',
    'buttonText'  => 'Baz',
    'cancellable' => true,
  ], $config);

  // config now equals: {title: "Order", body: "Bar", buttonText: "Send", cancellable: true}
  // ...
}

createMenu($menuConfig);
避免类型检查 (part 2)
Bad:

function combine($val1, $val2) {
  if (is_numeric($val1) && is_numeric(val2)) {
    return val1 + val2;
  }

  throw new \Exception('Must be of type Number');
}
Good:

function combine(int $val1, int $val2) {
  return $val1 + $val2;
}
封装条件语句

Bad:

if ($fsm->state === 'fetching' && is_empty($listNode)) {
  // ...
}
Good:

function shouldShowSpinner($fsm, $listNode) {
  return $fsm->state === 'fetching' && is_empty(listNode);
}

if (shouldShowSpinner($fsmInstance, $listNodeInstance)) {
  // ...
}
Bad:
不要写全局函数
function config() {
  return  [
    'foo': 'bar',
  ]
};
Good:

class Configuration {
  private static $instance;
  private function __construct($configuration) {/* */}
  public static function getInstance() {
     if(self::$instance === null) {
         self::$instance = new Configuration();
     }
     return self::$instance;
 }
 public function get($key) {/* */}
 public function getAll() {/* */}
}

$singleton = Configuration::getInstance();
```
###[做最好的 PHP 中文分詞](https://github.com/fukuball/jieba-php)
```js
ini_set('memory_limit', '1024M');

require_once "/path/to/your/vendor/multi-array/MultiArray.php";
require_once "/path/to/your/vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "/path/to/your/class/Jieba.php";
require_once "/path/to/your/class/Finalseg.php";
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
Jieba::init();
Finalseg::init();

$seg_list = Jieba::cut("怜香惜玉也得要看对象啊！");
var_dump($seg_list);

$seg_list = Jieba::cut("我来到北京清华大学", true);
var_dump($seg_list); #全模式

$seg_list = Jieba::cut("我来到北京清华大学", false);
var_dump($seg_list); #默認精確模式

$seg_list = Jieba::cut("他来到了网易杭研大厦");
var_dump($seg_list);

$seg_list = Jieba::cutForSearch("小明硕士毕业于中国科学院计算所，后在日本京都大学深造"); #搜索引擎模式
var_dump($seg_list);
```
###[Eruda 是一个专为手机网页前端设计的调试面板，类似 DevTools 的迷你版](https://github.com/liriliri/eruda/blob/master/doc/README_CH.md)
npm install eruda --save
var el = document.createElement('div');
document.body.appendChild(el);

eruda.init({
    container: el,
    tool: ['console', 'elements']
});
###[Fiddler|Fiddler安装与配置](https://zhuanlan.zhihu.com/p/22992759?refer=xmucpp)
