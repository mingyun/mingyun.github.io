
[安全课程](http://www.shiyanbar.com/courses)
[ctf安全工具](https://www.ctftools.com/down/)
[重温PHP手册 – 生成器](http://www.powerxing.com/php-review-generator/)
```js
function xrange($start, $limit, $step = 1) {
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }
 
        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }
 
        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}
将 range() 实现为生成器，主要是使用 yield 替代 return （并且一个生成器也不能 return，这会造成编译错误 如果 yield 后未跟变量，则返回 NULL 值
function getLines($file) {
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            yield $line;
        }
    } finally {
        fclose($f);     // 结束时关闭资源
    }
}
 
foreach (getLines("file.txt") as $n => $line) {
    if ($n > 5) break;
    echo $line;
}

非限定名称: 例如 $a = new foo();，如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。
限定名称: 例如 $a = new subnamespace\foo();，如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。
完全限定名称: 例如$a = new \currentnamespace\foo();，则总是被解析为代码中的文字名(literal name)currentnamespace\foo。

namespace NS;
 
define(__NAMESPACE__ .'\foo','111');
define('foo','222');
 
echo foo;   // 111.
echo \foo;  // 222.
echo \NS\foo  // 111.
echo NS\foo   // fatal error. assumes \NS\NS\foo.

在已有的word文档，或者模板中，插入一个表格
$table = $section->addTable();


$cellStyle = array( 'bgColor' => 'ffffff','borderColor' => '000000','cellMargin' => 50,'borderSize' => 6);


//$table = $section->addTable();
$table->addRow(300);
// Add cells
$table->addCell(2000,$cellStyle)->addText('Col 1');
$table->addCell(2000,$cellStyle)->addText('Col 2');
$table->addCell(2000,$cellStyle)->addText('Col 3');

$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$sTableText = $objWriter->getWriterPart('document')->getObjectAsText($table);

```
数据导出分页
```js
function getWebinarShare($id)
    {
        $str  = "用户ID,游客ID,参会ID,用户昵称,有效分享总数,微信分享总数,微博分享总数,QQ分享总数\n";
        $filename = 'webinar_share_stat'.$id.'_'.date('YmdHis').'.csv'; //设置文件名
        header("Content-type:text/csv");   
        header("Content-Disposition:attachment;filename=".$filename);   
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
        header('Expires:0');   
        header('Pragma:public');

        $count = WebinarShareStat::where('webinar_id', $id)->count();

        if($count <= 0){
            $str =  iconv('utf-8','GBK//IGNORE',$str);
            echo $str;
            exit;
        }

        $take = 1000;
        $s    = floor($count/$take);
        for ($i=0; $i<=$s; $i++) {
            if($i>0) $str = '';
            $skip   = $take * $i;
            $webinarShareStatObj = WebinarShareStat::where('webinar_id', $id)->skip($skip)->take($take)->get();
            foreach ($webinarShareStatObj as $list) {
                    $data['user_id'] = $userIsJoin->user_id;
                    $data['visit_id'] = $userIsJoin->visit_id;
                    $data['join_id'] = $userIsJoin->id;
                    $data['nick_name'] = $userIsJoin->name;
                    $data['total'] = $list['num'];
                    $data['weixin_total'] = $list['weixin'];
                    $data['weibo_total'] = $list['weibo'];
                    $data['qq_total'] = $list['qq'];

                    $str .= implode(',', $data)."\n";;
                }
            }
            //删除临时变量
            $str =  iconv('utf-8','GBK//IGNORE',$str);
            echo $str;
            unset($str);
            ob_flush();
            flush();
            sleep(1);
        }
    }
    $this->execute("UPDATE {table} SET `duration` = TIMESTAMPDIFF(MINUTE,`t_start`,'{$data['t_end']}') WHERE `id` = '{$data['id']}'");
```
phpquery querycc.list pyquery
[利用Content-disposition实现无刷新下载图片文件](http://www.powerxing.com/download-picture-without-refresh/)
```js
无刷新下载 rar 之类的文件很好实现：

通过 meta 标签: <meta http-equiv="refresh" content="url=http://down.load/file.rar">；
通过 Javascript 重定向: window.location.assign("http://down.load/file.rar")；
通过 Javascript 构建隐藏的 iframe 并设置 src $(body).append('<iframe style="display:none;" src="http://down.load/file.rar"')。
header('Content-Disposition: attachment; filename=girl.png');
// 禁止浏览器缓存，否则IE下可能会失效
header("Pragma: No-cache");
header("Cache-Control: No-cache");
header("Expires: 0");
 
// 简单的返回文件
echo file_get_contents('http://localhost/girl.png');
```
[SQL的JOIN语法解析(inner join, left join, right join, full outer join的区别)](http://www.powerxing.com/sql-join/)
```js
如果要找出在AA(左边的表)中有，而在BB(右边的表)中没有的数据项，可以使用如下的SQL语句
SELECT * FROM A LEFT OUTER JOIN B ON AA = BB WHERE BB is NULL
如果想要取得所有的元素项，则可以使用FULL JOIN:
SELECT * FROM A FULL JOIN B ON AA = BB
 
 AA         BB
--------   --------
 Item 1            <-----+
 Item 2                  |
 Item 3     Item 3       |
 Item 4     Item 4       |
            Item 5       +--- empty holes are NULL's
            Item 6       |
   ^                     |
   |                     |
   +---------------------+INNER JOIN将只会返回相匹配的元素项，即不会返回结果为NULL的数据项。
```
[重温PHP手册 – 引用](http://www.powerxing.com/php-review-reference/)
[重温PHP手册 – 异常](http://www.powerxing.com/php-review-exception/)
```js
function inverse($x) {
    if (!$x) {
        throw new Exception('Division by zero.');
    }
    else return 1/$x;
}
 
try {
    echo inverse(5);        // 0.2
    echo inverse(0);        // Caught exception: Division by zero.
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
 
// Continue execution
echo 'Hello World';
```
[TCP的构成与调优_《Web性能权威指南》读书笔记](http://www.powerxing.com/reading-high-performance-browser-networking-ch2/)
[php 易错知识盘点](http://phpbestpractices.justjavac.com/)
```js
 /* 定义变量区分大小写*/
    $abc=100;
    $Abc=200;

    echo $abc.'|'.$Abc; //输出100|200

    /*定义函数不区分大小写 下面写法系统会报错:Fatal error: Cannot redeclare Abc() */
    function abc(){
        echo 'abc';
    }

    function Abc(){
        echo "Abc";
    }
https://zhuanlan.zhihu.com/p/25088168

 $arr = [1,2,3];
    foreach($arr as &$v) {
        //nothing todo.
    }
    foreach($arr as $v) {
        //nothing todo.
    }
    var_export($arr);
    //output:array(0=>1,1=>2,2=>2)，你的答案对了吗？为什么
    //第一个foreach用引用赋值的方式将数组的值依次赋给了$v。 
$arr = array('a', 'b', 'c'); 
foreach($arr as &$v) {} 
var_dump($v); 
//此时的$v的值为c，是引用赋值，$v指向了字符串c的地址空间。 

//第二个foreach是以拷贝赋值的方式将数组的值依次赋值给了$v。 
//由于目前$v指向了c的地址空间，那么改变$v的值即改变了c所占地址空间的值。 
$arr = array('a', 'b', 'c'); 
foreach($arr as &$v) {} 
foreach($arr as $v) { 
var_dump($arr); break; 
} 
//第一次赋值将a赋值到了$v，原有c所占的地址空间的值变为了a，此时数组就是array('a', 'b', 'a')。 
//以此类推第一次赋值c->a，第二次赋值即a->b，第三次赋值即b->b， 
//所以最终结果为array('a', 'b', 'b')。
https://segmentfault.com/a/1190000004340634
// $a = "hello";
// $b = &$a;
// unset($b);
// echo $a;
//输出 hello
// var_dump(empty(false));
输出 true
final class demo
{
public static $count = 0;


function __construct()
{
self::$count++;
}
}


$a = new demo();
$b = new demo();
$c = new demo();
echo demo::$count;
输入 3
static属性常驻内存，不会被立刻回收
class A{
public $num = 100;
}
$a = new A();
$b = $a;
$b->num = 200;
echo $a->num;
输出：200
在php5，一个对象变量已经不再保存整个对象的值。只是保存一个标识符来访问真正的对象内容。 当对象作为参数传递，作为结果返回，或者赋值给另外一个变量，另外一个变量跟原来的不是引用的关系，只是他们都保存着同一个标识符的拷贝，这个标识符指向同一个对象的真正内容。
对象的复制是通过引用来实现的，$a=new A();$b=$a;相当于$a=new A();$b=＆$a;
在一个对象的方法中，$this 永远是调用它的对象的引用。
当用 global $var 声明一个变量时实际上建立了一个到全局变量的引用。也就是说下面两者是相同的：
// 两种定义是等价的
global $var;
$val =& GLOBALS['var'];
unset($var) 不会 unset 全局变量。
当 unset 一个引用，只是断开了变量名和变量内容之间的绑定。这并不意味着变量内容被销毁了
$a = 1;
$b =& $a;
unset($a);
echo $b;    // 1
返回新对象时，默认是返回引用，因此可以达到链式操作的效果
class Foo {
    public function sayHi() {
        echo 'Hi, ';
        return $this;
    }
    public function sayHello() {
        echo 'Hello';
        return $this;
    }
 
}
 
function test() {
    return new Foo();
}
 
test()->sayHi()->sayHello();
可以将一个变量通过引用传递给函数，这样该函数就可以修改其参数的值。注意在函数调用时没有引用符号——只有函数定义中有。
function foo(&$var)
{
    $var++;
}
 如果传递一个对象，函数内修改也会修改该对象 
$a=5;
foo($a);
$a = 1;
$c = 2;
$b =& $a;   // $b points to 1
$a =& $c;   // $a points now to 2, but $b still to 1;
echo $a, " ", $b;   // Output: 2 1
$a = 0123; // 八进制数 (等于十进制 83)
$a = 0x1A; // 十六进制数 (等于十进制 26)
当从浮点数转换成整数时，将向下取整（去掉小数位）-> 决不要将未知的分数强制转换为 integer!
echo (int) ( (0.1+0.7) * 10 ); // 显示 7!
$i = 6887129852;
echo "i=$i\n";
echo "i%36=".($i%36)."\n";  // -24, wrong
echo "alternative i%36=".($i-floor($i/36)*36)."\n"; // 20, right
永远不要相信浮点数结果精确到了最后一位，也永远不要直接比较两个浮点数是否相等
要测试浮点数是否相等，要使用一个仅比该数值大一丁点的最小误差值。该值也被称为机器极小值（epsilon）或最小单元取整数，是计算中所能接受的最小的差别值$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001; # 可以比较小数点后五位的浮点数
 
if(abs($a-$b) < $epsilon) {
    echo "true";
}
    $name = 'Star';
    $str = <<<EOD
        My name is $name,
        spanning multiple lines using heredoc syntax.
EOD;
    echo $str;
 
    // 注意作为参数传递时，结束标识符后不能有任何内容，包括分号。
    foo(<<<END
        abcd
END
);
 // 有效的表示
echo "This is $great";
echo "This is {$great}";
echo "This is ${great}";
 
// 需注意的是数组，只能用 花括号 才能正确解析带引号的键名。
echo "resut: $arr[0]";              // 有效
echo "result: $array['result']";    // 出错
echo "result: {$array['result']}";  // 有效
echo "result: ".$arr['result'];     // 有效

function getArray() {
    return array(1, 2, 3);
}
 
// on PHP 5.4
$secondElement = getArray()[1];
 
// previously
$tmp = getArray();
$secondElement = $tmp[1];
 
// or
list(, $secondElement) = getArray();

$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001; # 可以比较小数点后五位的浮点数
 
if(abs($a-$b) < $epsilon) {
    echo "true";
}
    $name = 'Star';
    $str = <<<EOD
        My name is $name,
        spanning multiple lines using heredoc syntax.
EOD;
    echo $str;
 
    // 注意作为参数传递时，结束标识符后不能有任何内容，包括分号。
    foo(<<<END
        abcd
END
);
 // 有效的表示
echo "This is $great";
echo "This is {$great}";
echo "This is ${great}";
 
// 需注意的是数组，只能用 花括号 才能正确解析带引号的键名。
echo "resut: $arr[0]";              // 有效
echo "result: $array['result']";    // 出错
echo "result: {$array['result']}";  // 有效
echo "result: ".$arr['result'];     // 有效

function getArray() {
    return array(1, 2, 3);
}
 
// on PHP 5.4
$secondElement = getArray()[1];
 
// previously
$tmp = getArray();
$secondElement = $tmp[1];
 
// or
list(, $secondElement) = getArray();
class MyClass { 
    public $property = 'Hello World!'; 

    public function MyMethod() 
    {
        call_user_func(array($this, 'myCallbackMethod'));
    }

    public function MyCallbackMethod()
    {
        echo $this->property; 
    }
}
// 回调函数
function my_callback_function() {
    echo 'hello world!';
}
 
// 回调方法
class MyClass {
    static function myCallbackMethod() {
        echo 'Hello World!';
    }
}
 
// Type 1: 简单的回调
call_user_func('my_callback_function'); 
 
// Type 2: 静态回调方法
call_user_func(array('MyClass', 'myCallbackMethod')); 
 
// Type 3: 对象回调方法
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));
 
// Type 4: 静态回调方法 (As of PHP 5.2.3)
call_user_func('MyClass::myCallbackMethod');
$a = array();
 
$a == null  <== return true
$a === null <== return false
is_null($a) <== return false
$obj = (object) 'ciao';
echo $obj->scalar;      // outputs 'ciao'
 
$arrObj = (object) array('a' => 'aa', 'b'=> 'bb');
echo $arrObj->a;        // outpus 'aa'
echo $arrObj->{'a'}     // outpus 'aa'
$arrObj = (object) array('aa', 'bb');
var_dump($arrObj); // object(stdClass)#1 (2) { [0]=> string(2) "aa" [1]=> string(2) "bb" }
echo $arrObj->{0}; // Notice: Undefined property: stdClass::$0 in... 将数组转换为Object，务必指定键名，且不能使用数字型，否则无法获取（即使能正确转换）。注意语法为 $arrObj->{‘key’} 
若将NULL值转换为数组，则会返回空数组，这点特性可以用在一些地方。例如需要合并两个数组，但其中一个数组可能为NULL
// $values可能为NULL.
$combined = array_merge((array)$values, $other);
如果在$_POST数组(从form中传递过来)中使用字符串作为键名，键名中的小数点、空格会转换为下划线。程序中操作$_POST数组，则不会有这个情况defined('CONSTANT') or define('CONSTANT', 'SomeDefaultValue');

define('MAX_VALUE', 1);
echo MAX_VALUE;                 // 输出 1
echo constant('MAX_VALUE');     // 也可通过函数获取
静态变量仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失。

/* 多次执行 test()， $a 可以累加 */
function test()
{
    static $a = 0;
    echo $a;
    $a++;
}
静态变量复制时不能使用表达式。如 static $int = 1+2; 是错误的。
$a = 1; 
 
function Test()
{
    global $a;
    echo $a; 
}
 
Test();
$a = 1; 
 
function Test()
{
    echo $GLOBALS['a']; 
}
 使用 $GLOBALS 数组，$GLOBALS 是超全局变量，即在一个脚本中的全部作用域中都可用，而无需执行 global $variable，如 $_SERVER 变量。
Test();
逻辑运算符总是返回布尔值
$a = 0 || 'avacado';
print "A: $a\n"; // 输出 1（布尔值true）
and 和 or 的优先级比较低，低于 &&、||、=
$e = false || true; // 判断 (false || true) 是否成立
$f = false or true; // 先执行赋值 $f = false ，再判断 $f or true 是否成立
var_dump($e, $f);   // true, false
 
$g = true && false;  // 判断 (true && false) 是否成立
$h = true and false; // 先执行赋值 $f = false ，再判断 $f and true 是否成立
var_dump($g, $h);    // false, true
($a = $_GET['var']) || ($a = 'a default');

defined('VALUE') or define('VALUE', 'v');
$i = 0;
while (++$i) {
    switch ($i) {
    case 5:
        echo "At 5<br />\n";
        break 1;  /* 只退出 switch. */
    case 10:
        echo "At 10; quitting<br />\n";
        break 2;  /* 退出 switch 和 while 循环 */
    default:
        break;
    }
}
注意生成对象是自动传递引用，所以如果匿名函数传递的是对象，要特别注意，应传递引用：
```
[Hadoop安装配置简略教程](http://www.powerxing.com/install-hadoop-simplify/)
[&符号引用传递会对运算结果有什么影响？](https://segmentfault.com/q/1010000009859640)
```js
$b = &$a;
这个操作，可以认为，$a和$b都指向原本$a变量所在的那块内存（为了方便后面解释，称为内存X），也就是说，后面任何对于$a或者$b的操作，都是在直接对这块内存里的值进行修改。

所以加上这一行之后的运行流程：

前面步骤省略，初始a为1
$c = (++$a) + (++$a)的两次++$a都是在操作内存X，也就是把内存X里的值自增了两次，所以，在运算$c的值的时候，取的是这个内存里数的值，也就是自增了两次之后的内存X里的值。所以，是3 + 3 = 6（运算$c时候，内存X里存的值是3）。
这个跟PHP的底层实现有关，说起来很长，推荐看一下github上同样问题的解析
一个PHP bug引发的探索
https://github.com/xurenlu/phplearn/blob/master/%E4%B8%80%E4%B8%AAPHP%20bug%E5%BC%95%E5%8F%91%E7%9A%84%E6%8E%A2%E7%B4%A2.md

权限管理，通常使用 RBAC (Role-Based Access Control) 模式。https://segmentfault.com/q/1010000009856212
R : role 代表角色，主要给各个权限分组，例如管理员，编辑，审核员等等。
具体思路：
给程序的每个模块，可以考虑是每个 Controller 甚至细化到每个控制器的function。给这些模块取一个名字，记到数据库里，同时在程序里标识上。
然后把这个模块和角色（role）关联起来，记到一张表里，比如说编辑，可能操作的模块是写文章，编辑文章等等。
最后把 user 和 角色关联起来。
这样，当某个用户要执行某个操作（访问某个action的时候），可以把当前用户处在哪个角色读出来。然后根据角色信息去角色模块对应表里找，是否有当前操作模块的记录，有的话说明有授权。
以上是基本思路，不仅是CI，其它的框架也能用
```
[php 把字符串打散成字符数组](https://segmentfault.com/q/1010000009853345)
```js
function mb_str_split($str)
{
    return preg_split('/(?<!^)(?!$)/u' , $str);
}$string = '中国共产党万岁！aaaaa';
var_dump(preg_split('//u', $string, 0, PREG_SPLIT_NO_EMPTY));
preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
bash变量赋值时等号两边不能有空格，应写成：

dir=/webserver/test/
写明文档类型为 XML

header("Content-Type:text/xml; charset=UTF-8");
```
[微信重定向至服务器会发送两次请求?](https://segmentfault.com/q/1010000009846666)
[php 数组改造](https://segmentfault.com/q/1010000009852041)
```js
$str = '[["10","荔枝好吃"],["11","葡萄好吃"],["18","菠萝好吃"]]';// 字符串
$arr = array_reduce(json_decode($str,true),function($c,$v){$c[$v[0]]=$v[1];return $c;},[]);
var_dump($arr); // 对应数组
/*
array(3) {
  [10]=>
  string(12) "荔枝好吃"
  [11]=>
  string(12) "葡萄好吃"
  [18]=>
  string(12) "菠萝好吃"
}
*/$arr = [["10","荔枝好吃"],["11","葡萄好吃"],["18","菠萝好吃"]];
echo "<pre>";
print_r(array_column($arr, 1, 0));
var_dump(json_decode('[["10","荔枝好吃"],["11","葡萄好吃"],["18","菠萝好吃"]]'));
PHP 如何判断数组里的键值是否使用相同键名，并输出当前相同键名的键值？https://segmentfault.com/q/1010000009909093
$target = [50, 59, 65];
foreach($arr as $index => $value) { // 遍历整个$arr
    $keys = array_keys($value); // 获取对应项的键值

    $check = true; // 默认为真，如果下面遍历中出现一个假值则为假，否则真值表示所有的目标键名都在此项中

    foreach($target as $target_key) { // 遍历所有的目标键名
        if(!in_array($target_key, $keys)) { // 如果发现目标键名不在当前项键名$keys中，则设置$check为假值，并直接跳出
            $check = false;
            break;
        }
    }

    if($check) { // 通过了键名检测，那么这就是要找的项，输出
        print_r($index);
        print_r($value);
    }
}
Redis下批量删除特定pattern的keyshttp://www.revotu.com/redis-delete-multiple-keys-by-pattern.html
redis-cli -h [host] -p [port] -n [db] KEYS "pattern" | xargs redis-cli -h [host] -p [port] -n [db] DEL
有用的在线工具http://www.revotu.com/useful-online-tools.html  PDF转换(Image、Word、Excel等)工具https://www.freepdfconvert.com/
在线正则表达式测试http://www.rubular.com/  在线文件对比 https://www.diffchecker.com/ 各种编程语言在线编译：ideone
```

[可视化理解SQL的JOIN用法](http://www.revotu.com/a-visual-explanation-of-sql-joins.html)

[PHP如何实现内容实时输出？](https://segmentfault.com/q/1010000009799179)
```js
for($n = 1; $n < 100; $n++) {
    echo chr(3); // 输出文本结束控制字符，这样可以清除之前输出的文本内容
    echo chr(8); // 将前一个控制字符删掉，避免在控制台留下控制字符的标记
    echo "inserting row $n\r";
    sleep(1); // 延时一秒是为了看清楚文字变化
}
```

[phpunit单元测试问题](https://segmentfault.com/q/1010000009911902)
[php 的 opcache 和最近的 php jit 有什么区别](https://segmentfault.com/q/1010000009911944)
Windows上如果PHP连接MySQL的host使用了localhost,改成127.0.0.1试试.因为Win7上my.ini里配置了bind-address=127.0.0.1,PHP用localhost连接会被卡1秒.
源代码(人认识)->字节码(解释器认识)->机器码(硬件认识)
来看下PHP的执行流程，假设有个a.php文件，不启用opacache的流程如下：
a.php->经过zend编译->opcode->PHP解释器->机器码
启用opacache的流程如下
a.php->查找opacache缓存，如果没有则进行zend编译为opcode并缓存->opacode->PHP解释器->机器码
启用jit的流程如下
a.php->编译->机器码
以后都只执行机器码，不编译，效率上高了很多
[php 记住密码登陆如何做安全](https://segmentfault.com/q/1010000009891388)
首先，登录成功了之后，随机生成一个MD5的hash值token（32位或者64位）；
然后，把这个token存入当前用户的表，然后给这个用户增加一个token字段和last_login_time字段；
把这个token返回让浏览器的cookie存储，设置一个最长时常，比如30天；
这三个过程的主要作用就是，last_login_time可以检查过期时间，过期时间到了之后，就更新这个token，另外，只要用户通过这个token登录成功就进行更新token，这样就能尽可能的保证安全。

每次用户访问网站的时候，检查cookie里是否有token，如果有token就去数据库查询数据，如果查到就直接登录成功了，也就省去了用户名和密码验证登录的阶段。

整套思想是这样，你也可以让前端把token存入localstorage
[504 Gateway Time-out之后，代码还会继续执行吗？](https://segmentfault.com/q/1010000009893442)
nginx 504 之后，php 还有可能会执行一段时间。具体看 nginx 的超时设置 和 php 的超时设置。
代码不会继续执行了，就是因为代码得不到请求，所以才会出现504Gateway Time-out
[PHP的链式调用](https://segmentfault.com/q/1010000009821945)
```js
class Api
{
    public function auth(){
        //quiet a few
        var_dump(222);
    }
    public function render(){
        //quiet a few
    }
}

class Site{
    static private $_api;

    public function api(){
        if(self::$_api != NULL) {
            var_dump(1);
            return self::$_api;
        }else {
            var_dump(2);
            self::$_api = new Api();
            return self::$_api;
        }
        
    }
}
说明第一次调用auth()进了api()的else执行语句，第二次调用render()进入if语句，说明返回的是同一个实例。

不管你调用多少次，返回的都是一个实例，这就是单例模式
$site = new Site();
echo $site->api()->auth();
echo $site->api()->render();
php如何返回值为000001而不是1 str_pad($number, 6, '0', STR_PAD_LEFT);
sprintf("%06d", $num);
过大浮点型数据比较大小https://segmentfault.com/q/1010000009860352
if(bcsub($a,$b,1)==0){
    echo '相等';
}
$a = 12345678912345678.8;
    $b = 12345678912345678.9;
    if (strval($a) == strval($b)) {
        echo '相等';
    }
```
[什么样的架构能防止表结构变动后程序运行错误？](https://segmentfault.com/q/1010000009855063)


[去除多维数组的最外层key 保留值](https://segmentfault.com/q/1010000009893220)
[接口 sign 被破解的可能性猜想](https://segmentfault.com/q/1010000009897364)
```js
//保密token串
$token = '249238jdush24hgdddf/sds_assd_&ssa23_sd';
//业务参数对开公开
$str = 'name=zhangsan&id=23';
//保密的签名算法
$sign = md5($str.$token);
只要你的token不被泄露，此方法不会有问题。
更加保密一点的方案是加上timestamp，比如大于600秒之外的请求全部无效。
$md51 = md5('QNKCDZO');
$a = @$_GET['a'];
$md52 = @md5($a);
if(isset($a)){
if ($a != 'QNKCDZO' && $md51 == $md52) {
    echo "nctf{*****************}";
} else {
    echo "false!!!";
}}
else{echo "please input a";}
```
[]()
[不超时的后台进程or守护进程or在若干小时后执行的cron进程](https://segmentfault.com/q/1010000009855040)
如果你的系统使用systemd，可以利用它的计时器systemd.timer来完成你的需求 文章里的at的at now + n units是一个很好的选择
[openssl linux 和 windows 下 密钥签名结果不一致](https://segmentfault.com/q/1010000009846914)
```js
echo aaaaa | openssl rsautl -sign -inkey xxxx.pem | openssl enc -base64
"echo aaaaa"输出的结果带回车，即“aaaaa\n”，要输出纯字符串“aaaaa”的话需要使用"echo -n aaaaa"，不确定是不是这个原因，仅供参考
在linux和windows输出时字符时的问题,在Linux上会追加\n,而在Windows上会追加\r\n。对于这种情况,可以使用python来进行兼容:

import base64
data = 'aaaaa'
base64.b64encode(data)
>>> 'YWFhYWE='
```
[foreach既然是操作原数组的副本，为什么这样写还能改变原数组呢](https://segmentfault.com/q/1010000009881240)
你加了&符号后不是使用的是原数组的拷贝。不加&符号确实是原数组的拷贝。加&符号相当于一个指针，把名字赋给它而已。所以你改变你新的数组，原来的数组也会改变。自 php 5 起，可以很容易地通过在 $value 之前加上 & 来修改数组的单元。此方法将以引用赋值而不是拷贝一个值。

<?php
$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
}
// $arr is now array(2, 4, 6, 8)
mysql可以承受下的確可以用全文索引。但個人建議假如這樣的搜索訪問量大的話還是使用sphinx比較好'
SELECT * from expert where(expert_name like '%迷糊%' and status= 1 ) OR FIND_IN_SET(40,keywords)
update user u,single s set u.user = '值', s.user = '值' where u.user = u.user and u.id = '条件'
[mysql查询](https://segmentfault.com/q/1010000009870691)
select name, sum(case when Course='Chinese' then Score end) as Chinese,
sum(case when type='Math' then Score end) as Math,
sum(case when type='English' then Score end) as English
from table1
group by name
[MySQL混合utf8 utf8mb4是否比纯utf8mb4更具优势？](https://segmentfault.com/q/1010000009853687)
```js
没有太多优势
因为utf8mb4仅在emoji等特殊字符的时候用到了4个字节存储
其余时候表现和mysql的utf8字符集是一样的, 存储汉字仍然是3个字节

(因为mysql的utf8字符集的单个字符的最大长度方面的实现是错误的, 所以才冒出个utf8mb4字符集出来, 实际上这个utf8mb4就是标准的utf8)

当然, 需要避免使用char, 改用varchar, 因为mysql的char列类型在utf8mb4下, 为了保证所有的数据都存的下, char将会占用字符数*4的字节数 (mysql的char列类型utf8将占用字符数*3的字节数), 以保证空间分配足够. 所以建议用可变长度varchar, 以节省空间. 可变长度消耗的存储空间为: 实际存储需要的字节数+1或2个字节表达的长度.

另外对于纯英文字符的列, 你可以另外考虑varbinary(可变长度binary)和binary列(适用于固定长度的英文字符, 例如密码哈希)类型, 性能比varchar略好, 因为这个存储二进制数据
```
[mysql主从，从库锁表会导致复制阻塞](https://segmentfault.com/q/1010000009875708)
主从同步是通过binlog进行的，从库有两个线程，一个负责接受binlog日志，一个负责解析日志将数据写入库中。所以主从同步一般是有一定的延时的。
至于读写锁的问题，写锁是排他的，读锁可以多次获得。在Innodb中，锁分为表锁、行锁和间隙锁，具体看你的操作，如果一个插入操作需要锁表，而这时有查询锁住了该表中的一行，自然是需要等待的。
[Python 怎么操作windows系统服务](https://segmentfault.com/q/1010000009881227)
```js
def listservices():
    import wmi
    c = wmi.WMI()
    for service in c.Win32_Service():
        #print(service.Caption,service.StartMode,service.State)
        print(service.Caption)     #名称
        print(service.StartMode)   #启动类型
        print(service.State)       #状态
if __name__=='__main__':
    listservices()
    
    import wmi
c = wmi.WMI()
for service in c.Win32_Service(Name="seclogon"):
  result, = service.StopService()
  if result == 0:
    print "Service", service.Name, "stopped"
  else:
    print "Some problem"
  break
else:
  print "Service not found"
```
[如何正则字符串中的所有汉字](https://segmentfault.com/q/1010000009861809)
pattern = re.compile(ur"[\u4e00-\u9fa5]")
print pattern.findall(s.decode('utf8'))
这里的decode('utf8')是怕s的值为类似\x66\x77\x88这样的Unicode散列。另外，需要注意compile()中ur修饰符，u为Unicode修饰符。

[python正则怎么提取域名](https://segmentfault.com/q/1010000009847289)
```js
正则表达式如何匹配重复出现的字符串https://segmentfault.com/q/1010000009828634
var s = 'aaabccc11fdsa';
var re = /(.)\1+/g;

console.log(s.match(re));
其中，正则表达式中.表示任意字符，\1表示第一个被匹配到的分组，+表示匹配前一个字符一次或一次以上
preg_match_all(
    '/(\w)\1+/i',
    'aaabccc11fdsa',
    $matches,
    PREG_PATTERN_ORDER
);
print_r($matches[0]);
(\w)匹配字母数字下划线即[a-zA-Z0-9_]
((\w)\2)匹配重复的字符，其中\2匹配分组number是2的分组，因为最外层有圆括号，所以number是2的分组就是前面\w匹配的字符
((\w)\2+)匹配重复出现2次或以上的字符
>>> import re
>>> str = 'aaabccc11fdsa'
>>> re.findall(r'((\w)\2+)', str)
[('aaa', 'a'), ('ccc', 'c'), ('11', '1')]
>>> [match[0] for match in re.findall(r'((\w)\2+)', str)]
['aaa', 'ccc', '11']

第一是用sys.path.append()方法，将当前目录添加到模块搜索的目录列表中，如sys.path.append(dir_path)
第二是将当前目录的路径添加到系统的PYTHONPATH环境变量里去

import json

str = '''
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "SaleEvent",
    "name": "10% Off First Orders",
    "url": "https://www.myvouchercodes.co.uk/coggles",
    "image": "https://mvp.tribesgds.com/dyn/oh/Ow/ohOwXIWglMg/_/mQR5xLX5go8/m0Ys/coggles-logo.png",
    "startDate": "2017-02-17",
    "endDate": "2017-12-31",
    "location": {
        "@type": "Place",
        "name": "Coggles",
        "url": "coggles.co.uk",
        "address": "Coggles"
    },
    "description": "Get the top branded fashion items from Coggles at discounted prices. Apply this code and enjoy savings on your purchase.",
    "eventStatus": "EventScheduled"
}</script>
'''

d = json.loads(re.search('({[\s\S]*})', str).group(1))
print d['location']['url']
```
[Python如何统计某一文件夹下文件数量](https://segmentfault.com/q/1010000009917433)
```js
tite = '......' #网页title中包含换行
print(re.findall('(?<=\<title\>).+?(?=\<)', title, re.S))

就是让你配置好环境变量而已. 如果你有一个项目叫做pythonCodes, 然后你要在系统属性->环境变量->path, 将你这个pythonCodes绝对路径加进去, 这样的话, 你在pythonCodes里面写python脚本, 例如command.py, 就能够直接通过win+R,然后通过输入command.py直接运行..
Python默认查找包的地方有以下几个：

Python安装目录下的site-packages目录
环境变量PYTHONPATH的目录
当前目录
sys.path.append(...)添加的目录（这个是临时的）
然而如果你只把包放在了C盘下面，那么它不属于任何一种情况，Python当然就找不到包了。除了sys.path.append()方法，上面方法中还有将C:\加到PYTHONPATH环境变量也是可以的。
XPath中变量用$somevariable语法即$符号加变量名，然后在xpath方法调用时传参变量值。
xpath中如何使用变量
>>> # `$val` used in the expression, a `val` argument needs to be passed
>>> response.xpath('//div[@id=$val]/a/text()', val='images').extract_first()
u'Name: My image 1 '
>>> import os
>>> DIR = '/tmp'
>>> print len([name for name in os.listdir(DIR) if os.path.isfile(os.path.join(DIR, name))])
http不只有get方法（请求头部+正文），还有head方法，只请求头部。
import re, requests

r = requests.get("http://...页面地址..")
p = re.compile(r'相应的正则表达式匹配')
image = p.findall(r.text)[0]  # 通过正则获取所有图片的url
ir = requests.get(image)      # 访问图片的地址
sz = open('logo.jpg', 'wb').write(ir.content)  # 将其内容写入本地
print('logo.jpg', sz,'bytes')
```
[]()
[这几个软件你可能没听过，但真的好用到爆！](https://zhuanlan.zhihu.com/p/27479267)
第一款神器叫Listary，这是一款文件搜索的工具。第二款神器叫图片助手，这是一款图片下载的工具。 第五个神器叫Listen1 ，这是知友stormzhang推荐的神器
文字云的工具，以前讲过叫tagul，现在改名叫WordArt，是一个在线文字云的生成网站第七个神器是 http://UZER.ME 这是一个云端的应用网站
[Python Selenium WebDriver简明指南](http://www.revotu.com/python-selenium-webdriver-concise-guide.html)
```js
等待元素动态加载完成
driver = webdriver.Firefox()
driver.implicitly_wait(10) # seconds
driver.get("http://somedomain/url_that_delays_loading")
myDynamicElement = driver.find_element_by_id("myDynamicElement")
```
[Python获取当前时间](http://www.revotu.com/how-to-get-current-time-in-python.html)
```js
import time
## 24 hour format
time.strftime("%H:%M:%S") # 输出 18:58:17
## 12 hour format
time.strftime("%I:%M:%S") # 输出 06:58:17
time.strftime("%Y-%m-%d") # 输出 2017-06-23
datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S") # 输出 2017-06-23 18:58:17
now = datetime.datetime.now() # 当前datetime，输出 datetime.datetime(2017, 6, 23, 19, 13, 43, 555000)
now.year                      # 年
now.month                     # 月
now.day                       # 日
now.hour                      # 时
now.minute                    # 分
now.second                    # 秒
now.isoformat() # Date and time in ISO format，输出 2017-06-23T19:16:21.835000
```
[把自己fork别人的仓库中的代码更新至最新版本？](https://segmentfault.com/q/1010000009818126)
```js
git remote add upstream 原作者仓库地址
此时再用 git remote -v 就可以看到一个origin是你的，另外一个upstream是原作者的。

其次 更新代码

使用git fetch upstream 拉去原作者的仓库更新。

使用git checkout master 切换到自己的master

使用 git merge upstream/master, merge或者rebase到你的master
```
[想导出微信的朋友圈怎么办？](https://www.zhihu.com/question/25026007/answer/183261557)
[shell脚本中怎么判断发行版](https://segmentfault.com/q/1010000009829086)
uname -a 会给出 Linux/Unix, 32/64 位等信息
lsb_release -a cat /proc/version cat /etc/*-release
[如何对api接口进行限流](https://segmentfault.com/q/1010000009874889)
既然问题的标签里有 laravel，那么现成的解决方案，我推荐，https://github.com/dingo/api，这个包有个特性 Rate Limiting，应该就是你要找的。

如果你要自己实现也简单的，根据 【user_id + 设备唯一码】做主键，访问次数存 redis，记录访问的次数，然后具体频率，次数，都看你实现策略了
http://blog.41ms.com/post/61.html
Nginx 模块limit_req_zone $binary_remote_addr zone=one:10m rate=1r/s;

[PHP 下载 url 远程图片](https://zhuanlan.zhihu.com/p/27484500)
```js
function download($url, $path = 'images/') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    $file = curl_exec($ch);
    curl_close($ch);
    $filename = pathinfo($url, PATHINFO_BASENAME);
    $resource = fopen($path . $filename, 'a');
    fwrite($resource, $file);
    fclose($resource);
}

作者：Jelly Bool
链接：https://zhuanlan.zhihu.com/p/27484500
来源：知乎
著作权归作者所有，转载请联系作者获得授权。
```
[PHP能做什么好玩的事？](https://www.zhihu.com/question/36157365/answer/187230179)
```js
基于Swoole,寥寥几行PHP代码就能轻松实现一个基于WebSocket(全双工通信)的聊天室.

server.php:
<?php
$ws = new swoole_websocket_server('0.0.0.0', 8080);
$ws->on('message', function($ws, $frame) {
	// 消息建议用JSON格式,这里为了方便示例,用普通字符串
	$msg = '<p>From ' . $frame->fd. ':<br><b>' . $frame->data . '</b><br>时间: ' . date('Y年m月d日 H:i:s') . '</p>';
	// 广播: 发送消息给所有客户端
	foreach($ws->connections as $fd) { $ws->push($fd, $msg); }
});
$ws->start();
?>

index.php:
<script>
var ws = new WebSocket("ws://0.0.0.0:8080");
ws.onmessage = function(e) {
	$("#content").prepend(e.data);
}
$(document).on("click", "#send", function() {
	ws.send($("#msg").val());
});
</script>
```




[mysql查询所有曾经降过薪的员工 emp_no 以及降薪幅度](https://www.v2ex.com/t/370157)
select a.emp_no,b.salary-a.salary, a.to_date 
from salaries a join salaries b 
on a.emp_no=b.emp_no and a.to_date>b.to_date and a.salary<b.salary and a.from_date=b.to_date;
[PHP 中'false'等于 true '0'==false](https://www.v2ex.com/t/369755)
```js
当字符串和布尔值进行比较时，会先将字符串转换成布尔值。

而字符串中除了'0'等于false之外，其他字符串都等于true。

即便是'0.0'、'-0'也都等于true。
$a= 0; 
var_dump($a == "imageUrl");//输出 bool(true)
$falseArr = [
    '',
    '0',
    0,
    false,
    [],
    null
];


$trueArr = [
    ' ',
    'false',
    '123',
    'abc',
    1,
    true,
    ['val'],
    new stdClass,
    function(){}
];
$print = function ($arr) {
    foreach ($arr as $v) {
        var_dump($v==false);
    }
};

$print($falseArr);
echo "\n";
$print($trueArr);
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)

bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
```
[喜马拉雅在线json](http://www.ximalaya.com/tracks/1099713.json)
[解决Redis之MISCONF Redis is configured to save RDB snapshots](http://www.jianshu.com/p/3aaf21dd34d6)
强制关闭Redis快照导致不能持久化。
127.0.0.1:6379> config set stop-writes-on-bgsave-error no
set stop-writes-on-bgsave-error yes
[php在线库](http://www.ctolib.com/article/wiki/11055)
[支付宝即时到账 SDK 简化版](https://github.com/mytharcher/alipay-php-sdk)
[支付宝](https://github.com/lokielse/omnipay-alipay-example/issues/6)
[手机网站支付快速接入](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.DGFUxo&treeId=193&articleId=105285&docType=1)
手机网站支付老版本请求支付宝的网关地址为：https://mapi.alipay.com/gateway.do；

手机网站支付新版本请求支付宝的网关地址为：https://openapi.alipay.com/gateway.do；
如果使用 md5 不需要秘钥 新接口需要创建应用
[Payment是一个php版本的支付聚合第三方sdk，集成了微信支付、支付宝支付](https://github.com/helei112g/payment)
[支付宝SDK在Laravel5的封装。](https://github.com/latrell/Alipay)
[微信自动加群](pan.baidu.com/s/1nuU3dl3)
密码79yd http://mp.weixin.qq.com/s/Q5IfQvxD7sTueGjtRfq9Kg
```js

import itchat
from itchat.content import *
#自动同意好友申请
@itchat.msg_register(FRIENDS)
def add_friend(msg):
    itchat.add_friend(**msg['Text']) # 该操作会自动将新好友的消息录入，不需要重载通讯录
    itchat.send_msg('你好，回复[我要加群]获取群信息哦', msg['RecommendInfo']['UserName'])


# 回复群消息
@itchat.msg_register('Text')
def text_reply(msg):
    #查看msg中都有啥
    # print( msg['FromUserName'])  #发信息的人的UserName
    #创建一个字典用来保存群名称
    qun_name = []
    #存储群的username
    qun_username = {}
    #保存群名称和对应的MemberList
    qun_member_list = {}
    #群名称和对应群成员的数量
    qun_name_count = {}
    #应该在用户问之前获取所有群聊获取所有群聊
    grouplist = itchat.get_chatrooms(update=True)[1:]


    for group in grouplist:
        # print( group['MemberCount'])
        # print( group['MemberList'] )
        qun_name.append(group['NickName'])
        #根据群名称存入username
        qun_username[ group['NickName'] ] = group['UserName']
        qun_member_list[ group['NickName'] ] = group['MemberList']
        qun_name_count[ group['NickName'] ] = group['MemberCount']


    if msg['Text']=='我要加群':
        itchat.send('你好，有以下群聊：\n{}'.format( qun_name ) , toUserName=msg['FromUserName'])
        itchat.send('请回复你要加入的群名称[爱心]' , toUserName=msg['FromUserName'])
#https://github.com/jinfagang/blogo.git 写博客神器，人工智能自动生成博客，go语言实现，求star


    #回复指定的群名称进群
    #在qun_name中查找，看看是不是有该群
    # print( len(qun_name ))
    for i in range(0,len(qun_name)):
        if msg['Text']==qun_name[i]:
            #根据群名称获取对应的群所有成员信息
            menber_list = qun_member_list.get( msg['Text'] )
            for m in menber_list:
                # 判断发消息的人的username是否在该群里面
                 if m['UserName'] == msg['FromUserName']:
                     itchat.send('你已加入该群聊，请勿重复增加！', toUserName=msg['FromUserName'])
                     return
            #获取群名称对应的username
            chatroomUserName = qun_username.get( msg['Text'] )
            friend = msg['User']
            #发送群邀请
            itchat.add_member_into_chatroom(chatroomUserName, [friend], useInvitation=True)


if __name__ == '__main__':
    itchat.auto_login(hotReload=True)
    # 获取自己的UserName
    myUserName = itchat.get_friends(update=True)[0]["UserName"]
    # 显示所有的群聊，包括未保存在通讯录中的，如果去掉则只是显示在通讯录中保存的
    itchat.dump_login_status()
    itchat.run()


```
[larave session问题，为什么每次session_id都要变](https://segmentfault.com/q/1010000009694886)
[github怎么提交回退旧版本代码并更改后的文件到主分支上](https://segmentfault.com/q/1010000009800764)
[让git命令行保存github的登录状态](https://segmentfault.com/q/1010000009785643)
echo命令本身默认会在输出字符串后面追加一个换行符，可以通过增加一个选项-n来阻止此默认行为echo -ne "\n"
 删除当前目录下 10天前的子目录 find . -maxdepth 1 -type d -mtime +10|xargs rm -rf
[将100之内的数字中文转换..](https://segmentfault.com/q/1010000009760061)
[正则表达式问题](https://segmentfault.com/q/1010000009745638)
# coding: utf8
filename = '2.txt'
with open(filename) as f:
    for i in f:
        result = i.split()
        print result[1], result[-1]
        
[php 如何解析既有值又有属性的 xml 标签？](https://segmentfault.com/q/1010000009762137)        
$xml = simplexml_load_string($content);
foreach($xml->attributes() AS $a => $b) {

echo "$a = $b <br />";
}
[数字变为文字](https://segmentfault.com/q/1010000009747721)   
[python中eval的问题](https://segmentfault.com/q/1010000009808234)
```js
python有 decimal 和 fraction 2个模块用来进行高精度浮点计算
>>> from fractions import Fraction
>>> Fraction('0.3')-Fraction('0.1') == Fraction('0.2')
True
>>> from decimal import Decimal
>>> Decimal('0.3')-Decimal('0.1') == Decimal('0.2')
True
>>> 
eval('0.3-0.1==0.2')  # 输出为False, 是因为0.3-0.1=0.19999999999999998
eval('%d - %d == %d'%(0.3, 0.1, 0.2))  # 输出为True, 是因为你%d传入是整数，相当于0-0=0
eval('%s - %s == %s'%(0.3, 0.1, 0.2))  # 输出为False, 参考1
eval('%s - %s == %s'%('0.3', '0.1', '0.2'))  # 输出为False, 参考1
```
[python如何转换时间戳到"2017年6月12日 18点24分"这样的格式](https://segmentfault.com/q/1010000009748841)
```js
import time
print('%s年%s月%s日 %s时%s分' % time.localtime(1497254119.69407)[:5])
timestamp = time.time() - 3600   # 时间戳
print(time.strftime('%Y{y}%m{m}%d{d} %H{H}%M{M}', time.localtime(timestamp)).format(y='年', m='月', d='日', H='时', M='分'))
#统计出现次数
lst = [1,1,2,2,3,3,4,4,5,6]
print len(set(lst))

#统计每种各出现几次
from collections import Counter
print dict(Counter(lst))
```
[php字符串比较](https://segmentfault.com/q/1010000009794813)
[Python 爬虫中完成 JavaScript 函数翻页?](https://segmentfault.com/q/1010000009753395)
[一段不减的整数，如11111223333，怎么快速计算重复次数最多的那个数](https://segmentfault.com/q/1010000009695220)
```js
其实这种标准字典格式的，eval是最简单的。https://segmentfault.com/q/1010000009813506
t='''{"status": "0", "msg": "ok", "result": {"name": "露水", "content": 
"<p>释名在秋露重的时候，早晨去花草间收取。</p><p>气味甘、平、无毒。</p><p>主治用以煎煮润肺杀虫的药剂，或把治疗疥癣、虫癞的散剂调成外敷药，可以增强疗效。白花露：止消渴。百花露：能令皮肤健好。柏叶露、菖蒲露：每天早晨洗眼睛，能增强视力。韭叶露：治白癜风。每天早晨涂患处。</p>", "commentary": "", "translation": "", "appreciation": "", "interpretation": ""}}'''

a=eval(t)
```
[请教linux的find命令如何按正则表达式过滤](https://segmentfault.com/q/1010000009776190)
find . -regex '\./[0-9]+_[0-9]+\.zip'
如果需要将找到的文件删除则利用xargs(注意确定之后再删除)：

find . -regex '\./[0-9]+_[0-9]+\.zip'|xargs rm -f
如果不仅要删除还要得到删除的数量，可以这样：

find . -regex '\./[0-9]+_[0-9]+\.zip'|tee >(wc -l 1>&2)|xargs rm -f

[PHP二维数组根据某字段排序](https://tiicle.com/items/288/php-two-dimensional-array-ordered-according-to-a-certain-field)
```js
$array=[
    ['name'=>'张三','age'=>'23'],['name'=>'李四','age'=>'64'],
['name'=>'王五','age'=>'55'],['name'=>'赵六','age'=>'66'],
['name'=>'孙七','age'=>'17']];
$sort = array(
    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
    'field'     => 'age',       //排序字段
);
$arrSort = array();
foreach($array as $uniqid => $row){
    foreach($row AS $key=>$value){
        $arrSort[$key][$uniqid] = $value;
    }
}
array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
print_r($array);
Array
(
    [0] => Array
        (
            [name] => 孙七
            [age] => 17
        )

    [1] => Array
        (
            [name] => 张三
            [age] => 23
        )

    [2] => Array
        (
            [name] => 王五
            [age] => 55
        )

    [3] => Array
        (
            [name] => 李四
            [age] => 64
        )

    [4] => Array
        (
            [name] => 赵六
            [age] => 66
        )

)
//定义一个学生数组
$students  = array (
     256=> array ( 'name' => 'jon' , 'grade' =>98.5),
     2=> array ( 'name' => 'vance' , 'grade' =>85.1),
     9=> array ( 'name' => 'stephen' , 'grade' =>94.0),
     364=> array ( 'name' => 'steve' , 'grade' =>85.1),
     68=> array ( 'name' => 'rob' , 'grade' =>74.6),
);
//按照名称进行排序
function name_sort( $x , $y )
{
 return strcasecmp ( $x [ 'name' ], $y [ 'name' ]);
}

//按照成绩进行排序
function grade_sort( $x , $y )
{
 return ( $x [ 'grade' ] > $y [ 'grade' ]);
}
uasort( $students , name_sort);
 
uasort( $students , grade_sort);
```
[php 数组改造](https://segmentfault.com/q/1010000009729734)
```js
$arrayOld = array(
    '17' => array('1'),
    '11' => array('2'),
    '10' => array('6'),
    '9' => array('1'),
);
$arrayNew = [];

foreach($arrayOld as $key => $value){
    $arrayNew[] = [(string)$key,$value[0]];
}

//print_r ($arrayNew);
 function maps(&$array,$key) {
    array_unshift($array, $key);
  }

  array_walk($arrayOld, 'maps');
  print_r($arrayOld);
```
[mysql文档生成PHP程序](https://git.oschina.net/mjw/sqlDoc/blob/master/sql.php?dir=0&filepath=sql.php&oid=cb5db581bdb2e378a8207383c8534396c9f7bb05&sha=114c111a9b7ac5314e73977505ee4743e67a4f87)
```js
$sql="SHOW TABLE STATUS FROM " . DB_NAME; 
$sql_tab='show full fields from `' . $array[$i]['Name'].'`'
中文字符字数读取  mb_strlen($data['content'],'utf8');  对于中文来说，第二个参数请加上。
替换函数  用于隐私处理
$data['mobile'] = substr_replace($data['mobile'],'******',3,5);  //将电话号码中间5位用*代替
$data['email'] = substr_replace($data['email'],'******',0,5);  //将前位用*代替
```
[如何合并数组里某个key值一样的对象](https://segmentfault.com/q/1010000009819805)
```js
var new = Array.from(
  old.reduce((dict, item)=> {
    if (dict.has(item.name)) {
      dict.get(item.name).push(item.id)
    } else {
      dict.set(item.name, [item.id])
    }
    return dict
  }, new Map())
).map(item => ({a: item[1], b: item[0]}))
var old = [
    {
        id: 1,
        name: "first"
    },
    {
        id: 2,
        name: "first"
    },
    {
        id: 3,
        name: "second"
    },
    {
        id: 4,
        name: "second"
    }
]new = [
    {
        a: [1, 2],
        b: "first"
    },
    {
        a: [3, 4],
        b: "second"
    }
]
var getNew = old => {
    let temp = old.reduce((acc, cur) => {
        if (acc[cur.name]){
            acc[cur.name].push(cur.id); 
        } else {
            acc[cur.name] = [cur.id]
        }
        return acc; 
    }, {});
    
    return Object.keys(temp).map(key => {
        return {
            a: temp[key],
            b: key
        }
    })
}
//https://segmentfault.com/q/1010000009821632 
var hash = {};
var i = 0;
var res = [];
old.forEach(function(item) {
    var name = item.name;
    hash[name] ? res[hash[name] - 1].id.push(item.id) : hash[name] = ++i && res.push({
        id: [item.id],
        name: name,
        type: item.type
    })

});
console.log(JSON.stringify(res))
```
[无限分类之无限方法](http://www.majianwei.com/%e6%97%a0%e9%99%90%e5%88%86%e7%b1%bb%e4%b9%8b%e6%97%a0%e9%99%90%e6%96%b9%e6%b3%95/)
[基于chrome扩展的脚本注入工具](https://zhuanlan.zhihu.com/p/27427557?group_id=859108597462859776)
[来自新浪微博的面试题](https://laravel-china.org/topics/4941/interview-questions-from-sina-and-micro-blog)
```js
function king ($n, $m){
    $s = 0;
    for($i=1;$i<=$n;$i++) {
        $s = ($s+$m)%$i;
    }
    return $s+1;
}

echo king(5,2);     // 3
$arr=
[
'赵','钱','孙','李',
'周','吴','郑','王',
'冯','陈','褚','魏',
'蒋','沈','韩','杨'
];

function countM($arr,$step)
{
$i=1;

while (count($arr)>1)
{
    if ($i==$step)
    {
        array_shift($arr);
        $i=0;
    }else
    {
        array_push($arr,array_shift($arr));
    }

    $i++;
}

echo array_shift($arr);
}
function monkey($monkey, $x) {
    $arr = range(1, $monkey);
    $i   = 0;
    while (count($arr) > 1) {
        if (($i+1) % $x !== 0) {
            array_push($arr, $arr[$i]);
        }
        unset($arr[$i]);
        $i++;
    }
    return implode('', $arr);
}

echo 'The winner is ' . monkey(5, 5);
```
[Notadd 商城模块 ](https://laravel-china.org/articles/5002/notadd-mall-module-product-documentation-apache-open-source)
https://github.com/notadd/notadd
[2017 第三届PHP全球开发者大会PPT/Keynote](https://github.com/devlinkcn/ppts_for_php2017)
[利用 ngrok 代替 在线测试服务器 进行开发的简单使用](https://laravel-china.org/articles/4978/use-ngrok-instead-of-online-test-server-for-simple-development)
Laravel 的命令 php artisan cache:clear 用来清除各种缓存，如页面，Redis，配置文件等缓存，它会清空 Redis 数据库的全部数据，比如默认使用的 Redis 的数据库是 db0，那么执行这个命令后，会清空 db0 中所有数据。Laravel的话，在Controller中要使用$msg = $request->getContent()获取原始数据。
[ThinkSNS+ 是如何计算字符显示长度的](https://laravel-china.org/articles/4803/how-does-thinksns-calculate-the-character-display-length-using-the-laravel-custom-validation-rule)
[如何创建一个自己的 Composer 库](https://laravel-china.org/articles/4982/how-do-i-create-my-own-composer-library)
[Zttp 发送 form params 请求 而非 JSON 请求](https://laravel-china.org/articles/4959/zttp-sends-form-params-requests-instead-of-json-requests)
$response = Zttp::withHeaders(['Fancy' => 'Pants'])->post($url, [
    'foo' => 'bar',
    'baz' => 'qux',
]);

$response->json();
Zttp::asFormParams()->post(bd_api_url(), $params);

[Laravel 中调试输出 SQL 语句的简便方法](https://laravel-china.org/articles/4812/a-simple-way-to-debug-and-output-sql-statements-in-laravel)
```js
\DB::listen(function($sql, $bindings, $time) {
     foreach ($bindings as $replace){
         $value = is_numeric($replace) ? $replace : "'".$replace."'";
         $sql = preg_replace('/\?/', $value, $sql, 1);
     }
     dd($sql);
 })
```
[查看公网出口IP](https://laravel-china.org/topics/4772/the-composer-image-collection-problem-caton-welcome-feedback)
```js
# 1. curl 命令方法
curl http://ipv4.icanhazip.com

# 2. 或者 php
php -r "readfile('http://ipv4.icanhazip.com');"

Trait 在我理解是一个不能实例化的class，用于实现多继承的关系。 你有一个杯子，空值代表杯子是真空的，NULL代表杯子中装满了空气，虽然杯子看起来都是空的，但是区别是很大的。
$user = User::find(1);
$user->touch();
用 touch() 方法可以不需要更新其他字段就用当前时间戳对 updated_at 进行更新。这个方法用来保存 最后一次处理时间 亦或者是 用户最近一次活跃时间 是极好的。
```
[使用 ngrok 让外网也能访问本地](https://laravel-china.org/articles/4339/use-ngrok-to-allow-access-to-the-local-network)
git clone https://github.com/HanSon/ngrok-script.git
cd ngrok-script
// if linux or mac
./ngrok.sh domain
// if windows
ngrok.bat domain
[简单快速的开发 Web 应用， PHP 框架 Lemon 介绍](https://laravel-china.org/topics/4671/write-a-small-project-for-the-php-framework-to-support-regular-routing-database-query-chain)
[Laravel 核心——IoC 服务容器源码解析（服务器解析）](https://laravel-china.org/articles/4700/laravel-core-ioc-service-container-source-code-analysis-server-resolution)

[Composer 系列：autoload](https://laravel-china.org/articles/4802/composer-series-autoload)

[Allowed memory size of 134217728 bytes 错误解决心得](https://laravel-china.org/articles/4736/allowed-memory-size-of-134217728-bytes-error-resolution)
不下二十个字段，所有字段都查询出来肯定撑爆内存。
最后修改代码：$*****->get(["uid","loginid","steamid","created_at","name"]);
[简单的初级压力测试](https://laravel-china.org/articles/4765/simple-primary-stress-test)

