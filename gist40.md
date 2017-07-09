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



