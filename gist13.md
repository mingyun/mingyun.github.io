###[服务器不解析PHP](https://segmentfault.com/q/1010000008223801)
1：检查php-fpm服务是否打开
2：如果php-fpm服务确认打开，请看nginx.conf是否正确将php文件交给了php-fpm解析（重点检查端口，ip等等）
3：最佳建议是直接看nginx提供的success/error .log。

图示的问题其实就是nginx正确接受到请求PHP文件了，但是把该文件转发给php-fpm解析的时候出了某些意外。
###[canvas刮开](https://segmentfault.com/q/1010000008268192)
```js
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>http://runjs.cn/detail/uk9ho4ad
		<img src="http://sandbox.runjs.cn/uploads/rs/167/jg8rzhfj/lf.jpg" />
		<canvas id="myCanvas" width="400" height="400"></canvas>
	</body>
</html>
* {
	margin: 0;
}

img {
	position: absolute;
	width:400px;
	height:400px;
}

#myCanvas {
	position: absolute;
	transition: 1s;
}

	var myc = document.getElementById("myCanvas");
		var ctx = myc.getContext("2d");

		ctx.fillStyle = "#ccc";
		ctx.fillRect(0, 0, 400, 400);
		ctx.globalCompositeOperation = "destination-out";

		myc.onmousedown = function(e) {
			document.onmousemove = function(e) {
				var ev = e || window.event;
				var x = ev.clientX;
				var y = ev.clientY;
				
				ctx.beginPath();
				ctx.arc(x,y,30,0,Math.PI*2);
				ctx.fill();

				var obj = ctx.getImageData(0, 0, 400, 400);
				var arr = obj.data;
				var n = 0;
				for(var i = 0; i < arr.length; i += 4) {
					if(arr[i + 3] == 0) {
						n++;
					}
				}
				//大于50%时显示全部
				if(n / (arr.length / 4) > 0.5) {
					myc.style.opacity = 0;
				}
			}

			document.onmouseup = function() {
				document.onmousemove = "";
			}
		}
```
###[Redis 实现无序队列 LPUSH / LPOP](https://www.goodspb.net/%E7%94%A8-redis-%E5%AE%9E%E7%8E%B0%E6%97%A0%E5%BA%8F%E9%98%9F%E5%88%97-lpush-lpop/)
```js
//需要Redis扩展，请自定搞定
$redis = new Redis();
//长连接
$redis->pconnect('127.0.0.1", "6379");
//写入单个信息
$redis->LPush('message', 'a');
//写入多个信息
$redis->LPush('message','b','c','d');
//关闭redis连接
$redis->close();
$redis = new Redis();
//还是长连接
$redis->pconnect('127.0.0.1', 6379);
//循环取出队列中的数据
while(true) {
    try {
        //取出数据成功时
        $data =  $redis->LPOP('message');
        //也可以使用阻塞型的函数：BLPOP
        //$redis->BLPOP('list1', 10) //等到超时时间为10秒
    } catch(Exception $e) {
        //队列中什么都没有，继续运行
    }
}
```
###类微信发红包
```js
$envlopeData = [
            'webinar_id'    => $webinar_id,
            'user_id'       => $user->id,
            'title'         => $title,
            'type'          => $type,
            'money'         => $totalMoney,
            'num'           => $num,
            'nick_name'     => $user->nick_name,
            'role_name'     => 'system',
            'is_pay'        => 0,
        ];
	//红包数据
        $red = WebinarsRedpacket::create($envlopeData);

//红包记录写入到红包集合
        $key    = self::ENVELOPE_RED_PREFIX.$webinar_id;
        $field  = self::ENVELOPE_FIELD_PREFIX.$red->id;
        $redInfo= $red->toArray();
        $redInfo['userName'] = $user->nick_name;
        $redInfo['avatar']   = $user->avatar;
        RedisFacade::hset($key,$field,json_encode($redInfo));每个活动的红包记录
        $arr = [];
        $moneyList = $type == 0 ? self::createRandomRed($money,$num) : self::createAverageRed($money,$num);
        $date = date('Y-m-d H:i:s');
        foreach($moneyList as $val){
            $arr[] = [
                'redpacket_id'  =>$red->id,
                'webinar_id'    =>$webinar_id,
                'money'         =>$val,
                'is_refund'     => 0,
                'created_at'    =>$date,
                'updated_at'    =>$date,
            ];
        }
        $ret = WebinarsRedpacketRecord::insert($arr);
	$order = $this->order->create($order_arr);支付订单后更新对应红包信息updateEnvelopeInfo
$list = WebinarsRedpacketRecord::where('webinar_id',$webinar_id)->where('redpacket_id',$red->id)->get()->toArray();
//设置所以红包记录 红包队列
        foreach($list as $v){
            self::setRedList($red->id,$v['id'],json_encode($v));
        }
	public static function createRandomRed($total,$num,$min = 0.01){
        $list = [];
        for($i= 1;$i< $num;$i++){
            $safe_total = ($total-($num-$i)*$min)/($num-$i);//随机安全上限
            $tmpMin = $min * 100;
            $tmpsafe = $safe_total * 100;
            if($tmpsafe < 1){
                $tmpsafe = $tmpMin;
                $tmpMin  = $tmpsafe;
            }
            $money      = mt_rand($tmpMin,$tmpsafe)/100;
            $total      = $total-$money;
            $list[$i]   = round($money,2);
        }
        $list[$num] = round($total,2);
        //打乱次序 随机红包算法无规律可循
        shuffle($list);
        return $list;
    }
    /**
     * 设置红包列表队列 hash表
     * @param $envelopId 红包id
     * @param $envelopeRecordId 领取分配的红包id
     * @param $result
     */
    public static function setRedList($envelopId,$envelopeRecordId,$result){
        $key = self::ENVELOPE_RED_RECORD_PREFIX.$envelopId;
        $field = self::ENVELOPE_FIELD_RED_RECORD_PREFIX.$envelopeRecordId;
        RedisFacade::hset($key,$field,$result);
        $queueKey = self::ENVELOPE_QUEUE_NAME.$envelopId;
        RedisFacade::lPush($queueKey,$envelopeRecordId);
    }
    /**
     * 验证活动下的红包是否被领取完
     * @param int $webinarId
     * @return bool
     */
    public static function checkRedLength($webinarId =0){
        $redKey = self::CURRENT_REDPACKET.$webinarId;
        $ret    = RedisFacade::get($redKey);
        if(!empty($ret)){
            $redpacket = unserialize($ret);
            //已经支付，并且 红包是有效的
            if(!empty($redpacket['is_pay']) && !empty($redpacket['is_expira'])){
                $length = RedisFacade::llen(self::ENVELOPE_QUEUE_NAME.$redpacket['id']);
                if($length > 0){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 根据活动id , + 红包id  从hash表中拉取红包数据
     * @param $webinarId
     * @param $id
     * @return bool|mixed
     */
    public static function getEnvelopeInfo($webinarId,$id){
        if(!empty($webinarId) && !empty($id)){
            $key = self::ENVELOPE_RED_PREFIX.$webinarId;
            $field  = self::ENVELOPE_FIELD_PREFIX.$id;
            $ret = RedisFacade::hget($key,$field);
            if(!empty($ret)){
                return json_decode($ret,true);
            }
        }
        return false;
    }


    /**
     * 设置红包 支付状态
     * @param int $id
     * @return bool
     */
    public static function updateEnvelopeInfo($id=0){
        $model = WebinarsRedpacket::find($id);
        if(!empty($model)){
            $model->is_pay = 1;
            if($model->save()){
                $ret = self::getEnvelopeInfo($model->webinar_id,$id);
                if(!empty($ret)){
                    $ret['is_pay'] = 1;
                    $key    = self::ENVELOPE_RED_PREFIX.$model->webinar_id;
                    $field  = self::ENVELOPE_FIELD_PREFIX.$id;
                    RedisFacade::hset($key,$field,json_encode($ret));
                    //记录当前红包信息
                    $currenRedpacketKey = self::CURRENT_REDPACKET.$model->webinar_id;
                    $ret['is_expira'] = 1; // 1为过期  0过期
                    RedisFacade::set($currenRedpacketKey,serialize($ret));
                }
                return true;
            }
        }
        return false;
    }
    
    抢红包的时候从队列获取，更新红包的领取人receive_user_id  活动结束后receive_user_id为0的红包更新is_refund为1表示退回
```
###[Python2 / Python3 获取字符中是否包含“中文”](https://www.goodspb.net/python2-python3-%E8%8E%B7%E5%8F%96%E5%AD%97%E7%AC%A6%E4%B8%AD%E6%98%AF%E5%90%A6%E5%8C%85%E5%90%AB%E4%B8%AD%E6%96%87/)
```js
def check_contain_chinese(check_str):
    for ch in check_str.decode('utf-8'):
        if u'\u4e00' <= ch <= u'\u9fff':
            return True
    return False
     def check_contain_chinese(check_str):
    for ch in check_str:
        if u'\u4e00' <= ch <= u'\u9fff':
            return True
    return False
```
###[生成公钥](https://www.goodspb.net/%E6%9C%8D%E5%8A%A1%E5%99%A8%E7%AB%AF%E9%AA%8C%E8%AF%81-apple-game-center-gklocalplayer-%E7%AD%BE%E5%90%8D%EF%BC%88php%E6%8F%8F%E8%BF%B0%EF%BC%89/)
```js
function getPublicKey($url)
    {
        $content = file_get_content($url); //建议使用 curl 来处理，这里为了演示简单直接使用 file_get_content 
        return '-----BEGIN CERTIFICATE-----' . PHP_EOL .
                chunk_split(base64_encode($content), 64, PHP_EOL) .
                '-----END CERTIFICATE-----'. PHP_EOL;
    }
    function unpackTimestamp($timestamp)
    {
        $highMap = 0xffffffff00000000;
        $lowMap = 0x00000000ffffffff;
        $higher = ($timestamp & $highMap) >> 32;
        $lower = $timestamp & $lowMap;
        return pack('NN', $higher, $lower);
    }
```
###[通过 API 获取 实时的货币汇率](https://www.goodspb.net/%E5%A6%82%E4%BD%95%E9%80%9A%E8%BF%87-api-%E8%8E%B7%E5%8F%96-%E5%AE%9E%E6%97%B6%E7%9A%84%E8%B4%A7%E5%B8%81%E6%B1%87%E7%8E%87/)
```js
https://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20yahoo.finance.xchange%20WHERE%20pair%20IN%20(“USDCNY”)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys
{
            query: {
                        count: 1,
                        created: "2016-09-01T11:43:17Z",
                        lang: "zh-CN",
                        results: {
                                    rate: {
                                                    id: "USDCNY",
                                                    Name: "USD/CNY",
                                                    Rate: "6.6795",
                                                    Date: "9/1/2016",
                                                    Time: "5:41am",
                                                    Ask: "6.6808",
                                                    Bid: "6.6795"
                                    }
                        }
            }
}
```
###[Laravel 5/4 中生成二维码](https://www.goodspb.net/%E5%9C%A8-laravel-54-%E4%B8%AD%E7%94%9F%E6%88%90%E4%BA%8C%E7%BB%B4%E7%A0%81/)
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate(Request::url()); !!}
    <p>Scan me to return to the original page.请参考：https://www.simplesoftware.io/docs/simple-qrcode/zh</p>
</div>
###[判断类中是否包含特定的 const 常量](https://www.goodspb.net/php-%E5%88%A4%E6%96%AD%E7%B1%BB%E4%B8%AD%E6%98%AF%E5%90%A6%E5%8C%85%E5%90%AB%E7%89%B9%E5%AE%9A%E7%9A%84-const-%E5%B8%B8%E9%87%8F/)
```js
class A {
       const STATUS_SUCCESS = 1;
             const STATUS_FAILED = 0;
}
$ref = new ReflectionClass('A');
print_r($ref->getConstants());

/* 输出：

Array
(
    ['STATUS_SUCCESS'] => 1
    ['STATUS_FAILED'] => 0
)

*/
class A {
       const STATUS_SUCCESS = 1;
             const STATUS_FAILED = 0;

             public function checkStatus()
             {
                     return defined("self::STATUS_SUCCESS");
             }

}

var_dump((new A)->checkStatus());
```
###[对递归的优化](https://www.goodspb.net/php-%E5%AF%B9%E9%80%92%E5%BD%92%E7%9A%84%E4%BC%98%E5%8C%96/)
```js
function recursion($n)
{
    if ($n == 0) {
        return $n;
    }
    $n--;
    return recursion($n) + $n;
}

echo recursion(11) ;
function recursion2($n, $result = 0)
{
    if ($n == 0) {
        return $result;
    }
    $n--;
    $result += $n;
    return recursion2($n, $result);
}

echo recursion2(253);
function recursion3($n)
{
    function interRecursion($n, $result = 0)
    {
        if ($n == 0) {
            return $result;
        }
        $n--;
        $result += $n;
        return function () use ($n, $result) {
            return interRecursion($n, $result);
        };
    }
    $result = call_user_func('interRecursion', $n);
    while (is_callable($result)) {
        $result = $result();
    }
    return $result;
}

echo recursion3(1255);
```
###更换 npm 淘宝源
npm --registry=https://registry.npm.taobao.org install koa
npm install -g cnpm --registry=https://registry.npm.taobao.org
cnpm install koa  npm --registry=https://registry.npm.taobao.org install koa
###[Redis 实现消息队列 MQ](https://www.goodspb.net/redis-%E5%AE%9E%E7%8E%B0%E6%B6%88%E6%81%AF%E9%98%9F%E5%88%97-mq/)
```js
$redis = new Redis();
$redis->pconnect('127.0.0.1', 6379);
$redis->zAdd('MQ', 1, 'need to do 1');
$redis->zAdd('MQ', 2, 'need to do 2');

while (true) {
        $pid = pcntl_fork();
        if ($pid == -1) {
            //创建子进程失败，不处理
        } else if ($pid == 0) {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            //执行有序查询，取出排序前10进行处理
            $redis->zRevRangeByScore('MQ', '+inf', '-inf', array('withscores'=>false, 'limit'=>array(0,10)));
            exit;
        } else {
            //主进行执行中，等待
            pcntl_wait($status);
        }
}
无序队列：
$redis = new Redis();
$redis->pconnect('127.0.0.1', 6379);
$redis->LPUSH('MQ', 1, 'need to do 1');
$redis->LPUSH('MQ', 2, 'need to do 2');
while (true) {
        $pid = pcntl_fork();
        if ($pid == -1) {
            //创建子进程失败，不处理
        } else if ($pid == 0) {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            //执行出队处理，BLPOP是阻塞的出队方式，其实还可以用LPOP，不过用lPOP就要自行判断数据是否为空了
            $mq = $redis->BLPOP('MQ')
            //do something

        } else {
            //主进行执行中，等待
            pcntl_wait($status);
        }
}
```
###[PHP session 跨域解决方法](https://www.goodspb.net/php-session-%E8%B7%A8%E5%9F%9F%E8%A7%A3%E5%86%B3%E6%96%B9%E6%B3%95/)
```js
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', '.goodspb.net');
ini_set('session.cookie_lifetime', '1800');
php -i | grep php.ini
session.cookie_path = /
session.cookie_domain = .goodspb.net
session.cookie_lifetime = 1800
session_start();
$_SESSION['uid'] = 1;

//获取session_id
$session_id = session_id();

//然后保存起来，例如用mysql / cookie / redis 等
然后到跨域处保存设置session_id

<?php

//从mysql / cookie /redis 获取
$session_id = '1234567890';
session_id($session_id);
session_start();
```
###[CURL 发起POST , GET , DELETE , PUT 请求](https://www.goodspb.net/php-curl-%E5%8F%91%E8%B5%B7post-get-delete-put-%E8%AF%B7%E6%B1%82/)
```js
  function api_request($URL,$type,$params,$headers){
        $ch = curl_init(); //初始化curl，还应该判断一下是否包含curl这个函数
        $timeout = 5; //设置过期时间
        curl_setopt($ch, CURLOPT_URL, $URL); //发贴地址
        if($headers!=""){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //以文件流的形式返回
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        switch ($type){
            case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
            case "POST": curl_setopt($ch, CURLOPT_POST,true); 
                     curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
                     curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
            case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
                      curl_setopt($ch, CURLOPT_POSTFIELDS,$params);break;
        }
        $file_contents = curl_exec($ch);//获得返回值
        return $file_contents;
        curl_close($ch);
    }
```
###[mysql商家商品获取](https://segmentfault.com/q/1010000008271106)
```js
SELECT seller
FROM (SELECT
        seller,
        count(product) AS product_count
      FROM seller_product
      WHERE product IN (001, 002)
      GROUP BY seller) AS seller_list
WHERE product_count = 2
```
###[两个列表的“笛卡尔乘积” ](http://www.iteye.com/topic/106747)
```js
>>> functools.reduce(lambda x,y: x+y**2,range(1,3))
5
>>> [(x , y) for x in range(4) for y in [3,1,7,8]]
[(0, 3), (0, 1), (0, 7), (0, 8), (1, 3), (1, 1), (1, 7), (1, 8), (2, 3), (2, 1),
 (2, 7), (2, 8), (3, 3), (3, 1), (3, 7), (3, 8)]
>>>
26个英语字母，分别用1～26标识，就是一个单词所有标识的和http://www.iteye.com/topic/750294
import types  
reduce(lambda x,y:(x if type(x)==types.IntType else ord(x)-96)+ord(y)-96,[x for x in 'attitude'])  
sum([ord(i)-96 for i in list('attitude')]) 
sum( [ ord(ch) - 96 for ch in 'attitude' ] )  

```
###[ 检测时间是否正确](http://blog.csdn.net/u010265663/article/details/50493781)
```js
function check_Datetime($str, $format = "Y-m-d H:i:s"){
    $time = strtotime($str);  //转换为时间戳
    $checkstr = date($format, $time); //在转换为时间格式
    if($str == $checkstr){
        return 1;
    }else{
        return 2;
    }
}
```
###[python教程copy & deepcopy 浅复制 & 深复制](https://morvanzhou.github.io/tutorials/python-basic/basic/13-04-copy/)
```js
>>> import copy
>>> a=[1,2,3]
>>> b=a
>>> id(a)
"""
4382960392
"""
>>> id(b)
"""
4382960392
"""
>>> id(a)==id(b)    #附值后，两者的id相同，为true。
True
>>> b[0]=222222  #此时，改变b的第一个值，也会导致a值改变。
>>> print(a,b)
[222222, 2, 3] [222222, 2, 3] #a,b值同时改变
>>> import copy
>>> a=[1,2,3]
>>> c=copy.copy(a)  #拷贝了a的外围对象本身,
>>> id(c)
4383658568
>>> print(id(a)==id(c))  #id 改变 为false
False
>>> c[1]=22222   #此时，我去改变c的第二个值时，a不会被改变。
>>> print(a,c)
[1, 2, 3] [1, 22222, 3] #a值不变,c的第二个值变了，这就是copy和‘==’的不同
>>> a=[1,2,[3,4]]  #第三个值为列表[3,4],即内部元素
>>> d=copy.copy(a) #浅拷贝a中的[3，4]内部元素的引用，非内部元素对象的本身
>>> id(a)==id(d)
False
>>> id(a[2])==id(d[2])
True
>>> a[2][0]=3333  #改变a中内部原属列表中的第一个值
>>> d             #这时d中的列表元素也会被改变
[1, 2, [3333, 4]]


#copy.deepcopy()

>>> e=copy.deepcopy(a) #e为深拷贝了a
>>> a[2][0]=333 #改变a中内部元素列表第一个的值
>>> e
[1, 2, [3333, 4]] #因为时深拷贝，这时e中内部元素[]列表的值不会因为a中的值改变而改变
```
###[nodejs npm webpack Cannot find module ‘webpack/lib/node/NodeTemplatePlugin](http://www.fddcn.cn/cannot-find-module-webpacklibnodenodetemplateplugin.html)
```js
当你在windows系统的dos下执行：webpack命令时在dos下出现 “Cannot find module ‘webpack/lib/node/NodeTemplatePlugin”；
解决方法是：配置环境变量，指定webpack/lib/node/NodeTemplatePlugin的准确路径；
1.右键我的电脑点击属性，弹出以”系统“为标题的窗口；
2.点击左侧高级系统，弹出系统属性窗口；
3.点击环境变量，弹出环境变量窗口；
4.
  4.1如果你的webpack是是用cnpm安装的，则在dos下执行cnpm config get prefix，然后会在界面输出一个路径；我的是F:\Program Files\nodejs
然后在第3步弹出的环境变量窗口中 系统变量里新建变量NODE_PATH，值为：以第4步得到的路径开头，F:\Program Files\nodejs\node_modules;然后一直点击确定；
  4.2如果你的webpack是是用npm安装的，则在dos下执行npm config get prefix；后续步骤同4.1所述；
5.关闭dos窗口，再次打开dos；就好了；
echo $NODE_PATH;http://elickzhao.github.io/2016/10/webpace%20%E9%9B%B6%E5%9F%BA%E7%A1%80%E6%95%99%E7%A8%8B/   http://www.yatessss.com/2016/01/29/%E5%88%9D%E5%AD%A6webpack%E9%81%87%E5%88%B0%E7%9A%84%E5%9D%91.html
https://zhuanlan.zhihu.com/p/20397902  Webpack傻瓜指南（二）开发和部署技巧 
 webpack --display-error-details来打印错误详情。
 Webpack 中涉及路径配置最好使用绝对路径，建议通过 path.resolve(__dirname, "app/folder") 或 path.join(__dirname, "app", "folder") 的方式来配置，以兼容 Windows 环境
  webpack --progress --colors
  # 安装
$ npm install webpack-dev-server -g
在浏览器打开 http://localhost:8080/ 或 http://localhost:8080/webpack-dev-server/ 可以浏览项目中的页面和编译后的资源输出
# 运行
$ webpack-dev-server --progress --colors
demo https://github.com/zhaoda/webpack-handbook/blob/master/examples/start/webpack.config.js
```
###[数组排序](https://segmentfault.com/q/1010000008276449)
```js
var arr_1 = ["2017-02-05", "2017-02-06", "2017-02-04", "2017-01-31", "2017-02-01", "2017-02-02", "2017-02-03"]

var arr_2 = ["142146.00", "93380.03", "49825.00", "90437.00", "69174.00", "73603.00", "76662.00"]


var arr_3 = [];

arr_1.forEach(function(v, i){
  arr_3.push({
    'date': v,
    'money': arr_2[i]
  });
});

arr_3.sort(function(a, b){
  return a.date > b.date
});

console.log(JSON.stringify(arr_3));
//[{"date":"2017-01-31","money":"90437.00"},{"date":"2017-02-01","money":"69174.00"},{"date":"2017-02-02","money":"73603.00"},{"date":"2017-02-03","money":"76662.00"},{"date":"2017-02-04","money":"49825.00"},{"date":"2017-02-05","money":"142146.00"},{"date":"2017-02-06","money":"93380.03"}]
```
###[shell判断两个文件是否相等](https://segmentfault.com/q/1010000008276725)
```js
#cat temp
#/bin/sbin
file1=/workstation/develop/a.txt
file2=/workstation/develop/a.txt
diff $file1 $file2 > /dev/null
if [ $0 == 0 ]; then
    echo "yes"
else
    echo "no"
fi
x=$(diff --binary p1.js ex2.js);
if [[ -z $x ]]; then
  echo '相等'; 
else
  echo '不相等';
fi
```
###[数组remove元素](https://segmentfault.com/q/1010000008273313)
```js
Array.prototype.remove = function(num){
    var l = this.length;
    for(var i=0;i<this.length;i++){
        if(this[i]==num){
            this.splice(i,1)
        }
    }
    if(l==this.length){
        console.log("没有删除任何元素")
    }
}

var arr = new Array("111111",8,11,4,5);

arr.remove("111111")
console.log(arr);

```
###[获取前七天的日期](https://segmentfault.com/q/1010000008278376)
var dayBefore=new Date().getTime()-24*60*60*7*1000;;
var result=new Date(dayBefore).getDate();
console.log(result);

###[git diff打印两个文件的不同之处](https://segmentfault.com/q/1010000008280203)
--- a/readme.txt
+++ b/readme.txt
这个意思就是，你的 readme.txt 文件有改动。

======= 是分割线
分割线以上到 <<<<<<< HEAD 有两行，表示你本地的 HEAD 里面加了两行内容
分割线以下到 >>>>>>> origin/master 没有内容，表示 origin remote 的 master branch 这个位置是空的
"---"表示变动前的版本，"+++"表示变动后的版本。
###[李白打酒](https://segmentfault.com/q/1010000008252344)
```js
话说大诗人李白，一生好饮。幸好他从不开车。
一天，他提着酒壶，从家里出来，酒壶中有酒2斗。他边走边唱：
无事街上走，提壶去打酒。
逢店加一倍，遇花喝一斗。

这一路上，他一共遇到店5次，遇到花10次，已知最后一次遇到的是花，他正好把酒喝光了。 
请你计算李白遇到店和花的次序，可以把遇店记为a，遇花记为b。则：babaabbabbabbbb 就是合理的次序。像这样的答案一共有多少呢？请你计算出所有可能方案的个数（包含题目给出的）。
注意：通过浏览器提交答案。答案是个整数。不要书写任何多余的内容。
用递归法可以得到答案是14：

bababaababbbbbb
babaabbabbabbbb
babaababbbbbabb
baabbbaabbabbbb
baabbabbbaabbbb
baabbabbabbbabb
baababbbbbababb
abbbabaabbabbbb
abbbaabbbaabbbb
abbbaabbabbbabb
abbabbbabaabbbb
abbabbbaabbbabb
abbabbabbbababb
ababbbbbabababb
除了正向递归，还可以反向递归：

正向：从(花,店,酒) = (0,0,2)出发，递归到(10,5,0)结束。
反向：从(10,5,0)倒推，(10,5,0) -> (9,5,1) -> (8,5,2) ……直到(0,0,2)结束。
试着手工推导两三步就会发现，倒推法可能更好。因为只有当酒量为偶数时，我们才需要考虑用店将酒量减半。而正推法每一步都要考虑花和店两种情况。实际执行也发现倒推法明显优于正推法。

下图是倒推法调用树。圆圈里的数字是每一步递推后的酒量，箭头上的字母 P(ub)=酒店，F(lowe)r=花。红色路径是符合要求的顺序。总递归调用149次（缓存中间结果，形式相同的调用只算一次）
```
###[PHP易错面试题收集](https://zhuanlan.zhihu.com/p/25088168)
```js
$arr = [1,2,3];
    foreach($arr as &$v) {
        //nothing todo.
    }
    foreach($arr as $v) {
        //nothing todo.
    }
    var_export($arr);
    //output:array(0=>1,1=>2,2=>2)
class SomeClass
{
    private $properties = [];
    public function __set($name, $value)
    {
       $this->properties[$name] = $value;
    }
    public function __get($name)
    {
        return $this->properties[$name];
    }
}


$obj = new SomeClass();
$obj->name = 'phpgod';
$obj->age = 2;
$obj->gender = 'male';

var_dump($obj->name);
//output:string(6) "phpgod"
var_dump(isset($obj->name));
//output:bool(false)

 https://segmentfault.com/q/1010000008279730
 标准的写法：在使用了“ & ”的 foreach 之后，需要写一句 unset($v); 释放掉临时的引用。

该题的两个foreach的代码效果类似于以下代码：

$v = &$arr[0];
$v = &$arr[1];
$v = &$arr[2];
//var_dump($arr);

//请注意这个时候的$v是和$arr[2]等价的

$v = $arr[0];
$v = $arr[1];
$v = $arr[2];
//var_dump($arr);

php是没有块级作用域的！！！
也就是说，第一个循环结束后，$item依然指向数组的第三个成员。
之后每次循环，就把数组的第一个值写到第三个成员，然后是第二个值写个第三个成员，然后是第二个值写个第三个成员，但此时第三个值已经被上次修改成2了，所以这次第三个值会被修改成2
```
###[字典中根据value值取对应的key值](https://segmentfault.com/q/1010000008277059)
```js
def get_keys(d, value):
    return [k for k,v in d.items() if v == value]
    
get_keys({'a':'001', 'b':'002'}, '001') # => ['a']
>>> dicxx = {'a':'001', 'b':'002'}
>>> list(dicxx.keys())[list(dicxx.values()).index("001")]
'a'
dicxx = {'a':'001', 'b':'002'}
new_dict = {v:k for k,v in dicxx.items()}  # {'001': 'a', '002': 'b'}
new_dict['001']  # 'a'
```
###文字转图片
```js
text = u"这是一段测试文本，test 123。"
 
im = Image.new("RGB", (300, 50), (255, 255, 255))
dr = ImageDraw.Draw(im)
#font = ImageFont.truetype(os.path.join("fonts", "msyh.ttf"), 14)
font = ImageFont.truetype("STKAITI.ttf", 18)
dr.text((10, 5), text, font=font, fill="#000000")
 
im.show()
im.save("t.png")
print [x for x in xrange(1, 100) if not [y for y in xrange(2, x/2+1) if x % y == 0]]
http://python-china.org/t/254
print reduce(lambda l, y : not 0 in map(lambda x: y % x, l) and l + [y] or l, xrange(2, 100), [])
filter(lambda prime: all(prime%num for num in range(2, prime)), range(2, max))
```
###定义求质数的函数
```js
def getprim(n):
    #我们从3开始，提升效率，呵呵，微乎其微啦
    p=3
    x=0
    while(x<n):
        result=True
        for i in range(2,p-1):
            if(p%i==0):
                result=False
        if result==True:
        x=x+1
    rst=p
    #注意:这里加2是为了提升效率，因为能被双数肯定不是质数。
    p=+2 
    print(rst)

调用函数
getprim(1000)
```
###[用phantomjs生成截图文件很大](https://segmentfault.com/q/1010000008283594)
phantomjs rasterize.js "http://www.XXX.com/aa/bb/c.html" x.png
可以在截图后调用第三方包对图像进行后续处理，比如PNG Quant
###[laravel 本地 跳转一个链接需要2~3s](https://segmentfault.com/q/1010000008284766)
mysql连接用127.0.0.1而不是localhost。慢的原因是localhost解析到ipv6了，然后tcp连接1秒，超时，转而链接ipv4，所以导致了不管干什么都在1秒以上了
###[webpack 2 默认不支持简写的loader了](https://segmentfault.com/q/1010000008286904)
在 Webpack 2 中，你不能在使用 style-loader 的缩写 style 形式，因为 Webpack 2 不会再自动补全成 style-loader 。 你应该使用 loader 的全称，也就是 style-loader、css-loader 
###日期间隔
```js
$a='2017-01-11';
$b='2017-02-12';

$arr = [];
for($i=strtotime($a);$i<=strtotime($b);$i+=86400){
    $arr[]=date('Y-m-d',$i);
}

print_r($arr);
```
###[PHP防御XSS攻击的终极解决方案](https://www.waitalone.cn/xss-fix.html)
```js
function clean_xss(&$string, $low = False)
	{
		if (! is_array ( $string ))
		{
			$string = trim ( $string );
			$string = strip_tags ( $string );
			$string = htmlspecialchars ( $string );
			if ($low)
			{
				return True;
			}
			$string = str_replace ( array ('"', "\\", "'", "/", "..", "../", "./", "//" ), '', $string );
			$no = '/%0[0-8bcef]/';
			$string = preg_replace ( $no, '', $string );
			$no = '/%1[0-9a-f]/';
			$string = preg_replace ( $no, '', $string );
			$no = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
			$string = preg_replace ( $no, '', $string );
			return True;
		}
		$keys = array_keys ( $string );
		foreach ( $keys as $key )
		{
			clean_xss ( $string [$key] );
		}
	}
1.在输出html时，加上Content Security Policy的Http Header

（作用：可以防止页面被XSS攻击时，嵌入第三方的脚本文件等）
（缺陷：IE或低版本的浏览器可能不支持）

2.在设置Cookie时，加上HttpOnly参数

（作用：可以防止页面被XSS攻击时，Cookie信息被盗取，可兼容至IE6）
（缺陷：网站本身的JS代码也无法操作Cookie，而且作用有限，只能保证Cookie的安全）

3.在开发API时，检验请求的Referer参数

（作用：可以在一定程度上防止CSRF攻击）
（缺陷：IE或低版本的浏览器中，Referer参数可以被伪造）
1.尽量使用innerText(IE)和textContent(Firefox),也就是jQuery的text()来输出文本内容

2.必须要用innerHTML等等函数，则需要做类似php的htmlspecialchars的过滤（参照@eechen的答案）

```
###[喜马拉雅mp3批量下载工具PHP版](https://www.waitalone.cn/ximalaya-php-download.html)
```js
<?php

/**php ximalaya.php http://www.ximalaya.com/52622741/album/4519297
 * Created by 独自等待
 * Date: 2016/10/11
 * Time: 14:35
 * Name: ximalaya.php
 * 独自等待博客：http://www.waitalone.cn/
 */
print_r('
+---------------------------------------------------------------------+
                       喜马拉雅mp3批量下载工具
                     Site：http://www.waitalone.cn/
                        Exploit BY： 独自等待
                          Time：2016-10-11
+---------------------------------------------------------------------+
');
set_time_limit(0);
error_reporting(7);
if ($argc < 2) {
    print_r('
+---------------------------------------------------------------------+
Useage: php ' . $argv[0] . ' 喜马拉雅mp3专辑地址
Example: php ' . $argv[0] . ' http://www.ximalaya.com/1412917/album/239463
+---------------------------------------------------------------------+
    ');
    exit;
}

class ximalaya
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getpage()
    {
        $purl = array();
        $response = file_get_contents($this->url);
        if (preg_match_all('/class=\'pagingBar_page\'/', $response, $match)) {
            $pagelen = count($match[0]);
            for ($i = 1; $i <= $pagelen; $i++) {
                $purl[] = $this->url . '?page=' . $i;
            }
        } else {
            $purl[] = $this->url;
        }
        return $purl;
    }

    public function analyze($trackid)
    {
        $mp3_arr = array();
        $trackurl = 'http://www.ximalaya.com/tracks/' . $trackid . '.json';
        $response = file_get_contents($trackurl);
        $jsonobj = json_decode($response, true);
        $title = $jsonobj['title'];
        $mp3 = $jsonobj['play_path'];
        $mp3_arr['title'] = iconv('utf-8', 'gbk//IGNORE', $title);
        $mp3_arr['mp3'] = $mp3;
        return $mp3_arr;
    }

    public function getids($purl)
    {
        $ids = array();
        if (strpos($purl, 'sound')) {
            $ids[] = substr($purl, strrpos($purl, '/') + 1);
        } else {
            $response = file_get_contents($purl);
            preg_match('/sound_ids="(.+?)"/', $response, $match);
            $ids = explode(',', $match[1]);
        }
        return $ids;
    }

    public function down()
    {
        $todown = $this->getpage();
        foreach ($todown as $purl) {
            foreach ($this->getids($purl) as $ids) {
                $idsarr = $this->analyze($ids);
                $title = $idsarr['title'];
                $mp3_url = $idsarr['mp3'];
                $filename = $title . '.mp3';
                echo $filename . ' ' . $mp3_url . PHP_EOL;
                fwrite(fopen('mp3.txt', 'ab+'), $filename . ' | ' . $mp3_url . PHP_EOL);
                if (function_exists('system')) {
                    @ob_start();
                    $res = system('aria2c.exe -s 10 -j 10 ' . $mp3_url . ' --out=' . $filename);
                    @ob_get_contents();
                    @ob_end_clean();
                    if (strpos($res, 'OK')) {
                        echo $filename . ' 下载成功!' . PHP_EOL;
                    } else {
                        echo $filename . ' 下载失败!' . PHP_EOL;
                    }
                } else {
                    echo '请开启system函数以便多线程下载!tips: check disable_functions in php.ini' . PHP_EOL;
                }
            }
        }
    }
}

$ximalaya = new ximalaya($argv[1]);
$ximalaya->down();


```
###[用PHP发送POST请求]()
```js
/** 
 * 发送post请求 
 * @param string $url 请求地址 
 * @param array $post_data post键值对数据 
 * @return string 
 */  
function send_post($url, $post_data) {  
  
  $postdata = http_build_query($post_data);  
  $options = array(  
    'http' => array(  
      'method' => 'POST',  
      'header' => 'Content-type:application/x-www-form-urlencoded',  
      'content' => $postdata,  
      'timeout' => 15 * 60 // 超时时间（单位:s）  
    )  
  );  
  $context = stream_context_create($options);  
  $result = file_get_contents($url, false, $context);  
  
  return $result;  
}  
  
//使用方法  
$post_data = array(  
  'username' => 'stclair2201',  
  'password' => 'handan'  
);  
send_post('http://www.waitalone.cn', $post_data);
<?php  
/** 
 * Socket版本 
 * 使用方法： 
 * $post_string = "app=socket&version=beta"; 
 * request_by_socket('waitalone.cn', '/restServer.php', $post_string); 
 */  
function request_by_socket($remote_server,$remote_path,$post_string,$port = 80,$timeout = 30) {  
  $socket = fsockopen($remote_server, $port, $errno, $errstr, $timeout);  
  if (!$socket) die("$errstr($errno)");  
  fwrite($socket, "POST $remote_path HTTP/1.0");  
  fwrite($socket, "User-Agent: Socket Example");  
  fwrite($socket, "HOST: $remote_server");  
  fwrite($socket, "Content-type: application/x-www-form-urlencoded");  
  fwrite($socket, "Content-length: " . （strlen($post_string) + 8） . "");  
  fwrite($socket, "Accept:*/*");  
  fwrite($socket, "");  
  fwrite($socket, "mypost=$post_string");  
  fwrite($socket, "");  
  $header = "";  
  while ($str = trim(fgets($socket, 4096))) {  
    $header .= $str;  
  }  
  
  $data = "";  
  while (!feof($socket)) {  
    $data .= fgets($socket, 4096);  
  }  
  
  return $data;  
}  
?>  
<?php  
/**  
 * Curl版本  
 * 使用方法：  
 * $post_string = "app=request&version=beta";  
 * request_by_curl('http://www.waitalone.cn/restServer.php', $post_string);  
 */  
function request_by_curl($remote_server, $post_string) {  
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, $remote_server);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERAGENT, "waitalone.cn's CURL Example beta");  
  $data = curl_exec($ch);  
  curl_close($ch);  
  
  return $data;  
}  

```
###[Python certificate verify failed解决方法](https://www.waitalone.cn/python-ssl-error.html)
```js
import ssl
import urllib2
 
context = ssl._create_unverified_context()
print urllib2.urlopen("https://www.xxx.com/", context=context).read()
import ssl
import urllib2
 
ssl._create_default_https_context = ssl._create_unverified_context
print urllib2.urlopen("https://www.xxx.com/").read()

```
###[lxml 中文乱码解决](https://www.waitalone.cn/lxml-text.html)
```js
#!/usr/bin/env python
# -*- coding: utf-8 -*-
# Date: 2016/2/14
# Created by 独自等待
# 博客 http://www.waitalone.cn/
import urllib2
from lxml import etree
from lxml.html.clean import Cleaner


def getText(url):
    '''
    获取指定url返回页的所有文字
    :param url: 需要抓取的url
    :return: 返回文字
    '''
    page = urllib2.urlopen(url, timeout=10).read()
    page = unicode(page, "utf-8")  # 转换编码,否则会导致输出乱码
    cleaner = Cleaner(style=True, scripts=True, page_structure=False, safe_attrs_only=False)  # 清除掉CSS等
    str = etree.HTML(cleaner.clean_html(page))
    texts = str.xpath('//*/text()')  # 获取所有文本
    for t in texts:
        print t.strip().encode('gbk', 'ignore')


getText('http://www.360.cn/')

```
###[下载美女图](https://www.waitalone.cn/netbian-images-down.html)
```js
#!/usr/bin/env python
# -*- coding: gbk -*-
# -*- coding: utf-8 -*-
# Date: 2016/4/25
# Created by 独自等待
# 博客 http://www.waitalone.cn/
import urllib2

try:
    from lxml import html
except ImportError:
    raise SystemExit(u'模块导入错误,请使用pip install lxml安装!')

nums = 10  # 下载多少页,每页大概18张
imgtype = 'meinv'  # 壁纸的分类,比如：meinv,fengjing


def downlist():
    u"获取需要下载的壁纸列表函数"
    todownlist = []  # 保存需要下载的壁纸URL

    for i in range(1, nums + 1):
        if i == 1:
            url = 'http://www.netbian.com/' + imgtype + '/index.htm'
        else:
            url = 'http://www.netbian.com/' + imgtype + '/index_%d.htm' % i
        try:
            response = urllib2.urlopen(url, timeout=10).read()
        except Exception, msg:
            print msg
        else:
            imglink = html.fromstring(response)
            imgalist = imglink.xpath('//div[@class="list"]/ul/li/a/@href')
            imgalist = [l.replace('.htm', '') for l in imgalist if 'desk' in l]
            downlist = ['http://www.netbian.com' + d + '-1920x1080.htm' for d in imgalist]
            todownlist.extend(downlist)
    return todownlist


def downimg():
    u"下载壁纸并自动更名"
    cnt = 0
    for link in downlist():
        cnt += 1
        try:
            response = urllib2.urlopen(link, timeout=10).read()
        except Exception, msg:
            print msg
        else:
            img = html.fromstring(response)
            imgsrclist = img.xpath('//td[@align="left"]/img/@src')
            try:
                if imgsrclist:
                    imgres = urllib2.urlopen(imgsrclist[0]).read()
                else:
                    continue
            except Exception, msg:
                print msg
            else:
                print u'[!] 爷,小的正努力下载[ %s ]类第[ %.3d ]张壁纸!' % (imgtype, cnt)
                with open(imgtype + u'壁纸%.3d.jpg' % cnt, 'wb') as imgfile:
                    imgfile.write(imgres)


if __name__ == '__main__':
    print '+' + '-' * 60 + '+'
    print u'\t\tPython 彼岸壁纸下载器'
    print u'\t   Blog：http://www.waitalone.cn/'
    print u'\t\t Code BY： 独自等待'
    print u'\t\t Time：2016-04-25'
    print '+' + '-' * 60 + '+'
    print u'正在下载中,请稍候……\n'
    try:
        downimg()
    except KeyboardInterrupt:
        print u'[x] 爷,还没有下载完哦!'
    print u'\n恭喜爷,已经下载完毕.请查看!'

```
###[PythonZip压缩成功](https://segmentfault.com/q/1010000008290294)
```js
#!/usr/bin/env bash

zip -r target.zip target_dir/

if [ $? -eq 0 ]; then
    echo "Success"
else
    echo "Failed"
fi
#!/usr/bin/env python

import commands

status = commands.getstatusoutput("zip -r target.zip target_dir/")[0]

if status == 0:
    print "Success"
else:
    print "Failed"
```
###[nodejs做一个简易的tcp聊天程序](https://segmentfault.com/q/1010000008293716)
```js
var net=require('net');

var count=0, users={};

var server=net.createServer(function(conn){
    conn.write(
        '\n\r > welcome to\033[92m node-chat\033[39m !'+
        '\n\r > '+count+' other people are connected at this time.'+
        '\n\r > please write your name and press enter: '
    );
    count++;

    conn.setEncoding('utf8');

    var nickname;

    function broadcast(msg, exceptMyself){
        for(var i in users){
            if(!exceptMyself||i!=nickname){
                users[i].write(msg);
            }
        }
    }

    var tmp = '';

    conn.on('data',function(data){
      tmp += data;
      if (tmp.indexOf('\n') === -1) {
        return;
      }
      data = tmp.replace(/\r|\n/g, '');

        if(!nickname){
            if(users[data]){
                conn.write('\r\n\033[93m> nickname already in use. try again:\033[39m\r\n ');
                return;
            }else{
                nickname=data;
                users[nickname]=conn;

                broadcast('\r\n\033[90m > '+nickname+' joined the room\033[39m\r\n', true);
            }
        }else{
            broadcast('\r\n\033[96m> '+nickname+':\033[39m '+data+'\r\n');
        }

        process.stdout.write(tmp);
    });
    conn.on('close',function(){
        count--;
        delete users[nickname];
        broadcast('\r\n\033[096m> '+nickname+' left the room\033[39m \r\n');
    });
});

server.listen(3000,function(){
    console.log('\033[96m server listening on *:3000\033[39m');
});
```
###[找不到webpack](https://segmentfault.com/q/1010000008294703)
```js
没有安装 webpack，devDependencies 里需要添加 webpack。因为 webpack-dev-server 里依赖 webpack 是 peerDependencies，npm@>=3 不会再自动安装 peerDependencies 下的依赖。
```
