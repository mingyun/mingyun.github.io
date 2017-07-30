[用python爬取qq好友十万条说说并简单进行数据分析](https://zhuanlan.zhihu.com/p/27604277 )
```js
https://github.com/doctorwho77/qq_mood/blob/master/wordcloud/qq_mood.py
import matplotlib.pyplot as plt
from wordcloud import WordCloud,ImageColorGenerator,STOPWORDS
import jieba
import numpy as np
from PIL import Image

#读入背景图片
abel_mask = np.array(Image.open("qq.jpg"))

#读取要生成词云的文件
text_from_file_with_apath = open('mood.txt',encoding='utf-8').read()

#通过jieba分词进行分词并通过空格分隔
wordlist_after_jieba = jieba.cut(text_from_file_with_apath, cut_all = True)
stopwords = {'转载','内容','em','评语','uin','nick'}
seg_list = [i for i in wordlist_after_jieba if i not in stopwords]
wl_space_split = " ".join(seg_list)
#my_wordcloud = WordCloud().generate(wl_space_split) 默认构造函数
my_wordcloud = WordCloud(
            background_color='black',    # 设置背景颜色
            mask = abel_mask,        # 设置背景图片
            max_words = 250,            # 设置最大现实的字数
            stopwords = STOPWORDS,        # 设置停用词
            font_path = 'C:/Windows/fonts/simkai.ttf',# 设置字体格式，如不设置显示不了中文
            max_font_size = 42,            # 设置字体最大值
            random_state = 40,            # 设置有多少种随机生成状态，即有多少种配色方案
                scale=1.5,
            mode='RGBA',
            relative_scaling=0.6
                ).generate(wl_space_split)

# 根据图片生成词云颜色
#image_colors = ImageColorGenerator(abel_mask)
#my_wordcloud.recolor(color_func=image_colors)

# 以下代码显示图片
plt.imshow(my_wordcloud)
plt.axis("off")
plt.show()

my_wordcloud.to_file("cloud.jpg")
```
[从零开始写Python爬虫 --- 爬虫应用： 利用斗鱼Api抓取弹幕](https://zhuanlan.zhihu.com/p/28164017)
```js
import multiprocessing
import socket
import time
import re
import signal

# 构造socket连接，和斗鱼api服务器相连接
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
host = socket.gethostbyname("openbarrage.douyutv.com")
port = 8601
client.connect((host, port))
乘法口诀表https://zhuanlan.zhihu.com/p/28098534?group_id=873230463827841024

for i in range(1,10):
for j in range(1,10):
        result = i * j
        print('%d * %d = % -3d' % (i,j,result))
    print('')
```
[基于laravel5+swagger-php的api接口自动生成系统](http://t.cn/R9bSoWX)
[查询全球所有城市的 API](http://www.bugcode.cn/cities.html)
[【思维导图】Python 编程：核心知识体系](https://zhuanlan.zhihu.com/p/27409997)
https://github.com/woaielf/MindMap_ZY 
[给定 key，能“长期”保存一段字符串](https://www.v2ex.com/t/377521)
比如保存到 notepad.pw 上： https://notepad.pw/n1y638kw https://archive.org/
[递归计算笛卡尔积的方法](https://laravel-china.org/topics/5482/share-a-recursive-calculation-of-cartesian-product)
```js
namespace CarteSian;

class CarteSian
{

    /**
     * Store results
     *
     * @var array
     */
    public $products = [];

    /**
     * Calculate the Cartesian product
     *
     * @param array $params
     * @param array $temporary
     */
    public function carteSian(array $params, array $temporary = [])
    {
        foreach (
            array_shift($params) as $param
        ) {
            array_push($temporary, $param);
            $params ? $this->carteSian(
                $params, $temporary
            ) : array_push(
                $this->products, $temporary
            );
            array_pop($temporary);
        }
    }
}
 

$cartSian = new CarteSian();

$params = [
   'Girls' => [
       '雾岛董香',
       '艾米莉娅',
       '结城明日奈',
   ],
   'Boys' => [
       '金木研',
       '菜月昴',
       '桐谷和人',
   ],
   'Hentais' => [
       '华城绫女',
       '培提尔其乌斯·罗马尼空提',
       '月山习',
   ]
];

$cartSian->carteSian($params);

print_r($cartSian->products);
```
[curl 和 for 循环怎么更好的使用？curl 是同步执行？](https://laravel-china.org/topics/5297/how-can-the-curl-and-for-loops-be-used-better-curl-is-synchronous-execution)
```js
//如果不设置sleep(1)就会返回$res为null
for ($i=1; $i<=200; $i++) {
         $getAddr = User::findOrFail($i)->getAddresses()->where('type', 'b')->first()->address;
         $res = json_decode($curl->get($api. $getAddr)->response);
         var_dump($res);
 }
```
[生成随机序列的算法[(https://laravel-china.org/articles/5453/share-an-algorithm-for-generating-random-sequences)
```js
function getRandomList(arr) {
    let maxWeight = 10 * arr.length; //减小重复概率 给数组里面每个元素加上随机的权重，然后根据权重排序。
    let list = [];
    for(let i in arr) {
        list.push({
            weight: Math.ceil(maxWeight * Math.random()),
            value: arr[i]
        });
    }
    list.sort(function(a, b) {
        return a.weight > b.weight;
    });

    let ans = [];
    for(let i in list) {
        ans.push(list[i].value);
    }
    return ans;
}
```
[ Python 功能和特点](https://www.itcodemonkey.com/article/403.html)
```js
Python 计算阶乘
from functools import * 
fac = lambda n:reduce(lambda x,y:x*y,range(1,n+1))  
from operator import mul 

fac = lambda x: reduce(mul, range(1, x + 1))
import math 
math.factorial(x)//120


files = glob.glob('*.py')
result = uuid.uuid1()
import itertools as it, glob, os
 
def multiple_file_types(*patterns):
    return it.chain.from_iterable(glob.glob(pattern) for pattern in patterns)
 
for filename in multiple_file_types("*.txt", "*.py"): # add as many filetype arguements
    realpath = os.path.realpath(filename)
    print realpath
 
# output
#=========#
# C:\xxx\pyfunc\test.txt
# C:\xxx\pyfunc\arg.py
# C:\xxx\pyfunc\g.py
# C:\xxx\pyfunc\shut.py
# C:\xxx\pyfunc\test.py
《中学生编程》http://red-lang.qiniudn.com/doc/v063/%E4%B8%AD%E5%AD%A6%E7%94%9F%E7%BC%96%E7%A8%8B.pdf 
安利一个Gif在线制作工具http://www.soogif.com/crop https://github.com/red/red
 一个docker的图形化管理界面 各类Json格式的免费api收集https://github.com/toddmotto/public-apis
intitle: php 程序员的算法趣题http://www.ituring.com.cn/book/tupubarticle/16800
Vue.js小书http://www.ituring.com.cn/book/tupubarticle/12949
Learn regex the easy wayhttps://github.com/zeeshanu/learn-regex
vim /etc/ssh/sshd_config Port 2222
PHP程序员也能参与的MySQL中间件项目https://github.com/swoole/mysql-proxy
《网络安全从入门到入狱》https://pan.baidu.com/share/init?shareid=1149290362&uk=2634506822 fvgm  01编程
收集了近500个互联网上公开的数据集https://github.com/caesar0301/awesome-public-datasets
正则表达式系列总结https://zhuanlan.zhihu.com/p/27653434
对一行神奇js代码的解析http://geek.csdn.net/news/detail/218601
ZeroNet：一个基于区块链的深网https://zhuanlan.zhihu.com/p/28026567
收集了各类编程语言中git需要忽略的那些文件https://github.com/github/gitignore https://www.gitignore.io/ 根据github账号来自动生成一份简历https://resume.github.io/
《机器学习基石》https://www.bilibili.com/video/av12469267/
https://github.com/RedisLabsModules/RediSearch
https://github.com/ksky521/nodeppt alter table t1 convert to character set utf8mb4;
看图识动漫https://whatanime.ga/# 

百度云资源搜索  biliworld
win: type a.avi b.avi c.avi>d.avi 
linux: cat a.avi b.avi c.avi>d.avi ffmpeg 几行代码就可以了吧http://www.cnblogs.com/jameszh/p/5547525.html
$b = str_replace(['.','-'], ['%2E','%2D'], $b); <img src="" onerror="alert(/Hello from v2ex/)">admin 
说 python 比 php 性能差的可以参考下 
https://www.techempower.com/benchmarks/ 
这里的各种 benchmark 英语学习 https://github.com/byoungd/english-level-up-tips-for-Chinese
有时候磁盘空间还有剩余，却不能新建文件时，请检查 inode 是否耗尽
print(sum(range(101))) 
from functools import reduce 
sum = reduce(lambda a,b: a + b, range(100))
javascript:void(function(){if(location.hostname.indexOf("google")){var keyword = document.getElementsByName("q")[0].value;if(location.href.indexOf("zh-CN")<0){location.href = "https://www.google.com/?&q=#q=" + keyword + "&lr=lang_zh-CN%7Clang_zh-TW";}else{location.href = "https://www.google.com/?&q=#q=" + keyword}}})()
在 if 前面 var_dump(floatval()) 看看这两个变量对比的时候是多少 比较的时候乘 100 按整数比吧 什么情况下 5.590 小于 5.59 floor(8.29 * 100 * 100 / 100) 
js 的话用 https://prettier.github.io/prettier/ 
自动帮你格式化源码，大家按自己的习惯写，git commit 的时候通过 hook 用 prettier 转换一下
PHP 来说，有 php-cs-fixer 这类的命令行工具，无论用什么 Editor 或 IDE 都行。
https://laravel-china.org/topics/547/use-php-cs-fixer-to-automatically-standardize-your-php-code  偶然发现一个网站介绍了所有的 unicode 码，里面非常多好玩的符号 
http://graphemica.com/unicode/characters/page/13  https://github.com/thefantasystudio/easypay https://www.zybuluo.com/mdeditor
校内网 www.xiaonei.com  要满足加薪，需要两个条件 
1： 你是否值得 
2： 公司是否有钱  https://zhuangbi.me/ http://www.jianshu.com/p/ed3fe9f5badd
https://github.com/nowgoo/dict 一个简单快速的词库 
从微信采集的文章https://www.worthfo.com/w/8936/ 被公司辞退了，能拿多少钱https://zhuanlan.zhihu.com/p/28039132 
https://geek.getrelink.com/ 微信公众号文章收集
https://github.com/youngwind/blog 免费SHADOWSOCKS http://trial.ssbit.win/?from=ruanyifeng
学堂在线的，http://www.xuetangx.com/courses/course-v1:ustcX+USTC001+2017_T2/about
http://0.30000000000000004.com/
html5+PHP 手机端上传头像图片剪切源码 演示下载地址： http://www.sucaihuo.com/php/2228.html
微信号「一分钟的编程知识」http://tool.lu/crontab/   wordpress 导入公众号文章的插件 beepress
https://avgle.github.io/doc/ av视频接口
机器学习 
有现成的 API 接口，做个客户端收费功能 Swoole Compiler 已就绪，最佳 PHP 代码编译加密解决方案
渗透测试人员的Python工具箱https://www.ctolib.com/cheatsheets-python_sectool.html
https://github.com/NARKOZ/hacker-scripts  一个集在线录屏、剪辑视（音）频、转换视（音）频格式于一身的网站https://www.apowersoft.cn/free-online-screen-recorder
https://github.com/anujshah1003/own_data_cnn_implementation_keras 教你怎么换自己的数据训练  Keras 的中文手册https://keras-cn.readthedocs.io/en/latest/ https://www.bilibili.com/video/av12347418/
先去github issue上面搜，没有的话再去stackoverflow上搜，还是没有的话就回去提issue了
phpwebshell https://github.com/dotcppfile/DAws
机器学习相关教程 https://morvanzhou.github.io/tutorials
微信公众号 北哥兄弟连。http://nai8.me/

```
[一个获取百度网盘直接下载链接的小工具](https://github.com/Kyle-Kyle/baidudl)
[php最好的异步实现方法](https://yq.aliyun.com/articles/83265?utm_campaign=wenzhang&utm_medium=article&utm_source=QQ-qun&2017519&utm_content=m_21446)
```js
/**
 * User: layne.xfl
 * Date: 2017/5/12
 * Time: 下午01:24
 */
class Arrow{

    static $instance;

    /**
     * @return static
     */
    public static function getInstance(){
        if (null == Arrow::$instance)
            Arrow::$instance = new Arrow();
        return Arrow::$instance;
    }

    public function run($rb){

        $pid = pcntl_fork();
        if($pid > 0){
            pcntl_wait($status);
        }elseif($pid == 0){
            $cid = pcntl_fork();
            if($cid > 0){
                //这里放空
            }elseif($cid == 0){
                $rb();
            }else{
                exit();
            }
        }else
        {
           exit();
        }

    }
}
//离弦之箭---调用方法
$time_out = 30;
Arrow::getInstance()->run(function() use ($time_out){
    //这里写我们要执行的代码
    sleep($time_out);
});
```
[程序员必知的 Python 陷阱与缺陷列表](http://python.jobbole.com/88045/)
```js
>>> import time
 
>>> def report(when=time.time()):
 
... return when
 
...
 
>>> report()
 
1500113234.487932
 
>>> report()
 
1500113234.487932
>>> def report(when=None):
 
...  if when is None:
 
...  when = time.time()
 
... return when
 
...
 
>>> report()
 
1500113446.746997
 
>>> report()
 
1500113448.552873
>>> type(())
 
<type 'tuple'>
>>> a=(1)
 
>>> type(a)
 
<type 'int'>
>>> a=(1,)
 
>>> type(a)
 
<type 'tuple'>
>>> a= [[]] * 10
 
>>> a
 
[[], [], [], [], [], [], [], [], [], []]
 
>>> a[0].append(10)
 
>>> a[0]
 
[10]
>>> a
 
[[10], [10], [10], [10], [10], [10], [10], [10], [10], [10]]
>>> a = [[] for _ in xrange(10)]
 
>>> a[0].append(10)
 
>>> a
 
[[10], [], [], [], [], [], [], [], [], []]
在访问列表的时候，修改列表
def modify_lst(lst):
 
... for idx, elem in enumerate(lst):
 
... if elem % 3 == 0:
 
... del lst[idx]
把书的彩色封面图像转为灰度图像并显示出来：

from PIL import Image
pil_im = Image.open('cover.png').convert('L')
pil_im.show()
```
[带你制作高逼格的数据聚合云图](https://github.com/forezp/ZhihuSpiderMan/tree/master/blogspider)
``js
import jieba.analyse
from bs4 import BeautifulSoup
import requests
import re
url = 'http://blog.csdn.net/forezp'
titles=set()

def download(url):
    if url is None:
        return None
    try:
        response = requests.get(url, headers={
            'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
        })
        if (response.status_code == 200):
            return response.content
        return None
    except:
        return None

def parse_title(html):
    if html is None:
        return None
    soup = BeautifulSoup(html, "html.parser")
    links = soup.find_all('a', href=re.compile(r'/forezp/article/details'))
    for link in links:
        titles.add(link.get_text())


def parse_descrtion(html):
    if html is None:
        return None
    soup=BeautifulSoup(html, "html.parser")
    disciptions=soup.find_all('div',attrs={'class': 'article_description'})
    for link in disciptions:
        titles.add(link.get_text())


def jiebaSet():
    strs=''
    if titles.__len__()==0:
        return
    for item in titles:
        strs=strs+item;


    tags = jieba.analyse.extract_tags(strs, topK=100, withWeight=True)
    for item in tags:
        print(item[0] + '\t' + str(int(item[1] * 1000)))

def main():
   html= download(url)
   # parse_title(html)
   parse_descrtion(html)
   jiebaSet()

Building prefix dict from the default dictionary ...
Dumping model to file cache C:\Users\ADMINI~1\AppData\Local\Temp\jieba.cache
Loading model cost 1.782 seconds.
Prefix dict has been built succesfully.
...     291
springboot      205
工程    155
spring  119
Eureka  119
开源    108
服务    107
web     102
创建    99
客户端  96
分布式系统      94
if __name__ == '__main__':
    main()
制作云图： 用 artword在线工具，地址：https://wordart.com
```

[php webshell](https://github.com/tanjiti/webshellSample/blob/master/PHP/dama/DAws.php)
[一个故事讲完https](https://mp.weixin.qq.com/s?__biz=MzAxOTc0NzExNg==&mid=2665513779&idx=1&sn=a1de58690ad4f95111e013254a026ca2)
对称加密算法， 因为加密和解密用的是同一个密钥  RSA的非对称加密算法 用私钥加密的数据，只有对应的公钥才能解密，用公钥加密的数据， 只有对应的私钥才能解密。
[对一行神奇js代码的解析](http://geek.csdn.net/news/detail/218601)
```js
<pre id=p><script>n=setInterval("for(n+=7,i=k,P='p.\\n';i-=1/k;P+=P[i%2?(i%2*j-j+n/k^j)&1:2])j=k/i;p.innerHTML=P",k=64)</script>
```
[常见排序算法](http://blog.githuber.cn/posts/1738)
http://bubkoo.com/2014/01/12/sort-algorithm/bubble-sort/
[xssfork - 新一代 xss 探测工具](http://paper.seebug.org/359/)
[笛卡尔乘积](https://www.v2ex.com/t/378599#reply7)
```js
from itertools import product 

>>> list(product(['Red','Black','White'], ['64G','128G'], ['USB','Type-C']))
[('Red', '64G', 'USB'), ('Red', '64G', 'Type-C'), ('Red', '128G', 'USB'), ('Red'
, '128G', 'Type-C'), ('Black', '64G', 'USB'), ('Black', '64G', 'Type-C'), ('Blac
k', '128G', 'USB'), ('Black', '128G', 'Type-C'), ('White', '64G', 'USB'), ('Whit
e', '64G', 'Type-C'), ('White', '128G', 'USB'), ('White', '128G', 'Type-C')]
```
[PHP 什么情况下 5.590 小于 5.59](https://www.v2ex.com/t/378136)
```js
floatval(5.590) < floatval(5.59)
比较的时候乘 100 按整数比吧
php > var_dump(floatval(5.590) < floatval(5.59)); 
php shell code:1: 
bool(false) 
php > var_dump(floatval(5.590) == floatval(5.59)); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 == 5.59); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 < 5.59); 
php shell code:1: 
bool(false) 
1、从数据库里面查询出来的浮点数，请使用 string。 
2、http://php.net/manual/en/book.bc.php 
3、个人癖好，有段时间，金钱我用 int 来存储，单位是分。不过现在都用 string 来做了。
 floor(8.29 * 100 * 100 / 100) //828
if (fabs(a - b) > 1e-3 && a < b)
写个专门运算的函数，全部乘以 100 之后运算，把结果再除以 100 返回，可以参考微信支付的做法 http://de2.php.net/manual/en/ref.bc.php
```
[AJAX 跨域请求](https://www.v2ex.com/t/378681)
```js
后来发现前端使用 CORS 请求时content-type取值为application/json; charset=utf-8，也就是说发送跨域请求时会发送 OPTIONS 预检请求，而我没有对设置 OPTIONS 路由
app.all('*',function (req, res, next) {
	res.header('Access-Control-Allow-Origin', '*');
	res.header('Access-Control-Allow-Headers', 'Content-Type, Content-Length, Authorization, Accept, X-Requested-With , yourHeaderFeild');
	res.header('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, OPTIONS');

	if (req.method == 'OPTIONS') {
	   console.log('you can do that!!');
	   res.send(200); // 让 options 请求快速返回
	} else {
		next();
	}
});
```

