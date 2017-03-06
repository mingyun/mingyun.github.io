###[php isset和empty用于处理变量是否设置或者设置了是否为空。](https://www.v2ex.com/t/79807)
http://php.net/manual/en/aliases.php

parse_str 使用 传入参数来获取返回值，常用的函数中真独特

Python 是强类型的，比如： 

a = 1 # 变量 a 的值是一个整数 
b = '2' # 变量 b 的值是一个字符串 
a + b # 这里会报错 

而 PHP、Javascript 这些则不然，比如 Javascript 的 1 + '2' 的计算结果似乎是字符串 '12'，PHP 的 1 + '2' 的结果好像是整数 3。
php7可以指定类型
###[对设计模式的极简说明](https://github.com/questionlin/design-patterns-for-humans)
###[PHP 完整实战 23 种设计模式](https://www.v2ex.com/t/327657)
```js

面向对象的目标

高内聚，低耦合
面向对象设计的基本原则

单一职责：一个类只做一件事
开闭原则：对扩展开放对修改关闭
里氏替换：子类必须能替换所有父类的使用
依赖倒置：设计依赖于抽象而不是实现
最少知识：对象应当尽可能少的去了解其他对象
接口隔离：接口倾向于小而多
组合优先：优先使用类的组合而不是继承
抽象类和接口的使用

当类中有共同的行为或属性时,可以考虑使用 abstract calss
当类别中有共同的操作界面,但是在实现上有所差别,可以考虑使用 interface
```
###[现代化高性能 PHP 开发](https://www.v2ex.com/t/296145)
```
命名空间 psr composer php7性能 
https://blog.tanteng.me/2016/09/modern-php/ 
命名空间好比操作系统中的目录，两个同名的文件可以共存在不同的目录下。同理两个同名的 PHP 类可以在不同的 PHP 命名空间下共存，就这么简单。
自动加载规范非常重要，PHP 组件都遵循自动加载规范，才能通过 Composer 进行管理。
https://oddgb63aa.qnssl.com/uploads/2016/08/modern-php.pdf  
 apc opcache
1.PSR 规范 
曾经的乱象：什么.inc.php,class.php,大驼峰小驼峰等语法规范上的乱象 
出现后解决了什么问题 
PS:可以在讲 PSR4 的时候讲下 PSR0 ，然后一笔带过命名空间 
2.组件化 
解决了什么问题 
然后引入包管理器 
3.包管理器 Composer 
与 PEAR 的区别 
与其它语言的包管理,例如 pip,gem,npm 的比较，可以借鉴什么 
4.PHP 语法新特性 
语法糖 
面向对象特性上(trait) 
性能上(yield) 
5.现代框架的出现 
Yii,symfony,Laravel 为 phper 们带来了开发速度上的提升 
- -Ioc 容器？ 
Swoole 在性能上的突破 
6.PHP7 以及对 PHP 未来的展望
什么规范，都解决不了 in_array ， array_key_exists ， array_map ， array_filter 这些混乱的命名，混乱的参数位置。
在一个大型应用中，往往要用到好多种语言，就拿 PHP 来说，前期项目用它作为后端服务都没问题，但是随着并发量大了，可能部分需要 java 来实现，做成服务化接口， PHP 来调用， PHP 的灵活和开发效率是他的优势，而很多情况，一个完整的系统还包含 python 的脚本在运行， Redis 做缓存，我们的项目还用到 lua ，数据库一般都是 MySQL ，后端服务是 java ，还可能是 C++，前端还有 js 工程师支持，这才是一个完整的项目它包含各种语言。 

在大的互联网公司， PHP 是属于前端，这个前端就是广义的前端了，比如页面，还有后台系统，都是 PHP 做，后端指的是服务接口，可能是 python ，或者 lua ，总之是 HTTP 协议的，给 PHP 调用实现功能。

从性能角度说， C ， C++， JAVA 编译型语言，肯定比 PHP 快得多，而 WEB 开发本身不需要太高的性能，注重性能的用其他技术做，比如 Redis ，调服务接口等等， PHP 注重业务逻辑处理，开发效率快。  php糟糕特性 
```
###[Go 搭建 WebSocket 服务端例子](https://blog.tanteng.me/2017/02/go-websocket-demo/#more-11301)
```js
 
import (
	"fmt"
	"log"
	"net/http"
 
	"golang.org/x/net/websocket"
)
 
func Echo(ws *websocket.Conn) {
	var err error
 
	for {
		var reply string
 
		if err = websocket.Message.Receive(ws, &reply); err != nil {
			fmt.Println("Can't receive")
			break
		}
 
		fmt.Println("Received back from client: " + reply)
 
		msg := "Received:  " + reply
		fmt.Println("Sending to client: " + msg)
 
		if err = websocket.Message.Send(ws, msg); err != nil {
			fmt.Println("Can't send")
			break
		}
	}
}
 
func main() {
	http.Handle("/", websocket.Handler(Echo))
 
	if err := http.ListenAndServe(":1234", nil); err != nil {
		log.Fatal("ListenAndServe:", err)
	}
}
var wsServer = 'ws://localhost:1234';
var websocket = new WebSocket(wsServer);
websocket.onopen = function (evt) {
    console.log("Connected to WebSocket server.");
};
 
websocket.onclose = function (evt) {
    console.log("Disconnected");
};
 
websocket.onmessage = function (evt) {
    console.log('Retrieved data from server: ' + evt.data);
};
 
websocket.onerror = function (evt, e) {
    console.log('Error occured: ' + evt.data);
};
```
###[纯git pull然后同步到其他机器](https://www.v2ex.com/t/196046)
```js
ansible http://docs.ansible.com/index.html  Ansible + Ansible Docker module
Capistrano + 1 

个人项目没所谓，公司项目用ftp一旦出问题回滚不方便
即使我是一个人做再小的项目，也是用 git hook，本地一个 push 服务器就自动部署了。于是每次新建项目都要先配置好自动部署环境，所以写了这个工具，欢迎 star： 

https://github.com/mytharcher/hookagent

[desktop] 

git commit, push 


[server] 

-- deploy.sh -- 
#!/bin/bash 

echo -e "\033[31mPulling source...\033[0m" 
cd /env_name/src/app_name 
git pull 

echo -e "\033[31mBuilding...\033[0m" 
composer install 

echo -e "\033[31mDeploy complete.\033[0m"

Walle-瓦力，一个 web 部署系统工具，可能也是个持续发布工具，配置简单、功能完善、界面流畅、开箱即用！ 

支持 git 、 svn 版本管理，支持各种 web 代码发布，静态的 HTML ，动态 PHP ，需要编译的 JAVA 等

github 项目地址： https://github.com/meolu/walle-web ，官方主页介绍： http://www.huamanshu.com/walle.html
```
###[排行榜实战](https://segmentfault.com/a/1190000008475712)
```js

$redis->connect('127.0.0.1', 6379);
$strKey = 'Test_bihu_score';

//存储数据
$redis->zadd($strKey, '50', json_encode(['name' => 'Tom']));
$redis->zadd($strKey, '70', json_encode(['name' => 'John']));
$redis->zadd($strKey, '90', json_encode(['name' => 'Jerry']));
$redis->zadd($strKey, '30', json_encode(['name' => 'Job']));
$redis->zadd($strKey, '100', json_encode(['name' => 'LiMing']));

$dataOne = $redis->ZREVRANGE($strKey, 0, -1, true);
echo "---- {$strKey}由大到小的排序 ---- <br /><br />";
print_r($dataOne);

$dataTwo = $redis->ZRANGE($strKey, 0, -1, true);
echo "<br /><br />---- {$strKey}由小到大的排序 ---- <br /><br />";
print_r($dataTwo);
```



###[扛住100亿次请求？我们来试一试](https://github.com/xiaojiaqi/10billionhongbaos/wiki/%E6%89%9B%E4%BD%8F100%E4%BA%BF%E6%AC%A1%E8%AF%B7%E6%B1%82%EF%BC%9F%E6%88%91%E4%BB%AC%E6%9D%A5%E8%AF%95%E4%B8%80%E8%AF%95)
###[收集在学习和提高技术过程中遇到的比较有价值的网站、文档、Blog等，方便自己查阅。](https://github.com/china-kook/Skill-learn-collect)
###[Git 工作流的一些经验分享](http://www.jianshu.com/p/ca5ee4ea6420)
###[全面了解Nginx主要应用场景](http://www.raye.wang/2017/02/24/quan-mian-liao-jie-nginxdao-di-neng-zuo-shi-yao/)
###[米斯特白帽培训讲义（v2）漏洞篇 弱口令、爆破、遍历](http://blog.csdn.net/wizardforcel/article/details/56678797)
###[写给后端看的前端技术——webpack（上）](https://mp.weixin.qq.com/s?__biz=MzIxMjAzMDA1MQ%3D%3D&mid=2648945804&idx=1&sn=602698b6937004f3c2cad0a634ca5cf0&chksm=8f5b5380b82cda96c0c2d7a7f15d51af728f66a267391b14b531b9090f7e71f071e15b6debf3)
https://github.com/xrr2016/vue-express-mongodb/blob/master/README.md  
###[前端基础进阶（七）：函数与函数式编程](http://www.jianshu.com/p/69dede6f7e5f)
基于Laravel的API服务端架构代码https://segmentfault.com/a/1190000006178269 
https://segmentfault.com/r/1250000008408446?shareId=1210000008408447 
http://blog.csdn.net/qq_35246620/article/details/54317740?ref=myread  
https://rdnote.cn/archives.html
https://ipfans.github.io/2017/02/analyzing-pronto-cycleshare-data-with-python-and-pandas/ 
http://blog.yubangweb.com/ni-zhen-de-dong-redisma/ 
https://coyee.com/article/11939-mysql-when-not-in-is-not-equal-to-not-exists 
http://blog.shanamaid.top/2017/02/14/200%E8%A1%8C%E4%BB%A3%E7%A0%81%E5%AE%9E%E7%8E%B0web%E5%9C%A8%E7%BA%BF%E8%81%8A%E5%A4%A9%E5%AE%A4/
http://magicly.me/2017/03/03/word2vec-first-try-md/  
Redis的内存优化https://cachecloud.github.io/2017/02/16/Redis%E5%86%85%E5%AD%98%E4%BC%98%E5%8C%96/ 
https://qiaohong.org/2017/02/21/%E7%88%AC%E8%99%AB%E6%8E%92%E9%99%A4%E5%8D%8F%E8%AE%AE-robots-txt/ 
http://www.jianshu.com/u/4664d9570527   https://aotu.io/notes/2016/03/16/optimization/ 
https://mp.weixin.qq.com/s?__biz=MzIyMjUyNTkyNQ==&mid=2247484229&idx=1&sn=e537799c50251c8c5af5bce934f69e41&chksm=e82d63cfdf5aead9dd9a6dc8751cc7113fe536aff97788d0a2cf953510b2f6fdb7a2c9d87a3f&mpshare=1&scene=1&srcid=0221uPj1ObVWZaZ3EWyXxPY8&key=1421ccb947cab700ccf26f82e6cc80a1082411e2caa00a1d543e7de6420cf2d2c0d5d33b03fadf546567e38aeac8ec40cd2e0c8b0b9f3de092079bab3fedb195ef82cdab9443e22bd85b7fbda1949ed5&ascene=0&uin=MTg0OTA4MjAw&devicetype=iMac+MacBookPro8%2C1+OSX+OSX+10.10.3+build(14D131)&version=11020201&pas  逆天了word 90后：情人节巧用小小技术就俘获了女神 
###[WEB前端知识总结](https://zhuanlan.zhihu.com/p/25334672)
https://github.com/alcat2008/front-end-study-guide 
###[一个循环遍历逻辑问题](https://segmentfault.com/q/1010000008523335)
```js
function demo($a=null,$b=null)
    {
        $result = array();
        for ($i=$a[0]; $i<=$a[1]; $i++) {
            foreach ($b as $b_key => $b_value) {
                $result[$i][$b_value] = $i / $b_value;  //假设b中所有都能整除 , 先把值存起来
                if ($i % $b_value != 0) {
                    unset($result[$i]); // 一旦b中有一个数字不满足, 例如 1000 / 7 , 那就跳出循环, 移除 $result['1000']
                    break;
                }
            }
        }
        return $result;
    }
    print_r(demo([1000,1600],[4,5,6]));
```
###[Laravel 5.3入门](http://www.jianshu.com/p/6719e9424088)
###[从++[[]][+[]]+[+[]]==10?深入浅出弱类型JS的隐式转换 ](https://github.com/jawil/blog/issues/5)
###[一天一算法 – 快速排序](http://hwaphon.site/?p=287)
###[SELECT … FOR UPDATE如何影响INNODB的锁级别](https://github.com/wing324/helloworld_zh/blob/master/MySQL/SELECT%20%E2%80%A6%20FOR%20UPDATE%E5%A6%82%E4%BD%95%E5%BD%B1%E5%93%8DINNODB%E7%9A%84%E9%94%81%E7%BA%A7%E5%88%AB.md)
WHERE条件使用主键，SELECT ... FOR UPDATE为行级锁；
WHERE条件使用唯一索引，SELECT ... FOR UPDATE为行级锁；
WHERE条件使用普通索引，SELECT ... FOR UPDATE为行级锁；
WHERE条件使用联合索引的前缀索引，SELECT ... FOR UPDATE为行级锁；
WHERE条件不使用索引，SELECT ... FOR UPDATE为表级锁；
即：WHERE条件能使用索引时，SELECT ... FOR UPDATE表现为行级锁；WHERE条件不使用索引，SELECT ... FOR UPDATE表现为表级锁；
###[Linux系统安全需要注意的一些问题](http://www.cnblogs.com/chenpingzhao/p/6443354.html)
###[PHP程序员玩转Linux系列-备份还原MySQL](http://www.cnblogs.com/taoshihan/p/6437468.html)
###[解析 Nginx 负载均衡](http://mp.weixin.qq.com/s/egSpuYxKml_1xyFqoTqSjg)
###[Redis常见7种使用场景(PHP实战)](https://segmentfault.com/a/1190000008475712)
###[套公式让你不再害怕JavaScript中的原型链](http://www.jianshu.com/p/a81692ad5b5d)
###[教你撸一个网页聊天室](http://kyrieliu.cn/huno/2016/11/27/chatting-room/)

###[PHP导出报表(案例)](https://segmentfault.com/a/1190000008133820)
```js
public function export()
{

    //获取2016年日期
    $time_start = strtotime('2016-01-01');
    $time_end   = strtotime('2016-12-31');

    $month_arr = [];
    $month_arr['month'][]   = '2016-01';
    $month_arr['numbers'][] = date(t,$time_start); //获取天数

    while (($time_start = strtotime('+1 month', $time_start)) <= $time_end) {
        $month_arr['month'][]   = date('Y-m',$time_start); //取得递增月
        $month_arr['numbers'][] = date(t,$time_start);     //获取天数
    }

    function check_week($time = [])
    {
        if (empty($time['day'])) {
            return '';
        }
        $w = intval(date('w' , strtotime($time['day'])));
        if( $w === 0 || $w === 6){
            return '<td style="background-color: red;">'.date('d', strtotime($time['day'])).'</td>';
        }
        return '<td>'.date('d', strtotime($time['day'])).'</td>';
    }

    //向模板中注册一个函数
    $this->smarty->registerPlugin('function','check_week','check_week');

    //模拟数据如下：
    $list[0]['name'] = 'Tom';
    $list[1]['name'] = 'Joan';

    $list[0]['sex'] = '男';
    $list[1]['sex'] = '女';

    $list[0]['age'] = '30';
    $list[1]['age'] = '31';

    //设置迟到
    $list[0]['late'] = [
        '2016-01-08',
        '2016-01-09',
        '2016-02-09',
        '2016-03-09',
        '2016-04-09',
        '2016-05-09'
    ];

    $list[1]['late'] = [
        '2016-02-12',
        '2016-03-15',
        '2016-04-13',
        '2016-05-19',
        '2016-05-19'
    ];

    //设置早退
    $list[0]['leave'] = [
        '2016-03-09',
        '2016-04-11',
        '2016-05-15',
        '2016-06-18',
        '2016-07-21',
        '2016-08-23',
        '2016-09-22',
        '2016-10-20',
        '2016-11-17',
        '2016-12-14',
    ];
    $list[1]['leave'] = [
        '2016-05-09',
        '2016-06-11',
        '2016-07-13',
        '2016-08-15',
        '2016-09-17',
        '2016-10-19',
        '2016-11-20',
        '2016-12-23',
        '2016-03-18',
        '2016-02-19',
        '2016-01-23',
    ];

    $file_name   = "报表-".date("YmdHis",time());
    $file_suffix = "xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file_name.$file_suffix");
    $this->_assign('list', $list);
    $this->_assign('month', $month_arr);
    $this->_display();
}
```
###[phpDocumentor的代码分析工具]( https://phpdoc.org/)


###[探索PHP与Vue通用直出模板方案](http://blog.krimeshu.com/2017/02/13/vue-php-template-convertor/)
###[程序猿必读-防范CSRF跨站请求伪造](https://segmentfault.com/a/1190000008505616)
###[图例详解那道setTimeout与循环闭包的经典面试题](http://www.jianshu.com/p/9b4a54a98660)
###[教你破解隔壁妹子的wifi密码](http://www.imlifengfeng.com/blog/?utm_source=gank.io&utm_medium=email&p=15)

###[对设计模式的极简说明](https://github.com/questionlin/design-patterns-for-humans)
###[HTTP API网关选择之一Kong介绍](http://mp.weixin.qq.com/s/LIq2CiXJQmmjBC0yvYLY5A)

###[【建议收藏】黑客基础必学命令行！](https://zhuanlan.zhihu.com/p/22900743)
###[挖 "掘" 淘 "金" 之 前端闯关历险记学习资料汇总](https://github.com/jawil/blog/issues/4)
###[优雅的php短信发送库](https://github.com/toplan/phpsms)
###[Git Cheat Sheet](https://github.com/shfshanyue/cheat-sheets/blob/master/docs/git.md)
###[理解 TCP 和 UDP](https://github.com/JerryC8080/understand-tcp-udp)
###[密码技术那些事儿](http://www.jianshu.com/p/8d7c8f59ea21)
###[HTTP长连接？短连接？长轮询？短轮询？](http://www.jianshu.com/p/00daa2d84266)
###[less](https://github.com/holidaying/less-demo)
###[大话程序猿眼里的高并发之续篇](https://blog.thankbabe.com/2017/02/27/high-concurrency-scheme-xp/)
###[使用Redis存储用户粉丝](https://segmentfault.com/q/1010000008547001)
假设当前用户ID为1;

首先：依靠有序集合实现好友关系（对应的score就是关注时间戳）,假设与用户ID：2，3，4为好友

其次：使用hash去记录好友的具体信息（多个hash），存储规则如下：

# 存储规则如下
user:uid:fans:fuid:info  #user:用户ID:fans:好友ID:info

# 那对应2，3，4的三个hash存储，就是
user:1:fans:2:info
user:1:fans:3:info
user:1:fans:4:info
###[mysql和redis效率问题](https://segmentfault.com/q/1010000008553704)
```js
<?php 
$redis = new redis();
$redis->connect('127.0.0.1', 6379);
for ($i=0; $i <100 ; $i++) { 
    $redis->lpush('test',rand(1000,9999));
}
var_dump($redis->lrange('test', 0, 99));
$redis->delete('test');
$redis->close();
die;
 ?>
=================================
<?php 
$host = 'mysql:host=127.0.0.1;dbname=test';
$user = 'root';
$pass = 'root';
$pdo = new PDO($host, $user, $pass);
for ($i=0; $i < 100 ; $i++) { 
    $pdo->query('insert into abc (title) values( title = '.rand(1000,9999).')');
}
var_dump($pdo->query('select * from abc')->fetch());
$pdo->query('truncate table abc');
die;
 ?>
 ab -n10000 -c10000 http://localhost/test.php
 不管是Redis还是MySQL，创建连接的消耗都是不可忽视的。具体到你贴的代码，场景1下，连接都重复创建了10000次，时间主要都花在创建连接上了，执行命令的时间相比而言是次要的；场景2下，都只创建了一次连接，那么对比的主要就是各自执行命令的速度了，Redis完胜是必然的。
 果Redis采用pipeline模式来发送命令，Redis的优势会更大。
```

###[从零开始 Python 微信公众号开发](https://zhuanlan.zhihu.com/p/25561176?group_id=821373794957545472)
http://link.zhihu.com/?target=https%3A//github.com/loveQt/wxpytest
###[前端开发者应知必会：浏览器是如何渲染网页的](https://zhuanlan.zhihu.com/p/25554352?group_id=821150779464372224)
###[win7下python2和python3共存问题](https://zhuanlan.zhihu.com/p/25544755?group_id=821018977596735488)
python2 -m pip install package
python3 -m pip install package
###[根据指定坐标来找出指定距离内的其他坐标](https://segmentfault.com/q/1010000008537516)
```js
GeoHash，Redis直接支持，快速存储和查询都搞定了，最高0.5%的错误率。

插入用户的坐标：

GEOADD users 13.361389 38.115556 user1
GEOADD users 13.361389 38.115566 user2
...
查里user1半径500米的用户：

GEORADIUSBYMEMBER users user1 500 m
更好的是GEORADIUSBYMEMBER加WITHDIST还能得到用户间距离
 * 根据一个给定经纬度的点，进行附近地点查询
 * 获取周围坐标
 * @param double $lng
 * @param double $lat
 * @param real $distance
 * @return multitype:multitype:number
 */
public function returnSquarePoint($lng, $lat,$distance = 0.5)
{
    $earthRadius = 6378138;
    $dlng =  2 * asin(sin($distance / (2 * $earthRadius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);
    $dlat = $distance/$earthRadius;
    $dlat = rad2deg($dlat);
    return array(
        'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
        'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
        'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
        'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
    );
}

传个坐标进去范围范围
$wherefind['lat']['between']=array($around['right-bottom']['lat'],$around['left-top']['lat']);
                        $wherefind['lng']['between']=array($around['left-top']['lng'],$around['right-bottom']['lng']);
                        然后用范围搜索就可以了
```
###[分享离线版维基百科](https://zhuanlan.zhihu.com/p/25410565)
https://link.zhihu.com/?target=http%3A//www.mirrorservice.org/sites/download.kiwix.org/portable/wikipedia/kiwix-0.9%2Bwikipedia_zh_all_2017-01.zip  From微信公众号：wnsouba
###[自定义百度网盘分享密码](https://zhuanlan.zhihu.com/p/25518128)
require(["function-widget-1:share/util/service/createLinkShare.js"]).prototype.makePrivatePassword = () => {
  return prompt("请输入自定义的密码", "1234")
}
###[看到一个字体很喜欢，想知道是啥字体](https://link.zhihu.com/?target=http%3A//www.qiuziti.com/)
###[将文字隐藏到图片中](https://zhuanlan.zhihu.com/p/25285364)
https://link.zhihu.com/?target=http%3A//www.shuidi.im/ 
###[Python教你用matplotlib画个心心撩妹](https://zhuanlan.zhihu.com/p/25575403?group_id=821786158840320000)
```js
import matplotlib.pyplot as plt
import numpy as np
import math
pi = math.pi
t = np.arange(0,2*pi,0.001)
r = np.frompyfunc(round,1,1)
sin = np.frompyfunc(math.sin,1,1)
cos = np.frompyfunc(math.cos,1,1)
#y = sin(x)*(abs(cos(x)))**0.5/(sin(x)+1.4)-2*sin(x)+2
'''
y = 2*cos(t)-cos(2*t)
x = 2*sin(t)-sin(2*t)
'''
x=sin(t)
c=cos(t)
p=x**2
y=c+p**(1/3)
plt.plot(x, y,color='r', linewidth=9)
plt.fill(x,y,color='r')
plt.title("my heart for you")
ax = plt.subplot(111)
ax.spines['right'].set_color('none')
ax.spines['top'].set_color('none')
ax.spines['bottom'].set_color('none')
ax.spines['left'].set_color('none')
plt.xlim(-1.2,1.2),plt.xticks([])
plt.yticks([])
plt.show()
```
###[QQ好友列表数据获取](https://zhuanlan.zhihu.com/p/24580113?refer=codes)
QQ空间发说说的时候都有一个艾特好友功能，可以选择艾特列表中任意好友。这个地方有可能也会请求一个获取好友列表的接口
https://h5.qzone.qq.com/proxy/domain/r.qzone.qq.com/cgi-bin/tfriend/friend_show_qqfriends.cgi?uin=867597730&follow_flag=1&groupface_flag=0&fupdate=1&g_tk=1803395013 
```js

>>> url='http://ti.qq.com/cgi-bin/more_profile_card/more_profile_card'
>>> cookie='pgv_pvi=3128177664; '
>>> r=requests.post(url,headers={"cookie":cookie},data={"_q":12345678,"bkn":315
795074,"src":"mobile"})
>>> r.json()
{'ec': 0, 'profile': [{'birthday': {'year': 1998, 'day': 23, 'month': 7}, 'locat
ion_state': '江西', 'gender': 1, 'location_area': '', 'age': 22, 'email': '12345678@qq.com', 'hometown_state': '', 'college': '00210027238', 'location_city': '
xxx', 'company': '', 'hometown_country': '', 'constellation': 7, 'hometown_area
': '', 'location_country': '中国', 'occupation': 0, 'hometown_city': '', 'person
al': 'xxxx', 'nick': 'xx'}]
}
```
###[词频统计作业](https://mp.weixin.qq.com/s?__biz=MzI3NzM3NzIzNQ==&mid=2247483844&idx=1&sn=7f2951c419c7883a8b954795790eb99d&chksm=eb667878dc11f16eae9251eca34537d149dde30dc86d90efc2d8d8863658081e2ad78b33772f&mpshare=1&scene=1&srcid=0304HCTUV8BseFgWJWl83GBl&pass_ticket=3yy5RFt3ntIFQ55PGWeesIpcVyX1chP%2FFK%2Bcad%2F65Io%2BkE4xNZ%2BOltFjcDz68Ner#rd)

读取文件 → 用 jieba 分词 → 清除非中文字符 → 用 counter 计数 → 用 sorted 排序
```js
# -*- coding: utf-8 -*-

import jieba # for spliting
import re # for regular expression
from collections import Counter # for stat

# Read file
loadfile = open('happiness.txt', 'r')
text = loadfile.read().decode('utf-8')
loadfile.close()

# Split words into a dict
dict = []
words = jieba.cut(text)
for word in words:
    if re.match(u'([\u4e00-\u9fff]+)', word):
        dict.append(word)

# Sort the list
sorted_list = sorted(Counter(dict).items(), key=lambda x:x[1], reverse=True)
    
# Print result
for i in sorted_list[:10]:
    print " '%s' : %d " % (i[0], i[1])
'的' : 22848 
 '是' : 4123 
 '在' : 3538 
 '他' : 2522 
 '了' : 2288 
 '人' : 2089 
 '他们' : 1811 
 '和' : 1746 
 '有' : 1478 
 '我' : 1433
```
###[分页与分库那些事儿（线上交流纪要）](https://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651959953&idx=1&sn=bc2f974f31ac21e43175ab585aa4038b&chksm=bd2d074d8a5a8e5b69582d566de142598cf1dc627a4bc927dda7ad59d411b2868acdf0a325db&mpshare=1&scene=1&srcid=0305IqPxxk072D4nmUwwEW9W&pass_ticket=3yy5RFt3ntIFQ55PGWeesIpcVyX1chP%2FFK%2Bcad%2F65Io%2BkE4xNZ%2BOltFjcDz68Ner#rd)
数据库水平切分的方式，常用的有两种：
hash取模：user_id%2=0为0库，user_id%2=1为1库。
数据分段：user_id属于[0, 1亿]为0库，属于[1亿, 2亿]为2库。
“单表多大数据量时才考虑分库分表”，我们的经验，mysql，1000w-2000w，要考虑分了。如果查询比较简单，例如订单全是单key查询，5000w。
###[零基础12天从入门到精通Python爬虫](http://log4geek.cc/2017/03/%E9%9B%B6%E5%9F%BA%E7%A1%8012%E5%A4%A9%E4%BB%8E%E5%85%A5%E9%97%A8%E5%88%B0%E7%B2%BE%E9%80%9Apython%E7%88%AC%E8%99%AB/)

###[CSRF 问题](https://www.v2ex.com/t/344850)
```js
防止 csrf 攻击 服务端下发 token 到表单里 提交时进行比对即可防住

但是如果攻击者盗取了 cookie 他通过 cookie 登陆网站 不是也得到了 token 吗
csrf 攻击者是弄不到 cookie 的，所以有 http only
csrf 攻击是这样的： 

1.网站删除文章功能是个 post 请求 
2.攻击者构建一个网页，网页自动提交删除的那个 post 请求，现在的 html 规范是允许这种提交的。 
3.引诱管理员访问这个网页。 
4.这个网页自动提交了删除的那个 post 请求。按照浏览器规则，这个请求会带着被攻击网站的 cookie ，是以管理员的身份提交的。 
5.如果没有做 csrf 防护，那么这个删除请求会被执行。而如果做了防护，攻击者是无法获得 token ，删除请求不会被执行。 

xxs 可以看作是前端的注入，输出用户提交的内容未作过滤，造成访问时会自行攻击者的 js ，那么这时候攻击者是可以获得和网页 js 同一权限 
。虽然 http omly 可以预防获得 cookie ，但是攻击者是可以以用户身份执行操作的，例如如果时管理员中招，可以删帖等。如果时普通用户中招，可以添加关注，可以继续向其他好友发起攻击进行传播等。
防 CSRF ，用 token 
防 XSS , 过滤用户提交的数据 
防中间人，上 HTTPS+HSTS 
防对方拿到用户 Cookie 后做危险操作 ， 麻烦你重要操作做二次认证（比如短信，扫码，邮箱， QQ 、微信等其他设备方式的验证） 
```
###合并开发分支到master
合并开发分支到master为例：
1、首先提交开发分支代码并使用git checkout master命令到主分支；
2、使用git pull origin master命令拉取主干分支最新代码；
3、使用git merge 分支名称 --squash命令合并分支代码到主干分支，但并不提交；
4、使用git diff --cached 来查看对比合并的差异;
5、确定差异都为自己或者为此版本内的修改后，使用git commit -m "写清楚修改或者版本变更说明” 提交修改。
6、使用git push origin master将本地master推送到远程master分支。
###[Hexo搭建博客教程](http://thief.one/2017/03/03/Hexo%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E6%95%99%E7%A8%8B/)
```js
新建一个文件夹，如MyBlog
进入该文件夹内，右击运行git，输入：hexo init（生成hexo模板，可能要翻墙）
生成完模板，运行npm install（目前貌似不用运行这一步）
最后运行：hexo server （运行程序，访问本地localhost:4000可以看到博客已经搭建成功）
在Github上创建名字为XXX.github.io的项目，XXX为自己的github用户名。

打开本地的MyBlog文件夹项目内的_config.yml配置文件，将其中的type设置为git

 
deploy:
  type: git
  repository: https://github.com/tengzhangchao/tengzhangchao.github.io.git
  branch: master
运行：npm install hexo-deployer-git –save
运行：hexo g（本地生成静态文件）
运行：hexo d（将本地静态文件推送至Github）
此时，打开浏览器，访问http://tengzhangchao.github.io
```
###[基于Python的WebServer](http://thief.one/2016/09/14/%E5%9F%BA%E4%BA%8EPython%E7%9A%84WebServer/)
python -m SimpleHTTPServer 8000
此时打开浏览器，访问localhost:8000端口即可。
为了方便没有安装python环境的windows机子启动，用pyinstaller工具将py程序打包成了exe可执行程序。
在服务器上运行程序，用来替代FTP等工具，下载服务器上的文件
###[  turnjs插件翻书](https://segmentfault.com/q/1010000008568079)
###[前端插件库 http://jquerywidget.com/](https://github.com/mumuy/widget)
###[PHP error tracking with Sentry](https://sentry.io/for/php/)
###[Python在unpacking上的一个小陷阱](https://zhuanlan.zhihu.com/p/25436739)
```js
a[i], a[j] = a[j], a[i]
j = 0
m = [1, 3, 5] 
j, m[j] = m[j], 99
结果违背了（我的）直觉：

print(j)    # 1
print(m)    # [1, 99, 5]
i, a[i] = 1, 2
# not equivalent to
a[i], i = 2, 1
的情形时要稍加注意，以免掉坑难以查错。dis可以解码类、函数、语句等多种结构
>>> import dis
>>> dis.dis("j, m[j] = m[j], 99")
  1           0 LOAD_NAME                0 (m)
              3 LOAD_NAME                1 (j)
              6 BINARY_SUBSCR
              7 LOAD_CONST               0 (99)
             10 ROT_TWO
             11 STORE_NAME               1 (j)
             14 LOAD_NAME                0 (m)
             17 LOAD_NAME                1 (j)
             20 STORE_SUBSCR
             21 LOAD_CONST               1 (None)
             24 RETURN_VALUE
```
###[PHP主干源码就集成了对libcurl的接口扩展](https://www.zhihu.com/question/56172183/answer/148929267)
```js
作者：eechen
链接：https://www.zhihu.com/question/56172183/answer/148929267
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

PHP主干源码就集成了对libcurl的接口扩展php-src/ext/curl.
http://php.net/curl
Firefox和Chrome也都提供了对curl的支持,F12开发者工具的网络请求里可以直接把请求复制为cURL命令,主要就是一些头,关键如Cookie信息:
curl 'https://www.zhihu.com/topic/19552910/newest' \
-H 'Host: www.zhihu.com' \
-H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0' \
-H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' \
-H 'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3' \
-H 'Accept-Encoding: gzip, deflate, br' \
-H 'Cookie: name1=value1; name2=value2' \
-H 'Connection: keep-alive' \
-H 'Upgrade-Insecure-Requests: 1'
要实现PHP编程(爬虫,自动化测试),你还可以根据浏览器里得到的命令参数转换为PHP curl代码:
http://php.net/curl_setopt
CURLOPT_COOKIEFILE:
包含 cookie 数据的文件名，cookie 文件的格式可以是 Netscape 格式，或者只是纯 HTTP 头部风格，存入文件。如果文件名是空的，不会加载 cookie，但 cookie 的处理仍旧启用。 
CURLOPT_COOKIEJAR:
连接结束后，比如，调用 curl_close 后，保存 cookie 信息的文件。

使用PHP curl,单进程也可以并行发起多个请求:
接口1: php -S 127.0.0.1:8080 -t /home/eechen/www
接口2: php -S 127.0.0.2:8080 -t /home/eechen/www
/home/eechen/www/index.php:
<?php
header('Content-Type: application/json; charset=utf-8');
echo json_encode(array('SERVER_NAME' => $_SERVER['SERVER_NAME']));
//串行访问需要sum(2,1)秒,并行访问需要max(2,1)秒.
($_SERVER['SERVER_NAME'] == '127.0.0.1') ? sleep(2) : sleep(1);
?>

并行:
/home/eechen/curl.php
<?php
$url[] = 'http://127.0.0.1:8080';
$url[] = 'http://127.0.0.2:8080';
$mh = curl_multi_init();
foreach($url as $k => $v) {
	$ch[$k] = curl_init($v);
	curl_setopt($ch[$k], CURLOPT_HEADER, 0); //不输出头
	curl_setopt($ch[$k], CURLOPT_RETURNTRANSFER, 1); //exec返回结果而不是输出,用于赋值
	curl_multi_add_handle($mh, $ch[$k]); //决定exec输出顺序
}
$running = null;
$starttime = microtime(true);
//执行批处理句柄(类似pthreads多线程里的start开始和join同步)
do {
	//CURLOPT_RETURNTRANSFER如果为0,这里会直接输出获取到的内容.如果为1,后面可以用curl_multi_getcontent获取内容.
	curl_multi_exec($mh, $running);
	//阻塞直到cURL批处理连接中有活动连接,不加这个会导致CPU负载超过90%.
	curl_multi_select($mh);
} while ($running > 0);
echo microtime(true) - $starttime."\n"; //耗时约2秒
foreach($ch as $v) {
	$info[] = curl_getinfo($v);
	$json[] = curl_multi_getcontent($v);
	curl_multi_remove_handle($mh, $v);
}
curl_multi_close($mh);
var_export($json); 
var_export($info);
?>
输出:
2.0015449523926
array (
  0 => '{"SERVER_NAME":"127.0.0.1"}',
  1 => '{"SERVER_NAME":"127.0.0.2"}',
)
array (
  0 => 
  array (
    'url' => 'http://127.0.0.1:8080/',
    'content_type' => 'application/json; charset=utf-8',
    'http_code' => 200,
    'header_size' => 107,
    'request_size' => 53,
    'filetime' => -1,
    'ssl_verify_result' => 0,
    'redirect_count' => 0,
    'total_time' => 2.0013990000000002,
    'namelookup_time' => 5.3999999999999998E-5,
    'connect_time' => 0.00015799999999999999,
    'pretransfer_time' => 0.000194,
    'size_upload' => 0,
    'size_download' => 27,
    'speed_download' => 13,
    'speed_upload' => 0,
    'download_content_length' => -1,
    'upload_content_length' => 0,
    'starttransfer_time' => 0.00079699999999999997,
    'redirect_time' => 0,
    'certinfo' => 
    array (
    ),
    'primary_ip' => '127.0.0.1',
    'primary_port' => 8080,
    'local_ip' => '127.0.0.1',
    'local_port' => 57653,
    'redirect_url' => '',
  ),
  1 => 
  array (
    'url' => 'http://127.0.0.2:8080/',
    'content_type' => 'application/json; charset=utf-8',
    'http_code' => 200,
    'header_size' => 107,
    'request_size' => 53,
    'filetime' => -1,
    'ssl_verify_result' => 0,
    'redirect_count' => 0,
    'total_time' => 1.0012369999999999,
    'namelookup_time' => 1.1E-5,
    'connect_time' => 4.6999999999999997E-5,
    'pretransfer_time' => 6.3E-5,
    'size_upload' => 0,
    'size_download' => 27,
    'speed_download' => 26,
    'speed_upload' => 0,
    'download_content_length' => -1,
    'upload_content_length' => 0,
    'starttransfer_time' => 0.00063699999999999998,
    'redirect_time' => 0,
    'certinfo' => 
    array (
    ),
    'primary_ip' => '127.0.0.2',
    'primary_port' => 8080,
    'local_ip' => '127.0.0.1',
    'local_port' => 43645,
    'redirect_url' => '',
  ),
)
```
###[逻辑或(||)优先级比赋值运算符(=)高.](https://www.zhihu.com/question/56093849)
```js
$a = 3;
$b = 5;
if ($a = 5 || $b = 7) {
$a++;
$b++;
}
echo $a . " " . $b;
if条件 $a = 5 || $b = 7 相当于 $a = (5 || $b = 7)
逻辑或运算 (5 || $b = 7) 判断到左边的5为true,就不再执行右边的逻辑(所以$b的值仍是5),整个表达式返回值是true,于是$a的值为true,$a++后$a的值为1,$b++后$b的值为6.

其实我也有困惑,为什么当$a的值为true时,$a++后$a的值为1,而不是像(true+1)为2.递增或递减布尔值没有效果.

如果要按预期,赋值时前后最好加上括号:
if( ($a = 5) || ($b = 7) ) {}

if( ($stmt = $db->prepare($sql)) && $stmt->execute(array($id)) ) {
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
} else { 
	return false;
}

 
```
###[教你免费搭建个人博客，Hexo&Github](https://zhuanlan.zhihu.com/p/25471760)
###[10个赚钱项目 月赚10000+](https://zhuanlan.zhihu.com/p/25531259)
###判断json
```js
function isJsonString(str) {
  try {
    JSON.parse(str)
    return true
  } catch (err) {
    return false
  }
}
```
###[Shadowsocks折腾记](http://thief.one/2017/02/22/Shadowsocks%E6%8A%98%E8%85%BE%E8%AE%B0/)
```js
pip install shadowsocks

{
"server":"",     ##服务器ip地址
"server_port":8000,  ##代理端口
"local_address":"127.0.0.1",
"local_port":1080, ##本地监听端口
"password":"",   ##连接密码
"timeout":300,
"method":"aes-256-cfb", ##加密方式
"dast_open":false
}
{
"server":"",
"local_address":"127.0.0.1",
"local_port":1080,
"port_password":{
"8000":"123456",
"8001":"123456"
},
"timeout":300,
"method":"aes-256-cfb",
"fast_open":false
}
ssserver -c config.json
sudo useradd ssuser //添加一个ssuser用户
sudo ssserver [other options] --user ssuser //用ssuser这个用户来运行ss
将之前的ssserver -c /etc/shadowsocks.json -d start改为ssserver -c /etc/shadowsocks.json -d start –user ssuser
```
###[黑帽SEO之基础知识](http://thief.one/2016/10/09/%E9%BB%91%E5%B8%BDSEO%E4%B9%8B%E5%9F%BA%E7%A1%80%E7%9F%A5%E8%AF%86/)
###[__contruct方法](https://segmentfault.com/q/1010000008565442)
一个类中如果同时存在__construct(非父类的)和与类名同名函数，则__construct是构造函数，而同名函数则当作普通函数；

2.如果一个子类的父类中有__construct(即使是public)但子类中没有,而子类中有同名函数，而同名函数是构造函数。如果你用get_class_methods($this);获取类的方法会发现其实是有__construct方法的;

3.php官方手册中有这么一句话：

自 PHP 5.3.3 起，在命名空间中，与类名同名的方法不再作为构造函数。这一改变不影响不在命名空间中的类
###[es6()=>{} 这种形式的代码](https://segmentfault.com/q/1010000008556196)
语法规定就是(function(){}).bind(this),即自动添加了bind this
###[.gitignore 没有生效](https://segmentfault.com/q/1010000008565646)
因为之前已经提交过，解决办法就是先把.gitignore中这三个目录去掉，然后删除这三个目录后再提交，push，最后再把这三个目录添加到.gitignore中，这样以后就被排除了
###[怎样将JS中的json对象转换成PHP可以识别的json对象](https://segmentfault.com/q/1010000008553610)
```js
<?php

$str = <<<STR
{
  a: {
    b: '1',
    c: '2',
    d: '3'
  },
  e: {
    f: '4',
    g: '5',
    h: '6'
  },
  i: [
    {
      j: '7',
      k: '8',
      l: '9'
    },
    {
      m: '10',
      n: '11',
      o: '12'
    },
    {
      p: '13',
      q: '14 ',
      r: '15'
    }
  ],
  s: '16',
  t: '17',
  u: '18',
  v: false,
  w: 'final',
  x: '',
  y: true,
  z: true
}
STR;

$str = preg_replace(["/([a-zA-Z_]+[a-zA-Z0-9_]*)\s*:/", "/:\s*'(.*?)'/"], ['"\1":', ': "\1"'], $str);
var_dump($str);
var_dump(json_decode($str));

```
###[正确移除绑定事件？？](https://segmentfault.com/q/1010000008561000)
```js
const something = {
    bindEvent() {
        // 不管是用 function 或箭头函数封装还是 bind(this)，
        // 都会产生新的函数，需要把这个新函数保存起来，这里用 this.events 来保存，
        // 方便以后移除绑定事件
        this.events = {
            mouseenter: e => this.mouseenterHandler(e),
            mouseleave: this.mouseleaveHandler.bind(this),
            click: this.clickHandler
        };

        // Array.from 可以把伪数组变成真正的数组，
        // 当然原来的 [].forEach.call 也没有什么问题
        // 不过 dot => { ... } 是箭头函数，不需要定义 self 来保存 this
        Array.from(document.querySelectorAll(".dot"))
            .forEach(dot => {
                // 这里是三句 addEventListener，
                // 直接用 Object.keys(this.events).forEach 简写了
                Object.keys(this.events)
                    .forEach(key => dot.addEventListener(key, this.events[key]));
            });
    },

    unbindEvent() {
        // 万一没调 bindEvent，this.events 会是 undefined，所以这里处理一下。
        // 其它的和 bindEvent 中的代码差不多，就不逐一解释了
        const events = this.events || {};
        Array.from(document.querySelectorAll(".dot"))
            .forEach(dot => {
                Object.keys(events)
                    .forEach(key => dot.removeEventListener(key, events[key]));
            });
    }
};
```
###[正则取出其中的 IP 地址](https://www.v2ex.com/t/344344#reply19)
```js
print 'jdbc:mysql://10.0.151.205:3306 -> 10.0.151.205:3306'.split('->')[1].split(':')[0].strip()
>>> import urlparse 
>>> a = 'jdbc:mysql://10.0.151.205:3306' 
>>> urlparse.urlparse(urlparse.urlparse(a).path).hostname 
'10.0.151.205'
 split rsplit lsplit 是一组函数 他第二个参数非常有用的 

>>> a.rsplit(':', 1)[0].rsplit('/', 1)[-1] 
'10.0.151.205'
print '''jdbc:mysql://10.0.151.205:3306'''.split('/')[-1].split(':')[0]
https://www.v2ex.com/t/344404 
 https://regex101.com/r/aQUufT/1 http://regex.alf.nu/ 

```
###[「特别的」短网址](https://www.v2ex.com/t/344247#reply29)
地址: https://advertics.io/
###[性能研究专栏小组](https://www.v2ex.com/t/344364#reply22)
https://github.com/barretlee/performance-column/issues 
###[微信公众号菜单编辑器](https://www.v2ex.com/t/344534#reply0)
https://handsomeone.github.io/WeChatMenuManager/

###[防止 MySQL 的 ibdata1 文件过大](https://www.v2ex.com/t/344695#reply2)
```js
在 MySQL 5.6.6 版本以前， MySQL 默认会把所有的 innodb 的表都放在同一个文件中(ibdata1)，当该文件过大的时候， MySQL 容易出错，维护性能差。一个简单的办法是修改 MySQL 配置文件 /etc/my.cnf 后重启 [mysqld]

innodb_file_per_table=1
 mysqldump 备份所有数据库后重建所有数据库，步骤如下

mysqldump -u user -p password --all-databases > backup.sql 导出所有数据
删除所有数据库 drop database database_N
停止 MySQL 服务 service mysql stop 如果是 Mariadb 就是 service mariadb stop
删除文件 ibdata1, ib_logfile0, ib_logfile1
重启 MySQL 服务 service mysql start 如果是 Mariadb 就是 service mariadb start
导入备份数据 mysql -u user -p password --all-databases < backup.sql
另一种办法是把已经储存在 ibdata1 里面的 innodb 表拿出来放到它自己的路径上 mysql -sN -u user -p -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb'" | awk -F" " '{print "alter table"$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql

如果要排除 MySQL 自带的 table ，可以修改上面脚本中的 where 部分的语句。下面是在 Plesk 中使用的一个例子 MYSQL_PWD=cat /etc/psa/.psa.shadow mysql -sN -u admin -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb' and table_schema != 'apsc' and table_schema != 'mysql' and table_schema != 'psa' and table_schema != 'information_schema' and table_schema != 'horde' and table_schema != 'performance_schema' and table_schema != 'roundcubemail' and table_schema not like 'phpmyadmin_%' " | awk -F" " '{print "alter table "$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql
```
###[国内的 composer 镜像](https://www.v2ex.com/t/344430#reply37)
https://pkg.phpcomposer.com/ 
git 也学会 -c HTTP_PROXY=http://127.0.0.1:1080
composer config -g repo.packagist composer https://p.staticq.com 
国内还有其它镜像 ThinkPHP 目前推荐的是 https://packagist.composer-proxy.org
###[HTML5 的匿名聊天室，试试 socket.io](https://www.v2ex.com/t/344540#reply19)
https://github.com/sheila1227/ChatRoom-AngularJS

###[wxpy: 优雅的微信个人号 机器人/API，用 Python 玩微信](https://www.v2ex.com/t/343685#reply48)
###[StackOverflow 上整理的 Python 2 和 3 之间的一些兼容性方面的细节问题](https://www.v2ex.com/t/344107#reply1)
http://stackoverflow.com/documentation/python/809/incompatibilities-between-python-2-and-python-3
###[静态网站生成器： Pagic](https://www.v2ex.com/t/344182#reply33)
GitHub: https://github.com/xcatliu/pagic
###[获取ip](https://www.v2ex.com/t/344470)
ifconfig.me 连不上 
ifconfig.co 太慢 

我用 Go 写了一个 ifconfig.cat 

curl ifconfig.cat 
wget -q ifconfig.cat 
http -b ifconfig.cat 
curl http://ip-api.com/line http://ip-api.com/docs/  
curl ipecho.net/plain https://ifconfig.minidump.info/ 
###[24小时从0到1开发阴阳师小程序](https://zhuanlan.zhihu.com/p/25477688)
```js
前端毫无疑问就是微信小程序咯；
后端使用 Django 提供 Restful API 服务；https://link.zhihu.com/?target=https%3A//github.com/bluedazzle/django-simple-serializer
# coding: utf-8
import json
import requests
import urllib
from xpinyin import Pinyin
url = "https://g37simulator.webapp.163.com/get_heroid_list?callback=jQuery11130959811888616583_1487429691764&rarity=0&page=1&per_page=200&_=1487429691765"
result = requests.get(url).content.replace('jQuery11130959811888616583_1487429691764(', '').replace(')', '')
json_data = json.loads(result)
hellspawn_list = json_data['data']
p = Pinyin()
for k, v in hellspawn_list.iteritems():
    file_name = p.get_pinyin(v.get('name'), '')
    print 'id: {0} name: {1}'.format(k, v.get('name'))
    big_url = "https://yys.res.netease.com/pc/zt/20161108171335/data/shishen_big/{0}.png".format(k)
    urllib.urlretrieve(big_url, filename='big/{0}@big.png'.format(file_name))
    avatar_url = "https://yys.res.netease.com/pc/gw/20160929201016/data/shishen/{0}.png".format(k)
    urllib.urlretrieve(avatar_url, filename='icon/{0}@icon.png'.format(file_name))
    
    https://link.zhihu.com/?target=https%3A//github.com/bluedazzle/HellspawnHunterBackend 
    >>> p.get_pinyin('世界只关心你能提供')
'shi-jie-zhi-guan-xin-ni-neng-ti-gong'
```
###[代码这样写更优雅 (Python 版)](https://zhuanlan.zhihu.com/p/25518608)
```js
变量交换

大部分编程语言中交换两个变量的值时，不得不引入一个临时变量：

>>> a = 1
>>> b = 2
>>> tmp = a
>>> a = b
>>> b = tmp
pythonic

>>> a, b = b, a
循环遍历区间元素

for i in [0, 1, 2, 3, 4, 5]:
    print i
# 或者
for i in range(6):
    print (i)
pythonic

for i in xrange(6):
    print (i)

带有索引位置的集合遍历

遍历集合时如果需要使用到集合的索引位置时，直接对集合迭代是没有索引信息的，普通的方式使用：

colors = ['red', 'green', 'blue', 'yellow']

for i in range(len(colors)):
    print (i, '--->', colors[i])
pythonic

for i, color in enumerate(colors):
    print (i, '--->', color)

字符串连接

字符串连接时，普通的方式可以用 + 操作

names = ['raymond', 'rachel', 'matthew', 'roger',
         'betty', 'melissa', 'judith', 'charlie']

s = names[0]
for name in names[1:]:
    s += ', ' + name
print (s)
pythonic

print (', '.join(names))

f = open('data.txt')
try:
    data = f.read()
finally:
    f.close()
pythonic

with open('data.txt') as f:
    data = f.read()
列表推导式

能够用一行代码简明扼要地解决问题时，绝不要用两行，比如

result = []
for i in range(10):
    s = i*2
    result.append(s)
pythonic

[i*2 for i in xrange(10)]

遍历字典的 key 和 value

# 方法一
for k in d:
    print k, '--->', d[k]

# 方法二
for k, v in d.items():
    print (k, '--->', v)
pythonic

for k, v in d.iteritems():
    print (k, '--->', v)

names = ['raymond', 'rachel', 'matthew', 'roger',
         'betty', 'melissa', 'judith', 'charlie']
names.pop(0)
names.insert(0, 'mark')
pythonic

from collections import deque
names = deque(['raymond', 'rachel', 'matthew', 'roger',
               'betty', 'melissa', 'judith', 'charlie'])
names.popleft()
names.appendleft('mark')
deque 是一个双向队列的数据结构，删除元素和插入元素会很快
 

善用装饰器

装饰器可以把与业务逻辑无关的代码抽离出来，让代码保持干净清爽，而且装饰器还能被多个地方重复利用。比如一个爬虫网页的函数，如果该 URL 曾经被爬过就直接从缓存中获取，否则爬下来之后加入到缓存，防止后续重复爬取。

def web_lookup(url, saved={}):
    if url in saved:
        return saved[url]
    page = urllib.urlopen(url).read()
    saved[url] = page
    return page
pythonic

import urllib #py2
#import urllib.request as urllib # py3

def cache(func):
    saved = {}

    def wrapper(url):
        if url in saved:
            return saved[url]
        else:
            page = func(url)
            saved[url] = page
            return page

    return wrapper


@cache
def web_lookup(url):
    return urllib.urlopen(url).read()



```
###[ 使用Python定制词云](https://zhuanlan.zhihu.com/p/25538157)
```js
$ mkdir work && cd work
$ sudo apt-get update
$ sudo apt-get install python-dev
$ sudo pip install numpy
$ sudo apt-get install python-matplotlib
$ sudo apt-get install python-pil
下载小说《三体》I、 II、 III。

$ wget http://labfile.oss.aliyuncs.com/courses/756/santi.txt
$ wget http://labfile.oss.aliyuncs.com/courses/756/santi2.txt
$ wget http://labfile.oss.aliyuncs.com/courses/756/santi3.txt
安装wordcloud扩展包。

$ sudo pip install wordcloud

 

#!/usr/bin/env python
"""
Minimal Example
===============
Generating a square wordcloud from the US constitution using default arguments.
"""

from os import path
from wordcloud import WordCloud

d = path.dirname(__file__)

# Read the whole text.
text = open(path.join(d, 'constitution.txt')).read()

# Generate a word cloud image
wordcloud = WordCloud().generate(text)

# Display the generated image:
# the matplotlib way:
import matplotlib.pyplot as plt
plt.imshow(wordcloud)
plt.axis("off")

# lower max_font_size
wordcloud = WordCloud(max_font_size=40).generate(text)
plt.figure()
plt.imshow(wordcloud)
plt.axis("off")
plt.show()

```
###[这个网站能够在线帮你把 PDF 文件轻松转成 PPT、Exel、JPG、Word 等文件](https://zhuanlan.zhihu.com/p/24735371)
https://link.zhihu.com/?target=https%3A//smallpdf.com/
###[《一个全栈增长工程师的练手项目集》](https://zhuanlan.zhihu.com/p/25534234)

http://link.zhihu.com/?target=http%3A//www.epubit.com.cn/book/details/4868
###[JavaEE 要懂的小事：图解Http协议](https://zhuanlan.zhihu.com/p/25518072)

```js
HTTP是一个客户端和服务器端请求和响应的标准TCP。其实建立在TCP之上的
1、客户端与服务器需要建立连接。（比如某个超级链接，HTTP就开始了。）


2、建立连接后，发送请求。


3、服务器接到请求后，响应其响应信息。


4、客户端接收服务器所返回的信息通过浏览器显示在用户的显示屏上，然后客户机与服务器断开连接。

建立连接，其实建立在TCP连接基础之上

 请求报文格式如下：

请求行 通用信息头 请求头 实体头 （空行） 报文主体
响应行-状态码

1xx：指示信息–表示请求已接收，继续处理
2xx：成功–表示请求已被成功接收、理解、接受
3xx：重定向–要完成请求必须进行更进一步的操作
4xx：客户端错误–请求有语法错误或请求无法实现
5xx：服务器端错误–服务器未能实现合法的请求
200 OK //请求成功
400 Bad Request //客户端请求有语法错误，不能被服务器所理解
401 Unauthorized //请求未经授权，这个状态代码必须和WWW-Authenticate报头域一起使用
403 Forbidden //服务器收到请求，但是拒绝提供服务
404 Not Found //请求资源不存在，eg：输入了错误的URL
500 Internal Server Error //服务器发生不可预期的错误
503 Server Unavailable //服务器当前不能处理客户端的请求，一段时间后可能恢复正常
```
###[谈谈对 Web 安全的理解](https://zhuanlan.zhihu.com/p/25486768)_
CSRF 可以简单理解为：攻击者盗用了你的身份，以你的名义发送恶意请求，容易造成个人隐私泄露以及财产安全。
![img](https://pic4.zhimg.com/v2-0c63c4193d48b8f42c4a4f53d82330df_b.jpg)
```js
登录受信任网站，并在本地生成 cookie
在不登出 A 的情况下，访问危险网站 B
举个简单的例子：

某银行网站 A，它以 GET 请求来完成银行转账的操作，如：

http://www.mybank.com/transfer.php?toBankId=11&money=1000
而某危险网站 B，它页面中含有一段 HTML 代码如下：

<img src=http://www.mybank.com/transfer.php?toBankId=11&money=1000>


 session_start();
    if (isset($_POST['toBankId'] &&isset($_POST['money']))
    {
        transfer($_POST['toBankId'],　$_POST['money']);
    }

<body onload="steal()">
    <iframe name="steal" display="none">
　　     <form method="POST" name="transfer"　action="http://www.myBank.com/transfer.php">
　　	    <input type="hidden" name="toBankId" value="11">
　　	    <input type="hidden" name="money" value="1000">
　　     </form>
    </iframe>
</body>
```
###[Phantomjs性能优化](https://zhuanlan.zhihu.com/p/25507989)
```js
from selenium import webdriver

d=webdriver.PhantomJS("D:\python27\Scripts\phantomjs.exe",service_args=[])
d.get("http://thief.one")
d.quit()

service_args=[]
service_args.append('--load-images=no')  ##关闭图片加载
service_args.append('--disk-cache=yes')  ##开启缓存
service_args.append('--ignore-ssl-errors=true') ##忽略https错误

d=webdriver.PhantomJS("D:\python27\Scripts\phantomjs.exe",service_args=service_args)
d.get("http://thief.one")
 d.implicitly_wait(10)        ##设置超时时间
d.set_page_load_timeout(10)  ##设置超时时间
url_list=["http://www.baidu.com"]*10
d=webdriver.PhantomJS()   
def test(url):
     d.get(url)
运行一个phantomjs进程，进程内开启多线程）
url_list=["http://www.baidu.com"]*10
for url in url_list:
     threading.Thread(target=test,args=(url,)).start() 
d.quit()

__author__="nMask"
__Date__="20170224"
__Blog__="http://thief.one"

import Queue
from selenium import webdriver
import threading
import time

class conphantomjs:
	phantomjs_max=1             ##同时开启phantomjs个数
	jiange=0.00001                  ##开启phantomjs间隔
	timeout=20                  ##设置phantomjs超时时间
	path="D:\python27\Scripts\phantomjs.exe" ##phantomjs路径
	service_args=['--load-images=no','--disk-cache=yes'] ##参数设置

	def __init__(self):
		self.q_phantomjs=Queue.Queue()   ##存放phantomjs进程队列

	def getbody(self,url):
		'''
		利用phantomjs获取网站源码以及url
		'''
		d=self.q_phantomjs.get()

		try:
			d.get(url)
		except:
			print "Phantomjs Open url Error"

		url=d.current_url

		self.q_phantomjs.put(d)

		print url

	def open_phantomjs(self):
		'''
		多线程开启phantomjs进程
		'''
		def open_threading():
			d=webdriver.PhantomJS(conphantomjs.path,service_args=conphantomjs.service_args) 
			d.implicitly_wait(conphantomjs.timeout)        ##设置超时时间
			d.set_page_load_timeout(conphantomjs.timeout)  ##设置超时时间

			self.q_phantomjs.put(d) #将phantomjs进程存入队列

		th=[]
		for i in range(conphantomjs.phantomjs_max):
			t=threading.Thread(target=open_threading)
			th.append(t)
		for i in th:
			i.start()
			time.sleep(conphantomjs.jiange) #设置开启的时间间隔
		for i in th:
			i.join()


	def close_phantomjs(self):
		'''
		多线程关闭phantomjs对象
		'''
		th=[]
		def close_threading():
			d=self.q_phantomjs.get()
			d.quit()

		for i in range(self.q_phantomjs.qsize()):
			t=threading.Thread(target=close_threading)
			th.append(t)
		for i in th:
			i.start()
		for i in th:
			i.join()


if __name__=="__main__":
	'''
	用法：
	1.实例化类
	2.运行open_phantomjs 开启phantomjs进程
	3.运行getbody函数，传入url
	4.运行close_phantomjs 关闭phantomjs进程
	'''
	cur=conphantomjs()
	conphantomjs.phantomjs_max=10
	cur.open_phantomjs()
	print "phantomjs num is ",cur.q_phantomjs.qsize()

	url_list=["http://www.baidu.com"]*50

	th=[]
	for i in url_list:
		t=threading.Thread(target=cur.getbody,args=(i,))
		th.append(t)
	for i in th:
		i.start()
	for i in th:
		i.join()

	cur.close_phantomjs()
	print "phantomjs num is ",cur.q_phantomjs.qsize()
 
 d=webdriver.PhantomJS("D:\python27\Scripts\phantomjs.exe",service_args=['--load-images=no','--disk-cache=yes'])
 每次d.get()请求完就d.quit()关闭phantomjs进程，待到新的请求再开启。（
 每次get后，保存current_url的值，待下一次请求后与此值相比较，如果一样，则说明状态没有被改变。
```
###[从设计到上线：如何用Vue.js和Python做一个博客？](https://zhuanlan.zhihu.com/p/25507320)

https://link.zhihu.com/?target=https%3A//github.com/hating/Shakespeare-TheBlog

###[推荐：Python学习总结](https://zhuanlan.zhihu.com/p/25507110)

###[MySQL成数据勒索新目标，开发4步自查](https://zhuanlan.zhihu.com/p/25497458)
```js

2、Redis
a. 配置鉴权

修改配置文件，增加 “requirepass 密码” 项配置（配置文件一般在/etc/redis.conf）
在连接上Redis的基础上，通过命令行配置，config set requirepass yourPassword
b. 关闭公网访问

配置bind选项，限定可以连接Redis服务器的IP，修改 Redis 的默认端口6379
c. 其他

配置rename-command 配置项 “RENAME_CONFIG”，重名Redis相关命令，这样即使存在未授权访问，也能够给攻击者使用config 指令加大难度（不过也会给开发者带来不方便）
相关配置完毕后重启Redis-server服务

3、MySQL
a. 配置鉴权
MySQL安装默认要求设置密码，如果是弱命令，可通过以下几种方式修改密码:

UPDATE USER语句
 //以root登录MySQL后，
 USE mysql；
 UPDATE user SET password=PASSWORD('新密码') WHERE user='root';
 FLUSH PRIVILEGES;
SET PASSWORD语句
//以root登录MySQL后，
 SET PASSWORD FOR root=PASSWORD('新密码');
mysqladmin命令
mysqladmin -u root -p 旧密码 新密码
b. 关闭公网访问

启动参数或者配置文件中设置bind-address= IP绑定内部IP
以root账号连接数据库，排查user表中用户的host字段值为%或者非localhost的用户，修改host为localhost或者指定IP或者删除没必要用户
```
###[GO语言学习资源整理](https://zhuanlan.zhihu.com/p/25493806)
###[PHP 开发中有效防御 SQL 注入攻击有哪些好方法](https://www.zhihu.com/question/20076383)
medoo.php这个PHP实现的Query Builder,就是通过PDO::quote($param)手动转义参数,然后通过exec/query来执行SQL,其并没有使用预处理参数化查询(prepare($sql)/execute(array($param))

```js
 

//id IN ($ids) 占位符生成
function app_place_holders(array $params) {
	//http://php.net/manual/zh/pdostatement.execute.php
	return implode(',', array_fill(0, count($params), '?'));
}

// var_export(app_in_pdo(array(1, 3, 5)));
function app_in_pdo(array $ids) {
	global $app;
	$db = app_db();
	$table = $app['db_prefix'].'post';
	$place_holders = app_place_holders($ids);
	$sql = "SELECT * FROM `{$table}` WHERE `id` IN ({$place_holders})";
	$stmt = $db->prepare($sql);
	$stmt->execute($ids); //所有id都当做字符串处理,值传递.
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// var_export(app_in_mysqli(array(1, 3, 5))); 要求使用PHP内置的mysqlnd驱动
function app_in_mysqli(array $ids) {
	global $app;
	$db = app_mysql();
	$table = $app['db_prefix'].'post';
	$place_holders = app_place_holders($ids);
	$sql = "SELECT * FROM `{$table}` WHERE `id` IN ({$place_holders})";
	$stmt = $db->prepare($sql);
	//MySQLi自动化"引用绑定"参数(因为mysqli的execute不像pdo的execute支持参数数组传递,所以显得麻烦些)
	$params = array_merge(array(str_repeat('s', count($ids))), $ids); //array('sss', 1, 3, 5)
	foreach($params as $k => $v) { $params[$k] = &$params[$k]; } //因为bind_param要求传递引用.
	call_user_func_array(array($stmt, 'bind_param'), $params); //相当于$stmt->bind_param('sss', $ids[0], $ids[1], $ids[2]);
	$stmt->execute();
	return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
用tail -f /path/to/mysqld/general_log查看MySQL的SQL日志可见:Prepare	SELECT * FROM `app_post` WHERE `id` IN (?,?,?)
Execute	SELECT * FROM `app_post` WHERE `id` IN ('1','3','5')
Close stmt

防SQL注入最好的方法就是千万不要自己拼装SQL命令和参数, 而是用PDO的prepare和bind. 
原理就在于要把你的SQL查询命令和传递的参数分开:
    > prepare的时候, DB server会把你的SQL语句解析成SQL命令.
    > bind的时候, 只是动态传参给DB Server解析好的SQL命令.

其他所有的过滤特殊字符串这种白名单的方式都是浮云.
https://link.zhihu.com/?target=https%3A//github.com/lincanbin/PHP-PDO-MySQL-Class 
$DB->query("SELECT * FROM fruit WHERE name IN (?)",array($_GET['pm1'],$_GET['pm2']));
$DB->query("SELECT * FROM users WHERE name=? and password=?",array($_GET['name'],$_GET['pw']));

 
```
###[公众号文章配图](https://www.zhihu.com/question/37493361)
https://link.zhihu.com/?target=http%3A//www.91yunying.com/25691.html https://link.zhihu.com/?target=http%3A//huaban.com/

###[在SQL中，如何查询某一字段中最大值的数据](https://www.zhihu.com/question/56557077)
 select * from shit as A inner join (select max(date) as date from shit) as B on A.date = B.date
 select * from shit as A where not exists(select * from shit where date>A.date)
 where date=(select max(date) from ..)
 最简单的子查询：select * from table where date = (select max(date) from table)

或者用轮子哥讲的join自己：

select * from table t1 left join (select max(date) as date from table) t2 on t1.date=t2.date where t2.date is not null

