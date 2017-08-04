[中奖概率算法（php 可用于刮刮卡，大转盘等抽奖算法](http://php-z.com/thread-2690-1-1.html)
```js
<?php
/*
 * 经典的概率算法，
 * $proArr是一个预先设置的数组，
 * 假设数组为：array(100,200,300，400)，
 * 开始是从1,1000 这个概率范围内筛选第一个数是否在他的出现概率范围之内， 
 * 如果不在，则将概率空间，也就是k的值减去刚刚的那个数字的概率空间，
 * 在本例当中就是减去100，也就是说第二个数是在1，900这个范围内筛选的。
 * 这样 筛选到最终，总会有一个数满足要求。
 * 就相当于去一个箱子里摸东西，
 * 第一个不是，第二个不是，第三个还不是，那最后一个一定是。
 * 这个算法简单，而且效率非常 高，
 * 关键是这个算法已在我们以前的项目中有应用，尤其是大数据量的项目中效率非常棒。
 */
function get_rand($proArr) { 
    $result = '';  
    //概率数组的总概率精度 
    $proSum = array_sum($proArr);  
    //概率数组循环 
    foreach ($proArr as $key => $proCur) { 
        $randNum = mt_rand(1, $proSum); 
        if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
        } else { 
            $proSum -= $proCur; 
        }         
    } 
    unset ($proArr);  
    return $result; 
} 


/*
 * 奖项数组
 * 是一个二维数组，记录了所有本次抽奖的奖项信息，
 * 其中id表示中奖等级，prize表示奖品，v表示中奖概率。
 * 注意其中的v必须为整数，你可以将对应的 奖项的v设置成0，即意味着该奖项抽中的几率是0，
 * 数组中v的总和（基数），基数越大越能体现概率的准确性。
 * 本例中v的总和为100，那么平板电脑对应的 中奖概率就是1%，
 * 如果v的总和是10000，那中奖概率就是万分之一了。
 * 
 */
$prize_arr = array( 
    '0' => array('id'=>1,'prize'=>'平板电脑','v'=>1), 
    '1' => array('id'=>2,'prize'=>'数码相机','v'=>5), 
    '2' => array('id'=>3,'prize'=>'音箱设备','v'=>10), 
    '3' => array('id'=>4,'prize'=>'4G优盘','v'=>12), 
    '4' => array('id'=>5,'prize'=>'10Q币','v'=>22), 
    '5' => array('id'=>6,'prize'=>'下次没准就能中哦','v'=>50), 
); 

/*
 * 每次前端页面的请求，PHP循环奖项设置数组，
 * 通过概率计算函数get_rand获取抽中的奖项id。
 * 将中奖奖品保存在数组$res['yes']中，
 * 而剩下的未中奖的信息保存在$res['no']中，
 * 最后输出json个数数据给前端页面。
 */
foreach ($prize_arr as $key => $val) { 
    $arr[$val['id']] = $val['v']; 
} 
$rid = get_rand($arr); //根据概率获取奖项id 

$res['yes'] = $prize_arr[$rid-1]['prize']; //中奖项 
unset($prize_arr[$rid-1]); //将中奖项从数组中剔除，剩下未中奖项 
shuffle($prize_arr); //打乱数组顺序 
for($i=0;$i<count($prize_arr);$i++){ 
    $pr[] = $prize_arr[$i]['prize']; 
} 
$res['no'] = $pr; 
print_r($res);
 $a = ['a', 32, true, 'x' => 'y'];
 var_dump(in_array(25, $a)); // true
 var_dump(in_array('ggg', $a)); // true
 var_dump(in_array(0, $a)); // true
 var_dump(in_array(null, $a)); // false
 var_dump(in_array(25,$a,true));//false
 var_dump(in_array('19fdf',[19]));
//echo getPeopleMonth(strtotime('-7 day'));
 function getPeopleMonth($time)
    {
        $validTime = date('Y-m-d', strtotime('+1 day'));
        if ($validTime>$time) {
            return 0;
        }
        $carbonDate = new \Carbon($validTime);
        $diffDate = $carbonDate->diff(new \Carbon($time), true);
        $month = $diffDate->y * 12 + $diffDate->m;
        if ($month>0 && $diffDate->d == 0) {
            $month = $month-1;
        }
        return $month;
    }
    print_r(array_sum_with_key(['07-01'=>10,'07-02'=>20,'07-12'=>12],['07-10'=>10,'07-12'=>12]));
 function array_sum_with_key(array $arr1, array $arr2, array $_ = null)
{
    $args = array_slice(func_get_args(), 1);

    foreach ($args as $arr) {
        foreach ($arr as $k => $v) {
            if (isset($arr1[$k])) {
                $arr1[$k] += $v;
            } else {
                $arr1[$k] = $v;
            }
        }
    }

    return $arr1;
}
print_r( weekday(2017,30));
Array
(
    [07-01] => 10
    [07-02] => 20
    [07-12] => 24
    [07-10] => 10
)
Array
(
    [start] => 2017-07-24
    [end] => 2017-07-30
}

function weekday($year, $week = 1){
    $year_start = mktime(0,0,0,1,1,$year);
    $year_end = mktime(0,0,0,12,31,$year);

    if (intval(date('w',$year_start)) === 1){
        $start = $year_start;
    }else{
        $start = strtotime('+1 monday',$year_start);
    }

    if ($week === 1){
        $weekday['start'] = $start;
    }else{
        $weekday['start'] = strtotime('+'.($week-0).' monday',$start);
    }

    $weekday['end'] = strtotime('+1 sunday',$weekday['start']);
    if (date('Y',$weekday['end'])!=$year){
        $weekday['end'] = $year_end;//跳过今年
    }
    return array_map(function($i){
        return date('Y-m-d',$i);
    },$weekday);
}

```


[ Redis在Php项目中的实际应用场景](https://segmentfault.com/a/1190000005145274)
```js
//[PHP开发] 1亿条数据在PHP中实现Mysql数据库分表100张  full_code作为主键，我们对full_code做hash
	
 echo get_hash_table('code',100);
  function get_hash_table($table,$code,$s=100){
 $hash = sprintf("%u", crc32($code));
 echo $hash;
 $hash1 = intval(fmod($hash, $s));
  return $table."_".$hash1;
 }

$redis->zAdd('user:1000:follow', 1463557212, '1001'); 
                                #uid为1000用户关注uid为1001 , score值设定时间戳1463557212
$redis->zAdd('user:1000:follow', 1463557333, '1002'); 
$redis->zAdd('user:2000:follow', 1463577568, '1001'); 
$redis->zAdd('user:2000:follow', 1463896964, '1003');                                 #uid为2000用户关注1001和1003用户 , score值设定时间戳
$redis->zInter('com_fllow:1000:2000', array('user:1000:follow', 'user:2000:follow')); 
        #对集合'user:1000:follow'和'user:2000:follow'取交集'com_fllow:1000:2000'        #获得共同关注的uid 
$redis->zRange('com_fllow:1000:2000',0,-1); // 获取全部集合元素        #array('10001','10002')
https://segmentfault.com/a/1190000005117381  alter table teacher partition by key(id) partitions 4;

<?php
namespace App\Services;
class RedisCache{

    protected $_redis;
    protected $_config;
    protected $_retry = 3;
    protected $_retrySleep = 200000;
    protected static $_instance;

    public function __construct() {
        $this->_redis = new \Redis();
        $this->connect();
        $password = env('REDIS_PASSWORD','');
        if($password) {
            $this->_redis->auth($password);
        }
        //$this->_redis->select(env('REDIS_DATABASE', 0));
    }

    private function connect($retry = 0){
        try{
            $this->_redis->pconnect(env('REDIS_HOST','test-r-qy-bj3.vhouhn.com'), env('REDIS_PORT','23244'), 3);
            $this->_redis->ping();
        }catch (\Exception $e){
            if($retry < $this->_retry){
                usleep($this->_retrySleep);
                $retry = $retry + 1;
                $this->connect($retry);
            }else{
                \Log::error($e->getMessage(), ['class'=>__CLASS__]);
            }
        }
    }

    private function ping(){
        try{
            $this->_redis->ping();
        }catch (\Exception $e){
            $this->connect();
        }
    }

    public static function getInstance() {
        if (!static::$_instance instanceof static) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public function get($key, $serialize = true) {
        $this->ping();
        $data = $this->_redis->get($key);
        if($data!==FALSE){
            return ($serialize && !is_numeric($data)) ? unserialize($data) : $data;
        }else{
            return FALSE;
        }
    }

    public function set($key, $value, $expire = 1800, $serialize = true) {
        if($serialize && !is_numeric($value)){
            $value = serialize($value);
        }
        $this->ping();
        return $this->_redis->setex($key, $expire, $value);
    }

    public function inc($key, $value = 1) {
        $this->ping();
        return $this->_redis->incrBy($key, $value);
    }

    public function des($key, $value = 1) {
        $this->ping();
        return $this->_redis->decrBy($key, $value);
    }

    public function del($key) {
        $this->ping();
        return $this->_redis->delete($key);
    }

    public function clear() {
        $this->ping();
        return $this->_redis->flushDB();
    }

    public function getRedis(){
        return $this->_redis;
    }

    public function __call($method, $args) {
        $this->ping();
        return call_user_func_array(array($this->_redis, $method), $args);
    }

    public function __destruct() {
        $this->_redis->close();
    }
}
```
[Sentry 自动化异常提醒](https://aabvip.com/archives/63)
```js

$ php artisan vendor:publish --provider="Sentry\SentryLaravel\SentryLaravelServiceProvider"
mysql[SQL] select * from `users` in 1 s      
bindinds: []Copied File [\vendor\sentry\sentry-laravel\src\Sentry\SentryLaravel\config.php]
To [\config\sentry.php]
Publishing Complete!

```
[]()


[Nginx 中 502 和 504 错误详解](https://segmentfault.com/a/1190000002686153)
```js
502错误一般都是PHP段挂掉导致的
比如 PHP-fpm运行占用内存过高，超出限制
在 php.ini 和 php-fpm.conf 中分别有这样两个配置项：max_execution_time 和 request_terminate_timeout。

这两项都是用来配置一个 PHP 脚本的最大执行时间的。当超过这个时间时，PHP-FPM不只会终止脚本的执行，还会终止执行脚本的Worker进程。所以Nginx会发现与自己通信的连接断掉了，就会返回给客户端502错误。

所以只需将这两项的值调大一些就可以让PHP脚本不会因为执行时间长而被终止了。request_terminate_timeout 可以覆盖 max_execution_time，所以如果不想改全局的php.ini，那只改PHP-FPM的配置就可以了。

要注意的是 factcgi_connect/read/send_timeout 是对 FastCGI 生效的，而 proxy_connect/read/send_timeout 是对 proxy_pass 生效的。

配置举例：

location ~ \.php$ {
                root                    /home/cdai/test.com;
                include                 fastcgi_params;
                fastcgi_connect_timeout      180;
                fastcgi_read_timeout            600;
                fastcgi_send_timeout            600;
                fastcgi_pass            unix:/dev/shm/php-fcgi.sock;
                fastcgi_index           index.php;
                fastcgi_param          SCRIPT_FILENAME         /home/cdai/test.com$fastcgi_script_name;
     }

```
[关于php 高并发解决的一点思路](http://www.cnblogs.com/phpper/p/6716248.html)
```js
悲观锁的特点是先获取锁，再进行业务操作，即“悲观”的认为获取锁是非常有可能失败的，因此要先确保获取锁成功再进行业务操作。通常所说的“一锁二查三更新”即指的是使用悲观锁。通常来讲在数据库上的悲观锁需要数据库本身提供支持，即通过常用的select … for update操作来实现悲观锁。当数据库执行select for update时会获取被select中的数据行的行锁，因此其他并发执行的select for update如果试图选中同一行则会发生排斥（需要等待行锁被释放），因此达到锁的效果。select for update获取的行锁会在当前事务结束时自动释放，因此必须在事务中使用。
乐观锁的特点先进行业务操作，不到万不得已不去拿锁。即“乐观”的认为拿锁多半是会成功的，因此在进行完业务操作需要实际更新数据的最后一步再去拿一下锁就好。

1. SELECT data AS old_data, version AS old_version FROM …;
2. 根据获取的数据进行业务操作，得到new_data和new_version
3. UPDATE SET data = new_data, version = new_version WHERE version = old_version
if (updated row > 0) {
    // 乐观锁获取成功，操作完成
} else {
    // 乐观锁获取失败，回滚并重试
}
<?php
$fp = fopen("lock.txt", "w+");
if(flock($fp,LOCK_EX))   //锁定当前指针，，，
{
  //..处理订单
  flock($fp,LOCK_UN);
}
fclose($fp);
?>

```
[ Redis的PHP操作手册（纯手稿版）](https://segmentfault.com/a/1190000004973921#articleHeader0)
```js
string是redis最基本的类型，而且string类型是二进制安全的。意思是redis的string可以包含任何数据。比如jpg图片或者序列化的对象

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


[Laravel 学习笔记](https://laravel-china.org/topics/3331/laravel-learning-notes#reply5)
[valgrind 检测 php-fpm 内存泄漏](https://mengkang.net/873.html)
[浅谈 Laravel 设计模式](https://laravel-china.org/topics/1954/on-laravel-design-pattern)
[微信控制台](https://github.com/WechatFE/vConsole )
[python周刊](https://github.com/NyanCat12/CrossinWeekly)
https://github.com/NyanCat12/CrossinWeekly/blob/master/20170303/NovelWordCount.py
[Python解惑：整数比较](https://foofish.net/python-int-mystery.html)
Python把这些可能频繁使用的整数对象规定在范围[-5, 256]之间的小对象
小整数对象[-5,256]是全局解释器范围内被重复使用，永远不会被GC回收。2、同一个代码块中的不可变对象，只要值是相等的就不会重复创建新的对象。
[Someline Starter 基于 Laravel, RESTful API and Vue.JS，适用于开发 app 或者 Web 端，现在开源](https://laravel-china.org/topics/2300/someline-starter-based-on-laravel-restful-and-vuejs-suitable-for-the-development-of-app-or-web-side-and-now-open-source-api)
[1.APP后端开发系列：登陆系统设计中的注意问题](https://helei112g.github.io/2016/07/12/1-APP%E5%90%8E%E7%AB%AF%E5%BC%80%E5%8F%91%E7%B3%BB%E5%88%97%EF%BC%9A%E7%99%BB%E9%99%86%E7%B3%BB%E7%BB%9F%E8%AE%BE%E8%AE%A1%E4%B8%AD%E7%9A%84%E6%B3%A8%E6%84%8F%E9%97%AE%E9%A2%98/)
```js
第三种设计方案，这是我原先干过的一件事，是这三种方案中最垃圾的设计。得出的教训就是：绝不能把任何加密的事情交给客户端。这样子灵活性大打折扣。举例：还是升级接口了，现在本来token生成只是服务端的事情，服务端随时可动态改变规则，现在由于客户端也参与进来了，这事儿就麻烦了，你一改，客户端也要跟着改。没有任何灵活性可言。切记：客户端就接收，然后转发回服务端就好了。别再客户端进行加密！！！

if ($redis->get($key)) {
    // 无法访问，还未到时间
    
    return ;
}

// 设置频率控制key
$redis->setex($key, $expires, $value);

// 访问接口
```
[MySQL隐式转化整理](http://www.cnblogs.com/rollenholt/p/5442825.html)
```js
mysql> select * from test where name = 'test1' and password = 0;
SELECT * FROM users WHERE username = '$_POST["username"]' AND password = '$_POST["password"]'
如果username输入的是a' OR 1='1，那么password随便输入，这样就生成了下面的查询：

SELECT * FROM users WHERE username = 'a' OR 1='1' AND password = 'anyvalue'
mysql> select * from test;
+----+-------+-----------+
| id | name  | password  |
+----+-------+-----------+
|  1 | test1 | password1 |
|  2 | test2 | password2 |
|  3 | aaa   | aaaa      |
|  4 | 55aaa | 55aaaa    |
+----+-------+-----------+
4 rows in set (0.00 sec)

mysql> select * from test where name = 'a' + '55';
+----+-------+----------+
| id | name  | password |
+----+-------+----------+
|  4 | 55aaa | 55aaaa   |

mysql> show warnings;

如果字符串的第一个字符就是非数字的字符，那么转换为数字就是0
如果字符串以数字开头
如果字符串中都是数字，那么转换为数字就是整个字符串对应的数字
如果字符串中存在非数字，那么转换为的数字就是开头的那些数字对应的值
如果你
```
[ mysql处理高并发数据,防止数据超读](http://blog.csdn.net/gaoxuaiguoyi/article/details/47304615)
```js
beginTranse(开启事务)  
try{  
   //第一次进行查询，返回数量     
    $result = $dbca->query('select amount from s_store where postID = 12345');  
  // 3个请求进入,使用了之前的，查询结果，造成了数据脏读，都去更新了库存，造成库存超读  
    if(result->amount > 0){  
        //quantity为请求减掉的库存数量  
        $dbca->query('update s_store set amount = amount - quantity where postID = 12345');  
    }  
}catch($e Exception){  
    rollBack(回滚)  
}  
commit(提交事务);  
  beginTranse(开启事务)  
try{  
    //quantity为请求减掉的库存数量  
    $dbca->query('update s_store set amount = amount - quantity where postID = 12345');  
    //更新之后再进行数量判断，如果为负就回滚，不会造成库存超读  
    $result = $dbca->query('select amount from s_store where postID = 12345');  
    if(result->amount < 0){  
       throw new Exception('库存不足');  
    }  
}catch($e Exception){  
    rollBack(回滚);  
}  
commit(提交事务);  
beginTranse(开启事务)  
try{  
    //quantity为请求减掉的库存数量  
    $dbca->query('update s_store set amount = amount - quantity where amount>=quantity and postID = 12345');  
}catch($e Exception){  
    rollBack(回滚)  
}  
commit(提交事务)  

```

[python实现web服务器](https://segmentfault.com/a/1190000004406048)
[mysql索引需要了解的几个注意](https://segmentfault.com/a/1190000004022595)
```js
有，想象一下，你面前有本词典，数据就是书的正文内容，你就是那个cpu，而索引，则是书的目录
索引越多越好？
大多数情况下索引能大幅度提高查询效率，但

数据的变更（增删改）都需要维护索引，因此更多的索引意味着更多的维护成本
更多的索引意味着也需要更多的空间 （一本100页的书，却有50页目录？）
过小的表，建索引可能会更慢哦 ：） （读个2页的宣传手册，你还先去找目录？）
索引的字段类型问题
text类型，也可建索引（需指定长度）
myisam存储引擎索引键长度综合不能超过1000字节
用来筛选的值尽量保持和索引列同样的数据类型
like 不能用索引？
尽量减少like，但不是绝对不可用，”xxxx%” 是可以用到索引的，
想象一下，你在看一本成语词典，目录是按成语拼音顺序建立，查询需求是，你想找以 “一”字开头的成语（”一%“），和你想找包含一字的成语（“%一%”）
除了like，以下操作符也可用到索引：
 <，<=，=，>，>=，BETWEEN，IN
 <>，not in ，！=则不行
什么样的字段不适合建索引？
一般来说，列的值唯一性太小（如性别，类型什么的），不适合建索引（怎样叫太小？一半说来，同值的数据超过表的百分之15，那就没必要建索引了）
太长的列，可以选择只建立部分索引，（如：只取前十位做索引）
更新非常频繁的数据不适宜建索引（怎样叫非常？意会）
一次查询能用多个索引吗?
不能

多列查询该如何建索引?
一次查询只能用到一个索引，所以 首先枪毙 a，b各建索引方案
a还是b？ 谁的区分度更高（同值的最少），建谁！
当然，联合索引也是个不错的方案，ab，还是ba，则同上，区分度高者，在前

联合索引的问题?
where a = “xxx” 可以使用 AB 联合索引
where b = “xxx” 则不可 （再想象一下，这是书的目录？）

所以，大多数情况下，有AB索引了，就可以不用在去建一个A索引了

哪些常见情况不能用索引?
like “%xxx”
not in ， ！=
对列进行函数运算的情况（如 where md5(password) = “xxxx”）
WHERE index=1 OR A=10
存了数值的字符串类型字段（如手机号），查询时记得不要丢掉值的引号，否则无法用到该字段相关索引，反之则没关系 也即
select * from test where mobile = 13711112222;
   
可是无法用到mobile字段的索引的哦（如果mobile是char 或 varchar类型的话）
   
btw，千万不要尝试用int来存手机号（为什么？自己想！要不自己试试）

```

[用python爬取qq好友十万条说说并简单进行数据分析](https://zhuanlan.zhihu.com/p/27604277 )
```js
https://github.com/doctorwho77/qq_mood/blob/master/wordcloud/qq_mood.py
import matplotlib.pyplot as plt
from wordcloud import WordCloud,ImageColorGenerator,STOPWORDS
import jieba
import numpy as np
from PIL import Image

#读入背景图片
abel_mask = np.array(Image.open("qq.jpg"))

#读取要生成词云的文件
text_from_file_with_apath = open('mood.txt',encoding='utf-8').read()

#通过jieba分词进行分词并通过空格分隔
wordlist_after_jieba = jieba.cut(text_from_file_with_apath, cut_all = True)
stopwords = {'转载','内容','em','评语','uin','nick'}
seg_list = [i for i in wordlist_after_jieba if i not in stopwords]
wl_space_split = " ".join(seg_list)
#my_wordcloud = WordCloud().generate(wl_space_split) 默认构造函数
my_wordcloud = WordCloud(
            background_color='black',    # 设置背景颜色
            mask = abel_mask,        # 设置背景图片
            max_words = 250,            # 设置最大现实的字数
            stopwords = STOPWORDS,        # 设置停用词
            font_path = 'C:/Windows/fonts/simkai.ttf',# 设置字体格式，如不设置显示不了中文
            max_font_size = 42,            # 设置字体最大值
            random_state = 40,            # 设置有多少种随机生成状态，即有多少种配色方案
                scale=1.5,
            mode='RGBA',
            relative_scaling=0.6
                ).generate(wl_space_split)

# 根据图片生成词云颜色
#image_colors = ImageColorGenerator(abel_mask)
#my_wordcloud.recolor(color_func=image_colors)

# 以下代码显示图片
plt.imshow(my_wordcloud)
plt.axis("off")
plt.show()

my_wordcloud.to_file("cloud.jpg")

我刚找到一个 QQ 音乐到网易云音乐的转换网站： http://144.48.7.239:5000/convert.html （ https://github.com/comwrg/xMusicWeb ）  同步网易云音乐歌单到 qq 音乐 https://github.com/Denon/syncPlaylist  
[给定 key，能“长期”保存一段字符串](https://www.v2ex.com/t/377521)
比如保存到 notepad.pw 上： https://notepad.pw/n1y638kw https://archive.org/

那天在扫地，男孩子把我的扫帚夺去，看着我笑，然后问：“我孰与城北徐公美？”
那一瞬间我就呆了……
觉得自己都面红耳赤了回了一句“美你妹”，转过身就走了。
补充说明《邹忌讽齐王纳谏》中，邹忌问客人的时候是“吾与徐公孰美”，问妾是“吾孰与徐公美”。只有问妻子的时候是“我孰与城北徐公美”……没错成功撩到我了
玩完游戏就删除  有新的想法立马记下来 选择固定的时间运动和看书 打电话之前打好腹稿  每个月固定基金定投 重要的事情别微信，直接打电话 逢年过节发短信 确认内容  记账 备忘本 学会一些基本的绅士风度 1.上车帮女生开门，进出任何室内场所都帮女生开门2.过马路时走车来的一边，也就是说，一开始站在女生的左边，过了中线后站在女生右边3.看到女生手上拿着包包，习惯性的询问要不要帮她拿4.不在女生面前抽烟5.晚归时一定要送女生回家6.开车去接送女生时，记得把车停好，自己走下来在门口等她7.遇到什么突发情况习惯性的站在女生前面8.下雨时，如果只有一把伞，记得拿伞并将伞倾向于对方那一边9.电动车也好，汽车也罢，载着她的话不要开太快，尽量匀速。10.最后，女朋友说的话都是对的，这是重点
 最年轻省纪委书记手把手教你起草领导讲话https://zhuanlan.zhihu.com/p/27642987
pyecharts + Jupyter Notebook 数据可视化，还要啥 PPThttps://zhuanlan.zhihu.com/p/28157126
通关这12个游戏，你就是编程大神，我不是开玩笑！https://zhuanlan.zhihu.com/p/28144861
https://zhuanlan.zhihu.com/p/28124472 12个Python项目教程，给缺乏项目实战经验的人
git clone https://github.com/git-game/git-game.git 
查询自己qq的注册时间 https://zhuanlan.zhihu.com/p/28151872 http://im.qq.com/
$.ajax({url : 'https://ti.qq.com/mqqbase/cgi/medalwall/medalguide',dataType: 'json',type : 'POST',xhrFields: {withCredentials: true}, crossDomain: true,contentType: "application/json",success:function(data){if(data.errCode!=0){alert("你没登录?");return;}var d=new Date();d.setTime(data.data.registDate);alert("注册时间:"+d.toLocaleString()+" 第一个添加的好友:"+data.data.firstFriend)}});
同名知乎专栏：说一说公务员的那点事 https://zhuanlan.zhihu.com/p/28130533 常见排序算法之JavaScript实现 看图学数学，公众号：matongxue314
https://zhuanlan.zhihu.com/p/28127291 教你如何优雅地3天背完8000个单词
https://www.zhihu.com/question/40801731/answer/203894909 马哥Python助理研发人，IT全栈市场狗，微信：itxiujiang  https://zhuanlan.zhihu.com/p/28126863  https://www.zhihu.com/question/20534668/answer/15407109 https://www.zhihu.com/question/62634555 我要做什么让妹子知道我是认真的，比如生活中的哪一些小事做起
如果你在 HTML 里写<script>let x = x</script> <!-- 后面的 x 可以换成任意一个不存在的变量 -->
那么，其他 script 都无法在全局作用域下使用 x 变量了，无论是对 x 进行赋值、取值，还是声明，都不行。也就是说现在 x 处于一种「既被定义了，又没被定义」的中间状态。

假如没有这6点，我英语一定还很差吧https://zhuanlan.zhihu.com/p/28138089 @恶膜的奶爸 的书《把你的英语用起来》 公众号「孤读者说」，一个关于英语、阅读、成长的公众号
链接：https://zhuanlan.zhihu.com/p/28117094
https://www.zhihu.com/question/36546814/answer/139721284  
用python爬取qq好友十万条说说并简单进行数据分析https://zhuanlan.zhihu.com/p/27604277  github.com/doctorwho77/qq_mood.git 天地可鉴 童叟无欺 我中意你 「史蒂芬的专栏」（ID：stehouse），聊点职场和英语
知乎TOP 1000 赞的回答 微信公众号：wnsouba https://zhuanlan.zhihu.com/p/28185173?group_id=874627072310530048 关注后回复【我爱星爷】电影公众号：猛兽笔记 少儿编程《轻松玩转Scratch编程》 用的小程序—群功能！尊重,信任,慎独,是男人应该具备的三种重要素养.
对香蕉不感兴趣，为什么不一开始就告诉我？ 对你的付出不置可否 永远觉得“男人对女人好，是理所应当的” 她只让你打怪，却很少给你升级 看不到进度条的游戏，最好还是掂量一下要不要再进行下去。
http://link.zhihu.com/?target=https%3A//zh.piixemto.com/ 星座，情感，运势等各种测试 年代感图片素材库http://link.zhihu.com/?target=https%3A//chineseposters.net/
男生的思维是”解决问题，达到目标“

女生的思维是”注重感受，活在当下“

所以女生特别反感一上来就直奔目标的男生

”你好，我觉得你很漂亮，我想认识你“

”你好，可以把你电话/微信给我么“我看你刚才从这边走过去，觉得如果不跟你打个招呼认识下，晚上一定会后悔的我看你刚从这边走过去，觉得你今天的裙子超级漂亮，所以脑子一热就过来跟你打招呼了 你好，我对你闺蜜印象很好，可以跟她说几句话么 你跟妹子共用一把伞，所以你们的距离也自然拉近，这时候要个微信自然不成问题啦 告诉你如何正确搭讪https://zhuanlan.zhihu.com/p/28117419?group_id=873629906041475072 高效文本记忆软件——背个X啊
 github.com/HcySunYang/knowledge  个人公众号：GY的小屋 高分50  简化版的vConsole /github.com/xiaojue/console  微信公众号：跑得开心最重要 柔而不弱，强而不悍。 女生有哪些加分项
公众号：撩妹论剑  debugtalk 
张表中某几个字段相同的记录排列到一起，并且排到表最前面https://segmentfault.com/q/1010000010360145
select
    a.*
from 表 a
left join (
    select
        字段A, 字段B, 字段C, count(1) as total
    from 表
    group by 字段A,字段B，字段C
) b on a.字段A=b.字段A
    and a.字段B=b.字段B
    and a.字段C=b.字段C
order by b.total desc
redis重启后数据怎么还在？不是会消失的吗？数据库也变成了3个，默认不是16个的吗？https://segmentfault.com/q/1010000010367185
1、重启后数据还在，是因为有持久化策略。redis默认开启rdb持久化策略，会产一个rdb.dump文件，重启时会从该文件导入数据。如果是配置了AOF持久化策略，也会产一个相应的文件，redis重启时会优先从这个文件导入数据。
2、你现在从客户端看到db0，db1，db2这3个库，说明你现在只在这3个库存了数据，其它库未使用。通过命令行连接redis操作你会看到。
predis是用PHP写的扩展，不需要编译而已。   predis的时候使用用的package，PhpRedis的时候用的extension
PHP是不需要redis扩展的，在laravel下安装predis/predis就足够了

PHP 使用的socket与redis通讯 所以无需扩展 redis本身就可以使用PHP自带的socket通讯就可以完成数据的交换，并且效率上面也不会有太明显的问题，毕竟redis的协议不复杂，用户数据的交换也不复杂。https://segmentfault.com/q/1010000010292328



mysql分页查询很慢，从第1000000条记录开始查10条https://segmentfault.com/q/1010000010410092
直接SELECT * FROM ... LIMIT m, n会把m+n行 整行 都取出来，所以应该先取n个id，再根据这n个id把整行取出来。
SELECT * FROM table WHERE id >= (SELECT id FROM table LIMIT 1000000, 1) LIMIT 10; （耗时0.3秒）
快了几十倍····· SELECT * FROM table WHERE id IN (SELECT id FROM table ORDER BY id LIMIT 1000000, 10)

count(1)的语句，如果在加索引后，查看执行计划确实使用了索引，因数据量小，出现不如全表扫描慢的情况是合理的。

建议把加索引前后的执行计划进行对比，确认查询方式的变化。
查询语句使用悲观锁策略，事务中的读语句改为select * ... for updatehttps://segmentfault.com/q/1010000010353164
mysql --help会告诉你的配置文件读取顺序：
Default options are read from the following files in the given order:
/etc/my.cnf /etc/mysql/my.cnf /app/mysql/etc/my.cnf ~/.my.cnf

配置防火墙端口访问
vi /etc/sysconfig/iptables
-A INPUT -m state –state NEW -m tcp -p tcp –dport 3306 -j ACCEPT
重启
特别提示：添加到默认的22端口规则后面
 $data[] = (function(){ 
         $item->tags = ['foo','bar']; return $item; 
         })($v); 
github上有wxbot项目，用python封装了微信的web api，其中，就可以回去到各种消息，你只需要调用相应的接口，接收公众号或者订阅号消息，就行了。附上项目链接https://github.com/liuwons/wxBot
import re

str = u'陈奕迅演唱(十年)、(浮夸)、(不要说话)'
print re.findall('\((.*?)\)', str) 正则表达式提取所有小括号里的字符串
	 
	pip和pip3都在Python36\Scripts\目录下

如果同时装有python2 和 python3

pip 默认给 python2 用。

pip3 指定给 python3 用。

如果只装有 python3，则pip和pip3是等价的
>>> import pandas as pd
>>> data = [
    {'A': 'A1','B': 'B2','C': 'C3','D': 'D4'},
    {'A': 'AA1','C': 'CC3','D': 'DD4','E': 'EE5'},
    {'A': 'AAA1','B': 'BBB2','C': 'CCC3','D': 'DDD4','E': 'EEE5'}
]
>>> df=pd.DataFrame(data).fillna('null')
>>> ls=df.values.tolist()
>>> ls.insert(0,df.columns.tolist())
>>> ls
[['A', 'B', 'C', 'D', 'E'], ['A1', 'B2', 'C3', 'D4', 'null'], ['AA1', 'null', 'CC3', 'DD4', 'EE5'], ['AAA1', 'BBB2', 'CCC3', 'DDD4', 'EEE5']]
>>>  https://segmentfault.com/q/1010000010362346

python+openpyxl操作excel？
#coding:utf-8
from openpyxl import load_workbook
wb = load_workbook('sample.xlsx')
sheetnames=wb.get_sheet_names()
ws = wb.get_sheet_by_name(sheetnames[0])
data=['姓名','杰克','里斯','安妮']
for i in range(len(data)):
    ws['B%d'%(i+1)]=data[i]
wb.save('sample.xlsx')https://segmentfault.com/q/1010000010342008
import pandas as pd
df=pd.read_excel('sample.xlsx')
print df
df['姓名']=['杰克','里斯','安妮']
#或者执行插入df.insert(1,'姓名',['杰克','里斯','安妮'])  1就是列的序号
df.to_excel('sample.xlsx')

crontab会产生日志一般不会造成数据太多。Linux 可以使用 logrotate 压缩 var/log/ 下的部分 log文件，定期归档。 在 /var/log/cron.log 或者是 /var/log/syslog 也可能是 /var/log/cron
log 还是不禁止的好，方便出问题，排查原因。

实在不想要，可以这样设置，命令后加 >/dev/null 2>&1,例如：

0 */3 * * * /usr/local/apache2/apachectl restart >/dev/null 2>&1
/dev/null 2>&1 表示先将标准输出重定向到 /dev/null，然后将标准错误重定向到标准输出，由于标准输出已经重定向到了 /dev/null，因此标准错误也会重定向到 /dev/null，这样日志输出问题就解决了。 https://segmentfault.com/q/1010000010409743 
秒级计划任务如何做
$i++;
while($i<60){
    $i++;
    //your code
    sleep(1);
}
这个递归算法哪里写错了https://segmentfault.com/q/1010000010390981

实现字符串 'AdminProTable' 到 'admin_pro_table' 的转换https://segmentfault.com/q/1010000010401215
s = 'AdminProTable'
print ''.join(['_{}'.format(_.lower()) if _.isupper() and i > 0 else _.lower() for i, _ in enumerate(s)])
$old = 'AdminProTable';
$str = '';
for ($i = 0; $i < strlen($old);  $i++) {
    $str .= preg_match('/^[A-Z]+$/', $old[$i]) ? '_' . strtolower($old[$i]) : $old[$i];
}
$str = $str[0] === '_' ? substr($str, 1) : $str;
var_dump($str);
PHP把对象转换为数组的问题https://segmentfault.com/q/1010000010367142
namespace Qiniu\Http;
class Error{
    private $url = 'http://rs.qbox.me/buckets';
    public $status = 200;
}
$obj = new Error();
$arr = (array)$obj;
var_export($arr);
var_dump($arr["\0Qiniu\\Http\\Error\0url"], $arr['status']);  原来var_dump的时候也得用拼接， var_dump($array['' . "0" . 'Qiniu\Http\Error' . "0" . 'url']);

引用传递和值参递的主要区别也体现在对值的修改。https://segmentfault.com/q/1010000010320088

function handle(&$item) {
    $item['msg'] = 'wtf!';
}


handle($item);

var_dump($item);
$arr = [1,2,3,4,5,6];

// 我要将整个数组按照node进行
array_walk($arr, function(&$v, $k){
    $v = strval($v);
});

unset($v);
https://segmentfault.com/q/1010000010316820
PHP 7 版本可以捕获到Error的错误

PHP 5 可以用register_shutdown_function来处理错误https://segmentfault.com/q/1010000010361037
try
{
   // Code that may throw an Exception or Error.
}
catch (Throwable $t)
{
   // Executed only in PHP 7, will not match in PHP 5
}
catch (Exception $e)
{
   // Executed only in PHP 5, will not be reached in PHP 7
}
dechex()函数，所能转换的最大数值为十进制的4294967295，其结果为 "ffffffff"
所以结果应该就截取了。 https://segmentfault.com/q/1010000000595871
$a = pow(10,16); //结果是 1.0E+16
 //转化成 16 进制
 echo dechex($a);
 
 结果是 6fc10000，
 正确的转换应该是 2386f26fc10000  https://segmentfault.com/q/1010000010328335
 新建第三方库流程具体该怎么操作放composer.json 的 autoload 块里，然后 composer dump   
 https://segmentfault.com/q/1010000010333845
 大写金额转换成阿拉伯数字金额(PHP)https://segmentfault.com/q/1010000010367675
 要动态改变 Eloquent Model 的表名可以使用 setTable 方法：

$model = new MyLog();
$model->setTable('log_20170123');
echo $model->getTable(); // my_log
但是在 setTable 之后使用 create 插入数据，使用的还是原来的表：

$model = new MyLog();
$model->setTable('log_20170123');
echo $model->create($data); // insert into `my_log`... https://segmentfault.com/q/1010000010149118
$model->save();
```
[仅78行代码实现微信撤回消息查看~](https://segmentfault.com/p/1210000009173139/read)


[从零开始写Python爬虫 --- 爬虫应用： 利用斗鱼Api抓取弹幕](https://zhuanlan.zhihu.com/p/28164017)
```js
import multiprocessing
import socket
import time
import re
import signal

# 构造socket连接，和斗鱼api服务器相连接
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
host = socket.gethostbyname("openbarrage.douyutv.com")
port = 8601
client.connect((host, port))
乘法口诀表https://zhuanlan.zhihu.com/p/28098534?group_id=873230463827841024

for i in range(1,10):
for j in range(1,10):
        result = i * j
        print('%d * %d = % -3d' % (i,j,result))
    print('')
```
[基于laravel5+swagger-php的api接口自动生成系统](http://t.cn/R9bSoWX)
[查询全球所有城市的 API](http://www.bugcode.cn/cities.html)
[【思维导图】Python 编程：核心知识体系](https://zhuanlan.zhihu.com/p/27409997)
https://github.com/woaielf/MindMap_ZY 
[给定 key，能“长期”保存一段字符串](https://www.v2ex.com/t/377521)
比如保存到 notepad.pw 上： https://notepad.pw/n1y638kw https://archive.org/
[递归计算笛卡尔积的方法](https://laravel-china.org/topics/5482/share-a-recursive-calculation-of-cartesian-product)
```js
namespace CarteSian;

class CarteSian
{

    /**
     * Store results
     *
     * @var array
     */
    public $products = [];

    /**
     * Calculate the Cartesian product
     *
     * @param array $params
     * @param array $temporary
     */
    public function carteSian(array $params, array $temporary = [])
    {
        foreach (
            array_shift($params) as $param
        ) {
            array_push($temporary, $param);
            $params ? $this->carteSian(
                $params, $temporary
            ) : array_push(
                $this->products, $temporary
            );
            array_pop($temporary);
        }
    }
}
 

$cartSian = new CarteSian();

$params = [
   'Girls' => [
       '雾岛董香',
       '艾米莉娅',
       '结城明日奈',
   ],
   'Boys' => [
       '金木研',
       '菜月昴',
       '桐谷和人',
   ],
   'Hentais' => [
       '华城绫女',
       '培提尔其乌斯·罗马尼空提',
       '月山习',
   ]
];

$cartSian->carteSian($params);

print_r($cartSian->products);
```
[curl 和 for 循环怎么更好的使用？curl 是同步执行？](https://laravel-china.org/topics/5297/how-can-the-curl-and-for-loops-be-used-better-curl-is-synchronous-execution)
```js
//如果不设置sleep(1)就会返回$res为null
for ($i=1; $i<=200; $i++) {
         $getAddr = User::findOrFail($i)->getAddresses()->where('type', 'b')->first()->address;
         $res = json_decode($curl->get($api. $getAddr)->response);
         var_dump($res);
 }
```
[生成随机序列的算法[(https://laravel-china.org/articles/5453/share-an-algorithm-for-generating-random-sequences)
```js
function getRandomList(arr) {
    let maxWeight = 10 * arr.length; //减小重复概率 给数组里面每个元素加上随机的权重，然后根据权重排序。
    let list = [];
    for(let i in arr) {
        list.push({
            weight: Math.ceil(maxWeight * Math.random()),
            value: arr[i]
        });
    }
    list.sort(function(a, b) {
        return a.weight > b.weight;
    });

    let ans = [];
    for(let i in list) {
        ans.push(list[i].value);
    }
    return ans;
}
```
[ Python 功能和特点](https://www.itcodemonkey.com/article/403.html)
```js
Python 计算阶乘
from functools import * 
fac = lambda n:reduce(lambda x,y:x*y,range(1,n+1))  
from operator import mul 

fac = lambda x: reduce(mul, range(1, x + 1))
import math 
math.factorial(x)//120


files = glob.glob('*.py')
result = uuid.uuid1()
import itertools as it, glob, os
 
def multiple_file_types(*patterns):
    return it.chain.from_iterable(glob.glob(pattern) for pattern in patterns)
 
for filename in multiple_file_types("*.txt", "*.py"): # add as many filetype arguements
    realpath = os.path.realpath(filename)
    print realpath
 
# output
#=========#
# C:\xxx\pyfunc\test.txt
# C:\xxx\pyfunc\arg.py
# C:\xxx\pyfunc\g.py
# C:\xxx\pyfunc\shut.py
# C:\xxx\pyfunc\test.py
《中学生编程》http://red-lang.qiniudn.com/doc/v063/%E4%B8%AD%E5%AD%A6%E7%94%9F%E7%BC%96%E7%A8%8B.pdf 
安利一个Gif在线制作工具http://www.soogif.com/crop https://github.com/red/red
 一个docker的图形化管理界面 各类Json格式的免费api收集https://github.com/toddmotto/public-apis
intitle: php 程序员的算法趣题http://www.ituring.com.cn/book/tupubarticle/16800
Vue.js小书http://www.ituring.com.cn/book/tupubarticle/12949
Learn regex the easy wayhttps://github.com/zeeshanu/learn-regex
vim /etc/ssh/sshd_config Port 2222
PHP程序员也能参与的MySQL中间件项目https://github.com/swoole/mysql-proxy
《网络安全从入门到入狱》https://pan.baidu.com/share/init?shareid=1149290362&uk=2634506822 fvgm  01编程
收集了近500个互联网上公开的数据集https://github.com/caesar0301/awesome-public-datasets
正则表达式系列总结https://zhuanlan.zhihu.com/p/27653434
对一行神奇js代码的解析http://geek.csdn.net/news/detail/218601
ZeroNet：一个基于区块链的深网https://zhuanlan.zhihu.com/p/28026567
收集了各类编程语言中git需要忽略的那些文件https://github.com/github/gitignore https://www.gitignore.io/ 根据github账号来自动生成一份简历https://resume.github.io/
《机器学习基石》https://www.bilibili.com/video/av12469267/
https://github.com/RedisLabsModules/RediSearch
https://github.com/ksky521/nodeppt alter table t1 convert to character set utf8mb4;
看图识动漫https://whatanime.ga/# 

百度云资源搜索  biliworld
win: type a.avi b.avi c.avi>d.avi 
linux: cat a.avi b.avi c.avi>d.avi ffmpeg 几行代码就可以了吧http://www.cnblogs.com/jameszh/p/5547525.html
$b = str_replace(['.','-'], ['%2E','%2D'], $b); <img src="" onerror="alert(/Hello from v2ex/)">admin 
说 python 比 php 性能差的可以参考下 
https://www.techempower.com/benchmarks/ 
这里的各种 benchmark 英语学习 https://github.com/byoungd/english-level-up-tips-for-Chinese
有时候磁盘空间还有剩余，却不能新建文件时，请检查 inode 是否耗尽
print(sum(range(101))) 
from functools import reduce 
sum = reduce(lambda a,b: a + b, range(100))
javascript:void(function(){if(location.hostname.indexOf("google")){var keyword = document.getElementsByName("q")[0].value;if(location.href.indexOf("zh-CN")<0){location.href = "https://www.google.com/?&q=#q=" + keyword + "&lr=lang_zh-CN%7Clang_zh-TW";}else{location.href = "https://www.google.com/?&q=#q=" + keyword}}})()
在 if 前面 var_dump(floatval()) 看看这两个变量对比的时候是多少 比较的时候乘 100 按整数比吧 什么情况下 5.590 小于 5.59 floor(8.29 * 100 * 100 / 100) 
js 的话用 https://prettier.github.io/prettier/ 
自动帮你格式化源码，大家按自己的习惯写，git commit 的时候通过 hook 用 prettier 转换一下
PHP 来说，有 php-cs-fixer 这类的命令行工具，无论用什么 Editor 或 IDE 都行。
https://laravel-china.org/topics/547/use-php-cs-fixer-to-automatically-standardize-your-php-code  偶然发现一个网站介绍了所有的 unicode 码，里面非常多好玩的符号 
http://graphemica.com/unicode/characters/page/13  https://github.com/thefantasystudio/easypay https://www.zybuluo.com/mdeditor
校内网 www.xiaonei.com  要满足加薪，需要两个条件 
1： 你是否值得 
2： 公司是否有钱  https://zhuangbi.me/ http://www.jianshu.com/p/ed3fe9f5badd
https://github.com/nowgoo/dict 一个简单快速的词库 
从微信采集的文章https://www.worthfo.com/w/8936/ 被公司辞退了，能拿多少钱https://zhuanlan.zhihu.com/p/28039132 
https://geek.getrelink.com/ 微信公众号文章收集
https://github.com/youngwind/blog 免费SHADOWSOCKS http://trial.ssbit.win/?from=ruanyifeng
学堂在线的，http://www.xuetangx.com/courses/course-v1:ustcX+USTC001+2017_T2/about
http://0.30000000000000004.com/
html5+PHP 手机端上传头像图片剪切源码 演示下载地址： http://www.sucaihuo.com/php/2228.html
微信号「一分钟的编程知识」http://tool.lu/crontab/   wordpress 导入公众号文章的插件 beepress
https://avgle.github.io/doc/ av视频接口
机器学习 
有现成的 API 接口，做个客户端收费功能 Swoole Compiler 已就绪，最佳 PHP 代码编译加密解决方案
渗透测试人员的Python工具箱https://www.ctolib.com/cheatsheets-python_sectool.html
https://github.com/NARKOZ/hacker-scripts  一个集在线录屏、剪辑视（音）频、转换视（音）频格式于一身的网站https://www.apowersoft.cn/free-online-screen-recorder
https://github.com/anujshah1003/own_data_cnn_implementation_keras 教你怎么换自己的数据训练  Keras 的中文手册https://keras-cn.readthedocs.io/en/latest/ https://www.bilibili.com/video/av12347418/
先去github issue上面搜，没有的话再去stackoverflow上搜，还是没有的话就回去提issue了
phpwebshell https://github.com/dotcppfile/DAws
机器学习相关教程 https://morvanzhou.github.io/tutorials
微信公众号 北哥兄弟连。http://nai8.me/

```
[一个获取百度网盘直接下载链接的小工具](https://github.com/Kyle-Kyle/baidudl)
[php最好的异步实现方法](https://yq.aliyun.com/articles/83265?utm_campaign=wenzhang&utm_medium=article&utm_source=QQ-qun&2017519&utm_content=m_21446)
```js
/**
 * User: layne.xfl
 * Date: 2017/5/12
 * Time: 下午01:24
 */
class Arrow{

    static $instance;

    /**
     * @return static
     */
    public static function getInstance(){
        if (null == Arrow::$instance)
            Arrow::$instance = new Arrow();
        return Arrow::$instance;
    }

    public function run($rb){

        $pid = pcntl_fork();
        if($pid > 0){
            pcntl_wait($status);
        }elseif($pid == 0){
            $cid = pcntl_fork();
            if($cid > 0){
                //这里放空
            }elseif($cid == 0){
                $rb();
            }else{
                exit();
            }
        }else
        {
           exit();
        }

    }
}
//离弦之箭---调用方法
$time_out = 30;
Arrow::getInstance()->run(function() use ($time_out){
    //这里写我们要执行的代码
    sleep($time_out);
});
```
[程序员必知的 Python 陷阱与缺陷列表](http://python.jobbole.com/88045/)
```js
>>> import time
 
>>> def report(when=time.time()):
 
... return when
 
...
 
>>> report()
 
1500113234.487932
 
>>> report()
 
1500113234.487932
>>> def report(when=None):
 
...  if when is None:
 
...  when = time.time()
 
... return when
 
...
 
>>> report()
 
1500113446.746997
 
>>> report()
 
1500113448.552873
>>> type(())
 
<type 'tuple'>
>>> a=(1)
 
>>> type(a)
 
<type 'int'>
>>> a=(1,)
 
>>> type(a)
 
<type 'tuple'>
>>> a= [[]] * 10
 
>>> a
 
[[], [], [], [], [], [], [], [], [], []]
 
>>> a[0].append(10)
 
>>> a[0]
 
[10]
>>> a
 
[[10], [10], [10], [10], [10], [10], [10], [10], [10], [10]]
>>> a = [[] for _ in xrange(10)]
 
>>> a[0].append(10)
 
>>> a
 
[[10], [], [], [], [], [], [], [], [], []]
在访问列表的时候，修改列表
def modify_lst(lst):
 
... for idx, elem in enumerate(lst):
 
... if elem % 3 == 0:
 
... del lst[idx]
把书的彩色封面图像转为灰度图像并显示出来：

from PIL import Image
pil_im = Image.open('cover.png').convert('L')
pil_im.show()
```
[带你制作高逼格的数据聚合云图](https://github.com/forezp/ZhihuSpiderMan/tree/master/blogspider)
``js
import jieba.analyse
from bs4 import BeautifulSoup
import requests
import re
url = 'http://blog.csdn.net/forezp'
titles=set()

def download(url):
    if url is None:
        return None
    try:
        response = requests.get(url, headers={
            'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
        })
        if (response.status_code == 200):
            return response.content
        return None
    except:
        return None

def parse_title(html):
    if html is None:
        return None
    soup = BeautifulSoup(html, "html.parser")
    links = soup.find_all('a', href=re.compile(r'/forezp/article/details'))
    for link in links:
        titles.add(link.get_text())


def parse_descrtion(html):
    if html is None:
        return None
    soup=BeautifulSoup(html, "html.parser")
    disciptions=soup.find_all('div',attrs={'class': 'article_description'})
    for link in disciptions:
        titles.add(link.get_text())


def jiebaSet():
    strs=''
    if titles.__len__()==0:
        return
    for item in titles:
        strs=strs+item;


    tags = jieba.analyse.extract_tags(strs, topK=100, withWeight=True)
    for item in tags:
        print(item[0] + '\t' + str(int(item[1] * 1000)))

def main():
   html= download(url)
   # parse_title(html)
   parse_descrtion(html)
   jiebaSet()

Building prefix dict from the default dictionary ...
Dumping model to file cache C:\Users\ADMINI~1\AppData\Local\Temp\jieba.cache
Loading model cost 1.782 seconds.
Prefix dict has been built succesfully.
...     291
springboot      205
工程    155
spring  119
Eureka  119
开源    108
服务    107
web     102
创建    99
客户端  96
分布式系统      94
if __name__ == '__main__':
    main()
制作云图： 用 artword在线工具，地址：https://wordart.com
```

[php webshell](https://github.com/tanjiti/webshellSample/blob/master/PHP/dama/DAws.php)
[一个故事讲完https](https://mp.weixin.qq.com/s?__biz=MzAxOTc0NzExNg==&mid=2665513779&idx=1&sn=a1de58690ad4f95111e013254a026ca2)
对称加密算法， 因为加密和解密用的是同一个密钥  RSA的非对称加密算法 用私钥加密的数据，只有对应的公钥才能解密，用公钥加密的数据， 只有对应的私钥才能解密。
[对一行神奇js代码的解析](http://geek.csdn.net/news/detail/218601)
```js
<pre id=p><script>n=setInterval("for(n+=7,i=k,P='p.\\n';i-=1/k;P+=P[i%2?(i%2*j-j+n/k^j)&1:2])j=k/i;p.innerHTML=P",k=64)</script>
```
[常见排序算法](http://blog.githuber.cn/posts/1738)
http://bubkoo.com/2014/01/12/sort-algorithm/bubble-sort/
[xssfork - 新一代 xss 探测工具](http://paper.seebug.org/359/)
[笛卡尔乘积](https://www.v2ex.com/t/378599#reply7)
```js
from itertools import product 

>>> list(product(['Red','Black','White'], ['64G','128G'], ['USB','Type-C']))
[('Red', '64G', 'USB'), ('Red', '64G', 'Type-C'), ('Red', '128G', 'USB'), ('Red'
, '128G', 'Type-C'), ('Black', '64G', 'USB'), ('Black', '64G', 'Type-C'), ('Blac
k', '128G', 'USB'), ('Black', '128G', 'Type-C'), ('White', '64G', 'USB'), ('Whit
e', '64G', 'Type-C'), ('White', '128G', 'USB'), ('White', '128G', 'Type-C')]
```
[PHP 什么情况下 5.590 小于 5.59](https://www.v2ex.com/t/378136)
```js
floatval(5.590) < floatval(5.59)
比较的时候乘 100 按整数比吧
php > var_dump(floatval(5.590) < floatval(5.59)); 
php shell code:1: 
bool(false) 
php > var_dump(floatval(5.590) == floatval(5.59)); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 == 5.59); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 < 5.59); 
php shell code:1: 
bool(false) 
1、从数据库里面查询出来的浮点数，请使用 string。 
2、http://php.net/manual/en/book.bc.php 
3、个人癖好，有段时间，金钱我用 int 来存储，单位是分。不过现在都用 string 来做了。
 floor(8.29 * 100 * 100 / 100) //828
if (fabs(a - b) > 1e-3 && a < b)
写个专门运算的函数，全部乘以 100 之后运算，把结果再除以 100 返回，可以参考微信支付的做法 http://de2.php.net/manual/en/ref.bc.php
```
[AJAX 跨域请求](https://www.v2ex.com/t/378681)
```js
后来发现前端使用 CORS 请求时content-type取值为application/json; charset=utf-8，也就是说发送跨域请求时会发送 OPTIONS 预检请求，而我没有对设置 OPTIONS 路由
app.all('*',function (req, res, next) {
	res.header('Access-Control-Allow-Origin', '*');
	res.header('Access-Control-Allow-Headers', 'Content-Type, Content-Length, Authorization, Accept, X-Requested-With , yourHeaderFeild');
	res.header('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, OPTIONS');

	if (req.method == 'OPTIONS') {
	   console.log('you can do that!!');
	   res.send(200); // 让 options 请求快速返回
	} else {
		next();
	}
});
```

