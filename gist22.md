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







