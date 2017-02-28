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
###[php使用curl下载https资源文件](https://segmentfault.com/q/1010000008502236)
```js
<?php
$urls = [
    "https://cdn.pixabay.com/photo/2017/01/28/21/48/lion-2016620__340.jpg 1x, https://cdn.pixabay.com/photo/2017/01/28/21/48/lion-2016620__480.jpg",
    "https://cdn.pixabay.com/photo/2017/02/20/19/29/architecture-2083687__340.jpg 1x, https://cdn.pixabay.com/photo/2017/02/20/19/29/architecture-2083687__480.jpg",
    "https://cdn.pixabay.com/photo/2017/02/06/12/34/reptile-2042906__340.jpg 1x, https://cdn.pixabay.com/photo/2017/02/06/12/34/reptile-2042906__480.jpg"
];

foreach ($urls as $k => $v) {
     if (!empty($v) && preg_match("~^http~i", $v)) {
        $nurl[$k] = trim(str_replace(' ', "%20", $v));
        $curl[$k] = curl_init($nurl[$k]);
        curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl[$k], CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl[$k], CURLOPT_HEADER, 0);
        curl_setopt($curl[$k], CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl[$k], CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl[$k], CURLOPT_SSL_VERIFYHOST, false);        
        if (!isset($handle)) {
           $handle = curl_multi_init();
        }
        curl_multi_add_handle($handle, $curl[$k]);
      }
      continue;
}
$active = null;
do {
   $mrc = @curl_multi_exec($handle, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
   while ($active && $mrc == CURLM_OK) {
       if (curl_multi_select($handle) != -1) {
          do {
             $mrc = curl_multi_exec($handle, $active);
          } while ($mrc == CURLM_CALL_MULTI_PERFORM);
       }
   }

foreach ($curl as $k => $v) {
   var_dump(curl_error($curl[$k]));
}
SSL: CA certificate set, but certificate verification is disabled
curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
改成：

curl_setopt($curl[$k], CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
```
###数组转换
```js
$arr = array("photo" => array(
            "name" => array(
              0 =>  "221.png",
              1 =>  "2211.png",
              2 =>  "545843ec763cf.jpg",
            ),
            "type" => array(
              0 => "image/png",
              1 => "image/png",
              2 => "image/jpeg",
            ),
            "tmp_name" => array(
              0 => "C:\Windows\Temp\php55FF.tmp",
              1 => "C:\Windows\Temp\php5600.tmp",
              2 => "C:\Windows\Temp\php5601.tmp",
            ),
            "error" => array(
              0 => 0,
              1 => 0,
              2 => 0,
            ),
            "size" => array(
              0 => 8353,
              1 => 8194,
              2 => 527569,
            )
          ));

        $result = array();
        foreach (current($arr) as $key => $value) {
          foreach ($value as $k => $val) {
            $result[$k][$key] = $val;
          }
        }
        >>> $result
=> [
       [
           "name"     => "221.png",
           "type"     => "image/png",
           "tmp_name" => "C:\\Windows\\Temp\\php55FF.tmp",
           "error"    => 0,
           "size"     => 8353
       ],
       [
           "name"     => "2211.png",
           "type"     => "image/png",
           "tmp_name" => "C:\\Windows\\Temp\\php5600.tmp",
           "error"    => 0,
           "size"     => 8194
       ],
       [
           "name"     => "545843ec763cf.jpg",
           "type"     => "image/jpeg",
           "tmp_name" => "C:\\Windows\\Temp\\php5601.tmp",
           "error"    => 0,
           "size"     => 527569
       ]
   ]
```
