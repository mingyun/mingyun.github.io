###[http code](https://http.cat/)

###[php 一个方法死循环， 其他页面无法访问](https://segmentfault.com/q/1010000008412879)
```js
public function a(){
    for($i = 1; $i<= 1000001; $i++){
        $data[] = ['a' => $i, 'add_time'=> date('Y-m-d H:i:s')];
    }
}
封装成一个方法， 然后访问这个页面的时候，把这个任务丢到redis的队列去中执行啊 。这样就实现了简单的php的异步
```
###[php如何能在1~2s左右判断线上服务器是否开启](https://segmentfault.com/q/1010000008425937)
```js
$ip = '192.168.1.1';
$port = 80;
$timeout = 2;
$sock = @fsockopen($ip, $port, $errno, $errmsg, $timeout);
if($sock) {
   //todo: server is online
}else {
   //todo: server is offline
}
$count = 3; //尝试次数
$flag = false; //状态标记
$ip = '192.168.1.1';
$port = 80;
$timeout = 2;
while($count--) {
    $sock = @fsockopen($ip, $port, $errno, $errmsg, $timeout);
    if($sock) {
        fclose($sock);
        $flag = true;
        break;
    }
}

if ($flag) {
    //你的业务逻辑
} else {
    echo "$errmsg ($errno)<br />" . PHP_EOL;
}
```
###[二维数组拼接问题](https://segmentfault.com/q/1010000008416813)
```js
public function actionTest()
{
    $list = [];
    $arr = [
        ['adminid' => 1, 'group' => '小组1'],
        ['adminid' => 2, 'group' => '小组2'],
        ['adminid' => 2, 'group' => '小组3'],
    ];
    foreach ($arr as $value) {
        if (isset($list[$value['adminid']])) {
            $list[$value['adminid']][] = $value;
            continue;
        }
        $list[$value['adminid']][] = $value;
    }
    unset($arr);
    print_r($list);
}
```
###[查询到小区列表并获取每个小区的出售房源总数和出租房源总数](https://segmentfault.com/q/1010000008410829)
```js
select 
C.id,
C.name,
(
    select count(*) from sale as S where S.cid = C.id
) as sale_count , 
(
    select count(*) from rent as R where R.cid = C.id
) as rent_count 
from community as C;
```
###[php使用curl下载https资源文件](https://segmentfault.com/q/1010000008502236)
```js
<?php
$urls = [
    "https://cdn.pixabay.com/photo/2017/01/28/21/48/lion-2016620__340.jpg 1x, https://cdn.pixabay.com/photo/2017/01/28/21/48/lion-2016620__480.jpg",
    "https://cdn.pixabay.com/photo/2017/02/20/19/29/architecture-2083687__340.jpg 1x, https://cdn.pixabay.com/photo/2017/02/20/19/29/architecture-2083687__480.jpg",
    "https://cdn.pixabay.com/photo/2017/02/06/12/34/reptile-2042906__340.jpg 1x, https://cdn.pixabay.com/photo/2017/02/06/12/34/reptile-2042906__480.jpg"
];

foreach ($urls as $k => $v) {
     if (!empty($v) && preg_match("~^http~i", $v)) {
        $nurl[$k] = trim(str_replace(' ', "%20", $v));
        $curl[$k] = curl_init($nurl[$k]);
        curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl[$k], CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl[$k], CURLOPT_HEADER, 0);
        curl_setopt($curl[$k], CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl[$k], CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl[$k], CURLOPT_SSL_VERIFYHOST, false);        
        if (!isset($handle)) {
           $handle = curl_multi_init();
        }
        curl_multi_add_handle($handle, $curl[$k]);
      }
      continue;
}
$active = null;
do {
   $mrc = @curl_multi_exec($handle, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
   while ($active && $mrc == CURLM_OK) {
       if (curl_multi_select($handle) != -1) {
          do {
             $mrc = curl_multi_exec($handle, $active);
          } while ($mrc == CURLM_CALL_MULTI_PERFORM);
       }
   }

foreach ($curl as $k => $v) {
   var_dump(curl_error($curl[$k]));
}
SSL: CA certificate set, but certificate verification is disabled
curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
改成：

curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
```
###数组转换
```js
$arr = array("photo" => array(
            "name" => array(
              0 =>  "221.png",
              1 =>  "2211.png",
              2 =>  "545843ec763cf.jpg",
            ),
            "type" => array(
              0 => "image/png",
              1 => "image/png",
              2 => "image/jpeg",
            ),
            "tmp_name" => array(
              0 => "C:\Windows\Temp\php55FF.tmp",
              1 => "C:\Windows\Temp\php5600.tmp",
              2 => "C:\Windows\Temp\php5601.tmp",
            ),
            "error" => array(
              0 => 0,
              1 => 0,
              2 => 0,
            ),
            "size" => array(
              0 => 8353,
              1 => 8194,
              2 => 527569,
            )
          ));

        $result = array();
        foreach (current($arr) as $key => $value) {
          foreach ($value as $k => $val) {
            $result[$k][$key] = $val;
          }
        }
        >>> $result
=> [
       [
           "name"     => "221.png",
           "type"     => "image/png",
           "tmp_name" => "C:\\Windows\\Temp\\php55FF.tmp",
           "error"    => 0,
           "size"     => 8353
       ],
       [
           "name"     => "2211.png",
           "type"     => "image/png",
           "tmp_name" => "C:\\Windows\\Temp\\php5600.tmp",
           "error"    => 0,
           "size"     => 8194
       ],
       [
           "name"     => "545843ec763cf.jpg",
           "type"     => "image/jpeg",
           "tmp_name" => "C:\\Windows\\Temp\\php5601.tmp",
           "error"    => 0,
           "size"     => 527569
       ]
   ]
```
###[ php的curl函数模拟post数据提交，首次速度非常慢的处理办法](http://blog.csdn.net/hzbigdog/article/details/10009043)
```js
1、curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //强制协议为1.0
2、curl_setopt($ch, CURLOPT_HTTPHEADER, array(''Expect: '')); //头部要送出'Expect: '
3、curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); //强制使用IPV4协议解析域名

使用curl做POST的时候, 当要POST的数据大于1024字节的时候, curl并不会直接就发起POST请求, 而是会分为俩步,
  1. 发送一个请求, 包含一个Expect:100-continue, 询问Server使用愿意接受数据
  2. 接收到Server返回的100-continue应答以后, 才把数据POST给Server
这是libcurl的行为.
具体的RFC相关描述: http://www.w3.org/Protocols/rfc2616/rfc2616-sec8.html#sec8.2.3
于是,这样就有了一个问题, 并不是所有的Server都会正确应答100-continue, 比如lighttpd, 就会返回417 “Expectation Failed”, 则会造成逻辑出错,,
解决方法:curl_setopt($ch, CURLOPT_HTTPHEADER, array(''Expect: '')); //头部要送出'Expect: '
```
###[php过滤](https://github.com/wulijun/php-ext-trie-filter)
https://github.com/morlay/gin-swagger 我们团队成员基于gin框架支持swagger，欢迎大家拔草
【推荐一个php扩展级的敏感词过滤库】
 trie树库libdatrie：https://github.com/Timandes/libdatrie
 基于libdatrie实现的php扩展：https://github.com/wulijun/php-ext-trie-filter

使用以上扩展的PHP使用代码： https://github.com/heiyeluren/tools/blob/master/lnmp_install/trie_filter_make_dict.php https://github.com/heiyeluren/tools/blob/master/lnmp_install/trie_filter_find_word.php 


敏感词库（参考）：

http://vdisk.weibo.com/s/u7m7v7tUJtAIn
 http://download.csdn.net/detail/jasonysu/9579408

 效率：15w敏感词库检测两千字左右文本大约0.13秒左右
反垃圾内容阶段：
1. 初级阶段：正则匹配、字符串扫描判断是否包含非法关键词库
2. 中级阶段：高效率敏感词匹配算法，比如什么 ac自动机（trie树+回朔）
3. 高级阶段：基本敏感词过滤+用户行为+机器学习（比如能够统计出新注册7天内的用户是坏人几率大等等）
比如评论内容的相关性，字数，历史数，用户等级，用户注册时长，发送频率。建立模型，对他是不是正常的用户进行打分，分数低于一定阈值就加验证码或直接打回
###[Use of undefined constant CURLOPT_IPRESOLVE - assumed 'CURLOPT_IPRESOLVE'](http://stackoverflow.com/questions/11220416/php-curl-curlopt-ipresolve)
```js
CURLOPT_IPRESOLVE is available since curl 7.10.8
Try this sample code to test

<?php

    $version = curl_version();

// These are the bitfields that can be used 
// to check for features in the curl build
$bitfields = Array(
            'CURL_VERSION_IPV6', 
            'CURLOPT_IPRESOLVE'
            );


foreach($bitfields as $feature)
{
    echo $feature . ($version['features'] & constant($feature) ? ' matches' : ' does not match');
    echo PHP_EOL;
}
```
###[MySQL 5.7 之联合（复合）索引实践](https://laravel-china.org/topics/3565)
```js
mysql> show create table m_user\G;
*************************** 1. row ***************************
       Table: m_user
Create Table: CREATE TABLE `m_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `school` char(128) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`age`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8
1 row in set (0.00 sec)
联合索引字段：
KEY name (name,age,status)
[1 3 命中]
select * from m_user where name='feng1' and status=1

[1 3 order by 3 命中]
select * from m_user where name='feng1' and status=1 order by status desc

[2 3 不命中]
select * from m_user where age=10 and status=1

[1 in 命中]
select * from m_user where name in ('feng1') and age<10
select * from m_user where name in ('feng1') and age<10 order by school

[1 between 不命中]
select * from m_user where name between 'feng1' and 'feng3'
select * from m_user where name between 'feng1' and 'feng3' order by school desc

[1 <> 不命中]
select * from m_user where name<>'feng1'
select * from m_user where name<>'feng1' and age<10
select * from m_user where name<>'feng1' and age<10 order by school desc

[1 < 或 <= 命中]
select * from m_user where name < 'feng1'
select * from m_user where name <= 'feng1'
select * from m_user where name <= 'feng1' and age<10
select * from m_user where name <= 'feng1' and age<10 order by school desc

[1 > 或 >= 不命中]
select * from m_user where name>'feng1'
select * from m_user where name>='feng1'

[无where条件 直接order by 不命中]
select * from m_user order by name desc
```
###[链家的模拟登录python](https://iwww.me/522.html)
```js
header里面生成了一个键名为JSESSIONID的cookie，没有这个cookie是无法登录的，所以发送表单内容之前一定要先获取这个cookie，然后带着这个cookie去post数据。 然后输入账号密码进行登录
# encoding:utf-8
import urllib
import urllib2
import json
import cookielib
import time
import re
#获取Cookiejar对象（存在本机的cookie消息）
cookie = cookielib.CookieJar()
#自定义opener,并将opener跟CookieJar对象绑定
opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cookie))
#安装opener,此后调用urlopen()时都会使用安装过的opener对象
urllib2.install_opener(opener)

home_url = 'http://bj.lianjia.com/'
auth_url = 'https://passport.lianjia.com/cas/login?service=http%3A%2F%2Fbj.lianjia.com%2F'
chengjiao_url = 'http://bj.lianjia.com/chengjiao/'


headers = {
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Encoding': 'gzip, deflate, sdch',
    'Accept-Language': 'zh-CN,zh;q=0.8',
    'Cache-Control': 'no-cache',
    'Connection': 'keep-alive',
    'Content-Type': 'application/x-www-form-urlencoded',
    'Host': 'passport.lianjia.com',
    'Pragma': 'no-cache',
    'Upgrade-Insecure-Requests': '1',
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'
}
# 获取lianjia_uuid
req = urllib2.Request('http://bj.lianjia.com/')
opener.open(req)
# 初始化表单
req = urllib2.Request(auth_url, headers=headers)
result = opener.open(req)
# print(cookie)
# 获取cookie和lt值
pattern = re.compile(r'JSESSIONID=(.*)')
jsessionid = pattern.findall(result.info().getheader('Set-Cookie').split(';')[0])[0]

html_content = result.read()

pattern = re.compile(r'value=\"(LT-.*)\"')
lt = pattern.findall(html_content)[0]

pattern = re.compile(r'name="execution" value="(.*)"')
execution = pattern.findall(html_content)[0]

# print(cookie)
# opener.open(lj_uuid_url)
# print(cookie)
# opener.open(api_url)
# print(cookie)

# data
data = {
    'username': 'YOUR USERNAME',
    'password': 'YOUR PASSWORD',
    # 'service': 'http://bj.lianjia.com/',
    # 'isajax': 'true',
    # 'remember': 1,
    'execution': execution,
    '_eventId': 'submit',
    'lt': lt,
    'verifyCode': '',
    'redirect': '',
}
# urllib进行编码
post_data=urllib.urlencode(data)
# header
headers = {
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Encoding': 'gzip, deflate',
    'Accept-Language': 'zh-CN,zh;q=0.8',
    'Cache-Control': 'no-cache',
    'Connection': 'keep-alive',
    # 'Content-Length': '152',
    'Content-Type': 'application/x-www-form-urlencoded',
    'Host': 'passport.lianjia.com',
    'Origin': 'https://passport.lianjia.com',
    'Pragma': 'no-cache',
    'Referer': 'https://passport.lianjia.com/cas/login?service=http%3A%2F%2Fbj.lianjia.com%2F',
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
    'Upgrade-Insecure-Requests': '1',
    'X-Requested-With': 'XMLHttpRequest',
}

headers2 = {
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Encoding': 'gzip, deflate, sdch',
    'Accept-Language': 'zh-CN,zh;q=0.8',
    'Cache-Control': 'no-cache',
    'Connection': 'keep-alive',
    'Content-Type': 'application/x-www-form-urlencoded',
    'Host': 'bj.lianjia.com',
    'Pragma': 'no-cache',
    'Referer': 'https://passport.lianjia.com/cas/xd/api?name=passport-lianjia-com',
    'Upgrade-Insecure-Requests': '1',
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'
}
req = urllib2.Request(auth_url, post_data, headers)
try:
    result = opener.open(req)
except urllib2.HTTPError, e:
    print e.getcode()  
    print e.reason  
    print e.geturl()  
    print "-------------------------"
    print e.info()
    print(e.geturl())
    req = urllib2.Request(e.geturl())
    result = opener.open(req)
    req = urllib2.Request(chengjiao_url)
    result = opener.open(req).read()
    print(result)
```
###[经典SQL：每个分组里的前n条记录问题](https://www.oschina.net/question/723168_127257)
```js
CREATE TABLE foo (
person varchar(30) not null,
groupname int not null,
age int not null
);

INSERT INTO foo VALUES('Shawn',1,42);
INSERT INTO foo VALUES('Jill', 1,34);
INSERT INTO foo VALUES('Bob',  1,32);
INSERT INTO foo VALUES('Fred', 1,12);
INSERT INTO foo VALUES('Laaaaa', 1,10);

INSERT INTO foo VALUES('Laura',2,39);
INSERT INTO foo VALUES('Paul', 2,36);
INSERT INTO foo VALUES('Joe',  2,36);
INSERT INTO foo VALUES('Jake', 2,29);
INSERT INTO foo VALUES('James',2,15);

INSERT INTO foo VALUES('Chuck',3,65);
INSERT INTO foo VALUES('Nancy',3,65);
INSERT INTO foo VALUES('Andy', 3,65);
INSERT INTO foo VALUES('King', 3,60);
INSERT INTO foo VALUES('Kang', 3,54);

INSERT INTO foo VALUES('no41',4,70);
INSERT INTO foo VALUES('no42',4,70);
INSERT INTO foo VALUES('no43', 4,70);
INSERT INTO foo VALUES('no44',  4,70);
INSERT INTO foo VALUES('no45', 4,54);

INSERT INTO foo VALUES('no51',5,80);
INSERT INTO foo VALUES('no52',5,80);
INSERT INTO foo VALUES('no53', 5,80);
INSERT INTO foo VALUES('no54',  5,80);
INSERT INTO foo VALUES('no55', 5,80);
SELECT
    person,
    groupname,
    age
FROM
(
    SELECT
        person,
        groupname,
        age,
        @rn := IF(@prev = groupname, @rn + 1, 1) AS rn,
        @prev := groupname
    FROM foo
    JOIN (SELECT @prev := NULL, @rn := 0) AS vars
    ORDER BY groupname, age DESC, person
) AS T1
WHERE rn <= 3;
+--------+-----------+-----+
| person | groupname | age |
+--------+-----------+-----+
| Shawn  |         1 |  42 |
| Jill   |         1 |  34 |
| Bob    |         1 |  32 |
| Laura  |         2 |  39 |
| Joe    |         2 |  36 |
| Paul   |         2 |  36 |
| Andy   |         3 |  65 |
| Chuck  |         3 |  65 |
| Nancy  |         3 |  65 |
| no41   |         4 |  70 |
| no42   |         4 |  70 |
| no43   |         4 |  70 |
| no51   |         5 |  80 |
| no52   |         5 |  80 |
| no53   |         5 |  80 |
+--------+-----------+-----+
15 rows in set (0.01 sec)

INSERT INTO foo VALUES('Laura',2,39);
INSERT INTO foo VALUES('Paul', 2,36);
INSERT INTO foo VALUES('Joe',  2,36);
INSERT INTO foo VALUES('Jake', 2,29);
INSERT INTO foo VALUES('James',2,15);

SELECT
DISTINCT 
a.groupname 
, b.* 
FROM 
foo a 
LEFT JOIN ( 
            SELECT c.*, 
                    (SELECT COUNT(groupname) FROM foo d WHERE d.age >= c.age AND d.groupname = c.groupname) AS cnt 
            FROM foo c 
            group BY groupname, age , person 
        ) AS b 
    ON (a.groupname = b.groupname)
    
    +-----------+--------+-----------+------+------+
| groupname | person | groupname | age  | cnt  |
+-----------+--------+-----------+------+------+
|         1 | Bob    |         1 |   32 |    3 |
|         1 | Jill   |         1 |   34 |    2 |
|         1 | Shawn  |         1 |   42 |    1 |
|         1 | Laaaaa |         1 |   10 |    5 |
|         1 | Fred   |         1 |   12 |    4 |
|         2 | Joe    |         2 |   36 |    3 |
|         2 | Paul   |         2 |   36 |    3 |
|         2 | Laura  |         2 |   39 |    1 |
|         2 | James  |         2 |   15 |    5 |
|         2 | Jake   |         2 |   29 |    4 |
|         3 | Andy   |         3 |   65 |    3 |
|         3 | Chuck  |         3 |   65 |    3 |
|         3 | Nancy  |         3 |   65 |    3 |
|         3 | Kang   |         3 |   54 |    5 |
|         3 | King   |         3 |   60 |    4 |
|         4 | no41   |         4 |   70 |    4 |
|         4 | no42   |         4 |   70 |    4 |
|         4 | no43   |         4 |   70 |    4 |
|         4 | no44   |         4 |   70 |    4 |
|         4 | no45   |         4 |   54 |    5 |
|         5 | no52   |         5 |   80 |    5 |
|         5 | no53   |         5 |   80 |    5 |
|         5 | no54   |         5 |   80 |    5 |
|         5 | no55   |         5 |   80 |    5 |
|         5 | no51   |         5 |   80 |    5 |
+-----------+--------+-----------+------+------+
25 rows in set (0.04 sec)
```
###[Ghost' object has no attribute 'open'](https://github.com/jeanphix/Ghost.py/issues/189)
```js
import ghost
#http://jeanphix.me/Ghost.py/
g = ghost.Ghost()
with g.start() as session:
    page, extra_resources = session.open("https://www.debian.org")
    result, resources = session.evaluate( "document.getElementById('my-input').getAttribute('value');")
    result, resources = session.set_field_value("input[name=username]", "jeanphix")
    session.capture_to('ghost.png'")
    if page.http_status == 200 and \
            'The Universal Operating System' in page.content:
        print("Good!")

ghost = Ghost()
session = ghost.start()
p, r = session.open("http://www.google.com')
 

session.capture_to(path=filename)
 

p.content
```
###[数组里面对象如何排序](https://segmentfault.com/q/1010000008527144)
function sort(list){
  return list.sort(function(i1, i2){
    return -((i1.ds+i1.dp) - (i2.ds+i2.dp));
  })
}

###[js如何实现不同窗口之间共享数据](https://segmentfault.com/q/1010000008527746)
###[求推荐效率很高的动态绘点插件](https://segmentfault.com/q/1010000008516708)
用highstock
https://www.hcharts.cn/demo/
###[用Jenkins搭建PHP持续集成解决方案](https://segmentfault.com/q/1010000008471032)
基于 flow.ci 实现 PHP 项目自动化持续集成
###[一个数组 a[99] ,里面有1-100中的99个不重复的整数,让你找出没有的那1个。](https://segmentfault.com/q/1010000008526503)
###[通过 Array.from(containers) 转为真正的数组再使用 forEach 方法](https://segmentfault.com/q/1010000008528453)
page.evaluate(function () {
            var dataList = [];
            var containers=document.querySelectorAll('.c-container');
            containers.forEach(function (val) {
                console.log(val);
            })
            containers 是一个伪数组，可以通过 Array.from(containers) 转为真正的数组再使用 forEach 方法
            有 length 属性不代表它就是一个数组，document.querySelectorAll 返回的是一个伪数组，类似的还有函数参数 arguments 也是伪数组
###[node js的终端中，如何让 console.log 尽可能地完全展开](https://segmentfault.com/q/1010000008528325)
console.log(JSON.stringify(obj));
###[js如何判断对象为空？](https://segmentfault.com/q/1010000008525092)
var obj;
if(!obj){
 console.log("object is null or undefined");
}
如果判断对象没有任何属性这个就不好弄了
使用
for...in能够遍历可枚举属性，包括prototype中的
Object.keys(ES2015)值遍历自有的可枚举属性
但是对象的属性也可以通过设置enumerable=false为不可枚举的，那么通过上面的方法你就无法判断是否具有某个属性了

$.isEmptyObject();方法也是检查可枚举的属性

所以具体问题还是要具体分析，根据你的业务场景来
没有特殊的设置
$.isEmptyObject();
Object.keys()
for...in
###[诡异的字符串长度，虚心请教](https://segmentfault.com/q/1010000008528705)
//代码如下：
var str1='﻿﻿﻿﻿{"status":0}';
console.log(str1.length)

var str2='{"status":0}';
console.log(str2.length)
str1.charCodeAt(0); //65279 即 0xFEFF
在某些东南亚语言里面，书写的时候有些字母间需要连字，有些不需要。这个似乎没有什么规律，所以只能人为的添加。0xFEFF是零宽度非连字空格，这个字符显示的效果是，有跟没有是一样的，对于其他语言。
###[php 二维数组去重合并](https://segmentfault.com/q/1010000008525167)
```js
$arr = array(

    array(
        'id'=>'1',
        'name' => '张三'
        ),
    array(
        'id'=>'2',
        'name' => '张三'
        ),
    array(
        'id'=>'1',
        'name' => '李四'
        )
);
$item = array();

foreach($arr as $k=>$v){

if(!isset($item[$v['name']])){
    $item[$v['name']]=$v;
}else{
    $item[$v['name']]['id']+=$v['id'];
}
}
echo '<pre>';
print_r(array_values($item));
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => 张三
        )

    [1] => Array
        (
            [id] => 2
            [name] => 张三
        )

    [2] => Array
        (
            [id] => 1
            [name] => 李四
        )

)
```
###[一个循环遍历逻辑问题](https://segmentfault.com/q/1010000008523335)
```js
function demo($a=null,$b=null)
{
    // $a是一个数字或一个范围数组；
    // $b是一个数组，代表多个除数；
    
    // 难点，如何判断$a里面的某个数字，能同时除尽$b里面的所有数字，并且还要一次性返回$a和$b相除后得到的多个正整数？
}
demo([1000,1600],[4,5,6]);
  function demo($a=null,$b=null)
    {
        $result = array();
        for ($i=$a[0]; $i<=$a[1]; $i++) {
            foreach ($b as $b_key => $b_value) {
                $result[$i][$b_value] = $i / $b_value;  //假设b中所有都能整除 , 先把值存起来
                if ($i % $b_value != 0) {
                    unset($result[$i]); // 一旦b中有一个数字不满足, 例如 1000 / 7 , 那就跳出循环, 移除 $result['1000']
                    break;
                }
            }
        }
        return $result;
    }
    print_r(demo([1000,1600],[4,5,6]));
    
Array
(
    [1020] => Array
        (
            [4] => 255
            [5] => 204
            [6] => 170
        )

    [1080] => Array
        (
            [4] => 270
            [5] => 216
            [6] => 180
        )

    [1140] => Array
        (
            [4] => 285
            [5] => 228
            [6] => 190
        )

    [1200] => Array
        (
            [4] => 300
            [5] => 240
            [6] => 200
        )

    [1260] => Array
        (
            [4] => 315
            [5] => 252
            [6] => 210
        )

    [1320] => Array
        (
            [4] => 330
            [5] => 264
            [6] => 220
        )

    [1380] => Array
        (
            [4] => 345
            [5] => 276
            [6] => 230
        )

    [1440] => Array
        (
            [4] => 360
            [5] => 288
            [6] => 240
        )

    [1500] => Array
        (
            [4] => 375
            [5] => 300
            [6] => 250
        )

    [1560] => Array
        (
            [4] => 390
            [5] => 312
            [6] => 260
        )

)
```
###[SSL certificate problem: unable to get local issuer certificate](https://segmentfault.com/q/1010000008508237)
因为它是https，你在curl那个方法加上
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 检查证书中是否设置域名
###[比较两个文本的差异用什么算法](https://segmentfault.com/q/1010000008499096)
找到两个链接：全局对齐的Needleman–Wunsch算法和局部对齐Smith–Waterman算法。
###[字符串转成数据 键值对应 不使用 eval](https://segmentfault.com/q/1010000008510596)
去掉开头的array(和最后的);，变成：
'"1"=>"给对方","2"=>"发鬼地方","5"=>"","6"=>"发鬼地方","7"=>"发光飞碟"'
把=>替换成:，变成：
'"1":"给对方","2":"发鬼地方","5":"","6":"发鬼地方","7":"发光飞碟"'
前后加{}，变成：
'{"1":"给对方","2":"发鬼地方","5":"","6":"发鬼地方","7":"发光飞碟"}'
上json_decode
###[mysq日期用datetime好还是用int10好](https://segmentfault.com/q/1010000008513894)
建议用unsigned bigint(20).
因为unsigned int(10)最大值为4294967295.
64位PHP执行echo date('Y-m-d H:i:s', 4294967295);可见:
2106-02-07 14:28:15
这个时间是我们可以预见的.

为什么要用时间戳(整数)呢?因为时间戳方便运算后对比.

比如:以当前时间为基础,查询过去8小时内,1天内,1周内符合特定条件(比如浏览数/获赞数)的数据.

8小时内: where time > (time()-3600*8) order by 浏览数 desc limit 20;
1天内: where time > (time()-3600*24) order by 浏览数 desc limit 20;
1周内: where time > (time()-3600*24*7) order by 浏览数 desc limit 20;
###[同样php代码不同服务器执行消耗内存不一致](https://segmentfault.com/q/1010000008514882)
PHP代码里可以用memory_get_usage/memory_get_peak_usage获取内存使用情况,用getrusage获取CPU使用情况.注意,memory_get_usage不包括PHP进程本身占用的内存.

要看PHP进程本身占用的内存,可以用top或者ps aux|head -n1 && ps aux|grep php-fpm
###[如何在list中插入不重复的数据？](https://segmentfault.com/q/1010000008519477)
sorted set肯定比你遍历查重快的，sorted set只用O(log(N))就能插入一个，而你要O(N)，差了一个数量级。

要方便地实现，可以把sorted set和一个普通的键值(counter)对结合一起用。

先incr counter，用它的结果作为权重（分数），然后ZADD到sorted set，要用NX选项，不更新原有的key。
###[php限制用户调用app接口的刷新频率，1秒不能达到20](https://segmentfault.com/q/1010000008515601)
nginx层面做限制。
可以使用openresty,用lua来写，每次请求都接口自增一次访问记录，可以把值记录到redis中。
在单位时间内达到最大限制，返回错误的提示码。
在http里server前加入:
limit_req_zone $binary_remote_addr zone=allips:10m rate=20r/s;
在server里加入:
limit_req zone=allips burst=5 nodelay;
超过每秒20次连接,则把IP加入黑名单,直接deny掉这些IP.
###[Laravel Session 失效 Case](https://mikecoder.cn/post/142)
```js
Route::group(['prefix' => 'Test', 'namespace' => 'Test'], function() {
    Route::get('/', function() {
        Session::set('mike', 'mike');
        d(Session::get('mike')); // d($value) 就是 var_dump 出来
    });
}); 
在 route 中添加 web 中间件即可。如最上面的代码修改成:

Route::group(['middleware' => 'web', 'prefix' => 'Test', 'namespace' => 'Test'], function() {
    Route::get('/', function() {
        Session::set('mike', 'mike');
        d(Session::get('mike')); // d($value) 就是 var_dump 出来
    });
}); 
```
###[基于redis的发布订阅实战](https://laravel-china.org/articles/3884)
```js
//发布
  $redis = new \Redis();
  $redis->connect('127.0.0.1', 6379);
  $redis->publish('msg', '来自msg频道的推送');
  echo "msg频道消息推送成功～ \n";
  $redis->close();
  $redis = new \Redis();
  $redis->pconnect('127.0.0.1', 6379);
  //订阅
  echo "订阅msg这个频道，等待消息推送... \n";
  $redis->subscribe(['msg'], 'callfun');
  function callfun($redis, $channel, $msg)
  {
   print_r([
     'redis'   => $redis,
     'channel' => $channel,
     'msg'     => $msg
   ]);
  }
```
###[python模块有缓存，import一次后再import，模块顶级作用域的代码不会再执行](https://segmentfault.com/q/1010000008524209)
```js

```
###[Python LEGB 原则](https://zhuanlan.zhihu.com/p/25223919)
```js
def l(list):
    def d():
        return list
    return d
    
 #运行
l = l([1,2,3,4])
print l()
def l(list):
    def d(list):
        return list
    return d
 
#运行
l = l([1,2,3,4])
#提示错误
print l()

#正常
print l([1,3,5,7,9])
```
###[javascript里的循环定时](https://segmentfault.com/q/1010000008524620)
```js
for(var i = 0; i < 5; i++) {
    setTimeout(function() {
        console.log(i);  
    }, 1000);
}
let timer = setTimeout(function() {console.log(2)}, 2)
> undefined
console.log(timer)
> 225
setTimeout方法的返回值就是一个timeoutID，这里的225就是ID
```
###[linux如何让一个文件在哪都能执行](https://segmentfault.com/q/1010000008515141)
在abc.py 第一行加一句

#!/usr/bin/env python
然后在$HOME创建一个文件夹，一般叫做bin,然后在$HOME/.bashrc中添加一句export PATH=$HOME/bin:$PATH。
然后,重启shell或者执行source ~/.bashrc

# 或者 mv
cp /path/to/abc.py ~/bin
cd ~/bin
chmod a+x abc.py
这样就可以直接用abc.py执行了,不用加python
你把abc.py放到PATH内，给它可执行权限，然后在任意目录中敲abc.py然后回车，就执行了
###[一道正则表达式问题](https://segmentfault.com/q/1010000008513484)
(^|W)'匹配的结果就是前面是字符串开头或者非单词字符（单词字符是指[^a-zA-Z0-9_]）的单引号；
'(W|$)匹配的是后面是字符串结尾或者非单词字符的单引号。
var text = "'I'm the cook,' he said, 'it's my job.'";
function replacer(match,$1,$2){
    console.log('match:['+match+']','$1:['+$1+']','$2:['+$2+']');
    $1 = $1 || '';
    $2 = $2 || '';
    return $1+'"'+$2;
}
console.log(text.replace(/(^|\W)'|'(\W|$)/g, replacer));

//match:['] $1:[] $2:[undefined]
//match:[,'] $1:[,] $2:[undefined]
//match:[ '] $1:[ ] $2:[undefined]
//match:[.'] $1:[.] $2:[undefined]
//"I'm the cook," he said, "it's my job."
也就是说只匹配到了一个括号，所以$1是有值的，$2只是空字符串
###[JS是单线程](https://segmentfault.com/q/1010000008514466)
```js
1、 JS是单线程，代码执行不会从一段代码突然打断，跳转到另一端代码去执行。
paginButton.click（...）的意思是定义一个函数，其代码是xxx，并且绑定为事件处理函数。所以执行代码foo()的时候，x = paginButton.index($(this)); 这一句并不会执行。 而上面这段代码还没有执行完，不会突然跳转到这个实践处理函数，所以a = foo();即a=x先执行。
等这段代码执行完了，在点击，出发事件处理函数的执行，才执行x = paginButton.index($(this));

所以，a=x在x = paginButton.index($(this));之前。

2 、在 JS 所有对象类型的变量都是一个引用，其中保存的不是具体的那个对象，而是一个指针，指向实际保存的对象。

x = paginButton.index($(this)); 意思是x指向后面生成的那一个对象。
a = x;让 a 和 x 指向了同一个对象。
然后 x = new Object 这样x 指向了新的对象，而a还是原来的值。

如果先执行a=x; a 和x 都指向了初始的那个对象，然后x = paginButton.index($(this)); x 指向了新的对象。可是a还是指向原来的对象。

但是，如果 newArr。
先执行，a=newArr 这样，a和newArr 指向了同一个对象。
然后给newArr指向的对象添加值(而不是让newArr指向新的值)，也就是给a指向的对象添加值(它们指向同一个对象)。

var x = {"0":1};
var a = x;
x[0] = 2;
a[0]; // 2
x = new Object();
x[0] = 3;
a[0]; // 2
```
###[即时执行匿名函数调用全局作用](https://segmentfault.com/q/1010000008515137)
```js
var a = 10;
function foo() {
  console.log(a)
}

foo();

(function () {
  var a = 20
  foo()
})();

(function (fn) {
  var a = 30
  fn()
})(foo);
```
###[php 求深度](https://segmentfault.com/q/1010000008537364)
```js
CREATE TABLE `tp_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tp_user` (`id`, `parent_id`, `name`) VALUES
(1, null, 'alpha1'),
(2, 1, 'alpha2'),
(3, 1, 'alpha3'),
(4, 1, 'alpha4'),
(5, 2, 'alpha5'),
(6, null, 'alpha6'),
(7, 3, 'alpha7'),
(8, 3, 'alpha8'),
(9, 5, 'alpha9'),
(10, 5, 'alpha10'),
(11, 8, 'alpha11');

ALTER TABLE `tp_user`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `id` (`id`);

```
###php二维数组去除特定键的重复项
```js
//二维数组去除特定键的重复项
    public function array_unset($arr,$key){   //$arr->传入数组   $key->判断的key值
        //建立一个目标数组
        $res = array();      
        foreach ($arr as $value) {         
           //查看有没有重复项
           if(isset($res[$value[$key]])){
                 //有：销毁
                 unset($value[$key]);
           }
           else{
                $res[$value[$key]] = $value;
           }
           //if(!isset($res[$value[$key]])){
             //$res[$value[$key]] = $value;
           //}
        }
        return $res;
    }
    //二维数组去掉重复值
function array_unique_fb($array2D){  
	foreach ($array2D as $v){
		$v=join(',',$v);//降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[]=$v;
	}
	$temp=array_unique($temp);//去掉重复的字符串,也就是重复的一维数组
	foreach ($temp as $k => $v){
		$temp[$k]=explode(',',$v);//再将拆开的数组重新组装
	}
	return $temp;
}
//二维数组去掉重复值 并保留键值 http://www.jb51.net/article/27738.htm
function array_unique_fb($array2D) 
{ 
foreach ($array2D as $k=>$v) 
{ 
$v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串 
$temp[$k] = $v; 
} 
$temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组 
foreach ($temp as $k => $v) 
{ 
$array=explode(",",$v); //再将拆开的数组重新组装 
$temp2[$k]["id"] =$array[0]; 
$temp2[$k]["litpic"] =$array[1]; 
$temp2[$k]["title"] =$array[2]; 
$temp2[$k]["address"] =$array[3]; 
$temp2[$k]["starttime"] =$array[4]; 
$temp2[$k]["endtime"] =$array[5]; 
$temp2[$k]["classid"] =$array[6]; 
$temp2[$k]["ename"] =$array[7]; 
} 
return $temp2; 
} 
```
###[事件有两种触发类型：一种是冒泡型；一种是捕获型](https://segmentfault.com/q/1010000008482488)
```js
冒泡型事件：从目标元素开始触发，然后触发其父元素上定义的同类型事件，再然后父元素的父元素...
捕获型事件：从目标元素的父元素上定义的同类型事件开始触发，然后其子元素，直到触发目标元素上定义的事件

对于你问题描述中说的 事件代理 ，应该是指不直接通过： domEle.addEventListener(event , fn , type) 这种方式定义，而是通过 loginEvent(domEle , event , fn , type) 这种方式去定义，就是委托第三方来定义事件。

如果是这样的话，你的这个现象应该类似下面这种：

// 事件代理（第三方注册事件的函数|对象）
function loginEvent(domEle , event , fn , type){
    domEle.addEventListener(event , fn , type);
}

// 注意第三个参数：表示是在捕获阶段触发
btn.addEventListener('click' , function(){
    // 按下这个按钮的时候：从 btn 的最顶级父元素上的 click 事件开始
    // 触发，然后直到 btn 上定义的 click 事件触发
    // 事件代理开始工作.....
    loginEvent(domEle , event , fn , type);    
} , true);
```
###[给 PHP 使用者的 Lua 教程](http://picasso250.github.io/2016/01/27/lua-for-php.html)
###[PHP 错误处理](http://picasso250.github.io/2014/12/03/PHP-error.html)
```js
$trace = implode("\n".' <== ', array_map(function($e){
        $func = isset($e['class']) ? "$e[class]::$e[function]" : $e['function'];
        return "$e[file]:$e[line] $func";
    }, debug_backtrace()));
echo "$trace";
不要使用 trigger_error 函数, PHP Web开发用 Exception 更合适
PDO 中, 有三种错误模式

PDO::ERRMODE_SILENT
PDO::ERRMODE_WARNING
PDO::ERRMODE_EXCEPTION
默认是 PDO::ERRMODE_SILENT 坑! 所以, 我们还是将他设为 PDO::ERRMODE_EXCEPTION

$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
json_decode 时, 可能会发生错误, 使用 json_last_error 可以获取错误. 为了严谨, 我们总是使用

function try_json_decode($str)
{
    $arr = json_decode($str, true);
    if (json_last_error()) {
        throw new Exception("json decode error", json_last_error());
    }
    return $arr;
}
error_log() 函数可以记录日志.

error_log("message");
可以记录到当前的日志的位置(具体来说, 就是error_log配置项的位置). 如果想要记录到一个指定文件

error_log("message\n", 3, 'log_file');
3 指的是类型 记录到文件, 注意一定要有换行符, error_log() 函数不会自动添加.
```
###[Mysql 和 缓存](http://picasso250.github.io/2015/11/16/MySQL-cache.html)
```js
SELECT r.*, u.user_name FROM r join u using(user_id)
            WHERE r.user_id != 0
            ORDER BY r.create_time DESC LIMIT 11
	    class Cachable
{
	function __call($name, $args)
	{
		if (preg_match('/(\w+)Cachable$/', $name, $m)) {
			$method = $m[1];
			if (method_exists($this, $method)) {
				$key = $name.implode(',', $args);
				if ($data = $cache->get($key)) {
					return $data;
				}
				$data = $this->$method(...$args);
				$cache->set($key, $data, 5); // 5 s
				return $data;
			} else {
				throw new Exception("$method is not Cachable", 1);
			}
		} else {
			throw new Exception("bad method call", 1);
		}
	}
}
```
###[详细论述联表查询与分步查询的优缺点](https://segmentfault.com/q/1010000008549113)
联表查询的优点：

简化代码逻辑，通过适当的注释可以轻松理解。
减少数据库查询次数，通常情况下，查询速度更快。
分步查询的优点：

能有效理由数据库缓存，提高查询效率，减少数据库压力。
数据库表结构发生变化时，代码受到的影响比较少。
###[统计出数组里相同名称的数量之和](https://segmentfault.com/q/1010000008548967)
```js
var res = [{
    "name": "apple",
    "number": "15",
    "date": "2017/1/2",
}, {
    "name": "orange",
    "number": "25",
    "date": "2017/1/4",
}, {
    "name": "apple",
    "number": "4",
    "date": "2017/1/7",
}, {
    "name": "banana",
    "number": "1",
    "date": "2017/1/1",
}];

var res = [{
    "name": "apple",
    "number": "19",
}, {
    "name": "orange",
    "number": "25",
}, {
    "name": "banana",
    "number": "1",
}];

let tmp = {}
res.forEach(v => tmp[v.name] = (tmp[v.name] || 0) + Number(v.number))
res = Object.keys(tmp).map(name => ({ name, number: tmp[name]}))
console.log(res)
    function parseArr(arr){
        var nameArr=[];
        var result=[]
        arr.forEach(function(item){
            var i
            if((i=nameArr.indexOf(item.name))>-1){
                console.log(result,i)
                result[i].number=Number(result[i].number)+Number(item.number);
            }else{
                nameArr.push(item.name);
                result.push({
                    name:item.name,
                    number:item.number
                })
            }
        })
        return result
    }
```
###[php两个数组合并](https://segmentfault.com/q/1010000008532899)
```js
$list1=[
    ['name'=> '好好','float_minimum_order_amount'=> '1'],
    ['name'=> '新保挪威三文鱼','float_minimum_order_amount'=> '2'],
    ['name'=> '天天','float_minimum_order_amount'=> '3'],
    ['name'=> '向上','float_minimum_order_amount'=> '4'],
    ['name'=> '哈哈','float_minimum_order_amount'=> '6']
];
$list2=[
    ['name'=> '哈哈','float_minimum_order_amount'=> '5'],
    ['name'=> '新保挪威三文鱼','float_minimum_order_amount'=> '8'],
    ['name'=> '天123天','float_minimum_order_amount'=> '9'],
    ['name'=> '向dd上','float_minimum_order_amount'=> '10'],
    ['name'=> '哈dd哈','float_minimum_order_amount'=> '11']
];
//第一步合并数据
$array = array_merge($list1, $list2);
//第二步 降维成一维数组
$array_1 = array_map('implode',$array);
//第三步 将一维数组作为键,二维数组作为值, 合并为新数组,因为重复键会直接被覆盖,故自动排重
//array_values 将数组由关联数组转换为枚举数组 over
$array_2 = array_values(array_combine($array_1, $array));

```
###[如何取出大字符串中指定的小字符串](https://segmentfault.com/q/1010000008550134)
```js
/**
 * @param target    123453423423
 * @param token     4
 */
function transform (target, token){
    return (target + '').split(token).map(item => `</span>${item}<span>`).join(token).slice("</span>".length, -"<span>".length);
}
function transform (target, token) {
    return (target + '').replace(new RegExp(token, 'g'), `<span>${token}</span>`);
}
```
###[js如何跨浏览器获取浏览器视口大小](https://segmentfault.com/q/1010000008548366)
document.documentElement.clientHeight
手边没ie7、8没法测试效果。但是一般我们做此设置

html,body{
    width:100%;
    height:100%
}
然后用document.body.clientHeight就行了

然后高程上document.compatMode == 'CSS1Compat'内的应该是针对doctype声明不是!doctype html的。所以ie7、8还是会走else。你可以加个断点或者console.log试试
###[npm 非管理员权限 全局安装问题](https://segmentfault.com/q/1010000008545037)
npm config set prefix "C:\\Users\\<用户名>\\.nodejs\\node_global"
npm config set cache "C:\\Users\\<用户名>\\.nodejs\\node_cache"
环境变量NODE_PATH改到C:\Users\<用户名>\.nodejs\node_global\node_modules

没权限就把路径改到有权限的地方呗

如果安装后成功却运行不了,记得把C:\Users\<用户名>\.nodejs\node_global加到PATH里
###[基于浏览器安全的限制，在https下是无法发起http请求的](https://segmentfault.com/q/1010000008547583)
在有http请求的时候，将页面从https重定向到http 这种做法比较恶心……
使用服务器端代理，对于http请求由页面发到服务器端，再有服务器代理发出请求
###[利用python如何将无限分类结构的数据](https://segmentfault.com/q/1010000008541784)
```js
import json
source=[
    {"name":"my document","id":1 , "parentid": 0 },
    {"name":"photos","id":2 , "parentid": 1 },
    {"name":"Friend","id":3 , "parentid": 2 },
    {"name":"Wife","id":4 , "parentid": 2 },
    {"name":"Company","id":5 , "parentid": 2 },
    {"name":"Program Files","id":6 , "parentid": 1 },
    {"name":"intel","id":7 , "parentid": 6 },
    {"name":"java","id":8 , "parentid": 6 },
]

def getChildren(id=0):
    sz=[]
    for obj in source:
        if obj["parentid"] ==id:
            sz.append({"id":obj["id"],"text":obj["name"],"children":getChildren(obj["id"])})
    return sz

print json.dumps(getChildren())
[
  {
    "text": "my document",
    "id": 1,
    "children": [
      {
        "text": "photos",
        "id": 2,
        "children": [
          {
            "text": "Friend",
            "id": 3,
            "children": [ ]
          },
          {
            "text": "Wife",
            "id": 4,
            "children ": [ ]
          },
          {
            "text": "Company",
            "id": 5,
            "children": [ ]
          }
        ]
      },
      {
        "text": "Program Files",
        "id": 6,
        "children": [
          {
            "text": "intel",
            "id": 7,
            "children": [ ]
          },
          {
            "text": "java",
            "id ": 8,
            "children": [ ]
          }
        ]
      }
    ]
  }
]
```
###[图片一般一怎么的形式存放在服务器中](https://segmentfault.com/q/1010000008549597)
是问几个浏览器(手机浏览器)支持 dataurl:base64 和 blob://
这些数据存数据库，本身就是对数据库的不负责，还受限于数据库I/O的性能瓶颈？
如何使用nginx的静态文件性能？
如果以后要支持CDN怎么办，上面格式你能做CDN吗？
实时裁剪图片，岂不是要先解码，然后裁切无故耗费性能
能顺利的做分布式 Filesystem 吗?
能顺利双击打开查看是什么？
剔除重复的文件，计算MD5等，这些格式可以快速做到吗？
文件就是文件，无故耗费性能，何必。
###[php正则替换成数组里面的值](https://segmentfault.com/q/1010000008550214)
```js
[]要加反斜杠转义，下面这个可以生效，其实这边可以不用正则替换，你用str_replace就能实现

$arr = array('微笑','吃饭','睡觉','看书','玩手机','做梦');

$arrt=array_flip($arr);
$str='你好啊微笑[微笑]，吃饭了吗[吃饭]';
foreach($arrt as $aKey => $aVal) {
    $pattern = "/\[$aKey\]/";
    $str=preg_replace($pattern,"<img src=./img/" . $aVal . '.jpg' . '>', $str);
}

var_dump($str);exit;
$arr = array('微笑','吃饭','睡觉','看书','玩手机','做梦');foreach ($arr as $key => $value) {

$arrt[$key]='['.$value.']';
}
$arrt=array_flip($arrt);
$str='你好啊微笑[微笑]，吃饭了吗[吃饭]';
foreach($arrt as $aKey => $aVal) {

$str = str_replace($aKey, "<img src=./img/" . $aVal . '.jpg' . '>', $str);
//$str=preg_replace($pattern,"<img src=./img/" . $aVal . '.jpg' . '>', $str);
}

str_replace效率更快
```
###[php把时间戳以小时结算](https://segmentfault.com/q/1010000008551488)
```js
$start=1488484037；
$end=1488504037；
$difference=$end-$start;
//小时
$h=intval($difference/3600);
$i=intval(($difference-$h*3600)/60);
$s=$difference-$h*3600-$i*60;
echo '耗时'.$h.'小时,'.$i.'分,'.$s.'秒';
/**
 * [format_date 格式化时间]
 * @param  [type] $start_time [开始时间]
 * @param  [type] $end_time   [结束时间]
 * @return [type]             [string]
 */
function format_date($start_time, $end_time){
    $t = $end_time - $start_time;

    $f = [
        // '31536000' => '年',
        // '2592000'  => '个月',    
        // '604800'   => '星期',
        // '86400'    => '天',
        '3600'        => '小时',
        // '60'       => '分钟',
        // '1'        => '秒'
    ];
    foreach ($f as $k=>$v)    {
        if (0 != $c = floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
}


```
###[理解原型模式](https://segmentfault.com/q/1010000008546340)
```js
a) Prototype:每一个函数都包含一个prototype属性，这个属性指向的是一个对象的引用；而对已每一个函数（类）的实例都会从prototype属性指向的对象上继承属性，换句话说通过同一个函数创建的所有对象都继承一个相同的对象。b) 通过new 关键字和构造函数创建的对象的原型，就是构造函数的prototype指向的那个对象

每一个函数的Prototype属性指向的对象都包含唯一一个不可枚举属性constructor,该属性的值是这么一个对象：它指向了它所在的构造函数。
   var obj = function () {
        this.a = 'a';
    }
    obj.prototype.say = function () {
       console.log("say")
    }
    var nobj = new obj();
    console.log(nobj.constructor===obj);//TRUE
    console.log(nobj)

    var OP=function(){
        this.a='a'
    }
    OP.prototype={
    /*让constructor指向OP解决办法
      constructor: OP,*/
        say:function(){
            console.log("say")
        }
    };
    var p =new OP();
    console.log(p.constructor===OP)//FALSE
```
###[轻量的博客程序，支持markdown的](https://segmentfault.com/q/1010000008536559)  
http://topspeedsnail.com/static-website-generators_or_tools/
###[ajax获取评论的问题](https://segmentfault.com/q/1010000008543130)
如果每条数据有个id就很好解决，如果只是你说明的问题的话，解决方案可以搞个临时变量记录已经插入多少条了，然然后，第二次的时候在减去第一次插入的条数，然后剩下的在插入数据，然后更新临时变量，一次类推就行了。
```js
ajax 相应的参数有 url（请求地址），page（页数），showNum（每页显示数）。请求的最终地址就像这样：

http://xx.com/comment?page=2&showNum=10

而有些网站则是直接通过第N条开始取的，它后台默认指定了每页显示的数目(showNum)，比如说豆瓣的影评：

https://movie.douban.com/subject/3792799/reviews?start=40

此时，后台只需要通过数据库查找语句 skip(start).limit(showNum) 来跳过前面 start 条，然后获取之后的 showNum 条。

按照你上面的意思，好像是不通过ajax请求后台。只是前端 mock 一大堆数据，一次性把这个数据全部请求回来，然后通过事件分批展示（比如总共有50条，每次点击按钮展示新的10条）。

var data = list, // list 为返回的数据列表
    dataSize = data.length,
    showNum = 10,
    page = 0,
    loadData = [];

for (var i = 0; i < dataSize; i += showNum) {
    loadData.push(data.slice(i, i + showNum));
}
loadData 是一个二维数组，它的每项是一个长度为 showNum 的数组。

最后，通过事件触发数据按批渲染：

btn.addEventListener('click', function() {
    page += 1;
    render(loadData[page]);
}, false);
```
