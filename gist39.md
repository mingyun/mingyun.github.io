[字符串中反斜杠的替换](https://segmentfault.com/q/1010000008830727)
```js
{"jsonstr":
"{\"pageindex\":1,\"start\":\"2017-03-01\",\"end\":\"2017-03-25\"}"
}
In [10]: import json

In [11]: json.dumps(s)
Out[11]: '{"end": "2017-03-25", "pageindex": 1, "start": "2017-03-01"}'
```
[python怎么使用matplotlib画出下面这样的图？](https://segmentfault.com/q/1010000008826803)
```js
# coding: utf-8

import matplotlib.pyplot as plt
import numpy as np

x = np.random.randint(0, 10, size=10)
y = np.random.randint(100, 1000, size=10)

plt.bar(x, y)
plt.show()
```
[PHP中一些通用和易混淆技术点的最佳编程实践](http://www.oschina.net/translate/php-best-practices?lang=chs&page=2#)
[php命令行下执行内存溢出的问题](https://segmentfault.com/q/1010000008453264)
```js
  //写法1，这里内存不会溢出
    while(true) {
        $i++;
        var_dump($i);
        $i = new Test();    
    }
    
    //写法2，这里内存不会溢出
    while(true) {
        new Test();
    }
    
    //写法3，这里内存会溢出
    while(true) {
       $i[] = new Test();  
    }
    这是因为前两个循环中创建的对象在循环完成一次后就没有用了，可以被垃圾回收机制回收内存，因此不会出现溢出。而第三种因为每次循环结束都会设置一下$i这个数组，数组$i的生命周期没有结束，持有对每一个Test对象的引用，造成创建的Test对象无法被垃圾回收机制回收，创建的太多了，内存占用就会越来越大，最终就内存溢出了。http://php.net/manual/zh/features.gc.php
```
[mysql，同一个表根据其中的两个字段修改这两个中的一个字段](https://segmentfault.com/q/1010000009294529)
```js
select * 
  from student 
  where id not in(select min(id) from student group by parent_id,name)t

修改打算根据createDate排序，然后name后面加上排序后的序号

update student t1 inner join 
    (select idx,id 
     from
         (select if(@m_last_parent_id=parent_id and @m_last_name=name,@m_i:=@m_i+1,@m_i:=0) idx,
             @m_last_parent_id:=parent_id,@m_last_name:=name,id,parent_id,name,createDate 
          from student
          order by parent_id,name,createDate
         )m 
     where idx>0
    )t2 on t1.id=t2.id 
set t1.name=concat(t1.name,t2.idx);
```

[支付开发填坑记之微信支付](https://segmentfault.com/a/1190000009346755)
```js

function arrayToXml(array $data)
{
    $xml = "<xml>";
    foreach ($data as $k => $v) {
        if (is_numeric($v)) {
            $xml .= "<{$k}>{$v}</{$k}>";
        } else {
            $xml .= "<{$k}><![CDATA[{$v}]]></{$k}>";
        }
    }
    $xml .= "</xml>";
    return $xml;
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
$response = curl_exec($ch);
if (!$response) {
    throw new Exception('CURL Error: ' . curl_errno($ch));
}
curl_close($ch);
function xmlToArray($xml){
    return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
}
$d = $this->xmlToArray(file_get_contents('php://input'));
if (empty($d)) {
    throw new Exception(__METHOD__);
}
if ($d['return_code'] != 'SUCCESS') {
    throw new Exception($d['return_msg']);
}
if ($d['result_code'] != 'SUCCESS') {
    throw new Exception("[{$d['err_code']}]{$d['err_code_des']}");
}
我也准备在这缴，51 社保 末代皇帝http://www.bilibili.com/video/av9760951/
https://xiaoluoboding.github.io/repository-tree/  https://github.com/xiaoluoboding/repository-tree 展示 Github 项目的目录树并拷贝到剪切板
批量保存微信图片的脚本https://www.v2ex.com/t/372122
```
[使用Python替换shell脚本](http://amoffat.github.io/sh/index.html)
from sh import ifconfig
print(ifconfig("wlan0"))
sh.ls("-l", "/tmp", color="never")
[8种常被忽视的SQL错误用法](https://mp.weixin.qq.com/s/1WpspGr7R-EjXfhWzlsZvQ)
[微博终结者爬虫重启版本](https://github.com/jinfagang/weibo_terminator_workflow)
[两个抓娃娃大神，将无数娃娃机清柜](http://weibo.com/1895964183/F7cANFr4h)
http://weibo.com/5888006271/EhYp50FGO http://weibo.com/6077588122/F7cuwf55k 
[Laravel 大将之 Redis 模块](https://segmentfault.com/a/1190000009695841)
```js
《Python Cookbook》https://github.com/yidao620c/python3-cookbook
Nginx配置静态分析器https://github.com/yandex/gixy gixy /etc/nginx/nginx.conf
有哪些科普类的歌词？比如一年有三百六十五个日出 ​​​​http://weibo.com/2530813523/F2vrfrb1e
$redis = app('redis.connection');
$redis->set('library', 'predis'); // 存储 key 为 library， 值为 predis 的记录；
app('redis')->connection('mydefine')可以获取该连接对象
$redis->keys('foo*');   // 返回 foo1 和 foo2 的 array
$redis->keys('f?o?');   // 同上
$redis->randomkey() ; // 可能是返回 'foo1' 或者是 'foo2' 及其它任何已存在的 key
$redis->expire('foo', 10);  // 设置有效期为 10 秒
$redis->ttl('foo');  // 返回剩余有效期值 10 秒
$redis->persist ('foo');  // 取消 expire 行为
dbsize 返回redis当前数据库的记录总数
$redis->info();
$redis->dbsize() ;

https://blog.ihoey.com/posts/Node/2017-05-10-npm.html
$ npm list
# 加上 global 参数，会列出全局安装的模块
$ npm list -global
# npm list 命令也可以列出单个模块
$ npm install git://github.com/package/path.git
$ npm install git://github.com/package/path.git#0.1.0
$ npm list underscore
```
[最常用的PHP正则表达式收集整理](https://segmentfault.com/p/1210000009589919/read#top)
[JavaScript正则进阶之路——活学妙用奇淫正则表达式](https://segmentfault.com/a/1190000009590458)
1234567890 --> 1,234,567,890 let format = test1.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
function isPrime(num) {
return !/^1?$|^(11+?)\1+$/.test(Array(num+1).join('1'))
}
[超详细的Python实现百度云盘模拟登陆(模拟登陆进阶)](https://segmentfault.com/a/1190000009411578)

[打包带走！史上最全的大数据分析和制作工具](https://mp.weixin.qq.com/s/Vg-Z6IfT530lJbkAa4M4ag)
console.log(isPrime(19)) // true
[JavaScript深入系列15篇正式完结](https://segmentfault.com/a/1190000009562674)
[git干货系列：（一）我是小白，我想要搭建git仓库](https://segmentfault.com/p/1210000009571646/read#top)
[127.0.0.1:6379[20]>info memory  info stats 关于redis性能问题分析和优化](https://segmentfault.com/p/1210000009545925/read#top)
[ 一个在线的 web 代码生成小工具](https://webcode.tools/)
[PHP那些琐碎的知识点](https://segmentfault.com/p/1210000009496954/read)
[给PHP做的分布式跟踪系统，可以方便的查看线上调用关系，性能，回放请求过程，具体参数，系统异常统计等信息 Github](https://github.com/weiboad/fiery)
[Redis性能问题排查解决手册](https://segmentfault.com/p/1210000009478608/read)
[公众号排名](https://sdk.cn/subscriptions)
[超级易懂爬虫系列之爬虫简单的架构](http://www.huqi.tk/index.php/2017/05/08/python_spider_simple_architecture/)
[密码存储中MD5的安全问题与替代方案](https://segmentfault.com/p/1210000009609778/read#top)
```js
class User extends BaseModel
{
 const PASSWORD_COST = 11; // 这里配置bcrypt算法的代价，根据需要来随时升级
 const PASSWORD_ALGO = PASSWORD_BCRYPT; // 默认使用（现在也只能用）bcrypt

 /**
 * 验证密码是否正确
 *
 * @param string $plainPassword 用户密码的明文
 * @param bool $autoRehash 是否自动重新计算下密码的hash值（如果有必要的话）
 * @return bool
 */
 public function verifyPassword($plainPassword, $autoRehash = true)
 {
 if (password_verify($plainPassword, $this->password)) {
 if ($autoRehash && password_needs_rehash($this->password, self::PASSWORD_ALGO, ['cost' => self::PASSWORD_COST])) {
 $this->updatePassword($plainPassword);
 }

 return true;
 }

 return false;
 }

 /**
 * 更新密码
 *
 * @param string $newPlainPassword
 */
 public function updatePassword($newPlainPassword)
 {
 $this->password = password_hash($newPlainPassword, self::PASSWORD_ALGO, ['cost' => self::PASSWORD_COST]);
 $this->save();
 }
}

```

[如何一键删除所有微博，一键将所有微博转为自己可见http://weibo.com/ttarticle/p/show?id=2309404112304810625896]()
[@请问金钟仁今天分手了吗](http://weibo.com/5638148926/F5N7rjYnC)
[Python入门之生成海贼王云图](https://mp.weixin.qq.com/s/r-7Z_d0REuEjFd8LDh0aiw)
[开源的跨平台代码片段管理工具](http://hackjutsu.com/Lepton/)
[现代JavaScript教程](http://t.cn/a3ib7X)
[PHP7内核剖析](https://github.com/pangudashu/php7-internal)
[用PYTHON玩微信（非常详细）](https://segmentfault.com/p/1210000009659125/read#top)
[记一次境外站渗透过程](http://ecma.io/)
http://link.zhihu.com/?target=https%3A//github.com/wzyonggege/python-wechat-itchat
[]()
[《windows下php开发环境搭建》 zeronet](https://github.com/chenjia404/how-to-self-programming/blob/master/php/windows%E4%B8%8B%E5%BC%80%E5%8F%91%E7%8E%AF%E5%A2%83%E6%90%AD%E5%BB%BA.md)
https://blog.chenjia.info/ 
[一个牛逼的交互式脑图](https://learn-anything.xyz/design/graphic-design/photoshop)
[如何免费建立一个永远在线博客](https://blog.chenjia.info/2017/06/online-blog.html)
官网:https://zeronet.io/
[ShutIt：一个基于Python的shell自动化框架](http://geek.csdn.net/news/detail/202105)
[您的用户遇到BUG了吗](https://fundebug.com/dashboard/594ccc061e2fb100144b983e/errors/inbox?filters=%7B%7D)
[喜欢用 Git 做的一些小事](https://segmentfault.com/a/1190000009753465)
```js
但如果你对团队成员在项目中的提交数量感兴趣，使用 shortlog 就可以找到答案：

$ git shortlog -sn
    80  Harry Roberts
    34  Samantha Peters
     3  Tom Smith
     
$ git shortlog -sn --since='10 weeks' --until='2 weeks'
    59  Harry Roberts
    24  Samantha Peters
    
 通过一种比较轻松的游戏的方式来一探全貌https://github.com/Gazler/githug   
  $ git blame -L5,10 _components.buttons.scss
  仅显示单词的变化而不是整行git diff --word-diff
 git for-each-ref --count=10 --sort=-committerdate refs/heads/ --format="%(refname:short)" 查看最近工作的分支 
  去除这种空白提示非常容易，在 git diff 和 git show 使用 -w 选项就可以轻松搞定
  http://159.226.40.104:18080/dev/  看到每个人都在做什么
  git log --all --oneline --no-merges
  git config --global alias.overview "log --all --since='2 weeks' --oneline --no-merges"
  
   Chrome 扩展插件「档案娘助手」，一键删除所有微博、删除所有转发微博、删除所有包含某些关键词的微博、删除某些日期的微博
  
```
[在简书发一片文章，自动同步到知乎、公众号、微博。这个应该就可以做到](https://sspai.com/post/38989)
[中科院计算所开源了Easy Machine Learning系统，其通过交互式图形化界面让机器学习应用开发变得简单快捷](https://github.com/ICT-BDA/EasyML)
http://159.226.40.104:18080/dev/


[微博关系图功能正式上线了](http://weibo.wbdacdn.com/weibo/friends/3217179555/)



[]()
```js
Math.min() < Math.max() // false 因为Math.min() 返回 Infinity, 而 Math.max()返回 -Infinity。
const Greeters = []

for (var i = 0 ; i < 10 ; i++) {
 Greeters.push(function () { return console.log(i) })
}
Greeters[0]() // 10
Greeters[1]() // 10
Greeters[2]() // 10
有两种方法：
- 使用`let`而不是`var`。备注：可以参考Fundebug的另一篇博客[ES6之"let"能替代"var"吗?](https://blog.fundebug.com/2017/05/04/why-you-should-not-use-var/)
- 使用`bind`函数。备注：可以参考Fundebug的另一篇博客[JavaScript初学者必看“this”](https://blog.fundebug.com/2017/05/17/javascript-this-for-beginners/)
 
Greeters.push(console.log.bind(null, i))
typeof [] === 'object' // true 需要使用`Array.isArray(var)`。
1 === 1 // true
// 然而这些不行
[1,2,3] === [1,2,3] // false
{a: 1} === {a: 1} // false
{} === {} // false
`new Date(2016, 1, 1)`不会在1900年的基础上加2016，而只是表示2016年。
JavaScript默认使用字典序(alphanumeric)来排序。因此，[1,2,5,10].sort()的结果是[1, 10, 2, 5]。

如果你想正确的排序，应该这样做：[1,2,5,10].sort((a, b) => a - b)
node -e 'console.log(3 + 2)'
node -p '3 + 2'



```
[Layer 子域名挖掘机4.1 全新重构 + 175万大字典](http://paper.seebug.org/113/)
[电商购物网站 - 需求与设计](https://segmentfault.com/a/1190000009926042)
[基于浏览器插件的数据抓取工具](https://github.com/easychen/catgate)
[Feigong - 针对各种情况自由变化的 mysql 注入工具](http://paper.seebug.org/124/)
https://github.com/LoRexxar/Feigong/tree/old
[brut3k1t - 一款模块化的服务端暴力破解工具](http://paper.seebug.org/119/)
[Web 前端代码规范](https://segmentfault.com/a/1190000009935766)
[Solutions collection of my LeetCode submissions](https://github.com/hijiangtao/LeetCodeOJ)
[linux Bash-Snippets](https://github.com/alexanderepstein/Bash-Snippets)
[tp5基于workerman实现browsersync开发利器](http://www.thinkphp.cn/extend/1006.html)
composer require workerman/workerman  github地址：https://github.com/skj198568/browser_sync
[看看大家在上线了上创建的精彩网站吧](https://www.sxl.cn/s/discover)
[当你难过的想死的时候回来看一眼这条微博。 ​​​​](http://weibo.com/5650770554/F8Zy6tfFC?type=comment)
[JavaScript中的数据结构和算法学习](http://caibaojian.com/learn-javascript.html?)
[深入理解 Python 浮点数](https://mp.weixin.qq.com/s/FTZT2x5TeZTmlKqGLDh0JQ)
```js
>>> 1/3
0.3333333333333333

>>> 0.1234567890123456789
0.12345678901234568
>>> 0.1 * 3 == 0.3
False

>>> (0.1 * 3).hex()  # 显然两个存储内容并不相同。
0x1.3333333333334p-2

>>> (0.3).hex()
0x1.3333333333333p-2
>>> s = (1/3).hex()

>>> float.fromhex(s)  # 反向转换回浮点数。
0.3333333333333333
round(0.1 * 3, 2) == round(0.3, 2)  # 避免不确定性，左右都使用固定精度。
round(0.1, 2) * 3 == round(0.3, 2)

>>> int(2.6), int(-2.6)
(2, -2)
>>> from math import trunc, floor, ceil

>>> trunc(2.6), trunc(-2.6)  # 截断小数部分。
(2, -2)

>>> floor(2.6), floor(-2.6)  # 往小数字方向取最近整数。
(2, -3)

>>> ceil(2.6), ceil(-2.6)  # 往大数字方向取最近整数。
(3, -2)
>>> 1.1 + 2.2   # 结果与 3.3 近似。
3.3000000000000003

>>> (0.1 + 0.1 + 0.1 - 0.3) == 0  # 同样二进制近似值计算结果与十进制预期不符。
False
>>> from decimal import Decimal

>>> Decimal("1.1") + Decimal("2.2")
Decimal('3.3')

>>> (Decimal("0.1") + Decimal("0.1") + Decimal("0.1") - Decimal("0.3")) == 0
True
有些文章宣称 “奇舍偶入” 或 “五成双” 等
```
[利用新接口抓取微信公众号的所有文章](https://mp.weixin.qq.com/s/fT4wZckEX69ZJbiZ0JGjqA)
```js
import requests
import redis
import json
import re
import random
import time
 
gzlist = ['yq_Butler']
 
 
url = 'https://mp.weixin.qq.com'
header = {
    "HOST": "mp.weixin.qq.com",
    "User-Agent": "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0"
    }
 #http://www.bilibili.com/video/av11127609/
with open('cookie.txt', 'r', encoding='utf-8') as f:
    cookie = f.read()
cookies = json.loads(cookie)
response = requests.get(url=url, cookies=cookies)
token = re.findall(r'token=(\d+)', str(response.url))[0]
for query in gzlist:
    query_id = {
        'action': 'search_biz',
        'token' : token,
        'lang': 'zh_CN',
        'f': 'json',
        'ajax': '1',
        'random': random.random(),
        'query': query,
        'begin': '0',
        'count': '5',
    }
    search_url = 'https://mp.weixin.qq.com/cgi-bin/searchbiz?'
    search_response = requests.get(search_url, cookies=cookies, headers=header, params=query_id)
    lists = search_response.json().get('list')[0]
    fakeid = lists.get('fakeid')
    query_id_data = {
        'token': token,
        'lang': 'zh_CN',
        'f': 'json',
        'ajax': '1',
        'random': random.random(),
        'action': 'list_ex',
        'begin': '0',
        'count': '5',
        'query': '',
        'fakeid': fakeid,
        'type': '9'
    }
    appmsg_url = 'https://mp.weixin.qq.com/cgi-bin/appmsg?'
    appmsg_response = requests.get(appmsg_url, cookies=cookies, headers=header, params=query_id_data)
    max_num = appmsg_response.json().get('app_msg_cnt')
    num = int(int(max_num) / 5)
    begin = 0
    while num + 1 > 0 :
        query_id_data = {
            'token': token,
            'lang': 'zh_CN',
            'f': 'json',
            'ajax': '1',
            'random': random.random(),
            'action': 'list_ex',
            'begin': '{}'.format(str(begin)),
            'count': '5',
            'query': '',
            'fakeid': fakeid,
            'type': '9'
        }
        print('翻页###################',begin)
        query_fakeid_response = requests.get(appmsg_url, cookies=cookies, headers=header, params=query_id_data)
        fakeid_list = query_fakeid_response.json().get('app_msg_list')
        for item in fakeid_list:
            print(item.get('link'))
        num -= 1
        begin = int(begin)
        begin+=5
        time.sleep(2)
```
[python求职Top10城市，来看看是否有你所在的城市](https://mp.weixin.qq.com/s?__biz=MzI2NjY5NzI0NA==&mid=2247483767&idx=1&sn=26f1e8c43084f9e4859031d54148fe33&chksm=ea8b6e04ddfce7125d2463732557e1f4f4655271f745c83149adcf2feb0fbdecd9eb2566a110&scene=21#wechat_redirect)
[一个轻量级PHP开源接口框架](https://github.com/phalapi/phalapi)
[MathLive是一个用于渲染和编辑数学公式的Javascript库](http://www.ctolib.com/arnog-mathlive.html)
[NSC2017第五届中国网络安全大会](https://github.com/xisigr/paper/blob/master/NSC2017%E7%AC%AC%E4%BA%94%E5%B1%8A%E4%B8%AD%E5%9B%BD%E7%BD%91%E7%BB%9C%E5%AE%89%E5%85%A8%E5%A4%A7%E4%BC%9A/%E6%B5%8F%E8%A7%88%E5%99%A8%E5%9C%B0%E5%9D%80%E6%A0%8F%E4%B9%8B%E5%9B%B0.pdf)



[Python：一篇文章掌握Numpy的基本用法](https://mp.weixin.qq.com/s/qWottPMuvkAvKz1z2TBZ_A)
```js
# 基于list
arr1 = np.array([1,2,3,4])
print(arr1)
# 基于tuple
arr_tuple = np.array((1,2,3,4))
print(arr_tuple)
# 二维数组 (2*3)
arr2 = np.array([[1,2,4], [3,4,5]])
# 一维数组
arr1 = np.arange(5)
print(arr1)
# 二维数组
arr2 = np.array([np.arange(3), np.arange(3)])
arr2
```

[用Pandas获取商品期货价格并可视化](https://mp.weixin.qq.com/s?__biz=MzI2NjY5NzI0NA==&mid=2247483676&idx=1&sn=09c35c1f4bf1ddc8c19c532829bd3964&chksm=ea8b6e6fddfce77983eb87e3870d186c15e911b9020523eef9a325f2f1a10e9b0ee99fa1d23a&scene=21#wechat_redirect)
[基于PHP实现的信息收集与SQL注入漏洞扫描工具](http://www.freebuf.com/sectool/137238.html)
git clone https://github.com/Tuhinshubhra/RED_HAWK
[检测 PHP 应用的代码复杂度](https://mp.weixin.qq.com/s/mJS2jqZIFMyKblFq1iCw0Q)
composer global require 'phploc/phploc=*' composer global require 'phpmetrics/phpmetrics'
[什么是动态规划](https://mp.weixin.qq.com/s/5tUYURKzvSeLBkg0Pdhzow)
[py爬虫](http://blog.csdn.net/wds2006sdo?viewmode=contents)
[localtunnel：将内网地址转化成公网地址npm install -g localtunnel](https://github.com/localtunnel/localtunnel)
[微博上的那些神评论](https://m.weibo.cn/p/23126100007540126469068801)
[将纯文本转成漂亮的手绘框图。 ​​​​](http://shakydraw.com/)
[一个python源码库的搜索引擎，搜到一些偏门的python库](http://nullege.com/)
[MySQL 分区表原理及使用详解](http://www.codeceo.com/article/mysql-partition.html)
```js
show variables like '%partition%';
mysql> select 
 ->   partition_name,
 ->   partition_expression,
 ->   partition_description,
 ->   table_rows
 -> from 
 ->   INFORMATION_SCHEMA.partitions
 -> where
 ->   table_schema='test'
 ->   and table_name = 'emp';
 explain partitions select * from emp where store_id=10 \G; partitions:p1 表示数据在p1分区进行检索。
```
[JavaScript 常用的简写技术](https://segmentfault.com/p/1210000009906328/read)
const answer = x > 10 ? 'is greater' : 'is lesser';
const variable2 = variable1 || 'new';
for (let i = 0; i < 10000; i++) {}
for (let i = 0; i < 1e7; i++) {}

// 下面都是返回true
1e0 === 1;
1e1 === 10;
[MySQL之一道关于GROUP BY的经典面试题](http://www.revotu.com/mysql-groupby-classic-interview-question.html)
```js



有一张shop表如下，有三个字段article，author，price。选出每个author的price最高的记录（要包含所有字段）。
SELECT article,author,MAX(price)
FROM shop
GROUP BY author;

SELECT article, author, price
FROM SHOP s1
WHERE price = (SELECT MAX(s2.price)
			   FROM shop s2
			   WHERE s1.author = s2.author);
SELECT article, s1.author, s1.price
FROM shop s1
JOIN (
	SELECT author, MAX(price) AS price
	FROM shop
	GROUP BY author) AS s2
	ON s1.author = s2.author AND s1.price = s2.price;
SELECT s1.article, s1.author, s1.price
FROM shop s1
LEFT JOIN shop s2
ON s1.author = s2.author AND s1.price < s2.price
WHERE s2.article IS NULL; 当 s1.price 是当前author的最大值时，就没有 s2.price比它还要大，所以此时s2的rows的值都会是NULL
```
[Luna 是一个新推出的可视化、函数式编程语言](http://t.cn/RGSaFN9)
[免费在线视频下载](https://www.apowersoft.cn/online-video-downloader)
[如何文艺地说我爱你？](http://weibo.com/1742566624/F9cwD2VdY)
[itchat+pillow实现微信好友头像爬取和拼接](https://github.com/15331094/wxImage)
```js
from numpy import *
import itchat
import urllib
import requests
import os

import PIL.Image as Image
from os import listdir
import math

itchat.auto_login(enableCmdQR=True)

friends = itchat.get_friends(update=True)[0:]

user = friends[0]["UserName"]

print(user)

os.mkdir(user)

num = 0

for i in friends:
	img = itchat.get_head_img(userName=i["UserName"])
	fileImage = open(user + "/" + str(num) + ".jpg",'wb')
	fileImage.write(img)
	fileImage.close()
	num += 1

pics = listdir(user)

numPic = len(pics)

print(numPic)

eachsize = int(math.sqrt(float(640 * 640) / numPic))

print(eachsize)

numline = int(640 / eachsize)

toImage = Image.new('RGBA', (640, 640))


print(numline)

x = 0
y = 0

for i in pics:
	try:
		#打开图片
		img = Image.open(user + "/" + i)
	except IOError:
		print("Error: 没有找到文件或读取文件失败")
	else:
		#缩小图片
		img = img.resize((eachsize, eachsize), Image.ANTIALIAS)
		#拼接图片
		toImage.paste(img, (x * eachsize, y * eachsize))
		x += 1
		if x == numline:
			x = 0
			y += 1


toImage.save(user + ".jpg")


itchat.send_image(user + ".jpg", 'filehelper')
```
[百度网盘之家](http://wowenda.com/)
[Python编写的文字到语音的转换。](https://pythonprogramminglanguage.com/text-to-speech/)

[微博加密神器](http://resource.haorenao.cn/tse.html)
```js
  <h1>微博加密神器 by 斌叔</h1>
    <h3>使用方法：将想发的内容填入加密。对方查看时到这个网址用同样的钥匙解密。</h3>

    <p>钥匙（记住你的钥匙，解密时需要一个钥匙才能解密）</p>
    <input type="" name="" id="key">
    <p>输入</p>
    <textarea id="input1" cols="50" rows="10"></textarea>
    <br>
    <button id="encode">加密</button> <button id="decode">解密</button>
    <p>输出</p>
    <div id="after">
    </div>
  $("#encode").click(function() {
    var myString   = $('#input1').val().trim();
    var myPassword = $('#key').val().trim();
    console.log(myString);
    console.log(myPassword);

    if (myPassword == "" || myString == "") {
      alert('输入不全！');
      return;
    }

    var encrypted = CryptoJS.AES.encrypt(myString, myPassword);

    $('#after').html(encrypted.toString());
    console.log(encrypted);
  });

    $("#decode").click(function() {
    var myString   = $('#input1').val();
    var myPassword = $('#key').val();
    console.log(myString);
    console.log(myPassword);
        if (myPassword == "" || myString == "") {
      alert('输入不全！');
      return;
    }

    var decrypted = CryptoJS.AES.decrypt(myString,myPassword).toString(CryptoJS.enc.Utf8);

    $('#after').html(decrypted);
    console.log(decrypted);
  });
  
  
```
[给定一个整数数组，其中有两项之和为一个特定的数字，假设每次 input 只有一个唯一解，不允许两次使用同一个元素，返回这两个数的索引。](https://github.com/barretlee/daily-algorithms/issues/1)
```js
给定 nums = [2, 7, 11, 15]，target = 9

由于 nums[0] + nums[1] = 9
所以返回 [0, 1]
const resolveTwoSum = (nums, target) => {
  for (let i = 0; i < nums.length - 1; i++) {
    for (let j = i; j < nums.length; j++) { 
      if (nums[i] + nums[j] === target) {
        return [i,j]; 
      }
    }
  }
}
```
[文字转换器, 将文字转成倒序](http://old.haorenao.cn/reverse/)
```js
$(document).ready(function() {
	$('#reverse').click(function() {
		var text = $('#orig').val();
		var ll = [];
		for (var i = 0;i < text.length;i++) {
			var c = text.charAt(i);
			ll.push(c);
		}
		ll.reverse();
		var s = ll.join("");
		$('#result').val(s);
	});
});
```

