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
