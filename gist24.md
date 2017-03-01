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
