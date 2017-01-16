###[Python requests SSL: CERTIFICATE_VERIFY_FAILED](https://www.v2ex.com/t/334435)
```php
requests.packages.urllib3.disable_warnings()
requests.get(url,verify=False )
```
###[判断一个值是否存在于一个多维关联数组](https://segmentfault.com/q/1010000008105523)
```php
https://github.com/VikinDev/v-collect
$collect = vcollect([
    ['id'=>1,'product'=>['name'=>['v'=>'i'],'sku'=>15]],
    ['id'=>2,'product'=>['name'=>'bibi','sku'=>10]],
]);

if($collect->where('product.name', 'aa')->toArray() == NULL) {
    echo 'Not in the array';
} else {
    echo 'In the array';
};
var_dump(in_array(2,array_dot($arr)));//true
var_dump(in_array(5,array_dot($arr)));//false
function array_dot($array, $prepend = '')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results = array_merge($results, array_dot($value, $prepend.$key.'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }
```
###[laravel 密码验证](https://segmentfault.com/q/1010000008109472)
```php
public function make($value, array $options = array())
    {
        $cost = isset($options['rounds']) ? $options['rounds'] : $this->rounds;

        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if ($hash === false)
        {
            throw new RuntimeException("Bcrypt hashing not supported.");
        }

        return $hash;
    }
public function check($value, $hashedValue, array $options = array())
    {
        return password_verify($value, $hashedValue);
    }

$password = Input::get('password_from_user'); 
$hash = Hash::make($password );//保存数据库

//对比
$input = 'password_from_user';
if(Hash::check($input, $hash)){
    
}
```
###[将任意内容的字符串唯一均匀地转换为1～n之间的一个整数](https://segmentfault.com/q/1010000008113634)
```php
$str = 'Created by PhpStorm.';

$crc32 = crc32($str);

// 因为crc32求出来的是一个32位整数，可为负数，所以abs一下
// 要多少范围内，就求余多少就行
$result = abs($crc32) % 100;

var_dump($result);//59

```
###[无限节点的树结构插件](https://segmentfault.com/q/1010000008113650)
```php
  var data = [{name: '水果', id: 1, children: [
            {name:'水果1',id:2,children:[
                {name:'水果2',id:3,children:[
                    {name:'水果2',id:3,children:[]}        
                ]}
            ]}
        ]
    }];
    
 function render(data){
         
    data.forEach(function(item,index){
        item.status = false;
        if(item.children){
            render(item.children);
        }
    }); 
    console.log(JSON.stringify(data));
    return data;
 }
 
 render(data);
 JSON.stringify(data)
"[{"name":"水果","id":1,"children":[{"name":"水果1","id":2,"children":[{"name":"水果2","id":3,"children":[{"name":"水果2","id":3,"children":[],"status":false}],"status":false}],"status":false}],"status":false}]"
```
###[mysql 插入1百万条数据](https://segmentfault.com/q/1010000008115511)
```php
mysql对sql长度有限制
要么分批100次每次插入一万，
mysql的配置文件（my.ini）中的max_allowed_packet = 1M 默认1M，修改成10M试试
或者用LOAD指令来加载数据文件。
source test.sql
```
###[moment.js](https://segmentfault.com/q/1010000008111757)
```php
  months: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'),
  monthsShort: '1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月'.split('_'),
  weekdays: '星期日_星期一_星期二_星期三_星期四_星期五_星期六'.split('_'),
  weekdaysShort: '周日_周一_周二_周三_周四_周五_周六'.split('_'),
  weekdaysMin: '日_一_二_三_四_五_六'.split('_'),
  longDateFormat: {
    LT: 'Ah点mm分',
    LTS: 'Ah点m分s秒',
    L: 'YYYY-MM-DD',
    LL: 'YYYY年MMMD日',
    LLL: 'YYYY年MMMD日Ah点mm分',
    LLLL: 'YYYY年MMMD日ddddAh点mm分',
    l: 'YYYY-MM-DD',
    ll: 'YYYY年MMMD日',
    lll: 'YYYY年MMMD日Ah点mm分',
    llll: 'YYYY年MMMD日ddddAh点mm分'
  },
  meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
  meridiemHour: function (h, meridiem) {
    let hour = h;
    if (hour === 12) {
      hour = 0;
    }
    if (meridiem === '凌晨' || meridiem === '早上' ||
      meridiem === '上午') {
      return hour;
    } else if (meridiem === '下午' || meridiem === '晚上') {
      return hour + 12;
    } else {
      // '中午'
      return hour >= 11 ? hour : hour + 12;
    }
  },
  meridiem: function (hour, minute, isLower) {
    const hm = hour * 100 + minute;
    if (hm < 600) {
      return '凌晨';
    } else if (hm < 900) {
      return '早上';
    } else if (hm < 1130) {
      return '上午';
    } else if (hm < 1230) {
      return '中午';
    } else if (hm < 1800) {
      return '下午';
    } else {
      return '晚上';
    }
  },
  calendar: {
    sameDay: function () {
      return this.minutes() === 0 ? '[今天]Ah[点整]' : '[今天]LT';
    },
    nextDay: function () {
      return this.minutes() === 0 ? '[明天]Ah[点整]' : '[明天]LT';
    },
    lastDay: function () {
      return this.minutes() === 0 ? '[昨天]Ah[点整]' : '[昨天]LT';
    },
    nextWeek: function () {
      let startOfWeek, prefix;
      startOfWeek = moment().startOf('week');
      prefix = this.diff(startOfWeek, 'days') >= 7 ? '[下]' : '[本]';
      return this.minutes() === 0 ? prefix + 'dddAh点整' : prefix + 'dddAh点mm';
    },
    lastWeek: function () {
      let startOfWeek, prefix;
      startOfWeek = moment().startOf('week');
      prefix = this.unix() < startOfWeek.unix() ? '[上]' : '[本]';
      return this.minutes() === 0 ? prefix + 'dddAh点整' : prefix + 'dddAh点mm';
    },
    sameElse: 'LL'
  },
  ordinalParse: /\d{1,2}(日|月|周)/,
  ordinal: function (number, period) {
    switch (period) {
      case 'd':
      case 'D':
      case 'DDD':
        return number + '日';
      case 'M':
        return number + '月';
      case 'w':
      case 'W':
        return number + '周';
      default:
        return number;
    }
  },
  relativeTime: {
    future: '%s内',
    past: '%s前',
    s: '几秒',
    m: '1 分钟',
    mm: '%d 分钟',
    h: '1 小时',
    hh: '%d 小时',
    d: '1 天',
    dd: '%d 天',
    M: '1 个月',
    MM: '%d 个月',
    y: '1 年',
    yy: '%d 年'
  },
  week: {
    // GB/T 7408-1994《数据元和交换格式·信息交换·日期和时间表示法》与ISO 8601:1988等效
    dow: 1, // Monday is the first day of the week.
    doy: 4  // The week that contains Jan 4th is the first week of the year.
  }
});
```
###[1天前](http://timeago.org/)
```php
<script src="dist/timeago.js" type="text/javascript"></script>
new timeago().format(new Date());             //=> "just now"
new timeago(null, 'zh_CN').format('2016-09-07')           //=> "4月前"
new timeago().format(1473245023718);          //=> "4 months ago"
```
###[Python 解数学方程](https://zhuanlan.zhihu.com/p/24840337)
```php
sudo pip install sympy
from sympy import *
x, y = symbols('x y')
print solve(x * 2 - 4, x)#[2]
print solve([2 * x - y - 3, 3 * x + y - 7],[x, y])#{y: 1, x: 2}
```
###[判断类型](https://github.com/chunpu/min-is/blob/gh-pages/index.js)
```php
is.wechatApp = function() {
	if ('object' == typeof wx) {
		if (wx && is.fn(wx.createVideoContext)) {
			// wechat js sdk has no createVideoContext
			return true
		}
	}
	return false
}
```
###[php curl](https://github.com/php-curl-class/php-curl-class)
```php
require __DIR__ . '/vendor/autoload.php';
//https://www.v2ex.com/t/333980#;  https://github.com/jmathai/php-multi-curl 
use \Curl\Curl;
$curl = new Curl();
$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
$curl->post('https://www.example.com/login/', array(
    'username' => 'myusername',
    'password' => 'mypassword',
));

$mc = JMathai\PhpMultiCurl\MultiCurl::getInstance();

  // Set up your cURL handle(s).
  $ch = curl_init('http://www.google.com');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);

  // Add your cURL calls and begin non-blocking execution.
  $call = $mc->addCurl($ch);

  // Access response(s) from your cURL calls.
  $code = $call->code;
```
###[避免重复注册同一个事件](https://segmentfault.com/q/1010000008078938)
```php
// 缓存列表
var clientList = {};

// 注册
regist = function(key, fn) {            
    clientList[key] = null;   // 每次都清空，就不需要管他到底有没有注册过
    clientList[key] = fn;    // 重新注册一个
};


// 注册remove事件
regist("remove", function(){console.log("remove function")});
// 执行
clientList["remove"]();
```
###[ajax是异步的](https://segmentfault.com/q/1010000008078306)
```php
var list = [];//大的集合
$.each(that.categoryList, function(index,value){
   $.ajax({
       type: 'get',
       url: that.getHotUrl,
       data:{
           category:value.id,
           pageIndex:1,
           pageSize:2,
           token:token
       },
       dataType: 'json',
       success: function(response){
          if(response.code==200){
              var obj = new Object();  //集合对象
              obj.category_name=value.name;
              obj.items = response.data.items;
              console.log(obj);
              list.push(obj);
          }
      },
      error: function(err) {
           console.log(err);
     }
  });
});
console.log(list);//null

先执行的是console.log(list);
然后在执行console.log(obj);

setTimeout(function(){
    console.log(list);
},100);
```
###[FileAPI上传文件](https://github.com/mailru/FileAPI)
```php
<div>
        <!-- "js-fileapi-wrapper" -- required class -->
        <div class="js-fileapi-wrapper upload-btn">
            <div class="upload-btn__txt">Choose files</div>
            <input id="choose" name="files" type="file" multiple />
        </div>
        <div id="images"><!-- previews --></div>
    </div>

    <script>window.FileAPI = { staticPath: '/js/FileAPI/dist/' };</script>
    <script src="/js/FileAPI/dist/FileAPI.min.js"></script>
    <script>
        var choose = document.getElementById('choose');
        FileAPI.event.on(choose, 'change', function (evt){
            var files = FileAPI.getFiles(evt); // Retrieve file list

            FileAPI.filterFiles(files, function (file, info/**Object*/){
                if( /^image/.test(file.type) ){
                    return  info.width >= 320 && info.height >= 240;
                }
                return  false;
            }, function (files/**Array*/, rejected/**Array*/){
                if( files.length ){
                    // Make preview 100x100
                    FileAPI.each(files, function (file){
                        FileAPI.Image(file).preview(100).get(function (err, img){
                            images.appendChild(img);
                        });
                    });

                    // Uploading Files
                    FileAPI.upload({
                        url: './ctrl.php',
                        files: { images: files },
                        progress: function (evt){ /* ... */ },
                        complete: function (err, xhr){ /* ... */ }
                    });
                }
            });
        });
    </script>
    
    /**
 * 获取要上传的文件大小
 * https://segmentfault.com/q/1010000008080489
 * @param element 需要配合jquery使用，$(上传文件的input)
 * @returns {*}
 */
function fileSize(element) {
    try {
        var fileSize = 0;
        // for IE
        if (window.ActiveXObject) {
            // before making an object of ActiveXObject,
            // please make sure ActiveX is enabled in your IE browser
            var objFSO = new ActiveXObject("Scripting.FileSystemObject");
            var filePath = element.get(0).value;
            var objFile = objFSO.getFile(filePath);
            fileSize = objFile.size; //size in kb
        }
        // for FF, Safari, Opeara and Others
        else {
            fileSize = element.get(0).files[0].size; //size in kb
        }

        //fileSize = fileSize / 1048576; //size in mb

        return fileSize;
    }
    catch (e) {
        return null;
    }
}

```
###[http方式的git push需要密码](https://segmentfault.com/q/1010000008103122)
```php
http协议不会记住也不会知道请求来自于谁，除非使用特殊方法，如cookie。因此对于那些需要授权的服务器，必须输入用户名和密码进行验证才能获取或推送数据，这样服务器才知道你是谁到底能不能获取或推送数据。
http协议的特点恰恰与ssh协议相反，ssh协议靠ssh key来识别你到底有没有权限推送或者获取数据，而ssh key保存在本地，如果你本地没有ssh key的话，当然是无法完成获取或推送数据的操作的。二者刚好形成互补对立的关系。
http协议
优点：省去了本地配置的麻烦，只要有URL和相应的权限便能进行相应的操作
缺点：每次操作都需要频繁验证，除非使用密码缓存机制git config --global credential.helper wincred
ssh协议
优点：推送或获取数据时不需要每次输入密码进行验证
缺点：在使用之前需要进行配置，并生成ssh key

```
###[0.1 + 0.2 = 0.30000000000000004](https://www.zhihu.com/question/20679634)
```php
在有限的存储空间下，绝大部分的十进制小数都不能用二进制浮点数来精确表示。例如，0.1 这个简单的十进制小数就不能用二进制浮点数来表示。
不用浮点数相加，让他们放大为整数相加，再缩小变为浮点数
// 不符合预期：
for(let i=0, j=100; i<j; i++) { console.log(i++ * 0.1); }
// 符合预期:
for(let i=0, j=100; i<j; i++) { console.log(i++ / 10); }
function add(v1, v2) {
  var r1, r2, m;
  try {
    r1 = v1.toString().split(".")[1].length; 
  } catch (e) {
    r1 = 0;
  }
  console.log('r1:', r1); // 获取v1剪切小数点的后的位数 "r1:" 1
  try {
    r2 = v2.toString().split(".")[1].length;
  } catch (e) {
    r2 = 0;
  }
  console.log('r2:', r2); // 获取v2剪切小数点的后的位数 "r2:" 1
  m = Math.pow(10, Math.max(r1, r2)); // 使用 Math.pow 获取倍数，10的r1、r2中取最大值次幂。
  console.log('m:', m); // "m:" 10
  return (v1 * m + v2 * m) / m;
}
var a = 0.1;
var b = 0.2;
console.log(add(a, b)); // 0.3
console.log(a + b); // 0.30000000000000004
```
###[js闭包](https://segmentfault.com/q/1010000008077806)
```js
for(var i=0;i<boxes.length;i++){
    boxes[i].index=i+1;
    boxes[i].onclick=function(){
        alert(this.index)
        }
}
for(var i=0;i<boxes.length;i++){
     (function(i){
                 boxes[i].onclick=function(){
                         alert(i+1);
                     }                    
                 })(i);    
}

```
###[高并发下，每个请求返回 100 条不重复的记录](https://www.v2ex.com/t/332511)
```php
乐观锁，先用 php 从 mysql 读取出没执行过的最后 100 条记录

SELECT * FROM list WHERE State = '0' LIMIT 100

然后一条一条修改 State 改成 1 ，修改成功的，则是有效可用的，否则就是被其他线程抢先修改了

UPDATE list SET State = '1' WHERE Id='1' AND State = '0'
遇到并发数据竞争第一个想到的应该是 redis ，因为 redis 天生单线程无竞争

用悲观锁select * from list where state = 0 for update limit 100; 然后再把 state 更新为 1.
加个字段 pid ， UPDATE 的时候，顺便把这 100 条数据打上进程的标记： 
'UPDATE `list` SET `State` = '1', `pid` = ' . getmypid() . ' WHERE `State` = '0' LIMIT 100;' 
锁定了之后，再： 
'SELECT * FROM `list` WHERE `pid` = ' . getmypid() . ' LIMIT 100' 
来拿到这 100 条数据
```
###[Python2 中的 xrange 与 python3 中的 range](https://www.v2ex.com/t/334489#reply0)
```php
#python2

timeit.timeit('1000000000 in range(0,1000000000,10)', number=1)
5.50357640805305

timeit.timeit('1000000000 in xrange(0,1000000000,10)', number=1)
2.3025200839183526

# python3

import timeit
timeit.timeit('1000000000 in range(0,1000000000,10)', number=1)
4.490355838248402e-06
```###[ Laravel 5.2 处理 Emoji 表情](https://laravel-china.org/topics/3615)
```php
https://github.com/unicodeveloper/laravel-emoji
databases.php 配置文件
没必要修改MySQL配置的，依次检查你的数据库、表、字段的字符集设置即可
 'mysql_utf8mb4' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => env('DB_PREFIX', 'pn_'),
            'strict' => false,
            'engine' => null,
        ],
	class Comment extends Model
{
    protected $connection = 'mysql_utf8mb4';
        protected $table = 'comment';
}
```
###[PHP调用phantomjs](https://laravel-china.org/topics/3590)
```php
composer require "jonnyw/php-phantomjs:4.*"
$client = Client::getInstance();
//这一步非常重要，务必跟服务器的phantomjs文件路径一致
$client->getEngine()->setPath('/usr/local/bin/phantomjs');
$request  = $client->getMessageFactory()->createRequest();
$response = $client->getMessageFactory()->createResponse();

//设置请求方法
$request->setMethod('GET');
//设置请求连接
$request->setUrl($link);
//发送请求获取响应
$client->send($request, $response);

if($response->getStatus() === 200) {
    //输出抓取内容
    echo $response->getContent();
    //获取内容后的处理
}
$client = Client::getInstance();
$client->isLazy(); // 让客户端等待所有资源加载完毕

$request = $client->getMessageFactory()->createRequest();
$request->setTimeout(5000); // 设置超时时间(超过这个时间停止加载并渲染输出画面)
```
###[Supervisor 管理 Laravel 队列进程](https://blog.tanteng.me/2017/01/supervisor-laravel-queue/)
```php
pip install supervisor
echo_supervisord_conf > /etc/supervisord.conf
[include]
files = /etc/supervisor/*.conf
supervisord -c /etc/supervisord.conf
sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl start laravel-worker:*
```
###[定时任务](https://laravel-china.org/topics/3552)
```php
app\Console\Kernerl.php
 protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('test')->insert(['name'=>'test']);
        })->everyMinute();
    }
    * * * * * /usr/bin/php /www/artisan schedule:run >> /dev/null 2>&1
```
###[图片拖动文本框自动上传](https://laravel-china.org/topics/3613)
```php
public function attachment(Request $request)
    {
        $file = $request->file('image');
        // 图片验证
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        // 自动验证
        $validator = \Validator::make($input, $rules);
        // 失败处理
        if ($validator->fails()) return \Response::json([
            'error' => 'Please choose a picture.'
        ]);
        // 移动目录地址
        $destinationPath = 'uploads/';
        // 获取图片文件名
        $filename = \Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        // 移动图片
        $file->move($destinationPath, $filename);

        return \Response::json([
            'filename' => '/' . $destinationPath . $filename
        ]);
    }
```
###[sql数据去重问题](https://segmentfault.com/q/1010000008098772)
```php
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sendid` int(11) NOT NULL DEFAULT '0',
  `receiveid` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `message` (`id`, `sendid`, `receiveid`, `create_time`)
VALUES
    (1, 321, 3, '2017-01-13 10:23:03'),
    (2, 322, 4, '2017-01-13 10:23:11'),
    (3, 123123, 9, '2017-01-13 10:23:25'),
    (4, 0, 0, '2017-01-13 10:22:54'),
    (5, 4, 321, '2017-01-13 10:22:54'),
    (6, 4, 322, '2017-01-13 10:23:17'),
    (7, 9, 12232, '2017-01-13 10:23:30'),
    (8, 0, 0, '2017-01-13 11:29:42');
    SELECT *
FROM   message m3
WHERE  id NOT IN (#查询需要去重的id
           select DISTINCT m1.id
           FROM            message AS m1
           INNER JOIN      message AS m2
           WHERE           m1.id != m2.id #过滤掉自身关联
           AND             ((
                                                           m1.receiveid = m2.sendid
                                           AND             m1.sendid = m2.receiveid)
                           OR              (
                                                           m1.sendid = m2.sendid
                                           AND             m1.receiveid = m2.receiveid ) )
           AND             m1.create_time < m2.create_time #
           GROUP BY        m1.id,
                           m2.id);    
```
###[pthreads 模块无法在 web 模式下运行](https://segmentfault.com/q/1010000008101102)
```php
创建两个配置文件（解决，web模式下添加 pthreads 扩展出错）。

php.ini        # web 模式下会自动加载
php-cli.ini    # php-cli 模式下回自动加载
```
###[php5.6中捕获fatal error(E_ERROR)](https://segmentfault.com/q/1010000008101135)
```php
function handle()
{
    $error = error_get_last();
    var_dump($error);
}

register_shutdown_function('handle');

hahah();
```
###[PHP如何远程下载](https://segmentfault.com/q/1010000008090535)
```php
$text = urlencode("苏醒的秘密.txt");
$url  = "http://dzs.qisuu.com/txt/" . $text;
echo file_get_contents($url);
```
###[解析xml](https://segmentfault.com/q/1010000008094579)
```php
$xml = file_get_contents("php://input");
$xml = new \SimpleXMLElement($xml);
$data = [];
        foreach ($xml as $key => $value) {
            $data[$key] = strval($value);
        }
```
###[php单例模式](https://segmentfault.com/q/1010000008048988)
```php
class test
{
    private $props = [];
    private static $instance;
    private function __construct()
    {
        echo 2;
    }

    public static function getInstance()
    {
        if( !( self::$instance instanceof self ) )
        {
            echo 1;
            self::$instance =new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    public function setProp($key, $val)
    {
        $this->props[$key] = $val;
    }

    public function getProp($key)
    {
        return $this->props[$key];
    }
}
$a = test::getInstance(); //12
$b = test::getInstance(); //没有输出

$a->setProp("name", "zhangsan");
echo $b->getProp("name");   //zhangsan
```
###[php bind](https://segmentfault.com/q/1010000008121858)
```php
function bind(Callable $func)
{
    $args = func_get_args();
    array_shift($args);

    return function() use ($func, $args) {
        return call_user_func_array($func, array_merge($args, func_get_args()));
    };
}

function add($x, $y) {
    return $x + $y;
}

$add0 = bind('add');
var_dump($add0(1, 2));

$add1 = bind('add', 1);
var_dump($add1(2));

$add12 = bind('add', 1, 2);
var_dump($add12());
```
###[PHP无限分类查找](https://segmentfault.com/q/1010000008092063)
```php
function unlimitedForLayer($cate, $child_name = 'child' , $pid_name = 'pid' , $id_name = 'id',$pid = 0){
    $arr = array();
    foreach ($cate as $v){
        if ($v[$pid_name] == $pid){
            $v[$child_name] = unlimitedForLayer($cate,$child_name,$pid_name,$id_name,$v[$id_name]);
            $arr[] = $v;
        }
    }
    return $arr;
}
<?php

$search_type = array(
  array('id'=>1,'name'=>"一级a",'parent_id'=>0),
  array('id'=>2,'name'=>"一级b",'parent_id'=>0),
  array('id'=>3,'name'=>"二级a",'parent_id'=>1),
  array('id'=>4,'name'=>"二级b",'parent_id'=>1),
  array('id'=>5,'name'=>"二级c",'parent_id'=>1),
  array('id'=>6,'name'=>"三级a",'parent_id'=>5),
  array('id'=>7,'name'=>"三级b",'parent_id'=>5),
  array('id'=>8,'name'=>"四级a",'parent_id'=>7),
  array('id'=>9,'name'=>"三级c",'parent_id'=>3),
  array('id'=>10,'name'=>"四级b",'parent_id'=>7),
  array('id'=>11,'name'=>"三级d",'parent_id'=>2),
  array('id'=>12,'name'=>"四级c",'parent_id'=>11),
  array('id'=>13,'name'=>"四级d",'parent_id'=>11),
  array('id'=>14,'name'=>"三级e",'parent_id'=>2),
  array('id'=>15,'name'=>"三级f",'parent_id'=>14)
);

// 相当于 select * from search_type where parent_id = 0 的结果
function select_where_parent_id( $parent_id, $data_source ) {
    $results = array();
    foreach ($data_source as $value) {
        if( $value['parent_id'] == $parent_id ) {
            $results[] = $value;
        }
    }
    return $results;
}

$childs = array();

// &$childs : 结果对象引用
// $parent_id : 父节点id
// $search : 查询对象数据
// $index : 递推深度，方便控制多少层
function get_type(&$childs, $parent_id, $search, $index) {
    $result = select_where_parent_id( $parent_id, $search );
    if( !empty($result) ) {
        $childs[$parent_id] = $result;
        foreach ($result as $value) {
            get_type( $childs, $value['id'], $search, ++$index );
        }
    }
}


get_type($childs, 0, $search_type, 1);
echo json_encode($childs);
```
###[golang版ss服务](https://segmentfault.com/a/1190000008050152)
```php
go get github.com/shadowsocks/shadowsocks-go/cmd/shadowsocks-server

cd shadowsocks/

ls
    bin pkg src

cd bin/

shadowsocks-server -h # 查看帮助

vim config.json # 编写配置文件
    {
        "server":"127.0.0.1",
        "server_port":8388,
        "local_port":1080,
        "password":"xxxx",
        "method": "aes-128-cfb-auth",
        "timeout":600
    }

./shadowsocks-server > log & # 在后台运行ss服务
```
###[唯一ID生成原理](http://blog.daydaygo.top/post/php-uniq-id)
```php
// mysql 自增ID + 事务 + 时间 + 随机数
public function generateTradeNumber()
{
    $tradeTime = date('YmdHi', time());

    $lastTrade     = TradeNumber::findBySql('SELECT * FROM `Trade` ORDER BY id DESC LIMIT 1 FOR UPDATE');
    $lastTradeTime = '';
    if (!empty($lastTrade)) {
        $lastTradeNumber = $lastTrade->getTradeNumber();
        $lastTradeTime   = substr($lastTradeNumber, 0, 12);
        $lastTradeSerial = substr($lastTradeNumber, 12);
        if ($tradeTime == $lastTradeTime) {
            return $lastTradeTime . ($lastTradeSerial >= 99999 ? $lastTradeSerial + 1 : '0' . ($lastTradeSerial + 1));
        }
    }

    $initSerialNumber = rand(10000, 99999);
    return $tradeTime . '0' . $initSerialNumber;
}
```
###[nginx proxy_pass](https://segmentfault.com/a/1190000008061457)
```php
location ^~ /static/ 
{ 
# http://backup/。。。 不带location中的东西
# 只要proxy_pass后面有东西就不带location中的东西
proxy_pass http://www.test.com/; 
}
# location中的匹配路径为/static/。加了/之后proxy_pass 不会加上/static/
# curl http://localhost:3000/static/index.html
# proxy_pass 转发为 http://www.test.com/index.html
```
###[MySQL timestamp 2038](https://laravel-china.org/topics/2473)
```php
$table->dateTime('created_at');
$table->dateTime('published_at');
 public $timestamps = false;
$safe_date = new DateTime('2040-02-01');

$user = new User;
$user->created_at = $safe_date->format('l j F Y H:i');
datetime 更像日历上面的时间和你手表的时间的结合，就是指具体某个时间。
timestamp 更适合来记录时间
timestamp 和 UNIX timestamps显示直观，出问题了便于排错，比好多很长的 int 数字好看多了 timestamp 是自带时区转换的
int 是从1970年开始累加的，如果之前的时间需要用负数支持
```
###[0.1 + 0.2==0.30000000000000004](https://segmentfault.com/q/1010000008122579)
```php
//http://0.30000000000000004.com/
(0.1).toString(2)
"0.0001100110011001100110011001100110011001100110011001101"
9007199254740992 + 1 = 9007199254740992
Math.pow(2,53)
9007199254740992
当结果大于 Math.pow(2, 53) 时，会出现精度丢失，导致最终结果存在偏差，而当结果大于 Number.MAX_VALUE，直接返回 Infinity
(0.1 * 10 + 0.2 * 10) / 10 
=> 0.3
2177.74*100
=> 217773.99999999997
先乘10的整数倍，然后再用toFixed进行四舍五入，这样能保证结果还是准确的http://www.cnblogs.com/lvdabao/p/5690173.html
(2177.74*100).toFixed(0); //217774
<a href="xxx.jpg" download="改名后的文件,jpg" />
算某天再过20天是几月几号new Date(2017, 6, 20+20);
计算2016年7月份有多少天new Date(2016, 7, 0).getDate(); //31
```
###[PHP脚本执行卡住的问题排查记录](http://tabalt.net/blog/php-script-execution-stuck-record/)
```php
ps aux | grep 'php' | grep -v 'php-fpm'
[tabalt@localhost ~] sudo strace -p 13793
Process 13793 attached - interrupt to quit
[tabalt@localhost ~] sudo netstat -tunpa | grep 13793
tcp        0      0 192.168.1.100:38019        192.168.1.101:3306        ESTABLISHED 13793/php
tcp        0      0 192.168.1.100:47107        192.168.1.102:6379        CLOSE_WAIT  13793/php 
echo("start foreach\n");
foreach($types as $type)
{
    echo("foreach $type\n");
    $result[$type] = $this->getSites($type);
}
echo("end foreach\n"); 
//getSites方法 实现拿8个不重复的网址写了2个循环，如果结果中不重复的网址只有7个就会有一个空，少于7个就会有死循环！于是查了下type为2的网址个数，果然是只有6个！
$sites = array();   // 省略从数据库查询的代码
$siteNum = 8;       // 省略从配置读的代码
$urlKeys = $result = array();
for($i = 0; $i < $siteNum; $i++)
{
    do {
        $site = array_shift($sites);
        $urlKey = md5($site['url']);
    } while(array_key_exists($urlKey, $urlKeys));

    $urlKeys[$urlKey] = 1;
    $result[] = $site;
}
return $result;
```
###[PHP中的Traits](https://segmentfault.com/a/1190000002970128)
```php
当方法或属性同名时，当前类中的方法会覆盖 trait的 方法，而 trait 的方法又覆盖了基类中的方法。

trait Drive {
        public function hello() {
            echo "hello drive\n";
        }
        public function driving() {
            echo "driving from drive\n";
        }
    }
    class Person {
        public function hello() {
            echo "hello person\n";
        }
        public function driving() {
            echo "driving from person\n";
        }
    }
    class Student extends Person {
        use Drive;
        public function hello() {
            echo "hello student\n";
        }
    }
    $student = new Student();
    $student->hello();//hello student

    $student->driving();//driving from drive
使用insteadof和as操作符来解决冲突，insteadof是使用某个方法替代另一个，而as是给方法取一个别名
<?php
trait Trait1 {
    public function hello() {
        echo "Trait1::hello\n";
    }
    public function hi() {
        echo "Trait1::hi\n";
    }
}
trait Trait2 {
    public function hello() {
        echo "Trait2::hello\n";
    }
    public function hi() {
        echo "Trait2::hi\n";
    }
}
class Class1 {
    use Trait1, Trait2 {
        Trait2::hello insteadof Trait1;
        Trait1::hi insteadof Trait2;
    }
}
class Class2 {
    use Trait1, Trait2 {
        Trait2::hello insteadof Trait1;
        Trait1::hi insteadof Trait2;
        Trait2::hi as hei;
        Trait1::hello as hehe;
    }
}
$Obj1 = new Class1();
$Obj1->hello();
$Obj1->hi();
echo "\n";
$Obj2 = new Class2();
$Obj2->hello();
$Obj2->hi();
$Obj2->hei();
$Obj2->hehe();

```
###[PHP开发APP微信支付接口](http://www.jianshu.com/p/a5ddd19e01a3#)
```php
/**
 * 生成随机数并返回
 */
private function getNonceStr() {
    $code = "";
    for ($i=0; $i > 10; $i++) { 
        $code .= mt_rand(1000);        //获取随机数
    }
    $nonceStrTemp = md5($code);
    $nonce_str = mb_substr($nonceStrTemp, 5,37);      //MD5加密后截取32位字符
    return $nonce_str;
}

/**
 * 获取参数签名；
 * @param  Array  要传递的参数数组
 * @return String 通过计算得到的签名；
 */
private function getSign($params) {
    ksort($params);        //将参数数组按照参数名ASCII码从小到大排序
    foreach ($params as $key => $item) {
        if (!empty($item)) {         //剔除参数值为空的参数
            $newArr[] = $key.'='.$item;     // 整合新的参数数组
        }
    }
    $stringA = implode("&", $newArr);         //使用 & 符号连接参数
    $stringSignTemp = $stringA."&key=".$this->key;        //拼接key
                                         // key是在商户平台API安全里自己设置的
    $stringSignTemp = MD5($stringSignTemp);       //将字符串进行MD5加密
    $sign = strtoupper($stringSignTemp);      //将所有字符转换为大写
    return $sign;
}
/**
 * 构造函数，初始化成员变量
 * @param  String $appid  商户的应用ID
 * @param  Int $mch_id 商户编号
 * @param String $key 秘钥
 */
// 将构造函数设置为私有，禁止用户实例化该类
private function __construct($appid, $mch_id, $key) {
    if (is_string($appid) && is_string($mch_id)) {
        $this->appid = $appid;
        $this->mch_id = $mch_id;
        $this->key = $key;
    }
}

/**
 * 获取微信支付类实例
 * 该类使用单例模式
 * @return WeEncryption         本类实例
 */
public static function getInstance() {
    if(self::$instance == null) {
        self::$instance = new Self(APPID, MCHID, APP_KEY);
    }
    return self::$instance;
}
public function setNotifyUrl($url) {
    if (is_string($url)) {
        $this->notify_url = $url;
    }
}
/**
 * 拼装请求的数据
 * @return  String 拼装完成的数据
 */
private function setSendData($data) {
    $this->sTpl = "<xml>
                        <appid><![CDATA[%s]]></appid>
                        <body><![CDATA[%s]]></body>
                        <mch_id><![CDATA[%s]]></mch_id>
                        <nonce_str><![CDATA[%s]]></nonce_str>
                        <notify_url><![CDATA[%s]]></notify_url>
                        <out_trade_no><![CDATA[%s]]></out_trade_no>
                        <spbill_create_ip><![CDATA[%s]]></spbill_create_ip>
                        <total_fee><![CDATA[%d]]></total_fee>
                        <trade_type><![CDATA[%s]]></trade_type>
                        <sign><![CDATA[%s]]></sign>
                    </xml>";                          //xml数据模板

    $nonce_str = $this->getNonceStr();        //调用随机字符串生成方法获取随机字符串

    $data['appid'] = $this->appid;
    $data['mch_id'] = $this->mch_id;
    $data['nonce_str'] = $nonce_str;
    $data['notify_url'] = $this->notify_url;
    $data['trade_type'] = $this->trade_type;      //将参与签名的数据保存到数组
    // 注意：以上几个参数是追加到$data中的，$data中应该同时包含开发文档中要求必填的剔除sign以外的所有数据
    $sign = $this->getSign($data);        //获取签名

    $data = sprintf($this->sTpl, $this->appid, $data['body'], $this->mch_id, $nonce_str, $this->notify_url, $data['out_trade_no'], $data['spbill_create_ip'], $data['total_fee'], $this->trade_type, $sign);
    //生成xml数据格式
    return $data;
}
/**
 * 发送下单请求；
 * @param  Curl   $curl 请求资源句柄
 * @return mixed       请求返回数据
 */
public function sendRequest(Curl $curl, $data) {
    $data = $this->setSendData($data);            //获取要发送的数据
    $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
    $curl->setUrl($url);          //设置请求地址
    $content = $curl->execute(true, 'POST', $data);       //执行该请求
    return $content;      //返回请求到的数据
}
/**
     * 将XML数据转换为对象
     * @param $xml  XmlTransfer
     * @return array
     */
    public function xml2Array($xml)
    {
        $obj = null;
        if (is_string($xml) && !empty($xml)) {
            $obj = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        }
        return (Array)$obj;
    }

    /**
     * 将数组转换成XML
     * @param $data
     * @return string
     */
    public function array2XML($data)
    {
        $xmlString = "";
        if (is_array($data) && !empty($data)) {
            $xmlString .= "<xml>";
            foreach ($data as $tag => $node)
            {
                $xmlString .= "<".$tag."><![CDATA[".$node."]]></".$tag.">";
            }
            $xmlString .= "</xml>";
        }
        return $xmlString;
    }
    $obj = $encpt->getNotifyData();     // 接收数据对象
    
    if ($obj) {
    $data = array(
        'appid'                =>    $obj->appid,
        'mch_id'            =>    $obj->mch_id,
        'nonce_str'            =>    $obj->nonce_str,
        'result_code'        =>    $obj->result_code,
        'openid'            =>    $obj->openid,
        'trade_type'        =>    $obj->trade_type,
        'bank_type'            =>    $obj->bank_type,
        'total_fee'            =>    $obj->total_fee,
        'cash_fee'            =>    $obj->cash_fee,
        'transaction_id'    =>    $obj->transaction_id,
        'out_trade_no'        =>    $obj->out_trade_no,
        'time_end'            =>    $obj->time_end
        );
                // 拼装数据进行第三次签名
    $sign = $encpt->getSign($data);        // 获取签名

    /** 将签名得到的sign值和微信传过来的sign值进行比对，如果一致，则证明数据是微信返回的。 */
    if ($sign == $obj->sign) {
        $reply = "<xml>
                    <return_code><![CDATA[SUCCESS]]></return_code>
                    <return_msg><![CDATA[OK]]></return_msg>
                </xml>";
        echo $reply;      // 向微信后台返回结果。
        exit;
    }
}
```
###[过滤微信昵称中的emoji表情](http://www.jianshu.com/p/646cb8a28f7f)
```php
MySQL的utf8编码只支持3个字节的长度，而emoji的编码多为4个字节甚至6个字节的长度
preg_replace("#(\\\ud[0-9a-f]{3})|(\\\ue[0-9a-f]{3})#ie",$nick_name)
```
###[PDOStatement::bindParam的一个陷阱](http://www.jianshu.com/p/90d2ec0e1051)
```php
$dbh = new PDO('mysql:host=localhost;dbname=test', "test");

$query = <<<QUERY
  INSERT INTO `user` (`username`, `password`) VALUES (:username, :password);
QUERY;
$statement = $dbh->prepare($query);

$bind_params = array(':username' => "laruence", ':password' => "weibo");
foreach( $bind_params as $key => $value ){
    $statement->bindParam($key, $value);
}
$statement->execute();

最终执行的SQL是：

INSERT INTO `user` (`username`, `password`) VALUES ("weibo", "weibo");
//第一次循环
$value = $bind_params[":username"];
$statement->bindParam(":username", &$value); //此时, :username是对$value变量的引用

//第二次循环
$value = $bind_params[":password"]; //oops! $value被覆盖成了:password的值
$statement->bindParam(":password", &$value);
1.不要使用foreach, 而是手动赋值
bindParam和bindValue的不同之处, bindParam要求第二个参数是一个引用变量(reference).
<?php
$statement->bindParam(":username", $bind_params[":username"]); //$value是引用变量了
$statement->bindParam(":password", $bind_params[":password"]);
2.使用bindValue代替bindParam, 或者直接在execute中传递整个参数数组.
3.使用foreach和reference(不推荐, 原因参看:微博)

<?php
foreach( $bind_params as $key => &$value ) { //注意这里
    $statement->bindParam($key, $value);
}
```
###[复制对象时的深copy和浅copy](http://www.jianshu.com/p/d16fdaa260aa)
```php
public function __clone() {
    $this->balance = clone $this->balance;
}
```
###[PHP实现搜索附近的人](http://www.jianshu.com/p/d2080a9b87eb)
```php
/**
 * 根据经纬度和半径计算出范围
 * @param string $lat 经度
 * @param String $lng 纬度
 * @param float $radius 半径
 * @return Array 范围数组
 */
private function calcScope($lat, $lng, $radius) {
    $degree = (24901*1609)/360.0;
    $dpmLat = 1/$degree;

    $radiusLat = $dpmLat*$radius;
    $minLat = $lat - $radiusLat;       // 最小经度
    $maxLat = $lat + $radiusLat;       // 最大经度

    $mpdLng = $degree*cos($lat * (PI/180));
    $dpmLng = 1 / $mpdLng;
    $radiusLng = $dpmLng*$radius;
    $minLng = $lng - $radiusLng;      // 最小纬度
    $maxLng = $lng + $radiusLng;      // 最大纬度

    /** 返回范围数组 */
    $scope = array(
        'minLat'    =>  $minLat,
        'maxLat'    =>  $maxLat,
        'minLng'    =>  $minLng,
        'maxLng'    =>  $maxLng
        );
    return $scope;
}
/**
 * 根据经纬度和半径查询在此范围内的所有的电站
 * @param  String $lat    经度
 * @param  String $lng    纬度
 * @param  float $radius 半径
 * @return Array         计算出来的结果
 */
public function searchByLatAndLng($lat, $lng, $radius) {
    $scope = $this->calcScope($lat, $lng, $radius);        // 调用范围计算函数，获取最大最小经纬度
    /** 查询经纬度在 $radius 范围内的电站的详细地址 */
    $sql = 'SELECT `字段` FROM `表名` WHERE `Latitude` < '.$scope['maxLat'].' and `Latitude` > '.$scope['minLat'].' and `Longitude` < '.$scope['maxLng'].' and `Longitude` > '.$scope['minLng'];

    $stmt = self::$db->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);       // 获取查询结果并返回
    return $res;
}
/**
 * 获取两个经纬度之间的距离
 * @param  string $lat1 经一
 * @param  String $lng1 纬一
 * @param  String $lat2 经二
 * @param  String $lng2 纬二
 * @return float  返回两点之间的距离
 */
public function calcDistance($lat1, $lng1, $lat2, $lng2) {
    /** 转换数据类型为 double */
    $lat1 = doubleval($lat1);
    $lng1 = doubleval($lng1);
    $lat2 = doubleval($lat2);
    $lng2 = doubleval($lng2);
    /** 以下算法是 Google 出来的，与大多数经纬度计算工具结果一致 */
    $theta = $lng1 - $lng2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return ($miles * 1.609344);
}
```
