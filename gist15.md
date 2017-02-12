###pyinstaller打包
python 版本 python3 

pip install pypiwin32 

pip install pyinstaller 


打包 exe 命令 
pyinstaller -F -w -i manage.ico app.py 

-F ：打包为单文件 
-w ： Windows 程序，不显示命令行窗口 
-i ：是程序图标， app.py 是你要打包的 py 文件
###[情人节表白助攻—微信记录词云分析](https://zhuanlan.zhihu.com/p/25188725)
```js
# -*- coding: utf-8 -*-
"""
Created on Tue Jan 17 17:00:15 2017
 pip install wordcloudhttps://github.com/amueller/word_cloud  http://www.lfd.uci.edu/~gohlke/pythonlibs/#wordcloud
@author: hhl
"""
#首先加载所需的各种库
import re
import requests
import time
import numpy as np
import codecs
import pandas
from lxml import etree
#import seaborn as sns
import jieba
import os
from wordcloud import WordCloud
import matplotlib.pyplot as plt
%matplotlib inline
 
#遍历文件中的数据
file=codecs.open(u"Msg_new666_20170211.html",'r')
html=file.read()
file.close()
 
#通过相应规则整理数据
item_pattern = re.compile(
    r'<SPAN class="MsgHistory">(.*?)</SPAN>',
    re.S)
 
 
def parse_askitem(page):
    info = re.findall(item_pattern, page)
    return info
 
items_list = parse_askitem(html)
 
对list进行处理，取出文字类型的数据并汇总到一个content中
content_list = []
for item in items_list:
    #print(item)
    if ('.' not in item)&(';' not in item):
        content_list.append(item)
 
content =""
for con in content_list:
    content = content + con
 
#print(len(content))
 
#分词   
segment = []
segs = jieba.cut(content)
for seg in segs:
    if len(seg) > 1 and seg!='\r\n':
        segment.append(seg)
 
#去停用词
words_df=pandas.DataFrame({'segment':segment})
words_df.head()
#stopwords=pandas.read_csv("stopwords.txt",index_col=False,quoting=3,sep="\t",names=['stopword'])#quoting=3全不引用
#stopwords.head()
#words_df=words_df[~words_df.segment.isin(stopwords.stopword)]
ancient_chinese_stopwords=pandas.Series([#'的',
                                         #'其','或','亦','方','于','即','皆',
                                         #'因','仍','故','尚','呢','了','的','着',
                                         '" "'])
words_df=words_df[~words_df.segment.isin(ancient_chinese_stopwords)]
 
#统计词频
words_stat=words_df.groupby(by=['segment'])['segment'].agg({"number":np.size})
words_stat=words_stat.reset_index().sort_values(by="number",ascending=False)
 
#照片做词云
from scipy.misc import imread
import matplotlib.pyplot as plt
from wordcloud import WordCloud,ImageColorGenerator
bimg=imread('timefriends_lcz.jpg')
wordcloud=WordCloud(background_color="white",mask=bimg,font_path='msyh.ttf')
wordcloud=wordcloud.fit_words(words_stat.head(39769).itertuples(index=False))
bimgColors=ImageColorGenerator(bimg)
plt.figure(figsize=(20,15))
plt.axis("off")
plt.imshow(wordcloud.recolor(color_func=bimgColors))
plt.show()
 
#==========================中文显示乱码问题===========================================
 
import matplotlib
zhfont1 = matplotlib.font_manager.FontProperties(fname='msyh.ttf')
# 设置显示中文
matplotlib.rcParams['font.sans-serif'] = ['msyh'] #指定默认字体
matplotlib.rcParams['axes.unicode_minus'] = False #解决保存图像是负号'-'显示为方块的问题
 
from matplotlib.font_manager import FontProperties
font = FontProperties(fname=r"msyh.ttc", size=14)
 
words_stat[:20].plot(y='number', kind='bar')#x='segment', 中文未能正常显示
 
words_stat[:20].plot(x='segment', y='number', kind='bar')#中文未能正常显示

```
###[Python爬虫利器之PyQuery的用法](https://zhuanlan.zhihu.com/p/25164773)
```js
from pyquery import PyQuery as pq
doc = pq(filename='hello.html')
from lxml import etree
doc = pq(etree.fromstring("<html></html>"))
p = pq('<p id="hello" class="hello"></p>')('p')
print p.append(' check out <a href="http://reddit.com/r/python"><span>reddit</span></a>')
print p.prepend('Oh yes!')
d = pq('<div class="wrap"><div id="test"><a href="http://cuiqingcai.com">Germy</a></div></div>')
p.prependTo(d('#test'))
print p
print d
d.empty()
print d

 
```
###[使用Python绘制图表](https://zhuanlan.zhihu.com/p/25181021)
```js
import matplotlib.pyplot as plt
import numpy as np
mu = 100
sigma = 20
x = mu + sigma * np.random.randn(20000)  # 样本数量
plt.hist(x,bins=100,color='green',normed=True)   # bins显示有几个直方,normed是否对数据进行标准化
plt.show()
 
```
###[程序员工作](https://www.zhihu.com/question/55582625)
```js
 #https://link.zhihu.com/?target=https%3A//github.com/ipreacher/tricks

coding(不会or会);
function coding(不会or会) {
    if(不会){
        for(搜索结果 in google){
            if(搜索结果==貌似可以){
                ctrl+c;
                ctrl+v;
                ctrl+s;
                if(checkin==false){
                    coding(不会);
                }else{
                    break;
                }
            }
        }
    }else{
        看看微博;
        doing;
        看看知乎;
        doing;
        看看朋友圈;
        doing;
        看看github;
        if(checkin==false){
            coding(不会);
        }
    }
}
while (还在微软)
{

while (任务没完成)
{
    do
    {
        写点代码
        编译一下
        上知乎回答10个问题
        看了一眼还没编译好
        上知乎再回答10个问题
    } while (编译没通过);
    运行
}
发code review
下班去google接老婆

do
{
    checkin
    上知乎再回答50个问题
    下班去google接老婆
} while (checkin没成功);

}
 
```
###[用 Python 分析指定知乎用户的关注者情况](https://zhuanlan.zhihu.com/p/25199087?refer=ipreacher)
```js
__author__ = 'ipreacher'

import zhihuapi as api

with open('cookie') as f:
    api.cookie(f.read())
# 拉取并打印关注者的基本信息，包括序号及其个性域名、昵称、赞同数、感谢数、关注人数
def ff():
    for i in range(len(r2)):
        r3 = api.user(r2[i]).detail()
        r4 = [i, r3['urlToken'], r3['name'], r3['voteupCount'], r3['thankedCount'], r3['followerCount']]
        r5.append(r4)
        print(r4)
    #print(r5)

import zhihuapi as api
#请求知乎，复制request header的Cookie: 字段
with open('cookie') as f:
    api.cookie(f.read())

data = api.user('zhihuadmin').profile()
print(data)
{
    "url_token": "zhihuadmin",
    "avatar_url": "https://pic3.zhimg.com/34bf96bf5584ac4b5264bd7ed4fdbc5a_is.jpg",
    "avatar_url_template": "https://pic3.zhimg.com/34bf96bf5584ac4b5264bd7ed4fdbc5a_{size}.jpg",
    "type": "people",
    "name": "知乎小管家",
    "headline": "欢迎反馈问题和建议！",
    "is_org": false,
    "url": "https://www.zhihu.com/people/zhihuadmin",
    "badge": [
        {
            "type": "identity",
            "description": "知乎官方帐号"
        }
    ],
    "user_type": "people",
    "is_advertiser": false,
    "id": "3d198a56310c02c4a83efb9f4a4c027e"
}


```
###[用PHP做爬虫相当简单](https://www.zhihu.com/question/26790346)
```js


https://my.oschina.net/eechen/blog/745224
接口1: php -S 127.0.0.1:8080 -t /home/eechen/www
接口2: php -S 127.0.0.2:8080 -t /home/eechen/www
/home/eechen/www/index.php:
<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode(array('SERVER_NAME' => $_SERVER['SERVER_NAME']));
//串行访问需要sum(2,1)秒,并行访问需要max(2,1)秒.
($_SERVER['SERVER_NAME'] == '127.0.0.1') ? sleep(2) : sleep(1);
?>

并行发出多个请求:
<?php
$url[] = 'http://127.0.0.1:8080';
$url[] = 'http://127.0.0.2:8080';
$mh = curl_multi_init();
foreach($url as $k => $v) {
	$ch[$k] = curl_init($v);
	curl_setopt($ch[$k], CURLOPT_HEADER, 0); //不输出头
	curl_setopt($ch[$k], CURLOPT_RETURNTRANSFER, 1); //exec返回结果而不是输出,用于赋值
	curl_multi_add_handle($mh, $ch[$k]); //决定exec输出顺序
}
$running = null;
$starttime = microtime(true);
//执行批处理句柄(类似pthreads多线程里的start开始和join同步)
do {
	//CURLOPT_RETURNTRANSFER如果为0,这里会直接输出获取到的内容.
	//如果为1,后面可以用curl_multi_getcontent获取内容.
	curl_multi_exec($mh, $running); 
	//阻塞直到cURL批处理连接中有活动连接,不加这个会导致CPU负载超过90%.
	curl_multi_select($mh);
} while ($running > 0);
echo microtime(true) - $starttime."\n"; //耗时约2秒
foreach($ch as $v) {
	$json[] = curl_multi_getcontent($v);
	curl_multi_remove_handle($mh, $v);
}
curl_multi_close($mh);
var_export($json); 
//输出:
2.0015449523926
array (
  0 => '{"SERVER_NAME":"127.0.0.1"}',
  1 => '{"SERVER_NAME":"127.0.0.2"}',
)

curl http://www.topit.me/|grep -P "http:[^>]*?(jpg|gif)" -o|xargs wget

这就是一个正则搜索url中以http开头 jpg或gif结尾的字符串，使用wget下载的例子
```
