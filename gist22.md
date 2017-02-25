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

for i in [0]:
    print(t)

 
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
