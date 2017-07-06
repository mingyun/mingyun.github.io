[30分钟掌握ES6/ES2015核心内容（上）](https://segmentfault.com/a/1190000004365693)
```js
 says(say){
       var self = this;
       setTimeout(function(){
           console.log(self.type + ' says ' + say)
       }, 1000)
        says(say){
       setTimeout(function(){
           console.log(this.type + ' says ' + say)
       }.bind(this), 1000)
       says(say){
        setTimeout( () => {
            console.log(this.type + ' says ' + say)
        }, 1000)
    }
   
   第二次foreach的第一次循环时，$v被赋值为$arr[0]，也就是a
而在第一次foreach结束时，$v最终指向了$arr[2]，他们指向同一个地址空间
所以第二次foreach的第一次循环时，$v的值成了a，$arr[2]也就变成了a
第二次foreach的第二次循环时，$v的值成了b，$arr[2]也就变成了b
所以，数组$arr的值就成了a b b
所以第三次循环时，$v的值就成了b
三种解决方案：
① 第二次foreach循环，别用$v了
② 第二次foreach循环之前，unset($v)
$v的引用在 foreach 循环之后仍会保留。建议使用unset()将其销毁
③ 第二次循环也用&

function factorial($n, $total) {
  if ($n === 1) return $total;
  return factorial($n - 1, $n * $total);
}
如果我们按goods_id分组，shop_price降序排列，不会出现所谓诡异的情况，因为此时分组的列（goods_id）和shop_price是一一对应的
select goods_id,goods_name,shop_price from goods group by goods_id order by shop_price desc;
https://segmentfault.com/a/1190000004879597

如果group by之后还要使用order by，那么order by的字段最好是select返回的字段，避免所谓诡异的情况
```
![php foreach](https://segmentfault.com/img/bVsnma)
[翻墙蓝灯](https://www.isharebest.com/lantern.htm)
[你见过的最想笑的，最奇葩的，最逗逼的代码是什么](https://www.zhihu.com/question/35113215)
[按键精灵怎么用？怎么用按键精灵做脚本](https://jingyan.baidu.com/album/ea24bc39b976dfda62b33107.html)
[SHADOWSOCKS VIP帐号](http://trial.ssbit.win/?from=ruanyifeng)
http://www.gioov.com/index.php/355
[ZeroNet](https://github.com/HelloZeroNet/ZeroNet/blob/master/README-zh-cn.md)
[使用 ZeroNet 搭建 P2P 全球网站](https://www.v2ex.com/t/271868)
[PHP 系统架构师成长之路](https://laravel-china.org/articles/4496/the-growth-path-of-php-system-architect)
查看 npm 全局包 ls `npm root -g`
```js
第一步：如果ZeroNet在运行，先将其关掉。（Linux下为ctrl+c）

第二步：执行命令zeronet.py siteCreate。我在执行这一步时提示没有gevent，下载安装后可以顺利执行。（pip install gevent）

第三步：出现Have you secured your private key?后，保存好前两行中的私钥和网址，然后选择yes

至此，第一个网站就建好了

http://127.0.0.1:43110/1ML1BufvU2A1KPeg57LPgXSbX7j9gTUEuC/

欢迎大家访问我的主页：

http://127.0.0.1:43110/1HDJPnnKR47JLM2nTXREeDhAbLVeCmHqF1
http://www.cnblogs.com/Wayou/p/es6_new_features.html

如果想要修改自己的网页，就需要在data目录下找到与自己网址一致的文件夹并对里面的内容做相应修改

最后将自己所作更新进行一下推送

zeronet.py siteSign 1HDJPnnKR47JLM2nTXREeDhAbLVeCmHqF1

然后根据提示输入私钥即可
var a = document.createElement('a');
 a.href = 'http://www.cnblogs.com/wayou/p/';
 console.log(a.host);
document.body.contentEditable='true';
data:text/html, <html contenteditable> 
function autoload($class){
        //参数$class，不用管它，它自己会以``类的名称``作为参数
        //类文件的地址，类文件的格式是$class.class.php
        $classPath = str_replace('\\','/',__DIR__).'/'.$class.'.php';
        //var_dump($classPath);
        if(file_exists($classPath)){
            include_once $classPath;
        }
    }
    //注册自动加载函数，此时autoload这个函数就相当于php的自动寻找类函数__autoload()
    spl_autoload_register('autoload');
    $obj = new test_class;//这个类已经存在同级目录中,我的情况
    $obj->go();
copy($x('//a').map(function(i){return i.href;}).join('\n'))
$x('//a').map(i=> `${i.href}`).join('\n')
$x('//a').map((i)=>{return i.href;}).join('\n')
https://helei112g.github.io/2017/03/12/Payment%EF%BC%9A%E6%94%AF%E4%BB%98%E5%AE%9D%E6%89%8B%E6%9C%BA%E7%BD%91%E7%AB%99%E6%94%AF%E4%BB%98%E6%95%99%E7%A8%8B/
http://www.tenyearsme.cn/blog/laravel-kongzhi-fanzhuan-he-menmian-moshi-gainian
http://www.cnblogs.com/phpper/p/6801678.html
http://larabase.com/collection/5/post/154
http://php.swoole.com/wiki/%E9%A6%96%E9%A1%B5
http://www.tuicool.com/articles/yMvyIrz
http://www.lijiejie.com/
http://2014.54chen.com/blog/archives/
https://github.com/pengzhile/purl
http://www.cnblogs.com/loveyoume/p/6261941.html
https://scriptoj.com/problems/54
https://v.sijiaomao.com/ability?3njfchm5
https://github.com/jaywcjlove/mysql-tutorial
http://gad.qq.com/weekly/detail/115?sessionUserType=BFT.PARAMS.218046.TASKID&ADUIN=2864727074&ADSESSION=1493004690&ADTAG=CLIENT.QQ.5497_.0&ADPUBNO=26621
http://www.cnblogs.com/phpper/default.html?page=2
http://www.cnblogs.com/z1298703836/p/5346728.html
http://laravelacademy.org/post/6587.html
https://aabvip.com/#blog
http://www.tenyearsme.cn/blog/da-jian-bo-ke-bi-bei-wen-ben-kuang-tuo-dong-shang-chuan-tu-pian
https://www.insp.top/article/learn-laravel-container
http://blog.csdn.net/column/details/payment.html
http://www.cnblogs.com/wish123/p/4756669.html
http://blog.csdn.net/gaoxuaiguoyi/article/details/51684743
http://blog.csdn.net/gaoxuaiguoyi/article/details/48739263
https://foofish.net/python-int-mystery.html
http://bayescafe.com/tools/use-postman-to-test-api-automatically.html
http://www.cnblogs.com/yjf512/p/6571941.html
https://lufficc.com/blog/the-core-conception-of-laravel
https://github.com/goosman-lei/ice/blob/master/src/Util/Time.php
http://manjusaka.itscoder.com/2016/11/18/Someone-tell-me-that-you-think-Python-is-simple/?utm_source=tool.lu
http://cuiqingcai.com/3179.html
https://github.com/NyanCat12/CrossinWeekly/blob/master/NovelWordCount.py
https://github.com/twy93007/adult_novel_fenxi/blob/master/get_novel.py
https://github.com/takashiki/cdo/blob/master/src/Cdo.php
http://www.phppan.com/2014/02/php-var-compare/?utm_source=tool.lu
http://www.cnblogs.com/beer/p/5672678.html?utm_source=tool.lu
https://foofish.net/python-heart.html
https://github.com/TIGERB/easy-tips/blob/master/redis/pessmistic-lock.php
https://helei112g.github.io/2016/08/10/%E5%BE%AE%E4%BF%A1%E7%9A%84%E4%B8%89%E7%A7%8D%E6%94%AF%E4%BB%98%E6%96%B9%E5%BC%8F%E6%8E%A5%E5%85%A5%EF%BC%9AAPP%E6%94%AF%E4%BB%98%E3%80%81%E5%85%AC%E4%BC%97%E5%8F%B7%E6%94%AF%E4%BB%98%E3%80%81%E6%89%AB%E7%A0%81%E6%94%AF%E4%BB%98/
https://www.waitalone.cn/upload-forms-threat.html
http://www.lai18.com/cate/117.html
https://github.com/lzjun567/crawler_html2pdf/blob/master/heart/heart.py
https://github.com/zx576/Crossin-practices/blob/master/weibo/ehcarts_js/addr_heatmap.js
http://lanbing510.info/2016/12/07/ProGit.html
http://blog.csdn.net/smstong/article/details/43561607
https://www.waitalone.cn/science-csrf-protection-methods.html
https://github.com/dosgo/ngrok-php/blob/master/natapp.php#L34
http://blog.coderzh.com/2015/09/28/go-tips/
http://www.haomou.net/2014/08/13/2014_web_token/
https://github.com/keepfool/vue-tutorials
http://www.cnblogs.com/luozhihao/p/6014098.html
https://github.com/bhnddowinf/vuejs-learn/blob/master/01.md
http://elickzhao.github.io/2016/10/vue.js%20%E4%B8%AD%E5%9B%BD%E5%A5%BD%E6%95%99%E7%A8%8B/
http://www.cnblogs.com/wzben/p/5930538.html
http://www.godeye.org/course/2
https://weny.name/2017/01/15/teach-zjzs-coding-4/
http://www.bo56.com/%e7%ba%bf%e4%b8%8aphp%e9%97%ae%e9%a2%98%e6%8e%92%e6%9f%a5%e6%80%9d%e8%b7%af%e4%b8%8e%e5%ae%9e%e8%b7%b5/
http://www.bo56.com/%e5%9c%a82016%e7%9a%84phpcon%e5%a4%a7%e4%bc%9a%e4%b8%8a%e7%9a%84%e5%88%86%e4%ba%abppt%e4%b8%8b%e8%bd%bd/
http://www.jianshu.com/p/cc1cb9a5650c#
http://linkagesel.xiaozhong.biz/
http://selfboot.cn/2016/12/28/py_encode_decode/
http://www.w3cvip.com/160.html
http://www.cnblogs.com/wish123/p/5540210.html
https://www.waitalone.cn/security-scripts-game.html
https://www.kancloud.cn/wizardforcel/dive-into-python/128820
https://laravel-china.org/topics/3331
http://river0314.lofter.com/view
http://www.okrd.cn/posts/a-nice-php-deploy-tool-magallanes
http://www.xiaoleilu.com/python-notes-oop
http://www.kancloud.cn/luofei614/programmer_talk_life/107486
http://www.cnblogs.com/keepfool/p/5619070.html
http://es.xiaoleilu.com/010_Intro/10_Installing_ES.html
https://laravel-china.org/topics/2092
http://www.cnblogs.com/Vito2008/p/5018525.html
https://github.com/lovecn/PHPConChina/blob/master/PHPCON2016/PHP%E7%B3%BB%E7%BB%9F%E9%97%AE%E9%A2%98%E6%8E%92%E6%9F%A5%E5%AE%9E%E8%B7%B5--%E4%BF%A1%E6%B5%B7%E9%BE%99%40PHPCon2016.pdf
https://mengkang.net/678.html
https://www.villainhr.com/page/2016/05/18/python%20beginner
http://www.hoohack.me/2015/09/30/php-spider-millons-of-zhihu-user-analyze
https://segmentfault.com/a/1190000004162880
https://github.com/monitor1379/hamaa
https://laravel-china.org/topics/3086
https://github.com/lovecn/StackOverFlowCn/blob/master/302.md
https://segmentfault.com/q/1010000007344409
https://github.com/Unknwon/the-way-to-go_ZH_CN/blob/master/eBook/04.2.md
http://www.jq22.com/jquery-info588
http://www.cnblogs.com/tudou1223/p/4530280.html
https://github.com/astaxie/build-web-application-with-golang/blob/master/zh/01.2.md
http://pagespeed.v2ex.com/t/283114
http://www.w00yun.top/
http://phpshiti.com/paper/1
https://github.com/lovecn/notes-python/blob/master/11.%20useful%20tools/11.03%20json.ipynb
http://www.zhihu.com/question/21395276/answer/20955095
https://github.com/SmoothPhp/CQRS-ES-Framework-Laravel
http://justcode.ikeepstudying.com/page/2/
http://www.codesec.net/view/456710.html
http://v2ex.com/t/295004
http://v2ex.com/t/299183#reply14
http://git.oschina.net/xuxu.gao/Yii-backadmin
https://segmentfault.com/a/1190000005779677
https://phphub.org/topics/23
http://ninghao.net/blog/3502
http://yangguoqi.me/2016/07/23/centos%E4%B8%8B%E6%90%AD%E5%BB%BAlaravel%E8%BF%90%E8%A1%8C%E7%8E%AF%E5%A2%83/
http://www.w3ctech.com/topic/854
https://github.com/6ag/jiansan-laravel
http://hanc.cc/index.php/archives/141/
https://phphub.org/topics/2300
http://mingkuu.com/2016/05/10/jquery%E6%96%87%E4%BB%B6%E4%B8%8A%E4%BC%A0%E6%8F%92%E4%BB%B6jquery-upload-file-%E6%9C%89%E4%B8%8A%E4%BC%A0%E8%BF%9B%E5%BA%A6%E6%9D%A1/
https://segmentfault.com/a/1190000004973921#articleHeader0
https://phphub.org/topics/2274
https://segmentfault.com/a/1190000005783857
https://phphub.org/topics/1954
http://www.cnblogs.com/siqi/archive/2012/11/17/2774982.html
https://segmentfault.com/a/1190000002921506
https://segmentfault.com/a/1190000005125725
https://segmentfault.com/a/1190000005055899
https://segmentfault.com/a/1190000004997982#articleHeader9
http://bbs.ichunqiu.com/thread-4887-1-1.html
http://www.cnblogs.com/Vito2008/p/5044251.html
http://www.hackos.cn/t/171
http://www.ituring.com.cn/article/211367
http://www.cnblogs.com/eczhou/archive/2012/03/08/2385142.html
https://www.zhihu.com/question/20893119
https://segmentfault.com/a/1190000003488038?_ea=3
https://segmentfault.com/a/1190000005778518
https://phphub.org/topics/2093
http://www.cnblogs.com/wangleiblog/p/5936238.html
http://wiki.hostker.com/page/websocket/
http://coolaf.com/article/81.html
http://onwise.xyz/2016/01/15/%e6%95%b0%e6%8d%ae%e7%bb%93%e6%9e%84%e4%b9%8b%e5%9b%9b%e7%a7%8d%e5%9f%ba%e6%9c%ac%e6%8e%92%e5%ba%8f/
http://blog.csdn.net/gaoxuaiguoyi/article/details/47304615
http://www.cnblogs.com/rollenholt/p/5442825.html
https://github.com/helei112g/laravel-swagger/blob/master/README.md
http://www.anigm.com/archives
http://type.so/php/gif-add-watermark-with-imagick.html
```
[重温PHP手册 – 类与对象](http://www.powerxing.com/php-review-oop/)
```js
class A
{
    static $str = 'A';
    function foo()
    {
        if (isset($this)) {
            echo self::$str;    // 静态变量需用 self:: 获取
            echo get_class($this);
        }
    }
}
 
class B
{
    static $str = 'B';
    function bar()
    {
        A::foo();
    }
}
 
$a = new A();
$a->foo();      // 输出 AA
 
$b = new B();
$b->bar();      // 输出 AB $this 指向当前的 object, self 指向当前的 class
//创建 stdClass 实例
$x = new stdClass;
$y = (object) null;        // same as above
$z = (object) 'a';         // creates property 'scalar' = 'a'
$a = (object) array('property1' => 1, 'property2' => 'b');

Class Object{
   public $foo="bar";
};
 
$objectVar = new Object();
$reference =& $objectVar;
$assignment = $objectVar;
 
// $assignment复制了一份$objectVar，但$assignment 的 handle还是指向同一对象，所以下面更改 $objectVar 的值，$assignment表现得与引用相像。
 
$objectVar->foo = "qux";
print_r( $objectVar );  // qux
print_r( $reference );  // qux
print_r( $assignment ); // qux
 
// 如果把$objectVar赋值为NULL，只是将$objectVar的 handle 的数据片段置为NULL，并不影响$assignment。
$objectVar = NULL;
print_r( $objectVar );  // NULL
print_r( $reference );  // NULL
print_r( $assignment ); // qux
namespace SomeNamespace;
 
class SomeClass {
    function SomeFunction() {
        try {
            throw new Exception('Some Error Message');
        } catch (\Exception $e) {//在命令空间中捕获异常时，需指向全局空间：
            var_dump($e->getMessage());
        }
    }
}

echo sprintf("%.1f",substr(sprintf("%.4f", 1.1634), 0, -3)); //不四舍五入保留一位小数
在子类中覆盖父类的 const ，可通过静态方法和 get_called_class() 来正确的访问其值。或者通过 static::constant 也可以达到同样的效果。
class dbObject
{    
    const TABLE_NAME='undefined';
 
    public static function GetAll()
    {
        $c = get_called_class();
        return "SELECT * FROM `".$c::TABLE_NAME."`";
        // return "SELECT * FROM `".static::TABLE_NAME."`"; /* 与上面等价 */
    }    
}
 
class dbPerson extends dbObject
{
    const TABLE_NAME='persons';
}
 
echo dbObject::GetAll();    // SELECT * FROM `undefined`
echo dbPerson::GetAll();    // SELECT * FROM `persons`
如果没有提供任何参数，spl_autoload_register() 将自动注册autoload的默认实现函数spl_autoload()。

void sql_autoload($class_name [, file_extensions]): 默认会将类名转化为小写，再加上.php/.inc，在所有的包含路径中检查是否存在该文件。

所以都无需定义 autoloader，可以直接这样：

spl_autoload_extensions(".php"); // comma-separated list
    spl_autoload_register();
 如果子类中定义了构造函数则不会隐式调用其父类的构造函数。要执行父类的构造函数，需要在子类的构造函数中调用 parent::__construct()   
    定义为 private 的方法只有定义该方法的类能够访问，因此无法在子类中进行重载。 这种情况下应该定义为 protected ：
    
class OtherClass extends MyClass
{
    public static $my_static = 'static var';
 
    public static function doubleColon() {
        echo parent::CONST_VALUE . "\n";
        echo self::$my_static . "\n";
    }
}    
   class A { 
    const C = 'constA'; 
    public function m() { 
        echo $this::C;  // 输出 constB
        echo static::C; // 与上面等价
        echo self::C;   // 输出 constA
    } 
} 
 
class B extends A { 
    const C = 'constB'; 
} 
 
$b = new B(); 
$b->m();  
    检查一个函数是否被静态地调用
    function foo () {
    $isStatic = !(isset($this) && get_class($this) == __CLASS__);
}

优先顺序是当前类中的方法会覆盖 trait 方法，而 trait 方法又覆盖了基类中的方法： 当前类 > trait > 基类。
PHP所提供的”重载”（overloading）是指动态地”创建”类属性和方法。我们是通过魔术方法（magic methods）来实现的。
class MethodTest 
{
    public function __call($name, $arguments) 
    {
        // 注意: $name 的值区分大小写
        echo "Calling object method '$name' "
             . implode(', ', $arguments). "\n";
    }
 
    /**  PHP 5.3.0之后版本  */
    public static function __callStatic($name, $arguments) 
    {
        // 注意: $name 的值区分大小写
        echo "Calling static method '$name' "
             . implode(', ', $arguments). "\n";
    }
}
 
$obj = new MethodTest;
$obj->runTest('in object context'); // Calling object method 'runTest' in object context
 
// PHP 5.3.0之后版本
MethodTest::runTest('in static context'); // Calling static method 'runTest' in static context
“后期绑定”的意思是说，static:: 不再被解析为定义当前方法所在的类，而是在实际运行时计算的。也可以称之为“静态绑定”，因为它可以用于（但不限于）静态方法的调用。
class Model 
{
    protected static $name = 'Model'; 
    public static function find() 
    {
        echo static::$name; 
    }
} 
 
class Product extends Model 
{ 
    protected static $name = 'Product'; 
}
 
Product::find();      // Product
$b = new Product();   
$b->find();           // 等价于 Product::find();
一个对象变量已经不再保存整个对象的值。只是保存一个标识符来访问真正的对象内容。 当对象作为参数传递，作为结果返回，或者赋值给另外一个变量，另外一个变量跟原来的不是引用的关系，只是他们都保存着同一个标识符的拷贝，这个标识符指向同一个对象的真正内容。
class A {
    public $foo = 1;
}  
 
$a = new A;
$b = $a;     // $a ,$b都是同一个标识符的拷贝
             // ($a) = ($b) = <id>
$b->foo = 2;
echo $a->foo;   // 2
echo $b->foo;   // 2
 
 
$c = new A;
$d = &$c;    // $c ,$d是引用
             // ($c,$d) = <id>
$d->foo = 3;
echo $c->foo;   // 2
echo $d->foo;   // 2
 
 
$e = new A;
 
function foo($obj) {
    // ($obj) = ($e) = <id>
    $obj->foo = 4;
}
 函数传参默认传递的是值，也就是复制了一个副本，但对象传递的是引用。 & 将另一变量指向同一内容地址。可以使用 unset() 分离。
 
foo($e);
echo $e->foo;   // 4
$a = "Clark Kent"; // a == Clark Kent
$b = &$a;          // The two will now share the same fate.
$b = "Superman";   // $a == "Superman" too.
 
unset($b);         // $b divorced from $a
$b="Bizarro";      // $a == "Superman" still.
// classa.inc:
 
  class A {
      public $one = 1;
 
      public function show_one() {
          echo $this->one;
      }
  }
 
// page1.php:
 
  include("classa.inc");
 
  $a = new A;
  $s = serialize($a);
  // 把变量$s保存起来以便文件page2.php能够读到
  file_put_contents('store', $s);
 
// page2.php:
 
  // 要正确了解序列化，必须包含下面一个文件，即类的定义
  include("classa.inc");
 
  $s = file_get_contents('store');
  $a = unserialize($s);
 
  // 现在就可以使用对象$a里面的函数 show_one()
  $a->show_one();
  class A {
    public $foo = 1;
}  
 
$a = new A;
$b = $a;        // 复制了一个标识符，指向同一内容。
$a->foo = 2;
$a = NULL;
echo $b->foo;   // 2
 
$c = new A;
$d = &$c;
$c->foo = 2;
$c = NULL;    
echo $d->foo;   // Notice:  Trying to get property of non-object...
```

[FRP内网穿透工具](https://www.diannaobos.com/frp/)
[优化 Laravel 网站打开速度](https://laravel-china.org/articles/5088/optimize-laravel-site-to-open-speed)
apt-get install php70-php-opcache.x86_64 service php70-php-fpm restart
Content-Encoding字段是gzip，表示该网页是经过gzip压缩的。
gzip            on;
gzip_min_length 1000;
gzip_proxied    expired no-cache no-store private auth;
gzip_types      text/plain application/xml;
php artisan optimize
数字转成简 / 繁体汉字的助手函数https://laravel-china.org/articles/5097/write-an-assistant-function-that-turns-a-number-into-a-simplified-traditional-chinese-character
一个基于 Laravel5.4+Vue+Redis 实时聊天的小 demohttps://laravel-china.org/articles/5121/a-small-demo-based-on-laravelvueredis-real-time-chat
python 的requests问题https://segmentfault.com/q/1010000009058023  
```js
UnicodeDecodeError是字符解码失败的原因
py2的用引号声明的字串类型都是str，字串前加一个u声明的才是unicode。网络IO，文件读写中传输的字符都是编码成bytes，即str类型。载入到计算机执行计算，一般都要解码成unicode。py2的str方法实际上是''.encode('ascii'), unicode方法是''.decode('ascii')

In [1]: s = u'你好'

In [2]: str(s)
---------------------------------------------------------------------------
UnicodeEncodeError                        Traceback (most recent call last)
<ipython-input-2-d22ffcdd2ee9> in <module>()
----> 1 str(s)

UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-1: ordinal not in range(128)

In [3]: s.decode('ascii')
---------------------------------------------------------------------------
UnicodeEncodeError                        Traceback (most recent call last)
<ipython-input-3-735804de5fd4> in <module>()
----> 1 s.decode('ascii')

UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-1: ordinal not in range(128)

In [4]: ss = '你好'

In [5]: unicode(ss)
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-5-6325006f91c2> in <module>()
----> 1 unicode(ss)

UnicodeDecodeError: 'ascii' codec can't decode byte 0xe4 in position 0: ordinal not in range(128)

In [6]: ss.decode('ascii')
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-6-b5dcf2f3b46d> in <module>()
----> 1 ss.decode('ascii')

UnicodeDecodeError: 'ascii' codec can't decode byte 0xe4 in position 0: ordinal not in range(128)

In [7]: ss.decode('utf-8')
Out[7]: u'\u4f60\u597d'

In [8]: ss.decode('gbk')
Out[8]: u'\u6d63\u72b2\u30bd'
因为ss = '你好'是非ascii字符，因此以ascii方式解码失败，当解码成utf-8和gbk就成功了。同理s=u'你好'也不能编码成ascii的方式。

你上面的问题，应该是非ascii字符，decode成ascii字符的时候抛错。result_path + p_path 即这两个变量中，有一个变量是包含非ascii字符的str类型：

In [1]: 'hello' + u'world'
Out[1]: u'helloworld'

In [2]: 'hello' + u'世界'
Out[2]: u'hello\u4e16\u754c'

In [3]: '你好' + u'世界'
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-3-8c1827afc847> in <modul
In [1]: 'hello' + u'world'
Out[1]: u'helloworld'

In [2]: 'hello' + u'世界'
Out[2]: u'hello\u4e16\u754c'

In [3]: '你好' + u'世界'
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-3-8c1827afc847> in <module>()
----> 1 '你好' + u'世界'

UnicodeDecodeError: 'ascii' codec can't decode byte 0xe4 in position 0: ordinal not in range(128)

In [4]: '你好' + '世界'
Out[4]: '\xe4\xbd\xa0\xe5\xa5\xbd\xe4\xb8\x96\xe7\x95\x8c'

In [5]: '你好' + '世界 world'
Out[5]: '\xe4\xbd\xa0\xe5\xa5\xbd\xe4\xb8\x96\xe7\x95\x8c world'

In [6]: '你好' + u'世界 world'
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-6-dcdf837ec675> in <module>()
----> 1 '你好' + u'世界 world'

UnicodeDecodeError: 'ascii' codec can't decode byte 0xe4 in position 0: ordinal not in range(128)

In [9]: '你好' + u'world'
---------------------------------------------------------------------------
UnicodeDecodeError                        Traceback (most recent call last)
<ipython-input-9-1be7bc8e74d5> in <module>()
----> 1 '你好' + u'world'

UnicodeDecodeError: 'ascii' codec can't decode byte 0xe4 in position 0: ordinal not in range(128)
'你好'中的中文不是ascii字符，和unicode字符拼接的时候，会解码成unicode再拼接，对于最后的例子，'你好' + u'world'，其实执行的是 '你好'.decode('ascii') + u'world'，所以就报错。

校正的方式很简单，统一字符编码就好。linux的py默认编码是utf-8，win貌似是gbk。不管怎么样，总之都用utf-8吧。

In [10]: '你好'.decode('utf-8') + u'world'
Out[10]: u'\u4f60\u597dworld'
py3中，所有引号声明的字串都是unicode。也就不存在str和unicode这两种类型。其中str编码成bytes类型，bytes解码成字串类型。两种的相互转换的时候，还是会有 UnicodeDecodeError 问题，不要以为用了py3就能万事大吉，解决的问题关键是知道如何编码解码，就能一劳永逸。

>>> s = '中文'
>>> s.encode('utf-8')
b'\xe4\xb8\xad\xe6\x96\x87'
>>> s.encode('ascii')
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-1: ordinal not in range(128)
>>> print(type(s.encode('utf-8')))
<class 'bytes'>
>>> print(type(s))
<class 'str'>
```
MYSQL里类似20-35这种格式的年龄段字段 select * from tbl where left(age,2)<=34 and right(age,2)>=25; 30-55符合25-34的话，可以这样
去重时忽略ID但又必须输出ID如何做? SELECT * FROM TB t1
WHERE t1.ID IN (
    SELECT MAX(t1.id) FROM TB t2 GROUP BY t2.column1, t2.column2
)https://segmentfault.com/q/1010000009007357 SSH端passwd命令改强密码，结束进程，删掉这些文件，重启机器  utf8mb4 的集合大于 utf8的集合

utf8mb4兼容utf8，且比utf8能表示更多的字符。

你从一个小的子集扩展到更大的集合，对原始数据是没有影响的 设置datetime类型的格式，而你的后面估计还有毫秒
show variables like 'datetime_format'; datetime_format=%Y-%m-%d %H:%i:%s
mysql事务，锁和交易问题？https://segmentfault.com/q/1010000009908336
mysql一对多结果归类https://segmentfault.com/q/1010000009967381
mysql建表分组索引问题https://segmentfault.com/q/1010000009940129
mysql连表统计查询https://segmentfault.com/q/1010000009907738
如果是sql报错，这属于应用错误了，一定要捕获异常，将异常记录在日志里

sql的相关操作一定要用try{}catch(){} 千万不能把异常流到上游，并且上游没有做对异常处理的相关操作

批量操作一定要做好事务求时间段之间的交集的最优解https://segmentfault.com/q/1010000009983477
NumPy数组操作的问题https://segmentfault.com/q/1010000009961268
>>> import numpy as np
>>> a = np.array(['000001_2017-03-17.csv', '000001_2017-03-20.csv',
 '000002_2017-03-21.csv', '000002_2017-03-22.csv',
 '000003_2017-03-23.csv', '000004_2017-03-24.csv'])

>>> b = np.unique(np.fromiter(map(lambda x:x.split('_')[0],a),'|S6'))
>>> b
array([b'000001', b'000002', b'000003', b'000004'], 
      dtype='|S6')
还可以这样写：np.frompyfunc
'|S6'是以6个字节存储字符串
ip_regx = re.compile(r'(?:[\d]+\.)+1$') 对于ip的合法性没有做匹配, 仅仅匹配符合x.x.x.1
推荐你一个网站 https://app.stoplight.io/ 你可以直接在这个网站上编辑swagger文件
JSON数据格式化以后，数据顺序发生了改变https://segmentfault.com/q/1010000009998567
你这是一个对象，对象里都是键值对，顺序是随机的。具体的顺序如何是浏览器自己决定的。如果想要有序，建议将此类对象变为如下格式数组：

[
    { .... },
    { .... },
    { .... },
    { .... }
]js操作新开页面会被拦截，如何解决？https://segmentfault.com/q/1010000009975806
递归获取文章所有的评论？？？https://segmentfault.com/q/1010000009987905
https://segmentfault.com/q/1010000009976976 https://segmentfault.com/q/1010000009966175 无限分级函数么？ preg_match('/(.)\1{3,}/u', $str); // 1 = 同一个字4次或以上
使用命名空间,以变量为类名实例化的时候,需要包含完整的命名空间,在实例化的地方直接加命名空间https://segmentfault.com/q/1010000009968340 
use cache\Redis;
$class = Redis::class;//需要完整的命名空间
$instance = new $class($options);
$cls_name = 'Redis';
$class = "\cache\Redis\\".$cls_name;
$instance = new $class($options);
php数组对比unset问题https://segmentfault.com/q/1010000009960818 
两个数组组合https://segmentfault.com/q/1010000009963786
php关于引用计数的疑问？https://segmentfault.com/q/1010000009931445
https://segmentfault.com/q/1010000009920992


[你可能用得上的 PHP 代码段](https://laravel-china.org/articles/4196/talk-about-the-anti-replay-mechanism-of-api)
```js
下面这个请求：

http://a.com?uid=123&timestamp=1480556543&nonce=43f34f33&sign=80b886d71449cb33355d017893720666

这个请求中国的uid是我们真正需要传递的有意义的参数

timestamp，nonce，sign都是为了签名和防重放使用。

timestamp是发送接口的时间，nonce是随机串，sign是对uid，timestamp,nonce(对于一些rest风格的api，我建议也把url放入sign签名)。签名的方法可以是md5({秘要}key1=val1&key2=val2&key3=val3...)
nonce是由客户端根据足够随机的情况生成的，比如 md5(timestamp+rand(0, 1000)); 它就有一个要求，正常情况下，在短时间内（比如60s）连续生成两个相同nonce的情况几乎为0
服务端接到这个请求：
1 先验证sign签名是否合理，证明请求参数没有被中途篡改
2 再验证timestamp是否过期，证明请求是在最近60s被发出的
3 最后验证nonce是否已经有了，证明这个请求不是60s内的重放请求
https://github.com/LingxiTeam/api-authentication
```
[从零开始微信机器人（一）：wxpy简介（登录、消息发送、注册回复）](https://zhuanlan.zhihu.com/p/27566793)
```js
pip install -U wxpy -i "https://pypi.doubanio.com/simple/"
from wxpy import *
import requests
# 回复 my_friend 发送的消息
@bot.register(my_friend)
def reply_my_friend(msg):
    return 'received: {} ({})'.format(msg.text, msg.type)

# 回复发送给自己的消息，可以使用这个方法来进行测试机器人而不影响到他人
@bot.register(bot.self, except_self=False)
def reply_self(msg):
    return 'received: {} ({})'.format(msg.text, msg.type)

# 打印出所有群聊中@自己的文本消息，并自动回复相同内容
# 这条注册消息是我们构建群聊机器人的基础
@bot.register(Group, TEXT)
def print_group_msg(msg):
    if msg.is_at:
        print(msg)
        msg.reply(meg.text)
TULING_TOKEN = 'Your API Key'
bot = Bot()

@bot.register(Group, TEXT) # 这里注册了群聊中的文字消息，测试时可以设置为自己(上篇中提到过)
def group_msg(msg):
    if msg.is_at:
        url_api = 'http://www.tuling123.com/openapi/api'
        data = {
            'key'    : TULING_TOKEN,
            'info'   : msg.text, # 收到消息的文字内容
        }

        s = requests.post(url_api, data=data).json()
        print s # 打印所获得的json查看如何使用

        if s['code'] == 100000:
            print s['text'] # 查看回复消息的内容，可省略
            msg.reply(s['text']) # 回复消息
        
embed()
from tempfile import NamedTemporaryFile
通过request获取图片信息，然后写入到一个临时文件中。

res = requests.get(url, allow_redirects=False)
tmp = NamedTemporaryFile()
tmp.write(res.content)
tmp.flush()
media_id = bot.upload_file(tmp.name)
tmp.close()
msg.reply_image('.gif', media_id=media_id) 上传图片并作为表情发送
echo_supervisord_conf > supervisord.conf
supervisorctl start bot # 开始程序，bot 是刚刚填写的程序名
supervisorctl restart bot # 重启程序
supervisorctl stop bot # 停止程序
```
[numpy和pandas入门](https://zhuanlan.zhihu.com/p/27624814)
[支付宝 电脑网站支付方式 最新的 SDK](https://laravel-china.org/articles/5107/alipay-computer-website-payment-of-the-latest-sdk-finishing-package-need-friends-away)
https://github.com/echobool/alipay-laravel5 
[解锁 Redis 锁的正确姿势](https://laravel-china.org/articles/4211/unlock-the-correct-position-of-the-redis-lock)
```js
if (Redis::setnx("my:lock", 1)) {
    Redis::expire("my:lock", 10);
    // ... do something

    Redis::del("my:lock")
}
if (Redis::set("my:lock", 1, "nx", "ex", 10)) {
    ... do something

    Redis::del("my:lock")
}
$token = rand(1, 100000);

function lock() {
    return Redis::set("my:lock", $token, "nx", "ex", 10);
}

function unlock() {
    $script = `
if redis.call("get",KEYS[1]) == ARGV[1]
then
    return redis.call("del",KEYS[1])
else
    return 0
end    
    `
    return Redis::eval($script, "my:lock", $token)
}

if (lock()) {
    // do something

    unlock();
}
```
[PHP RSA加解密长数据](https://www.juwends.com/tech/php/php-rsa-calc-plus.html)
```js
function rsa_publickey_encrypt($pubk, $data) {
    $pubk = openssl_get_publickey($pubk);
    openssl_public_encrypt($data, $en, $pubk, OPENSSL_PKCS1_PADDING);
    return $en;
}
 
function rsa_privatekey_decrypt($prik, $data) {
    $prik = openssl_get_privatekey($prik);
    openssl_private_decrypt($data, $de, $prik, OPENSSL_PKCS1_PADDING);
    return $de;
}
 
function rsa_encrypt($method, $key, $data, $rsa_bit = 1024) {
    $inputLen = strlen($data);
    $offSet = 0;
    $i = 0;
 
    $maxDecryptBlock = $rsa_bit / 8 - 11;
 
    $en = '';
 
    // 对数据分段加密
    while ($inputLen - $offSet > 0) {
 
        if ($inputLen - $offSet > $maxDecryptBlock) {
            $cache = $method($key, substr($data, $offSet, $maxDecryptBlock));
        } else {
            $cache = $method($key, substr($data, $offSet, $inputLen - $offSet));
        }
 
        $en = $en . $cache;
 
        $i++;
        $offSet = $i * $maxDecryptBlock;
    }
    return $en;
}
 
function rsa_decrypt($method, $key, $data, $rsa_bit = 1024) {
    $inputLen = strlen($data);
    $offSet = 0;
    $i = 0;
 
    $maxDecryptBlock = $rsa_bit / 8;
 
    $de = '';
    $cache = '';
 
    // 对数据分段解密
    while ($inputLen - $offSet > 0) {
 
        if ($inputLen - $offSet > $maxDecryptBlock) {
            $cache = $method($key, substr($data, $offSet, $maxDecryptBlock));
        } else {
            $cache = $method($key, substr($data, $offSet, $inputLen - $offSet));
        }
 
        $de = $de . $cache;
 
        $i = $i + 1;
        $offSet = $i * $maxDecryptBlock;
    }
    return $de;
}
 
$prik = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCtxKMuGIv1ERWmJm4g7a9SfOXymu1pGv1AolFnkjHSa+edVJop
kIg0QDyW7fC14NPZXLT6V765YtZv7EU6OEnrZ+lxrQS2gAbbj0F+OEzO9yd/9cKc
XoRb7EBYiw91Lc49cBcAn0QMO9iYb95qRxEdzxymAs9Te5B1B+sATVa7cQIDAQAB
AoGAd9BRw4LhXcS97KYq4UGB1ZqQ4sq4T/RwEpTZFFTVTYVhWjXvZiFmCMESBe9i
PcYbzJADqWm+9AyWVu3Ofeo57JfpxUJw93mVyUvj6IIs+3ktmY3Db/G0RoGpao3C
NvsIwZDjQBlyHH4/ZuIHfRQ80PZCvylx1jBC9SZ2pLYixJECQQDZPgEms96zkJK1
vuwsf510IaQz79w9Rb1nSG08iBlxNJjbQAhwrNbxXjRz6Afd9RfZLoE01YNhg7ZK
+1YbIagnAkEAzMUP9yeFdQ1Hxmw5f4t9e0RL3Tbyf6A9uUr4V2hPCh/h8BFcaDo4
Nk98svsgJtabMBRo8d1xjHVFj+7O8pnmpwJAV4YnqJQnUWkZ8qdtN7Bim3tCULp+
nSEP4iDIAe9DcNykCRGPVPYN00kFEP2WzdIFPbcCz2qGeC88rpD8bAnvWQJBAJxn
FDe6JxRtrVngRdamq5RgaPWxR2217g8+NQtGL8DS81bTW9p8RX0uH1fxufAQUP5b
SIEcm+Mlm5lBVS414NcCQQC3N4m1L8UmoX+64DkYrrj1s/2IWMUX594qD7hNyRC2
urDAx2ImZbpnfosueHiryTA3G5QV7Y2VoFRvkr/sImTk
-----END RSA PRIVATE KEY-----';
 
$pubk = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCtxKMuGIv1ERWmJm4g7a9SfOXy
mu1pGv1AolFnkjHSa+edVJopkIg0QDyW7fC14NPZXLT6V765YtZv7EU6OEnrZ+lx
rQS2gAbbj0F+OEzO9yd/9cKcXoRb7EBYiw91Lc49cBcAn0QMO9iYb95qRxEdzxym
As9Te5B1B+sATVa7cQIDAQAB
-----END PUBLIC KEY-----';
 
$t1 = 'Welcome to <a href="https://www.juwends.com" target="_blank">
www.juwends.com</a>
        这是个非常好的博客，非常欢迎大家经常来访问，谢谢<br>(&$(@^%)&)&)%<br>
 Juwend\'s的人员构成：如下<br>
                管理员：Juwend & Bigworld<br>
  作者：Juwend & Bigworld & 郭小枫 & 果果<br>
  93572504375lsdah;ldvjg;dzlj8(*^(*%Q*^)(&９３７５０（＆)<br>
  <img alt="" src=" ... 请自行到实例页面查看源码并复制这里的数据 ... " />
  <br>可以看到，上面的图片也可以被加密，取到图片的数据：data:image/png;base64，
  然后可以进行加密，再解密<br>
  这下数据就非常的长了，也可以RSA加解密了~~~~~~';
 
echo "<p><span style=\"color: #ff0000;\">明文：</span><br>" . $t1 . "</p>";
$r = rsa_encrypt('rsa_publickey_encrypt', $pubk, $t1);
echo "<p><span style=\"color: #ff0000;\">密文：</span><br>" . $r . "</p>";
$de = rsa_decrypt('rsa_privatekey_decrypt', $prik, $r);
echo "<p><span style=\"color: #ff0000;\">解密的明文：</span><br>" . $de . "</p>";
echo "<p><span style=\"color: #ff0000;\">明文 " . ($t1 == $de ? '==' : '!=') . " 密文</span></p>";
```

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

