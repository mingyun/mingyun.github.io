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
