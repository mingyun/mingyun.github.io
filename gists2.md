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
```
