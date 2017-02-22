###[python编码](https://zhuanlan.zhihu.com/p/25272901)
```js
print sys.getdefaultencoding()    #系统默认编码 ascii
当需要将unicode格式的字符串存入到文件时，python内部会默认将其先转换为Str格式的系统编码，然后再执行存入步骤。而在这过程中，容易引发ascii异常。
#! -*- coding:utf-8 -*-
#python程序开头加上这句代码，指定python源代码编码格式为utf-8。
a=u"中文"
f=open("test.txt","w")
f.write(a)
报错异常信息：UnicodeEncodeError: ‘ascii’ codec can’t encode characters in position 0-1……
说明：因为ascii不支持中文，而变量a为unicode格式的中文字符串，因此无法进行编码而引发异常。
windows控制台为gbk编码，而变量a本身为utf-8编码。
变量a是str格式，编码为utf-8的字符串，我们要将之转化为str格式，GBK编码的字符串。
在python内部无法直接转化，需要借助decod()与encode()函数。decode()函数先将str格式的字符串a转化为unicode，再将unicode编码为str格式GBK。


#! -*- coding:utf-8 -*-
a='你好'
b=a.decode("utf-8").encode("gbk")
print b

python2.x从外部获取的内容都是string编码，其内部分为String编码与Unicode编码，而String编码又分为UTF-8，GBK，GB2312等等
。因此为了避免不同编码造成的报错，python内部最好都转化为unicode编码，在输出时再转化为str编码 。
可以用encode()/decode()函数，将string与unicode编码互换。
 在windows下，最好将文件内容转为unicode，可以使用codecs：

f=codecs.open("test.txt", encoding='gbk').read()

#! -*- coding:utf-8 -*-
a=u"中文"  #a为unicode格式编码
f=open("test.txt","w")
f.write(a.encode("gbk"))
python代码内部请全部使用unicode编码，在获取外部内容时，先decode为unicode，向外输出时再encode为Str

a="\\u8fdd\\u6cd5\\u8fdd\\u89c4" # unicode转化为中文
b=a.decode('unicode-escape')
print b
```
###[PyShell 木马后门](http://thief.one/2016/09/05/PyShell-%E6%9C%A8%E9%A9%AC%E5%90%8E%E9%97%A8/)

https://github.com/tengzhangchao/PyShell/
###[基于Python的WebServer](http://thief.one/2016/09/14/%E5%9F%BA%E4%BA%8EPython%E7%9A%84WebServer/)
```js
https://github.com/tengzhangchao/PyWebServer 
python PyWebServer.py -h
python PyWebServer.py -i 10.0.0.1 -p 8888   ##指定ip与端口,默认为8888
PyWebServer.exe -h  
PyWebServer.exe -p 8888      ##指定端口,默认为8888
[*Tag]  Http Server is runing on 172.16.11.179:8888
#!coding=utf-8
import sys
import socket
import argparse
import BaseHTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler


def run(ip,port):
	Handler = SimpleHTTPRequestHandler
	Server = BaseHTTPServer.HTTPServer
	Protocol = "HTTP/1.0"	
	server_address = (ip, port)
	Handler.protocol_version = Protocol
	try:
		httpd = Server(server_address, Handler)
		print "[*Tag]	Http Server is runing on %s:%s" % (ip,port)

	except:
		print "[*Tag]	%s PORT Employ or IP Address Error" % str(port)

	try:
		httpd.serve_forever()
	except:
		sys.exit()


def get_ip():
	try:
		myname=socket.getfqdn(socket.gethostname())
		myaddr=socket.gethostbyname(myname)
	except:
		print "[*Error]	Get IP address Faile"
	return myaddr


if __name__=="__main__":

	parser=argparse.ArgumentParser()
	parser.add_argument("-p","--port",help="Server Port ,Default:8888",default=8888,type=int)
	parser.add_argument("-i","--ip",help="Server IP Address",default="")
	args=parser.parse_args()

	port=args.port
	ip=args.ip
	
	if ip=="":
		ip=get_ip()          #自动获取本机ip地址

	run(ip,port)         #运行主函数
	php获取本机ip echo gethostbyname('');
	function get_local_ip() {  
    $preg = "/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";  
//获取操作系统为win2000/xp、win7的本机IP真实地址  
    exec("ipconfig", $out, $stats);  
    if (!empty($out)) {  
        foreach ($out AS $row) {  
            if (strstr($row, "IP") && strstr($row, ":") && !strstr($row, "IPv6")) {  
                $tmpIp = explode(":", $row);  
                if (preg_match($preg, trim($tmpIp[1]))) {  
                    return trim($tmpIp[1]);  
                }  
            }  
        }  
    }  
//获取操作系统为linux类型的本机IP真实地址  
    exec("ifconfig", $out, $stats);  
    if (!empty($out)) {  
        if (isset($out[1]) && strstr($out[1], 'addr:')) {  
            $tmpArray = explode(":", $out[1]);  
            $tmpIp = explode(" ", $tmpArray[1]);  
            if (preg_match($preg, trim($tmpIp[0]))) {  
                return trim($tmpIp[0]);  
            }  
        }  
    }  
    return '127.0.0.1';  
}  
```
###[PyCmd 加密隐形木马](http://thief.one/2016/09/18/PyCmd-%E5%8A%A0%E5%AF%86%E9%9A%90%E5%BD%A2%E6%9C%A8%E9%A9%AC/)

https://github.com/tengzhangchao/PyCmd
python PyCmd.py -u http://10.0.3.13/test/p.php -p test [--proxy]
python PyCmd.py -u http://192.168.10.149:8080/Test/1.jsp -p test [--proxy]
###[windows服务器信息收集工具](http://thief.one/2016/09/04/windows%E6%9C%8D%E5%8A%A1%E5%99%A8%E4%BF%A1%E6%81%AF%E6%94%B6%E9%9B%86%E5%B7%A5%E5%85%B7/)
https://github.com/tengzhangchao/InForMation 
information.exe -i start -L start -s start  运行所有功能
information.exe -i start  运行收集系统信息功能
###[算法分析](https://github.com/facert/python-data-structure-cn/tree/master/2.%E7%AE%97%E6%B3%95%E5%88%86%E6%9E%90/2.2.%E4%BB%80%E4%B9%88%E6%98%AF%E7%AE%97%E6%B3%95%E5%88%86%E6%9E%90)
```js
import time

def sumOfN2(n):
    start = time.time()

    theSum = 0
    for i in range(1,n+1):
        theSum = theSum + i

    end = time.time()

    return theSum, end-start
    
    def sumOfN3(n):
   return (n*(n+1))/2

print(sumOfN3(10))
```
###[根据ip获取地理位置](https://github.com/maxmind/GeoIP2-php)
```js
php composer.phar require geoip2/geoip2:~2.0

require_once 'vendor/autoload.php';
use GeoIp2\Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader('/usr/local/share/GeoIP/GeoIP2-City.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city('128.101.101.101');

print($record->country->isoCode . "\n"); // 'US'
print($record->country->name . "\n"); // 'United States'
print($record->country->names['zh-CN'] . "\n"); // '美国'

print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

print($record->city->name . "\n"); // 'Minneapolis'

print($record->postal->code . "\n"); // '55455'

print($record->location->latitude . "\n"); // 44.9733
print($record->location->longitude . "\n"); // -93.2323
```
###[简单轻量的HTTP 客户端工具库](https://github.com/toohamster/ws-http/)
```js
composer require toohamster/ws-http
$httpRequest = \Ws\Http\Request::create();
$headers = array('Accept' => 'application/json');
$query = array('foo' => 'hello', 'bar' => 'world');

$response = $httpRequest->post('http://mockbin.com/request', $headers, $query);

$response->code;        // 请求响应码(HTTP Status code)
$response->curl_info;   // curl信息(HTTP Curl info)
$response->headers;     // 响应头(Headers)
$response->body;        // 处理后的响应消息体(Parsed body), 默认为 false
$response->raw_body;    // 原始响应消息体(Unparsed body)

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://mockbin.com/request?foo=bar&foo=baz",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"foo\": \"bar\"}",
  CURLOPT_COOKIE => "foo=bar; bar=baz",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json",
    "x-pretty-print: 2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
import requests

url = "http://mockbin.com/request"

querystring = {"foo":["bar","baz"]}

payload = "{\"foo\": \"bar\"}"
headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/json",
    'x-pretty-print': "2"
    }

response = requests.request("POST", url, data=payload, headers=headers, params=querystring)

print(response.text)
curl --request POST \
  --url 'http://mockbin.com/request?foo=bar&foo=baz' \
  --header 'accept: application/json' \
  --header 'content-type: application/json' \
  --header 'x-pretty-print: 2' \
  --cookie 'foo=bar; bar=baz' \
  --data '{"foo": "bar"}'
```
###[python煎蛋妹子图下载](https://github.com/picasso250/jiandan)
https://www.zhihu.com/question/28485416 
###[Python获取Chrome浏览器已保存的所有账号密码](http://www.lijiejie.com/python-get-chrome-all-saved-passwords/)
```js
#https://github.com/lijiejie/chromePass
import os, sys
import shutil
import sqlite3
import win32crypt

outFile_path = os.path.join(os.path.dirname(sys.executable),
                            'ChromePass.txt') 
if os.path.exists(outFile_path):
    os.remove(outFile_path)


db_file_path = os.path.join(os.environ['LOCALAPPDATA'],
                            r'Google\Chrome\User Data\Default\Login Data')
tmp_file = os.path.join(os.path.dirname(sys.executable), 'tmp_tmp_tmp')
if os.path.exists(tmp_file):
    os.remove(tmp_file)
shutil.copyfile(db_file_path, tmp_file)    # In case file locked
conn = sqlite3.connect(tmp_file)
for row in conn.execute('select username_value, password_value, signon_realm from logins'):
    pwdHash = str(row[1])
    try:
        ret =  win32crypt.CryptUnprotectData(pwdHash, None, None, None, 0)
    except:
        print 'Fail to decrypt chrome passwords'
        sys.exit(-1)
    with open(outFile_path, 'a+') as outFile:
        outFile.write('UserName: {0:<20} Password: {1:<20} Site: {2} \n\n'.format(
            row[0].encode('gbk'), ret[1].encode('gbk'), row[2].encode('gbk')) )
conn.close()
print 'All Chrome passwords saved to:\n' +  outFile_path
os.remove(tmp_file)    # Remove temp file
```
###[程序员有哪些平时自己开发的小工具来简便工作](https://www.zhihu.com/question/28485416)
爬豆瓣找好书工具https://link.zhihu.com/?target=https%3A//github.com/lanbing510/DouBanSpider 
```js
#-*- coding: UTF-8 -*-

import sys
import time
import urllib
import urllib2
import requests
import numpy as np
from bs4 import BeautifulSoup
from openpyxl import Workbook

reload(sys)
sys.setdefaultencoding('utf8')



#Some User Agents
hds=[{'User-Agent':'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6'},\
{'User-Agent':'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.12 Safari/535.11'},\
{'User-Agent': 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)'}]


def book_spider(book_tag):
    page_num=0;
    book_list=[]
    try_times=0
    
    while(1):
        #url='http://www.douban.com/tag/%E5%B0%8F%E8%AF%B4/book?start=0' # For Test
        url='http://www.douban.com/tag/'+urllib.quote(book_tag)+'/book?start='+str(page_num*15)
        time.sleep(np.random.rand()*5)
        
        #Last Version
        try:
            req = urllib2.Request(url, headers=hds[page_num%len(hds)])
            source_code = urllib2.urlopen(req).read()
            plain_text=str(source_code)   
        except (urllib2.HTTPError, urllib2.URLError), e:
            print e
            continue
  
        ##Previous Version, IP is easy to be Forbidden
        #source_code = requests.get(url) 
        #plain_text = source_code.text  
        
        soup = BeautifulSoup(plain_text)
        list_soup = soup.find('div', {'class': 'mod book-list'})
        
        try_times+=1;
        if list_soup==None and try_times<200:
            continue
        elif list_soup==None or len(list_soup)<=1:
            break # Break when no informatoin got after 200 times requesting
        
        for book_info in list_soup.findAll('dd'):
            title = book_info.find('a', {'class':'title'}).string.strip()
            desc = book_info.find('div', {'class':'desc'}).string.strip()
            desc_list = desc.split('/')
            book_url = book_info.find('a', {'class':'title'}).get('href')
            
            try:
                author_info = '作者/译者： ' + '/'.join(desc_list[0:-3])
            except:
                author_info ='作者/译者： 暂无'
            try:
                pub_info = '出版信息： ' + '/'.join(desc_list[-3:])
            except:
                pub_info = '出版信息： 暂无'
            try:
                rating = book_info.find('span', {'class':'rating_nums'}).string.strip()
            except:
                rating='0.0'
            try:
                #people_num = book_info.findAll('span')[2].string.strip()
                people_num = get_people_num(book_url)
                people_num = people_num.strip('人评价')
            except:
                people_num ='0'
            
            book_list.append([title,rating,people_num,author_info,pub_info])
            try_times=0 #set 0 when got valid information
        page_num+=1
        print 'Downloading Information From Page %d' % page_num
    return book_list


def get_people_num(url):
    #url='http://book.douban.com/subject/6082808/?from=tag_all' # For Test
    try:
        req = urllib2.Request(url, headers=hds[np.random.randint(0,len(hds))])
        source_code = urllib2.urlopen(req).read()
        plain_text=str(source_code)   
    except (urllib2.HTTPError, urllib2.URLError), e:
        print e
    soup = BeautifulSoup(plain_text)
    people_num=soup.find('div',{'class':'rating_sum'}).findAll('span')[1].string.strip()
    return people_num


def do_spider(book_tag_lists):
    book_lists=[]
    for book_tag in book_tag_lists:
        book_list=book_spider(book_tag)
        book_list=sorted(book_list,key=lambda x:x[1],reverse=True)
        book_lists.append(book_list)
    return book_lists


def print_book_lists_excel(book_lists,book_tag_lists):
    wb=Workbook(optimized_write=True)
    ws=[]
    for i in range(len(book_tag_lists)):
        ws.append(wb.create_sheet(title=book_tag_lists[i].decode())) #utf8->unicode
    for i in range(len(book_tag_lists)): 
        ws[i].append(['序号','书名','评分','评价人数','作者','出版社'])
        count=1
        for bl in book_lists[i]:
            ws[i].append([count,bl[0],float(bl[1]),int(bl[2]),bl[3],bl[4]])
            count+=1
    save_path='book_list'
    for i in range(len(book_tag_lists)):
        save_path+=('-'+book_tag_lists[i].decode())
    save_path+='.xlsx'
    wb.save(save_path)




if __name__=='__main__':
    #book_tag_lists = ['心理','判断与决策','算法','数据结构','经济','历史']
    #book_tag_lists = ['传记','哲学','编程','创业','理财','社会学','佛教']
    #book_tag_lists = ['思想','科技','科学','web','股票','爱情','两性']
    #book_tag_lists = ['计算机','机器学习','linux','android','数据库','互联网']
    #book_tag_lists = ['数学']
    #book_tag_lists = ['摄影','设计','音乐','旅行','教育','成长','情感','育儿','健康','养生']
    #book_tag_lists = ['商业','理财','管理']  
    #book_tag_lists = ['名著']
    #book_tag_lists = ['科普','经典','生活','心灵','文学']
    #book_tag_lists = ['科幻','思维','金融']
    book_tag_lists = ['个人管理','时间管理','投资','文化','宗教']
    book_lists=do_spider(book_tag_lists)
    print_book_lists_excel(book_lists,book_tag_lists)
```
###[八阿哥bug管理工具｜简单、够用、免费](https://link.zhihu.com/?target=http%3A//www.bugclose.com)
###[链家爬虫](http://lanbing510.info/2016/03/15/Lianjia-Spider.html)
###[ProGit-读书简记](http://lanbing510.info/2016/12/07/ProGit.html)
###[知乎上赞同数最高的999个回答](http://lanbing510.info/2016/04/14/ZhiHu-Good-Answers.html)
###[使用Wget下载整个网站](http://lanbing510.info/2015/12/11/Wget.html)
```js
wget --recursive --no-clobber --page-requisites --html-extension --convert-links --restrict-file-names=windows --domains lampweb.org --no-parent www.lampweb.org/linux/
--recursive 递归下载整个站点

--no-clobber 不要覆盖已有文件(以防下载被中断而重新开始)

--domains lampweb.org 不要下载lampweb.org以外的链接地址

--no-parent 不要下载org/linux/目录之外的内容

--page-requisites 下载所有页面需要的元素(图像、CSS等等)

--html-extention 只下载html相关的文件

--convert-links 转换链接地址，从而本地离线可以正常访问

--restrict-file-names=windows 修改文件名以使文件也可以在windows下访问(某些情况文件名在Linux下合法而在windows下非法)。
```
###[按拍摄日期一键归类照片 Python](http://lanbing510.info/2015/09/21/ClassifyPictures.html)
```js
# -*- coding: gbk -*-  

""" 
功能：对照片按照拍摄时间进行归类 
使用方法：将脚本和照片放于同一目录，双击运行脚本即可 
作者：冰蓝 一键归类所有的照片，按照拍摄日期归类到年月相应的文件夹
"""  

import shutil  
import os  
import time  
import exifread  


class ReadFailException(Exception):  
    pass  

def getOriginalDate(filename):  
    try:  
        fd = open(filename, 'rb')  
    except:  
        raise ReadFailException, "unopen file[%s]\n" % filename  
    data = exifread.process_file( fd )  
    if data:  
        try:  
            t = data['EXIF DateTimeOriginal']  
            return str(t).replace(":",".")[:7]  
        except:  
            pass  
    state = os.stat(filename)  
    return time.strftime("%Y.%m", time.localtime(state[-2]))  


def classifyPictures(path):  
    for root,dirs,files in os.walk(path,True):  
        dirs[:] = []  
        for filename in files:  
            filename = os.path.join(root, filename)  
            f,e = os.path.splitext(filename)  
            if e.lower() not in ('.jpg','.png','.mp4'):  
                continue  
            info = "文件名: " + filename + " "  
            t=""  
            try:  
                t = getOriginalDate( filename )  
            except Exception,e:  
                print e  
                continue  
            info = info + "拍摄时间：" + t + " "  
            pwd = root +'\\'+ t  
            dst = pwd + '\\' + filename  
            if not os.path.exists(pwd ):  
                os.mkdir(pwd)  
            print info, dst  
            shutil.copy2( filename, dst )  
            os.remove( filename )  

if __name__ == "__main__":  
    path = "."  
    classifyPictures(path)  
```
###[Python使用过程中常见问题汇总](http://lanbing510.info/2014/11/14/Python-Problems.html)
数据库SQLite3使用时中文编码问题
Python连接数据时进行如下设置：

db=sqlite3.connection("...")
db.text_factory=str
改变Python输出流的编码方式f=codecs.open('out.html','w','utf-8')
import codecs, sys
old=sys.stdout
sys.stdout = codecs.lookup('iso8859-1')[-1]( sys.stdout)
###[正则表达式及在Python中的使用](http://lanbing510.info/2014/09/20/Regular-Expression.html)
```js
管道符号（|）表示的或操作  匹配任意一个单个字符串（.）
从字符串开头或结尾或单词边界开始匹配（^, $, \b, \B）

使用方括号（[]）的表达式，会匹配方括号内的任何一个字符b[aeiu]t  #可匹配bat, bet, bit, but
指定范围（-）和否定（^）
z.[r-u]  #匹配z符号后面跟任意一个字符，然后再跟一个r, s, t, u中的任意一个字符的字符串
[^aeiou]  #匹配一个非元音字符
使用闭包操作符（*, +, ?, {}）实现多次出现/重复匹配

星号（*）表示匹配它左边的正则表达模式零次或以上

加号（+）表示匹配它左边的正则表达模式一次或以上

问号（?）表示匹配他左边的正则表达模式零次或一次

花边符号（{}），里面可以是单个数，也可以是一对值，如{N}表示匹配N次，{M,N}表示匹配M次到N次。

a*b+c?[0-9]{11,15}  #匹配开始为零个或以上，后面跟一个以上的b和最多一个c和11到15个数字的字符串
\d+(\.\d*)?  #匹配简单浮点数，同时，如果有小数点后，会将其存入子组。
>>> m=re.match('(\w\w\w)-(\d\d\d)','abc-123')
>>> m.group()
'abc-123'
>>> m.group(1)
'abc'
>>> m.groups()
('abc','123')
>>> re.findall('car','carry the barcardi to the car')
['car','car','car']
>>> re.sub('[ae]','X','abcdef')
'XbcdXf'
我们想截获末尾数字的字段

>>> patt = '.+(\d+-\d+-\d+)'
>>> re.match(patt,'Thu Feb 15 uzifzf@dpyivihw.gov::1171590364-6-8').group(1) #str是上述字符串
'4-6-8'
正则表达式本事模式的是贪心匹配，也就是从左到右尽量抓取最长的字符串 可以使用“非贪婪”操作符“?”来解决问题。

>>> patt='.+?(\d+-\d+-\d+)'
>>> re.match(patt,str).group(1)
1171590364-6-8
>>> s='abcde'
>>> for i in [None]+range(-1,-len(s),-1): #使用None作为索引值来实现s[:-1]打印出abcde
...     print s[:i]
... 
abcde
abcd
abc
ab
a
```
###[备份sf文章](https://github.com/quietin/seg_backup_script/blob/master/backup_with_phantomjs.py)
```js
# coding: utf8
import requests
import time
import sys
import os
import getopt
from selenium import webdriver
from selenium.common.exceptions import (
    WebDriverException, NoSuchElementException, TimeoutException)
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support.expected_conditions import staleness_of
from pyquery import PyQuery as pq
from tornado import gen
from tornado.queues import Queue
from tornado.ioloop import IOLoop
from tornado.process import cpu_count

_domain = 'segmentfault.com'
target_url = 'http://%s' % _domain
login_page_path = '/user/login'
blog_path = '/blog/quietin'
edit_suffix = '/edit'


class PageHtmlChanged(Exception):
    pass


class BlogSavePathError(Exception):
    pass


class PhantomjsPathError(Exception):
    pass


def has_page_load(driver):
    return driver.execute_script("return document.readyState") == 'complete'


class BlogBackup(object):
    _default_dir_name = 'seg_blog_backup'

    def _generate_save_dir(self):
        cur_dir = os.path.dirname(__file__)
        self.save_path = os.path.join(cur_dir, self._default_dir_name)
        if not os.path.isdir(self.save_path):
            os.mkdir(self.save_path)

    def _parse_save_path(self):
        if self.save_path:
            if os.path.exists(self.save_path) and \
                    os.path.isdir(self.save_path):
                return
            else:
                raise BlogSavePathError(
                    "'%s' not exists or is not dir!" % self.save_path)
        else:
            self._generate_save_dir()

    def _get_user_cookies(self):
        url = target_url + login_page_path
        self.driver.get(url)
        try:
            user_input = self.driver.find_element_by_name('mail')
            passwd_input = self.driver.find_element_by_name('password')
            submit_btn = self.driver.find_element_by_class_name('pr20')
        except NoSuchElementException:
            raise PageHtmlChanged(
                "%s login page structure have changed!" % _domain)

        user_input.send_keys(self.username)
        passwd_input.send_keys(self.passwd)
        submit_btn.click()
        try:
            WebDriverWait(self.driver, 3).until(staleness_of(submit_btn))
        except TimeoutException:
            raise Exception("Wrong username or password!")

        WebDriverWait(self.driver, timeout=10).until(has_page_load)
        try_times = 0
        while True:
            time.sleep(1)
            if url != self.driver.current_url:
                return self.driver.get_cookies()

            try_times += 1
            if try_times > 10:
                raise Exception("Getting cookie info failed!")

    def _get_driver(self):
        if self.phantomjs_path:
            try:
                return webdriver.PhantomJS(
                    executable_path=self.phantomjs_path,
                    service_log_path=os.path.devnull)
            except WebDriverException:
                raise PhantomjsPathError("Phantomjs locate path invalid!")
        else:
            return webdriver.PhantomJS(service_log_path=os.path.devnull)

    def __init__(self, **conf):
        self.username = conf['username']
        self.passwd = conf['passwd']
        self.phantomjs_path = conf.get('phantomjs_path')
        self.save_path = conf.get('save_path')
        self._q = Queue()

        self._parse_save_path()
        self.driver = self._get_driver()
        self._cookies = self._get_user_cookies()

    @gen.coroutine
    def run(self):
        self.__filter_cookies()

        start_url = target_url + blog_path
        yield self._fetch_blog_list_page(start_url)
        for _ in xrange(cpu_count()):
            self._fetch_essay_content()

        yield self._q.join()
    #解析获取的cookie
    def __filter_cookies(self):
        self._cookies = {k['name']: k['value'] for k in self._cookies if
                         k['domain'] == _domain}

    @gen.coroutine
    def _fetch_blog_list_page(self, page_link):
        ret = requests.get(page_link, cookies=self._cookies)
        d = pq(ret.text)
        link_elements = d('.stream-list__item > .summary > h2 > a')
        for link in link_elements:
            yield self._q.put(d(link).attr('href'))

        next_ele = d('.pagination li.next a')
        if next_ele:
            next_page_url = target_url + next_ele.attr('href')
            self._fetch_blog_list_page(next_page_url)

    @gen.coroutine
    def _fetch_essay_content(self):
        while True:
            try:
                essay_path = yield self._q.get(timeout=1)
                essay_url = target_url + essay_path + edit_suffix
                ret = requests.get(essay_url, cookies=self._cookies)
                d = pq(ret.text)
                title = d("#myTitle").val()
                content = d("#myEditor").text()
                file_name = title + '.md'
                real_file_name = os.path.join(self.save_path, file_name)
                with open(real_file_name, 'w') as f:
                    f.writelines(content.encode('utf8'))
            except gen.TimeoutError:
                raise gen.Return()
            finally:
                self._q.task_done()


@gen.coroutine
def main():
    config = {}
    opts, args = getopt.getopt(
        sys.argv[1:],
        'hs:u:p:',
        ['phantomjs_path=', 'save_path=', 'username=', 'passwd='])

    for opt, value in opts:
        if opt in ['-u', '--username']:
            config['username'] = value
        elif opt in ['-p', '--passwd']:
            config['passwd'] = value
        elif opt == '--phantomjs_path':
            config['phantomjs_path'] = value
        elif opt in ['-s', '--save_path']:
            config['save_path'] = value
        elif opt in ['-h', '--help']:
            usage()
            sys.exit()

    ins = BlogBackup(**config)
    yield ins.run()
    print 'finished!'


def usage():
    print '''
用法：python blogbackup.py -u [USERNAME] -p [PASSWORD] --phantomjs_path \
[phantomjs locate path]
-h --help 帮助
-u --username [USERNAME] 用户名
-p --passwd [PASSWORD] 密码
-s --save_path [save path] 博文保存的文件夹路径, 默认为本文件所在路径下的\
seg_blog_backup文件夹
--phantomjs_path  [phantomjs locate path] phantomjs所在路径, 如果其在PATH下可以\
找到则不必填
    '''


if __name__ == '__main__':
    IOLoop.current().run_sync(main)
  
  获取网页源码 driver.execute_script("return document.documentElement.innerHTML")
  WebDriverWait(self.driver, timeout=10).until(has_page_load) 直到网页加载完成
 
 
>>> vhall='http://xxxx.com/auth/login'
>>> s=requests.Session()
>>> s.post(vhall,{"account":"admin","password":"111111","_token":"mbjAjsn7XLl
yOgsy0XLDRzAqQHdFgntfJKvH4yNJ"})
<Response [200]>
>>> s.cookies
<<class 'requests.cookies.RequestsCookieJar'>[Cookie(version=0, name='laravel_se
ssion', value='eyJpdiI6IlJJdlZYR0h2dmR0TEN3XC9yNUVIYSt3PT0iLCJ2YWx1ZSI6IkxkU2FCV
Et0UlFqV3o2ODZxSlh0UnlsV1wvY2Y1bTZwVGFwYVRNUnlWRkhXUDhNUzVEWm94a0V6eTR0RkFxcyt5T
lFweTMzamtaVUdmYVB4ZlhiRG9MQT09IiwibWFjIjoiNGZlNGJiZWE2YmE4OTM5YWE0MmFiZGMyZjExY
TI5NTU0ZGEzZjMzOTAxZDU1OWFhM2JkODFlOTA1MTA0NWRjYiJ9', port=None, port_specified=
False, domain='t.e.vhall.com', domain_specified=False, domain_initial_dot=False,
 path='/', path_specified=True, secure=False, expires=None, discard=True, commen
t=None, comment_url=None, rest={'HttpOnly': None}, rfc2109=False)]>
>>> s.post('http://xxx.com/json').json()
>>> requests.post('http://xxx.com/json',cookies=s.cookies
).json()
>>> res=requests.get(vhall).content
>>> re.findall(r'_token',res)
['_token', '_token']
>>> re.findall(r'_token" value="(.*)"',res)
['NcqhZ8oSRxHqj1TGRtZVYdOKLrtddwKOk3pRmD3S', 'NcqhZ8oSRxHqj1TGRtZVYdOKLrtddwKOk3
pRmD3S']
```
###[php漏洞FineCMS后台getshell ](http://0day5.com/archives/4150)
https://www.secpulse.com/archives/category/vul 
###[浅谈PHP安全开发](https://www.secpulse.com/archives/51987.html)

预处理过程中，程序会将SQL执行分为两次发送给MySQL，第一次发送预声明SQL语句,形如select *from users where username = ?第二次发送执行绑定的参数值
由于是将SQL语句和值分开发送的，再由MySQL内部执行，这样就不会出现执行非预期的SQL语句情况。预处理可以说是最简单有效的防止SQL注入的方式。

不过使用预处理方式也是有条件的，PDO中有一个属性PDO::ATTR_EMULATE_PREPARES，默认是true，它将强制PDO总是模拟预处理语句。
可以看到并没有使用MySQL预处理的方式，而是进行的转义。所以使用预处理方式需要将PDO::ATTR_EMULATE_PREPARES设置为false。
![img](http://www.secpulse.com/wp-content/uploads/2016/09/phpsec8.jpg)
###[用python DIY一个图片转pdf工具并打包成exe ](http://www.cnblogs.com/MrLJC/p/4261339.html)
###[laravel核心理解 ServiceProvider(服务提供者) Container(容器) Facades(门面)](http://elickzhao.github.io/2017/01/laravel%E6%A0%B8%E5%BF%83%E7%90%86%E8%A7%A3%20ServiceProvider(%E6%9C%8D%E5%8A%A1%E6%8F%90%E4%BE%9B%E8%80%85)%20Container(%E5%AE%B9%E5%99%A8)%20Facades(%E9%97%A8%E9%9D%A2)/)
```js
服务提供者: 是绑定服务到容器的工具.

容器: 是laravel装载服务提供者提供的服务实例的集合或对象

门面: 使用这些服务的快捷方式.也就是静态方法.
在一个服务提供者中，可以通过 $this->app 变量访问容器，然后使用 bind 方法注册一个绑定，该方法需要两个参数，第一个参数是我们想要注册的类名或接口名称，第二个参数是返回类的实例的闭包
namespace App\Providers;
use Riak\Connection;
use Illuminate\Support\ServiceProvider;
class RiakServiceProvider extends ServiceProvider
{
    /**
     * 在容器中注册绑定。
     *
     * @return void
     */
    public function register()
    {   //这是5.3写法
        $this->app->singleton(Connection::class, function ($app) {
            return new Connection(config('riak'));
        });
        //5.2以前这么写 $this->app->singleton('Riak\Contracts\Connection', function ($app){...}
        // Connection::class 返回的就是命名空间字符串(可以看另一个我的文章),所以跟5.2是一样的.  
        //这里千万注意'Riak\Contracts\Connection'是个字符串,相当于在容器中定义了一个名字并把实例赋值给了这个名字.
        //并没有其他更高深的含义
        //所以只要在 config/app 下的provider数组里 注册一下就可以使用了
    }
}
服务容器的一个非常强大的特性是其绑定接口到实现的能力。我们假设有一个 EventPusher 接口及其 RedisEventPusher 实现，编写完该接口的 RedisEventPusher 实现后，就可以将其注册到服务容器：
当想要换掉EventPusher,很方便你不需要改别的地方的代码只要在provider把绑定类换掉就可以了,换成另一个实现了 EventPusher 类就ok了. 当然还有更强大一个接口绑定多个实现,然后根据条件选择使用的类
use App\Contracts\EventPusher;
/**
 * 创建一个新的类实例
 *
 * @param  EventPusher  $pusher
 * @return void
 */
public function __construct(EventPusher $pusher){
    $this->pusher = $pusher;
}
绑定到容器后,就是注册到Provider,让 laravel 可以自动加载

这次很简单 就是添加到 config/app.php 下的 Provider数组里
use App\Contracts\EventPusher;
/**
 * 创建一个新的类实例
 *
 * @param  EventPusher  $pusher
 * @return void
 */
public function __construct(EventPusher $pusher){
    $this->pusher = $pusher;
}
public function test(){
    //当然还可以手动调用 
    $fooBar = $this->app->make('FooBar');
    //其次，你可以以数组方式访问容器，因为其实现了 PHP 的 ArrayAccess 接口：
    $fooBar = $this->app['FooBar'];
}

```
###[vue.js 中国好教程](http://elickzhao.github.io/2016/10/vue.js%20%E4%B8%AD%E5%9B%BD%E5%A5%BD%E6%95%99%E7%A8%8B/)
###[laravel插件记录](http://elickzhao.github.io/2016/06/laravel%E6%8F%92%E4%BB%B6%E8%AE%B0%E5%BD%95/)
###[SQLSTATE[HY000] [2002] No such file or directory 报错处理](http://elickzhao.github.io/2016/11/SQLSTATE[HY000]%20[2002]%20No%20such%20file%20or%20directory%20%E6%8A%A5%E9%94%99%E5%A4%84%E7%90%86/)
打开 php.ini 添加 /var/lib/mysql/mysqld.sock 默认为空
// mysql.default_socket =  // php7里已经没有了这个
pdo_mysql.default_socket=/var/lib/mysql/mysqld.sock // 默认是空的,这个就是新添加的地址
mysqli.default_socket =/var/lib/mysql/mysqld.sock
php7 以后就不实用mysql这个驱动了 而使用mysqlnd 所以你在phpinfo()里不会再看到mysql项
重启php-fpm 需要用 ps aux|grep php 命令查看 php-fpm 的 pid,然后 kill pid.这里注意啊 要是多个php-fpm一定要看配置文件位置,不要删错了.
###[]()
