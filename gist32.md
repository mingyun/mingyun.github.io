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
