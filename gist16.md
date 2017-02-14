###[微博图床上传图片](https://segmentfault.com/q/1010000008250059)
```js
$cookie = 'your cookie';
$ch = curl_init('http://picupload.service.weibo.com/interface/pic_upload.php'
    . '?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog');

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_VERBOSE => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Cookie: $cookie"],
    CURLOPT_POSTFIELDS => ['b64_data' => base64_encode(file_get_contents('./img.jpg'))],
]);

var_export(curl_exec($ch));

如果要用 http://picupload.service.weibo.com/interface/pic_upload.php?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog 这个 URL 的话
POST 参数必须是 b64_data，值为经过 base64 编码后的字符串

如果要使用 pic1 参数的话，则要用 multipart 方式进行上传，且 URL 中必须包含 cb 参数，cb 参数的值为 http://weibo.com/aj/static/upimgback.html?_wv=5&callback=STK_ijax_ 加(js)时间戳

2种方法相比较的话，我个人倾向于 multipart 方法，因为 base64 编码会使上传文件的体积增加 1/3，不仅上传时间要更久，流量消耗也多了 1/3

具体可看 http://js.t.sinajs.cn/t5/home... 或者
用 fiddler 抓包看下 http://weibo.com/minipublish 的上传过程

或者你可以用我造的轮子 PHP实现的微博图床上传轮子https://github.com/consatan/weibo_image_uploader，支持 PHP 5.5.9 以上版本

        $cookie="";
        $base64_image_content = base64_encode(file_get_contents('d:/gg.jpg'));
        $post_data['b64_data']=$base64_image_content;
        $header = array (); 
        $header [] = 'Content-Type:application/x-www-form-urlencoded';  
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://picupload.service.weibo.com/interface/pic_upload.php?mime=image%2Fjpeg&data=base64&url=0&markpos=1&logo=&nick=0&marks=1&app=miniblog");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS,20);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $output = curl_exec($ch);
        $headers = curl_getinfo($ch);
        print_r($headers);
        curl_close($ch);
        
        成功截图https://ooo.0o0.ooo/2017/02/10/589d505fa2481.png
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
换成

$header [] = "Cookie:$cookie";  
curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
```
###[python模拟登陆微博](https://github.com/ResolveWang/smart_login/blob/master/sina_login/sina_login_by_selenium.py)
```js
import time
from selenium import webdriver
import requests

# 该段代码在ubuntu上能成功运行，并没有在windows上面运行过
# 直接登陆新浪微博
url = 'http://weibo.com/login.php'
driver = webdriver.PhantomJS()
driver.get(url)
print('开始登陆')

# 定位到账号密码表单
login_tpye = driver.find_element_by_class_name('info_header').find_element_by_xpath('//a[2]')
login_tpye.click()
time.sleep(3)

name_field = driver.find_element_by_id('loginname')
name_field.clear()
name_field.send_keys('youraccount')

password_field = driver.find_element_by_class_name('password').find_element_by_name('password')
password_field.clear()
password_field.send_keys('yourpassword')

submit = driver.find_element_by_link_text('登录')
submit.click()

# 等待页面刷新，完成登陆
time.sleep(5)
print('登陆完成')
sina_cookies = driver.get_cookies()

cookie = [item["name"] + "=" + item["value"] for item in sina_cookies]
cookiestr = '; '.join(item for item in cookie)

# 验证cookie是否有效
redirect_url = 'http://weibo.com/p/1005051921017243/info?mod=pedit_more'
headers = {'cookie': cookiestr}
html = requests.get(redirect_url, headers=headers).text
print(html)


```
###[调用网页接口实现发微博（PHP实现）](http://andrewyang.cn/post.php?id=1034)
```js
//https://github.com/yangyuan/weibo-publisher
function rsa_encrypt($message, $e, $n) {
	$exponent = hex2bin($e);
	$modulus = hex2bin($n);
	$pkey = rsa_pkey($exponent, $modulus);
	openssl_public_encrypt($message, $result, $pkey, OPENSSL_PKCS1_PADDING);
	return $result;
}
$message=$servertime."\t".$nonce."\n".$password;
function weibo_get_image_url($pid) {
	$zone = 0;
	$pid_zone = crc32 ($pid);
	$type = 'large'; //bmiddle
	if ($pid[9] == 'w') {
		$zone = ($pid_zone & 3) + 1;
		$ext = ($pid[21] == 'g') ? 'gif' : 'jpg';
		$url = 'http://ww'.$zone.'.sinaimg.cn/'.$type.'/'.$pid.'.'.$ext;
	} else {
		$zone = (hexdec(substr($pid, -2)) & 0xf) + 1;
		$url = 'http://ss'.$zone.'.sinaimg.cn/'.$type.'/'.$pid.'&690';
	}
	return $url;
}
```
###[windows上使用pyvenv进行项目隔离](http://www.jianshu.com/p/d01a85c8995e)
python -m venv test 从python3.4开始，就已经自带了pyvenv，我使用的是python3.5。如果版本低于3.4，可以使用pip安装virtualenv这个库，它们用法基本一致。
cd test/Scripts

activate
deactivate
在A环境中把所有依赖都保存到re.txt中,使用pip freeze:

pip freeze > re.txt
这时会在当前目录生成re.txt,通过记事本可以直接打开:

notepad re.txt
可以看到类似内容:

Flask==0.11.1
Flask-Login==0.3.2
Flask-SQLAlchemy==2.1
我们可以修改该文件来改变我们虚拟环境的相关依赖，比如我们不需要Flask,直接删除Flask==0.11.1即可。

这个文件怎么用呢,我们先激活B虚拟环境，然后可以一条命令安装所有依赖:

pip install -r re.txt
###[使用python+微博进行远程关机](http://www.jianshu.com/p/458a2656ca61)
```js
微博爬虫，使用requets+bs+oracle搭建的爬虫框架。包括对微博搜索、微博信息和用户资料的抓取、解析、存储和可视化展示https://github.com/ResolveWang/WeiboSpider
beautifulsoup我用得最多的是find(attrs={key: value})
 def get_newest(session, uid):
    # 获取只含有原创内容的个人主页
    url = 'http://weibo.com/' + uid + '/profile?profile_ftype=1&is_ori=1#_0'
    page = session.get(url).text
    soup = BeautifulSoup(page, 'html.parser')
    scripts = soup.find_all('script')
    status = ' '
    for s in scripts:
        if 'pl.content.homeFeed.index' in s.string:
                status = s.string
    #用正则表达式获取微博原创内容
    pattern = re.compile(r'FM.view((.*))')
    rs = pattern.search(status)
    if rs:
        cur_status = rs.group(1)
        html = json.loads(cur_status).get('html')
        soup = BeautifulSoup(html, 'html.parser')
        # 获取最新一条微博所有信息
        newest = soup.find(attrs={'action-type': 'feed_list_item'})
        # 获取最新发布内容
        post_cont = newest.find(attrs={'node-type': 'feed_list_content'}).text.strip()
        # 获取最新发布时间
        post_stamp = int(newest.find(attrs={'node-type': 'feed_list_item_date'}).get('date')[:-3])
        post_time = datetime.fromtimestamp(post_stamp)
        now = datetime.now()
        # 计算此刻和发布时间的时间差(单位为秒)
        t = (now - post_time).total_seconds()
        return post_cont, t
    else:
        return None
```
###[一段 Python 监测 HTTP 服务状态的脚本](http://andrewyang.cn/post.php?id=1058)
```js
#!/usr/bin/env python

import sys
import httplib
import time
import subprocess
import logging

def check():
    connection = httplib.HTTPConnection('127.0.0.1')
    connection.request('GET', '/')
    # 这个地方请求的是首页，也可以专门做个页面请求
    response = connection.getresponse()
    return response.status

if __name__ == '__main__':

    logging.basicConfig(format='%(asctime)s [%(levelname)s] %(message)s', datefmt='%Y-%m-%d %H:%M:%S', filename='daemon.log', level=logging.DEBUG)
    # 弄个一个日志，备查，参考了nginx的日志格式

    try:
        counter = 0
        while True:
            time.sleep(1)
            # 查询间隔是1秒
            status = check()
            logging.debug(str(status))
            if status == 200:
                counter = 0
                sys.stdout.write('.')
                sys.stdout.flush()
                # 注意这个地方需要 flush
            if status == 502:
                counter += 1
                # 这个地方有个计数器，当15次502之后才会进行操作
                if counter >= 15:
                    print ''
                    subprocess.call('service php5-fpm restart', shell=True)
                    print 'done restart php5-fpm'
                    logging.info('done restart php5-fpm')
                    counter = 0
                else:
                    sys.stdout.write('*')
                    sys.stdout.flush()
    except KeyboardInterrupt:
        # Ctrl+C
        print ''
        pass
```
###[配置高并发 UBUNTU、NGINX、PHP、MYSQL](http://andrewyang.cn/post.php?id=1026)
````js
文件描述符可以看作是 Linux 的 IO 句柄，默认限制在 1024 个活动描述符。
echo 'net.core.somaxconn = 65536' >> /etc/sysctl.conf
echo 'net.core.netdev_max_backlog = 65536' >> /etc/sysctl.conf
sysctl -p

index index.html index.php;
location ~ \.php$ {
	fastcgi_split_path_info ^(.+\.php)(/.+)$;
	fastcgi_pass unix:/dev/shm/php5-fpm.sock;
	fastcgi_index index.php;
	include fastcgi_params;
}
```
###[一个RSA加密的实际数学和编程实现过程](http://andrewyang.cn/post.php?id=1036)
```js
echo strlen('xxx')."\r\n";
echo strlen('xxx'."\0")."\r\n";
function rsa_encrypt($message, $e, $n) {
	$exponent = hex2bin($e);
	$modulus = hex2bin($n);
	$pkey = rsa_pkey($exponent, $modulus);
	openssl_public_encrypt($message, $result, $pkey, OPENSSL_PKCS1_PADDING);
	return $result;
}

function rsa_encrypt($message, $e, $n) {
	$exponent = hex2bin($e);
	$modulus = hex2bin($n);
	$pkey = rsa_pkey($exponent, $modulus);
	
	$length = strlen($modulus);
	$length_padding = $length - strlen($message) - 2;
	$padding = "\x00";
    while (strlen($padding) < $length_padding) {
        $padding = "\xFF".$padding;
    }
	$message = "\0\2".$padding.$message;
	
	openssl_public_encrypt($message, $result, $pkey, OPENSSL_NO_PADDING);
	return $result;
}
```
###[编程生成PEM格式的RSA公钥](http://andrewyang.cn/post.php?id=1037)
```js
-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgOsqOFaGYYh/oYC921yr1fIce/1ZwJDLLSRah6wl
MGKIJykpPlUGNQUI5/mqO7d/QzMjFJD5FfbWPFX+LwikmzU/RErTmTyswC23hKu7jkKpsbv/+zi+
GNeOh6DkG5uPc6ko7gzO4fZzmIS5d35P6eiKG75JWSesSnmbMYHWRCRDAgMBAAE=
-----END PUBLIC KEY-----
function rsa_pkey($exponent, $modulus) {
	$modulus = pack('Ca*a*', 0x02, asn1_length(strlen($modulus)), $modulus);
    $exponent = pack('Ca*a*', 0x02, asn1_length(strlen($exponent)), $exponent);
	$oid = pack('H*', '300d06092a864886f70d0101010500'); // MA0GCSqGSIb3DQEBAQUA，这段我也特么不知道是啥
	
	$pkey =	$modulus.$exponent;
	$pkey = pack('Ca*a*', 0x30, asn1_length(strlen($pkey)), $pkey);
	$pkey = pack('Ca*', 0x00, $pkey);
	$pkey = pack('Ca*a*', 0x03, asn1_length(strlen($pkey)), $pkey);
	$pkey = $oid.$pkey;
	$pkey = pack('Ca*a*', 0x30, asn1_length(strlen($pkey)), $pkey);
	$pkey = '-----BEGIN PUBLIC KEY-----'."\r\n".chunk_split(base64_encode($pkey)).'-----END PUBLIC KEY-----';
	return $pkey;
}
```
###[PHP 性能追踪及分析工具（XHPROF）配置问题xhprof.output_dir='' ](https://segmentfault.com/q/1010000008342162)
//源码安装
cd /usr/local/src
wget http://pecl.php.net/get/xhprof-0.9.4.tgz
tar zxvf xhprof-0.9.4.tgz
cd xhprof-0.9.4/extension/
/usr/local/php/bin/phpize
./configure --with-php-config=/usr/local/php/bin/php-config
make
make install

//在 php.ini 末尾新增
[xhprof]

extension = xhprof.so

xhprof.output_dir = 自定义文件夹(/tmp/xhprof_log)
// /tmp/xhprof_log 必须存在且有写入权限

//重启环境
//代码中查看 phpinfo 是否包含 xhprof。
//一切顺利的话，那么 xhprof 安装成功。

###[表增加索引而不影响使用](https://segmentfault.com/q/1010000008339569)
```js
这个需要看你用的mysql版本以及使用的存储引擎是否是innodb
mysql的5.1如果使用innodb插件或者是5.5版本使用innodb引擎有InnoDB Fast Index Creation，对于新建或者删除二级索引，不用复制表，效率有很大提高，但是只允许读操作，不允许修改操作。

而5.6版本中引入的innodb-online-ddl，在新建或者删除二级索引的时候可以并发执行DML语句，除了建索引操作会消耗硬件资源，不影响表的正常使用。

具体方案需要你根据数据库和存储引擎的情况来选择，如果版本满足，使用online ddl特性可以满足需求
```
###[python urlretrieve第二个参数是文件名，文件名里面是不允许有斜杠的](https://segmentfault.com/q/1010000008340234)
```js
FileNotFoundError: [Errno 2] No such file or directory:
download_link=['http://gnondgnoqnioandiofnas_swn_ssy_mhtng.jpg','http://asnoqenconvoqenripetn_swn_ssy_mhtng.jpg','http://asdnioqnoqwrqwenoqwr/12345/123/1256.gif']
for item in download_link:
    urllib.request.urlretrieve(item,folder_path + item[-19:])
    urllib.request.urlretrieve(item,folder_path + item.split('/')[-1])
    time.sleep(2)
    print('Done')
```
###[jQuery JSONP跨域原理](https://segmentfault.com/q/1010000008341945)
```js
script标签是不受同源限制的、只要能get到的资源文件就可以加载、所以JSONP是get方法用回调请求JSON
var eleScript= document.createElement("script"); 
eleScript.type = "text/javascript"; 
eleScript.src = "http://example2.com/getinfo.php"; 
document.getElementsByTagName("HEAD")[0].appendChild(eleScript); 
https://segmentfault.com/q/1010000000483131
 jQuery(document).ready(function(){ 
        $.ajax({
             type: "get",
             async: false,
             url: "http://flightQuery.com/jsonp/flightResult.aspx?code=CA1998",
             dataType: "jsonp",
             jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(一般默认为:callback)
             jsonpCallback:"flightHandler",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名，也可以写"?"，jQuery会自动为你处理数据
             success: function(json){
                 alert('您查询到航班信息：票价： ' + json.price + ' 元，余票： ' + json.tickets + ' 张。');
             },
             error: function(){
                 alert('fail');
             }
         });
     });
```     
###[swoole中的websocket的如何发给指定人消息.](https://segmentfault.com/q/1010000008243298)
foreach($ws->connections as $fd) {
        //发送信息
        $ws->push($fd, $msg);
    }
    //当用户进入A直播间
$redis->sadd('RoomA', $fd);
//获取所有属于A直播间下的用户的fd
$clients = $redis->smembers('RoomA');
foreach($clients as $key => $fd) {
    $ws->push($fd, $msg);
}
###[对象属性](https://segmentfault.com/q/1010000008340167)
```js
> var a = {A: "test", B: "what"}
undefined
> var A = 'B'
undefined
> a.A
'test'
> a[A]
'what'
如果你用点“.”访问，访问的属性是dictionary.$1，即$1为字符串，而当以[]访问时，是将$1内存的值作为变量的属性
var str = "今天{tianqi}很好,我的{xinqing}很糟,因为明天是{qingren}节!";
     var dictionary = {
        "tianqi":"天气",
        "xingqing":"心情",
        "qingren":"情人"
     }
     str = str.replace(/{(\w+)}/g,function(match,$1){
        console.log($1);
        return dictionary.$1;
     });
     alert(str);
     
       var str = "今天{tianqi}很好,我的{xinqing}很糟,因为明天是{qingren}节!";
     var dictionary = {
        "tianqi":"天气",
        "xingqing":"心情",
        "qingren":"情人"
     }
     str = str.replace(/{(\w+)}/g,function(match,$1){
        console.log($1);
        return dictionary[$1];
     });
     alert(str);
```
###[js匿名自执行函数的问题](https://segmentfault.com/q/1010000008342519)
```js
//第一种
var counter = (function(){
    var i = 0;
    return {
        get: function(){
            return i;
        },
        set: function(val){
            i = val;
        },
        increment: function(){
            return ++i;
        }
    }
}());
var counter = {
    i: 0,
    get: function(){
            return this.i;
    },
    set: function(val){
            this.i = val;
    },
    increment: function(){
            return ++this.i;
    }
}
```
###[python 使用requests 访问 繁体字网站会出现乱码](https://segmentfault.com/q/1010000008341385)
```js
<html>
<head>
<meta name='MS.LOCALE' content='ZH-TW'>
<title>Hong Kong Exchanges and Clearing Limited</title>
<meta http-equiv='Content-Type' content='text/html; charset=big5'>
r = requests.get('http://www.hkex.com.hk/chi/stat/smstat/dayquot/d170202c.htm')
r.encoding = 'big5'
```
###[python for]()
```js
>>> dir(range)
['__class__', '__contains__', '__delattr__', '__dir__', '__doc__', '__eq__', '__format__',   
'__ge__', '__getattribute__', '__getitem__', '__gt__', '__hash__', '__init__', '__iter__',   
'__le__', '__len__', '__lt__', '__ne__', '__new__', '__reduce__', '__reduce_ex__',   
'__repr__', '__reversed__', '__setattr__', '__sizeof__', '__str__', '__subclasshook__',   
'count', 'index', 'start', 'step', 'stop']  

>>> dir(str)
['__add__', '__class__', '__contains__', '__delattr__', '__dir__', '__doc__', '__eq__',   
'__format__', '__ge__', '__getattribute__', '__getitem__', '__getnewargs__', '__gt__',   
'__hash__', '__init__', '__iter__', '__le__', '__len__', '__lt__', '__mod__', '__mul__', 
'__ne__', '__new__', '__reduce__', '__reduce_ex__', '__repr__', '__rmod__', '__rmul__', 
'__setattr__', '__sizeof__', '__str__', '__subclasshook__', 'capitalize', 'casefold', 
'center', 'count', 'encode', 'endswith', 'expandtabs', 'find', 'format', 'format_map',
 'index', 'isalnum', 'isalpha', 'isdecimal', 'isdigit', 'isidentifier', 'islower', 
'isnumeric', 'isprintable', 'isspace', 'istitle', 'isupper', 'join', 'ljust', 'lower', 
'lstrip', 'maketrans', 'partition', 'replace', 'rfind', 'rindex', 'rjust', 'rpartition', 
'rsplit', 'rstrip', 'split', 'splitlines', 'startswith', 'strip', 'swapcase', 'title',
 'translate', 'upper', 'zfill']

查看这两个的共有属性
我们关注__iter__属性，他们两个都有这个函数，如果你查看其他可以使用for循环迭代的对象，你都可以发现这个特殊方法。
>>> set(dir(range)) & set(dir(str))
{'__hash__', '__eq__', '__contains__', '__iter__', '__getitem__', 'count', '__lt__', 
'__dir__', '__le__', '__subclasshook__', '__ge__', '__sizeof__', '__format__', '__len__', 
'__ne__', '__getattribute__', '__delattr__', '__reduce_ex__', '__gt__', '__reduce__', 
'__setattr__', '__doc__', '__class__', '__new__', '__repr__', '__init__', 'index', '__str__'}

>>> iter([1, 2])
<list_iterator object at 0x000001A1141E0668>
>>> iter(range(0, 10))
<range_iterator object at 0x000001A1124C6BB0>
>>> iter("abc")
<str_iterator object at 0x000001A1141E0CF8>
>>>
iter函数返回的对象我们称之为iterator，iterator只需要做一件事，那就是调用next(iterator)方法，返回下一个元素。

>>> t = iter("abc")
>>> next(t)
'a'
>>> next(t)
'b'
>>> next(t)
'c'
>>> next(t)
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
StopIteration
>>> t = iter(range(90, 0, -1))
>>> t
<range_iterator object at 0x000001A1124C6BB0>
>>> next(t)
90
>>> next(t)
89
>>> next(t)
88
```
###[PHP-CRUD-API](https://segmentfault.com/q/1010000008335958)
```js
https://github.com/mevdschee/php-crud-api 
$api = new PHP_CRUD_API(array(
    'username'=>'xxx',
    'password'=>'xxx',
    'database'=>'xxx',
));
$api->executeCommand();
```
###[PHP在类的定义中访问属性，为什么属性名有时要加"$"，有时却不用](https://segmentfault.com/q/1010000008344200)
```js
<?php
  class Test
  {
    private $property;

    function __destruct()
    {
        echo "Destroying ".$this->$property."<br />";
    }
    function __set($name,$value)
    {
        $this->$name = $value;
    }
  }
  $a = new Test();
  $a->property = 5;
?>
在__set()方法中，你设置__set("a", 1),$name作为局部变量，会转化为"a", $this->$name等价于$this->a,
在__destruct()中, 局部变量$property未定义，会有一个默认值""，属性值不能为空字符串，所以报错。
```
###[mysql InnoDB是没有直接保存表的数据总数的](https://segmentfault.com/q/1010000008343582)
```js
select count(*) from emp;要扫一遍索引，反复查当然要耗CPU。

我的测试表有两千万数据，没缓存时count(*)要15秒，有缓存后也要3秒
mysql> show table status where name='users'\G
*************************** 1. row ***************************
           Name: users
         Engine: InnoDB
        Version: 10
     Row_format: Compact
           Rows: 665
 Avg_row_length: 295
    Data_length: 196608
Max_data_length: 0
   Index_length: 245760
      Data_free: 14680064
 Auto_increment: 982
    Create_time: 2016-12-07 11:07:37
    Update_time: NULL
     Check_time: NULL
      Collation: utf8_unicode_ci
       Checksum: NULL
 Create_options:
        Comment: 用户信息表, 包括主账号和子账号的用户数据都在这个表里
可以区分两者。
1 row in set (0.10 sec)
```
###[程序错误后 再执行一次](https://segmentfault.com/q/1010000008332753)
```js
function add($number = 1)
{ 
   
   $name = '';
   for ($i=0; $i < 10; $i++) { 
      $name .= mt_rand(0,9);   
   }     
   //$sql = "insert into user ('name') values($name)";
    $PDO->exet($sql);   
    if(!$res){
        // 第一次调用add方法 生成rand 失败则再调用一下自身
        // 第二次失败的话 就返回FALSE
        if($number == 1) $this->add(2);
        else return FALSE;
        
    } 
}
```
