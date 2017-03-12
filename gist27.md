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
###[为Nginx目录设置访问密码](http://biezhi.me/2015/05/20/set-access-password-for-nginx-directory/)
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






