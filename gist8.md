###[Image()对象实例化获取图片宽高](https://segmentfault.com/q/1010000008138930)
```php
imgitem.forEach(function(item){
    var img = new Image();
    img.src = item.url;
    img.onload = function(){
        var w = img.width, 
            h = img.height;

        console.log(item, img, w, h);

        if(h/w >= 1.5){
                //...
        }
    }
});
```
###[js递归遍历](https://segmentfault.com/q/1010000008139179)
```php
var tree = {
    name: 'root',
    children: [{
        name: 'child1',
        children: [{
            name: 'child1_1',
            children: [{
                name: 'child1_1_1'
            }]
        }]
    }, {
        name: 'child2',
        children: [{
            name: 'child2_1'
        }]
    }, {
        name: 'child3'
    }]
};
function traverseTree(node){
  var child = node.children,
      arr = [];

  arr.push({ name: node.name });
  if(child){
    child.forEach(function(node){
      arr = arr.concat(traverseTree(node));
    });
  }
  return arr;
}
JSON.stringify(traverseTree(tree))
"[{"name":"root"},{"name":"child1"},{"name":"child1_1"},{"name":"child1_1_1"},{"name":"child2"},{"name":"child2_1"},{"name":"child3"}]"
```
###[js字典排序](https://segmentfault.com/q/1010000008141620)
```php
var myObject = {
    code: 'jonyqin_1434008071',
    timestamp: '1404896688',
    card_id: 'pjZ8Yt1XGILfi-FUsewpnnolGgZk',
    api_ticket: 'ojZ8YtyVyr30HheH3CM73y7h4jJE',
    nonce_str: 'jonyqin'
}

var arr=[];

for(var a in myObject){
    arr.push(myObject[a])
}
arr.sort();
console.log(arr);
```
###[配置机器之间免密码登录](https://segmentfault.com/q/1010000008143786)
```php
先在登录机上安装一个sshpass软件，然后执行脚本
cd /etc/yum.repos.d/ 
wget http://download.opensuse.org/repositories/home:Strahlex/CentOS_CentOS-6/home:Strahlex.repo
yum install sshpass
#!/bin/bash
#设置SSHPASS环境变量
export SSHPASS='对端密码'
#ip.txt中每行为一台机器的IP地址
for IP in `cat ip.txt`
do
    sshpass -e ssh-copy-id -o StrictHostKeyChecking=no $IP
done
```
###[分别是取变量的 个位、十位、百位、千位](https://www.v2ex.com/t/47288)
```php
Math.floor(1234 % 10) 个
Math.floor(1234 / 10 %10) 十
Math.floor(1234 / 100 %10) 百
Math.floor(1234 / 1000 % 10) 千 
str_split(""+228)
```
###[处理未定义变量](https://www.v2ex.com/t/196697)
```php
$params = array_merge(['id' => ''], $_GET);

if ($params['id']) 
$_GET += [
'id' => 0,
'page' => 1,
]; array_get($arr, 'foo.bar') 
	function array_get($array, $key, $default = null)
	{
		return Arr::get($array, $key, $default);
	}
```
###[浮点数计算比较](http://www.5idev.com/p-php_float_bcadd_ceil_floor.shtml)
```php
$a = 0.2+0.7;
$b = 0.9;
var_dump($a == $b);
printf("%0.20f", $a);0.89999999999999991118
printf("%0.20f", $b);0.90000000000000002220
var_dump(bcadd(0.2,0.7,1) == 0.9);	// 输出：bool(true) 
echo ceil( round((2.1/0.7),1) );
$a = 0.1;
$b = 0.9;
$c = 1;

printf("%.20f", $a+$b); // 1.00000000000000000000
printf("%.20f", $c-$b); // 0.09999999999999997780
$f = 0.07;
var_dump($f * 100 == 7);//输出false
$f = 0.07;
//输出7.00000000000000088818
echo number_format($f * 100, 20);
$f = 0.07;
var_dump($f * 100 == 7);
//输出0，表示两个数字精度为小数点后3位的时候相等
var_dump(bccomp($f * 100, 7, 3));
```
###[foreach循环后,无法用while+list+each循环输出](https://segmentfault.com/q/1010000008146643)
```php
$prices = array('Tom' => 100, 'len' => 20, 'youuu' => 38);
foreach ($prices as $key => $value) {
    echo "$key - $value <br/> ";
}
while (list($name, $price) = each($prices)) {
    echo "$name - $price <br/>";
} 
使用过一次while (list($name, $price) = each($prices))之后，因为使用了each函数会将数组内部的指针移动到最后，再次遍历的时候没有重置指针位置，就会出现不管怎么遍历都没有结果。

而使用foreach则会在每次遍历的时候自动设置指针到数组顶部，因此可以遍历出结果。

题主可以在使用while (list($name, $price) = each($prices))遍历一次之后，使用reset函数重置数组指针之后就可以了

reset($prices);
while (list($name, $price) = each($prices)) {
    echo "$name - $price \n";
}

```
###[不重启mysql情况修改参数变量](http://www.hdj.me/evil-replication-management)
```php
mysql> show variables like 'log_slave_updates';
+-------------------+-------+
| Variable_name     | Value |
+-------------------+-------+
| log_slave_updates | OFF   |
+-------------------+-------+
1 row in set (0.00 sec)
 
mysql> set global log_slave_updates=1;
ERROR 1238 (HY000): Variable 'log_slave_updates' is a read only variable
mysql> system gdb -p $(pidof mysqld) -ex "set opt_log_slave_updates=1" -batch
mysql> show variables like 'log_slave_updates';
+-------------------+-------+
| Variable_name     | Value |
+-------------------+-------+
| log_slave_updates | ON    |
+-------------------+-------+
1 row in set (0.00 sec)
mysql> show slave status \G
...
     Replicate_Do_DB: test
...
mysql> system gdb -p $(pidof mysqld)
          -ex 'call rpl_filter->add_do_db(strdup("hehehe"))' -batch
mysql> show slave status \G
```
###[查找表中的主键](http://www.hdj.me/category/mysql/page/2)
```php
查看你的数库有多大
SELECT
  table_schema AS 'Db Name',
  Round( Sum( data_length + index_length ) / 1024 / 1024, 3 ) AS 'Db Size (MB)',
  Round( Sum( data_free ) / 1024 / 1024, 3 ) AS 'Free Space (MB)'
FROM information_schema.tables
GROUP BY table_schema ;
SELECT k.column_name
FROM information_schema.table_constraints t
JOIN information_schema.key_column_usage k
USING (constraint_name,table_schema,table_name)
WHERE t.constraint_type='PRIMARY KEY'
  AND t.table_schema='db'
  AND t.table_name=tbl'

```
###[MySql中如何用LIKE来查找带反斜线“\”的记录](http://www.hdj.me/mysql-like-with-backlash)
```php
$sql = ‘SELECT * FROM table WHERE col LIKE \’%a\\%\’ ‘;
SELECT * FROM table WHERE col LIKE ‘%a\\%’;
    $sql = “SELECT * FROM table WHERE col LIKE ‘%a\\\\%’ “;

这样实际上经过转义发给 MySQL 的是

    SELECT * FROM table WHERE col LIKE ‘%a\\%’;
```
###[重置MySQL密码](http://www.hdj.me/how-to-reset-the-root-password)
```php
mysqld_safe --skip-grant-tables --skip-networking &
/etc/init.d/mysqld restart
把用到的SQL语句保存到一个文本文件里（/path/to/init/file）
UPDATE `mysql`.`user` SET `Password`=PASSWORD('yourpassword') WHERE `User`='root' AND `Host`= '127.0.0.1';
FLUSH PRIVILEGES;
shell> /etc/init.d/mysql stop
shell> mysqld_safe --init-file=/path/to/init/file &
```
###[COUNT(DISTINCT `field`)](http://www.hdj.me/mysql-count-distinct-duplicate-entry)
```php
SELECT COUNT(*) FROM (SELECT `field` FROM `table` GROUP BY `field`) a LIMIT 1;
```
###[ucs-2实体编码反转](http://www.hdj.me/php-ucs-2-decode)
```php
echo iconv('ucs-2','utf-8',pack('n','40670'));
echo mb_convert_encoding('&#40670;','utf-8','HTML-ENTITIES');
```
###[若非去空格，请慎用trim](http://www.hdj.me/php-trim-charlist-usage)
```php
trim('www.example.com.tw', 'www.')    期望的结果是example.com.tw，可实际的结果却是example.com.t，tw中的w没了。

问题出现在第二个参数$charlist，它代表的是一个字符列表，而不是一个单纯的字符串，所以tw的w属于www.这个列表中的一员，被一起去掉了
$domain = preg_replace(‘/^www\.|www\.$/’, ”, ‘www.example.com.tw’);
```
###[基于crc32的短网址算法](http://www.hdj.me/php-crc32-shorturl)
```php
function khash($data){
    $map        = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $hash       = bcadd(sprintf('%u',crc32($data)) , 0x100000000);
    $str        = "";
    do {
        $str    = $map[bcmod($hash, 62)] . $str;
        $hash   = bcdiv($hash, 62);
    } while ($hash >= 1);
    return $str;
}
10000个循环内未出现碰撞；
100000个循环仅出现1个碰撞；
$sids       = array();
$repeats    = array();
$result     = array();
for($i=1; $i<=100000; $i++){
    $url    = "http://www.hdj.me/?id=".md5($i);
    $sid    = shorurl($url);
    // echo $sid."\n";
    if(in_array($sid, $sids)){
        $repeats[]  = $sid;
    }
    $sids[]         = $sid;
    $result[$sid][] = $url;
}
foreach((array)$repeats as $sid){
    var_dump($result[$sid]);
}
```
###[微信红包算法](http://www.hdj.me/bonus-algorithm-of-wechat)
```php
// $bonus_total 红包总金额
// $bonus_count 红包个数
// $bonus_type 红包类型 1=拼手气红包 0=普通红包
function randBonus($bonus_total=0, $bonus_count=3, $bonus_type=1){
    $bonus_items    = array(); // 将要瓜分的结果
    $bonus_balance  = $bonus_total; // 每次分完之后的余额
    $bonus_avg      = number_format($bonus_total/$bonus_count, 2); // 平均每个红包多少钱
 
    $i              = 0;
    while($i<$bonus_count){
        if($i<$bonus_count-1){
            $rand           = $bonus_type?(rand(1, $bonus_balance*100-1)/100):$bonus_avg; // 根据红包类型计算当前红包的金额
            $bonus_items[]  = $rand;
            $bonus_balance  -= $rand;
        }else{
            $bonus_items[]  = $bonus_balance; // 最后一个红包直接承包最后所有的金额，保证发出的总金额正确
        }
        $i++;
    }
    return $bonus_items;
}
// 发3个拼手气红包，总金额是100元
$bonus_items    = randBonus(100, 3, 1);
// 查看生成的红包
var_dump($bonus_items);
// 校验总金额是不是正确，看看微信有没有坑我们的钱
var_dump(array_sum($bonus_items));
function sendRandBonus($total=0, $count=3, $type=1){
    if($type==1){
        $input          = range(0.01, $total, 0.01);
        if($count>1){
            $rand_keys  = (array) array_rand($input,  $count-1);
            $last       = 0;
            foreach($rand_keys as $i=>$key){
                $current    = $input[$key]-$last;
                $items[]    = $current;
                $last       = $input[$key];
            }
        }
        $items[]        = $total-array_sum($items);
    }else{
        $avg            = number_format($total/$count, 2);
        $i              = 0;
        while($i<$count){
            $items[]    = $i<$count-1?$avg:($total-array_sum($items));
            $i++;
        }
    }
    return $items;
}
```
###[自定义apk安装包](http://www.hdj.me/custom-apk-by-php-ziparchive)
```php
// 源文件
$apk    = "gb.apk";
// 生成临时文件
$file   = tempnam("tmp", "zip");
// 复制文件
if(false===file_put_contents($file, file_get_contents($apk))){
    exit('copy faild!');
}
// 打开临时文件
$zip    = new ZipArchive();
$zip->open($file); 
// 添加文件
// 由于apk限定只能修改此目录内的文件，否则会报无效apk包
$zip->addFromString('META-INF/extends.json', json_encode(array('author'=>'deeka')));
// 关闭zip
$zip->close();
// 下载文件
header("Content-Type: application/zip"); 
header("Content-Length: " . filesize($file)); 
header("Content-Disposition: attachment; filename=\"{$apk}\""); 
// 输出二进制流
readfile($file);
// 删除临时文件
unlink($file); 
```
