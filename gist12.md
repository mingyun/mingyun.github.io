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
###[js前端插件](http://elickzhao.github.io/2017/01/js%E5%89%8D%E7%AB%AF%E6%8F%92%E4%BB%B6%E5%A4%A7%E6%80%BB%E7%BB%93/)
打字输入效果的插件https://github.com/Zhouzi/TheaterJS 
强大的纯Js模态消息对话框插件 https://github.com/limonte/sweetalert2 
一个好看的时钟 https://github.com/objectivehtml/FlipClock 
###[npm 及 node.js 升级自己](http://elickzhao.github.io/2017/01/Npm%E5%8F%8A%20node.js%20%E5%8D%87%E7%BA%A7%E8%87%AA%E5%B7%B1%20/)
```js
npm -g install npm
# node有一个模块叫n（这名字可够短的。。。），是专门用来管理node.js的版本的。
# 首先安装n模块：
npm install -g n 
#升级node.js到最新稳定版
n stable
# n 后面也可以跟随版本号比如： 
n v0.10.26
n这个程序好像只是在linux下才好使,windows下是没用的.
```
###[JS 数组的 push 与 concat 区别](http://elickzhao.github.io/2016/12/JS%20%E6%95%B0%E7%BB%84%E7%9A%84%20push%20%E4%B8%8E%20concat%20%E5%8C%BA%E5%88%AB/)
```js
var a = [1,2,3,4];
a.push(5);  //a 现在是1,2,3,4,5
var a = [1,2,3,4];
var b = [5,6];
var c = a.concat(b); // a,b 数组都不变，c变成了1,2,3,4,5,6
//这里要注意是 c 变成了合并数组 不是 b , 所以这和push是有区别的
var arr1= [1,2,3];  
arr1.push.apply(arr1,[4,5]);  // 这时 arr1 就是 [1,2,3,4,5]

```
###[cooking 更易上手的前端构建工具](http://elickzhao.github.io/2016/12/cooking%20%E7%AE%80%E4%BB%8B%20%E5%AE%89%E8%A3%85%E4%B8%8E%E4%BD%BF%E7%94%A8/)
首先确保是在 NPM 3+, Node 4+, Python 2.7+ 环境下运行

第一步：安装 cooking 命令行工具

npm i cooking-cli -g

第二步：使用创建项目

cooking create my-project vue

第三步：开始开发

cd my-project && cooking watch

后续：打包、测试等

cooking build # or cooking run test
https://zhuanlan.zhihu.com/p/22387692
https://cookingjs.github.io/zh-cn/intro.html

###[Windows 系统下设置Nodejs NPM全局路径](http://elickzhao.github.io/2016/12/Windows%20%E7%B3%BB%E7%BB%9F%E4%B8%8B%E8%AE%BE%E7%BD%AENodejs%20NPM%E5%85%A8%E5%B1%80%E8%B7%AF%E5%BE%84/)
```js
查看配置命令
npm config ls -l

Windows下的Nodejs npm路径是appdata，很不爽，想改回来，但是在cmd下执行以下命令也无效

npm config set cache “C:\Program Files\nodejs\node_cache”

npm config set prefix “C:\Program Files\nodejs”

最后在nodejs的安装目录中找到node_modules\npm.npmrc文件

修改如下即可：

prefix = D:\nodejs\node_global
cache = D:\nodejs\node_global
```
###[laravel 修改用户验证为MD5加密方式](http://elickzhao.github.io/2016/11/laravel%20%E4%BF%AE%E6%94%B9%E7%94%A8%E6%88%B7%E9%AA%8C%E8%AF%81%E4%B8%BAMD5%E5%8A%A0%E5%AF%86%E6%96%B9%E5%BC%8F/)
```js
(laravel插件) laravel-backup 备份插件http://elickzhao.github.io/2016/10/[laravel%E6%8F%92%E4%BB%B6]%20laravel-backup%20%E5%A4%87%E4%BB%BD%E6%8F%92%E4%BB%B6/  https://packagist.org/packages/spatie/laravel-backup
Illuminate\Auth\EloquentUserProvider
larave后台日志插件rap2hpoutre/laravel-log-viewer和ARCANEDEV/LogViewer  http://elickzhao.github.io/2016/06/larave%E5%90%8E%E5%8F%B0%E6%97%A5%E5%BF%97%E6%8F%92%E4%BB%B6/
// 114行左右
/**
 * Validate a user against the given credentials.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
 * @param  array  $credentials
 * @return bool
 */
public function validateCredentials(UserContract $user, array $credentials)
{
    $plain = $credentials['password'];
    //XXX 自己修改的 md5验证, 这是最快捷的方式,虽然存在隐患,以后再解决吧
    return md5($plain) == $user->getAuthPassword();
    //return $this->hasher->check($plain, $user->getAuthPassword());
}
实现 Hasher 接口,然后替换掉原来的 BcryptHasher 这个类
namespace Illuminate\Contracts\Hashing;
interface Hasher
{
    public function make($value, array $options = []);
    public function check($value, $hashedValue, array $options = []);
    public function needsRehash($hashedValue, array $options = []);
}
//实现这个接口很简单
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        //return md5($plain) == $user->getAuthPassword();
        //这里的 hasher 的就行了. 不过还是得改代码
        return $this->hasher->check($plain, $user->getAuthPassword());
    }
```
###[php 抽象类的用法 (abstract)](http://elickzhao.github.io/2016/10/php%20%E6%8A%BD%E8%B1%A1%E7%B1%BB%E7%9A%84%E7%94%A8%E6%B3%95%20(abstract)/)
```js
定义为抽象的类不能被实例化。任何一个类，如果它里面至少有一个方法是被声明为抽象的，那么这个类就必须被声明为抽象的。被定义为抽象的方法只是声明了其调用方式（参数），不能定义其具体的功能实现。
namespace ApiDemo\Repositories\Eloquent;
abstract class BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }
    abstract public function model();
    public function paginate($limit = null)
    {
        return $this->model
            ->paginate($limit);
    }
 namespace ApiDemo\Repositories\Eloquent;
use ApiDemo\Repositories\Contracts\UserRepositoryContract;
class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function model()
    {
        return 'ApiDemo\Models\User';
    }
}   
```
###[Gravatar头像](http://elickzhao.github.io/2016/10/%E8%A7%A3%E5%86%B3%20Gravatar%20%E8%A2%AB%E5%A2%99%E5%AF%BC%E8%87%B4%E6%97%A0%E6%B3%95%E6%98%BE%E7%A4%BA%E7%9A%84%E9%97%AE%E9%A2%98/)
http://www.gravatar.com
http://0.gravatar.com
http://1.gravatar.com
http://2.gravatar.com
http://gravatar.com
http://cn.gravatar.com 使用这个就好了
https://secure.gravatar.com
###[JSFiddle 改写展示标签](http://elickzhao.github.io/2016/07/JSFiddle%20%E6%94%B9%E5%86%99%E5%B1%95%E7%A4%BA%E6%A0%87%E7%AD%BE/)
```js
原有的标签顺序狠不好,JS文件在前显示结果在后.所以要改一下,把结果放在前面.
//jsfiddle.net/elick/s03Lk51x/embedded/result,js,html,css
其实很简单,embedded/后面这个结构就是标签顺序.http://code.hcharts.cn/blog-demo/OYZT3i/1 
//其实这个很直白了 因为一般bool值 表示 ture 为 1 false 为 0
!0 == true 
!!0 == false 
//但是 !0 === true 这是错的 恒等于 是不会转义类型的 所以 0 还是 int 型  所以不能与 bool 型相等
//这些都是同理了
!1 == false
!!1 == true
//这是设置 a 为 undefined , 如果用字符串代替会存在浏览器兼容问题
//也可以在 return 时使用,表示返回空,只是执行操作.
//具体看下面参考文档
var a = viod 0;
```
###[php 隐藏下载地址](http://elickzhao.github.io/2016/07/php%20%E9%9A%90%E8%97%8F%E4%B8%8B%E8%BD%BD%E5%9C%B0%E5%9D%80/)
```js
$file_size = filesize($url); 
header("Content-type: application/octet-stream"); 
header("Accept-Ranges: bytes"); 
header("Accept-Length: $file_size");
header("Content-Disposition: attachment; filename=".basename($url)); 
header("location: $url");
```
###[PHP 扩展模块 phpize 解释](http://elickzhao.github.io/2016/06/PHP%20%E6%89%A9%E5%B1%95%E6%A8%A1%E5%9D%97%20phpize%20%E8%A7%A3%E9%87%8A/)
	
/home/vsrank/php/bin/phpize
make  
make install
extension="/home/vsrank/php/lib/php/extensions/no-debug-non-zts-20090626/sockets.so"
###[js 操作文件 FileAPI](http://elickzhao.github.io/2016/05/js%20%E6%93%8D%E4%BD%9C%E6%96%87%E4%BB%B6%20FileAPI/)
```js
!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="user-scalable=no, width=400, initial-scale=0.8, maximum-scale=0.8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="yes" />
	<meta name="format-detection" content="email=no" />
	<meta name="HandheldFriendly" content="true" />
	<script>
		// Объект настройки
		var FileAPI = {
			debug: true, // режим отладки
			staticPath: './' // путь до флешек
		};
	</script>
	<title>Document</title>
	<script src="dist/FileAPI.min.js"></script>
</head>
<body>
	<input type="file" name='my-input' id='singleFile'>
	<script>
	(function (){
		FileAPI.event.on(singleFile,'change' ,function (evt/**Event*/){
		  // Retrieve file list
		  var files = FileAPI.getFiles(singleFile);
				if( files.length ){
					FileAPI.each(files, function (file){
						FileAPI.readAsText(file, "utf-8", function (evt/**Object*/){
						  if( evt.type == 'load' ){
						    // Success
						     var text = evt.result;
						     //console.log(text);
						     alert(text);
						  } else if( evt.type =='progress' ){
						    var pr = evt.loaded/evt.total * 100;
						    console.log(pr);
						  } 
						});
					});
				}
		});
	})();
	</script>
</body>
</html>
https://github.com/mailru/FileAPI
```
###[Laravel项目 基本开发流程](http://elickzhao.github.io/2016/05/Laravel%E9%A1%B9%E7%9B%AE%20%E5%9F%BA%E6%9C%AC%E5%BC%80%E5%8F%91%E6%B5%81%E7%A8%8B/)
```js
composer create-project laravel/laravel myapp --prefer-dist
//安装程序
composer require barryvdh/laravel-ide-helper
//配置文件到 config > app.php > 服务数组里
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
//生成提示文件 这样一些静态命令才会有提示
php artisan ide-helper:generate
//在composer.json里 添加更新时命令 (为确保提示为最新的 当加载程序变更时 自动重启生成 顺序不能变)
        "pre-update-cmd": [
            "php artisan clear-compiled",
            "php artisan ide-helper:generate",
            "php artisan optimize"
        ],//安装程序
composer require barryvdh/laravel-debugbar
//配置程序
Barryvdh\Debugbar\ServiceProvider::class,
//配置门面别名
'Debugbar' => Barryvdh\Debugbar\Facade::class,

```
###[laravel模型学习笔记](http://elickzhao.github.io/2016/06/laravel%E6%A8%A1%E5%9E%8B%E5%AD%A6%E4%B9%A0%E7%AC%94%E8%AE%B0/)
```js
//指定表名  
protected $table = 'my_flights';
//这个限制只决定怎么插入到数据库 不决定怎么取出数据
protected $dateFormat = 'Y-m-d';
//白名单 可以直接创建数据的字段
protected $fillable = ['title','intro','content','published_at'];
//黑名单 除此之外的字段都可以直接创建
protected $guarded = ['created_at','updated_at'];
//设置字段为Carbon实例 可以直接使用Carbon方法
protected $dates = ['published_at'];
//属性转换类型 key是字段名称 value是要转换成的类型
protected $casts = ['is_admin' => 'boolean',];
//数组转换 把数组转化成JSON格式存入数据库 读取时自动转化成数组
protected $casts = ['options' => 'array', ];function flight()
{
    //默认外键为flight_id  这里的外键还是相对于Flight来说的  这是因为这个是belongsTO从属表  所以外键是位于表内字段
    //return $this->belongsTo('App\Flight','f_id','airline');
    //这里内键也是相对Flight说 其实是Flight的内部字段
    return $this->belongsTo('App\Flight','flight_fid','airline');
}
//隐藏模型的一些属性 直接输出的时候是无法看见的
protected $hidden = ['password'];
//显示白名单 那些字段直接输出是可以被看到的
protected $visible = ['first_name', 'last_name'];
//追加字段到返回数组中 而且是数据库没有的字段 而且需要访问器的帮忙
//但这个不理解有什么用处 他其实是通过已有字段经过判断后输出 两个字段都能返回 只不过这个返回是布尔值
protected $appends = ['is_admin'];
App\Flight::updateOrCreate(['name'=>'Flight 10'],['airline'=>'888']);

DB::table('users')
->whereExists(function ($query) {
    $query->select(DB::raw(1))
        ->from('orders')
        ->whereRaw('orders.user_id = users.id');
})
->get();
select * from users where exists (select 1 from orders where orders.user_id = users.id)
生成上面那句语句 exists 判断括号内语句是否为真 为真则搜索 为假则放弃
public function fly(){
    //外键一般用当前模型的表名加ID 例如 flight_id
    //这个外键是int类型或者是varchar类型都可以
    //第三个参数是表内关联的键  也是就是当期模型的表所含的字段  外键是关联外部的表所含的字段
    return $this->hasOne('App\Flys','flight_fid','airline');
}
/*
  实际上在底层无论是hasOne方法还是belongsTo方法都可以接收额外参数，
  比如如果user_accounts中关联users的外键是$foreign_key，该外键对应users表中的列是$local_key，
  那么我们可以这样调用hasOne方法：
  $this->hasOne('App\Models\UserAccount',$foreign_key,$local_key);
  调用belongsTo方法也是一样：
  $this->belongsTo('App\User',$foreign_key,$local_key);
  此外，belongsTo还接收一个额外参数$relation，用于指定关联关系名称，
  其默认值为调用belongsTo的方法名，这里是user。
 * */
 //注意我们定义中间表的时候没有在结尾加s并且命名规则是按照字母表顺序，
//将role放在前面，user放在后面，并且用_分隔
//所以RoleUser这个model必须指定表名 要不会出错的 protected $table = 'role_user';
//至于字段就没有说道了
$user = User::find(1);
```
###[composer 一些使用记录](http://elickzhao.github.io/2016/04/composer%20%E4%B8%80%E4%BA%9B%E4%BD%BF%E7%94%A8%E8%AE%B0%E5%BD%95/)
```js
composer selfupdate                      
composer require "foo/bar:1.0.0"                    安装一个库
composer update foo/bar                             更新单个库
composer create-project laravel/laravel myapp --prefer-dist 创建laravel项目
composer config -g repo.packagist composer https://packagist.phpcomposer.com 配置仓库镜像
composer global require "laravel/installer=~1.1"    全局安装laravel安装器
composer install update --prefer-dist               后面这个参数是强制使用压缩包
composer install --profile                          后面这个参数是显示安装时间
composer dump-autoload --optimize                   生产环境优化
composer update symfony/yaml --prefer-source        强制克隆代码 用于修改库文件
当你更新一个修改的库的时候 会提示你是否放弃修改
----------------------------------------------------------------------------------------------------
$ composer update
Loading composer repositories with package information  
Updating dependencies  
  - Updating symfony/symfony v2.2.0 (v2.2.0- => v2.2.0)
    The package has modified files:
    M Dumper.php
    Discard changes [y,n,v,s,?]?
    全局配置目录
C:\Users\elick\AppData\Roaming\Composer
```
###[PHP 获取服务器详细信息](http://elickzhao.github.io/2016/04/PHP%20%E8%8E%B7%E5%8F%96%E6%9C%8D%E5%8A%A1%E5%99%A8%E8%AF%A6%E7%BB%86%E4%BF%A1%E6%81%AF%E4%BB%A3%E7%A0%81/)
```js
获取系统类型及版本号：	php_uname()
只获取系统类型：	php_uname('s')
只获取系统版本号：	php_uname('r')
获取PHP运行方式：	php_sapi_name()
获取前进程用户名：	Get_Current_User()
$_ENV[]	存储当前WEB环境变量
```
###[bootstrap 该死的IE兼容](http://elickzhao.github.io/2016/05/bootstrap%20%E8%AF%A5%E6%AD%BB%E7%9A%84IE%E5%85%BC%E5%AE%B9/)
```js
if (!("classList" in document.documentElement)) {
    //兼容ie8  HTMLElement
    window.HTMLElement = window.HTMLElement || Element;
    //兼容ie9 classlist
    Object.defineProperty(HTMLElement.prototype, 'classList', {
      get: function() {
        var self = this;
        function update(fn) {
          return function(value) {
            var classes = self.className.split(/\s+/g),
              index = classes.indexOf(value);
            fn(classes, index, value);
            self.className = classes.join(" ");
          }
        }
        return {
          add: update(function(classes, index, value) {
            if (!~index) classes.push(value);
          }),
          remove: update(function(classes, index) {
            if (~index) classes.splice(index, 1);
          }),
          toggle: update(function(classes, index, value) {
            if (~index)
              classes.splice(index, 1);
            else
              classes.push(value);
          }),
          contains: function(value) {
            return !!~self.className.split(/\s+/g).indexOf(value);
          },
          item: function(i) {
            return self.className.split(/\s+/g)[i] || null;
          }
        };
      }
    });
  }
</script>
window.HTMLElement = window.HTMLElement || Element;

```
