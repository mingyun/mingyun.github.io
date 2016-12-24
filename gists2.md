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
