###[理解PHP延迟静态绑定](https://blog.haitun.me/late-static-bindings/)
static::中的static其实是运行时所在类的别名，并不是定义类时所在的那个类名。这个东西可以实现在父类中能够调用子类的方法和属性。
使用(static)关键字来表示这个别名，和静态方法，静态类没有半毛钱的关系，static::不仅支持静态类，还支持对象（动态类）。
```js
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        static::who(); // 后期静态绑定从这里开始
    }
}
class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}
B::test();
class Model 
{ 
    public static function find() 
    { 
        echo static::$name; 
    } 
} 

class Product extends Model 
{ 
    protected static $name = 'Product'; 
} 

Product::find(); 
```
###[向社区发布自己的 Composer 包](https://laravel-china.org/articles/3881)
```js
{
  "name": "baocai/yprint",
  "description": "Elind Printer SDK",
  "type": "sdk",
  "license": "MIT",
  "authors": [
    {
      "name": "kelaocai",
      "email": "kelaocai@163.com"
    }
  ],
  "minimum-stability": "dev",
  "require": {},
  "autoload": {
    "psr-4": {
      "BaoCai\\Yprint\\": "src/"
    }
  }
}
设置GitHub代码自动同步
主要填写两项Packagist配置信息：

用户名： 注意是Packagist上的用户名
Token： 通讯令牌
Domain： 可不用填写
composer require baocai/yprint dev-master
laravel Facade是通过class_alias来是实现的，通过Illuminate/Foundation/AliasLoader.php进行加载
```
###[Laravel 5.3 代码生成器 - summerblue/generator](https://laravel-china.org/articles/3730)
###[这个包可以让你在浏览器上查看路由](https://laravel-china.org/articles/3707)
composer require garygreen/pretty-routes
###[读《代码整洁之道》有感](https://laravel-china.org/articles/3636)
```js
函数的第一规则是要短小。第二条规则则是还要更短小。

函数应该做一件事。做好这件事。只做这一件事。

每个函数一个抽象层级。自顶向下读代码。
public function login(Request $request)
{
    $this->validateLogin($request);

    if ($this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);

        return $this->sendLockoutResponse($request);
    }

    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
}
public function calculatePay(Employee $e)
{
    switch ($e->type) {
        case COMMISSIONED :
            return calculateCommissionedPay($e);
        case HOURLY :
            return calculateHourlyPay($e);
        case SALARIED :
            return calculateSalariedPay($e);
        default:
            throw new InvalidEmployeeType($e->type);
    }
}
明显这个函数做了不止一件事
当出现新员工类型时需要增加。
违反了单一职责原则（SRP）
违反了开放闭合原则（OCP）
// 雇员抽象类
abstract class Employee {

    public function isPayday($date);

    public function calculatePay();

    public function deliverPay($money);
}

// 雇员工厂
interface EmployeeFactory {
    public function makeEmployee(EmployeeRecord $record);
}

// 工厂的具体实现
class EmployeeFactoryImpl implements EmployeeFactory {
    public function makeEmployee(EmployeeRecord $record)
    {
        switch ($record->type) {
        case COMMISSIONED :
            return new CommissionedEmployee($record);
        case HOURLY :
            return new HourlyEmployee($record);
        case SALARIED :
            return new SalariedEmployee($record);
        default:
            throw new InvalidEmployeeType($record->type);
    }
    }
}
$employeeClass = $type.'Employee'; 
$employee = new $employeeClass();
echo get_class($field);
```
###[开发高性能 Vue.js 应用只需要 3 步](https://laravel-china.org/topics/3864)
```js
yarn global add vbuild
import Vue from 'vue'

new Vue({
  el: '#app',
  render: h => <h1>Hello World</h1>
})
vbuild index.js --dev
```
###[从解决 bug 谈到学习](https://laravel-china.org/articles/3836)
###[Laravel tap 用法](https://laravel-china.org/articles/3893)
```js
function tap($value, $callback)
{
   $callback($value);

   return $value;
}
$response = $next($request);

$this->storePasswordHashInSession($request);

return $response;
return tap($next($request), function () use ($request) {
    $this->storePasswordHashInSession($request);
});
public function pull($key, $default = null)
{
   return tap($this->get($key, $default), function ($value) use ($key) {
      $this->forget($key);
   });
}
```
###[Speedy - 简洁灵活的 Laravel 管理后台](https://laravel-china.org/articles/3829)
```js
项目地址： https://github.com/HanSon/speedy
```
###[搜索功能使用了此扩展包：](https://github.com/nicolaslopezj/searchable)
###[Composer 包来，支持 Laravel 的事件广播](https://laravel-china.org/topics/3630)
###[Request::intersect (...) 一个可以让你初步远离意大利面条的函数](https://laravel-china.org/topics/3781)
```js
$record = Record::findOrFail($id);

if ($request->has('title')) {
    $record->title = $request->title;
}

if ($request->has('label')) {
    $record->label = $request->label;
}

if ($request->has('year')) {
    $record->year = $request->year;
}

if ($request->has('type')) {
    $record->type = $request->type;
}

$record->save();
$record = Record::findOrFail($id);

$record->update($request->intersect([
    'title',
    'label',
    'year',
    'type'
]));
 public function intersect($keys)
    {
        return array_filter($this->only(is_array($keys) ? $keys : func_get_args()));
    }
```
###[Laravel 认证原理及完全自定义认证](https://laravel-china.org/articles/3825)
表单请求的时候所有的内容格式为 string , 所以不会有 true / false 存在了。 当然了，在写 API 时候 content-type: application/json 这类请求的时候还是不能直接这样用这个 feature 的。值为 0，0.0 的也会被过滤
```js
如果使用 $request->only() 方法，即使数据不在 request data 中，only 方法也会将数据设置为 null，而其他两个示例则会过滤掉不在 request data 中的数据
Request::macro('pick', function ($keys) {
    return array_intersect_key($this->all(), array_flip($keys));
});

$request = Request::create('/', 'GET', [
    'a' => 'foo',
    'b' => null,
    'c' => false,
]);

dd([
    'only' => $request->only(['a', 'b', 'c', 'd']),
    'intersect' => $request->intersect(['a', 'b', 'c', 'd']),
    'pick' => $request->pick(['a', 'b', 'c', 'd'])
]);

array:3 [
  "only" => array:4 [
    "a" => "foo"
    "b" => null
    "c" => false
    "d" => null  <-- 即使不在 request data 中，only 方法会默认设置为 null
  ]
  "intersect" => array:1 [
    "a" => "foo"
  ]
  "pick" => array:3 [
    "a" => "foo"
    "b" => null
    "c" => false
  ]
]
```
###[Redis 五种常见使用场景下 PHP 实战](https://laravel-china.org/articles/3884)
克隆项目： git clone git@github.com:TIGERB/easy-tips.git
运行脚本： php redis/test.php [实例名称]，
例如测试悲观锁： 运行 php redis/test.php p-lock
###[aliyun 发送短信的扩展包](https://laravel-china.org/topics/3875)
composer require cmzz/laravel-aliyun-sms 
$smsService = App::make(AliyunSms::class);
$smsService->send(strval($mobile), 'SMS_xxx', ['code' => strval(1234), 'product' => 'xxx']);
###[用 Jenkins 部署 PHP 应用](https://laravel-china.org/articles/3880)
###[对 REST 的理解](https://laravel-china.org/articles/3785)
所有的东西都是资源，我们始终是在操作资源，当然资源需要是个名词。

于是我们定义出这样一些资源，users, products, orders, vendors。注意这里是复数，因为既然是资源，肯定是一堆，是个集合。单复数的概念还是很重要的。

###[GitHub 导航栏](https://laravel-china.org/topics/3805)
git clone git@github.com:RryLee/github-light-header.git

打开 chrome://extensions
###[为 Laravel 博客添加 SiteMap 和 RSS 订阅](https://laravel-china.org/topics/3794)
###[vue 的表单验证插件](https://laravel-china.org/topics/3846)
https://github.com/logaretm/vee-validate
###[Laravel5.3 版本的后台管理系统](https://laravel-china.org/topics/3768)
https://github.com/DukeAnn/Laradmin
###[Laravel 5.4 MySQL 数据库字符编码变更引起的字符串长度问题](https://laravel-china.org/topics/3852)
原因是5.4版本的 Laravel 将 mysql 默认字符编码换成了utf8mb4 ，见config/database.php
```js
'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        
        utf8 的 varchar 类型字符串最长255，换成utf8mb4最长是191，然而框架里面默认长度还是用的 255 导致长度不够了，暂时解决方法是在 app/Providers/AppServiceProvider.php 添加字符默认长度：

 use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
$table->string('phone')->charset('utf8')->collate('utf8_general_ci')
```
###[iTerm 2 上简单安装 Fish 并配置主题](https://laravel-china.org/articles/3647)
###[Git 的使用基础和示例](https://laravel-china.org/topics/3849)
###[ Laravel 内 PHP artisan 命令提示 “Mcrypt PHP extension required” 的解决办法](https://laravel-china.org/topics/3837)
# Setting PATH for Python 3.5
# The orginal version is saved in .bash_profile.pysave
PATH="/Library/Frameworks/Python.framework/Versions/3.5/bin:${PATH}" 
PATH="/Applications/MAMP/bin/php/php5.5.26/bin:${PATH}"
export PATH
###[为 Laravel 开发而配置的 Sublime Text 3](https://laravel-china.org/articles/3688)
###[跟我一起学 Laravel-EloquentORM 基础部分](https://laravel-china.org/articles/3817) 
###[高效的从 HTML 中提取正文的类库](https://laravel-china.org/topics/3821)
composer require "mylukin/textractor:dev-master"
```js
<?php
$url = 'http://news.163.com/17/0204/08/CCDTBQ9E000189FH.html';
// 创建提取实例
$textractor = new \Lukin\Textractor();
// 下载并解析文章
$article = $textractor->download($url)->parse();

printf('<div id="url">URL: %s</div>' . PHP_EOL, $url);
printf('<div id="title">Title: %s</div>' . PHP_EOL, $article->getTitle());
printf('<div id="published">Publish: %s</div>' . PHP_EOL, $article->getPublishDate());
printf('<div id="text">Text: <pre>%s</pre></div>' . PHP_EOL, $article->getText());
printf('<div id="html">Content: %s</div>' . PHP_EOL, $article->getHTML());
```
###[自己关于一个项目的编程思路](https://laravel-china.org/topics/3792)
###[Laravel 用户认证体系详解](https://laravel-china.org/articles/3758)
###[Laravel 技巧之 Pivot](https://laravel-china.org/articles/3798)
$user = App\User::find(1);
foreach ($user->roles as $role) {
    echo $role->pivot->created_at;
}
###[PHP Swoole 蝌蚪聊天室](https://laravel-china.org/topics/3746)
https://github.com/zhaohehe/swoole-tadpole 
###[搭建博客必备：图片拖动文本框自动上传]()
###[用好 Webpack2 从一个完整的配置开始](https://laravel-china.org/articles/3783)
###[添加多个 Homestead box](https://laravel-china.org/articles/3772)
git clone https://github.com/laravel/homestead.git NewHomestead
###[Laravel5.4 中使用 browsync 监控 CSS 并自动刷新页面](https://laravel-china.org/topics/3778)
###[HTTPS 背后的内幕](https://laravel-china.org/articles/3754)
 HTTPS = HTTP + TLS/SSL
 ###[Monolog 优化及打造 ELK 友好的日志格式](https://laravel-china.org/topics/3567)
 ###[使用 Laravel Queue 不得不明白的知识](https://laravel-china.org/articles/3729)
 使用队列是为了：

异步
重试
耗时比较久的，比如上传一个文件后进行一些格式的转化等。
需要保证送达率的，比如发送短信，因为要调用别人的 api，总会有几率失败，那么为了保证送达，重试就必不可少了。
在开发环境我们想测试的时候，可以把 Queue driver 设置成为 sync，这样队列就变成了同步执行，方便调试队列里面的任务。
Job 里面的 handle 方法是可以注入别的 class 的，就像在 Controller action 里面也可以注入一样
本地调试的时候要使用 queue:listen，因为 queue:work在启动后，代码修改，queue:work不会再 Load 上下文，但是 queue:listen仍然会重新 Load 新代码
Redis 里面一个任务默认最多执行60秒，如果一个任务60秒没有执行完毕，会继续放回到队列中，循环执行
###[设计模式实践--单例模式](https://laravel-china.org/articles/3683)
```js
class test 
{
    private static $_instance;    //保存类实例的私有静态成员变量

    //定义一个私有的构造函数，确保单例类不能通过new关键字实例化，只能被其自身实例化
    private final function __construct() 
    {
        echo 'test __construct';
    }

    //定义私有的__clone()方法，确保单例类不能被复制或克隆
    private function __clone() {}

    //对外提供获取唯一实例的方法
    public static function getInstance() 
    {
        //检测类是否被实例化
        if ( ! (self::$_instance instanceof self) ) {
            self::$_instance = new test();
        }
        return self::$_instance;
    }
}

test::getInstance();
在容器中，普通对象的绑定通过bind()方法，示例如下：

$app = new System\Foundation\Container();

$app->bind('test', \System\test::class);
而要绑定一个单例对象的时候则用下面的方式：

$app->singleton('test', \System\test::class);
```
###[PHP 中 static 静态属性和静态方法的调用](https://laravel-china.org/articles/3652)
```js
class Human{
 static public $name = "妹子";
 public $height = 180;
 public $age;
// 构造方法
public function __construct(){
   $this->age = "Corwien";
   // 测试调用静态方法时，不会执行构造方法，只有实例化对象时才会触发构造函数，输出下面的内容。
  echo __LINE__,__FILE__,'<br>'; 

}
 static public function tell(){
 echo self::$name;//静态方法调用静态属性，使用self关键词
 //echo $this->height;//错。静态方法不能调用非静态属性
//因为 $this代表实例化对象，而这里是类，不知道 $this 代表哪个对象
 }
 public function say(){
 echo self::$name . "我说话了";
 //普通方法调用静态属性，同样使用self关键词
 echo $this->height;
 }
}
$p1 = new Human();
$p1->say(); 
$p1->tell();//对象可以访问静态方法
echo $p1::$name;//对象访问静态属性。不能这么访问$p1->name
//因为静态属性的内存位置不在对象里
Human::say();//错。say()方法有$this时出错；没有$this时能出结果
//但php5.4以上会提示

/* 
 调用类的静态函数时不会自动调用类的构造函数。
测试方法，在各个函数里分别写上下面的代码 echo __LINE__,__FILE__,'<br>'; 
根据输出的内容，就知道调用顺序了。
*/
// 调用静态方法，不会执行构造方法，只有实例化对象时才会触发构造函数，输出构造方法里的内容。
Human::tell();
```
###[Goutte 一个简单易用的 PHP 爬虫类库](https://laravel-china.org/articles/3701)
```js
public function scrapePHPUnitDe()
{
    $client = new Client();
    $crawler = $client->request('GET', 'https://phpunit.de/manual/current/en/index.html');
    $toc = $crawler->filter('.toc');
    file_put_contents(base_path('resources/docs/').'index.html', $toc->html());

    $crawler->filter('.toc > dt a')->each(function($node) use ($client) {
        $href = $node->attr('href');
        $this->info("Scraped: " . $href);
        $crawler = $client->request('GET', $href);
        $chapter = $crawler->filter('.col-md-8 .chapter, .col-md-8 .appendix')->html();
        file_put_contents(base_path('resources/docs/').$href, $chapter);
    });
}
```
###[Laravel 做 App 接口和后台开发](https://laravel-china.org/topics/3629)
https://github.com/vvXiao/laravel-exa
###[Rbac-Laravel 拓展包，轻松搞定权限控制！](https://laravel-china.org/topics/3589)
###[MySQL 5.7 之联合（复合）索引实践](https://laravel-china.org/topics/3565)
###[对数据进行签名](https://laravel-china.org/topics/3569)
如果目标数据是个数组，就需要先进行ksort排序，然后在转换为字符串，转换字符串自然就想到用json_encode了。最后进行签名，调用hash_hmac或者私钥签名。
https://www.v2ex.com/t/326285 
###[PHP调用phantomjs](https://laravel-china.org/topics/3590)
http://jonnnnyw.github.io/php-phantomjs/4.0 
###[PHP 登录 QQ，支付宝等网站](https://laravel-china.org/topics/3908)
https://github.com/facebook/php-webdriver 
```js
namespace App\Helpers;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class QQHelper
{
    static protected $users=[];

    static protected $cookieJar;

    static protected $host = 'http://localhost:4444/wd/hub';

    static protected $driver;

    static protected $loginUrl='http://ui.ptlogin2.qq.com/cgi-bin/login?style=9&pt_ttype=1&appid=549000929&pt_no_auth=1&pt_wxtest=1&daid=5&s_url=https%3A%2F%2Fh5.qzone.qq.com%2Fmqzone%2Findex';

    static public function login(){

        self::$driver = RemoteWebDriver::create(self::$host, DesiredCapabilities::chrome(),5000);

        self::$driver->get(self::$loginUrl);

        self::$driver->findElement(WebDriverBy::id('guideSkip'))->click();

        self::$driver->findElement(WebDriverBy::id("u"))->sendKeys('10000');//账号

        self::$driver->findElement(WebDriverBy::id("p"))->sendKeys('password');//密码

        self::$driver->findElement(WebDriverBy::id('go'))->click();

        self::$cookieJar=self::$driver->manage()->getCookies();

        print_r(self::$cookieJar);

        //self::$driver->quit();

    }

}
```
https://httpstatuses.com/ 
###[程序员如何写好简历 && 一份优秀的程序员简历是什么样的?](https://zhuanlan.zhihu.com/p/25220298)
###[优化 centos 服务器](https://www.v2ex.com/t/343252#reply22)

```js
Linux 内存不是用的越少越好， Centos7 版本以前，通常看到的内存 used 比较多是因为包含了 buffer 和 cache 占用 
Centos7 版本以后，内存 used 显示数值不包含 buffer 和 cache 

Linux 中内存不用白不用，会尽可能的 cache 和 buffer 一些数据，以方便下次使用。 
但实际上这些内存大部分也是在应用需要的时候可以释放出来供应用使用。 

大部分人在对 linux 做内存优化，都是简单的关闭不使用的服务，调整自己应用的参数来减少内存的占用 
因此我也仅通过最简单的方式来介绍下如何调整 

关闭服务 
======= 
Centos7 版本以前可以通过 chkconfig --list 来查看服务列表 
找到当前 runlevel 下自启动的服务名，然后通过 chkconfig --level 3 service_name off 关闭指定 RUNLEVEL 下自启动服务 
重启后生效或者通过 /etc/init.d/servicce_name stop 的方式来实时生效。 

Centos7 以后的版本需要通过 systemctl list-unit-files --type=service --state=enabled 查看自启动服务 
通过 systemctl disable service_name 关闭启动 
通过 systemctl stop service_name 停止服务运行 

调整应用参数 
========== 
这个部分需要了解自己启动的服务软件简单的工作原理和配置方法 
VPS 中安装的 LNMP 环境主要包含三个套件： Nginx, MySQL, php 

Nginx 
====== 
工作进程数量直接决定了 Nginx 对内存的占用，平均一个工作进程占用 10~40m 不等 
可通过配置文件中 worker_processes 指定 

MySQL 
====== 
MySQL 比较复杂，大致可以从全局共享内存使用和线程独享内存使用两个方向入手 

全局共享内存可理解为 MySQL 启动的时候就需要分配的全局内存使用 
比较明显的是可以调整以下几个参数（但不完全就是以下几个） 
key_buffer_size 
innodb_buffer_pool_size 
innodb_additional_memory_pool_size 
innodb_log_buffer_size 
query_cache_size 

线程独享内存使用可以理解为每个到 MySQL 的链接都会分配一部分内存 
read_buffer_size 
sort_buffer_size 
read_rnd_buffer_size 
tmp_table_size 

除此之外 MySQL 还有灰常多的参数可以调整影响到内存的使用，可以参考官方文档了 

以上列出的参数，也并不是调整了就有效果，因为 MySQL 还有一个重要的东西就是存储引擎 
常用的比如 InnoDB ， MyISAM 很多参数都是针对存储引擎的，比如你只使用 InnoDB,却调整了 MyISAM 的参数 
那也是没有效果的 

php 
==== 
由于本人没有搞过 php 所以具体也不清楚详细的调整 
php 没有运行在 nginx 下的 module ，所以大部分通过 php-fpm 的方式启动 
php-fpm 提供 fastcgi 的协议访问， nginx 再通过 fastcgi 反代到 php-fpm 

所以这里的 php-fpm 也是一个多进程应用，也可以通过调整 php-fpm 的启动进程数量来达到控制内存占用的效果 


以上这些都是从简单的方面来优化的，但还是那句话，一切看你时机的使用情况，这些参数不是越低越好 
比如 nginx 只给 1 个进程。 php-fpm 只给一个进程，在你狂刷浏览器时就会发现你经常会遇到 502 ， 503 错误 

鉴于在题主是在放在 vps 中的小博客，实在不需要搞到太深度的调优。如果想了解仍可去搜索一些相关的资料: 
linux 内核参数调优 
linux io 队列调优 
nginx 如何通过编译安装精简模块 
php 编译安装 精简不必要模块 
mysql 编译安装精简存储引擎
```
###[GitBook 使用教程](https://www.v2ex.com/t/343338)
http://gitbook.zhangjikai.com/ 
###[pjax 的简单应用](https://www.v2ex.com/t/343325#reply2)
###[服务器抓包 HTTP 的工具](https://www.v2ex.com/t/343223)
Github: https://github.com/six-ddc/httpflow
###[ cURL 然后在这个网站能直接转换为 requests 格式](https://www.v2ex.com/t/343342#reply4)
https://curl.trillworks.com/ 
###[php str_replace替换关键词，如何控制长词优先](https://segmentfault.com/q/1010000008320325)
```js
$str0 = 'php技术 是时下最好用的 php'; // 替换成 'java技术 是时下最好用的 编程技术' 
$str1 = 'php技术';
$str2 = 'php'
// 比较字符串长短，并组合成数组
function compare(){
    $vars = func_get_args();
    $list = array();
    $len  = array();
    $rel  = array();
    
    // 收集长度 + 对照表
    foreach ($vars as $k => $v)
        {
            $l        = mb_strlen($v);
            $list[$k] = $l;
            $len[]    = $l;
        }
    
    $count = count($len);
    
    // 选择排序：对长度进行比较
    for ($i = 0; $i < $count; ++$i)
        {
            $longest = $i;
            
            for ($n = $i + 1; $n < $count; ++$n)
                {
                    if ($len[$i] < $len[$n]) {
                        $longest = $n;
                    }
                }
            
            if ($i !== $longest) {
                $tmp = $len[$i];
                $len[$i] = $len[$longest];
                $len[$longest] = $tmp;
            }
        }
     
     // 搜集整理
     foreach ($len as $v)
         {
             $rel[$v] = $list[$v];
         }
         
    // 返回最终结果
    return $rel;
}

// 队列方式按照长的先替换
$rel = compare($str1 , $str2);
$replace = array('java' , '编程技术');

for ($i = 0; $i < count($rel); ++$i)
    {
        $str0 = preg_replace($rel[$i] , $replace[$i] , $str0);
    }
```
###[Laravel Passport在前后端分离](https://segmentfault.com/q/1010000008481512)
```js
通过事件监听来清理token的方法：
将事件注册到 EventServiceProvider 中，代码如下：

protected $listen = [
    'App\Events\SomeEvent' => [
        'App\Listeners\EventListener',
    ],
    'Laravel\Passport\Events\AccessTokenCreated' => [
        'App\Listeners\Auth\RevokeOldTokens',
    ],
    'Laravel\Passport\Events\RefreshTokenCreated' => [
        'App\Listeners\Auth\PruneOldTokens',
    ],
];

```
###[闭包原理](https://segmentfault.com/q/1010000008491951)
```js
var a = [];
for (var i = 0; i < 10; i++) {
  a[i] = (function(index){
    return function(){console.log(index)}
  })(i)
}
a[6](); // 6
```
###[链式调用](https://segmentfault.com/q/1010000008491351)
```js
umber.prototype.add=function(num){return Number(this + num)}
Number(10).add(20).add(30)
Number.prototype.add=function(num){return this+num}
(10).add(20)
```
###[javascript模仿重载](https://segmentfault.com/q/1010000008491969)
```js
function a(){
  if(arguments.length===1){
    //执行某些代码
  }else if(arguments.length===2){
    //执行另一些代码
  }

}
```
###[如何屏蔽页面上所有a标签的跳转](https://segmentfault.com/q/1010000008491960)
document.querySelectorAll('a').forEach(a => {a.onclick=(e) => {e.preventDefault()}}) 
###[mysql根据某个字段已存在的值排序](https://segmentfault.com/q/1010000008471094)
```js
CREATE FUNCTION `sort_col`(`input` VARCHAR(50))
    RETURNS VARCHAR(50)
    LANGUAGE SQL
    NOT DETERMINISTIC
    NO SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

declare a int;
declare b int;
declare c int;

set a = cast(substr(input, 3, 3) as int);
set b = cast(substr(input, 9, 3) as int);
set c = cast(substr(input, 15, 3) as int);

if (a <= b && b <= c) then
  return concat('["', a, '","', b , '","', c , '"]');
elseif (b <= a && a <= c) then
 return concat('["', b, '","', a , '","', c , '"]');
elseif (c <= a && a <= b) then
 return concat('["', c, '","', a , '","', b , '"]');
elseif (c <= b && b <= a) then
 return concat('["', c, '","', b , '","', a , '"]');
elseif (a <= c && c <= b) then
 return concat('["', a, '","', c , '","', b , '"]');
elseif(b <= c && c <= a) then
 return concat('["', b, '","', c , '","', a , '"]');
end if;
END
update table_name set values = sort_col(values);
```
###[有一个函数名（字符串形式），如何能够调用这个函数？](https://segmentfault.com/q/1010000008491531)
```js

import sys
def afunc():
    return 0
s= "afunc"
get_afunc = getattr(sys.modules[__name__], s)
print get_afunc()
```
###[微博第三方登录，授权回掉页面如何获取code？](https://segmentfault.com/q/1010000008407752)
授权回调页 :必须设置为自己网站的地址，这样就可以接收到了。
###[如何让浏览器文本排版和记事本排版效果一样](https://segmentfault.com/q/1010000008490153)
放 pre 里，然后使用 monospace 字体。
###[批量替换超大量的html文本](https://segmentfault.com/q/1010000008479762)
```js
#!/bin/bash
A=($(find . -name '*.html'))
for((i=0;i<${#A[@]};i+=10000))
do
    sed -i 's@xxxx@oooo@g' ${A[@]:$i:10000} &
done
wait
find    ./   -name  "*.html"  -exec  grep "1234" {} \; -exec sed -i 's/1234/5678/g' {} \;
```
###[python 利用subprocess库调用mplayer](https://segmentfault.com/q/1010000008482564)
```js
import subprocess
 
p = subprocess.Popen(["mplayer", "-slave", "-quiet", "/home/pi/Music/爱的翅膀.mp3"], stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False)
 
p.stdin.write('\n') 
print p.stdout.read() //此处
p.stdin.write('get_time_pos\n')
print p.stdout.read()
mplayer播放时会向stout输入大量字符，超过了4096造成死锁，输出信息不在我的需求之中，因此决定修改stdout=open("/dev/null","w")
```
###[Laravel 5.1 如何 migrate 某一个指定的迁移文件](https://segmentfault.com/q/1010000008485186)
在 database/migrations/ 目录下创建一个新的目录，比如 single/
将你要 migrate 的那个文件移到上一步创建的 single/ 目录
命令行执行下面的命令：
php artisan migrate --path=/database/migrations/single
###[touchmove e.preventDefault() 不生效](https://segmentfault.com/q/1010000008484849)
chrome,或者说再webkit核浏览器里，当你浏览器在一个滚动的状态时，touchmove的cancelable属性被默认置为false，所以preventDefault是不会生效的。

所以要么你在start的时候就阻止，要么就换一种方式去达到你的需求
###[前端预览图片，用Base64和objectURL哪个更好](https://segmentfault.com/q/1010000008228165)
```js
input.onchange = function(e) {
    [...this.files].map(file => {
        const img = new Image();

        // 方案1 ObjectURL
        img.src = window.URL.createObjectURL(new Blob([file], {type: file.type}));
        document.body.appendChild(img);

        // 方案2 Base64
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            document.body.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
}
```
###[H5页面在手机端如何实现复制粘贴板功能](https://segmentfault.com/q/1010000008464484)
```js
<div id="copy" data-clipboard-text="Copy Me!">Click to copy</div> 
<script src="ZeroClipboard.js"></script> <script> var clip = new
ZeroClipboard( document.getElementById('copy') ); </script>

If you need non-flash support for iOS you just add a fall-back:clip.on( 'noflash', function ( client, args ) {

$("#copy").click(function(){            
    var txt = $(this).attr('data-clipboard-text');
    prompt ("Copy link, then click OK.", txt);
}); });   
```
###[POST提交为什么比Get提交数据量大](https://segmentfault.com/q/1010000008487254)
浏览器及 HTTP 服务器的实现限制了 URL 的长度，从而限制了 GET 能够提交的数据量。

或者你想问同样的数据，你使用 POST 提交会比 GET 提交消耗掉更多的流量？

是会多出那么一点点。你把两种方法的全文写出来就知道啦。多了 Content-Length 和 Content-Type 头
###求数组2个值的和为6
```js
$arr=[1,5,8,11,44];
for ($i=0;$i<count($arr);$i++){
  for ($j=0;$j<count($arr);$j++){
   if($arr[$i]+$arr[$j]==6){echo $arr[$i],$arr[$j];echo '<br>';}//5 1
}
}
```
