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
作者：路人甲
链接：https://www.zhihu.com/question/28981353/answer/144155391
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

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

###[ Python 把微博数据绘制成一颗“心”](https://www.v2ex.com/t/341280)

完整代码：https://github.com/lzjun567
