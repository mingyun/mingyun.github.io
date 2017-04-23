[值得回头看几遍](https://www.zhihu.com/collection/19561986)
[知乎实时热门](https://www.zhihu.com/collection/118261499)
[laravel用构造器写了一个查询,如何知道具体运行的sql语句](https://www.zhihu.com/question/58792455)
```js
MySQL开general_log就能看到应用程序执行了哪些SQL:my.cnf:
[mysqld]
general_log=ON
general_log_file=/path/to/sql.log
用 tail -f /path/to/sql.log 实时监听日志文件的改变.用ORM和Query Builder还不如用PDO+SQL来得简单直接:有参数的:
$stmt = $db->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
$rowCount = $stmt->rowCount();
没有参数的:
$rows = $db->query($sql)->fetchAll();
$rowCount = $db->query($sql)->rowCount();
https://link.zhihu.com/?target=http%3A//overtrue.gitbooks.io/building-web-apps-with-laravel5/
 PHP的几种SAPI(Server API):

php(cli,cli-server)
php-cgi(cgi-fcgi)
php-fpm/hhvm(fpm-fcgi)
libphp7.so/php7apache2_4.dll(apache2handler)
cli跟其他SAPI最大的区别就是:像你熟悉的各种超全局变量$_SERVER,$_COOKIE,$_SESSION,$_GET,$_POST,$_FILES,你没法在cli下正常使用了,换言之,就是cli下默认没有这些东西.
```
文件包含漏洞(绕过姿势)https://zhuanlan.zhihu.com/p/26287501?group_id=835055887910588416
4行Python代码获取所在城市天气预报https://zhuanlan.zhihu.com/p/26369491?group_id=836265482196754432
 r = requests.get('http://www.weather.com.cn/data/sk/101020100.html')
 r.encoding = 'utf-8'
 一行curl：
curl "http://www.weather.com.cn/data/sk/101020100.html" | jq -c ". | .weatherinfo.city, .weatherinfo.WD, .weatherinfo.temp"
一行 shell：curl
http://wttr.in
xlwings 让你的 Excel 飞起来https://zhuanlan.zhihu.com/p/25810634
计算一个整数的阶乘https://zhuanlan.zhihu.com/p/26288051?group_id=835065900435636224
傻子才去记Excel的函数，聪明人都用这招https://zhuanlan.zhihu.com/p/26324706?group_id=835549668145496064
爬虫天坑系列-百度指数爬虫https://zhuanlan.zhihu.com/p/26295228?group_id=835159482865692672
使用Python进行语音识别---将音频转为文字https://zhuanlan.zhihu.com/p/26121974?group_id=834701120264892416
如何用Python做一个微信自动拉群机器人？https://zhuanlan.zhihu.com/p/26277794?group_id=835166911510765568
25 个 questions, 教你向面试官提问!https://zhuanlan.zhihu.com/p/26287742?group_id=835062556828766208
Python 基础梳理(思维导图与汇总)http://link.zhihu.com/?target=https%3A//github.com/Windrivder/Python-Book
作为面试官，面试时我会问这三个问题https://zhuanlan.zhihu.com/p/26272337?group_id=834763880705167360 
程序员职业发展该怎么做https://zhuanlan.zhihu.com/p/26334825?group_id=835796642362970112
微博社交网络图：爬虫+可视化https://zhuanlan.zhihu.com/p/26316380?group_id=835463883828363264
效率君先用Tineye（专业的以图搜图网站）
https://zhuanlan.zhihu.com/p/26326810?group_id=835553821164986369  Python 网络爬虫入门
[微信机器人进化指南](https://zhuanlan.zhihu.com/p/26319288?group_id=835502104545230848)
笨办法学前端http://link.zhihu.com/?target=https%3A//frankfang.github.io/wheels/
[我的职业是前端工程师](http://ued.party/)
[我是如何使用Python来自动化我的婚礼的](https://zhuanlan.zhihu.com/p/26395384)
[校长，我要上车——python模拟登录熊猫TV](https://zhuanlan.zhihu.com/p/26164778?group_id=837315473673707520)
用chrome打开pandaTV，同时按F12打开chrome dev tool，选择Network栏，勾选Preserve log，如图所示。勾选Preserve log 是为了不让抓包被刷新掉，因为登录过程中有一次刷新，很容易就把关键的包刷掉了。
[你一定能看懂的算法基础书《算法图解》](https://zhuanlan.zhihu.com/p/26332883?group_id=835775400192925696)
[机器学习的数学之 python 矩阵运算](https://zhuanlan.zhihu.com/p/26343623?group_id=835872318491361280)

[又在知乎上get√新技能](https://www.zhihu.com/collection/30569180)
[从0开始学PHPExcel(1)之初探](https://zhuanlan.zhihu.com/p/26515492?group_id=839150577912025088)
```js
http://link.zhihu.com/?target=https%3A//github.com/PHPOffice/PHPExcel
header('content_type:text/html;charset=utf-8');
	$dir=dirname(__FILE__);//找到当前脚本所在的路径
	include $dir."/PHPExcel.php";//引入文件
	$objPHPExcel = new PHPExcel();//实例化PHPExcel类 (相当于创建了一个excel表格)
	$objSheet=$objPHPExcel->getActiveSheet();//获取当前活动sheet的操作对象
	$objSheet->setTitle("demo");//给当前活动的sheet这只名称为demo
	$objSheet->setCellValue("A1","昵称")->setCellValue("B1","性别")->setCellValue("C1","年龄");//给当前活动的sheet填充数据
	$objSheet->setCellValue("A2","羊大仙")->setCellValue("B2","男")->setCellValue("C2","21");
	$objSheet->setCellValue("A3","张三")->setCellValue("B3","女")->setCellValue("C3","18");
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");//按照指定的格式生成excel文件
	$objWriter->save($dir."/demo.xlsx"); //命名保存的路径
```
[他看了几千份技术简历，愿意把技术简历的秘籍传授给你](https://zhuanlan.zhihu.com/p/26494021?group_id=838750245969092608)
[【收藏】数据分析必备神器](https://zhuanlan.zhihu.com/p/26494069?group_id=838744356759408640)
http://www.picdata.cn/#
[Scrapy爬图片（二）](https://zhuanlan.zhihu.com/p/26419110?group_id=838166013559341056)
[“你最大的缺点是什么？”，面试中你最好这样回答...](https://zhuanlan.zhihu.com/p/26445672?group_id=837979918125121536)
有时候，我会过于关注一件事，尤其是截止日期很赶或成果很重要的时候，这时我对其他事的关注可能没那么够

我有时会太注重细节，失去全局观
[世界上最好语言，PHP技术百问](https://zhuanlan.zhihu.com/p/26484814)
[ python Web 运维 爬虫.....一条龙学习视频教程](https://zhuanlan.zhihu.com/p/24518315)
链接：http://pan.baidu.com/s/1boTrTmv 密码：w7ml解压密码: redis章节:www.helloworld.com 其他:www.zygx8.com
[知乎牛人集中营](https://www.zhihu.com/collection/19682978)
[mysql 证明为什么用limit时，offset很大会影响性能](https://github.com/zhangyachen/zhangyachen.github.io/issues/117)
select * from test where val=4 limit 300000,5; select * from test a inner join (select id from test where val=4 limit 300000,5) b on a.id=b.id;
[nginx 502 VS 504](https://github.com/zhangyachen/zhangyachen.github.io/issues/89)
[mysql group max](https://github.com/zhangyachen/zhangyachen.github.io/issues/103)
查找人数(userNum)最多的行对应的teamId，为什么会返回1呢？很显然人数最多的行对应的teamId不是1。
select teamId,userNum from iknow_team_info order by userNum desc limit 1
select teamId,max(userNum) maxNum from iknow_team_info group by teamId order by maxNum desc limit 1;
[酷炫的matplotlib](https://zhuanlan.zhihu.com/p/26441649?group_id=837805836544929792)
[《数据运营手册》| GrowingIO ](https://zhuanlan.zhihu.com/p/26486065)
[python38 行代码实现传输 Android 实时画面](https://www.v2ex.com/t/356275)

[一个自动上色的网站——Automatic Image Colorization](https://zhuanlan.zhihu.com/p/26438147?group_id=837740550802264064)
[6个提高学习和工作效率的神器](https://zhuanlan.zhihu.com/p/25080445?group_id=837746344964784128)
youtube高清视频在线下载 http://link.zhihu.com/?target=http%3A//www.clipconverter.cc/ http://link.zhihu.com/?target=http%3A//www.flvcd.com/
[IP精确定位的一个网站](http://opengps.cn/Data/IP/LocHighAcc.aspx)
[Python如何识别二维码](https://zhuanlan.zhihu.com/p/21292914?group_id=837314583822741505)
import zbar
from PIL import Image
[sql连接查询中on筛选与where筛选的区别](https://zhuanlan.zhihu.com/p/26420938?group_id=837596545636536320)
select * from main left JOIN exton main.id = ext.id and address <> '杭州'
select * from main left JOIN ext on main.id = ext.id where address <> '杭州'
1、先对两个表执行交叉连接(笛卡尔积)

2、应用on筛选器

3、添加外部行

4、应用where筛选器

[不那么反人性的爬虫，浏览器渲染](https://zhuanlan.zhihu.com/p/26385967?group_id=836718435974135808)
http://link.zhihu.com/?target=http%3A//www.seleniumhq.org/download/  selenium (里面涉及到要用的webdriver, 比如我用的chrome
http://link.zhihu.com/?target=https%3A//github.com/leven-ls/cq_lianjia 
[从零开始的 Python 爬虫速成指南](https://zhuanlan.zhihu.com/p/26301354?group_id=836539571704569857)
[为了找一份Python实习，我用爬虫收集数据](https://zhuanlan.zhihu.com/p/26409764?group_id=837352936089722880)
[手把手教你搭建谷歌TensorFlow深度学习开发环境！](https://zhuanlan.zhihu.com/p/26389992?group_id=836913754196299776)
[python奇技淫巧](https://zhuanlan.zhihu.com/p/26459091)
```js
os.system('pause') print a.prettify()
获取python安装路径

from distutils.sysconfig import get_python_lib
print get_python_lib
查看系统环境变量

os.environ["PATH"]
当前平台使用的行终止符

os.linesep
域名解析为ip
isinstance("123",(int,long,float,complex)
file_dict={"a":1,"b":2,"c":3}
file_dict_new=sorted(file_dict.iteritems(), key=operator.itemgetter(1),reverse=True) ##字典排序,reverse=True由高到低，itemgetter(1)表示按值排序，为0表示按key排序
ip= socket.getaddrinfo(domain,'http')[0][4][0]
输出一个目录下所有文件名称
列表去重

ids = [1,4,3,3,4,2,3,4,5,6,1]
ids = list(set(ids))
将嵌套列表转换成单一列表

a = [[1, 2], [3, 4], [5, 6]]
>>> import itertools
>>> list(itertools.chain.from_iterable(a))
[1, 2, 3, 4, 5, 6]
>>> ip= socket.getaddrinfo('zhuanlan.zhihu.com','http')[0][4][0]
>>> ip
'118.178.213.186'
def search(paths):
    if os.path.isdir(paths):  #如果是目录
          files=os.listdir(paths)  #列出目录中所有的文件
          for i in files:
               i=os.path.join(paths,i)  #构造文件路径
               search(i)           #递归
          elif os.path.isfile(paths): #如果是文件
               print paths   #输出文件名
```
[无广告，集百度，谷歌] (http://www.qi1y.cn/)
Windows 绝赞应用 https://emlvirus.gitbooks.io/windows-apps-that-amaze-us/content/ 
[值得购买/使用的、能够提升码农日常生活/工作的服务工具](https://www.v2ex.com/t/355892#reply97)
[Python 字符串 '0x01' 转换成 数字](https://www.v2ex.com/t/356421#reply5)
int('0xaa01', 16)int('0x01',0) int(eval('0x01'))
[2017 谷歌可用hosts](http://www.51ask.org/article/256)
修改hosts后如果不生效 ，需要刷新DNS ipconfig /flushdns  sudo rcnscd restart
[PHP 在线项目挑战](https://www.v2ex.com/t/356459#reply0)
挑战地址： https://www.shiyanlou.com/contests/lou5/challenges  可以找你擅长的题目试试身手： https://www.shiyanlou.com/contests/
[MySQL 获取随机数据方法](http://www.51ask.org/article/428)
推荐使用PHP解决。尽量少用mysql去处理问题。
交给php解决 不操作mysql 比如 一千w条数据 随机取十条 先用php生成一千万以内的随机数 20个 再用mysql的主键in(这20个随机数) 之所以取20条是因为有些id可能被删除了 然后再用php处理成10条。性能最高
[农民房设计服务，「求设计」新站上线](https://www.v2ex.com/t/356294#reply46)
 https://qiusheji.com
[命令行传参的时候, 请问如何防止参数带有特殊符号，使得整行命令 broke](https://www.v2ex.com/t/349792#reply9)
但是当密码带有$符号的时候，整行命令就 broken 
防止 argumen 里面注入非法字符有 2 种， 
1. 在每个非法字符前面用\转义。 
2. 用单引号'' 来包裹 argument 。
> echo $var 

> export var=passwd 
> echo $var 
passwd 
> echo \$var 
$var 
> echo "$var" 
passwd 
> echo '$var' 
$var
[css让页面动起来](https://www.v2ex.com/t/353955)
https://daneden.github.io/animate.css/  http://www.coolshell.cn/ 可以把 high 一下 拖到书签位置，然后打开其他网站再点击书签，同样有效
https://gist.github.com/devn/5007287 
javascript:setInterval(() => {document.querySelectorAll('p,img,button,h1,h2,h3').forEach(x=>x.style=`transform:rotate(${Math.random()*777}deg) scale(${Math.random()*3}); transition:all 500ms`)}, 500);
[wechat-go 微信机器人](https://www.v2ex.com/t/356399#reply31)
https://github.com/songtianyi/wechat-go
[懒得找-程序员购衣导航网](https://www.v2ex.com/t/356359#reply12)
目前网站雏形见： http://www.landezhao.com/ 
[科学上网管理系统正式开源  PHP 技术栈 ](https://www.v2ex.com/t/355402#reply50)
BiliBili 解析 下载 合并 一条龙服务 

https://github.com/XhstormR/GetBilibili
 
[微信指数多词对比查询工具](https://www.v2ex.com/t/352709#reply9)
 http://wx.quafelabs.com/wxIndex 

Github 地址： https://github.com/ZhuFaner/shadowsocks-manage-system
[ 基于 yourls 搭建的短网址服务](https://www.v2ex.com/t/353705#reply84)
https://u.nu/ 

API 文档在这儿 

https://u.nu/api/ 
[给自己挖了一个 Python 爬虫系列的坑](https://www.v2ex.com/t/353080#reply19)
[开源 PHP 图床程序](https://www.v2ex.com/t/353270#reply35)
演示地址： https://famio.liew.io 
Git ： https://git.oschina.net/famio/wocreat 
[Mobi.css 2 发布 beta 版，一个轻量、可拓展、移动端优先的 css 框架](https://www.v2ex.com/t/352809#reply15)
[ Tiicle 一个程序员分享编程知识和协作的平台](https://www.v2ex.com/t/352855#reply15)
https://tiicle.com/
[第二篇爬虫文章](https://www.v2ex.com/t/352150#reply20)
[耀眼的 404 页面](https://www.v2ex.com/t/352105#reply78)
[PHP 写了一个管理本地 Nginx 网站配置文件的命令行小工具](https://www.v2ex.com/t/352420#reply6)

https://github.com/panlatent/site-cli 
[视频专辑《如何提高生产效率目录》](https://www.v2ex.com/t/352396#reply14)
http://www.findspace.name/easycoding/1890
[Python 下发送邮件的库](https://www.v2ex.com/t/351693#reply8)
```js
from Smail import Smail
a=Smail()
#设置邮件服务期信息，包含 smtp 地址，端口，登录账号和密码，如果端口不是 25 就启用 SSL 。 
a.set_server("smtp.exmail.qq.com",465,"admin@aliencn.net","password")
#写一个主题  
a.set_subject('hello')  
#写邮件内容，默认情况下邮件是 plain 的格式，如果要切换成 html 的可以执行 a.set_mail_type('html')
a.set_content('world') 
#添加收件人，可以添加多个
a.add_to_addr('admin@aliencn.net')  
a.add_to_addr('admin2@aliencn.net')  
#Optional
#接下来就是可选项了，比如添加抄送、密送、附件什么的
a.add_cc_addr('admin1@aliencn.net')  
a.add_cc_addr('admin2@aliencn.net')  
a.add_bcc_addr('admin3@aliencn.net')  
a.add_bcc_addr('admin4@aliencn.net')  
a.add_attachment(r'D:\Alien_System\Desktop\0.jpg')  
a.add_attachment(r'D:\Alien_System\Desktop\1.exe')  
 
#send mail now
#最后一步，发送邮件
a.send()
```
[ mysql 中文排序的问题，就是某一列是有“高”、“中”、“低”三种值，然后我怎么才能 orderby 出高中低的效果](https://www.v2ex.com/t/350941#reply16)
 order by decode ，然后搜索到 MySQL 的， ORDER BY FIND_IN_SET(FieldName,"高,中,低")


[阿里云代码](https://code.aliyun.com/)
[pdf 文件转成 html 文件](https://github.com/coolwanglu/pdf2htmlEX)
[GitHub 与 Python 有关的 repo 集合](https://www.v2ex.com/t/350802#reply7)
[从事摄影后期的人要失业了](https://github.com/luanfujun/deep-photo-styletransfer)
[开源项目——HelloGitHub](https://www.v2ex.com/t/351587#reply39)
[简书上写 Python 爬虫系列文章](https://www.v2ex.com/t/351900#reply80)
http://www.jianshu.com/p/11d7da95c3ca  https://blog.ansheng.me/article/python-full-stack-way/
[开坑一个从零开始的 Python 爬虫教程](https://www.v2ex.com/t/351442#reply47)
http://www.jianshu.com/p/e3444c52c043
[CodePan: 能够离线使用的 JSBin/CodePen](https://www.v2ex.com/t/351601#reply4)
网站: https://codepan.js.org
 V2 签到脚本 

https://github.com/bonfy/qiandao
代码: https://github.com/egoist/codepan
[MarkDown 文档帮助系统](https://www.v2ex.com/t/348636#reply6)
https://elvisszhang.github.io/jr-docs/
[基于命令行的网易云音乐下载器](https://www.v2ex.com/t/348005#reply3)
https://github.com/ziwenxie/netease-dl

[支付宝收款明细检查工具](https://www.v2ex.com/t/347913#reply20)
[Composer 的源管理工具 slince/crm](https://www.v2ex.com/t/347603#reply5)
http://0.30000000000000004.com/ composer global require slince/crm

[支付宝 alipay-sdk- PHP](https://www.v2ex.com/t/348451#reply31)
https://github.com/wxpay/WXPay-SDK-PHP   https://github.com/fishlab/alipay-sdk-php
```js
经实践，最终我的做法是： 
1 、在 vendors 下新建 alipay 
2 、把 SDK 里的 aop 目录拷到 alipay 下（抛弃原来 SDK 目录下的 lotusphp_runtime 和 AopSdk.php ） 
3 、最终目录结构是 vendors/alipay/aop 
4 、 composer.json 的 autoload 节点里加入： 

"classmap": [ 
"vendor/alipay/aop" 
]
5 、运行``composer dump-autoload`` 
6 、这样在项目里可以不用 require ，直接： 

// 仅测试能使用命名空间，忽略参数设置吧。。。 
$a = new \AopClient(); 
$b = new \AlipayAppTokenGetRequest(); 
$c = $a->execute($b);
```
[拉勾的爬虫](https://www.v2ex.com/t/346862#reply13)
https://github.com/whatsGhost/lagou_spider  
[root 防撤回 微信 QQ](https://www.v2ex.com/t/347634#reply56)
http://github.com/JasonQS/Anti-recall 
[ PHP 循环获取用户关系树的性能问题](https://www.v2ex.com/t/347529#reply31)
[循环超过 5000 条时，页面就不动了，内存都用完了](https://www.v2ex.com/t/346901#reply29)


[PHP 写的验证码类](https://www.v2ex.com/t/347730#)
传送门： https://github.com/sostuts/Vcode
[创业公司安全基础](https://github.com/Hopsken/security-101-for-saas-startups-zh_CN)

[Nginx+ PHP -fpm 运行原理详解](https://www.v2ex.com/t/351308#reply6)
[Chrome 扩展一枚： ToolCat 开发者常用工具](https://www.v2ex.com/t/349791#reply10)
http://tool.leavesongs.com/
[Python企查查爬虫](http://pituber.com/t/python/42)
[各语言常用工具库及资料【爬虫相关】](http://pituber.com/t/topic/131)
[传送门这个网站采集了大量的微信公众号文章](https://www.v2ex.com/t/349562#reply24)
http://www.tianfangyetan.org/ http://phptools.cn ，还集成了一个 google 镜像
[创建联动选择器的 js 库](https://www.v2ex.com/t/349215#reply4)
https://jsfiddle.net/lmk123/8d2x8dLy/
[玩法收藏/云服务器/Python3 环境安装 PySpider 爬虫框架](https://www.v2ex.com/t/349209#reply4)
pip install pyspider

[Composer Packagist 镜像搭建工具](https://www.v2ex.com/t/345641#reply3)
https://github.com/garveen/imagist
[做了一个标题党制作器](https://www.v2ex.com/t/346036#reply29)
[简单生成 Excel2007 xlsx 文档的 PHP 类，主要解决了内存占用问题](https://www.v2ex.com/t/345939#reply2)
https://github.com/chopins/toknot/blob/master/vendor/toknot/Toknot/Share/SimpleXlsx.php

图片小站，堪称宅男神奇。 http://www.chihepiao.com （吃喝嫖全拼）

[在线 markdown 转 html 的小工具， http://md2html.net/ ](https://www.v2ex.com/t/345076#reply23)
curl ifconfig.cat 
wget -q ifconfig.cat 
http -b ifconfig.cat ifconfig.io
[面试问什么问题比较容易看出一个 PHPer 的水平](https://www.v2ex.com/t/344137#reply36)
服务器抓包 HTTP 的工具https://www.v2ex.com/t/343223#reply25
又一个图床 https://ooxx.ooo
github 上比较火的一篇软件设计模式的介绍https://github.com/questionlin/design-patterns-for-humans  https://sourcemaking.com/design-patterns-and-tips 
撸了一个导航网站 喜欢个人博客的进来啦https://www.v2ex.com/t/343011#reply108   传送门： http://blog.yiyeti.cc/ 
[JSON 格式化工具](http://json.awesomes.cn/)
Laravel+Vue 前后端分离 https://www.v2ex.com/t/342281#reply21
web 移动端原生裁剪插件https://github.com/ffx0s/xcrop  Talk is cheap, show me the code -- 用 github 数据辅助你完善简历 https://www.v2ex.com/t/341669#reply38  php面试题 https://www.v2ex.com/t/341873#reply72  https://www.onlinevideoconverter.com/zh 
https://www.youtubeto.com/zh/ 
http://savevideo.me/
翻译了开源书籍 《 Python 数据结构》一书 https://www.v2ex.com/t/340583#reply100 
借助微信测试公众号撸了个 服务器信息推送https://www.v2ex.com/t/340512#reply26
https://github.com/iakisey/ServerMsgPush  发企业号文本消息的 Shell 脚本, 十几行代码搞定. 需要自取. 
https://github.com/x1596357/scripts/blob/master/alert-wechat/alert-wechat.sh  https://github.com/boywhp/fcn  内网穿透的软件
网址收藏应用： http://mybookmark.cn/  开源图床上传工具 [File to URL]https://www.v2ex.com/t/338814#reply42
[PHP 就碰到 PDO 扩展的一个大坑，详情](https://segmentfault.com/q/1010000008305175)
[关于Python的面试题](https://github.com/taizilongxu/interview_python)
PHPMailer 封装，让发邮件更简单https://www.v2ex.com/t/342029#reply6 
[ awesome-backend 收集展示后端开发相关组件和解决方案](https://www.v2ex.com/t/351248#reply0)
Github: https://github.com/sunchen009/awesome-backend
[不错的在线简历模板，如果有需要可以直接拿去用](https://www.v2ex.com/t/351441#reply26)
git clone --recursive https://github.com/onevcat/resume.git
[python免费代理工具，目前来说有用不完的代理 ](https://github.com/awolfly9/IPProxyTool)
[PHP 开源实战主题： PDF 处理类 pdfparser](https://www.v2ex.com/t/351278#reply0)
PDF 处理类 http://www.pdfparser.org/demo
[包学会之浅入浅出 Vue.js](https://www.v2ex.com/t/353120#reply55)
https://www.qcloud.com/community/article/430630001490779316?fromSource=gwzcw.84430.84430.84430
[应对“伸手党”的网站](https://www.v2ex.com/t/354605#reply65)
帮你百度googlehttp://lmgtfy.com/   http://www.baidu-x.com/  http://lmbtfy.cn/ https://shansing.com/lmbtfy/  http://www.lmbtfy.cn/ 
http://lmgtfy.com/
[一个假的苹果网站，能肉眼看出来算我输](https://www.v2ex.com/t/355961#reply80 )
https://www.xn--80ak6aa92e.com/  http://chuangzaoshi.com/friends
[个人博客](https://www.v2ex.com/t/354131#reply47)
[爬取查询百度指数的教程](http://blog.shenjianshou.cn/?p=170)
[Laravel 写了一个图床网站](https://www.v2ex.com/t/353720#reply74)
改成 https://sm.ms 的图床  体验地址： http://img.hanc.cc/ 项目地址： https://github.com/HanSon/img


[Vue 第一次练手： github-issue 博客生成方案](https://www.v2ex.com/t/355274#reply13)
[方正字库开放云平台](http://yun.foundertype.com/)
[Python 分布式抓取京东商城评价并且使用 pandas](https://www.v2ex.com/t/356132#reply22)
体验地址：http://awolfly9.com/jd/
[解析 Excel 文件(xls,xlsx)的 javascript 方案](https://github.com/SheetJS/js-xlsx)
[防不胜防的钓鱼网址](https://www.v2ex.com/t/355174#reply204)
Chrome 插件来防止被钓鱼, 希望对 V 友有用. 

下载地址: https://chrome.google.com/webstore/detail/real-domain-name/lhbkkikjboiebjeghokpefafaahnfoff 
GitHub: https://github.com/liaa/real_domain_name 
[Python 3 写了个基于 selenium 的知乎关键词爬虫，可以爬钓鱼贴图片]()
[《收库 123·导航网》](https://www.v2ex.com/t/355344#reply19)
官网网址： http://shouku123.com/  http://123.xcatliu.com/  chuangzaoshi.com  撸表情 http://www.lubiaoqing.com  http://www.alloyteam.com/nav/
[下载微博、秒拍视频](http://v.atob.site/)
[基于 laravel 的一个后台管理系统](https://www.v2ex.com/t/355936#reply28)
https://github.com/AnyISalIn/zhihu_fun 


[编解码小工具](https://www.v2ex.com/t/349150#reply1)
http://tool.leavesongs.com/
[一个解除网页“禁用复制”的小书签](https://www.v2ex.com/t/356477#reply7)
https://github.com/yulanggong/celery 
[Python 密码泄露查询模块 leakPasswd](https://www.v2ex.com/t/355641#reply19)
[百度网盘爬虫](https://www.v2ex.com/t/348731)
[blibili 直播换成 HTML5 播放器的油猴脚本](https://www.v2ex.com/t/339625)
安装地址： https://greasyfork.org/zh-CN/scripts/27239  DPlayer ： https://github.com/DIYgod/DPlayer
[PHP 写一个爬虫](https://www.v2ex.com/t/347589)
gouchaoer 同学的爬虫经验分享： https://www.v2ex.com/t/324309 

另外可以看下这个： https://github.com/owner888/phpspider https://github.com/slince/spider 分分钟教你做人。 https://querylist.cc/ 靠谱简单的 https://github.com/FriendsOfPHP/Goutte https://doc.phpspider.org/
分分钟搞定一个爬虫程序 https://www.figotan.org/2016/08/10/pyspider-as-a-web-crawler-system/
 这种简单验证码识别率应该可以达到 100%  https://gist.github.com/liberize/79f9bfb5a7e767b4b756ff1c7dc04eaa
[php 敏感词过滤 php-ext-trie-filter](http://www.51ask.org/article/421)
[将页面内容输出为 pdf 文档](https://www.v2ex.com/t/356363)
TCPDF 分页 
Mpdf 完美 html 排版 
PHP 生成 PDF ： http://www.51ask.org/article/232
http://pdftest.xieyi.im/ https://github.com/MrRio/jsPDF 
phantomjs 挺好的啊。有现成的 example https://github.com/ariya/phantomjs/blob/master/examples/rasterize.js

chrome 浏览器 选择内容 右键-打印 保存到 pdf 效果不错啊 可以分页啊 
有其他需求就 acrobat 有浏览器插件
 https://github.com/wkhtmltopdf/wkhtmltopdf
 
 [猴子选大王](http://www.51ask.org/article/406)
 ```js
 /**
* 猴子选大王
*一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。
* @param int $m 猴子数
* @param int $n 出局数
* @return array
*
*/
function ws_king($m ,$n)
{
//构造数组
for($i=1 ;$i<$m+1 ;$i++){
   $arr[] = $i ;
}
$i = 0 ;    //设置数组指针

while(count($arr)>1)
{
   //遍历数组，判断当前猴子是否为出局序号，如果是则出局，否则放到数组最后
   if(($i+1)%$n ==0) {
    unset($arr[$i]) ;
   } else {
    array_push($arr ,$arr[$i]) ; //本轮非出局猴子放数组尾部
    unset($arr[$i]) ;   //删除
   }
   $i++ ;
}
return $arr ;
}

var_dump(ws_king(6,4));
 ```
[ mysql 优化整理](http://blog.csdn.net/gaoxuaiguoyi/article/details/47439331)


```js
/**
 *@功能：获取客户端的代理IP地址,很容易被程序篡改http://www.51ask.org/article/372
 *@参数：null
 *@返回：客户端的IP地址
 */
function get_proxy_ip()
{
    $arr_ip_header = array(
        'HTTP_CDN_SRC_IP',
        'HTTP_PROXY_CLIENT_IP',
        'HTTP_WL_PROXY_CLIENT_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR',
    );
    $client_ip = 'unknown';
    foreach ($arr_ip_header as $key)
    {
        if (!empty($_SERVER[$key]) && strtolower($_SERVER[$key]) != 'unknown')
        {
            $client_ip = $_SERVER[$key];
            break;
        }
    }
    return $client_ip;
}
count(column) 是表示结果集中有多少个column字段不为空的记录。

　　count(*) 是表示整个结果集有多少条记录。

拆分大的 DELETE 或 INSERT 语句
while (1) { 
    //每次只做1000条 
    mysql_query("DELETE FROM logs WHERE log_date <= '2009-11-01' LIMIT 1000"); 
    if (mysql_affected_rows() == 0) { 
        // 没得可删了，退出！ 
        break; 
    } 
    // 每次都要休息一会儿 
    usleep(50000); 
} 
应尽量避免在where子句中对字段进行函数操作，这将导致mysql放弃使用索引

          select uid from imid where datediff(create_time,'2011-11-22')=0
            优化后
           select uid from imid where create_time> ='2011-11-21‘ and create_time<‘2011-11-23’;
$user = User::create($createArr);
        $name = 'v'.$user->id;
        $user->name = $name;
        $user->save();
```
[PHP类延迟加载机制原理](http://blog.csdn.net/gaoxuaiguoyi/article/details/49622155)
```js
//1.不使用类延迟加载  
      
    require 'class/Class1.php';  
    require 'class/Class2.php';  
      
    $c1 = new Class1;  
    $c2 = new Class2;  
    $c1->say();  
    $c2->say();  
      
    //2.使用类延迟加载  
      
    function autoload($class){  
          
        require ('class/'.$class.'.php');  
          
    }  
    spl_autoload_register("autoload");  
      
      
    $c1 = new Class1;  
    $c2 = new Class2;  
    $c1->say();  
    $c2->say(); 
    实例化一个PHP类的时候，new class这个过程如果没有包含类文件活报出警告信息，没有包含该类文件，但是这个时候，会去执行spl_autoload_register这个函数，执行之后，会将我们new的类名传递过去，进行包含我们的类文件，这样就是我们在使用的时候才去加载需要的类，而不是无论是否使用都进行加载
```

[laravel的依赖注入http://blog.csdn.net/gaoxuaiguoyi/article/details/50042829]()
```js
public function register()  
 {          
     //$this->app->bind(App\Services\IUserService::class, App\Services\IUserServiceImpl::class);  
 //单例模式创建对象  
     $this->app->singleton('\App\Services\IUserService', function()  
             {  
                 return new \App\Services\IUserServiceImpl();  
             });  
 } 
 /** 
 * 控制器 
 */  
class UserController extends Controller{  
 private  $UserService;  
//注入接口的实例对象IUserServiceImpl,其实laravel框架帮助我们实现了 IUserService  $service = new IUserServiceImpl();这一步。  
 public function __construct(IUserService $service){  
   
  $this->UserService = $service;  
  
 }  
```
[适配器模式的优点既没有修改原来的类，又扩展了原来的类](http://blog.csdn.net/gaoxuaiguoyi/article/details/62991893)
```js
class OldClient  
{  
  
    public function oldRequest()  
    {  
  
        echo '老方法不满足现在的需求<br/>';  
    }  
  
}  
  
/** 
 * 新的需求接口 
 * Interface Target 
 */  
interface Target  
{  
  
    public function newRequest();  
  
}  
  
  
class Adapter extends OldClient implements Target  
{  
    public function newRequest()  
    {  
  
        echo '新方法满足现在的需求';  
    }  
  
}  
//测试  
$Adapter1 = new Adapter();  
$Adapter1->oldRequest();  
$adapter = new Adapter();  
$adapter->newRequest(); 
```
[ PHP工厂模式和单例模式](http://blog.csdn.net/gaoxuaiguoyi/article/details/50859596)
```js
namespace Factory;  
  工厂模式的好处就是我们创建对象的方法是统一的，不是在我们需要的地方直接使用new进行创建，降低了模块之间的耦合度，并且当我们修改了类的名称我们只需要在工厂类里面修改一处即可完成。
单例模式好处是我们使用对象的时候不是每次使用都去new一个新对象出来，这样造成很大的开支和浪费，单例模式保证我们程序运行过程中对象产生一次，节省了开支。
  
class ObjectFactory {  
  
    /** 
     * 工厂模式 
     */  
  
    public static function createObject(){  
  
  
        $obj = Object::getInstance();  
  
          
      return $obj;  
    }  
  
}  

spl_autoload_register('autoload');  
  
function autoload($className){  
  
  
    $classFile = ROOT.'/'.str_replace('\\','/',$className).'.php';  
  
    include $classFile;  
  
} define('ROOT',__DIR__);  
  
  require 'autoload.php';  
  
  $obj =  Factory\ObjectFactory::createObject();  
  
  $obj->say();
  //这个控制器直接在根目录下面，如果定义的控制器又加了一层文件夹的话可以使用namespace进行控制 Route::group(['namespace'=>'xxxxx','middleware'=>['checkuser','dealuser']]);

Route::group(['middleware'=>['checkuser','dealuser']],function(){

    Route::post('user/addUser','UserController@postAdduser');
});
```
[PHP实现双端队列](http://blog.csdn.net/gaoxuaiguoyi/article/details/45723757)
```js
class Deque    
{   
    public $queue = array();   
      
    /**（尾部）入队  **/   
    public function addLast($value)    
    {   
        return array_push($this->queue,$value);   
    }   
    /**（尾部）出队**/   
    public function removeLast()    
    {   
        return array_pop($this->queue);   
    }   
    /**（头部）入队**/   
    public function addFirst($value)    
    {   
        return array_unshift($this->queue,$value);   
    }   
    /**（头部）出队**/   
    public function removeFirst()    
    {   
        return array_shift($this->queue);   
    }   
    /**清空队列**/   
    public function makeEmpty()    
    {   
        unset($this->queue);  
    }   
      
    /**获取列头**/  
    public function getFirst()    
    {   
        return reset($this->queue);   
    }   
   
    /** 获取列尾 **/  
    public function getLast()    
    {   
        return end($this->queue);   
    }  
   
    /** 获取长度 **/  
    public function getLength()    
    {   
        return count($this->queue);   
    }  
      
}  
```
[ PHP csv大量数据导出分割处理](http://blog.csdn.net/gaoxuaiguoyi/article/details/47108129)
```js
后台管理系统总是成百万的数据导出，使用excel导出根本不能实现，excel只支持65536，2007和2010的是1048576，所以无论哪一种都不能满足需求，csv就符合需求，
 error_reporting(0);  
        header ( "Content-type:application/vnd.ms-excel" );  
                header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", "topic" ) . ".csv" );      
        //连接数据库   
        $link = mysql_connect('localhost','root','root') or die('连接错误');  
            //选择数据库  
            mysql_select_db("bbs",$link);  
            //设置字符集  
            mysql_query("set names utf8");  
            //查询函数  
            function get_res($sql,$link){  
                  
                $res  = mysql_query($sql,$link);  
                  
                if(!$res){  
                      
                    die("操作失败".mysql_error());  
                }  
                $arr=array();  
                while ($row = mysql_fetch_assoc($res)) {                
                        $arr[]=$row;  
                    }  
                return $arr;  
            }  
            //查询记录总数  
            function getTotalCount(){  
                  
                $result = mysql_query("SELECT count(*) as count FROM medsci_edu_public_medsciedu_topic", $link);  
                  
                return $result['count'];  
            }  
               // 打开PHP文件句柄，php://output 表示直接输出到浏览器  
                $fp = fopen('php://output', 'a');   
                //表头  
        $column_name = array('topic_id','cat_id','user_id','is_best','is_top','topic_title',  
                 'topic_content','topic_img','hits','total_reply_count','created_time','last_updated_time','topic_status','last_reply_name');  
                // 将中文标题转换编码，否则乱码  
              foreach ($column_name as $i => $v) {    
                   $column_name[$i] = iconv('utf-8', 'gbk', $v);    
              }  
        // 将标题名称通过fputcsv写到文件句柄    
              fputcsv($fp, $column_name);  
              $pagecount = 10000;//一次读取多少条  
        $totalcount = getTotalCount();//总记录数  
        $sql = "select * from medsci_edu_public_medsciedu_topic";  
           for ($i=0;$i<intval($totalcount/$pagecount)+1;$i++){  
            $data = get_res($sql." limit ".strval($i*$pagecount).",{$pagecount}",$link);  
            foreach ( $data as $item ) {  
                $rows = array();  
                foreach ( $item as $v){  
                    $rows[] = iconv('utf-8', 'GBK', $v);  
                }  
                fputcsv($fp, $rows);  
            }  
            // 将已经写到csv中的数据存储变量销毁，释放内存占用  
            unset($data);  
            //刷新缓冲区  
            ob_flush();  
            flush();  
        }  
    exit;  
```

[CURL下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47104945)
```js
$url = 'http://pic1.nipic.com/2008-09-08/200898163242920_2.jpg';    
    
    function http_get_data($url) {    
            
        $ch = curl_init ();    
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );    
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );    
        curl_setopt ( $ch, CURLOPT_URL, $url );   
        //打开输出控制缓冲  
        ob_start ();    
        curl_exec ( $ch );    
        //返回输出缓冲区的内容  
        $return_content = ob_get_contents ();   
        //清空（擦除）缓冲区并关闭输出缓冲  
        ob_end_clean ();    
            
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );    
        return $return_content;    
    }    
        
    $return_content = http_get_data($url);    
    $filename = 'my.jpg';    
    $fp= @fopen($filename,"a"); //将文件绑定到流  
    fwrite($fp,$return_content); //写入文件
```

[PHP手机获取6为不重复验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/46621971)
```js
//存数字数组  
                $code = array();  
           
         while(count($code) < 6){  
             //产生随机数1-9  
             $code[] = rand(1,9);  
                         //去除数组中的重复元素  
                         $code = array_unique($code);  
         }  
         echo "<pre>";  
         print_r($code);  
```

[ laravel事件创建以及使用](http://blog.csdn.net/gaoxuaiguoyi/article/details/50043021)
```js
5.0版本的还可以使用2条命令进行生成事件，还可以分开执行创建事件。
php artisan make:event PupUserchange（事件的类名）
php artisan handler:event UserManagerd(事件处理类) --event=PupUserchange

protected $listen = [  
       'App\Events\SomeEvent' => [  
           'App\Listeners\EventListener',  
       ],  
       'App\Events\PupUserchange'=>[  
       'App\Handlers\Events\UserManagerd'  
       ],  
   ];  
   php artisan event:generate
   Event::fire(new PupUserchange(Users::find(2)));
```
[PHP二维数组根据某个元素去重](http://blog.csdn.net/gaoxuaiguoyi/article/details/53127386)
```js
function array_unset_tt($arr,$key){     
        //建立一个目标数组  
        $res = array();        
        foreach ($arr as $value) {           
           //查看有没有重复项  
           $tmp = array();  
           if(isset($res[$value[$key]])){  
                 //有：销毁  
                  
                 unset($value[$key]);  
                   
           }  
           else{  
                  
                $res[$value[$key]] = $value;  
           }    
        }  
        return $res;  
    }  
    $arr = array(  
              
            array(  
            'title'=>'1111','date'=>'ddddd'  
                  
            ),  
            array('title'=>'22222','date'=>'fffffff'),  
            array('title'=>'1111','date'=>'ggggggg')  
);  
$newArr = array_unset_tt($arr,'title');  
echo '<pre>';  
  
print_r(array_values($newArr));  
//本月第一天  
$beginDate = date('Y-m-01', strtotime(date("Y-m-d")));  
//本月最后一天  
$endDate = date('Y-m-d', strtotime("$beginDate +1 month -1 day"));  
$begintime = strtotime($beginDate);  
$endtime = strtotime($endDate);  
//输出每一天  
for ($start = $begintime; $start <= $endtime; $start += 24 * 3600)  
{  
        echo date('Y-m-d',$start).'<br>';  
}  
```
[PHP self与static区别](http://blog.csdn.net/gaoxuaiguoyi/article/details/49758757)
```js
class Boo {  
        
      protected static $str = "This is class Boo";  
      /* 
      public static function get_info(){ 
           
          echo get_called_class()."<br>"; 
          echo self::$str; 
      }  
      */  
      public static function get_info(){  
            
          echo get_called_class()."<br>";  
          echo static::$str;  
      }   
        
  }  
  class Foo extends Boo{  
        
      protected static $str = "This is class Foo";  
        
  }  
    
    
   Foo::get_info(); 
   大概意思是说self调用的就是本身代码片段这个类，而static调用的是从堆内存中提取出来，访问的是当前实例化的那个类，那么 static 代表的就是那个类，例子比较容易明白些。

其实static就是调用的当前调用的类，比较抽象吧。
```
[PHP 按一定比例压缩图片，保持清晰度](http://blog.csdn.net/gaoxuaiguoyi/article/details/49592151)
```js
 class Image{  
         
       private $src;  
       private $imageinfo;  
       private $image;  
       public  $percent = 0.1;  
       public function __construct($src){  
             
           $this->src = $src;  
             
       }  
       /** 
       打开图片 
       */  
       public function openImage(){  
             
           list($width, $height, $type, $attr) = getimagesize($this->src);  
           $this->imageinfo = array(  
                  
                'width'=>$width,  
                'height'=>$height,  
                'type'=>image_type_to_extension($type,false),  
                'attr'=>$attr  
           );  
           $fun = "imagecreatefrom".$this->imageinfo['type'];  
           $this->image = $fun($this->src);  
       }  
       /** 
       操作图片 
       */  
       public function thumpImage(){  
             
            $new_width = $this->imageinfo['width'] * $this->percent;  
            $new_height = $this->imageinfo['height'] * $this->percent;  
            $image_thump = imagecreatetruecolor($new_width,$new_height);  
            //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度  
            imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);  
            imagedestroy($this->image);    
            $this->image =   $image_thump;  
       }  
       /** 
       输出图片 
       */  
       public function showImage(){  
             
            header('Content-Type: image/'.$this->imageinfo['type']);  
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image);  
             
       }  
       /** 
       保存图片到硬盘 
       */  
       public function saveImage($name){  
             
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image,$name.'.'.$this->imageinfo['type']);  
             
       }  
       /** 
       销毁图片 
       */  
       public function __destruct(){  
             
           imagedestroy($this->image);  
       }  
         
   }  
   
   $src = "001.jpg";  
        $image = new Image($src);  
        $image->percent = 0.2;  
        $image->openImage();  
        $image->thumpImage();  
        $image->showImage();  
        $image->saveImage(md5("aa123"));
```
[PHP使用Screw把源代码加密](http://blog.csdn.net/gaoxuaiguoyi/article/details/53466860)
https://sourceforge.net/projects/php-screw/files/php-screw/
find ./ -name "*.php" -print|xargs -n1 screw //加密所有的.php文件
find ./ -name "*.screw" -print|xargs -n1 rm //删除所有的.php源文件的备份文件
[PHP实现验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/48805451)
get参数进行urlencode转换一下，数据可以正确显示了 使用urlencode进行转换之后  &变成十六进制的%26  空格会变成+  如果使用rawurlencode 空格变成%20：
[PHP多线程读写文件操作](http://blog.csdn.net/gaoxuaiguoyi/article/details/48731035)
[PHP二维数组根据某个数组元素排序](http://blog.csdn.net/gaoxuaiguoyi/article/details/48261653)
```js
$grade = array("score" => array(70, 95, 70.0, 60, "70"),
"name" => array("Zhang San", "Li Si", "Wang Wu",
"Zhao Liu", "Liu Qi"));
array_multisort($grade["score"], SORT_NUMERIC, SORT_DESC,
// 将分数作为数值，由高到低排序
$grade["name"], SORT_STRING, SORT_ASC);
// 将名字作为字符串，由小到大排序
var_dump($grade);
```
[PHP读取大文件小技巧](http://blog.csdn.net/gaoxuaiguoyi/article/details/47951115)
```js
ini_set('memory_limit','-1');  
$file = 'access.log';  
$data = file($file);  
$line = $data[count($data)-1];
$fp = fopen($file, "r");  
$line = 10;  
$pos = -2;  
$t = " ";  
$data = "";  
while ($line > 0) {  
    while ($t != "\n") {  
        fseek($fp, $pos, SEEK_END);  
        $t = fgetc($fp);  
        $pos --;  
    }  
    $t = " ";  
    $data .= fgets($fp);  
    $line --;  
}  
fclose ($fp);  
echo $data  

如果 t2.column1 的值是 NULL 的话，WHERE 子句的结果就是假了：

   SELECT * FROM t1 LEFT JOIN t2 ON (column1) WHERE t2.column2=5;

   因此，这就可以安全的转换成一个普通的连接查询：

  SELECT * FROM t1,t2 WHERE t2.column2=5 AND t1.column1=t2.column1;

  这查询起来就更快了，因为如果能有一个更好的查询计划的话，MySQL就会在 t1 之前就用到 t2 了。
```
[PHP安全下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47952443)
```js
$file_name = "pigcms.rar";     //下载文件名      
    $file_dir = "./file/";        //下载文件存放目录      
    //检查文件是否存在      
    if (! file_exists ( $file_dir . $file_name )) {      
        echo "文件找不到";      
        exit ();      
    } else {      
        //打开文件      
        $fp= fopen ( $file_dir . $file_name, "r" );      
        //输入文件标签       
        Header ( "Content-type: application/octet-stream" );      
        Header ( "Accept-Ranges: bytes" );      
        Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );      
        Header ( "Content-Disposition: attachment; filename=" . $file_name );      
        //输出文件内容       
        //读取文件内容并直接输出到浏览器      
        while(!feof($fp)) {  
                         set_time_limit(0);  
                         echo fread($fp,1024);  
                         flush();  
                         ob_flush();  
                    }   
     
        fclose ( $fp);      
        exit ();      
    }    
```
分批处理数据
```js
$count = 140000;
        $take = 2000;
        $s    = floor($count/$take);
	    for ($i =0 ;$i <= $s; $i++ ){
            $skip   = $take*$i;
            echo 'start ---'.$skip.'---'.$take."---\n";
            $ret = WebinarSwitch::groupBy('webinar_id')->skip($skip)->take($take)->get();
            if(!empty($ret)){
                $list = $ret->toArray();
                foreach ($list as $row){
                    $webinar = Webinars::withTrashed()->find($row['webinar_id']);
                    if(!empty($webinar)){
                        $sql = "update webinar_switch set user_id ='{$webinar['user_id']}' where webinar_id={$row['webinar_id']}; \n";
                        file_put_contents($file,$sql,FILE_APPEND);
                    }
                }
            }
        }
	
30分钟支付
$second = strtotime($order['created_at']) + 60*30 - time();
        if ($second>0) {
            $order['expire'] = date('i:s', $second);
        } else {
            $order['expire'] = '00:00';
        }
	
```
时间相差几天
```js
$a=new \Carbon\carbon()
 <Carbon\Carbon #00000000142cb4980000000048d664ed> {
       date: "2017-04-16 16:07:58.000000",
       timezone_type: 3,
       timezone: "PRC"
   }
 $d=$a->diff(new \carbon\carbon('2017-01-03 11:11:11'),true)
 <DateInterval #00000000142cb4a50000000048d665bd> {
       y: 0,
       m: 3,
       d: 13,
       h: 4,
       i: 56,
       s: 47,
       weekday: 0,
       weekday_behavior: 0,
       first_last_day_of: 0,
       invert: 0,
       days: 103,
       special_type: 0,
       special_amount: 0,
       have_weekday_relative: 0,
       have_special_relative: 0
   }
//输出js数组
  function consoleLog($data, $log = false)
    {
        // 数据预处理json
        if (is_string($data) && $preJsonMsg = json_decode($data, true)) {
            if (count($preJsonMsg) > 1) {
                $data = $preJsonMsg;
            }
        }

        $logFunc = $log ? 'console.log' : 'console.dir';

        if (is_array($data) || is_object($data)) {
            echo("<script>".$logFunc."(".json_encode($data).");</script>");
        } else {
            echo("<script>".$logFunc."('".$data."');</script>");
        }
    }
```
