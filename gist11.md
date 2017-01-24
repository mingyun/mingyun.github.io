###[python指定utf-8编码](https://segmentfault.com/q/1010000008093604)
https://www.python.org/dev/peps/pep-0263/
只要符合下面这个正则即可：

^[ \t\v]*#.*?coding[:=][ \t]*([-_.a-zA-Z0-9]+)
###[shell调试](https://segmentfault.com/q/1010000008183336)
set -xv
ls -rlt 'file_name_not_exits.txt'
echo "$?" && if [ "$?" == "1" ]; then echo "错误存在" fi
###[ajax fetch](https://segmentfault.com/q/1010000008185107)
```js
fetch('http://hq.sinajs.cn/list=s_sz399001', {
    method: 'GET',
    headers: {
      'Accept': 'application/json, text/javascript, */*; q=0.01',
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    },
    mode: 'cors',
    credentials: 'credentials',
    cache: 'default'
  })
  .then((resp) => {
    return resp.text();
  })
  .then((str) => {
    console.log(str);
    console.log(str.match(/\=\"(.*?)\"/)[1])
  })
  .catch((err) => {
    console.error(err);
  });
  function getStr(str) {
  eval(str.replace(/var (.*?)( ?)=/, function(a, b, c) {
    return 'var aa' + c + '=';
  }))
  return aa;
}

console.log(getStr(`var hq_str_s_sz399001="深证成指,9906.14,137.565,1.41,126388534,18146230";`))
```
###[下载excel文件](https://segmentfault.com/q/1010000008182958)
```js
function fake_click(obj) {
  var ev = document.createEvent('MouseEvents');
  ev.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
  obj.dispatchEvent(ev);
}
https://segmentfault.com/q/1010000008187200 
function export_raw(name, data) {
  var urlObject = window.URL || window.webkitURL || window;
  var export_blob = new Blob([data]);
  var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a')
  save_link.href = urlObject.createObjectURL(export_blob);
  save_link.download = name;
  fake_click(save_link);
}
```
###[unicode转中文](https://segmentfault.com/q/1010000008185071)
```js
function convert2Unicode(str) {
    return str.replace(/[\u0080-\uffff]/g,
    function($0) {
        var tmp = $0.charCodeAt(0).toString(16);
        return "\u" + new Array(5 - tmp.length).join('0') + tmp;
    });
}
decodeURIComponent('\u6211\u662F')
function unicode2ch($str)
{
    if (!$str) {
        return false;
    }
    if($decode=json_decode($str)){
        return $decode;
    }
    $str = '['.$str.']';
    $decode = json_decode($str);
    if(count($decode)===1){
        return $decode[0];
    }
    return false;
}

$st = '中';
$en = json_encode($st);//"\u4e2d"
echo unicode2ch($en);//中
```
###[php将unicode编码转为utf-8方法](http://www.welefen.com/post/php-unicode-to-utf8.html)
```js
function unicode2utf8($str){
        if(!$str) return $str;
        $decode = json_decode($str);
        if($decode) return $decode;
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
        if(count($decode) == 1){
                return $decode[0];
        }
        return $str;
}
js将汉字转为实体字符
function convert2Entity(str) {
    var len = str.length;
    var re = [];
    for (var i = 0; i < len; i++) {         
        var code = str.charCodeAt(i);         if (code > 256) {
            re.push('&#' + code + ';');
        } else {
            re.push(str.charAt(i));
        }
    }
    return re.join('');
}
php将实体字符转为utf-8汉字的方法
function entity2utf8onechar($unicode_c){
    $unicode_c_val = intval($unicode_c);
    $f=0x80; // 10000000
    $str = "";
    // U-00000000 - U-0000007F:   0xxxxxxx
    if($unicode_c_val <= 0x7F){         $str = chr($unicode_c_val);     }     //U-00000080 - U-000007FF:  110xxxxx 10xxxxxx     else if($unicode_c_val >= 0x80 && $unicode_c_val <= 0x7FF){         $h=0xC0; // 11000000         $c1 = $unicode_c_val >> 6 | $h;
        $c2 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2);
    }
    //U-00000800 - U-0000FFFF:  1110xxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x800 && $unicode_c_val <= 0xFFFF){         $h=0xE0; // 11100000         $c1 = $unicode_c_val >> 12 | $h;
        $c2 = (($unicode_c_val & 0xFC0) >> 6) | $f;
        $c3 = ($unicode_c_val & 0x3F) | $f;
        $str=chr($c1).chr($c2).chr($c3);
    }
    //U-00010000 - U-001FFFFF:  11110xxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x10000 && $unicode_c_val <= 0x1FFFFF){         $h=0xF0; // 11110000         $c1 = $unicode_c_val >> 18 | $h;
        $c2 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c3 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c4 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4);
    }
    //U-00200000 - U-03FFFFFF:  111110xx 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x200000 && $unicode_c_val <= 0x3FFFFFF){         $h=0xF8; // 11111000         $c1 = $unicode_c_val >> 24 | $h;
        $c2 = (($unicode_c_val & 0xFC0000)>>18) | $f;
        $c3 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c4 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c5 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4).chr($c5);
    }
    //U-04000000 - U-7FFFFFFF:  1111110x 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x4000000 && $unicode_c_val <= 0x7FFFFFFF){         $h=0xFC; // 11111100         $c1 = $unicode_c_val >> 30 | $h;
        $c2 = (($unicode_c_val & 0x3F000000)>>24) | $f;
        $c3 = (($unicode_c_val & 0xFC0000)>>18) | $f;
        $c4 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c5 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c6 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4).chr($c5).chr($c6);
    }
    return $str;
}
function entities2utf8($unicode_c){
    $unicode_c = preg_replace("/\&\#([\da-f]{5})\;/es", "entity2utf8onechar('\\1')", $unicode_c);
    return $unicode_c;
}
```
###[按字节截取字符串](http://www.welefen.com/post/substr-by-byte.html)
```js
baidu.string.subByte1 = function(source, length) {
    return (source + '').substr(0, length).replace(/([^\x00-\xff])/g, '$1 ').substr(0, length).replace(/([^\x00-\xff]) /g, '$1');
}
```
###[相似图片搜索的php实现](http://www.welefen.com/post/similar-image-search-in-php.html)
```js
class Imghash{


 private static $_instance = null;


 public $rate = 2;


 public static function getInstance(){


 if (self::$_instance === null){
     self::$_instance = new self();
 }
 return self::$_instance;

 }
 public function run($file){


 if (!function_exists('imagecreatetruecolor')){
     throw new Exception('must load gd lib', 1);
 }
 $isString = false;
 if (is_string($file)){
     $file = array($file);
     $isString = true;
 }
 $result = array();
 foreach ($file as $f){
     $result[] = $this->hash($f);
 }
 return $isString ? $result[0] : $result;

 }
 public function checkIsSimilarImg($imgHash, $otherImgHash){


 if (file_exists($imgHash) && file_exists($otherImgHash)){
     $imgHash = $this->run($imgHash);
     $otherImgHash = $this->run($otherImgHash);
 }
 if (strlen($imgHash) !== strlen($otherImgHash)) return false;
 $count = 0;
 $len = strlen($imgHash);
 for($i=0;$i<$len;$i++){
     if ($imgHash{$i} !== $otherImgHash{$i}){
         $count++;
     }
 }
 return $count <= (5 * $rate * $rate) ? true : false;

 }
 public function hash($file){


 if (!file_exists($file)){
     return false;
 }
 $height = 8 * $this->rate;
 $width = 8 * $this->rate;
 $img = imagecreatetruecolor($width, $height);
 list($w, $h) = getimagesize($file);
 $source = $this->createImg($file);
 imagecopyresampled($img, $source, 0, 0, 0, 0, $width, $height, $w, $h);
 $value = $this->getHashValue($img);
 imagedestroy($img);
 return $value;

 }
 public function getHashValue($img){


 $width = imagesx($img);
 $height = imagesy($img);
 $total = 0;
 $array = array();
 for ($y=0;$y<$height;$y++){
     for ($x=0;$x<$width;$x++){
         $gray = ( imagecolorat($img, $x, $y) >> 8 ) & 0xFF;
         if (!is_array($array[$y])){
             $array[$y] = array();
         }
         $array[$y][$x] = $gray;
         $total += $gray;
     }
 }
 $average = intval($total / (64 * $this->rate * $this->rate));
 $result = '';
 for ($y=0;$y<$height;$y++){
     for ($x=0;$x<$width;$x++){
         if ($array[$y][$x] >= $average){
             $result .= '1';
         }else{
             $result .= '0';
         }
     }
 }
 return $result;

 }
 public function createImg($file){


 $ext = $this->getFileExt($file);
 if ($ext === 'jpeg') $ext = 'jpg';
 $img = null;
 switch ($ext){
     case 'png' : $img = imagecreatefrompng($file);break;
     case 'jpg' : $img = imagecreatefromjpeg($file);break;
     case 'gif' : $img = imagecreatefromgif($file);
 }
 return $img;

 }
 public function getFileExt($file){


 $infos = explode('.', $file);
 $ext = strtolower($infos[count($infos) - 1]);
 return $ext;

 }
}
$instance = ImgHash::getInstance();
$result = $instance->checkIsSimilarImg('chenyin/IMG_3214.png', 'chenyin/IMG_3212.JPG');
```
###[PJAX](http://www.welefen.com/post/use-ajax-and-pushstate.html)
```js
http://www.welefen.com/post/pjax-for-ajax-and-pushstate.html
function is_pjax(){
    return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] === 'true';
}
$('#container').bind('start.pjax', function(){
    $('#loading').show();
})
$('#container').bind('end.pjax', function(){
    $('#loading').hide();
})
```
###[JS类型转换](https://zhuanlan.zhihu.com/p/24967321)
```js
var bool = new Boolean(false);
if (bool) {
	alert('true');
} else {
	alert('false');
}
有哪些东西是假值？

共6个：

0或+0、-0，NaN
""
false
undefined
null
上面的顺序是按照基本类型来排列的。

除此之外的一律不是！！哪怕是如下形式：

Infinity
'0'、'false'、" "（空格字符）
任何引用类型:[],{},function(){}
if (a && b)的正确理解方式是：a && b进行表达式求值后，然后再转换为Boolean类型。

&&是种短路语法，求值后不一定是个Boolean类型，更不是两边转化布尔值再运算。
比如 2&&3 的结果是3，不是true。
引用类型转换为布尔，始终为true

引用类型转换为字符串

1.优先调用toString方法（如果有），看其返回结果是否是原始类型，如果是，转化为字符串，返回。
2.否则，调用valueOf方法（如果有），看其返回结果是否是原始类型，如果是，转化为字符串，返回。
3.其他报错。
引用类型转化为数字
1.优先调用valueOf方法（如果有），看其返回结果是否是基本类型，如果是，转化为数字，返回。
2.否则，调用toString方法（如果有），看其返回结果是否是基本类型，如果是，转化为数字，返回。
3.其他报错。
```
###[js语言中最常用的单词](https://zhuanlan.zhihu.com/p/24949254)
```js
https://anvaka.github.io/common-words/#?lang=php
this\function\if/var/return/the/i/a/to/value
```
###[Pandas | 表格整合三大神技](https://zhuanlan.zhihu.com/p/24892205)
```js
#暴走大事件四名同学的政治,英语,语文得分,索引为0,1,2,4(学号)
df1=pd.DataFrame({'名字':['王尼玛','张全蛋','赵铁柱','李小花'],
                 '语文':[95,88,23,66],
                 '政治':[96,64,33,66],
                 '英语':[66,100,33,66]}
                  ,index=[0,1,2,4])

frame=[df1,df2]
df3=pd.concat(frame,keys=['暴走大事件','NBA'],axis=0,join='outer').fillna(0)
```
###数组用第二个元素排序
```js
s = [('a', 3), ('b', 2), ('c', 1)]
sorted(s, key=lambda x:x[1])
```
###[打印出九九乘法表](https://www.zhihu.com/question/20125256/answer/141795902)
```js
for x in range(1,10):
    for y in range(x,10):
        print('{}*{}= {} '.format(x,y,x*y),end='')
    print('')
    
    1*1= 1 1*2= 2 1*3= 3 1*4= 4 1*5= 5 1*6= 6 1*7= 7 1*8= 8 1*9= 9
2*2= 4 2*3= 6 2*4= 8 2*5= 10 2*6= 12 2*7= 14 2*8= 16 2*9= 18
3*3= 9 3*4= 12 3*5= 15 3*6= 18 3*7= 21 3*8= 24 3*9= 27
4*4= 16 4*5= 20 4*6= 24 4*7= 28 4*8= 32 4*9= 36
5*5= 25 5*6= 30 5*7= 35 5*8= 40 5*9= 45
6*6= 36 6*7= 42 6*8= 48 6*9= 54
7*7= 49 7*8= 56 7*9= 63
8*8= 64 8*9= 72
9*9= 81
```
###[Python 正则匹配跨行 HTML](https://www.v2ex.com/t/335684)
```js
[\s\S]+.*?p>(.*?)<\/p>
re.search("<p.*p>", text, re.S)
```
###[Python 解方程](https://zhuanlan.zhihu.com/p/24893371)
```js
x + 2y = 3
4x ＋ 5y = 6
In [1]: import numpy as np
   ...: A = np.mat('1,2; 4,5')    # 构造系数矩阵 A
   ...: b = np.mat('3,6').T       # 构造转置矩阵 b （这里必须为列向量）
   ...: r = np.linalg.solve(A,b)  # 调用 solve 函数求解
   ...: print r
   ...:
Out[1]: [[-1.]
         [ 2.]]

x + 2 * (x ** 2) + 3 * (x ** 3) - 6 = 0
In [4]: from sympy import *
   ...: x = symbols('x')
   ...: solve(x + 2 * (x ** 2) + 3 * (x ** 3) - 6, x)
Out[4]: [1, -5/6 - sqrt(47)*I/6, -5/6 + sqrt(47)*I/6]


```
###[imagemagick 水印 gif](https://www.v2ex.com/t/335293)
`convert -coalesce name.gif -gravity SouthEast -geometry +0+0 null: watermark.png -layers composite -layers optimize output.gif` 
###[key 里面有不可见字符](https://www.v2ex.com/t/335582#reply48)
```js
$a = []; 

$a["hell\u{2060}o"] = 1; 
$a["hello"] = 2; 
print_r($a); 

输出 
Array 
( 
[hell ⁠ o] => 1 
[hello] => 2 
)
foreach($ret as $key=>$value){ 
var_dump($key); 
var_dump(bin2hex($key)); 
}
OPcache 的锅 

https://bugs.php.net/bug.php?id=73871 
https://bugs.php.net/bug.php?id=73847
是 opcache 导致的，我用循环生成数组，且键值加 md5 解决了
```
###[震惊小伙伴的单行代码](http://www.vaikan.com/10-python-one-liners-to-impress-your-friends/)
```js
print sum(range(1,1001))
print open("ten_one_liners.py").readlines()
过滤列表中的数值

print reduce(lambda(a,b),c: (a+[c],b) if c > 60 else (a,b + [c]), [49, 58, 76, 82, 88, 90],([],[]))
获取XML web service数据并分析

from xml.dom.minidom import parse, parseString
import urllib2
# 注意，我将它转换成XML格式化并打印出来
print parse(urllib2.urlopen("http://search.twitter.com/search.atom?&q=python")).toprettyxml(encoding="utf-8")
并行处理

import multiprocessing
import math

print list(multiprocessing.Pool(processes=4).map(math.exp,range(1,11)))

```
###[SQL 注入详解](http://blog.jobbole.com/109784/)
```js
//原先要在数据库中执行的命令
SELECT first_name, last_name FROM users WHERE user_id = '1'
//变成
SELECT first_name, last_name FROM users WHERE user_id = '1' or '1'='1'
mysql> select * from students where TRUE ;
+-------+-------+-----+
| id    | name  | age |
+-------+-------+-----+
| 10056 | Doris |  20 |
| 10058 | Jaune |  22 |
| 10060 | Alisa |  29 |
+-------+-------+-----+
3 rows in set (0.00 sec)

mysql> select * from students where FALSE ;
Empty set (0.00 sec)
and 1=1 , and 1=2 即是 and TRUE , and FALSE 的变种。
mysql> select name from students where id = -1 union select schema_name from information_schema.schemata;   //数据库名  
+--------------------+
| name               |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| rumRaisin          |
| t3st               |
| test               |
+--------------------+
6 rows in set (0.00 sec)
```
###[拿到JavaScript异步函数的返回值](https://zhuanlan.zhihu.com/p/24404144)
```js
<script>
function getSomething() {
	var r = 0;
	setTimeout(function() {
		r = 2;
	}, 10);
	return r;
}

function compute() {
	var x = getSomething();
	alert(x * 2);
}
compute();
</script>

function getSomething(cb) {
	var r = 0;
	setTimeout(function() {
		r = 2;
		cb(r);
	}, 10);
}

function compute(x) {
	alert(x * 2);
}
getSomething(compute);

function getSomething() {
	var r = 0;
	return new Promise(function(resolve) {
		setTimeout(function() {
			r = 2;
			resolve(r);
		}, 10);
	});
}

function compute(x) {
	alert(x * 2);
}
getSomething().then(compute);


 
```
###[把第一个数组的值作为剩下数组的键名](https://segmentfault.com/q/1010000008191624)
```js
$data=[['id','name'],[1,'a'],[2,'b'],[3,'c']];


$keys = array_shift($data);

$result = array_map(function ($values) use ($keys) {
    return array_combine($keys, $values);
}, $data);
print_r($result);
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => a
        )

    [1] => Array
        (
            [id] => 2
            [name] => b
        )

    [2] => Array
        (
            [id] => 3
            [name] => c
        )

)
```
###[在Laravel中导入Excel文件](https://segmentfault.com/q/1010000008192716)
```js
PHP excel xls读取扩展https://github.com/xavieryang007/Xavxls  
```
###[mysql IF ELSE](https://segmentfault.com/q/1010000008137290)
```js
IF EXISTS (SELECT 1 FROM dual WHERE 1=1) 
THEN
    #TODO
ELSE 
    #TODO
END IF;
```
###[mysql求游戏排名](https://segmentfault.com/q/1010000008130461)
```js
CREATE TABLE `active_gamescore` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联active.id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '参与用户',
  `score` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分数',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间（时间戳）',
  PRIMARY KEY (`id`),
  KEY `active_id` (`active_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=240076 DEFAULT CHARSET=utf8 COMMENT='小游戏分数记录';
select user_id,a.sc,min(created_at) tm 
from (select user_id,max(score) sc from active_gamescore group by user_id) a 
join active_gamescore b 
on a.user_id=b.user_id and a.sc=b.score 
group by a.user_id,a.sc 
order by a.sc desc,tm asc limit 20;
```
###[sql数据去重问题](https://segmentfault.com/q/1010000008098772)
```js
 CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendid` int(11) NOT NULL DEFAULT '0',
  `receiveid` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `message` (`id`, `sendid`, `receiveid`, `create_time`)
VALUES
    (1, 321, 3, '2017-01-13 10:23:03'),
    (2, 322, 4, '2017-01-13 10:23:11'),
    (3, 123123, 9, '2017-01-13 10:23:25'),
    (4, 0, 0, '2017-01-13 10:22:54'),
    (5, 4, 321, '2017-01-13 10:22:54'),
    (6, 4, 322, '2017-01-13 10:23:17'),
    (7, 9, 12232, '2017-01-13 10:23:30'),
    (8, 0, 0, '2017-01-13 11:29:42');
根据sendid和receiveid进行数据去重，就是说其实id=22的数据和id=25的数据是一条数据
SELECT *
FROM   message m3
WHERE  id NOT IN (#查询需要去重的id
           select DISTINCT m1.id
           FROM            message AS m1
           INNER JOIN      message AS m2
           WHERE           m1.id != m2.id #过滤掉自身关联
           AND             ((
                                                           m1.receiveid = m2.sendid
                                           AND             m1.sendid = m2.receiveid)
                           OR              (
                                                           m1.sendid = m2.sendid
                                           AND             m1.receiveid = m2.receiveid ) )
           AND             m1.create_time < m2.create_time #
           GROUP BY        m1.id,
                           m2.id);    
```
###[laravel sql](https://segmentfault.com/q/1010000008148200)
```js
<?php

namespace App\Providers;

use DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * @param $needle
     * @param $replace
     * @param $haystack
     * @return mixed
     */
    private function str_replace_once($needle, $replace, $haystack)
    {
        $pos = strpos($haystack, $needle);
        if ($pos === false) {
            return $haystack;
        }
        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    public function boot()
    {
        DB::listen(function (QueryExecuted $query) {
            if ($query->bindings) {
                $sql = $query->sql;
                foreach ($query->bindings as $val) {
                    if (is_string($val)) {
                        $val = "\"" . strval($val) . "\"";
                    }
                    $sql = $this->str_replace_once("?", $val, $sql);
                }
                Log::debug($sql, $query->bindings);
            } else {
                Log::debug($query->sql, $query->bindings);
            }

        });
    }
}

```
###[把一个数组放入另一个数组的子数组里](https://segmentfault.com/q/1010000008144703)
```js
$floor_list=array(
        array('floor_num'=>'1'),
        array('floor_num'=>'2'),
        array('floor_num'=>'3'),
        array('floor_num'=>'4')
    );

$room_list=array('101','102','103','104','201','202','203','204','301','302','303','304','401','402','403','404');

$room_datas=array();
foreach ($room_list as $k => $v) {
    $floor_num=substr($v, 0,1);
    $room_datas[$floor_num][]=$v;
}

foreach ($floor_list as $k => $v) {
    $floor_num=$v['floor_num'];
    $floor_list[$k]['rooms']=isset($room_datas[$floor_num])?$room_datas[$floor_num]:array();
}

print_r($floor_list);

/*
Array
(
    [0] => Array
        (
            [floor_num] => 1
            [rooms] => Array
                (
                    [0] => 101
                    [1] => 102
                    [2] => 103
                    [3] => 104
                )

        )

    [1] => Array
        (
            [floor_num] => 2
            [rooms] => Array
                (
                    [0] => 201
                    [1] => 202
                    [2] => 203
                    [3] => 204
                )

        )

    [2] => Array
        (
            [floor_num] => 3
            [rooms] => Array
                (
                    [0] => 301
                    [1] => 302
                    [2] => 303
                    [3] => 304
                )

        )

    [3] => Array
        (
            [floor_num] => 4
            [rooms] => Array
                (
                    [0] => 401
                    [1] => 402
                    [2] => 403
                    [3] => 404
                )

        )

)
 */
```
###[Only variables should be assigned by reference](https://segmentfault.com/q/1010000008144401)
```js
function &getArr(){
    static $arr = [3,4,6];
    return $arr;
}

$arr2 = &getArr();
$arr2[0] = 100;
var_dump($arr2);

$arr3 = &getArr();
var_dump($arr3);
```
###[php artisan serve不支持https](http://stackoverflow.com/a/12946566/2429469)
php内置的web服务器仅仅用于本地测试使用，不支持ssl加密，所以使用php artisan serve来启动https服务显然是不行的。

可以使用php-fpm的方式来启动你的web服务，这样就可以支持https的访问方式了
###[json字符串中带双引号解析](https://segmentfault.com/q/1010000008195853)
```js
var s = '{"name" : "\\"张三\\"在提这样\\"一个\\"问题"}';
JSON.parse(s);
var s = '{name : "\\"张三\\"在提这样\\"一个\\"问题"}';
eval("[" + s + "]");
```
###[ cmd 解析命令对空格敏感环境变量有空格加引号](https://segmentfault.com/q/1010000008202080 )
```js
D:\一大段\python.exe
加上双引号...
"D:\一大段\python.exe" 
```
###移动网页上传图片只允许拍照而不出现相册<input type="file" capture="camera" accept="image/*" />
###[static是php面向对象的延迟绑定功能](https://segmentfault.com/q/1010000008209807)
```js

class A {
    const HH = "hello";
    function show()
    {
        echo static::HH, PHP_EOL;
    }
}

class B extends A {
    const HH = "world";
}


(new A)->show();
(new B)->show();
$ php test.php
hello
world
```
###[计算指定工作日后的日期](https://segmentfault.com/q/1010000008208219)
```js
<?php

class BusinessDaysCalculator {

    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;

    /**
     * @param DateTime   $startDate       Date to start calculations from
     * @param DateTime[] $holidays        Array of holidays, holidays are no conisdered business days.
     * @param DateTime[]      $nonBusinessDays Array of days of the week which are not business days.
     *  @param DateTime[]      $specialBusinessDay Array is the special work day.
     */
    public function __construct(DateTime $startDate, array $holidays, array $nonBusinessDays ,array $specialBusinessDay) {
        $this->date = $startDate;
        $this->holidays=[];
        foreach($holidays as $holiday){
            array_push($this->holidays,new DateTime($holiday));
        }
        $this->nonBusinessDays = $nonBusinessDays;
        $this->specialBusinessDay = $specialBusinessDay;
    }

    public function addBusinessDays($howManyDays) {
        $i = 0;
        while ($i < $howManyDays) {
            $this->date->modify("+1 day");
            if ($this->isBusinessDay($this->date)) {
                $i++;
            }
        }
    }

    public function getDate() {
        return $this->date->format('Y-m-d');
    }

    private function isBusinessDay(DateTime $date) {
        if(in_array($date->format('Y-m-d') , $this->specialBusinessDay)) return true; //判断当前日期是否是因法定节假日调休而上班的周末，这种情况也算工作日

        if (in_array((int)$date->format('N'), $this->nonBusinessDays)) {
            return false; //当前日期是周末
        }

        foreach ($this->holidays as $day) {
            if ($date->format('Y-m-d') == $day->format('Y-m-d')) {
                return false; //当前日期是法定节假日
            }
        }

        return true;
    }

}

$holidays=["2017-01-27","2017-01-28","2017-01-29","2017-01-30","2017-01-31","2017-02-01","2017-02-02"];//从聚合数据接口获得
$specialBusinessDay=["2017-01-22"];//因法定节假日调休而上班的周末，这种情况也算工作日.因为这种情况少，可以通过手动配置
$calculator = new BusinessDaysCalculator(
    new DateTime(), //当前时间
    $holidays,
    [BusinessDaysCalculator::SATURDAY, BusinessDaysCalculator::SUNDAY],
    $specialBusinessDay
);

$calculator->addBusinessDays(2); // 2个工作日后的时间

$afterBusinessDay=$calculator->getDate();
echo $afterBusinessDay;
```
