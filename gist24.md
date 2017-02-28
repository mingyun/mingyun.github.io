###[http code](https://http.cat/)

###[php 一个方法死循环， 其他页面无法访问](https://segmentfault.com/q/1010000008412879)
```js
public function a(){
    for($i = 1; $i<= 1000001; $i++){
        $data[] = ['a' => $i, 'add_time'=> date('Y-m-d H:i:s')];
    }
}
封装成一个方法， 然后访问这个页面的时候，把这个任务丢到redis的队列去中执行啊 。这样就实现了简单的php的异步
```
###[php如何能在1~2s左右判断线上服务器是否开启](https://segmentfault.com/q/1010000008425937)
```js
$ip = '192.168.1.1';
$port = 80;
$timeout = 2;
$sock = @fsockopen($ip, $port, $errno, $errmsg, $timeout);
if($sock) {
   //todo: server is online
}else {
   //todo: server is offline
}
$count = 3; //尝试次数
$flag = false; //状态标记
$ip = '192.168.1.1';
$port = 80;
$timeout = 2;
while($count--) {
    $sock = @fsockopen($ip, $port, $errno, $errmsg, $timeout);
    if($sock) {
        fclose($sock);
        $flag = true;
        break;
    }
}

if ($flag) {
    //你的业务逻辑
} else {
    echo "$errmsg ($errno)<br />" . PHP_EOL;
}
```
###[二维数组拼接问题](https://segmentfault.com/q/1010000008416813)
```js
public function actionTest()
{
    $list = [];
    $arr = [
        ['adminid' => 1, 'group' => '小组1'],
        ['adminid' => 2, 'group' => '小组2'],
        ['adminid' => 2, 'group' => '小组3'],
    ];
    foreach ($arr as $value) {
        if (isset($list[$value['adminid']])) {
            $list[$value['adminid']][] = $value;
            continue;
        }
        $list[$value['adminid']][] = $value;
    }
    unset($arr);
    print_r($list);
}
```
###[查询到小区列表并获取每个小区的出售房源总数和出租房源总数](https://segmentfault.com/q/1010000008410829)
```js
select 
C.id,
C.name,
(
    select count(*) from sale as S where S.cid = C.id
) as sale_count , 
(
    select count(*) from rent as R where R.cid = C.id
) as rent_count 
from community as C;
```
