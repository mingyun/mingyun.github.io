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
