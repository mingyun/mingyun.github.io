[基于laravel5+swagger-php的api接口自动生成系统](http://t.cn/R9bSoWX)
[查询全球所有城市的 API](http://www.bugcode.cn/cities.html)
[ Python 功能和特点](https://www.itcodemonkey.com/article/403.html)
```js
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

