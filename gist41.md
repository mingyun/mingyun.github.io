[使用PHP_XLSXWriter代替PHPExcel](https://segmentfault.com/a/1190000010178094)
```js
https://github.com/mk-j/PHP_XLSXWriter  http://www.mysqltutorial.org/mysql-delete-join/ 火车票 https://github.com/protream/tickets  https://github.com/jkchao/books  https://github.com/yuanliangding/books  getproxy 是一个抓取发放代理网站pip install getproxy
```
[PHP 该多维数组如何递归循环](https://segmentfault.com/q/1010000010304022)
```js
<?php


$arr = [
    [
        'id' => 1,
        'children' => [
            'id' => 2,
            'children' => [
                'id' => 3,
                'children' => [
                    'id' => 4
                ]
            ]
        ]
    ],
    [
        'id' => 5,
        'children' => [
            'id' => 6,
        ]
    ],
    [
        'id' => 7
    ]
];

function pushChild($children, &$container) 
{
    $container[] = $children['id'];
    if (! isset($children['children'])) {
        return;
    }
    pushChild($children['children'], $container);
}

$arr2 = [];

foreach ($arr as $item) {
    $result = [];
    pushChild($item, $result);
    $arr2[] = $result;
}

var_dump($arr2); 
$arr2 = [
    [1,2,3,4],
    [5,6],
    [7]
];
```
[优雅的重试功能。](https://www.zhihu.com/question/24590883/answer/201698987)
```js
from tenacity import retry, stop_after_attempt@retry(stop=stop_after_attempt(3))def extract(url):    info_json = requests.get(url).content.decode()    info_dict = json.loads(info_json)    data = info_dict['data']    save(data)


 
```


[numpy和pandas入门](https://zhuanlan.zhihu.com/p/27624814)
 [A chatbot in wxpy for wechat group chats](https://github.com/locoda/connector-wechat-bot.git)
[微信的语音聊天记录可以从手机提取出来保存到PC](https://www.zhihu.com/question/19909162/answer/80640430)
https://link.zhihu.com/?target=https%3A//github.com/alexyangfox/wechat_silk/tree/master  http://mindstore.io/mind/13191/
[从零开始写Python爬虫 --- 爬虫应用： 12306火车票信息查询](https://zhuanlan.zhihu.com/p/27969976)
```js
'''
获取12306城市名和城市代码的数据 在终端输入： python3 parse_stations.py >> stations.py
文件名： parse_station.py
'''
import requests
import re

#关闭https证书验证警告
requests.packages.urllib3.disable_warnings()
# 12306的城市名和城市代码js文件url
url = 'https://kyfw.12306.cn/otn/resources/js/framework/station_name.js?station_version=1.9018'
r = requests.get(url,verify=False)
pattern = u'([\u4e00-\u9fa5]+)\|([A-Z]+)'
result = re.findall(pattern,r.text)
station = dict(result)
print(station)
```
[70个Python练手项目列表](https://zhuanlan.zhihu.com/p/27931879)
[Python中list()方法的疑问](https://segmentfault.com/q/1010000010305364)
list()构造函数通过可以传递iterable对象. 而string就是 iterable.  至于reverse()对列表操作, 本身返回值是 none. 因为 list 是 mutable 对象(可变对象), 对可变对象进行操作, Python 中大多数会对其本身进行操作, 返回值为 none
[PHP 最佳实践之数据库](https://laravel-china.org/articles/5330/php-database-of-best-practices)
```js
//把预处理语句获得的结果当成关联数组处理
$sql = 'SELECT id, email FROM users WHERE email = :email';
$statement = $pdo->prepare($sql);
$email = filter_input(INPUT_GET, 'email');
$statement->bindValue(':email', $email);
$statement->execute();
//迭代结果
while(($result = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
echo $result['email'];
}
cat .git/config 查看是否已经设置忽略文件权限跟踪，filemode=true 的时候即跟踪修改权限的文件 。 git config core.filemode false
在 启动队列时，最好是指定 tries 的值，同时 在 定义job 中 添加 failed 方法来 处理 队列失败时 的操作

php artisan queue:work redis --tries=3
 public function failed(Exception $exception)
    {
        // 给用户发送失败通知，等等...
    }
    优雅地在 Mac+Valet 环境下本地部署 PHPHubhttps://laravel-china.org/articles/5316/gracefully-deploying-phphub-locally-in-a-macvalet-environment
     windows下听说有一个Laragon和Mac下的Valet差不多
    Chrome 修改 user agent 简单模拟微信内置浏览器https://laravel-china.org/articles/5319/chrome-modify-user-agent-simple-simulation-of-wechats-built-in-browser
    快马加鞭使用 certbot 为你的网站免费上 https https://laravel-china.org/articles/5266/the-use-of-certbot-at-top-speed-for-your-website-for-free-on-https
 wget https://dl.eff.org/certbot-auto
chmod a+x certbot-auto
service nginx stop
./certbot-auto certonly --standalone --email `你的邮箱地址` -d `你的域名地址`

tree /etc/letsencrypt/live/
 # TLS 基本设置
ssl_certificate /etc/letsencrypt/live/www.just4fun.site/fullchain.pem;#证书位置
ssl_certificate_key /etc/letsencrypt/live/www.just4fun.site/privkey.pem;# 证书位置
service nginx start
 ss免费账号https://github.com/Alvin9999/new-pac/wiki/ss%E5%85%8D%E8%B4%B9%E8%B4%A6%E5%8F%B7
 最好的GitHub代码浏览插件https://juejin.im/entry/597025d9518825419f7b65ba
chrom商店里 搜索 就可以了 php offline manual
http://cn.office-converter.com/  https://smallpdf.com/ http://www.ilovepdf.com/ PDF、WORD、PPT、TXT转换方法 强大的OCR和PDF处理软件：ABBYY FineReader，可识别图片上的文字 http://ocr.abbyy.cn/  https://uzer.me/ 直接在线使用包括office、PS、SPSS、CAD等等各种大型软件
一个自动更新chrome的小工具 http://chrome.wbdacdn.com/
为预防「重大突发事件」下断网的情况，给大家推荐一款 app 吧：FireChat
http://zh.wikihow.com/%E9%A6%96%E9%A1%B5  安利一个超级强大的干货搜索引擎
这是一条知乎优秀回帖大集合，赞同数在1000以上的问答。http://weibo.com/5823997358/Fd5Z54Op4
https://www.apowersoft.cn/video-download-capture 视频下载王 https://www.apowersoft.cn/online-video-downloader
http://127.0.0.1:43110/1FRQLoQqnAziCyhmAp8Ev3sVNNkcS1hXYT/
免费全平台的文件分享利器：SendAnywhere  https://sspai.com/post/40047
https://gitlab.com/kornelski/babel-preset-php.git  PHP语法转JS
PHP 命令行工具框架 Laravel Zerohttps://github.com/nunomaduro/laravel-zero/blob/stable/readme.md 推荐一个有效存储和展示自己 PGP
永远都不要看轻自己，马云、李嘉诚、王健林、马化腾，还有你，你们5个人的资产加起来，足以撼动整个亚洲甚至全世界的经济体系。 ​​​​在电脑之间传文件的命令行工具，支持主流操作系统 https://github.com/warner/magic-wormhole/blob/master/README.md
微信号「一分钟的编程知识」
http://www.bilibili.com/video/av3504428/index_1.html#page=1 神速学会视频剪辑，up主必备Premiere技能 doyoudo.com  科普一下短信报警，编辑信息发送到12110即可http://weibo.com/1756672641/Fcu3Shhui
《Go入门指南》https://github.com/Unknwon/the-way-to-go_ZH_CN  非常强大的应用：Office Lens Modern task runner for PHPhttp://robo.li/
set names utf8b4 程序员应该掌握的10个搜索技巧http://www.codeceo.com/article/10-search-tips-for-programmer.html 《nginx从入门到精通PDF》http://pan.baidu.com/s/1o6KCn7W?
0xbug写的一个GitHub 泄露监控系统 https://github.com/0xbug/Hawkeye
微信公众号----软件编程之路 random_int() 在php用这个函数 windows下听说有一个Laragon和Mac下的Valet差不多 微信公众号：Jimmy的技术乐园
```
[PHP系列总结](https://github.com/xx19941215/webBlog)
[swoole 服务端120行代码构建一个websocket 聊天室](https://segmentfault.com/a/1190000010247505)
https://github.com/buffge/buffchat http://www.bilibili.com/video/av12418026/ 
[我是怎么做App token认证的](http://blog.githuber.cn/posts/3018)
基于 ItChat 开发的机器人https://github.com/PY-Learning/wbot
[ ROT13 密码算法](https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650367149&idx=1&sn=5b9bc4a8029e7eb9b8a4b71d06524da9&chksm=be9cdff989eb56ef143d5b03fab7e825f08ea6a96d041aa1da50e78e765a75e60d49b42d9bf6&mpshare=1&scene=1&srcid=0721yrbY93iVEEROCSr1bWdN&pass_ticket=nibRL4OOwqqlqGUBQ8mnsaXsv6niSYSnG%2BPhy3uP%2BvD3386ssTy5UjDfLlo6aNGq#rd)
```js
d = {}
for c in (65, 97):
    for i in range(26):
        d[chr(i+c)] = chr((i+13) % 26 + c)

print("".join([d.get(c, c) for c in s]))
ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
                | |
NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm
它是凯撒加密的一种变体。一段文字按照字母顺序只需把当前字母用13位之后的对应字母进行替代，超过第13位的字母（从N开始）则重新绕回到字母表的开头即可。而对于非字母字符还是保持原样不变。
正向代理的过程，它隐藏了真实的请求客户端，服务端不知道真实的客户端是谁，客户端请求的服务都被代理服务器代替来请求，科学上网工具 Shadowsocks 扮演的就是典型的正向代理角色。在天朝访问 www.google.com 时会被无情的墙掉，要想翻越这堵墙，你可以在国外用 Shadowsocks 来搭建一台代理服务器，代理帮我们请求 www.google.com，代理再把请求响应结果再返回给我 「正向代理」代理的对象是客户端，「反向代理」代理的对象是服务端https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650366790&idx=1&sn=3b5d390d07445745e067334365873a18&chksm=be9cd81289eb510499dd029f91a302a2e08f0c4bbed13c7a47d33d2f1b6a91eebc6199b141b9&scene=21#wechat_redirect 
bytes 类型提供的操作和 str 一样，支持分片、索引、基本数值运算等操作。但是 str 与 bytes 类型的数据不能执行 + 操作
encode 负责字符到字节的编码转换。默认使用 UTF-8 编码准换。
>>> c = b'a'
>>> s = "Python之禅"
>>> s.encode()
b'Python\xe4\xb9\x8b\xe7\xa6\x85'
>>> s.encode("gbk")
b'Python\xd6\xae\xec\xf8'
>>> b'Python\xe4\xb9\x8b\xe7\xa6\x85'.decode()
'Python之禅'
>>> b'Python\xd6\xae\xec\xf8'.decode("gbk")
'Python之禅'  print(keyword.kwlist)
if 18 < age < 60:
    print("yong man")
    >>> payload = {'key1': 'value1', 'key2': 'value2'}
>>> r = requests.post("http://httpbin.org/post", json=payload)
>>> r.json() 作为 json 格式的字符串格式传输给服务器
{'url': 'http://httpbin.org/post', 'files': {}, 'data': '{"key2": "value2", "key
1": "value1"}', 'args': {}, 'form': {}, 'headers': {'Host': 'httpbin.org', 'Cont
ent-Type': 'application/json', 'User-Agent': 'python-requests/2.13.0', 'Accept':
 '*/*', 'Connection': 'close', 'Content-Length': '36', 'Accept-Encoding': 'gzip,
 deflate'}, 'json': {'key2': 'value2', 'key1': 'value1'}, 'origin': '36.102.227.
115'}
content 是 byte 类型，适合直接将内容保存到文件系统或者传输到网络中
```
[Mysql 数据类型隐式转换规则](http://blog.githuber.cn/posts/2893)
mysql> explain select * from convert_test where areacode=0001 and period>='20170511' and period<='20170511';
[关于JavaScript调试的十来个小Tips](https://www.shiyanlou.com/questions/4275)
你可以在JavaScript代码中加入一句debugger;来手工造成一个断点效果
console.trace就要起作用咯，它可以帮你进行函数调用的追踪
mointor(func)在Chrome中可以监测指定函数的调用情况以及参数

在console中使用debug(funcName)然后脚本会在指定到对应函数的地方自动停止
[python模拟http请求遇到的一个坑 ](https://www.testwo.com/article/1002)
使用python做接口测试同学如果在遇到参数中是json那就绕行requests模块，有时候看似好模块库反而容易出问题
透传的ctx参数是一个json格式  通过curl 请求就是正常的，经过一番折腾原来requests模块自动给url 做了encode编码才造成如此现象，解码后恢复正常json串，要不后台改要不我找其他解决办法,后台不能改，所以只能找其他办法更换python请求的api 更换urllib2，urllib2不会主动对url进行编码，如果你想给url编码自己调用：urllib.encode（）方法
>>> r = requests.get("http://httpbin.org/get", params='{"a":2}')
>>> r.url
'http://httpbin.org/get?%7B%22a%22:2%7D'
[PHP红包算法](https://segmentfault.com/a/1190000010210451)
```js
/*
 * 获取随机红包
 * min<k<max
 * min(n-1) <= money - k <= (n-1)max
 * k <= money-(n-1)min
 * k >= money-(n-1)max
 */
function getRedPackage($money, $num, $min, $max)
{
    $data = array();
    if ($min * $num > $money) {
        return array();
    }
    if($max*$num < $money){
        return array();
    }
    while ($num >= 1) {
        $num--;
        $kmix = max($min, $money - $num * $max);
        $kmax = min($max, $money - $num * $min);
        $kAvg = $money / ($num + 1);
        //获取最大值和最小值的距离之间的最小值
        $kDis = min($kAvg - $kmix, $kmax - $kAvg);
        //获取0到1之间的随机数与距离最小值相乘得出浮动区间，这使得浮动区间不会超出范围
        $r = ((float)(rand(1, 10000) / 10000) - 0.5) * $kDis * 2;
        $k = round($kAvg + $r);
        $money -= $k;
        $data[] = $k;
    }
    return $data;
}
一行代码，炫酷效果：

<pre id=p>n=setInterval("for(n+=7,i=k,P='p.\\n';i-=1/k;P+=P[i%2?(i%2*j-j+n/k^j)&1:2])j=k/i;p.innerHTML=P",k=64) ​​​​
```
[这十二行代码是如何让浏览器爆炸的？](http://www.0xroot.cn/demo.html)
http://www.codeceo.com/article/12-line-code-browser-die.html
```js
<html>
<body>
<script>
var total="";
for (var i=0;i<1000000;i++)
{
    total= total+i.toString ();
    history.pushState (0,0,total);
}
</script>
</body>
</html>
```
[用Python&Tesseract识别图片文字](https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650367001&idx=1&sn=dc8ea91ba4a83e23b5524a37aab5db73&chksm=be9cdf4d89eb565b1179c9d89030c512afa691dcf9480a0f604ebc658ddea2434658c8c184ef&scene=21#wechat_redirect)
```js
# pip install pytesseract 先安装依赖包
try:
    import Image
except ImportError:
    from PIL import Image
import pytesseract
# lang 指定中文简体
text = pytesseract.image_to_string(Image.open('dufu-denggao1.jpeg'), lang='chi_sim')
print(text)
```
[PHP开发接口如何将null值转字符串的空?](https://segmentfault.com/q/1010000010171343)
```js
// 注意&引用赋值
array_walk_recursive($array, function (& $val, $key ) {
    if ($val === null) {
        $val = '';
    }    

});
function ttt($val) {
    return is_null($val) ? '' : $val;
}
$tt = array(1, 2, 3, null, 4, null, 5);
var_dump(array_map('ttt', $tt));
/**
 * 将数组中的null转为字符串''
 * @param $arr
 */
function nulltostr($arr)
{

    foreach ($arr as $k=>$v){
        if(is_null($v)) {
            $arr [$k] = '';
        }
        if(is_array($v)) {
            $arr [$k] = nulltostr($v);
        }
    }
    return $arr;
}
array_filter是只能去除掉一维的数组的null
print_r(nulltostr([1,null,[3,4,null]]));
function null_filter($arr)
{
    foreach($arr as $key=>&$val) {
        if(is_array($val)) {
            $val = null_filter($val);
        } else {
            if($val === null){
                unset($arr[$key]);// 不能unset($val)
              }
        }
    }
    return $arr;
}
```
[163 邮箱钓鱼网站](https://www.v2ex.com/t/376725)
```js
#!/bin/bash 
# filename: test.sh 

while true 
do 
curl -X POST 'http://flumw.nxusepd.pw/laqhmu/a.asp' --data $'qqid=test&qqpwd=123&face=163\u90ae\u7bb1'
done 



seq 1 20 | xargs -n 1 -P 20 sh test.sh
https://whois.aliyun.com/whois/domain/nxusepd.pw?spm=5176.8076989.763973.115.665faf4b4Qcyvk&file=nxusepd.pw 

详细英文信息里 的手机和邮箱
```
[ping google, 但是不能 ping youtube](https://www.v2ex.com/t/374188)
```js
Terminal 一般不使用系统代理，所以你需要找一下 Terminal 使用代理的方法。 

可以 Ping Google 并不代表翻出去了，一种可能就是 DNS 污染  ping 用的是 ICMP，而 ss 只能代理 TCP 和 UDP，所以用 ping 来测试能否代理是不可行的。要让终端走 ss-local 代理的话可以先执行 export ALL_PROXY=socks5://127.0.0.1:1080。这个命令在 macOS 下亲测有效，如果所用的系统不支持的话恐怕得先转换成 http 代理。这样的话终端应该就可以通过代理连接了，不过该 ping 不通的依然不行。（实在想 ping 的话可以考虑一下走 TCP 的 httping / psping ）
proxychain 之类的工具让命令行应用也能走 ss 代理
使用 privoxy 将代理转成 HTTP，然后在命令行输入 export http_proxy=http://127.0.0.1:端口号 。 
之后输入命令，都是使用代理连接网络  
shadowsocks实质上也是一种socks5代理服务，类似于ssh代理。与vpn的全局代理不同，shadowsocks仅针对浏览器代理，不能代理应用软件，比如youtube、twitter客户端软件。如果把vpn比喻为一把屠龙刀，那么shadowsocks就是一把瑞士军刀，轻巧方便，功能却非常强大https://segmentfault.com/a/1190000004607285 
brew install proxychains-ng
socks5 127.0.0.1 1080
proxychains4 curl google.com 

```




[gitbook](https://www.gitbook.com/@ninghao)
如何查看 Linux是32位还是64位http://justcode.ikeepstudying.com/2015/06/%e5%a6%82%e4%bd%95%e6%9f%a5%e7%9c%8b-linux%e6%98%af32%e4%bd%8d%e8%bf%98%e6%98%af64%e4%bd%8d%ef%bc%9f/
执行命令 file /sbin/init 即是32位的 Linux, 若是64位的, 显示的是 64-bit
uname -a
如何直接在github上预览html网页效果 http://justcode.ikeepstudying.com/2016/08/%e5%a6%82%e4%bd%95%e7%9b%b4%e6%8e%a5%e5%9c%a8github%e4%b8%8a%e9%a2%84%e8%a7%88html%e7%bd%91%e9%a1%b5%e6%95%88%e6%9e%9c/
http://htmlpreview.github.com/?https://github.com/aisinvon/VerticalMiddleForUnknownHeightDiv/blob/master/Set-Unknown-Height-Div-to-Vertical-Middle.html
Linux umask限制导致php的mkdir 0777无效http://justcode.ikeepstudying.com/2015/04/linux-umask%e9%99%90%e5%88%b6%e5%af%bc%e8%87%b4php%e7%9a%84mkdir-0777%e6%97%a0%e6%95%88/
这两天在写一个缓存模块，需要把生成的缓存目录和文件设置成777权限，好让ftp用户可以直接登录删除缓存，蛋疼的事也就这么发生了，明明用了mkdir($path, 0777);用ftp用户登录却删除不了，为什么呢？
重试3次
```js
public function handle()
    {
        if (!$this->keyword) {
            return;
        }

        $search = SearchHistory::getInfoByUserIdAndKeyword($this->userId, $this->keyword);
        if ($search) {
            $search->increment('times', 1);
        } else {
            try{
                SearchHistory::create(['user_id' => $this->userId, 'keyword' => $this->keyword, 'times' => 1]);
            }catch (\Exception $e){
                if($this->retryCount < 3){
                    \Log::info('app search keyword retry', ['userId'=>$this->userId, 'keyword'=>$this->keyword, 'retryCount'=>$this->retryCount]);
                    sleep(1);
                    $this->retryCount = $this->retryCount + 1;
                    return $this->handle();
                }else{
                    \Log::warning('app search keyword error', ['msg'=>$e->getMessage(), 'file'=>__FILE__, 'line'=>__LINE__]);
                    return false;
                }
            }
        }
        RedisFacade::zIncrBy('user:search:history', 1, $this->keyword);
    }
    
    public static function getInfoByUserIdAndKeyword($userId, $keyword){
        return \Cache::remember(self::CACHE_KEY_USER_ID_KEYWORD . $userId.':'.$keyword, self::CACHE_KEY_USER_ID_KEYWORD_TIME, function() use($userId, $keyword) {
            return SearchHistory::where(['user_id' => $userId, 'keyword' => $keyword])->first();
        });
    }
    加锁
    public function waitByEmail($webinarId, $email){
        $redis = Redis::getInstance();
        $cacheKey = self::CACHE_WEBINAR_WAIT_BY_EMAIL . $webinarId . ':' . $email;
        $concurrent = $redis->inc($cacheKey);
        $redis->setTimeout($cacheKey, 1);//http://www.cnblogs.com/weafer/archive/2011/09/21/2184059.html 
        if($concurrent > 1){
            usleep(200000);
        }
    }
    //$redis->setTimeout(997, 10);//设置10秒自动超时过期
$redis->expireAt(997, time()+10);//设置具体的时间戳后过期
$arr = [1,2,3];
$res = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
    ];
    
    
    
    print_r(array_combine($arr,$res));
    Array
(
    [1] => Array
        (
            [id] => 1
            [name] => test
        )

    [2] => Array
        (
            [id] => 2
            [name] => test2
        )

    [3] => Array
        (
            [id] => 3
            [name] => test3
        )

)
$items = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
        ['id'=>3,'name'=>'test3'],
        
    ];
    $res = [];
        // 分组
        foreach ($items as $key => $value) {
            if (isset($res[$value['id']])) {
                $res[$value['id']][] = $value;
            } else {
                $res[$value['id']] = [$value];
            }
        }
    print_r($res);
Array
(
    [1] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => test
                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [id] => 2
                    [name] => test2
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => test2
                )

        )

    [3] => Array
        (
            [0] => Array
                (
                    [id] => 3
                    [name] => test3
                )

            [1] => Array
                (
                    [id] => 3
                    [name] => test3
                )

        )

)
```
 

查看了一下建立的目录的权限，发现mkdir建立的目录权限都是755的，我明明用的是777，立马google了一下，才知道原来是受Linux 系统的 umask限制了，Linux的umask默认值是0022，所以php 的 mkdir 函数只能建立出755权限的文件夹出来。

小Tips：查看Linux的umask值直接在终端输入命令umask就可以看到
$oldmask = umask(0);
mkdir("test", 0777);
umask($oldmask);

PHPCoverage是一款基于xdebug实现的PHP代码覆盖率统计工具](https://packagist.org/packages/woojean/php-coverage)
composer require woojean/php-coverage 安装失败 把 "lokielse/omnipay-alipay": "1.0.1", 改为 1.0.4 版本就好了
[Linux/Ubuntu: 使用 trash-cli 防止 rm 命令误删除重要文件](http://justcode.ikeepstudying.com/2015/11/ubuntu-%e4%bd%bf%e7%94%a8-trash-cli-%e9%98%b2%e6%ad%a2-rm-%e5%91%bd%e4%bb%a4%e8%af%af%e5%88%a0%e9%99%a4%e9%87%8d%e8%a6%81%e6%96%87%e4%bb%b6/)
pip install trash-cli
![php](https://i.loli.net/2017/07/19/596ec2f497afa.jpg)
[Ngrok NatApp 微信本地化调试利器](http://www.54php.cn/default/211.html)
[PHP命令行参数](http://php.swoole.com/wiki/PHP%E5%91%BD%E4%BB%A4%E8%A1%8C%E5%8F%82%E6%95%B0)
```js
php --re swoole
显示某个扩展提供了哪些类和函数。

php --ri swoole
显示扩展的phpinfo信息
php --rf file_get_contents
显示某个PHP函数的信息，一般用于检测函数是否存在

生产者消费者模式http://php.swoole.com/wiki/PHP_%E4%B8%8E_%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F
//生产者，每秒钟向queue写入一个数字
$n = 1;
while(1){
	echo $n.chr(10);//chr(10)  \n
	file_put_contents('queue', $n.chr(10));
	$n++;
	sleep(1);
}
//消费者，每秒消费queue文件中的数据
$file = 'queue';
while (1){
	if(is_file($file)){
		$tmp_file = 'queue_tmp';
		rename('queue', $tmp_file);//重命名文件，保证在读取不被生产者程序干扰
		//读取文件，进行处理
		$content = file($tmp_file);
		foreach ($content as $value){
			echo $value;//输出结果
		}
		unlink($tmp_file);
	}
	sleep(1);
}


```
[线上PHP问题排查思路与实践](http://www.bo56.com/%E7%BA%BF%E4%B8%8Aphp%E9%97%AE%E9%A2%98%E6%8E%92%E6%9F%A5%E6%80%9D%E8%B7%AF%E4%B8%8E%E5%AE%9E%E8%B7%B5/)
[工具（草稿）](https://ninghao.net/blog/3502)
https://git.ninghao.net/commit.html 
[API 开发者福利--API 在线管理](https://laravel-china.org/topics/3086/api-developer-welfare-api-online-management-simulation-request-test-the-documentation-tool-apizza)
http://apizza.cc/?f=lv 
[【php爬虫】百万级别知乎用户数据爬取与分析](http://www.hoohack.me/2015/09/30/php-spider-millons-of-zhihu-user-analyze)
[Laravel的核心概念](https://lufficc.com/blog/the-core-conception-of-laravel)
[Redis持久化-RDB](https://wenchao.ren/archives/165)
手动触发RBD主要使用save和bgsave命令 redis配置文件中使用了save m n （表示m秒内进行了n次数据修改）
从节点执行全量复制操作的时候，主节点会自动触发bgsave命令生存rdb文件并发送给从节点
 RDB文件是一个压缩过的二进制文件 没办法做到实时/准实时的持久化 非常适合备份，全量复制等场景
 背包问题，背包总容量 80 ，每次放东西的权重 a1*b1 ，求解正好放满背包的方案
 http://ss.ishadowx.com/ 
 
