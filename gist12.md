###[Python里对list用sort和sorted排序的一个问题](https://www.zhihu.com/question/55371008)
```js
A=[2,1,3,4,2,2,3]

A.sort(key=lambda x:A.count(x))
print A 
[2,1,3,4,2,2,3]

B=sorted(A,key=lambda x:A.count(x))
print B
[1, 4, 3, 3, 2, 2, 2]
```
###[Python编写多线程爬虫抓取百度贴吧邮箱与手机号](https://zhuanlan.zhihu.com/p/25039408)
```js
 github.com/cw1997/get-email-by-tieba/blob/master/get-email-by-tieba-multithreading.py 
```
###[Pandas学习笔记](https://zhuanlan.zhihu.com/p/25013519)
```js
s = pd.Series({‘a’=1,’b’=2,’d’=3},index = [‘a’,’d’,’c’,b’])
输出：a  1	
      d  3
      c  NaN
      b  2
      dtype：int64
```
###[微信拜年群发](https://zhuanlan.zhihu.com/p/25034403)
```js
#扫不到二维码的在enableCmdQR的值改成2就好了，我原来都扫不到，看了文档改了一下就好了
import itchat, time, re
from itchat.content import *

@itchat.msg_register([TEXT])
def text_reply(msg):
    match = re.search('年', msg['Text']).span()
    if match:
      itchat.send(('那我就祝你鸡年大吉吧'), msg['FromUserName'])

@itchat.msg_register([PICTURE, RECORDING, VIDEO, SHARING])
def other_reply(msg):
    itchat.send(('那我就祝你鸡年大吉吧'), msg['FromUserName'])

itchat.auto_login(enableCmdQR=True,hotReload=True)
itchat.run()
```
###[** 有时不等于 Math.pow](https://zhuanlan.zhihu.com/p/25067384)
```js
console.log(99**99);
a = 99, b = 99;
console.log(a**b);
console.log(Math.pow(99, 99));
分别输出：

3.697296376497268e+197 
3.697296376497263e+197 
3.697296376497263e+197
function diff(x) {
  return Math.pow(x,x) - x**x;
}
调用 diff(99) 返回 0 Math.pow(99,99) - 99**99 的结果也不是 0 而是 -5.311379928167671e+182
```
###[神奇的数字2017](https://www.zhihu.com/question/51033691)
```js
2017=10+9+8+7+6+5+4+3+2+1
+987+654+321。

不仅，2017=12^3+4*56+7*8+9。
而且，2017+29=2^1+2^2+2^3+2^4+2^5+2^6+2^7
+2^8+2^9+2^10。
142857×1=142857
142857×2=285714
142857×3=428571
142857×4=571428
142857×5=714285
142857×6=857142

076923×1=076923
076923×3=230769
076923×4=307692
076923×9=692307
076923×10=769230
076923×12=923076

076923×2=153846
076923×5=384615
076923×6=461538
076923×7=538461
076923×8=615384
076923×11=846153

12345679×1=12345679
12345679×2=24691358
12345679×4=49382716
12345679×5=61728395
12345679×7=86419753
12345679×8=98765432

12345679随便乘以一个80以内的不是3的倍数的正整数所得的数字，每位数字都不重复，并且缺一个数，那一个数就是9减去这个数字除以九的余数。
比如12345679×79=975308641
79除以九余七，缺二。
12345679×65=802469135
65除以九余二，缺七。

123456789×2=246913578
123456789×4=493827156
123456789×5=617283945
123456789×7=864197523
123456789×8=987654312(逼死强迫症)
123456789乘以一个80以内的不是3的倍数的两位数所得的数字，恰好遍布0到9的10个数字，比如123456789×34=4197530826
```
###[爬虫之微博抢红包](https://zhuanlan.zhihu.com/p/25037705)
```js
作者：爬虫
链接：https://zhuanlan.zhihu.com/p/25037705
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

# -*- coding: utf-8 -*-
import requests
import js2xml
from lxml import etree
headers ={
    #这边cookie替换成你的cookie
    'Cookie':'',
    'User-Agent':'Mozilla/5.0 (Linux; Android 4.0.4; Galaxy Nexus Build/IMM76B) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.133 Mobile Safari/535.19',
}
#获取红包列表
def getuid():
    url = 'http://chunjie.hongbao.weibo.com/hongbao2017/h5index'
    # 带上request headers
    z = requests.get(url,headers=headers)
    if z.status_code == 200:
        # 这边是查找所有的ouid
        alluid = etree.HTML(z.content).xpath('//div[@class="m-auto-box"]/@action-data')
        return alluid

#获取st的值
def getst(url):
    #带上request headers
    z = requests.get(url,headers=headers)
    # 获取第一段JavaScript,并去掉 <!--拆包页-->，防止中文报错
    jscode = etree.HTML(z.content).xpath("//script[contains(., 'weibo')]/text()")[0].replace(u'<!--拆包页-->','')
    #使用js2xml 把JavaScript代码替换成xml
    parsed_js  = js2xml.parse(jscode)
    #打印下 xml
    # print js2xml.pretty_print(parsed_js)
    #打印的值如下
    """
    <program>
      <var name="$config">
        <object>
          <property name="weibo">
            <number value="0"/>
          </property>
          <property name="wechat">
            <number value="0"/>
          </property>
          <property name="alipay">
            <number value="0"/>
          </property>
          <property name="isLogin">
            <number value="1"/>
          </property>
          <property name="isPad">
            <number value="0"/>
          </property>
          <property name="isPass">
            <number value="0"/>
          </property>
          <property name="st">
            <string>dfd6e4</string>
          </property>
          <property name="ext">
            <string>pay=1&amp;unionPay=1</string>
          </property>
          <property name="loginUrl">
            <string></string>
          </property>
          <property name="cuid">
            <number value="3485500247"/>
          </property>
          <property name="detail">
            <string></string>
          </property>
        </object>
      </var>
      <if>
        <predicate>
          <dotaccessor>
            <object>
              <identifier name="$config"/>
            </object>
            <property>
              <identifier name="wechat"/>
            </property>
          </dotaccessor>
        </predicate>
        <then>
          <block>
            <var name="WB_mishu">
              <string>http://mp.weixin.qq.com/s?__biz=MjM5NDA2NDY4MA==&amp;mid=201898100&amp;idx=4&amp;sn=aceda5551311992d46fa039f54ed9477#rd</string>
            </var>
            <var name="show_WB_mishu">
              <number value="0"/>
            </var>
            <var name="show_WX_guide">
              <number value="0"/>
            </var>
          </block>
        </then>
      </if>
      <if>
        <predicate>
          <dotaccessor>
            <object>
              <identifier name="$config"/>
            </object>
            <property>
              <identifier name="weibo"/>
            </property>
          </dotaccessor>
        </predicate>
        <then>
          <block>
            <var name="$WB_version">
              <string></string>
            </var>
          </block>
        </then>
      </if>
      <var name="minVersion">
        <object>
          <property name="minClientVerNum">
            <string>600</string>
          </property>
          <property name="minClientV">
            <string>6.0.0</string>
          </property>
        </object>
      </var>
      <var name="scheme_protocol">
        <string>sinaweibo://</string>
      </var>
      <if>
        <predicate>
          <binaryoperation operation="==">
            <left>
              <dotaccessor>
                <object>
                  <identifier name="minVersion"/>
                </object>
                <property>
                  <identifier name="minClientVerNum"/>
                </property>
              </dotaccessor>
            </left>
            <right>
              <string>510</string>
            </right>
          </binaryoperation>
        </predicate>
        <then>
          <block>
            <assign operator="=">
              <left>
                <identifier name="scheme_protocol"/>
              </left>
              <right>
                <string>sinaweibo510://</string>
              </right>
            </assign>
          </block>
        </then>
      </if>
    </program>
    """
    #从上面可以看到st在哪，然后用xpath写出来
    st = parsed_js.xpath('//property[@name="st"]/string/text()')[0]
    return st
# 抢红包
def tj(url,uid,st,tjheaders):
    #生成需要发送的data
    data = {
        'groupid':'1000110',
        'uid':uid,
        'share':'1',
        'st':st
    }
    # 这里使用了post,headers增加了Referer
    z = requests.post(url,data=data,headers=tjheaders)
    #把得到的结果以json形式展示
    _ = z.json()
    #如果json中有“ok”,表示提交成功了，否则返回报错信息
    if _.has_key('ok'):
        print _['data']['error_msg']
    else:
        print _['errMsg']
if __name__ == '__main__':
    # 得到所有的uid
    uids = getuid()
    for uid in uids:
        #生成红包页面的url
        url = 'http://hongbao.weibo.com/h5/aboutyou?groupid=1000110&ouid=%s' %uid
        #获取st
        st = getst(url)
        #生成点击“抢红包”页面的url
        tjurl = 'http://hongbao.weibo.com/aj_h5/lottery?uid=%s&groupid=1000110&wm=' %uid
        # 添加Referer，如果不添加会报错
        headers['Referer'] = url
        tjheaders = headers
        try:
            # 点击“抢红包”
            tj(tjurl,uid,st,tjheaders)
        except:
            pass
```
###[八大排序算法python实现](https://zhuanlan.zhihu.com/p/25074334)
```js
# -*- coding:utf-8 -*-
def bubble_sort(list):
    length=len(list)
    for index in range(length):
        for i in range(1,length-index):
            if list[i-1]<list[i]:
                list[i],list[i-1]=list[i-1],list[i]
    return list
#一下为测试其正确性：
list=[10,23,1,53,654,54,16,646,65,3155,546,31]
print bubble_sort(list)

```
###[获取某个页面中的input的csrf_token](https://segmentfault.com/q/1010000008256515)
```js
"symfony/css-selector": "3.1.*",
"symfony/dom-crawler": "3.1.*",
"guzzlehttp/guzzle": "6.2.*"
$body = (new \GuzzleHttp\Client)->get('http://bosonnlp.com/account/login')->getBody()->getContents();
$csrf = (new \Symfony\Component\DomCrawler\Crawler($body))->filter('#csrf_token')->attr('value');
var_dump($csrf);
$res = (new \GuzzleHttp\Client)->post('http://bosonnlp.com/account/login', ['connect_timeout' => 10,
    'form_params' => [
        'csrf_token' => $csrf,
        'email' => 'xxx',
        'password' => 'xxx',
    ],
]);
// 登陆后拿到的html
$body = $res->getBody()->getContents();
$dom = new \Symfony\Component\DomCrawler\Crawler($body);

// 检查是否登录失败并抛出异常
if ($err_str = $dom->filter('.email-warn')->text()){
    throw new \Exception($err_str);
}
csrfToken是和session相关的，如果你获取csrf和登录post用的不是一个sessionid的话，csrf是无效的。所以，获取csrf和post登录请共用这一个client以共享同一个cookie $client = new Client(['cookies'=>true]);
```
###[convert_utf8](https://segmentfault.com/q/1010000008255392)
```js
function convert_utf8($data){
  if( !empty($data) ){
    $fileType = mb_detect_encoding($data , mb_list_encodings(), true);
    if( strtolower($fileType) != 'utf-8'){
      $data = mb_convert_encoding($data ,'utf-8' , $fileType);  
    }
  }
  return $data;
}

$text = file_get_contents($filename);
$text = convert_utf8($text);
```
###[php7的fpm]()
```js
路径参考/etc/php/7.0/fpm
路径参考 /etc/init.d/php7.0-fpm status|start|stop
如果不需要fpm，根据你需要请求的协议 ，可以使用swoole，workman之类的框架，无需fpm，只需要指定到指定的监听端口。
```
###[1-2+3-4+5 ... 99的所有数的和](https://segmentfault.com/q/1010000008235645)
```js
>>> num = 0
>>> for i in range(100):
...     if i % 2 == 0:
...         num = num - i
...     else:
...         num = num + i
...
>>> num
50
def compute(n):
    if n % 2 is 1:
        return int(((n - 1) / 2) * (-1) + n)
    else:
        return int((n / 2) * (-1))
        >>> rslt=0
>>> for n in range(1,100):
    rslt += n*(-1,1)[n&1]

    
>>> rslt
50
>>> sum(( n*(-1,1)[n&1] for n in range(1,100) ))
50
>>> sum((sum(range(1, 100)[::2]), -sum(range(1, 100)[1::2])))
>>> 50
>>> # functools和itertools是你最强大的利器。
```
###[laravel/eloquent 的python 版本](https://segmentfault.com/q/1010000007964817)
```js
https://github.com/sdispater/orator
users = User.where('votes', '>', 100).take(10).get()

for user in users:

    print(user.name)
count = User.where('votes', '>', 100).count()
```
###[中文首字母](https://segmentfault.com/q/1010000008248979)
```js
function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }

        $fchar = ord($str{0});

        if ($fchar >= ord('A') && $fchar <= ord('z'))
            return strtoupper($str{0});

        $s1 = iconv('UTF-8', 'gb2312', $str);

        $s2 = iconv('gb2312', 'UTF-8', $s1);

        $s = $s2 == $str ? $s1 : $str;

        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;

        if ($asc >= -20319 && $asc <= -20284)
            return 'A';

        if ($asc >= -20283 && $asc <= -19776)
            return 'B';

        if ($asc >= -19775 && $asc <= -19219)
            return 'C';

        if ($asc >= -19218 && $asc <= -18711)
            return 'D';

        if ($asc >= -18710 && $asc <= -18527)
            return 'E';

        if ($asc >= -18526 && $asc <= -18240)
            return 'F';

        if ($asc >= -18239 && $asc <= -17923)
            return 'G';

        if ($asc >= -17922 && $asc <= -17418)
            return 'H';

        if ($asc >= -17417 && $asc <= -16475)
            return 'J';

        if ($asc >= -16474 && $asc <= -16213)
            return 'K';

        if ($asc >= -16212 && $asc <= -15641)
            return 'L';

        if ($asc >= -15640 && $asc <= -15166)
            return 'M';

        if ($asc >= -15165 && $asc <= -14923)
            return 'N';

        if ($asc >= -14922 && $asc <= -14915)
            return 'O';

        if ($asc >= -14914 && $asc <= -14631)
            return 'P';

        if ($asc >= -14630 && $asc <= -14150)
            return 'Q';

        if ($asc >= -14149 && $asc <= -14091)
            return 'R';

        if ($asc >= -14090 && $asc <= -13319)
            return 'S';

        if ($asc >= -13318 && $asc <= -12839)
            return 'T';

        if ($asc >= -12838 && $asc <= -12557)
            return 'W';

        if ($asc >= -12556 && $asc <= -11848)
            return 'X';

        if ($asc >= -11847 && $asc <= -11056)
            return 'Y';

        if ($asc >= -11055 && $asc <= -10247)
            return 'Z';

        return null;

    }
```
###[then返回的是一个新的promise对象](https://segmentfault.com/q/1010000008249358)
```js
var promise1 = new Promise(function(resolve, reject) {
  resolve(1);
});
var promise2 = new Promise(function(resolve, reject) {
  reject(3);
});
promise1.then(function(val) {
  console.log(val); // 1
  return promise2;
}).then(function(val) {
  console.log('成功' + val); 
},function(val){
  console.log('失败' + val) // 失败3
});
```
###[Python 随机产生中文字符](https://segmentfault.com/q/1010000008241060)
```js
import random
a = '你们好'
lists = list(a)
print(lists)
# 随机取出2个
res = random.sample(lists,2)
print(res)
```
###[unicode转中文](https://segmentfault.com/q/1010000008185071)
```js
decodeURIComponent('\u6211\u662F')

function unicode2ch($str)
{
    if (!$str) {
        return false;
    }
    if($decode=json_decode($str)){
        return $decode;
    }
    $str = '['.$str.']';
    $decode = json_decode($str);
    if(count($decode)===1){
        return $decode[0];
    }
    return false;
}

$st = '中';
$en = json_encode($st);
echo unicode2ch($en);
```
###[箭头函数里的this是定义时所在的作用域，而不是运行时所在的作用域](https://segmentfault.com/q/1010000008247977)
```js
var obj2 = {
    id: 2333,
    test: () => console.log(this)
}
var obj2 = {};
obj2.id = 2333;
var _this = this;
obj2.test = function(){console.log(_this);}
function OBJ(){
    this.id = 2333;
    this.test = () => console.log(this);
}
var obj2 = new OBJ();
function OBJ(){
    this.id = 2333;
    var _this = this;
    this.test = function(){console.log(_this);}
}
var obj2 = new OBJ();
```
###[计算页面刷新次数](https://segmentfault.com/q/1010000008226123)
```js
function count() {
    // 当前浏览器是否支持localStorage
    if(window.localStorage) {
        // 是否已经有记录了，如果有进入操作
        if(window.localStorage.getItem("count")) {
            //拿出key对应的value， 因为存储进去的是字符串。
            var c = parseInt(window.localStorage.getItem("count"));
            // 设置key，value加1
            window.localStorage.setItem("count",c+1);
            console.log(parseInt(window.localStorage.getItem("count")));
        }else {
            //如果没有检查到key, 那肯定没设置，那就让他默认为0
            window.localStorage.setItem("count",0);
            console.log(0);
        }
    }
}
count();
```
###[ {'k1': 大于66的所有值, 'k2': 小于66的所有值}](https://segmentfault.com/q/1010000008235827)
```js
nums = [11,22,33,44,55,66,77,88,99,90]

d = {'k1': [x for x in nums if x > 66], 'k2': [x for x in nums if x ＜ 66]}
```
###[firstOrCreate方法判断返回的模型是新增的还是原有的，](https://segmentfault.com/q/1010000008234906)
```js
$user = User::firstOrCreate($userData);
if($user->wasRecentlyCreated){
    // 新用户处理
    
}
```
###[删除数组中的空格或字符串](https://segmentfault.com/q/1010000008230865)
```js
foreach ($table_rows as $row => $tr) {
        foreach ($tr->childNodes as $td) {
            $data[$row][] = preg_replace("/[^a-zA-Z0-9]/", "", $td->nodeValue);
        }
    }
```
###[segmentfault可以被站点镜像](https://segmentfault.com/q/1010000008231284)
wget -c -w 2 -m https://segmentfault.com/ 
###[字符串中的所有字符变成它ASCII码中前7位的数字](https://segmentfault.com/q/1010000008229265)
```js
>>> s='hijkl'
>>> bytes(map(lambda c:c-7,bytes(s,'ascii'))).decode('ascii')
'abcde'
```
###[正则表达式中'/'](https://segmentfault.com/q/1010000008224056)
分隔符已经用了/,所以表达式里要使用/时就需要用反斜杠\转义.

你写成调用RegExp的话就可以不用分隔符了:

var routeStripper = new RegExp("^[#/]\s+$", "g");
###[输入某年某月某日，全年的第几天](https://segmentfault.com/q/1010000008217387)
var endDate = new Date(y, m-1, d),
    startDate = new Date(y, 0, 0),
    days = (endDate - startDate) / 1000 / 60 / 60 / 24;

document.write("该天为一年中的第"+ days +"天");
###[运算符号使下面等式成立](https://segmentfault.com/q/1010000008213102)
let a = [2,2,2,2,2,2,2,2,2,2];
a[1]  +  a[1]  +  a[1]  = 6
2 +  2  + 2    = 6
a[3]  +  a[3]  +  a[3]  = 6
a[4]  +  a[4]  +  a[4]  = 6
a[5]  +  a[5]  +  a[5]  = 6
a[6]  +  a[6]  +  a[6]  = 6
a[7]  +  a[7]  +  a[7]  = 6
a[8]  +  a[8]  +  a[8]  = 6
a[9]  +  a[9]  +  a[9]  = 6
( 1  +   1   +   1 )!          = 6
  2  +   2   +   2             = 6
  3  *   3   -   3             = 6
  4  +   4   -   sqrt(4)       = 6
  5  +   5   /   5             = 6
  6  *   6   /   6             = 6
  7  -   7   /   7             = 6
  8  -   sqrt( sqrt( 8 + 8 ))  = 6
  9  -   9   /   sqrt(9)       = 6
###[Python 表达式 i += x 与 i = i + x 等价吗](https://www.v2ex.com/t/338218)
```js
>>> l1 = range(3)
>>> l2 = l1
>>> l2 += [3]
>>> l1
[0, 1, 2, 3]
>>> l2
[0, 1, 2, 3]
代码 2

>>> l1 = range(3)
>>> l2 = l1
>>> l2 = l2 + [3]
>>> l1
[0, 1, 2]
>>> l2
[0, 1, 2, 3]
```
###[php7.1 里， mcrypt_encrypt()用openssl_encrypt()函数代替](https://www.v2ex.com/t/338027#reply6)
```js
mcrypt_decrypt(MCRYPT_BLOWFISH, $passphrase, base64_decode($data), MCRYPT_MODE_CBC, $iv); 
openssl_decrypt($data, "BF-CBC", $passphrase, 0, $iv); 

base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $passphrase, $data, MCRYPT_MODE_CBC, $iv)); 
openssl_encrypt($data, "BF-CBC", $passphrase, null, $iv);
``` 
###[cli下pdo不可用](https://segmentfault.com/q/1010000008258119)
```js
系统中装有两套以上的php环境，浏览器访问用和cli不是同一套，可以检查一下web服务用的php的完整路径，然后使用这个路径下的php执行cli模式，比如/usr/local/php/bin/php xx.php
```
###[显示存在storage目录中的图片文件](https://segmentfault.com/q/1010000008258288)
```js
// 控制器
// https://github.com/shellus/shcms/blob/v2.0.0/app/Http/Controllers/FileController.php

class FileController extends Controller
{
    public function show($id){
        return File::findOrFail($id) -> downResponse();
    }
}

// Model
https://github.com/shellus/shcms/blob/v2.0.0/app/File.php

public function downResponse(){
    return new BinaryFileResponse($this -> downToLocal());
}
public function downToLocal(){
    $temp_path = tempnam(sys_get_temp_dir(), $this->id);
    $is_success = file_put_contents($temp_path, \Storage::disk('public')->get($this -> full_path));
    return $temp_path;
}
    
```
###[base64加密](https://segmentfault.com/q/1010000004355638)
```js
从结果来看应该就是 Base64。（区分大小写，字母数量大于数字的数量还有 = ）。应该就是某种方法加密之后，再用Base64编码的。前一段Base64解码出来是 aHR19\x06 \x06是ACK，确认的意思。所以后面可能是用aHR19作为密钥加密的结果。
    $str = "YUhSMTkG==NUa0Q9PW92TDJzeExtRndjREV4TVM1dmNtY3ZRWEJ3VW1sdVp5OHhMekF3TXk4eU5qa3ZaVFk1TkdVMU9EazBNbVkzWldWa01UQTRZbVl5T0RFMk5UYzFOek5oWVdZdWJUUnk=";
    $arr = explode("PW92", $str); #拆分前后两部分       
    $str1 = "http:/";  #修正前面部分       
    echo $str1.base64_decode(base64_decode($arr[1])); #分别解密后，拼接，再进一步解密    
```
###[二维数组元素组合的算法](https://segmentfault.com/q/1010000003786297)
```js
$arr = array(
    array('a','b','c'),
    array('c','f'),
    array('g','z'),
    array('x','y')
);
//$arr子集元素长度可能会多一些
//将$arr的子集元素与$arr其他子集元素两两组合或者三三四四组合
//子集array('a','b','c')中的元素不需要组合
//两两组合
$newarr = array(
  array('a','c'),
  array('a','f'),
  array('b','c'),
  array('b','f'),
  array('c','c'),
  array('c','f'),
  ……
)
//三三组合
$newarr = array(
  array('a','c','g'),
  array('a','f','g'),
  array('b','c','g'),
  array('b','f','g'),
  array('c','c','g'),
  array('c','f','g'),
  ……
)
//四四组合
$newarr = array(
  array('a','c','g','x'),
  array('a','f','g','x'),
  array('b','c','g','x'),
  array('b','f','g','x'),
  array('c','c','g','x'),
  array('c','f','g','x'),
  ……
)
$arr = array(
    array('a', 'b', 'c'),
    array('c', 'f'),
    array('g', 'z'),
    array('x', 'y')
);

//$arr：原始数组，$cNum：组合长度
function getCombination($arr, $cNum) {
    if ($cNum === 0) {
        return return array(
            array('a'),
            array('b'),
            array('c'),
        );
    } else {
        $tmpArr2 = $arr;
        $resultArr = array();
        array_pop($tmpArr2);
        $lastNewArr = getCombination($tmpArr2, $cNum - 1);
        for ($i = 0; $i < count($lastNewArr); $i++) {
            for ($j = 0; $j < count($arr[$cNum]); $j++) {
                $tmpArr = $lastNewArr[$i];
                $tmpArr[] = $arr[$cNum][$j];
                $resultArr[] = $tmpArr;
            }
        }
        return $resultArr;
    }
}

print_r(getCombination($arr, count($arr) - 1));
//PHP计算二维数组笛卡尔积
class Descartes
{
    public $sourceArray;
    public $resultArray;

    public function __construct($array, $result)
    {
        $this->sourceArray = $array;
        $this->resultArray = $result;
    }

    public function calcDescartes($arrIndex, $arrResult)
    {
        if ($arrIndex >= count($this->sourceArray)) {
            array_push($this->resultArray, $arrResult);
            return ;
        }

        $currentArray = $this->sourceArray[$arrIndex];
        $currentArrayCount = count($currentArray);
        $arrResultCount = count($arrResult);

        for ($i = 0; $i < $currentArrayCount; ++$i) {
            $currentArraySlice = array_slice($arrResult, 0, $arrResultCount);
            array_push($currentArraySlice, $currentArray[$i]);
            $this->calcDescartes($arrIndex + 1, $currentArraySlice);
        }
    }

}

$example = [
    ['a', 'b', 'c'],
    ['c', 'f'],
    ['g', 'z'],
    ['x', 'y']
];

$result = [];

$descartes = new Descartes($example, $result);
$descartes->calcDescartes(0, $result);

var_dump($descartes->resultArray);

```
###[php做des加密](https://segmentfault.com/q/1010000004939270)
```js
echo mcrypt_get_key_size(MCRYPT_DES,MCRYPT_MODE_CFB);
// des cfb 秘钥长度为8位

// 秘钥
$key = 11111111;

// 创建IV
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_CFB),MCRYPT_RAND);

// 加密 使用CFB模式
$data = mcrypt_encrypt(MCRYPT_DES, $key, '加密的数据', MCRYPT_MODE_CFB, $iv);

var_dump($data);
// 获取OpenSSL支持的加密参数列表
print_r(openssl_get_cipher_methods());
Array
(
    [0] => AES-128-CBC
    [1] => AES-128-CFB
    [2] => AES-128-CFB1
    [3] => AES-128-CFB8
    [4] => AES-128-CTR
    [5] => AES-128-ECB
    [6] => AES-128-OFB
    [7] => AES-128-XTS
    [8] => AES-192-CBC
    [9] => AES-192-CFB
    [10] => AES-192-CFB1
    [11] => AES-192-CFB8
    [12] => AES-192-CTR
    [13] => AES-192-ECB
    [14] => AES-192-OFB
    [15] => AES-256-CBC
    [16] => AES-256-CFB
    [17] => AES-256-CFB1
    [18] => AES-256-CFB8
    [19] => AES-256-CTR
    [20] => AES-256-ECB
    [21] => AES-256-OFB
    [22] => AES-256-XTS
    [23] => BF-CBC
    [24] => BF-CFB
    [25] => BF-ECB
    [26] => BF-OFB
    [27] => CAMELLIA-128-CBC
    [28] => CAMELLIA-128-CFB
    [29] => CAMELLIA-128-CFB1
    [30] => CAMELLIA-128-CFB8
    [31] => CAMELLIA-128-ECB
    [32] => CAMELLIA-128-OFB
    [33] => CAMELLIA-192-CBC
    [34] => CAMELLIA-192-CFB
    [35] => CAMELLIA-192-CFB1
    [36] => CAMELLIA-192-CFB8
    [37] => CAMELLIA-192-ECB
    [38] => CAMELLIA-192-OFB
    [39] => CAMELLIA-256-CBC
    [40] => CAMELLIA-256-CFB
    [41] => CAMELLIA-256-CFB1
    [42] => CAMELLIA-256-CFB8
    [43] => CAMELLIA-256-ECB
    [44] => CAMELLIA-256-OFB
    [45] => CAST5-CBC
    [46] => CAST5-CFB
    [47] => CAST5-ECB
    [48] => CAST5-OFB
    [49] => DES-CBC
    [50] => DES-CFB
    [51] => DES-CFB1
    [52] => DES-CFB8
    [53] => DES-ECB
    [54] => DES-EDE
    [55] => DES-EDE-CBC
    [56] => DES-EDE-CFB
    [57] => DES-EDE-OFB
    [58] => DES-EDE3
    [59] => DES-EDE3-CBC
    [60] => DES-EDE3-CFB
    [61] => DES-EDE3-CFB1
    [62] => DES-EDE3-CFB8
    [63] => DES-EDE3-OFB
    [64] => DES-OFB
    [65] => DESX-CBC
    [66] => GOST 28147-89
    [67] => IDEA-CBC
    [68] => IDEA-CFB
    [69] => IDEA-ECB
    [70] => IDEA-OFB
    [71] => RC2-40-CBC
    [72] => RC2-64-CBC
    [73] => RC2-CBC
    [74] => RC2-CFB
    [75] => RC2-ECB
    [76] => RC2-OFB
    [77] => RC4
    [78] => RC4-40
    [79] => RC4-HMAC-MD5
    [80] => SEED-CBC
    [81] => SEED-CFB
    [82] => SEED-ECB
    [83] => SEED-OFB
    [84] => aes-128-cbc
    [85] => aes-128-ccm
    [86] => aes-128-cfb
    [87] => aes-128-cfb1
    [88] => aes-128-cfb8
    [89] => aes-128-ctr
    [90] => aes-128-ecb
    [91] => aes-128-gcm
    [92] => aes-128-ofb
    [93] => aes-128-xts
    [94] => aes-192-cbc
    [95] => aes-192-ccm
    [96] => aes-192-cfb
    [97] => aes-192-cfb1
    [98] => aes-192-cfb8
    [99] => aes-192-ctr
    [100] => aes-192-ecb
    [101] => aes-192-gcm
    [102] => aes-192-ofb
    [103] => aes-256-cbc
    [104] => aes-256-ccm
    [105] => aes-256-cfb
    [106] => aes-256-cfb1
    [107] => aes-256-cfb8
    [108] => aes-256-ctr
    [109] => aes-256-ecb
    [110] => aes-256-gcm
    [111] => aes-256-ofb
    [112] => aes-256-xts
    [113] => bf-cbc
    [114] => bf-cfb
    [115] => bf-ecb
    [116] => bf-ofb
    [117] => camellia-128-cbc
    [118] => camellia-128-cfb
    [119] => camellia-128-cfb1
    [120] => camellia-128-cfb8
    [121] => camellia-128-ecb
    [122] => camellia-128-ofb
    [123] => camellia-192-cbc
    [124] => camellia-192-cfb
    [125] => camellia-192-cfb1
    [126] => camellia-192-cfb8
    [127] => camellia-192-ecb
    [128] => camellia-192-ofb
    [129] => camellia-256-cbc
    [130] => camellia-256-cfb
    [131] => camellia-256-cfb1
    [132] => camellia-256-cfb8
    [133] => camellia-256-ecb
    [134] => camellia-256-ofb
    [135] => cast5-cbc
    [136] => cast5-cfb
    [137] => cast5-ecb
    [138] => cast5-ofb
    [139] => des-cbc
    [140] => des-cfb
    [141] => des-cfb1
    [142] => des-cfb8
    [143] => des-ecb
    [144] => des-ede
    [145] => des-ede-cbc
    [146] => des-ede-cfb
    [147] => des-ede-ofb
    [148] => des-ede3
    [149] => des-ede3-cbc
    [150] => des-ede3-cfb
    [151] => des-ede3-cfb1
    [152] => des-ede3-cfb8
    [153] => des-ede3-ofb
    [154] => des-ofb
    [155] => desx-cbc
    [156] => gost89
    [157] => gost89-cnt
    [158] => id-aes128-CCM
    [159] => id-aes128-GCM
    [160] => id-aes128-wrap
    [161] => id-aes192-CCM
    [162] => id-aes192-GCM
    [163] => id-aes192-wrap
    [164] => id-aes256-CCM
    [165] => id-aes256-GCM
    [166] => id-aes256-wrap
    [167] => id-smime-alg-CMS3DESwrap
    [168] => idea-cbc
    [169] => idea-cfb
    [170] => idea-ecb
    [171] => idea-ofb
    [172] => rc2-40-cbc
    [173] => rc2-64-cbc
    [174] => rc2-cbc
    [175] => rc2-cfb
    [176] => rc2-ecb
    [177] => rc2-ofb
    [178] => rc4
    [179] => rc4-40
    [180] => rc4-hmac-md5
    [181] => seed-cbc
    [182] => seed-cfb
    [183] => seed-ecb
    [184] => seed-ofb
)
// 使用openssl加密数据 http://e-file.arkoo.com/tools/des3.htm
$string = openssl_encrypt('要加密的数据','des-cfb','秘钥des为8位',0,'IV des为8位');
var_dump($string);
```
