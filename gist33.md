[Laravel 后台管理扩展包 Voyager 汉化](https://laravel-china.org/topics/4581/laravel-background-management-expansion-pack-voyager)
[Laravel 消费队列的正确使用姿势](https://laravel-china.org/articles/4605/laravel-use-of-the-correct-attitude-of-the-consumer-queue)
queue:work - 这是一个新的后台进程（不再需要 daemon 标记）， 这种方式运行，框架只会启动一次，并保持循环去消费队列
queue:listen - 这种方式运行，框架每次都会启动，运行job，然后关闭，然后再次启动框架，运行job
luminate\Queue\Console\WorkCommand.php

protected $signature = 'queue:work
session_start()前面不能有任何代码 这个描述是不正确的。正确描述应该是 session_start 之前不能有输出语句，如果 echo var_dump 等，使用 ob_start 等缓冲处理情况除外。
[Laravel 的命令版 Siri — 交互式生成命令](https://laravel-china.org/articles/4601/laravel-command-version-siri-interactive-generation-command)
composer require laracademy/interactive-make 
Laracademy\Commands\MakeServiceProvider::class,
php artisan make
[Laravel5.4+vue2 做的基本后台系统](https://laravel-china.org/topics/4063/laravel54vue2-basic-background-system)
[有道翻译的插件](https://laravel-china.org/topics/4628/pure-nothing-idle-wrote-a-translation-of-the-plug-in)
https://github.com/redrain-wang/laravel-youdao  php artisan vendor:publish
[SESSION_DOMAIN 导致的 TokenMismatchException](https://laravel-china.org/topics/4635/laravel-53-session-domain-leads-to-tokenmismatchexception)
在本地，只要把session_domain删掉，用默认的设置null，即可解决问题。
[ThinkSNS+ 基于 Laravel master 分支](https://laravel-china.org/articles/4584/thinksns-based-on-laravel-master-branch-from-1-to-0-and-then-to-the-01)
[基于 easywechat 的一个微信文字消息回复包](https://laravel-china.org/topics/4624/easywechat-based-on-a-wechat-text-message-reply-package)
https://github.com/RunnerLee/wechat-answer 
[基于 Laravel 的工作流](https://laravel-china.org/articles/4627/workflow-based-on-laravel)
[又拍云的 Laravel Package](https://laravel-china.org/topics/4626/wrote-a-package-and-then-shoot-the-cloud-laravel)
https://github.com/JellyBool/flysystem-upyun
[Laravel 5.4+Bootstrap 写的商城小 demo](https://laravel-china.org/topics/4577/share-a-laravel-54bootstrap-to-write-a-small-mall-demo#reply5)
支付使用包(omnipay-alipay/omnipay-wechatpay)来完成，目前只支持支付宝与微信，微信做了扫码支付功能；  https://github.com/freedomlizhigang/laravelDemo/tree/xyshop
[Laravel5.4 版本的后台管理系统](https://laravel-china.org/topics/3768/laravel54-version-of-the-background-management-system-seek-advice)
https://github.com/DukeAnn/Laradmin 
[Laravel 之队列使用浅析](https://laravel-china.org/articles/4479/analysis-of-laravel-queue-usage)
/home/niuyufu/php/bin/php /home/niuyufu/webroot/snail_api/artisan queue:work --queue=snail:SendMessage --tries=3 --memory=512 --daemon
监控redis对应队列消息具体产生的消息操作如下

tail -f | redis-cli -h 10.94.120.13 -p 6380 monitor | grep "queues:snail"
[PHP Composer 简明教程](https://laravel-china.org/articles/4615/php-composer-concise-tutorial#reply1)
"autoload": {
"psr-4": {
    "Foo\\": "src/"
}
}src/Bar/Hello.php”类文件中定义的Hello类，就可以通过命名空间“Foo\Bar\Hello”来使用了
Collection 可以使用 isEmpty 来判断是否为空，或者 调用 count 方法来判断。 不用 toArray 和 empty 来判断是否为空。
[LaraCSV--从 Eloquent 模型中生成 CSV 文件](https://laravel-china.org/articles/4533/laracsv-generates-csv-file-from-eloquent-model)
 $users = User::get(); // All users
   $csvExporter = new \Laracsv\Export();
   $csvExporter->build($users, ['email', 'name'])->download();
 https://github.com/usmanhalalit/laracsv   
[laravel一个项目的初始及开发流程](https://laravel-china.org/articles/4597/the-initial-and-development-process-of-a-project) 
[让简单工厂模式遵循开放封闭原则 (OCP)](https://laravel-china.org/articles/4330/let-the-simple-factory-model-follow-the-open-closed-principle-ocp)
```js
class Factory
{
    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function register($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $alias => $class) {
                $this->register($alias, $class);
            }
        } else {
            $this->items[$key] = $value;
        }

    }

    public function create($key)
    {
        if (array_key_exists($key, $this->items)) {
            return new $this->items[$key];
        }

        throw new InvalidArgumentException("Key [{$key}] is not registered.");
    }
}

// Test

$factory = new Factory;

$factory->register('std', StdClass::class);
$factory->register('dom', DOMDocument::class);
$factory->register('exception', Exception::class);

$classes = [
    'time' => DateTime::class,
    'queue' => SplQueue::class,
    'array' => ArrayObject::class,
];

$factory->register($classes);

var_dump(
    $factory->create('dom'),
    $factory->create('queue'),
    $factory->create('exception')
);
```
[某个 Class 或某个 Trait 突然找不到](https://laravel-china.org/articles/3782/a-pit-reminder-a-class-or-a-trait-suddenly-can-not-find)
删除旧文件，提交代码。
添加新文件，提交代码。
git config core.ignorecase false
[PHP 依赖注入容器 Pimple 笔记](https://laravel-china.org/articles/4276/php-dependency-injection-container-pimple-notes)
https://www.h57.pw/aritlce/42 
[简化你的关注与点赞 - Laravel Follow & Vote](https://laravel-china.org/articles/4408/simplify-your-attention-with-the-point-of-praise-laravel-follow-vote)
[Git submodule 的笔记](https://laravel-china.org/articles/4430/git-submodule-notes)
[frp 内网穿透简单教程](https://laravel-china.org/articles/4200/frp-network-through-a-simple-tutorial)
[如何构建一个自己的PHP框架](https://github.com/TIGERB/easy-php/blob/master/README-CN.md)
[谁动了我的内存之 PHP 内存溢出](https://laravel-china.org/articles/4356/who-moved-my-memory-php-memory-overflow)
ini_set('memory_limit','100M');循环,分段读取数据,读数据库的话可以用limit
[Speedy - 简洁灵活的 Laravel 管理后台](https://laravel-china.org/articles/3829/speedy-simple-and-flexible-laravel-management-background)
https://github.com/HanSon/speedy 
[让程序飞起来之 Laravel OPcache Package](https://laravel-china.org/articles/4362/let-the-program-fly-laravel-opcache-package)
composer require appstract/laravel-opcache  实现 OPcache 的一个缺点是每次更改任何 PHP 代码时你都不得不去清除缓存
php artisan opcache:clear 
[书童造轮子之自动生成数据字典](https://laravel-china.org/articles/4327/automatic-generation-of-data-dictionary-for-childrens-wheel)
composer require jormin/laravel-ddoc  
[laracasts.com 用的录屏软件](https://laravel-china.org/topics/4353/recording-software-for-laracastscom)
https://www.telestream.net/screenflow/overview.htm
[使用 anyproxy 二次开发的微信公众号抓取工具，可以抓阅读数，点赞数，赞赏数和回复数](https://laravel-china.org/articles/4352/wechat-spider)
https://github.com/lijinma/wechat_spider 
[微信小程序 for Laravel 5](https://laravel-china.org/topics/3824/wechat-applet-for-laravel-5)
[Windows 7 上安装 Homestead 遇到的坑](https://laravel-china.org/articles/4358/windows-7-installed-on-homestead-encountered-pit)
composer有好几个国内镜像，比如我的https://www.composer-proxy.org
[在 Laravel 上撸了一个支持多语言的国家地区数据库](https://laravel-china.org/articles/4354/in-the-laravel-line-and-a-multi-language-country-database)
https://github.com/khsing/laravel-world
[基于 Windows 开启我的 Homestead 之旅 --PHPHub 安装](https://laravel-china.org/articles/4297/windows-based-on-my-homestead-tour-phphub-installation)
[yaf-example](https://laravel-china.org/articles/4308/yaf-example)
https://github.com/jsyzchen/chen-yaf
[一个简单易用的 Vue 组件 V - Distpicker](https://laravel-china.org/articles/4161/a-simple-and-easy-to-use-vue-component-v-distpicker)
[Laravel 5.1 加载流程 / 图形化](https://laravel-china.org/articles/4335/laravel-51-loading-process-graphical)
[移动端后台开发 (加密验证--非通用接口篇）](https://laravel-china.org/articles/4294/mobile-backend-development-encryption-verification-non-generic-interface)
[基于 Laravel 5 开发的轻量化手机短信服务包](https://laravel-china.org/articles/4302/lightweight-mobile-phone-short-message-service-package-based-on-laravel5)
https://github.com/phper2013/laravel-sms
[CentOS6 基于 Python 安装 Sentry](https://laravel-china.org/articles/4295/centos6-install-python-based-on-sentry)
[简单轻松部署你的项目 - Deployer](https://laravel-china.org/articles/4389/simple-and-easy-to-deploy-your-project-deployer)
[Laravel 缓存花样耍](https://laravel-china.org/articles/4371/laravel-cache-tricks)
```js
$fullUrl = request()->fullUrl();
return Cache::remember($fullUrl, $minutes, function () use ($data) {
    return $data;
});
$url = request()->url();
$queryParams = request()->query();

//对查询参数按照键名排序
ksort($queryParams);

//将查询数组转换为查询字符串
$queryString = http_build_query($queryParams);

$fullUrl = "{$url}?{$queryString}";

```
[省市区街道四级联动（2017年最新实时更新）](https://laravel-china.org/topics/4323/urban-street-four-linkage-2017-update)
http://api.131.im/address/province.json  
[写一个搜索：使用 Laravel Scout，Elasticsearch，ik 分词](https://laravel-china.org/articles/4027/tutorial-write-a-search-use-laravel-scout-elasticsearch-ik-word-segmentation)
https://github.com/lijinma/laravel-scout-elastic-demo
[说说 PHP 的魔术方法及其应用](https://laravel-china.org/articles/4404/talking-about-the-magic-method-of-php-and-its-application)
[GitHub 多账号的 SSH 配置](https://laravel-china.org/articles/4411/github-multi-account-ssh-configuration)
$ git clone git@user2.github:EvaEngine/Dockerfiles.git地址中的 host 替换为了 config 中配置的名称。
git@github.com:EvaEngine/Dockerfiles.git
[检测颜值包，基于微软小冰https://github.com/HanSon/face](https://laravel-china.org/articles/4401/detection-of-yan-value-package-based-on-microsoft-wheatgrass)
https://github.com/HanSon/face  http://kan.msxiaobing.com/
[镜像了一个 Linux 中文命令手册](http://linux-command.composer-proxy.org/)
[結合 Laravel 與 Swoole，更簡易的開發與佈署！](https://laravel-china.org/articles/4390/swoole-the-combination-of-laravel-and-swoole-the-development-and-deployment-of-more-simple)
[说说 API 的防重放机制](https://laravel-china.org/articles/4196/talk-about-the-anti-replay-mechanism-of-api)
我们常用的防止重放的机制是使用timestamp和nonce来做的重放机制。 nonce是由客户端根据足够随机的情况生成的，比如 md5(timestamp+rand(0, 1000)); 它就有一个要求，正常情况下，在短时间内（比如60s）连续生成两个相同nonce的情况几乎为0。
https://github.com/LingxiTeam/api-authentication  
[app移动端后台开发 (加密验证--通用接口篇）](https://laravel-china.org/articles/4290/mobile-backend-development-encryption-verification-generic-interface)
[灵析团队 package 陆续开源，向社区贡献力量](https://laravel-china.org/articles/4251/analysis-team-package-open-source-to-contribute-to-the-community)
[Laravel+VueJs 知乎](https://laravel-china.org/articles/4466/laravelvuejs-know-almost)
https://github.com/GeekGhc/zhihu-app 
[Editor.md For Laravel 5](https://laravel-china.org/articles/4168/editormd-for-laravel5)
https://github.com/LaravelChen/laravel-editormd 
[Laravel 5.4 vue 实现收藏](https://laravel-china.org/articles/4271/laravel-54-vue-collection)
https://github.com/ammezie/laravel-vue-favorite
[Laragon 让你在 Windows 下愉快的编码](https://laravel-china.org/articles/3994/laragon-allows-you-to-happy-coding-under-windows)
https://laragon.org/download.html
[分享一个 Trait 来易用 Laravel 的缓存](https://laravel-china.org/articles/4421/share-a-trait-to-use-laravel-cache)
https://github.com/deathkel/easy-cache
[Laravel-Geetest For Laravel 5](https://laravel-china.org/articles/4441/laravel-geetest-for-laravel5)
[Laravel 错误日志的插件 (Laravel-log-viewer)](https://laravel-china.org/articles/4419/laravel-error-log-plugin)
https://github.com/rap2hpoutre  
[搭建自己的 sentry 服务](https://laravel-china.org/articles/4285/build-your-own-sentry-service)
[ 利用二级缓存提高缓存命中率和内存使用效率](https://laravel-china.org/articles/4545/outside-the-box-using-two-levels-of-buffer-cache-hit-rate-and-improve-the-efficiency-of-memory-usage)
二级缓存可以看成业务逻辑的缓存，首页最新20条文章 就属于业务逻辑，只缓存这20条文章的id，极大地节省了内存占用。等需要用到具体的数据再去一级缓存取，一级缓存没有才去查询数据库
[Laravel 5.3 搭建的简单博客](https://laravel-china.org/articles/4505/share-a-simple-blog-laravel-53)
https://github.com/SadCreeper/myweb3.git
[接口测试的解决方案](https://laravel-china.org/articles/4470/interface-test-solution)
http://apidocjs.com/ 
[PHP 系统架构师成长之路](https://laravel-china.org/articles/4496/the-growth-path-of-php-system-architect)
[中文文案排版纠正器](https://laravel-china.org/articles/4532/chinese-copywriter)
https://github.com/ricoa/copywriting-correct 
[NGINX + SSH Tunnel 把本地开发环境公布到互联网上](https://laravel-china.org/articles/4522/nginx-ssh-tunnel-to-publish-the-local-development-environment-to-the-internet)
[Docker 的安装与常用指令](https://laravel-china.org/articles/4541/docker-installation-and-commonly-used-instructions)
[Nginx 新手配置引导](https://laravel-china.org/articles/4558/nginx-novice-configuration-guide)
[手机号码绑定流程](https://laravel-china.org/articles/4515/phone-number-binding-process)
[使用 ngrok 让外网也能访问本地](https://laravel-china.org/articles/4339/use-ngrok-to-allow-access-to-the-local-network)
https://github.com/HanSon/ngrok-script 
[Laravel 中文离线文档分享](https://laravel-china.org/topics/4026/laravel-chinese-offline-document-sharing)
[Laravel 中间件使用及源码分析](https://laravel-china.org/articles/4544/laravel-middleware-use-and-source-analysis)
[Laravel + Vue.js 的 SPA 项目中进行微信网页授权的一种姿势](https://laravel-china.org/articles/4539/laravel-vuejs-in-the-wechat-spa-project-in-a-position-authorized-by-the-page)
[Sentry 自动化异常提醒](https://laravel-china.org/articles/4235/sentry-automation-exception-alert)
[Nginx WebSocket 模块](https://laravel-china.org/topics/4595/nginx-websocket-module)
https://github.com/lvht/nginx-websocket-module
[发布一个为请求生成 id 的中间件](https://laravel-china.org/topics/4564/publishing-a-middleware-for-generating-id-requests)
composer require cmzz/laravel-request-id
 依赖注入原理其实就是利用类方法反射，取得参数类型，然后利用容器构造好实例。然后再使用回调函数调起。
[分享 Laravel 5.4 开发的博客系统](https://laravel-china.org/topics/4451/share-laravel-54-development-blog-system)
laravel的错误信息可以统一在：app/Exceptions/Handler.php 里面的 report() 方法里面发送。
[使用 Laravel Valet 做开发](https://laravel-china.org/articles/4546/development-using-laravel-valet)
[函数explode和split的区别](http://blog.csdn.net/diandianxiyu_geek/article/details/52177575)
[MDUI —— 基于 Material Design 的无依赖前端框架](https://laravel-china.org/topics/4570/mdui-an-independent-front-end-framework-based-on-material-design)
https://github.com/zdhxiong/mdui 

也就是说split函数并不支持PHP 7  split的第一个参数为正则表达式，也就是说，如果想要匹配特殊字符，需要转义一下。
$arr='2016\8\11';
$rearr = split ('[/\]', $arr);
[  HTML转换为pdf](https://wkhtmltopdf.org/)
[bug 管理平台](https://www.v2ex.com/t/359330)
产品一：bugclose （ www.bugclose.cn ） 产品二：delbug （ www.delbug.cn ） 产品三：easybug （ easybug.org ） 产品四：bugfree （ www.bugfree.cn ）
[当谈 SQL 优化时谈些什么？](https://www.qcloud.com/community/article/302356)
where语句中列的表达式为=、>、>=、<、<=、BETWEEN、ISNULL或者LIKE ’pattern’（其中’pattern’不以通配符开始）
每个AND组作为表达式匹配索引。
如果表达式中存在类型转换或者列上有复杂函数则与该列不匹配索引中的列。
索引的左前缀规则；索引中的列由左向右逐一匹配，如果中间某一列不能使用索引则后序列不在查询中不再被使用。
索引的cost基本是由“估计需要扫描的行数”（rows）来确定。数据来源于information_schema，在Mysql启动的时候读入内存，运行时只使用内存值，存储引擎会动态更新这些值。
type:索引的使用方式
eq_ref      …  索引,关联匹配若干行
   ref          …  索引(前缀)匹配   
    range        …  索引范围扫(BETWEEN、IN、>=、LIKE)得到数据
   index        …  索引全扫描
    all           …  表全扫描
    类型是否一致: int vs char（varchar）、varchar（32）vs varchar(64)
字符集是否一致：涉及表关联时，两表字符集是否一致。 避免大offset，使用where语句过滤更多的行。
    rows<1000，是在可接受的范围内的。
rows在1000~1w之间，在密集访问时可能导致性能问题，但如果不是太频繁的访问(频率低于1分钟一次)，又难再优化的话，可以接受，但需要注意观察
rows大于1万时，应慎重考虑SQL的设计，优化SQL
当执行计划Extra 出现Using filesort 、Using temporary 时，可以考虑是否需要进行sql优化和调整索引，最后再调整my.cnf 中与排序或者临时表相关的参数，如sort_buffer_size或者tmp_table_size
mysql查询只使用一个索引，如果where字句用了索引的话，那么order by 中的列是不会使用索引的。所以order by的条件也需要添加到索引里面组成联合索引
索引有个最左前缀的原则：联合索引（a,b,c）可以匹配(a)、（a,b）、（a,b,c）但不可以匹配(b,c)
发现数据库cpu或者io有异常现象时候，用show processlist看看数据库在忙什么
[https明文代理](https://github.com/alibaba/anyproxy)
[PHP图像裁剪缩略裁切类源代码及使用方法](http://blog.csdn.net/diandianxiyu_geek/article/details/50477015重点在于使用图像处理函数 imagecopy 和 imagecopyresampled)
[如何免费地、完整地把 PDF 转换为 Word？](https://www.zhihu.com/question/20841069/answer/47857848)
最好的PDF转换软件是 ABBYY FineReader  https://link.zhihu.com/?target=http%3A//www.abbyy.cn/
[Python实现文字转语音功能](https://zhuanlan.zhihu.com/p/26726297)
[介绍用Gephi进行数据可视化](https://zhuanlan.zhihu.com/p/26718634)
[当Python遇上微信，可以这么玩](https://zhuanlan.zhihu.com/p/26514576)
[搜索公众号文章批量采集抓取爬虫](https://zhuanlan.zhihu.com/p/24900456)
[在后台运行和管理进程PM2](https://www.zhihu.com/question/59227720/answer/163372371)
[有哪些命令行的软件堪称神器](https://www.zhihu.com/question/59227720)
https://link.zhihu.com/?target=https%3A//github.com/aharris88/awesome-cli-apps
[能理解聊天记录的微信机器人 (四)](http://link.zhihu.com/?target=https%3A//github.com/grapeot/WechatForwardBot)
[使用codecs自定义编/解码方案](https://zhuanlan.zhihu.com/p/26720957)
In : print u'\U0001F3F4'.encode('utf-8')
🏴
In : '哈哈'.decode('utf8')

Out: u'\u54c8\u54c8'
「utf-8」和「utf8」，这2个词长得很像。事实上都能正常使用是由于他们都是「utf\_8」的别名
原生PHP一行代码就可以把远程图片保存到本地:
file_put_contents('/tmp/logo.gif', file_get_contents('https://www.baidu.com/img/bdlogo.gif'));
[使用Laravel框架搭建的微博数据获取分析平台](https://github.com/daweilang/GetWB)
```js
php上传文件500错误,原来 是/tmp没有权限，你们说，谁能想到 php 上传500是因为没有权限啊，这不是看日志就能明白的事，所以自己的总结 还是有一定含金量的
以前做会员过期是类似这样实现的，他买了一个月的会员，在买的时候设置expired_at字段为2017-6-4，然后Laravel中间件每次验证用户的时候顺便验证当前时间是否大于过期时间，后台也是一样，如果当前时间小于过期时间则有一个“会员”小标识，反过来就是没有
table  中有一个字段  param   存储的是字符串列表  1,2,3 这样的

现在要统计1,2,3分别的行数，我现在的想法是union 

select param,count(*) as count from 
(https://www.qcloud.com/community/article/302356
select * from table where find_in_set('param', 1)
union 
select * from table where find_in_set('param', 2)
union
select * from table where find_in_set('param', 3)
) as tb
group by param

或者
select param,count(*) as count from table where find_in_set('param', 1)
union
select param,count(*) as count from table where find_in_set('param', 2)
select param,count(*) as count from table where find_in_set('param', 3)

除了拆表     改字段类型，  有没有比较痛快的统计语句
var a = [];
a['abc'] = 1;
console.log(a);

你跑一下，是可以输出内容的，但json的化时候，就丢失了
site:52pojie.cn beyondcompare4  绝大部分破解软件都能在52pojie上下到

class A {private $x = 1;}

// Pre PHP 7 code
$getXCB = function() {return $this->x;};
$getX = $getXCB->bindTo(new A, 'A'); // intermediate closure
echo $getX();

// PHP 7+ code
$getX = function() {return $this->x;};
echo $getX->call(new A);
```
[远程调用以及RPC框架](http://blog.csdn.net/diandianxiyu_geek/article/details/52294201)
[PHP实现经典算法(下)](http://blog.csdn.net/diandianxiyu_geek/article/details/51141598)
[PHP的CURL开发项目最佳实践](http://blog.csdn.net/diandianxiyu_geek/article/details/50414778)

github开源地址 https://github.com/diandianxiyu/ApiTesting
[ PHP计算时间差函数 可显示“消息来自XX分钟前”](http://blog.csdn.net/diandianxiyu_geek/article/details/17164179)
```js
function time2Units ($time)  
{  
        $year   = floor($time / 60 / 60 / 24 / 365);  
        $time  -= $year * 60 * 60 * 24 * 365;  
        $month  = floor($time / 60 / 60 / 24 / 30);  
        $time  -= $month * 60 * 60 * 24 * 30;  
        $week   = floor($time / 60 / 60 / 24 / 7);  
        $time  -= $week * 60 * 60 * 24 * 7;  
        $day    = floor($time / 60 / 60 / 24);  
        $time  -= $day * 60 * 60 * 24;  
        $hour   = floor($time / 60 / 60);  
        $time  -= $hour * 60 * 60;  
        $minute = floor($time / 60);  
        $time  -= $minute * 60;  
        $second = $time;  
        $elapse = '';  
          
        $unitArr = array('年前'  =>'year', '个月前'=>'month',  '周前'=>'week', '天前'=>'day',  
                '小时前'=>'hour', '分钟前'=>'minute', '秒前'=>'second'  
        );  
          
        foreach ( $unitArr as $cn => $u )  
        {  
            if ( $year > 0 ) {//大于一年显示年月日  
                $elapse = date('Y/m/d',time()-$time);  
                break;  
            }  
            else if ( $$u > 0 )  
            {  
                $elapse = $$u . $cn;  
                break;  
            }  
        }  
          
        return $elapse;  
}  
  
$past = 2052345678; //已经过去的时间  
$diff = time() - $past;  
  
echo '发表于' . time2Units($diff) . '前'; 
```
[PHP使用PHPExcel生成Excel表格文件](http://blog.csdn.net/diandianxiyu_geek/article/details/51636990)
[极验验证官方SDK源码分析和实现思路](http://blog.csdn.net/diandianxiyu_geek/article/details/50455049)
[Gif图片的处理 GIFDecoder的排错以及修改另附完整代码和demo](http://blog.csdn.net/diandianxiyu_geek/article/details/45889091)
[模拟登录网站并获取用户信息](http://blog.csdn.net/diandianxiyu_geek/article/details/52074237)
通过Chrome的调试模式寻找发送的http请求。

注意勾选下图的Preserve log,避免页面跳转的请求记录丢失。
[mysql分库分表的策略](http://type.so/sql/mysql-sharding-strategy.html)
1. 插入数据，必须带有userId
2. 根据userId计算出xId
xId = userId % 10000;
3. 根据xId定位数据所在表
tNum = xId % 1024; // 最简单的取模hash(具体策略由中间件决定)
4. 插入数据，返回realId
realId = id + xId;
1. 根据realId查询, 获取单张表中的Id值
id = realId / 10000; // 整除
2. 获取虚拟键xId
xId = realId % 10000;
3. 根据xId定位数据所在表
tNum = xId % 1024; // 最简单的取模hash(具体策略由中间件决定)
4. 根据表和Id获取单条数据
[订单号的生成规则](http://type.so/default/order-id-generate-rule.html)
[php max_input_vars限制](http://type.so/php/php-max-input-vars-limit.html)
使用了大量的数组，造成了 php 端 $stock 变量无法完全解析。
 使用 post 的 body 将数据传过来；在 php 端使用 file_get_contents('php://input') 来获取之后在 json_decode；
减少 post 的字段，先 js json_encode 一下，再用一个大字段传过来
[slim框架接入pysh](http://type.so/php/slim-framework-and-pysh.html)

[私信的设计](http://type.so/default/design-private-message.html)

```js
发件人和消息的关系 (一对多)

消息和收件人的关系 (多对多)
pre_messages

+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| sender_id  | int(11) unsigned | NO   |     | 0       |                |
| message    | varchar(255)     | NO   |     |         |                |
| type       | varchar(50)      | NO   |     |         |                |
| expires_at | datetime         | YES  |     | NULL    |                |
| created_at | datetime         | NO   |     | NULL    |                |
| updated_at | datetime         | NO   |     | NULL    |                |
| deleted_at | datetime         | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+

pre_message_recipients

+--------------+---------------------+------+-----+---------+----------------+
| Field        | Type                | Null | Key | Default | Extra          |
+--------------+---------------------+------+-----+---------+----------------+
| id           | int(11) unsigned    | NO   | PRI | NULL    | auto_increment |
| recipient_id | int(11) unsigned    | NO   |     | 0       |                |
| message_id   | int(11) unsigned    | NO   |     | 0       |                |
| status       | tinyint(1) unsigned | NO   |     | 0       |                |
| created_at   | datetime            | NO   |     | NULL    |                |
| updated_at   | datetime            | NO   |     | NULL    |                |
| deleted_at   | datetime            | YES  |     | NULL    |                |
+--------------+---------------------+------+-----+---------+----------------+
flush这个函数http://type.so/php/php-flush.html http://type.so/php/php-tips-1.html
$my_string_var = 'test...';
echo '';
for($i = 1, $i <7, $i++) {
	echo str_pad($my_string_var, 2048, ' ');
	@ob_flush();
	flush();
	sleep(1);
}

// 获取所有php和txt文件，必须指定第二个参数为GLOB_BRACE才能使用{}
$files = glob('*.{php,txt}', GLOB_BRACE);

// 按照文件的修改时间排序
usort($files, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));

// 深度遍历文件夹
$path = realpath('/etc');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
    echo $name . PHP_EOL;
}
```
[php大数（浮点数）取余](http://type.so/php/fmod.html)
```js
function Kmod($bn, $sn)
{
	return intval(fmod(floatval($bn), $sn));
}
//整数取余方法
function mod($bn, $sn)
{
	return $bn%$sn;
}

//最大的int整数
$bn = PHP_INT_MAX;
$sn = 11;

var_dump($bn);
var_dump(Kmod($bn, $sn));
var_dump(mod($bn, $sn));

//给最大的int整数加1
$bn = PHP_INT_MAX + 1;
var_dump($bn);
var_dump(Kmod($bn, $sn));
var_dump(mod($bn, $sn));

x = {'a':1, 'b': 2}
y = {'b':10, 'c': 11}
合并字典
# python2.x
z = dict(x.items() + y.items())
# python3.x
z = dict(list(x.items()) + list(y.items()))

# another way
z = dict(x, **y)

直接用int会报错。

str = "545.2222"
print(int(float(str)))
```
[咔咔，网页截图服务 http://tool.lu/article/](https://github.com/xiaozi/kaka)
[网易式评论箱的实现](http://type.so/php/netease-comment-box.html)
[php对特定数组进行压缩](http://type.so/php/compress-array.html)
```js
$dataArr = array(
'0'=>array('c'=>'A','f'=>55,'t'=>60),
'1'=>array('c'=>'A','f'=>61,'t'=>70),
'2'=>array('c'=>'A','f'=>71,'t'=>80),
'3'=>array('c'=>'A','f'=>81,'t'=>90),
'4'=>array('c'=>'B','f'=>91,'t'=>100),
'5'=>array('c'=>'B','f'=>101,'t'=>110),
'6'=>array('c'=>'A','f'=>111,'t'=>120),
'7'=>array('c'=>'B','f'=>121,'t'=>130),
'8'=>array('c'=>'B','f'=>131,'t'=>140),
'9'=>array('c'=>'B','f'=>141,'t'=>150)
);
好多同城市的ip上一条结束和下一条开始其实是连续的，也就是说完全可以组成一条数据。
function change($dataArr)
{
	$j=0;
	for ($i=0;$i<=count($dataArr);$i++)
	{
		if($dataArr[$i]['t']+1 == $dataArr[$i+1]['f'] && $dataArr[$i]['c'] == $dataArr[$i+1]['c'] && $i!=count($dataArr)-1)
		{
			$dataArr[$i]['t'] = $dataArr[$i+1]['t'];
			unset($dataArr[$i+1]);
			$j++;
		}
	}
	if($j != 0) $dataArr = change(array_values($dataArr));
	return $dataArr;
}
array
  0 => 
    array
      'c' => string 'A' (length=1)
      'f' => int 55
      't' => int 90
  1 => 
    array
      'c' => string 'B' (length=1)
      'f' => int 91
      't' => int 110
  2 => 
    array
      'c' => string 'A' (length=1)
      'f' => int 111
      't' => int 120
  3 => 
    array
      'c' => string 'B' (length=1)
      'f' => int 121
      't' => int 150
```
[php中正确获取程序路径](http://type.so/php/php-application-root.html)
if ( ! defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

$GLOBALS['laravel_paths']['base'] = __DIR__.DS;

[位运算](http://type.so/python/bitwise.html)
a, b = 3, 4
a = a ^ b
b = b ^ a
a = a ^ b
print(a, b) #4 3

[Mysql ERROR 1690 (22003): BIGINT UNSIGNED value is out of range in..的解决方法](http://type.so/sql/mysql-bigint-unsigned-value-is-out-of-range-in-solution.html)
当两个时间戳相减为负数时才会出现ERROR 1690 (22003): BIGINT UNSIGNED value is out of range in..这个错误，但在这个表中两个值中大小不是固定的，lastactivity有可能比lastvisit大，也有可能比lastvisit小。。所以这里可以用cast()来解决
select abs(lastvisit-lastactivity) from pre_common_member_status limit 1;
select lastactivity-lastvisit from pre_common_member_status limit 1;

select cast(lastactivity as signed)-cast(lastvisit as signed) from pre_co
mmon_member_status limit 1;
select abs(cast(lastactivity as signed)-cast(lastvisit as signed)) from p
re_common_member_status limit 1;
[php中nbsp的trim](http://type.so/php/trim-nbsp.html)
$str = "&nbsp;abc"; 
$converted = strtr($str, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES)));
var_dump($converted); // 这儿才是要处理的字符串，上面的都是准备工作
var_dump(trim($converted, chr(0xc2) . chr(0xa0)));//abc
[mysql load data infile一例](http://type.so/sql/load-data-infile.html)
LOAD DATA INFILE 'D:\data.txt'
INTO TABLE `domain`
FIELDS TERMINATED BY ','
(@domain,`status`)
[php调用python服务](http://type.so/python/php-call-python.html)
[使用casperjs截出优雅的图片](http://type.so/linux/casperjs-capture-nice.html)
[为php程序增加调试REPL](http://type.so/php/add-repl-to-php-project.html)
composer require d11wtq/boris dev-master
require __DIR__ . '/vendor/autoload.php';

$boris = new \Boris\Boris('> ');
$boris->start();
jQuery data函数的坑
<div id="test" data-id="1e3"></div>
<script>
console.log($('#test').data('id'));
// 1e3  jQuery 1.9.1
// 1000  jQuery 1.7.2
</script>
[分析某手机号码归属地储存结构](http://type.so/other/phone-dat-struct.html)
https://github.com/lovedboy/phone pip install phone p.find(1888888)
[PHP unpack VS Python unpack](http://type.so/python/php-vs-python-unpack.html)
unpack 对二进制数据解包。

php unpack的结果 数组的索引是从 1 开始的
python unpack的结果是 元祖，索引从 0 开始
// php
unpack('V6', $bin);

# python
import struct
struct.unpack('<6L', bin[0:24])
[MySQL server has gone away解决办法](http://type.so/sql/mysql-server-has-gone-away-solution.html)
解决办法:将max_allowed_packet值调大。
SHOW GLOBAL VARIABLES LIKE '%packet'; SET GLOBAL max_allowed_packet=10485760;

[酷Q聊天机器人的安装设置教程](http://jingyan.baidu.com/article/1612d500768ee0e20e1eeeb2.html)
同一进程调用第一次false，第二次true
```js
function cacheUserIsThird($userData)
    {
        static $userIsThird;

        if (isset($userIsThird)) {
            return true;
        }

        $userIsThird = true;
        return false;
    }
 cacheUserIsThird($user)   ;//false
 
 $user=user::create([]);
 if(cacheUserIsThird($user)){
   return;
 }
    
```
[Redis持久化-RDB](https://wenchao.ren/archives/165)


[ubuntu 上给PHP安装扩展 Msgpack 和 Yar 可以高效的封装好供外部访问的接口](http://blog.csdn.net/diandianxiyu_geek/article/details/17119341)
[PHP使用PHPExcel生成Excel表格文件附带随机生成英文名函数](http://blog.csdn.net/diandianxiyu_geek/article/details/51636990)
[Redis在实际项目中的应用](http://blog.csdn.net/diandianxiyu_geek/article/details/52985648)
[RESTful  PUT 一般用于更改已有数据， POST 一般用来创建新数据](https://www.v2ex.com/t/357228)
幂等就是说，如果你提交的参数是相同的，不论提交几次，结果都是一样的，或者可以理解，最终结果都以最后一次提交为准 
比如你修改 id=1 的 user 的 name 为 'zhu'，无论你请求多少次， name 都是 zhu 
不幂等的情况，比如你创建一个 name 为 'zhu' 的用户，第一次请求，系统里有了一个 zhu ，返回 id 为 1 ，再请求一次，系统里又多了一个 zhu ，返回 id 为 2 ，系统状态以及返回结果与请求次数有关 POST 是非幂等，每次 POST 都会增加一个 record 
PUT 是幂等 且完全替换，每次 PUT 都会对指定的 record 进行更新  CURD  ： 
C(POST)， U(PUT)， R(GET)， D(DELETE) 
[Python网络爬虫Scrapy框架研究](https://github.com/yidao620c/core-scrapy)
[基于PDF.js的pdf文件在线阅读Demo](https://zhuanlan.zhihu.com/p/26606586)
[独家|内部公开 灰产 网赚 创业项目20案例（不看后悔）](https://zhuanlan.zhihu.com/p/26549455)
[暴力密码破解器 ocl-Hashcat-plus 支持每秒猜测最多 80 亿个密码，意味着什么？](https://www.zhihu.com/question/21558046/answer/160651946)
[爬虫杂谈（二）使用Selenium抓取动态网站](https://zhuanlan.zhihu.com/p/26630390)
[浅谈 CSRF 攻击](https://www.v2ex.com/t/357992#reply16)
CSRF 就是利用了我们的登录状态或者授权状态（请注意“利用”，并没有窃取到），然后做一些损害我们自身利益的事情。 
验证HTTP Referer 字段 服务端验证请求的token一致性
session_start();
$csrf_token = md5(openssl_random_pseudo_bytes(32));//生成随机token
$_SESSION['token']= $csrf_token;
[查询所有数据库占用磁盘空间大小的SQL语句](https://www.qcloud.com/community/article/538493001490275637)
select TABLE_SCHEMA, concat(truncate(sum(data_length)/1024/1024,2),' MB') as data_size,
concat(truncate(sum(index_length)/1024/1024,2),'MB') as index_size
from information_schema.tables
group by TABLE_SCHEMA
order by data_length desc;
[update 一条记录的值 WHERE 条件如何做到扩大限制到全表](https://www.v2ex.com/t/357665#reply12)
```js
UPDATE `user` SET `mobile`='13888888888' 
where `id`=1 AND 全 user 表 mobile 字段所有记录没有等于 13888888888
UPDATE `user` SET `mobile`='13888888888' 
where 1 > (select count(*) from (select * from user) a where `mobile` = '13888888888') and `id` = 1; 
UPDATE `zc_users` SET `mobile`='13888888888' 
where 1 > (select count(*) from (select * from zc_users) a where `mobile` = '13888888888') and `user_id` = 1
update zc_users set mobile='13888888888' where user_id=1 And not exists(select user_id from (select * from zc_users) a where mobile='13888888888'); 
```
[linux 下有办法将前一个命令的结果作为第二个命令的第一个参数](https://www.v2ex.com/t/357232)
```js
ls | xargs -i mv {} dst_dir/ (使用 xargs 的-i 参数)
mv `ls` dst_dir/
mv $(ls) dst_dir/
e=`ls` => mv ${e} dst_dir/

比如这个 cat hosts.txt 
127.0.0.1 p.kjwx8.com 
127.0.0.1 sta.jcjk0451.com 
127.0.0.1 1.yhzm.cc 
127.0.0.1 www.hao934.com 
如何实现这个效果： 
127.0.0.1 dp.559.cc 
127.0.0.1 1.yhzm.cc 
127.0.0.1 sta.jcjk0451.com 
127.0.0.1 www.716703.com 
cat hosts | rev | sort | rev
```
[两三年工作经验的 PHPer 需要了解什么知识点](https://www.v2ex.com/t/356904)
https://freelancersinchina.github.io/diveintophp

如何实现从最右边字符开始逐步往左字符排序
[php中max_input_vars默认值为1000导致多表单提交失败](http://www.cnblogs.com/wish123/p/6650361.html)
，打印post请求后，也发现提交表单个数和正在表单个数对不上 再看了下php-fpm的日志，有点信息可以参考了。 max_input_vars = 2000
[JS 汉字与Unicode码的相互转化](http://www.cnblogs.com/wish123/p/6481926.html)
```js
var GB2312UnicodeConverter={
        ToUnicode:function(str){
          return escape(str).toLocaleLowerCase().replace(/%u/gi,'\\u');
        }
        ,ToGB2312:function(str){
          return unescape(str.replace(/\\u/gi,'%u'));
        }
      };

      
```
[php安全](http://stackoverflow.com/documentation/php/2781/security#t=201704280841101496392)
```js
$whitelist = [
  'extensions' => [
    'png', 'gif', 'jpg', 'jpeg'
  ],
  'mimes' => [
    'image/png',
    'image/gif',
    'image/jpeg',
  ]
];

if(in_array($extension, $whitelist['extensions'])){
  if(in_array(mime_content_type($filename), $whitelist['mimes']){
    // safe to store.
  } else {
    die('file extension does not match mime');
  }
} else {
  die("Only '" . join(', ', $whitelist['extensions'])) . "' extensions are allowed");
}
$string = '<b>Hello,<> please remove the <br> tags.</b>';

echo strip_tags($string, '<b>');
$page = 'pages/'.$_GET['page'].'.php';
$allowed = ['pages/home.php','pages/error.php'];
if(in_array($page,$allowed)) {
    include($page);
} else {
    include('index.php');
}
<?php system('ls ' . escapeshellarg($_GET['path'])); ?>
echo '<div>' . htmlspecialchars($_GET['input']) . '</div>';
$arr=[];
echo $arr['a'];
echo $arr['a']??'null';
$data = [
    [ "Fruit" => "Apple",  "Color" => "Red",    "Cost" => 1 ],
    [ "Fruit" => "Banana", "Color" => "Yellow", "Cost" => 7 ],
    [ "Fruit" => "Cherry", "Color" => "Red",    "Cost" => 2 ],
    [ "Fruit" => "Grape",  "Color" => "Green",  "Cost" => 4 ]
];

foreach($data as $fruit) {
    foreach($fruit as $key => $value) {
        if ($key == "Cost" && $value >= 5) {
            continue 2;
        }
        echo $key.$value.PHP_EOL;
        /* make a pie */
    }
}
// PHP <7.0
if (isset($_COOKIE['user'])) {
    // true, cookie is set
    echo 'User is ' . $_COOKIE['user'];
else {
    // false, cookie is not set
    echo 'User is not logged in';
}
unset($_COOKIE['user']);setcookie('user', '', time() - 3600, '/');
// PHP 7.0+
echo 'User is ' . $_COOKIE['user'] ?? 'User is not logged in';
class StaticSquareHolder
{
    public static function square($number)
    {
        return $number * $number;
    }
}

$initial_array = [1, 2, 3, 4, 5];
$final_array = array_map(['StaticSquareHolder', 'square'], $initial_array);
// or:
$final_array = array_map('StaticSquareHolder::square', $initial_array); // for PHP >= 5.2.3
$squaredHolder = new SquareHolder();
var_dump($final_array); // prints the new array with 1, 4, 9, 16, 25
$final_array = array_map([$squaredHolder, 'square'], $initial_array);

echo '<?php echo "Hello world!";' | php
$a = 1;
$b = 1;
$a = $b += 1;// 2 2
$a = 3;
$b = ($a = 5);//5 5
print "Current cURL version: " . phpversion( 'curl' );
模拟登陆
# create a cURL handle
$ch  = curl_init();

# set the URL (this could also be passed to curl_init() if desired)
curl_setopt($ch, CURLOPT_URL, "https://www.example.com/login.php");

# set the HTTP method to POST
curl_setopt($ch, CURLOPT_POST, true);

# setting this option to an empty string enables cookie handling
# but does not load cookies from a file
curl_setopt($ch, CURLOPT_COOKIEFILE, "");

# set the values to be sent
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    "username"=>"joe_bloggs",
    "password"=>"$up3r_$3cr3t",
));

# return the response body
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

# send the request
$result = curl_exec($ch);别关闭 下面继续使用
curl_setopt($ch, CURLOPT_URL, "https://www.example.com/show_me_the_foo.php");

# change the method back to GET
curl_setopt($ch, CURLOPT_HTTPGET, true);

# send the request
$result = curl_exec($ch);

# finished with cURL
curl_close($ch);

同时上传文件和表单
$files = array();

foreach ($_FILES["upload"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {

        $files["upload[$key]"] = curl_file_create(
            $_FILES['upload']['tmp_name'][$key],
            $_FILES['upload']['type'][$key],
            $_FILES['upload']['name'][$key]
        );
    }
}
$data = $new_post_array + $files;
$ch = curl_init();

curl_setopt_array($ch, array(
    CURLOPT_POST => 1,
    CURLOPT_URL => "https://api.externalserver.com/upload.php",
    CURLOPT_RETURNTRANSFER => 1,
    CURLINFO_HEADER_OUT => 1,
    CURLOPT_POSTFIELDS => $data
));

$result = curl_exec($ch);
//Set the session name
session_name('newname');
//Start the session
session_start();
if(isset($_COOKIE[session_name()])) {
    session_start();
}
>>> serialize(null)
=> "N;"
>>> serialize(true)
=> "b:1;"
>>> serialize(false)
=> "b:0;"
>>> serialize(3.445)
=> "d:3.444999999999999840127884453977458178997039794921875;"
$numbers = [16,3,5,8,1,4,6];

$even_indexed_numbers = array_filter($numbers, function($index) {
    return $index % 2 === 0;
}, ARRAY_FILTER_USE_KEY);
$parameters = ['foo' => 'bar', 'bar' => 'baz', 'boo' => 'bam'];
$allowedKeys = ['foo', 'bar'];
$filteredParameters = array_intersect_key($parameters, array_flip($allowedKeys));

// $filteredParameters contains ['foo' => 'bar', 'bar' => 'baz]
$parameters  = ['foo' => 1, 'hello' => 'world'];
$allowedKeys = ['foo', 'bar'];
$filteredParameters = array_filter(
    $parameters,
    function ($key) use ($allowedKeys) {
        return in_array($key, $allowedKeys);
    },
    ARRAY_FILTER_USE_KEY
);
$array = ['Joel', 23, true, ['red', 'blue']];

// Returns a JSON encoded array
echo json_encode($array);
#> ["Joel",23,true,["red","blue"]]

// Returns a JSON encoded object
echo json_encode($array, JSON_FORCE_OBJECT);
#> {"0":"Joel","1":23,"2":true,"3":{"0":"red","1":"blue"}}

// Combine bitmasks - force an object AND pretty print it
echo json_encode($array, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
{
    "0": "Joel",
    "1": 23,
    "2": true,
    "3": {
        "0": "red",
        "1": "blue"
    }
}
$array = ['23452', 23452];

echo json_encode($array);
#> ["23452",23452]

echo json_encode($array, JSON_NUMERIC_CHECK);
#> [23452,23452]
```

[MySQL隐式转化整理](http://www.cnblogs.com/rollenholt/p/5442825.html)
假如 password 类型为字符串，查询条件为 int 0 则会匹配上
SELECT 1+'1'; SELECT CONCAT(2,' test');
select * from test where name = 'test1' and password = 0;
show warnings;
SELECT * FROM users WHERE username = '$_POST["username"]' AND password = '$_POST["password"]'
如果username输入的是a' OR 1='1，那么password随便输入，这样就生成了下面的查询：

SELECT * FROM users WHERE username = 'a' OR 1='1' AND password = 'anyvalue'
select * from test where name = 'a' + '55';
select '55aaa' = 55;
select 'a' + '55';select 'a' + 'b';
+为算术操作符arithmetic operator 这样就可以解释为什么a和b都转换为double了。因为转换之后其实就是：0+0=0了。 select 'a'+'b'='c';
[laravel的启动过程](http://www.cnblogs.com/wish123/p/4756669.html)
```js
PSR0加载方式—对应的文件就是autoload_namespaces.php
PSR4加载方式—对应的文件就是autoload_psr4.php
其他加载类的方式—对应的文件就是autoload_classmap.php
加载公用方法—对应的文件就是autoload_files.php
class Superman
{
    protected $power;

    public function __construct(array $modules)
    {
        // 初始化工厂
        $factory = new SuperModuleFactory;

        // 通过工厂提供的方法制造需要的模块
        foreach ($modules as $moduleName => $moduleOptions) {
            $this->power[] = $factory->makeModule($moduleName, $moduleOptions);
        }
    }
}

// 创建超人
$superman = new Superman([
    'Fight' => [9, 100], 
    'Shot' => [99, 50, 2]
    ]);
    
    class Superman
{
    protected $module;

    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module
    }
}
```

[Shadowsocks Windows 使用说明](https://github.com/shadowsocks/shadowsocks-windows/wiki/Shadowsocks-Windows-%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E)
[manage.py](https://github.com/Birdback/manage.py)
[如何使用 Null Object 模式 laravel](http://oomusou.io/dp/dp-nullobject/)
[python Pandas 使用](http://wiki.jikexueyuan.com/project/start-learning-python/311.html)
[ app后端开发系列文章目录](http://blog.csdn.net/hel12he/article/details/47721209)
```js
\Queue::push(new \App\Commands\WebinarUserRegExportDeal($id),null,'webinar_user_reg_async_export');
t上环境增加 supervisord 任务  vi /etc/supervisord.d/webianr_async_export.conf
[program:webianr_async_export]
command=/usr/bin/php /application/www/e.vhall.com/artisan queue:listen --tries=3 --queue=webinar_user_reg_async_export --timeout=0
autostart=true
autorestart=true
stdout_logfile=/var/log/supervisor/webianr_async_export_std.log
stderr_logfile=/var/log/supervisor/webianr_async_export_err.log

self的引用是在类被定义时就决定的，也就是说，继承了B的A，他的self引用仍然指向A 通过static关键字来访问静态的方法或者变量，与self不同，static的引用是由运行时决定。
class C  
{  
    protected static $_instance = null;  
    protected function __construct(){  
    }  
    protected function __clone(){  
    }  
    public function getInstance(){  
        if (static::$_instance === null) {  
            static::$_instance = new static;  
        }  
        return static::$_instance;  
    }   
}  
class D extends C{  
    protected static $_instance = null;  
}  
$c = C::getInstance();  
$d = D::getInstance();  
var_dump($c === $d);bool(false)

var_dump(substr('f', 257, 1), substr('f', -257, 1));
bool(false)
string(1) "f"
http://www.lolphp.com

echo("I'm ok");
var_dump(number_format('-0.123', 0)); string(2) "-0"
```
[支付宝、微信支付接入](http://blog.csdn.net/column/details/payment.html)
[mysql数据库设计](http://blog.csdn.net/hel12he/article/details/44997209)
[ Laravel5学习笔记：执行route:cache时报LogicException](http://blog.csdn.net/hel12he/article/details/46550645)
php artisan route:cache  在闭包里边，是不能够进行路由缓存的
// 之前，报错的路由
Route::get('/', function()
{
    return veiw('welcome');
});

// 修改之后，能够路由缓存的方式
Route::get('/', 'HomeController@index');
[在packagist上发布自己的composer包](http://blog.csdn.net/hel12he/article/details/46659749)
[Laravel5学习笔记：Facade的运行机制](http://blog.csdn.net/hel12he/article/details/46620519)
$value = $app->make('cache')->get('key'); $value = $app['cache']->get('key');
$value = app('cache')->get('key'); $value = Cache::get('key');
use Illuminate\Support\Facades\Cache; use Cache;

CacheServiceProvider实现cache单例
$this->app->singleton('cache', function ($app) {
            return new CacheManager($app);
        });
config/app.php 加载CacheServiceProvider
[Composer.json配置文件说明](http://blog.csdn.net/hel12he/article/details/46503875)
```js
"autoload":{
    "files":["lib/OrderManager.php"]
}
composer dump-autoload
 
让composer重建自动加载的信息，完成之后，就可以在index.php里调用OrderManager类啦。
"classmap":["lib"]
PSR-0自动加载 
PSR-1基本代码规范 
PSR-2代码样式 
PSR-3日志接口 
PSR-4 自动加载
PSR-4和PSR-0最大的区别是对下划线（underscore）的定义不同。PSR-4中，在类名中使用下划线没有任何特殊含义。而PSR-0则规定类名中的下划线_会被转化成目录分隔符。
"autoload":{
    "psr-0":{
        "SilkLib":"lib/"
    }
}
SlikLib是命名空间，lib是目录名，他们的组合告诉composer，文件搜索是在：lib/SilkLib/ 目录下，而不是在 SilkLib/lib 目录下
应用根目录\lib\SilkLib\OrderManager.php
namespace SilkLib;
class OrderManager
{
    public function test()
    {
        echo "hello";
    }
 }
 应用根目录\lib\OrderManager.php
"autoload":{
    "psr-4":{
        "Silk\\":"lib"
    }
}
再次composer dump-autoload，运行测试，OK通过！
```


[ 8. Laravel5学习笔记：在laravel5中使用OAuth授权](http://blog.csdn.net/hel12he/article/details/46820711)
composer lucadegasperi/oauth2-server-laravel


[app后端开发四：GeoHash实现查找附近的X](http://blog.csdn.net/hel12he/article/details/48208927)
https://github.com/helei112g/laravel_geohash 
```js
$lat = '30.555';
$long = '104.07';
$geohash = new GeoHash();

$hash = $geohash->encode($lat, $long);
// 决定查询范围，值越大，获取的范围越小
// 当geohash base32编码长度为8时，精度在19米左右，而当编码长度为9时，精度在2米左右，编码长度需要根据数据情况进行选择。
$pre_hash = substr($hash, 0, 5);

//取出相邻八个区域
$neighbors = $geohash->neighbors($pre_hash);
array_push($neighbors, $pre_hash);

$values = '';
foreach ($neighbors as $key=>$val) {
  $values .= '\'' . $val . '\'' .',';
}
$values = substr($values, 0, -1);
SELECT * FROM `address` WHERE LEFT(`geohash`,5) IN ('wm6n0','wm6j8','wm6jc','wm3vz','wm3yp','wm6n1','wm6j9','wm3vx','wm6jb')
```
[app后端开发二：API接口文档自动生成工具 swagger-ui](http://blog.csdn.net/hel12he/article/details/46804915)
https://github.com/helei112g/laravel-swagger/blob/master/README.md 
https://github.com/helei112g/swagger-ui

```js
import pandas as pd # This is the standard
Series 就如同列表一样，一系列数据，每个数据对应一个索引值。比如这样一个列表：[9, 3, 8]
DataFrame 是一种二维的数据结构，非常接近于电子表格或者类似 mysql 数据库的形式


>>> s=pd.Series([100,'php','py','js'])
>>> s.values
array([100, 'php', 'py', 'js'], dtype=object)
>>> s
0    100
1    php
2     py
3     js
dtype: object
>>> len(s)
4
>>> data = {"name":["yahoo","google","facebook"], "marks":[200,400,800], "price":[9, 3, 7]} 
>>> f1 = DataFrame(data) 
>>> f1 
     marks  name      price 
0    200    yahoo     9 
1    400    google    3 
2    800    facebook  7
>>> f3 = DataFrame(data, columns=['name', 'price', 'marks', 'debt'], index=['a','b','c']) 
>>> f3 
       name      price  marks  debt 
a     yahoo      9      200     NaN 
b    google      3      400     NaN 
c  facebook      7      800     NaN
newdata = {"lang":{"firstline":"python","secondline":"java"}, "price":{"firstline":8000}}

with open("./marks.csv") as f:
...     for line in f:
...         print line
>>> csv_reader = csv.reader(open("./marks.csv"))
>>> for row in csv_reader:
...     print row
>>> marks.sort(column="python")
 用pip 安装 openpyxl 模块：sudo pip install openpyxl。继续：

>>> xls = pd.ExcelFile("./marks.xlsx")
>>> xls.sheet_names
['Sheet1', 'Sheet2', 'Sheet3']
>>> sheet1 = xls.parse("Sheet1")
# 查看表头5行
df.head(5)

# 查看表末5行
df.tail(5)

# 查看列的名字
df.columns

# 查看表格当前的值
df.values

# 查看所有列的统计描述，包括平均值，标准差，最大最小值，以及25%，50%，75%的 percentile 值
df.describe()

# 对表按照A列升序排序
df.sort_values(by='A')
在方括号中加入判断条件来过滤行，条件必需返回 True 或者 False

df[(df.index >= '2013-01-01') & (df.index <= '2013-01-03')]
df[df['A'] > 0]
Pandas 中的基本数据结构有二，Series 和 Dataframe。 Series 用来创建行，也可以理解为一维数组。 Dataframe 用来创建块，或称为矩阵，表格。
列的选取

cols = df[['A', 'B', 'C']]http://www.chenhf.com/data/pandas-done-right
df[df.rain_octsep < 1000]
这条代码只返回十月-九月降雨量小于 1000 mm 的记录

>>> df[0:3]
   user_id         id  price
0    28695  421750219   0.01
1    28695  864476977   0.01
2    28695  775958292   0.01
>>> df['price'].mean()
23.895552010210594
>>> df['price'].count()
1567
>>> df['price'].describe()
count    1567.000000
mean       23.895552
std       138.741234
min         0.010000
25%         1.000000
50%         2.000000
75%        10.000000
max      5000.000000
Name: price, dtype: float64
>>> df.shape
(1567, 3)
>>>
1.右连接。场景是根据几个主键把两个特征集拼起来。merge(data1,data2,how='left',on=['userID','date'])
2.合并。场景是把两个特征都一样的数据集合并起来，比如把3月份的数据集合并到4月份来，这样样本就会比单用4月份的多了。concat((data1,data2))
它是按列名合并的，所以列的顺序没关系

作者：王杰
链接：https://www.zhihu.com/question/37180159/answer/79671057
来源：知乎https://ericfu.me/10-minutes-to-pandas/
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
修改符合条件行的某个值。比如，符合消费额度到1000的客户，打标签为优质客户。data['target'] = 0
data.loc[data['consumption_sum']>1000,'target'] = 1
8.某列转日期。data['date'] = pandas.to_datetime(data['date'])
9.对某列进行比较特殊的处理。在个人工作中，用的比较多和时间相关的，所以推荐个时间加减的方法。#新建一列，为下个月
from dateutil.relativedelta import relativedelta
data['next_month'] = data['date'].map(lambda x:x+relativedelta(months=1))
10.保持数据到csv#index=None不加，会将行号输出到文件中
data.to_csv('data.csv',index=None)
 



 
```
[十分钟的 pandas 入门教程](https://ericfu.me/10-minutes-to-pandas/)
```js




```

[域名代码Punycode converter Unicode Domains](https://www.punycoder.com/)
http://xn--domain.net/
[ mysql处理高并发数据,防止数据超读](http://blog.csdn.net/gaoxuaiguoyi/article/details/47304615)
```js
pandas-0.19.1-cp27-none-win32.whl
beginTranse(开启事务)  
try{  
   //第一次进行查询，返回数量     
    $result = $dbca->query('select amount from s_store where postID = 12345');  
  // 3个请求进入,使用了之前的，查询结果，造成了数据脏读，都去更新了库存，造成库存超读  
    if(result->amount > 0){  
        //quantity为请求减掉的库存数量  
        $dbca->query('update s_store set amount = amount - quantity where postID = 12345');  
    }  
}catch($e Exception){  
    rollBack(回滚)  
}  
commit(提交事务);
其实隐藏着巨大的漏洞。数据库的访问其实就是对磁盘文件的访问，数据库中的表其实就是保存在磁盘上的一个个文件，甚至一个文件包含了多张表。
beginTranse(开启事务)  
try{  
    //quantity为请求减掉的库存数量  
    $dbca->query('update s_store set amount = amount - quantity where postID = 12345');  
    //更新之后再进行数量判断，如果为负就回滚，不会造成库存超读  
    $result = $dbca->query('select amount from s_store where postID = 12345');  
    if(result->amount < 0){  
       throw new Exception('库存不足');  
    }  
}catch($e Exception){  
    rollBack(回滚);  
}  
commit(提交事务);  
beginTranse(开启事务)  
try{  
    //quantity为请求减掉的库存数量  
    $dbca->query('update s_store set amount = amount - quantity where amount>=quantity and postID = 12345');  
}catch($e Exception){  
    rollBack(回滚)  
}  
commit(提交事务) 
```

PHP中记录最后一次新增的ID https://segmentfault.com/q/1010000009114926
如何比较高效的求出用户余额与流水的差异数据？https://segmentfault.com/q/1010000009115881
MySQL的排序并取得对应序号https://segmentfault.com/q/1010000009124773
统计出20170403到20170420期间点击量前十的广告每天的点击量https://segmentfault.com/q/1010000009139117
SELECT s.date,s.advertise_id,s.count FROM advertise_stat s
WHERE
    EXISTS (
        SELECT advertise_id FROM (SELECT advertise_id FROM advertise_stat GROUP BY advertise_id ORDER BY count DESC LIMIT 10) AS advertise_temp
        WHERE advertise_id = s.advertise_id
    )
AND s.date BETWEEN 20170403 AND 20170420
ORDER BY s.date ASC,s.count DESC
group by后排序问题https://segmentfault.com/q/1010000009149903
select a.cid,a.comment_content from old_chapter_check_list a join (select max(id) maxid from old_chapter_check_list group by cid order by maxid desc limit 10) b on a.id=b.maxid;
select substring_index(group_concat(comment_content order by id desc separator '|||'),'|||',1) cmt,cid from old_chapter_check_list group by cid limit 10;
mysql order by 子查询 后面的结果 如何 也显示在结果集https://segmentfault.com/q/1010000009160747
sql 优化问题，between比in好？https://segmentfault.com/q/1010000009092938
两句sql，一个是用or，一个是用union all，性能应该是后面的好吧？https://segmentfault.com/q/1010000009093526
sql怎么优化下https://segmentfault.com/q/1010000009094213
在一组wid中 每个（不重复的）wid 下对应的 前5个uid(order by id limit 5) https://segmentfault.com/q/1010000009109922
SELECT
    wid,
    SUBSTRING_INDEX(GROUP_CONCAT(uid ORDER BY id),',',5) AS 'uids'
FROM (
  SELECT DISTINCT wid, uid
  FROM demo_table
  ORDER BY wid, uid
)
GROUP BY wid
Mysql数据表行转列https://segmentfault.com/q/1010000009082729
select team_name,sum(if(score='正',1,0)) as'正',sum(if(score='负',1,0)) as '负' 
from teamscore 
group by team_name;
mysql 1kw数据 快速查询https://segmentfault.com/q/1010000008992061 
mysql查询字符串形式保存的id怎么查https://segmentfault.com/q/1010000009077988
select * from article_table where tags like '%,1,%' or tags like '1,%' or tags like '%,1' or tags='1'
使用 redis 处理高并发原理？？https://segmentfault.com/q/1010000008835117
为什么要用redis而不用map做缓存https://segmentfault.com/q/1010000009106416  使用redis或memcached之类的称为分布式缓存，在多实例的情况下，各实例共用一份缓存数据，缓存具有一致性。缺点是需要保持redis或memcached服务的高可用，整个程序架构上较为复杂。

select jing_qu,group_concat(distinct gong_si separator ',') from A group by jing_qu
自增值不会随你删除记录而减少.
微服务架构下跨服务查询的聚合有什么好的方案？https://segmentfault.com/q/1010000009053767
mysql的查询正则表达式https://segmentfault.com/q/1010000009084860
SELECT code FROM xxxx WHERE code REGEXP '^(I|IC)[0-9]{4}0000[0-9]{3}$';
SELECT code FROM xxxx WHERE code LIKE 'I____0000%' OR code LIKE 'IC____0000___';
分库分表、分区、读写分离 这些都是用在什么场景下https://segmentfault.com/q/1010000009044121
不用LEFT JOIN查询？https://segmentfault.com/q/1010000009030133
sql查询结果合并的问题https://segmentfault.com/q/1010000009055596 
SELECT
  art.id,
  meta1.meta_value AS meta_key10086,
  meta2.meta_value AS meta_key12580
FROM wp_posts AS art
  LEFT JOIN wp_postmeta AS meta1
    ON meta1.post_id = art.id AND meta1.meta_key = '10086'
  LEFT JOIN wp_postmeta AS meta2
    ON meta2.post_id = art.id AND meta2.meta_key = '12580'
关于数据库查询，既要不影响查询速度，又能实现分页的办法？https://segmentfault.com/q/1010000009062581
分库分表后关于查询的问题https://segmentfault.com/q/1010000009061988
数据库存图片，是存图片名称？还是存图片路径？？https://segmentfault.com/q/1010000009061355
mysql连表统计查询问题https://segmentfault.com/q/1010000008951274
https://segmentfault.com/q/1010000008968545  https://segmentfault.com/q/1010000009013208
Laravel 5.4 php artisan migrate 提示表已经存在https://segmentfault.com/q/1010000009119587
socket发送的信息怎么在浏览器中显示出来https://segmentfault.com/q/1010000009159874
https://segmentfault.com/q/1010000009159717
通过正则提取出来的ip，怎么命名https://segmentfault.com/q/1010000009147022
怎样在网页上运行Python脚本？https://segmentfault.com/q/1010000009044320
python该种情形下应该使用pickle还是csvhttps://segmentfault.com/q/1010000009107764 
requests.post(headers=headers,params=data, data=json.dumps(payload),url=qiuzhi_url)
https://segmentfault.com/q/1010000009117002
requests爬取[大街网]职位信息，尝试多次失败，帮忙看看我的代码有什么问题？应该怎么改呢？https://segmentfault.com/q/1010000009116197

python mp3流如何转无损wavhttps://segmentfault.com/q/1010000009095487
网易邮箱Web端模拟登录看信的加密参数_ntes_nnid、_ntes_nuidhttps://segmentfault.com/q/1010000009135799
索引的长度超过了mysql的限制,在migrate之前,设置

$table->string('email' , 32)->index();
$table->string('token' , 128)->index();
导入10万条数据，数据库里有100万条数据，如何判断重复https://segmentfault.com/q/1010000009121453
```js
假定目标表叫做 target（100万数据）， 需要导入的表叫做 source（10万数据）。
本例很大的一部分时间消耗在于判断是否两张表中的记录一样，猜测楼主想要 所有字段都相同（除了id字段）才认定为是同一条记录。

给每条记录计算一个类Hash值，可以存在target和source新建的字段中（hashValue), 计算量是 110万。然后使用以下语句导入数据

IF EXISTS(
    SELECT TOP 1 1
      FROM source a
      INNER JOIN target b
    ON a.hashValue = b.hashValue
) BEGIN

  -- 返回重复记录
    SELECT a.*
      FROM source a
      INNER JOIN target b
    ON a.hashValue = b.hashValue

END
ELSE 
BEGIN
    INSERT INTO Target(filed1, field2, field3, field4 ... hashValue)
    SELECT
      t.filed1,
      t.field2,
      t.field3,
      t.field4, ..., t.hashValue
    FROM target t
END
```
[值得回头看几遍](https://www.zhihu.com/collection/19561986)
[知乎实时热门](https://www.zhihu.com/collection/118261499)
[laravel用构造器写了一个查询,如何知道具体运行的sql语句](https://www.zhihu.com/question/58792455)
```js
MySQL开general_log就能看到应用程序执行了哪些SQL:my.cnf:
[mysqld]
general_log=ON
general_log_file=/path/to/sql.log
用 tail -f /path/to/sql.log 实时监听日志文件的改变.用ORM和Query Builder还不如用PDO+SQL来得简单直接:有参数的:
$stmt = $db->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
$rowCount = $stmt->rowCount();
没有参数的:
$rows = $db->query($sql)->fetchAll();
$rowCount = $db->query($sql)->rowCount();
https://link.zhihu.com/?target=http%3A//overtrue.gitbooks.io/building-web-apps-with-laravel5/
 PHP的几种SAPI(Server API):

php(cli,cli-server)
php-cgi(cgi-fcgi)
php-fpm/hhvm(fpm-fcgi)
libphp7.so/php7apache2_4.dll(apache2handler)
cli跟其他SAPI最大的区别就是:像你熟悉的各种超全局变量$_SERVER,$_COOKIE,$_SESSION,$_GET,$_POST,$_FILES,你没法在cli下正常使用了,换言之,就是cli下默认没有这些东西.
```
文件包含漏洞(绕过姿势)https://zhuanlan.zhihu.com/p/26287501?group_id=835055887910588416
4行Python代码获取所在城市天气预报https://zhuanlan.zhihu.com/p/26369491?group_id=836265482196754432
 r = requests.get('http://www.weather.com.cn/data/sk/101020100.html')
 r.encoding = 'utf-8'
 一行curl：
curl "http://www.weather.com.cn/data/sk/101020100.html" | jq -c ". | .weatherinfo.city, .weatherinfo.WD, .weatherinfo.temp"
一行 shell：curl
http://wttr.in
xlwings 让你的 Excel 飞起来https://zhuanlan.zhihu.com/p/25810634
计算一个整数的阶乘https://zhuanlan.zhihu.com/p/26288051?group_id=835065900435636224
傻子才去记Excel的函数，聪明人都用这招https://zhuanlan.zhihu.com/p/26324706?group_id=835549668145496064
爬虫天坑系列-百度指数爬虫https://zhuanlan.zhihu.com/p/26295228?group_id=835159482865692672
使用Python进行语音识别---将音频转为文字https://zhuanlan.zhihu.com/p/26121974?group_id=834701120264892416
如何用Python做一个微信自动拉群机器人？https://zhuanlan.zhihu.com/p/26277794?group_id=835166911510765568
25 个 questions, 教你向面试官提问!https://zhuanlan.zhihu.com/p/26287742?group_id=835062556828766208
Python 基础梳理(思维导图与汇总)http://link.zhihu.com/?target=https%3A//github.com/Windrivder/Python-Book
作为面试官，面试时我会问这三个问题https://zhuanlan.zhihu.com/p/26272337?group_id=834763880705167360 
程序员职业发展该怎么做https://zhuanlan.zhihu.com/p/26334825?group_id=835796642362970112
微博社交网络图：爬虫+可视化https://zhuanlan.zhihu.com/p/26316380?group_id=835463883828363264
效率君先用Tineye（专业的以图搜图网站）
https://zhuanlan.zhihu.com/p/26326810?group_id=835553821164986369  Python 网络爬虫入门
[微信机器人进化指南](https://zhuanlan.zhihu.com/p/26319288?group_id=835502104545230848)
笨办法学前端http://link.zhihu.com/?target=https%3A//frankfang.github.io/wheels/
[我的职业是前端工程师](http://ued.party/)
[我是如何使用Python来自动化我的婚礼的](https://zhuanlan.zhihu.com/p/26395384)
[校长，我要上车——python模拟登录熊猫TV](https://zhuanlan.zhihu.com/p/26164778?group_id=837315473673707520)
用chrome打开pandaTV，同时按F12打开chrome dev tool，选择Network栏，勾选Preserve log，如图所示。勾选Preserve log 是为了不让抓包被刷新掉，因为登录过程中有一次刷新，很容易就把关键的包刷掉了。
[你一定能看懂的算法基础书《算法图解》](https://zhuanlan.zhihu.com/p/26332883?group_id=835775400192925696)
[机器学习的数学之 python 矩阵运算](https://zhuanlan.zhihu.com/p/26343623?group_id=835872318491361280)

[又在知乎上get√新技能](https://www.zhihu.com/collection/30569180)
[从0开始学PHPExcel(1)之初探](https://zhuanlan.zhihu.com/p/26515492?group_id=839150577912025088)
```js
http://link.zhihu.com/?target=https%3A//github.com/PHPOffice/PHPExcel
header('content_type:text/html;charset=utf-8');
	$dir=dirname(__FILE__);//找到当前脚本所在的路径
	include $dir."/PHPExcel.php";//引入文件
	$objPHPExcel = new PHPExcel();//实例化PHPExcel类 (相当于创建了一个excel表格)
	$objSheet=$objPHPExcel->getActiveSheet();//获取当前活动sheet的操作对象
	$objSheet->setTitle("demo");//给当前活动的sheet这只名称为demo
	$objSheet->setCellValue("A1","昵称")->setCellValue("B1","性别")->setCellValue("C1","年龄");//给当前活动的sheet填充数据
	$objSheet->setCellValue("A2","羊大仙")->setCellValue("B2","男")->setCellValue("C2","21");
	$objSheet->setCellValue("A3","张三")->setCellValue("B3","女")->setCellValue("C3","18");
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");//按照指定的格式生成excel文件
	$objWriter->save($dir."/demo.xlsx"); //命名保存的路径
```
[他看了几千份技术简历，愿意把技术简历的秘籍传授给你](https://zhuanlan.zhihu.com/p/26494021?group_id=838750245969092608)
[【收藏】数据分析必备神器](https://zhuanlan.zhihu.com/p/26494069?group_id=838744356759408640)
http://www.picdata.cn/#
[Scrapy爬图片（二）](https://zhuanlan.zhihu.com/p/26419110?group_id=838166013559341056)
[“你最大的缺点是什么？”，面试中你最好这样回答...](https://zhuanlan.zhihu.com/p/26445672?group_id=837979918125121536)
有时候，我会过于关注一件事，尤其是截止日期很赶或成果很重要的时候，这时我对其他事的关注可能没那么够

我有时会太注重细节，失去全局观
[世界上最好语言，PHP技术百问](https://zhuanlan.zhihu.com/p/26484814)
[ python Web 运维 爬虫.....一条龙学习视频教程](https://zhuanlan.zhihu.com/p/24518315)
链接：http://pan.baidu.com/s/1boTrTmv 密码：w7ml解压密码: redis章节:www.helloworld.com 其他:www.zygx8.com
[知乎牛人集中营](https://www.zhihu.com/collection/19682978)
[mysql 证明为什么用limit时，offset很大会影响性能](https://github.com/zhangyachen/zhangyachen.github.io/issues/117)
select * from test where val=4 limit 300000,5; select * from test a inner join (select id from test where val=4 limit 300000,5) b on a.id=b.id;
[nginx 502 VS 504](https://github.com/zhangyachen/zhangyachen.github.io/issues/89)
[mysql group max](https://github.com/zhangyachen/zhangyachen.github.io/issues/103)
查找人数(userNum)最多的行对应的teamId，为什么会返回1呢？很显然人数最多的行对应的teamId不是1。
select teamId,userNum from iknow_team_info order by userNum desc limit 1
select teamId,max(userNum) maxNum from iknow_team_info group by teamId order by maxNum desc limit 1;
[酷炫的matplotlib](https://zhuanlan.zhihu.com/p/26441649?group_id=837805836544929792)
[《数据运营手册》| GrowingIO ](https://zhuanlan.zhihu.com/p/26486065)
[python38 行代码实现传输 Android 实时画面](https://www.v2ex.com/t/356275)

[一个自动上色的网站——Automatic Image Colorization](https://zhuanlan.zhihu.com/p/26438147?group_id=837740550802264064)
[6个提高学习和工作效率的神器](https://zhuanlan.zhihu.com/p/25080445?group_id=837746344964784128)
youtube高清视频在线下载 http://link.zhihu.com/?target=http%3A//www.clipconverter.cc/ http://link.zhihu.com/?target=http%3A//www.flvcd.com/
[IP精确定位的一个网站](http://opengps.cn/Data/IP/LocHighAcc.aspx)
[Python如何识别二维码](https://zhuanlan.zhihu.com/p/21292914?group_id=837314583822741505)
import zbar
from PIL import Image
[sql连接查询中on筛选与where筛选的区别](https://zhuanlan.zhihu.com/p/26420938?group_id=837596545636536320)
select * from main left JOIN exton main.id = ext.id and address <> '杭州'
select * from main left JOIN ext on main.id = ext.id where address <> '杭州'
1、先对两个表执行交叉连接(笛卡尔积)

2、应用on筛选器

3、添加外部行

4、应用where筛选器

[不那么反人性的爬虫，浏览器渲染](https://zhuanlan.zhihu.com/p/26385967?group_id=836718435974135808)
http://link.zhihu.com/?target=http%3A//www.seleniumhq.org/download/  selenium (里面涉及到要用的webdriver, 比如我用的chrome
http://link.zhihu.com/?target=https%3A//github.com/leven-ls/cq_lianjia 
[从零开始的 Python 爬虫速成指南](https://zhuanlan.zhihu.com/p/26301354?group_id=836539571704569857)
[为了找一份Python实习，我用爬虫收集数据](https://zhuanlan.zhihu.com/p/26409764?group_id=837352936089722880)
[手把手教你搭建谷歌TensorFlow深度学习开发环境！](https://zhuanlan.zhihu.com/p/26389992?group_id=836913754196299776)
[python奇技淫巧](https://zhuanlan.zhihu.com/p/26459091)
```js
os.system('pause') print a.prettify()
获取python安装路径

from distutils.sysconfig import get_python_lib
print get_python_lib
查看系统环境变量

os.environ["PATH"]
当前平台使用的行终止符

os.linesep
域名解析为ip
isinstance("123",(int,long,float,complex)
file_dict={"a":1,"b":2,"c":3}
file_dict_new=sorted(file_dict.iteritems(), key=operator.itemgetter(1),reverse=True) ##字典排序,reverse=True由高到低，itemgetter(1)表示按值排序，为0表示按key排序
ip= socket.getaddrinfo(domain,'http')[0][4][0]
输出一个目录下所有文件名称
列表去重

ids = [1,4,3,3,4,2,3,4,5,6,1]
ids = list(set(ids))
将嵌套列表转换成单一列表

a = [[1, 2], [3, 4], [5, 6]]
>>> import itertools
>>> list(itertools.chain.from_iterable(a))
[1, 2, 3, 4, 5, 6]
>>> ip= socket.getaddrinfo('zhuanlan.zhihu.com','http')[0][4][0]
>>> ip
'118.178.213.186'
def search(paths):
    if os.path.isdir(paths):  #如果是目录
          files=os.listdir(paths)  #列出目录中所有的文件
          for i in files:
               i=os.path.join(paths,i)  #构造文件路径
               search(i)           #递归
          elif os.path.isfile(paths): #如果是文件
               print paths   #输出文件名
```
[无广告，集百度，谷歌] (http://www.qi1y.cn/)
Windows 绝赞应用 https://emlvirus.gitbooks.io/windows-apps-that-amaze-us/content/ 
[值得购买/使用的、能够提升码农日常生活/工作的服务工具](https://www.v2ex.com/t/355892#reply97)
[Python 字符串 '0x01' 转换成 数字](https://www.v2ex.com/t/356421#reply5)
int('0xaa01', 16)int('0x01',0) int(eval('0x01'))
[2017 谷歌可用hosts](http://www.51ask.org/article/256)
修改hosts后如果不生效 ，需要刷新DNS ipconfig /flushdns  sudo rcnscd restart
[PHP 在线项目挑战](https://www.v2ex.com/t/356459#reply0)
挑战地址： https://www.shiyanlou.com/contests/lou5/challenges  可以找你擅长的题目试试身手： https://www.shiyanlou.com/contests/
[MySQL 获取随机数据方法](http://www.51ask.org/article/428)
推荐使用PHP解决。尽量少用mysql去处理问题。
交给php解决 不操作mysql 比如 一千w条数据 随机取十条 先用php生成一千万以内的随机数 20个 再用mysql的主键in(这20个随机数) 之所以取20条是因为有些id可能被删除了 然后再用php处理成10条。性能最高
[农民房设计服务，「求设计」新站上线](https://www.v2ex.com/t/356294#reply46)
 https://qiusheji.com
[命令行传参的时候, 请问如何防止参数带有特殊符号，使得整行命令 broke](https://www.v2ex.com/t/349792#reply9)
但是当密码带有$符号的时候，整行命令就 broken 
防止 argumen 里面注入非法字符有 2 种， 
1. 在每个非法字符前面用\转义。 
2. 用单引号'' 来包裹 argument 。
> echo $var 

> export var=passwd 
> echo $var 
passwd 
> echo \$var 
$var 
> echo "$var" 
passwd 
> echo '$var' 
$var
[css让页面动起来](https://www.v2ex.com/t/353955)
https://daneden.github.io/animate.css/  http://www.coolshell.cn/ 可以把 high 一下 拖到书签位置，然后打开其他网站再点击书签，同样有效
https://gist.github.com/devn/5007287 
javascript:setInterval(() => {document.querySelectorAll('p,img,button,h1,h2,h3').forEach(x=>x.style=`transform:rotate(${Math.random()*777}deg) scale(${Math.random()*3}); transition:all 500ms`)}, 500);
[wechat-go 微信机器人](https://www.v2ex.com/t/356399#reply31)
https://github.com/songtianyi/wechat-go
[懒得找-程序员购衣导航网](https://www.v2ex.com/t/356359#reply12)
目前网站雏形见： http://www.landezhao.com/ 
[科学上网管理系统正式开源  PHP 技术栈 ](https://www.v2ex.com/t/355402#reply50)
BiliBili 解析 下载 合并 一条龙服务 

https://github.com/XhstormR/GetBilibili
 
[微信指数多词对比查询工具](https://www.v2ex.com/t/352709#reply9)
 http://wx.quafelabs.com/wxIndex 

Github 地址： https://github.com/ZhuFaner/shadowsocks-manage-system
[ 基于 yourls 搭建的短网址服务](https://www.v2ex.com/t/353705#reply84)
https://u.nu/ 

API 文档在这儿 

https://u.nu/api/ 
[给自己挖了一个 Python 爬虫系列的坑](https://www.v2ex.com/t/353080#reply19)
[开源 PHP 图床程序](https://www.v2ex.com/t/353270#reply35)
演示地址： https://famio.liew.io 
Git ： https://git.oschina.net/famio/wocreat 
[Mobi.css 2 发布 beta 版，一个轻量、可拓展、移动端优先的 css 框架](https://www.v2ex.com/t/352809#reply15)
[ Tiicle 一个程序员分享编程知识和协作的平台](https://www.v2ex.com/t/352855#reply15)
https://tiicle.com/
[第二篇爬虫文章](https://www.v2ex.com/t/352150#reply20)
[耀眼的 404 页面](https://www.v2ex.com/t/352105#reply78)
[PHP 写了一个管理本地 Nginx 网站配置文件的命令行小工具](https://www.v2ex.com/t/352420#reply6)

https://github.com/panlatent/site-cli 
[视频专辑《如何提高生产效率目录》](https://www.v2ex.com/t/352396#reply14)
http://www.findspace.name/easycoding/1890
[Python 下发送邮件的库](https://www.v2ex.com/t/351693#reply8)
```js
from Smail import Smail
a=Smail()
#设置邮件服务期信息，包含 smtp 地址，端口，登录账号和密码，如果端口不是 25 就启用 SSL 。 
a.set_server("smtp.exmail.qq.com",465,"admin@aliencn.net","password")
#写一个主题  
a.set_subject('hello')  
#写邮件内容，默认情况下邮件是 plain 的格式，如果要切换成 html 的可以执行 a.set_mail_type('html')
a.set_content('world') 
#添加收件人，可以添加多个
a.add_to_addr('admin@aliencn.net')  
a.add_to_addr('admin2@aliencn.net')  
#Optional
#接下来就是可选项了，比如添加抄送、密送、附件什么的
a.add_cc_addr('admin1@aliencn.net')  
a.add_cc_addr('admin2@aliencn.net')  
a.add_bcc_addr('admin3@aliencn.net')  
a.add_bcc_addr('admin4@aliencn.net')  
a.add_attachment(r'D:\Alien_System\Desktop\0.jpg')  
a.add_attachment(r'D:\Alien_System\Desktop\1.exe')  
 
#send mail now
#最后一步，发送邮件
a.send()
```
[ mysql 中文排序的问题，就是某一列是有“高”、“中”、“低”三种值，然后我怎么才能 orderby 出高中低的效果](https://www.v2ex.com/t/350941#reply16)
 order by decode ，然后搜索到 MySQL 的， ORDER BY FIND_IN_SET(FieldName,"高,中,低")


[阿里云代码](https://code.aliyun.com/)
[pdf 文件转成 html 文件](https://github.com/coolwanglu/pdf2htmlEX)
[GitHub 与 Python 有关的 repo 集合](https://www.v2ex.com/t/350802#reply7)
[从事摄影后期的人要失业了](https://github.com/luanfujun/deep-photo-styletransfer)
[开源项目——HelloGitHub](https://www.v2ex.com/t/351587#reply39)
[简书上写 Python 爬虫系列文章](https://www.v2ex.com/t/351900#reply80)
http://www.jianshu.com/p/11d7da95c3ca  https://blog.ansheng.me/article/python-full-stack-way/
[开坑一个从零开始的 Python 爬虫教程](https://www.v2ex.com/t/351442#reply47)
http://www.jianshu.com/p/e3444c52c043
[CodePan: 能够离线使用的 JSBin/CodePen](https://www.v2ex.com/t/351601#reply4)
网站: https://codepan.js.org
 V2 签到脚本 

https://github.com/bonfy/qiandao
代码: https://github.com/egoist/codepan
[MarkDown 文档帮助系统](https://www.v2ex.com/t/348636#reply6)
https://elvisszhang.github.io/jr-docs/
[基于命令行的网易云音乐下载器](https://www.v2ex.com/t/348005#reply3)
https://github.com/ziwenxie/netease-dl

[支付宝收款明细检查工具](https://www.v2ex.com/t/347913#reply20)
[Composer 的源管理工具 slince/crm](https://www.v2ex.com/t/347603#reply5)
http://0.30000000000000004.com/ composer global require slince/crm

[支付宝 alipay-sdk- PHP](https://www.v2ex.com/t/348451#reply31)
https://github.com/wxpay/WXPay-SDK-PHP   https://github.com/fishlab/alipay-sdk-php
```js
经实践，最终我的做法是： 
1 、在 vendors 下新建 alipay 
2 、把 SDK 里的 aop 目录拷到 alipay 下（抛弃原来 SDK 目录下的 lotusphp_runtime 和 AopSdk.php ） 
3 、最终目录结构是 vendors/alipay/aop 
4 、 composer.json 的 autoload 节点里加入： 

"classmap": [ 
"vendor/alipay/aop" 
]
5 、运行``composer dump-autoload`` 
6 、这样在项目里可以不用 require ，直接： 

// 仅测试能使用命名空间，忽略参数设置吧。。。 
$a = new \AopClient(); 
$b = new \AlipayAppTokenGetRequest(); 
$c = $a->execute($b);
```
[拉勾的爬虫](https://www.v2ex.com/t/346862#reply13)
https://github.com/whatsGhost/lagou_spider  
[root 防撤回 微信 QQ](https://www.v2ex.com/t/347634#reply56)
http://github.com/JasonQS/Anti-recall 
[ PHP 循环获取用户关系树的性能问题](https://www.v2ex.com/t/347529#reply31)
[循环超过 5000 条时，页面就不动了，内存都用完了](https://www.v2ex.com/t/346901#reply29)


[PHP 写的验证码类](https://www.v2ex.com/t/347730#)
传送门： https://github.com/sostuts/Vcode
[创业公司安全基础](https://github.com/Hopsken/security-101-for-saas-startups-zh_CN)

[Nginx+ PHP -fpm 运行原理详解](https://www.v2ex.com/t/351308#reply6)
[Chrome 扩展一枚： ToolCat 开发者常用工具](https://www.v2ex.com/t/349791#reply10)
http://tool.leavesongs.com/
[Python企查查爬虫](http://pituber.com/t/python/42)
[各语言常用工具库及资料【爬虫相关】](http://pituber.com/t/topic/131)
[传送门这个网站采集了大量的微信公众号文章](https://www.v2ex.com/t/349562#reply24)
http://www.tianfangyetan.org/ http://phptools.cn ，还集成了一个 google 镜像
[创建联动选择器的 js 库](https://www.v2ex.com/t/349215#reply4)
https://jsfiddle.net/lmk123/8d2x8dLy/
[玩法收藏/云服务器/Python3 环境安装 PySpider 爬虫框架](https://www.v2ex.com/t/349209#reply4)
pip install pyspider

[Composer Packagist 镜像搭建工具](https://www.v2ex.com/t/345641#reply3)
https://github.com/garveen/imagist
[做了一个标题党制作器](https://www.v2ex.com/t/346036#reply29)
[简单生成 Excel2007 xlsx 文档的 PHP 类，主要解决了内存占用问题](https://www.v2ex.com/t/345939#reply2)
https://github.com/chopins/toknot/blob/master/vendor/toknot/Toknot/Share/SimpleXlsx.php

图片小站，堪称宅男神奇。 http://www.chihepiao.com （吃喝嫖全拼）

[在线 markdown 转 html 的小工具， http://md2html.net/ ](https://www.v2ex.com/t/345076#reply23)
curl ifconfig.cat 
wget -q ifconfig.cat 
http -b ifconfig.cat ifconfig.io
[面试问什么问题比较容易看出一个 PHPer 的水平](https://www.v2ex.com/t/344137#reply36)
服务器抓包 HTTP 的工具https://www.v2ex.com/t/343223#reply25
又一个图床 https://ooxx.ooo
github 上比较火的一篇软件设计模式的介绍https://github.com/questionlin/design-patterns-for-humans  https://sourcemaking.com/design-patterns-and-tips 
撸了一个导航网站 喜欢个人博客的进来啦https://www.v2ex.com/t/343011#reply108   传送门： http://blog.yiyeti.cc/ 
[JSON 格式化工具](http://json.awesomes.cn/)
Laravel+Vue 前后端分离 https://www.v2ex.com/t/342281#reply21
web 移动端原生裁剪插件https://github.com/ffx0s/xcrop  Talk is cheap, show me the code -- 用 github 数据辅助你完善简历 https://www.v2ex.com/t/341669#reply38  php面试题 https://www.v2ex.com/t/341873#reply72  https://www.onlinevideoconverter.com/zh 
https://www.youtubeto.com/zh/ 
http://savevideo.me/
翻译了开源书籍 《 Python 数据结构》一书 https://www.v2ex.com/t/340583#reply100 
借助微信测试公众号撸了个 服务器信息推送https://www.v2ex.com/t/340512#reply26
https://github.com/iakisey/ServerMsgPush  发企业号文本消息的 Shell 脚本, 十几行代码搞定. 需要自取. 
https://github.com/x1596357/scripts/blob/master/alert-wechat/alert-wechat.sh  https://github.com/boywhp/fcn  内网穿透的软件
网址收藏应用： http://mybookmark.cn/  开源图床上传工具 [File to URL]https://www.v2ex.com/t/338814#reply42
[PHP 就碰到 PDO 扩展的一个大坑，详情](https://segmentfault.com/q/1010000008305175)
[关于Python的面试题](https://github.com/taizilongxu/interview_python)
PHPMailer 封装，让发邮件更简单https://www.v2ex.com/t/342029#reply6 
[ awesome-backend 收集展示后端开发相关组件和解决方案](https://www.v2ex.com/t/351248#reply0)
Github: https://github.com/sunchen009/awesome-backend
[不错的在线简历模板，如果有需要可以直接拿去用](https://www.v2ex.com/t/351441#reply26)
git clone --recursive https://github.com/onevcat/resume.git
[python免费代理工具，目前来说有用不完的代理 ](https://github.com/awolfly9/IPProxyTool)
[PHP 开源实战主题： PDF 处理类 pdfparser](https://www.v2ex.com/t/351278#reply0)
PDF 处理类 http://www.pdfparser.org/demo
[包学会之浅入浅出 Vue.js](https://www.v2ex.com/t/353120#reply55)
https://www.qcloud.com/community/article/430630001490779316?fromSource=gwzcw.84430.84430.84430
[应对“伸手党”的网站](https://www.v2ex.com/t/354605#reply65)
帮你百度googlehttp://lmgtfy.com/   http://www.baidu-x.com/  http://lmbtfy.cn/ https://shansing.com/lmbtfy/  http://www.lmbtfy.cn/ 
http://lmgtfy.com/
[一个假的苹果网站，能肉眼看出来算我输](https://www.v2ex.com/t/355961#reply80 )
https://www.xn--80ak6aa92e.com/  http://chuangzaoshi.com/friends
[个人博客](https://www.v2ex.com/t/354131#reply47)
[爬取查询百度指数的教程](http://blog.shenjianshou.cn/?p=170)
[Laravel 写了一个图床网站](https://www.v2ex.com/t/353720#reply74)
改成 https://sm.ms 的图床  体验地址： http://img.hanc.cc/ 项目地址： https://github.com/HanSon/img


[Vue 第一次练手： github-issue 博客生成方案](https://www.v2ex.com/t/355274#reply13)
[方正字库开放云平台](http://yun.foundertype.com/)
[Python 分布式抓取京东商城评价并且使用 pandas](https://www.v2ex.com/t/356132#reply22)
体验地址：http://awolfly9.com/jd/
[解析 Excel 文件(xls,xlsx)的 javascript 方案](https://github.com/SheetJS/js-xlsx)
[防不胜防的钓鱼网址](https://www.v2ex.com/t/355174#reply204)
Chrome 插件来防止被钓鱼, 希望对 V 友有用. 

下载地址: https://chrome.google.com/webstore/detail/real-domain-name/lhbkkikjboiebjeghokpefafaahnfoff 
GitHub: https://github.com/liaa/real_domain_name 
[Python 3 写了个基于 selenium 的知乎关键词爬虫，可以爬钓鱼贴图片]()
[《收库 123·导航网》](https://www.v2ex.com/t/355344#reply19)
官网网址： http://shouku123.com/  http://123.xcatliu.com/  chuangzaoshi.com  撸表情 http://www.lubiaoqing.com  http://www.alloyteam.com/nav/
[下载微博、秒拍视频](http://v.atob.site/)
[基于 laravel 的一个后台管理系统](https://www.v2ex.com/t/355936#reply28)
https://github.com/AnyISalIn/zhihu_fun 


[编解码小工具](https://www.v2ex.com/t/349150#reply1)
http://tool.leavesongs.com/
[一个解除网页“禁用复制”的小书签](https://www.v2ex.com/t/356477#reply7)
https://github.com/yulanggong/celery 
[Python 密码泄露查询模块 leakPasswd](https://www.v2ex.com/t/355641#reply19)
[百度网盘爬虫](https://www.v2ex.com/t/348731)
[blibili 直播换成 HTML5 播放器的油猴脚本](https://www.v2ex.com/t/339625)
安装地址： https://greasyfork.org/zh-CN/scripts/27239  DPlayer ： https://github.com/DIYgod/DPlayer
[PHP 写一个爬虫](https://www.v2ex.com/t/347589)
gouchaoer 同学的爬虫经验分享： https://www.v2ex.com/t/324309 

另外可以看下这个： https://github.com/owner888/phpspider https://github.com/slince/spider 分分钟教你做人。 https://querylist.cc/ 靠谱简单的 https://github.com/FriendsOfPHP/Goutte https://doc.phpspider.org/
分分钟搞定一个爬虫程序 https://www.figotan.org/2016/08/10/pyspider-as-a-web-crawler-system/
 这种简单验证码识别率应该可以达到 100%  https://gist.github.com/liberize/79f9bfb5a7e767b4b756ff1c7dc04eaa
[php 敏感词过滤 php-ext-trie-filter](http://www.51ask.org/article/421)
[将页面内容输出为 pdf 文档](https://www.v2ex.com/t/356363)
TCPDF 分页 
Mpdf 完美 html 排版 
PHP 生成 PDF ： http://www.51ask.org/article/232
http://pdftest.xieyi.im/ https://github.com/MrRio/jsPDF 
phantomjs 挺好的啊。有现成的 example https://github.com/ariya/phantomjs/blob/master/examples/rasterize.js

chrome 浏览器 选择内容 右键-打印 保存到 pdf 效果不错啊 可以分页啊 
有其他需求就 acrobat 有浏览器插件
 https://github.com/wkhtmltopdf/wkhtmltopdf
 
 [猴子选大王](http://www.51ask.org/article/406)
 ```js
 /**
* 猴子选大王
*一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。
* @param int $m 猴子数
* @param int $n 出局数
* @return array
*
*/
function ws_king($m ,$n)
{
//构造数组
for($i=1 ;$i<$m+1 ;$i++){
   $arr[] = $i ;
}
$i = 0 ;    //设置数组指针

while(count($arr)>1)
{
   //遍历数组，判断当前猴子是否为出局序号，如果是则出局，否则放到数组最后
   if(($i+1)%$n ==0) {
    unset($arr[$i]) ;
   } else {
    array_push($arr ,$arr[$i]) ; //本轮非出局猴子放数组尾部
    unset($arr[$i]) ;   //删除
   }
   $i++ ;
}
return $arr ;
}

var_dump(ws_king(6,4));
 ```
[ mysql 优化整理](http://blog.csdn.net/gaoxuaiguoyi/article/details/47439331)


```js
/**
 *@功能：获取客户端的代理IP地址,很容易被程序篡改http://www.51ask.org/article/372
 *@参数：null
 *@返回：客户端的IP地址
 */
function get_proxy_ip()
{
    $arr_ip_header = array(
        'HTTP_CDN_SRC_IP',
        'HTTP_PROXY_CLIENT_IP',
        'HTTP_WL_PROXY_CLIENT_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR',
    );
    $client_ip = 'unknown';
    foreach ($arr_ip_header as $key)
    {
        if (!empty($_SERVER[$key]) && strtolower($_SERVER[$key]) != 'unknown')
        {
            $client_ip = $_SERVER[$key];
            break;
        }
    }
    return $client_ip;
}
count(column) 是表示结果集中有多少个column字段不为空的记录。

　　count(*) 是表示整个结果集有多少条记录。

拆分大的 DELETE 或 INSERT 语句
while (1) { 
    //每次只做1000条 
    mysql_query("DELETE FROM logs WHERE log_date <= '2009-11-01' LIMIT 1000"); 
    if (mysql_affected_rows() == 0) { 
        // 没得可删了，退出！ 
        break; 
    } 
    // 每次都要休息一会儿 
    usleep(50000); 
} 
应尽量避免在where子句中对字段进行函数操作，这将导致mysql放弃使用索引

          select uid from imid where datediff(create_time,'2011-11-22')=0
            优化后
           select uid from imid where create_time> ='2011-11-21‘ and create_time<‘2011-11-23’;
$user = User::create($createArr);
        $name = 'v'.$user->id;
        $user->name = $name;
        $user->save();
```
[PHP类延迟加载机制原理](http://blog.csdn.net/gaoxuaiguoyi/article/details/49622155)
```js
//1.不使用类延迟加载  
      
    require 'class/Class1.php';  
    require 'class/Class2.php';  
      
    $c1 = new Class1;  
    $c2 = new Class2;  
    $c1->say();  
    $c2->say();  
      
    //2.使用类延迟加载  
      
    function autoload($class){  
          
        require ('class/'.$class.'.php');  
          
    }  
    spl_autoload_register("autoload");  
      
      
    $c1 = new Class1;  
    $c2 = new Class2;  
    $c1->say();  
    $c2->say(); 
    实例化一个PHP类的时候，new class这个过程如果没有包含类文件活报出警告信息，没有包含该类文件，但是这个时候，会去执行spl_autoload_register这个函数，执行之后，会将我们new的类名传递过去，进行包含我们的类文件，这样就是我们在使用的时候才去加载需要的类，而不是无论是否使用都进行加载
```

[laravel的依赖注入http://blog.csdn.net/gaoxuaiguoyi/article/details/50042829]()
```js
public function register()  
 {          
     //$this->app->bind(App\Services\IUserService::class, App\Services\IUserServiceImpl::class);  
 //单例模式创建对象  
     $this->app->singleton('\App\Services\IUserService', function()  
             {  
                 return new \App\Services\IUserServiceImpl();  
             });  
 } 
 /** 
 * 控制器 
 */  
class UserController extends Controller{  
 private  $UserService;  
//注入接口的实例对象IUserServiceImpl,其实laravel框架帮助我们实现了 IUserService  $service = new IUserServiceImpl();这一步。  
 public function __construct(IUserService $service){  
   
  $this->UserService = $service;  
  
 }  
```
[适配器模式的优点既没有修改原来的类，又扩展了原来的类](http://blog.csdn.net/gaoxuaiguoyi/article/details/62991893)
```js
class OldClient  
{  
  
    public function oldRequest()  
    {  
  
        echo '老方法不满足现在的需求<br/>';  
    }  
  
}  
  
/** 
 * 新的需求接口 
 * Interface Target 
 */  
interface Target  
{  
  
    public function newRequest();  
  
}  
  
  
class Adapter extends OldClient implements Target  
{  
    public function newRequest()  
    {  
  
        echo '新方法满足现在的需求';  
    }  
  
}  
//测试  
$Adapter1 = new Adapter();  
$Adapter1->oldRequest();  
$adapter = new Adapter();  
$adapter->newRequest(); 
```
[ PHP工厂模式和单例模式](http://blog.csdn.net/gaoxuaiguoyi/article/details/50859596)
```js
namespace Factory;  
  工厂模式的好处就是我们创建对象的方法是统一的，不是在我们需要的地方直接使用new进行创建，降低了模块之间的耦合度，并且当我们修改了类的名称我们只需要在工厂类里面修改一处即可完成。
单例模式好处是我们使用对象的时候不是每次使用都去new一个新对象出来，这样造成很大的开支和浪费，单例模式保证我们程序运行过程中对象产生一次，节省了开支。
  
class ObjectFactory {  
  
    /** 
     * 工厂模式 
     */  
  
    public static function createObject(){  
  
  
        $obj = Object::getInstance();  
  
          
      return $obj;  
    }  
  
}  

spl_autoload_register('autoload');  
  
function autoload($className){  
  
  
    $classFile = ROOT.'/'.str_replace('\\','/',$className).'.php';  
  
    include $classFile;  
  
} define('ROOT',__DIR__);  
  
  require 'autoload.php';  
  
  $obj =  Factory\ObjectFactory::createObject();  
  
  $obj->say();
  //这个控制器直接在根目录下面，如果定义的控制器又加了一层文件夹的话可以使用namespace进行控制 Route::group(['namespace'=>'xxxxx','middleware'=>['checkuser','dealuser']]);

Route::group(['middleware'=>['checkuser','dealuser']],function(){

    Route::post('user/addUser','UserController@postAdduser');
});
```
[PHP实现双端队列](http://blog.csdn.net/gaoxuaiguoyi/article/details/45723757)
```js
class Deque    
{   
    public $queue = array();   
      
    /**（尾部）入队  **/   
    public function addLast($value)    
    {   
        return array_push($this->queue,$value);   
    }   
    /**（尾部）出队**/   
    public function removeLast()    
    {   
        return array_pop($this->queue);   
    }   
    /**（头部）入队**/   
    public function addFirst($value)    
    {   
        return array_unshift($this->queue,$value);   
    }   
    /**（头部）出队**/   
    public function removeFirst()    
    {   
        return array_shift($this->queue);   
    }   
    /**清空队列**/   
    public function makeEmpty()    
    {   
        unset($this->queue);  
    }   
      
    /**获取列头**/  
    public function getFirst()    
    {   
        return reset($this->queue);   
    }   
   
    /** 获取列尾 **/  
    public function getLast()    
    {   
        return end($this->queue);   
    }  
   
    /** 获取长度 **/  
    public function getLength()    
    {   
        return count($this->queue);   
    }  
      
}  
```
[ PHP csv大量数据导出分割处理](http://blog.csdn.net/gaoxuaiguoyi/article/details/47108129)
```js
后台管理系统总是成百万的数据导出，使用excel导出根本不能实现，excel只支持65536，2007和2010的是1048576，所以无论哪一种都不能满足需求，csv就符合需求，
 error_reporting(0);  
        header ( "Content-type:application/vnd.ms-excel" );  
                header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", "topic" ) . ".csv" );      
        //连接数据库   
        $link = mysql_connect('localhost','root','root') or die('连接错误');  
            //选择数据库  
            mysql_select_db("bbs",$link);  
            //设置字符集  
            mysql_query("set names utf8");  
            //查询函数  
            function get_res($sql,$link){  
                  
                $res  = mysql_query($sql,$link);  
                  
                if(!$res){  
                      
                    die("操作失败".mysql_error());  
                }  
                $arr=array();  
                while ($row = mysql_fetch_assoc($res)) {                
                        $arr[]=$row;  
                    }  
                return $arr;  
            }  
            //查询记录总数  
            function getTotalCount(){  
                  
                $result = mysql_query("SELECT count(*) as count FROM medsci_edu_public_medsciedu_topic", $link);  
                  
                return $result['count'];  
            }  
               // 打开PHP文件句柄，php://output 表示直接输出到浏览器  
                $fp = fopen('php://output', 'a');   
                //表头  
        $column_name = array('topic_id','cat_id','user_id','is_best','is_top','topic_title',  
                 'topic_content','topic_img','hits','total_reply_count','created_time','last_updated_time','topic_status','last_reply_name');  
                // 将中文标题转换编码，否则乱码  
              foreach ($column_name as $i => $v) {    
                   $column_name[$i] = iconv('utf-8', 'gbk', $v);    
              }  
        // 将标题名称通过fputcsv写到文件句柄    
              fputcsv($fp, $column_name);  
              $pagecount = 10000;//一次读取多少条  
        $totalcount = getTotalCount();//总记录数  
        $sql = "select * from medsci_edu_public_medsciedu_topic";  
           for ($i=0;$i<intval($totalcount/$pagecount)+1;$i++){  
            $data = get_res($sql." limit ".strval($i*$pagecount).",{$pagecount}",$link);  
            foreach ( $data as $item ) {  
                $rows = array();  
                foreach ( $item as $v){  
                    $rows[] = iconv('utf-8', 'GBK', $v);  
                }  
                fputcsv($fp, $rows);  
            }  
            // 将已经写到csv中的数据存储变量销毁，释放内存占用  
            unset($data);  
            //刷新缓冲区  
            ob_flush();  
            flush();  
        }  
    exit;  
```

[CURL下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47104945)
```js
$url = 'http://pic1.nipic.com/2008-09-08/200898163242920_2.jpg';    
    
    function http_get_data($url) {    
            
        $ch = curl_init ();    
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );    
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );    
        curl_setopt ( $ch, CURLOPT_URL, $url );   
        //打开输出控制缓冲  
        ob_start ();    
        curl_exec ( $ch );    
        //返回输出缓冲区的内容  
        $return_content = ob_get_contents ();   
        //清空（擦除）缓冲区并关闭输出缓冲  
        ob_end_clean ();    
            
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );    
        return $return_content;    
    }    
        
    $return_content = http_get_data($url);    
    $filename = 'my.jpg';    
    $fp= @fopen($filename,"a"); //将文件绑定到流  
    fwrite($fp,$return_content); //写入文件
```

[PHP手机获取6为不重复验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/46621971)
```js
//存数字数组  
                $code = array();  
           
         while(count($code) < 6){  
             //产生随机数1-9  
             $code[] = rand(1,9);  
                         //去除数组中的重复元素  
                         $code = array_unique($code);  
         }  
         echo "<pre>";  
         print_r($code);  
```

[ laravel事件创建以及使用](http://blog.csdn.net/gaoxuaiguoyi/article/details/50043021)
```js
5.0版本的还可以使用2条命令进行生成事件，还可以分开执行创建事件。
php artisan make:event PupUserchange（事件的类名）
php artisan handler:event UserManagerd(事件处理类) --event=PupUserchange

protected $listen = [  
       'App\Events\SomeEvent' => [  
           'App\Listeners\EventListener',  
       ],  
       'App\Events\PupUserchange'=>[  
       'App\Handlers\Events\UserManagerd'  
       ],  
   ];  
   php artisan event:generate
   Event::fire(new PupUserchange(Users::find(2)));
```
[PHP二维数组根据某个元素去重](http://blog.csdn.net/gaoxuaiguoyi/article/details/53127386)
```js
function array_unset_tt($arr,$key){     
        //建立一个目标数组  
        $res = array();        
        foreach ($arr as $value) {           
           //查看有没有重复项  
           $tmp = array();  
           if(isset($res[$value[$key]])){  
                 //有：销毁  
                  
                 unset($value[$key]);  
                   
           }  
           else{  
                  
                $res[$value[$key]] = $value;  
           }    
        }  
        return $res;  
    }  
    $arr = array(  
              
            array(  
            'title'=>'1111','date'=>'ddddd'  
                  
            ),  
            array('title'=>'22222','date'=>'fffffff'),  
            array('title'=>'1111','date'=>'ggggggg')  
);  
$newArr = array_unset_tt($arr,'title');  
echo '<pre>';  
  
print_r(array_values($newArr));  
//本月第一天  
$beginDate = date('Y-m-01', strtotime(date("Y-m-d")));  
//本月最后一天  
$endDate = date('Y-m-d', strtotime("$beginDate +1 month -1 day"));  
$begintime = strtotime($beginDate);  
$endtime = strtotime($endDate);  
//输出每一天  
for ($start = $begintime; $start <= $endtime; $start += 24 * 3600)  
{  
        echo date('Y-m-d',$start).'<br>';  
}  
```
[PHP self与static区别](http://blog.csdn.net/gaoxuaiguoyi/article/details/49758757)
```js
class Boo {  
        
      protected static $str = "This is class Boo";  
      /* 
      public static function get_info(){ 
           
          echo get_called_class()."<br>"; 
          echo self::$str; 
      }  
      */  
      public static function get_info(){  
            
          echo get_called_class()."<br>";  
          echo static::$str;  
      }   
        
  }  
  class Foo extends Boo{  
        
      protected static $str = "This is class Foo";  
        
  }  
    
    
   Foo::get_info(); 
   大概意思是说self调用的就是本身代码片段这个类，而static调用的是从堆内存中提取出来，访问的是当前实例化的那个类，那么 static 代表的就是那个类，例子比较容易明白些。

其实static就是调用的当前调用的类，比较抽象吧。
```
[PHP 按一定比例压缩图片，保持清晰度](http://blog.csdn.net/gaoxuaiguoyi/article/details/49592151)
```js
 class Image{  
         
       private $src;  
       private $imageinfo;  
       private $image;  
       public  $percent = 0.1;  
       public function __construct($src){  
             
           $this->src = $src;  
             
       }  
       /** 
       打开图片 
       */  
       public function openImage(){  
             
           list($width, $height, $type, $attr) = getimagesize($this->src);  
           $this->imageinfo = array(  
                  
                'width'=>$width,  
                'height'=>$height,  
                'type'=>image_type_to_extension($type,false),  
                'attr'=>$attr  
           );  
           $fun = "imagecreatefrom".$this->imageinfo['type'];  
           $this->image = $fun($this->src);  
       }  
       /** 
       操作图片 
       */  
       public function thumpImage(){  
             
            $new_width = $this->imageinfo['width'] * $this->percent;  
            $new_height = $this->imageinfo['height'] * $this->percent;  
            $image_thump = imagecreatetruecolor($new_width,$new_height);  
            //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度  
            imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);  
            imagedestroy($this->image);    
            $this->image =   $image_thump;  
       }  
       /** 
       输出图片 
       */  
       public function showImage(){  
             
            header('Content-Type: image/'.$this->imageinfo['type']);  
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image);  
             
       }  
       /** 
       保存图片到硬盘 
       */  
       public function saveImage($name){  
             
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image,$name.'.'.$this->imageinfo['type']);  
             
       }  
       /** 
       销毁图片 
       */  
       public function __destruct(){  
             
           imagedestroy($this->image);  
       }  
         
   }  
   
   $src = "001.jpg";  
        $image = new Image($src);  
        $image->percent = 0.2;  
        $image->openImage();  
        $image->thumpImage();  
        $image->showImage();  
        $image->saveImage(md5("aa123"));
```
[PHP使用Screw把源代码加密](http://blog.csdn.net/gaoxuaiguoyi/article/details/53466860)
https://sourceforge.net/projects/php-screw/files/php-screw/
find ./ -name "*.php" -print|xargs -n1 screw //加密所有的.php文件
find ./ -name "*.screw" -print|xargs -n1 rm //删除所有的.php源文件的备份文件
[PHP实现验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/48805451)
get参数进行urlencode转换一下，数据可以正确显示了 使用urlencode进行转换之后  &变成十六进制的%26  空格会变成+  如果使用rawurlencode 空格变成%20：
[PHP多线程读写文件操作](http://blog.csdn.net/gaoxuaiguoyi/article/details/48731035)
[PHP二维数组根据某个数组元素排序](http://blog.csdn.net/gaoxuaiguoyi/article/details/48261653)
```js
$grade = array("score" => array(70, 95, 70.0, 60, "70"),
"name" => array("Zhang San", "Li Si", "Wang Wu",
"Zhao Liu", "Liu Qi"));
array_multisort($grade["score"], SORT_NUMERIC, SORT_DESC,
// 将分数作为数值，由高到低排序
$grade["name"], SORT_STRING, SORT_ASC);
// 将名字作为字符串，由小到大排序
var_dump($grade);
```
[PHP读取大文件小技巧](http://blog.csdn.net/gaoxuaiguoyi/article/details/47951115)
```js
ini_set('memory_limit','-1');  
$file = 'access.log';  
$data = file($file);  
$line = $data[count($data)-1];
$fp = fopen($file, "r");  
$line = 10;  
$pos = -2;  
$t = " ";  
$data = "";  
while ($line > 0) {  
    while ($t != "\n") {  
        fseek($fp, $pos, SEEK_END);  
        $t = fgetc($fp);  
        $pos --;  
    }  
    $t = " ";  
    $data .= fgets($fp);  
    $line --;  
}  
fclose ($fp);  
echo $data  

如果 t2.column1 的值是 NULL 的话，WHERE 子句的结果就是假了：

   SELECT * FROM t1 LEFT JOIN t2 ON (column1) WHERE t2.column2=5;

   因此，这就可以安全的转换成一个普通的连接查询：

  SELECT * FROM t1,t2 WHERE t2.column2=5 AND t1.column1=t2.column1;

  这查询起来就更快了，因为如果能有一个更好的查询计划的话，MySQL就会在 t1 之前就用到 t2 了。
```
[PHP安全下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47952443)
```js
$file_name = "pigcms.rar";     //下载文件名      
    $file_dir = "./file/";        //下载文件存放目录      
    //检查文件是否存在      
    if (! file_exists ( $file_dir . $file_name )) {      
        echo "文件找不到";      
        exit ();      
    } else {      
        //打开文件      
        $fp= fopen ( $file_dir . $file_name, "r" );      
        //输入文件标签       
        Header ( "Content-type: application/octet-stream" );      
        Header ( "Accept-Ranges: bytes" );      
        Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );      
        Header ( "Content-Disposition: attachment; filename=" . $file_name );      
        //输出文件内容       
        //读取文件内容并直接输出到浏览器      
        while(!feof($fp)) {  
                         set_time_limit(0);  
                         echo fread($fp,1024);  
                         flush();  
                         ob_flush();  
                    }   
     
        fclose ( $fp);      
        exit ();      
    }    
```
分批处理数据
```js
$count = 140000;
        $take = 2000;
        $s    = floor($count/$take);
	    for ($i =0 ;$i <= $s; $i++ ){
            $skip   = $take*$i;
            echo 'start ---'.$skip.'---'.$take."---\n";
            $ret = WebinarSwitch::groupBy('webinar_id')->skip($skip)->take($take)->get();
            if(!empty($ret)){
                $list = $ret->toArray();
                foreach ($list as $row){
                    $webinar = Webinars::withTrashed()->find($row['webinar_id']);
                    if(!empty($webinar)){
                        $sql = "update webinar_switch set user_id ='{$webinar['user_id']}' where webinar_id={$row['webinar_id']}; \n";
                        file_put_contents($file,$sql,FILE_APPEND);
                    }
                }
            }
        }
	
30分钟支付
$second = strtotime($order['created_at']) + 60*30 - time();
        if ($second>0) {
            $order['expire'] = date('i:s', $second);
        } else {
            $order['expire'] = '00:00';
        }
	
```
时间相差几天
```js
$a=new \Carbon\carbon()
 <Carbon\Carbon #00000000142cb4980000000048d664ed> {
       date: "2017-04-16 16:07:58.000000",
       timezone_type: 3,
       timezone: "PRC"
   }
 $d=$a->diff(new \carbon\carbon('2017-01-03 11:11:11'),true)
 <DateInterval #00000000142cb4a50000000048d665bd> {
       y: 0,
       m: 3,
       d: 13,
       h: 4,
       i: 56,
       s: 47,
       weekday: 0,
       weekday_behavior: 0,
       first_last_day_of: 0,
       invert: 0,
       days: 103,
       special_type: 0,
       special_amount: 0,
       have_weekday_relative: 0,
       have_special_relative: 0
   }
//输出js数组
  function consoleLog($data, $log = false)
    {
        // 数据预处理json
        if (is_string($data) && $preJsonMsg = json_decode($data, true)) {
            if (count($preJsonMsg) > 1) {
                $data = $preJsonMsg;
            }
        }

        $logFunc = $log ? 'console.log' : 'console.dir';

        if (is_array($data) || is_object($data)) {
            echo("<script>".$logFunc."(".json_encode($data).");</script>");
        } else {
            echo("<script>".$logFunc."('".$data."');</script>");
        }
    }
```
