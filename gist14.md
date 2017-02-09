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
