###[正则取出其中的 IP 地址](https://www.v2ex.com/t/344344#reply19)
```js
print 'jdbc:mysql://10.0.151.205:3306 -> 10.0.151.205:3306'.split('->')[1].split(':')[0].strip()
>>> import urlparse 
>>> a = 'jdbc:mysql://10.0.151.205:3306' 
>>> urlparse.urlparse(urlparse.urlparse(a).path).hostname 
'10.0.151.205'
 split rsplit lsplit 是一组函数 他第二个参数非常有用的 

>>> a.rsplit(':', 1)[0].rsplit('/', 1)[-1] 
'10.0.151.205'
print '''jdbc:mysql://10.0.151.205:3306'''.split('/')[-1].split(':')[0]
https://www.v2ex.com/t/344404 
 https://regex101.com/r/aQUufT/1 http://regex.alf.nu/ 

```
###[「特别的」短网址](https://www.v2ex.com/t/344247#reply29)
地址: https://advertics.io/
###[性能研究专栏小组](https://www.v2ex.com/t/344364#reply22)
https://github.com/barretlee/performance-column/issues 
###[微信公众号菜单编辑器](https://www.v2ex.com/t/344534#reply0)
https://handsomeone.github.io/WeChatMenuManager/

###[防止 MySQL 的 ibdata1 文件过大](https://www.v2ex.com/t/344695#reply2)
```js
在 MySQL 5.6.6 版本以前， MySQL 默认会把所有的 innodb 的表都放在同一个文件中(ibdata1)，当该文件过大的时候， MySQL 容易出错，维护性能差。一个简单的办法是修改 MySQL 配置文件 /etc/my.cnf 后重启 [mysqld]

innodb_file_per_table=1
 mysqldump 备份所有数据库后重建所有数据库，步骤如下

mysqldump -u user -p password --all-databases > backup.sql 导出所有数据
删除所有数据库 drop database database_N
停止 MySQL 服务 service mysql stop 如果是 Mariadb 就是 service mariadb stop
删除文件 ibdata1, ib_logfile0, ib_logfile1
重启 MySQL 服务 service mysql start 如果是 Mariadb 就是 service mariadb start
导入备份数据 mysql -u user -p password --all-databases < backup.sql
另一种办法是把已经储存在 ibdata1 里面的 innodb 表拿出来放到它自己的路径上 mysql -sN -u user -p -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb'" | awk -F" " '{print "alter table"$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql

如果要排除 MySQL 自带的 table ，可以修改上面脚本中的 where 部分的语句。下面是在 Plesk 中使用的一个例子 MYSQL_PWD=cat /etc/psa/.psa.shadow mysql -sN -u admin -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb' and table_schema != 'apsc' and table_schema != 'mysql' and table_schema != 'psa' and table_schema != 'information_schema' and table_schema != 'horde' and table_schema != 'performance_schema' and table_schema != 'roundcubemail' and table_schema not like 'phpmyadmin_%' " | awk -F" " '{print "alter table "$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql
```
###[国内的 composer 镜像](https://www.v2ex.com/t/344430#reply37)
https://pkg.phpcomposer.com/ 
git 也学会 -c HTTP_PROXY=http://127.0.0.1:1080
composer config -g repo.packagist composer https://p.staticq.com 
国内还有其它镜像 ThinkPHP 目前推荐的是 https://packagist.composer-proxy.org
###[HTML5 的匿名聊天室，试试 socket.io](https://www.v2ex.com/t/344540#reply19)
https://github.com/sheila1227/ChatRoom-AngularJS

###[wxpy: 优雅的微信个人号 机器人/API，用 Python 玩微信](https://www.v2ex.com/t/343685#reply48)
###[StackOverflow 上整理的 Python 2 和 3 之间的一些兼容性方面的细节问题](https://www.v2ex.com/t/344107#reply1)
http://stackoverflow.com/documentation/python/809/incompatibilities-between-python-2-and-python-3
###[静态网站生成器： Pagic](https://www.v2ex.com/t/344182#reply33)
GitHub: https://github.com/xcatliu/pagic
###[获取ip](https://www.v2ex.com/t/344470)
ifconfig.me 连不上 
ifconfig.co 太慢 

我用 Go 写了一个 ifconfig.cat 

curl ifconfig.cat 
wget -q ifconfig.cat 
http -b ifconfig.cat 
curl http://ip-api.com/line http://ip-api.com/docs/  
curl ipecho.net/plain https://ifconfig.minidump.info/ 
###[24小时从0到1开发阴阳师小程序](https://zhuanlan.zhihu.com/p/25477688)
```js
前端毫无疑问就是微信小程序咯；
后端使用 Django 提供 Restful API 服务；https://link.zhihu.com/?target=https%3A//github.com/bluedazzle/django-simple-serializer
# coding: utf-8
import json
import requests
import urllib
from xpinyin import Pinyin
url = "https://g37simulator.webapp.163.com/get_heroid_list?callback=jQuery11130959811888616583_1487429691764&rarity=0&page=1&per_page=200&_=1487429691765"
result = requests.get(url).content.replace('jQuery11130959811888616583_1487429691764(', '').replace(')', '')
json_data = json.loads(result)
hellspawn_list = json_data['data']
p = Pinyin()
for k, v in hellspawn_list.iteritems():
    file_name = p.get_pinyin(v.get('name'), '')
    print 'id: {0} name: {1}'.format(k, v.get('name'))
    big_url = "https://yys.res.netease.com/pc/zt/20161108171335/data/shishen_big/{0}.png".format(k)
    urllib.urlretrieve(big_url, filename='big/{0}@big.png'.format(file_name))
    avatar_url = "https://yys.res.netease.com/pc/gw/20160929201016/data/shishen/{0}.png".format(k)
    urllib.urlretrieve(avatar_url, filename='icon/{0}@icon.png'.format(file_name))
    
    https://link.zhihu.com/?target=https%3A//github.com/bluedazzle/HellspawnHunterBackend 
    >>> p.get_pinyin('世界只关心你能提供')
'shi-jie-zhi-guan-xin-ni-neng-ti-gong'
```
###[代码这样写更优雅 (Python 版)](https://zhuanlan.zhihu.com/p/25518608)
```js
变量交换

大部分编程语言中交换两个变量的值时，不得不引入一个临时变量：

>>> a = 1
>>> b = 2
>>> tmp = a
>>> a = b
>>> b = tmp
pythonic

>>> a, b = b, a
循环遍历区间元素

for i in [0, 1, 2, 3, 4, 5]:
    print i
# 或者
for i in range(6):
    print (i)
pythonic

for i in xrange(6):
    print (i)

带有索引位置的集合遍历

遍历集合时如果需要使用到集合的索引位置时，直接对集合迭代是没有索引信息的，普通的方式使用：

colors = ['red', 'green', 'blue', 'yellow']

for i in range(len(colors)):
    print (i, '--->', colors[i])
pythonic

for i, color in enumerate(colors):
    print (i, '--->', color)

字符串连接

字符串连接时，普通的方式可以用 + 操作

names = ['raymond', 'rachel', 'matthew', 'roger',
         'betty', 'melissa', 'judith', 'charlie']

s = names[0]
for name in names[1:]:
    s += ', ' + name
print (s)
pythonic

print (', '.join(names))

f = open('data.txt')
try:
    data = f.read()
finally:
    f.close()
pythonic

with open('data.txt') as f:
    data = f.read()
列表推导式

能够用一行代码简明扼要地解决问题时，绝不要用两行，比如

result = []
for i in range(10):
    s = i*2
    result.append(s)
pythonic

[i*2 for i in xrange(10)]

遍历字典的 key 和 value

# 方法一
for k in d:
    print k, '--->', d[k]

# 方法二
for k, v in d.items():
    print (k, '--->', v)
pythonic

for k, v in d.iteritems():
    print (k, '--->', v)

names = ['raymond', 'rachel', 'matthew', 'roger',
         'betty', 'melissa', 'judith', 'charlie']
names.pop(0)
names.insert(0, 'mark')
pythonic

from collections import deque
names = deque(['raymond', 'rachel', 'matthew', 'roger',
               'betty', 'melissa', 'judith', 'charlie'])
names.popleft()
names.appendleft('mark')
deque 是一个双向队列的数据结构，删除元素和插入元素会很快
 

善用装饰器

装饰器可以把与业务逻辑无关的代码抽离出来，让代码保持干净清爽，而且装饰器还能被多个地方重复利用。比如一个爬虫网页的函数，如果该 URL 曾经被爬过就直接从缓存中获取，否则爬下来之后加入到缓存，防止后续重复爬取。

def web_lookup(url, saved={}):
    if url in saved:
        return saved[url]
    page = urllib.urlopen(url).read()
    saved[url] = page
    return page
pythonic

import urllib #py2
#import urllib.request as urllib # py3

def cache(func):
    saved = {}

    def wrapper(url):
        if url in saved:
            return saved[url]
        else:
            page = func(url)
            saved[url] = page
            return page

    return wrapper


@cache
def web_lookup(url):
    return urllib.urlopen(url).read()



```
###[ 使用Python定制词云](https://zhuanlan.zhihu.com/p/25538157)
```js
$ mkdir work && cd work
$ sudo apt-get update
$ sudo apt-get install python-dev
$ sudo pip install numpy
$ sudo apt-get install python-matplotlib
$ sudo apt-get install python-pil
下载小说《三体》I、 II、 III。

$ wget http://labfile.oss.aliyuncs.com/courses/756/santi.txt
$ wget http://labfile.oss.aliyuncs.com/courses/756/santi2.txt
$ wget http://labfile.oss.aliyuncs.com/courses/756/santi3.txt
安装wordcloud扩展包。

$ sudo pip install wordcloud

作者：Wayne Shi
链接：https://zhuanlan.zhihu.com/p/25538157
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

#!/usr/bin/env python
"""
Minimal Example
===============
Generating a square wordcloud from the US constitution using default arguments.
"""

from os import path
from wordcloud import WordCloud

d = path.dirname(__file__)

# Read the whole text.
text = open(path.join(d, 'constitution.txt')).read()

# Generate a word cloud image
wordcloud = WordCloud().generate(text)

# Display the generated image:
# the matplotlib way:
import matplotlib.pyplot as plt
plt.imshow(wordcloud)
plt.axis("off")

# lower max_font_size
wordcloud = WordCloud(max_font_size=40).generate(text)
plt.figure()
plt.imshow(wordcloud)
plt.axis("off")
plt.show()

```
###[这个网站能够在线帮你把 PDF 文件轻松转成 PPT、Exel、JPG、Word 等文件](https://zhuanlan.zhihu.com/p/24735371)
https://link.zhihu.com/?target=https%3A//smallpdf.com/
###[《一个全栈增长工程师的练手项目集》](https://zhuanlan.zhihu.com/p/25534234)

http://link.zhihu.com/?target=http%3A//www.epubit.com.cn/book/details/4868




