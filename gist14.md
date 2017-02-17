###[修改mysql数据库名称](https://segmentfault.com/q/1010000008298910)
```js
rename database old_db_name to new_db_name报错
把数据库停掉，然后去data目录把文件夹名称改了，然后重启就可以了。
```
###[依次输出时间](https://segmentfault.com/q/1010000008299737)
```js
for($i = 0; $i<10;$i++){
    date_default_timezone_set("Asia/Shanghai");
    echo "event:newDate\n";
    echo 'data:'.date('Y-m-d H-i-s');
    echo "\n\n";
    flush();
    sleep(1);
}
header('Content-Type:text/event-stream');
ob_end_clean() 关闭输出缓存
ob_implicit_flush(1) 开启绝对输出
set_time_limit(0);
ob_end_clean();
ob_implicit_flush(1);
for($i = 0; $i<100;$i++){
    date_default_timezone_set("Asia/Shanghai");
    echo "event:newDate\n";
    echo 'data:'.date('Y-m-d H-i-s');
    echo "\n\n";
    sleep(1);
}
event:newDate
data:2017-02-09 17-21-00

event:newDate
data:2017-02-09 17-21-01

event:newDate
data:2017-02-09 17-21-02

event:newDate
data:2017-02-09 17-21-03

event:newDate
data:2017-02-09 17-21-04

event:newDate
data:2017-02-09 17-21-05

event:newDate
data:2017-02-09 17-21-06

event:newDate
data:2017-02-09 17-21-07

event:newDate
data:2017-02-09 17-21-08

event:newDate
data:2017-02-09 17-21-09
```
###[过滤掉他们的script标签的src属性](https://segmentfault.com/q/1010000008300101)
```js
$context = <<<EOF
<script src="111"> sss</script><script src="222dd"> ggg</script>
<script src="222"> fff</script>
EOF;

echo preg_replace('/\s*src=("[^"]*")|(\'[^\']*\')/', '', $context);
preg_replace('#<script.*?)\s+src=".+?"(.*?>)#','$1$2',$str)
```
###.htaccess: Options not allowed here
```js
vi httpd.conf
<Directory />
    #AllowOverride none
    #Require all denied
    Options All
    AllowOverride All
    Order deny,allow
    Allow from all
</Directory>
```
###[验证id_rsa.pub和id_rsa是否匹配](https://segmentfault.com/q/1010000008302009)
```js
以“-----BEGIN PUBLIC KEY-----”开头 “-----END PUBLIC KEY-----” 结尾
这种格式的需要使用openssl生成

openssl genrsa -out id_rsa 1024
openssl rsa -in id_rsa -pubout -out id_rsa.pub
至于验证id_rsa.pub和id_rsa是否匹配的方法如下：

ssh-keygen  -y -f id_rsa > id_rsa.pub.tobecompared
然后比较id_rsa.pub.tobecompared 与 id_rsa.pub 的内容是否一致
```
###[循环里要慎用bindParam](https://segmentfault.com/q/1010000008305175)
```js
第二个参数是引用，也就是你传递的这那参数，之前的值都会变成最近一次传参的那个值。

你上图里绑定的，自然都会变成123456, last_player会溢出，所以是255了 http://www.laruence.com/2012/10/16/2831.html
function update($sql, $params) {
    // var_dump($params);
    $pdo = new PDO(dsn, user, pass);
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindParam($key + 1, $value);
    }
    return $stmt->execute();
}
foreach里的$value改为&$value
```
###[workerman 或 swoole](https://segmentfault.com/q/1010000008284693)
```js
    //获取定时任务的配置
        $timing_task=api_base::load_config('zip_remove');
        if($timing_task['is_remove']){
            
            \Man\Core\Lib\Task::add($timing_task['time_interval'], function(){
                $zip_remove=api_base::load_sys_class('zpi_file');
                
                $zip_xml_config=api_base::load_config('zip_xml');
                $zip_path=$zip_xml_config['BCP_PATH'][0]['val'];
                $timing_task=api_base::load_config('zip_remove');
                if(!empty($timing_task['delete_zip_time'])){
                    if(date('H:i',time())==$timing_task['delete_zip_time']){
                        $zip_remove=new zpi_file();
                        $zip_remove->remove_zip_file($zip_path);
                    }
                }else{
                    $zip_remove=new zpi_file();
                    $zip_remove->remove_zip_file($zip_path);
                }
                    
            });
        }
```
###[遍历出全部的月份](https://segmentfault.com/q/1010000008303676)
```js
function traverse(start, end) {
    start = start.split('-');
    end = end.split('-');
    var startYear = parseInt(start[0]),
        startMon = parseInt(start[1]),
        endYear = parseInt(end[0]),
        endMon = parseInt(end[1]);

    if(startMon<1 || startMon>12){
      throw new Error('初始月份不正确');
    }
    if(endMon<1 || endMon>12){
      throw new Error('终止月份不正确');
    }

    var result = [];
    var year, mon;

    for (year = startYear; year < endYear;) {
        for(mon = startMon; mon<=12; mon++){
          result.push(year +'-'+ (mon<10?'0'+mon:mon));
          if(mon == 12) year++;
        }
    }
    if(startYear == endYear){
      mon = startMon;
    }else{
      mon = 1;
    }
    for (; mon <= endMon; mon++) {
        result.push(endYear +'-'+ (mon<10?'0'+mon:mon));
    }

    return result;
}
// 转换为时间戳
var startTime = new Date("2017-11").getTime();
var endTime = new Date("2018-03").getTime();
// 存放结果
var arr = []
// 最后的格式转换
var format  = function(time) {
    var date = new Date(time)
    return date.getFullYear() + '-' + (date.getMonth() + 1)
}
// 判断是否为闰年
var isLeapYear = function(year) {  return (year % 4 == 0) && (year % 100 != 0 || year % 400 == 0)  }
// 月份映射 假设不为闰年
var MONTH = {
    '1': 31,
    '2': 28,
    '3': 31,
    '4': 30,
    '5': 31,
    '6': 30,
    '7': 31,
    '8': 31,
    '9': 30,
    '10': 31,
    '11': 30,
    '12': 31
}
arr.push("2017-11")
while (startTime < endTime) {
    // 转换时间格式
    var start = new Date(startTime)
    // 判断是否为闰年的2月份
    if (isLeapYear(start.getFullYear()) && (start.getMonth() + 1 === 2)) {
        startTime = startTime + 29 * 24 * 60 * 60 * 1000
    } else {
        // 其他情况
        startTime = startTime + MONTH[start.getMonth() + 1] * 24 * 60 * 60 * 1000
    }
    arr.push(format(startTime))
}
arr.push("2018-03")
console.log(arr)
```
###[php位运算，windows和linux结果为什么不同](https://segmentfault.com/q/1010000008306292)
```js
function myHash3($str) {

    $hash = 0;
    $s    = md5($str);
    $seed = 5;
    $len  = 32;
    for ($i = 0; $i < $len; $i++) {

        //$hash = ($hash << $seed) + $hash + ord($s{$i});
        $hash = (($hash << $seed) & 0xffffffff) + $hash + ord($s{$i});
    }
    return $hash & 0x7FFFFFFF;
}

$str = "A8A1B1EF-2B31-6572-B364-1E169C943F8E";


echo myHash($str);  // window 85222734
                    // linux 1473101824
```
###[IIFE前面最好加上分号;](https://segmentfault.com/q/1010000008302637)
```js
;(function(){
    var First = document.querySelector('.first'),
        firstBody = document.querySelector('.first_body'),
        Btn = document.querySelector('.btn'),
        btnBody = document.querySelector('.btnbody');
    var myFunc = kim.prototype;
    myFunc.init(First, firstBody);
    myFunc.closeWindow(Btn, btnBody);
})()
// obj <obj>
var a = obj(function () {})()
```
###[获取location跳转地址](https://segmentfault.com/q/1010000008300089)
```js
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_NOBODY,1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$content=curl_exec($curl);
$headerStr=curl_getinfo($curl);
curl_close($curl);
print_r($headerStr);
$url = 'http://c.b1za.com/h.2SXXls?cv=nXP87fAkEx&sm=0d941d';

$html = file_get_contents($url);

preg_match('/var url = \'(.+?)\'/', $html, $urls);
print_r($urls);
if (count($urls) !== 2) {
  die('获取跳转URL失败!');
}

$url = $urls[1];

$html = file_get_contents($url, false, stream_context_create(array ('http' => array ('follow_location' => false))));
http://php.net/manual/zh/reserved.variables.httpresponseheader.php
$http_response_header 数组与 get_headers() 函数类似。当使用HTTP 包装器时，$http_response_header 将会被 HTTP 响应头信息填充。$http_response_header 将被创建于局部作用域中。
print_r($http_response_header);
get_headers($url,1);
Array
(
    [0] => var url = 'http://a.m.taobao.com/i37424802695.htm?price=288&sourceType=item&suid=8be20505-0a16-4863-8c8c-1910b7373a3b&ut_sk=1.U%2B2FehgzDrwDAJm7pzfsyyn8_12278902_1485154518051.Copy.1&un=133fdc823ca48dcfd9378eee1c005948&share_crt_v=1&cpp=1&shareurl=true&spm=a313p.22.352.22903886283&short_name=h.2SXXls'
    [1] => http://a.m.taobao.com/i37424802695.htm?price=288&sourceType=item&suid=8be20505-0a16-4863-8c8c-1910b7373a3b&ut_sk=1.U%2B2FehgzDrwDAJm7pzfsyyn8_12278902_1485154518051.Copy.1&un=133fdc823ca48dcfd9378eee1c005948&share_crt_v=1&cpp=1&shareurl=true&spm=a313p.22.352.22903886283&short_name=h.2SXXls
)
Array
(
    [0] => HTTP/1.1 301 Moved Permanently
    [1] => Server: nginx
    [2] => Date: Fri, 10 Feb 2017 02:52:22 GMT
    [3] => Content-Type: text/html
    [4] => Content-Length: 280
    [5] => Connection: close
    [6] => Location: http://item.taobao.com/item.htm?id=37424802695&price=288&sourceType=item&suid=8be20505-0a16-4863-8c8c-1910b7373a3b&ut_sk=1.U%2B2FehgzDrwDAJm7pzfsyyn8_12278902_1485154518051.Copy.1&un=133fdc823ca48dcfd9378eee1c005948&share_crt_v=1&cpp=1&shareurl=true&spm=a313p.22.352.22903886283&short_name=h.2SXXls
)
preg_match('#Location:(.*)#',$http_response_header[6],$m);
print_r($m);
```
###[php Pdo连接数据库插入一条数据出现两条的bug](https://segmentfault.com/q/1010000008289695)
```js
$dsn    =   sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbName);
$_dbHandle    =   new PDO($dsn, $user, $password, $option);
$sql = "insert into `name` (`age`) values (18)";
$_dbHandle->exec($sql);
//这样插入一次数据,但是数据库会存在两条数据;
由于nginx的 rewrite问题,在location {}模块中,错误的语法导致项目被重复执行了两次,但是由于是同样的执行操作,我们所有的断点调试都无法检出这个问题;
$sql = "insert into `name` (`age`) values (18)";
$stmt = $_dbHandle->prepare($sql);
$stmt->execute();
echo $stmt->rowCount(); //查询中受影响(改动)的行数,插入失败时为0
echo $_dbHandle->lastInsertId(); //插入的自增ID,插入失败时为0
```
###[实现Excel的效果,类似石墨的表格 ](https://segmentfault.com/q/1010000008164727)
```js
从百度图说发现的：handsontable https://handsontable.com/examples.html
基于Node.js实现的EtherCalchttps://ethercalc.org/gn7851og3d5j
```
###[python xlrd模块 怎么获得单元格格式信息](https://segmentfault.com/q/1010000008270267)
```js
import xlrd
from xlutils.filter import process, XLRDReader, XLWTWriter
def copy2(wb):
    w = XLWTWriter()
    process(XLRDReader(wb, 'unknown.xls'), w)
    return w.output[0][1], w.style_list

rb = xlrd.open_workbook('C:\\Users\\sa\\Desktop\\1.xls', formatting_info=True, on_demand=True)
wb, s = copy2(rb)
wbs = wb.get_sheet(0)
rbs = rb.get_sheet(0)
styles = s[rbs.cell_xf_index(0, 0)]
rb.release_resources()  #关闭模板文件

wbs.write(0, 0, 'aa', styles)
wb.save("C:\\Users\\sa\\Desktop\\2.xls")
```
###[mysql中的FIND_IN_SET](https://segmentfault.com/q/1010000008308314)
```js
select * from table_name where find_in_set('5',type_id) or find_in_set('8',type_id) or find_in_set('9',type_id) ;
SELECT * FROM table WHERE CONCAT(',' , type_id , ',') LIKE '%,6,%' OR CONCAT(',' , type_id , ',') LIKE '%,9,%';
```
###[对象不仅有属性，还有方法](https://segmentfault.com/q/1010000008303260)
```js
时下流行的orm或者active records, 不就是一个对象存储一个实体(数据表中的一条记录), 对象可以封装对这些数据的操作，而数组是办不到的。

所以如果是单纯存数据，就用数组，但如果你要定义对这些数据的操作，我更建议使用对象.
```
###[关于.toFixed()的重写](https://segmentfault.com/q/1010000008310032)
```js
Number.prototype.toFixed = function (exponent) {
    return parseInt(this * Math.pow(10, exponent) + (this >= 0 ? 0.5 : -0.5)) / Math.pow(10, exponent);
}
```
###[如果第三者知道客户端的ssh公钥，那他能登录服务器](https://segmentfault.com/q/1010000008309357)
```js
服务端拿着公钥是为了验证客户端用私钥加密的信息，只有拥有私钥的人才能加密出服务端认识的信息，所以第三者知道公钥也没用。http://www.ruanyifeng.com/blog/2011/12/ssh_remote_login.html
你能登陆是因为你有私钥, 只要你私钥不泄漏, 别人拿到公钥也是干瞪眼
所谓"公钥登录"，原理很简单，就是用户将自己的公钥储存在远程主机上。登录的时候，远程主机会向用户发送一段随机字符串，用户用自己的私钥加密后，再发回来。远程主机用事先储存的公钥进行解密，如果成功，就证明用户是可信的，直接允许登录shell，不再要求密码。
```
###[灵感源自QQ浏览器微信调试工具 内网穿透](http://www.yatessss.com/2016/03/29/%E5%86%85%E7%BD%91%E7%A9%BF%E9%80%8F%E2%80%94%E5%A4%96%E7%BD%91%E5%8F%AF%E4%BB%A5%E8%AE%BF%E9%97%AE%E5%88%B0%E6%9C%AC%E5%9C%B0%E9%A1%B5%E9%9D%A2.html)
```js
http://www.ngrok.cc/  https://natapp.cn/ 
以natapp来举例。只要下载相应操作系统的客户端，然后把它解压，cd进入到解压后的目录中，运行命令./ngrok -config ngrok.cfg -subdomain myapp 80。

这里需要注意myapp这个是你要自己定义的域名，80是你要映射到本地的端口，然后访问http://myapp.ngrok.natapp.cn就可以和本地联通了
```
###[微信jssdk withCredentials跨域请求](http://www.yatessss.com/2016/03/30/%E5%BE%AE%E4%BF%A1JSSDK%E5%9D%91%E5%95%8A%E5%9D%91.html)
请求头中就会带上cookie，而后台要接受这个凭据的话，在服务端的响应头必须添加Access-Control-Allow-Credentials: true，并且服务端需指定一个域名（Access-Control-Allow-Origin:www.xxxxxx.com），而不能使用泛型（Access-Control-Allow-Origin: * ）这样我们就可以跨域发送cookie了
记得向后台传递url的时候一定要进行encodeURI编码
var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://www.xxx.com/api');
xhr.withCredentials = true;
xhr.onload = onLoadHandler;
xhr.send();
$.ajax({
 	url: url,
 	type: 'get',
 	data:  data,
 	dataType: 'json',
 	xhrFields: {
   		withCredentials: true
 	},
###[分转换为元](http://www.yatessss.com/2016/02/19/%E5%B7%A5%E4%BD%9C%E6%80%BB%E7%BB%93.html)
```js
//分转换为元
var fen_yuan = function(val){
    //toFixed来确定保留两位小数  因为除以100 所以都会整除
    var str = (val/100).toFixed(2) + '';
    var intSum = str.substring(0,str.indexOf(".")).replace( /\B(?=(?:\d{3})+$)/g, ',' );
    //取到整数部分
    var dot = str.substring(str.length,str.indexOf("."))
    //取到小数部分
    var ret = intSum + dot;
    return ret;
}
```
###[《你不知道的JavaScript》读书笔记——闭包](http://www.yatessss.com/2016/03/29/%E4%BD%A0%E4%B8%8D%E7%9F%A5%E9%81%93%E7%9A%84JavaScript%E8%AF%BB%E4%B9%A6%E7%AC%94%E8%AE%B0%E2%80%94%E2%80%94%E9%97%AD%E5%8C%85.html)
```js
function foo() {
     var a = 2;
     function bar() {
         console.log( a );
     }
     return bar; 
} 
var baz = foo();
baz(); // 2 这就是闭包
简单讲就是foo函数外面的变量baz要用到foo作用域里面的东西，这就叫baz拥有foo的闭包。

再简单讲就是函数调函数。
for (var i=1; i<=5; i++) {
     setTimeout( function timer() {
         console.log( i );
     }, i*1000 );
}
for (var i=1; i<=5; i++) {
     (function() {
         var j = i;
         setTimeout( function timer() {
             console.log( j );
         }, j*1000 );
     })(); 
}
for (var i=1; i<=5; i++) {
     (function(j) {
         setTimeout( function timer() {
             console.log( j );
         }, j*1000 );
     })( i );
}
for (let i=1; i<=5; i++) {
     setTimeout( function timer() {
         console.log( i );
     }, i*1000 );
}
```
###[ip location](https://github.com/nelsonking/ip_location/blob/master/example/sample.php)
```js
require '../src/IpLocation.php';
$ip = '106.2.157.20';
$ipObj = new IpLocation();
$ipMsg = $ipObj->getlocation($ip);
var_export($ipMsg);
/**
 * like
 *
 * array ( 'ip' => '106.2.157.20', 'beginip' => '106.2.128.0', 'endip' => '106.2.159.255', 'country' => '辽宁省沈阳市', 'area' => '辽宁神州云信息技术有限公司')
 */
```
###[图片鉴别](https://github.com/vhall/check_picture/blob/master/src/CheckPicture.php)
```js
include_once 'aliyun-php-sdk-core/Config.php';
use Green\Request\V20160308 as Green;
class CheckPicture
{
    private $client;
    private $request;
    public function __construct($accessKey, $secretKey)
    {
        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $accessKey, $secretKey);
        $this->client = new DefaultAcsClient($iClientProfile);
        // 图片检测
        $this->request = new Green\ImageDetectionRequest ();
    }
    public function check($url)
    {
        //设置参数
        //设置为同步调用
        $this->request->setAsync("false");
        //设置图片链接
        //同步只支持单张图片
        $this->request->setImageUrl(json_encode(array($url)));
        //设置检测的场景
        //porn: 黄图检测
        //ocr:  图文识别
        $this->request->setScene(json_encode(array("porn")));
        try {
            $response = $this->client->getAcsResponse($this->request);
            //print_r($response);
            //返回状态值成功时进行处理
            if ("Success" == $response->Code) {
                $imageResults = $response->ImageResults->ImageResult;
                foreach ($imageResults as $imageResult) {
                    //黄图结果处理
                    $pornResult = $imageResult->PornResult;
                    return [
                        'rate' => $pornResult->Rate,
                        'label' => $pornResult->Label,
                    ];
                }
            }
        } catch (Exception $e) {
            print_r($e);
        }
    }
}
use Illuminate\Contracts\Mail\Mailer;
$imageUrl = 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=476277235,348';
$checkObj = new CheckPicture(env('ALI_ACCESS_KEY'),env('ALI_SECRET_KEY'));
			$result = $checkObj->check($imageUrl);
if($result && isset($result['rate']) && isset($result['label'])) {
				$webinarExist = WebinarGreenCheck::where('webinar_id',$webinarId)->first();

				if (!empty($webinarExist)) {
					// 只记录最坏情况
					if ($webinarExist['rate'] < $result['rate']) {
						$webinarExist->update($result);
					}
				} else {
					$result['webinar_id'] = $webinarId;
					WebinarGreenCheck::create($result);
				}

				if ($result['label'] == 1) {
					$content = '发现黄色视频，活动ID为'.$webinarId.' 图片地址为'.$imageUrl;

					// 发送信息到运维
					// $sms->send($content,'18510248667');
					$sms->send($content,'1860023269');

					$mailer->send('emails.check', ['msg'=>$content], function($message)
					{
						$message->to('ops@test.com');
					});
			}            
```
###[socket.io-php-emitter](https://github.com/rase-/socket.io-php-emitter)
```js
$redis = new \Redis(); // Using the Redis extension provided client
$redis->connect('127.0.0.1', '6379');
$emitter = new SocketIO\Emitter($redis,['key'=>'redis']);#默认为socket.io
$emitter->emit('redis', 'payload str');
$emitter->broadcast->to('redis')->emit('redis', 'such data');
命令行执行 subscribe redis#emitter，接收消息：
1) "message"
2) "redis#emitter"
3) "\x92\x83\xa4type\x02\xa4data\x92\xa3lsp\xabpayload str\xa3nsp\xa1/\x82\xa5ro
oms\x90\xa5flags\x90"
自己实现函数msgpack_pack https://github.com/onlinecity/msgpack-php
发送Socket.io消息.
$ms=new MessageServer();
                $ms->sendMessage($webinar->id, 'cmd', ['type'=>'*publishStart']);
public function sendMessage($room, $event, $obj = [])
    {
        return $this->getSIOEmitter($room)
            ->to($room)
            ->emit($event, $obj);
    }                
```
###[简易socket.io demo](https://segmentfault.com/a/1190000002665449)
```js
mkdir chat
cd chat
npm init 
npm install socket.io express
https://github.com/nswbmw/N-chat/wiki/%E7%AC%AC%E4%B8%80%E7%AB%A0-socket.io-%E7%AE%80%E4%BB%8B%E5%8F%8A%E4%BD%BF%E7%94%A8 
index.js
var express = require('express');
var app = express();
var server  = require('http').createServer(app);
var io = require('socket.io')(server);
var port = process.env.PORT || 3000;

app.use(express.static(__dirname + '/public'));

app.get('/', function (req, res) {
    res.sendFile('index.html');
});

io.on('connection', function (socket) {
    console.log('a user connected');

    socket.on('chat message', function (data) {
        io.emit('reply message',data);
    });
    socket.on('disconnect', function () {
        console.log('a user left');
    })
});
在服务器端区分以下三种情况：

socket.emit() ：向建立该连接的客户端广播
socket.broadcast.emit() ：向除去建立该连接的客户端的所有客户端广播
io.sockets.emit() ：向所有客户端广播，等同于上面两个的和
server.listen(port, function () {
    console.log('server start on port : %d',port);
});

main.js
var socket = io();
客户端（这里是浏览器）通过引入 <script src="/socket.io/socket.io.js"></script> 即可使用 socket.io 。var socket = io.connect('http://localhost'); 与 http://localhost 本地服务器建立连接并赋值给 socket 对象，如果是与其他服务器建立连接则只需将 connect() 参数修改为服务器的地址即可，这里 socket.io 客户端和服务器位于同一个服务器上，那么也可以简写为 var socket = io.connect();
$('button[type=submit]').click(function(){
    socket.emit('chat message', $('#input').val());
    $('#input').val('');
    return false;
});

socket.on('reply message', function (data) {
    $('#message').append($('<li>').text(data));
});

index.html
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>socket.io chatroom</title>
    <link rel="stylesheet" href="style.css" type="text/css">

</head>
<body>

<ul id="message"></ul>
<form action="">
    <input type="text" id="input"><button type="submit">Send</button>
</form>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script src="/socket.io/socket.io.js"></script>
<script src="main.js"></script>
</body>
</html>

```
###[nginx分析日志的工具](https://segmentfault.com/q/1010000008061100)
elk三件套（LogStash、Elasticsearch、Kinaba），比较好用
这三个是一整套的，l是收集log日志的，e是存储的，k是展示的，三种分别各司其职，你可以分开用，例如l收集log日志，然后把日志插入mysql数据库，不用e来存储，然后你自己写展示层， 不用k来展示，都可以的
nginx plus  日志易 http://api1024.com/archives/120 
###[正则表达式匹配](https://segmentfault.com/q/1010000008310749)
```js
'x1'.split('x'); x 做为分隔符, 按它拆分之后, 它前面没有内容, 所以是空, 而后面是1, 所以最终结果是 空字符串 和 1.
```
###[如何查看这个函数是怎么运行的](https://segmentfault.com/q/1010000008314140)
```js
var a = [];
    for (var i = 0; i < 10; i++) {
      a[i] = function () {
        document.write(i);
      };
    }
    a[6](); // 10
    在 source 里有一个 Snippets，新建一个 snippet，然后将这段代码拷贝进去，设置断点并执行就可以了
```
###[用代码撩妹](https://www.v2ex.com/t/339220)
```js
一个男孩给女孩写了一行代码

For(;;) printf(“ I Love You!\n ”);

女孩回了一行代码

For(;;); printf(I Love You Too!\n);
try{living();} 
catch(Exception e){faceTogether();} 
finally{ours.love++;}
for(int i = 0; ; i++); printf("i love you"); 
一个分号的误会， 
令它无任何输出， 
只有永远的漆黑。 
虽字里行间有爱， 
但你永远看不见。
today=$(date +%m%d) 
if [ "${today}" = '0214' ]; then 
today='0215' 
fi
s=socket.socket(socket.AF_INET,socket.SOCK_DGRAM) 
s.bind(('',520)) 
s.listen(10000) 
while True: 
girl,addr=s.accept() 
girl.send("我喜欢你 约吗?") 
resp=girl.recv(1024) 
if not resp: 
girl.close() 
else: 
papapa_with(girl)
$.ajax{ 
url;'/your/heart', 
type:'thinking', 
data:{' i wanna marry with you'}, 
dataType:'really', 
success:function{ 
put_this_in_my_heart_forever(); 
} 
}
man ： 
echo -e "\033[1;31mI ♡ You \e[0m 
female ： 
echo -e "\0x1b[92mholy shit, your right hand is your lovely\e[0m"
for everyday in lifetime: 
loveyou(by_all_means);
$girlfriend=($cool==true&&$rich==true)?true:false;
console.log("love you")
https://github.com/YCF/Christy_gift 
https://gist.github.com/anonymous/9935ff91f0ad50e34261daf469a38be6 
```
###[QQ 最古老版本的那些经典头像](https://www.v2ex.com/t/339523#reply42)
```js
import requests 
import base64 
# https://laoyur.com/qq-18yr-avatars.html  http://pan.baidu.com/s/1b9dGMM 

r = requests.get("http://wa.qq.com/qq18/avatar.json") 
data = r.json() 
date_1 = data['headerImg'] 
i = 0 
for pic_str in date_1: 
imgdata = base64.b64decode(pic_str[22:]) 
filename = str(i) + ".jpg" 
i = i+1 
with open(filename, 'wb') as f: 
f.write(imgdata)
```
###[基于goquery的轻量级爬虫, 图片下载器支持分布式, 可以自定义下载并发量老司机](https://github.com/songtianyi/laosj)
```js
go get -u -v github.com/songtianyi/laosj
go build mzituzp.go
./mzituzp
```
###[简单的视频下载器，支持 youtube 与 B 站](https://www.v2ex.com/t/339114)
```js
https://github.com/rg3/youtube-dl
https://github.com/chriskiehl/Gooey
备用地址： http://pan.baidu.com/s/1kUVLNBh
 chrome.google.com/webstore/detail/video-url-parser/ilcdiicigjaccgipndigcenjieedjohj
 支持 在线离线。 三个强大的服务器（做雷锋，不用谢我） 

https://chrome.google.com/webstore/detail/video-download-helper/ilcdiicigjaccgipndigcenjieedjohj 
官网(在线): https://weibomiaopai.com/ 
```
###[微信一键自动拜年脚本](https://www.v2ex.com/t/336244)
```js
git clone https://github.com/HanSon/vbot.git
cd vbot
composer install
php example/bainian.php
use Hanson\Vbot\Foundation\Vbot;
use Hanson\Vbot\Message\Entity\Text;

$robot = new Vbot([
    'tmp' => __DIR__ . '/./../tmp/',
    'debug' => true
]);

$robot->server->setCustomerHandler(function () {
    $whiteList = ['some remark name...', 'some remark name...'];
    $blackList = ['some remark name...', 'some remark name...'];
    contact()->each(function($item, $username) use ($whiteList, $blackList){
        // 发送白名单https://github.com/HanSon/vbot  https://github.com/vonnyfly/wechat-sendall
        if($item['RemarkName'] && in_array($item['RemarkName'], $whiteList)){
            Text::send($username, $item['RemarkName'] . ' 新年快乐');
        }
        // 黑名单不发送
//        if($item['RemarkName'] && !in_array($item['RemarkName'], $blackList)){
//            Text::send($username, $item['RemarkName'] . ' 新年快乐');
//        }
        // 全部人发送
//        if($item['RemarkName']){
//            Text::send($username, $item['RemarkName'] . ' 新年快乐');
//        }
    });
    exit;
});

$robot->server->run();

URL error 60: SSL certificate problem: unable to get local issuer certificate (see http://curl.haxx.se/libcurl/c/libcurl-errors.html)

下载 CA 证书

你可以从 http://curl.haxx.se/ca/cacert.pem 下载 或者 使用微信官方提供的证书中的 CA 证书 rootca.pem 也是同样的效果。

在 php.ini 中配置 CA 证书
https://easywechat.org/zh-cn/docs/troubleshooting.html
只需要将上面下载好的 CA 证书放置到您的服务器上某个位置，然后修改 php.ini 的 curl.cainfo 为该路径（绝对路径！），重启 php-fpm 服务即可。

curl.cainfo = /path/to/downloaded/cacert.pem


```
###[一个每日自动commit的小脚本](https://metaquant.org/git.html)
```js
import os
import numpy as np
import subprocess
import time
import sys

if len(sys.argv) == 1:
    commitNum = np.random.randint(3,11)
elif len(sys.argv) == 2:
    commitNum = int(sys.argv[1])
else:
    print "the number of optional argument is wrong, must be 0 or 1!"

fileType = ['.txt','.html','.md','.py']
print 'the program will make %s commits today!' %(commitNum)
for i in range(commitNum):
    typeNum = np.random.randint(0,4)
    fileName = np.random.randint(100,1000)
    path = str(fileName)+fileType[typeNum]
    with open(path,'wb') as code:
        code.close()
    print str(fileName)+fileType[typeNum]+' have been created!'
    gitShell = subprocess.Popen('sync.sh',shell=True)
    print 'the new change is being commited and push, please wait a few seconds!'
    if gitShell.wait() == 0:
        os.remove(path)
        print str(fileName)+fileType[typeNum]+' have been deleted!'
print 'all changes have been committed!'
raw_input('press Enter to exit!')
```
###[python函数式编程之高阶函数](https://metaquant.org/python-func.html)
```js
# Classic "FP-style"
transformed = map(tranformation,iterator)
# Comprehension
transformed = (transformation(x) for x in iterator)

# Classic "FP-style"
filtered = filter(predicate,iterator)
# Comprehension
filtered = (x for x in iterator if predicate(x))

from functools import reduce
total = reduce(operator.add,it,0)
#total = sum(it)

>>> add5 = lambda n: n+5
>>> reduce(lambda l,x: l+[add5(x)],range(10),[])
[5,6,7,8,9,10,11,12,13,14]
>>> # simpler: map(add5,range(10)
>>> isOdd = lambda n: n%2
>>> reduce(lambda l,x: l+[x]if isOdd(x) else l, range(10),[])
[1,3,5,7,9]
>>> # simpler: filter(isOdd,range(10))
```
###[Python 中除了 SimpleHTTPServer, json.tool 外，还有哪些内置的模块](https://www.v2ex.com/t/338920)
```js
cat file.json | python -m json.tool
python -m smtpd -n -c DebuggingServer localhost:1025 一句话开启一个 SMTP 服务器测试邮件功能
python -m zipfile 可以压缩解压缩 zip 文件的，但是无法解压带密码的 zip 
python -m pydoc 一个查看 python 文档的模块
python -m timeit '"-".join(str(n) for n in range(100))'
10000 loops, best of 3: 35.8 usec per loop
python3 -m http.server
python -m turtle
python -m antigravity
python -m venv 常用 
python -m pip 这个在 win 下更新 pip 要用到
python -m zipapp 
可以用来打包程序
```
###[chrome console tricks](http://coolshell.cn/articles/17634.html)
1.source-snippet可以保存常用的一些脚本，可以在这写demo
2.console 中， preservelog旁边的top标签可以切换global环境，top是当前页面，然后还有其他插件的页面，调用插件的函数。用来调试serviceworker
console可以用btoa(‘test:test’)来返回Base64 encoding
inspect函数可以让你控制台跳到你需要查看的对象上
copy函数可以把一个变量的值copy到剪贴板上。
 getEventListeners($("selector")) 来查看某个DOM对象上的事件
 Copy as cURL  设置你的网络的访问速度来模拟一个网络很慢的情况。
 document.designMode = "on"直接编辑网页
