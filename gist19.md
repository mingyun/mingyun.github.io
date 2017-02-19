###[简单又实用的 shell 命令](https://www.v2ex.com/t/338470)
```js
find . -type d -name ".svn"|xargs rm -rf;
find . -type f -name "*.a"|xargs svn add;
find . -type d -name ".svn" -delete
grep "search something" -r * --include=*.php
统计某文件个数 ll l grep xxx l wc -l
https://github.com/nvbn/thefuck
while read -d " "; do sl; done 

孩子不到 1 岁的时教会按空格看火车，按了一年多了
命令行的艺术https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md
http://www.commandlinefu.com/commands/browse/sort-by-votes

https://billie66.github.io/TLCL/book/index.html

怎么没有人说 sl 这个命令, 具我的研究它可以用来测试网络是否稳定 
如果稳定的话会有一列火车帽着白烟从屏幕右边向左边疾驰而过 
如果不稳定火车就会一卡一卡的走不动
windows查看WiFi密码
cmd 运行
for /f “skip=9 tokens=1,2 delims=:” %i in (‘netsh wlan show profiles’) do @echo %j | findstr -i -v echo | netsh wlan show profiles %j key=clear
查看Linux版本
cat /etc/redhat-release#或者
cat /etc/issue
linux查看端口占用
netstat -anl | grep “80” ；#1080 8080也是会被筛选出来
lsof -i:80
linux查看程序占用的端口
ps -ef | grep nginx
linux安装docker
curl -s https://get.docker.com/ | sudo sh
linux查看目录中有多少文件
ls -lR|grep “^-“|wc -l
Python启动http服务器（传文件）
python -m SimpleHTTPServer
linux显示命令执行的具体时间精确到秒
export HISTTIMEFORMAT=’%F %T ‘
history | more
linux DD 显示进度
先放入后台，然后每5秒显示一下进度
sudo dd if= xxx.img of=/dev/mmcblk1 bs=10MB &
while (ps auxww |grep “ dd “ |grep -v grep |awk ‘{print $2}’ |while read pid; do kill -USR1 $pid; done) ; do sleep 5; done
命令行测速 （python+speedtest）
sudo apt-get install python-pip
sudo pip install speedtest-cli
另一种
wget https://raw.githubusercontent.com/sivel/speedtest-cli/master/speedtest.py
##　mplayer 后台播放
mplayer * < /dev/null > /dev/null 2>1&
block一些恶意ip
wget https://teddysun.com/wp-content/uploads/2013/05/block.sh
chmod +x block.sh
./block.sh
最常用的命令排行https://vsxen.github.io/2016/12/02/short-useful-command/
history | awk ‘{CMD[$2]++;count++;} END { for (a in CMD )print CMD[ a ]” “ CMD[ a ]/count*100 “% “ a }’ | grep -v “./“ | column -c3 -s “ “ -t |sort -nr | nl | head -n10
命令行播放器 mpv.io
npm install <name> --save  #save的作用是将信息写入package.json中
npm init  #会引导你创建一个package.json文件，包括名称、版本、作者这些信息等
npm update <name>#更新
npm ls #列出当前安装的了所有包
npm uninstall <name>
npm rm <name> #卸载某一个包
npm help  帮助，如果要单独查看install命令的帮助，可以使用的npm help
```
###[ssh免密码登录服务器](https://vsxen.github.io/2016/09/20/ssh-login-linux/)
```js
scp id_rsa.pubroot@ip:~/.ssh/ 
#The authenticity of host '192.168.1.3(192.168.1.3)' can't be established.  ...
#输入yes
#输入密码
cat id_dsa.pub >> ~/.ssh/authorized_keys  
chmod 600 ~/.ssh/authorized_keys  #设置权限
chmod 700 -R .ssh
ssh root@ip
如果不出错的话就登录成功了。
ssh-keygen -t rsa -b 4096 -C "youremail"#生成公钥 不带参数也可以
cat ~/.ssh/id_rsa#复制结果
#打开github，点击头像->setting ->侧边栏选择”SSH Keys" 接着粘贴key，点击”Add key”按钮，如果没有出错就添加成功了。
ssh -T git@github.com#测试连接
The authenticity of host 'github.com...(yes/no)?#输入yes
Hi 你的用户名...access#这就是添加成功了
git remote add origin 你的远程地址 #ssh 不要密码 https需要 ，origin 可以自己取名
git remote -v#查看添加的远程信息
git push -u origin master#提交到远程仓库
git feach origin #取回远程分支的文件
git pull origin master#取回远程分支的文件
```
###[Nginx配置Let'sEncrypt https证书](https://vsxen.github.io/2016/08/20/nginx-https/)
wget https://dl.eff.org/certbot-auto#下载
chmod a+x ./certbot-auto#加权限
./certbot-auto -n#安装依赖
./certbot-auto certonly --standalone --email test@example.com -d www.test.site #单域名单证书
./certbot-auto certonly --standalone --email test@example.com -d www.test.site -d blog.test.site#多域名单证书
ls /etc/letsencrypt/live/
如果需要备份到本地可以使用scp命令
scp -r root@ip:/etc/letsencrypt /Users/test
在crontab加入如下规则0 3 */5 * * /root/certbot-auto renew这样每五天就会执行一次续期操作
###[php nginx windows](https://vsxen.github.io/2016/03/27/windows-wnmp/)
```js
让php能够与nginx结合。找到
;cgi.fix_pathinfo=1
我们去掉这里的封号。
cgi.fix_pathinfo=1
```
###[ ngrok 服务可以分配给你一个域名让你本地的web项目提供给外网访问](http://qydev.com/)
```js
https://vsxen.github.io/2016/10/18/ssh-with-ngrok/ 用ngrok刺破内网，开启本地调试
server_addr: "tunnel.qydev.com:4443"#可以改成别的网站
trust_host_root_certs: falsetunnels
tunnels:
  client:
    auth: "user:password"
    proto:
      https: 8080
  ssh:
    proto: 
      tcp: 22
  test.tunnel.qydev.com:
    proto:
      http: 4000
  weixin2: 
    proto: 
      http: 80
      
      执行./ngrok -config ngrok.cfg list可以看到
weixin2
client
ssh
test.tunnel.qydev.com
已经成功添加了四个隧道
运行./ngrok -config ngrok.cfg start ssh client ，可以开启指定的端口隧道。
配置文件每一项冒号后面必须有空格，必须有空格，必须有空格
```
###[天猫双12爬虫，附266万活动商品数据。](https://github.com/LiuXingMing/Tmall1212)
###[QQ空间爬虫（日志、说说、个人信息）](https://github.com/LiuXingMing/QQSpider)
###[新浪微博爬虫（Scrapy、Redis）](https://github.com/LiuXingMing/SinaSpider)
###[图像识别学习之路上的例子](https://github.com/cnbailian/image-recognition)
###[将网页转换为 PDF ](https://www.v2ex.com/t/340053)
https://github.com/amir20/phantomjs-node 
https://github.com/brenden/node-webshot 
// demo
var webshot = require('webshot');

webshot('google.com', 'google.png', function(err) {
  // screenshot now saved to google.png
});
composer require barryvdh/laravel-dompdf:^0.6.0
###[如何用爬虫抓取京东商品评价](https://www.zhihu.com/question/28981353)
```js
 

#endocing:utf-8
from bs4 import BeautifulSoup
import re,requests,json

s = requests.session()
url = 'https://club.jd.com/comment/productPageComments.action'
data = {	
	'callback':'fetchJSON_comment98vv61',
	'productId':'3888284',
	'score':0,
	'sortType':5,
	'pageSize':10,
	'isShadowSku':0,
	'page':0
}

while True:
	t = s.get(url,params = data).text
	try:
		t = re.search(r'(?<=fetchJSON_comment98vv61\().*(?=\);)',t).group(0)
	except Exception as e:
		break
	
	j = json.loads(t)
	commentSummary = j['comments']
	for comment in commentSummary:
		c_content = comment['content']
		c_time = comment['referenceTime']
		c_name = comment['nickname']
		c_client = comment['userClientShow']
		print('{}  {}  {}\n{}\n'.format(c_name,c_time,c_client,c_content))
	data['page'] += 1
  
  with requests.session() as s:
    url = 'https://club.jd.com/comment/productPageComments.action'
    data = {	
        'productId':'3888284',
        'score':0,
        'sortType':5,
        'pageSize':10,
        'isShadowSku':0,
        'page':0
    }
    r = s.get(url, params = data)
    r.json()

 
```
###[女朋友的微博情绪监控](https://www.v2ex.com/t/339369#reply24)
https://github.com/DIYgod/Weibo2RSS 以 RSS 形式输出消极情绪的微博
https://api.prprpr.me/emotion?text=%E6%88%91%E4%BB%8A%E5%A4%A9%E5%BE%88%E5%BC%80%E5%BF%83 
"以讯飞分词接口和大连理工的情感词汇本体库为基础，分析一句话的情绪值" 

https://api.prprpr.me/emotion/?text=%E6%88%91%E4%BB%8A%E5%A4%A9%E5%BE%88%E5%BC%80%E5%BF%83 

{"code":1,"emotion":5,"words":["我","今天","很","开心"]} 

https://api.prprpr.me/emotion/?text=%E6%88%91%E4%BB%8A%E5%A4%A9%E5%BE%88%E4%B8%8D%E5%BC%80%E5%BF%83 

{"code":1,"emotion":5,"words":["我","今天","很","不","开心"]}
https://github.com/DIYgod/Text2Emotion 分析一句话的情绪值
使用RSS订阅喜欢的微博博主 & 女朋友的微博情绪监控 Demo：https://api.prprpr.me/weibo/rss/3306934123
https://api.prprpr.me/weibo/negative/3306934123 
获取uid：进入博主的微博主页，控制台执行

/uid=(\d+)/. exec(document.querySelector('.opt_box .btn_bed').getAttribute('action-data'))[1]
使用方法及介绍：

https://www.anotherhome.net/2920
###[老司机教你下载tumblr上视频和图片的正确姿势](https://zhuanlan.zhihu.com/p/24945262)
https://link.zhihu.com/?target=https%3A//github.com/xuanhun/tumblr-crawler 
###[Python时间处理完全手册](http://mp.weixin.qq.com/s/MnUpQcf-nHPJw9V9HOp5rQ)
```js
print time.strftime('%Y-%m-%d %H:%M:%S')
# 获取当前日期
today = datetime.date.today()
print today.strftime('%Y-%m-%d')
# Out: '2016-12-01'  # 获取当前日期

now = datetime.datetime.now()
print now.strftime('%Y-%m-%d %H:%M:%S')
# Out: '2016-12-01 16:14:22' # 获取当前日期时间
struct_time = time.strptime('161201 16:14:22', '%y%m%d %H:%M:%S')
# struct_time 为一个时间元组对象
print time.strftime('%Y-%m-%d %H:%M:%S', struct_time)
# Out: '2016-12-01 16:14:22'
dt = datetime.datetime.strptime('161201 16:14:22', '%y%m%d %H:%M:%S')
# dt 为 datetime.datetime对象  # 通过调用 timetuple()方法将datetime.datetime对象转化为时间元组
print dt.strftime('%Y-%m-%d %H:%M:%S')
# Out: '2016-12-01 16:14:22'

```
###[ Python 把微博数据绘制成一颗“心”](https://www.v2ex.com/t/341280)
```js
scipy‑0.18.1‑cp35‑cp35m‑win32.whl 
完整代码：https://github.com/lzjun567
# -*- coding:utf-8 -*-
import codecs
import csv
import re

import jieba.analyse
import matplotlib.pyplot as plt
import requests
from scipy.misc import imread
from wordcloud import WordCloud

__author__ = 'liuzhijun'

cookies = {
    "ALF": "xxxx",
    "SCF": "xxxxxx.",
    "SUBP": "xxxxx",
    "SUB": "xxxx",
    "SUHB": "xxx-", "xx": "xx", "_T_WM": "xxx",
    "gsScrollPos": "", "H5_INDEX": "0_my", "H5_INDEX_TITLE": "xxx",
    "M_WEIBOCN_PARAMS": "xxxx"
}


def fetch_weibo():
    api = "http://m.weibo.cn/index/my?format=cards&page=%s"
    for i in range(1, 102):
        response = requests.get(url=api % i, headers={"cookie":"SINAGLOBAL=4399434400256.724.1393582057383; wb_g_upvideo_2717930601=1; wb_publish_fist100_2717930601=1; YF-Ugrow-G0=b02489d329584fca03ad6347fc915997; SCF=ApAKLlfvcDWRTxdyp6K-ECZnIoyDl2tiNXrWLqQNaUqgjgZpc5-t01qsJ4cWHdnJtKnjRSCkq7EuiPfDHNLWsKo.; SUB=_2A251rJsTDeRxGeRJ6lUY8y7Kyz2IHXVW24vbrDV8PUJbmtBeLRmlkW8tlGcpiAe2Gd2hZyD50yuINbe0jA..; SUBP=0033WrSXqPxfM725Ws9jqgMF55529P9D9WW1cajqHaL9UWbevdkzPrX95JpX5o2p5NHD95QES02N1Ke7So5pWs4Dqcj.i--RiKyFiKysi--NiK.XiKLsi--Xi-zRiKy2i--ciKn0iK.p; SUHB=079ivAWVI-aQRs; ALF=1519001259; SSOLoginState=1487465283; YF-V5-G0=a9b587b1791ab233f24db4e09dad383c; _s_tentry=login.sina.com.cn; UOR=,,login.sina.com.cn; Apache=6104702277251.093.1487465331053; ULV=1487465331062:420:8:1:6104702277251.093.1487465331053:1487376124957; YF-Page-G0=23b9d9eac864b0d725a27007679967df; tips_2717930601=1"})
        data = response.json()[0]
        groups = data.get("card_group") or []
        for group in groups:
            text = group.get("mblog").get("text")
            text = text.encode("utf-8")

            def cleanring(content):
                """
                去掉无用字符
                """
                pattern = "<a .*?/a>|<i .*?/i>|转发微博|//:|Repost|，|？|。|、|分享图片"
                content = re.sub(pattern, "", content)
                return content

            text = cleanring(text).strip()
            if text:
                yield text


def write_csv(texts):
    with codecs.open('./weibo2.csv', 'w') as f:
        writer = csv.DictWriter(f, fieldnames=["text"])
        writer.writeheader()
        for text in texts:
            writer.writerow({"text": text})


def read_csv():
    with codecs.open('./weibo2.csv', 'r') as f:
        reader = csv.DictReader(f)
        for row in reader:
            yield row['text']


def word_segment(texts):
    jieba.analyse.set_stop_words("./stopwords.txt")
    for text in texts:
        tags = jieba.analyse.extract_tags(text, topK=20)
        yield " ".join(tags)


def generate_img(texts):
    data = " ".join(text for text in texts)

    mask_img = imread('./heart-mask2.jpg', flatten=True)
    wordcloud = WordCloud(
        font_path='msyh.ttc',
        background_color='white',
        mask=mask_img
    ).generate(data)
    plt.imshow(wordcloud)
    plt.axis('off')
    plt.savefig('./heart2.jpg', dpi=600)


if __name__ == '__main__':
    texts = fetch_weibo()
    write_csv(texts)
    generate_img(word_segment(read_csv()))

```
###[Python 爬虫：把廖雪峰的教程转换成 PDF 电子书](https://github.com/lzjun567/crawler_html2pdf/tree/master/pdf)

pip install requests
pip install beautifulsoup4
pip install pdfkit
$ sudo apt-get install wkhtmltopdf  # ubuntu
$ sudo yum intsall wkhtmltopdf      # centos
python crawler.py
###[下载各种编程语言文档的网站](https://www.v2ex.com/t/340798#reply12)
http://devdocs.io/  看云的广场里面有很多技术文档 http://www.kancloud.cn/explore
###[开源书籍 《 Python 数据结构》](https://www.v2ex.com/t/340583#reply100)

github 地址: https://github.com/facert/python-data-structure-cn
gitbook 在线浏览: https://facert.gitbooks.io/python-data-structure-cn
###[PHP Compsoer 使用以及常用的一些 Package](https://www.v2ex.com/t/340204#reply6)
###[开源一个爬虫代理框架](https://www.v2ex.com/t/340272#reply43)
github 地址： https://github.com/awolfly9/IPProxyTool
###[通过测试公众号模版消息推送，能够实时获知服务器的状态](https://github.com/iakisey/ServerMsgPush)
###[谁成就了微博段子手杜蕾斯](https://www.v2ex.com/t/340095#reply3)
数据展示用 ECharts 做的： 
http://res.crossincode.com/code/weibo/durex.html https://github.com/zx576/Crossin-practices/tree/master/weibo 
###[用 Vue 实现了 strml.net 的效果](https://www.v2ex.com/t/339958#reply55)
https://jirengu-inc.github.io/animating-resume/dist/  源码： https://github.com/jirengu-inc/animating-resume 饥人谷出品：一个会动的简历
strml.net 抄的这个 http://codepen.io/jakealbaugh/full/JoVrdw/
###[2016 年你所在的行业发生了哪些变化分析器](https://www.v2ex.com/t/339380#reply4)
直接围观： https://labs.getweapp.com/
###[微信一键自动拜年脚本](https://www.v2ex.com/t/336244#reply21)
git clone https://github.com/HanSon/vbot.git
cd vbot
composer install
php example/bainian.php
https://github.com/vonnyfly/wechat-sendall
网址收藏应用： http://mybookmark.cn/
###[简单的视频下载器，支持 youtube 与 B 站](https://www.v2ex.com/t/339114#reply56)
GitHub releases ： https://github.com/sorrowise/viedo_downloader/releases
https://github.com/rg3/youtube-dl 
###[加密的内容是 jquery](https://www.v2ex.com/t/338725#reply13)
```js
$uid = 13922; 

$url = 'http://api.expoon.com/XmlKrpano/getCrptyXml/uid/' . $uid; 

$data = file_get_contents($url); 

$data = substr($data, 2, -2); //去掉不需要的内容 

$key = $uid % 10; //得到 key 

$data = str_replace('$', $key, $data); //进行替换 

$data = base64_decode($data); // base64 解码 

var_dump($data);//输出内容
```
###[markdown 的所见即所得编辑器](https://www.v2ex.com/t/338391#reply119)
[Artizen.cc]一个独立作品收集站点
在浏览器端无需插件即可多人视频的站https://www.v2ex.com/t/337390#reply25
输入房间名创建房间后只需要将 URL 发给朋友，一键即可加入
比如: https://lawsroom.com/room/ROOM_NAME
GitHub:https://github.com/HFO4/HideByPixel

Demo:https://hide.aoaoao.me/
[把文字写进像素里] 基于像素微调实现的文字隐写术https://www.v2ex.com/t/337138#reply63
 PHP 写的一个文字直播，协作编辑的工具https://www.v2ex.com/t/336102#reply19 
 http://pad.laravel.band/pad/home
 
GitBook《十大经典排序算法》JavaScript 实现https://www.v2ex.com/t/335773#reply16
https://github.com/hustcc/JS-Sorting-Algorithm GitHook 在线阅读地址：https://sort.hust.cc/
Javascript - 一个支持中文的摩斯密码转换库开源地址在这里：https://github.com/hustcc/xmorse

demo 地址：http://git.hust.cc/xmorse
https://www.v2ex.com/t/334965#reply2
Python requests SSL: CERTIFICATE_VERIFY_FAILED 错误https://www.v2ex.com/t/334435#reply20
requests.packages.urllib3.disable_warnings()
Medoo 中文文档地址：http://lonewolf.oschina.io/medoo/  https://www.v2ex.com/t/333158#reply20
 markdown 转换为类似于下面的 html 页面https://www.v2ex.com/t/333132#reply1
 微信命令行版本终端 github 地址： https://github.com/liushuchun/wechatcmd
 https://github.com/lbbniu/WebWechat https://github.com/Urinx/WeixinBot 
 pip install git+https://github.com/dabeaz/curio.git
 http://res.crossincode.com/other/heart.html https://www.v2ex.com/t/333050#reply88
 http://zichi.date/2015/love-on-20150214/ 
 程序员怎样用自己的专业技能给女朋友惊喜https://www.v2ex.com/t/333050#reply88
  fork 简历的小工具https://www.v2ex.com/t/333153#reply2 https://github.com/remrain/fork-this-resume
  python whl http://www.lfd.uci.edu/~gohlke/pythonlibs/#numpy
  ###[最省心的Python版本和第三方库管理——初探Anaconda](https://zhuanlan.zhihu.com/p/25198543)
  
  不过很少有以anaconda入门的教程，给人一种先学Python再学numpy scipy的感觉。其实从一开始就用anaconda能少很多事，不论是版本和库的管理，还是iPython交互的命令行、spyder编辑器，当然我现在最常用的还是jupyter notebook。
###[Python爬虫|Python爬虫入门（四）：储存](https://zhuanlan.zhihu.com/p/21452812)
  ```js
  #Python列表or元组与csv的转换
csv.reader(file)    #读出csv文件

csv.writer(file)    #写入csv文件
writer.writerow(data)    #写入一行数据
writer.writerows(data)    #写入多行数据 


#Python字典与csv的转换
csv.DictReader(file)    #读出csv文件

csv.DictWriter(file)    #写入csv文件  
writer.writeheader()    #写文件头
writer.writerow(data)    #写入一行数据
writer.writerows(data)    #写入多行数据 
作者：iGuo
链接：https://zhuanlan.zhihu.com/p/21452812
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

# -*- coding: utf-8 -*-
import codecs
import csv

import requests
from bs4 import BeautifulSoup


def getHTML(url):
    r = requests.get(url)
    return r.content


def parseHTML(html):
    soup = BeautifulSoup(html,'html.parser')

    body = soup.body
    company_middle = body.find('div',attrs={'class':'middle'})
    company_list_ct = company_middle.find('div',attrs={'class':'list-ct'})
    
    company_list = []    #修改
    for company_ul in company_list_ct.find_all('ul',attrs={'class':'company-list'}):
        for company_li in company_ul.find_all('li'):
            company_url = company_li.a['href']
            company_info = company_li.get_text()
            company_list.append([company_info.encode('utf-8'),company_url.encode('utf-8')])    #修改
    
    return company_list    #修改


def writeCSV(file_name,data_list):
    with codecs.open(file_name,'wb') as f:
        writer = csv.writer(f)
        for data in data_list:
            writer.writerow(data)


URL = 'http://www.cninfo.com.cn/cninfo-new/information/companylist'
html = getHTML(URL)
data_list = parseHTML(html)    #修改
writeCSV('test.csv',data_list)

r3 = requests.get('http://www.cninfo.com.cn/finalpage/2015-03-13/1200694563.PDF',stream = True)    #请求

r3.raw.read()   #读取文件
```
###[Python对微信好友进行简单统计分析](https://zhuanlan.zhihu.com/p/21967333?refer=passer)
https://www.zhihu.com/question/36132174/answer/145997723?group_id=814232716034871296
###[爬虫带你逛知乎](https://zhuanlan.zhihu.com/p/25133425)
#下载图片 
def downloadimage(urllist):
    for url in urllist:
        ir = s.get(url,headers=HEADERS)
        if ir.status_code == 200:
            open('images\%s' %(url.split(r'/')[-1]), 'wb').write(ir.content)

 https://link.zhihu.com/?target=https%3A//github.com/kimg1234/pachong/
###[Shapecollage：超好用的拼图工具](https://zhuanlan.zhihu.com/p/25151315)
###[天猫商品评论 ](http://www.yunya.pw/?post=18)
GitHub https://github.com/cooperxiong/py-crawlers  http://www.yunya.pw/?post=5
###[利用相关性进行数字识别](http://www.yunya.pw/?post=14)
```js
import numpy as np
import scipy as sp
import pandas as pd
import matplotlib.pyplot as plt

df_train = pd.read_csv("../input/train.csv",nrows=2000) 
#df_test = pd.read_csv("test.csv")
X_train = df_train.drop("label",axis=1)

X_train_n = [0]*10
for n in range(10):
    X_train_n[n] = df_train.loc[df_train.label==n].drop("label",axis=1)

plt.figure(figsize=(12,12))

for i in range(10):
    plt.subplot(10,4,i+1)
    plt.imshow(X_train_n[i].mean(axis=0).reshape(28,28),interpolation='nearest')   
    #plt.axis('tight')
plt.figtext(0.5, 0.965,"average image",size='large')

plt.show()

# use corr
nr = 0
for k in range(50):
    maxcorr=0
    for i in range(10):
        a = X_train_n[i][:10].mean(axis=0)
        corr = np.corrcoef(X_train.values[k,:],a)[0,1]
        #print i,corr
        if maxcorr <= corr:
            maxcorr = corr
            pred = i
    if pred == df_train.label[k]:
        nr += 1
    print (k,maxcorr,pred,df_train.label[k])
print (nr / 50)
```
###[phpanalysis分词系统](https://segmentfault.com/q/1010000008401473)
```js
    /**
     * 获得保存目标编码
     * @return int
     */
     private function _source_result_charset()
     {
        if( preg_match("/^utf/", $this->targetCharSet) ) {
           $rs = 1;
        }
        else if( preg_match("/^gb/", $this->targetCharSet) ) {
           $rs = 2;
        }
        else if( preg_match("/^big/", $this->targetCharSet) ) {
           $rs = 3;
        }
        else {
            $rs = 4;
        }
        return $rs;
     }
     
     /**
     * 编译词典
     * @parem $sourcefile utf-8编码的文本词典数据文件<参见范例dict/not-build/base_dic_full.txt>
     * 注意, 需要PHP开放足够的内存才能完成操作
     * @return void
     */
     public function MakeDict( $source_file, $target_file='' )
     {
        $target_file = ($target_file=='' ? $this->mainDicFile : $target_file);
        $allk = array();
        $fp = fopen($source_file, 'r');
        while( $line = fgets($fp, 512) )
        {
            if( $line[0]=='@' ) continue;
            list($w, $r, $a) = explode(',', $line);
            $a = trim( $a );
            $w = iconv('utf-8', UCS2, $w);
            $k = $this->_get_index( $w );
            if( isset($allk[ $k ]) )
                $allk[ $k ][ $w ] = array($r, $a);
            else
                $allk[ $k ][ $w ] = array($r, $a);
        }
        fclose( $fp );
        $fp = fopen($target_file, 'w');
        $heade_rarr = array();
        $alldat = '';
        $start_pos = $this->mask_value * 8;
        foreach( $allk as $k => $v )
        {
            $dat  = serialize( $v );
            $dlen = strlen($dat);
            $alldat .= $dat;
        
            $heade_rarr[ $k ][0] = $start_pos;
            $heade_rarr[ $k ][1] = $dlen;
            $heade_rarr[ $k ][2] = count( $v );
        
            $start_pos += $dlen;
        }
        unset( $allk );
        for($i=0; $i < $this->mask_value; $i++)
        {
            if( !isset($heade_rarr[$i]) )
            {
                $heade_rarr[$i] = array(0, 0, 0);
            }
            fwrite($fp, pack("Inn", $heade_rarr[$i][0], $heade_rarr[$i][1], $heade_rarr[$i][2]));
        }
        fwrite( $fp, $alldat);
        fclose( $fp );
     }
     
     /**
     * 导出词典的词条
     * @parem $targetfile 保存位置
     * @return void
     */
     public function ExportDict( $targetfile )
     {
        if( !$this->mainDicHand )
        {
            $this->mainDicHand = fopen($this->mainDicFile, 'r');
        }
        $fp = fopen($targetfile, 'w');
        for($i=0; $i <= $this->mask_value; $i++)
        {
            $move_pos = $i * 8;
            fseek($this->mainDicHand, $move_pos, SEEK_SET);
            $dat = fread($this->mainDicHand, 8);
            $arr = unpack('I1s/n1l/n1c', $dat);
            if( $arr['l'] == 0 )
            {
                continue;
            }
            fseek($this->mainDicHand, $arr['s'], SEEK_SET);
            $data = @unserialize(fread($this->mainDicHand, $arr['l']));
            if( !is_array($data) ) continue;
            foreach($data as $k => $v)
            {
                $w = iconv(UCS2, 'utf-8', $k);
                fwrite($fp, "{$w},{$v[0]},{$v[1]}\n");
            }
        }
        fclose( $fp );
        return true;
     }
}

```
###[JavaScript闭包的经典面试题有点不懂](https://segmentfault.com/q/1010000008395390)
for (var i = 0; i < 10; ++i) {
    setTimeout(function () {console.log(i)}, 0);
}
for (var i = 0; i < 10; ++i) {
    setTimeout((function () {console.log(i)})(), 0);
}
for (var i = 0; i < 10; ++i) {
    (function(i) {
        setTimeout(function () {console.log(i)}, i * 100);
    })(i)
}
###[js 函数中属性定义的疑问](https://segmentfault.com/q/1010000008392972)

function a()
            {
                this.showMsg = function()
                {
                    alert("a want showMsg");
                }
            }
a.showMsg = function() 
            {
          alert("a want showMsg static");
            }
            var p = new a();
         a.showMsg();    //输出a want showMsg static
         p.showMsg();    //输出a want showMsg
	 
一种是实例方法，一种是静态方法。

实例方法当实例化时会添加到生成的对象中，静态方法在构造函数上，可以直接调用。

通常我们定义静态方法，可以减少全局变量的声明个数，避免变量污染，而且很多静态方法是在构造函数中使用，这样定义为对应的构造函数上，方便管理。
 function a()
    {
      this.showMsg = function()
      {
        alert("haha");
      }
    }
    //a.showMsg();  //调用失败,this绑定的方法只有在实例化的时候才会被绑定当a的实例上
    a.showMsg = function(){
      alert("heihei")
    };

    a.showMsg();   //"heihei" 调用成功,在类外部申明的属性相当于静态属性,不需要实例化,可以直接通过类名称访问

    var b = new a(); //调用了a的构造函数,给b添加了showMsg属性
    b.showMsg();     //"haha" 调用成功,b是a的实例
    
###[合并相同值的键的实现方法](https://segmentfault.com/q/1010000008399710)
>>> a = [1,2,3,4,5,6]
>>> b = [7,7,9,8,8,8]
>>> d={}
>>> for k,v in zip(b,a):
    d.setdefault(k,[]).append(v)

    
>>> d
{8: [4, 5, 6], 9: [3], 7: [1, 2]}
from itertools import groupby
from functools import reduce

dic_a = {1: 7, 2: 7, 3: 9, 4: 8, 5: 8, 6: 8}

dica = dict([reduce(lambda v, e: (int(str(v[0])+str(e[0])), k), g) for k, g in 
groupby(dic_a.items(), lambda v: v[1])])
>>> dica
>>> {3: 9, 12: 7, 456: 8}
###[ajax使用post方法传递数据](https://segmentfault.com/q/1010000008400321)
xhr.open('get','m.php?date='+cdate,true);  //cdate是获取的日期值
xhr.send();

xhr=new XMLHttpRequest();
xhr.open('post','m.php',true); 
###[pdo的select操作怎么利用prepare语句返回结果数组](https://segmentfault.com/q/1010000008399081)
执行$db->select(array('*'), 'admin')之后，$params = ['*']，$statement = "select ? from admin;

你prepare的语句是select ? from admin，注意?的位置。

然后在bindParam(1, $params[0])，实际执行的语句就变成：select '*' from admin，就是select一个字符串'*'。

select '*' from admin和select * from admin是不同的。

xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
xhr.send('date='+cdate); //cdate是获取的日期值
###[php中break 2 和 continue 2](https://segmentfault.com/q/1010000008396915)

foreach($arr1 as $value1)
    {
        foreach($value1 as $value2)
        {
            if($value2 == 0)
            {
               continue; //继续下次循环,在里层的foreach里面，默认为1
               continue 2;//继续下次循环,在外层的foreach里面 
               break; 则同理
            }
        }
    
    }
###[往后1个月的时间戳](https://segmentfault.com/q/1010000008391749)
ALTER TABLE tablename CONVERT TO CHARSET utf8; （输入这句命令后，可以插入含中文的记录）
ALTER TABLE tablename DEFAULT CHARSET utf8; （然而输入完这句，再插入含中文的记录时，会报错）
$date = new DateTime('2019-11-23');
$date->add(new DateInterval('P1M'));
echo $date->format('Y-m-d') . "\n";
strtotime的+1 month是直接加31天，很可能不是你想要的结果：

date('Y-m-d', strtotime('+1 month', strtotime('2016-01-31'))); // 2016-03-02
date('Y-m-d', strtotime('+1 month', strtotime('1999-01-31'))); // 1999-03-03
date('Y-m-d', strtotime('+1 month', strtotime('1999-03-31'))); // 1999-05-01
DateInterval('P1M')也是类似的结果。https://segmentfault.com/q/1010000008392233 
// print 2017-04-28
echo date('Y-m-d', strtotime('+2 month', strtotime('2017-2-28')));
function xufei($add_num) 
{
    $month = date('m', time()) + 1;
    $limit = strtotime(sprintf('%s-%s-01', date('Y'), $month)) - 86400 - strtotime(date('Y-m-d', time()));
    
    $add_num += $month;
    return strtotime(sprintf('%s-%s-01', date('Y') + floor($add_num / 12), $add_num % 12)) - 86400 - $limit;
}

echo date('Y-m-d', xufei(5)); 
###[spl_autoload_register()](https://segmentfault.com/q/1010000008393605)
function auto($class){
    if（file_exists("./class/".$class.".php")) {
        require("./class/".$class.".php");
    }
}
function aa($class){
    if（file_exists("./class2/".$class.".php")) {
        require("./class2/".$class.".php");
    }
}
spl_autoload_register("auto");
spl_autoload_register("aa");
###[laravel在执行php artisan出现内容不足](https://segmentfault.com/q/1010000008393245)
sudo vim /etc/php/7.1/fpm/php.ini 把 memory_limit设定为 -1，即不对php的memory做限制。

memory_limit = -1
然后再尝试➜ yak git:(dev) ✗ php artisan make:model Dictionary -m

Model created successfully.
###[php 静态方式调用非静态方法](https://segmentfault.com/q/1010000008391485)
<?php
class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        // Note: the next line will issue a warning if E_STRICT is enabled.
        A::foo();
    }
}

$a = new A();
$a->foo();

// Note: the next line will issue a warning if E_STRICT is enabled.
A::foo();
$b = new B();
$b->bar();

// Note: the next line will issue a warning if E_STRICT is enabled.
B::bar();
?>

在不匹配的上下文中以静态方式调用非静态方法， 在 PHP 5.6 中已经废弃， 但是在 PHP 7.0 中， 会导致被调用方法中未定义 $this 变量，以及此行为已经废弃的警告。
<?php
class A {
    public function test() { var_dump($this); }
}

// 注意：并没有从类 A 继承
class B {
    public function callNonStaticMethodOfA() { A::test(); }
}

(new B)->callNonStaticMethodOfA();
?>
###[通过for循环创建对象型数组](https://segmentfault.com/q/1010000008392011)

var arr=[]
var k={}
k.num=0
k.name=''
a=[1,2,3,4]
b=['tom','sun','bob','kiki']
for(i=0;i<4;i++)
{
    k.num=a[i];
    k.name=b[i];
    arr.push(k)
}
console.log(arr)
结果：[{name:'kiki,num:4},{name:'kiki,num:4},{name:'kiki,num:4},{name:'kiki,num:4}]
k是一个对象，而且在内存中只有一个，循环中每次对k的属性赋值都在相同的内存空间里进行，所以push到arr中的4个对象都是相同的k对象
for(i = 0; i < 4; i++)
{
    arr.push({
        num : a[i],
        name: b[i]
    })
}
###[python如何让减价乘除变成变量之后再变回来](https://segmentfault.com/q/1010000008389427)
a = 1
b = 2
for opt in ["+", "-", "*", "/"]:
    print(eval(str(a) + opt + str(b)))
###[js 取对象属性的个数](https://segmentfault.com/q/1010000008387942)
 for(pro in this){
     if(this.hasOwnProperty(pro)) count++;
  }
###[React和Vue的初学demo](https://segmentfault.com/q/1010000008374402)
https://github.com/SimonZhangITer/VueDemo_Sell_Eleme
###[login_log表转换成last_login表](https://segmentfault.com/q/1010000008382051)
把这张表转换成一张名为last_login的表，它只记录每个用户最近一次登录事件
INSERT 
INTO 
    last_login(user_id,last_login_time,last_login_ip)
SELECT
    log.user_id,
    log.login_time ,
    log.login_ip
FROM
    login_log log,
    (
        SELECT
            user_id,
            MAX(login_time) last_login_time
        FROM
            login_log
        GROUP BY
            user_id
    ) last_log
WHERE
    log.user_id= last_log.user_id
AND log.login_time= last_log.last_login_time;
###[Linux 中php读写文件时，是Linux中的哪个用户在读写的](https://segmentfault.com/q/1010000008384308)
ps -ef |grep php-fpm
显示如下： www 38216 38215 0 Feb13 ? 00:00:02 nginx: worker process

这个www 用户 在.conf 里面user 可以配置
###[Python request 上传文件](https://segmentfault.com/q/1010000008378921)
curl --form file=@/home/test/sample.png --form username=test@noreply.com --form password=test --insecure --form lang[0]=cn --form lang[1]=jp --form langs[2]=en https://www.example.com/api

files = {'file': open('test.png', 'rb')}
requests.post(url, files=files)
with open('filename1', 'rb') as f1, open('filename2', 'rb') as f2:
    files_to_upload = {
        'filename1': f1,
        'filename2': f2,
    }
    
    response = requests.post(url, files=files_to_upload)
###[python如何根据关键字查询进程](https://segmentfault.com/q/1010000008380240)
import os

ret = os.popen("ps -ef | grep mysql | wc -l")
print ret.read()
###[PHP中session问题](https://segmentfault.com/q/1010000008379709)
session默认是个会话文件, 存在服务器端的, sessid就是会话文件的唯一标识，也就是文件名. 一般情况是通过cookie来传递sessid的, 因为http协议是无状态的, 所以每次都得传, 才能确定上一个请求和下一个请求的是不是同一个访问者.

那既然用sessid可以标识会话的唯一性, 那你能拿到它，自然也就可以登录别人的网站了. 你自己可以做个实验验证一下, 把segmentfault网站的cookie中的phpsessid拷贝到另一个浏览器上, 你会发现另一个浏览器也登录了
###[GitHub 支持的 emoji ](http://www.webpagefx.com/tools/emoji-cheat-sheet/)
###[laravel多表查询](https://segmentfault.com/q/1010000008016729)
通过user表里的用户id查询order表里订单的详细信息，然后通过order里的aid查询account账号的账号信息
//在模型中设置关联
class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }
}

//查询出id为1的用户所有的订单,并用with关联出user的信息
$orders= Order::whereHas('user', function ($q) {
    $q->where('id', 1);
})->with('user')->get();
###[尾递归优化](https://segmentfault.com/q/1010000008373129)
function f(n) {
        return n < 2 ? n : f(n - 2) + f(n - 1);
    }
    
f(50)   
var fibArr =[0,1,1];
function fibonacci(n){
    return  fibArr[n]? fibArr[n]:(fibArr[n]=fibonacci(n-1)+fibonacci(n-2));
}
checkout . 放弃修改，可是发现新建的文件夹和文件夹内的内容并没有被删除掉
因为新建的文件夹和文件是 ‘Untracked files’ ，想放弃他们可以用 git clean -fd 
###[禁止手机键盘上的表emoji情输入](https://segmentfault.com/q/1010000008357920)
// 输入时删除emoji字符
$("input").on("input", function(){
    this.value = this.value.replace(/\ud83d[\udc00-\ude4f\ude80-\udfff]/g, '');
});

"i am emoji 👨‍👩‍👧‍👦".replace(/\ud83d[\udc00-\ude4f\ude80-\udfff]/g, '');
// "i am emoji "
###[php-cgi和php-fpm有什么关系?](https://segmentfault.com/q/1010000008356979)
###[php中preg_replace匹配问题](https://segmentfault.com/q/1010000008356679)
 \11将会使preg_replace() 不能理解你希望的是一个\1后向引用紧跟一个原文1，还是 一个\11后向引用后面不跟任何东西。 这种情况下解决方案是使用${1}1
 ###[背包算法PHP或Javascript实现方案](https://segmentfault.com/q/1010000008357070)
 ###[Python list转换成字符串](https://segmentfault.com/q/1010000008350777)
 str([[[1, 2], [1, 2]], [[3, 4], [3, 4]]])
 ###[PHP关于递归和无限级分类](https://segmentfault.com/q/1010000008352829)
