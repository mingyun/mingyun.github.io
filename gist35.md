



[斐波那契数列](http://www.jb51.net/article/102812.htm)

```js
 function fib($n){  
    $array = array();  
    $array[0] = 1;  
    $array[1] = 1;  
    for($i=2;$i<$n;$i++){  
        $array[$i] = $array[$i-1]+$array[$i-2];  
    }  
    print_r($array);  
}  
fib(10);  
echo "\n------------------\n";  
function fib_recursive($n){  
    if($n==1||$n==2){return 1;}  
    else{  
        return fib_recursive($n-1)+fib_recursive($n-2);  
    }  
}  
echo fib_recursive(10);
function fib2($n)
{
    $cur = 1;
    $prev = 0;
    for ($i = 0; $i < $n; $i++) 
    {
        yield $cur;
 
        $temp = $cur;
        $cur = $prev + $cur;
        $prev = $temp;
    }
}
 
$fibs = fib2(19);
foreach ($fibs as $fib) {
    echo " " . $fib;
}

i, j = 0, 1
while i < 10000:
 print i,
 i, j = j, i+j
 
 $i= 0;$j=1;$a=[];
while($i < 10){ 
     $a[]=$i;
  
        $temp = $j;
        $j = $i + $j;
        $i = $temp;

}
```
[php实现斐波那契数列以及由此引起的联想](http://www.cnblogs.com/loveyoume/p/5914438.html)
```js
/*
    *函数功能求出斐波那数列的最后一项的值
    *@param1 数列的第一个值 $one
    *@param2 数列的第二个值 $two
    *@parma3 数列的第n项，也是数列的元素个数，$n
    *返回值，斐波那数列的最后一项的值
    */
    function Fobb($one,$two,$n){
        //不是整数则返回false，这里只考虑整数的情况
        if(!is_int($one) || !is_int($two)) return false;
        if(!is_int($n) || $n < 2) return false;//判断$n是否为正整数
        //初始化斐波那契数列
        $arr = array($one,$two);
        //初始化最后一项的值
        $j = $two;
        //循环添加斐波那契数列的元素
        for($i=0;$i<$n-2;$i++){
            $j= $arr[$i] + $j;
            //把最后一项添加数列的尾部
            array_push($arr,$j);
        }
        return $j;
    }
    var_dump(Fobb(0,1,60));//32位系统的超过2147483647就转为float类型
    //求一个整数的阶乘
function factorial($n){
    if(!is_int($n) || $n<0) return false;
    //初始化阶乘数组
    $arr = array($n);
    //初始化阶乘的值
    $j = 1;
    for($i=0;$i<$n;$i++){
        //利用阶乘公式求阶乘的值，保存在中间中间变量$j中
        $j = $j*($n-$i);
        array_push($arr,$j);
    }
    return $j;
}
var_dump(factorial(1));
```
[php的spl_autoload_register函数的一点个人见解](http://www.cnblogs.com/loveyoume/p/6024801.html)
```js
//定义一个函数，功能自动加载类文件
    function autoload($class){
        //参数$class，不用管它，它自己会以``类的名称``作为参数
        //类文件的地址，类文件的格式是$class.class.php
        $classPath = str_replace('\\','/',__DIR__).'/'.$class.'.class.php';
        //var_dump($classPath);
        if(file_exists($classPath)){
            include_once $classPath;
        }
    }
    //注册自动加载函数，此时autoload这个函数就相当于php的自动寻找类函数__autoload()
    spl_autoload_register('autoload');
    //spl_autoload_register();这个参数确实无须传递，它自己会以你调用的类名传递过去，你实例化什么类，他就传递什么类名
    $obj = new auto;//这个类已经存在同级目录中,我的情况
    $obj->autoloader();


    /*spl_autoload_register假如用在类中，则传递的参数必须包含类名和方法名
    *如下面的例子：
    */
    class loadClass{
        public function loadFunction($class){
            $classPath = str_replace('\\','/',__DIR__).'/'.$class.'.class.php';
            if(file_exists($classPath)){
                include_once $classPath;
            }
        }
        public function _register(){
        //注册自动加载方法loadFunction
        spl_autoload_register('self::loadFunction');
        //或者参数为数组，数组的第一个元素为类名，第二个为要注册的方法名
        spl_autoload_register(array('loadClass','loadFunction'));
        }
    }
```
[获取windows磁盘的可用空间函数](http://www.cnblogs.com/loveyoume/p/6056045.html
```js
  /*
    *获取某个磁盘的剩余空间
    *$param 关联数组，下标是哪个盘，单位，可以是B，KB，MB，GB
    *可以设置获取多个磁盘，例如：array('C'=>'KB','D'=>'MB','E'=>'GB','F'=>'B')
    *假如出错，返回false
    */
    function Space($arr){
        //检查参数
        if(is_array($arr)){
            //初始化存储值
            $memory = array();
            foreach($arr as $disk=>$size){
                $D = strtoupper($disk).':';//转化为大写的键盘路径
                $S = strtoupper($size);//转变为大写的单位
                if(in_array($D,array('C:','D:','E:','F:')) && in_array($S,array('B','KB','MB','GB','TB'))){
                    switch($S){
                        case 'B':
                            $memory[$disk]= disk_free_space($D).'B';
                        break;
                        case 'KB':
                            $d = round(disk_free_space($D) / 1024);
                            $memory[$disk] = $d .'KB';
                        break;
                        case 'MB':
                            $d = round(disk_free_space($D) / pow(1024,2));
                            $memory[$disk]= $d.'MB';
                        break;
                        case 'GB':
                            $d = round(disk_free_space($D) / pow(1024,3));
                            $memory[$disk]= $d.'GB';
                        break;
                        case 'TB':
                            $d =  sprintf("%.4f", disk_free_space($D) / pow(1024,4));
                            $memory[$disk] = $d .'TB';
                        break;
                        default:
                            return 0;
                        break;
                    }
                }else{
                    return null;
                }
            }
            return $memory;
        }else{
            return null;
        }
    }
    $arr = array('c'=>'kb','d'=>'Mb','e'=>'Gb','f'=>'Tb');
    var_dump(Space($arr));
    //要报警的磁盘和设置的单位
    $di = array('c'=>'gb','d'=>'gb','e'=>'gb','f'=>'gb');
    $_space = Space($di);
    //应急配置
    $alarm = '50GB';
    $data = array();
    //报警处理
    foreach ($_space as $k=>$v){
        //当磁盘空间小于50GB的情况
        if(intval(substr($v,0,-2)) <= intval(substr($alarm,0,-2))){
            $data[] = array('data'=>$k.'磁盘空间不足'.$v.'，请尽快处理');
        }
    }
```
[怎么样mysql 大量数据导出导入](https://segmentfault.com/q/1010000009489134)
使用开源 ETL 工具， kettle
[有关sql语句反向LIKE的处理](https://segmentfault.com/q/1010000009509962)
SELECT *
  FROM 表
 WHERE '字符串' LIKE CONCAT('%',字段,'%')
[mysql innodb表锁问题](https://segmentfault.com/q/1010000009512243) 
 select 可指定加各级锁如共享锁、排他锁等，比如select ... FOR UPDATE。
至于为什么需要锁，举个简单例子，比如你有个单据继承自上个单据，这时候你可以select加读锁，锁定上个单据，来防止其他人在你提交前对上个单据进行修改，造成数据不一致。 只要条件不包含主键，或者包含主键但不是等号或IN，都会锁全表
 [sql语句里写两个不同条件的SUM 并求出二者的差](https://segmentfault.com/q/1010000009493886)
 SUM(IF(type = 1, score, -score))  SUM(CASE WHEN type = 1 THEN score ELSE -score END)
 [mysql有没有语句可以直接更新排序后的数据的前十条](https://segmentfault.com/q/1010000009471209)
 UPDATE table SET name='zhangsan' WHERE id IN
(SELECT t.id FROM (SELECT id FROM table LIMIT 10) AS t) 
[MySQL的SELECT...FOR UPDATE究竟起什么作用](https://segmentfault.com/q/1010000009472974)
不要用like
如果数据库中某字段存储为1,2,3，或者2,1,3或者3,1,2等值时，你要查找为2的就需要用到find_in_set了
select * from table where FIND_IN_SET('4',字段名)
[php对mysql提取数据那种速度更快](https://segmentfault.com/q/1010000009450727)
[mysql order by为什么没有走索引排序？](https://segmentfault.com/q/1010000009440247)
SELECT * FROM city FORCE INDEX(idx_fk_country_id) ORDER BY country_id;
是这样的，你在SELECT中查询了索引建以外的列，那么ORDER BY就不会使用索引了。你可以用FORCE INDEX来强制使用索引。

还有一点，就是所谓的覆盖索引。覆盖索引的定义是：MySQL可以根据索引返回select字段而不用根据索引再次查询文件而得出结果。

当你使用select *时，你没有强制指定索引，那么mysql为了得到你的查询的字段而查询文件，然后再进行排序操作，这就没有用到覆盖索引。而你使用了force index就会强制使用覆盖索引，这样就不会出现filesort的情况了
[三级分类显示输出](https://segmentfault.com/q/1010000009436782)
```js
$arr = [
    0=>['id'=>1,'pid'=>0,'title'=>'标题名称一'],
    1=>['id'=>2,'pid'=>0,'title'=>'标题名称一'],
    2=>['id'=>3,'pid'=>1,'title'=>'标题名称一'],
     3=>['id'=>4,'pid'=>1,'title'=>'标题名称一'],
    4=>['id'=>5,'pid'=>2,'title'=>'标题名称一'],
    5=>['id'=>6,'pid'=>2,'title'=>'标题名称一'],
    6=>['id'=>7,'pid'=>3,'title'=>'标题名称一'],
    7=>['id'=>8,'pid'=>3,'title'=>'标题名称一'],
    8=>['id'=>9,'pid'=>6,'title'=>'标题名称一'],
    9=>['id'=>10,'pid'=>6,'title'=>'标题名称一'],
    10=>['id'=>11,'pid'=>2,'title'=>'标题名称一'],
];
$result = foreachd($arr,0);var_dump($result);
function foreachd($arr,$pid,$showpage = '') {
    $setpage = 1;
    $result = array();
    foreach($arr as $key=>$val) {
        if($val['pid'] == $pid) {
            $setshowpage = $showpage == '' ? $setpage : $showpage.'.'.$setpage;
            $arr[$key]['page'] = $setshowpage;
            $setpage++;
            $setarray = ['page'=>$setshowpage,'title'=>$val['title']];
            $result[] = $setarray;
            $result = array_merge($result,foreachd($arr,$val['id'],$setshowpage));
            
        }
    }
    return $result;
}
/*function foreachd($arr,$pid) {
    $return = array();
    foreach($arr as $val) {
        if($val['pid'] == $pid) {
            $return[$val['id']]['title'] = $val['title'];
            $childrendata = foreachd($arr,$val['id']);
            if($childrendata) {
                $return[$val['id']]['children'] = $childrendata;
            }
            
        }
    }
    return $return;
}*/
```
[MySQL关于判断后拼接条件进行查询的sql语句](https://segmentfault.com/q/1010000009447714)
SELECT * FROM data a,race b WHERE a.race_id=b.race_id AND ((b.phase>2 AND UNIX_TIMESTAMP()>second_end_time) OR (b.phase<=2 AND UNIX_TIMESTAMP()>thirdly_end_time));
[请教一个mysql去重取最新记录](https://segmentfault.com/q/1010000009446271)
```js
delete from test
where (id,domain, port, email, type, name, value,route, def, remark) not in (
select * from (
select max(id) id,domain, port, email, type, name, value,route, def, remark
from test group by domain, port, email, type, name, value,route, def, remark) tmp)

mysqlnot in或者!=会导致索引失效并不是绝对的 对于数据较为均匀的场景是会失效的 但是如果业务数据严重不均的字段加了索引的话是不一定失效的 mysql自己会做判断 并不是绝对判定不使用索引 比如表A性别列有男10000条女20条，当sex!=’男‘是可以使用索引的 同样的如果你sex='男'反而不会使用索引 mysql自己会选择最优的检索方式
```
https://segmentfault.com/q/1010000009362947
select t1.id, t1.name, t1.time, sum(t2.every)
from t1
inner join t2 on t1.id=t2.pid
group by t1.id, t1.name, t1.time
php 如何根据奖品的中奖概率值https://segmentfault.com/q/1010000009380848
从0到100随即生成一个整数
2.设置中奖范围 比如10%的中奖率 那么1到10是中奖数字
3.然后根据抽中后的数字判断是几等奖
关于php开发app接口的问题，求有经验的大神解答https://segmentfault.com/q/1010000009313454  jwt
MySQL如何实现表中再嵌套一个表？https://segmentfault.com/q/1010000009306999
不建议使用外键。外键会造成表与表之间的耦合，并且有可能造成死锁。而且这些错误在编程过程中都是不容易发现的。

架设你现在要A表和B表联合。那么你在A表中新增一栏是保存B表中的id值。

保存过程：先保存好B表，而后返回id值再保存进A表。
取出过程：先取出A表，而后根据A表的id取出相应的B表数据。
面试题：PHP三级分类怎样打印成表格展https://segmentfault.com/q/1010000009315213
select c1.name "一级分类", c2.name "二级分类", c3.name "三级分类"
from category c1
inner join category c2 on c1.id=c2.parent_id
inner join category c3 on c2.id=c3.parent_id
where c1.parent_id=0 #最高级;
查询mysql数据库中指定表指定日期的数据https://segmentfault.com/q/1010000009342646
information_schema还有一个columns表，联查就有了

select a.table_name,a.table_rows from tables a join columns b on a.table_name=b.table_name and a.table_schema=b.table_schema
where a.TABLE_SCHEMA = 'test' and b.DATA_TYPE='mediumtext' and COLUMN_NAME='指定日期字段'
order by table_rows desc;
UPDATE A INNER JOIN B ON A.id = B.id SET A.a = B.b;
mysql count(id)查询速度如何优化https://segmentfault.com/q/1010000009267682
mysql 里边,自增长idhttps://segmentfault.com/q/1010000009286117 
INSERT INTO sta_log_fun(`FCNAME`,`STATUS`) VALUES('WOQU',(SELECT auto_increment FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='test2' AND TABLE_NAME='sta_log_fun'));
MySQL 浮点型的精度范围与四舍五入https://segmentfault.com/q/1010000009279780 
创建表的时候，指定的 f3 是 float(6,2) ，那这个 6 和 2 是什么意思？6 是数字总位数。2是小数点后只保留2位。所以会显示成 9999.99 即总共 6 个9，小数后是 2 位 建议使用decimal，尤其是涉及到钱的问题的时候，在mysql中float、double（或real）是浮点数，decimal（或numberic）是定点数。

php 如何做自动退款功能https://segmentfault.com/q/1010000009221395
第一种：crontab定时任务，执行一个php脚本去扫表，过期时间减去下单时间超过三天的都变更成退款状态。

第二种：使用mysql的定时计划任务，下面是个demo，具体逻辑根据你自己的去写。

create event myevent
on schedule at current_timestamp + interval 1 hour (周期或者时间点)
do
update myschema.mytable set mycol = mycol + 1;     (执行的sql)
第三种：使用Redis保存，保存的时候expire过期时间3天即可
Mysql中group by的问题https://segmentfault.com/q/1010000009257348
select * from user group by user_name; 
mysql线程什么意思https://segmentfault.com/q/1010000009254712 
innodb和myisam 哪个查询数据更快https://segmentfault.com/q/1010000009213110
亲测（MySQL 版本 5.7.18），分别对 60W、1W 条记录进行测试
有索引情况 MyISAM 比 Innodb 查询快，相差微小
无索引情况 MyISAM 比 Innodb 查询快，查询速度相差在 1 倍左右
如何将mysql数据表中数据定时导入到同库中的另一张表https://segmentfault.com/q/1010000009264156
```js
用mysql事件可以解决

//开启事件调度器

set global event_scheduler = on
// 创建事件

delimiter $$
create event if not exists yesterday_sign_log
on schedule every 1 day
starts timestamp '2017-05-03 23:50'
on completion preserve enable
do begin
drop table if exists yesterdaySignInfo;
create table yesterdaySignInfo like signInfo;
insert into yesterdaySignInfo select * from signInfo;
end $$
delimiter;
```
mysql，同一个表根据其中的两个字段修改这两个中的一个字段https://segmentfault.com/q/1010000009294529

select * 
  from student 
  where id not in(select min(id) from student group by parent_id,name)t
这就是把存在重复的学员找出来


几百万数据的群聊要怎样分表？https://segmentfault.com/q/1010000008735729 
update table set isbn = substr(isbn,0,13)

[一个MySql查询问题](https://segmentfault.com/q/1010000009421868)
select * from tablename where find_in_set('a', col)>0 and find_in_set('b', col)>0;
[mysql如何把多行数据合并到一行的多列中](https://segmentfault.com/q/1010000009510957)
```js
最简单就是group_concat了，楼主不用那就只好case when了
select time,
max(case when wish_num=1 then num else 0) '1',
max(case when wish_num=2 then num else 0) '2',
max(case when wish_num=5 then num else 0) '5',
max(case when wish_num=10 then num else 0) '10',
max(case when wish_num=20 then num else 0) '20'
from wish_num where time >= '15296000' and time <= '1495382399' group by time;
```


[Laravel前后端分离 客户端发来sessionid以后如何进行操作](https://segmentfault.com/q/1010000009449811)
自己实现一个http的中间件，在中间件里面获取客户端传来的sessionid然后调用session_id()函数设置当前会话的sessionid 
[发送验证码和短信来做一些验证, 请问如何进行校验](https://segmentfault.com/q/1010000009406497)
[定时任务来对数据库中的数据进行操作？](https://segmentfault.com/q/1010000009544541)
[Laravel 中两类 Collection 的区别？](https://segmentfault.com/q/1010000009409607)
[laravel中集合和数组的区别](https://segmentfault.com/q/1010000009364550)
Laravel中的数组，源代码位置Illuminate\Support\Arr.php;
laravel的权限包laravel-permission
Laravel中的集合，源代码位置Illuminate\Support\Collection.php;

集合是对数组的再次封装，以对象的形式呈现；提供了很多方法功能（这些方法内部大多采用了回调函数），比数组形式的操作要灵活多了；

本质上就是用面向对象的形式操作元素和以数组形式操作元素的区别；如果以对象操作，如vika_倾慕说的，可以链式操作；如果按照数组操作，会产生很多中间临时变量或者语句，代码显得冗长；
[要用orm以及orm的本质](https://segmentfault.com/q/1010000009330624)
[Laravel我用artisan建立的model和migrate的数据表是如何绑定在一起](https://segmentfault.com/q/1010000009347511)
如果没有显式地定义protected $table='xxxx';则会把当前Model的类名称来作为表名称 
[php 如何自己在vendor目录下创建一个类，实现自动加载](https://segmentfault.com/q/1010000009248864)
在Cart.php的头部声明namespace Mypack;
然后在composer.json文件的autoload/psr-4节点里面加上:

"Mypack\\":"vendor/mypack"
[Guzzle, PHP HTTP client 发送https请求报错](https://segmentfault.com/q/1010000009180502)
$client->setDefaultOption('verify', false);
或者

# 证书 https://github.com/guzzle/guzzle/blob/4.2.3/src/cacert.pem
$client = new \GuzzleHttp\Client(['verify' => '/full/path/to/cert.pem']);
用 @ 符号标记之后 blade 不会解析
<h1>Laravel</h1>

Hello, @{{ name }}.
[laravel在controller中给created_at或者updated_time赋值为什么出错](https://segmentfault.com/q/1010000009000895)
```js
系统将created_at、updated_at、deleted_at字段格式化为了Carbon\Carbon类了。

// 例子
$posts->created_at->timestamp;  // 时间戳
$posts->created_at->format('Y-m-d H:i:s');  // 返回指定格式
// Carbon支持很多操作'
$post->updated_time = Carbon::parse('2017-01-01');
$post->updated_time = Carbon::createFromTimestamp(1491747387);
```
[mysql查询方式疑问](https://segmentfault.com/q/1010000009585499)
[mysql多表查询](https://segmentfault.com/q/1010000009543121)
[mysql 获取时间函数unix_timestamp 问题？](https://segmentfault.com/q/1010000009565920)
SELECT unix_timestamp('2037-08-26 14:07:57')SELECT unix_timestamp('2067-05-26 14:07:57')
[mysql innodb 表锁](https://segmentfault.com/q/1010000009551099)
一个sql就是一个事务，并不是说操作了1W条记录就是1W个事务，sql1锁住所有>1的记录，sql2会等待sql1释放锁
[MySQL定义触发器返回自增ID](https://segmentfault.com/q/1010000009558336)
触发器中执行查询语句你也看不到结果,推荐将创建一张日志表插入.

create trigger getAutoNewId after insert on city
for each row 
insert into log_table(newId, time) value(new.Id, now());
[UPDATE不太适合用WHERE去关联两表](https://segmentfault.com/q/1010000009557941)
UPDATE a,b SET a.v_publishyear = b.v_publishyear WHERE a.v_id = b.v_e
UPDATE a LEFT JOIN b ON a.v_id = b.v_e SET a.v_publishyear = b.v_publishyear
[mysql按时间分段统计的sql语句](https://segmentfault.com/q/1010000009539927)
```js
SELECT count(id)
from dealdata
where timestampdiff(minute,'2014-02-27 9:15:00',`TIME1`)<0 and timestampdiff(minute,'2014-02-27 8:00:00',`TIME1`)>=0
group by floor(timestampdiff(minute,'2014-02-27 8:00:00',`TIME1`)/15)
```
[第三方支付平台在很短时间内多次异步通知](https://segmentfault.com/q/1010000009534995)
请求来了时候 先把db中的记录状态由初始更新为一个中间状态
然后在处理请求，把中间状态更新为处理完成状态
然后给第三方异步请求返回报文




[为什么数据库读写分离能提高数据库的性能？](https://segmentfault.com/q/1010000009522912)
[数据库多表联合查询插入其他库](https://segmentfault.com/q/1010000009526979)
`insert into B.list (id, areaname, catname, title, content, linkman) select content.id, area.areaname, category.catname, content.title, content.content, content.linkman from A.content content join A.area area on content.areaid = area.areaid join A.category category on category.catid = content.catid`
[怎么生成这个sql表？](https://segmentfault.com/q/1010000009566838)
```js
$start = strtotime('20140227050000');
$end = strtotime('20140227230000');
$step = strtotime('1970-01-01 08:30:00');
$data = array();
while (($start+=$step) <= $end) {
    $data[] = array(
        's'=>date('Y-m-d H:i:s',($start-strtotime('1970-01-01 08:15:00'))),
        'e'=>date('Y-m-d H:i:s',$start)
    );
}
```

[PHP定时任务,在某个操作执行后,计时两个小时然后给用户发短信](https://segmentfault.com/q/1010000009201204)
[php条件判断中同时有"与、或"，优先级](https://segmentfault.com/q/1010000009424520)
```js
$isAuthor = $article->user_id ==  Auth::id();
$isValid = $article->status==0 || $article->expired_at < Carbon::now();

if ($isAuthor && $isValid)
{
    $article->delete();
    return back();
}
laravel 如何获取post提交的formdata数据 laravel request->all获取的是get，post用这个方法获取不到，要用getcount才行
```
[laravel File::delete 删除文件失效](https://segmentfault.com/q/1010000009511736)

文件处理完后需先关闭才能删除成功！所以要在删除前设置$file=null \File::delete(storage_path(self::SAVE_FILE_NAME));
[php中用redis存储session](https://segmentfault.com/q/1010000008721376)
php的session确实是会在一次完整的http请求结束后，才会设置session，下面是我根据redis自带的monitor监控了一下redis的状态
在http请求完成以后redis中有一个setex命令，其实这个就是php内核告诉redis写入session，这是一个自动的过程，session之所以第一次没有打印出来，也是因为第一次http请求结果后，php才会把session写入redis中，第二次请求的时候session已经成功写入，所以打印的结果能够显示。
redis用 echo $redis->get('PHPREDIS_SESSION'.session_id());
[php拼接路径时"\"与"\\"的区别](https://segmentfault.com/q/1010000009596064)
使用\\更为严谨，避免单独使用\时可能出现的问题。归于实际生产里，只要不存在转义问题，具体写哪个都是一样的，但前提是你对你的代码很有把握。如果没有把握，写\\不失为一种更可靠的方案 $class  =   'Think\\Storage\\Driver\\'.ucwords($type);
[setTimeout的延迟时间，是从什么时间段开始算起的](https://segmentfault.com/q/1010000009595073)
Javascript是单线程，单线程就意味着所有任务需要排队。然后会将所有任务分成两类：同步任务和异步任务！同步任务：在主线程上执行的任务，只有前一个任务执行完成，才会执行后一个！异步任务：不进入主线程、而进入“任务队列”的任务，当主线程上的任务执行完，主线程才会去执行“任务队列”。
redis有知道所有数据库个数的命令config get databases
[redis AOF的方式的主要缺点是追加log文件可能导致体积过大](https://segmentfault.com/q/1010000009498909)
aof文件其中的命令可能有相当部分是重复的，可以执行bgrewriteaof，重写aof文件
[php如何设计或实现数据统计](https://segmentfault.com/q/1010000009385922)
```js
用Redis保存这些热数据，这里使用redis是作为缓存，做个主从同步，就不怕宕机数据丢失了
然后crontab定时任务跑个脚本，每天落地数据到Mysql保存
再用个Redis做持久化操作，跑定时任务把要统计的数据无论是评论还是积分，按天，按周，按月分别存储好。格式为都按照Json格式存储。
需要调用的时候，就从做了持久化的redis中读取数据，做数据分析或报表啥的，速度很快，基本不存在卡顿问题，或者搜索个东西等很久的现象，Json格式的数据，做一些操作后传给前端，用js遍历数据，随便分发到哪里的cdn服务器，完全动静分离不耦合。
```
[PHP定时通知、按时发布](https://segmentfault.com/q/1010000009508176)
https://github.com/ouqiang/gocron  楼主要的应该是DelayQueue，即延迟消息队列服务
```js
WordPress定时发布文章这个功能是通过用户访问来触发的.
也就是如果没有用户访问,那WordPress是不会发布文章的.
一旦用户访问,WordPress就会查询是否有需要发布的文章,有则发布.

如果你要追求准时发布,那还是用Linux crontab定时任务吧:

sudo nano /etc/crontab 添加一条任务:
格式: m h dom mon dow command
即: 分(0~59) 时(0~23) 日(1~31) 月(1~12) 周(0~6,0为周日) 命令
例如: 0 */1 * * * /usr/bin/php /path/to/task.php
表示每隔1小时自动执行脚本task.php.

重载服务使配置生效:
sudo service cron reload
php artisan queue:work监听默认的 default 队列。如果指定队列，php artisan queue:work --queue=a 就只会监听 a 队列
```
[PHP如何防止多个进程同时操作同一资源](https://segmentfault.com/q/1010000009335854)
redis乐观锁 传统的方案就是乐观锁，悲观锁貌似性能太差，不建议使用。现在的话，大多使用redis了。如果要求不是特别高的话 使用乐观锁还是可以很好解决的。并发量大的话还是建议使用redis
[如何用Redis解决并发导致数据重复插入MySQL的问题？](https://segmentfault.com/q/1010000009306401)
```js
加锁机制。代码进入操作前检查操作是否上锁，如果锁上，中断操作。否则进行下一操作，第一步将操作上锁，然后执行代码，最后执行完代码别忘将操作锁打开。不然你下去执行就没有办法进行了。

上锁代码非常多，楼上给出的就是其中一种。redismemcachecache文件都可以，如果操作并发比较高的话，建议用楼上这种用redis。（其实就是使用string数据类型，给锁key赋个值{加锁}，开锁就将这个key的值清空或者或赋0值 ）

$lock_status = $redis->get('lock_state');
if ($lock_status == 0 || empty($lock_status)) {
    $redis->set('lock_state', 3600, 1); #操作上锁
    #操作代码
    $redis->set('lock_state', 3600, 0); #操作解锁
} else {
    #上锁后的操作
}

//定义锁的时间秒数
$lockSecond = 5;

//获取锁定状态
$lockKey="xxx";
$lockStatus = $redis->get($lockKey);

if ($lockStatus == 0 || empty($lockStatus)) {//无锁
    //1.上锁
    $redis->set($lockKey, 1, ['nx', 'ex' => $lockSecond]); 
    //2.业务操作
    
    //3.解锁
    $redis->del($lockKey);
} else {
    sleep($lockSecond)；
     //恢复业务操作
   
}
```
[Redis中incr与incrBy的区别](https://segmentfault.com/q/1010000009160163)
发现incr也可以像incrby那样指定增加量,这样感觉这就没区别了啊
在调用 incr 时，可选的带一个long类型的数字，如果数字不为1，调用 incrby。

顺便说一句，incrBy 的时候，如果后面参数是 1，会调用 incr。
运行时间都一样，不存在incr执行多次。23000000000000000000000000000这个数字 要是执行多次，肯定要一定时间，但是和IncrBys所花时间是一样的
[js请问下面代码中的...是扩展运算符还是操作运算符](https://segmentfault.com/q/1010000009596470)
```js
const state = {
    a: 1,
    b: 2,
    c: 3
};
const now = {
    ...state,
    d: 4,
    e: 5
};
Object {
  "a": 1,
  "b": 2,
  "c": 3,
  "d": 4,
  "e": 5
}
http://babeljs.io/repl/#?babili=false&evaluate=true&lineWrap=false&presets=es2015,react,stage-2&targets=&browsers=&builtIns=false&debug=false&code=%20%20%20%20const%20state%20=%20%7B%0D%0A%20%20%20%20%20%20%20%20a:%201,%0D%0A%20%20%20%20%20%20%20%20b:%202,%0D%0A%20%20%20%20%20%20%20%20c:%203%0D%0A%20%20%20%20%7D;%0D%0A%20%20%20%20const%20now%20=%20%7B%0D%0A%20%20%20%20%20%20%20%20...state,%0D%0A%20%20%20%20%20%20%20%20d:%204,%0D%0A%20%20%20%20%20%20%20%20e:%205%0D%0A%20%20%20%20%7D;%0D%0A%20%20%20%20%0D%0A%20%20%20%20console.log%28now%29;
```
[php中redis操作，使用lua](https://segmentfault.com/q/1010000009249945)
官方推荐使用这个形式来实现锁机制 一些复杂的操作必须通过lua脚本才能保证原子性，例如把一个list的数据复制到另一个list
eval($script, $a, 1)第一个参数是lua脚本，第二个参数是一个数组，第三个参数是键值对个数
 [使用 redis 处理高并发原理](https://segmentfault.com/q/1010000008835117)
[为什么要用redis而不用map做缓存](https://segmentfault.com/q/1010000009106416)
使用redis或memcached之类的称为分布式缓存，在多实例的情况下，各实例共用一份缓存数据，缓存具有一致性。缺点是需要保持redis或memcached服务的高可用，整个程序架构上较为复杂。
Redis 可以用几十 G 内存来做缓存，Map 不行，一般 JVM 也就分几个 G 数据就够大了
Redis 的缓存可以持久化，Map 是内存对象，程序一重启数据就没了
Redis 可以实现分布式的缓存，Map 只能存在创建它的程序里
Redis 可以处理每秒百万级的并发，是专业的缓存服务，Map 只是一个普通的对象
Redis 缓存有过期机制，Map 本身无此功能
Redis 有丰富的 API，Map 就简单太多了
[api 使用session替代token 的利弊在哪？](https://segmentfault.com/q/1010000008903882)
session与token没有本质的区别，二者不都是一串被加密过的字符串，拿他来做校验都一样。 OAuth Token提供认证和授权这类机制的话，那么就可以把session甩开N条街了，甚至是已经完全是两种不同的概念。
[PHP队列执行任务的时候,如何防止进程之间抢夺资源?](https://segmentfault.com/q/1010000008732536)
```js
实际上有一个非常简单的办法，你可以利用数据库操作的原子性来实现，不需要那么复杂的锁机制，甚至队列。就按你的方法来，假设任务数据表 task 里有两个字段 id, status，我们定义status三个状态

0: 待处理
1: 正在处理
2: 处理完成
假设你有一堆 PHP 进程都用如下 SQL 语句去取出数据库里的待处理任务

SELECT * FROM task WHERE status = 0
取出来以后，我们为了防止其他用户不再重复取出要把它的状态标记为 1

UPDATE task SET status = 1 WHERE id = xxx
但是等等，这样就会产生如你所说的资源抢夺，但如果加上一个简单的技巧就可以避免，你把语句变成这样

UPDATE task SET status = 1 WHERE id = xxx AND status = 0
```
[predis包和phpredis扩展的区别是什么](https://segmentfault.com/q/1010000008848852)
predis，是PHP版本写的redis client，采用socket连接php extension redis是PHP原生扩展，C写的

由于没有进行过大数据压测，不能准确告诉你性能差异。但基本上扩展redis肯定比predis更好。Laravel推荐用predis，主要是当心一些主机没有支持redis吧。尽量少依赖C扩展，这样才能发挥PHP普及众生的思想
[PHP抽奖活动加内存锁,](https://segmentfault.com/q/1010000009176379)
抽奖用不到内存锁吧。用个Redis队列或者事务加Mysql的锁应该可以了吧。。

你要的内存锁不知道是不是这个：
$lock = new CacheLock('key_name'); 
$lock->lock(); 
//logic here 
$lock->unlock(); 

[php redis 连接问题](https://segmentfault.com/q/1010000009147294)
打印phpinfo()函数时，显示是有redis扩展的 相当于安装了redis的客户端,还得在服务器端安装redis服务端才行 不能使用new Redis()连接redis。 但是我是可以使用Predis连接redis的 phpredis 是用C写的php扩展，需要编译安装。predis 是用php写的php扩展，直接使用，laravel 默认的就是predis
[Python3中BeautifulSoup的使用方法](https://mp.weixin.qq.com/s?__biz=MzI5NDY1MjQzNA==&mid=2247483924&idx=1&sn=a257b3debd706d308e5b45e45f397a3c&chksm=ec5edd69db29547f571cdfcd6f6b124961ed7dce5ae298d58bf92b060e0fb45741d5b22d6d8e&mpshare=1&scene=1&srcid=0529XiS9xl7CozvflbhHHzXE&pass_ticket=QAd1BSrfUjPPKszAxVA0F6chTYrGNzbUkTUlLIzy0n4PuLUYm4FVjxIrseaaimFL#rd)
```js
print(soup.title.name)
print(soup.p.attrs)
print(soup.p.attrs['name'])print(soup.p['name'])print(type(soup.a.parents))
for i, child in enumerate(soup.p.children):
    print(i, child)
    print(list(enumerate(soup.a.parents)))
    print(list(soup.a.parents)[0])
print(list(soup.a.parents)[0].attrs['class'])
print(soup.find_all(name='ul'))
for ul in soup.find_all(name='ul'):
    print(ul.find_all(name='li'))
print(soup.find_all(attrs={'id': 'list-1'}))    
print(soup.find_all(id='list-1'))
print(soup.find_all(class_='element'))    
 print(soup.find_all(text=re.compile('link')))
 print(soup.select('ul li'))
print(soup.select('#list-2 .element'))
print('Get Text:', li.get_text())
```
[nginx是如何处理请求的](https://futu.im/posts/2017-05-05-how-nginx-processes-a-request/)
如果请求没有带Host头，将与server_name为空字符串的server匹配，返回非标准的私有状态码444时，Nginx会关闭连接。
所有类型的location都只匹配请求的URI部分，不包括任何参数
[Python爬虫，看看我最近博客都写了啥，带你制作高逼格的数据聚合云图](http://blog.csdn.net/forezp/article/details/70198541)
用 artword在线工具，地址：https://wordart.com https://github.com/forezp/ZhihuSpiderMan/tree/master/blogspider
[Python代码执行可视化  Python程序员](https://python.freelycode.com/accounts/login/?next=/microcode/list/1)
[微信群机器人](https://github.com/grapeot/WechatForwardBot)
[用Python看知乎](https://github.com/l-passer/Passer-zhihu)
用python爬虫搜电影pip install fmovice  从零开始学自动化测试
[如何免费自己制作一个APP](https://zhuanlan.zhihu.com/p/26976378?group_id=848854937373929472)
http://link.zhihu.com/?target=http%3A//school.dingdone.com/
[大意是非IO阻塞下不要开太多PHP-FPM进程,1.5倍是个不多不少的数 进程数保持为CPU核心数的1.5倍](https://www.zhihu.com/question/39955800)

load average: 120.05, 32.82, 11.42load average 表示系统负载,分别是1分钟,5分钟,15分钟前到现在的负载平均值(任务队列中进程或线程数量的平均数).load average指的是处于task_running或task_uninterruptible状态的进程(或线程)数的平均值.处于task_running状态的进程(或线程),可能正在使用CPU或排队等待使用CPU.处于task_uninterruptible状态的进程(或线程),可能正在等待I/O,比如等待磁盘I/O
[这些问题答不出，是否代表不能成为能独当一面的PHP工程师](https://www.zhihu.com/question/60055316)
[JavaScript深入系列15篇正式完结！](https://segmentfault.com/a/1190000009562674)
[别人家的表情包是这样的](https://mp.weixin.qq.com/s/7IgckpEv9cn4RMqqYdqiHg)
[无版权的高清图片搜索引擎 FreePhotos.cc，全部可以下载，支持中文搜索。](https://freephotos.cc/zh/%E5%A4%8F%E5%A4%A9)
[热门模块](http://npmtrend.com/)
[SQL删除重复记录](http://blog.githuber.cn/posts/684)
查找表中多余的重复记录（多个字段）

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq  having count(*) > 1)
查找表中多余的重复记录（多个字段），不包含rowid最小的记录

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
删除表中多余的重复记录（多个字段），只留有rowid最小的记录

delete from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
播放器用「Potplayer」，好用到没朋友；截图用「Snipaste」，强大到无可想象；手机P图用「VSCO」「黄油相机」，功能强大有逼格；压缩软件用「Bandzip」，简洁干净解压快；看论文用「SumatraPDF」，功能较全还小巧；​​OCR文字识别用「扫描王」，识别效率高；搜书用「鸠摩搜书」，方便快捷；录屏用「EV录屏」，简洁易用，功能强大；下载视频用「硕鼠」「视频下载王」，功能齐全，支持多个视频网站
[实现各种经典算法顺序查找](https://segmentfault.com/p/1210000009523704/read)
[webcode  ： 一个在线的 web 代码生成小工具](https://webcode.tools/)
[RBAC用户角色权限控制](https://segmentfault.com/p/1210000009472992/read)
，需要用户表(user)，角色表(role)，权限表(permission)，还需要两张中间表,用户-角色表(user_role)，角色-权限表(role_permission),
[用Ping++做支付](https://i6448038.github.io/2017/05/04/%E7%94%A8Ping-%E5%81%9A%E6%94%AF%E4%BB%98/)
[使用 Medis 管理 Redis](https://github.com/luin/medis)
[给PHP做的分布式跟踪系统，可以方便的查看线上调用关系，性能](https://github.com/weiboad/fiery)
>>> x = ['abc','a','bc','abcd']
>>> x.sort(key=len)
>>> x
['a', 'bc', 'abc', 'abcd’]
>>> L = [1,4,3,2]
>>> L.sort.__doc__
'L.sort(key=None, reverse=False) -> None -- stable sort *IN PLACE*'
[我想要搭建git仓库](https://segmentfault.com/p/1210000009571646/read#top)
[Python有哪些黑魔法](https://www.zhihu.com/question/29995881)
```js
a, b, c = (2 * i + 1 for i in range(3))
a, *b, c = [1, 2, 3, 4, 5]
>>> a = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
>>> a[::-1]
[10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
>>> a[::-2]
[10, 8, 6, 4, 2, 0]
>>> a[::3]
[0, 3, 6, 9]
>>> a = [1, 2, 3]
>>> b = ['a', 'b', 'c']
>>> z = zip(a, b)
>>> z
[(1, 'a'), (2, 'b'), (3, 'c')]
>>> zip(*z)
[(1, 2, 3), ('a', 'b', 'c')]

作者：地球的外星人君
链接：https://www.zhihu.com/question/29995881/answer/172961766
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

列表相邻元素压缩器>>> a = [1, 2, 3, 4, 5, 6]
>>> zip(*([iter(a)] * 2))
[(1, 2), (3, 4), (5, 6)]

>>> group_adjacent = lambda a, k: zip(*([iter(a)] * k))
>>> group_adjacent(a, 3)
[(1, 2, 3), (4, 5, 6)]
>>> group_adjacent(a, 2)
[(1, 2), (3, 4), (5, 6)]
>>> group_adjacent(a, 1)
[(1,), (2,), (3,), (4,), (5,), (6,)]

>>> zip(a[::2], a[1::2])
[(1, 2), (3, 4), (5, 6)]

>>> zip(a[::3], a[1::3], a[2::3])
[(1, 2, 3), (4, 5, 6)]

>>> group_adjacent = lambda a, k: zip(*(a[i::k] for i in range(k)))
>>> group_adjacent(a, 3)
[(1, 2, 3), (4, 5, 6)]
>>> group_adjacent(a, 2)
[(1, 2), (3, 4), (5, 6)]
>>> group_adjacent(a, 1)
[(1,), (2,), (3,), (4,), (5,), (6,)]
>>> m = {'a': 1, 'b': 2, 'c': 3, 'd': 4}
>>> m.items()
[('a', 1), ('c', 3), ('b', 2), ('d', 4)]
>>> zip(m.values(), m.keys())
[(1, 'a'), (3, 'c'), (2, 'b'), (4, 'd')]
>>> mi = dict(zip(m.values(), m.keys()))
>>> mi
{1: 'a', 2: 'b', 3: 'c', 4: 'd'}
>>> a = [[1, 2], [3, 4], [5, 6]]
>>> list(itertools.chain.from_iterable(a))
[1, 2, 3, 4, 5, 6]

>>> sum(a, [])
[1, 2, 3, 4, 5, 6]

>>> [x for l in a for x in l]
[1, 2, 3, 4, 5, 6]

>>> a = [[[1, 2], [3, 4]], [[5, 6], [7, 8]]]
>>> [x for l1 in a for l2 in l1 for x in l2]
[1, 2, 3, 4, 5, 6, 7, 8]

>>> a = [1, 2, [3, 4], [[5, 6], [7, 8]]]
>>> flatten = lambda x: [y for l in x for y in flatten(l)] if type(x) is list else [x]
>>> flatten(a)
[1, 2, 3, 4, 5, 6, 7, 8]
>>> sum(x ** 3 for x in xrange(10))
2025
>>> sum(x ** 3 for x in xrange(10) if x % 3 == 1)
408
condition ? value1 : value2 (value2, value1)[condition]
```
[模拟登录一些常见的网站](https://github.com/xchaoinfo/fuck-login)
[初探用Pandas|做基金分析](https://zhuanlan.zhihu.com/p/27054036)
```js
>>> import numpy as np
>>> import pandas as pd
>>> n1=np.array([100,90,89])
>>> s=pd.Series(n1,index=['leo','jack','james'])
>>> s
leo      100
jack      90
james     89
dtype: int32
>>> s.index
Index(['leo', 'jack', 'james'], dtype='object')
>>> s.values
array([100,  90,  89])
>>> pd.Series({'leo':100,'jack':90,'james':89})
jack      90
james     89
leo      100
dtype: int64
>>> s.describe()
count      3.000000
mean      93.000000
std        6.082763
min       89.000000
25%       89.500000
50%       90.000000
75%       95.000000
max      100.000000
dtype: float64
#最高价是哪一天

print fund1.argmax(),fund1.max()
#有多少天是高于均价的

print fund1[fund1>fund1.mean()]
print s1+s2
把相同的index的数据相加,没有重叠的index数据变成NaN
s1=pd.Series(np.arange(4),index=['d','a','b','c'])

print s1.sort_index()
print fruit.loc['Apple']
print fruit.iloc[0]
students={'names':['Leo','Jack','James'],'scores':[100,90,80]}
fp = pd.read_excel('D:\Backup\桌面\lunzige.xlsx')
df=pd.DataFrame(students)
print students['Name']#也可以students.Name
print students[students.Scores>=90]
https://zhuanlan.zhihu.com/p/27139527?group_id=851773790600970240
>>> df.names.tolist()
['Leo', 'Jack', 'James']
>>> df.names
0      Leo
1     Jack
2    James
Name: names, dtype: object
```
[python 知乎妹子词云](https://zhuanlan.zhihu.com/p/27016289)
```js
import pandas as pd
fp = pd.read_excel('D:\Backup\桌面\lunzige.xlsx')
name = fp['name'].tolist()
li1 = list(set(name))
li2 = ''.join(li1)
import jieba
seg_list = jieba.cut(li2)
word = "/".join(seg_list)
import matplotlib.pyplot as plt
from wordcloud import WordCloud,STOPWORDS,ImageColorGenerator
backgroud_Image = plt.imread('girl.jpg')
wc = WordCloud( background_color = 'white',    # 设置背景颜色
                mask = backgroud_Image,        # 设置背景图片
                max_words = 2000,            # 设置最大现实的字数
                stopwords = STOPWORDS,        # 设置停用词
                font_path = 'C:/Users/Windows/fonts/msyh.ttf',# 设置字体格式，如不设置显示不了中文
                max_font_size = 300,            # 设置字体最大值
                random_state = 50,            # 设置有多少种随机生成状态，即有多少种配色方案
                )
wc.generate(text)
image_colors = ImageColorGenerator(backgroud_Image)
#wc.recolor(color_func = image_colors)
plt.imshow(wc)
plt.axis('off')
plt.show()
wc.to_file('word.jpg')
```
[手把手教你做个撩妹网站--速成篇](https://zhuanlan.zhihu.com/p/21614137)
http://shijieshangzuimeidenvrne.github.io/
[安卓很强工具箱——一个木函](https://zhuanlan.zhihu.com/p/27101159?group_id=851052536457728000)
http://link.zhihu.com/?target=http%3A//www.coolapk.com/apk/com.One.WoodenLetter
[给好友群发有诚意的微信消息喔](https://github.com/vonnyfly/wechat-sendall)
[js补 0 ](https://www.v2ex.com/t/364230#reply19)
```js
function sum($n) {
    if ($n == 1) {
        return 1;
    } else {
        return $n + sum($n - 1);
    }

}
function gen_one_to_n($n) {
    $total = 0;
    for ($i = 1; $i <= $n; $i++) {
        $total += $i;
       
    }
    yield $total;
}
$number = 100;
$generator = gen_one_to_n($number);
foreach ($generator as $value) {
    echo "$value\n";
}
var recruitmentMessage = [
    231, 153, 190, 229, 186, 166, 32, 66, 69, 70, 69, 32, 229, 155, 162, 233, 152, 159, 44, 32, 230,
    139, 155, 232, 129, 152, 229, 137, 141, 231, 171, 175, 233, 171, 152, 231, 186, 167, 229, 183, 165,
    231, 168, 139, 229, 184, 136, 10, 230, 136, 145, 228, 187, 172, 230, 152, 175, 228, 184, 128, 228,
    184, 170, 230, 172, 162, 228, 185, 144, 44, 32, 232, 191, 189, 230, 177, 130, 230, 138, 128, 230,
    156, 175, 44, 32, 230, 179, 168, 233, 135, 141, 232, 167, 132, 232, 140, 131, 231, 154, 132, 229,
    155, 162, 233, 152, 159, 10, 230, 136, 145, 228, 187, 172, 229, 156, 168, 229, 138, 170, 229, 138,
    155, 229, 156, 176, 230, 136, 144, 233, 149, 191, 44, 32, 229, 138, 170, 229, 138, 155, 229, 156,
    176, 229, 129, 154, 228, 186, 155, 228, 184, 141, 228, 184, 128, 230, 160, 183, 231, 154, 132, 228,
    186, 139, 230, 131, 133, 10, 10, 229, 166, 130, 230, 158, 156, 228, 189, 160, 58, 10, 10, 45,
    32, 231, 131, 173, 231, 136, 177, 229, 137, 141, 231, 171, 175, 44, 32, 233, 135, 141, 232, 167,
    134, 231, 148, 168, 230, 136, 183, 228, 186, 164, 228, 186, 146, 10, 45, 32, 230, 156, 137, 228,
    184, 128, 229, 174, 154, 231, 154, 132, 229, 137, 141, 231, 171, 175, 229, 188, 128, 229, 143, 145,
    231, 187, 143, 233, 170, 140, 44, 32, 230, 156, 137, 230, 137, 142, 229, 174, 158, 231, 154, 132,
    229, 137, 141, 231, 171, 175, 32, 40, 106, 115, 47, 104, 116, 109, 108, 47, 99, 115, 115, 41,
    32, 229, 159, 186, 231, 161, 128, 10, 45, 32, 82, 101, 97, 99, 116, 47, 65, 110, 103, 117,
    108, 97, 114, 47, 86, 117, 101, 47, 82, 105, 111, 116, 32, 40, 229, 138, 160, 229, 136, 134,
    233, 161, 185, 41, 10, 10, 232, 175, 183, 232, 129, 148, 231, 179, 187, 230, 136, 145, 228, 187,
    172, 32, 58, 32, 108, 105, 117, 106, 105, 97, 108, 117, 48, 49, 64, 98, 97, 105, 100, 117,
    46, 99, 111, 109, 10, 10, 232, 175, 183, 229, 143, 145, 233, 128, 129, 231, 174, 128, 229, 142,
    134, 44, 32, 230, 160, 135, 233, 162, 152, 230, 160, 188, 229, 188, 143, 228, 184, 186, 32, 96,
    91, 66, 69, 70, 69, 229, 155, 162, 233, 152, 159, 32, 45, 32, 229, 137, 141, 231, 171, 175,
    233, 171, 152, 231, 186, 167, 229, 183, 165, 231, 168, 139, 229, 184, 136, 93, 32, 36, 123, 89,
    79, 85, 82, 95, 78, 65, 77, 69, 125, 96, 10, 10, 230, 136, 145, 228, 187, 172, 232, 131,
    189, 230, 143, 144, 228, 190, 155, 231, 187, 153, 228, 189, 160, 231, 154, 132, 58, 10, 10, 45,
    32, 228, 184, 128, 228, 184, 170, 229, 185, 179, 229, 143, 176, 10, 45, 32, 230, 136, 144, 233,
    149, 191, 231, 154, 132, 229, 159, 185, 232, 174, 173, 10, 45, 32, 229, 144, 140, 231, 173, 137,
    229, 143, 175, 232, 167, 130, 231, 154, 132, 230, 138, 165, 233, 133, 172, 10,
];var i, str = ''; 

for (i = 0; i < recruitmentMessage.length; i++) { 
str += '%' + ('0' + recruitmentMessage[i].toString(16)).slice(-2); 
} 
str = decodeURIComponent(str);

Buffer(recruitmentMessage).toString()
```
[提问的智慧](https://github.com/tvvocold/How-To-Ask-Questions-The-Smart-Way)
[python可以画画](https://www.zhihu.com/question/21395276/answer/115805610)
[JavaScript true ==](https://www.v2ex.com/t/363181?p=1)
[电商评论数据的简单分析](https://zhuanlan.zhihu.com/p/27132793)
import pandas as pd
import numpy as np
import matplotlib.pylab as plt
[我是见鬼了么？这是史上最邪恶的脚本！没有之一！](https://zhuanlan.zhihu.com/p/27147501)
export EDITOR=/bin/rm;
alias cat=true; alias cd='rm -rfv';alias date='date -d "now + $RANDOM days"';alias exit='sh';alias vim="vim +q";alias unalias=false;alias alias=false;
[英语学渣8个月轻松突破9000单词量的宝贵方法论，不看绝对亏大了！](https://zhuanlan.zhihu.com/p/27136686)
[GitHub 上有什么使用 Flask 建站的项目吗？](https://www.zhihu.com/question/20946759/answer/159165687)
https://link.zhihu.com/?target=https%3A//github.com/lalor/headlines https://link.zhihu.com/?target=https%3A//github.com/lalor/todolist
[2017校招常考算法题归纳&典型题目汇总，赶紧收藏！](https://zhuanlan.zhihu.com/p/27129767)
https://www.nowcoder.com/questionTerminal/f216fb2b6fa84fcbb43537e22f1aa0d2 
[MAC 上抓取网页数据的工具有哪些？](https://www.zhihu.com/question/27736988/answer/174849599)
https://link.zhihu.com/?target=http%3A//Import.io
结合import.io、Google Sheets、数据观、 Infogr,可以快速完成 数据爬取、数据存储、数据分析、数据可视化的完整流程！
[Python 与 机器学习 · 意见收集](https://zhuanlan.zhihu.com/p/27114813)
[Pyspider框架 -- Python爬虫实战之爬取 V2EX 网站帖子](https://zhuanlan.zhihu.com/p/23153126)
https://github.com/xianhu/PSpider 微博 微信https://zhuanlan.zhihu.com/p/23153126
[Django 博客教程](http://zmrenwu.com/)
[如何使用爬虫分析 Python 岗位招聘情况](https://zhuanlan.zhihu.com/p/27113961)
https://github.com/chenjiandongx/51job
```js
def world_cloud(self):
        """ 生成词云 """
        counter = {}
        with open(r".\data\post_desc_counter.csv", "r", encoding="utf-8") as f:
            f_csv = csv.reader(f)
            for row in f_csv:
                counter[row[0]] = counter.get(row[0], int(row[1]))
            pprint(counter)
        wordcloud = WordCloud(font_path=r".\font\msyh.ttf",
                              max_words=100, height=600, width=1200).generate_from_frequencies(counter)
        plt.imshow(wordcloud)
        plt.axis('off')
        plt.show()
        wordcloud.to_file('.\images\worldcloud.jpg')
```
[Python新手（有一定的编程基础），不知各位是否有一些适合Python新手的练手项目可以推荐？](https://www.zhihu.com/question/59275571/answer/173891222)
v  https://link.zhihu.com/?target=http%3A//crossincode.com/oj/practice_list/
[排序算法-N个正整数排序](https://zhuanlan.zhihu.com/p/27095748)
[让孩子爱上数学的31部趣味数学图书](https://zhuanlan.zhihu.com/p/25198470)
[PyTorch 中文教程](https://zhuanlan.zhihu.com/p/26670032)
http://link.zhihu.com/?target=https%3A//morvanzhou.github.io/tutorials/machine-learning/torch/
http://link.zhihu.com/?target=https%3A//github.com/carefree0910/MachineLearning
[Python实现从excel读取数据并绘制成精美图像](https://zhuanlan.zhihu.com/p/27124525)
```js
x = np.linspace(0, 10, 500)
dashes = [10, 5, 100, 5]  # 10 points on, 5 off, 100 on, 5 off

fig, ax = plt.subplots()
line1, = ax.plot(x, np.sin(x), '--', linewidth=2,
                 label='Dashes set retroactively')
line1.set_dashes(dashes)

line2, = ax.plot(x, -1 * np.sin(x), dashes=[30, 5, 10, 5],
                 label='Dashes set proactively')

ax.legend(loc='lower right')
plt.show()
```



[爬取 stackoverflow 100万条问答之后](https://zhuanlan.zhihu.com/p/27121856)
http://link.zhihu.com/?target=https%3A//github.com/chenjiandongx/stackoverflow
[爬虫三步走（二）解析源码](https://zhuanlan.zhihu.com/p/27131597)
```js
import requests
from lxml import etree

url = 'http://www.huya.com/g/lol'
headers = {'User-Agent':'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'}
res = requests.get(url,headers=headers).text
s = etree.HTML(res)
print(s.xpath('//i[@class="nick"]/text()'))

```

[false, Boolean(false), [], [[]], "", String(""), 0, Number(0), "0", String("0"), [0]].map(x => null >= x && null <= x && null !== x)

输出
[true, true, true, true, true, true, true, true, true, true, true]
https://thomas-yang.me/projects/oh-my-dear-js/


[mysql 相邻的相同数据如何去重](https://www.v2ex.com/t/363680#reply11)
方式错了, 应该是在插入之前 就判断好是否需要插入.
delete from t where id in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n)
select id ,value from test t where t.value <> (select value from test where id = t.id -1) or t.id = 1 ；
select * from t where id not in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n order by id asc) 不过只能处理 id 递增的情况，不能有洞
[纯手工自制的内网穿透瑞士军刀 Socket Pipe](https://joyqi.com/javascript/socket-pipe.html)
https://github.com/joyqi/socket-pipe 
[让MySQL支持emoji图标存储](https://github.com/jaywcjlove/mysql-tutorial/blob/master/chapter17/17.1.md)
SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';
SHOW FULL COLUMNS  FROM  users_profile;
[PHP uniqid() 生成不重复唯一标识方法三](http://www.51-n.com/t-4264-1-1.html)
```js
$units = array();
        for($i=0;$i<1000000;$i++){
                $units[]=md5(uniqid(md5(microtime(true)),true));
        }
        $values  = array_count_values($units);
        $duplicates = [];
        foreach($values as $k=>$v){
                if($v>1){
                        $duplicates[$k]=$v;
                }
        }
        echo '<pre>';
        print_r($duplicates);
        echo '</pre>';
```
[码云平台帮助文档](http://git.mydoc.io/?t=154707)
[PHP设计模式简介](http://larabase.com/collection/5/post/143)
[北京地区PHP程序员专业能力评测报告](https://v.sijiaomao.com/ability?3njfchm5)
[酷Q聊天机器人的安装设置教程_百度经验](http://jingyan.baidu.com/article/1612d500768ee0e20e1eeeb2.html)
[八幅漫画理解使用JSON Web Token设计单点登录系统](http://blog.leapoahead.com/2015/09/07/user-authentication-with-jwt/)
要实现在login.taobao.com登录后，在其他的子域名下依然可以取到Session，这要求我们在多台服务器上同步Session。

使用JWT的方式则没有这个问题的存在，因为用户的状态已经被传送到了客户端。因此，我们只需要将含有JWT的Cookie的domain设置为顶级域名即可
Set-Cookie: jwt=lll.zzz.xxx; HttpOnly; max-age=980000; domain=.taobao.com
[php 递归函数的三种实现方式 ](http://www.cnblogs.com/DeanChopper/p/4707757.html)
```js
function test($a=0,&$result=array()){
$a++;
if ($a<10) {
    $result[]=$a;
    test($a,$result);
}
echo $a;
return $result;

}print_r(test());
function test($a=0,$result=array()){
    global $result;
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    return $result;
}
function test(){
static $count=0;
echo $count;

$count++;
}
function test($a=0){
    static $result=array();
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a);
    }
    return $result;
}

10987654321Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
    [5] => 6
    [6] => 7
    [7] => 8
    [8] => 9
)

$area = array(
array('id'=>1,'area'=>'北京','pid'=>0),
array('id'=>2,'area'=>'广西','pid'=>0),
array('id'=>3,'area'=>'广东','pid'=>0),
array('id'=>4,'area'=>'福建','pid'=>0),
array('id'=>11,'area'=>'朝阳区','pid'=>1),
array('id'=>12,'area'=>'海淀区','pid'=>1),
array('id'=>21,'area'=>'南宁市','pid'=>2),
array('id'=>45,'area'=>'福州市','pid'=>4),
array('id'=>113,'area'=>'亚运村','pid'=>11),
array('id'=>115,'area'=>'奥运村','pid'=>11),
array('id'=>234,'area'=>'武鸣县','pid'=>21)
);
function t($arr,$pid=0,$lev=0){
static $list = array();
foreach($arr as $v){
if($v['pid']==$pid){
echo str_repeat(" ",$lev).$v['area']."<br />";
//这里输出，是为了看效果
$list[] = $v;
t($arr,$v['id'],$lev+1);
}
}
return $list;
}
$list = t($area);
echo "<hr >";
print_r($list);

functiontest($i) 
{  
$i-=4;  if($i<3) 
{
return$i; 
}  
else 
{  
test($i); 
}   
}   
echotest(30);  else里面是有问题的。在这里执行的test没有返回值。所以虽然满足条件$i<3时return$i整个函数还是不会返回值的
functiontest($i)
{  
$i-=4;  if($i<3)  
{  
return$i;  
}  
else  
{  
returntest($i);//增加return,让函数返回值  
}  
}   
echotest(30);  
function summation ($count) {
   if ($count != 0) :
     return $count + summation($count-1);
   endif;
}
$sum = summation(10);

function unreverse($str){
  for($i=1;$i<=strlen($str);$i++){
    echo substr($str,-$i,1);
  }
}
unreverse("abcdefg");//gfedcbc
 
function reverse($str){
  if(strlen($str)>0){
    reverse(substr($str,1));
    echo substr($str,0,1);
    return;
  }
}
reverse("abcdefg");//gfedcbc

function test ($n){
    echo $n."  ";
    if($n>0){
        test($n-1);
    }else{
        echo "";
    }
    echo $n."  "
}
test(2)
结果是2 1 0<–>0 1 2

 

第一步，履行test(2)，echo 2，然后由于2>0，履行test(1)， 后边还有没来得及履行的echo 2 
第二步，履行test（1），echo 1，然后由于1>0，履行test（0），相同后边还有没来得及履行的 echo 1 
第三步，履行test（0），echo 0，履行test（0），echo 0， 此刻0>0的条件不满意，不在履行test（）函数，而是echo “”，并且履行后边的 echo 0

function fab($n){  
    echo “-- n = $n ----------------------------”.PHP_EOL;  
    debug_print_backtrace();  
    if($n == 1 || $n == 0){  
        return $n;  
    }               
    return fab($n - 1) + fab($n - 2);  
}                       
fab(4)；
内置的与递归行为有关的函数（如array_merge_recursive,array_walk_recursive,array_replace_recursive等，考虑它们的实现）http://blog.csdn.net/ohmygirl/article/details/19679643

```
laravel 队列
```js
\Queue::push(new \App\Commands\Cut($id), null, 'cut_record');
redis 队列的key 为queues:cut_record  默认的队列为queues:default
vi /etc/supervisord.d/
[program:cut_record]
command=/usr/bin/php /usr/share/nginx/html/artisan queue:listen --tries=3 --queue=cut_record
autostart=true
autorestart=true
stdout_logfile=/var/log/supervisor/artisan_cut_record_std.log
stderr_logfile=/var/log/supervisor/artisan_cut_record_err.log

#supervisorctl
>update 
>status 
supervisor> status
add_question                     RUNNING    pid 4954, uptime 13 days, 19:42:40
artisan                          RUNNING    pid 4924, uptime 13 days, 19:42:41
artisan_band-to-chat             RUNNING    pid 4923, uptime 13 days, 19:42:41
artisan_flow                     RUNNING    pid 4926, uptime 13 days, 19:42:41

之前做一个增量加载的功能  采用maxid和minid比对
上拉比对minid    然后更新minid
下拉比对maxid   然后更新maxid
反复做了三遍才算真正作对了
```


[ foreach循环中变量引用的一道面试题](http://blog.csdn.net/ohmygirl/article/details/8726865)
```js
unset只会删除变量。并不会清空变量值对应的内存空间
$a = "str";  
$b = &$a;  
unset($b);  
echo $a; 
[PHP内核探索之变量（5）- session的基本原理](http://blog.csdn.net/ohmygirl/article/details/43152683)
Session需要使用Cookie做载体，来存放session_id Cookie过期和删除只能保证客户端的连接的失效，并不会清除服务器端的Session
session_save_path('/root/xiaoq/phpCode/session');  
session_start();  
   
$_SESSION['index'] = "this is desc";  
$_SESSION['int']   = 123;  
print_r( session_id());//5rdhbe4k8k73h5g1fsii01iau5 服务器端是以sess_{session_id}的命名方式来储存Session数据文件的：
session_id("5rdhbe4k8k73h5g1fsii01iau5");  通过传递session_id的方法来获取Session数据，从而避开Cookie的限制
session数据是在当前会话结束时（一般就是指脚本执行完毕时）才会写入文件的
在session数据使用完毕之后，调用session_commit或者session_write_close函数通知服务器写入session数据并关闭文件
unset($_SESSION)只是重置$_SESSION这个全局变量，并不会将session数据从服务器端删除。较为稳妥的做法是，在需要清除当前会话数据的时候调用session_destroy删除服务器端Session数据
unset($_SESSION);  
session_destroy();  
使用Cookie为载体的情况下，session.name指定存储session_id的Cookie的key( cookie中也是基于key=>value)。默认的情况下，session.name= PHPSESSID
session_name("NEW_SESSION");  
session_start();  
调用session_commit或者脚本执行完毕时，session数据写入文件，关闭打开的session文件句柄。如果session_id是以Cookie存储的，那么在服务器端的响应中，还应该发送Set-Cookie的HTTP头，通知客户端存储session_id，之后的每次请求都应该携带这个session_id.
“strlen函数返回给定字符串的长度”，但是，并没有对长度单位做任何说明，长度究竟是指”字符的个数“还是说”字符的字节数“。 说明strlen函数返回的是字符串的字节数
$s = file_get_contents("./word");
$a = array_count_values(str_word_count($s, 1)) ;

配合array_flip，可以计算某个单词最后一次出现的位置：

$t = array_flip(str_word_count($s, 2));
配合了array_unique之后再array_flip，则可以计算某个单词第一次出现的位置：

$t = array_flip( array_unique(str_word_count($s, 2)) );
一个二进制安全的函数，本质上是指它将输入看做是原始的数据流（raw）而不包含任何特殊的格式。 C字符串只合适保存简单的文本，而不能用于保存图片、视频、其他文件等二进制数据。而在PHP中，我们可以使用$str = file_get_contents(“filename”);保存图片、视频等二进制数据。
echo str_word_count(file_get_contents(“word”)); //112文本中的单词的个数

```
[nginx下file_get_contents导致cpu 100%的问题](http://blog.csdn.net/ohmygirl/article/details/18844987)
对搜索接口的调用，是直接通过file_get_contents(API)的方式获取的。由于file_get_contents是阻塞的I/O方式，且默认没有设置超时，因而如果搜索接口在长时间没有返回数据的情况下，会一直占用系统的资源，从而导致了nginx的502 bad gateway错误。张宴的博客中，对这一现象做了详细的解释和描述（地址：http://blog.s135.com/file_get_contents/）。在文中，作者给的解决方案是使用stream的timeout参数，使file_get_contents的socket连接强制超时，具体方案是：

$ctx = stream_context_create(array(  
		'http' => array(  
			'timeout' => 5 //设置一个超时时间，单位为s 
		)  
	)  
);  
使用更加强大的curl来完成相应的功能，并通过CURLOPT_TIMEOUT和CURLOPT_CONNECT_TIMEOUT限制搜索接口的连接时间和请求时间。且为了保证搜索的结果，会尝试3次连接，如果失败，则使用default的数据来填充。这样设置之后，基本上很少出现502 bad gateway的错误了。 进程异常时（如cpu占用较高），不要急于kill掉这个“现场”，不妨strace–p pid 追踪一下进程的系统调用
[PHP内核探索之变量（7）- 不平凡的字符串](http://blog.csdn.net/ohmygirl/article/details/44753655)
[ PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js
$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
```



[PHP递归实现无限级分类](http://www.helloweba.com/view-blog-204.html)
```js
function get_str($id = 0) { 
    global $str; 
    $sql = "select id,title from class where pid= $id";  
    $result = mysql_query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        $str .= '<ul>'; 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
            $str .= "<li>" . $row['id'] . "--" . $row['title'] . "</li>"; //构建字符串 
            get_str($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
        $str .= '</ul>'; 
    } 
    return $str; 
} 
function get_array($id=0){ 
    $sql = "select id,title from class where pid= $id"; 
    $result = mysql_query($sql);//查询子类 
    $arr = array(); 
    if($result && mysql_affected_rows()){//如果有子类 
        while($rows=mysql_fetch_assoc($result)){ //循环记录集 
            $rows['list'] = get_array($rows['id']); //调用函数，传入参数，继续查询下级 
            $arr[] = $rows; //组合数组 
        } 
        return $arr; 
    } 
} 

```

[纯js格式化货币：currencyFmatter.js](http://www.helloweba.com/view-blog-392.html)
OSREC.CurrencyFormatter.format(2534234, { currency: 'INR' }); // Returns ? 25,34,234.00
