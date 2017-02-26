###[爬虫入门到精通-网页的下载](https://zhuanlan.zhihu.com/p/25198314)

我们爬取一个网页的步骤可以分为如下：

打开要爬取的网页
打开开发者工具，并让请求重发一次（简单讲就是抓包）
找到正确的请求
用程序模拟发送
小提示：当你要抓的网页是会自动跳转的话，那么你需要选中“proserve log”

意思是不要在页面重新加载后清除log（抓知乎登录的包会用到）
###[分享6个学外语的高质量免费网站](https://zhuanlan.zhihu.com/p/25082038)
###[原来还有这么多实用的工具呀，估计好多你都还不知道](https://zhuanlan.zhihu.com/p/25419805)
Clipboard Plus 是一个类似锤子手机BigBang 的Android App
Pushbullet 是一款跨平台消息推送工具
向日葵远程控制是一款支持多平台的远程控制软件。

它支持Android，iOS，Windows，Mac，Linux 各平台可以相互控制，比如苹果手机控制华为手机，Win 控制Mac，再也不用担心女朋友或者家人遇到不会的问题啦。
茄子快传是一款面对面互传工具。

它可以随时和朋友分享手机或者电脑上的照片，视频，音频以及任何格式的文件，就是大文件也一样很快。
###[三分钟学会Scrapy选择器(selectors)](https://zhuanlan.zhihu.com/p/25411797)
```js
>>> from scrapy import Selector
>>> sel = Selector(text='<a href="#">Click here to go to the <strong>Next Page</strong></a>')
>>> sel.xpath('//a//text()').extract() # take a peek at the node-set
[u'Click here to go to the ', u'Next Page']
>>> sel.xpath("//a[contains(., 'Next Page')]").extract()
[u'<a href="#">Click here to go to the <strong>Next Page</strong></a>']
 >>> from scrapy import Selector
>>> sel = Selector(text='<div class="hero shout"><time datetime="2014-07-23 19:00">Special date</time></div>')
>>> sel.css('.shout').xpath('./time/@datetime').extract()
[u'2014-07-23 19:00']

http://link.zhihu.com/?target=http%3A//blog.csdn.net/zhm9484/article/details/47423215
 http://link.zhihu.com/?target=http%3A//www.jianshu.com/p/b7f41df6202d 
```
###[python爬虫 scrapy框架 知乎zhihu 模拟登陆](http://blog.csdn.net/zhm9484/article/details/47423215#)
```js
#coding=utf-8  
  
from scrapy.spiders import CrawlSpider  
from zhihu_user.items import *  
import scrapy  
  
  
class ZhihuUserSpider(CrawlSpider):  
    name = "zhihu_user"  
    allowed_domains = ['zhihu.com']  
    start_urls = ["http://www.zhihu.com"]  
  
      
      
    #要cookie！！！！！  
    cook = {'_za':'fa9fc68f-11cf-4ac5-988c-c96a71314555',  
        'cap_id':'OTZkYWNhM2U5NjNjNDY0YjhiY2RlZTY5ZWU2YzQxOTM=|1437467003|4e4efe7eac594758447752d643bd2d09a55da003',  
        '_ga':'GA1.2.1564443706.1436181504',  
        'q_c1':'a0fa2a995d2b42508c989033b99f8b59|1438829781000|1436181610000',  
        'Hm_lvt_16374ac3e05d67d6deb7eae3487c2345':'1438829813',  
        'CNZZDATA1255966030':'2033776647-1438828198-http%253A%252F%252Fwww.zhihu.com%252F%7C1438828198',  
        '_xsrf':'c0fb9d9a1e9fd2d2c13f873c8b632084' ,  
        'tc':'AQAAAAWHFmdKTAYAMYVscUxEq23ssAJS',  
        'z_c0':'QUFBQVV1Y2tBQUFYQUFBQVlRSlZUWmY2NzFYZ3FydEdUSENERHBvZk12SVRQVFVhVFE2OUJRPT0=|1439198615|9846ac1f6283b21c5ac397c52b5d91dbd8a4ad18',  
        'unlock_ticket':'QUFBQVV1Y2tBQUFYQUFBQVlRSlZUWjkweUZYMHZ3RzJSVjhFR1o2R0thY2RhZkxxOExlajJRPT0=|1439198615|040bb323faec37453cdb5b285feeb58e8162bee1',  
        '__utmt':'1',  
        '__utma':'51854390.1564443706.1436181504.1439197715.1439198983.2',  
        '__utmb':'51854390.9.9.1439199033355',  
        '__utmc':'51854390',  
        '__utmz':'51854390.1439198983.2.2.utmcsr=baidu|utmccn=(organic)|utmcmd=organic',  
        '__utmv':'51854390.100-1|2=registration_date=20140128=1^3=entry_date=20140128=1'  
        }  
  
  
      
    def start_requests(self):     #登陆  
        return [scrapy.FormRequest(  
            "http://www.zhihu.com/login/email",  
            formdata = {'email':youremail,  
                '_xsrf':从request的headers中获取  
                'remember_me':'true',  
                'password':yourpassword  
                },  
                cookies = self.cook,  
            callback = self.after_login  
            )]  
  
    def after_login(self, response):  
        print 'after login'  
        for url in self.start_urls:  
  
            request = self.make_requests_from_url(url)  
              
            yield request  
```
###[免费网页抓取软件-网络爬虫工具-GooSeeker网络爬虫](http://www.gooseeker.com)
###[小白进阶之Scrapy第二篇（登录篇）](https://zhuanlan.zhihu.com/p/25418605)
```js
作者：Python爱好者
链接：https://zhuanlan.zhihu.com/p/25418605
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

from scrapy.spiders import CrawlSpider, Rule, Request ##CrawlSpider与Rule配合使用可以骑到历遍全站的作用、Request干啥的我就不解释了
from scrapy.linkextractors import LinkExtractor ##配合Rule进行URL规则匹配
from haoduofuli.items import HaoduofuliItem ##不解释
from scrapy import FormRequest ##Scrapy中用作登录使用的一个包

class myspider(CrawlSpider):

    name = 'haoduofuli'
    allowed_domains = ['haoduofuli.wang']
    start_urls = ['http://www.haoduofuli.wang']

    rules = (
        Rule(LinkExtractor(allow=('\.html',)), callback='parse_item', follow=True),
    )

def parse_item(self, response):
        item = HaoduofuliItem()
        item['url'] = response.url
        item['category'] = response.xpath('//*[@id="content"]/div[1]/div[1]/span[2]/a/text()').extract()[0]
        item['title'] = response.xpath('//*[@id="content"]/div[1]/h1/text()').extract()[0]
        item['imgurl'] = response.xpath('//*[@id="post_content"]/p/img/@src').extract()
return item
```
###[AI已经不只会填色了](https://zhuanlan.zhihu.com/p/25401772)

http://link.zhihu.com/?target=http%3A//affinelayer.com/pixsrv/ 
可能是最近看过最棒的深度学习在线图像转换演示。

已经不是填色那么简单了，它可以将灵魂画手的线稿变成逼真的实物图。

###[【Git操作系列】Git由浅入深之安装与配置](https://zhuanlan.zhihu.com/p/25348278?refer=dreawer)
###[领导让你去扒网站 ](https://www.zhihu.com/question/56238870)
wget -p -H -e robots=off https://www.baidu.com
###[装修的你还在为油烟机选择发愁吗？---抓取老板和方太数据](https://zhuanlan.zhihu.com/p/25397997)

```js
 

#价格是单独获取的 在network的js中
import json
def Price(url):
    newurl1=url.split('/')[-1].strip('.html')
    newurl2='http://pas.suning.com/nspcsale_0_000000000'
    newurl3='_000000000'
    newurl4='_0000000000_110_551_5510101_20358_1000002_9001_10008_Z001__.html?'
    newurl=newurl2+newurl1+newurl3+newurl1+newurl4
    res2=requests.get(newurl)
    res2.encoding='utf-8'
    res2=json.loads(res2.text.lstrip("pcData(").rstrip(")\n"))
return res2['data']['price']['saleInfo'][0]['netPrice']

#获取商品参数的keys
def Getparam(url):
    res1=requests.get(url)
    res1.encoding='utf-8'
    soup1=BeautifulSoup(res1.text,'html.parser')
    a=soup1.select('#itemParameter')[0].text
    a=a.split('\n\n\n')
    a.remove('\n\n主体')
    b=['价格']
for each1 in range(len(a)):
if each1%2==0:
            b.append(a[each1])
return b[:-1]

#获取商品参数的values
def Getparam1(url):
    res1=requests.get(url)
    res1.encoding='utf-8'
    soup1=BeautifulSoup(res1.text,'html.parser')
    a=soup1.select('#itemParameter')[0].text
    a=a.split('\n\n\n')
    a.remove('\n\n主体')
    b=[Price(url)]
for each1 in range(len(a)):
if each1%2==1:
            b.append(a[each1])
return b

#生成字典 目的是用字典生成dataframe
def Getgroup(url):
return dict(zip(Getparam(url),Getparam1(url)))
```
###[自动化IT工具ansible使用指南](https://zhuanlan.zhihu.com/p/25387801)
###[7 款 Python 数据图表工具的比较](https://zhuanlan.zhihu.com/p/25390965)
###[如何用一个循环语句输出九九乘法表？](https://www.zhihu.com/question/55768263)
```js
t = """1*1=1
2*1=2 2*2=4
3*1=3 3*2=6 3*3=9
4*1=4 4*2=8 4*3=12 4*4=16
5*1=5 5*2=10 5*3=15 5*4=20 5*5=25
6*1=6 6*2=12 6*3=18 6*4=24 6*5=30 6*6=36
7*1=7 7*2=14 7*3=21 7*4=28 7*5=35 7*6=42 7*7=49
8*1=8 8*2=16 8*3=24 8*4=32 8*5=40 8*6=48 8*7=56 8*8=64
9*1=9 9*2=18 9*3=27 9*4=36 9*5=45 9*6=54 9*7=63 9*8=72 9*9=81
"""
seq 9 | sed 'H;g' | awk -v RS='' '{for(i=1;i<=NF;i++)printf("%dx%d=%d%s", i, NR, i*NR, i==NR?"\n":"\t")}'
for i in [0]:
    print(t)

 excel https://www.zhihu.com/question/55768263/answer/148334879?group_id=818696197811343360
 =IF(B$1<=$A2,B$1&"×"&$A2&"＝"&B$1*$A2,"")
```
###[不能翻墙的情况下，如何更新chrome？](https://www.zhihu.com/question/34931031)
https://link.zhihu.com/?target=http%3A//chrome.wbdacdn.com/  chrome更新工具。
###[一个页面中嵌套了几个iframe，怎么获取iframe中的元素?](https://www.zhihu.com/question/46161155)
document.querySelector('iframe').contentDocument.querySelectorAll('*')
###[这个前端面试在搞事！](https://zhuanlan.zhihu.com/p/25407758)
```js
for (var i = 0; i < 5; i++) {
  console.log(i);
}
for (var i = 0; i < 5; i++) {
  setTimeout(function() {
    console.log(i);
  }, 1000 * i);
}
for (var i = 0; i < 5; i++) {
  (function(i) {
    setTimeout(function() {
      console.log(i);
    }, i * 1000);
  })(i);
}
for (var i = 0; i < 5; i++) {
  (function() {
    setTimeout(function() {
      console.log(i);
    }, i * 1000);
  })(i);
}
for (var i = 0; i < 5; i++) {
  setTimeout((function(i) {
    console.log(i);
  })(i), i * 1000);
}
```
###[13个不可忽视的优秀 Python 库](https://zhuanlan.zhihu.com/p/25368640)
Gooey

简介： 一条命令，将命令行程序变成一个 GUI 程序。
Python-docx

简介：以编程方式创建和操纵 Microsoft Word .docx 文件。
cat >test.py <<EOF
import requests
EOF
###[这些小众但有趣的网站](https://zhuanlan.zhihu.com/p/25358895)
局域网下同步文字与图片-Simple.Savr
https://link.zhihu.com/?target=https%3A//www.ssavr.com/
###[Python网络编程的入门之路](https://zhuanlan.zhihu.com/p/25354747)
```js
python3 -m http.server 8000
Serving HTTP on 0.0.0.0 port 8000 ...

在命令行用tcpdump来监听本地网卡的tcp连接，

tcpdump -i lo0 port 8000
或者你也可以用-w参数把信息写出到文件，再通过wireshark来观察结果：

tcpdump -i lo0 port 8000 -w test.cap
现在执行程序：

bash-3.2$ python test.py

 import socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect(('127.0.0.1', 8000))
sock.send(b'GET / HTTP/1.1\r\nHost: 127.0.0.1:8000\r\n\r\n')
data = sock.recv(4096)
print(data)
sock.close()
 import socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
sock.bind(('127.0.0.1', 8000))
sock.listen(5)
while 1:
    cli_sock, cli_addr = sock.accept()
    req = cli_sock.recv(4096)
    cli_sock.send(b'hello world')
    cli_sock.close()

 
```
###[PHP: 运算符优先级](https://www.zhihu.com/question/56093849)
```js
跟运算符优先级有关,逻辑或(||)优先级比赋值运算符(=)高.
if条件 $a = 5 || $b = 7 相当于 $a = (5 || $b = 7)
逻辑或运算 (5 || $b = 7) 判断到左边的5为true,就不再执行右边的逻辑(所以$b的值仍是5),整个表达式返回值是true,于是$a的值为true,$a++后$a的值为1,$b++后$b的值为6.

其实我也有困惑,为什么当$a的值为true时,$a++后$a的值为1,而不是像(true+1)为2.

如果要按预期,赋值时前后最好加上括号:
if( ($a = 5) || ($b = 7) ) {}

if( ($stmt = $db->prepare($sql)) && $stmt->execute(array($id)) ) {
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
} else { 
	return false;
}

 
```
###[躺着也中枪，我是如何任意重置你密码的~](https://zhuanlan.zhihu.com/p/25322731)
非安全技术爱好者请勿加入！ 。。。暗号是: 知乎 群号 517927936
###[Python 实战计划：7天上线苹果官网](https://zhuanlan.zhihu.com/p/25315677)
http://study.163.com/course/introduction.htm?courseId=1003245017#/courseDetail
###[利用cookie模拟网站登录](https://zhuanlan.zhihu.com/p/25332701)
```js
 #创建一个带有cookie的opener，在访问登录的URL时，将登录后的cookie保存下来，然后利用这个cookie来访问其他网址。

import urllib
import urllib2
import cookielib

filename = 'cookie.txt'
#声明一个MozillaCookieJar对象实例来保存cookie，之后写入文件
cookie = cookielib.MozillaCookieJar(filename)
opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cookie))
postdata = urllib.urlencode({
'stuid':'201200131012',
'pwd':'23342321'
		})
#登录教务系统的URL
loginUrl = 'http://jwxt.sdu.edu.cn:7890/pls/wwwbks/bks_login2.login'
#模拟登录，并把cookie保存到变量
result = opener.open(loginUrl,postdata)
#保存cookie到cookie.txt中
cookie.save(ignore_discard=True, ignore_expires=True)
#利用cookie请求访问另一个网址，此网址是成绩查询网址
gradeUrl = 'http://jwxt.sdu.edu.cn:7890/pls/wwwbks/bkscjcx.curscopre'
#请求访问成绩查询网址
result = opener.open(gradeUrl)
print result.read()
```
###[前端开发面试题](https://github.com/markyun/My-blog/tree/master/Front-end-Developer-Questions)

###[《The Way to Go》中文译本，中文正式名《Go入门指南》](https://github.com/sushengbuhuo/the-way-to-go_ZH_CN)
###[文件下载服务](https://github.com/LyricTian/snail)
$ go get -u github.com/LyricTian/snail
$ cd github.com/LyricTian/snail
$ go build -o snail
$ ./snail
在浏览器中打开http://localhost:8099
###[PHP接入微信退款接口](https://segmentfault.com/a/1190000006561282)
https://github.com/helei112g/payment 
###[微信的三种支付方式接入：APP支付、公众号支付、扫码支付](https://helei112g.github.io/2016/08/10/微信的三种支付方式接入：APP支付、公众号支付、扫码支付/)

三种支付方式返回值因为处理方式不同，微信方面返回了不同的类型。

app支付返回了需要调用的数组。调用客户端的方式 查看微信文档
扫码支付返回了一个地址。可生成一个二维码，完成支付。
公众号支付，返回的是一个json数据。可直接放入微信的sdk完成jsapi调用。
```js
use Payment\ChargeContext;
use Payment\Config;
use Payment\Common\PayException;

// 微信支付，必须设置时区，否则发生错误
date_default_timezone_set('Asia/Shanghai');

//  生成订单号 便于测试
function createPayid()
{
    return date('Ymdhis', time()).substr(floor(microtime()*1000),0,1).rand(0,9);
}

// 订单信息
$payData = [
    "order_no"	=> createPayid(),
    "amount"	=> '0.01',// 单位为元 ,最小为0.01
    "client_ip"	=> '127.0.0.1',
    "subject"	=> '测试支付',
    "body"	=> '支付接口测试',
    "extra_param"	=> '',
];

// 微信扫码支付，需要设置的参数
$payData['product_id']  = '123456';

// 微信公众号支付，需要的参数
$payData['openid'] = 'otijfvr2oMz3tXnaQdKKbQeeBmhM';// 需要通过微信提供的api获取该openid

/**
 * 包含客户的配置文件
 * 本次 2.0 版本，主要的改变是将配置文件独立出来，便于客户多个账号的情况
 * 已经使用不同方式读取配置文件，如：db  file   cache等
 */
$wxconfig = [
    'app_id'    => 'wxxxx',  // 公众账号ID
    'mch_id'    => 'xxxx',// 商户id
    'md5_key'   => 'xxxxxx',// md5 秘钥

    'notify_url'    => 'http://test.helei.com/pay-notify.html',
    'time_expire'	=> '14',

    // 涉及资金流动时，需要提供该文件
    'cert_path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wx' . DIRECTORY_SEPARATOR . 'apiclient_cert.pem',
    'key_path'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'wx' . DIRECTORY_SEPARATOR . 'apiclient_key.pem',
];

/**
 * 实例化支付环境类，进行支付创建
 */
$charge = new ChargeContext();

try {

    // 微信 扫码支付
    $type = Config::WX_CHANNEL_QR;

    // 微信 APP支付
    //$type = Config::WX_CHANNEL_APP;

    // 微信 公众号支付
    //$type = Config::WX_CHANNEL_PUB;
    $charge->initCharge($type, $wxconfig);
    $ret = $charge->charge($payData);
} catch (PayException $e) {
    echo $e->errorMessage();exit;
}

if ($type === Config::WX_CHANNEL_QR) {
    $url = urlencode($ret);
    echo "<img alt='扫码支付' src='http://paysdk.weixin.qq.com/example/qrcode.php?data={$url}' style='width:150px;height:150px;'/>";
} elseif ($type === Config::WX_CHANNEL_PUB) {
    $json = $ret;
    var_dump($json);exit;
} elseif (stripos($type, 'wx') !== false) {
    var_dump($ret);
}
```
###[vagrant系列五：Vagrant使用中遇到的坑](https://helei112g.github.io/2016/10/30/vagrant系列五：Vagrant使用中遇到的坑/)
###[PHP中浮点数位数截取性能大比拼](https://helei112g.github.io/2017/02/16/PHP中浮点数位数截取性能大比拼/)
```js
$data = array_fill(0, 1, range(1, 100000, 1.1))[0];

$start = microtime(true);
foreach ($data as $num) {
    number_format(10000, 2, '.', '');
}
$end = microtime(true);
$need = $end - $start;
print("number_format time: {$need}" . PHP_EOL);

$start = microtime(true);
foreach ($data as $num) {
    bcadd($num, 0, 2);
}
$end = microtime(true);
$need = $end - $start;
print("bcadd time: {$need}" . PHP_EOL);

$start = microtime(true);
foreach ($data as $num) {
    sprintf('.2%f', $num);
}
$end = microtime(true);
$need = $end - $start;
print("sprintf time: {$need}" . PHP_EOL);
number_format time: 0.086385011672974
bcadd time: 0.098035097122192
sprintf time: 0.069508075714111
```
###[APP后端开发系列：登陆系统设计中的注意问题](https://helei112g.github.io/2016/07/12/1-APP后端开发系列：登陆系统设计中的注意问题/)

验证通过后，把用户uid+username+salt等md5后，作为token返回到客户端。
对token加入时间戳，过期后客户端重新提交username + pwd验证后再发一个token到客户端
服务端生成一个token后下发到客户端，客户端按照约定的规则加密后请求服务端。

，参考oauth2.0，我现在采用以下方案：

用户提交username + pwd后，服务端返回以下信息：
{
    "access_token":"2YotnFZFEjr1zCsicMWpAA",
    "expires_in":3600,
    "refresh_token":"tGzv3JOkF0XG5Qx2TlKWIA"
}
access_token 是用来进行访问的接口的，expires_in 是他的过期时间，到达过期时间后，需要用 refresh_token 来请求服务端刷新 access_token。

这里几个重点是：refresh_token 仅能使用一次，使用一次后，将被废弃。另外这个 access_token 只在 expires_in 有效期内有效。
访问频率控制 就把 access_token 与这些关联起来。这里需要用到redis。当用户A进来访问了 a接口 那么设置这个token 5s内不能再次访问。
if ($redis->get($key)) {
    // 无法访问，还未到时间
    
    return ;
}

// 设置频率控制key
$redis->setex($key, $expires, $value);

// 访问接口
###[想模拟登录本网站v2ex](https://www.v2ex.com/t/341686#reply13)
```js
#!/usr/bin/env python
# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup

login_url=r'https://www.v2ex.com/signin'
headers = { 
	"content-type":"application/x-www-form-urlencoded",
    'User-Agent': 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
    'Origin': 'https://www.v2ex.com',
    'Referer': 'https://www.v2ex.com/signin'    
}  
userName='pive'
password='******'
s=requests.Session()
res=s.get(login_url,headers=headers)
soup=BeautifulSoup(res.content,"html.parser") 
form=soup.find("form",action="/signin") 
once=form.find("input",{"name":"once"})["value"] 
formUserName=form.find("input",type="text")["name"] 
#formUserName=soup.find("input",placeholder="用户名或电子邮箱地址")["name"]
formPassword=soup.find("input",type="password")["name"]
print(once+"\n"+userName+"\n"+password)
post_data={
	formUserName:userName,
	formPassword:password,
	"once":once,
	"next":"/settings"
}
s.post(login_url,post_data,headers=headers)
f = s.get('https://www.v2ex.com/settings',headers=headers)
with open('v2ex.html',"wb") as v2ex:
	v2ex.write(f.content)
	
	
#-*- coding=utf-8 -*- 
import requests 
import re 
from lxml import etree 

signin='https://v2ex.com/signin' 
home='https://v2ex.com' 
url='https://v2ex.com/mission/daily' 
headers = { 
'User-Agent': 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 
'Origin': 'https://www.v2ex.com', 
'Referer': 'https://www.v2ex.com/signin', 
'Host': 'www.v2ex.com', 
} 
data={} 

def sign(username,passwd): 
	session=requests.Session() 
	session.headers=headers 
	loginhtm=session.get(signin,verify=False).content 
	page=etree.HTML(loginhtm) 
	x=page.xpath("//input[@class='sl']/@name") 
	usernameform=x[0] 
	passwdform=x[1] 
	onceform=page.xpath("//input[@name='once']/@value")[0] 
	data[usernameform]=username 
	data[passwdform]=passwd 
	data['once']=onceform 
	data['next']='/' 
	loginp=session.post(signin,data=data,verify=False) 
	sign=session.get(url).content.decode('UTF-8') 
	qiandao=re.findall("location.href = '(.*?)'",sign)[0] 
	if (qiandao == '/balance'): 
		print ("已经签过了") 
		else: 
	session.get(home+qiandao,verify=False) 
		print ('签到成功') 

if __name__=='__main__': 
	username='siloong' 
	passwd='123456' 
	requests.packages.urllib3.disable_warnings() 
	sign(username,passwd) 
```
###[github push 超过 100M pdf 文件提示错误，.gitignore 无法忽视*.pdf ][(https://www.v2ex.com/t/342845#reply7)
gitignore 不会忽略已经添加到版本管理里的文件 删除仓库里的文件后 gitignore 才会生效
git filter-branch --index-filter 'git rm --cached --ignore-unmatch path/to/your/file.pdf' HEAD
###[安卓微信浏览器location.reload()刷新无效 ，但iOS版微信可以刷新](https://www.v2ex.com/t/342451#reply19)
https://segmentfault.com/a/1190000006753455
http://debugtbs.qq.com 
在微信 /QQ 中打开可以调试
window.location.href=window.location.href
```js
function updateUrl(url,key){
        var key= (key || 't') +'=';  //默认是"t"
        var reg=new RegExp(key+'\\d+');  //正则：t=1472286066028
        var timestamp=+new Date();
        if(url.indexOf(key)>-1){ //有时间戳，直接更新
            return url.replace(reg,key+timestamp);
        }else{  //没有时间戳，加上时间戳
            if(url.indexOf('\?')>-1){
                var urlArr=url.split('\?');
                if(urlArr[1]){
                    return urlArr[0]+'?'+key+timestamp+'&'+urlArr[1];
                }else{
                    return urlArr[0]+'?'+key+timestamp;
                }
            }else{
                if(url.indexOf('#')>-1){
                    return url.split('#')[0]+'?'+key+timestamp+location.hash;
                }else{
                    return url+'?'+key+timestamp;
                }
            }
        }
    }
    window.location.href=updateUrl(window.location.href); //不传参，默认是“t”
window.location.href=updateUrl(window.location.href,'v'); //传入自定义的变量名
```
###[网易云音乐单首歌曲加密算法](https://www.v2ex.com/t/341662#reply18)
https://github.com/darknessomi/musicbox/blob/master/NEMbox/api.py#LC81  http://projects.qiyichao.cn/netease-music-parse/
```js
import hashlib
import base64
import random

def encrypted_id(id):
    magic = bytearray('3go8&$8*3*3h0k(2)2', 'u8')
    song_id = bytearray(id, 'u8')
    magic_len = len(magic)
    for i, sid in enumerate(song_id):
        song_id[i] = sid ^ magic[i % magic_len]
    m = hashlib.md5(song_id)
    result = m.digest()
    result = base64.b64encode(result)
    result = result.replace(b'/', b'_')
    result = result.replace(b'+', b'-')
    return result.decode('utf-8')
    
    song_dfsId = str(3435973841155597)
enc_id = encrypted_id(song_dfsId)
url = 'http://m%d.music.126.net/%s/%s.mp3' % (random.randrange(1, 3), enc_id, song_dfsId)
print url# http://m2.music.126.net/RMJR7wDullRqppBk8dhLow==/3435973841155597.mp3
var httpurl = "http://music.163.com/api/song/detail?id=" + music_id + "&ids=[" + music_id + "]"; 
https://github.com/ss098/qiyichao.cn/blob/master/projects/netease-music-parse.html 
```
###[百度前端技术学院 ](https://www.qiyichao.cn/#/paper/百度前端技术学院 2017 热身任务攻略)
http://ife.baidu.com/  atob($(".text-panel").text())
###[一个简单的视频下载器，支持 youtube 与 B 站 python gui](https://www.v2ex.com/t/339114#reply56)
https://github.com/chriskiehl/Gooey 
###[我是如何获取到你真实上网地址的 附POC](https://zhuanlan.zhihu.com/p/25118463)
用生成图片马的方式,把1.php和1.jpg合体

copy 1.jpg+1.php 2.jpg
```js
test.php
function get_addr($_ip) { 
        $_ip=array("X-Forwarded-For:{$_ip}");
            //初始化curl模块 
        $curl = curl_init();
        //需要获取的URL地址也可以在 curl_init() 函数中设置。
        curl_setopt($curl, CURLOPT_URL, 'http://ip.zishuo.net/');
        //在启用 CURLOPT_RETURNTRANSFER 的时候返回原生的Raw输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置"User-Agent: "头
        curl_setopt($curl, CURLOPT_USERAGENT  , 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $_ip);
        //执行cURL
        curl_exec($curl); 
        //关闭cURL资源并且释放系统资源 
        $retn=curl_exec($curl); 
        curl_close($curl);
        return json_decode($retn);
    } 
    $_addr=get_addr($_GET['ip']);
    if ($_addr->code=='200') {
        echo $_addr->desc.'->'.$_addr->position;
    }elseif($_addr->code=='404'){
        echo $_addr->message;
    }else{
        echo '异常!';
    }
    1.php
    $_ip=$_SERVER['REMOTE_ADDR']; 
$_ip_addr=file_get_contents('http://127.0.0.1/test.php?ip='.$_ip); 
$fh = fopen('ip.txt', 'a'); 
fwrite($fh, 'IP:'.$_ip.' Time:'.date("Y-m-d H:i",time()+28800).' Address:'.$_ip_addr."\r\n"); fclose($fh); 
$im = imagecreatefromjpeg("n00b.png"); 
header('Content-Type: image/jpeg'); 
imagejpeg($im); 
imagedestroy($im); 
 AddType application/x-httpd-php .jpg
```
###[十万个日式冷笑话](https://www.v2ex.com/t/339054)
 http://www.iguooo.cn/ 
 ###[Linux 磁盘已满，删除文件后可使用的空间还是为零](https://www.v2ex.com/t/340096#reply23)
 lsof | grep delete
 ###[一个小众的短网址小网站](https://www.v2ex.com/t/340717#reply0)
 Github 地址： https://github.com/Blacate/Portal 
 ###[微信公众号文章采集](https://zhuanlan.zhihu.com/p/25238068)
 ###[PHP 的面试题吧](https://www.v2ex.com/t/341873#reply65)
 我在数据库中存了很多到题目，然后管理员又有权限出比赛，可以把题目拉到比赛里，一个题目可以对应多个比赛，怎么做？这就问道了数据库多对多的实现。 
每场比赛有很多人参加，每个人都能看到自己参加的比赛提交记录，但是要把每场比赛和外面题库的提交记录分开，怎么做？这就问道了账号权限处理。 
每场比赛还有一个根据做出题的数量和罚时相关的实时更新的排名表，如果不是实时更新怎么处理，如果是实时更新怎么做最快？这就问了排序（静态）和二分（动态）。 
如果提交者交上来的是 sql 代码或者 js 代码怎么办？这就问道了 web 安全。 
假设提交者提交上来的是一个程序调用危险的系统调用怎么处理？这就问了系统安全。
低级：描述一下最近印象最深的解决的问题？ 
中级：让你主导项目你会选什么框架？ 
高级：如何提高团队整体的编码质量？
考语言特性的话，可以问下 class 中，$this 、 self 、 static 的区别。
$arr = [1,2,3]; 
foreach($arr as &$v) { 
//nothing todo. 
} 
foreach($arr as $v) { 
//nothing todo. 
} 
print_r($arr);
1.说一说什么是静态后期绑定 
2.接口 Interface 的作用 
3.封装继承抽象是什么意思,php 如何表现 
4.影响 php 性能的几个方面 
5.说说对 php gc 的理解 
6.如何改变匿名函数 Closure 的作用域 
7.php7 了解多少 以及你对哪个新特性最感兴趣 
8.cookie/session 的生命周期 
9.什么情况下设置 header 头会失效 
10.ob_start 系列的作用,以及在项目中都怎么用过 
11.如果给 yii/tp/加上一个注释 Annotation 路由你该如何实现 
12 !empty($varable)和 isset($varable)的区别 
13 请说出几种接受外部变量的方式 
14.说说从 nginx 接受请求到 php 输出内容，期间都经过了什么

如何防止 SQL 注入 
如何防止 XSS 注入 
如何防止 CRSF
搜 PHP Certification 题库 
能解决那些稀奇古怪的题目，并不代表日常的代码水准就高 
另外可以扩展一下，考校一些 Git 、 Linux 的常用命令
聊聊 http 模型， fastcgi 处理模型，确定基本问题知道在哪，常用的 MYSQL 大坑是否了解，比如 LIMIT 很大数字会慢这种常识，细节见镇长 

然后，聊聊各种数据安全问题，防止泄露的处理，常见业务大坑比如支付网关返回只验证订单号成功不验证金额的这种事儿怎么看之类 

然后，针对 PHP ，问问 5.X 到 5.6 有啥主要变化，新特性简单了解即可，日常能用到的会出现不兼容问题的为重点，然后是 5.6 到 7 有啥重点需要注意的地方之类，重点在代码题 输入过滤，对于系统内约定的传进来 int ，有没有随手 intval 一下的习惯，对于用户数据（比如 cookies ）是否有随手 intval 的习惯等等 
###[app api接口开发](https://www.v2ex.com/t/337850#reply27)

加密方式： MD5 、 RC4 、 RSA ，根据我们业务场景选择。 
关于 app 版本
关于 json 规范
请求方式 get:选则 get 一般是把一些验证信息放到 http 请求的 head 中的 post:post 可以发送大量数据， php 的 post_max_size 默认值一般是 8MB,这时候验证信息可以放到 post 数据里面 5.开发文档 文档是服务器开发与客户端开发人员接口交流的重要途径
微信 /支付宝 /支付 友盟统计 消息推送（单人推送，群发，按标签推送，按版本推送等，有时候运营要知道到达率等等） 
渠道统计，广告统计，针对单用户的各种统计。 
包括客户端服务端异常监控等。 app 版本是 1.0 的，在请求服务器接口时 head 中加入 App-Version: 1.0 
jwt.io
 errorCode 错误码比较棒。 
最近刚用的: 
0-没错误 
1-9 服务器错误 
10-99 前端参数错误 
100-用户输入错误～～
https://www.v2ex.com/t/340066#reply58
1.基础数据层:提供各种最底层的数据,最基础的获取,不会有任何逻辑 
2.数据逻辑层:这个也是服务端做,就是之前争论的 api 做还是客户端做的那些操作,全部放到这一层,向上从基础数据层获取数据,向下对客户端提供数据. 
3.最后才是客户端
###[一个心形符号“❤”导致保存失败](https://www.v2ex.com/t/342724#reply9)
UnicodeEncodeError: 'gbk' codec can't encode character '\u2764' in position 9870: illegal multibyte sequence

'\u2764'我转了编码后发现是❤ 不要转成国标码，直接存 UTF-8
utf8mb4 ，还可以保存 emoji 表情，微信的昵称
###[管理 API 文档](https://www.v2ex.com/t/340795)
Swagger 
Confluence 
showdoc 
口头传述 
gitlab 传 md.... 
天啦，还有 API 文档,没听说过 
raml 
wiki 
gogs 
apidoc 
quip 
意念传输 
postman 
RAP
SBDoc = 可视化的文档编写工具
###[锤子便签可能是史上最漂亮的便签应用](http://www.smartisan.com/apps/notes  )
它不仅可以输入文字,还支持插入图片,进行图文混排。你还可以随时随地将便签内容生成精美的长微博并分享。
markdown www.zybuluo.com/mdeditor 
###[推荐几款好用的截图工具](https://zhuanlan.zhihu.com/p/25364170)
FScapture全名为 FastStone Capture  将图像转换为 PDF 文件
图片可以直接转为PDF
官方主页：http://www.faststone.org/ 官方主页：www.picpick.org/
发送到 PowerPoint，Word，FTP Snipaste=Snip + Paste =截图 + 贴图
###[7个堪称神器的网站](https://zhuanlan.zhihu.com/p/25394126)
网站地址：Smallpdf.com – 您所有PDF问题的免费解决方案
网站地址：iLovePDF | 为PDF爱好者提供的PDF文件在线转换工具
网站地址：百度脑图 - 便捷的思维工具
网站地址：石墨 - 可多人实时协作的云端文档和表格
网站地址：WPS云文档 协作在云端
网站地址：平面设计,简单,快速,轻松完成平面设计,2016最好的在线平面设计工具-创客贴
网站地址：花瓣网_陪你做生活的设计师（发现、采集你喜欢的灵感、家居、穿搭、婚礼、美食、旅行、美图、商品等）
###[小白进阶之Scrapy第一篇](https://zhuanlan.zhihu.com/p/25354987)
###[TensorFlow搞定“倒字验证码”](https://www.zhihu.com/question/46495381/answer/147826276?group_id=817709112065421312)

```js
 

# -*- coding: utf-8 -*-
from PIL import Image,ImageDraw,ImageFont
import random
import math, string
import logging
# logger = logging.Logger(name='gen verification')

class RandomChar():
    @staticmethod
    def Unicode():
        val = random.randint(0x4E00, 0x9FBF)
        return unichr(val)    

    @staticmethod
    def GB2312():
        head = random.randint(0xB0, 0xCF)
        body = random.randint(0xA, 0xF)
        tail = random.randint(0, 0xF)
        val = ( head << 8 ) | (body << 4) | tail
        str = "%x" % val
        return str.decode('hex').decode('gb2312')    

class ImageChar():
    def __init__(self, fontColor = (0, 0, 0),
    size = (100, 40),
    fontPath = '/Library/Fonts/Arial Unicode.ttf',
    bgColor = (255, 255, 255),
    fontSize = 20):
        self.size = size
        self.fontPath = fontPath
        self.bgColor = bgColor
        self.fontSize = fontSize
        self.fontColor = fontColor
        self.font = ImageFont.truetype(self.fontPath, self.fontSize)
        self.image = Image.new('RGB', size, bgColor)

    def drawText(self, pos, txt, fill):
        draw = ImageDraw.Draw(self.image)
        draw.text(pos, txt, font=self.font, fill=fill)
        del draw    

    def drawTextV2(self, pos, txt, fill, angle=180):
        image=Image.new('RGB', (25,25), (255,255,255))
        draw = ImageDraw.Draw(image)
        draw.text( (0, -3), txt,  font=self.font, fill=fill)
        w=image.rotate(angle,  expand=1)
        self.image.paste(w, box=pos)
        del draw

    def randRGB(self):
        return (0,0,0)

    def randChinese(self, num, num_flip):
        gap = 1
        start = 0
        num_flip_list = random.sample(range(num), num_flip)
        # logger.info('num flip list:{0}'.format(num_flip_list))
        print 'num flip list:{0}'.format(num_flip_list)
        char_list = []
        for i in range(0, num):
            char = RandomChar().GB2312()
            char_list.append(char)
            x = start + self.fontSize * i + gap + gap * i
            if i in num_flip_list:
                self.drawTextV2((x, 6), char, self.randRGB())
            else:
                self.drawText((x, 0), char, self.randRGB())
        return char_list, num_flip_list
    def save(self, path):
        self.image.save(path)



err_num = 0
for i in range(10):
    try:
        ic = ImageChar(fontColor=(100,211, 90), size=(280,28), fontSize = 25)
        num_flip = random.randint(3,6)
        char_list, num_flip_list = ic.randChinese(10, num_flip)
        ic.save(''.join(char_list)+'_'+''.join(str(i) for i in num_flip_list)+".jpeg")
    except:
        err_num += 1
        continue
	
	https://github.com/burness/tensorflow-101/tree/master/zhihu_code/src
```

###[那些程序员深信不疑的谣言github   ](https://github.com/kdeldycke/awesome-falsehood)
###[用漫画告诉你什么是DDoS](https://zhuanlan.zhihu.com/p/25317153)
###[有5个海盗抢了100个金币](https://www.zhihu.com/question/51316439/answer/147036827?group_id=816485318114041856)

（1）抽签决定各人的号码为1，2，3，4，5

（2）由1号提出金币的分配方案，然后五个人开始表决，如果方案超过半数同意就被通过，否则1号就被扔进大海喂鲨鱼。

（3）1号死后，由2号提方案，四人表决，当且仅当超过半数同意时方案通过，否则2号同样被扔进大海。

（4）一直到找到一个每个人都接受的方案。

假设每个海盗都是完全理性人，都能很理智的判断得失。做出选择。

那么，如何你是这五人中的一个，抽到了1号，你该如何提出分配方案，才能使自己受益最大化？

其中简直充满了套路。

因为需要保证自己不被丢进大海的同时，还需要利益最大化。

可能你会觉得抽到1号时，是最倒霉的。因为会觉得即便你1个金币都不要，全都分给另外4个人，也不一定能得到其他4人赞同。


为什么说这道题套路很深，也是因为最后的答案远远出乎你的意料。

最后的分配方案[97，0，1，2，0]或[97，0，1，0，2]

也就是说自己拿97个金币，给3号1个，4号2个，2号和5号一个都不给。

或者自己拿97个，给3号1个，5号1个，2号和4号一个都不给

###[简单而实用的CMD命令](https://zhuanlan.zhihu.com/p/25194940)
tree命令能够以分支的形式显示指定目录下的全部子目录和文件
tree C:\Users\Desktop /f  tree 指定目录 /f >1.txt
arp -a 可以查看同一网络下的设备的物理地址，可以用来查看是否有人蹭网
taskkill /f /im notepad.exe
也可以输入 tasklist 查看所有的进程，查看进程对应的PID码
从而使用 taskkill /pid 4708 来关闭进程
ipconfig /all 可以查看电脑网卡信息，包括mac地址、DNS地址、本地IP地址等。
打开cmd.exe：Win+R，输入cmd，回车。
打开计算器：calc
打开画图：mspaint
打开放大镜：magnify
打开屏幕键盘：osk
打开记事本、写字板：notepad、write
打开字符映射表：charmap
打开造字程序（专用字符编辑程序）：eudcedit
打开远程桌面连接：mstsc

打开服务：services.msc
打开设备管理器：devmgmt
打开磁盘管理：diskmgmt
打开系统信息：msinfo32
打开系统配置：msconfig
打开DirectX诊断工具：dxdiag
打开事件查看器：eventvwr
打开我的电脑：explorer
打开注册表编辑器：regedt32
打开资源监视器：resmon
打开性能监视器：perfmon
打开计算机管理：compmgmt

 
