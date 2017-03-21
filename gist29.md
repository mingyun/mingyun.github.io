[男生送给女生特别用心的礼物](https://www.zhihu.com/question/27581416)
我看过的最感动的一封信，不是写给我的，是我朋友的。她老公在和她恋爱的时候，给她写的。具体的肯定不记得，大概是这样：我不知道我跟她能不能走到最后，如果没有，请后面的你看看，好好的照顾她。如果你和她逛超市看到毛茸茸的玩具，她会抱一抱，但是放心，她不会要你买，她只是喜欢抱一抱。如果你和她一起吃饭，记得先把餐具用水洗一洗，她喜欢干净。如果吃完饭，她执意要付钱，请不要和她争，她好强。如果她做PPT，请以一定要耐心教，她总是记不住那些到底是什么。如果和她出去玩，记得拉好她的手，她不记得路的。如果……如果…… 欲获得本书《如何让美少女来追你》完整版的朋友可关注我们的 微信公众号 Smileblgg 回复 “书籍” 即可获得相关的书籍下载方式
FDC原则。
感受+细节+对比。

你真美。
细节：你的眼睫毛特别长。你的眼睛特别明亮。
感受：看到你的笑，我心都软了。
对比：你刚才走进来，让整个餐厅的人都黯然失色。

查看redis-cli --help查看--eval的语法
 有redis-cli --eval myscript.lua key1 key2 , arg1 arg2 arg3
https://redis.io/commands/eval itchatmp&itchat 结合使用
https://zhuanlan.zhihu.com/p/23742990 
[一个用Go写的微信机器人](https://github.com/KevinGong2013/ggbot)
https://github.com/KevinGong2013/wechat
[python生成固定长度的随机字符串](https://www.oschina.net/code/snippet_153443_4752)
```js
import random, string
def random_str(randomlength=8):
    a = list(string.ascii_letters)
    random.shuffle(a)
    return ''.join(a[:randomlength])

salt = ''.join(random.sample(string.ascii_letters + string.digits, 8)) random.randint(1000,9999)
seed = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-"
sa = []
for i in range(8):
    sa.append(random.choice(seed))
salt = ''.join(sa)
from random import Random
def random_str(randomlength=8):
    str = ''
    chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789'
    length = len(chars) - 1
    random = Random()
    for i in range(randomlength):
        str+=chars[random.randint(0, length)]
    return str
print(uuid.uuid1())
```

PHP设计模式问题https://segmentfault.com/q/1010000008736793
最好用的是phpfmt sublime
php 怎么获取当前月份往前24个月中的每个月的订单总和https://segmentfault.com/q/1010000008734802
https://segmentfault.com/q/1010000008357070  背包算法PHP或Javascript实现方案
php中static当实例化方法用是什么意思https://segmentfault.com/q/1010000008715451
无限级分类，tp_user 应该新增一个字段 path 。path值为 0-1、0-1-2 等等。

然后，sql查询：select id,name, parent_id,path,concat(path,'-',id) as bpath, from tp_user order by bpathhttps://segmentfault.com/q/1010000008537364
[微信公众平台开发工具集](http://www.cnblogs.com/txw1958/p/weixin-tools-list.html)
PHP怎么获取每个月的最后一个周五日期https://segmentfault.com/q/1010000008708171
在curl请求的url上加一个XDEBUG_SESSION_START=1就可以了。 xdebug helper也就是加的这个参数. 如果url里有这个参数，并且也不需要xdebug helper trace等功能的话,完全就可以不用helper了.
https://segmentfault.com/q/1010000008704638
订单拆分成子订单问题求教https://segmentfault.com/q/1010000008703173
判定前端调用后端接口超时？https://segmentfault.com/q/1010000008684983
2038年的问题https://segmentfault.com/q/1010000008671369
遍历目录并下载文件 https://segmentfault.com/q/1010000008675464
https://segmentfault.com/q/1010000008682636
sublime中PHP有调用模型https://segmentfault.com/q/1010000008681529
msyql的锁机制，解锁是自动解锁吗https://segmentfault.com/q/1010000008683232
高并发抢单时,锁表的疑惑？https://segmentfault.com/q/1010000008676397
preg_match的理解https://segmentfault.com/q/1010000008635436
https://segmentfault.com/q/1010000008661892  https://segmentfault.com/q/1010000008668318
var iframe = document.getElementById('test')
// 取到 iframe 内的 document 对象，然后用这个对象去查找里面的表单
var iframeDoc = iframe.contentWindow.document  
https://segmentfault.com/q/1010000008691659  基于 session 和基于 token 的用户认证方式到底该如何选择？
二维数组合并成三维数组https://segmentfault.com/q/1010000008691370

DateTime对象可以用时间戳的哦 203v问题是由于整数溢出造成的，32位整数就会遇到，64位就不会。这和你的程序架构有关，如果你运行的是32位PHP的话就会溢出。
###[生成自己的词性词典](邓旭东 天善大数据http://mp.weixin.qq.com/s?src=3&timestamp=1489907873&ver=1&signature=mPVOF3R4tcsLs1L1Phi9*juQlHCeGtA4kbe8bgSyrJVW7msRydAK1ggmQMUBfPJ5ti-82g9Edo33VwXGCwnoSKdefoxNNYd4NOC1whlrQOA3owzlgqS-P4TQaIuvvNQLCZNs5s-Nz5VySSIOnCy9iMrdxmtGBZFKoPzIuVZjnpU=)
```js
import re
1、应先使用正则表达式，匹配含有‘adj’的行字符串，返回的是list。
2、获得adj结尾处的索引值
3、对行字符串进行切片处理，获得索引值后的全部字符
4、如果获得的字符串有 ‘，’ 那再用正则表达式，匹配中文字符，获得的是中文的list
strs = open(r'C:/Users/myl/Desktop/SegChineseToWords/英汉词典TXT格式.txt','r',encoding='utf-8').readlines()

for str in strs:

# 形容词典
    adj_re = re.search('adj', str)
    if adj_re != None:
        adj_num = adj_re.end()+1
        adj_str = str[adj_num:]
        adj_list = re.findall("[\u4e00-\u9fa5]+", adj_str)
        for ele_adj in adj_list:
            ele_adj = ele_adj + '\n'
            with open(r'C:/Users/myl/Desktop/SegChineseToWords/Dict/adj_dict.txt', 'a+',encoding='utf-8') as f:
                f.write(ele_adj)
```

###[有哪些老鸟程序员知道而新手不知道的小技巧？](https://www.zhihu.com/question/36426051/answer/152115740)
```js
>>> x = 5
>>> 1 < x < 10
True
>>> 10 < x < 20 
False
>>> x < 10 < x*10 < 100
True
>>> 10 > x <= 9
True
>>> 5 == x > 4
True
x = [n for n in foo if bar(n)]
>>> type(x)
<type 'list'>

d = {value: foo(value) for value in sequence if bar(value)}
>>> def foo(x=None):
...     if x is None:
...         x = []
...     x.append(1)
...     print x
>>> foo()
[1]
>>> foo()
[1]
如果你不喜欢使用空格缩进，那么可以使用C语言花括号{}定义函数：

>>> from __future__ import braces   #这里的braces 指的是：curly braces（花括号）
  File "<stdin>", line 1
SyntaxError: not a chance
当然这仅仅是一个玩笑，想用花括号定义函数？没门。感兴趣的还可以了解下：

from __future__ import barry_as_FLUFL
装饰器使一个函数或方法包装在另一个函数里头，可以在被包装的函数添加一些额外的功能，比如日志，还可以对参数、返回结果进行修改。

>>> def print_args(function):
>>>     def wrapper(*args, **kwargs):
>>>         print 'Arguments:', args, kwargs
>>>         return function(*args, **kwargs)
>>>     return wrapper

>>> @print_args
>>> def write(text):
>>>     print text

>>> write('foo')
Arguments: ('foo',) {}
foo
@是语法糖，它等价于：

>>> write = print_args(write)
>>> write('foo')
arguments: ('foo',) {}
foo




```
[Python 绘制分形图（曼德勃罗集、分形树叶、科赫曲线、分形龙、谢尔宾斯基三角等）附代码](https://zhuanlan.zhihu.com/p/25792397)
```js
import numpy as np
import matplotlib.pyplot as pl
import time

# 蕨类植物叶子的迭代函数和其概率值
eq1 = np.array([[0,0,0],[0,0.16,0]])
p1 = 0.01

eq2 = np.array([[0.2,-0.26,0],[0.23,0.22,1.6]])
p2 = 0.07

eq3 = np.array([[-0.15, 0.28, 0],[0.26,0.24,0.44]])
p3 = 0.07

eq4 = np.array([[0.85, 0.04, 0],[-0.04, 0.85, 1.6]])
p4 = 0.85

def ifs(p, eq, init, n):
"""
    进行函数迭代
    p: 每个函数的选择概率列表
    eq: 迭代函数列表
    init: 迭代初始点
    n: 迭代次数

    返回值： 每次迭代所得的X坐标数组， Y坐标数组， 计算所用的函数下标    
    """

# 迭代向量的初始化
pos = np.ones(3, dtype=np.float)
pos[:2] = init

# 通过函数概率，计算函数的选择序列
p = np.add.accumulate(p)    
rands = np.random.rand(n)
select = np.ones(n, dtype=np.int)*(n-1)
for i, x in enumerate(p[::-1]):
select[rands<x] = len(p)-i-1

# 结果的初始化
result = np.zeros((n,2), dtype=np.float)
c = np.zeros(n, dtype=np.float)

for i in range(n):
eqidx = select[i] # 所选的函数下标
tmp = np.dot(eq[eqidx], pos) # 进行迭代
pos[:2] = tmp # 更新迭代向量

# 保存结果
result[i] = tmp
c[i] = eqidx

return result[:,0], result[:, 1], c

start = time.clock()
x, y, c = ifs([p1,p2,p3,p4],[eq1,eq2,eq3,eq4], [0,0], 100000)
time.clock() - start
pl.figure(figsize=(6,6))
pl.subplot(121)
pl.scatter(x, y, s=1, c="g", marker="s", linewidths=0)
pl.axis("equal")
pl.axis("off")
pl.subplot(122)
pl.scatter(x, y, s=1,c = c, marker="s", linewidths=0)
pl.axis("equal")
pl.axis("off")
pl.subplots_adjust(left=0,right=1,bottom=0,top=1,wspace=0,hspace=0)
pl.gcf().patch.set_facecolor("#D3D3D3")
pl.show()
```
[人人都爱数据科学家！Python数据科学精华实战课程系列教程连载 ----长期更新中，敬请关注!](https://zhuanlan.zhihu.com/p/25829702)
[就用python爬淘宝评论](https://zhuanlan.zhihu.com/p/25840330)
```js
import requests
import json
import time
import simplejson

headers = {
    'Connection': 'keep-alive',
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:51.0) Gecko/20100101 Firefox/51.0'
}
base_url = 'https://rate.tmall.com/list_detail_rate.htm?itemId=38975978198&' \
           'spuId=279689783&sellerId=92889104&order=3&callback=jsonp698'
#在base_url后面添加&currentPage=1就可以访问不同页码的评论

for i in range(2, 98, 1):
    url = base_url + '&currentPage=%s' % str(i)
    #将响应内容的文本取出
    tb_req = requests.get(base_url, headers=headers).text[12:-1]
    print(tb_req)

    #将str格式的文本格式化为字典
    tb_dict = simplejson.loads(tb_req)

    #编码： 将字典内容转化为json格式对象
    tb_json = json.dumps(tb_dict, indent=2)   #indent参数为缩紧，这样打印出来是树形json结构，方便直观
    #print(type(tb_json))

    #print(tb_json)
    #解码： 将json格式字符串转化为python对象
    review_j = json.loads(tb_json)
    for p in range(1, 20, 1):
        print(review_j["rateDetail"]["rateList"][p]['rateContent'])
    time.sleep(1)
```
[Python网络爬虫免费视频](https://zhuanlan.zhihu.com/p/25828596)
爬取知乎所有用户信息
```js
import jieba
import time

path = r'E:\Python\Projects\Dig_text\云麓园\云麓水吧.txt'
read_txt = open(path, 'r')
ShuiBa_word_list = []
ShuiBa_word_set = set()
for line in read_txt.readlines():
line = line.replace(' ', '')
line = line.strip('\n')
word_list = jieba.lcut(line, cut_all=False)  #cut_all=false精准模式
word_set = set(word_list)
# 汇总水吧的所有词语的列表（有顺序，重复）
ShuiBa_word_list = ShuiBa_word_list + word_list
# 得到水吧所有词语的集合（无顺序，不重复）
ShuiBa_word_set = ShuiBa_word_set.union(word_set)

for word in ShuiBa_word_set:
fre = ShuiBa_word_list.count(word)
print(word, str(fre))  #打印词语及其频率
```
[使用selenium简单收集知乎的话题数据](https://zhuanlan.zhihu.com/p/25803780)
```js
import re
import csv
import time
import urllib.parse as parse
from selenium import webdriver
from bs4 import BeautifulSoup

# keyword话题名 ，filename保存数据的文件名，page_num收集多少页
def topic_title_spider(keyword='王宝强', filename = 'wangbaoqiang', page_num = 10):

start = time.time()

# 建立一个收集数据的csv文件
csvFile = open(r'E:\%s.csv'% filename, 'a+', newline='')
writer = csv.writer(csvFile)
writer.writerow(('title', 'review_num'))

# 将关键词转换为十六进制格式，填入到链接中
kw = parse.quote(keyword)
driver = webdriver.Firefox()
driver.get('https://www.zhihu.com/search?type=content&q=%s' % kw)

# 正则表达式，用来匹配标题，评论数
reg_title = re.compile(r'<a class="js-title-link" href=.*?" target="_blank">(.*?)</a>')
reg_li = re.compile(r'item clearfix.*?')
reg_num = re.compile(r'<a class="zm-item-vote-count hidden-expanded js-expand js-vote-count" data-bind-votecount="">(.*?)</a>')

# 先循环点击页面底部“更多”，加载尽可能多的页面数据
for i in range(1, page_num, 1):
driver.find_element_by_link_text("更多").click()
duration = time.time()-start
print('%s小爬虫 已经跑到 第%d页 了，运行时间%.2f秒，好累啊'%(keyword, i, duration))
time.sleep(5)

soup = BeautifulSoup(driver.page_source, 'lxml')
li_s = soup.find_all('li', {'class': reg_li})

for li in li_s:
li = str(li)
try:
title = re.findall(reg_title, li)[0]
title = title.replace('<em>', '')
title = title.replace('</em>', '')
review_num = re.findall(reg_num, li)[0]
except:
continue
writer.writerow((title, review_num))
print(title, review_num)

csvFile.close()
driver.quit()
```
[Python爬虫实战——免费图片 - Pixabay](https://zhuanlan.zhihu.com/p/25863566?group_id=826853788479557632)
pixabay.com/  http://link.zhihu.com/?target=https%3A//github.com/zhangslob/Pixabay/tree/master 
```js
import requests
from lxml import etree
import time
import urllib

def Download(url):
    header = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'}
    r = s.get(url, headers=header).text
    s = etree.HTML(r)
    r = s.xpath('//img/@data-lazy')
    for i in r:
        imglist = i.replace('__340', '_960_720')
        name = imglist.split('/')[-1]#图片名称
        urllib.request.urlretrieve(imglist,name)
        time.sleep(1)


def FullUrl():
    full_link = []
    for i in range(2,165):
        #print(i)
        full_link.append( 'https://pixabay.com/zh/editors_choice/?media_type=photo&pagi='+ str(i))
        #print(full)
    return full_link

if __name__ == '__main__':
    urls = FullUrl()
    for url in urls:
        Download(url)
In [13]: import requests

In [14]: r = requests.get('https://pixabay.com/zh/editors_choice/')

In [15]: soup = BeautifulSoup(r.text, 'lxml')

In [16]: for img in soup.find_all('img',attrs={'data-lazy-srcset':True}):
    ...:     
    ...:     print(img['data-lazy-srcset'])

```
[异常JSON字符串的解析以及JS字符串的解析运行](https://zhuanlan.zhihu.com/p/25693482)
```js
var str = "{a: 1, 'b': 2}"; 
[].push.constructor('console.log("abc");')(); // abc
Math.max.constructor('console.log("abc");')(); // abc [].push.constructor === Function // true
var script = document.createElement('script');
var txt = document.createTextNode('console.log("abc");');
script.appendChild(txt);
document.body.appendChild(script); // abc
当让，也可以通过把字符串转化为二进制然后通过window.URL.createObjectURL生成URL修改script的src。

var blob = new Blob(['console.log("abc");']);
var src = window.URL.createObjectURL(blob);
var script = document.createElement('script');
script.src = src;
document.body.appendChild(script); // abc
var blob = new Blob(['console.log("abc");']);
var src = window.URL.createObjectURL(blob);
new Worker(src); // abc  

location.href='javascript:' + 'console.log("abc")'; // abc

var str = 'var i = 0; var arr = [i++, i++, i++]';
eval(str);
console.log(arr); // [0,1,2]
var str = new Array(6).join('i++,'); // 'i++,i++,i++,i++,i++,'

// var str = 'i++,'.repeat(5) 当然，这样写也OK
var evalstr = 'var i = 0; var arr = [' + str + ']';
eval(evalstr);
console.log(arr); // [0, 1, 2, 3, 4, 5]
```

[无循环 JavaScript](https://zhuanlan.zhihu.com/p/25370825?group_id=826839568971071488)
[正则表达式中的lastIndex以及预查](https://zhuanlan.zhihu.com/p/25793949)
```js
var reg1 = /a/;
var reg2 = /a/g;

console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true

console.log(reg2.test('abcabc')); // true
console.log(reg2.test('abcabc')); // true
console.log(reg2.test('abcabc')); // false
console.log(reg2.test('abcabc')); // true
var reg = /ab/g;
reg.test('123abc');
console.log(reg.lastIndex) // 5

// 匹配内容在最后
var reg = /ab/g;
reg.test('123ab');
console.log(reg.lastIndex) // 5

// 不带参数g
var reg = /ab/;
reg.test('123abc');
console.log(reg.lastIndex) // 0
// 测试字符串str1 和 str2 是否都含有ab字符
var reg = /ab/g;

var str1 = '123ab';
var str2 = 'ab123';

console.log(reg.test(str1)); // true
console.log(reg.test(str2)); // false
```
[python小甜点-----100行代码实现个性化翻译！](https://zhuanlan.zhihu.com/p/25818996?group_id=825858731395940352)
[在线的链接维基百科的思维导图工](https://zhuanlan.zhihu.com/p/25816988?group_id=825804887966248960)
搜狗人物关系 、百度人物图谱http://link.zhihu.com/?target=http%3A//tupu.baidu.com/tupu/131804.html
http://link.zhihu.com/?target=http%3A//wikimindmap.com/viewmap.php%3Fwiki%3Den.wikipedia.org
http://link.zhihu.com/?target=https%3A//index.baidu.com/%3Ftpl%3Ddemand%26word%3D%25B9%25F9%25B5%25C2%25B8%25D9
http://link.zhihu.com/?target=http%3A//www.sogou.com/tupu/person.html%3Fq%3D%25E9%2583%25AD%25E5%25BE%25B7%25E7%25BA%25B2
以看直播电视：在线电视http://link.zhihu.com/?target=https%3A//tv.empire.net.cn/
[关于跨域，你想知道的全在这里](https://zhuanlan.zhihu.com/p/25778815?group_id=825753771505233920)
我们正好在开发一个小工具，辅助微信编辑的，挺吻合题主的需求。

这个小工具叫做「壹伴」，很小巧的一款浏览器插件，大小不到1M。https://link.zhihu.com/?target=http%3A//yiban.io/%3Futm%3Dxiaojiqiao
[是最有艺术感的二维码了吧](https://zhuanlan.zhihu.com/p/25779045?group_id=825323688302907392)
http://link.zhihu.com/?target=https%3A//www.imayan.net/QrBuild/Index/Builder.html
http://link.zhihu.com/?target=http%3A//www.9thws.com/%23 

[爬虫入门到精通-headers的详细讲解（模拟登录知乎）](https://zhuanlan.zhihu.com/p/25711916?group_id=825423128233656320)
```js
from lxml import etree
sel = etree.HTML(z1.content)
# 这个xsrf怎么获取 我们上面有讲到
_xsrf = sel.xpath('//input[@name="_xsrf"]/@value')[0]

mylog = 'https://www.zhihu.com/people/pa-chong-21/logs'
z3 = requests.get(url=mylog,headers=headers)
print z3.status_code
#200
print z3.url
# u'https://www.zhihu.com/?next=%2Fpeople%2Fpa-chong-21%2Flogs'
headers={cookie:z2.headers['set-cookie']}
z3 = requests.get(url=mylog,headers=headers)
print z3.url
print z3.request.headers 打印看下我们请求的headers
# u'https://www.zhihu.com/people/pa-chong-21/logs'
```
Python的zipfile模块提供的命令行接口，创建、查看和提取zip格式压缩包：
lmx@host1:~/temp$ python -c "import paramiko"
python -m zipfile -c monty.zip spam.txt eggs.txt
python -m zipfile -e monty.zip target-dir/
python -m zipfile -l monty.zip
[初学Python--微信好友/群消息防撤回，查看相关附件](https://zhuanlan.zhihu.com/p/25744154?group_id=824799146052587520)
[教你免费搭建个人博客，Hexo&Github](https://zhuanlan.zhihu.com/p/25729240?group_id=824595631568998400)
[爬虫入门到精通-爬虫之异步加载（实战花瓣网](https://zhuanlan.zhihu.com/p/25860823?group_id=826823016343302144)

python md5之后是base64 encode

java md5之后是base64 decode
[Fetch 跨域请求时默认不会带 cookie，需要时得手动指定 credentials: 'include'](https://segmentfault.com/q/1010000008709916)

fetch('a.com/api', {credentials: 'include'}).then(function(res) {
    // ...
})
[查看Beautiful Soup的prettify(encoding, formatter="minimal")](https://segmentfault.com/q/1010000008743981)
In [1]: import bs4

In [2]: bs4.BeautifulSoup.prettify.__code__
Out[2]: <code object prettify at 0x103f7f5d0, file "/Library/Frameworks/Python.framework/Versions/3.5/lib/python3.5/site-packages/bs4/element.py", line 1198>
[用python求差商？](https://segmentfault.com/q/1010000008744969)
```js

fmap = {1:1, 2:2, 3:3}

def f(*x):
    if len(x)==1:
        rc = fmap[x[0]]
        print('f({})={}'.format(x[0], rc))
        return rc
    rc = (f(*x[1:])-f(*x[:-1]))/(x[-1]-x[0])
    template = 'f({})=(f({})-f({}))/({}-{})={}'
    print(template.format(', '.join([str(i) for i in x]),
                          ', '.join([str(i) for i in x[1:]]),
                          ', '.join([str(i) for i in x[:-1]]),
                          x[-1], x[0],
                          rc))
    return rc
    
f(1, 2, 3)
f(3)=3
f(2)=2
f(2, 3)=(f(3)-f(2))/(3-2)=1.0
f(2)=2
f(1)=1
f(1, 2)=(f(2)-f(1))/(2-1)=1.0
f(1, 2, 3)=(f(2, 3)-f(1, 2))/(3-1)=0.0
```
152753这个字符串转变成时间格式15:27:53 https://segmentfault.com/q/1010000008716602

from datetime import datetime
s = '152753'
t = datetime.strptime(s, '%H%M%S').time()

print(t)
15:27:53
 >>> time = "152753"
 >>> ':'.join(time[i:i+2] for i in range(0, len(time), 2))
 >>> '15:27:53'
import pandas as pd

a = pd.read_csv('./test.csv')

a.to_excel('./test_output.xlsx', index=False)

a.to_excel('./test_output.csv', index=False)
Python列表或者字典里面的中文如何处理https://segmentfault.com/q/1010000008664310
>>> list
[u'\u4e2d\u6587', u'\u6211\u662f\u4e2d\u6587', u'\u6211\u8fd8\u662f\u4e2d\u6587']
>>> list[0]
u'\u4e2d\u6587'
>>> list[0].encode('utf8')
'\xe4\xb8\xad\xe6\x96\x87'
>>> str = list[0].encode('utf8')
>>> print str
中文
import json
zhlist = [u'中文', u'英文']
print json.dumps(zhlist, ensure_ascii=False, indent=2)
Nginx服务器如何配置Laravel项目？总是报502 Bad Gatewayhttps://segmentfault.com/q/1010000008713658
location / {
        try_files $uri /index.php$is_args$args;
    }
    
    location ~ ^/index\.php(/|$) {
        fastcgi_pass unix:/run/php-fpm/php-fpm.sock;  fastcig_pass 就是php-fpm运行时候的服务,可以用tcp/ip方式访问，也可以通过这中socket的方式
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
    }
如何一条SQL从一张表中取出关联字段值分别为A/B/C的数据一个取出N条https://segmentfault.com/q/1010000008576146
SELECT * FROM s_area AS a
WHERE area_parent_id in (3,4,5) and 5 > ( SELECT COUNT(*) FROM s_area WHERE area_parent_id = a.area_parent_id AND area_id>a.area_id) 
order by area_sort asc
PHP队列执行任务的时候,如何防止进程之间抢夺资源?https://segmentfault.com/q/1010000008732536
PHP 进程都用如下 SQL 语句去取出数据库里的待处理任务

SELECT * FROM task WHERE status = 0
取出来以后，我们为了防止其他用户不再重复取出要把它的状态标记为 1

UPDATE task SET status = 1 WHERE id = xxx
但是等等，这样就会产生如你所说的资源抢夺，但如果加上一个简单的技巧就可以避免，你把语句变成这样

UPDATE task SET status = 1 WHERE id = xxx AND status = 0

redis做一个队列，为什么出队列是会少显示一个元素？https://segmentfault.com/q/1010000008700710

```js
    <?php
    $redis = new \redis();
    $redis->connect('127.0.0.1', 6379);
    $arr = array('h', 'e', 'l', 'l', 'o', 'w', 'o', 'r', 'l', 'd');
    foreach ($arr as $k => $val) { //入队
        $redis->rpush('list', $val);
    }
    echo "队列总长度：".$redis->lLen('list');
    echo "<br/>";
    
    while (true) { //出对
        $get = $redis->lpop('list');
        if ($get) {
            echo '出队列--' . $get;
            echo '<br/>';
        } else {
            echo '出队完成';
            return false;
        }
    
    }
    这是你的代码，没有呀
    
队列总长度：10
出队列--h
出队列--e
出队列--l
出队列--l
出队列--o
出队列--w
出队列--o
出队列--r
出队列--l
出队列--d
出队完成
    
    sql问题（店铺 商家 活动的sql）https://segmentfault.com/q/1010000008744776
    select shopname,level,group_concat(actname) from(select shop.shopname,user.level,activity.actname from shop inner join user on shop.shopid = user.shopid inner join activity on shop.shopid = activity.shopid) group by shopname,level
    ￼
```
像很多网站(比如电商)里的筛选功能一般是如何实现的？https://segmentfault.com/q/1010000008645411 

https://segmentfault.com/q/1010000008671774
数据隔离级别，一般是在数据启动的配置文件中设置好的，没有特殊场景的话不需要在程序代码中设置。

对于一些需要独占资源的操作，需要在代码中使用SELECT ... FOR UPDATE类似的代码加锁，然后通过COMMIT/ROLLBACK进行事务处理，数据库自己会释放对应的锁。
php 定时执行任务问题https://segmentfault.com/q/1010000008671224
redis 做一个以mysql时间字段为触发时间的服务 定时推送

具体 你可以找下redis实现的步骤！redis肯定可以实现！

MySQL 5.7 以上版本默认禁止 0000-00-00 的日期。在 MySQL 的配置文件 [mysqld] 区域添加

sql_mode="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
然后重启 MySQLhttps://segmentfault.com/q/1010000008666236 
MySQL 隐式转化啊 
SELECT 1='1w';

结果是 1 就是 TRUE
积分返还算法求解https://segmentfault.com/q/1010000008652947 
mysql如何处理数据变化中的事务https://segmentfault.com/q/1010000008655798
事务这块在程序控制，一般不要数据库自己的事务机制
mysql proxy怎么做代理https://segmentfault.com/q/1010000008697657
http://coolerfeng.blog.51cto.com/133059/90231/
如何保证两次操作都达到预期效果https://segmentfault.com/q/1010000008685406
status ASC, (case when FROM_UNIXTIME(end_date,'%Y%m%d%H%i') > '".date('YmdHi')."' then 1 else 0 end) DESC, start_date ASC, end_date ASC,create_date ASC "; 这句sql应该是php拼接的，date('YmdHi')是当前时间。end_data比当前时间大的为1反之为0，然后根据这个数值降序，前排显示未结束的纪录 https://segmentfault.com/q/1010000008685489
https://segmentfault.com/q/1010000008676874 
php PDO的模拟预编译语句和本地预处理语句区别https://segmentfault.com/q/1010000008671265
开发的时候最好是加上这句$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false)，这样如果支持本地预处理则会使用本地预处理，在不支持的情况下会自动使用模拟预处理方式。
mysql索引的疑惑？？
https://segmentfault.com/q/1010000007931752
sql 左连接结果union右连接结果https://segmentfault.com/q/1010000008632475
select t.a , sum(t.b) from (
select t1.a , b from t1 
union all
select t2.a , 0-b from t2
) t group by t.a
find_in_sethttps://segmentfault.com/q/1010000008719869
SELECT * FROM `table_name` WHERE FIND_IN_SET('0',`b_leibie`);



