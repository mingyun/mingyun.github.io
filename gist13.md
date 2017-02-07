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
