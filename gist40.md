[Redis的并发控制](http://blog.liuhongnan.com/2017/07/03/Redis%E7%9A%84%E5%B9%B6%E5%8F%91%E6%8E%A7%E5%88%B6/?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
```js
update act set num=#{numNew} where actId=#{actId} and num=#{numOld}
即只有当查询出来的数据与当前数据库的数据一致时，才可以进行赋值操作，否则失败
```
[微信OAuth2.0网页授权流程总结](http://blog.liuhongnan.com/2017/03/23/%E5%BE%AE%E4%BF%A1OAuth2.0%E7%BD%91%E9%A1%B5%E6%8E%88%E6%9D%83%E6%B5%81%E7%A8%8B%E6%80%BB%E7%BB%93/)
```js
总结起来主要分为四步

用户同意授权，获取code

通过code换取网页授权access_token

刷新access_token（如果需要）

拉取用户信息(需scope为 snsapi_userinfo)
```

![imag](http://ojtlrnjhy.bkt.clouddn.com/2017-03-24-082728.jpg)

[迭代一个4GB大小的文件中功能中，迭代器大展身手](https://laravel-china.org/articles/5283/namespaces-traits-and-generators-for-php-new-features)
```js
function getRows($file) {
    $handle = fopen($file, 'rb');
    if ($handle === false) {
        throw new Exception();
    }
    //feof()函数检测是否到达文件末尾
    while (feof($handle) === false) {
        //fgetcsv()一次读取csv文件的一行
        yield fgetcsv($handle);
    }
    fclose($handle)
}

foreach (getRows('data.csv') as $row) {
    print_r($row);
}
超能力和超人不再是强依赖关系。超能力是由外部给予超人的，超人和超能力有依赖，但是这个依赖是外部给予，因此我们可以说超能力是由外部注入给他的，所以这就叫 依赖注入。

而反过来说，超人具有何种超能力不是他内部自身控制的，而是由外部控制的，相当于将超能力具有何种功效交给了外部，外部来决定超人该有的超能力，所以超能力的控制权被由自身控制反转为外部控制，这被称为 控制反转。
$user = User::find(1); 
$user->update([ 
'votes' => \DB::raw( 'votes + 1' ), 
'click' => \DB::raw( 'click + 1' ), 
]); 
https://github.com/XhstormR/GetBilibili http://www.jijidown.com/ http://kanbilibili.com/
这个我在用，可以下载 b 站视频，年头久远的视频也能 down 下来。 
https://weibomiaopai.com/ https://www.biliget.com/
HTML To Excelhttps://github.com/hejiheji001/tableExport.jquery.plugin
哔哩哔哩视频高能预警分析http://blbl.yidianit.com/
VIP视频在线观看http://www.maxiaohao.com/video/
帮你百度莆田系  
https://imjad.cn/baidu/?q=%E4%BB%80%E4%B9%88%E6%98%AF%E8%8E%86%E7%94%B0%E7%B3%BB http://buhuibaidu.me/?s=%E4%BB%80%E4%B9%88%E6%98%AF%E8%8E%86%E7%94%B0%E7%B3%BB http://www.baidu-x.com/?q=%E4%BB%80%E4%B9%88%E6%98%AF%E8%8E%86%E7%94%B0%E7%B3%BB http://ni.buhuigoogle.me/ http://zh.lmgtfy.com/ 《滚蛋吧，莆田系》 https://putianxi.github.io/
修改 
￼from PIL import Image 
if __name__ == "__main__": 
im = Image.open("mr.zhang.jpg") 
x, y = im.size 
for i in range(x): 
for j in range(y): 
r, g, b = im.getpixel((i,j)) 
if (20< r < 180) and (80< g < 250) and (180< b< 265): 
r, g, b = 255, 255, 255 
im.putpixel((i, j), (r, g, b)) 
im.show()


```
[前端原型工具](https://app.zeplin.io/project/595079b21963884d60a9b903/screen/5966de88343f499f1d40f308)
[JavaScript专题之深浅拷贝](https://juejin.im/post/59658504f265da6c415f3324)
```js
var arr = ['old', 1, true, null, undefined];
var new_arr = JSON.parse( JSON.stringify(arr) );
var new_arr = arr.concat();
var new_arr = arr.slice();
new_arr[0] = 'new';

console.log(arr) // ["old", 1, true, null, undefined]
console.log(new_arr) // ["new", 1, true, null, undefined]
var shallowCopy = function(obj) {
    // 只拷贝对象
    if (typeof obj !== 'object') return;
    // 根据obj的类型判断是新建一个数组还是对象
    var newObj = obj instanceof Array ? [] : {};
    // 遍历obj，并且判断是obj的属性才拷贝
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            newObj[key] = obj[key];
        }
    }
    return newObj;
}
var deepCopy = function(obj) {
    if (typeof obj !== 'object') return;
    var newObj = obj instanceof Array ? [] : {};
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            newObj[key] = typeof obj[key] === 'object' ? deepCopy(obj[key]) : obj[key];
        }
    }
    return newObj;
}
火车票查询工具 iquery https://zeronet.io/ 开放，自由，去中心化的网络，
使用 Bitcoin 加密和 BitTorrent 网络
写过一个很小的程序，就是把文字倒过来。心情不好的时候，我的微博都是倒着的http://old.haorenao.cn/reverse/
看例子，学 Python（一）https://segmentfault.com/a/1190000009903115
如何用一行代码表达程序员的自黑http://weibo.com/ttarticle/p/show?id=2309404120294456460748  使用OAuth 2.0进行GitHub API验证
XSS'OR 开源，Hack with JavaScript https://github.com/evilcos/xssor2
itchat+pillow实现微信好友头像爬取和拼接https://github.com/15331094/wxImage  欢迎关注我的公众号“玉树芝兰”。
https://www.tshe.com/c/1155795c 一个实现创想的定制平台 http://doge.tv/
https://github.com/jkchao/books  https://github.com/yuanliangding/books 
Go 交互式REPLhttps://github.com/d4l3k/go-pry
https://lmgtfy.com/  let me google that for you 的中文版 http://zh.lmgtfy.com/?q=PHP
ni.buhuigoogle.me  http://buhuibaidu.me/?s=%E4%BD%A0%E4%B8%8D%E4%BC%9A%E8%87%AA%E5%B7%B1%E7%99%BE%E5%BA%A6%E4%B9%88%EF%BC%9F%EF%BC%9F
Quilt：一个数据包管理器，像管理代码那样管理数据。采用Python编写。 ​​​​https://quiltdata.com/ pip install quilt PHP自动话工具 Robohttp://robo.li/ http://weibo.com/1088413295/FctnK3GKV
netdata 。一款强大的附带UI的跨平台机器监视工具https://github.com/firehol/netdata/wiki/Installation
awesome-guidelines: 高质量的编码风格约定和标准资源大全https://github.com/Kristories/awesome-guidelines 真正的利器叫做markdown-here https://github.com/adam-p/markdown-here sukhoi：python实现的灵活可扩展的Web爬虫。 ​​​​
世界上最好的语言可以在浏览器里运行了https://gitlab.com/kornelski/babel-preset-php#php7-to-es7-syntax-translator  推荐一个牛X大数据买房微信公众号：撸房价（或搜索lulufangjia）
git config --global alias.undo 'reset --soft HEAD ^'  Git 全局配置。它是你 home 目录中的 .gitconfig 文件 https://segmentfault.com/p/1210000010168660/read
$ git config --global alias.glog "log --graph --pretty=format:'%Cred%h%Creset -
%C(yellow)%d%Creset %s %Cgreen(%cr) %C(bold blue)%Creset'"
请搜索emule、bt sync、zeronet，不谢  发现一个网站https://www.relive.cc/view/1078895740，可以将你的路线（跑步、骑车、健行等等）转换成小视频
JavaScript深入系列https://github.com/mqyqingfeng/Blog  很好玩的软件BitTorrent-Sync(bt sync)
https://pan.baidu.com/s/1c2uwEGC#list/path=%2F%E8%BD%AF%E4%BB%B6%E5%88%86%E4%BA%AB&parentPath=%2F 自己两个电脑异地同步
基于Node 的一个网络爬虫 API接口https://ecitlm.github.io/SpliderApi
开启TCP BBR拥塞控制算法https://github.com/iMeiji/shadowsocks_install/wiki/%E5%BC%80%E5%90%AFTCP-BBR%E6%8B%A5%E5%A1%9E%E6%8E%A7%E5%88%B6%E7%AE%97%E6%B3%95  devdocs.io
```
[PHP OCR实战：用Tesseract从图像中读取文字](http://www.codeceo.com/article/php-ocr-tesseract-get-text.html)
[Using Tesseract OCR with Python](http://www.pyimagesearch.com/2017/07/10/using-tesseract-ocr-python/)
[js 变量作用域](https://www.v2ex.com/t/375425)
```js
var getPrecent = function(){ 
	$.getJSON(Url, requestData, function (rv) { 
		var response = rv.Value; 
		ret = response.Process; 
		if (ret == 100) { 
			console.log("Done!，已完成100%"); 
		}else{ 
			console.log("已完成"+ret+"%");
			setTimeout(getPrecent,200); 
		} 
	}); 
}; 
getPrecent();
```
[端口扫描 视频vip解析](http://www.liuwx.cn/nmap/scanPort.php)
[shadowsocks Python 一键安装](https://github.com/iMeiji/shadowsocks_install/wiki/shadowsocks-Python-%E4%B8%80%E9%94%AE%E5%AE%89%E8%A3%85)
[在线执行代码](https://glot.io/snippets/ern6rrksm5)
http://sandbox.onlinephpfunctions.com/ http://www.duoluosb.com/coderunner 
微信支付付款
```js
// 微信付款 type=1 app付款 type=2网页付款 pay.weixin.qq.com 
    public function wechatpay($order_id,$openid,$amount,$desc,$type=1){
        if ($type == 1) {
            $appid = config('services.appwxpay.appid');
            $mchid = config('services.appwxpay.mchid');
            $appkey = config('services.appwxpay.key');
            $cert_path = config('services.wxtransfer.appsslcert_path');
            $key_path = config('services.wxtransfer.appsslkey_path');
        } else if ($type == 2) {
            $appid = config('services.wxpay.appid');
            $mchid = config('services.wxpay.mchid');
            $appkey = config('services.wxpay.key');
            $cert_path = config('services.wxtransfer.wapsslcert_path');
            $key_path = config('services.wxtransfer.wapsslkey_path');
        }
        $arr = [
            'mch_appid'=>$appid,
            'mchid'=>$mchid,
            'nonce_str'=>str_random(32),
            'partner_trade_no'=>$order_id,
            'openid'=>$openid,
            'check_name'=>'NO_CHECK',
            'amount'=>$amount*100,
            'desc'=>$desc,
            'spbill_create_ip'=>\Request::getClientIp(),
            'sign'=>'',
        ];
        ksort($arr);
        $sign="";
        foreach ($arr as $key => $value) {
            if($value && $key!="sign" && $key!="key"){
                $sign.=$key."=".$value."&";
            }
        }
        $sign.="key=".$appkey;
        $arr['sign'] = strtoupper(md5($sign));
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
                if (is_numeric($val))
             {
                $xml.="<".$key.">".$val."</".$key.">"; 

             }
             else
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
       
        $ch = curl_init();
        //超时时间
        curl_setopt($ch,CURLOPT_TIMEOUT,60);
        curl_setopt($ch,CURLOPT_URL,'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers');
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        //默认格式为PEM
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT,$cert_path);
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,$key_path);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
        $data = curl_exec($ch);
        $data = json_decode(json_encode(simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        curl_close($ch);
        return $data;
    }
```
[Laravel5中Cookie的使用](http://www.cnblogs.com/phpper/p/6801678.html)
```js
$foreverCookie = Cookie::forever('forever', 'Success');
    $tempCookie = Cookie::make('temporary', 'My name is fantasy', 5);//参数格式：$name, $value, $minutes
    return Response::make()->withCookie($foreverCookie)->withCookie($tempCookie);
    public function index(Request $request)
{
    $cookie = $request->cookie('test');
    dump($cookie);
}当我们需要在客户端使用的时候，获取Cookie的值就不是这样了。首先，我们通过响应withCookie($cookie)传输到客户端的数据并不是一个字符串，而是一个cookie对象
<div>{{ $cookie->getValue() }}</div>
$cookie = Cookie::forget('test');
//return Redirect::route('index')->withCookie($cookie);
```
[关于laravel5 消息订阅/发布的理解初](http://www.cnblogs.com/phpper/p/6867786.html)
```js
 public function handle()
    {
        \Redis::psubscribe(['user-channel'], function($message) {
            echo $message;
        });
    }
    现在控制台中输入:php artisan redis:subscribe 启动服务进程
    
    Route::get('test', function () {
    // 路由逻辑...
　　\Redis::publish('user-channel', json_encode(['username' => 'mary','message'=>'i miss you']));
 });
 Route::get('/get', function () {
    $exitCode = \Artisan::call('redis:subscribe');//这里应该是代码启动进程监听的命令了
});
if(count($array) == count($array, 1)){
　　echo '一维数组';
}else{
　　echo '多维数组';
}
MYSQL表记录字段换行符回车符处理

UPDATE 表名 SET  字段= REPLACE(REPLACE(字段, CHAR(10), ''), CHAR(13), ''); 
```
[多个php版本的composer使用](http://www.cnblogs.com/phpper/p/6795711.html)
```js
1：下载composer.phar，官网有直接下载的链接，https://getcomposer.org/download/<br>
2：composer.phar 复制到项目根目录，比如我的是:/home/www/web<br>
3:执行 /usr/local/php7/bin/php composer.phar update （这里我的安装路径是/usr/local/php7/bin/php,不一定适合你额，请对号入座即可吧）<br>
4：安装依赖包：/usr/local/php7/bin/php composer.phar require laravel/scout
```
[已经编译好的 ngrok服务端和客户端，服务端支持Linux、Mac、Windows，有自己服务器有需要的朋友可以自己搭建
](http://www.sunnyos.com/article-show-74.html )
 [(招募截止)『Python爬虫小分队』学习群第三期招募](http://www.jianshu.com/p/f00d19916b53)
[PHP基础知识系统复习](http://blog.csdn.net/qq_34625397/article/details/51785421)
[百度网盘](http://www.baiduyunpan.net/)
[正则表达式101](http://regex.zjmainstay.cn/r/7yHAms/1)
[ nginx配置文件nginx.conf conf.d](http://blog.csdn.net/qq_34625397/article/details/51460209)
```js
.(dot) 是以你当前运行文件路径为当前路径
发布后被其他用户引用, 在你Python安装目录下有一个Lib目录, 直接像import os这样的是引用该目录下全局的模块
import os
os.path...
可以运行是因为os是一个模块, 也是一个可运行的python文件

客户端请求服务端的时候请求头会带上本地的cookie, request headers里面有 Cookie: xxxx

所以服务器就能看到客户端的cookie,如果服务端要给客户端设置cookie,就会在response里面添加一个set-cookie: xxxx; 客户端接受到就会写在本地,下次请求的时候再把本地cookie带上去https://segmentfault.com/q/1010000010070806

composer不知什么原因，遇到https，就会报SSL: Handshake timed out，Google也没结果
打开php.ini, 将default_socket_timeout值调大。如：default_socket_timeout=360(默认为-1或60)
$count = 0;
$str   = '12#{店铺dagf称}gds#{奋斗区}sffd#{店盖饭}fdf#{奋斗}fsa';
$str   = preg_replace_callback('/#\{[^}]*\}/', function() use (&$count) {
    return '{$var' . ++$count . '}';
}, $str);
print_r($str);
运行结果：

12{$var1}gds{$var2}sffd{$var3}fdf{$var4}fsa
求重组数组 有点递归https://segmentfault.com/q/1010000010067017
$arr = [ ... ];
$result = [];

$arr = array_column($arr, NULL, 'id');

foreach($arr as $item) {
    if(empty($arr[$item['pid']])) {
        $result[] = &$arr[$item['id']];
    } else {
        if(empty($arr[$item['pid']]['content']))
            $arr[$item['pid']]['content'] = [];
        $arr[$item['pid']]['content'][] = &$arr[$item['id']];
    }
}

var_export($result);
call_user_func([$this->hello, $name]);
PHP7 sql_regcase 的替代函数https://segmentfault.com/q/1010000010085188
$string = preg_replace_callback( '/[a-zA-Z]/', function($matches){
        return "[".strtoupper($matches[0]).strtolower($matches[0])."]";
    } , 'hello-. world-.');
    var_dump($string);
结果:

string(45) "[Hh][Ee][Ll][Ll][Oo]-. [Ww][Oo][Rr][Ll][Dd]-."
https://glot.io/snippets/erfs6n65cp 
1、富文本编辑器可以用百度的UEditor
2、正如楼上所说，你可以用ajax来提交，但是这个有一点不好，如果有一百个输入框，难道提交一百个键值对？
3、所以你可以用js的formData对象，图片也可以发送过去，代码如下
    $("#submit").click(function() {
        var x = new FormData(document.getElementById("frm"));//构造方法里面必须是dom对象
        x.append('abc', 123);//追加你的数据
        $.ajax({
            url: '1.php',
            type: 'POST',
            data: x,
            processData: false,  // 告诉jQuery不要去处理发送的数据
            contentType: false   // 告诉jQuery不要去设置Content-Type请求头
        })
        .success(function(data) {
            //代码
        });
    });
4、也可以用serializeArray函数模拟上面的formData对象，代码如下
    var allDatas = $("form").serializeArray();
    allDatas.push({name:'data',value: JSON.stringify(你的数据对象)});//追加的格式必须是name，value形式，打印allDatas的格式就知道了！！！
    $.post(url,allDatas,function(json){//代码
    });
测试环境被百度快照抓了
先找百度提交删除申请

然后测试环境记得加 robots.txt 不给抓取，或者在 nginx 上 直接拒绝 来自蜘蛛的请求.
$oldArr = [
    ['a', 1],
    ['', 2],
    ['', 3],
    ['b', 4],
    ['', 5],
    ['c',6],
    ['',7]
];

$newArray = [];

$temp = '';
foreach ($oldArr as $item) {
    if ($item[0]) {
        $temp = $item[0];
        $newArray[$temp] = $item[1];
        continue;
    }
    $newArray[$temp] .= ','.$item[1];
}
php与nginx和apache的通信过程分别是什么样的？https://segmentfault.com/q/1010000010075777
CGI全名common gateway interface,只是一种协议
fcgi是fastcgi，可以看作cgi的升级版。他有一个常驻的进程池管理，而这点是cgi没有的。
php-fpm是对fastcgi的php实现，是php的进程池管理。

总的来说，cgi和fastcgi是协议，php-fpm是fastcgi的php实现。
nginx与php-fpm通过socket通信,通信方式分两种:

[1]unix socket 可进行同一台服务器上的多个进程进行数据通信
[2]tcp socket 可跨服务器通信,效率略低于unix socket
nginx与fpm通信过程

UNIX Domain Socket:
Nginx <=> socket <=> PHP-FPM

TCP Socket(本地回环):
Nginx <=> socket <=> TCP/IP <=> socket <=> PHP-FPM

TCP Socket(Nginx和PHP-FPM位于不同服务器):
php foreach 引用的问题https://segmentfault.com/q/1010000010039585

php怎么把jpg转换成webp格式
php-imagick


$im = new Imagick('your-file-path');
$im->setFormat('webp');
$im->writeImage('webp-file.webp');

如果二维数组中的，$oldArr[i][0] 的值为空，就以上一个不为空的值填充
$oldArray = [
    ['A0060750', 9787560618852],
    ['', 9787560618855],
    ['', 9787560618856],
    ['A00607507', 9787560618857],
    ['', 9787560618857]
];

$lastId = '';
foreach ($oldArray as &$item) {
    if ($item[0]) {
        $lastId = $item[0];
        continue;
    }
    $item[0] = $lastId;
}
怎么解决for循环调用递归函数时，数据包含上一条数据记录https://segmentfault.com/q/1010000010032189
```

[快捷打印 Laravel 中的数据库查询（SQL）语句](https://laravel-china.org/articles/5166/quick-print-laravel-database-query-sql-statement)
```js
当你的 APP_ENV 设置为 local、请求 URL 后面紧跟 ?sql-debug=1 时，就会打印出请求处理逻辑中涉及到的所有数据库查询语句。

配置#

AppServiceProvider 的 boot 方法内写入

use DB;
use Event;

if ( env('APP_ENV') === 'local' ) {
    DB::connection()->enableQueryLog();
    Event::listen('kernel.handled', function ( $request, $response ) {
        if ( $request->has('sql-debug') ) {
            $queries = DB::getQueryLog()；
            if (!empty($queries)) {
                foreach ($queries as &$query) {
                    $query['full_query'] = vsprintf(str_replace('?', '%s', $query['query']), $query['bindings']);
                }
            }
            dd($queries);
        }
    });
}
```
[Chrome插件：更好的GitHub代码搜索和浏览](https://about.sourcegraph.com/blog/faster-smoother-github-code-browsing/)
[微信开发之微信登录](https://segmentfault.com/p/1210000010009577/read#top)
[高效使用 Python 可视化工具 Matplotlib](http://python.jobbole.com/87831/)
```js
import pandas as pd
import matplotlib.pyplot as plt
from matplotlib.ticker import FuncFormatter
 
df = pd.read_excel("https://github.com/chris1610/pbpython/blob/master/data/sample-salesv3.xlsx?raw=true")
df.head()
```
[如何用Python做舆情时间序列可视化？](http://www.jianshu.com/p/4ea083874df4)
```js
pip install snownlp
pip install ggplot
import pandas as pd
df = pd.read_excel("https://github.com/wshuyi/workshop-NKU-mlis-20170702/raw/master/restaurant-comments.xlsx")
def get_sentiment_cn(text):
    s = SnowNLP(text)
    return s.sentiments
text = df.comments.iloc[0]
s = SnowNLP(text)
s.sentiments
df["sentiment"] = df.comments.apply(get_sentiment_cn)
df.head()
df.sentiment.mean()#我们来把所有的情感分析结果数值做一下平均。使用mean()函数即可。
from ggplot import *
ggplot(aes(x="date", y="sentiment"), data=df) + geom_point() + geom_line(color = 'blue') + scale_x_date(labels = date_format("%Y-%m-%d"))
df.sort(['sentiment'])[:1]
print(df.sort(['sentiment']).iloc[0].comments)#所有评论里情感分析数值最低的那条 欢迎关注我的公众号“玉树芝兰”。
```
[看例子，学 Python（一）](https://segmentfault.com/a/1190000009903115)
```js
打印 100 以内的数列：

>>> a, b = 0, 1
>>> while a < 100:
...     print(a, end='')
...     a, b = b, a+b
...
0 1 1 2 3 5 8 13 21 34 55 89 >>>

def fac(n):
    """C-style implementation"""
    result = 1
    while n > 1:
        result = result * n
        n -= 1
    return result
    def fac(n):
    result = 1
    for i in range(2, n+1):
        result *= i
    return result
def fib(n):
    result = []
    a, b = 0, 1
    while a < n:
        result.append(a)
        a, b = b, a+b
    return result
    
    
    
    def char_counter(chars):
    counter = {}
    for c in chars:
        counter[c] = counter.get(c, 0) + 1
    return counter
```
[SQL两个字段不区分顺序去重](https://segmentfault.com/q/1010000010089529)
```js
select aa,bb from (select case when a<=b then a else b end aa,case when a<=b then b else a end bb from tbl) tt group by aa,bb;
数据库如何判断一条数据是否被修改?https://segmentfault.com/q/1010000010059342
乐观锁用的是版本号字段实现的，每次更新成功后时候版本号字段的值加1在更新前，先检查数据库中的版本号和页面中保存的版本号是否相同，如果版本号变大，提示用户在编辑期间已有其他用户修改了数据。

当然也可以用悲观锁，进入页面的时候使用的select ... for update锁定记录，这时候其他用户就不能同时编辑锁定的记录了。
加个字段，edit_num，每改一次+1，B要改的时候比对一下。
脚本中可能有特殊字符，使用cat -A test.sh看一下
要让这个提醒消失也很简单，就是指定输出流向，例如：
nohup ls / >/dev/null 2>&1 &
在文件中固定以这样的字符串出现: "count:XX"
举个例子：
A/1A/data/20170630/asd.txt
A/1A/data/20170630/zxc.txt
A/2B/data/20170630/dfg.txt
A/2B/data/20170630/dnv.txt
我需要获取到这些txt文件中count后的数值。
grep -rPo '(?<=count:)\S+' *  https://segmentfault.com/q/1010000010024582
前端ajax：

data = {};
$.ajax({
    type: "post",
    url: "url",
    dataType: "json",
    data: JSON.stringify(data),
    success: function(result) {
    }
});
后端取值：

import json
data = json.loads(request.body)
print data['key']
不小心强制提交了git push origin master -f

执行 git reset 之后，在 .git/objects 文件夹里面的内容并没有相应的删除。

运行 git reflog 可以找到之前的提交 ID（commit_id)

然后再 git reset --hard commit_id
Git线上存在一个文件，本地修改文件，如何让这个文件不被提交
$ git update-index --assume-unchanged /path/to/file #忽略跟踪

$ git update-index --no-assume-unchanged /path/to/file #恢复跟踪
https://segmentfault.com/q/1010000010079121 
ps: .gitignore 只会对未加入版本控制的文件有效,如果你已经加入过了,那这个文件就帮不了你了
1、看看有没有隐藏的大文件

du -sh .*
2、看看有没有程序运行过程删除的文件，虽然文件删了，但占的空间并没有释放：
如果有输出的话，说明有删除过正在运行的程序产生的文件
lsof |grep delete
怎么用一行shell语句统计这两个文件行数之和
wc -l f1 | awk '{print $1}'
wc -l f1 f2|awk 'END{print $1}'
或者：

awk 'END{print NR}' f1 f2
$read  =  ture;
$limit =  0;
while($read)
{    

    $sql = "select id,name from table limit {$limit},5";
    $data = $db->select($sql); 
    //todo 你的业务逻辑
    
    if(!data)
    {    
        $read = false;
        break;数据为空,直接停止了循环
    }
   
    $limit += 5;每次获取后面5条,直至数据查询为空.

}
有一个ajax请求，当用户登录的时候可以返回数据，当session过期了，就跳转到登录页，怎么做呢？
过期了，会返回 401 状态码

默认情况下，axios 会将 401 丢给 error ，你在 catch 里处理到401状态码 跳转到登录页面即可。
php 静态调用非静态方法是如何做到的归根结底是通过 魔术方法 __callStatic 实现的
Illuminate\Support\Facades\Facade 代码最下方




```
[php一个算法问题](https://segmentfault.com/q/1010000010104906)
```js
这个二进制设计就不太对，二进制可以只用3个位来标记对应的优惠。

// 以下为二进制
000 // 表示无优惠，十进制0
001 // 表示会员折扣，十进制1
010 // 表示满减
100 // 表示优惠券
会员和满减谁优先，其实并不用标记。因为这个是产品折扣本身的信息，不需要基于用户选定的值。（永远不要相信用户输入）
所以，最后用户可能选的值就是从000到111的值，也就是十进制0到7。
然后，这样就很容易分离出每一个折扣来了：

$is_vip = $value & 1;
$is_amount_cut = ($value & 2) >> 1;
$is_discount = ($value & 4) >> 2;
拆完之后，下面的逻辑判断其实就非常容易了，先判断只能一种的情况

elseif($is_vip + $is_amount_cut + $is_discount > 1)
# 上面用了位移而没有直接使用布尔值，就是为了这边可以使每一个为真的优惠标记权值为1
# 权值加起来如果大于1，表示用了一种以上的优惠了
然后判断两个的情况

if($is_vip + $is_amount_cut + $is_discount == 2) {
    if(!$is_vip)
        ...
    elseif(!$is_amount_cut)
        ...
    else
        ...
}
# 由于每个权值都是1，所以加起来等于2时候只可能有一个为假值（0）
# 所以只需要判断哪个标记为假，就可以判断出用了哪两种优惠
下面是三种优惠

elseif($is_vip + $is_amount_cut + $is_discount >= 3)
或者

elseif($is_vip && $is_amount_cut && $is_discount)
对于list的+=,它要求右边对象是iterable的,也就是说,能够用于迭代的, 例如元组,列表甚至是字典这些, 而append则没这个要求, 因为它直接将右边的对象,当成一个整体, 追加到列表末尾! 可以通过下面的例子帮助理解

# += 演示
>>> a = []
>>> a+= (1,2)
>>> a
[1, 2]
>>> a+= [1,2]
>>> a
[1, 2, 1, 2]
>>> a+= {'a':123, 'b':333}
>>> a
[1, 2, 1, 2, 'a', 'b']

# append 演示
>>> a.append({'a':123, 'b': 333})
>>> a
[1, 2, 1, 2, 'a', 'b', {'a': 123, 'b': 333}]
>>> a.append((1,2))
>>> a
[1, 2, 1, 2, 'a', 'b', {'a': 123, 'b': 333}, (1, 2)]

boss第一天给你一元钱，后面每一天给你的是前一天的一倍。 也就是说1，2，4，8.... 。现问到了30天后，你一共拿了多少钱https://segmentfault.com/q/1010000010053216
/*
·递归
  1. salarySum(n) = salarySum(n-1) + salary(n)
  2. salary(n) = 2 ^ (n-1)

·非递归
  循环
*/

function salary(nthDay){
  return Math.pow(2, nthDay-1)
}

// 递归
function salarySum(nthDay) {
  if (nthDay > 1) {
    return salarySum(nthDay - 1) + salary(nthDay)
  } else {
    return 1
  }
}

// 非递归
function salarySum(nthDay) {
  let day = 1
  let sum = 0
  while (day <= nthDay) {
    sum += salary(day)
    day++
  }
  return sum
}
function recursion($day){
    if($day == 1){
        return 1;
    }else{
        return recursion($day - 1) + pow(2,$day - 1);
    }
}
echo recursion(30);
正则匹配连续5个1212121212或者2121212121，可以重复利用数字https://segmentfault.com/q/1010000010042330
使用环视提取子分组：(?=.*?((12|21)\2{4}))
>>> import re
>>> ss='1212121212121212121212'
>>> re.findall(r'(?=((12|21)\2{4}))',ss)
[('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12'), ('2121212121', '21'), ('1212121212', '12')]

```
[前端职业规划 live 中的彩蛋到底怎么解](https://www.zhihu.com/question/62071167/answer/194308872)
```js
作者：匿名用户
链接：https://www.zhihu.com/question/62071167/answer/194308872
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

对下面的那串数字解析下: 100,119,122,46,99,110,47,54,57,76,82,104,117 
最开始用ASCII码试了下,好像能对上,对着码表翻了下100: d
119:  w
嗯,短连接-> dwz.cn/69LRhu然后有人提到 Unicode,嗯,也是对的上的. 这个故事告诉我们 Unicode 兼容ASCII 码(废话)短连接的跳转的url是https://www.zhihu.com/people/xiao-jue-83/activities?code=aHR0cHM6Ly96aHVhbmxhbi56aGlodS5jb20vcC8yNzUwNzg2NV1BRVNVMkZzZEdWa1gxL1ZGblN4V3UxTUNySVJGVHZHMnRsTjduTzFrb0FzcmkxWVRrWE0yRk80RktRVm5id1Y3NytpCjZVTjRKazJkODVJUU1Lcmt6eUhPeWc9PQ==
小爝的专栏,URL后面跟了一个可疑的code ='aHR0cHM6Ly96aHVhbmxhbi56aGlodS5jb20vcC8yNzUwNzg2NV1BRVNVMkZzZEdWa1gxL1ZGblN4V3UxTUNySVJGVHZHMnRsTjduTzFrb0FzcmkxWVRrWE0yRk80RktRVm5id1Y3NytpCjZVTjRKazJkODVJUU1Lcmt6eUhPeWc9PQ=='
然后看着==结尾,嗯,base64吧, 然后试着用atob(code);
结果是https://zhuanlan.zhihu.com/p/27507865]AESU2FsdGVkX1/VFnSxWu1MCrIRFTvG2tlN7nO1koAsri1YTkXM2FO4FKQVnbwV77+i
6UN4Jk2d85IQMKrkzyHOyg=
从最开始有意义的字符猜测,这个解码是正确的. 有意义的字符后面从] 开始的乱码 嗯...是以AES开头的. AES嗯,接下来就是找密匙的过程. 尝试了几百次之后,以我天才的智商, 我去问了下 @Jasin Yip 同学. 套出了密匙:  小爝      (Notes:此处可见这俩应该是真爱).在http://tool.oschina.net/encrypt . 输入密匙和加密码.真相就在眼前.https://www.zhihu.com/lives/861180779319934976
```



[字符编码发展史和密码算法那些事儿](http://www.freebuf.com/articles/others-articles/136742.html)
[【吐槽】PHP编程中遇到令人抓狂的“bug”](http://bbs.51cto.com/thread-1506888-1.html)
[写个隐藏链接指过去。人是不会点的，爬虫一进去就挂掉了](https://blog.haschek.at/2017/how-to-defend-your-website-with-zip-bombs.html)
```js
$agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

//check for nikto, sql map or "bad" subfolders which only exist on wordpress
if (strpos($agent, 'nikto') !== false || strpos($agent, 'sqlmap') !== false || startswith($url,'wp-') || startswith($url,'wordpress') || startswith($url,'wp/'))
{
      sendBomb();
      exit();
}
//dd if=/dev/zero bs=1M count=10240 | gzip > 10G.gzip 最流行的curl默认要求服务器返回的非压缩内容，这种方法不会有用的。写爬虫的人不会开启这个选项的
function sendBomb(){
        //prepare the client to recieve GZIP data. This will not be suspicious
        //since most web servers use GZIP by default
        header("Content-Encoding: gzip");
        header("Content-Length: ".filesize('10G.gzip'));
        //Turn off output buffering
        if (ob_get_level()) ob_end_clean();
        //send the gzipped file to the client
        readfile('10G.gzip');
}

function startsWith($a, $b) { 
    return strpos($a, $b) === 0;
}
DNS 子域名遍历工具 dnssearchhttps://github.com/evilsocket/dnssearch
想知道男朋友去哪了，iPhone定位查询http://weibo.com/2824626113/FaEFldqS6
Temper Chrome：好用到飞起的 HTTP 请求修改插件https://zhuanlan.zhihu.com/p/27657281?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io
微博码农圈观察 http://ic.civiw.com/cd/0946C8379B8042576FBE669A5F101A46 http://weibo.com/2194035935/FaGI8s6ZA
一个chrome插件 —— CatGate，可以抓取网页信息http://weibo.com/1071036042/FaH5Dxbh7 https://github.com/easychen/catgate
全部删除、转发微博、原微博已删除http://chrome.weibodangan.com/ http://www.jijidown.com/

火车票查询工具 iquery https://zeronet.io/ 开放，自由，去中心化的网络，
使用 Bitcoin 加密和 BitTorrent 网络
写过一个很小的程序，就是把文字倒过来。心情不好的时候，我的微博都是倒着的http://old.haorenao.cn/reverse/
看例子，学 Python（一）https://segmentfault.com/a/1190000009903115
如何用一行代码表达程序员的自黑http://weibo.com/ttarticle/p/show?id=2309404120294456460748  使用OAuth 2.0进行GitHub API验证
XSS'OR 开源，Hack with JavaScript https://github.com/evilcos/xssor2
```
[玩转算法面试 leetcode题库分门别类详细解析](http://coding.imooc.com/class/82.html?mc_marking=f3bfe42ef90a9df5a2ab48e6a80a35ab&mc_channel=weibo&mc_billing=%E5%85%8D%E8%B4%B9%E8%B5%A0%E9%80%81&mc_keywords=&mc_position=&mc_business=)
[MySQL日志审计 帮你揪出内个干坏事儿的小子](http://suifu.blog.51cto.com/9167728/1881116)
```js
如果我们想对数据库进行审计，去看是谁把我的数据库数据给删了，该怎么办呢？我们主要利用init-connect参数，让每个登录的用户都记录到我们的数据库中，并抓取其connection_id()，再根据binlog就能够找出谁干了那些破事儿。
mysql> CREATE TABLE accesslog (
    -> ID INT (10) UNSIGNED NOT NULL PRIMARY KEY auto_increment,
    -> ConnectionID INT (10) UNSIGNED,
    -> ConnUser VARCHAR (30) NOT NULL DEFAULT '',
    -> MatchUser VARCHAR (30) NOT NULL DEFAULT '',
    -> LoginTime datetime
    -> );
    vi my.cnf
    init-connect='Insert into auditdb.accesslog(ConnectionID ,ConnUser ,MatchUser ,LoginTime)values(connection_id(),user(),current_user(),now());'
    /etc/init.d/mysqld restart
    
    +----+--------------+-----------------+-----------+---------------------+
| ID | ConnectionID | ConnUser        | MatchUser | LoginTime           |
+----+--------------+-----------------+-----------+---------------------+
|  1 |           10 | helei@localhost | helei@%   | 2016-12-08 19:07:49 |
|  2 |           19 | helei@localhost | helei@%   | 2016-12-08 19:08:44 |
|  3 |          125 | helei@localhost | helei@%   | 2016-12-08 19:24:46 |
|  4 |          128 | yuhao@localhost | yuhao@%   | 2016-12-08 19:25:01 |
|  5 |          182 | helei@localhost | helei@%   | 2016-12-08 19:33:02 |
|  6 |          185 | yuhao@localhost | yuhao@%   | 2016-12-08 19:33:20 |
+----+--------------+-----------------+-----------+---------------------+
```
[设计模式总结（C++和Python实现）](https://www.nowcoder.com/discuss/22886)
[密码保护来让数据安全的Python库](https://github.com/ofek/privy)
```js
>> data = b'secret'
pip install privy
>>> hidden = privy.hide(data, ask_for_password())
>>> hidden
'1$2$fL7xRh8WKe...'
>>> privy.peek(hidden, password)
b'secret'
在线拼接电影字幕截图工具http://join-screenshots.zhanghai.me/
关于互联网公司工作信息共享的网站http://www.zhijie.pro/
https://qingbuyaohaixiu.com/archives/category/%e5%a4%a7
youtube-dl 可以加参数：--proxy socks5://127.0.0.1:1080/ 
这样就可以走 ss 下载了，实测下 youtube 视频可满速，当然前提是 ss 要足够快
https://github.com/XhstormR/GetBilibili http://www.jijidown.com/ http://kanbilibili.com/
这个我在用，可以下载 b 站视频，年头久远的视频也能 down 下来。 
https://weibomiaopai.com/ https://www.biliget.com/
HTML To Excelhttps://github.com/hejiheji001/tableExport.jquery.plugin
哔哩哔哩视频高能预警分析http://blbl.yidianit.com/
[Python 全栈之路系列文章]( https://blog.ansheng.me/article/python-full-stack-way/)
在线 Mock 服务https://www.easy-mock.com/ https://github.com/alibaba/anyproxy
https://github.com/MrRio/jsPDF
https://freelancersinchina.github.io/diveintophp
https://www.v2ex.com/t/358526#reply67 收藏有哪些技术博客
V2EX API 接口https://www.v2ex.com/p/7v9TEc53
微信机器人技术http://xun.im/2017/04/26/weixin-robots-tecnicical-review/
go get github.com/six-ddc/httpbin
终端版 V2EXhttps://github.com/creatorYC/v2ex-terminal
git push -u origin master , 这里就是把 master （默认 git 分支）推送到 origin， -u也就是--set-upstream, 代表的是更新 默认推送的地方，这里就是默认以后git pull和git push时，都是推送和拉自 origin git reset --hard commitID, 把整个 git 回退到这个 commitID 里
grep -R keyword ./ , 我是更喜欢用 git grep keyword
https://www.gitbook.com/book/tl3shi/the-way-to-go/details  Go入门指南http://123.56.1.216/ 微信订阅号：bulabean http://wiki.jikexueyuan.com/project/the-way-to-go/ 轻松跳过广告：document.getElementsByTagName('video')[0].currentTime = 100;VIP视频在线观看http://www.maxiaohao.com/video/ 找到nginx网站根目录$nginx -V   –prefix里的/usr/share/nginx就是目录 https://www.v2ex.com/t/368083#reply76
每次执行 password_hash('123456', PASSWORD_BCRYPT) 语句后，得到哈希值都不一样 在不同的服务中使用同一个密码的用户，他的密码的安全性变高了  
请不要在config 目录的其他地方使用env函数 config:cache 后就肯定读不到了，config:clear 后就可以了 ig('services.juhe.app_key')
add=(x,y)=>x+y;
(x,y)=>x+y
monitor(add) 使用 monitor函数来监控一函数 monitorEvents(document.body, "click"); 监控相关的事件  getEventListeners($("selector")) 来查看某个DOM对象上的事件
undefined
add(1,2)
VM205:1 function add called with arguments: 1, 2
 show processlist; 查看当前mysql中各个线程状态。找到消耗资源最大的那条语句对应的id kill id;
微信公众号【架构栈】： ForestNotes
简单加密程序http://tools.weibodangan.com/work3decrypt.html
我家孩子自己发明了个“反减法”，专门针对于两位数减一位数需要借位的情况（现在学到的难度）。比如：43-5，3减5不够减，就反过来减：5-3＝2，然后取被减数的十位40，减去之前“反减”的2，得到答案38。我试了试其它的两位数减一位数，靠，还真好用。这个什么鬼？也太hack了…
“从入门到XX”搞笑的封面随意做https://dev.to/rly
通过ab很容易理解并发/PV/QPS，ab -c并发数 -n请求数 c的值就是并发数，n请求数可以理解为pv，输出值里面的QPS(Query Per Second)每秒处理请求数，这个其实就是吞吐数了，我测试的时候并发数一般不会设置太大(200~500)，同时会加上-k避免连接出错。
上亿PV的系统, 平均QPS有多少呢? 很简单, 经验算法是除以8小时, 所以100000000/8/3600=3472, 如果你有10台机器, 每台机器340QPS, 但是你想啊, 我都上亿的系统了, 怎么得也不得有个上百台机器来显示我的"大"吧? 好吧, 这样的话, 平均每台QPS 34, 这你就算用上古语言也能轻松拿下吧
几百万并发是啥概念, 就微博春节零时的QPS峰值也不过数万.... 吹什么牛逼啊.
既然开始说技术选型，那么说一下为什么会对一些技术有喜好上的差异。
术业有专攻，数据库的实现，是一个极有挑战的工程问题，对于我们这种使用者来说，各种数据库产品，特别是关系型数据库，帮我们完成了软件项目中非常难的一些有普遍意义的工作。使很多软件项目成为了可能。但是并不表示使用数据库的时候不需要思考。各种数据库产品是有差异的，评估产品也需要分析自己面对的问题。
例如，SQL语言学习中一个经典的问题是，给一个员工信息表，找到每个部门工资最高的员工的所有详细信息，或者给出每个部门的员工详细信息，并按照kpi给出部门内排序并按顺序输出。按传统的SQL只能先构造分组统计，筛选出特征数据集，再做连接查询全部信息，但是postgresql或其它支持window function的产品，就可以一次给出结果。超大数据集中查询性能天差地别，书写形式上也是window function优越很多。
再例如经典的不定深度的树结构，按传统的SQL语法是不能简单查出来的，要么写递归的存储过程（这可能会爆函数栈），要么在应用层构造递归逻辑。但是现在postgresql、mssql、sqlite都支持递归cte，这就有力的简化了查询形式的复杂度。如果意识到这是一个递归问题，就很容易判别是否需要这样的功能，如果对各种数据库实现有了解，就能知道如何选择，或实现如何取舍或封装。
再例如一些网状数据模型，曾经我写过一个叫socrates的实验项目，企图以主题、关联和数据的定义构造一个足够通用的模型，但是实际上在应用层做这样的事效率极其低下，而且很难建立有效的约束，相对来说对于支持递归cte的数据库，完全可以用它在具体的模型上实现可递归的网络模型。socrates之所以不实用，就是因为太执着于兼顾几种平台，以及当时并没有递归查询的概念。
还有一个经典的争论是否需要一个orm工具？双方都有理由，我认为要不要orm既取决于产品也取决于是否有可选的数据库访问工具。例如jdbc就是个反面范例。好的数据库访问工具应该支持命名参数、和安全的sql调用，SQL表达式DSL，关系-模型的友好封装等等，这里且不关心会话等资源管理。我遇到一些同行认为要通过手写sql保证查询质量。然而好的orm应该足够我们做简单对象的curd，人工在这一层做也大多是重复劳动，意义不大。但是工具支持直接写“安全”的sql很重要，可以帮助我们在处理高难度的复杂查询和减少简单curd的工作量这个两难中做到兼顾。所以要不要orm？通常我认为是值得用orm的，只要有好的orm可以用。如果一定要排序，我认为数据库访问工具首先要允许用户安全的编写参数化的查询，仔就是要能有效提高工作效率，以及对各种数据库特定功能的支持，既然对SQL的支持够好，也就不是那么重要了——其实项目做大以后可能仍然是需要支持的。以写SQL的能力来说，我自信还是可以吹牛的。正因为如此我建议大家不必纠结绕过数据库访问工具自己写所有的sql，手写curd查询不会有效提高工程质量，还可能引入不必要的麻烦，例如当年12306被注入的事件。另一方面说好的数据库访问工具应该允许我们不失安全性的前提下手写各种sql，这对于处理复杂问题非常重要。
以上几个问题的共同点是，如果不了解问题和解决问题的工具，就不容易做出正确的选择。例如我们到底需要一个带统计分组的连接查询？还是一个展开详细信息的分组统计？有些问题，可能一开始就问错了。找到正确的问题，就会发现不同的工具真的可以给出不一样的解决方案。重要的是思想，想得清楚，用得上的那种才叫思想。看别人说好就跟风，落实到自己身上就永远是一个自增id带各种var char的不叫思想。当然没必要每个人都陷在技术问题里，岗位有分工，工程师下班也要有自己的生活。但是这并不是把行业整个拉低到自己熟悉的水平以避免思考的理由http://weibo.com/1729408273/FaolmbpQl
使用PyTorch深度学习：60分钟闪电教程。 ​​​​http://pytorch.org/tutorials/beginner/deep_learning_60min_blitz.html#deep-learning-with-pytorch-a-60-minute-blitz



```
[一个灵活、友好的爬虫框架](https://github.com/DarkSand/Sasila?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
[JavaScript项目一系列最佳实践。 ​​​​](https://github.com/wearehive/project-guidelines)
[推荐一个 Electron 应用，用于 Linxu 系统监控，几乎所有系统信息都包括了](https://github.com/yaronn/blessed-contrib)
http://t.cn/RZKNfhm 
[想在github上搭建一个【免费的】个人blog或者项目展示站点](http://damoqiongqiu.github.io/)
[微信开发之微信登录](https://segmentfault.com/p/1210000010009577/read#top)
[神注释大全](https://github.com/Blankj/awesome-comment)
[微信公号DIY：训练微信聊天机器人&公号变身图片上传工具](https://segmentfault.com/a/1190000010108718)



