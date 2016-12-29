###数据库分组查询最大值的问题
```php
//https://segmentfault.com/a/1190000004157112
create table test (
    id smallint unsigned not null auto_increment,
    name varchar(20) not null,
    age smallint unsigned not null,
    class smallint unsigned not null,
    primary key (id));

insert into test (name, age, class) values
('wang', 11, 3), ('qiu', 22, 1), ('liu', 42, 1), ('qian', 20, 2),
('zheng', 20, 2), ('li', 33, 3);
mysql> select * from test;
+----+-------+-----+-------+
| id | name  | age | class |
+----+-------+-----+-------+
|  1 | wang  |  11 |     3 |
|  2 | qiu   |  22 |     1 |
|  3 | liu   |  42 |     1 |
|  4 | qian  |  20 |     2 |
|  5 | zheng |  20 |     2 |
|  6 | li    |  33 |     3 |
+----+-------+-----+-------+
选出每班中年龄最大者
select t1.*
from test t1,
  (select class, max(age) as age from test group by class) t2
where t1.class = t2.class and t1.age = t2.age;
+----+-------+-----+-------+
| id | name  | age | class |
+----+-------+-----+-------+
|  3 | liu   |  42 |     1 |
|  5 | zheng |  22 |     2 |
|  6 | li    |  33 |     3 |
+----+-------+-----+-------+
select t1.*
from test t1
join (
  select class, max(age) as age
  from test
  group by class) t2
on t1.class = t2.class and t1.age = t2.age;

select t1.*
from test t1
left join test t2 on t1.class = t2.class and t1.age < t2.age
where t2.class is null;
//http://ccxxxx.blog.51cto.com/7769075/1289758
create table tb(name varchar(10),val int,memo varchar(20)) 
insert into tb values('a', 2, 'a2(a的第二个值)') 
insert into tb values('a', 1, 'a1--a的第一个值') 
insert into tb values('a', 3, 'a3:a的第三个值') 
insert into tb values('b', 1, 'b1--b的第一个值') 
insert into tb values('b', 3, 'b3:b的第三个值') 
insert into tb values('b', 2, 'b2b2b2b2') 
insert into tb values('b', 4, 'b4b4') 
insert into tb values('b', 5, 'b5b5b5b5b5') 
select a.* from tb a where 1 > (select count(*) from tb where name = a.name and val > a.val ) order by a.name
select a.* from tb a where val = (select max(val) from tb where name = a.name) order by a.name
select a.* from tb a where not exists(select 1 from tb where name = a.name and val > a.val)
```
###redis php sort 
```php
//http://blog.51yip.com/cache/1441.html
$redis = new redis();  
$redis->connect('192.168.1.108', 6379);  
$redis->flushall();   
  
$redis->lpush('id', 1);  
$redis->set('name_1', 'tank');  
$redis->set('score_1',89);  
  
$redis->lpush('id', 2);  
$redis->set('name_2', 'zhang');  
$redis->set('score_2', 40);  
  
$redis->lpush('id', 4);  
$redis->set('name_4','ying');  
$redis->set('score_4', 70);  
  
$redis->lpush('id', 3);  
$redis->set('name_3', 'fXXK');  
$redis->set('score_3', 90);  
  
/** 
 * 按score从大到小排序,取得id 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => 3 [1] => 1 [2] => 4 [3] => 2 )   
  
/** 
 * 按score从大到小排序,取得name 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>'name_*'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => fXXK [1] => tank [2] => ying [3] => zhang )    
  
/** 
 * 按score从小到大排序,取得name，score 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>array('name_*','score_*')  
            );  
print_r($redis->sort('id',$sort));  
/** 
 *结果:Array 
        ( 
            [0] => fXXK 
            [1] => 90 
            [2] => tank 
            [3] => 89 
            [4] => ying 
            [5] => 70 
            [6] => zhang 
            [7] => 40 
        )) 
 */ 
```
###二维数组去重
```php
$arr = array(
        0 => array('u_id' => 1, 'time' => 1),
        1 => array('u_id' => 1, 'time' => 1),
        2 => array('u_id' => 2, 'time' => 4),
        3 => array('u_id' => 2, 'time' => 3)
    );
    function array_unique_new($array)
{
	foreach ($array as $k=>$v)
	{
		$v = join(",",$v);  //降维
		$temp[$k] = $v;
    }
	$temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v)
	{
        $array=explode(",",$v);		//再将拆开的数组重新组装
		    $temp2[$k]["u_id"] =$array[0];   
		    $temp2[$k]["time"] =$array[1];
	}
    return $temp2;
}
    print_r(array_unique_new($arr));
    
```
###php7 usort
```php
usort($list, function($a, $b) { return $a->weight <=> $b->weight; });
usort($list, function($a, $b) {
     return $a->weight < $b->weight ? -1 : ($a->weight == $b->weight ? 0 : 1);
 });
```
###获取域名ip
`gethostbyname ( 'www.example.com' );//93.184.216.34`
###filter_var
```php
$string = "<p>Example</p>";
$newstring = filter_var($string, FILTER_SANITIZE_STRING);
var_dump($newstring); // string(7) "Example"

var_dump(filter_var('joh n@example.com', FILTER_SANITIZE_EMAIL));#john@example.com

$options = array(
    'options' => array(
        'min_range' => 5,
        'max_range' => 10,
    )
);
var_dump(filter_var('5', FILTER_VALIDATE_INT, $options));
var_dump(filter_var('10', FILTER_VALIDATE_INT, $options));
var_dump(filter_var('javascript://comment%0Aalert(1)', FILTER_VALIDATE_URL));
// string(31) "javascript://comment%0Aalert(1)"
```
###array_map
```php
class StaticSquareHolder
{
    public static function square($number)
    {
        return $number * $number;
    }
}

$initial_array = [1, 2, 3, 4, 5];
$final_array = array_map(['StaticSquareHolder', 'square'], $initial_array);
// or:
$final_array = array_map('StaticSquareHolder::square', $initial_array);
```
###unicode
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
//http://stackoverflow.com/documentation/php/4472/unicode-support-in-php#t=201609060941458015713
 
var_dump(codepoint_encode("我好"));
var_dump(codepoint_decode('\u6211\u597d'));
var_dump('\u6211\u597d');
```
###通过key过滤
```php
$numbers = [16,3,5,8,1,4,6];

$even_indexed_numbers = array_filter($numbers, function($index) {
    return $index % 2 === 0;
}, ARRAY_FILTER_USE_KEY); 
print_r($even_indexed_numbers);//16,5,1,6
```
###php7继承时覆盖父函数需保持参数一致
```php
class a{
function test($str){
    return $str;
}
}
class b extends a {
    function test(){
       return __FUNCTION__;
}
}
echo (new b)->test();//Warning: Declaration of b::test() should be compatible with a::test($str) in /data/413421607 on line 104

php7.1的php.ini里 增加了session.sid_length的配置项，默认32，会导致原有程序每次请求刷新sessionId，保留不住。php7.1之前，php.ini里没有session.sid_length配置项，并且sessionid默认长度40。所以升级到php7.1以后为了兼容性需要把session.sid_length = 40
```
###array_reduce
```php
$result = array_reduce(["hello", "world", "PHP", "language"], function($carry, $item){
        return !$carry ? $item : $carry . "-" . $item ;
});//result:"hello-world-PHP-language"
```
###mysql case when
```php
SELECT  st.name,
        st.percentage, 
        CASE WHEN st.percentage >= 35 THEN 'Pass' ELSE 'Fail' END AS `Remark` 
    FROM student AS st ;
SELECT  st.name,
        st.percentage, 
        IF(st.percentage >= 35, 'Pass', 'Fail') AS `Remark` 
    FROM student AS st ;
```
###limit分页，自己在最上面
```php
//$lastId为上次分页最大的主键id，$selfJoinId为登录用户的主键id,$limit为分页数
if(empty($lastId)){
        $selfInfo = user_joins::where('id', $selfJoinId)->first();
        if(is_null($selfInfo)){
                $selfInfo=[];
        }
        $res = user_joins::where('id', '!=', $selfJoinId)->take($limit)->get()->toArray();
        }else{
                $res = user_joins::where('id', '>', $lastId)->where('id', '!=', $selfJoinId)->take($limit)->get()->toArray();
        }

        if (!$res && !$selfInfo) {
                return [];
        }
        if($selfInfo){
                array_unshift($res, $selfInfo);
        }
}
```
###laravel 批量获取redis
```php
$info = Cache::increment("info:{$id}");//统计数据
$laravelPrefix = config('cache.prefix');//默认为laravel
if(is_array($Ids)){
    $keys = array_map(function($id) use ($laravelPrefix){
        return "$laravelPrefix:info:{$id}";
    },$Ids);
}

$countArr = \Redis::mget($keys);//[100,null,]
$ret = [];
    foreach ($countArr as $i=>&$v) {
        if(is_null($v)){
            $v = table::find($Ids[$i]);
        }
        $ret[$Ids[$i]] = $v;//补充为null的key
    }
    
    public static function mget($ids)
    {
        if(empty($ids)){
            return [];
        }
        
        $keys = array_map(function($id) {
            return $id . ':info';
        }, $ids);

        $caches = Redis::mget($keys);

        $result = array_combine($ids, $caches);

        if ($needIds = array_keys($result, null, true)) {
            $result = self::sync($needIds) + $result;
        }

        return $result;
    }
```
###二进制表示属性
```php
//问题 置顶1 提问2 关心4 已答8
$question['attribute'] = 0;
if($question['top']){
$question['attribute']  += 1; // 置顶
}

if($question['user_id'] == $userId){
$question['attribute']  += 2; // 提问
}

if(isset($myCaredHash[$question['id']])){
$question['attribute']  += 4; // 关心
}

if(isset($myAnsweredHash[$question['id']])){
$question['attribute']  += 8; // 已答
}
```
###按指定id顺序排序
```php
$infos = User::whereIn('id', $list)
    ->select('id', 'avatar', 'nick_name')
    ->orderBy(\DB::raw("find_in_set(id,'".implode(',',$list)."')"))
    ->get()
    ->toArray();
$list = array_column($infos, 'id');
$userInfos = array_combine($list, $infos);//每个id对应一个数组
// $userInfos = array_column($infos,null, 'id');
```
###pv每7个更新
```php
$pv = Redis::incr('view:'.$id);
$list= table::find($id);
if ($pv % 7 === 0) {
    // table::where('id', $id)->increment('pv', 7);
    table::where('id', $id)->update(['pv' => $pv]);
} else if ($pv == 1) {
    // 首次缓存同步数据
    $pv = $list['pv'] + 1;
    Redis::set('view'.$id, $pv);
}
```
###设置缓存
```php
if (!($lives = Cache::get($cacheKey))) {
        $lives = table::where(['status' => 1])->select('id', 'user_id')->limit(30)->get()->toArray();
        Cache::put($cacheKey, $lives, count($lives) >= 10 ? 5 : 1);
}
```
###统计总费用和type为5的费用
```php
$money = Orders::where(['status' => 1])->select(
                \DB::raw('SUM(`fee`) AS `income`, SUM(IF(`type`=5, `fee`, 0)) AS `reward`')
            )->first();
```
###英文算1个字符，中文算2个
```php
echo mb_strwidth('abc中文字符统计', 'utf-8');//15
```
###新粉丝数
```php
$knowIds = [];
$preKnow = 0;

$followList = $redis->hKeys('user:follows:list:' . $userId);
$knowIds = array_diff($followList, [$userId]);//过滤自己
$preKnow = $redis->get('app:preknow:'. $userId);//每次获取粉丝列表更新为count($knowids)

$res = count($knowIds) - $preKnow;
```
###获取网页所有url
`$x('//a').map(function(i){return i.href;})`
###数组排序
```php
var arr = ["bananas", "cranberries", "apples"];
arr.sort(function(a, b) {
    return a.localeCompare(b);
});
["apples", "bananas", "cranberries"]
```
###重复字符串
`new Array(2 + 1).join('abc');  // Returns "abcabcabc"`
###数组去重
```php
function onlyUnique(value, index, self) { 
  return self.indexOf(value) === index;
}
var array = ['a', 1, 'a', 2, '1', 1];
var uniqueArray = array.filter(onlyUnique); // returns ['a', 1, 2, '1']
var uniqueArray = [... new Set(array)];
```
###先偶数后奇数排序
```php
[10, 21, 4, 15, 7, 99, 0, 12].sort(function(a, b) {
    return (a & 1) - (b & 1) || a - b;
});
//[0, 4, 10, 12, 7, 15, 21, 99] 
```
###数组最小值
```php
var arr = [4, 2, 1, -10, 9]

arr.reduce(function(a, b) {
  return a < b ? a : b
}, Infinity);//-10
```
###dom each
```php
var domList = document.querySelectorAll('#myDropdown option');

domList.forEach(function () { 

}); // Error! forEach is not defined.

Array.prototype.forEach.call(domList, function () { 

}); // Wow! this works
```
###数组统计
```php
$fees = [[
            "user_id" => "1",
            "fee" => "100"
          ],
           [
            "user_id" => "2",
            "fee" => "88"
          ],
           [
            "user_id" => "3",
            "fee" => "8888"
          ]];

      $spans =[
            '1000以下' => [0, 1000],
            '1000-1万' => [1000, 10000],
            '1万-10万' => [10000, 100000],
            '10万-20万' => [100000, 200000],
            '20万-50万' => [200000, 500000],
            '50万-100万' => [500000, 1000000],
            '100万以上' => [1000000, '~']
        ];
        $figureData = [];
        foreach ($spans as $name => $spanItem){
            $figureData[$name] = 0;
        }
        foreach ($fees as $row){
            foreach ($spans as $name => $span) {
                $leftBound = $span[0];
                $rightBound = $span[1];
                if($row['fee'] > $leftBound && ($row['fee']<= $rightBound || $rightBound == '~')){
                    if(isset($figureData[$name])){
                        $figureData[$name]+=1;
                    }else{
                        $figureData[$name] = 0;
                    }
                }

            }
        }
print_r($figureData);
Array
(
    [1000以下] => 2
    [1000-1万] => 1
    [1万-10万] => 0
    [10万-20万] => 0
    [20万-50万] => 0
    [50万-100万] => 0
    [100万以上] => 0
)
```
###微信红包
```php
function split_money($money, $count) {
  $money *= 100;
  $list = array(0);
  for ($i = 1; $i < $count; ++$i) {
    while(in_array($r = mt_rand(1, $money), $list));
    $list[] = $r;
  }
  sort($list);
  $list[] = $money;
  $packs = array();
  for ($i = 0; $i < $count; ++$i)
    $packs[] = ($list[$i + 1] - $list[$i]) / 100;
  return $packs;
}
$packs = split_money(100, 10);
[
    20.76,
    12.72,
    7.57,
    6.59,
    1.24,
    0.31,
    9.67,
    28.62,
    6.92,
    5.6
]
//https://www.zhihu.com/question/22625187/answer/50556558
def weixin_divide_hongbao(money, n):
    divide_table = [random.randint(1, 10000) for x in xrange(0, n)]
    sum_ = sum(divide_table)
    return [x*money/sum_ for x in divide_table]
function red_rand($amount, $num)
{
$amount = intval($amount * 100);
if($num > $amount){
exit('err');
}

$reds = array();
while(--$num){
$r = rand(1, $amount);
$r = fix_rand($r, $reds, $amount);
$reds[] = $r;
}
asort($reds);
$arr = array();
$last = 0;
foreach($reds as $v){
$arr[] = ($v - $last) / 100;
$last = $v;
}
$arr[] = ($amount - $last) / 100;
return $arr;
}


function fix_rand($r, $reds, $max){
if(in_array($r, $reds) || $r == $max){
$r1 = $r;
while(--$r1){
if( ! in_array($r1, $reds)){
return $r1;
break;
}
}

while(true){
++$r;
if( ! in_array($r, $reds)){
return $r;
break;
}
}
}
return $r;
}

```
###You can't specify target table 'wms_cabinet_form' for update in FROM clause
```php
更新user_id为36215 sche_time最大的那条记录的end_time为当前时间

//http://www.cnblogs.com/chy1000/archive/2010/03/02/1676282.html
mysql> update user set end_time =now() where user_id = 36215 and sche_time =(select max(sche_time) from user where user_id = 36215);
ERROR 1093 (HY000): You can't specify target table 'user' for update in
 FROM clause
mysql> select max(sche_time) from user where user_id = 36215;
+---------------------+
| max(sche_time)      |
+---------------------+
| 2014-10-16 12:30:00 |
+---------------------+
1 row in set, 1 warning (0.10 sec)
重点在select max(a.sche_time) from (select * from user b) a ，我 select * from user b 作为子集
然后再select max(a.sche_time) 子集，这样就不会 select 和 update 都是同一个表。致此问题得到完美解决。
mysql> update user set end_time =now() where user_id = 36215 and sche_time =(select max(a.sche_time) from (select * from user b) a where a.user_id = 36215);
Query OK, 1 row affected (0.40 sec)
```
###MySQL表字段长度的限制
```php
//http://www.cnblogs.com/zhoujinyi/p/3178558.html
CREATE TABLE tb_test (
    -> recordid varchar(32) NOT NULL,
    -> areaShow varchar(10000) DEFAULT NULL,
    -> areaShow1 varchar(10000) DEFAULT NULL,
    -> areaShow2 varchar(10000) DEFAULT NULL,
    -> PRIMARY KEY (recordid)
    -> ) ENGINE=INNODB DEFAULT CHARSET=utf8;
ERROR 1118 (42000): Row size too large. The maximum row size for the used table type, not counting BLOBs, is 65535. You have to change some columns to TEXT or BLOBs
报错
CREATE TABLE tb_test (
    -> recordid varchar(32) NOT NULL,
    -> areaShow varchar(30000) DEFAULT NULL,
    -> areaShow1 varchar(30000) DEFAULT NULL,
    -> areaShow2 varchar(30000) DEFAULT NULL,
    -> PRIMARY KEY (recordid)
    -> ) ENGINE=INNODB DEFAULT CHARSET=utf8;
Query OK, 0 rows affected, 3 warnings (0.26 sec)
可以建立，只是类型被转换了。
show warnings;
+-------+------+----------------------------------------------------+
| Level | Code | Message                                            |
+-------+------+----------------------------------------------------+
| Note  | 1246 | Converting column 'areaShow' from VARCHAR to TEXT  |
| Note  | 1246 | Converting column 'areaShow1' from VARCHAR to TEXT |
| Note  | 1246 | Converting column 'areaShow2' from VARCHAR to TEXT |
+-------+------+----------------------------------------------------+
3 rows in set (0.00 sec)
（1）单个字段如果大于65535，则转换为TEXT 。

（2）单行最大限制为65535，这里不包括TEXT、BLOB。

按照上面总结的限制，来解释出现的现象：

第一个情况是：
单个字段长度：varchar(10000) ，字节数：10000*3(utf8)+（1 or 2) = 30000 ，小于65535，可以建立。
单行记录长度：varchar(10000)*3，字节数：30000*3(utf8)+（1 or 2) = 90000，大于65535，不能建立，所以报错：

ERROR 1118 (42000): Row size too large. The maximum row size for the used table type, not counting BLOBs, is 65535. You have to change some columns to TEXT or BLOBs
第二个情况是：
单个字段长度：varchar(30000) ，字节数：30000*3+（1 or 2) = 90000 ， 大于65535，需要转换成TEXT，才可以建立。所以报warnings。
单行记录长度：varchar(30000)*3，因为每个字段都被转换成了TEXT，而TEXT没有限制，所以可以建立表。
https://laravel-china.org/topics/3421  虽然有65535这个限制，但是 TEXT 和 BLOBs 这2种类型的字段是不被计算在内的
```
###[javascript坑](https://zhuanlan.zhihu.com/p/24524394)
```php
0.1 + 0.2 = 0.30000000000000004
Math.round( (.1+.2)*100)/100;

3.tostring;
3..toString;
3...toString;
var a = [0];
//[0]这个玩意儿在单独使用的时候是被认为是true的，但用作比较的时候它是false…所以正确答案是false
if ([0]) {
  console.log(a == true);
} else {
  console.log("wut");
}
```
###[网页自动刷新工具browsersync](https://zhuanlan.zhihu.com/p/24462674)
```php
npm install browser-sync gulp --save-dev
var gulp = require('gulp');
var less = require('gulp-less');
var plumber = require('gulp-plumber');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;

var paths = {
	less: ['./less/*.less']
};
gulp.task('less', function () {
	return gulp.src('./less/style.less')
	.pipe(plumber())
	.pipe(less())
	.pipe(gulp.dest('./css'))
	.pipe(reload({stream: true}));
});

// 静态服务器
gulp.task('watch', function() {
    browserSync.init({
        server: {
            baseDir: "./",
	    proxy: "localhost"
        }
    });
    gulp.watch(paths.less, ['less']);
});
```
###[适配所有移动端网页](https://zhuanlan.zhihu.com/p/24443208)
`<meta name="viewport" content="width=device-width,initial-scale=1,
minimum-scale=1,maximum-scale=1,user-scalable=no" />`
###[自定义laravel log日志目录](https://laravel-china.org/topics/3457)
```php
Log::useFiles(string $path, string $level = 'debug')
$log = new Logger('xxxx');
$logDir = storage_path('logs/xxxx');
 if (!is_dir($logDir)) {
      mkdir($logDir, 0777, true);
}
$log->pushHandler(new StreamHandler($logDir . '/' . date('Y-m-d') . '.log', Logger::DEBUG))
```
###修改laravel默认加密方式为md5
```php
mkdir providers/Hashing
vi Md5ServiceProvider.php

namespace App\Providers\Hashing;
use Illuminate\Support\ServiceProvider;
class Md5ServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton('hash', function () { return new Md5Hasher(); });
    }
}
vi Md5Hasher.php

namespace App\Providers\Hashing;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Md5Hasher implements HasherContract
{
    public function make($value, array $options = array())
    {
        $md5 = md5($value);

        return $md5;
    }

    public function check($value, $hashedValue, array $options = array())
    {
        return md5($value) === $hashedValue ? true : false;
    }

    public function needsRehash($hashedValue, array $options = array())
    {
        return false;
    }
}

vi config/app.php

'App\Providers\Hashing\Md5ServiceProvider', 替代'Illuminate\Hashing\HashServiceProvider',
```
###无限极分类
```php
$array = [
     1 => [ 'k' => 0 ],
     2 => [ 'k' => 1 ],
     3 => [ 'k' => 1 ],
     4 => [ 'k' => 2 ],
     5 => [ 'k' => 4 ],
     6 => [ 'k' => 3 ],
     7 => [ 'k' => 0 ],
     8 => [ 'k' => 6 ]
];


$tree  = [];
$refer = $array;

foreach($array as $key => $val) {
    if (isset($refer[$val['k']])) {
        $refer[$val['k']]['children'][$key] = &$refer[$key];
    } else {
        $tree[$key] = &$refer[$key];
    }
}

print_r($tree);
 [
     1 => [
         "k"        => 0,
         "children" => [
             2 => [
                 "k"        => 1,
                 "children" => [
                     4 => Array(2)
                 ]
             ],
             3 => [
                 "k"        => 1,
                 "children" => [
                     6 => Array(2)
                 ]
             ]
         ]
     ],
     7 => [
         "k" => 0
     ]
 ]
```
###每输入5个字符,自动加入-
```php
'input里面可以输入或者粘贴文本aaaBBB2222'.replace(/[^\d|^a-z|^A-Z]/g, '').replace(/(.{5,5})/g, '$1-')
'1234567890abcd'.replace(/\w(?=(\w{5})+$)/g, "$&-");//"1234-56789-0abcd"
"1234567890abcDEFg".replace(/([^_\W]{5})/g,"$1-")
//"12345-67890-abcDE-Fg"
```
###按name分组取val最大的值所在行的数据
```php
//http://www.jb51.net/article/31590.htm
create table tb(name varchar(10),val int,memo varchar(20)); 
insert into tb values('a', 2, 'a2(a的第二个值)') ;
insert into tb values('a', 1, 'a1--a的第一个值') ;
insert into tb values('a', 3, 'a3:a的第三个值') ;
insert into tb values('b', 1, 'b1--b的第一个值') ;
insert into tb values('b', 3, 'b3:b的第三个值') ;
insert into tb values('b', 2, 'b2b2b2b2') ;
insert into tb values('b', 4, 'b4b4') ;
insert into tb values('b', 5, 'b5b5b5b5b5') ;
--方法1：select a.* from tb a where val = (select max(val) from tb where name = a.name) order by a.name 
--方法2： 
select a.* from tb a where not exists(select 1 from tb where name = a.name and val > a.val) 
--方法3： 
select a.* from tb a,(select name,max(val) val from tb group by name) b where a.name = b.name and a.val = b.val order by a.name 
--方法4： 
select a.* from tb a inner join (select name , max(val) val from tb group by name) b on a.name = b.name and a.val = b.val order by a.name 
--方法5 
select a.* from tb a where 1 > (select count(*) from tb where name = a.name and val > a.val ) order by a.name 
/* 
name val memo 
---------- ----------- -------------------- 
a 3 a3:a的第三个值 
b 5 b5b5b5b5b5 

*/ 
更新val大于4的memo为val等于4的记录
mysql> update tb set memo=(select memo from (select *from tb) a where a.val=4) where val>4;
按name分组取最小的两个(N个)val 
select a.* from tb a where exists (select count(*) from tb where name = a.name and val < a.val having Count(*) < 2) order by a.name 
/* 
name val memo 
---------- ----------- -------------------- 
a 1 a1--a的第一个值 
a 2 a2(a的第二个值) 
b 1 b1--b的第一个值 
b 2 b2b2b2b2 

*/ 
取出每个分类中最新的内容
select * from test group by category_id order by `date`
正确
select * from (select * from `test` order by `date` desc) `temp`  group by category_id order by `date` desc
```
###laravel5.0 空对象无where条件更新全表
```php
$ad=Ad::findornew(0);
dump($ad);
array:21 [▼
  "\x00*\x00table" => "ads"
  "\x00*\x00fillable" => array:12 [▶]
  "\x00*\x00guarded" => array:1 [▶]
  "\x00*\x00connection" => null
  "\x00*\x00primaryKey" => "id"
  "\x00*\x00perPage" => 15
  "incrementing" => true
  "timestamps" => true
  "\x00*\x00attributes" => array:14 [▶]
  "\x00*\x00original" => array:14 [▶]
  "\x00*\x00relations" => []
  "\x00*\x00hidden" => []
  "\x00*\x00visible" => []
  "\x00*\x00appends" => []
  "\x00*\x00dates" => []
  "\x00*\x00casts" => []
  "\x00*\x00touches" => []
  "\x00*\x00observables" => []
  "\x00*\x00with" => []
  "\x00*\x00morphClass" => null
  "exists" => false
]
Ad::findornew(1);//exists为true
dd(count((array)$ad));22
$ad->update(['nick_name'=>'空对象会更新表所有数据']);
```
###[交换行和列](http://www.pythondoc.com/pythontutorial3/datastructures.html)
```php
>>> matrix = [
...     [1, 2, 3, 4],
...     [5, 6, 7, 8],
...     [9, 10, 11, 12],
... ]
>>> [[row[i] for row in matrix] for i in range(4)]
[[1, 5, 9], [2, 6, 10], [3, 7, 11], [4, 8, 12]]
>>> transposed = []
>>> for i in range(4):
...     transposed.append([row[i] for row in matrix])
...
>>> transposed
[[1, 5, 9], [2, 6, 10], [3, 7, 11], [4, 8, 12]]
>>> list(zip(*matrix))
[(1, 5, 9), (2, 6, 10), (3, 7, 11), (4, 8, 12)]
>>> vec = [[1,2,3], [4,5,6], [7,8,9]]
>>> [num for elem in vec for num in elem]
[1, 2, 3, 4, 5, 6, 7, 8, 9]
>>> a = set('abracadabra')
>>> b = set('alacazam')
>>> a                                  # unique letters in a
{'a', 'r', 'b', 'c', 'd'}
>>> a - b                              # letters in a but not in b
{'r', 'd', 'b'}
>>> a | b                              # letters in either a or b
{'a', 'c', 'r', 'd', 'b', 'm', 'z', 'l'}
>>> a & b                              # letters in both a and b
{'a', 'c'}
>>> a ^ b                              # letters in a or b but not both
{'r', 'd', 'b', 'm', 'z', 'l'}
>>> dict(sape=4139, guido=4127, jack=4098)
{'sape': 4139, 'jack': 4098, 'guido': 4127}
```
###浮点数
```php
>>> import glob
>>> glob.glob('*.py')
['primes.py', 'random.py', 'quote.py']
>>> from array import array
>>> a = array('H', [4000, 10, 700, 22222])
>>> sum(a)
26932
>>> a[1:3]
array('H', [10, 700])
>>> from decimal import *
>>> round(Decimal('0.70') * Decimal('1.05'), 2)
Decimal('0.74')
>>> round(.70 * 1.05, 2)
0.73
>>> Decimal('1.00') % Decimal('.10')
Decimal('0.00')
>>> 1.00 % 0.10
0.09999999999999995

>>> sum([Decimal('0.1')]*10) == Decimal('1.0')
True
>>> sum([0.1]*10) == 1.0
False
```
###[排序算法](http://www.cnblogs.com/siqi/archive/2012/09/01/2667145.html)
```php
$arr = array(3,2,1);
//外层每循环一次则找出一个最大值，放到后面，所以里层的循环就可以减少一次
function bubble_sort(&$arr)
{
   $flag = false;

   $nums = count($arr)-1;//外层循环次数$temp = 0;//变量交换位置
   for($i=0;$i<$nums;$i++)
    {
        //每排好一个，以后就可以少循环一回
        for($j=0;$j<$nums-$i;$j++)
        {
            if($arr[$j]>$arr[$j+1])
            {
                //交换位置
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;

                $flag = true;//以次来判断是否进入过次层，如果没有进入过，说明本来就是个有序的，无需进行排序了

            }
        }

        if(!$flag){
            //已经排好了
            break;
        }else{
            $flag = false;
        }

    }
}

bubble_sort($arr);

print_r($arr);

$arr = array(1,2,3);
/**
 * 取一个数依次和后面的做比较，记录本次的最小值，然后交换位置
 * 
 */
function select_sort(&$arr)
{
    $nums = count($arr)-1;//外层循环次数
    $temp = 0;//交换变量用的临时变量
    for($i=0;$i<$nums;$i++)
    {
        $minValue = $arr[$i];//假设$i就是最小数
        $minIndex = $i;     //记录我认为的最小数的下标
        //每排好一个，以后就可以少循环一回
        for($j=$i+1;$j<$nums;$j++)
        {
            if($minValue>$arr[$j])
            {
                $minIndex = $j;
                $minValue = $arr[$j];
            }
        }
        
        //交换位置
        $temp = $arr[$i];
        $arr[$i] = $arr[$minIndex];
        $arr[$minIndex] = $temp;
    }
}

select_sort($arr);
$arr = array(3,2,1);
//把数组的前半部分看做是有序的，后面的不断的往前面插入
function insert_sort(&$arr)
{
    //先默认下标为0 这个数已经是有序
    for($i=1;$i<count($arr);$i++)
    {
        //$insertValue 是准备插入的数
        $insertValue = $arr[$i];
        //先准备和$insertIndex比较
        $inserIndex = $i-1;
        
        //如果满足这个条件，说明我们没有找到合适的位置、
        
        while($inserIndex>=0 && $insertValue<$arr[$inserIndex])
        {
            //同时把数相应往后面移动
            $arr[$inserIndex+1] = $arr[$inserIndex];
            $inserIndex--;
        }
        
        //插入（这时就给$insertValue找到适当的位置）
        $arr[$inserIndex+1] = $insertValue;//之所以+1 是因为 $inserIndex 是插入的前一个数，即每次和他比较的那个数
    }
}

insert_sort($arr);
/**
 * 随便取一个数，每循环一次则把比他小的放到左边，比他大的放到右边，递归完成
 * @param array $seq

 * @return array
 */
function quicksort($seq) {
    if (count($seq) > 1) {
        $k = $seq[0];
        $x = array();
        $y = array();
        $_size = count($seq);      //do not use count($seq) in loop for.
        for ($i=1; $i<$_size; $i++) {
            if ($seq[$i] <= $k) {
                $x[] = $seq[$i];
            } else {
                $y[] = $seq[$i];
            }
        }
        $x = quicksort($x);
        $y = quicksort($y);
        return array_merge($x, array($k), $y);
    } else {
        return $seq;
    }
}
```
###[curl 同时发送多个请求](http://www.cnblogs.com/siqi/p/4419320.html)
```php
// 创建一对cURL资源
$ch1 = curl_init();
$ch2 = curl_init();

// 设置URL和相应的选项
curl_setopt($ch1, CURLOPT_URL, "http://test.cm/a.php/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt($ch2, CURLOPT_URL, "http://testd.cm/b.php");

curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt ( $ch2, CURLOPT_RETURNTRANSFER, 1 );

// 创建批处理cURL句柄
$mh = curl_multi_init();

// 增加2个句柄
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);

$running=null;
// 执行批处理句柄
do {
    //处理所有的请求，知道全部执行完毕
    curl_multi_exec($mh,$running);
} while($running > 0);

//根据句柄获取每个请求对应的返回的内容
$a = curl_multi_getcontent($ch1);
ee($a);
ee(curl_error($ch1)); //单个请求出错，不会影响到其他请求

$b = curl_multi_getcontent($ch2);
ee($b);

// 关闭全部句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);

// 创建一对cURL资源
$ch1 = curl_init();
$ch2 = curl_init();

// 设置URL和相应的选项
curl_setopt($ch1, CURLOPT_URL, "http://test.cm/a.php/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt($ch2, CURLOPT_URL, "http://test.cm/b.php");

curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt ( $ch2, CURLOPT_RETURNTRANSFER, 1 );

// 创建批处理cURL句柄
$mh = curl_multi_init();

// 增加2个句柄
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);

$running=null;
$msgs_in_queue = null;
// 执行批处理句柄
do {
    //处理所有的请求，知道全部执行完毕 , 循环执行
    $status = curl_multi_exec($mh,$running);
     $info = curl_multi_info_read($mh, $msgs_in_queue);
    if (false !== $info)
     {
          eee($msgs_in_queue);
        eee($info); //如果不为空则说明有返回结果
        eee(curl_multi_getcontent($info['handle']));
    }
    
} while($status === CURLM_CALL_MULTI_PERFORM  || $running > 0);

// 关闭全部句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);
```
###二维数组排序
```php
function multi_compare($a, $b)
{
    $val_arr = array(
            'gold'=>'asc',
            'silver'=>'desc'//还可以增加额外的排序条件
    );
    foreach($val_arr as $key => $val){
        if($a[$key] == $b[$key]){
            continue;
        }
        return (($val == 'desc')?-1:1) * (($a[$key] < $b[$key]) ? -1 : 1);
    }
    return 0;
}

$arr = array(
    array('gold'=>1, 'silver'=>2),
    array('gold'=>8, 'silver'=>10),
    array('gold'=>8, 'silver'=>8),
    array('gold'=>2, 'silver'=>1),
);

uasort($arr, 'multi_compare');
```
###php || &&
```php
$a = 3;
$b = 5;

var_dump(5 || $b = 7);//boolean(true)

if($a = 5 || $b = 7) { //|| 的优先级比赋值预算的要高    
    var_dump($a); //boolean(true)
    $a++;
    $b++;
}
echo $a . " " . $b;//1 6
 if($a = 100 && $b = 200) {
    var_dump($a,$b);//bool(true) int(200)
}
    $int  = 2;
    $bool = true;

    
    $a= 1 + 'test'. ($int + $bool);
    $b= 'test' . ($int + $bool) + 1;
    var_dump($a, $b);//string(2) "13" int(1)
//如果 var 不是数组类型或者实现了 Countable 接口的对象，将返回 1，有一个例外，如果 var 是 NULL 则结果是 0。 
echo  count ("567");//1
echo count(null);    //0
echo count(false);  //1
//注意这种操作引起的错误
$a = null;
var_dump($a['abc']);//null 
echo -10%3; //-1
```
###[浮点数](http://www.cnblogs.com/siqi/archive/2012/12/02/2798058.html)
```php
/**
 * 浮点数一般是不能用来比较大小的，但是我们可以用一种变通的的方式
 * 用var_dump输出浮点是看不出效果的,可以用serialize查看
 * 1.round  2.浮点转换成字符串
 * 
 * 转换成字符串方法：
 * 通过在其前面加上(string)或用strval()函数来转变成 字符串
 * 在一个需要字符串的表达式中，字符串会自动转变，比如在使用函数 echo() 或 print() 时， 或在一个变量和一个 字符串 进行比较时，就会发生这种转变
 * true会转为1 ， 而false则会转为空字符串
 * 
 */

$a = 13.2;
$b = 24;
$c = $a/$b;

//实际值是这个d:0.54999999999999993338661852249060757458209991455078125;
echo serialize($c).'<br/>';//

echo  $c.'<br/>';//输出时会显示成0.55 实际的值是比他小的

//所以直接和0.55比较大小是不成立的http://www.cnblogs.com/siqi/archive/2012/12/02/2798058.html
if($c == 0.55){
    echo 'nothing';
}

$c = round($c,2);

//用round处理
if($c == 0.55){
    echo 'ok';
}

//强制转为字符串
// $c = (string)$c;
// $c = strval($c);

if("$c" == 0.55){
    echo 'ok';
}

```
###多维数组转一维
```php
//静态变量是只存在于函数作用域中的变量，注释：执行后这种变量不会丢失（下次调用这个函数时，变量仍会记着原来的值）

function array_multi2single($array){

    static $result_array=array();

    foreach($array as $value){

        if(is_array($value)){

            array_multi2single($value);

        }

        else

        $result_array[]=$value;

    }

    return $result_array;

}



$array=array("1"=>array("A","B","C",array("D","E")),"2"=>array("F","G","H","I"));

$array=array_multi2single($array);

 
 //采用数组引用来实现，这样比上一种要好哦
function array_multi2single($array,&$rs = array()){
    foreach($array as $value){
        if(is_array($value)){
            array_multi2single($value, $rs);
        }
        else
        $rs[]=$value;
    }
}

$array=array("1"=>array("A","B","C",array("D","E")),"2"=>array("F","G","H","I"));
array_multi2single($array, $rs);

print_r($rs);
```
###[树形数组](http://www.cnblogs.com/siqi/archive/2012/10/11/2719245.html)
```php
 /**
 * 创建父节点树形数组
 * 参数
 * $ar 数组，邻接列表方式组织的数据
 * $id 数组中作为主键的下标或关联键名
 * $pid 数组中作为父键的下标或关联键名
 * 返回 多维数组
 * 
 * 分析：
 * 由于传递是引用，故当赋值给他后，当这个值在变时，上面的值也会跟着一块变
 * 后面的循环不断的给他添加值 第一个元素也会不断的添加值
 * 最终所有的树行结构都会放到数组的第一个元素中
 * 而下面的元素依次保存当次级别以下的孩子
 * 
 **/
function find_parent($ar, $id='id', $pid='pid') {
  foreach($ar as $v) $t[$v[$id]] = $v;
  foreach ($t as $k => $item){
    if( $item[$pid] ){
      if( ! isset($t[$item[$pid]]['parent'][$item[$pid]]) )
         $t[$item[$id]]['parent'][$item[$pid]] =& $t[$item[$pid]];
    }
  }
  return $t;
}


/**
 * 创建子节点树形数组
 * 参数http://www.cnblogs.com/siqi/archive/2012/10/11/2719245.html
 * $ar 数组，邻接列表方式组织的数据
 * $id 数组中作为主键的下标或关联键名
 * $pid 数组中作为父键的下标或关联键名
 * 返回 多维数组
 **/
function find_child($ar, $id='id', $pid='pid') {
  foreach($ar as $v) $t[$v[$id]] = $v;
  foreach ($t as $k => $item){
    if( $item[$pid]) {
      $t[$item[$pid]]['child'][$item[$id]] = & $t[$k];
    }
  }
  return $t;
}

    $data = array(
      array('ID'=>1, 'PARENT'=>0, 'NAME'=>'祖父'),
      array('ID'=>2, 'PARENT'=>1, 'NAME'=>'父亲'),
      array('ID'=>3, 'PARENT'=>1, 'NAME'=>'叔伯'),
      array('ID'=>4, 'PARENT'=>2, 'NAME'=>'自己'),
      array('ID'=>5, 'PARENT'=>4, 'NAME'=>'儿子'),
    );

   $p = find_parent($data, 'ID', 'PARENT');
   Array
(
    [1] => Array
        (
            [ID] => 1
            [PARENT] => 0
            [NAME] => 祖父
        )

    [2] => Array
        (
            [ID] => 2
            [PARENT] => 1
            [NAME] => 父亲
            [parent] => Array
                (
                    [1] => Array
                        (
                            [ID] => 1
                            [PARENT] => 0
                            [NAME] => 祖父
                        )

                )

        )

    [3] => Array
        (
            [ID] => 3
            [PARENT] => 1
            [NAME] => 叔伯
            [parent] => Array
                (
                    [1] => Array
                        (
                            [ID] => 1
                            [PARENT] => 0
                            [NAME] => 祖父
                        )

                )

        )

    [4] => Array
        (
            [ID] => 4
            [PARENT] => 2
            [NAME] => 自己
            [parent] => Array
                (
                    [2] => Array
                        (
                            [ID] => 2
                            [PARENT] => 1
                            [NAME] => 父亲
                            [parent] => Array
                                (
                                    [1] => Array
                                        (
                                            [ID] => 1
                                            [PARENT] => 0
                                            [NAME] => 祖父
                                        )

                                )

                        )

                )

        )

    [5] => Array
        (
            [ID] => 5
            [PARENT] => 4
            [NAME] => 儿子
            [parent] => Array
                (
                    [4] => Array
                        (
                            [ID] => 4
                            [PARENT] => 2
                            [NAME] => 自己
                            [parent] => Array
                                (
                                    [2] => Array
                                        (
                                            [ID] => 2
                                            [PARENT] => 1
                                            [NAME] => 父亲
                                            [parent] => Array
                                                (
                                                    [1] => Array
                                                        (
                                                            [ID] => 1
                                                            [PARENT] => 0
                                                            [NAME] => 祖父
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

)

   $c = find_child($data, 'ID', 'PARENT');
```
