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


[WEB应用在今天越来越广泛，也是CTF夺旗竞赛中的主要题型，题目涉及到常见的Web漏洞，诸如注入、XSS、文件包含、代码执行、上传等漏洞。](http://www.shiyanbar.com/ctf/practice)
[Apple ID钓鱼网站后台一览](https://zhuanlan.zhihu.com/p/26219701)
http://www.cnblogs.com/zqh20145320/p/5710072.html  网站链接：http://www.ichunqiu.com/racing
https://www.ctftools.com/down/ https://www.ctftools.com/down/down/passwd/ https://c.runoob.com/
[Python 编码为什么那么蛋疼](https://zhuanlan.zhihu.com/p/25924333?group_id=832384651610980352)
str 本质上其实是一串二进制数据，而 unicode 是字符（符号），编码（encode）就是把字符（符号）转换为 二进制数据的过程，因此 unicode 到 str 的转换要用 encode 方法，反过来就是用 decode 方法。
为调用 write 方法时，Python 会先判断字符串是什么类型，如果是 str，就直接写入文件，不需要编码，因为 str 类型的字符串本身就是一串二进制的字节序列了。

如果字符串是 unicode 类型，那么它会先调用 encode 方法把 unicode 字符串转换成二进制形式的 str 类型，才保存到文件，而 encode 方法会使用 python 默认的 ascii 码来编码

相当于：

>>> u"Python之禅".encode("ascii")
[Python科学计算的瑞士军刀——Anaconda 安装与配置](http://blog.csdn.net/u012675539/article/details/46974217)
conda config --add channels 'https://mirrors.tuna.tsinghua.edu.cn/anaconda/pkgs/free/'
conda config --set show_channel_urls yes
如果大家使用 whl 手动安装包安装wordcloud ，出现pip安装报错：is not a supported wheel on this platform。可以使用这种解决方法：将文件名wordcloud‑1.3‑cp27‑cp27m‑win_amd64.whl改为wordcloud-1.3-cp27-none-win_amd64    即：将cp27m改为none。 或者尝试装后缀为 win32.whl 的版本
[PHP的笛卡尔积算法实现](https://www.bytelang.com/article/content/zUEWXIbeyeU=)
```js
function Descartes()
{
    $t = func_get_args();

    if (func_num_args() == 1) {
        $t0 = $t[0];
        return call_user_func_array(__FUNCTION__, $t0);
    }

    $a = array_shift($t);
    if (!is_array($a)) $a = array($a);
    $a = array_chunk($a, 1);
    do {
        $r = array();
        $b = array_shift($t);
        if (!is_array($b)) $b = array($b);
        foreach ($a as $p)
            foreach (array_chunk($b, 1) as $q)
                $r[] = array_merge($p, $q);
        $a = $r;
    } while ($t);
    return $r;
}
>>> Descartes([1,2],[3,4])
=> [
       [
           1,
           3
       ],
       [
           1,
           4
       ],
       [
           2,
           3
       ],
       [
           2,
           4
       ]
   ]
```
[laravel在controller中给created_at或者updated_time赋值为什么出错](https://segmentfault.com/q/1010000009000895)
```js
系统将created_at、updated_at、deleted_at字段格式化为了Carbon\Carbon类了。

// 例子
$posts->created_at->timestamp;  // 时间戳
$posts->created_at->format('Y-m-d H:i:s');  // 返回指定格式
// Carbon支持很多操作
```
[js根据数组中的值 排序对象](https://segmentfault.com/q/1010000009011452)
```js
var a = [100,200,300]
var b = [{id:'100',name:'小红'},{id:'300',name:'小明'},{id:'200',name:'小蓝'}]

function sortSome(a, b){
    var arr = [];
    a.forEach(function(tem, index){
      b.forEach(function(val, num){
        if(tem == val.id){
          arr.push(val);
      }
    })
  })
  return arr;
}
console.log(sortSome(a,b))
```

[签到表格插件](http://www.gcpowertools.com.cn/products/spreadjs/demo.htm)
[php如何确保服务端的接口调用安全](https://segmentfault.com/q/1010000008918918)
1.对受限资源的登录授权
2.对请求做身份认证
3.对敏感数据进行加密
[PHP简体中文离线手册17-04月更新](https://www.oschina.net/question/998019_2237185)
http://www.os688.com/fenanr/112646.html
[php 3028问题在于32位系统，64位系统上任意版本的php都不会有这个问题]()
echo date('Y-m-d H:i:s', strtotime('+500 year', time()));//2517-04-10 02:55:47
$d=new datetime()
$d->modify('+500 year');
$d->format('Y-m-d')
[p里面不能包含块级元素div](https://stackoverflow.com/questions/5441639)
 https://segmentfault.com/q/1010000008981388
[php处理阴历和阳历的](https://segmentfault.com/q/1010000008997316)
$lunar = new Lunar();
$month = $lunar->convertSolarToLunar(time());//将阳历转换为阴历 
var_dump($month);
[ubuntu开启3306端口失败](https://segmentfault.com/q/1010000008938349)
竟然返回空的，3306端口没有开启

netstat -an|grep 3306
然后就使用以下命令

iptables -I INPUT 4 -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
来开启3306，但是显示以下错误

iptables: Index of insertion too big.
表示在INPUT chain中第四行的位置插入这条rule

iptables: Index of insertion too big.
说明你的iptable里没有那么多行

iptables -S 看一下你一共多少行
[mysql连表统计查询问题](https://segmentfault.com/q/1010000008951274)
select u2.username as borrower,u1.username as debtor,sum(b.amount) as debt from borrow_log b left join users u1 on b.debtor = u1.id left join users u2 on b.borrower = u2.id where u1.gender = 1 group by b.borrower,b.debtor;

数据库连接要设置为utf8mb4，一般配置数据库的地方都有设置。

如果没有的话php连接数据库后先执行一次查询

set names utf8mb4  General error: 1366 Incorrect string value: '\xF0\x9F\x98\xAF' for column 'content' mysql无法保存emoji表情https://segmentfault.com/q/1010000008965110
[一对多查询问题](https://segmentfault.com/q/1010000008950624)
select a.id from a where not exists (select 1 from b where a.id=b.a_id); SELECT 
  a.id 
FROM
  a 
WHERE a.id NOT IN 
  (SELECT 
    a.id  
  FROM
    a
    RIGHT JOIN b ON b.a_id = a.id) 
    
[php正则循环匹配](https://segmentfault.com/q/1010000008993966)
    preg_match_all('/(\d{8}\$[^<]+)/', $subject, $result, PREG_PATTERN_ORDER);
for ($i = 0; $i < count($result[0]); $i++) {
    # Matched text = $result[0][$i];
}
php 跨域请求执行了两次接口https://segmentfault.com/q/1010000008992437
if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    exit;
}
php判断一个二进制数中，哪些位是0 而 哪些是1？https://segmentfault.com/q/1010000008984540

$a= 100010010;
需要通过php判断出（从右往左）的 第0 第2 第3 第5 第6 第7位是0
从而得到
$ar0=array(0,2,3,5,6,7);
$ar1=array(1,4,8);
$binary = ".....";
$binary = str_split($binary);

// 0
$a0 = array_keys(array_filter($binary, function ($bit) {
    return !$bit;
}));

// 1
$a1 = array_keys(array_filter($binary));
[ 单点登录SSO的实现原理](http://blog.csdn.net/cutesource/article/details/5838693)
[curl 抓取某些页面的时候，提示 503 nginx](https://segmentfault.com/q/1010000008980562)
```js
function task() {
        $url = "url";
        $headers = randIp();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);  
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_USERAGENT,  "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0");      //模拟浏览器类型
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);                               // 设置超时限制防止死循环    
        curl_setopt($curl, CURLOPT_HEADER, 0);                                  // 显示返回的Header区域内容    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);                          // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl);
        if (curl_errno($curl)) { 
            print "Error: " . curl_error($curl); 
        } else { 
            curl_close($curl); 
        } 
    }
//此函数提供了国内的IP地址
function randIP(){
       $ip_long = array(
           array('607649792', '608174079'), //36.56.0.0-36.63.255.255
           array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
           array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
           array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
           array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
           array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
           array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
           array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
           array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
           array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
       );
       $rand_key = mt_rand(0, 9);
       $ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
       $headers['CLIENT-IP'] = $ip; 
       $headers['X-FORWARDED-FOR'] = $ip; 

       $headerArr = array(); 
       foreach( $headers as $n => $v ) { 
           $headerArr[] = $n .':' . $v;  
       }
       return $headerArr;    
   }
```
>>> import chardet
>>> a=b'\xb5\xd8\xb1d\xb6\xea\xc5\xe9\xaf}\xad\xb5\xa4@'
>>> chardet.detect(a)
{'confidence': 0.99, 'encoding': 'Big5'}
>>> a.detect('Big5')
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
AttributeError: 'bytes' object has no attribute 'detect'
>>> a.decode('Big5')
'華康圓體破音一'
linux ubuntu14.04找不到3306端口 my.cnf里面设置了skip-networking 导致mysql启动起来不监听端口netstat -an | grep 3306 https://segmentfault.com/q/1010000008952539 
echo substr_replace ('13412343312','****',3,4) ; 把13412343312 替换成 134**3312
[采用JWT做API的验证，如何设计token刷新的逻辑？](https://segmentfault.com/q/1010000008994073)
[mysql需要笛卡尔积join，才能在两个3行的表取出3行以上的记录](https://segmentfault.com/q/1010000008968545)
			
```js
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(8) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `desk` (
  `desk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `left_id` int(10) unsigned DEFAULT NULL,
  `right_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`desk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO test.user (name) VALUES ('小明');
INSERT INTO test.user (name) VALUES ('小红');
INSERT INTO test.user (name) VALUES ('小丽');

INSERT INTO test.desk (left_id, right_id) VALUES (3, null);
INSERT INTO test.desk (left_id, right_id) VALUES (null, 2);
INSERT INTO test.desk (left_id, right_id) VALUES (1, 2);
```
    
[Python 爬虫之模拟知乎登录](https://github.com/lzjun567/crawler_html2pdf/blob/master/zhihu/auto_login.py)
```js
import time
from http import cookiejar
#https://zhuanlan.zhihu.com/p/26102000
import requests
from bs4 import BeautifulSoup

headers = {
    "Host": "www.zhihu.com",
    "Referer": "https://www.zhihu.com/",
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87'
}

# 使用登录cookie信息
session = requests.session()
session.cookies = cookiejar.LWPCookieJar(filename='cookies.txt')
try:
    print(session.cookies)
    session.cookies.load(ignore_discard=True)

except:
    print("还没有cookie信息")


def get_xsrf():
    response = session.get("https://www.zhihu.com", headers=headers)
    soup = BeautifulSoup(response.content, "html.parser")
    xsrf = soup.find('input', attrs={"name": "_xsrf"}).get("value")
    return xsrf


def get_captcha():
    """
    把验证码图片保存到当前目录，手动识别验证码
    :return:
    """
    t = str(int(time.time() * 1000))
    captcha_url = 'https://www.zhihu.com/captcha.gif?r=' + t + "&type=login"
    r = session.get(captcha_url, headers=headers)
    with open('captcha.jpg', 'wb') as f:
        f.write(r.content)
    captcha = input("验证码：")
    return captcha


def login(email, password):
    login_url = 'https://www.zhihu.com/login/email'
    data = {
        'email': email,
        'password': password,
        '_xsrf': get_xsrf(),
        "captcha": get_captcha(),
        'remember_me': 'true'}
    response = session.post(login_url, data=data, headers=headers)
    login_code = response.json()
    print(login_code['msg'])
    for i in session.cookies:
        print(i)
    session.cookies.save()


if __name__ == '__main__':
    email = "xxxx"
    password = "xxxxx"
    login(email, password)
```
[手机电脑互传工具](https://zhuanlan.zhihu.com/p/26008219?group_id=829438715901390848)
[史上最详细VUE2.0全套demo讲解 基础篇](https://zhuanlan.zhihu.com/p/26119383?group_id=831214352295137280)
[Nodejs系列课程，从入门到进阶帮你打通全栈](https://zhuanlan.zhihu.com/p/26107559?group_id=831112083264393216)
[下载资料，别只知道去百度文库啦！](https://zhuanlan.zhihu.com/p/26096144?group_id=830942891496067072)
道客巴巴

http://www.doc88.com/ 、 好东东网

http://www.haodd.com.cn/ d.dxy.cn/

丁香文档是丁香园旗下文档在线浏览与下载平
[不会Python也可以用用她做的工具——全网网页视频下载工具You-Get](https://zhuanlan.zhihu.com/p/26098165?group_id=830864380286599168)
http://link.zhihu.com/?target=https%3A//github.com/soimort/you-get/releases/tag/v0.4.652  下载好软件，解压，打开下图所示bat文件。
[Python高手都知道的内置函数，你不知道就low了](https://zhuanlan.zhihu.com/p/26097557?group_id=830848161630285824)
L = [{1:5,3:4},{1:3,6:3},{1:1,2:4,5:6},{1:9}]
new_line=sorted(L,key=lambda x:len(x))
students = [('wang', 'A', 15), ('li', 'B', 12), ('zhang', 'B', 10)]   
print(sorted(students, key=lambda student : student[2]))  
>>>[('zhang', 'B', 10), ('li', 'B', 12), ('wang', 'A', 15)]
students = [('wang', 'A', 15), ('li', 'B', 12), ('zhang', 'B', 10)]   
print(sorted(students, cmp=lambda x,y : cmp(x[0], y[0])) )
>>>[('li', 'B', 12), ('wang', 'A', 15), ('zhang', 'B', 10)]
[安利一个很火的 Github 滤镜项目](https://zhuanlan.zhihu.com/p/26066756?group_id=830439826254872576)
http://link.zhihu.com/?target=https%3A//github.com/jcjohnson/neural-style
https://zhuanlan.zhihu.com/p/25853745?group_id=830133798166478848
[爬虫入门到精通-headers的详细讲解](https://zhuanlan.zhihu.com/p/26075735?group_id=830525132417159168)
```js
当我第一次打开王者荣耀：在 App Store 上的内容网页的时候，再次刷新的时候，你会看到http状态码返回 304
import requests

headers = {'User-Agent':'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'}

url = 'https://itunes.apple.com/cn/app/%E7%8E%8B%E8%80%85%E8%8D%A3%E8%80%80/id989673964'

z = requests.get(url,headers=headers)
# 获取上次修改时间
last_modified = z.headers['Last-Modified']

# 修改headers
headers['If-Modified-Since'] = last_modified
z1 = requests.get(url,headers=headers)
print z1.status_code
# 304
# 可以看到已经返回状态码304，表示网页没有更新
z2 = requests.head(url,headers=headers)
if z1.headers['Last-Modified'] == last_modified:
    print u'网页没有更新'
    
 keys = ['Name', 'Sex', 'Age']
values = ['Jack', 'Male', 23]
dict(zip(keys,values))   
    
```
 [算法和数据结构学习-八种必需掌握的排序](https://zhuanlan.zhihu.com/p/26065419?group_id=830424829554466816)   
    
    
[零基础入门之：JavaScript学习课程共26节](https://zhuanlan.zhihu.com/p/26088017?group_id=830775821064093696)
[HR看不下去了：应聘时你真的好意思说自己精通Excel？](https://zhuanlan.zhihu.com/p/26100199?group_id=830900756126265344)
求和是最常用的Excel函数之一，只需要连续按下快捷键“alt”和“=”就可以求出一列数字的和。
[Phantomjs正确打开方式](https://zhuanlan.zhihu.com/p/26110017?group_id=831133453583024128)
用phantomjs Webservice作为一种web服务的形式（api）,将其与其他语言分离开来（比如python）。
[愚人节专刊—说说互联网厂商的愚人节产品](https://zhuanlan.zhihu.com/p/26120806?group_id=831479183145324544)
百度种子搜索内测版 http://huodong.baidu.com/zhongzi/  种子搜索
[教你分析知乎用户系列之陆](https://zhuanlan.zhihu.com/p/23422888?group_id=831609049371013120)
百度豆瓣小 https://nosec.org/users/sign_in  lxghost site:http://tieba.baidu.com  http://www.weixinduihua.com/ 微信对话框
[天眼查企查查，启信宝，工商总](http://www.tianyancha.com/search?key=%E5%8C%97%E4%BA%AC%E5%BE%AE%E5%90%BC%E6%97%B6%E4%BB%A3%E7%A7%91%E6%8A%80%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8&checkFrom=searchBox)
[批量取关：控制台脚本实现新浪微博批量取消关注](https://zhuanlan.zhihu.com/p/26143735?group_id=831814580383653888)
```js
function qxgz()
{
document.getElementsByClassName("btn_link S_txt1")[0].click();
var arrs = document.getElementsByClassName("member_li S_bg1 ");
for(var i = 0;i<arrs.length;i++){arrs[i].click();}
document.getElementsByClassName("W_btn_a")[1].click();
document.getElementsByClassName("W_btn_a btn_34px")[0].click();

}
self.setInterval("qxgz()",60000);
var arrs = $('div.markup_choose');
for(var i=0;i<arrs.length;i++){
	arrs[i].click();

}
```

[如何用爬虫获取网易云音乐歌单中的歌曲？](https://www.zhihu.com/question/41505181/answer/155095628?group_id=832628588288303104)
```js
import requests
from bs4 import BeautifulSoup
https://github.com/Chengyumeng/spider163
headers = {
    'Referer':'http://music.163.com/',
    'Host':'music.163.com',
    'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64; rv:38.0) Gecko/20100101 Firefox/38.0 Iceweasel/38.3.0',
    'Accept':'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
    }
                
play_url = 'http://music.163.com/playlist?id=317113395'

s = requests.session()
s = BeautifulSoup(s.get(play_url,headers = headers).content)
main = s.find('ul',{'class':'f-hide'})

for music in main.find_all('a'):
  print('{} : {}'.format(music.text,music['href']))
```




[python gzip 查找任意一串数字在圆周率小数点后两亿位中的具体位置](https://www.v2ex.com/t/349851#reply3)
```js
Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Encoding:gzip,deflate
Accept-Language:zh-CN
Cache-Control:no-cache
Connection:keep-alive
Cookie:__cfduid=d7569585f59a67768e5ff2544a32641181491619438
url = 'http://www.angio.net/newpi/piquery?q=666666666'
#这里 headers 是完全复制了浏览器里的
req = urllib.request.Request(url, None, headers)
response = urllib.request.urlopen(req).read()

b'\x1f\x8b\x08\x00\x00\x00\x00\x00\x00\x03L\x8c1\x0e\xc20\x10\xc0\xfe\xe29C\x8e\r\xb9\xfb\x02\x03\x0f@\x0c\x85\xc2\x82\x04\x88\xb6S\xc5\xdfQ\x07$\xbcx\xb0\xe4\x95\xebL45)\x897q\\xb9\x13\xb4\x1f$\xa6\x99\xc8\x9b\x86y\x99\x08n\xcf\xe51\x92x\x11Z[\x17\xeb\x92\x18\xcf\x04\xbdY\x91\\xb3\xbaU\xa9\xd9<\xbb\x92\x18\x07\x02\x13+\xdak\xdb\xb9\xba\xb9\xf7\xa2\xba\xb5\x0b!\x9f\xd3\xdf\xfd\xb0\xe7\x0b\x00\x00\xff\xff\xaa\x05\x00\x00\x00\xff\xff\x03\x00B\xb8\x0e\x84\x95\x00\x00\x00'
又加了一句解压缩之后就正常了 
gzip.decompress(response).decode("utf-8")
其实你没必要自己解压，可以先试试去掉 header 里 Accept-Encoding 的压缩选项，只保留 identity ，服务器应该就会回明文了。


```
[微信机器人itchatdemo](https://github.com/discountry/itchat-examples/blob/master/examples/auto-reply-greetings.py)（）
[THULAC：一个高效的中文词法分析工具包](http://thulac.thunlp.org/)
```js
代码示例1
import thulac   

thu1 = thulac.thulac()  #默认模式
text = thu1.cut("我爱北京天安门", text=True)  #进行一句话分词
print(text)
代码示例2
thu1 = thulac.thulac(seg_only=True)  #只进行分词，不进行词性标注
thu1.cut_f("input.txt", "output.txt")  #对input.txt文件内容进行分词，输出到output.txt
```
[1024之我可能注册了假的黄色网站上卷（渗透到社工）](https://zhuanlan.zhihu.com/p/26213061)
大家可以关注一波我的公众号 微信搜索网络小捕快
[Python练习第八题，阶乘计算](https://zhuanlan.zhihu.com/p/25635148)
```js
def FirstFactorial(num): 
  factorial = 1
  for i in range(1, num+1):
    factorial = factorial * i
  return factorial
https://coderbyte.com/ 编程挑战

def FirstFactorial(num):  
    def factorial(n):
        if n == 0:
      return 1
        else:
      return factorial(n-1) * n
  return factorial(num)
  
import operator
swd=sorted(dic.items(),key=operator.itemgetter(1),reverse=True)#从大到小排序  
  yield 实现Fibonacci数列（斐波那契数列）
  def fab(max):  
n, a, b = 0, 0, 1  
while n < max:  
        yield b  
        # print b  
        a, b = b, a + b  
        n = n + 1
```
[史上最全Quant资源整理数据源](https://zhuanlan.zhihu.com/p/26179943)
[微信公众号如何运营？](https://www.zhihu.com/question/22084460/answer/97431309)
[相信我，这篇文章足以颠覆你对Office的三观](https://zhuanlan.zhihu.com/p/26213949)
[图表秀网址 图表秀--免费在线图表制作工具,数据可视化工具](https://zhuanlan.zhihu.com/p/26249606)
http://link.zhihu.com/?target=http%3A//www.tubiaoxiu.com 
[工资报表计算、打印的小玩意，有什么好的库或者软件吗？](https://www.v2ex.com/t/346969#reply27)
delphi 好工具啊  薪人薪事如果用 python 的话，就用 pandas ，可以做透视表
Github 上有把 foxpro 数据文件转 csv 文件的东西。 
https://www.zhihu.com/question/21588013
方案一、继续用 foxpro 开发。 

方案二、先数据迁移到 SQLite ， Qt 提供 GUI 界面，处理打印报表。 Tower 旗下的知人可以试试
没人提 power bi?免费版够用了

[针对CTF，大家都是怎么训练的](https://www.zhihu.com/question/30505597)
https://hbctf.ctftools.com/index.php?p=game   http://star.ctftools.com/
[网络安全培训phppythonweb](http://www.moonsos.com/)
《Web安全深度剖析》书籍出版 

[HBCTF是专门为CTF小白打造的入门级训练平台](http://star.ctftools.com/)

[ctf xss练习平台]( http://ctf.bugku.com/scoreboard)

[md5查询](http://www.chamd5.org/login.html)
http://www.cnblogs.com/wangleiblog/p/5936238.html  http://pmd5.com/#
[twig](http://pengbotao.cn/twig-template-language.html)
http://www.twigcn.com/doc.php 
[Github 安全军火库](http://www.moonsos.com/post/52.html)
[websocket服务](http://wiki.hostker.com/page/websocket/)
[laravel的php框架](https://www.zhihu.com/question/27453375?sort=created)
```js
public function findMostPopular($per_page = self::PAGE_SIZE)
    {
        return $this->model
                    ->orderByRaw('(tricks.vote_cache * 5 + tricks.view_cache) DESC')->whereNull('deleted_at')
                    ->paginate($per_page);
    }
  echo join('',array_reverse(preg_split('//u', 'redis数据库')));  
//二维数组排序，   
//$source_array是数据，  
//$key_word是排序的健值，  
//$order是排序规则:0是升序，1是降序  
function array_sort($source_array, $key_word, $order=0)   
{  
    if (!is_array($source_array))   
        return false;  
      
    $keysvalue = array();  
    foreach($source_array as $key => $val)   
    {  
        $keysvalue[$key] = $val[$key_word];  
    }  
    if($order == 0)  
    {  
        asort($keysvalue);  
    }  
    else   
    {  
        arsort($keysvalue);  
    }  
    reset($keysvalue);  
    foreach($keysvalue as $key => $vals)   
    {  
        $keysort[$key] = $key;  
    }  
      
    $new_array = array();  
    foreach($keysort as $key => $val)   
    {  
        $new_array[$key] = $source_array[$val];  
    }  
    return $new_array;  
}  
  
$source_array = array(31=>array('id'=>10001, 'name'=>'allen'),  
                      7=>array('id'=>10020, 'name'=>'bbb'),  
                      13=>array('id'=>10013, 'name'=>'fff'),  
                      45=>array('id'=>10024, 'name'=>'dddd'),  
                      65=>array('id'=>10076, 'name'=>'gggg'),  
                      12=>array('id'=>10047, 'name'=>'jjjj'),  
                      23=>array('id'=>10058, 'name'=>'hhh'),  
                      43=>array('id'=>10039, 'name'=>'kkkkk'),  
                      56=>array('id'=>10011, 'name'=>'iiiiii'));  
$result = array_sort($source_array, 'id', 0);  
print_r($result);    
获取    后缀名
function get_ext1($file_name)
{
	return substr(strrchr($file_name, '.'), 1);
}
function get_ext2($file_name)
{
	return substr($file_name, strrpos($file_name, '.')+1);
}
function get_ext3($file_name)
{
	$path = pathinfo($file_name);
	return $path['extension'];
}
function get_ext4($file_name)
{
	$file_name_array = explode('.', $file_name);
	return array_pop($file_name_array);
}
function get_ext5($file_name)
{
	$str = strrev($file_name);
	return strrev(substr($str, 0, strpos($str, '.')));
}

echo get_ext1('/a/b/c/d.class.php');
echo '<br/>';
echo get_ext2('/a/b/c/d.class.php');
echo '<br/>';
echo get_ext3('/a/b/c/d.class.php');
echo '<br/>';
echo get_ext4('/a/b/c/d.class.php');
echo '<br/>';
echo get_ext5('/a/b/c/d.class.php');
/** 
* 遍历目录，结果存入数组。支持php4及以上。php5以后可用scandir()函数代替while循环。 
* @param string $dir 
* @return array 
*/  
function my_scandir($dir)  
{  
    $files = array();  
    if ( $handle = opendir($dir) ) {  
        while ( ($file = readdir($handle)) !== false )   
        {  
            if ( $file != ".." && $file != "." )   
            {  
                if ( is_dir($dir . "/" . $file) )   
                {  
                    $files[$file] = my_scandir($dir . "/" . $file);  
                }  
                else   
                {  
                    $files[] = $file;  
                }  
            }  
        }  
        closedir($handle);  
        return $files;  
    }  
}  
  
function my_scandir1($dir)  
{  
    $files = array();  
    $dir_list = scandir($dir);  
    foreach($dir_list as $file)  
    {  
        if ( $file != ".." && $file != "." )   
        {  
            if ( is_dir($dir . "/" . $file) )   
            {  echo $file.'<br>';
                $files[$file] = my_scandir1($dir . "/" . $file);  
            }  
            else   
            {  
                $files[] = $file;  
            }  
        }  
    }  
      
    return $files;  
}  
function is_prime($n)
{  
	$m = ceil($n/2);	
	for ($i = 2; $i <= $m; $i++) 
	{
		//如果有可以被整除数，说明此数n不是质数
		if ($n % $i == 0) 
			return 0;
		
	}
	
	return 1;
}
// （输入1到100间的所有素数）
for($i=2;$i<=100;$i++)
 {
  $flag=1;
  for($j=2;$j<=sqrt($i);$j++)
   if(!($i%$j)) $flag=0; 
  if($flag)
   echo "$i<br/>";
 }
// 求100以内的质数和。
$first=2;  
$last=100;
for($i=$first;$i<=$last;$i++){  
	$arr[$i]=1;  
	for($j=2;$j<=ceil($i/2);$j++){  
		if(fmod($i,$j)==0){  
		$arr[$i]=0;  
		break;  
		}  
	}  
}  

// 按照权重随机item的代码
$w = array('a' =>1, 'b'=>10, 'c'=>14, 'e'=>20, 'f'=>30, 'h'=>6, 'g'=>70);
function roll($weight)
{
    $sum = array_sum($weight);
    $j = 0;
    foreach($weight as $k=>$v)
    {
        $j = mt_rand(1,$sum);
        if($j <= $v)
        {
            return $k;
        }else{
            $sum -= $v;
        }
    }
}
$ret = array();
$n = 1000;
for($i=0;$i<$n;$i++)
{
    $v = roll($w);
    $ret[$v] = isset($ret[$v]) ? $ret[$v] + 1 :1;
}
print_r($ret);
foreach($ret as $k=>$v)
{
     printf("real: %f\t", ($v / $n));
     printf("set: %f\n",($w[$k] / array_sum($w)));
}
function GetIpLookup($ip = ''){  
    if(empty($ip)){  
        $ip = GetIp();  
    }  
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
    if(empty($res)){ return false; }  
    $jsonMatches = array();  
    preg_match('#\{.+?\}#', $res, $jsonMatches);  
    if(!isset($jsonMatches[0])){ return false; }  
    $json = json_decode($jsonMatches[0], true);  
    if(isset($json['ret']) && $json['ret'] == 1){  
        $json['ip'] = $ip;  
        unset($json['ret']);  
    }else{  
        return false;  
    }  
    return $json;  
}  
  
  
$ipInfos = GetIpLookup('106.2.187.202'); //baidu.com IP地址 
```



[数据字典,data-dictionary,数据库字段文档,db-doc](https://github.com/CallMeNP/DBDict)
[数据字典自动生成文档 https://blog.lerzen.com](https://github.com/jormin/laravel-ddoc)
[开始使用PHPUnit](http://bayescafe.com/php/getting-started-with-phpunit.html)
```js
├── phpunit.xml
├── src
│   ├── autoload.php
│   └── Money.php
└── tests
    └── MoneyTest.php
    
function __autoload($class){
    include $class.'.php';
}

spl_autoload_register('__autoload');
在项目根目录下执行：phpunit tests/MoneyTest
```

[PHP实现长轮询](http://bayescafe.com/php/implementing-long-polling-with-php.html)
```js

$result = $mysql->query($sql);

//如果没有取到数据，且执行时间小于30秒，则暂停1秒后重新查询
while($result->num_rows == 0 && (time()-$begintime<30))
{
    sleep(1);
    $result = $mysql->query($sql);
}

//用JSON返回数据
$ret = array();
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $ret[]=array('id'=>$row["id"],'nick'=>$row["nick"],'content'=>$row["content"]);
    }
}

echo json_encode($ret);

$mysql->close();
function chat_update() 
{
    $.ajax({
        url: "chatview.php",
        //取最后一条ID之后的数据
        data: {begin: window.Lastid},
        cache: false,
        success: function (data) {
            //将数据填入页面上
            resolveMsg(data);
            chat_update();
        },
        error: function(){
            chat_update();
        }
    });
} set_time_limit会导致死循环，你这个跑久了服务器会崩的。可以用RS服务实现实时推送，开发文档见http://doc.hostker.com/realtime-sock.html
```
[JavaScript条形码生成和扫码识别(Barcode scan)开源库](http://ourjs.com/detail/58bd0c8c4edfe07ccdb234e9)
[QRCode:用纯JavaScript实现的微信二维码图片生成器](http://ourjs.com/detail/55e412ebe3312b046d27f51c)
<div id="qrcode"></div>
<script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "http://davidshimjs.github.io/qrcodejs/");
</script>
[安全宝「约宝妹」代码审计CTF题解](http://bayescafe.com/php/yuebaomei-ctf.html)
![p](http://bayescafe.com/usr/uploads/2015/02/1008817134.png)
```js
var_dump("1" == "01"); // 1 == 1 -> true
var_dump("10" == "1e1"); // 10 == 10 -> true
var_dump(100 == "1e2"); // 100 == 100 -> true
三个正则比较简单，就不细说了，分别是：

可见字符超过12个
字符串中，把连续的大写，小写，数字，符号作为一段，至少分六段，例如a12SD+io8可以分成a 12 SD + io 8六段
大写，小写，数字，符号这四种类型至少要出现三种
符合这三个要求的字符串很容易构建，关键是最后还要使$password=="42"。
var_dump("42"=="0x2A");
可以用4.2e1也可以用420e-1，不过第二种可以额外提供一个-符号，在第二个里加上小数点，420.0e-1，就满足正则2和正则3了。为了满足正则1，在里面再加几个零，就是我最后的答案：

420.00000e-1
var_dump("\x34\x32\x2E"=="42");//bool(true)
在PHP中，如果在双引号里放转义字符，在赋值的时候就会转义。例如

$a = "\x34\x32\x2E";
echo $a;//42.
echo strlen($a);//3
var_dump($a=="42");//bool(true)
而通过POST提交，浏览器会对转义字符做转换，服务器拿到的相当于在单引号里赋值的字符串（值为%5Cx34%5Cx32%5Cx2E）：

$b = '\x34\x32\x2E';
echo $b;//\x34\x32\x2E
echo strlen($b);//12
var_dump($b=="42")//bool(false);

$flag = "THIS IS FLAG";

if  ("POST" == $_SERVER['REQUEST_METHOD'])
{
    $password = $_POST['password'];
    if (0 >= preg_match('/^[[:graph:]]{12,}$/', $password))
    {
        echo 'Wrong Format';
        exit;
    }

    while (TRUE)
    {
        $reg = '/([[:punct:]]+|[[:digit:]]+|[[:upper:]]+|[[:lower:]]+)/';
        if (6 > preg_match_all($reg, $password, $arr))
        break;

        $c = 0;
        $ps = array('punct', 'digit', 'upper', 'lower');
        foreach ($ps as $pt)
        {
            if (preg_match("/[[:$pt:]]+/", $password))
            $c += 1;
        }

        if ($c < 3) break;
        if ("42" == $password) echo $flag;
        else echo 'Wrong password';
        exit;
    }
}

CTF训练营，IDF实验室做的CTF在线解题网站，喜欢CTF的同学可以多刷刷题，组个队去参加真正的CTF比赛。
```
[微信抢红包插件示例代码及其实现原理](http://ourjs.com/detail/58da6a724edfe07ccdb23535)
[从一行JavaScript代码生成随机字符串说起](http://bayescafe.com/webfrontend/generate-random-string-in-javascript.html)
```js
function generateUIDNotMoreThan1million() {
    return ("0000" + (Math.random()*Math.pow(36,4) << 0).toString(36)).slice(-4)
}
在这里要生成的是一个4位字母数字混合的字符串，他把这个字符串看作了一个4位的36进制数字（10个数字+26个字母）。这个数字的上限用十进制表示是36的4次方。因此通过Math.random()*Math.pow(36,4)可以获得一个从0到36^4范围内的随机数字（带小数）。

然后使用<< 0截断这个数字的小数位。因为<<操作符会把操作数转换成整数，就像《从一行CSS》里的~~一样。

接下来使用.toString(36)将这个十进制整数转换成36进制。Number.prototype.toString方法接受一个2-36的整数参数，可以用来作进制转换。

然后"0000"+在左侧补全，再用slice(-4)截取右4位。这样可以在生成的字符串位数不够4位时在左侧补0。

这样就可以获得一个由数字和小写字母组成的4位随机字符串了
("0000000" + (Math.random()*Math.pow(36,7) << 0).toString(36)).slice(-7)
超过2147483647的数字在按位左移之后会得到负数，而不仅仅是取整。那么，最多生成几位的随机字符串时，这种方法是安全的？答案是log36(2147483647)=5.996，5位。

想要获得更长的字符串怎么办？也很简单啦，只要用Math.floor代替<<取整就可以了

生成6位颜色码 Math.random().toString(16).substr(-7, 6);

同样的道理 生成带数字和字母的随机数 Math.random().toString(36).substr(-7, 6); http://ourjs.com/detail/54be0a98232227083e000012
```

[强大的微信开发组件/服务](http://www.weixingate.com/)
[PHP中三元运算符的结合性](http://bayescafe.com/php/the-associativity-of-ternary-operator-in-php.html)
```js
echo 1?'a':0?'b':'c';
输出的结果为b。

这是因为，在C语言中，表达式1?'a':0?'b':'c'被解释为

1 ? 'a' : ( 0 ? 'b' : 'c' )
而在PHP中，被解释为

( 1 ? 'a' : 0 ) ? 'b' : 'c'
也即，在PHP中，三元运算符是左结合的 https://eev.ee/blog/2012/04/09/php-a-fractal-of-bad-design/#operators
```
[PHP上传文件时$_FILES数组为空](http://bayescafe.com/php/php-upload-found-files-array-empty.html)
```js
有三个上传文件的大小限制：

php.ini 里的 upload_max_filesize
php.ini 里的 post_max_size
nginx.conf 里的 client_max_body_size
假设只上传一个文件，此时会出现三种不同的情况：

a) 文件大于1，小于2
b) 文件大于2，小于3
c) 文件大于3
a情况中。超过php.ini中upload_max_filesize的值，可以在PHP中得到$_FILES['file']['error']==1。

c情况中，超过nginx.conf中的client_max_body_size，Nginx会返回413 Request Entity Too Large错误。

在b情况中，你能看到的就是$_FILES数组为空（即isset($_FILES['file']==FALSE）。

此时就出现了两种可能，一种是客户端的表单里没有file这个字段，另一种是有超限的附件使表单的大小超过了post_max_size。

如果客户端是网页，那还比较好办，在HTML表单里，文件类型的input即使没有选择文件，$_FILES['file']也是在的，此时服务器端拿到的应该是$_FILES['file']['error']==4错误。因此当出现$_FILES为空时，就可以告诉用户上传文件过大了（前提是你确定表单没有问题，尤其是没有忘记加enctype="multipart/form-data"属性）。

如果客户端是App的话，作为后端程序员难免有点拿不准客户端究竟传没传文件。这时还有一个办法，就是取Header中的Content-Length。也就PHP里的$_SERVER['CONTENT_LENGTH']，如果是没有传文件的话，纯文本的表单体积很小，通常在几十几百，而如果传了一个超过8M的文件，Content-Length会大于8388608。因此可以用ini_get('upload_max_filesize')取出upload_max_filesize的值，换算成字节数与Content-Length比较一下，来确定是哪种情况。

最后要说的是，尽管上面只讨论了上传单文件，但是这种错误更多见于一张表单上传多个文件，上传多个文件时，虽然每个文件的大小都小于upload_max_filesize，但是若多个文件加起来大于post_max_size，就会触发这个错误。debug时只看单个文件的大小，没有注意所有文件的总大小，bug就会时隐时现，非常让人头疼。不过话说回来，以现在公网的网速来讲，提交这么大的POST请求体验太差了，还是采取Ajax的方式逐个上传好一点。
```
[Laravel的核心概念](https://blog.lerzen.com/articles/34d733c0-1234-11e7-8029-9f45782468d5)
[Laravel5导入全球国家信息](https://blog.lerzen.com/articles/d4849d70-0fca-11e7-8e7c-ed6df2003de5)
composer require webpatser/laravel-countries  http://phplib.lerzen.com/country
$ # 使用 Composer 创建项目
  $ composer create-project --prefer-dist laravel/laravel [项目名称]
  $ # 也可以指定创建的Laravel框架版本
  $ composer create-project --prefer-dist laravel/laravel [项目名称] "5.3.*"
  
  
    $ # 使用 Composer 下载 Laravel 安装包
  $ composer global require "laravel/installer"
  $ # 创建项目
  $ laravel new [项目名称]
[全新环境安装Homestead](https://blog.lerzen.com/articles/41bbec30-0fcb-11e7-9d5a-097d182109fa)
[一步一步教你部署自己的Laravel应用程序到服务器](https://lufficc.com/blog/step-by-step-teach-you-to-deploy-your-laravel-application-to-server)

https://www.laravist.com/series/deploy-laravel-app-on-vps 
[Laravel邮件、事件、队列浅谈](https://blog.lerzen.com/articles/09440f70-1202-11e7-8330-9358a635e7ff)
[Nginx 有一个主线程（ master process）和几个工作线程（worker process）。主线程的目的是加载和验证配置文件、维护工作线程。](https://lufficc.com/blog/nginx-for-beginners)
```js
events 和 http 放置在主配置文件中，server 放置在http块指令中，location放置在server块指令中。 
如果 URI 匹配多个 location 块，Nginx 采用最长前缀匹配原则（类似计算机网络里面的IP匹配）
server {
    location / {
        root /data/www;
    }

    location /images/ {
        root /data;
    }
}用一个 Nginx 实例实现对图片文件的请求使用本地文件系统，而其他请求转发到代理服务器。
server {
    listen 8080;
    root /data/up1;

    location / {
    }
}
server {
    location / {
           # proxy_pass指令的参数为：协议+主机名+端口号
        proxy_pass http://localhost:8080;
    }

    location /images/ {
        root /data;
    }
}
使用fastcgi_pass指令替换proxy_pass指令，并将参数更改为 localhost:9000 。 在 PHP 中， SCRIPT_FILENAME 参数用于确定脚本名称，而 QUERY_STRING 参数用于传递请求参数。
server {
    location / {
        fastcgi_pass  localhost:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param QUERY_STRING    $query_string;
    }

    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```
[自己搭建 Shadowsocks 服务器科学上网 N 种姿势](https://lufficc.com/blog/vpn)
[Laravel的核心概念](https://lufficc.com/blog/the-core-conception-of-laravel)
每一次请求结束，Php的变量都会unset，Laravel的singleton只是在某一次请求过程中的singleton；你在Laravel 中的静态变量也不能在多个请求之间共享，因为每一次请求结束都会unset。




[在PHP中生成守护进程(Daemon Process)](http://bayescafe.com/php/create-daemon-process-with-php.html)
```js

function run()
{
    //第一次fork，父进程与子进程在此分开
    if(($pid1 = pcntl_fork()) === 0)
    {
        //子进程在此成为会话组leader
        posix_setsid();

        //第二次fork，子进程与孙子进程在此分开
        if(($pid2 = pcntl_fork()) === 0)
        {
            //孙子进程成为守护进程，开始处理任务
            handle_http_request('www.codinglabs.org', 9999);
        }
        else
        {
            //子进程退出，将孙子进程交由init托管
            exit;
        }
    }
    else
    {
        //父进程在此等待子进程的退出信号
        pcntl_wait($status);
    }
}
if(($pid1 = pcntl_fork()) === 0)
{
    //子进程执行此处的代码
}
else
{
    //父进程执行此处的代码
}

```
[MySQL 分页查询性能比较](https://www.v2ex.com/t/351908#reply20)

SELECT * FROM API_LOG a JOIN (select ID from API_LOG LIMIT 0, 10) b ON a.ID = b.ID

SELECT * FROM API_LOG WHERE ID IN ( SELECT * FROM (SELECT ID FROM API_LOG LIMIT 0, 10) t)
WHERE IN 又子查询在 mysql 上的实现似乎是上一级的查询的每一条数据做一次子查询， mysql 文档上似乎有详细解释  加 SELECT * FROM 是 MySQL 不允许 Limit IN 在子查询里面  覆盖索引的意思就是指直接通过索引的查询就能获取到数据。例如： select id from table 这个 id 是主键，仅仅通过索引查询就能返回结果， select * from table 这里则需要先查到主键，再通过主键获取剩余字段的值，这也就是为什么前者比后者快。
[用 select * from table where in 来查找， in 里面有 50 个学号，但是 select 出来只有 40 个，我改如何找出在数据库中不存在的学号](https://www.v2ex.com/t/351690#reply12)
SELECT 
* 
FROM table1 t1 
LEFT JOIN table2 t2 ON t1.id = t2.id 
WHERE t2.id IS NULL
先做一次初始化，然后把有的数据更新，最后查未更新过的。 

解决方案非常不优化，但胜在快速简单...   NOT IN 是数据库中存在但不匹配 IN 列表的项。
[服务端一般怎么处理 token？](https://www.v2ex.com/t/351950)
很多都是不存，即用 JWT 
[javascript 之隐藏你的代码](http://blog.mango16.cc/2017/02/20/hiderjs/)
```js
在 unicode 里有一种神奇的字符叫 零宽空白，它的特点是字型的显示宽度为 0，无论堆了多少个零宽字符，你都看不见它
每个字符都有一个唯一的编码，将编码以 2 进制表示得到 01.. 的字串，把 1 替换成 U+200C，把 0 替换成 U+200D 就得到一个全零宽空白的字符串，每 8 位零宽字符可用于表示 1 个 ascii字符，所以例子当中，理论上是变长的，不算解码程序的 129 个字符，仅空白就占了原文 8 倍的体积，如果出现中文，那就更不止了，因为中文已经超过了 ascii 的范围，需要先转成纯 ascii （如以 \uxxxx 表示）后再处理。
在 unicode 里，至少有 U+200B, U+200C, U+200D 和 U+FEFF 四个零宽字符，如果把这 4 个字符全用上，上面的例子又可以减少 1 半的体积

function(window) {
    var rep = { // 替换用的数据，使用了4个零宽字符，数据量减少了一半。
        '00': '\u200b',
        '01': '\u200c',
        '10': '\u200d',
        '11': '\uFEFF'
    };
    function hide(str) {
        str = str.replace(/[^\x00-\xff]/g, function(a) { // 转码 Latin-1 编码以外的字符。
            return escape(a).replace('%', '\\');
        });
        str = str.replace(/[\s\S]/g, function(a) { // 处理二进制数据并且进行数据替换
            a = a.charCodeAt().toString(2);
            a = a.length < 8 ? Array(9 - a.length).join('0') + a : a;
            return a.replace(/../g, function(a) {
                return rep[a];
            });
        });
        return str;
    }
    var tpl = '("@code".replace(/.{4}/g,function(a){var rep={"\u200b":"00","\u200c":"01","\u200d":"10","\uFEFF":"11"};return String.fromCharCode(parseInt(a.replace(/./g, function(a) {return rep[a]}),2))}))';
    window.hider = function(code, type) {
        var str = hide(code); // 生成零宽字符串
        str = tpl.replace('@code', str); // 生成模版
        if (type === 'eval') {
            str = 'eval' + str;
        } else {
            str = 'Function' + str + '()';
        }
        return str;
    }
})(window);
```
[全栈数据工程师养成攻略](https://zhuanlan.zhihu.com/fullstack-data-engineer)

[ Mac 下文件名大小写不敏感](http://blog.mango16.cc/2017/03/10/everyday/)
```js
$ git mv --force myfile MyFile
#修改git配置，不忽略大小写
git config core.ignorecase false
 git push --delete origin branch_name 删除git 远程的分支
$ git push origin dev -f
netstat -apn|grep 7782
tcp        0      0 :::80                       :::*                        LISTEN      19408/java 
#那么进程号就是`19408`
再通过`ps -ef | grep 19408` 就知道这个进程是啥了。 Linux下查看一个端口被哪个占用进程
php --ini
显示当前加载的php.ini绝对路径
php --re swoole
显示某个扩展提供了哪些类和函数。
php --ri swoole
显示扩展的phpinfo信息。与phpinfo的作用相同，不同之处是这里仅显示指定扩展的phpinfo
php --rf file_get_contents
显示某个PHP函数的信息，一般用于检测函数是否存在
set_error_handler PHP中用来捕获自定义的错误信息
public function aaa()
{
    function customError($errno, $errstr, $errfile, $errline)
    {
        echo "<b>Custom error:</b> [$errno] $errstr<br />";
        echo " Error on line $errline in $errfile<br />";
        echo "Ending Script";
        die();
    }
    //set error handler， 第二个参数是可以设置需要捕获的错误类型
    set_error_handler("customError", E_ALL | E_WARNING);
    //$a 没定义，应该会有一个错误：
    var_dump($a);
}
redis MONITOR 监控redis的所有的被执行的命令
//在程序之外用管道监控某一个命令。
redis-cli -h 172.16.71.70 -p 6379 MONITOR|grep medal:rank:9
1472647383.968024 [0 172.16.71.67:48460] "ZINCRBY" "medal:rank:9" "1.0000000000000000" "12436136

```
[猴子选大王算法](http://blog.mango16.cc/2016/06/05/monkeyKing/)
有M个monkey ，转成一圈，第一个开始数数，数到第N个出圈，下一个再从1开始数，再数到第N个出圈，直到圈里只剩最后一个就是大王 【单项循环数据链表】
```js
class MonkeyKing
{ 	
	var $next;
   	var $name;
   public function __construct($name)
   {
       $this->name = $name;
   }
   public static function whoIsKing($count, $num)
   {
       /************* 构造单向循环链表 ******************/
       // 构造单向循环链表
       $current = $first = new MonkeyKing(1);
       for($i=2; $i<=$count; $i++)
       {
           $current->next = new MonkeyKing($i);
           $current = $current->next;
       }
       // 最后一个指向第一个
       $current->next = $first;
       // 指向第一个
       $current = $first;
       /*************** 开始数数 *********************/
       // 定义一个数字
       $cn = 1;
       while($current !== $current->next)
       {
           $cn++;  // 数数
           if($cn == $num)
           {
               $current->next = $current->next->next;
               $cn = 1;
           }
           $current = $current->next;
       }
       // 返回猴子王的名字
       return $current->name;
   }
}
// 共10个猴子每3个出圈
echo MonkeyKing::whoIsKing(10,3);
```
[因为这篇EXCEL教程，我卸载了王者荣耀。](https://zhuanlan.zhihu.com/p/26150579)
[Edward 是一个用于概率建模、推理和评估的 Python 库。](https://edward-cn.readthedocs.io/zh/latest/)
[关于 MySQL 你可能不知道的 SQL 使用技巧](https://zhuanlan.zhihu.com/p/25064592)
```js
select 'product' as type, count(*) as count from `products`
union
select 'comment' as type, count(*) as count from `comments`
order by count;
我们通过 UNION 语法同时查询了 products 表 和 comments 表的总记录数，并且按照 count 排序。

ERROR 1093 (HY000): You can't specify target table 'xxx' for update in FROM clause
这样的错误产生的原因是：MySQL 不支持同一个 SQL 语句尝试对同一个表进行查询和修改两个操作。

删除没有评论的文章这条语句

delete from articles 
where id in (
select a.id from articles as a left join comments as c on a.id=c.article_id 
where c.is is NULL
)
articles 表既被查询，也被更新，将出现上面的错误。

但是，如果 DELETE 结合 JOIN，则可以直接写出这样的 SQL 语句，简洁许多：

delete s from articles as a 
left join comments as c on a.id=c.article_id 
where c.is is NULL
当然，UPDATE 也是同理：

update articles as a 
left join comments as c on a.id=c.article_id 
set a.deleted=1 
where c.is is NULL



```
[python 抓取任何网站 HTTPError: HTTP 599: Resolving timed out](https://segmentfault.com/q/1010000007809233)
我今天也遇到这个问题，经过千百次不同的尝试，终于发现了问题所在。只需禁用你当前所使用的网络的ipv6访问即可
[【位运算经典应用】 寻找那个唯一的数](http://www.cnblogs.com/zichi/p/4795049.html)
[PHPExcel 类库](https://mp.weixin.qq.com/s?__biz=MjM5OTgxMTIwMw==&mid=2447558518&idx=1&sn=b802b4a22bc211e7bf9e7113c1fd6547&chksm=b323a69a84542f8ceea83cd49dd3d111df96bd34a4afc0f996af679708c9acfbd094f99d6773#rd)
\w 包括字母数字下划线，但不包括减号
[如何用Jq 对数组重复对象去重？](https://segmentfault.com/q/1010000008935350)
```js
var arr=[{id:1,X: 3, Y: 4},{id:2,X: 3, Y: 4},{id:2,X: 3, Y: 4},{id:4,X: 3, Y: 4},{id:5,X: 3, Y: 4}];
    var hash = {};
    var result = [];
    for(var i = 0, len = arr.length; i < len; i++){
        if(!hash[arr[i].id+arr[i].X+arr[i].Y]){
            result.push(arr[i]);
            hash[arr[i].id+arr[i].X+arr[i].Y] = true;
        }
    }
    console.log(result);
```
[Python 代码应该如何修改才能正确运行？](https://segmentfault.com/q/1010000008930570)
class Solution(object):
    def test(self):
        ans = 0
        def fn():
            nonlocal ans
            ans = max(ans, 10)
            return ans

        print(fn())

obj = Solution()
obj.test()
[js倒计时代码](https://segmentfault.com/q/1010000008928904)
var c1t = setInterval("count1()",1000);
function count1(){
    if(num1>=1){
        cerCount.innerHTML=num1;
        num1--;
    }else if(num1==0) {
        divs[0].className=null;
        divs[1].className="current";
        clearInterval(c1t);
        setInterval("count2()",1000);
    }
}

window.document.body.innerHTML= printData.innerHTML;https://segmentfault.com/q/1010000008926575
[python3读取chrome浏览器cookies](http://www.cnblogs.com/gayhub/p/pythongetcookiefromchrome.html)
```js
"""
python3从chrome浏览器读取cookie
get cookie from chrome
2016年5月26日 19:50:38 codegay

"""
import os
import sqlite3
import requests
from win32.win32crypt import CryptUnprotectData

def getcookiefromchrome(host='.oschina.net'):
    cookiepath=os.environ['LOCALAPPDATA']+r"\Google\Chrome\User Data\Default\Cookies"
    sql="select host_key,name,encrypted_value from cookies where host_key='%s'" % host
    with sqlite3.connect(cookiepath) as conn:
        cu=conn.cursor()        
        cookies={name:CryptUnprotectData(encrypted_value)[1].decode() for host_key,name,encrypted_value in cu.execute(sql).fetchall()}
        print(cookies)
        return cookies

#运行环境windows 2012 server python3.4 x64 chrome 50
#以下是测试代码
#getcookiefromchrome()
#getcookiefromchrome('.baidu.com')

url='http://my.oschina.net/'

httphead={'User-Agent':'Safari/537.36',}

#设置allow_redirects为真，访问http://my.oschina.net/ 可以跟随跳转到个人空间
r=requests.get(url,headers=httphead,cookies=getcookiefromchrome('.oschina.net'),allow_redirects=1)
print(r.text)
```
[爬虫去爬取51job里的招聘信息](https://segmentfault.com/q/1010000008924427)
```js
import requests
from lxml import etree
import re

headers = {"Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
               "Accept-Encoding": "gzip, deflate",
               "Accept-Language": "en-US,en;q=0.5",
               "Connection": "keep-alive",
               "Host": "jobs.51job.com",
               "Upgrade-Insecure-Requests": "1",
               "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0"}

def generate_info(url):
    html = requests.get(url, headers=headers)
    html.encoding = 'GBK'
    select = etree.HTML(html.text.encode('utf-8'))
    job_id = re.sub('[^0-9]', '', url)
    job_title=select.xpath('/html/body//h1/text()')
    print(job_id,job_title)

sum_page='http://search.51job.com/jobsearch/search_result.php?fromJs=1&jobarea=070200%2C00&district=000000&funtype=0000&industrytype=00&issuedate=9&providesalary=06%2C07%2C08%2C09%2C10&keywordtype=2&curr_page=1&lang=c&stype=1&postchannel=0000&workyear=99&cotype=99&degreefrom=99&jobterm=99&companysize=99&lonlat=0%2C0&radius=-1&ord_field=0&list_type=0&dibiaoid=0&confirmdate=9'
sum_html=requests.get(sum_page)
sum_select=etree.HTML(sum_html.text.encode('utf-8'))
urls= sum_select.xpath('//*[@id="resultList"]/div/p/span/a/@href')

for url in urls:
    generate_info(url)

```
[python如何手动实现阻塞](https://segmentfault.com/q/1010000008924200)
while True:
    ＃ 等待一年
    time.sleep(60*60*24*365)
    
# 直接等待一百年
time.sleep(60*60*24*365*100)
condition=threading.Condition()
condition.acquire()
condition.wait()
[抓取一个代理ip网页，使用cookie但是报错](https://segmentfault.com/q/1010000008927935)
他把重要的key隐藏到js中，并通过eval函数进行转换跳转，起到一个混搅代码的作用，使用selenium的话也许可以解决这个问题

[python如何相加加法](https://segmentfault.com/q/1010000008938541)
>>> def sum(*args):
...     r = 0.0
...     for n in args:
...             r += float(n)
...     return "%.2f" % r
...
>>> sum('1.1', '2.2')
'3.30'
>>> sum('1.1', '2.2', 3.3)
'6.60'
>>> num=['276.30','1,446.90','23,456.80']
>>> "%.2f" % sum(map(lambda s:float(s.replace(',','')),num))
'25180.00'
[mysql索引与数据是怎样关联的](https://segmentfault.com/q/1010000008831966)
1、主键存储数据行的物理地址，普通索引关联主键
2、所有数据
3、关联主键存储多行
[Laravel在database.php加上强制mysql预处理后出现问题](https://segmentfault.com/q/1010000008849888)
$item对象对应的is_display字段值为string类型的，导致$child为空
[limit前面加上order by 索引查询性能会更好？](https://segmentfault.com/q/1010000008862044)
如果不加索引，SELECT * FROM sys_client LIMIT 100000,10会将全表扫描，然后取第100001~100010这10条记录； 
加了索引之后，就只检索100010条记录，而不是全表检索，所以执行效率会更好！
[laravel5.1路由一个非常奇怪的问题](https://segmentfault.com/q/1010000008854296)
Route::get('admin/login', 'Admin\AuthController@getLogin');
Route::get('adminasds/login', 'Admin\AuthController@getLogin');
在public目录下有admin文件夹
[laravel 关闭指定控制器方法的CSRF后获取不到session吗](https://segmentfault.com/q/1010000008893817)
既然要关闭CSRF，那么这个URL的来源可能是来自于 SWF、其他途径

如果基于浏览器访问当前Domain的页面，这不可能会丢失Session的

我猜测可能场景是 使用Flash上传文件，那么的确会出现丢失Cookie的情况(Cookie和Session有什么关系)

一般情况下，我会把Session ID附加到这些场景的POST的字段、或上传的URL中：url?session_id=<?php echo session_id();?>

然后在控制器里面重设SessionID：

session_id($_GET['seesion_id']);
Session::setId($_GET['seesion_id']);
[laravel toArray()方法内存泄露,](https://segmentfault.com/q/1010000008903003)
 $query->chunk(1000, function ($data) use (&$firstWrite, $fp) {
    Log::info("开始:".memory_get_usage());
    $data = $data->toArray();
    Log::info("结束:".memory_get_usage());
    unset($data);
    Log::info("usnet 结束:".memory_get_usage());
});

DB::table("coupons")->orderBy("id")->chunk(1000, function ($data){
   $data=json_decode(json_encode($data),true);
});
有哪些可视化大数据三方应用推荐呢https://segmentfault.com/q/1010000008873761
https://www.qcloud.com/product/RayData  https://data.aliyun.com/visual/datav?spm=5176.8142029.388261.109.9ZNB5N https://github.com/airbnb/superset
大文本数据合并问题思路https://segmentfault.com/q/1010000008909291  https://github.com/BurntSushi/xsv
python编写爬虫，返回http error 521怎么解决https://segmentfault.com/q/1010000008880517
import execjs
import re
import requests

url = "http://www.kuaidaili.com/proxylist/1/"

HERDERS = {
    "Host": "www.kuaidaili.com",
    'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36',
}


def executejs(html):
    # 提取其中的JS加密函数
    js_string = ''.join(re.findall(r'(function .*?)</script>',html))

    # 提取其中执行JS函数的参数
    js_func_arg = re.findall(r'setTimeout\(\"\D+\((\d+)\)\"', html)[0]
    js_func_name = re.findall(r'function (\w+)',js_string)[0]

    # 修改JS函数，使其返回Cookie内容
    js_string = js_string.replace('eval("qo=eval;qo(po);")', 'return po')

    func = execjs.compile(js_string)
    return func.call(js_func_name,js_func_arg)

def parse_cookie(string):
    string = string.replace("document.cookie='", "")
    clearance = string.split(';')[0]
    return {clearance.split('=')[0]: clearance.split('=')[1]}

# 第一次访问获取动态加密的JS
first_html = requests.get(url=url,headers=HERDERS).content.decode('utf-8')

# 执行JS获取Cookie
cookie_str = executejs(first_html)

# 将Cookie转换为字典格式
cookie = parse_cookie(cookie_str)
print('cookies = ',cookie)

# 带上cookies参数，再次请求
response = requests.get(url=url,headers=HERDERS,cookies=cookie)
print(response.status_code)
Xpath 为什么爬取不到内容https://segmentfault.com/q/1010000008885973
在写爬虫的时候，使用xpath一定要确认一下网页的源代码中是否有数据，如果没有，说明是异步加载的
view-source:https://image.baidu.com/search/flip?tn=baiduimage&ie=utf-8&word=%E6%9A%B4%E8%B5%B0%E6%BC%AB%E7%94%BB&pn=0

[laravel 的 Eloquent 设置排序的时候怎么以两个字段的差来排序？](https://segmentfault.com/q/1010000008829128)
orderByRaw(string $sql, array $bindings = array())方法，直接把排序的sql写在第一个参数就可以了
-- mysql原語句
select (click-num) click_num from table order by click_num desc
// laravel寫法，如果ORM，則自行調整
DB::table('table)->selectRaw('(click-num) as click_num')->orderBy('click_num', 'desc')->get()
[用JS读取出 arr 字符串中每个字母重复出现的次数](https://segmentfault.com/q/1010000008924203)
var arr='asfacfagsahvahvxssaaxssxs';

var info = arr
     .split('')
     .reduce( (p,k) => (p[k]++ || (p[k]=1) ,p ),{});

console.log(info);

var info = arr
     .reduce( (p,k) => {
         if (p[k]) {
             p[k]++
         } else {
             p[k]=1
         }
         return (p);
     }, {});
     
抓取天猫详情页里面的月销量，反爬非常厉害https://segmentfault.com/q/1010000008843066 
https://segmentfault.com/q/1010000008867745
Python2 BeautifulSoup 提取网页中的表格数据及连接https://segmentfault.com/q/1010000008859379
# coding:utf-8

import requests

r = requests.get('http://nufm.dfcfw.com/EM_Finance2014NumericApplication/JS.aspx?type=CT&cmd=C._BKGN&sty=FPGBKI&st=c&sr=-1&p=1&ps=5000&token=7bc05d0d4c3c22ef9fca8c2a912d779c&v=0.12043042036331286')
data = [_.decode('utf-8').split(',') for _ in eval(r.text)]

url = 'http://quote.eastmoney.com/center/list.html#28003{}_0_2'
lst = [(url.format(_[1].replace('BK0', '')), _[2]) for _ in data]
print lst
https://segmentfault.com/q/1010000008870050 
Python读取文件每行记录并转存为字典格式的数据https://segmentfault.com/q/1010000008847767
f = open('1', 'r')                  
result = {}
for line in f.readlines():
    line = line.strip()
    if not len(line):
        continue
    result[line.split(':')[0]] = line.split(':')[1]
f.close()
print result
with open('test.txt', 'r') as f:
    result = dict(line.strip().split(':') for line in f if line)
print(result)


[Cannot read property 'appendChild' of null](https://segmentfault.com/q/1010000008935520)
执行js的时候body还没加载，把script放在body内部或者用window.onload把js包起来可以解决问题
错误指向这一行 document.body.appendChild(table);
[python-在微信上假装我是小冰](https://zhuanlan.zhihu.com/p/25912740)
http://link.zhihu.com/?target=https%3A//github.com/BestJuly/just_for_fun 

[初学Python--微信好友/群消息防撤回，查看相关附件](https://zhuanlan.zhihu.com/p/25744154?group_id=824799146052587520)
http://link.zhihu.com/?target=https%3A//github.com/ZKeeer/WeChatForRevocation.git
[初学python--小脚本解决大问题（实时推送闲鱼某关键词最新动态）](https://zhuanlan.zhihu.com/p/25843989)
http://link.zhihu.com/?target=https%3A//github.com/ZKeeer/fSeach.git
[一个简单的微信自动回复机器人的实现](https://github.com/pannzh/pyweixin)
[深入理解PHP之：Nginx 与 FPM 的工作机制](https://zhuanlan.zhihu.com/p/20694204)
fpm 是进程管理器，同时也实现了 fastcgi 协议，使用 master-worker 模型管理 php 进程，master 负责 php 进程的调度，worker 负责具体 php 代码的执行。

然后就是你的「php-fpm是负责调度php-cgi的进程管理器」说法并不正确，fpm 管理的是 php，而非 php-cgi, php-cgi 是 cgi 协议的实现，使用 stdin 和 stdout 进行数据交换，每个请求都需要开启一个进程，性能是在太渣，现在应该没人用了~
1.nginx是web服务器，提供http服务。2.php代码需要php解析器解析。所以这里要有个nginx和php解析器通信的问题。就出现了一个fastcgi的协议来解决通信问题。


[能理解聊天记录的微信机器人 ](https://zhuanlan.zhihu.com/p/26010876)
http://link.zhihu.com/?target=https%3A//github.com/grapeot/WechatForwardBot 

和ElasticSearch和Kibana连了起来，现在有了实时监控和可视化了。能看到每小时平均有多少次自动回复，多少次看群里话唠，多少次看标签云。
[如何将自己的程序发布到 PyPI](https://zhuanlan.zhihu.com/p/26159930)
python setup.py register sdist upload
[img2html 用于将图片转化为 HTML 页面](https://github.com/xlzd/img2html)
```js
python3的话 ，手动改一下xrange-> range，78行的 next()--> char=next(self.char)。就好了。谢谢作者，有点意思。 -o 参数指定输出到哪里，或者默认到控制台上。 ！曾经我也搞过
https://github.com/hit9/img2txt
另外还有这个动画的
https://github.com/hit9/gif2txt  ./gif2txt.py test.gif -m 80 -o out.html http://hit9.github.io/gif2txt/out.html
https://github.com/upfain/html-img
 //参数1:图片url *
 //参数2:效果比例 默认2 (整数)  http://mengdc.applinzi.com/caicai.html
 //参数3:function
 htmlImg('img.jpg',1,function (html,tag) {
     //html 是一个生成的table标签的字符串
     //tag  为table标签
     document.body.appendChild(this)
 })
pip install img2html
from img2html.converter import Img2HTMLConverter

converter = Img2HTMLConverter(*some config here*)
html = converter.convert(*image_path*)
```
[我的工具包](https://github.com/xlzd/xtls)
https://github.com/xlzd/xPyToys 
[生成ascii文字](https://github.com/xlzd/xart)

xart test



[好像只有面试的时候考算法，但是在实际工作中算法几乎用不到](https://segmentfault.com/q/1010000008606058)
```js
你在学算法？你都学什么算法了？插入排序？？你学插入排序当然会用不到了！你要是学快排的话，抱歉，库都实现好了。

你学不实用，或者成熟的算法，当然很难用到了。前者根本用不到，后者已经被别人实现好了。

对于常见算法，最重要的是理解：它的时间复杂度、空间复杂度、功能特点等。然后呢，你就可以学点实现不是那么多的算法（比如 skiplist 啊，hyperloglog 啊，bloom filter 啊之类的。有些语言糙，连最大堆和 btree map 都没有，你需要的时候也可以去实现一个。当然前提是你知道你需要什么。

你自己的背景说得太少了，所以我不好举例。就说数据库查询吧，你知道 hash 索引和 btree 索引的差别吗？

至于面试。那是刚毕业的人，没什么实战经验，所以才会考算法这种学校里学的东西吧。不然面试会针对你应聘的工作内容来问的。当然那些大公司都很需要懂算法的人，创业公司就不怎么需要了。

再补充一点：会算法不等于会编程。很多人认为算法好就能写出好程序，are you kidding me？算法好的确能写出高效的程序，但是程序又不止高效这一方面。一个优秀的程序需要：

效率足够好
良好的可读性 / 可维护性
可扩展性
良好的用户界面（不管它是 GUI、TUI 还是命令行或者配置文件）
足够的支持性文档
良好的兼容性
易与其它程序配合工作
```




[nodejs客服聊天系统](https://segmentfault.com/q/1010000008018196)
https://gist.github.com/martinsik/2031681

[php7静态调用一个非静态方法, 会在静态调用中被提示未定义 $this, 并会报错](https://segmentfault.com/q/1010000007433025)
[PHP 7 的非向下兼容的里面可以找到](http://php.net/manual/zh/migration70.incompatible.php)
```js
// PHP 5 时代的代码将会出现问题
function handler(Exception $e) { ... }
set_exception_handler('handler');

// 兼容 PHP 5 和 7
function handler($e) { ... }

// 仅支持 PHP 7
function handler(Throwable $e) { ... }
在 INI 文件中，不再支持以 # 开始的注释行， 请使用 ;（分号）来表示注释。 此变更适用于 php.ini 以及用 parse_ini_file() 和 parse_ini_string() 函数来处理的文件。
 第一，数值不能以点号（.）结束 （例如，数值 34. 必须写作 34.0 或 34）。 第二，如果使用科学计数法表示数值，e 前面必须不是点号（.） （例如，3.e3 必须写作 3.0e3 或 3e3）
$str = "0xffff";
$int = filter_var($str, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_HEX); 检查一个 string 是否含有十六进制数字,并将其转换为integer:
var_dump("0x123" == "291");
var_dump(is_numeric("0x123")); 含十六进制字符串不再被认为是数字

```
[PHP内存溢出解决方案 数据量过大内存溢出解决方案](http://onwise.xyz/2017/02/08/php%e5%86%85%e5%ad%98%e6%ba%a2%e5%87%ba%e8%a7%a3%e5%86%b3%e6%96%b9%e6%a1%88/)
```js
ini_set(‘memory_limit’,’64M’);　//重置php可以使用的内存大小为64M，一般在远程主机上是不能修改php.ini文件的，只能通过程序设置。注：在safe_mode（安全模式）下，ini_set失效
 
set_time_limit(600);//设置超时限制为６分钟
 
$farr = $Uarr = $Marr = $IParr = $data = $_sub = array();
 
$spt = ”$@#!$”;
 
$root = ”/Data/webapps/VisitLog”;
 
$path = $dpath = $fpath = NULL;
 
$path = $root.”/”.date(“Y-m”,$timestamp);
 
$dpath = $path.”/”.date(“m-d”,$timestamp);
 
for($j=0;$j<24;$j++){
 
$v = ($j < 10) ? ”0″.$j : $j;
 
$gpath = $dpath.”/”.$v.”.php”;
 
if(!file_exists($gpath)){
 
continue;
 
} else {
 
$arr = file($gpath);////将文件读入数组中
 
array_shift($arr);//移出第一个单元－》<?php exit;?>
 
$farr = array_merge($farr,$arr);
 
unset($arr);
 
}
 
}
 
if(empty($this->farr)){
 
echo ”<p><center>没有相关记录！</center></p>”;
 
exit;
 
}
 
while(!empty($farr)){
 
$_sub = array_splice($farr, 0, 10000); //每次取出$farr中1000个
 
for($i=0,$scount=count($_sub);$i<$scount;$i++){
 
$arr = explode($spt,$_sub[$i]);
 
$Uarr[] = $arr[1]; //vurl
 
$Marr[] = $arr[2]; //vmark
 
$IParr[] = $arr[3].” |$nbsp;”.$arr[1]; //IP
 
}
 
unset($_sub);//用完及时销毁
 
}
 
unset($farr);

只有当指向该变量的所有变量（如引用变量）都被销毁后，才会释放内存。 unset()函数只能在变量值占用内存空间超过256字节时才会释放内存空间。

$farr=range(1,10);
while(!empty($farr)){
	print_r($farr);
 
$_sub = array_splice($farr, 0, 2); //每次取出$farr中2个
 
for($i=0,$scount=count($_sub);$i<$scount;$i++){
 
 
$Uarr[] = $_sub[$i];
 
 
}
 
unset($_sub);//用完及时销毁
 
}
 
unset($farr);

print_r($Uarr);

```
[二分法查找与顺序查找 查找算法](http://onwise.xyz/2015/08/15/%e4%ba%8c%e5%88%86%e6%b3%95%e6%9f%a5%e6%89%be%e4%b8%8e%e9%a1%ba%e5%ba%8f%e6%9f%a5%e6%89%be/)
```js
//如从一个数组中找到一个数：34  
//$arr = array(23,45,67,34,9,34,6)如果查到则输出下标，否则输出查无此数  
  
$arr = array(23,45,67,34,9,34,6);  
//设一个标志位  
$flag = false;  
foreach($arr as $x => $x_val)  
{  
      
    if ($x_val == 34)  
    {  
        echo 'arr['.$x.']=34'."<br>";  
        $flag = true;  
    }  
}  
if ($flag==false)  
{  
    echo "查无此数！";  
}     
//如从一个数组中找到一个数：134   首先找到数组中间这个数，然后与要查找的数比较，如果要查找的数大于中间这个数，则说明应该向后找，否则向前找，如果想等，则说明找到。
//$arr = array(23,45,67,89,90,134,236)如果查到则输出下标，否则输出查无此数  
  
function binarySearch(&$arr,$val,$leftindex,$rightindex)  
{  
    if($rightindex < $leftindex)  
    {  
        echo "查无此数！";  
        return 0;  
    }  
    //四舍五入取整数值  
    $middleindex = round(($leftindex + $rightindex)/2);  
    if($val > $arr[$middleindex])  
    {  
        binarySearch($arr,$val,$middleindex + 1,$rightindex);  
    }  
    elseif($val < $arr[$middleindex])  
    {  
        binarySearch($arr,$val,$leftindex,$middleindex - 1);  
    }  
    else  
    {  
        echo 'arr['."$middleindex".']=134'."<br>";  
    }  
}  
    $arr = array(23,45,67,89,90,134,236);  
    sort（$arr）;//先排序
//  $leftindex = 0;左下标  
//  $rightindex = count($arr)-1;右下标  
//      $val = 134;要找的值  
    binarySearch($arr,134,0,count($arr) - 1)  
```
[PHP网站的自动化部署工具](https://segmentfault.com/q/1010000000659604)
[这个javascript双色球代码](https://segmentfault.com/q/1010000008920706)
```js
function doubleChromosphere() {

                var bools = [],
                    i,
                    ranNumber;

                for(i = 0; i < 5;) {
                    ranNumber = parseInt(Math.random() * 33 + 1);
                    if(bools.indexOf(ranNumber) == -1) {
                        bools.push(ranNumber);
                        i++;
                    }
                }

                
                var str = "";
                for(var j = 0; j < bools.length; j++){
                    str += bools[j] + "&ensp;";
                }
                red.innerHTML = str.toString();
                
                blue.innerHTML = (parseInt(Math.random() * 16 + 1)).toString();
            }
```
http://capistranorb.com/ http://deployer.org/  https://github.com/meolu/walle-web

[数据结构之四种基本排序 数据排序算法](http://onwise.xyz/2016/01/15/%e6%95%b0%e6%8d%ae%e7%bb%93%e6%9e%84%e4%b9%8b%e5%9b%9b%e7%a7%8d%e5%9f%ba%e6%9c%ac%e6%8e%92%e5%ba%8f/)
[Web系统大规模并发——秒杀与抢购 秒杀系统优化与预防措施](http://onwise.xyz/2017/03/06/web%e7%b3%bb%e7%bb%9f%e5%a4%a7%e8%a7%84%e6%a8%a1%e5%b9%b6%e5%8f%91-%e7%a7%92%e6%9d%80%e4%b8%8e%e6%8a%a2%e8%b4%ad/)
[cookie跨域session共享 结合实践谈谈cookie和session](http://onwise.xyz/2017/02/14/cookie%e8%b7%a8%e5%9f%9fsession%e5%85%b1%e4%ba%ab/)
```js
setcookie("sso", "e589hR6VnO8K1CNQZ4PSP/LWGBhRKE5VckawQwl1TdE8d4Q5E7tW", time() + 900);
var_dump($_COOKIE["sso"]);
要解决这个问题，要先了解一下setcookie后发生了什么？因为cookie是保存在客户端的，php是服务端语言，实际上setcookie之后只是在返回的http头增加一个cookie的头信息，告诉客户端需要设置一个酱紫的cookie
而$_COOKIE这个数组里面保存客户端传递上来的cookie。自然第一次刷新的时候因为客户端没有相应的cookie值，所以$_COOKIE是没有sso的信息的。第一次请求过后，因为服务器设置了cookie sso，所以第一次请求过来客户端就有了cookie sso的信息，所以第二次请求的时候就会带上sso的信息，服务端就能通过$_COOKIE取到值了。

 
session_start();
echo session_id();//本例输出ipkl446enhae25uq92c28u4lo3
$_SESSION['name'] = "tony”;
$_SESSION['users'] = array("tony", "andy");
通过session_id方法可以取到当前的session编号，通过这个编号可查看一下该session文件。
$ sudo more /var/tmp/sess_ipkl446enhae25uq92c28u4lo3
name|s:4:"tony";users|a:2:{i:0;s:4:"tony";i:1;s:4:"andy";}
php在进行session操作的时候会生成一个session id，而后把这个值以cookie的形式保存在客户端，就是图示中的PHPSESSID了。客户端在下次请求的时候就会带上这个PHPSESSID，服务端就能知道当前客户端对应的session文件了。
如果需要使用redis进行存储，需要session中的Registered save handlers支持redis
```

[PHP 命令行下的世界 PHP的shell](http://onwise.xyz/2016/12/27/php-%e5%91%bd%e4%bb%a4%e8%a1%8c%e4%b8%8b%e7%9a%84%e4%b8%96%e7%95%8c/)
通过php_sapi_name()函数判断是否是在命令行下运行的 提供了两个全局变量$argc和$argv用于获取命令行输入。
查看redis类的信息

$ php --rc redis
查看函数printf的信息

$ php —rf printf
查看扩展redis的配置信息

$ php —ri redis
php —info | grep redis

[SegmentFault 年度内容盘点 - 2016](https://summary.segmentfault.com/2016/#/)
[策略模式适用情况是你已经知道了某个算法。](http://www.cnblogs.com/yjf512/p/6546490.html)
```js
abstract Database
{
    abstract public function showTables();

    abstract public function showEngine();
}

class Content
{
    private $dabatase;

    public function setDatabase(Database $database) {
        $this->database = $database;
    }

    public function Print() {
        $tables = $this->database->showTables();
        $engine = $this->database->showEngine();
        return [
            'table' => $tables,
            'engine' => $engine
        ];
    }
}


class MysqlDatabase implements Database
{
    public function showTables() {
        return ['mysql1', 'mysql2'];
    }

    public function showEngine() {
        return ['innodb', 'myisam'];
    }

}

class PgDatabase implements Database
{
    public function showTables() {
        return ['pg1', 'pg2'];
    }

    public function showEngine() {
        return ['pginno1', 'pginno2'];
    }

}

$content = new Content();
$content->setDatabase(new MysqlDatabase());
$content->Print();
```
[Python的编码与解码问题](https://segmentfault.com/q/1010000008912870)
```js
import urllib


def get_data(ip):
    url = "http://ip.taobao.com/service/getIpInfo.php?ip=" + ip
    data = urllib.urlopen(url).read()

    return data


if __name__ == "__main__":
    result = get_data("59.151.5.5")
    print(result)
    >>> import unicodedata as u

# 这段字符串是来自你给提供的内容
>>> s = "\u5317\u4eac\u5e02"
>>> s1 = ''
>>> for i in s:
        s1 += u.lookup(u.name(i))

# 输出结果    
>>> s1
'北京市'


if __name__ == "__main__":
    result = get_data("59.151.5.5")
    print(eval(result))
    
result = get_data("59.151.5.5").decode('raw_unicode_escape')    
import json
print json.dumps(json.loads(result), indent=2)    
```


[给数组中增加内容](https://segmentfault.com/q/1010000008914818)
var arr = ["1", "2", "3", "4"].map(item => `第${item}季度`);
[1,2,3,4].map(function(val){ return "第"+val+"季度" })
[就是这么迅猛的实现搜索需求](http://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651959917&idx=1&sn=8faeae7419a756b0c355af2b30c255df&chksm=bd2d07b18a5a8ea75f16f7e98ea897c7e7f47a0441c64bdaef8445a2100e0bdd2a7de99786c0&scene=21#wechat_redirect)
select tid from t_tiezi where content like ‘%天通苑%’
ElasticSearch 完全能满足10亿数据量，5k吞吐量的常见搜索业务需求，强烈推荐。


[1分钟实现“延迟消息”功能](http://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651959961&idx=1&sn=afec02c8dc6db9445ce40821b5336736&chksm=bd2d07458a5a8e5314560620c240b1c4cf3bbf801fc0ab524bd5e8aa8b8ef036cf755d7eb0f6&mpshare=1&scene=1&srcid=0316rh7QmkSKJH06XFENtsgw#rd)
一般来说怎么实现这类“48小时后自动评价为5星”需求呢？
 
常见方案：启动一个cron定时任务，每小时跑一次，将完成时间超过48小时的订单取出，置为5星，并把评价状态置为已评价。
假设订单表的结构为：t_order(oid, finish_time, stars, status, …)，更具体的，定时任务每隔一个小时会这么做一次：
select oid from t_order where finish_time > 48hours and status=0;
update t_order set stars=5 and status=1 where oid in[…];
如果数据量很大，需要分页查询，分页update，这将会是一个for循环
高效延时消息，包含两个重要的数据结构：
（1）环形队列，例如可以创建一个包含3600个slot的环形队列（本质是个数组）
（2）任务集合，环上每一个slot是一个Set<Task>

[API的防重放机制](http://www.cnblogs.com/yjf512/p/6590890.html)
```js
防止重放的机制是使用timestamp和nonce来做的重放机制。
每个请求带的时间戳不能和当前时间超过一定规定的时间。比如60s。这样，这个请求即使被截取了，你也只能在60s内进行重放攻击。过期失效。

但是这样也是不够的，还有给攻击者60s的时间。所以我们就需要使用一个nonce，随机数。

nonce是由客户端根据足够随机的情况生成的，比如 md5(timestamp+rand(0, 1000)); 它就有一个要求，正常情况下，在短时间内（比如60s）连续生成两个相同nonce的情况几乎为0。

服务端第一次在接收到这个nonce的时候做下面行为：
1 去redis中查找是否有key为nonce:{nonce}的string
2 如果没有，则创建这个key，把这个key失效的时间和验证timestamp失效的时间一致，比如是60s。
3 如果有，说明这个key在60s内已经被使用了，那么这个请求就可以判断为重放请求。
请求：

http://a.com?uid=123&timestamp=1480556543&nonce=43f34f33&sign=80b886d71449cb33355d017893720666

这个请求中国的uid是我们真正需要传递的有意义的参数

timestamp，nonce，sign都是为了签名和防重放使用。

timestamp是发送接口的时间，nonce是随机串，sign是对uid，timestamp,nonce(对于一些rest风格的api，我建议也把url放入sign签名)。签名的方法可以是md5({秘要}key1=val1&key2=val2&key3=val3...)

服务端接到这个请求：
1 先验证sign签名是否合理，证明请求参数没有被中途篡改
2 再验证timestamp是否过期，证明请求是在最近60s被发出的
3 最后验证nonce是否已经有了，证明这个请求不是60s内的重放请求
这个是没有办法防止DDOS的，但是有办法防止比如一个接口是增加积分，你恶意拦截自己的接口，然后重新调用来增加自己的积分

```
[php利用yield写一个简单中间件](http://blog.csdn.net/qq_20329253/article/details/52202811)
```js
function xrange($start, $end, $step = 1) {  
    for ($i = $start; $i <= $end; $i += $step) {  
        yield $i;  
    }  
}  

foreach (xrange(1, 1000) as $num) {  
    echo $num, "\n";  
}  
/* 
 * 1 
 * 2 
 * ... 
 * 1000 
 */  
 数据库连接.....
$sql = "select * from `user` limit 0,500000000";
$stat = $pdo->query($sql);
$data = $stat->fetchAll();  //mysql buffered query遍历巨大的查询结果导致的内存溢出

var_dump($data);
function get(){
    $sql = "select * from `user` limit 0,500000000";
    $stat = $pdo->query($sql);
    while ($row = $stat->fetch()) {
        yield $row;
    }
}

foreach (get() as $row) {
    var_dump($row);
}
```

[图普科技图像识别开放平台图片识别ocr](https://www.tuputech.com/api)

[mysql中select distinct 多列的用法](https://wujunze.com/mysql_distint.jsp)
select distinct test1, id from test
SELECT id, group_concat( DISTINCT test1 ) FROM test GROUP BY test1
id group_concat( distinct test1 )
1 a
5 b
select *, count(distinct test1) from test group by test1
id test1 test2 count( distinct test1 )
1 a 1 1
5 b 1 1
[MySQL导入数据load data infile用法](http://blog.csdn.net/vbloveshllm/article/details/42965317)
[让MySQL数据库里的主键ID重新排序](https://wujunze.com/mysql_id_sort.jsp)
ALTER TABLE 【表名字】 DROP 【列名称】

ALTER TABLE `riskmanage_info_university` DROP COLUMN `id`;
然后再创建列
ALTER TABLE 【表名字】 ADD 【列名称】 INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST

ALTER TABLE `riskmanage_info_university` ADD `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
laravel 多 where ->where([
['field', 'value'],
['field2', 'value2']
])
[javascript递归](https://segmentfault.com/q/1010000007997849)
```js
var arr = ['A','B','C','D',"E","F","G"];
其次这个函数目的就是算阶乘.
!arr.length/!(arr.length - 5) 叹号为阶乘
function show(arr,num){
    debugger
    var resultNum = 0;
    var iNow = 1;
    
    if(num==1){
        return arr.length;
    }
    
    function change(arr,iNow){
        
        for(var i=0;i<arr.length;i++){
            
            var result = arr.concat();
            result.splice(i,1);

            if( iNow == num ){
                resultNum += result.length;
            }else{
                change(result,iNow+1);
            }
        }
    }
    change(arr,iNow+1);
    return resultNum;
}

console.log(show(arr,5));
```
[nodejs socket.io在线聊天](https://github.com/nswbmw/N-chat/wiki/%E7%AC%AC%E5%9B%9B%E7%AB%A0-%E7%94%A8%E6%88%B7%E4%B8%8A%E7%BA%BF)
[文字对比工具](http://www.bejson.com/othertools/finddif/)
http://www.atool.org/   http://www.easyapi.com/?from=sojson.com 
[api接口测试工具](http://www.sojson.com/httpRequest/)
[python杨慧三角 2017-03-10 马超 公众号 DeveloperPython]()
```js
杨慧三角

         1
        1   1
      1   2   1
    1   3   3   1
  1   4   6   4   1
1   5   10  10  5   1
def yanghu(n):
    L=[1]
    while 1:
        yeild L
        L = [L[x] + L[x+1] for x in range(len(L) -1)]
        L.insert(0,1)
        L.append(1)
        if len(L)>n:
            break
for n in yanghu(10):
    print n
 cookie登录    bilibili
```
[在线手册学习网站请前往](http://www.shouce.ren)
```js
执行1000用户并发时就出现502或504错误，若用户数较多时，App上相关功能会大大受影响
1、首页，最大支持2000用户并发，超过2000后会出现502/504等错误，5000用户时会有50%的用户无法访问；
2、活动页-移动端UA，最大支持2000用户并发，但响应时间在25秒左右，需要优化；
3、Info接口，1000用户并发响应时间6秒，每秒处理事务数160个；Info优化前后的对比见附件。
4、List接口，2000用户并发相应时间13秒，每秒处理事务数130个。
mysql> select count(*) from users;
+----------+
| count(*) |
+----------+
|  5008300 |
+----------+
1 row in set (1.25 sec)
不翻墙  avtb123  后缀自己想去吧 https://oneinstack.com   我用的这个
```
[Redis 的三种启动方式 （转）](https://www.insp.top/article/three-kinds-of-start-ways-for-redis)
```js
# 加上 `&` 号使 redis 以后台程序方式运行
./redis-server &
# 检测后台进程是否存在
ps -ef |grep redis
 
# 检测 6379 端口是否在监听
netstat -lntp | grep 6379
 
# 使用`redis-cli`客户端检测连接是否正常
./redis-cli
127.0.0.1:6379> keys *
(empty list or set)
# 使用客户端
redis-cli shutdown
# 因为Redis可以妥善处理 SIGTERM 信号，所以直接 kill -9 也是可以的
kill -9 PID
redis-server ./redis.conf
#如果更改了端口，使用 `redis-cli` 客户端连接时，也需要指定端口，例如：
redis-cli -p 6380
```
[匿名函数的那些事儿](https://www.insp.top/article/we-need-to-know-something-about-closure)
```js
class foo
{
    public function exec(Closure $callback)
    {
        echo $callback();
    }
}
 
$name = 'nick';
 
(new foo)->exec(function() use ($name) {
    return 'hi, '. $name;
}); // 输出: hi, nick
/**
 * 一个简单的IoC容器
 */
class Container
{
    protected static $bindings;
 
    public static function bind($abstract, Closure $concrete)
    {
        static::$bindings[$abstract] = $concrete;
    }
 
    public static function make($abstract)
    {
        return call_user_func(static::$bindings[$abstract]);
    }
}
 
/**
 * 示例用的 talk 类
 */
class talk
{
    public function greet($target)
    {
        echo 'hi, ' . $target->getName();
    }
}
 
/**
 * 示例用的 A 类
 */
class A
{
    public function getName()
    {
        return 'Nick';
    }
}
 
/**
 * 示例用的 B 类
 */
class B
{
    public function getName()
    {
        return 'Amy';
    }
}
 
// 以下代码是主要示例代码
 
// 创建一个talk类的实例
$talk = new talk;
 
// 将A类绑定至容器，命名为foo
Container::bind('foo', function() {
    return new A;
});
 
// 将B类绑定至容器，命名为bar
Container::bind('bar', function() {
    return new B;
});
 
// 通过容器取出实例
$talk->greet(Container::make('foo')); // hi, Nick
$talk->greet(Container::make('bar')); // hi, Amy
```

[laravel 学习笔记 —— 神奇的服务容器](https://www.insp.top/article/learn-laravel-container)
```js
class Container
{
    protected $binds;
 
    protected $instances;
 
    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }
 
    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
 
        array_unshift($parameters, $this);
 
        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}
```
[laravel 学习笔记——请求与响应](https://www.insp.top/article/learn-laravel-request-and-response)

控制器和路由闭包中返回的数据，最终会交由 laravel 的 HTTP 组件的 Response（响应）类处理，而直接输出是由 php 引擎处理，php 会以默认的文件格式、响应头输出，除非使用 header 函数改变。因此与其自己去调取 header() 调整响应头还是其他，都不如 laravel 的 Response 来的简洁实惠。
[闭包——藏在代码中的“房间”](https://www.insp.top/article/what-is-closure)
```js
function foo()
{
    $i = 0;
    $bar = function() use (&$i) {
        return ++$i;
    }
    return $bar;
}
 
$closure = foo(); 说$closure就是一个闭包。
 
echo $closure(); // 1
echo $closure(); // 2
全局变量 $closure 接收了 foo 函数返回的匿名函数，我们通过 $closure() 这一方式调用了这一个匿名函数，由于该匿名函数看似是在外部被调用，但实际上而言，匿名函数在定义的时候引用了它当时所处的上下文的变量 $i，而该匿名函数最终又被赋予了全局变量 $closure，假如全局变量 $closure 不被释放，则 $i 里面的值将会一直保留而不会被 GC（垃圾回收机制）所释放，因此，每一次调用该匿名函数的结果都是在上一次运算结果的基础上累加。
闭包有一个很有用的功能就是保证了内部变量不被释放。这在 javascript 里很有用。
php 里你可以通过 static 将变量声明为静态，在整个程序执行期间，这个静态变量会一直保存在内存中而不会被释放，而 javascript 为了保证一些变量不被释放，只能保持其引用状态，这时候就可以利用闭包。
function foo()
{
    var i = 0;
    var bar = function() {
        return ++i;
    }
    return bar;
}
 
closure = foo();
 
alert(closure()); // 1
alert(closure()); // 2
function foo()
{
    var i = 0;
    return ++i;
}
 
alert(foo()); // 1
alert(foo()); // 1

 不过php要通过匿名函数引用内部变量需要使用use，而且引用传值要求变量名前面必须要加&，这是和javascript不一样的地方。
```
[HTTP 中的幂等操作](https://www.insp.top/article/idempotent-operation-in-http-protocol)

幂等通俗来说是指不管进重复多少次操作，其结果都一样。 GET、PUT、DELTE、HEAD 都是幂等操作，而 POST 则不是
创建一个资源的时候，我们用的最多的就是 POST，但是，当我们无法确认一个 POST 请求是否发送成功，我们并不能随意再次发出同样请求，因为这可能不经意创建出多个东西出来（每次请求都会产生新的东西或者说产生不同结果）。

当其再次发起一次 POST 请求，该请求中的数据和之前记录的关键数据一致时，则提示其可能存在重复提交的可能。

限制一段时间内的请求也是种比较好的办法。对于同一个客户，由于其正常操作流程最快也会需要小段时间，可以此作为限制手段。
[四舍六入五成双浮点数](https://www.insp.top/article/how-to-ensure-accurate-for-digital-transformation)

舍去位的数值小于5时，直接舍去；
舍去位的数值大于等于6时，进位后舍去；
当舍去位的数值等于5时，分两种情况：5后面还有其他数字（非0），则进位后舍去；若5后面是0（即5是最后一位），则根据5前一位数的奇偶性来判断是否需要进位，奇数进位，偶数舍去。
舍去位，当小于 5，即 0 ~ 4.999999…… 则舍去，大于 6，即 6 ~ 10 则进位，则中间区间那个数字，5 ~ 5.999999…… ，只要使该区间内存在的数字平均分布，即可保证取舍概率相等。于是得到上述算法。

按上述规则，之前的 2.55 + 3.45 = 6 得出的结果如下：

2.6 + 3.4 = 6
[使用 xunsearch 构建全文搜索功能](https://www.insp.top/article/use-xunsearch-to-build-fulltext-search-function) 
https://github.com/chongyi/inspirer 博客源码
[Simple browser detection for PHP ](http://www.flamecore.org)
[ip本地库解析地理位置](https://packagist.org/packages/geoip2/geoip2)
```js
/**
     * ip本地库解析地理位置
     * @param $ip
     * @return array|bool
     */
    public static function geoIp($ip){
        try{
            $file = base_path('storage').'/ipdata/GeoLite2-City.mmdb';
            $reader = new Reader($file);
            $record = $reader->city($ip);
            if(empty($record)){
                throw new \Exception('ip解析失败',5000);
            }
            $cityName = '';
            if(!empty($record->city->names)){
                $cityName = !empty($record->city->names['zh-CN']) ? $record->city->names['zh-CN'] : $record->city->names['en'];
            }
            $countryName = $record->country->names['zh-CN'];
            $areaName = !empty($record->subdivisions[0]->names['zh-CN']) ? $record->subdivisions[0]->names['zh-CN'] : $countryName;
            if(!empty($cityName) && !empty($countryName)){
                if(in_array($countryName,['台湾','澳门','香港'])){
                    $countryName = '中国';
                }
                return ['country' => $countryName, 'area' => $areaName, 'region' =>$areaName, 'city' => $cityName, 'isp' => '未知'];
            }else{
                return false;
            }
        }catch (\Exception $e){
            //print_r($e->getMessage());
        }
        return false;
    }
$reader = new Reader('/usr/local/share/GeoIP/GeoIP2-City.mmdb');//下载地址https://www.maxmind.com/en/geoip2-city

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city('128.101.101.101');

print($record->country->isoCode . "\n"); // 'US'
print($record->country->name . "\n"); // 'United States'
print($record->country->names['zh-CN'] . "\n"); // '美国'    
// http://geoip2.readthedocs.io/en/latest/  http://dev.maxmind.com/zh-hans/geoip/geoip2/geolite2-%e5%bc%80%e6%ba%90%e6%95%b0%e6%8d%ae%e5%ba%93/
>>> import geoip2.database
>>>
>>> # This creates a Reader object. You should use the same object
>>> # across multiple requests as creation of it is expensive.
>>> reader = geoip2.database.Reader('/path/to/GeoLite2-City.mmdb')
>>>
>>> # Replace "city" with the method corresponding to the database
>>> # that you are using, e.g., "country".
>>> response = reader.city('128.101.101.101')

>>> r=reader.city('1.119.129.17')
>>> print r.country.names['zh-CN']
中国
>>> print r.city.name
Beijing
>>> print r.city.names['zh-CN']
北京

redis队列用6379端口 因为用 keys * 
```

[Python 招聘信息爬取及可视化](http://bigborg.github.io/2016/09/12/Scrapy-Pythonjobs/)
```js
https://github.com/BigBorg/Scrapy-playground
rpub是一个专门用于发布R语言分析报告的网站http://7xshuq.com1.z0.glb.clouddn.com//githubrepo/scrapy/RAnalysis.html ggplot可以是R语言可视化最著名的包 https://mirrors.tuna.tsinghua.edu.cn/CRAN/bin/windows/base/R-3.3.3-win.exe  https://mirrors.tuna.tsinghua.edu.cn/anaconda/archive/ 
age <- c(1,3,5,2,11,9,3,9,12,3)
weight <- c(4.4,5.3,7.2,5.2,8.5,7.3,6.0,10.4,10.2,6.1)
mean(weight)
plot(age,weight)
q()
http://www.cnblogs.com/shyustc/p/4003225.html http://vdisk.weibo.com/s/yVFSlzgEVkvFA

desc select id,user_id,created_at,sum(nums) a,count(*) s from webinar_onlines where id>10000 and id<20000 group by user_id,created_at order by id \G
http://music.163.com/#/playlist?id=564322156
导入sql文件
load data infile 'd:/soft/wamp/www/laravel_web/saas_user_onlines.sql' into table user_onlines_bak fields terminated by ',' (user_id,parent_id,nums,online_min,online_hour,online_day,online_week) ; 
// $str = "insert into vhall_webinar.user_onlines_bak(user_id,nums,parent_id,online_min,online_hour,online_day,online_week) values({$row['user_id']},{$row['nums']},{$row['parent_id']},{$row['online_min']},{$row['online_hour']},{$row['online_day']},{$row['online_week']});".PHP_EOL;
                    // \Storage::disk('local_static')->append(date('Y-m-d').'onlines.sql', $str);
                    $s = "{$row['user_id']},{$row['parent_id']},{$row['nums']},{$row['online_min']},{$row['online_hour']},{$row['online_day']},{$row['online_week']}".PHP_EOL;
                    // file_put_contents(storage_path().'/'.date('Y-m-d-H').'onlines.sql',$str,FILE_APPEND);
                    file_put_contents(storage_path().'/onlines.sql',$s,FILE_APPEND);

//先排序后分组  获取每个分组最后的id
select id,user_id,created_at,sum(nums) from (select *from webinar_onlines
 order by id desc) a where id>40 and id<110 group by user_id,created_at order by id;
            // $lastCount = WebinarOnline::where(['user_id' => $data[$rowCount-1]->user_id, 'created_at' => $data[$rowCount-1]->created_at])->count();
            // $lastWebinarId = $data[$rowCount-1]->id+$lastCount-1;

```
[mysql笔记](http://bigborg.github.io/2016/09/29/mysql-notes/)
[pandas出毛病了](https://segmentfault.com/q/1010000008762657)
推荐使用Python的发行版Anaconda，自带各种数据处理包，不用额外安装
该发行版使用conda包管理工具，可以有效避免pip安装导致的依赖错误，无法安装等问题
如果觉得安装包比较大，可以试用精简版的Miniconda,需要额外下载安装。

如果使用conda下载速度比较慢，可以使用清华的镜像，清华conda镜像配置https://conda.io/miniconda.html  https://mirrors.tuna.tsinghua.edu.cn/help/anaconda/
[对文件夹内文件处理](https://segmentfault.com/q/1010000008777127)
```js
import glob
import shutil
file_list = glob.glob('*.htm')  # ['1.htm', '2.htm', '3.htm']
得到列表之后就可以遍历列表进行你想要的处理

for i in file_list：
    old_fileName = i
    new_fileName = i + '.tmp'
    #另存为：
    shutil.copy(old_fileName, new_fileName)
    with open(new_fileName, 'r+') as f:
       #光标移动到末尾
       f.seek(0,2)
       f.write('\nwrite something')
       #f.flush()
```
[PHP &变量问题](https://segmentfault.com/q/1010000008780130)
[取消composer全局代理设置。](https://laravel-china.org/topics/3984/phpcomposer-domestic-mirror-pills)
composer config -g repo.packagist composer https://packagist.org
composer config -g repo.packagist composer https://packagist.composer-proxy.org 
[命令行下执行 PHP artisan 相关命令没有效果且没有错误提示](https://laravel-china.org/articles/4070/command-line-execution-of-the-php-artisan-command-has-no-effect-and-no-error)
alias phpe="php -d display_errors" 
phpe artisan make:migration create_foo_table --create=foo
[Laravel 5.3 下捕捉 PDOException 异常](https://laravel-china.org/articles/4132/laravel-53-to-catch-pdoexception-exceptions)
use PDOException;
然后，这样处理即可：

try {
    $record = Foo::create(['name' => '王义国', 'sex' => 'male']);
 } catch (PDOException $e) {
    var_dump($e->getMessage());
 }
[Laragon 是一个 windows 下一个集 lnmp 为一体的web服务器](https://laravel-china.org/articles/3994/laragon-allows-you-to-happy-coding-under-windows)
下载地址：https://laragon.org/download.html
[数据库表设计范式 笔记](https://laravel-china.org/articles/4137/database-table-design-paradigm-notes)
https://page94.ctfile.com/fs/omy177170690 
[Laravel Debugbar 不用走宝的调试器](https://laravel-china.org/articles/4185/laravel-debugbar-do-not-go-to-the-treasure-debugger)
新增内置函数不一定自己定义的一样。
尽量不要定义全局函数，定义类静态方法。
[frp 内网穿透简单教程](https://laravel-china.org/articles/4200/frp-network-through-a-simple-tutorial)
载地址：http://www.diannaobos.com/frp/
安利一个 Composer 的源管理工具 slince/crmhttps://laravel-china.org/topics/4134/amway-composer-source-management-tool-slincecrm
https://github.com/slince/crm 
