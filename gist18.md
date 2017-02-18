###[PHP 输出 json乱码](https://www.v2ex.com/t/340206#reply28)
echo 之前加 ob_clear(); 

代码有顶格,无 bom, 是 utf-8.
后面是 C3 AF C2 BB 么？仍然是 BOM 头，只是转换过。而如果是 EF BB BF 则是没有转换过的。 
一个典型的 PHP 程序文件应该以“<?php 开头”。这个标签开始之前不应该有任何东西，包括不可见字符。 

当然还有一种可能性，就是你手头上的程序主动输出了那些内容。如果是这样， Debug 会变得很复杂：你需要去掉所有的 Output Buffer 控制（就是让内容直接输出），然后用 headers_list 以及 headers_sent 函数检查到底是谁发送了“ï”字符。
###[代码表白](https://www.zhihu.com/question/55736593)
```js
算法题目 http://hmbb.hustoj.com/  
>>> print('\x42\x65\x20\x77\x69\x74\x68\x20\x6d\x65')
Be with me
>>> print(''.join(['\\'+hex(ord(i))[1:] for i in 'be with me']))
\x62\x65\x20\x77\x69\x74\x68\x20\x6d\x65
```
###[一个循环语句输出九九乘法表](https://www.zhihu.com/question/55768263)
```js
n = 9

for i in range(n * n):
    x = i % n + 1
    y = i // n + 1

    a = lambda: print(str(x) + '*' + str(y) + '=' + str(x * y), end=chr(10 + 22 * int(x != y)))
    b = lambda: 1
    [a, b][int(x > y)]()

import math
R = map(lambda x: (int( (math.sqrt( 8 * x + 1 ) + 1) / 2), x),range(0,45))
RC = map(lambda x: (x[0], x[1] + 1 - (x[0] - 1) * x[0] / 2), R)
T = map(lambda x: ("%d*%d=%d"%(x[1],x[0],x[0]*x[1]) + ("\n" if(x[0]==x[1]) else " ")), RC)
print "".join(T)

print '\n'.join([' '.join([str(i * j) for i in xrange(1,j+1)]) for j in xrange(1,10)])
print ' '.join([x % 10 and ((x / 10 < x % 10) and ' ' or (chr((x / 10) + ord('0')) + "x" + chr((x % 10) + ord('0')))) or '\n' for x in range(1, 101 , 1)])
print str.join('',[str((i-i%9)/9+1)+'*'+str(i%9+1)+'='+str((i%9+1)*((i-i%9)/9+1))+' \n'[i%9] for i in xrange(80)])
console.log([...Array(9)].reduce((m, _, x) => m + [...Array(x + 1)].reduce((m, _, y) => m + `${y + 1}*${x + 1}=${(x + 1) * (y + 1)} `, "") + "\n", ""))




console.log([...Array(45)].reduce(([x, y, s]) => [[x + 1, y, s + `${x}*${y}=${x*y} `], [1, y + 1, s + `${x}*${y}=${x*y}\n`]][1 + Math.sign(x - y)], [1, 1, ""])[2])

// 同上，加了换行，好读点
console.log(
    [...Array(45)].reduce(
        ([x, y, s]) => [
            [x + 1, y, s + `${x}*${y}=${x*y} `],
            [1, y + 1, s + `${x}*${y}=${x*y}\n`]
        ][1 + Math.sign(x - y)],
        [1, 1, ""])
    [2]
)

// 或者这样
console.log(
    [...Array(45)].reduce(
        ([x, y, s]) => ({
            "true":  [x + 1, y, s + `${x}*${y}=${x*y} `],
            "false": [1, y + 1, s + `${x}*${y}=${x*y}\n`]
        })[String(x < y)],
        [1, 1, ""])
    [2]
)
```
###[nginx跨域的设置](https://www.v2ex.com/t/340648#reply7)
if ($http_origin ~* ( https?://.*\.example\.com(:[0-9]+)?$)) { 
add_header Access-Control-Allow-Origin: $http_origin; 
}
###[mysql select count(*)](https://www.v2ex.com/t/339758#reply15)
select （*）在 myiaam 中是常数级的， innodb 却不是的 http://dba.stackexchange.com/questions/17926/why-doesnt-innodb-store-the-row-count
###[解决Python2.x编码之殇](https://zhuanlan.zhihu.com/p/25272901)
```js
print sys.getdefaultencoding()    #系统默认编码
print sys.getfilesystemencoding() #文件系统编码
print locale.getdefaultlocale()   #系统当前编码
print sys.stdin.encoding          #终端输入编码
print sys.stdout.encoding         #终端输出编码
 将unicode格式的字符串存入到文件时，python内部会默认将其先转换为Str格式的系统编码，然后再执行存入步骤
 #! -*- coding:utf-8 -*-
a=u"中文"
f=open("test.txt","w")
f.write(a)
import sys
reload(sys)
sys.setdefaultencoding('gbk')

#! -*- coding:utf-8 -*-
a='你好'
b=a.decode("utf-8").encode("gbk")
print b
f=codecs.open("test.txt", encoding='gbk').read()
a="\\u8fdd\\u6cd5\\u8fdd\\u89c4" # unicode转化为中文
b=a.decode('unicode-escape')
print b
```
###[PHP 就碰到 PDO 扩展的一个大坑](https://www.v2ex.com/t/339840#reply74)
PDO 的参数绑定 bindParam 方法第二个参数是传递一个引用类型，而不是值
###[查看 js 中一个变量值是怎样一步一步生成](https://www.v2ex.com/t/338996#reply5)
```js
如果你知道变量名，可以通过 Object.defineProperty(obj,变量名，{set: function(){console.trace();}} );可以追踪到何时被赋值，何时被修改
o._value = o.value 

Object.defineProperty(o, 'value', { 
get: function() { 
console.trace(); 
return o._value; 
}, 
set : function(val) { 
console.trace(); 
o._value = val; 
} 
});
```
###[Ostagram：一款强大的图片艺术滤镜工具](https://link.zhihu.com/?target=http%3A//ostagram.ru/)
###[利用TensorFlow搞定知乎验证码之《让你找中文倒转汉字》](https://zhuanlan.zhihu.com/p/25297378)
```js
python生成汉字的代码

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

http://link.zhihu.com/?target=https%3A//github.com/burness/tensorflow-101/tree/master/zhihu_code/src
```
###[通过微博 API 和 Pushbullet 准实时关注你的心上人](https://zhuanlan.zhihu.com/p/25297732)
https://link.zhihu.com/?target=https%3A//www.pushbullet.com/
https://link.zhihu.com/?target=https%3A//gist.github.com/xlzd/01b8b8e1909ae0f601c85e142f2bd15b
###[把 Markdown 文件转化为 PDF](https://www.zhihu.com/question/20849824)
如果你的md文件使用chrome预览，就比较简单了。
点打印，目标，选本地另存为pdf，即可
pandoc README -o example13.pdf  https://link.zhihu.com/?target=http%3A//www.reportlab.com/  http://pandoc.org/installing.html 
$pandoc -N -s --toc --smart --latex-engine=xelatex -V CJKmainfont='PingFang SC' -V mainfont='Monaco' -V geometry:margin=1in 1.md 2.md 3.md ... xx.md  -o output.pdf

Atom有一个Markdown Preview的插件，Markdown文件下按ctrl+shit+m就可以预览Markdown，然后右键生成的预览文件可以保存为html文件，再用chrome打开这个html文件，右键Print里面转换成pdf。  http://www.markdowntopdf.com/ 
 https://github.com/fraserxu/electron-pdf   $ electron-pdf index.html ~/Desktop/index.pdf
选择reportlab以及基于reportlab的chrisglass/xhtml2pdf https://github.com/xhtml2pdf/xhtml2pdf ，这样你就可以简单的pandoc转为html，再由html轻松地转为pdf啦
xhtml2pdf不能识别汉字，需要在html文件中通过CSS的方式嵌入code2000字体，代码是这样的：html { 
font-family: code2000; 
}
###[Python练习第四题，批量修改图片分辨率](https://zhuanlan.zhihu.com/p/25232848)
```js
http://pillow-cn.readthedocs.io/zh_CN/latest/index.html  
>>> from PIL import Image
>>> im=Image.open(r'F:\1.jpg')
>>> print(im.format,im.size,im.mode)
import os
import glob
from PIL import Image

def thumbnail_pic(path):
    a = glob.glob(r'*.jpg')
    for x in a:
        name = os.path.join(path, x)
        im = Image.open(name)
        im.thumbnail((1136, 640))
        print(im.format, im.size, im.mode)
        im.save(name, 'JPEG')
    print('Done!')

if __name__ == '__main__':
    path = '.'
    thumbnail_pic(path)
作者：崔斯特
链接：https://zhuanlan.zhihu.com/p/25232848
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

from PIL import Image

def change_resolution(picPath, reslution):
    img = Image.open(picPath)
    x, y = img.size
    print x, y
    changex = float(x) / reslution[0]
    changey = float(y) / reslution[1]

    # 判断分辨率是否满足
    if changex > 1 or changey > 1:
        change = changex if changex > changey else changey
        print change
        print int(reslution[0] / change), int(reslution[1] / change)
        img.resize((int(x / change), int(y / change))).save('result.jpg')

if __name__ == '__main__':
    change_resolution('pictest.jpg', (1136, 640))
```
###[Python爬取百度图片及py文件转换exe](https://zhuanlan.zhihu.com/p/24854051?refer=linjichu)
```js
作者：崔斯特
链接：https://zhuanlan.zhihu.com/p/24854051
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

#coding:utf-8
import requests
import os
import re
import json
import itertools
import urllib
import sys

str_table = {
    '_z2C$q': ':',
    '_z&e3B': '.',
    'AzdH3F': '/'
}

char_table = {
    'w': 'a',
    'k': 'b',
    'v': 'c',
    '1': 'd',
    'j': 'e',
    'u': 'f',
    '2': 'g',
    'i': 'h',
    't': 'i',
    '3': 'j',
    'h': 'k',
    's': 'l',
    '4': 'm',
    'g': 'n',
    '5': 'o',
    'r': 'p',
    'q': 'q',
    '6': 'r',
    'f': 's',
    'p': 't',
    '7': 'u',
    'e': 'v',
    'o': 'w',
    '8': '1',
    'd': '2',
    'n': '3',
    '9': '4',
    'c': '5',
    'm': '6',
    '0': '7',
    'b': '8',
    'l': '9',
    'a': '0'
}
char_table = {ord(key): ord(value) for key, value in char_table.items()}

def decode(url):
	for key,value in str_table.items():
		url = url.replace(key,value)
	return url.translate(char_table)

def buildUrls(word):
    word = urllib.parse.quote(word)
    url = r"http://image.baidu.com/search/acjson?tn=resultjson_com&ipn=rj&ct=201326592&fp=result&queryWord={word}&cl=2&lm=-1&ie=utf-8&oe=utf-8&st=-1&ic=0&word={word}&face=0&istype=2nc=1&pn={pn}&rn=60"
    urls = (url.format(word=word, pn=x) for x in itertools.count(start=0, step=60))
    return urls

re_url = re.compile(r'"objURL":"(.*?)"')
def resolveImgUrl(html):
	imgUrls = [decode(x) for x in re_url.findall(html)]
	return imgUrls

def downImg(imgUrl,dirpath,imgName):
	filename = os.path.join(dirpath,imgName)
	try:
		res = requests.get(imgUrl,timeout=15)
		if str(res.status_code)[0] == '4':
			print(str(res.status_code),":",imgUrl)
			return False
	except Exception as e:
		print('抛出异常:',imgUrl)
		print(e)
		return False
	with open(filename+'.jpg','wb') as f:
		f.write(res.content)
	return True
def mkDir(dirName):
    dirpath = os.path.join(sys.path[0], dirName)
    if not os.path.exists(dirpath):
        os.mkdir(dirpath)
    return dirpath

if __name__ == '__main__':
    print("欢迎使用百度图片下载脚本！\n目前仅支持单个关键词。")
    print("下载结果保存在脚本目录下的img文件夹中。")
    print("=" * 50)
    word = input("请输入你要下载的图片关键词：\n")

    dirpath = mkDir("img")

    urls = buildUrls(word)
    index = 0
    for url in urls:
        print("正在请求：", url)
        html = requests.get(url, timeout=10).content.decode('utf-8')
        imgUrls = resolveImgUrl(html)
        if len(imgUrls) == 0:  # 没有图片则结束
            break
        for url in imgUrls:
            if downImg(url, dirpath, str(index) + ".jpg"):
                index += 1
                print("已下载 %s 张" % index)
                
pip install pyinstaller
pyinstaller -F baiduimg.py
目录下，dist文件下就有baiduimg.exe文件了，双击即可
```
###[生成激活码](https://zhuanlan.zhihu.com/p/25169905?refer=linjichu)
```js

import uuid

uuids = []
for i in range(200):
	uuids.append(uuid.uuid1())
print uuids
```
###[在图片上加入数字](https://zhuanlan.zhihu.com/p/25147821?refer=linjichu)
```js

from PIL import Image, ImageDraw, ImageFont

img = Image.open('girl.jpg')
draw = ImageDraw.Draw(img)
myfont = ImageFont.truetype('C:/windows/fonts/Arial.ttf', size=80)
fillcolor = "#ff0000"
width, height = img.size
draw.text((40,40),'hello', font=myfont, fill=fillcolor)
img.save('result.jpg','jpeg')

 https://github.com/zhangslob/Image  python3下用方正字迹 ，能显示出中文
 
 photo_url = "http://p3.pstatp.com/large/159f00010b30d6736512"
photo_name = photo_url.rsplit('/', 1)[-1] + '.jpg'

with request.urlopen(photo_url) as res, open(photo_name, 'wb') as f:
    f.write(res.read())

 
```
###[python爬虫学习资源整理](https://zhuanlan.zhihu.com/p/25250739)
###[php ecshop修饰符preg_replace/e不安全的几处改动](http://www.epooll.com/archives/841/)
```js
主要集中在 upload/includes/cls_template.php 文件中：

1：line 300 ：

原语句：

return preg_replace("/{([^\}\{\n]*)}/e", "\$this->select('\\1');", $source);

修改为：

return preg_replace_callback("/{([^\}\{\n]*)}/", function($r) { return $this->select($r[1]); }, $source);

2：line 495：

原语句：

$out = "<?php \n" . '$k = ' . preg_replace("/(\'\\$[^,]+)/e" , "stripslashes(trim('\\1','\''));", var_export($t, true)) . ";\n";

修改为：

$replacement = preg_replace_callback("/(\'\\$[^,]+)/" ,

function($matcher){

return stripslashes(trim($matcher[1],'\''));

},

var_export($t, true));

$out = "<?php \n" . '$k = ' . $replacement . ";\n";

3：line 554： //zuimoban.com 转载不带网址，木JJ

原语句：

$val = preg_replace("/\[([^\[\]]*)\]/eis", "'.'.str_replace('$','\$','\\1')", $val);

修改为：

$val = preg_replace_callback("/\[([^\[\]]*)\]/is",

function ($matcher) {

return '.'.str_replace('$','\$',$matcher[1]);

},

$val);

4：line 1071：

原语句：

$replacement = "'{include file='.strtolower('\\1'). '}'";

$source = preg_replace($pattern, $replacement, $source);

修改为：

$source = preg_replace_callback($pattern,

function ($matcher) {

return '{include file=' . strtolower($matcher[1]). '}';

},

$source);
```
###[用PHP蜘蛛做旅游数据分析 ](http://www.epooll.com/archives/843/)
https://github.com/owner888/phpspider  马蜂窝
###[PHP DOMDocument保存xml时中文出现乱码](http://www.epooll.com/archives/842/)
```js
$doc = new DOMDocument();
$doc->loadHTML('<?xml encoding="UTF-8">' . $html);
foreach ($doc->childNodes as $item)
{
    if ($item->nodeType == XML_PI_NODE)
    {
        $doc->removeChild($item); // remove hack
    }
}
$doc->encoding = 'UTF-8'; // insert proper
echo iconv("UTF-8", "GB18030//TRANSLIT", $dom->saveXML($n) );
```
###[Android 窃取手机中微信聊天记录](http://icodeyou.com/2015/06/05/2015-06-05-%20%E8%8E%B7%E5%8F%96%E5%BE%AE%E4%BF%A1%E8%81%8A%E5%A4%A9%E8%AE%B0%E5%BD%95/)
###[手把手教你搭建ngrok服务－轻松外网调试本机站点](https://aotu.io/notes/2016/02/19/ngrok/?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
###[CSRF实战：借刀杀人之全民助我投诉吧主](https://zhuanlan.zhihu.com/p/24411110?refer=codes)
###[laravel 翻译](https://github.com/cw1997/laravel-Simplified-Chinese)
###[QQ好友列表数据获取](https://zhuanlan.zhihu.com/p/24580113?refer=codes)
https://h5.qzone.qq.com/proxy/domain/r.qzone.qq.com/cgi-bin/tfriend/friend_show_qqfriends.cgi?uin=123&follow_flag=1&groupface_flag=0&fupdate=1&g_tk=1742568391
###[Python爬虫实战入门六：提高爬虫效率—并发爬取智联招聘](https://zhuanlan.zhihu.com/p/24930071)
```js


# coding:utf-8

import requests
from bs4 import BeautifulSoup
from multiprocessing import Pool

def get_zhaopin(page):
    url = 'http://sou.zhaopin.com/jobs/searchresult.ashx?jl=全国&kw=python&p={0}&kt=3'.format(page)
    print("第{0}页".format(page))
    wbdata = requests.get(url).content
    soup = BeautifulSoup(wbdata,'lxml')

    job_name = soup.select("table.newlist > tr > td.zwmc > div > a")
    salarys = soup.select("table.newlist > tr > td.zwyx")
    locations = soup.select("table.newlist > tr > td.gzdd")
    times = soup.select("table.newlist > tr > td.gxsj > span")

    for name, salary, location, time in zip(job_name, salarys, locations, times):
        data = {
            'name': name.get_text(),
            'salary': salary.get_text(),
            'location': location.get_text(),
            'time': time.get_text(),
        }
        print(data)

if __name__ == '__main__':
    pool = Pool(processes=2)
    pool.map_async(get_zhaopin,range(1,pages+1))
    pool.close()
    pool.join()
```
###[Python爬虫实战入门四：使用Cookie模拟登录——获取电子书下载链接](https://zhuanlan.zhihu.com/p/24786095)
```js
 

# coding:utf-8
import requests
from bs4 import BeautifulSoup

cookie = '''cisession=19dfd70a27ec0eecf1fe3fc2e48b7f91c7c83c60;CNZZDATA1000201968=1815846425-1478580135-https%253A%252F%252Fwww.baidu.com%252F%7C1483922031;Hm_lvt_f805f7762a9a237a0deac37015e9f6d9=1482722012,1483926313;Hm_lpvt_f805f7762a9a237a0deac37015e9f6d9=1483926368'''

header = {    
'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',    
'Connection': 'keep-alive',       
'accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',  
'Cookie': cookie}

url = 'https://kankandou.com/book/view/22353.html'
wbdata = requests.get(url,headers=header).text
soup = BeautifulSoup(wbdata,'lxml')
print(soup)


 
# coding:utf-8
import requests
from bs4 import BeautifulSoup

cookie = {
"cisession":"19dfd70a27ec0eecf1fe3fc2e48b7f91c7c83c60",          
"CNZZDATA100020196":"1815846425-1478580135-https%253A%252F%252Fwww.baidu.com%252F%7C1483922031",          
"Hm_lvt_f805f7762a9a237a0deac37015e9f6d9":"1482722012,1483926313",          
"Hm_lpvt_f805f7762a9a237a0deac37015e9f6d9":"1483926368"
}

url = 'https://kankandou.com/book/view/22353.html'
wbdata = requests.get(url,cookies=cookie).text
soup = BeautifulSoup(wbdata,'lxml')
print(soup)
```
###[爬取了20万淘宝店铺信息](https://zhuanlan.zhihu.com/p/24389378)
```js
def get_taobao_cate():
    url = 'https://shopsearch.taobao.com/search?app=shopsearch'
    driver = webdriver.PhantomJS(executable_path="F:\\phantomjs.exe")
    driver.get(url)
    driver.implicitly_wait(3)
    page = driver.page_source
    soup = BeautifulSoup(page,'lxml')
    cate_name = re.findall(r"q=(.*?)&amp;tracelog=shopsearchnoqcat",str(soup))
    for c in cate_name:
        cname = urllib.parse.unquote(c,encoding='gb2312')
        cate_list.append(c)
        print(cname)
    print(cate_list)

作者：Lerther
链接：https://zhuanlan.zhihu.com/p/24389378
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

def get_taobao_seller(keywords):
    # 爬取指定数量的店铺信息
    def get_seller_from_num(nums):
        url = "https://shopsearch.taobao.com/search?data-key=s&data-value={0}&ajax=true&_ksTS=1481770098290_1972&callback=jsonp602&app=shopsearch&q={1}&js=1&isb=0".format(nums,keywords)
        # url = "https://shopsearch.taobao.com/search?data-key=s&data-value={0}&ajax=true&callback=jsonp602&app=shopsearch&q={1}".format(nums,keywords)
        wbdata = requests.get(url).text[11:-2]
        data = json.loads(wbdata)
        shop_list = data['mods']['shoplist']['data']['shopItems']
        for s in shop_list:
            name = s['title'] # 店铺名
            nick = s['nick'] # 卖家昵称
            nid = s['nid'] # 店铺ID
            provcity = s['provcity'] # 店铺区域
            shopUrl = s['shopUrl'] # 店铺链接
            totalsold = s['totalsold'] # 店铺宝贝数量
            procnt = s['procnt'] # 店铺销量
            startFee = s['startFee'] # 未知
            mainAuction = s['mainAuction'] # 店铺关键词
            userRateUrl = s['userRateUrl'] # 用户评分链接
            dsr = json.loads(s['dsrInfo']['dsrStr'])
            goodratePercent = dsr['sgr']  # 店铺好评率
            srn = dsr['srn'] # 店铺等级
            category = dsr['ind'] # 店铺分类
            mas = dsr['mas'] # 描述相符
            sas = dsr['sas']  # 服务态度
            cas = dsr['cas']  # 物流速度
            data = {
                'name':name,
                'nick':nick,
                'nid':nid,
                'provcity':provcity,
                'shopUrl':shopUrl,
                'totalsold':totalsold,
                'procnt':procnt,
                'startFee':startFee,
                'goodratePercent':goodratePercent,
                # 'mainAuction':mainAuction,
                'userRateUrl':userRateUrl,
                'srn':srn,
                'category':category,
                'mas':mas,
                'sas':sas,
                'cas':cas
            }
            print(data)
            seller_info.insert_one(data)
            print("插入数据成功")
	    if __name__ == '__main__':
    pool = Pool(processes=4)
    pool.map_async(get_taobao_seller,cate_list)
    pool.close()
    pool.join()
 
```
###[一个获取 QQ 好友名单（号码、名称、头像、等级）的方法](https://www.v2ex.com/t/330033)
1. 登录 “我的 QQ 中心”： http://id.qq.com/ 
2. 来到 “资料-我的等级” 这页： http://id.qq.com/index.html#mylevel 
3. 打开 Chrome 的 Network 监视（或任意浏览器的监视功能、或抓包工具，都行） 
4. 筛选监视列表中的 qqlevel_rank 页面 
5. 这个页面本身就是个 json 格式的列表
项目地址：https://github.com/abosexy/QFriends
https://h5.qzone.qq.com/proxy/domain/r.qzone.qq.com/cgi-bin/tfriend/friend_show_qqfriends.cgi?uin=QQ 号码&follow_flag=1&groupface_flag=0&fupdate=1&g_tk=替换 GTK 
###[Python爬虫入门实战七：使用Selenium--以抓取QQ空间好友说说为例](https://zhuanlan.zhihu.com/p/25006226)
```js


from bs4 import BeautifulSoup
from selenium import webdriver
import time

#使用selenium
driver = webdriver.PhantomJS(executable_path="D:\\phantomjs.exe")
driver.maximize_window()
#登录QQ空间
def get_shuoshuo(qq):
    driver.get('http://user.qzone.qq.com/{}/311'.format(qq))
    time.sleep(5)
    try:
        driver.find_element_by_id('login_div')
        a = True
    except:
        a = False
    if a == True:
        driver.switch_to.frame('login_frame')
        driver.find_element_by_id('switcher_plogin').click()
        driver.find_element_by_id('u').clear()#选择用户名框
        driver.find_element_by_id('u').send_keys('QQ号')
        driver.find_element_by_id('p').clear()
        driver.find_element_by_id('p').send_keys('QQ密码')
        driver.find_element_by_id('login_button').click()
        time.sleep(3)
    driver.implicitly_wait(3)
    try:
        driver.find_element_by_id('QM_OwnerInfo_Icon')
        b = True
    except:
        b = False
    if b == True:
        driver.switch_to.frame('app_canvas_frame')
        content = driver.find_elements_by_css_selector('.content')
        stime = driver.find_elements_by_css_selector('.c_tx.c_tx3.goDetail')
        for con,sti in zip(content,stime):
            data = {
                'time':sti.text,
                'shuos':con.text
            }
            print(data)
        pages = driver.page_source
        soup = BeautifulSoup(pages,'lxml')

    cookie = driver.get_cookies()
    cookie_dict = []
    for c in cookie:
        ck = "{0}={1};".format(c['name'],c['value'])
        cookie_dict.append(ck)
    i = ''
    for c in cookie_dict:
        i += c
    print('Cookies:',i)
    print("==========完成================")

    driver.close()
    driver.quit()

if __name__ == '__main__':
    get_shuoshuo('好友QQ号')
    
  pages = driver.page_source
soup = BeautifulSoup(pages,'lxml')
driver.execute_script("JS代码")
driver.save_screenshot('保存的文件路径及文件名')
```
https://github.com/inconshreveable/ngrok  
