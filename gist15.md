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
