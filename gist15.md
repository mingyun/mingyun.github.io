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
###[图文并茂！8 张 Gif 图学会 Flexbox](https://zhuanlan.zhihu.com/p/25152672)
```js
#container {
  display: flex;
  flex-direction: column;
}
```
###[PHP倒序输出所有日志内容](https://zhuanlan.zhihu.com/p/25128276)
```js
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content = "5"> 
</head>
<body>
<?php
$fp = file("out.log");
if ($fp) {
for($i = count($fp) - 1;$i >= 0; $i --) 
echo $fp[$i]."<br>";
            }
?>
</body>
</html>
5秒刷新一次网页来查看最新的日志。
<?php 
$ph = popen('tail -n 100 out.log','r');
while($r = fgets($ph)){
echo $r."<br>";
            }
            pclose($ph);
?>
 
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
###[JavaScript 面试](https://zhuanlan.zhihu.com/p/25176639)
```js
document.addEventListener('DOMContentLoaded', function() {
  
  let app = document.getElementById('todo-app');
  let items = app.getElementsByClassName('item');
  
  // attach event listener to each item
  for (let item of items) {
    item.addEventListener('click', function() {
      alert('you clicked on item: ' + item.innerHTML);
    });
  }
});


document.addEventListener('DOMContentLoaded', function() {
  let app = document.getElementById('todo-app');
  
  // attach event listener to whole container
  app.addEventListener('click', function(e) {
    if (e.target && e.target.nodeName === 'LI') {
      let item = e.target;
      alert('you clicked on item: ' + item.innerHTML);
    }
  });
});
const arr = [10, 12, 15, 21];
for (var i = 0; i < arr.length; i++) {
  // pass in the variable i so that each function 
  // has access to the correct index
  setTimeout(function(i_local) {
    return function() {
      console.log('The index of this number is: ' + i_local);
    }
  }(i), 3000);
}
const arr = [10, 12, 15, 21];
for (let i = 0; i < arr.length; i++) {
  // using the ES6 let syntax, it creates a new binding
  // every single time the function is called
  // read more here: http://exploringjs.com/es6/ch_variables.html#sec_let-const-loop-heads
  setTimeout(function() {
    console.log('The index of this number is: ' + i);
  }, 3000);
}
```
###[QQ聊天记录数据分析](https://zhuanlan.zhihu.com/p/25171755)
```js
#定义数据框和变量
data <- data.frame(user_name = c(), datetime = c(), text = c())
user_name <- character()
datetime <- character()
text <- character()
#开始遍历整个文本，取出三列数据
for(i in 5:length(file_data)){
dt_pattern <- regexpr('[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]+:[0-9]+:[0-9]+',file_data[i])
if(dt_pattern == 1) {
user_begin <- dt_pattern+attr(dt_pattern,'match.length') + 1
user_end <- nchar(file_data[i])
user_name <- substring(file_data[i],user_begin,user_end)

dt_begin <- dt_pattern
dt_end <- dt_pattern+attr(dt_pattern,'match.length')-1
datetime <- substring(file_data[i],dt_begin,dt_end)

text <- file_data[i+1]

data <- rbind(data, data.frame(Name = user_name,datetime = datetime,text = text))
}
}
#字段类型转换
data$user_name <- as.character(data$Name)
data$text <- as.character(data$text)
data$datetime <- as.POSIXlt(data$datetime)
#取出时间戳（datetime）的年、月、日、时、分、秒部分
data <- transform(data,
year = datetime$year+1900,
month = datetime$mon+1,
day = datetime$mday,
hour = datetime$hour,
min = datetime$min,
sec = datetime$sec)
data$datetime <- as.character(data$datetime)
```
###[关于反爬虫](https://zhuanlan.zhihu.com/p/25174337)
```js
from selenium import webdriver
from selenium.webdriver.common.keys import Keys    #
from selenium.webdriver.support.ui import WebDriverWait   # WebDriverWait的作用是等待某个条件的满足之后再往后运行
from selenium.webdriver import ActionChains
import time
import sys
driver = webdriver.PhantomJS(executable_path='C:\PyCharm 2016.2.3\phantomjs\phantomjs.exe')  # 构造网页驱动

driver.get('https://www.zhihu.com/#signin')       # 打开网页
driver.find_element_by_xpath('//input[@name="password"]').send_keys('your_password')
driver.find_element_by_xpath('//input[@name="account"]').send_keys('your_account')
driver.get_screenshot_as_file('zhihu.jpg')                   # 截取当前页面的图片
input_solution = input('请输入验证码 :')
driver.find_element_by_xpath('//input[@name="captcha"]').send_keys(input_solution)
time.sleep(2)

driver.find_element_by_xpath('//form[@class="zu-side-login-box"]').submit()  # 表单的提交  表单的提交，即可以选择登录按钮然后使用click方法，也可以选择表单然后使用submit方法
sreach_widonw = driver.current_window_handle     # 用来定位当前页面
# driver.find_element_by_xpath('//button[@class="sign-button submit"]').click()
try:
dr = WebDriverWait(driver,5)
# dr.until(lambda the_driver: the_driver.find_element_by_xpath('//a[@class="zu-side-login-box"]').is_displayed())
if driver.find_element_by_xpath('//*[@id="zh-top-link-home"]'):
print('登录成功')
except:
print('登录失败')
driver.save_screenshot('screen_shoot.jpg')     #截取当前页面的图片
sys.exit(0)
driver.quit()   #退出驱动

import requests
proxies = { "http": "http://10.10.1.10:3128",
"https": "http://10.10.1.10:1080",}
p = request.get("http://www.baidu.com", proxies = proxies)
print(p.content.decode('utf-8'))
```
###[R语言如何画个性化词云图](https://zhuanlan.zhihu.com/p/25163990?refer=rshequ)
```js
wordcloud2(demoFreq, size = 1,shape='star')
wordcloud2(demoFreqC, size = 1.55,figPath =log)
```
###[Python密码学之旅凯撒密码和栅栏密码](https://zhuanlan.zhihu.com/p/25157493)
```js
 

#字符表
mstr='abcdefghijklmnopqrstuvwxyz'
#字符表长度
lengthM=len(mstr)

#strs为输入的明文，shitf为移动的位数
def caesar(strs,shift):
    newstrs =''
    for x in strs:
            #获取x字符在mstr中的位置
        numX=mstr.index(x)
        
            #新的字符位置加上shift
        numX=(numX+shift)%lengthM
        
        newstrs=newstrs+mstr[numX]
     
    return newstrs

if __name__ == '__main__':
    strs = raw_input("Enter character sequence:")
    shift = input("Shift Numbers:")
    C=caesar(strs,shift)
    print("CiperText:",C)
    print("PlainText:",caesar(C,int(shift)*(-1)))
```
###[add(1)(2)(3);](https://segmentfault.com/q/1010000008323101)
```js
function add(x){
    var num = x;
    function _add(para){
        num+=para;
        return _add;
    }
    _add.toString=function(){
        return num;
    }
    return _add;
}


var a = add(1)(2)(3);
console.log(a);//6
console.log((a+7));//13
console.log(a(11));//17

function add(x){
    var num = x;
    function _add(para){
        num+=para;
        return _add;
    }
    _add.log=function(){
        return num;
    }
    return _add;
}


var a = add(1)(2)(3);
console.log(a);
a.log()

在执行a+7的时候 会自动调用toString 以下展示了这个情况

var a = function() {return 3}
a + 7
// "function () {return 3}7"
a.toString = function() {return 3}
a + 7
// 10

console.log函数需要把变量转换成字符串打印，所以会首先调用变量的toString方法的，你把_add.toString换成_add.log再试试就不会自动打印出结果了，就会是函数了，除非再手动调用log
```
###[单点登录](https://segmentfault.com/q/1010000008325474)
```js
www.baidu.com （调用者） 
tieba.baidu.com （调用者） 
pic.baidu.com （调用者） 
login.baidu.com （服务者）。

对于各个模块之间应该保持充分的独立性
单点登陆实现方案吧：

某个项目登陆成功，广播其他注册的项目进行登陆操作[写session的操作]
某个项目登陆成功，url会携带一个ticket，各个项目通过解析ticket获取uid进行写session操作
```
###[微信扫码关注](https://segmentfault.com/q/1010000008321149)
1、网站里每次都生成一个带参数的公众号二维码（临时）
2、用户用微信扫码后关注，服务端获取到关注事件以及该用户和参数二维码标识。
3、服务端返回内容，提示输入Y
4、网页端根据服务端获取到的事件进行后续处理。
###[nodejs做一个简易的tcp聊天程序](https://segmentfault.com/q/1010000008293716)
```js
var net=require('net');

var count=0, users={};

var server=net.createServer(function(conn){
    conn.write(
        '\n\r > welcome to\033[92m node-chat\033[39m !'+
        '\n\r > '+count+' other people are connected at this time.'+
        '\n\r > please write your name and press enter: '
    );
    count++;

    conn.setEncoding('utf8');

    var nickname;

    function broadcast(msg, exceptMyself){
        for(var i in users){
            if(!exceptMyself||i!=nickname){
                users[i].write(msg);
            }
        }
    }

    var tmp = '';

    conn.on('data',function(data){
        tmp += data;
        if (tmp.indexOf('\n') === -1) {
            return;
        }
        data = tmp.replace(/\r|\n/g, '');
        if(!nickname){
            if(users[data]){
                conn.write('\r\n\033[93m> nickname already in use. try again:\033[39m\r\n ');
                tmp='';
                return;
            }else{
                nickname=data;
                users[nickname]=conn;

                broadcast('\r\n\033[90m> '+nickname+' joined the room\033[39m\r\n');
            }
        }else{
            broadcast('\r\n\033[96m> '+nickname+':\033[39m '+data+'\r\n');
        }

        tmp='';
        
    });

    conn.on('close',function(){
        count--;
        delete users[nickname];
        broadcast('\r\n\033[096m> '+nickname+' left the room\033[39m \r\n');
    });
});

server.listen(3000,function(){
    console.log('\033[96m server listening on *:3000\033[39m');
});
```
###[下拉刷新出来](https://segmentfault.com/q/1010000008324477)
```js
$(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
        $('#banner').show();
    } else {
        $('#banner').hide();
    }
});
// 滚动控制返回顶部和漂浮栏出现、隐藏
$(window).scroll(function() {
    console.log($(this).scrollTop());
});
```
###[mysql数据insert快还是update比较快](https://segmentfault.com/q/1010000008276218)
```js
查询： 主键查询最快，索引查询次之，where条件中有函数再次之；扫描行数越少越快。
插入：根据索引数量，索引越多插入越慢。插入行数越多越慢，因为会导致重建索引。
删除：行数越多越慢，索引数量越多越慢，因为会导致重建索引
更新：同删除，因为索引列数据改变会导致重建索引https://segmentfault.com/q/1010000008299383

修改用户余额前，因为怕修改出问题，意外把用户余额改为0什么的。而选择先插入一条记录到用户账务变动表，然后查出账务变动表的数据，来更新用户余额字段。
// 开始事物
BEGIN ;

// 取出该用户数据，并锁住，防止其他线程（进程）读取该条记录
SELECT * FROM users where id = $id FOR UPDATE ;

// 处理业务...计算用户新的余额

// 更新用户余额
UPDATE users SET money = $new_money;

// 获取影响行数=1,则：{
  // 提交事物（解锁我们锁定的记录）
  COMMIT ;
}else{
  // 发现不对，撤销我们在事物内做的所有操作
  ROLLBACK ;
}
```
###[Python的参数里的：](https://segmentfault.com/q/1010000008325027)
type hinthttps://www.python.org/dev/peps/pep-0484/
def greeting(name: str) -> str:
  return 'Hello ' + name
###[微信红包算法](https://segmentfault.com/q/1010000008324708)
```js
        function ranAllo(value, min, max, length) {

            var ran = [], arrId;

            //循环存放数组最小值
            for(var i = 0; i < length; i++) {
                
                ran[i] = min;
                
            }
            
            //计算剩下的值
            var spare = value - (min * length);
            
            while(spare > 0) {
                
                //生成数组随机ID
                arrId = Math.round(Math.random() * length);

                if(ran[arrId] < max) {
                    
                    ran[arrId] += 1;
                    
                    spare--;
                    
                }
                
            }
            
            console.log(ran);
            
            return ran

        }
```
    
###[Chrome 调试js时，如何避开各种插件js的干扰](https://segmentfault.com/q/1010000008322986)  
Blackbox Script
###[mysql for update 如果事务一直没有提交会不会这表数据一直锁在那里](https://segmentfault.com/q/1010000008309121)
不会。客户端连接断开后，会自动释放锁。

客户端1

set AUTOCOMMIT = 0;
BEGIN；
SELECT * FROM articles WHERE id=1 FOR UPDATE ;
客户端2

set AUTOCOMMIT = 0;
BEGIN；
SELECT * FROM articles WHERE id=1 FOR UPDATE ;
这时，客户端2的查询会卡住。直到客户端1 commit 或 rollback 。但是，如果客户端1直接关闭窗口断开连接，客户端2也能直接拿到锁。说明客户端断开时，会自动释放锁。
###[标签的id中存在#](https://segmentfault.com/q/1010000008320447)
用双反斜杠转义，即对于id="foo#bar"，用$('#foo\\#bar')
###[underscore的_.without函数](https://segmentfault.com/q/1010000008320336)
function without(arr, obj){
    arr.splice(arr.indexOf(obj),1)
}
let arrObj = [obj1,obj2,obj3,obj4];
_.without(arrObj,obj1);
console.log(arrObj);//[obj2,obj3,obj4]
###[php str_replace替换关键词，如何控制长词优先](https://segmentfault.com/q/1010000008320325)
```js
function str_replace_once($needle,$replace,$haystack) {
    $pattern = '/<img[^>]*>/is';
    preg_match_all($pattern, $haystack, $matched);
    if(empty($matched[0])){
        $pos = strpos($haystack, $needle);
        if ($pos === false) {
            return $haystack;
        }
        return substr_replace($haystack, $replace, $pos, strlen($needle));
    } else {
        $arr = preg_split($pattern, $haystack);
        $haystack_new = '';
        $replace_time = 0;
        foreach($arr as $key => $str){
                        $pos = strpos($str, $needle);
            if ($pos === false || $replace_time > 0 || strpos($str, $needle.'</a>') !== false) {
                $haystack_new .= $str;
            } else {
                $haystack_new .= substr_replace($str, $replace, $pos, strlen($needle));
                $replace_time  = 1;
            }
            if(isset($matched[0][$key])) $haystack_new .= $matched[0][$key];
        }
        return $haystack_new;
    }
}

$str0 = 'php技术 是时下最好用的 php'; // 替换成 'java技术 是时下最好用的 编程技术' 
$str1 = 'php技术';
$str2 = 'php'
// 比较字符串长短，并组合成数组
function compare(){
    $vars = func_get_args();
    $list = array();
    $len  = array();
    $rel  = array();
    
    // 收集长度 + 对照表
    foreach ($vars as $k => $v)
        {
            $l       = mb_strlen($v);
            $list[$k] = $l;
            $len     = $l;
        }
    
    $count = count($len);
    
    // 选择排序：对长度进行比较
    for ($i = 0; $i < $count; ++$i)
        {
            $longest = $i;
            
            for ($n = $i + 1; $n < $count; ++$n)
                {
                    if ($len[$i] < $len[$n]) {
                        $longest = $n;
                    }
                }
            
            if ($i !== $longest) {
                $tmp = $len[$i];
                $len[$i] = $len[$longest];
                $len[$longest] = $tmp;
            }
        }
     
     // 搜集整理
     foreach ($len as $v)
         {
             $rel[$v] = $list[$v];
         }
         
    // 返回最终结果
    return $rel;
}

// 队列方式按照长的先替换
$rel = compare($str1 , $str2);
$replace = array('java' , '编程技术');

for ($i = 0; $i < count($rel); ++$i)
    {
        $str0 = preg_replace($rel[$i] , $replace[$i] , $str0);
    }
```
###[php 如何抓到當前的 TITLE](https://segmentfault.com/q/1010000008319461)
```js
document.write(document.title);
<?php
ob_start(function($buffer){
    preg_match('/<title.*>\s*(.*)\s*<\/title>/',$buffer,$str);
    return $str[1];
});

?>
<!DOCTYPE html>
<html>
<head>
    <title>我是一个title</title>
</head>
<body>
</body>
</html>
<?php

ob_end_flush();
$url = "http://bosonnlp.com/account/login";
$body = (new \GuzzleHttp\Client)->get($url)->getBody()->getContents();
$title = (new \Symfony\Component\DomCrawler\Crawler($body))->filter('title')->text();
var_dump($title);
```
###[浏览器打开图片要显示不要下载](https://segmentfault.com/q/1010000008315289)
<a href="http://*****/e90fecec7b38b42a406318e78f961a1a.png" target="_blank">查看</a>
head中的类型不是图片images/*而是application/octet-stream
得到的服务端返回的响应头，将Content-Type改成images/*就可以啦
###[输出变量名及变量类型](https://segmentfault.com/q/1010000008314212https://segmentfault.com/q/1010000008314212)
```js
function var_types() {
    $bt = debug_backtrace()[0];
    $file = new \SPLFileObject($bt['file']);
    $file->seek($bt['line'] - 1);
    $line = $file->current();
    $matchs = null;
    preg_match('/var_types\((.*)\)/', $line, $matchs);
    $param_names = array_map('trim', explode(",", $matchs[1]));
    $args = func_get_args();

    for ($i = 0; $i < count($args); $i++) {
        echo $param_names[$i] . ' ' . gettype($args[$i]) . PHP_EOL;
    }
}
https://3v4l.org/522df
define('MY_CONSTANT', 1);
$string = "STR";
$num = 123.4;

var_types(MY_CONSTANT, $string, $num, $_GET, $_SERVER['PHP_SELF']);
MY_CONSTANT integer
$string string
$num double
$_GET array
$_SERVER['PHP_SELF'] string
```
###[php正则表达式匹配@用户名](https://segmentfault.com/q/1010000008317959)
```js
$users = [
    ['id' => 1, 'name' => '小明'],
    ['id' => 2, 'name' => '小李'],
];

$comment = '@小明 你好，@小李 你也好”中的小明，小李提取出';


$comment = preg_replace_callback('/(@)(.+?)(\s)/', function ($matches) use ($users) {
    foreach ($users as $user) {
        if ($matches[2] === $user['name']) {
            return "<a href='/user/{$user['id']}'>@$matches[2]</a> ";
        }
    }
    return $matches[0];
}, $comment);

var_dump($comment);

// string(111) "<a href='/user/1'>@小明</a> 你好，<a href='/user/2'>@小李</a> 你也好”中的小明，小李提取出"
```
###[过滤掉他们的script标签的src属性](https://segmentfault.com/q/1010000008300101)
$context = <<<EOF
<script src="111"> sss</script><script src="222dd"> ggg</script>
<script src="222"> fff</script>
EOF;

echo preg_replace('/\s*src=("[^"]*")|(\'[^\']*\')/', '', $context);
###[trimArray](https://segmentfault.com/q/1010000008322002)
```js
function trimArray($str, $charArray)
{
    foreach ($charArray as $char) {
        $charLength = strlen($char);
        if (substr($str, 0, $charLength) === $char) {
            // 去掉头部
            $str = substr_replace($str, '', 0, $charLength);
        }
        if (substr($str, 0 - $charLength) === $char) {
            // 去掉尾部
            $str = substr_replace($str, '', strlen($str) - $charLength, $charLength);
        }
    }
    return $str;
}

$str = '<br />
<p>gwgawegwewgaweg</p><p>awe</p><p>gawe</p><p>we</p><p>awe</p><p>eg</p><br />';

var_dump(trimArray($str,['<br />']));
// string(79) "
<p>gwgawegwewgaweg</p><p>awe</p><p>gawe</p><p>we<br /></p><p>awe</p><p>eg</p>"

```
###[安装composer报错，找不到php_pdo_firebird.dll](https://segmentfault.com/q/1010000008254232)
在PHP7中已经不再支持使用ext/mysql这个扩展了，可以使用mysqli或PDO扩展，详细情况可以看remove deprecated functionality in php7
第二个扩展的问题，这里有解决办法：PHP Startup: Unable to load dynamic library php_pdo_firebird.dll
###[Apache的 OpenSSL与PHP的不匹配问题](https://segmentfault.com/q/1010000008288880)
```js
$encrypted_all='';
    $pu_key = openssl_pkey_get_public($this->public_key);
    foreach ($cutting_data as $key => $value) {
        $encrypted='';
        openssl_public_encrypt($value,$encrypted,$pu_key);【这一步报错】
        $encrypted = base64_encode($encrypted);
        //echo $encrypted;
        $encrypted_all=$encrypted_all.$encrypted;
    }
    由于OpenSSL版本不一致，所以函数库不一样，导致此问题，同步openssl版本进行解决
```
###[算法讲解的注解](https://segmentfault.com/a/1190000005060870)
```js
$row_num = 3;
$rows = [
    'abcdefghijkl',
    'bcdefghaijkl',
    'bcdefghijkla',
];

$orders = [];
foreach ($rows as $row) {
    $orders[] = get_order($row);
}
```
###[Stack Overflow 2016年度 20个最佳Python问题](https://zhuanlan.zhihu.com/p/25020763)
```js
https://github.com/mingyun/Coding-Guide/blob/master/Notes/Python/Python%E5%8F%8A%E5%BA%94%E7%94%A8/Python3%E5%8F%8A%E5%BA%94%E7%94%A81-%E5%9F%BA%E7%A1%80.md Python3及应用
$ python -m timeit -s 'import random;a=range(10000);random.shuffle(a)' 'a.sort();a[-1]'
1000 loops, best of 3: 239 usec per loop
$ python -m timeit -s 'import random;a=range(10000);random.shuffle(a)' 'max(a)'        
1000 loops, best of 3: 342 usec per loop
 >>> 3*0.1
0.30000000000000004
>>> 4*0.1
0.4
>>> from decimal import Decimal
>>> Decimal(3*0.1)
Decimal('0.3000000000000000444089209850062616169452667236328125')
>>> Decimal(4*0.1)
Decimal('0.40000000000000002220446049250313080847263336181640625')
 >>> (0.1).hex()
'0x1.999999999999ap-4'
>>> (0.3).hex()
'0x1.3333333333333p-2'
>>> (0.1*3).hex()
'0x1.3333333333334p-2'
>>> (0.4).hex()
'0x1.999999999999ap-2'
>>> (0.1*4).hex()
'0x1.999999999999ap-2'

 
```
###[自己搭建 Shadowsocks](https://lufficc.com/blog/vpn)
sudo apt-get install python-pip
ssserver -c /path/to/shadowsocks.json
sudo apt-get install supervisor
/etc/supervisor/conf.d 文件夹新建文件 shadowsocks.conf :

[program:shadowsocks]
command = ssserver -c /var/shadowsocks/shadowsocks.json
user = root
autostart = true
autoresart = true
stderr_logfile = /var/shadowsocks/shadowsocks.stderr.log
stdout_logfile = /var/shadowsocks/shadowsocks.stdout.log
然后依次运行即可使 shadowsocks 运行在后台：

sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl start shadowsocks
###[Python干货：表达式 i += x 与 i = i + x 等价吗](http://mp.weixin.qq.com/s/jluii9YIvfhKd_tPecfTaw)
```js
>>> l1 = range(3)
>>> l2 = l1
>>> l2 += [3]
>>> l1
[0, 1, 2, 3]
>>> l2
[0, 1, 2, 3]
>>> l1 = range(3)
>>> l2 = l1
>>> l2 = l2 + [3]
>>> l1
[0, 1, 2]
>>> l2
[0, 1, 2, 3]
```
###[MySQL 如何存储长度较大的varchar与blob](https://github.com/zhangyachen/zhangyachen.github.io/issues/96)
CREATE TABLE `row` (
  `content` varchar(65532) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1

mysql> insert into row(content) select repeat('a',65532);
Query OK, 1 row affected (0.03 sec)
Records: 1  Duplicates: 0  Warnings: 0
###[in or效率](https://github.com/zhangyachen/zhangyachen.github.io/issues/60)
select * from table where id in (xxx,xxx,xxx...,xxx)
select * from table where id=xxx or id=xxx or id=xxx ... or id=xxx
在InnoDB引擎下，in返回的顺序是按照主键排序的，我以前一直以为是按照in列表里排序好的顺序进行排序的：
###[App接入支付宝](https://segmentfault.com/a/1190000008188574?utm_source=tuicool&utm_medium=referral)
```js
https://os.alipayobjects.com/download/secret_key_tools_RSA256_win.zip  下载支付宝提供的工具
https://openhome.alipay.com/doc/sdkDownload.resource?sdkType=PHP 下载php的sdk
<?php  
require_once './aop/AopClient.php';
require_once './aop/request/AlipayTradeAppPayRequest.php';
$c = new AopClient;
$c->gatewayUrl = "https://openapi.alipaydev.com/gateway.do";
$c->appId = "2016080100138126";
$c->rsaPrivateKey = '私钥';
$c->format = "json";
$c->charset= "utf-8";
$c->signType= "RSA2";
$c->alipayrsaPublicKey = '支付宝公钥';
$request = new AlipayTradeAppPayRequest ();
$request->setBizContent("{\"timeout_express\":\"30m\",\"product_code\":\"QUICK_MSECURITY_PAY\",\"total_amount\":\"0.01\",\"subject\":\"1\",\"body\":\"我是测试数据\",\"out_trade_no\":\"012114575097325\"}");
echo $c->sdkExecute($request);
?>
```
###[递归](https://segmentfault.com/a/1190000008304428)
//递归的方法
function test(n){
  if(n<2){
    return 1;
  }
  return test(n-1)+test(n-2)
}
alert(test(9))
//迭代的方法
function test(n){
  var num1 = 1;
  var num2 = 2;
  var num3 = 0;
  for(var i=0;i<n-2;i++){
    num3 = num1 + num2;
    num1 = num2;
    num2 = num3;
  }
}
alert(test(9))
###[图片相似度算法算出匹配度](https://segmentfault.com/q/1010000008322029)
```js

<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017-02-12
 * Time: 19:34
 */

require 'vendor/autoload.php';

use Intervention\Image\ImageManager;

// create an image manager instance with favored driver
$manager = new ImageManager(array('driver' => 'gd')); // imagick

// to finally create image instances
$img = $manager->canvas(800, 100, '#fff');

$img->text('蛙蛙脾气', 0, 0, function(\Intervention\Image\AbstractFont $font) {
    $font->file('src/fonts/msyhbd.ttc');
    $font->size(100);
    $font->color('#000');
    $font->valign('top');
});
$img->text('娃娃脾气', 0, 0, function(\Intervention\Image\AbstractFont $font) {
    $font->file('src/fonts/msyhbd.ttc');
    $font->size(100);
    $font->color('#ff0');
    $font->valign('top');
});

$img->save('bar.png');
```
###[单页整站导航点击滚动](https://segmentfault.com/q/1010000008328704)
```js
<div class='nav-left'>
    <div data-to='content1'><\div>
    <div data-to='content2'><\div>
<\div>
<div class='content1'>
<div class='content2'>
$('.nav-left').on('click','div',function(e){
            //console.log(e);
            var target = e.target;
            var div = $(target).data("to");
            //console.log(div);
            
            $('html,body').animate({scrollTop:$('.'+div).offset().top}, 800);
        });
```
###[hexo搭建个人博客如何设置自定义的页面为主页](https://segmentfault.com/q/1010000008326088)
首先，我用的hexo 3.2.2版本，要使用自定义页面为主页，就得确保node_modules里没有hexo-generator-index模块，如果有请删除掉；（这个是用来渲染主页的，要自定义就不需要对吧）
然后，如果细心你会发现themes/your_themes_name/source/这个目录里的文件，在你每次hexo g的时候都会全部复制，所以接下来就简单了，只需要把你的项目放到这个里面就OK了（自定义的index.html得在哈，也就是source目录做你项目的根目录）
做完上面两步就可以看到自己自定义的主页了
###[【ipv6惹的祸】curl 超时](http://www.54php.cn/default/185.html)
```js
Operation timed out after 0 milliseconds with 0 out of 0 bytes received
 
Resolving timed out after 5514 milliseconds
wget www.domain.com
--2016-11-19 22:17:30--  http://www.domain.com/
Resolving www.domain.com... # 此处停滞约 5 秒
xxx.xxx.xxx.xxx
Connecting to www.domain.com|xxx.xxx.xxx.xxx|:80... connected.
HTTP request sent, awaiting response... 200 OK
只需要加上下面一句即可解决延迟问题（指定使用IPV4）
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
```
###[权限修饰符的问题](https://segmentfault.com/q/1010000008329419)
```js
class count(){
    public $a = 0;
    public $b = 0;
    
    public function setNumber($a,$b){
        $this->a = $a;
        $this->b = $b;
        echo $this->compute();
    }
    
    private function compute(){
        return $this->a/$this->b;
    }
}
$obj = new count();
$obj->setNumber(1,2);
$obj = new count();
$obj->compute();
$obj->setNumber(1,2);
问题出现了。由于开始我们给变量a和b都设置了值为0，那么除数岂不是出现了0.更加容易出错
```
###[CSP -- 运营商内容劫持（广告）的终结者](http://www.54php.cn/default/182.html)
```js
setTimeout(function(){
    $.ajax({
        url:"/error/ad_log",
        type:'post',
        data:{
            'content': $("html").html(),
            'url':window.location.href
        },
        success:function(){
 
        }
    });
},3000);
<meta http-equiv="Content-Security-Policy" content="script-src 'self'">

Content-Security-Policy:
script-src 'unsafe-inline' 'unsafe-eval' 'self'  *.vincentguo.cn *.yunetidc.com *.baidu.com *.cnzz.com *.c-cnzz.com *.duoshuo.com *.jiathis.com;report-uri /error/csp
```
###[QQ，github，微博第三方社交登录](http://www.54php.cn/default/191.html)
```js
https://github.com/apanly/dream/tree/master/common/service/oauth
ClientService.php   统一第三方登录方法，应用程序的方法入口
GithubService.php  Github第三方登录相关方法
QqService.php      QQ第三方登录相关方法 
WeiboService.php   微博第三方登录相关方法
CREATE TABLE `user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户uid',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `unique_name` varchar(60) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `avatar` varchar(500) NOT NULL DEFAULT '' COMMENT '用户头像',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '用户手机号码',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `idx_name` (`unique_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表';
 
 
CREATE TABLE `oauth_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_type` varchar(20) NOT NULL DEFAULT '' COMMENT '客户端来源类型',
  `token` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  `valid_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '有效期截止日期',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `createdt_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `client_type_token` (`client_type`,`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='oauth token 表';
 
 
CREATE TABLE `oauth_bind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户uid',
  `client_type` varchar(20) NOT NULL DEFAULT '' COMMENT '客户端',
  `openid` varchar(80) NOT NULL DEFAULT '' COMMENT '第三方id',
  `extra` text NOT NULL COMMENT '额外字段',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `idx_client_type_opend_id` (`client_type`,`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方登录绑定关系';

```
###[Invalid default value for 'create_date' timestamp field](http://www.54php.cn/default/195.html)
SHOW VARIABLES LIKE 'sql_mode';
`created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间'
其实从5.6.17这个版本就默认设置了不允许插入 0 日期了，术语是 NO_ZERO_IN_DATE  NO_ZERO_DATE
sql-mode = "STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
