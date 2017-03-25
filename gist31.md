如何向开源项目提交无法解答的问题 https://zhuanlan.zhihu.com/p/25795393 我为莆田系代言-把这款插件推广到五湖四海https://zhuanlan.zhihu.com/p/25963120  http://link.zhihu.com/?target=https%3A//chrome.google.com/webstore/detail/%25E8%258E%2586%25E7%2594%25B0%25E7%25B3%25BB%25E5%258C%25BB%25E9%2599%25A2%25E7%25BD%2591%25E7%25AB%2599%25E6%258F%2590%25E9%2586%2592/pihadmdiehanenijehoohjnpiaofmmng  http://link.zhihu.com/?target=http%3A//open-power-workgroup.github.io/Hospital/data/draft1/html/hospitals.html  
LAMP兄弟连视频下载地址：免费PHP视频教程下载-LAMP兄弟连PHP培训教程学习网；

传智播客视频下载地址：免费php视频教程下载；

后盾网视频下载地址：后盾网论坛-php培训-php教程；

自学it网下载地址：PHP视频教程 自学it网
[爬虫神器-selenium](https://zhuanlan.zhihu.com/p/25981552)
```js
from selenium import webdriver

from bs4 import BeautifulSoup

初始化浏览器

driver = webdriver.Firefox()

打开某个网址

driver.get(url)

如果网站需要输入登录账号密码

这里用到firepath找到目标位置的xpath

找到输入账号框，清除框内信息，再输入你的账号

driver.find_element_by_xpath(xpath).clear()

driver.find_element_by_xpath(xpath).send_keys("你的账号")

找到输入密码框，清除框内信息，再输入你的密码

driver.find_element_by_xpath(xpath).clear()

driver.find_element_by_xpath(xpath).send_keys("你的密码")

定位“点击登录”框的位置的xpath，执行登录

driver.find_element_by_xpath(xpath).click()

访问你想爬的网页的网址

driver.get(url)

获取该网页的源码

html = driver.page_source

BeautifulSoup定位标签  视频地址http://v.qq.com/vplus/bd8acb3d0418431a6f356522325b0902
bsObj = BeautifulSoup（html，‘html.parser’）
```
[Python爬虫—破解JS加密的Cookie](https://zhuanlan.zhihu.com/p/25957793)
```js
首次请求没有Cookie，服务端回返回一段生成Cookie并自动刷新的JS代码。浏览器拿到代码能够成功执行，带着新的Cookie再次请求获取数据。而Python拿到这段代码就只能停留在第一步。
作者：Jerry
链接：https://zhuanlan.zhihu.com/p/25957793
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

import re
import PyV8
import requests

TARGET_URL = "http://www.kuaidaili.com/proxylist/1/"

def getHtml(url, cookie=None):
    header = {
        "Host": "www.kuaidaili.com",
        'Connection': 'keep-alive',
        'Cache-Control': 'max-age=0',
        'Upgrade-Insecure-Requests': '1',
        'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36',
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding': 'gzip, deflate, sdch',
        'Accept-Language': 'zh-CN,zh;q=0.8',
    }
    html = requests.get(url=url, headers=header, timeout=30, cookies=cookie).content
    return html

def executeJS(js_func_string, arg):
    ctxt = PyV8.JSContext()
    ctxt.enter()
    func = ctxt.eval("({js})".format(js=js_func_string))
    return func(arg)

def parseCookie(string):
    string = string.replace("document.cookie='", "")
    clearance = string.split(';')[0]
    return {clearance.split('=')[0]: clearance.split('=')[1]}

# 第一次访问获取动态加密的JS
first_html = getHtml(TARGET_URL)

# first_html = """
# <html><body><script language="javascript"> window.onload=setTimeout("lu(158)", 200); function lu(OE) {var qo, mo="", no="", oo = [0x64,0xaa,0x98,0x3d,0x56,0x64,0x8b,0xb0,0x88,0xe1,0x0d,0xf4,0x99,0x31,0xd8,0xb6,0x5d,0x73,0x98,0xc3,0xc4,0x7a,0x1e,0x38,0x9d,0xe8,0x8d,0xe4,0x0a,0x2e,0x6c,0x45,0x69,0x41,0xe5,0xd0,0xe5,0x11,0x0b,0x35,0x7b,0xe4,0x09,0xb1,0x2b,0x6d,0x82,0x7c,0x25,0xdd,0x70,0x5a,0xc4,0xaa,0xd3,0x74,0x98,0x42,0x3c,0x60,0x2d,0x42,0x66,0xe0,0x0a,0x2e,0x96,0xbb,0xe2,0x1d,0x38,0xdc,0xb1,0xd6,0x0e,0x0d,0x76,0xae,0xc3,0xa9,0x3b,0x62,0x47,0x40,0x15,0x93,0xb7,0xee,0xc3,0x3e,0xfd,0xd3,0x0d,0xf6,0x61,0xdc,0xf1,0x2c,0x54,0x8c,0x90,0xfa,0x24,0x5b,0x83,0x0c,0x75,0xaf,0x18,0x01,0x7e,0x68,0xe0,0x0a,0x72,0x1e,0x88,0x33,0xa7,0xcc,0x31,0x9b,0xf3,0x1a,0xf2,0x9a,0xbf,0x58,0x83,0xe4,0x87,0xed,0x07,0x7e,0xe2,0x00,0xe9,0x92,0xc9,0xe8,0x59,0x7d,0x56,0x8d,0xb5,0xb2,0x6c,0xe0,0x49,0x73,0xfc,0xe7,0x20,0x49,0x34,0x09,0x71,0xeb,0x60,0xfd,0x8e,0xad,0x0f,0xb9,0x2e,0x77,0xdc,0x74,0x9b,0xbf,0x8f,0xa5,0x8d,0xb8,0xb0,0x06,0xac,0xc5,0xe9,0x10,0x12,0x77,0x9b,0xb1,0x19,0x4e,0x64,0x5c,0x00,0x98,0xc6,0xed,0x98,0x0d,0x65,0x11,0x35,0x9e,0xf4,0x30,0x93,0x4b,0x00,0xab,0x20,0x8f,0x29,0x4f,0x27,0x8c,0xc2,0x6a,0x04,0xfb,0x51,0xa3,0x4b,0xef,0x09,0x30,0x28,0x4d,0x25,0x8e,0x76,0x58,0xbf,0x57,0xfb,0x20,0x78,0xd1,0xf7,0x9f,0x77,0x0f,0x3a,0x9f,0x37,0xdb,0xd3,0xfc,0x14,0x39,0x11,0x3b,0x94,0x8c,0xad,0x8e,0x5c,0xd3,0x3b];qo = "qo=251; do{oo[qo]=(-oo[qo])&0xff; oo[qo]=(((oo[qo]>>4)|((oo[qo]<<4)&0xff))-0)&0xff;} while(--qo>=2);"; eval(qo);qo = 250; do { oo[qo] = (oo[qo] - oo[qo - 1]) & 0xff; } while (-- qo >= 3 );qo = 1; for (;;) { if (qo > 250) break; oo[qo] = ((((((oo[qo] + 200) & 0xff) + 121) & 0xff) << 6) & 0xff) | (((((oo[qo] + 200) & 0xff) + 121) & 0xff) >> 2); qo++;}po = ""; for (qo = 1; qo < oo.length - 1; qo++) if (qo % 5) po += String.fromCharCode(oo[qo] ^ OE);eval("qo=eval;qo(po);");} </script> </body></html>
# """

# 提取其中的JS加密函数
js_func = ''.join(re.findall(r'(function .*?)</script>', first_html))

print 'get js func:\n', js_func

# 提取其中执行JS函数的参数
js_arg = ''.join(re.findall(r'setTimeout\(\"\D+\((\d+)\)\"', first_html))

print 'get ja arg:\n', js_arg

# 修改JS函数，使其返回Cookie内容
js_func = js_func.replace('eval("qo=eval;qo(po);")', 'return po')

# 执行JS获取Cookie
cookie_str = executeJS(js_func, js_arg)

# 将Cookie转换为字典格式
cookie = parseCookie(cookie_str)

print cookie

# 带上Cookie再次访问url,获取正确数据
print getHtml(TARGET_URL, cookie)[0:500]


```
[想知道大家都用python写过哪些有趣的脚本?](https://www.zhihu.com/question/28661987/answer/152739366)
https://link.zhihu.com/?target=https%3A//github.com/lzjun567/crawler_html2pdf/blob/master/pdf/crawler.py
[23家互联网名企的300多篇精华笔经面经，免费领取](https://zhuanlan.zhihu.com/p/25863996)
[35岁HR告诉你，如何正确的写简历（附12款精美模板）](https://zhuanlan.zhihu.com/p/25953536)
[国内有没有适合青少年观看的性教育视频？](https://www.zhihu.com/question/47016153/answer/104716432)
[提问的智慧 - 中文版](https://link.zhihu.com/?target=http%3A//doc.zengrong.net/smart-questions/cn.html)
https://link.zhihu.com/?target=https%3A//ryancao.gitbooks.io/php-developer-prepares/content/assets/smart-questions-cn.jpg
https://link.zhihu.com/?target=http%3A//study.163.com/topics/sexuality-education/
[10分钟python图表绘制 | seaborn入门（四）：回归模型lmplot](https://zhuanlan.zhihu.com/p/25909753)
pip install seaborn 
```js

import seaborn as sns
sns.set_style("whitegrid")
tips = sns.load_dataset("tips") #载入自带数据集
#研究小费tips与总消费金额total_bill在吸烟与不吸烟人之间的关系

g = sns.lmplot(x="total_bill", y="tip", hue="smoker", data=tips,palette="Set1")

#继续研究pokemon数据集
import pandas as pd
import seaborn as sns
pokemon=pd.read_csv('H:/zhihu/Pokemon.csv')
pokemon.head()
```

[奇舞学院 推出的视频](https://link.zhihu.com/?target=http%3A//t.75team.com/video)
[知乎看片-指日可待 ： 如何优雅的“轮带逛”初级篇——获取单张图片](https://zhuanlan.zhihu.com/p/25936300)
[Python 程序如何高效地调试？](https://www.zhihu.com/question/21572891/answer/153088414)
```js
有两种不同的方法启动Python调试器，一种直接在命令行参数指定使用pdb模块启动Python文件，如下所示：

python -m pdb test_pdb.py 
另一种方法是在Python代码中，调用pdb模块的set_trace方法设置一个断点，当程序运行自此时，将会暂停执行并打开pdb调试器。

#/usr/bin/python
from __future__ import print_function
import pdb

def sum_nums(n):
    s=0
    for i in range(n):
        pdb.set_trace()
        s += i
        print(s)

if __name__ == '__main__':
    sum_nums(5)
```
[深度学习方面的学术交流平台？](https://link.zhihu.com/?target=https%3A//jizhi.im/community)
今天上线了新功能，社区帖子中也可以插入在线Python运行环境，这样在交流PY的时候，不仅可以show me the code，还可以run the code, see the output https://www.zhihu.com/question/54749093/answer/153175713  
[快来get新技能--抓包+cookie,爬微博不再是梦](https://mp.weixin.qq.com/s?__biz=MzI1MTE2ODg4MA==&mid=2650068076&idx=1&sn=9306af74c6fc6edc98906101c3d8c1ee&chksm=f1f76573c680ec652e4a3a313535e1e16c28b6b4484a9b35bc55e8bcb132f8194893d28170da&scene=21#wechat_redirect)
r  = requests.get(url,cookiess = Cookie)
[记忆转换工具](https://faded12.github.io/conversion/)
https://zhuanlan.zhihu.com/p/25865945 
[有哪些好看的婚礼请柬？](https://www.zhihu.com/question/22406901/answer/152969274)

[求职必胜，提升面试成功率靠谱攻略](https://zhuanlan.zhihu.com/p/25975370)
[新媒体运营工具盘点](https://zhuanlan.zhihu.com/p/25477198)

[用python实现简单的文本情感分析](https://mp.weixin.qq.com/s?__biz=MzI1MTE2ODg4MA==&mid=2650067952&idx=1&sn=4dc4b061db10b68f9154eadc4fe24e51&chksm=f1f762efc680ebf9ba3c92b731bbe56272a3513c0608d83bc4c2350f6f3abadd894bc2fc7ce6&scene=21#wechat_redirect)

[计算中文混合字符串长度（二）](http://blog.csdn.net/zhouzme/article/details/18909553)
```js
将字符串转换为 一个中文为 1，一个英文、数字 为 0.5 ，取最大整数长度值，类似腾讯微博计算字数长度方式
function asGbkLength($str, $fromEncode = 'utf-8')  
{  
    return ceil(strlen(mb_convert_encoding($str, 'gbk', $fromEncode))/2);  
}  
$str = 'abcd计算字符串长度12345';  
echo $str;  
echo '<br>';  
echo asGbkLength($str); // 12  
/** 
 * 计算字符串的字符长度，默认为 utf-8 编码, 一个中文算 3个字符长度, gbk 则是 2个字符长度 
 * @param string str 检测的字符串 
 * @param integer step 字符编码长度, utf-8 为3 , gbk 为 2 
 * @return integer 
 */  
function myStrlen(str, step) {   
    var len = str.length;   
    var reLen = 0;  
    step = step ? step : 3;  
    for (var i = 0; i < len; i++) {          
        if (str.charCodeAt(i) < 27 || str.charCodeAt(i) > 126) {   
            reLen += step; // 全角  
        } else {   
            reLen++;   
        }   
    }   
    return reLen;  
}  
function asGbkLength(str)  
{  
    return Math.ceil(myStrlen(str, 2)/2);  
}  
计算包含中文的混合字符串长度，一个中文、英文、数字 均为 1
function resolveContainCn($string, $charset = 'utf-8')  
{  
    if ($string == '') {  
        return '';  
    }  
           
    if ($charset == 'utf-8') {  
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";  
    }  
    else {  
        $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";  
    }  
    $matches = array();  
    preg_match_all($pa, $string, $matches);  
    return $matches[0];  
}  
function strlenCn($string, $charset = 'utf-8')  
{  
    if (function_exists('mb_strlen')) {  
        return mb_strlen($string, $charset);  
    }  
    return count(resolveContainCn($string, $charset));  
}  
$str = 'abcd计算字符串长度12345';  
echo $str;  
echo '<br>';  
echo strlenCn($str); // 16 
```
[PHP高效获取远程图片尺寸和大小](http://blog.csdn.net/zhouzme/article/details/18902113)
```js
function myGetImageSize($url, $type = 'curl', $isGetFilesize = false)   
{  
    // 若需要获取图片体积大小则默认使用 fread 方式  
    $type = $isGetFilesize ? 'fread' : $type;  
   
     if ($type == 'fread') {  
        // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法  
        $handle = fopen($url, 'rb');  
   
        if (! $handle) return false;  
   
        // 只取头部固定长度168字节数据  
        $dataBlock = fread($handle, 168);  
    }  
    else {  
        // 据说 CURL 能缓存DNS 效率比 socket 高  
        $ch = curl_init($url);  
        // 超时设置  
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
        // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值  
        curl_setopt($ch, CURLOPT_RANGE, '0-167');  
        // 跟踪301跳转  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        // 返回结果  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
   
        $dataBlock = curl_exec($ch);  
   
        curl_close($ch);  
   
        if (! $dataBlock) return false;  
    }  
   
    // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置  
    // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息   
    $size = getimagesize('data://image/jpeg;base64,'. base64_encode($dataBlock));  
    if (empty($size)) {  
        return false;  
    }  
   
    $result['width'] = $size[0];  
    $result['height'] = $size[1];  
   
    // 是否获取图片体积大小  
    if ($isGetFilesize) {  
        // 获取文件数据流信息  
        $meta = stream_get_meta_data($handle);  
        // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data   
        $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];  
   
        foreach ($dataInfo as $va) {  
            if ( preg_match('/length/iU', $va)) {  
                $ts = explode(':', $va);  
                $result['size'] = trim(array_pop($ts));  
                break;  
            }  
        }  
    }  
   
    if ($type == 'fread') fclose($handle);  
   
    return $result;  
}  
   
// 测试的图片链接  
echo '<pre>';  
$result = myGetImageSize('http://s6.mogujie.cn/b7/bao/120630/2kpa6_kqywusdel5bfqrlwgfjeg5sckzsew_345x483.jpg_225x999.jpg', 'curl');  
print_r($result); 
```
[MySQL字段自增自减的SQL语句](http://blog.csdn.net/zhouzme/article/details/18909469)
通常情况下是可以类似上面自增的方法 把 +号 改成 -号 就行了，但问题是如果当前 comments 统计数值为 0 时 再做减法将会变成该字段类型的最大数值 65535
update `info` set `comments` = IF(`comments`< 1,0,`comments`-1) WHERE `id` = 32  
update `info` set `comments` = IF(`comments`<1, 0, `comments`-1) WHERE `id` = 32  
[给 phper 出一道基本的面试题](https://www.v2ex.com/t/349774)
```js
echo '6+5' . 9+7; 13 实际 计算为 6+7 
和 “ 123abc ” +1 输出结果为 int 124 一个性质  // ‘ 6+59 ’+7=6+7=13
例子里的 ((int)'6+1') == intval('6+1') == 6 。从其他语言的叫都上来看完全属于设计不合理，因为会导致混乱。 

试想如果你想严格判断整数输入的话，只能在 intval 转换前再加上一些格式判断，否则甚至可能就会导致安全问题（比如 var_dump('0e1' == '0e2') => true ）。
class A{ 
public $bar = 1; 
public $c = 2; 
} 
$a = new A(); 
$bar = ['baz'=>'c']; 
echo $a->$bar['baz']; 

@moult 
js 嘛，坑多了去了 
比如这个 
if([]){alert(0);}; 
if([]==false){alert(1);}; 
if(![]==false){alert(2);};
1. 126 

php -r 'echo '6+5' . 9 + 7;' 

相当于 intval('11' . '9') + 7 


2. 13 

php -r "echo '6+5' . 9 + 7;" 

相当于 '6+59' + 7 = 6 + 7 ，运行会报警 Notice: A non well formed numeric value encountered ，说明有碰到这种非预期的数值转化，可能有 bug 。 


3. syntax error 

php -r "echo '6+5'.9 + 7;" 

报错 PHP Parse error: syntax error, unexpected '.9' (T_DNUMBER), expecting ',' or ';' in Command line code on line 1 
『.9 』 被当成符号了， echo 后面只支持 『,』和『;』


```
[ 将int，bigint整型数值可逆转换字符串](http://blog.csdn.net/zhouzme/article/details/51098101)
如： 9223372036854775807 => aZl8N0y58M7
```js
class Convert
{
    /**
     * 默认密钥字符串
     * @var string
     */
    const KEY = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * 将 Int 类型十进制数值转换为指定进制编码
     * @param int|string $num 取值范围 0 ~ 2147483647 之间
     * @return string
     */
    public static function encodeInt($num) {
        $str = '';
        if ($num <= 0)
            $str = substr(self::KEY, 0, 1);
        while ($num > 0) {
            $val = intval($num / 62);
            $mod = $num % 62;
            $str = substr(self::KEY, $mod, 1) . $str;
            $num = $val;
        }
        return $str;
    }

    /**
     * 将编码字符串转换为 Int 类整型数值
     * @param string $code
     * @return int
     */
    public static function decodeInt($code){
        $result = null;
        $len = strlen($code);
        for ($i = 1; $i <= $len; $i++) {
            $char = substr($code, $i - 1, 1);
            $result += intval(strpos(self::KEY, $char)) * pow(62, $len - $i);
        }
        return $result;
    }

    /**
     * 支持15位长度的整型，超过则精度大幅降低
     * @param int $num
     * @return string
     */
    public static function encodeInt2($num) {
        $out = '';
        for ($t = floor(log10($num)/log10(62)); $t >= 0; $t--) {
            $a = floor($num/bcpow(62, $t));
            $out = $out . substr(self::KEY, $a, 1);
            $num = $num - $a * pow(62, $t);
        }
        return $out;
    }

    /**
     * 支持最大15位整型字符串的解码
     * @param string $num
     * @return string
     */
    public static function decodeInt2($num) {
        $out = 0;
        $len = strlen($num) - 1;
        for ($t = 0; $t <= $len; $t++) {
            $out = $out + strpos(self::KEY, substr( $num, $t, 1 )) * pow(62, $len - $t);
        }
        return $out;
    }

    /**
     * 将 BigInt 类型的数值转换为指定进制值
     * @param int|string $num
     * @return string
     */
    public static function encodeBigInt($num) {
        bcscale(0);
        $str = '';
        if ($num <= 0)
            $str = substr(self::KEY, 0, 1);
        while ($num > 0) {
            $div = bcdiv($num, 62);
            $mod = bcmod($num, 62);
            $str = substr(self::KEY, $mod, 1) . $str;
            $num = $div;
        }
        return $str;
    }

    /**
     * 将编码字符串转换为 BigInt 类整型数值
     * @param string $code
     * @return string
     */
    public static function decodeBigInt($code) {
        bcscale(0);
        $result = '';
        $len = strlen($code);
        for ($i = 1; $i <= $len; $i++) {
            $char = substr($code, $i - 1, 1);
            $result = bcadd(bcmul(strpos(self::KEY, $char), bcpow(62, $len - $i)), $result);
        }
        return $result;
    }
}
```

[PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js

$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve($list) {
    $newList = $manages = $deeps = $inDeeps = array();
    foreach ($list as $row) {
        $newList[$row['id']] = $row;
    }
    $list = null;
    foreach ($newList as $row) {
        if (! isset($manages[$row['pid']]) || ! isset($manages[$row['pid']]['children'][$row['id']])) {
            if ($row['pid'] > 0 && ! isset($manages[$row['pid']]['children'])) $manages[$row['pid']] = $newList[$row['pid']];
            $manages[$row['pid']]['children'][$row['id']] = $row;
        }
        if (! isset($inDeeps[$row['deep']]) || ! in_array($row['id'], $inDeeps[$row['deep']])) {
            $inDeeps[$row['deep']][] = array($row['pid'], $row['id']);
        }
    }
    krsort($inDeeps);
    array_shift($inDeeps);
    foreach ($inDeeps as $deep => $ids) {
        foreach ($ids as $m) {
            // 存在子栏目的进行转移
            if (isset($manages[$m[1]])) {
                $manages[$m[0]]['children'][$m[1]] = $manages[$m[1]];
                $manages[$m[1]] = null;
                unset($manages[$m[1]]);
            }
        }
    }
    return $manages[0]['children'];
}
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
Array
(
    [1] => Array
        (
            [id] => 1
            [pid] => 0
            [deep] => 0
            [name] => test1
            [children] => Array
                (
                    [2] => Array
                        (
                            [id] => 2
                            [pid] => 1
                            [deep] => 1
                            [name] => test2
                            [children] => Array
                                (
                                    [4] => Array
                                        (
                                            [id] => 4
                                            [pid] => 2
                                            [deep] => 2
                                            [name] => test4
                                        )

                                    [5] => Array
```
[PHP5.6通过CURL上传图片@符无效的兼容问题](http://blog.csdn.net/zhouzme/article/details/51050980)
```js
CURL 的一个配置参数 CURLOPT_SAFE_UPLOAD 
CURLOPT_SAFE_UPLOAD 在 PHP5.5中默认值是 false 
而在 PHP5.6中已经默认为 true 了。 
所以只需要增加一行强制设置为 false 就行，如下： 
注意：该参数的设置顺序，必须在设置 CURLOPT_POSTFIELDS 参数之前才有效哦
$url = 'http://127.0.0.1/test3.php';
$file = __DIR__ .'/0634134726bc5b8b.jpg';
$data = array('mypic'=>new CURLFile($file));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$content = curl_exec($curl);
curl_close($curl);
print_r($content);
```
[PhpMyAdmin+Opcache出现无响应，500错误](http://blog.csdn.net/zhouzme/article/details/54345932)

设置 opcache 黑名单打开 php.ini 
搜索 blacklist_filename，设置为你的文件绝对路径就可以了，若没有则添加一条
[opcache]
opcache.blacklist_filename="C:/ProgramFiles(x86)/php_opcache_blacklist"
[ Windows RunHiddenConsole 后台运行 nginx，php，redis](http://blog.csdn.net/zhouzme/article/details/53613594)
start-redis.bat
C:\RunHiddenConsole\RunHiddenConsole redis-server.exe redis-union.conf --loglevel verbose 
[ PHP5.5在windows 安装使用 memcached 服务端的方法以及 php_memcache.dll 下载](http://blog.csdn.net/zhouzme/article/details/22231931)
[ phpDocumentor2安装配置和使用](http://blog.csdn.net/zhouzme/article/details/25816753)
[PHP截取含中文的混合字符串长度的函数](http://blog.csdn.net/zhouzme/article/details/18909537)
```js
/** 
 * 截取中文混合字符串指定长度 
 *  
 * @param string $string 
 * @param integer $length 
 * @param string $etc 超过长度时的省略符 
 * @param string $charset 字符编码 utf-8 或者 gbk 
 * @return string 
 */  
public function truncateCn($string, $length = 80, $etc = '...', $charset = 'utf-8')  
{  
    if ($length == 0) {  
        return '';  
    }  
         
    if (function_exists('mb_substr')) {  
        $etc = mb_strlen($string, $charset) > $length ? $etc : '';  
        return mb_substr($string, 0, $length, $charset) . $etc;  
    }  
         
    if ($charset == 'utf-8') {  
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";  
    }  
    else {  
        $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";  
    }  
    preg_match_all($pa, $string, $t_string);  
    if (count($t_string[0]) > $length) {  
        return join('', array_slice($t_string[0], 0, $length)) . $etc;  
    }  
         
    return join('', array_slice($t_string[0], 0, $length));  
}  
```
[PHP全角半角转换函数](http://blog.csdn.net/zhouzme/article/details/18909523)
```js
/** 
  * 全角字符转换为半角 
  *  
  * @param string $str 
  * @return string 
  */  
 public function Sbc2Dbc($str)  
 {  
     $arr = array(  
             '０'=>'0', '１'=>'1', '２'=>'2', '３'=>'3', '４'=>'4','５'=>'5', '６'=>'6', '７'=>'7', '８'=>'8', '９'=>'9',   
             'Ａ'=>'A', 'Ｂ'=>'B', 'Ｃ'=>'C', 'Ｄ'=>'D', 'Ｅ'=>'E','Ｆ'=>'F', 'Ｇ'=>'G', 'Ｈ'=>'H', 'Ｉ'=>'I', 'Ｊ'=>'J',   
             'Ｋ'=>'K', 'Ｌ'=>'L', 'Ｍ'=>'M', 'Ｎ'=>'N', 'Ｏ'=>'O','Ｐ'=>'P', 'Ｑ'=>'Q', 'Ｒ'=>'R', 'Ｓ'=>'S', 'Ｔ'=>'T',   
             'Ｕ'=>'U', 'Ｖ'=>'V', 'Ｗ'=>'W', 'Ｘ'=>'X', 'Ｙ'=>'Y','Ｚ'=>'Z', 'ａ'=>'a', 'ｂ'=>'b', 'ｃ'=>'c', 'ｄ'=>'d',   
             'ｅ'=>'e', 'ｆ'=>'f', 'ｇ'=>'g', 'ｈ'=>'h', 'ｉ'=>'i','ｊ'=>'j', 'ｋ'=>'k', 'ｌ'=>'l', 'ｍ'=>'m', 'ｎ'=>'n',   
             'ｏ'=>'o', 'ｐ'=>'p', 'ｑ'=>'q', 'ｒ'=>'r', 'ｓ'=>'s', 'ｔ'=>'t', 'ｕ'=>'u', 'ｖ'=>'v', 'ｗ'=>'w', 'ｘ'=>'x',   
             'ｙ'=>'y', 'ｚ'=>'z',  
             '（'=>'(', '）'=>')', '〔'=>'(', '〕'=>')', '【'=>'[','】'=>']', '〖'=>'[', '〗'=>']', '“'=>'"', '”'=>'"',   
             '‘'=>'\'', '’'=>'\'', '｛'=>'{', '｝'=>'}', '《'=>'<','》'=>'>','％'=>'%', '＋'=>'+', '—'=>'-', '－'=>'-',   
             '～'=>'~','：'=>':', '。'=>'.', '、'=>',', '，'=>',', '、'=>',',  '；'=>';', '？'=>'?', '！'=>'!', '…'=>'-',   
             '‖'=>'|', '”'=>'"', '’'=>'`', '‘'=>'`', '｜'=>'|', '〃'=>'"','　'=>' ', '×'=>'*', '￣'=>'~', '．'=>'.', '＊'=>'*',  
             '＆'=>'&','＜'=>'<', '＞'=>'>', '＄'=>'$', '＠'=>'@', '＾'=>'^', '＿'=>'_', '＂'=>'"', '￥'=>'$', '＝'=>'=',  
             '＼'=>'\\', '／'=>'/'  
         );  
     return strtr($str, $arr);  
 }  
```
[PHP 获取指定日期对应的星座名称](http://blog.csdn.net/zhouzme/article/details/18909505)
```js
public function getConstellation($month, $day)  
    {  
        $day   = intval($day);  
        $month = intval($month);  
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;  
        $signs = array(  
                array('20'=>'宝瓶座'),  
                array('19'=>'双鱼座'),  
                array('21'=>'白羊座'),  
                array('20'=>'金牛座'),  
                array('21'=>'双子座'),  
                array('22'=>'巨蟹座'),  
                array('23'=>'狮子座'),  
                array('23'=>'处女座'),  
                array('23'=>'天秤座'),  
                array('24'=>'天蝎座'),  
                array('22'=>'射手座'),  
                array('22'=>'摩羯座')  
        );  
        list($start, $name) = each($signs[$month-1]);  
        if ($day < $start)  
            list($start, $name) = each($signs[($month-2 < 0) ? 11 : $month-2]);  
        return $name;  
    }  
```
[ mysql连接失败或出现“Too many connections”错误](http://blog.csdn.net/zhouzme/article/details/20015887)
修改为：max_connections = 1000


默认值：100

最大值：16384

即该参数最大值不能超过16384，即使超过也以16384为准
[PHP的ip2long和long2ip函数的实现原理](http://blog.csdn.net/zhouzme/article/details/35285831)
```js
$ip = '12.34.56.78';  
$ips = explode('.', $ip);  
$result = 0;  
$result += $ips[0]<<24;  
$result += $ips[1]<<16;  
$result += $ips[2]<<8;  
$result += $ips[3];  
echo bindec(decbin($result));  
echo '<br>';  
echo bindec(decbin(ip2long($ip)));  
echo '<br>';  
  
$str = '';  
$str .= intval($result/intval(pow(2, 24))) .'.';  
$str .= intval(($result&0x00FFFFFF)/intval(pow(2, 16))) .'.';  
$str .= intval(($result&0x0000FFFF)/intval(pow(2, 8))) .'.';  
$str .= intval($result&0x000000FF);  
  
echo $str;  
echo '<br>';  
echo long2ip($result); 
```
[Redis 数据序列化方法 serialize, msgpack, json, hprose 比较](http://blog.csdn.net/zhouzme/article/details/46863709)
```js
 Msgpack 都是非常牛逼的，只不过需要自己单独安装 Msgpack 的扩展，不过安装也很简单的。

服务器上可以直接 pecl install msgpack 
如果不行的话，就手动下载 tgz 包: 
在这里下载最新版本 https://pecl.php.net/package/msgpack 
然后 pecl install msgpack-0.5.6.tgz 即可


```
