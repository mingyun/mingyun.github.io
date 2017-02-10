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
