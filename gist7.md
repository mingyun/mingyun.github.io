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
```
