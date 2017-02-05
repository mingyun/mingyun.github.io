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
