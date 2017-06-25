[phpunit单元测试问题](https://segmentfault.com/q/1010000009911902)
[php 的 opcache 和最近的 php jit 有什么区别](https://segmentfault.com/q/1010000009911944)
Windows上如果PHP连接MySQL的host使用了localhost,改成127.0.0.1试试.因为Win7上my.ini里配置了bind-address=127.0.0.1,PHP用localhost连接会被卡1秒.
源代码(人认识)->字节码(解释器认识)->机器码(硬件认识)
来看下PHP的执行流程，假设有个a.php文件，不启用opacache的流程如下：
a.php->经过zend编译->opcode->PHP解释器->机器码
启用opacache的流程如下
a.php->查找opacache缓存，如果没有则进行zend编译为opcode并缓存->opacode->PHP解释器->机器码
启用jit的流程如下
a.php->编译->机器码
以后都只执行机器码，不编译，效率上高了很多
[php 记住密码登陆如何做安全](https://segmentfault.com/q/1010000009891388)
首先，登录成功了之后，随机生成一个MD5的hash值token（32位或者64位）；
然后，把这个token存入当前用户的表，然后给这个用户增加一个token字段和last_login_time字段；
把这个token返回让浏览器的cookie存储，设置一个最长时常，比如30天；
这三个过程的主要作用就是，last_login_time可以检查过期时间，过期时间到了之后，就更新这个token，另外，只要用户通过这个token登录成功就进行更新token，这样就能尽可能的保证安全。

每次用户访问网站的时候，检查cookie里是否有token，如果有token就去数据库查询数据，如果查到就直接登录成功了，也就省去了用户名和密码验证登录的阶段。

整套思想是这样，你也可以让前端把token存入localstorage
[504 Gateway Time-out之后，代码还会继续执行吗？](https://segmentfault.com/q/1010000009893442)
nginx 504 之后，php 还有可能会执行一段时间。具体看 nginx 的超时设置 和 php 的超时设置。
代码不会继续执行了，就是因为代码得不到请求，所以才会出现504Gateway Time-out
[PHP的链式调用](https://segmentfault.com/q/1010000009821945)
```js
class Api
{
    public function auth(){
        //quiet a few
        var_dump(222);
    }
    public function render(){
        //quiet a few
    }
}

class Site{
    static private $_api;

    public function api(){
        if(self::$_api != NULL) {
            var_dump(1);
            return self::$_api;
        }else {
            var_dump(2);
            self::$_api = new Api();
            return self::$_api;
        }
        
    }
}
说明第一次调用auth()进了api()的else执行语句，第二次调用render()进入if语句，说明返回的是同一个实例。

不管你调用多少次，返回的都是一个实例，这就是单例模式
$site = new Site();
echo $site->api()->auth();
echo $site->api()->render();
php如何返回值为000001而不是1 str_pad($number, 6, '0', STR_PAD_LEFT);
sprintf("%06d", $num);
过大浮点型数据比较大小https://segmentfault.com/q/1010000009860352
if(bcsub($a,$b,1)==0){
    echo '相等';
}
$a = 12345678912345678.8;
    $b = 12345678912345678.9;
    if (strval($a) == strval($b)) {
        echo '相等';
    }
```
[什么样的架构能防止表结构变动后程序运行错误？](https://segmentfault.com/q/1010000009855063)


[去除多维数组的最外层key 保留值](https://segmentfault.com/q/1010000009893220)
[接口 sign 被破解的可能性猜想](https://segmentfault.com/q/1010000009897364)
```js
//保密token串
$token = '249238jdush24hgdddf/sds_assd_&ssa23_sd';
//业务参数对开公开
$str = 'name=zhangsan&id=23';
//保密的签名算法
$sign = md5($str.$token);
只要你的token不被泄露，此方法不会有问题。
更加保密一点的方案是加上timestamp，比如大于600秒之外的请求全部无效。
$md51 = md5('QNKCDZO');
$a = @$_GET['a'];
$md52 = @md5($a);
if(isset($a)){
if ($a != 'QNKCDZO' && $md51 == $md52) {
    echo "nctf{*****************}";
} else {
    echo "false!!!";
}}
else{echo "please input a";}
```
[]()
[不超时的后台进程or守护进程or在若干小时后执行的cron进程](https://segmentfault.com/q/1010000009855040)
如果你的系统使用systemd，可以利用它的计时器systemd.timer来完成你的需求 文章里的at的at now + n units是一个很好的选择
[openssl linux 和 windows 下 密钥签名结果不一致](https://segmentfault.com/q/1010000009846914)
```js
echo aaaaa | openssl rsautl -sign -inkey xxxx.pem | openssl enc -base64
"echo aaaaa"输出的结果带回车，即“aaaaa\n”，要输出纯字符串“aaaaa”的话需要使用"echo -n aaaaa"，不确定是不是这个原因，仅供参考
在linux和windows输出时字符时的问题,在Linux上会追加\n,而在Windows上会追加\r\n。对于这种情况,可以使用python来进行兼容:

import base64
data = 'aaaaa'
base64.b64encode(data)
>>> 'YWFhYWE='
```
[foreach既然是操作原数组的副本，为什么这样写还能改变原数组呢](https://segmentfault.com/q/1010000009881240)
你加了&符号后不是使用的是原数组的拷贝。不加&符号确实是原数组的拷贝。加&符号相当于一个指针，把名字赋给它而已。所以你改变你新的数组，原来的数组也会改变。自 php 5 起，可以很容易地通过在 $value 之前加上 & 来修改数组的单元。此方法将以引用赋值而不是拷贝一个值。

<?php
$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
}
// $arr is now array(2, 4, 6, 8)
mysql可以承受下的確可以用全文索引。但個人建議假如這樣的搜索訪問量大的話還是使用sphinx比較好'
SELECT * from expert where(expert_name like '%迷糊%' and status= 1 ) OR FIND_IN_SET(40,keywords)
update user u,single s set u.user = '值', s.user = '值' where u.user = u.user and u.id = '条件'
[mysql查询](https://segmentfault.com/q/1010000009870691)
select name, sum(case when Course='Chinese' then Score end) as Chinese,
sum(case when type='Math' then Score end) as Math,
sum(case when type='English' then Score end) as English
from table1
group by name
[MySQL混合utf8 utf8mb4是否比纯utf8mb4更具优势？](https://segmentfault.com/q/1010000009853687)
```js
没有太多优势
因为utf8mb4仅在emoji等特殊字符的时候用到了4个字节存储
其余时候表现和mysql的utf8字符集是一样的, 存储汉字仍然是3个字节

(因为mysql的utf8字符集的单个字符的最大长度方面的实现是错误的, 所以才冒出个utf8mb4字符集出来, 实际上这个utf8mb4就是标准的utf8)

当然, 需要避免使用char, 改用varchar, 因为mysql的char列类型在utf8mb4下, 为了保证所有的数据都存的下, char将会占用字符数*4的字节数 (mysql的char列类型utf8将占用字符数*3的字节数), 以保证空间分配足够. 所以建议用可变长度varchar, 以节省空间. 可变长度消耗的存储空间为: 实际存储需要的字节数+1或2个字节表达的长度.

另外对于纯英文字符的列, 你可以另外考虑varbinary(可变长度binary)和binary列(适用于固定长度的英文字符, 例如密码哈希)类型, 性能比varchar略好, 因为这个存储二进制数据
```
[mysql主从，从库锁表会导致复制阻塞](https://segmentfault.com/q/1010000009875708)
主从同步是通过binlog进行的，从库有两个线程，一个负责接受binlog日志，一个负责解析日志将数据写入库中。所以主从同步一般是有一定的延时的。
至于读写锁的问题，写锁是排他的，读锁可以多次获得。在Innodb中，锁分为表锁、行锁和间隙锁，具体看你的操作，如果一个插入操作需要锁表，而这时有查询锁住了该表中的一行，自然是需要等待的。
[Python 怎么操作windows系统服务](https://segmentfault.com/q/1010000009881227)
```js
def listservices():
    import wmi
    c = wmi.WMI()
    for service in c.Win32_Service():
        #print(service.Caption,service.StartMode,service.State)
        print(service.Caption)     #名称
        print(service.StartMode)   #启动类型
        print(service.State)       #状态
if __name__=='__main__':
    listservices()
    
    import wmi
c = wmi.WMI()
for service in c.Win32_Service(Name="seclogon"):
  result, = service.StopService()
  if result == 0:
    print "Service", service.Name, "stopped"
  else:
    print "Some problem"
  break
else:
  print "Service not found"
```
[如何正则字符串中的所有汉字](https://segmentfault.com/q/1010000009861809)
pattern = re.compile(ur"[\u4e00-\u9fa5]")
print pattern.findall(s.decode('utf8'))
这里的decode('utf8')是怕s的值为类似\x66\x77\x88这样的Unicode散列。另外，需要注意compile()中ur修饰符，u为Unicode修饰符。

[python正则怎么提取域名](https://segmentfault.com/q/1010000009847289)
```js
正则表达式如何匹配重复出现的字符串https://segmentfault.com/q/1010000009828634
var s = 'aaabccc11fdsa';
var re = /(.)\1+/g;

console.log(s.match(re));
其中，正则表达式中.表示任意字符，\1表示第一个被匹配到的分组，+表示匹配前一个字符一次或一次以上
preg_match_all(
    '/(\w)\1+/i',
    'aaabccc11fdsa',
    $matches,
    PREG_PATTERN_ORDER
);
print_r($matches[0]);
(\w)匹配字母数字下划线即[a-zA-Z0-9_]
((\w)\2)匹配重复的字符，其中\2匹配分组number是2的分组，因为最外层有圆括号，所以number是2的分组就是前面\w匹配的字符
((\w)\2+)匹配重复出现2次或以上的字符
>>> import re
>>> str = 'aaabccc11fdsa'
>>> re.findall(r'((\w)\2+)', str)
[('aaa', 'a'), ('ccc', 'c'), ('11', '1')]
>>> [match[0] for match in re.findall(r'((\w)\2+)', str)]
['aaa', 'ccc', '11']

第一是用sys.path.append()方法，将当前目录添加到模块搜索的目录列表中，如sys.path.append(dir_path)
第二是将当前目录的路径添加到系统的PYTHONPATH环境变量里去

import json

str = '''
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "SaleEvent",
    "name": "10% Off First Orders",
    "url": "https://www.myvouchercodes.co.uk/coggles",
    "image": "https://mvp.tribesgds.com/dyn/oh/Ow/ohOwXIWglMg/_/mQR5xLX5go8/m0Ys/coggles-logo.png",
    "startDate": "2017-02-17",
    "endDate": "2017-12-31",
    "location": {
        "@type": "Place",
        "name": "Coggles",
        "url": "coggles.co.uk",
        "address": "Coggles"
    },
    "description": "Get the top branded fashion items from Coggles at discounted prices. Apply this code and enjoy savings on your purchase.",
    "eventStatus": "EventScheduled"
}</script>
'''

d = json.loads(re.search('({[\s\S]*})', str).group(1))
print d['location']['url']
```
[Python如何统计某一文件夹下文件数量](https://segmentfault.com/q/1010000009917433)
```js
tite = '......' #网页title中包含换行
print(re.findall('(?<=\<title\>).+?(?=\<)', title, re.S))

就是让你配置好环境变量而已. 如果你有一个项目叫做pythonCodes, 然后你要在系统属性->环境变量->path, 将你这个pythonCodes绝对路径加进去, 这样的话, 你在pythonCodes里面写python脚本, 例如command.py, 就能够直接通过win+R,然后通过输入command.py直接运行..
Python默认查找包的地方有以下几个：

Python安装目录下的site-packages目录
环境变量PYTHONPATH的目录
当前目录
sys.path.append(...)添加的目录（这个是临时的）
然而如果你只把包放在了C盘下面，那么它不属于任何一种情况，Python当然就找不到包了。除了sys.path.append()方法，上面方法中还有将C:\加到PYTHONPATH环境变量也是可以的。
XPath中变量用$somevariable语法即$符号加变量名，然后在xpath方法调用时传参变量值。
xpath中如何使用变量
>>> # `$val` used in the expression, a `val` argument needs to be passed
>>> response.xpath('//div[@id=$val]/a/text()', val='images').extract_first()
u'Name: My image 1 '
>>> import os
>>> DIR = '/tmp'
>>> print len([name for name in os.listdir(DIR) if os.path.isfile(os.path.join(DIR, name))])
http不只有get方法（请求头部+正文），还有head方法，只请求头部。
import re, requests

r = requests.get("http://...页面地址..")
p = re.compile(r'相应的正则表达式匹配')
image = p.findall(r.text)[0]  # 通过正则获取所有图片的url
ir = requests.get(image)      # 访问图片的地址
sz = open('logo.jpg', 'wb').write(ir.content)  # 将其内容写入本地
print('logo.jpg', sz,'bytes')
```
[]()
[这几个软件你可能没听过，但真的好用到爆！](https://zhuanlan.zhihu.com/p/27479267)
第一款神器叫Listary，这是一款文件搜索的工具。第二款神器叫图片助手，这是一款图片下载的工具。 第五个神器叫Listen1 ，这是知友stormzhang推荐的神器
文字云的工具，以前讲过叫tagul，现在改名叫WordArt，是一个在线文字云的生成网站第七个神器是 http://UZER.ME 这是一个云端的应用网站
[Python Selenium WebDriver简明指南](http://www.revotu.com/python-selenium-webdriver-concise-guide.html)
```js
等待元素动态加载完成
driver = webdriver.Firefox()
driver.implicitly_wait(10) # seconds
driver.get("http://somedomain/url_that_delays_loading")
myDynamicElement = driver.find_element_by_id("myDynamicElement")
```
[Python获取当前时间](http://www.revotu.com/how-to-get-current-time-in-python.html)
```js
import time
## 24 hour format
time.strftime("%H:%M:%S") # 输出 18:58:17
## 12 hour format
time.strftime("%I:%M:%S") # 输出 06:58:17
time.strftime("%Y-%m-%d") # 输出 2017-06-23
datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S") # 输出 2017-06-23 18:58:17
now = datetime.datetime.now() # 当前datetime，输出 datetime.datetime(2017, 6, 23, 19, 13, 43, 555000)
now.year                      # 年
now.month                     # 月
now.day                       # 日
now.hour                      # 时
now.minute                    # 分
now.second                    # 秒
now.isoformat() # Date and time in ISO format，输出 2017-06-23T19:16:21.835000
```
[把自己fork别人的仓库中的代码更新至最新版本？](https://segmentfault.com/q/1010000009818126)
```js
git remote add upstream 原作者仓库地址
此时再用 git remote -v 就可以看到一个origin是你的，另外一个upstream是原作者的。

其次 更新代码

使用git fetch upstream 拉去原作者的仓库更新。

使用git checkout master 切换到自己的master

使用 git merge upstream/master, merge或者rebase到你的master
```
[想导出微信的朋友圈怎么办？](https://www.zhihu.com/question/25026007/answer/183261557)
[shell脚本中怎么判断发行版](https://segmentfault.com/q/1010000009829086)
uname -a 会给出 Linux/Unix, 32/64 位等信息
lsb_release -a cat /proc/version cat /etc/*-release
[如何对api接口进行限流](https://segmentfault.com/q/1010000009874889)
既然问题的标签里有 laravel，那么现成的解决方案，我推荐，https://github.com/dingo/api，这个包有个特性 Rate Limiting，应该就是你要找的。

如果你要自己实现也简单的，根据 【user_id + 设备唯一码】做主键，访问次数存 redis，记录访问的次数，然后具体频率，次数，都看你实现策略了
http://blog.41ms.com/post/61.html
Nginx 模块limit_req_zone $binary_remote_addr zone=one:10m rate=1r/s;

[PHP 下载 url 远程图片](https://zhuanlan.zhihu.com/p/27484500)
```js
function download($url, $path = 'images/') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    $file = curl_exec($ch);
    curl_close($ch);
    $filename = pathinfo($url, PATHINFO_BASENAME);
    $resource = fopen($path . $filename, 'a');
    fwrite($resource, $file);
    fclose($resource);
}

作者：Jelly Bool
链接：https://zhuanlan.zhihu.com/p/27484500
来源：知乎
著作权归作者所有，转载请联系作者获得授权。
```
[PHP能做什么好玩的事？](https://www.zhihu.com/question/36157365/answer/187230179)
```js
基于Swoole,寥寥几行PHP代码就能轻松实现一个基于WebSocket(全双工通信)的聊天室.

server.php:
<?php
$ws = new swoole_websocket_server('0.0.0.0', 8080);
$ws->on('message', function($ws, $frame) {
	// 消息建议用JSON格式,这里为了方便示例,用普通字符串
	$msg = '<p>From ' . $frame->fd. ':<br><b>' . $frame->data . '</b><br>时间: ' . date('Y年m月d日 H:i:s') . '</p>';
	// 广播: 发送消息给所有客户端
	foreach($ws->connections as $fd) { $ws->push($fd, $msg); }
});
$ws->start();
?>

index.php:
<script>
var ws = new WebSocket("ws://0.0.0.0:8080");
ws.onmessage = function(e) {
	$("#content").prepend(e.data);
}
$(document).on("click", "#send", function() {
	ws.send($("#msg").val());
});
</script>
```




[mysql查询所有曾经降过薪的员工 emp_no 以及降薪幅度](https://www.v2ex.com/t/370157)
select a.emp_no,b.salary-a.salary, a.to_date 
from salaries a join salaries b 
on a.emp_no=b.emp_no and a.to_date>b.to_date and a.salary<b.salary and a.from_date=b.to_date;
[PHP 中'false'等于 true '0'==false](https://www.v2ex.com/t/369755)
```js
当字符串和布尔值进行比较时，会先将字符串转换成布尔值。

而字符串中除了'0'等于false之外，其他字符串都等于true。

即便是'0.0'、'-0'也都等于true。
$a= 0; 
var_dump($a == "imageUrl");//输出 bool(true)
$falseArr = [
    '',
    '0',
    0,
    false,
    [],
    null
];


$trueArr = [
    ' ',
    'false',
    '123',
    'abc',
    1,
    true,
    ['val'],
    new stdClass,
    function(){}
];
$print = function ($arr) {
    foreach ($arr as $v) {
        var_dump($v==false);
    }
};

$print($falseArr);
echo "\n";
$print($trueArr);
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)

bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
```
[喜马拉雅在线json](http://www.ximalaya.com/tracks/1099713.json)
[解决Redis之MISCONF Redis is configured to save RDB snapshots](http://www.jianshu.com/p/3aaf21dd34d6)
强制关闭Redis快照导致不能持久化。
127.0.0.1:6379> config set stop-writes-on-bgsave-error no
set stop-writes-on-bgsave-error yes
[php在线库](http://www.ctolib.com/article/wiki/11055)
[支付宝即时到账 SDK 简化版](https://github.com/mytharcher/alipay-php-sdk)
[支付宝](https://github.com/lokielse/omnipay-alipay-example/issues/6)
[手机网站支付快速接入](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.DGFUxo&treeId=193&articleId=105285&docType=1)
手机网站支付老版本请求支付宝的网关地址为：https://mapi.alipay.com/gateway.do；

手机网站支付新版本请求支付宝的网关地址为：https://openapi.alipay.com/gateway.do；
如果使用 md5 不需要秘钥 新接口需要创建应用
[Payment是一个php版本的支付聚合第三方sdk，集成了微信支付、支付宝支付](https://github.com/helei112g/payment)
[支付宝SDK在Laravel5的封装。](https://github.com/latrell/Alipay)
[微信自动加群](pan.baidu.com/s/1nuU3dl3)
密码79yd http://mp.weixin.qq.com/s/Q5IfQvxD7sTueGjtRfq9Kg
```js

import itchat
from itchat.content import *
#自动同意好友申请
@itchat.msg_register(FRIENDS)
def add_friend(msg):
    itchat.add_friend(**msg['Text']) # 该操作会自动将新好友的消息录入，不需要重载通讯录
    itchat.send_msg('你好，回复[我要加群]获取群信息哦', msg['RecommendInfo']['UserName'])


# 回复群消息
@itchat.msg_register('Text')
def text_reply(msg):
    #查看msg中都有啥
    # print( msg['FromUserName'])  #发信息的人的UserName
    #创建一个字典用来保存群名称
    qun_name = []
    #存储群的username
    qun_username = {}
    #保存群名称和对应的MemberList
    qun_member_list = {}
    #群名称和对应群成员的数量
    qun_name_count = {}
    #应该在用户问之前获取所有群聊获取所有群聊
    grouplist = itchat.get_chatrooms(update=True)[1:]


    for group in grouplist:
        # print( group['MemberCount'])
        # print( group['MemberList'] )
        qun_name.append(group['NickName'])
        #根据群名称存入username
        qun_username[ group['NickName'] ] = group['UserName']
        qun_member_list[ group['NickName'] ] = group['MemberList']
        qun_name_count[ group['NickName'] ] = group['MemberCount']


    if msg['Text']=='我要加群':
        itchat.send('你好，有以下群聊：\n{}'.format( qun_name ) , toUserName=msg['FromUserName'])
        itchat.send('请回复你要加入的群名称[爱心]' , toUserName=msg['FromUserName'])
#https://github.com/jinfagang/blogo.git 写博客神器，人工智能自动生成博客，go语言实现，求star


    #回复指定的群名称进群
    #在qun_name中查找，看看是不是有该群
    # print( len(qun_name ))
    for i in range(0,len(qun_name)):
        if msg['Text']==qun_name[i]:
            #根据群名称获取对应的群所有成员信息
            menber_list = qun_member_list.get( msg['Text'] )
            for m in menber_list:
                # 判断发消息的人的username是否在该群里面
                 if m['UserName'] == msg['FromUserName']:
                     itchat.send('你已加入该群聊，请勿重复增加！', toUserName=msg['FromUserName'])
                     return
            #获取群名称对应的username
            chatroomUserName = qun_username.get( msg['Text'] )
            friend = msg['User']
            #发送群邀请
            itchat.add_member_into_chatroom(chatroomUserName, [friend], useInvitation=True)


if __name__ == '__main__':
    itchat.auto_login(hotReload=True)
    # 获取自己的UserName
    myUserName = itchat.get_friends(update=True)[0]["UserName"]
    # 显示所有的群聊，包括未保存在通讯录中的，如果去掉则只是显示在通讯录中保存的
    itchat.dump_login_status()
    itchat.run()


```
[larave session问题，为什么每次session_id都要变](https://segmentfault.com/q/1010000009694886)
[github怎么提交回退旧版本代码并更改后的文件到主分支上](https://segmentfault.com/q/1010000009800764)
[让git命令行保存github的登录状态](https://segmentfault.com/q/1010000009785643)
echo命令本身默认会在输出字符串后面追加一个换行符，可以通过增加一个选项-n来阻止此默认行为echo -ne "\n"
 删除当前目录下 10天前的子目录 find . -maxdepth 1 -type d -mtime +10|xargs rm -rf
[将100之内的数字中文转换..](https://segmentfault.com/q/1010000009760061)
[正则表达式问题](https://segmentfault.com/q/1010000009745638)
# coding: utf8
filename = '2.txt'
with open(filename) as f:
    for i in f:
        result = i.split()
        print result[1], result[-1]
        
[php 如何解析既有值又有属性的 xml 标签？](https://segmentfault.com/q/1010000009762137)        
$xml = simplexml_load_string($content);
foreach($xml->attributes() AS $a => $b) {

echo "$a = $b <br />";
}
[数字变为文字](https://segmentfault.com/q/1010000009747721)   
[python中eval的问题](https://segmentfault.com/q/1010000009808234)
```js
python有 decimal 和 fraction 2个模块用来进行高精度浮点计算
>>> from fractions import Fraction
>>> Fraction('0.3')-Fraction('0.1') == Fraction('0.2')
True
>>> from decimal import Decimal
>>> Decimal('0.3')-Decimal('0.1') == Decimal('0.2')
True
>>> 
eval('0.3-0.1==0.2')  # 输出为False, 是因为0.3-0.1=0.19999999999999998
eval('%d - %d == %d'%(0.3, 0.1, 0.2))  # 输出为True, 是因为你%d传入是整数，相当于0-0=0
eval('%s - %s == %s'%(0.3, 0.1, 0.2))  # 输出为False, 参考1
eval('%s - %s == %s'%('0.3', '0.1', '0.2'))  # 输出为False, 参考1
```
[python如何转换时间戳到"2017年6月12日 18点24分"这样的格式](https://segmentfault.com/q/1010000009748841)
```js
import time
print('%s年%s月%s日 %s时%s分' % time.localtime(1497254119.69407)[:5])
timestamp = time.time() - 3600   # 时间戳
print(time.strftime('%Y{y}%m{m}%d{d} %H{H}%M{M}', time.localtime(timestamp)).format(y='年', m='月', d='日', H='时', M='分'))
#统计出现次数
lst = [1,1,2,2,3,3,4,4,5,6]
print len(set(lst))

#统计每种各出现几次
from collections import Counter
print dict(Counter(lst))
```
[php字符串比较](https://segmentfault.com/q/1010000009794813)
[Python 爬虫中完成 JavaScript 函数翻页?](https://segmentfault.com/q/1010000009753395)
[一段不减的整数，如11111223333，怎么快速计算重复次数最多的那个数](https://segmentfault.com/q/1010000009695220)
```js
其实这种标准字典格式的，eval是最简单的。https://segmentfault.com/q/1010000009813506
t='''{"status": "0", "msg": "ok", "result": {"name": "露水", "content": 
"<p>释名在秋露重的时候，早晨去花草间收取。</p><p>气味甘、平、无毒。</p><p>主治用以煎煮润肺杀虫的药剂，或把治疗疥癣、虫癞的散剂调成外敷药，可以增强疗效。白花露：止消渴。百花露：能令皮肤健好。柏叶露、菖蒲露：每天早晨洗眼睛，能增强视力。韭叶露：治白癜风。每天早晨涂患处。</p>", "commentary": "", "translation": "", "appreciation": "", "interpretation": ""}}'''

a=eval(t)
```
[请教linux的find命令如何按正则表达式过滤](https://segmentfault.com/q/1010000009776190)
find . -regex '\./[0-9]+_[0-9]+\.zip'
如果需要将找到的文件删除则利用xargs(注意确定之后再删除)：

find . -regex '\./[0-9]+_[0-9]+\.zip'|xargs rm -f
如果不仅要删除还要得到删除的数量，可以这样：

find . -regex '\./[0-9]+_[0-9]+\.zip'|tee >(wc -l 1>&2)|xargs rm -f

[PHP二维数组根据某字段排序](https://tiicle.com/items/288/php-two-dimensional-array-ordered-according-to-a-certain-field)
```js
$array=[
    ['name'=>'张三','age'=>'23'],['name'=>'李四','age'=>'64'],
['name'=>'王五','age'=>'55'],['name'=>'赵六','age'=>'66'],
['name'=>'孙七','age'=>'17']];
$sort = array(
    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
    'field'     => 'age',       //排序字段
);
$arrSort = array();
foreach($array as $uniqid => $row){
    foreach($row AS $key=>$value){
        $arrSort[$key][$uniqid] = $value;
    }
}
array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
print_r($array);
Array
(
    [0] => Array
        (
            [name] => 孙七
            [age] => 17
        )

    [1] => Array
        (
            [name] => 张三
            [age] => 23
        )

    [2] => Array
        (
            [name] => 王五
            [age] => 55
        )

    [3] => Array
        (
            [name] => 李四
            [age] => 64
        )

    [4] => Array
        (
            [name] => 赵六
            [age] => 66
        )

)
//定义一个学生数组
$students  = array (
     256=> array ( 'name' => 'jon' , 'grade' =>98.5),
     2=> array ( 'name' => 'vance' , 'grade' =>85.1),
     9=> array ( 'name' => 'stephen' , 'grade' =>94.0),
     364=> array ( 'name' => 'steve' , 'grade' =>85.1),
     68=> array ( 'name' => 'rob' , 'grade' =>74.6),
);
//按照名称进行排序
function name_sort( $x , $y )
{
 return strcasecmp ( $x [ 'name' ], $y [ 'name' ]);
}

//按照成绩进行排序
function grade_sort( $x , $y )
{
 return ( $x [ 'grade' ] > $y [ 'grade' ]);
}
uasort( $students , name_sort);
 
uasort( $students , grade_sort);
```
[php 数组改造](https://segmentfault.com/q/1010000009729734)
```js
$arrayOld = array(
    '17' => array('1'),
    '11' => array('2'),
    '10' => array('6'),
    '9' => array('1'),
);
$arrayNew = [];

foreach($arrayOld as $key => $value){
    $arrayNew[] = [(string)$key,$value[0]];
}

//print_r ($arrayNew);
 function maps(&$array,$key) {
    array_unshift($array, $key);
  }

  array_walk($arrayOld, 'maps');
  print_r($arrayOld);
```
[mysql文档生成PHP程序](https://git.oschina.net/mjw/sqlDoc/blob/master/sql.php?dir=0&filepath=sql.php&oid=cb5db581bdb2e378a8207383c8534396c9f7bb05&sha=114c111a9b7ac5314e73977505ee4743e67a4f87)
```js
$sql="SHOW TABLE STATUS FROM " . DB_NAME; 
$sql_tab='show full fields from `' . $array[$i]['Name'].'`'
中文字符字数读取  mb_strlen($data['content'],'utf8');  对于中文来说，第二个参数请加上。
替换函数  用于隐私处理
$data['mobile'] = substr_replace($data['mobile'],'******',3,5);  //将电话号码中间5位用*代替
$data['email'] = substr_replace($data['email'],'******',0,5);  //将前位用*代替
```
[如何合并数组里某个key值一样的对象](https://segmentfault.com/q/1010000009819805)
```js
var new = Array.from(
  old.reduce((dict, item)=> {
    if (dict.has(item.name)) {
      dict.get(item.name).push(item.id)
    } else {
      dict.set(item.name, [item.id])
    }
    return dict
  }, new Map())
).map(item => ({a: item[1], b: item[0]}))
var old = [
    {
        id: 1,
        name: "first"
    },
    {
        id: 2,
        name: "first"
    },
    {
        id: 3,
        name: "second"
    },
    {
        id: 4,
        name: "second"
    }
]new = [
    {
        a: [1, 2],
        b: "first"
    },
    {
        a: [3, 4],
        b: "second"
    }
]
var getNew = old => {
    let temp = old.reduce((acc, cur) => {
        if (acc[cur.name]){
            acc[cur.name].push(cur.id); 
        } else {
            acc[cur.name] = [cur.id]
        }
        return acc; 
    }, {});
    
    return Object.keys(temp).map(key => {
        return {
            a: temp[key],
            b: key
        }
    })
}
//https://segmentfault.com/q/1010000009821632 
var hash = {};
var i = 0;
var res = [];
old.forEach(function(item) {
    var name = item.name;
    hash[name] ? res[hash[name] - 1].id.push(item.id) : hash[name] = ++i && res.push({
        id: [item.id],
        name: name,
        type: item.type
    })

});
console.log(JSON.stringify(res))
```
[无限分类之无限方法](http://www.majianwei.com/%e6%97%a0%e9%99%90%e5%88%86%e7%b1%bb%e4%b9%8b%e6%97%a0%e9%99%90%e6%96%b9%e6%b3%95/)
[基于chrome扩展的脚本注入工具](https://zhuanlan.zhihu.com/p/27427557?group_id=859108597462859776)
[来自新浪微博的面试题](https://laravel-china.org/topics/4941/interview-questions-from-sina-and-micro-blog)
```js
function king ($n, $m){
    $s = 0;
    for($i=1;$i<=$n;$i++) {
        $s = ($s+$m)%$i;
    }
    return $s+1;
}

echo king(5,2);     // 3
$arr=
[
'赵','钱','孙','李',
'周','吴','郑','王',
'冯','陈','褚','魏',
'蒋','沈','韩','杨'
];

function countM($arr,$step)
{
$i=1;

while (count($arr)>1)
{
    if ($i==$step)
    {
        array_shift($arr);
        $i=0;
    }else
    {
        array_push($arr,array_shift($arr));
    }

    $i++;
}

echo array_shift($arr);
}
function monkey($monkey, $x) {
    $arr = range(1, $monkey);
    $i   = 0;
    while (count($arr) > 1) {
        if (($i+1) % $x !== 0) {
            array_push($arr, $arr[$i]);
        }
        unset($arr[$i]);
        $i++;
    }
    return implode('', $arr);
}

echo 'The winner is ' . monkey(5, 5);
```
[Notadd 商城模块 ](https://laravel-china.org/articles/5002/notadd-mall-module-product-documentation-apache-open-source)
https://github.com/notadd/notadd
[2017 第三届PHP全球开发者大会PPT/Keynote](https://github.com/devlinkcn/ppts_for_php2017)
[利用 ngrok 代替 在线测试服务器 进行开发的简单使用](https://laravel-china.org/articles/4978/use-ngrok-instead-of-online-test-server-for-simple-development)
Laravel 的命令 php artisan cache:clear 用来清除各种缓存，如页面，Redis，配置文件等缓存，它会清空 Redis 数据库的全部数据，比如默认使用的 Redis 的数据库是 db0，那么执行这个命令后，会清空 db0 中所有数据。Laravel的话，在Controller中要使用$msg = $request->getContent()获取原始数据。
[ThinkSNS+ 是如何计算字符显示长度的](https://laravel-china.org/articles/4803/how-does-thinksns-calculate-the-character-display-length-using-the-laravel-custom-validation-rule)
[如何创建一个自己的 Composer 库](https://laravel-china.org/articles/4982/how-do-i-create-my-own-composer-library)
[Zttp 发送 form params 请求 而非 JSON 请求](https://laravel-china.org/articles/4959/zttp-sends-form-params-requests-instead-of-json-requests)
$response = Zttp::withHeaders(['Fancy' => 'Pants'])->post($url, [
    'foo' => 'bar',
    'baz' => 'qux',
]);

$response->json();
Zttp::asFormParams()->post(bd_api_url(), $params);

[Laravel 中调试输出 SQL 语句的简便方法](https://laravel-china.org/articles/4812/a-simple-way-to-debug-and-output-sql-statements-in-laravel)
```js
\DB::listen(function($sql, $bindings, $time) {
     foreach ($bindings as $replace){
         $value = is_numeric($replace) ? $replace : "'".$replace."'";
         $sql = preg_replace('/\?/', $value, $sql, 1);
     }
     dd($sql);
 })
```
[查看公网出口IP](https://laravel-china.org/topics/4772/the-composer-image-collection-problem-caton-welcome-feedback)
```js
# 1. curl 命令方法
curl http://ipv4.icanhazip.com

# 2. 或者 php
php -r "readfile('http://ipv4.icanhazip.com');"

Trait 在我理解是一个不能实例化的class，用于实现多继承的关系。 你有一个杯子，空值代表杯子是真空的，NULL代表杯子中装满了空气，虽然杯子看起来都是空的，但是区别是很大的。
$user = User::find(1);
$user->touch();
用 touch() 方法可以不需要更新其他字段就用当前时间戳对 updated_at 进行更新。这个方法用来保存 最后一次处理时间 亦或者是 用户最近一次活跃时间 是极好的。
```
[使用 ngrok 让外网也能访问本地](https://laravel-china.org/articles/4339/use-ngrok-to-allow-access-to-the-local-network)
git clone https://github.com/HanSon/ngrok-script.git
cd ngrok-script
// if linux or mac
./ngrok.sh domain
// if windows
ngrok.bat domain
[简单快速的开发 Web 应用， PHP 框架 Lemon 介绍](https://laravel-china.org/topics/4671/write-a-small-project-for-the-php-framework-to-support-regular-routing-database-query-chain)
[Laravel 核心——IoC 服务容器源码解析（服务器解析）](https://laravel-china.org/articles/4700/laravel-core-ioc-service-container-source-code-analysis-server-resolution)

[Composer 系列：autoload](https://laravel-china.org/articles/4802/composer-series-autoload)

[Allowed memory size of 134217728 bytes 错误解决心得](https://laravel-china.org/articles/4736/allowed-memory-size-of-134217728-bytes-error-resolution)
不下二十个字段，所有字段都查询出来肯定撑爆内存。
最后修改代码：$*****->get(["uid","loginid","steamid","created_at","name"]);
[简单的初级压力测试](https://laravel-china.org/articles/4765/simple-primary-stress-test)

