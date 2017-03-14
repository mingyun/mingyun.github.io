###[遭遇php的in_array低性能08/28/2013](http://www.zendstudio.net/archives/php-in_array-s-low-performance/?utm_source=tool.lu)
```js
$y="1800";
$x = array();
for($j=0;$j&lt;2000;$j++){
        $x[]= "{$j}";
}
 
for($i=0;$i&lt;3000;$i++){
        if(in_array($y,$x)){
                continue;
        }
}
strace -ttt -o xxx /usr/local/php/bin/php test.php
ltrace -c /usr/local/php/bin/php test.php

in_array这种松比较，会将两个字符型数字串先转换为长整型再进行比较，却不知性能就耗在这上面了。
最简单的就是为in_array加第三个参数为true，即变为严格比较，同时还要比较类型，这样避免了PHP自作聪明的转换类型
面对大数组查询的时候，在PHP中应该尽量采用key查询而不是value查询。函数in_array的性能是不好的。
所以文中的例子代码如果改为下面的，应该会快很多：
<?php
$y="1800";
$x = array();
for($j=0;$j<2000;$j++){
$x[{$j}]= true;
}
for($i=0;$i
总之，大数组查询，用in_array函数是个糟糕的选择。应该尽量用isset函数或array_key_exists函数来替代 。in_array函数的复杂度是O(n)，而isset函数的复杂度是O(1)。 大数据都不要用in_array，要么先array_flip,isset($arr[$key]),要么strpos

$elemCount = 1000;
$repeatCount = 1000000;
 
$vArr = range(1, $elemCount);
$kArr = array_flip($vArr);
 
$start = microtime(true);
for ($i = 0; $i < $repeatCount; $i++) {
    in_array($i, $vArr);
}
$inArrTime = microtime(true) - $start;
echo "in_array:{$inArrTime}<br>";
 
$start = microtime(true);
for ($i = 0; $i < $repeatCount; $i++) {
    array_key_exists($i, $kArr);
}
$keyTime = microtime(true) - $start;
echo "array_key_exists:{$keyTime}<br>";
 
$start = microtime(true);
for ($i = 0; $i < $repeatCount; $i++) {
    isset($kArr[$i]);
}
$issetTime = microtime(true) - $start;
echo "isset:{$issetTime}<br>";

in_array:1.6679329872131
array_key_exists:0.23828101158142
isset:0.022069931030273
```
###[第三方微信登录和支付开发记录](https://blog.skyx.in/archives/348/)
微信的网页应用、移动应用、公众号的上限都是10个，所有同一个账号下的应用获取到的 union_id 是相同的，open_id 不同，所以需注意应用数量是否会超过上限。
微信登录目前只有APP登录、扫码登录和公众号登录三种登录方式，在微信浏览器内打开网页使用的是公众号登录的方式，其他浏览器只能使用扫码登录，换句话说目前移动端非微信浏览器打开的网页基本无法使用微信登录。 通过微信自带浏览器打开网页时唤起微信授权登录页面进行授权登录。


https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa77178c0a05b6498&redirect_uri=http%3A%2F%2Fh5.2144.com%2Fsite%2Fauth%3Fauthclient%3Dweixin-mp&scope=snsapi_userinfo&response_type=code

https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa77178c0a05b6498&response_type=code&redirect_uri=http%3A%2F%2Fh5.2144.com%2Fsite%2Fauth%3Fauthclient%3Dweixin-mp&scope=snsapi_userinfo

上面两个链接除了参数的顺序不同之外完全相同，但是上面那个链接可以正常显示授权页面，下面那个则不可以
###[PHP修改apk文件的comment实现](https://blog.skyx.in/archives/319/)
```js
$comment = '123测试';
 
$file = fopen('R:\1.apk', 'r+');
fseek($file, -2, SEEK_END);
fwrite($file, pack('s', mb_strlen($comment, '8bit')));
fwrite($file, $comment);
fclose($file);
 
$zip = new ZipArchive();
 
$zip->open('R:\1.apk');
var_dump($zip->getArchiveComment());
//$zip->setArchiveComment($comment);
//var_dump($zip->getArchiveComment());
$zip->close();
```
###[使用phpbrew管理php版本](https://blog.skyx.in/archives/322/)
curl -L -O https://github.com/phpbrew/phpbrew/raw/master/phpbrew
chmod +x phpbrew
sudo mv phpbrew /usr/bin/phpbrew
###[开源一个简单轻量的高性能PHP路由实现](https://blog.skyx.in/archives/303/)
```js
Github:https://github.com/takashiki/cdo
$do = new \Mis\Cdo();
 
$do->get('/', function () {
    echo 'hello world';
});
 
$do->post('/', function () {
    $name = isset($_POST['name']) ? $_POST['name'] : 'world';
    echo "hello {$name}";
});
 
$do->any('/(\d+)', function ($id) {
    echo $id;
});
 
/**
 * When using named subpattern, order of parameters is not matter.
 * eg. /book/2
 */
$do->any('/(?P<type>\w+)/(?P<page>\d+)', function ($page, $type) {
    echo $type.'<br>'.$page;
});
 
$do->run();
```
###[使用db2md生成表结构](https://blog.skyx.in/archives/275/)
https://github.com/index0h/node-db2md
```js
这个简直是神器，写数据库文档再也不用头疼了。

首先要安装node和npm，这就不多说了。然后使用npm安装db2md：
npm install db2md -g
安装完成后创建配置文件db2md.json，示例如下：

{
    "user": "root",
    "pass": "123456",
    "database": "test",
    "tables": ".*"
}
配置完成后即可以开始导出：


db2md -o tables.md
```
###[极简图床、sm.ms图床curl上传图片](https://blog.skyx.in/archives/164/)
```js
$data = base64_encode(file_get_contents('test.jpg'));
 
$ch = curl_init('http://yotuku.cn/upload?name=');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: text/plain',                                                                                
    'Content-Length: ' . strlen($data))                                                                       
);                                                                                                                   
 
$result = curl_exec($ch);
echo $result;
$url = 'https://sm.ms/index.php?act=upload';
$image = curl_file_create(realpath('test.jpg'), 'image/jpg', 'test.jpg');
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['smfile' => $image]);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
 
```
###[linux服务器上mysql无法远程连接的可能原因](https://blog.skyx.in/archives/152/)
```js
grant all privileges on *.* to root@"%" identified by "password" with grant option;
 
flush privileges;
第一个代表数据库名；第二个代表表名。root：授予用户账号。“%”：表示授权的用户IP，%代表任意的IP地址都能访问。“password”：分配账号对应的密码。第二行命令是刷新权限信息
如果telnet不通，我们先用netstat查看3306端口是否已监听所有ip地址的请求：


netstat -an | grep 3306
如果输出为


tcp        0      0 127.0.0.1:3306            0.0.0.0:*               LISTEN
则说明只监听了本地连接。解决方法：修改/etc/mysql/my.cnf文件。打开文件，找到下面内容：


# Instead of skip-networking the default is now to listen only on
# localhost which is more compatible and is not less secure.
bind-address  = 127.0.0.1
把上面bind-address = 127.0.0.1这一行注释掉或者把127.0.0.1换成合适的IP。
重新启动mysql再用netstat检测是否为：


tcp        0      0 0.0.0.0:3306            0.0.0.0:*               LISTEN
如果这样之后还是telnet不通，那基本就是防火墙的问题了，查看iptables的rules文件里是否包含


-A INPUT -p tcp -m tcp --dport 3306 -j ACCEPT
如果没有该规则的话加入该规则后重启iptables就可以了。
```

###[PHP解析\x22之类的十六进制字符串代码](https://blog.skyx.in/archives/192/)
function parse_hex($string) {
    return preg_replace_callback(
        "(\\\\x([0-9a-f]{2}))i",
        function($a) {return chr(hexdec($a[1]));},
        $string
    );
}

###[开源一个简单的短网址程序Ourls](https://blog.skyx.in/archives/183/)
在线演示地址：http://skyx.in/。

github地址：https://github.com/takashiki/Ourls
###[php读写crx文件](https://blog.skyx.in/archives/264/)
###[PHP Warning: Module 'modulename' already loaded in Unknown on line 0 产生原因及解决方法](https://blog.skyx.in/archives/288/)
该扩展在编译 PHP 时已经 enable 了，但是在 php.ini 中又写了动态调用该扩展的 so 文件。

这时候我们可以查看一下 phpinfo ：
 
php -i | grep 'modulename'
php -i | grep 'php.ini'
然后去对应的 php.ini 文件中去掉该扩展即可
###[PHPStorm中使用php-cs-fixer进行自动代码格式化](https://blog.skyx.in/archives/207/)
composer global require fabpot/php-cs-fixer
jsonp接口xss防范 
只要在header里输出类型设置为javascript即可：

header('Content-type: text/javascript;charset=utf-8');
git config --global core.autocrlf false Windows下git commit时设置不自动将LF转换为CRLF

*nix系统的换行符为LF(\n)，而Windows的换行符为CRLF(\r\n)，所以在Windows上的默认配置的Git会在git pull时将LF换行符换为CRLF，而git push时会再将换行符换回去。然而，当文件中含有中文时Git的这个功能会出现问题，pull时能正常转换，push时却无法正常执行，这时就会出现文件比对时整个文件内容都改变了，但肉眼却无法看出。

解决方法很简单，直接执行以下命令进行全局配置就可以了：

 
git config --global core.autocrlf false
###[Fork过来的项目拉取源项目的更新](https://blog.skyx.in/archives/276/)
git remote add upstream https://github.com/lj2007331/lnmp.git
在每次 Pull Request 前做如下操作，即可实现和上游版本库的同步。

 
git remote update upstream
git rebase upstream/{branch name}
注意的是在rebase操作之前，一定要将checkout到{branch name}所指定的branch
git Push代码
###[PHP源码阅读，PHP设计模式-胖胖的空间](http://www.phppan.com/2014/02/php-var-compare/?utm_source=tool.lu)
###[git发布脚本](http://stackoverflow.com/questions/279169/deploy-a-project-using-git-push?utm_source=tool.lu)
###[An object oriented PHP driver for FFMpeg binary](https://github.com/PHP-FFMpeg/PHP-FFMpeg?utm_source=tool.lu)
$ composer require php-ffmpeg/php-ffmpeg
```js
$ffmpeg = FFMpeg\FFMpeg::create();
$video = $ffmpeg->open('video.mpg');
$video
    ->filters()
    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
    ->synchronize();
$video
    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
    ->save('frame.jpg');
$video
    ->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
    ->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
    ->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm');
```
###[lxml 解析 html 以爬取 豆瓣电影主页本周口碑榜](http://blog.csdn.net/tanzuozhev/article/details/50442243)
```js
import lxml.html
str_url = 'http://movie.douban.com/'
request = urllib.request.Request(str_url)
html_text = urllib.request.urlopen(request).read()
root = lxml.html.fromstring(html_text)
# 获取本页面所有项目名称
movies_list = [a.text for a in  root.cssselect('div.billboard-bd tr td a')]
print(movies_list)
# 获取所有电影超链接
movies_href = [a.get('href') for a in  root.cssselect('div.billboard-bd tr td a')]
print(movies_href)
```


###[51job和智联招聘的自动刷新简历脚本](http://www.woowen.com/php/2014/09/20/51job%E5%92%8C%E6%99%BA%E8%81%94%E6%8B%9B%E8%81%98%E8%87%AA%E5%8A%A8%E5%88%B7%E6%96%B0%E7%AE%80%E5%8E%86%E8%84%9A%E6%9C%AC/)
```js
dl("php_curl.dll");

$ifupdate = false;

$rand = mt_rand(1, 5);

if($rand == 5)
$ifupdate = true;

if($ifupdate)
{
//智联招聘
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "...填写刷新简历ajax链接...");

curl_setopt($ch,CURLOPT_COOKIE,"JSpUserInfo=...填写cookie参数...");

$result = curl_exec($ch);

curl_close($ch);

//前程无忧
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "...填写刷新简历ajax链接...");

curl_setopt($ch,CURLOPT_COOKIE,"51job=...填写cookie参数...");

$result = curl_exec($ch);

curl_close($ch);

}else
{
echo 'rand not hit';
}

在CURLOPT_URL参数中写上你刷新简历时访问的ajax url 的地址.
在CURLOPT_COOKIE中写上你浏览器cookie中对应参数的value.
然后在linux中使用将脚本1小时一次的执行起来就可以了.
```

###[PHP内核](http://www.imsiren.com/archives/tag/php%e5%86%85%e6%a0%b8)
###[Nginx PHP 使用 limit_req,limit_conn 限制并发，外加白名单](http://www.imsiren.com/archives/1230)
nginx/conf/limit/whiteip.conf 里面是你要忽略限制的白名单IP地址
###[跨浏览器下PHP下载文件名中的中文乱码问题](http://www.cnblogs.com/jiji262/archive/2012/09/21/2697205.html?utm_source=tool.lu)
```js
$ua = $_SERVER["HTTP_USER_AGENT"];

$filename = "中文 文件名.txt";
$encoded_filename = urlencode($filename);
$encoded_filename = str_replace("+", "%20", $encoded_filename);

header('Content-Type: application/octet-stream');

if (preg_match("/MSIE/", $ua)) {
    header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
} else if (preg_match("/Firefox/", $ua)) {
    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
} else {
    header('Content-Disposition: attachment; filename="' . $filename . '"');
}

print 'ABC';
```
###[JavaScript获取服务器时间](http://amals.org/?id=216)
```js
var xhr = null;
if(window.XMLHttpRequest){
   xhr = new window.XMLHttpRequest();
}else{
 // ie
   xhr = new ActiveObject("Microsoft")
}
// 通过get的方式请求当前文件
xhr.open("get","/");
xhr.send(null);
// 监听请求状态变化
xhr.onreadystatechange = function(){
   var time = null,curDate = null;
   if(xhr.readyState===2){
       // 获取响应头里的时间戳
       time = xhr.getResponseHeader("Date");
       console.log(xhr.getAllResponseHeaders())
       curDate = new Date(time);
       console.log("服务器时间："+curDate.getFullYear()+"-"+(curDate.getMonth()+1)+"-"+curDate.getDate()+" "+curDate.getHours()+":"+curDate.getMinutes()+":"+curDate.getSeconds());
   }
}
```
###[Laravel会成为最成功的PHP框架](http://www.hoehub.com/PHP/141.html?utm_source=tool.lu)
模块化和可扩展性 中间件 各种集成 事件处理 对象关系化映射（ORM）


###[PHP 实现 短URL](http://www.imsiren.com/archives/459)
```js
function base62($x){
    $show='';
    while($x>0){
        $s=$x%62;
        if($s>35){
            $s=chr($s+61);
        }elseif($s>9&&$s<=35){
            $s=chr($s+55);
        }
        $show.=$s;
        $x=floor($x/62);
    }
            return $show;
}
function urlShort($url){
    $url=crc32($url);
    $res=sprintf('%u',$url);
    return base62($res);
}
echo urlShort("http://www.imsiren.com");
```
###[redis 应用场景](http://www.imsiren.com/archives/982)
将redis的List用作队列，这个很轻量级，不用引入别的队列服务器，缺点是可能会丢失数据，因为其持久化方案是redis通用的aof或者rdb方式

2.将排好序的实体id放到LIST中，然后以prefix 实体id为key，用hashtable存储具体的实体信息

3.用ZSET存储排名和带有权重信息的一些实体id，缺点是内存占用太厉害了。

4.用hashtable做一些映射，例如username=>user_id等

5.set可以支持一些逻辑操作，但是排序的时间复杂度不佳，所以我选择了用list

6.set用来做唯一性验证，如果验证某个用户是否已经对某篇文章进行了赞的操作

7.使用redis用来优化内存hash-max-zipmap-entries等参数减少内存使用量

8.排序好的id也可以用string的getRange和setRange命令来实现顺序访问

用LIST不好的是其顺序已经确定，其删除操作耗时O(n)，顺序查找并删除，而且不支持union inter等操作，这些操作可以模拟and 和or这两种关系操作。
###[php strtotime是否有bug](https://segmentfault.com/q/1010000002454116?utm_source=tool.lu)
```js
$beginMon=strtotime("-1 week Monday");
$endMon=strtotime("-1 week Tuesday")-1;
echo date("Y-m-d H:i:s", $beginMon);
echo('<br/>');
echo date("Y-m-d H:i:s", $endMon);
echo("<br />");

//上面是获取本周一的开始与结束时间戳
//结果如下：
//2015-01-05 00:00:00（错误）
//2014-12-29 23:59:59（正确）

$beginSun=strtotime("+0 week Sunday");
$endSun=strtotime("+1 week Monday")-1;
echo date("Y-m-d H:i:s", $beginSun)."<br />";
echo date("Y-m-d H:i:s",$endSun)."<br />";

//上面获取的是本周末的开始与结束时间戳
//结果如下：
//2015-01-04 00:00:00
//2015-01-11 23:59:59(错误)

//以上案例都是在今天测试(非周末 因为周末)
http://php.net/manual/en/datetime.formats.relative.php 
每星期的七天，'sunday' | 'monday' | 'tuesday' | 'wednesday' | 'thursday' | 'friday' | 'saturday' | 'sun' | 'mon' | 'tue' | 'wed' | 'thu' | 'fri' | 'sat' | 'sun' 应该是以当前时间往后推 7 * 24 小时来考量的。本例中，如果你想特指本周的某个星期一，你可以使用 strtotime("-1 week Monday this week"); ，其它的天，类似地，指定是在哪个自然周内（本例即 this week 指定为本自然周），不要让系统自己按自己默认的逻辑处理即可。
```

###[表分区](http://www.jianshu.com/p/52843a98acda)
```js
ALTER TABLE users MODIFY COLUMN `id` bigint(20) unsigned NOT NULL;
ALTER TABLE users DROP PRIMARY KEY;
ALTER TABLE users ADD INDEX `id`(`id`);
ALTER TABLE users PARTITION BY HASH(id) PARTITIONS 64;
分区表限制：
单表最多支持1024个分区
MySQL5.1只能对数据表的整型列进行分区，或者数据列可以通过分区函数转化成整型列;
MySQL5.5的RANGE LIST类型可以直接使用列进行分区
如果分区字段中有主键或唯一索引的列，那么所有的主键列和唯一索引列都必须包含进来
分区表无法使用外键约束
分区必须使用相同的Engine
对于MyISAM分区表，不能在使用LOAD INDEX INTO CACHE操作
对于MyISAM分区表，使用时会打开更多的文件描述符（单个分区是一个独立的文件）
t1#p#p0.ibd t1#p#p1.ibd
mysql> show table status from vhall like 'webinar_user_regs'\G
*************************** 1. row ***************************
           Name: webinar_user_regs
         Engine: InnoDB
        Version: 10
     Row_format: Compact
           Rows: 728334
 Avg_row_length: 174
    Data_length: 126992384
Max_data_length: 0
   Index_length: 210354176
      Data_free: 231735296
 Auto_increment: NULL
    Create_time: 2017-03-13 12:27:36
    Update_time: NULL
     Check_time: NULL
      Collation: utf8_unicode_ci
       Checksum: NULL
 Create_options: partitioned
        Comment:
1 row in set (0.02 sec)
无论创建何种类型的分区，如果表中存在主键或唯一索引时，分区列必须是唯一索引的一个组成部分
在MySQL5.6中，可以使用清空一个分区数据：alter table operation_log truncate partition2014-01;
清空该分区表所有分区数据：alter table operation_log truncate partition all;

http://blog.csdn.net/tjcyjd/article/details/11194489 

ALTER TABLE users ADD PARTITION PARTITIONS 8;  
            将分区总数扩展到8个。
	    
CREATE TABLE ti2 (id INT, amount DECIMAL(7,2), tr_date DATE)  
    ENGINE=myisam  
    PARTITION BY HASH( MONTH(tr_date) )  
    PARTITIONS 6;    
默认分区限制分区字段必须是主键（PRIMARY KEY)的一部分，为了去除此
限制：
[方法1] 使用ID 
[方法2] 将原有PK去掉生成新PK
alter table results drop PRIMARY KEY;   
```
###[phptrace 是一个追踪（trace）PHP执行流程的工具](http://chuansong.me/n/1031743)
Github：https://github.com/Qihoo360/phptrace
```js
$ ./phptrace -p 3130 -s 3130 为php-fpm的进程ID
phptrace 0.1 demo, published by infra webcore team
process id = 3130
script_filename = /home/renyongquan/opt/nginx//webapp/block.php
[0x7f27b9a99dc8]  sleep /home/renyongquan/opt/nginx/webapp/block.php:6
[0x7f27b9a99d08]  say /home/renyongquan/opt/nginx/webapp/block.php:3
[0x7f27b9a99c50]  run /home/renyongquan/opt/nginx/webapp/block.php:10
-p 参数指定进程pid， -s表示我们需要获取stack信息； -p参数是必需的，并且只能是PHP相关进程（php,php-cli,php-fpm）的pid， 这很好理解，因为我们获取的是PHP的调用信息。-s 如果省略，则phptrace不会打印调用栈，而是实时获取PHP函数执行流程，即phptrace 的第二个功能，也是其主要功能。现在我们仍然回到stack上来。
基础架构快报 
程序输出的第一行，是版本信息，第二行显示了其进程PID，第三行是当前执行的PHP脚本，从第四行开始就是调用栈信息，从打印的 信息可以看出，最外层run函数调用了say函数，最终调用了sleep函数。
```
###[温故而知新之PHP手册](http://www.woowen.com/php/2015/01/21/%E6%B8%A9%E6%95%85%E8%80%8C%E7%9F%A5%E6%96%B0%E4%B9%8BPHP%E6%89%8B%E5%86%8C(1)/?utm_source=tool.lu)
```js
不要使用AND 和 OR 尽量使用 && 和 || 来替代,因为 && 和 || 的优先级比AND 和 OR要高,连 = 的优先级都比AND 和 OR要高.

 //这个还是要记录下,虽然以前就知道.
    $c = $a or $b 跟 ($c = $a) or $b 同义.
    $c = $a || $b 跟 $c = ($a or $b) 同义.
    不要对each() 中需要遍历的数组赋值 例如
    $a = array('a','v','c');
    while(list($b,$c) = each($a)){          
        $e = $a;
        echo $b;
        echo $c;
    }
    //数组在赋值的时候会重置指针,上面代码会无限循环
传递参数使用sub.x 的时候,PHP会自动转成subx因此应该使用$GET['sub_x']来获取值    
   const BIT_5 = 1 << 5;  //PHP5.6之后可以这么做
    define('BIT_5', 1 << 5);//一直可以
    //define还可以这么写
    for ($i = 0; $i < 32; ++$i) {
        define('BIT_' . $i, 1 << $i);
    }
    //const不能这么定义
    if(1){
        const XX = 'xx';
    }
    //define可以
    if(1){
        define('XX','xx');
    }  
var_dump("10" == "1e1"); // 10 == 10 -> true
    var_dump(100 == "1e2"); // 100 == 100 -> true   
    数组比较,数组中的单元如果具有相同的键名和值则比较时相等
    $a = array("apple", "banana");
    $b = array(1 => "banana", "0" => "apple");

    var_dump($a == $b); // bool(true)
    var_dump($a === $b); // bool(false)
    $a = 1;
$b = 1.25;
debug_zval_dump($a);
debug_zval_dump($b);
$array = [0];
foreach ($array as &$val) {
    var_dump($val);
    $array[1] = 1;
}
PHP7之前，当数组通过 foreach 迭代时，数组指针会移动。现在开始，不再如此
$array = [0, 1, 2];
foreach ($array as &$val) {
    var_dump(current($array)); 

    // PHP7
    // return int(0)

    // PHP5
    // return int(1),int(2),bool(false)
}

$a = '9d9';
for ($i = 0; $i < 10; $i++) {
    $a++;
}
var_dump($a);

//echo 18
当运行到9e0的时候 ,科学计数法转换成了9,那么后面++就成了数字了..

$a = floor((0.1+0.7) * 10);
//返回的结果并不是8,而是7
$a = round((0.1+0.7) * 10);
//返回的结果 = 8
$a = 9 - 5.1;
$b = 3.9;
var_dump(round($a, 2) == round($b, 2));

如果需要判断是否为空,可以使用Isset这种语句,而不要使用Isnull函数.或者使用===Null方法.速度跟Isset差不多,含义跟Isnull一致
键值为数字时  使用 + : 会返回前一个数组的value
使用 array_merge : 返回合并之后的一个数组,且重置键值
键值为字符时 使用 + : 返回数组1的value
使用 array_merge : 返回数组2的value
键值重置 使用 + : 键值不会重置
使用 array_merge : 数字键值会从0开始重置,且返回的合并数组的键值排序是按照先数组1,再数组2的次序来的

当Errorreporting 设置 Notice之上的时候,Arraymerge函数第一个参数为Null也不会报错,但是确实不会返回任何数据了.

个人开发本地/测试环境还是把Errorreporting设置成EALL吧.
__FUNCTION__和METHOD的不同在于前者只会返回函数名称,后者会连类名一起返回
PHP7中在switch语句中不能出现多个default,而php5可以,并且会执行最后一个 新增方法随机数字random_int
ASP的元素标签被移除,不能再使用<% <%=以及<script language="php”> .新增方法随机字节random_bytes
新增intdiv方法,取参数1 除以参数2 然后取整
http://www.woowen.com/php/2015/12/07/PHP7%20%E6%96%B0%E7%89%B9%E6%80%A7,%E6%94%B9%E5%8F%98%E5%8F%98%E5%8C%96/ 

SELECT * FROM `module_images`  WHERE pid = 'xx' and appid = 'xx' and parent in (416,415,419,421,414) GROUP BY parent order by FIELD(parent,416,415,419,421,414)
前面的In里面的顺序可以随便改变,但是后面的需要按照顺序书写. 关键就是这个Order By FIELD.另外不要忘记Group By 不然是会出错的.

arrayshift 在使用arrayshift弹出一个非常大的数组的第一个元素的时候,执行效率会很低.
Array_Pop()的复杂度为O(1)
Array_Shift()的复杂度为O(N)
当你执行一个非常大的数组的时候会随着数组庞大而降低效率.因此当你给一个非常大的数组执行弹出首元素操作的时候可以使用,Arrayreverse() 和 Arraypop()结合的方式.
较频繁地作为查询条件的字段
唯一性太差的字段不适合建立索引
更新太频繁地字段不适合创建索引
不会出现在where条件中的字段不该建立索引


新增两个CSPRNG函数：random_int和random_bytes /dev/urandom 会被作为最后一个可使用的工具
session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
覆盖写在 php.ini 中的 session 配置项。
有了preg_replace_callback_array就可以让每个不同的表达式对应不同的回调函数。
$subject = 'Aaaaaa Bbb';
 
echo preg_replace_callback_array(
    [
        '~[a]+~i' => function ($match) {
            return str_repeat('1', strlen($match[0]));
        },
        '~[b]+~i' => function ($match) {
            return str_repeat('2', strlen($match[0]));
        }
    ],
    $subject
);
使用 intdiv() 计算整数除法
生成器支持 return
$gen = (function() {
    yield 1;
    yield 2;
 
    return 3;
})();
 
foreach ($gen as $val) {
    echo $val, PHP_EOL;
}
 
echo $gen->getReturn(), PHP_EOL;
class A {private $x = 1;}
 
// Pre PHP 7 code
$getXCB = function() {return $this->x;};
$getX = $getXCB->bindTo(new A, A::class); // intermediate closure
echo $getX();
 
// PHP 7+ code
$getX = function() {return $this->x;};
echo $getX->call(new A);

// converts all objects into __PHP_Incomplete_Class object
$data = unserialize($foo, ["allowed_classes" => false]);
 
// converts all objects into __PHP_Incomplete_Class object except those of MyClass and MyClass2
$data = unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]);
//emoji微笑
echo "\u{1F603}";
echo [1, 2, 3][0];
echo 'string'[0];
$result = isset($var) ? $var : 'none';
 
$result = $var ?? 'none';  现在可以支持大于 2GB 的文件上传。
```
###[PHP 单例模式和工厂模式](http://www.woowen.com/php/2014/10/22/php%E5%8D%95%E4%BE%8B%E6%A8%A1%E5%BC%8F%E5%92%8C%E5%B7%A5%E5%8E%82%E6%A8%A1%E5%BC%8F/)
这个类有且只有一个实例存在,这样可以方式被多个实例化,造成多个操作.或者操作同时进行,你可以将单例用在数据库类上,这样在同一时间只会有一个数据库实例存在,也就是只会有一个数据库连接的存在,这样避免的过多的数据库连接,和不必要的系统资源的浪费.
```js
//单例模式
class myClass{
    static $__staticvar; //静态成员变量
    private $_str; //私有的变量
    private function __construct(){
        $this->_str = '单例模式';
    }
    private function __clone(){} //重载clone方法
    //由于单例不能被其他类所实例化,也就是不能使用$test = new myclass();
    public static function getObject(){
    //判断静态成员中是否有该对象如果没有就重新实例化.有就直接返回
    if(!(self::$__staticvar instanceof self))
    {
        self::$__staticvar = new self();
    }
        return self::$__staticvar;
    }
    //单例的一个方法
    public function getStr(){
        return $this->_str;
    }
}

$dl = myClass::getObject();
print_r($dl->getStr());
工厂模式,就是你定义一个接口,在接口中写下哪些方法可能会被用到.然后将每个特定的类起调用这个接口,并且重写里面的方法,在通过一个工厂类来根据判断而申明不同的类.工厂类必须返回一个对象,一般的命名规则为factory的静态方法.
//工厂模式
public static function factory($var){
    switch($var){
        case 'xx':
        $test = new classname();
        break;
        case 'xxx':
        $test = new classname1();
        break;
    }
return $test;
}

```
###[208.130.29.30-35这个IP段换成CIDR格式](http://mp.weixin.qq.com/s?__biz=MzAwMTEwNzEyOQ%3D%3D&mid=2650009231&idx=1&sn=6845ceb44d7ea6bf6464c3e5d4e0b75c&chksm=82d9fb59b5ae724f13346d784adb54b65378f94cf7f8c08000aecc93681f7e496c1c37b59697&scene=0&utm_source=tool.lu#wechat_redirect)
```js
# 确定起始和结尾IP，无论多复杂都可以转换
startip = '208.130.29.30'
endip = '208.130.29.35'
cidrs = netaddr.iprange_to_cidrs(startip, endip)
for k, v in enumerate(cidrs):
    iplist = v
    print iplist
输出：
208.130.29.30/31
208.130.29.32/30

反过来，CIDR也能直接转成IP地址段：

from netaddr import *

ip = IPNetwork('192.0.2.16/29')
ip_list = list(ip)
print(ip_list)
```
###[php缺点](https://www.toptal.com/php/10-most-common-mistakes-php-programmers-make?utm_source=tool.lu)

```js
$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
}
// $arr is now array(2, 4, 6, 8)
unset($value);

```
###[Python 技巧总结](http://litaotao.github.io/python-materials?utm_source=tool.lu)
###[字符型图片验证码识别完整过程及Python实现](http://www.cnblogs.com/beer/p/5672678.html?utm_source=tool.lu)
###[python词云 wordcloud 入门](http://blog.csdn.net/tanzuozhev/article/details/50789226?utm_source=tool.lu)
```js
官网: https://amueller.github.io/word_cloud/ 
github: https://github.com/amueller/word_cloud 
wget  https://github.com/amueller/word_cloud/archive/master.zip
unzip master.zip
rm master.zip
cd word_cloud-master
pip install -r requirements.txt
python setup.py install
from os import path
from scipy.misc import imread
import matplotlib.pyplot as plt

from wordcloud import WordCloud, STOPWORDS, ImageColorGenerator

# 获取当前文件路径
# __file__ 为当前文件, 在ide中运行此行会报错,可改为
# d = path.dirname('.')
d = path.dirname(__file__)

# 读取文本 alice.txt 在包文件的example目录下
#内容为
"""
Project Gutenberg's Alice's Adventures in Wonderland, by Lewis Carroll

This eBook is for the use of anyone anywhere at no cost and with
almost no restrictions whatsoever.  You may copy it, give it away or
re-use it under the terms of the Project Gutenberg License included
with this eBook or online at www.gutenberg.org
"""
text = open(path.join(d, 'alice.txt')).read()

# read the mask / color image
# taken from http://jirkavinse.deviantart.com/art/quot-Real-Life-quot-Alice-282261010
# 设置背景图片
alice_coloring = imread(path.join(d, "alice_color.png"))

wc = WordCloud(background_color="white", #背景颜色max_words=2000,# 词云显示的最大词数
mask=alice_coloring,#设置背景图片
stopwords=STOPWORDS.add("said"),
max_font_size=40, #字体最大值
random_state=42)
# 生成词云, 可以用generate输入全部文本(中文不好分词),也可以我们计算好词频后使用generate_from_frequencies函数
wc.generate(text)
# wc.generate_from_frequencies(txt_freq)
# txt_freq例子为[('词a', 100),('词b', 90),('词c', 80)]
# 从背景图片生成颜色值
image_colors = ImageColorGenerator(alice_coloring)

# 以下代码显示图片
plt.imshow(wc)
plt.axis("off")
# 绘制词云
plt.figure()
# recolor wordcloud and show
# we could also give color_func=image_colors directly in the constructor
plt.imshow(wc.recolor(color_func=image_colors))
plt.axis("off")
# 绘制背景图片为颜色的图片
plt.figure()
plt.imshow(alice_coloring, cmap=plt.cm.gray)
plt.axis("off")
plt.show()
# 保存图片
wc.to_file(path.join(d, "名称.png"))
```
###[python2,3对比](http://python-future.org/compatible_idioms.html?utm_source=tool.lu)
###[python脚本集合](https://github.com/realpython/python-scripts?utm_source=tool.lu)
###[Python列表对象实现原理](https://foofish.net/python-list-implements.html?utm_source=tool.lu)
###[Php Imagick常用知识](http://www.woowen.com/php/2014/08/10/PHP%20Imagick%20%E8%B5%84%E6%96%99%E6%B1%87%E6%80%BB/)
html->pdf->imgick->pic

htmltopdf 有第三方公司提供接口http://pdfcrowd.com/

###[数据库设计需要注意的地方](http://www.woowen.com/mysql/2014/10/15/%E6%95%B0%E6%8D%AE%E5%BA%93%E8%AE%BE%E8%AE%A1%20%E6%B3%A8%E6%84%8F%E8%A6%81%E7%82%B9/)


###[多维数组根据键值排序](http://www.woowen.com/php/2014/10/28/php%E5%A4%9A%E7%BB%B4%E6%95%B0%E7%BB%84%E6%8E%92%E5%BA%8F,%E5%AD%97%E7%AC%A6%E7%9B%B8%E4%BC%BC%E5%BA%A6%E5%8C%B9%E9%85%8D%E5%BA%A6/)
```js
/**
     * @param $array 需要排序的数组
     * @param $keyName 数组键值名称
     * @param int $order
     * @return array
     * @desc 多维数组根据键值排序,排序之后重置键值
     * @明心 php 获取2个字符之间的相似度 similar_text()
     */
    public static function array_sort($array, $keyName, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $keyName) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
        //重置混乱键值
        return array_values($new_array);
    }
```

###[PHP二维码类库(phpqrcode.php)详解及应用](http://www.hoehub.com/PHP/176.html?utm_source=tool.lu)
###[php文章索引](http://tool.lu/article/tag/php?page=2)
###[说说 PHP 的 die 和 exit](http://0x1.im/blog/php/php-exit-die.html?utm_source=tool.lu)
###[max/min 函数（PHP）的一个小 BUG](http://0x1.im/blog/php/bug-of-php-function-max.html?utm_source=tool.lu)
>>> max(0, ceil(-0.5))
=> 0
>>> $a = ceil(-0.5)
=> -0.0
>>> max($a, 0)
=> -0.0
###[php的curl调用远程接口](https://my.oschina.net/u/222608/blog/808708?utm_source=tool.lu)
改了curl一个参数CURLOPT_CONNECTTIMEOUT_MS
strace -o output.txt -f -T -tt -e trace=all php test.php
###[Differences between array_replace and array_merge in PHP](http://stackoverflow.com/questions/34367511/differences-between-array-replace-and-array-merge-in-php/34367698?utm_source=tool.lu)
```js
$a = array('a' => 'hello', 'b' => 'world');
$b = array('a' => 'person', 'b' => 'thing', 'c'=>'other', '15'=>'x');

print_r(array_merge($a, $b));
/*Array
(
    [a] => person
    [b] => thing
    [c] => other
    [0] => x
)*/

print_r(array_replace($a, $b));
/*Array
(
    [a] => person
    [b] => thing
    [c] => other
    [15] => x
)*/
$a = array('0'=>'a', '1'=>'c');
$b = array('0'=>'b');

print_r(array_merge($a, $b));
/*Array
(
  [0] => a
  [1] => c
  [2] => b
)*/

print_r(array_replace($a, $b));
/*Array
(
  [0] => b
  [1] => c
)*/
```
###[当cpu飙升时，找出php中可能有问题的代码行](http://www.bo56.com/%E5%BD%93cpu%E9%A3%99%E5%8D%87%E6%97%B6%EF%BC%8C%E6%89%BE%E5%87%BAphp%E4%B8%AD%E5%8F%AF%E8%83%BD%E6%9C%89%E9%97%AE%E9%A2%98%E7%9A%84%E4%BB%A3%E7%A0%81%E8%A1%8C/?spm=0.0.0.0.mlzm0G&utm_source=tool.lu)
###[php命令行](http://www.phpsh.org/?utm_source=tool.lu)
###[JavaScript + PHP(正则表达式)](http://amals.org/?id=1&utm_source=tool.lu)
```js
var pattern = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/,
	str = '';
        console.log(pattern.test(str));
	
 $str = '';
        $isMatched = preg_match('/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/', $str, $matches);
        var_dump($isMatched, $matches);
匹配双字节字符(包含汉字)var pattern = /[^\x00-\xff]/,
匹配时间(时:分:秒):var pattern = /([01]?\d|2[0-3]):[0-5]?\d:[0-5]?\d/,
匹配身份证: var pattern = /\d{15}|\d{17}[0-9Xx]/,
```
###[php 实现同一个账号同时只能一个人登录](http://blog.51yip.com/php/1698.html?utm_source=tool.lu)
实现原理
1,用户在电脑A登录,session信息存放在redis当中，并将session_id存到mysql数据库中。
2,同一用户在电脑B登录，验证完用户名和密码后，将该用户信息从数据库读出，取得用户在电脑A登录的session_id，然后在到redis中验证session是否过期。
3,如果过期，不用openfire推送提示信息。如果没有过期，php利用openfire推送消息后，在将redis中用户在电脑A中登录的session删除掉，删除后，在将用户在电脑B登录的个人信息放到session中，并将电脑B登录的session_id更新到数据库中，在这里一定要先发送推送，然后在清空session，不然用户在电脑A收不到xmpp发过来的消息。
https://phpbestpractices.org/?utm_source=tool.lu  https://phptrends.com/?utm_source=tool.lu
###[Markdown Parser in PHP](http://parsedown.org/?utm_source=tool.lu)
###[php安全](http://phpsecurity.readthedocs.io/en/latest/index.html?utm_source=tool.lu)
###[APP后端开发系列：登陆系统设计中的注意问题](https://helei112g.github.io/2016/07/12/1-APP%E5%90%8E%E7%AB%AF%E5%BC%80%E5%8F%91%E7%B3%BB%E5%88%97%EF%BC%9A%E7%99%BB%E9%99%86%E7%B3%BB%E7%BB%9F%E8%AE%BE%E8%AE%A1%E4%B8%AD%E7%9A%84%E6%B3%A8%E6%84%8F%E9%97%AE%E9%A2%98/)
```js
验证通过后，把用户uid+username+salt等md5后，作为token返回到客户端。
对token加入时间戳，过期后客户端重新提交username + pwd验证后再发一个token到客户端
服务端生成一个token后下发到客户端，客户端按照约定的规则加密后请求服务端
参考oauth2.0，用户提交username + pwd后，服务端返回以下信息
{
    "access_token":"2YotnFZFEjr1zCsicMWpAA",
    "expires_in":3600,
    "refresh_token":"tGzv3JOkF0XG5Qx2TlKWIA"
}
access_token 是用来进行访问的接口的，expires_in 是他的过期时间，到达过期时间后，需要用 refresh_token 来请求服务端刷新 access_token。

这里几个重点是：refresh_token 仅能使用一次，使用一次后，将被废弃。另外这个 access_token 只在 expires_in 有效期内有效。

注意： 这里的 expires_in 仅返回秒数就好了。别返回时间戳。因为各个平台计算s的时间戳，不一致，这样子做更方便处理。
token常用的一种生成方式：

该用户的uid，如：8888
该用户的口令，如： 123123
用户对应的salt，如：abcd
过期时间戳，如：1468293948
把上面几部分拼接起来：888:123123:abcd:1468293948

token = md5(‘888:123123:abcd:1468293948’);
```
###[Laravel --进阶篇 (单点登录)](https://www.blog8090.com/laravel-jin-jie-pian-dan-dian-deng-lu-sso/)
```js
if ($result) {  
   # 登录成功
   // 制作 token
   $time = time();
   // md5 加密
   $singleToken = md5($request->getClientIp() . $result->guid . $time);
   // 当前 time 存入 Redis
   \Redis::set(STRING_SINGLETOKEN_ . $result->guid, $time);
   // 用户信息存入 Session
   \Session::put('user_login', $result);
   // 跳转到首页, 并附带 Cookie
   return response()->view('index')->withCookie('SINGLETOKEN', $singletoken);
} else {
   # 登录失败逻辑处理
}
获取我们登录之后发送给用户的 Cookie 在 Cookie 之中会有我们登录成功后传到客户端的 SINGLETOKEN 我们要做的事情就是重新获取存入 Redis 的时间戳, 取出来安顺序和 IP, Guid, time MD5 加密, 加密后和客户端得到的 Cookie 之中的 SINGLETOKEN 对比. 把之前的用户挤下去了
public function handle($request, Closure $next)
    {
        $userInfo = \Session::get('user_login');
        if ($userInfo) {
            // 获取 Cookie 中的 token
            $singletoken = $request->cookie('SINGLETOKEN');
            if ($singletoken) {
                // 从 Redis 获取 time
                $redisTime = \Redis::get(STRING_SINGLETOKEN_ . $userInfo->guid);
                // 重新获取加密参数加密
                $ip = $request->getClientIp();
                $secret = md5($ip . $userInfo->guid . $redisTime);
                if ($singletoken != $secret) {              
                    // 记录此次异常登录记录
                    \DB::table('data_login_exception')->insert(['guid' => $userInfo->guid, 'ip' => $ip, 'addtime' => time()]);
                    // 清除 session 数据
                    \Session::forget('indexlogin');
                    return view('/403')->with(['Msg' => '您的帐号在另一个地点登录..']);
                }
                return $next($request);
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }
    
```

###[生成了词云图](https://github.com/NyanCat12/CrossinWeekly/blob/master/NovelWordCount.py)
```js
# Crossin的编程教室 
import re
from collections import Counter
from matplotlib import pyplot
from wordcloud import WordCloud
import matplotlib.pyplot as plt

def NovelRe(Novel):
    content = open(Novel, 'r').read().lower()
    words = []
    pattern = r"(?<!')\b[a-zA-Z]{2}[a-zA-Z]+\b"
    tmp = re.findall(pattern, content)
    DropList = ['you','your','he','him','his','she','her','they','them','their','where','when','what','who','which','there','said','had','don','mer','for','jul','its','his','with','charles','elecbook','classics','charlotte','bront','aesop','fables','dickens','tale','and','the','that','was']
    for word in DropList:
        tmp = [x for x in tmp if x!=word]
    for x in tmp:
        words.append(x)
    Count = Counter(words).most_common(100)
    return Count
'''
#用不上
def WordListToWordDict(WordList):
    Dict = {}
    for word in WordList:
        Dict[word[0]] = word[1]
    return Dict
#用不上
def FullWordList(OldList, AddDict):
    for key in AddDict:
        OldList.append(key)
    NewList = list(set(OldList))
    return NewList
'''
def Output():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    for novel in NovelList:
        print (novel[:-4]+'\n'+'========================================')
        WordList = NovelRe(novel)
        i = 1

        wordsum = 0
        for word in WordList:
            wordsum += word[1]
            
        for word in WordList:
            print (str(i) + '.'+'\t' + str(word[0]) + '\t' + str('%.5f%%' %(word[1]/wordsum)))
            i += 1
        print ('\n')
'''
#用不上
def Freq(Dict):
    WordSum = 0
    for key in Dict:
        WordSum += Dict[key]
    for key in Dict:
        Dict[key] = Dict[key]/WordSum#只是前100的单词出现总次数，不是文章总数
    return Dict
#用不上
def Style():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    Dict = {}
    for novel in NovelList:
        Dict[novel[:-4]] = Freq(WordListToWordDict(NovelRe(novel)))
    WordList = []
    for key in Dict:
        WordList = FullWordList(WordList, Dict[key])
    return (WordList, Dict)
#用不上
def WordVector(WordList, Dict):
    vector = [x*0 for x in range(len(WordList))]
    for index in range(len(WordList)):
        try:
            vector[index] = Dict[WordList[index]]
        except:
            vector[index] = 0
    return vector
#用不上
def NovelVector():
    WordList, Dict = Style()
    NovelVectorDict = {}
    for key in Dict:
        NovelVectorDict[key] = WordVector(WordList, Dict[key])
    return NovelVectorDict
def Plot():
    pass
'''
def OutputForWordCloud():
    NovelList = ['a tale of two cities(双城记).txt', 'Aesop’s Fables(伊索寓言).txt', 'Jane Eyre(简·爱).txt', 'Oliver Twist(雾都孤儿(孤星血泪)).txt', 'Romeo and Juliet(罗蜜欧和朱丽叶).txt']
    WordList = []
    NovelName = []
    for novel in NovelList:
        WordList.append(NovelRe(novel))
        NovelName.append(novel[:-4])
    return NovelName, WordList

def Wordcloud(name, freq):
    wordcloud = WordCloud(max_font_size=40).fit_words(freq)

    plt.imshow(wordcloud)
    plt.axis("off")
    plt.savefig(str(name)+".jpg")
    return 0
    


if __name__ == '__main__':
    Output()
    print ('Generating wordclouds')
    NovelName, WordList = OutputForWordCloud()
    for novel, word in zip(NovelName, WordList):
        Wordcloud(novel, word)
    print ('Wordclouds saved')
    #WordList, Dict = Style()

>>> from collections import Counter
>>> Counter('adffdsads')
Counter({'d': 3, 'f': 2, 's': 2, 'a': 2})
>>> c = Counter('adffdsads')
>>> c.most_common(3)
[('d', 3), ('a', 2), ('f', 2)]
```
###[现在有一文本文件 ‘abc.txt’，有 1000 行内容，现在需要在每一行的开头添加一个 ‘+’ 字符](http://mp.weixin.qq.com/s?timestamp=1489372072&src=3&ver=1&signature=qVVtrc2xfLjj-VcYj9yPBO3DHCDzca2ev2-Zxdd1Z8DgyzXERKux1dVNxpj7iVCgCfBFsrkcZzh4CTN1PkilExc6l6HO9nteOBHjoe09NJGUKa95IZzlPh66Iwy*63dHGs7z886SmdNiyPX8pXiVCG-ZSUqVw4P3ZGWdtp5IEXY=)
```js
text = 'The module provides some convenience functions'
# 初始化“包装器” 文本包装 textwrap
wrapper = textwrap.TextWrapper()
# 每行最大长度
wrapper.width = 20
# 第一行词头
wrapper.initial_indent = '+'
# 非首行词头
wrapper.subsequent_indent = '+'
# 最后填充文本
result = wrapper.fill(text)
print(result)

>>> text = 'module provides some convenience functions.'
>>> print(textwrap.shorten(text, 20))
module [...]
# placeholder 参数修改结尾形式
>>> print(textwrap.shorten(text, 20, placeholder='...'))
module...
finally 下的语句无论是否出现异常，均会被执行。

try:
  dfdg = xidfg  # 定义一个错误变量
  f = 2/0  # 除0错误
except ZeroDivisionError as e:
  print(e)
finally:
  print('程序结束')
  
   raw_input 得到的输入是字符串，无法直接和数字去比较大小。但在python2里，你这样做了，也不会报错，而是产生不可预知的结果。在python3里，则会直接报错。

Python2 中应改为：

answer = input()
Python3 中可使用：

answer = eval(input())

>>> [1, 2] == [2, 1]
False
>>> {'a':1, 'b':2} == {'b':2, 'a':1}
True
>>> from collections import OrderedDict
d = OrderedDict()
d['c'] = 3
d['b'] = 2
d['a'] = 1
print(d)
无论在什么环境下，输出结果都是：

OrderedDict([('c', 3), ('b', 2), ('a', 1)])
d = {'a': 2, 'b': 3, 'c': 1}
# 以 value 值对 dic 排序
sd = sorted(d.items(), key=lambda x: x[1])
# 转换为有序字典
od = OrderedDict(sd)
print(od)

```
###[代理ip](https://github.com/twy93007/adult_novel_fenxi/blob/master/proxyip.py)
```js
# coding:utf-8
import requests
from bs4 import BeautifulSoup
import re
import os.path

# 构造Header
user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5)'
headers = {'User-Agent': user_agent}

# 爬取代理
def getListProxies():
    # 获得页面
    session = requests.session()
    page = session.get("http://www.xicidaili.com/nn", headers=headers)
    # soup解析
    soup = BeautifulSoup(page.text, 'lxml')
    proxyList = []
    taglist = soup.find_all('tr', attrs={'class': re.compile("(odd)|()")})
    # 构造代理信息
    for trtag in taglist:
        tdlist = trtag.find_all('td')
        proxy = {'http': tdlist[1].string + ':' + tdlist[2].string,
                 'https': tdlist[1].string + ':' + tdlist[2].string}
        url = "http://ip.chinaz.com/getip.aspx"  # 用来测试IP是否可用的url
        # 测试IP是否可用
        try:
            response = session.get(url, proxies=proxy, timeout=5)
            proxyList.append(proxy)
            if (len(proxyList) == 10):
                break
        except Exception, e:
            continue

    return proxyList

print getListProxies()
```
###[MySQL 对于千万级的大表要怎么优化](https://www.zhihu.com/question/19719997)
```js
第一优化你的sql和索引；

第二加缓存，memcached,redis；

第三以上都做了后，还是慢，就做主从复制或主主复制，读写分离，可以在应用层做，效率高，也可以用三方工具，第三方工具推荐360的atlas,

mysql自带分区表，先试试这个，对你的应用是透明的，无需更改代码,但是sql语句是需要针对分区表做优化的
myisam读的效果好，写的效率差，这和它数据存储格式，索引的指针和锁的策略有关的，它的数据是顺序存储的（innodb数据存储方式是聚簇索引）

表分区，是指根据一定规则，将数据库中的一张表分解成多个更小的，容易管理的部分。从逻辑上看，只有一张表，但是底层却是由多个物理分区组成。https://my.oschina.net/jasonultimate/blog/548745
分区从逻辑上来讲只有一张表，而分表则是将一张表分解成多张表。 一个表最多只能有1024个分区
show variables like '%partition%';
常规Hash分区:使用取模算法 partition by hash(store_id) partitions 4;
上面的语句，根据store_id对4取模，决定记录存储位置。 比如store_id = 234的记录，MOD(234,4)=2,所以会被存储在第二个分区。

如果分区字段中有主键或者唯一索引的列，那么多有主键列和唯一索引列都必须包含进来。即：分区字段要么不包含主键或者索引列，要么包含全部主键和索引列。
查询某张表一共有多少个分区
mysql> select 
 ->   partition_name,
 ->   partition_expression,
 ->   partition_description,
 ->   table_rows
 -> from 
 ->   INFORMATION_SCHEMA.partitions
 -> where
 ->   table_schema='test'
 ->   and table_name = 'emp';
+----------------+----------------------+-----------------------+------------+
| partition_name | partition_expression | partition_description | table_rows |
+----------------+----------------------+-----------------------+------------+
| p0             | store_id             | 10                    |          0 |
| p1             | store_id             | 20                    |          1 |
+----------------+----------------------+-----------------------+------------+
即，可以从information_schema.partitions表中查询。 表查询条件如果没有order by条件，mysql不再按自增主键正序排序
mysql> select partition_name,partition_expression,table_rows from information_sc
hema.partitions where table_schema='vhall' and table_name='webinar_user_regs';
+----------------+----------------------+------------+
| partition_name | partition_expression | table_rows |
+----------------+----------------------+------------+
| p0             | webinar_id           |       1461 |
| p1             | webinar_id           |       1254 |
| p2             | webinar_id           |       1957 |
mysql> explain partitions select * from emp where store_id=10 \G;
*************************** 1. row ***************************
        id: 1
select_type: SIMPLE
     table: emp
partitions: p1
      type: system
possible_keys: NULL
       key: NULL
   key_len: NULL
       ref: NULL
      rows: 1
     Extra: 
1 row in set (0.00 sec)
上面的结果：partitions:p1 表示数据在p1分区进行检索
查看redis-cli --help查看--eval的语法
 有redis-cli --eval myscript.lua key1 key2 , arg1 arg2 arg3
```
###[使用selenium webdriver从隐藏元素中获取文本](http://blog.csdn.net/vinson0526/article/details/51830650)
```js
from selenium import webdriver

DEMO_PAGE = '''data:text/html,
    <p>Demo page for how to get text from hidden elements using Selenium WebDriver.</p>
    <div id='demo-div'>Demo div <p style='display:none'>with a hidden paragraph inside.</p><hr /><br /></div>'''

driver = webdriver.PhantomJS()
driver.get(DEMO_PAGE)

demo_div = driver.find_element_by_id("demo-div")

print demo_div.get_attribute('innerHTML')
print driver.execute_script("return arguments[0].innerHTML", demo_div)

print demo_div.get_attribute('textContent')
print driver.execute_script("return arguments[0].textContent", demo_div)

driver.quit
```
wxBot: https://github.com/liuwons/wxBot 
图灵机器人: http://www.tuling123.com/ 



###[mySQL，从入门到熟练](https://mp.weixin.qq.com/s/KqSpXIveVJsnMeye0bZ-WQ  )
```js
select if(industryField like '%电子商务%',1,0) from DataAnalyst  select city,
          count(distinct positionId),
          count(if(industryField like '%电子商务%',positionId,null)) 
from DataAnalyst
group by city  嵌套子查询 select left(salary,locate("k",salary)-1),salary from DataAnalyst
2017-02-12 秦路 秦路 
找出各个部门的最高薪水 
select d.Id,  #这是部门ID
           d.Name as Name,  #这是部门名字
           max(e.Salary) as Salary  #这是最高薪水
from Department d
join Employee e
on e.DepartmentId = d.Id
group by d.Id

当最高薪水非单个时，使用max会只保留第一个，而不是列举所有，所以我们需要更复杂的查询。 各部门最高薪水的数据，可以将它作为一张新表，用最高薪水关联雇员表，获得我们最终的答案。
![img](http://mmbiz.qpic.cn/mmbiz_png/9WoCz1BTJSjNzwpRAsicrWlYYoFKKZDPbialSy5HKG00DwovDKsDqhIPXSAOnr7vGuCc1gxVUFXRNPHUKYGn7ycQ/640?wx_fmt=png&tp=webp&wxfrom=5&wx_lazy=1)
各部门薪水前三的数据。如果最高薪水只有两个，则输出两个。
select * from Employee as e
where  (
    select count(distinct e1.Salary) 
    from Employee e1
    where e1.Salary > e.Salary
    and e1.DepartmentId = e.DepartmentId
    ) < 3

```
###[【Python爬虫实战】为啥学Python，BOSS告诉你](https://zhuanlan.zhihu.com/p/25641178)
```js
url = 'http://www.zhipin.com/job_detail/?query=Python&scity=101200100&source=2'
headers = {
	'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
	'Accept-Language':'zh-CN,zh;q=0.8',
	'Host':'www.zhipin.com',
	'User-Agent':'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
}a = requests.get(url,headers=headers)
soup = BeautifulSoup(a.text,'lxml')
b = soup.find_all("span",class_="red")
print(b)
for i in b:
	c = i.get_text("|", strip=True)
	print(c) https://link.zhihu.com/?target=https%3A//github.com/zhangslob/-Python-Python-BOSS-/blob/master/test.py
```
###[用python实现微信聊天机器人](https://zhuanlan.zhihu.com/p/25682247?group_id=823517271958896640)
```js
import requests
from wxpy import *
import json


#图灵机器人https://zhuanlan.zhihu.com/p/25692489
def talks_robot(info = '你叫什么名字'):
    api_url = 'http://www.tuling123.com/openapi/api'
    apikey = 'APIKey'
    data = {'key': apikey,
                'info': info}
    req = requests.post(api_url, data=data).text
    replys = json.loads(req)['text']
    return replys

#微信自动回复
robot = Robot()
# 回复来自其他好友、群聊和公众号的消息
@robot.register()
def reply_my_friend(msg):
    message = '{}'.format(msg.text)
    replys = talks_robot(info=message)
    return replys

# 开始监听和自动处理消息
robot.start()


@robot.register() 
def just_print(msg): 
print(datetime.now().strftime("%I:%M:%S") + " " + msg.chat.nick_name + ":" + msg.text)
# register不限定回复对象，匹配所有聊天对象（包括公众号，群），但是不做回复，只print收到的消息，这样不会打扰任何人。
@robot.register(Friend, TEXT) 
def auto_reply_by_tuling(msg): 
print(datetime.now().strftime("%I:%M:%S") + " " + msg.chat.nick_name + ":" + msg.text) 
return Tuling(api_key=Tuling_api_key).reply_text(msg)
# register指定回复Friend对象，因为写在后面，所以受到来自好友的消息时，会优先按这个方法来处理。这里既做了打印又做了图灵机器人的自动回复。
# 这样就不会打扰群里了。而且wxpy还支持群里有人@你了才回复
```
###[从自动化刷票说phantomjs和selenium](https://www.yanxiuer.com/phantomjsandselenium.html)
###[ELK+redis搭建nginx日志分析平台](http://yanliu.org/2015/08/19/ELK-redis%E6%90%AD%E5%BB%BAnginx%E6%97%A5%E5%BF%97%E5%88%86%E6%9E%90%E5%B9%B3%E5%8F%B0/)
###[msyql 积分返还算法求解](https://segmentfault.com/q/1010000008652947)
"select user from tablename where status=1 and time<'{$time}' limit 100";
"update tablename set number=number-100 where status=1 and time<'{$time}'";
"update tablename set status=0, time='当前时间' where status=1 and number=0;
###[js可以替换或删掉选中文本](https://segmentfault.com/q/1010000008657235)
// 1. 设置整个页面为可编辑状态
document.body.setAttribute('contenteditable', true)
// 2. 全选
document.execCommand('selectAll')
// 3. 剪切
document.execCommand('cut')

###[python爬虫爬取中证指数官网数据](https://segmentfault.com/q/1010000008619396)
```js
import requests
from itertools import groupby

url = 'http://www.csindex.com.cn/sseportal/ps/zhs/hqjt/csi/show_zsgz.js'
r = requests.get(url)

text = r.text.replace('"', '').replace('var zsgz','').split('\r\n')
content = [_.split('=') for _ in text if _ and not _.startswith('00')]

rows = []
for _, lst in groupby(content, key=lambda x: int(x[0]) / 10):
    row = tuple([v for k, v in lst])
    rows.append(row)

print rows
```
###[执行PHP文件会添加php命令路径](https://segmentfault.com/q/1010000008626259)
php的安全机制。

在安全模式下，只有在特定目录中的外部程序才可以被执行，对其它程序的调用将被拒绝。这个目录可以在php.ini文件中用 safe_mode_exec_dir指定，或在编译PHP是加上--with-exec-dir选项来指定，默认是 /usr/local/php/bin
PHP里面执行whoami命令，但是执行时候会自动在 /usr/bin/whoami 前添加 /usr/local/php 路径导致出错
###[Python 3.6中 'utf-8' codec can't decode byte invalid start byte](https://segmentfault.com/q/1010000008631001)
```js
网站返回的是gzip压缩过的数据，所以要进行解码
Content-Encoding: gzip
# coding=utf-8
from io import BytesIO
import gzip
import urllib.request

url = ('http://wthrcdn.etouch.cn/weather_mini?city=%E4%B8%8A%E6%B5%B7')
resp = urllib.request.urlopen(url)
content = resp.read() # content是压缩过的数据

buff = BytesIO(content) # 把content转为文件对象
f = gzip.GzipFile(fileobj=buff)
res = f.read().decode('utf-8')
print(res)
```
###[模拟滑动验证码](https://segmentfault.com/q/1010000008584470)
```js
# -*- coding:utf-8 -*-
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.common.action_chains import ActionChains
import PIL.Image as image
import time,re, random
import requests
try:
    from StringIO import StringIO
except ImportError:
    from io import StringIO

#爬虫模拟的浏览器头部信息
agent = "Mozilla/5.0 (Windows NT 5.1; rv:33.0) Gecko/20100101 Firefox/33.0"
headers = {
        "User-Agent": agent
        }

# 根据位置对图片进行合并还原
# filename:图片
# location_list:图片位置
#内部两个图片处理函数的介绍
#crop函数带的参数为(起始点的横坐标，起始点的纵坐标，宽度，高度）
#paste函数的参数为(需要修改的图片，粘贴的起始点的横坐标，粘贴的起始点的纵坐标）
def get_merge_image(filename,location_list):
    #打开图片文件
    im = image.open(filename)
    #创建新的图片,大小为260*116
    new_im = image.new("RGB", (260,116))
    im_list_upper=[]
    im_list_down=[]
    # 拷贝图片
    for location in location_list:
        #上面的图片
        if location["y"]==-58:
            im_list_upper.append(im.crop((abs(location["x"]),58,abs(location["x"])+10,166)))
        #下面的图片
        if location["y"]==0:
            im_list_down.append(im.crop((abs(location["x"]),0,abs(location["x"])+10,58)))
    new_im = image.new("RGB", (260,116))
    x_offset = 0
    #黏贴图片
    for im in im_list_upper:
        new_im.paste(im, (x_offset,0))
        x_offset += im.size[0]
    x_offset = 0
    for im in im_list_down:
        new_im.paste(im, (x_offset,58))
        x_offset += im.size[0]
    return new_im

#下载并还原图片
# driver:webdriver
# div:图片的div
def get_image(driver,div):
    #找到图片所在的div
    background_images=driver.find_elements_by_xpath(div)
    location_list=[]
    imageurl=""
    #图片是被CSS按照位移的方式打乱的,我们需要找出这些位移,为后续还原做好准备
    for background_image in background_images:
        location={}
        #在html里面解析出小图片的url地址，还有长高的数值
        location["x"]=int(re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][1])
        location["y"]=int(re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][2])
        imageurl=re.findall("background-image: url\(\"(.*)\"\); background-position: (.*)px (.*)px;",background_image.get_attribute("style"))[0][0]
        location_list.append(location)
    #替换图片的后缀,获得图片的URL
    imageurl=imageurl.replace("webp","jpg")
    #获得图片的名字
    imageName = imageurl.split("/")[-1]
    #获得图片
    session = requests.session()
    r = session.get(imageurl, headers = headers, verify = False)
    #下载图片
    with open(imageName, "wb") as f:
        f.write(r.content)
        f.close()
    #重新合并还原图片
    image=get_merge_image(imageName, location_list)
    return image

#对比RGB值
def is_similar(image1,image2,x,y):
    pass
    #获取指定位置的RGB值
    pixel1=image1.getpixel((x,y))
    pixel2=image2.getpixel((x,y))
    for i in range(0,3):
        # 如果相差超过50则就认为找到了缺口的位置
        if abs(pixel1[i]-pixel2[i])>=50:
            return False
    return True

#计算缺口的位置
def get_diff_location(image1,image2):
    i=0
    # 两张原始图的大小都是相同的260*116
    # 那就通过两个for循环依次对比每个像素点的RGB值
    # 如果相差超过50则就认为找到了缺口的位置
    for i in range(0,260):
        for j in range(0,116):
            if is_similar(image1,image2,i,j)==False:
                return  i

#根据缺口的位置模拟x轴移动的轨迹
def get_track(length):
    pass
    list=[]
    #间隔通过随机范围函数来获得,每次移动一步或者两步
    x=random.randint(1,3)
    #生成轨迹并保存到list内
    while length-x>=5:
        list.append(x)
        length=length-x
        x=random.randint(1,3)
    #最后五步都是一步步移动
    for i in range(length):
        list.append(1)
    return list

#滑动验证码破解程序
def main():
    #打开火狐浏览器
    driver = webdriver.Firefox()
    #用火狐浏览器打开网页
    driver.get("http://www.geetest.com/exp_embed")
    #等待页面的上元素刷新出来
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_slider_knob gt_show"]").is_displayed())
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_cut_bg gt_show"]").is_displayed())
    WebDriverWait(driver, 30).until(lambda the_driver: the_driver.find_element_by_xpath("//div[@class="gt_cut_fullbg gt_show"]").is_displayed())
    #下载图片
    image1=get_image(driver, "//div[@class="gt_cut_bg gt_show"]/div")
    image2=get_image(driver, "//div[@class="gt_cut_fullbg gt_show"]/div")
    #计算缺口位置
    loc=get_diff_location(image1, image2)
    #生成x的移动轨迹点
    track_list=get_track(loc)
    #找到滑动的圆球find_element_by_xpath('//div[@class="gt_slider_knob gt_show"]')
    element=driver.find_element_by_xpath("//div[@class="gt_slider_knob gt_show"]")
    location=element.location
    #获得滑动圆球的高度
    y=location["y"]
    #鼠标点击元素并按住不放
    print ("第一步,点击元素")
    ActionChains(driver).click_and_hold(on_element=element).perform()
    time.sleep(0.15)
    print ("第二步，拖动元素")
    track_string = ""
    for track in track_list:
        #不能移动太快,否则会被认为是程序执行
        track_string = track_string + "{%d,%d}," % (track, y - 445)
        #xoffset=track+22:这里的移动位置的值是相对于滑动圆球左上角的相对值，而轨迹变量里的是圆球的中心点，所以要加上圆球长度的一半。
        #yoffset=y-445:这里也是一样的。不过要注意的是不同的浏览器渲染出来的结果是不一样的，要保证最终的计算后的值是22，也就是圆球高度的一半
        ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=track+22, yoffset=y-445).perform()
        #间隔时间也通过随机函数来获得,间隔不能太快,否则会被认为是程序执行
        time.sleep(random.randint(10,50)/100)
    print (track_string)
    #xoffset=21，本质就是向后退一格。这里退了5格是因为圆球的位置和滑动条的左边缘有5格的距离
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    time.sleep(0.1)
    ActionChains(driver).move_to_element_with_offset(to_element=element, xoffset=21, yoffset=y-445).perform()
    print ("第三步，释放鼠标")
    #释放鼠标
    ActionChains(driver).release(on_element=element).perform()
    time.sleep(3)
    #点击验证
    # submit = driver.find_element_by_xpath("//div[@class="gt_ajax_tip success"]")
    # print(submit.location)
    # time.sleep(5)
    #关闭浏览器,为了演示方便,暂时注释掉.
    #driver.quit()

#主函数入口
if __name__ == "__main__":
    pass
    main()
```
###[SQL中一个表的转换问题](https://segmentfault.com/q/1010000008591791)
```js
pandas的melt方法

a = pd.DataFrame([[0101,1,2,3],[0202,4,5,6]],columns=['date','a','b','c'])
   date  a  b  c
0    65  1  2  3
1   130  4  5  6
pd.melt(a,id_vars=['date'],var_name='col1',value_name='col2')
   date col1  col2
0    65    a     1
1   130    a     4
2    65    b     2
3   130    b     5
4    65    c     3
5   130    c     6
```

###[python如何进行socket连接](https://segmentfault.com/q/1010000008631917 )
```js
from websocket import create_connection


ws = create_connection("ws://42.96.131.185:7575")
print("Sending 'Hello, World'...")
for i in range(10000):
    ws.send(b"Hello, World")
    print("Sent")
print("Reeiving...")
result = ws.recv()
print("Received '%s'" % result)
ws.close()
```
三级联动的生成器插件 https://microzz.com/2017/03/12/select-plugin/ 
https://segmentfault.com/q/1010000008626085
https://segmentfault.com/q/1010000008642343 php socket 是干嘛的 请用具体场景举例
php 在线打开word文档https://segmentfault.com/q/1010000008623235
借助第三方：http://www.idocv.com/index.html http://www.officeweb365.com
2.自己转换成swf http://www.print2flash.com
PHP如何判断每个月的每一周是几号到几号https://segmentfault.com/q/1010000008608311 
###[PHP多维数组排序问题](https://segmentfault.com/q/1010000008605080)
```js
<?php

$a = $b = $c = [];

array_map(function( $value ) use ( &$a,&$b,&$c ){
      array_push($a, $value['a']);
      array_push($b, $value['b']);
      array_push($c, $value['c']);
} , $arr);

$count = $arr;

var_dump($count);
array_multisort(
    $a,SORT_ASC,
    $b,SORT_ASC,
    $c,SORT_ASC,
    $arr
);

var_dump($arr);
```

###[字符串里的u'\u00a1'怎么打印成中文](https://segmentfault.com/q/1010000008601928)
```js
demo.decode('unicode-escape')
当然限 Python 2，因为 Python 3 里边不会遇到这种字符串
```
###[mysql返回字符串](https://segmentfault.com/q/1010000008576315)
```js
用PDO的话：PDO::ATTR_STRINGIFY_FETCHES，例：

$pdo = new PDO('...');
$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
$stm = $pdo->prepare("select 1, 2.3, 'hello'");
$stm->execute();
$result = $stm->fetch(PDO::FETCH_NUM);
```
###[关联查询的sql查询不全的问题](https://segmentfault.com/q/1010000008615512)
select id,title,(select count(*) from attop_article where attop_article.type = attop_article_type.id) as count from attop_article_type;


###[mysql select 不取第一条和第二条怎么做到](https://segmentfault.com/q/1010000008599232)
limit的第二个参数中放入 select count(*) from table 的值, 也可以用查询条件比如 where id > 2 这样筛选 
###[Python中如何将爬取到的数据循环存入到csv](https://segmentfault.com/q/1010000008624695)
```js
#coding=utf-8

import requests
import json
import time
import csv
import codecs

headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.113 Safari/537.36'
}
url = 'https://sec.wedengta.com/getIntelliStock?action=IntelliSecPool&id=99970_56&_={0}'.format(time.time())
r = requests.get(url, headers=headers)
result = json.loads(r.text)

rows = []
for every in json.loads(result['content'])['vtDaySec']:
    for company in every['vtSec']:
        row = (
            every['sOptime'].encode('utf-8'),
            company['sChnName'].encode('utf-8'),
            company['sDtCode'][4:].encode('utf-8')
        )
        rows.append(row)

with codecs.open('company.csv', 'wb') as f:
    f.write(codecs.BOM_UTF8)
    writer = csv.writer(f)
    writer.writerow(['date', 'stk_name', 'stk_num'])
    writer.writerows(rows)

```



###[python3 脚本调用shell 指令如何获得返回值](https://segmentfault.com/q/1010000008624292)
```js
import os
if(os.system('netstat -tnlp | grep nginx') == 0) {
    print 'process nginx exists.'
}
import os
if(os.popen('netstat -tnlp | grep nginx').read() != '') {
    print 'process nginx exists.'
}
调用子程序更强大的是subprocess.Popen
>>> subprocess.getstatusoutput('ls /bin/ls')
(0, '/bin/ls')
>>> subprocess.getstatusoutput('cat /bin/junk')
(256, 'cat: /bin/junk: No such file or directory')
>>> subprocess.getstatusoutput('/bin/junk')
(256, 'sh: /bin/junk: not found')
```
###[几个有趣的javascript函数](http://gengliming.com/2015/06/05/some-funny-js-functions/)
###[对登录中账号密码进行加密之后再传输的爆破的思路和方式](http://www.freebuf.com/articles/web/127888.html)
###[饿了么大前端 Node.js 进阶教程](https://cnodejs.org/topic/58ad76db7872ea0864fedfcc#58b3bf27e418a986315f3959)
###[Web服务器性能压力测试工具](http://biezhi.me/2015/12/03/webserver-performance-pressure-test-tool/)
webbench  siege -c 100 -r 10 -f site.url
###[新一代子域名爆破工具brutedns](http://www.freebuf.com/sectool/127099.html)
我博客地址：https://www.yanxiuer.com。更多有关技术的细节会在上边更新。
pyrhon3 brutedns.py -d target -l 1/2 -s low/medium/high
工具地址：https://github.com/yanxiu0614/subdomain3
interface DateGlobal {
  const SECONDS_IN_A_DAY = 86400;
}

addExpireAt(DateGlobal::SECONDS_IN_A_DAY);
###[28张相见恨晚的速查表（Cheat Sheet）——Python篇](https://zhuanlan.zhihu.com/p/25669434?group_id=823242843865894912)
matplotlib:https://www.datacamp.com/community/blog/python-matplotlib-cheat-sheet
scipy:https://www.datacamp.com/community/blog/python-scipy-cheat-sheet
pandas:https://www.datacamp.com/community/blog/python-pandas-cheat-sheet
numpy:https://www.datacamp.com/community/blog/python-numpy-cheat-sheet
scikit-Learn:https://www.datacamp.com/community/blog/scikit-learn-cheat-sheet
bokeh:https://www.datacamp.com/community/blog/bokeh-cheat-sheet-python
python basic:https://www.datacamp.com/community/tutorials/python-data-science-cheat-sheet-basics
###[历史爱好者福利—这个网站包含了6000年来的世界历史地图演变](https://zhuanlan.zhihu.com/p/25658582?group_id=823149310563713024)
http://link.zhihu.com/?target=http%3A//x768.com/w/twha.zh-hans 
###[循环体异步函数中循环变量i的保存](https://zhuanlan.zhihu.com/p/25647386?group_id=822928818560983040)
```js
for (var i=1; i<=5; i++) {
    setTimeout( function timer() {
        console.log(i);
    }, i*1000 );
}

for (var i=1; i<=5; i++) {
    (function(i){
        setTimeout( function timer() {
            console.log(i);
        }, i*1000 );
    })(i);
}
for (var i=1; i<=5; i++) {
    setTimeout( (function(i){
        return function timer() {
            console.log(i);
        }
    })(i), i*1000 );
}
for (var i=1; i<=5; i++) {
    setTimeout( function timer(i) {
        console.log(i);
    }, i*1000, i );
}
for (let i=1; i<=5; i++) {
    setTimeout( function timer() {
        console.log(i);
    }, i*1000 );
}
```
###[使用Python定制词云](https://zhuanlan.zhihu.com/p/25538157?group_id=822178793971126272)
```js
from os import path
from wordcloud import WordCloud

d = path.dirname(__file__)

# Read the whole text.
text = open(path.join(d, 'constitution.txt')).read()

# Generate a word cloud image
wordcloud = WordCloud().generate(text)

 
import matplotlib.pyplot as plt
plt.imshow(wordcloud)
plt.axis("off")

# lower max_font_size
wordcloud = WordCloud(max_font_size=40).generate(text)
plt.figure()
plt.imshow(wordcloud)
plt.axis("off")
plt.show()
https://link.zhihu.com/?target=https%3A//www.shiyanlou.com/courses/756 
```
###[Python教你用matplotlib画个心心撩妹](https://zhuanlan.zhihu.com/p/25575403?group_id=821786158840320000)
```js
import matplotlib.pyplot as plt
import numpy as np
import math
pi = math.pi
t = np.arange(0,2*pi,0.001)
r = np.frompyfunc(round,1,1)
sin = np.frompyfunc(math.sin,1,1)
cos = np.frompyfunc(math.cos,1,1)
#y = sin(x)*(abs(cos(x)))**0.5/(sin(x)+1.4)-2*sin(x)+2
'''
y = 2*cos(t)-cos(2*t)
x = 2*sin(t)-sin(2*t)
'''
x=sin(t)
c=cos(t)
p=x**2
y=c+p**(1/3)
plt.plot(x, y,color='r', linewidth=9)
plt.fill(x,y,color='r')
plt.title("my heart for you")
ax = plt.subplot(111)
ax.spines['right'].set_color('none')
ax.spines['top'].set_color('none')
ax.spines['bottom'].set_color('none')
ax.spines['left'].set_color('none')
plt.xlim(-1.2,1.2),plt.xticks([])
plt.yticks([])
plt.show()
```
###[总结一些前端的知识点 (一)](https://zhuanlan.zhihu.com/p/25351196?group_id=821810418736599040)

###[用python实现微信聊天机器人](https://zhuanlan.zhihu.com/p/25682247?group_id=823517271958896640)

###[10行Python代码的词云](http://mp.weixin.qq.com/s/HysMAAPMY2zLilQVnTUE5A)
```js
import matplotlib.pyplot as plt
from wordcloud import WordCloud
import jieba

text_from_file_with_apath = open('/Users/hecom/23tips.txt').read()

wordlist_after_jieba = jieba.cut(text_from_file_with_apath, cut_all = True)
wl_space_split = " ".join(wordlist_after_jieba)

my_wordcloud = WordCloud().generate(wl_space_split)

plt.imshow(my_wordcloud)
plt.axis("off")
plt.show()
直接进入wordcloud.py 的源码，找字体库相关的代码

FONT_PATH = os.environ.get("FONT_PATH", os.path.join(os.path.dirname(__file__), "DroidSansMono.ttf"))
wordcloud 默认使用了DroidSansMono.ttf 字体库，改一下换成一个支持中文的ttf 字库
```
###[JavaScript技巧](https://rockjins.js.org/2017/02/15/javascript-skill/)
```js
获取一个链接的绝对地址
var getAbsoluteUrl = (function() {
  var a;

  return function(url) {
    if(!a) a = document.createElement('a');
    a.href = url;

    return a.href;
  };
})();

//使用
getAbsoluteUrl("/something"); //https://rockjins.github.io/something
上传图片预览功能
<input type="file" name="file" onchange="showPreview(this)" />
<img id="portrait" src="" width="70" height="75">
function showPreview(source) {
  var file = source.files[0];
  if(window.FileReader) {
      var fr = new FileReader();
      fr.onloadend = function(e) {
        document.getElementById("portrait").src = e.target.result;
      };
      fr.readAsDataURL(file);
  }
}
Math.round函数的坑
Math.round(-3.2) //-3

Math.round(-3.5) //-3(这个就奇怪了)

Math.round(-3.8) //-4

//其实，Math.round(x)等同于：
Math.floor(x + 0.5)
const EPSILON = Math.pow(2, -53); //1.1102230246251565e-16

function epsEqu(x,y) {
  return Math.abs(x - y) < EPSILON;
}

epsEqu(0.1+0.2, 0.3) //true
随机生成字母和数字组合的字符串
Math.random().toString(36).substr(2);
//un80usvvsgcpi0rffskf39pb9
//02aoe605zgg5xqup6fdclnb3xr
//ydzr1swdxjg3yolkb95p14i
```
###[SQL，从入门到熟练](http://mp.weixin.qq.com/s/KqSpXIveVJsnMeye0bZ-WQ)
###[你真的了解如何将Nginx配置为Web服务器吗](http://mp.weixin.qq.com/s/jYd9WkLOAvv6RfxfSa_PYg)
###[再议数据库军规](http://mp.weixin.qq.com/s/8LHNXdpRcn_ehIdb8Q4EvA)
###[Vue.js 的一些资源索引](https://github.com/jsfront/src/blob/master/vuejs.md)
###[python 计算两个时间相差的分钟数](https://segmentfault.com/q/1010000008657761)
```js
import datetime

t1 = datetime.datetime(2017,3,4,8,49,0)
t2 = datetime.datetime(2017,3,5,8,50,30)

min =(t2-t1).total_seconds()/60
m = round(min)

print(m)
```
###[Web全栈工程师](https://coin8086.gitbooks.io/getfullstack/content/)
###[PHP软件指南](https://github.com/yangweijie/clean-code-php)
###[前端面试题（一）：递归解析](http://mp.weixin.qq.com/s/-V-Vp0EqevA869vHuvpY6A)
```js
function fillArray(array,result){  
    var count = array.length;
    var i = 0; 
    for(;i<count;++i){	
        var temp = array[i];
        if(Array.isArray(temp)){
            fillArray(temp,result);
	} else {		
            result.push(array[i]);
	}
  }
}
var result = [];
fillArray(meta,result);
var resultMap = {};
function fillArrayII(array,result){
    var count = array.length;
    var i = 0;
    if (!count){
        return [];
    }
    for(;i<count;++i){
        var temp = array[i];
        var g = resultMap[temp];
        if(g){
            result.push(g);
	} else {
            if (Array.isArray(temp)){
                fillArrayII(temp,result);
	    } else {
                result.push(temp);
	    }
	}
    }
}
var date1 = new Date();
var time1 = date1.getTime();
var r = [];
fillArrayII(meta,r);
var date2 = new Date();
var time2 = date2.getTime();
console.log('no cache time : ',time2 - time1);
var date3 = new Date();
var time3 = date3.getTime();
var f = [];
fillArrayII(meta,f);
var date4 = new Date();
var time4 = date4.getTime();
console.log('cache time : ',time4 - time3);
尾递归就是把计算结果放到调用者函数的尾部，顶部的返回值越简单越好，而尾巴的返回可能是越来越复杂的计算。

```
###[程序员证明自己智商的时候到了，一大波智力面试题正在靠近](http://mp.weixin.qq.com/s/yLcHLCfVkz5o4vsaC-4NEA)
###[frp内网穿透配置](http://www.kkblog.me/notes/frp%E5%86%85%E7%BD%91%E7%A9%BF%E9%80%8F%E9%85%8D%E7%BD%AE)
https://github.com/fatedier/frp
###[如何让你的分库分表中间件支持emoji表情](http://www.jianshu.com/p/c01843ae82c7?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
###[PHP实现微信开放平台扫码登录源码](https://dev.21ds.cn/article/36.html)
###[Python微信智能回复](http://lafree317.github.io/2017/02/16/%E5%BE%AE%E4%BF%A1%E6%99%BA%E8%83%BD%E5%9B%9E%E5%A4%8D/)
https://github.com/Lafree317/PythonChat 
###[msyql in or效率](https://github.com/zhangyachen/zhangyachen.github.io/issues/60)
select * from table where id in (xxx,xxx,xxx...,xxx)
select * from table where id=xxx or id=xxx or id=xxx ... or id=xxx
在InnoDB引擎下，in返回的顺序是按照主键排序的
当id为主键时，两个sql效率差别不大，都运用了主键进行查询。但是当id上没有索引时，mysql会扫描整个表，对每一个元组的id去in的列表或者or的列表里进行查询 所以在没有索引时，in的效率会高于or。
###[python读取excel](http://biezhi.me/2015/03/12/python-read-excel/)
```js
# -*- coding: utf-8 -*- 
import  xdrlib ,sys
import xlrd

def open_excel(file= 'file.xls'):
    try:
        data = xlrd.open_workbook(file)
        return data
    except Exception,e:
        print str(e)
#根据索引获取Excel表格中的数据   参数:file：Excel文件路径     colnameindex：表头列名所在行的所以  ，by_index：表的索引
def excel_table_byindex(file= 'file.xls',colnameindex=0,by_index=0):
    data = open_excel(file)
    table = data.sheets()[by_index]
    nrows = table.nrows #行数
    ncols = table.ncols #列数
    colnames =  table.row_values(colnameindex) #某一行数据 
    list =[]
    for rownum in range(1,nrows):

         row = table.row_values(rownum)
         if row:
             app = {}
             for i in range(len(colnames)):
                app[colnames[i]] = row[i] 
             list.append(app)
    return list

#根据名称获取Excel表格中的数据   参数:file：Excel文件路径     colnameindex：表头列名所在行的所以  ，by_name：Sheet1名称
def excel_table_byname(file= 'file.xls',colnameindex=0,by_name=u'Sheet1'):
    data = open_excel(file)
    table = data.sheet_by_name(by_name)
    nrows = table.nrows #行数 
    colnames =  table.row_values(colnameindex) #某一行数据 
    list =[]
    for rownum in range(1,nrows):
         row = table.row_values(rownum)
         if row:
             app = {}
             for i in range(len(colnames)):
                app[colnames[i]] = row[i]
             list.append(app)
    return list

def main():
   tables = excel_table_byindex()
   for row in tables:
       print row

   tables = excel_table_byname()
   for row in tables:
       print row

if __name__=="__main__":
    main()
```
https://github.com/ElemeFE/node-interview
###[基于AIML的PHP聊天天机器人](https://github.com/kompasim/chatbot-utf8)
###[mysqlDBA的40条军规](http://mp.weixin.qq.com/s/PtIaqAjs298uH6edEYb2xg)

###[一款国产Nmap在线扫描系统](http://www.freebuf.com/sectool/127670.html)
https://github.com/geekchannel/webmap 工具地址：http://nmap.pay.re
TinyAnalytics：一个轻量级分析工具https://github.com/josephernest/TinyAnalytics
###[PDFLayoutTextStripper：将PDF格式的文档转换成为TXT的纯文本文件](https://github.com/JonathanLink/PDFLayoutTextStripper)
###[image to ascii 的生成器还蛮好玩的](http://lunatic.no/ol/img2aschtml.php)
http://www.xilinjie.com/hao/ 
日常代码审查工具https://github.com/softwaremill/codebrag



###[客户端身份认证](http://veryyoung.me/blog/2015/08/17/client-authentication.html)
生成token：客户端发送用户名和密码，判断账户密码是否正确,如果正确，调用tokenService.storeToken(userId)来生成一个token，并把该token保存在redis中，同时返回给client。

token的规则是

userId|timeStamp
返回给client的token需要进行des加密，并且urlEncode

token的有效时间为半小时

校验token：通过tokenService.checkToken(token)来校验token是否有效


###[2016-02-25PHP 用 curl 读取 HTTP chunked 数据](http://www.ideawu.net/blog/archives/929.html?f=http://blogread.cn/)
```js
$url = "http://127.0.0.1:8100/stream";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'myfunc');
$result = curl_exec($ch);
curl_close($ch);

function myfunc($ch, $data){
    $bytes = strlen($data);
    // 处理 data
    return $bytes;
}function myfunc($ch, $data){
    $bytes = strlen($data);
    static $buf = '';
    $buf .= $data;
    while(1){
        $pos = strpos($buf, "\n");
        if($pos === false){
            break;
        }
        $data = substr($buf, 0, $pos+1);
        $buf = substr($buf, $pos+1);

        // 处理 data
    }
}
```
###[微信支付（公众号）的流程以及各种坑](http://veryyoung.me/blog/2016/01/05/wechat-pay-is-fucking-shit.html)
###[JS 实现的 unix Terminal命令行，数据都记录在浏览器内存中](http://www.masswerk.at/jsuix/)
###[Mysql In 子查询慢](http://veryyoung.me/blog/2015/08/17/mysql-in-slow.html)
```js
SELECT * FROM table_a WHERE id IN (SELECT id FROM table_id_list)
再把ID列表select一次

SELECT * FROM table_a WHERE id IN (SELECT id from(SELECT id FROM table_id_list)) 秒查
SELECT * FROM table_a JOIN (SELECT id FROM table_id_list) id_list ON table_a.id = id_list.id
###[该项目是 J2Cache 的 Python 语言移植版本](https://git.oschina.net/ld/Py3Cache)
###[mysql按日期分组](http://biezhi.me/2015/09/12/mysql-group-by-date/)
1、按月分组：
select month(FROM_UNIXTIME(time)) from table_name group by month(FROM_UNIXTIME(time))
2、按年月分组：
select DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m") from tcm_fund_list group by DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m")
或者：
select FROM_UNIXTIME(time,"%Y-%m") from tcm_fund_list group by FROM_UNIXTIME(time,"%Y-%m")
3、按年月日分组：
select DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m-%d") from tcm_fund_list group by DATE_FORMAT(FROM_UNIXTIME(time),"%Y-%m-%d")
或者：
select FROM_UNIXTIME(time,"%Y-%m-%d") from tcm_fund_list group by FROM_UNIXTIME(time,"%Y-%m-%d")
其中FROM_UNIXTIME(time,"%Y-%m-%d")中的time代表UNIX时间戳的字段名称 
###[Redis 数据备份与恢复](http://biezhi.me/2016/03/07/redis-data-backup-and-recovery/)
redis 127.0.0.1:6379> SAVE 
OK
该命令将在 redis 安装目录中创建dump.rdb文件。

恢复数据
如果需要恢复数据，只需将备份文件 (dump.rdb) 移动到 redis 安装目录并启动服务即可。获取 redis 目录可以使用 CONFIG 命令，如下所示：

redis 127.0.0.1:6379> CONFIG GET dir
1) "dir"
2) "/usr/local/redis/bin"
以上命令 CONFIG GET dir 输出的 redis 安装目录为 /usr/local/redis/bin
```
###[为Nginx目录设置访问密码](http://biezhi.me/2015/05/20/set-access-password-for-nginx-directory/)
```js
http://trac.edgewall.org/export/10770/trunk/contrib/htpasswd.py
执行命令：

chmod 777 htpasswd.py
./htpasswd.py -c -b htpasswd username password
其中htpasswd是生成的文件名

修改nginx的conf

修改nginx.conf或者所要设置的vhost的conf，加入如下语句：

location  ^~ / {
	auth_basic "Password";
	auth_basic_user_file /usr/local/nginx/conf/htpasswd;
}
```
###[协议分析（微信网页版 wx2.qq.com）](http://biezhi.me/2016/02/21/wechat-protocol-analysis/)
Java版实现源码：https://github.com/biezhi/wechat-robot Python实现：https://github.com/Urinx/WeixinBot C#实现：https://github.com/sherlockchou86/WeChat.NET QT实现：https://github.com/xiangzhai/qwx
###[MySQL工具推荐 | 基于MySQL binlog的flashback工具，MySQL下的误操作有后悔药](http://t.cn/Ribd3Kk)
###[Python读写zip压缩文件](http://biezhi.me/2015/09/15/python-read-and-write-zip-compressed-files/)
```js
import zipfile
 
z = zipfile.ZipFile("zipfile.zip", "r")
 
#打印zip文件中的文件列表
for filename in z.namelist(  ):
    print 'File:', filename
 
#读取zip文件中的第一个文件
first_file_name = z.namelist()[0]
content = z.read(first_file_name)
print first_file_name
print content
z = zipfile.ZipFile('test.zip', 'w', zipfile.ZIP_DEFLATED)
z.write('test.html')
z.close( ) 
```
###[无损压缩/放大图片神器推荐](http://mp.weixin.qq.com/s/HpG3vgCXsP-UY6jJpJ_a7Q)
重量级的下载工具
https://imagecyborg.com http://waifu2x.udp.jp/index.zh-CN.html
没想到你是这样的gif动图 http://mp.weixin.qq.com/s?__biz=MzAxMDA5ODk3OQ==&mid=2649327987&idx=1&sn=5003298b1e779bd942d27fa3b41ddc8e&chksm=8348a93fb43f202900133faf8a461d6e6501d891d4a0ce00d4b36e8b898db59c65d709ec8b9f&scene=21#wechat_redirect   小巧的工具
ScreenToGif zhitu.isux.us
###[PHP过滤掉Emoji表情字符](http://www.ideawu.net/blog/category/web/php)
function smarty_modifier_emojistrip($string)
{       
    return preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $string);
}
###[美团点评SQL优化工具SQLAdvisor开源](http://mp.weixin.qq.com/s/idz6b2rls97W4Iw6J-ubng)

GitHub 地址：https://github.com/Meituan-Dianping/SQLAdvisor 
###[10行Python代码的词云](http://mp.weixin.qq.com/s/HysMAAPMY2zLilQVnTUE5A)
###[Python 资源大全中文版](https://segmentfault.com/p/1210000008627120/read#top)
###[所谓mysql的优化，三分是配置的优化，七分是sql语句的优化](http://weibo.com/ttarticle/p/show?id=2309404083337810553196)
https://my.oschina.net/benhaile/blog/849499
###[笑来搜原型 Laravel Scout & ElasticSearch ik http://scout.lijinma.com/search](https://github.com/lijinma/laravel-scout-elastic-demo)
把一个公众账号的文章拉下来，然后实现所有文章的“标题”和“内容”的搜索，在项目中我选择了李笑来老师的”学习学习再学习“中的50篇文章。


###[微信里有哪些优雅装B的小技巧](https://www.zhihu.com/question/45231797)
http://baozoumanhua.com/zhuangbi/list?from=web  暴走漫画装逼神器系列
###[解压文件](http://stackoverflow.com/questions/3263129/unzipping-larger-files-with-php)
```js
图片解压后导致 php 内存溢出
$filename = 'c:\kosmas.zip';
        $archive = zip_open($filename);
        while($entry = zip_read($archive)){
            $size = zip_entry_filesize($entry);
            $name = zip_entry_name($entry);
            $unzipped = fopen('c:/unzip/'.$name,'wb');
            while($size > 0){
                $chunkSize = ($size > 10240) ? 10240 : $size;
                $size -= $chunkSize;
                $chunk = zip_entry_read($entry, $chunkSize);
                if($chunk !== false) fwrite($unzipped, $chunk);
            }

            fclose($unzipped);
        }
        
        $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
 fwrite($fp,"$buf");
浮点数 http://0.30000000000000004.com/
 
```
###[GitHub Page精选](http://blog.githuber.cn/)
MySQL 每次查询一条数据查询十次与一次查询十条数据之间的区别http://blog.githuber.cn/posts/1009
###[ Python3爬虫三大案例实战分享](https://m.hellobi.com/course/156?from=timeline)

https://github.com/Germey/TouTiao/blob/master/spider.py
###[理解 TCP 和 UDP](https://github.com/JerryC8080/understand-tcp-udp?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
###[SQL删除重复记录](http://www.xiangguo.li/sql_and_nosql/2015/01/01/sql)
```js
select * from people
where peopleId in (select  peopleId  from  people  group  by  peopleId  having  count(peopleId) > 1)
select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq  having count(*) > 1)
删除表中多余的重复记录（多个字段），只留有rowid最小的记录

delete from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
5、查找表中多余的重复记录（多个字段），不包含rowid最小的记录

select * from vitae a
where (a.peopleId,a.seq) in  (select peopleId,seq from vitae group by peopleId,seq having count(*) > 1) and rowid not in (select min(rowid) from vitae group by peopleId,seq having count(*)>1)
```
###[前端的甩锅指南](https://zhuanlan.zhihu.com/p/25649277)
如果不在浏览器上，写爬虫脚本的话需要自己把 Cookie 这个 header 带上。很多的 web server 是借助 Cookie 作为用户会话的凭证的，比如存一个唯一的 sessionid 值到 Cookie，每次请求都带上，来判断是哪个用户。如果不用 Cookie 作为会话认证，还有其他方式吗？其实说到底认证就是需要传给服务端有个字段标识哪个用户，那我们可以在头里面加个 Authorization 的字段，其他名字也行，只要跟服务端商量好。
加一些 http 的头也能有效的防御攻击，比如 csp(Content Security Policy)
###[十款好用的图片/视频类工具](http://mp.weixin.qq.com/s/3wpEW0sjf-YWonojgPxYWA)
让照片变成名画--prisma 智能拼图神器--shape collage
###[Mysql数字排序](http://veryyoung.me/blog/2015/08/17/mysql-rank-number.html)
SELECT * FROM  table_name ORDER BY CAST(field_name AS UNSIGNED) 
SELECT * FROM table_name ORDER BY field_name*1 desc
 SELECT * FROM table_name ORDER BY ABS（field_name) desc 
 ###[Usql：SQL数据库的通用命令行界面，用Go语言编写](https://github.com/knq/usql)
 ###[免费的在线格式转换工具](http://www.alltoall.net/)
 ###[数据结构宝典](http://www.ucai.cn/dsviz/)
 ###[github-trending小工具](http://www.jianshu.com/p/25722080c73d?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
 https://github.com/bonfy/github-trending 
 ```js
 def scrape(language, filename):

    HEADERS = {
        'User-Agent'        : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:11.0) Gecko/20100101 Firefox/11.0',
        'Accept'            : 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding'    : 'gzip,deflate,sdch',
        'Accept-Language'    : 'zh-CN,zh;q=0.8'
    }

    url = 'https://github.com/trending/{language}'.format(language=language)
    r = requests.get(url, headers=HEADERS)
    assert r.status_code == 200

    d = pq(r.content)
    items = d('ol.repo-list li')

    # codecs to solve the problem utf-8 codec like chinese
    with codecs.open(filename, "a", "utf-8") as f:
        f.write('\n####{language}\n'.format(language=language))

        for item in items:
            i = pq(item)
            title = i("h3 a").text()
            owner = i("span.prefix").text()
            description = i("p.col-9").text()
            url = i("h3 a").attr("href")
            url = "https://github.com" + url
            f.write(u"* [{title}]({url}):{description}\n".format(title=title, url=url, description=description))
 ```
 
###[php原生的引擎](https://www.zhihu.com/question/39711044)
```js
 

这个是模板文件
<h1><?=$title?></h1>
<ul>
	<?php foreach($list as $value): ?>
		<li><?=$value?></li>
	<?php endforeach; ?>
</ul>

这个是解析文件：
<?php
/**
 * 模板解析
 */
class View{
	protected $path;
	protected $vars;
	public function __construct($path, $vars = []){
		if (is_file($path)) {
			$this->path = $path;
		}
		$this->vars = $vars;
	}

	public function fetch(){
		ob_start();
		ob_implicit_flush(0);
		extract($this->vars, EXTR_OVERWRITE);
		require_once $this->path;
		return ob_get_clean();
	}
}

$view = new View('./index.html', ['title' => 'test', 'list' => ['a', 'b', 'c']]);
echo $view->fetch();

```
###[Git基础(二)--常见撤销操作](http://goldenera.me/2017/02/23/Git%E5%9F%BA%E7%A1%80(%E4%BA%8C)--%E5%B8%B8%E8%A7%81%E6%92%A4%E9%94%80%E6%93%8D%E4%BD%9C/)
```js
撤销工作区文件

git checkout filename
撤销暂存区文件至工作区

git reset filename
撤销本地仓库的某次至工作区

git reset commit
Git 命令行输入如下命令，禁止自动转换换行符

 
git config --global core.autocrlf false
pull 失败 解决方案：取消 Pull 操作然后手动合并
git merge --abort
git reset --merge
checkout : Unable to create ‘/path/project/.git/index.lock’ rm -f ./.git/index.lock
###[不小心敲了rm -rf后](https://www.zhihu.com/question/29438735)
不允许用rm命令的，要删除文件，需要mv文件到指定目录/delete/，会有一个定时任务，每周清空/delete/下文件
mv 文件(夹) /tmp 

(/tmp 下的文件在每次关机后都会被清理干净)
使用了以下命令：brew install safe-rm
echo 'alias rm=/usr/local/safe-rm' >> ~/.profile
不过不是root应该还是删不掉/的吧，反正我没试过。 命令行的回收站，设置alias rm=trash
```
###[Pandas速查手册中文版](https://zhuanlan.zhihu.com/p/25630700)
###[最新任意命令执行漏洞)批量检测工具精简版 ](https://zhuanlan.zhihu.com/p/25628971)
###[我所依赖的记忆方法](https://zhuanlan.zhihu.com/p/25603437)
https://faded12.github.io/conversion/ 记忆转换工具（中/英）
###[Python Web导出有排版要求的PDF文件](https://zhuanlan.zhihu.com/p/25691170)
xhtml2pdf 安装

pip install xhtml2pdf
pip install html5lib==1.0b8
中文字体问题

xhtml2pdf默认不支持中文字体，所以需要下载中文字体，比如:

宋体: simsun
同时要指定html页面的charset， 如：

<meta charset='utf8'/>
###[requests模块的response.text与response.content有什么区别](https://www.zhihu.com/question/56816991)
```js
requests.content返回的是二进制响应内容

而requests.text则是根据网页的响应来猜测编码，如果服务器不指定的话，默认编码是"

ISO-8859-1"
用response.encoding看一下他猜测的编码是啥。我猜应该是ISO-8859-1

然后你用response.encoding = 'utf-8'

然后再 response.text ，返回的内容应该是正常的了.
url = 'http://www.23us.com/class/9_11.html'
  response = requests.get(url)
response.encoding = response.apparent_encoding
resp.text返回的是Unicode型的数据。
resp.content返回的是bytes型也就是二进制的数据。
如果你想取文本，可以通过r.text。 如果想取图片，文件，则可以通过r.content。
（resp.json()返回的是json格式数据）

 # 例如下载并保存一张图片  
import requests  
jpg_url = 'http://img2.niutuku.com/1312/0804/0804-niutuku.com-27840.jpg'  
content = requests.get(jpg_url).content  
with open('demo.jpg', 'wb') as fp:     
    fp.write(content) 
```
###[APACHE VirtualHost的配置](http://goldenera.me/2017/02/16/%E4%BB%8E%E9%9B%B6%E5%BC%80%E5%A7%8B%E5%BB%BA%E7%AB%99(%E4%BA%8C)--VirtualHost%E7%9A%84%E9%85%8D%E7%BD%AE/)
```js
sudo mkdir -p /var/www/mysite.com
sudo chown -R $USER:$USER /var/www/mysite.com
cp /etc/apache2/site-available/default /etc/apache2/site-available/mysite.com
vi mysite.com.conf 
建议的配置文件内容

<VirtualHost *:80>
    ServerAdmin yourEmail@gmail.com
    ServerName www.yoursite.com
    DocumentRoot /var/www/example.com
    ErrorLog ${APACHE_LOG_DIR}/mysite.com/error.log
    CustomLog ${APACHE_LOG_DIR}/mysite.com/access.log
</VirtualHost>
激活配置文件

sudo a2ensite mysite.com.conf
重启apahce

sudo service apache2 restart
```
###[微信消息防撤回工具](https://zhuanlan.zhihu.com/p/25706692)
http://link.zhihu.com/?target=https%3A//pan.baidu.com/s/1c2mWSVm 
如果有朋友发消息给你并撤回你就会收到文件传输助手的通知了。
https://zhuanlan.zhihu.com/p/25689314?utm_source=zhihu&utm_medium=social 
###[cookies 转换 python dict](https://zhuanlan.zhihu.com/p/23208898)
```js
from http.cookies import SimpleCookie

#浏览器中的原始cookies字符串
rawdata = '''omg_first_visit_completed=1; __utmt=1; __utma=114157465.1493803552.1477441810.1477441810.1477441810.1; __utmb=114157465.1.10.1477441810; __utmc=114157465; __utmz=114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'''

from http.cookies import SimpleCookie
cookie = SimpleCookie(rawdata)
cookies = {i.key:i.value for i in cookie.values()}
{'__utmt': '1', 
'omg_first_visit_completed': '1', 
'__utmc': '114157465',
'__utmb': '114157465.1.10.1477441810', '__utma': '114157465.1493803552.1477441810.1477441810.1477441810.1', 
'__utmz': '114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'}
```
