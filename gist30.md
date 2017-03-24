mysql分区
ALTER TABLE webinar_user_regs MODIFY COLUMN `id` bigint(20) unsigned NOT NULL;
ALTER TABLE webinar_user_regs DROP PRIMARY KEY;
ALTER TABLE webinar_user_regs ADD INDEX `id`(`id`);
ALTER TABLE webinar_user_regs PARTITION BY HASH(webinar_id) PARTITIONS 64;
[php 二维码 加水印图片 支持ios,android,win8](http://blog.51yip.com/php/1600.html)
[php xml与json间的相互转换](http://blog.51yip.com/php/660.html)
```js
public function xml_to_json($source) {  
    if(is_file($source)){             //传的是文件，还是xml的string的判断  
        $xml_array=simplexml_load_file($source);  
    }else{  
        $xml_array=simplexml_load_string($source);  
    }  
    $json = json_encode($xml_array);  //php5，以及以上，如果是更早版本，請下載JSON.php  
    return $json;  
}  

public function json_to_xml($source,$charset='utf8') {  
    if(emptyempty($source)){  
        return false;  
    }  
    $array = json_decode($source);  //php5，以及以上，如果是更早版本，請下載JSON.php  
    $xml  ='<!--l version="1.0" encoding="'.$charset.'-->';  
    $xml .= $this->change($array);  
    return $xml;  
}  
  
public function change($source) {  
    $string=""; 
    foreach($source as $k=>$v){ 
        $string .="<".$k.">"; 
        if(is_array($v) || is_object($v)){       //判断是否是数组，或者，对像 
            $string .= $this->change($v);        //是数组或者对像就的递归调用 
        }else{ 
            $string .=$v;                        //取得标签数据 
        } 
        $string .="";  
    }  
    return $string;  
}  

 $list = WebinarTrack::where('webinar_id',$webinar_id)->where('created_at','>=',$start)->where('created_at','<=',$end)->whereRaw('`created_at` = `updated_at`')->get()->toArray();
 $redisCacheKey = 'cache:user:info:'.$id;
            $data = \RedisFacade::get($redisCacheKey);
            if($data){
                return unserialize($data);
            }
MySQL忘记密码
ps -e|grep mysql |xargs killall  
mysqld_safe --user=root --skip-grant-tables  
mysql -u root  
use mysql  
update user set password=password("new_pass") where user="root";  
flush privileges;
开启profile
mysql> set profiling=1;
Query OK, 0 rows affected (0.00 sec) show profile for query 1;
update comment set content=replace(content,'1111','2222')  where c_id = '2';
SELECT CASE u_id  
WHEN 1  
THEN '张映'  
WHEN 2  
THEN 'tank'  
ELSE 'no'  
END AS uname, name  
FROM COMMENT  
SELECT CASE  
WHEN u_id =1  
THEN '张映'  
WHEN u_id =2  
THEN 'tank'  
ELSE 'no'  
END AS uname, name  
FROM COMMENT   SELECT if( u_id =1, '张映', 'tank' ) AS uname,name FROM `comment`  

```
推荐注册手机号的好友 关注
```js
$mobileList=[['mobile'=>111111,'name'=>'xxx']]
$mobiles = array_column($mobileList, 'mobile');
        unset($mobileList);
        foreach ($mobiles as $i => &$mobile) {
            $mobile = str_replace(' ', '', $mobile);
            if (substr_compare('+86', $mobile, 0, 3) === 0) {
                $mobile = substr($mobile, 3);
            }

            $mobile = (int)$mobile;
            if (!$mobile || $mobile < 10000) {
                unset($mobiles[$i]);
            }
        }

        if (!$mobiles) {
            $this->delete();
            return;
        }

        $redis->pipeline(function($pipe) use($userId, $mobiles) {
            foreach ($mobiles as $mobile) {
                // 订阅所有的通讯录中的手机号
                $pipe->sAdd('mobile:sub:users:' . $mobile, $userId);
            }
        });

        $users = User::whereIn('phone', $mobiles)->lists('id');
        $redis->pipeline(function($pipe) use($userId, $users) {
            foreach ($users as $user) {
                // 将通讯录已注册的用户推荐给我
                $pipe->sAdd('user:sub:otherUser:' . $userId, $user);
                // 将我推荐给通讯录中已注册的用户
                $pipe->sAdd('user:sub:otherUser:' . $user, $userId);
            }
        });

$userIds = $redis->sMembers('user:sub:otherUser:' . $userId);
        $followList = $redis->hKeys('user:follows:list:' . $userId);
        $knowIds = array_diff($userIds, $followList, [$userId]);

        if (!$knowIds) return [];

        RedisFacade::set('app:mayknow:'. $userId, count($knowIds));
        $result = $this->model->mgetBascInfo(array_slice($knowIds, $offset, $limit));//分页
        return array_filter(array_values($result));
```



[apache2nginx 安装和使用](http://blog.51yip.com/apachenginx/1455.html)

wget https://github.com/downloads/nhnc-nginx/apache2nginx/apache2nginx-1.0.0-bin.i386.tar.bz2 //下载  
tar jxvf apache2nginx-1.0.0-bin.i386.tar.bz2   //解压  
cp ./apache2nginx /usr/sbin   //放到环境变量目录下面  
apache2nginx -f /etc/httpd/conf/httpd.conf  //apache配置文件转换成nginx  
[crontab执行不了php的解决方法](http://blog.51yip.com/php/1346.html)

```jsphp文件有没有执行权限
chmod +x ./del_redis.php  
*/10 * * * * /usr/local/php/bin/php /var/www/cron/del_redis.php >> /home/zhangy/cron.txt  
3，用crontab来执行php，是不走apache,nginx，所以$_SERVER,$_ENV这类变量根本用不了。所以检查一下php代码中有没有这类变量，如果有拿掉。
4，php的相对路径问题

include_once'./mysql.php';  
当php代码中，用的是相对路径时，只有进入到那个目录下执行/usr/local/php/bin/php /var/www/cron/level_rank.php才能生效。这个问题我遇到过至少二次，但是再遇到时还是想不起来。
解决方法如下:
 
*/10 * * * * cd /var/www/cron && /usr/local/php/bin/php /var/www/cron/level_rank.php  
或者
在php代码中用绝对路径
```
group_concat的存在的问题
1，如果想合并的列是int型的，合并出来提示[BLOB - 7 B]或者[BLOB - 7 字节]，这个时候要GROUP_CONCAT( cast( id AS char ) ) AS id 而不能GROUP_CONCAT( id  ) AS id，cast是一个转换函数
2，group_concat对长度是有限制的，mysql默认的是1024字节，
查看复制打印?
mysql> show variables like "%concat%";  
+----------------------+-------+  
| Variable_name        | Value |  
+----------------------+-------+  
| group_concat_max_len | 1024  |  
+----------------------+-------+  
1 row in set (0.00 sec)  


[redis php sort 函数](http://blog.51yip.com/cache/1441.html)
```js
$redis = new redis();  
$redis->connect('192.168.1.108', 6379);  
$redis->flushall();  
$redis->lpush('test', 'a');  
$redis->lpush('test', 'd');  
$redis->lpush('test', 'b');  
  
print_r($redis->sort('test')); //结果：Array ( [0] => b [1] => d [2] => a )  
  
print_r($redis->sort('test',array('ALPHA'=>TRUE))); //结果：Array ( [0] => a [1] => b [2] => d )  
$array = array('LIMIT'=>array(0,3),"SORT"=>'DESC');  
print_r($redis->sort('test',$array));  //结果：Array ( [0] => 31 [1] => 23 [2] => 5 )  

$redis->lpush('id', 1);  
$redis->set('name_1', 'tank');  
$redis->set('score_1',89);  
  
$redis->lpush('id', 2);  
$redis->set('name_2', 'zhang');  
$redis->set('score_2', 40);  
  
$redis->lpush('id', 4);  
$redis->set('name_4','ying');  
$redis->set('score_4', 70);  
  
$redis->lpush('id', 3);  
$redis->set('name_3', 'fXXK');  
$redis->set('score_3', 90);  
  
/** 
 * 按score从大到小排序,取得id 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => 3 [1] => 1 [2] => 4 [3] => 2 )   
  
/** 
 * 按score从大到小排序,取得name 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>'name_*'  
            );  
print_r($redis->sort('id',$sort)); //结果:Array ( [0] => fXXK [1] => tank [2] => ying [3] => zhang )    
  
/** 
 * 按score从小到大排序,取得name，score 
 */  
$sort=array('BY'=>'score_*',  
            'SORT'=>'DESC',  
            'GET'=>array('name_*','score_*')  
            );  
print_r($redis->sort('id',$sort));  
/** 
 *结果:Array 
        ( 
            [0] => fXXK 
            [1] => 90 
            [2] => tank 
            [3] => 89 
            [4] => ying 
            [5] => 70 
            [6] => zhang 
            [7] => 40 
        )) 
 */  
```


[innodb 共享表空间 转 独立表空间 详细说明，以及遇到的问题](http://blog.51yip.com/mysql/1368.html)




```js
mysql> show variables like '%per_table%';  
+-----------------------+-------+  
| Variable_name         | Value |  
+-----------------------+-------+  
| innodb_file_per_table | OFF   |  
+-----------------------+-------+  
1 row in set (0.00 sec)  
如果是OFF，肯定不是独立表空间。如果是ON的话，也不一定是独立表空间。最直接的方法就是查看硬盘上的文件，独立表空间，每个表都对应了一个空间。
[root@localhost tg]# ll  
总用量 64  
-rw-rw----. 1 mysql mysql   65 12月 30 20:09 db.opt  
-rw-rw----. 1 mysql mysql 8658 12月 30 23:17 gb.frm  
-rw-rw----. 1 mysql mysql 8658 12月 30 23:19 qr.frm  
-rw-rw----. 1 mysql mysql 8658 12月 30 23:19 qy.frm  
-rw-rw----. 1 mysql mysql 8658 12月 30 23:19 tg.frm  
-rw-rw----. 1 mysql mysql 8658 12月 30 23:19 xcy.frm  
tg是一个数据库名，里面的都是innodb的。像这种情况就是共享表空间。
从这里可以看出，每一张表都对应有一个.ibd的文件，根共享表空间是不一样的。到这儿就完全配置好了。
```


[redis session 存储 同步](http://blog.51yip.com/cache/1434.html)
```js
session.save_handler = redis  
session.save_path = "tcp://127.0.0.1:6379"  
session_start();  
$_SESSION['redis'] = "aaaaaa";  
echo session_id();  
echo "<br>";  
echo $_SESSION['redis'];  
echo "<br>";  
$redis = new redis();  
$redis->connect('192.168.1.108', 6379);  
echo $redis->get("PHPREDIS_SESSION:ruk5i2vlu2hvtmfr5hig4l55f6");//这个key我是通过telnet到redis查的。  

echo session_id();显示出来是ruk5i2vlu2hvtmfr5hig4l55f6，开始的时候，echo $redis->get("ruk5i2vlu2hvtmfr5hig4l55f6");不管怎么样都取不到值，因为memcache这样是可以取到值的，所以我就想redis估计也是这样。telnet到redis看了一下，原来命名key值的方式是不一样的
copy一下redis.conf，生成一个从机的配置
cp /usr/local/redis/redis.conf /usr/local/redis/redis_slave.conf
2，修改主服务器的配置redis.conf
bind 127.0.0.1
3，修改从服务器的配置redis_slave.conf
pidfile /usr/local/redis/var/redis_slave.pid
port 10002
bind 127.0.0.1
logfile /usr/local/redis/var/redis_slave.log
dbfilename dump_slave.rdb
slaveof 127.0.0.1 6379
4，启动主服务器，从服务器
redis-server /usr/local/redis/redis.conf
redis-server /usr/local/redis/redis_slave.conf
root@ubuntu:/usr/local/redis# ps -e|grep redis
3774 ? 00:00:00 redis-server
4148 ? 00:00:00 redis-server

```
php函数  几个小时前
```js
function timeFromNow($dateline) {  
    if(emptyempty($dateline)) return false;  
    $seconds = time() - $dateline;  
    if ($seconds < 60){  
        return "1分钟前";  
    }elseif($seconds < 3600){  
        return floor($seconds/60)."分钟前";  
    }elseif($seconds  < 24*3600){  
        return floor($seconds/3600)."小时前";  
    }elseif($seconds < 48*3600){  
        return date("昨天 H:i", $dateline)."";  
    }else{  
        return date('Y-m-d', $dateline);  
    }  
}  
  
echo timeFromNow(strtotime("2012-07-07 14:15:13")); //昨天 14:15  
echo timeFromNow(strtotime("2012-07-08 14:15:13")); //1小前  
```
[nginx 报 504 Gateway Time-out 解决方法](http://blog.51yip.com/apachenginx/1475.html)

用pkill php-cgi的时候，根本杀不掉，当时我想到是php-cgi进程死了，急着解决问题，没有演示一下查看僵尸进程。下面有二个方法查看。
第一种：ps查看
[root@localhost ~]# ps -ef |grep defunc  
第二种，top查看zombie，如果 != 0，就是僵尸进程

源码下载：https://github.com/t0k4rt/phpqrcode http://blog.51yip.com/demo/phpqrcode/test.php
[ffmpeg 安装 分割 截图 转换 加水印](http://blog.51yip.com/linux/1584.html)
```js
视频截图
# ffmpeg -i test.mp4 -y -f mjpeg -ss 3 -t 1  test1.jpg  
  
# ffmpeg -i test.mp4 -y -f image2 -ss 3 -vframes 1 test1.jpg  
上面二个例子都表示，在第三秒的时候，截图。
3，获取视频时间
查看复制打印?
[root@localhost test]# ffmpeg -i test.mp4 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//  
00:00:33.73  
4，视频转换
视频的格式有很多，以mp4和flv为例子
查看复制打印?
# ffmpeg -i test.mp4 -ab 56 -ar 22050 -qmin 2 -qmax 16 -b 320k -r 15 -s 320x240 outputfile.flv   //mp4 转 flv  
  
# ffmpeg -i outputfile.flv -copyts -strict -2 test.mp4  //flv 转 mp4  
5，视频加水印
查看复制打印?
#ffmpeg -y -i test.mp4 -acodec copy -vf "movie=uwsgi.jpg [logo]; [in][logo] overlay=10:10:1 [out]" test2.mp4  
overlay=10:10:1，后三个数据表示是距离左边的距离，距离上边的距离，是否透明，1表示透明。上例我用的是jpg，当然不可能透明。
查看复制打印?
# ffmpeg -y -i test.mp4 -acodec copy -vf "movie=uwsgi.jpg [logo]; [in][logo] overlay=enable='lte(t,1)' [out]" test2.mp4  
overlay=enable='lte(t,1)' ，这个参数表示，水印在前一秒显示。
```


```js

php excelreader操作excel的php类，生成，读取excel等。功能很强大。
下载地址：http://sourceforge.net/projects/phpexcelreader/
解压后，里面有很多例子，调用方法简单。
2，phpdocx操作word的php类
下载地址：http://www.phpdocx.com/
在线演示地址：http://www.phpdocx.com/demo/sample-word-report
3，tcpdf操作pdf的php类
下载地址：http://sourceforge.net/projects/html2fpdf/?source=recommended
在线演示地址：http://www.tcpdf.org/examples.php
$logo = 'logo.png';  
  
if(is_file($logo))  
{  
    $QR = imagecreatefromstring(file_get_contents($filename));  
    $logo = imagecreatefromstring(file_get_contents($logo));  
    $QR_width = imagesx($QR);  
    $QR_height = imagesy($QR);  
    $logo_width = imagesx($logo);  
    $logo_height = imagesy($logo);  
    $logo_qr_width = $QR_width / 5;  
    $scale = $logo_width / $logo_qr_width;  
    $logo_qr_height = $logo_height / $scale;  
    $from_width = ($QR_width - $logo_qr_width) / 2;  
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);  
    imagepng($QR,$filename);  
}  
```

[Linux命令查找](http://linux.51yip.com/search/crontab)
[redis 导出 导入 详解](http://blog.51yip.com/nosql/1656.html)
```js
[root@localhost tank]# telnet 127.0.0.1 6379 //telnet到redis  
Trying 127.0.0.1...  
Connected to 127.0.0.1.  
Escape character is '^]'.  
set test 11 //设置一个值  
+OK  
get test //取值  
$2  
11  
  
[root@localhost tank]# redis-dump -u 127.0.0.1:6379 >test.json //导出数据
[root@localhost tank]# telnet 127.0.0.1 6379 //telnet到redis  
Trying 127.0.0.1...  
Connected to 127.0.0.1.  
Escape character is '^]'.  
flushall //请空所有数据  
+OK  
keys * //查看已清空  
*0  
  
[root@localhost tank]# < test.json redis-load //导入数据  
  
[root@localhost tank]# telnet 127.0.0.1 6379  
Trying 127.0.0.1...  
Connected to 127.0.0.1.  
Escape character is '^]'.  
keys * //已导入成功  
*1  
$4  
test  
```

[根据用户职级关系展示数据如何设计更合理](https://segmentfault.com/q/1010000008741101)
```js
--管理员表
CREATE TABLE `mango16_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 
--权限表
CREATE TABLE `mango16_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别，从0开始计数',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 
--角色表
CREATE TABLE `mango16_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作,控制器-操作,控制器-操作',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
 
 
角色：
    品牌经理
    店长
    销售

```
[apidoc 生成api文档](http://blog.51yip.com/other/1847.html)
# npm install apidoc@0.12 -g 
```js
class UserController{  
  
 /** 
 * @api {POST} /api/user/getUserInfo 
 * @apiName 取得用户信息 api 
 * @apiGroup 用户组 
 * @apiVersion 1.0.1 
 * @apiDescription 取得用户信息 
 * @apiPermission 登录用户 
 * @apiSampleRequest http://api.test.com/api/user/getUserInfo 
 * @apiParam {int} [id] any id 
 * @apiParamExample {json} 请求例子: 
 * { 
 * "id": 4711 
 * } 
 * @apiSuccess (200) {String} msg 信息 
 * @apiSuccess (200) {int} code 200 
 * @apiSuccess (200) {String} name 真实姓名 
 * @apiSuccess (200) {String} mobile 手机号 
 * @apiSuccess (200) {String} birthday 生日 
 * @apiSuccess (200) {String} email 邮箱 
 * @apiSuccessExample {json} 返回样例: 
 * { 
 * "code": 200, 
 * "msg": "", 
 * "name": "真实姓名", 
 * "mobile": 12345678901, 
 * "birthday": "1980-03-05", 
 * "email": "test@gamil.com" 
 * } 
 * @apiErrorExample {json} 错误返回: 
 * { 
 * "code": 14695 
 * "msg": "数据出错" 
 * } 
 */  
 public function getUserInfo(){  
  
 }  
}  
[root@localhost mytest]# cat apidoc.json  
{  
    "name": "我的测试",  
    "version": "1.0.0",  
    "description": "测试",  
    "title": "测试",  
    "url" : "https://api.test.com"  
}  
  
# apidoc -i mytest/ -o ./doc  
```
[centos7 安装 shadowsocks](http://blog.51yip.com/linux/1839.html)
```js
# mkdir -p /etc/shadowsocks  
# vim /etc/shadowsocks/config.json  
  
{  
"server":"118.61.***.***",  
"port_password":{  
 "18381":"*********",  
 "18382":"*********",  
 "18383":"*********",  
 "18385":"*********",  
 "18384":"*********"  
 },  
"timeout":300,  
"method":"rc4-md5",  
"fast_open":false,  
"workers":1  
}  
# systemctl start shadowsocks-server.service  
# systemctl enable shadowsocks-server.service  
# systemctl disable shadowsocks-server.service  
# firewall-cmd --permanent --add-port=18381-18385/tcp  
# firewall-cmd --reload  
centos7用的firewalld，比直接用iptables要简单，好用。

alter如果很慢，优化一下my.cnf，[mysqld]加上以下内容，并重新加载。
innodb_buffer_pool_size=1G  
innodb_file_io_threads=4  
innodb_file_io_threads常规配置，小于等CPU核数。innodb_buffer_pool_size小于等于物理内存的1/2，原则上够用就好。

```
[nginx php-fpm 小VPS 优化](http://blog.51yip.com/apachenginx/1792.html)
```js
[root@xxxxxx nginx]# free -m  
              total       used       free     shared    buffers     cached  
Mem:           994        815        179          0         43        118  
-/+ buffers/cache:        453        540  
Swap:            0          0          0  
  
[root@xxxxxx nginx]# cat /proc/cpuinfo
pm = dynamic                      //进程数，动态分配  
pm.max_children = 24              //最大进程数  
pm.start_servers = 8              //刚启动时的进程数  
pm.min_spare_servers = 8          //服务器空闲时的最小进程数  
pm.max_spare_servers = 24         //服务器空闲时的最大进程数  
  
php_flag[display_errors] = off    //运行一段时间后，将错误提示信息关闭掉  
php-fpm一个进程占了20M-30M之间，top看一下php-fpm占的内存百分比，估算一下就知道了。max_children，max_spare_servers不是越大越好
nginx.cnf
worker_processes auto;      //设置auto，nginx进程动态分配  
  
# access_log    //注释掉，减少I/O  
# log_format    //注释掉，减少I/O  
  
gzip on;          //开启gzip  
gzip_min_length  1k;  
gzip_buffers     4 16k;  
gzip_http_version 1.1;  
gzip_comp_level 5;       //1-9,越大压缩越好，消耗资源越大  
gzip_types       text/plain application/x-javascript text/css application/xml;  
gzip_vary on;  

```

[munin 监控 redis](http://blog.51yip.com/server/1695.html)
[munin 监控 php-fpm](http://blog.51yip.com/server/1694.html)
```js
# vim /etc/php-fpm.d/www.conf  
  
pm.status_path = /status     //把前面注释去掉  
  
# /etc/init.d/php-fpm restart   //重启 
# vim /etc/nginx/conf.d/munin.conf   //添加以下内容  
  
location ~ ^/(status|ping)$ {  
 include fastcgi_params;  
 fastcgi_pass 127.0.0.1:9000;  
 fastcgi_param SCRIPT_FILENAME $fastcgi_script_name;  
 allow 127.0.0.1;  
 #allow 192.168.1.101;  
 #allow munin.51yip.com;  
 deny all;  
}  
  
# /etc/init.d/nginx restart  //重启
访问http://xxxxx.com/status，如果出现以下内容，说明nginx和php-fpm配置对了
pool:                 www
process manager:      dynamic
start time:           14/Jan/2015:09:26:23 +0800
start since:          28796
accepted conn:        261
listen queue:         0
max listen queue:     0
listen queue len:     128
idle processes:       6
active processes:     1
total processes:      7
max active processes: 4
max children reached: 0
3,下载munin的php-fpm插件
https://github.com/tjstein/php5-fpm-munin-plugins
```


下载munin redis插件
https://github.com/bpineau/redis-munin
[php word html](http://blog.51yip.com/php/1708.html)
[nginx php curl 访问 不正常](http://blog.51yip.com/apachenginx/1736.html)

导致php curl 不正常的原因是我将php-fpm的启动用户改成了root，启动方法改为，
sudo nohup /usr/sbin/php-fpm -R >/dev/null 2>&1 &
解决办法是，将，vim /etc/php-fpm.d/www.conf里面的，group和user改成非root账号，通过service php-fpm start或者是/etc/init.d/php-fpm start来启动。

[nginx php 上传文件大小 设置](http://blog.51yip.com/apachenginx/1751.html)
```js
nginx php设置上传文件大小，有三个地方需要改。
1，nginx.conf
client_max_body_size默认是2M的，如果通过http上传超过2M，会报413 Request Entity Too Large错误
解决办法，将client_max_body_size改大就行了。
2，php.ini
upload_max_filesize = 20M     #文件上传的最大值
post_max_size = 30M   #post数据的最大值
这二个有什么区别呢，post数据，常用的就是form表单了，表单数据不光有文件，还可以有其他数据，所以一般情况下，post_max_size设置的会比upload_max_filesize大,大多少，看需要了，如果一个form表单要传多个文件，那就要设置很大了。
如果不用post，而用socket协议来上传文件，那么post_max_size设置就没有用处了。
```


[输入pip list时提示Unable to create process using '"'](https://segmentfault.com/q/1010000008816667)
你安装了个python3环境,然而你的pip是python2的版本,对此你要将原先的python3卸载了,然后安装的时候勾选pip即可.
[php用htmlentities转换引号时，为什么双引号转换成了实体名称，单引号却转换成了实体编号？](https://segmentfault.com/q/1010000008816915)
这个转义的映射关系可以通过这函数来获取：get_html_translation_table(HTML_ENTITIES) 可以看到里面没有单引号。所以单引号就被转换为&#039;的形式。
[mysql innodb #145 错误解决](http://blog.51yip.com/mysql/1790.html)
check table user_order_logs;  
repair table user_order_logs;  
[redis突然挂掉后，无法启动，查看log日志，发现报Short read or OOM loading DB. Unrecoverable error, aborting now](http://blog.51yip.com/nosql/1791.html)

[root@localhost ~]# rm -f /var/lib/redis/dump.rdb  
[root@localhost ~]# rm -f /var/run/redis.pid  
[root@localhost ~]# service redis start  
[php 字符串算术表达式计算](http://blog.51yip.com/php/1846.html)

$aa = "{1}*{2}-{3}";  
$farr = array('/\{1\}/','/\{2\}/','/\{3\}/');  
$tarr = array(3,4,10);  
$str = preg_replace( $farr,$tarr,$aa);  
echo $str;        //结果：3*4-10  
echo eval('return '.$str.';');   //结果:2  
[mysql分区功能详细介绍，以及实例](http://blog.51yip.com/mysql/1013.html)
//到存放数据库表文件的地方看一下，my.cnf里面有配置，datadir后面就是  
[root@BlackGhost test]# ls |grep user |xargs du -sh  
4.0K    user#P#p0.MYD  
4.0K    user#P#p0.MYI  
4.0K    user#P#p1.MYD  
4.0K    user#P#p1.MYI  
4.0K    user#P#p2.MYD  
4.0K    user#P#p2.MYI  
4.0K    user#P#p3.MYD  
4.0K    user#P#p3.MYI  
4.0K    user#P#p4.MYD  
4.0K    user#P#p4.MYI  
12K    user.frm  
4.0K    user.par  
HASH分区主要用来确保数据在预先确定数目的分区中平均分布，你所要做的只是基于将要被哈希的列值指定一个列值或表达式，以 及指定被分区的表将要被分割成的分区数量。

1，分区可以分在多个磁盘，存储更大一点
2，根据查找条件，也就是where后面的条件，查找只查找相应的分区不用全部查找了
3，进行大数据搜索时可以进行并行处理。
4，跨多个磁盘来分散数据查询，来获得更大的查询吞吐量
[python Anaconda使用总结](http://python.jobbole.com/86236/)
[Python > 小白进阶之Scrapy第一篇](http://cuiqingcai.com/3472.html)

[把数组里的数按照指定的顺序重新排序](https://segmentfault.com/q/1010000008815093)
```js
https://xss.haozi.me/tools/xss-encode/
$arr1 = [0,1,3,7,9];

$arr2 = [1,0,9,3,7];

$arr3 = [];

for ($i=0; $i < count($arr1); $i++) { 
    for ($j=0; $j < count($arr2); $j++) { 
        if ($arr2[$j] == $arr1[$i]) {
            $arr3[$i] = $arr2[$j];
        }
    }
}

var_dump($arr3);
$a = array('a','b','c','d','e','f');

$b = array('b','a','e','c');

$c = [];

for ($i=0; $i < count($b); $i++) { 
    for ($j=0; $j < count($a); $j++) { 
        if ($a[$j] == $b[$i]) {
            $c[$i] = $a[$j];
        }
    }
}

var_dump($c);
```
[PHP设计模式问题](https://segmentfault.com/q/1010000008736793)

[JavaScript中的位运算符如|和&，有啥应用场景吗](https://segmentfault.com/q/1010000008810893)
```js
判断奇偶

//一般都是(i % 2 !== 0)来判断奇数
if(i & 1) {
    //奇数需要进行的事情
} else {
    //
}
交换数字

var temp = a;
var a = b;
var b = temp;

//可以用位操作符实现交换不需要中间变量

a ^= b; //a = a ^ b
b ^= a; //b = b ^ a = b ^ a ^ b = a (b = a)
a ^= b; //a = a ^ b = a ^ b ^ a = b;

-- bad
arr.indexOf(2) === -1
-- good
~arr.indexOf(2)
-- 订单状态判断，例如：1、2、4、8，表示四种状态，判断当前订单是否为1和2状态
-- bad
status === FLAG_1 || status === FLAG_2
-- good
(FLAG_1 | FLAG_2) & status
```
[JavaScript代码的解释：有关base64编码](https://segmentfault.com/q/1010000008811603)

Buffer.from("\x6a\x8a\x69\x65\xa1\x7d\xac\xae", 'binary').toString('base64')
>>> s = "\x6a\x8a\x69\x65\xa1\x7d\xac\xae"
>>> import base64
>>> base64.encodebytes(bytes(s,'utf8'))
b'asKKaWXCoX3CrMKu\n'
>>> base64.encodebytes(bytes(s,'l1'))
b'aoppZaF9rK4=\n'
[React比Vue.js好在哪？](https://segmentfault.com/q/1010000008810414)
[数据库查询排序问题，如何按字符串中的数字排序](https://segmentfault.com/q/1010000008762633)
ORDER BY CONVERT(SUBSTR(column, 6), SIGNED INTEGER) 
[关于 RESTful API 的设计](https://segmentfault.com/q/1010000008811387)
https://segmentfault.com/a/1190000008697972 
[javascript 匿名函数](https://segmentfault.com/q/1010000008810316)
```js
var trs = document.getElementsByTagName("tr");
for(var i = 0;i < trs.length;i++){
    (function changeColor(tr){
        tr.onmouseover = function(){
            tr.style.backgroundColor = 'grey';
        }
        tr.onmouseout = function(){
            tr.style.backgroundColor = 'white';
        }
    })(trs[i]);
}
```
[js怎样通过arr3把arr2变成arr4](https://segmentfault.com/q/1010000008809418)
```js
var arr2 = [{1: '1'}, {2: '2'}, {3: '3'}, {5: '5'}];

var arr3 = [{1: '1'}, {2: '2'}, {3: '3'}, {4: '4'}, {5: '5'}, {6: '6'}];

var arr4 = [];

var obj = {};
for (var i=0; i<arr2.length; i++) {
    var temp = arr2[i];
    for (var key in temp) {
        obj[key] = temp[key];
    }
}
for (var j=0; j<arr3.length; j++) {
    var temp = arr3[j];
    for (var key in temp) {
        if (obj[key]) {
            var subobj = {};
            subobj[key] = obj[key];
            arr4.push(subobj)
        } else {
            var subobj = {};
            subobj[key] = '0';
            arr4.push(subobj)
        }
    }
}
```
[JavaScript 俩数组,个数一样,怎么a数组升序对另一个数组排序?](https://segmentfault.com/q/1010000008812492)
```js
var a = [ 0 , 89 ,2 , 3];

var b = [ "san" , "si" , "wu" , "liu"];

var merge = a.map(function(ai, i){
    return {a:ai, b:b[i]};
})
merge.sort(function(am1, am2){
    return am1.a - am2.a
})
// 允许生成新的数组引用就用map, 要是不允许生成新的数组引用，就挨个赋值
b = merge.map(function(ab, i){
    return ab.b
}) 
console.log(b);

a.map(function(value,index){
    return {
        key:b[index],
        value:value
    }
}).sort(function(pre,next){
    return pre.value - next.value
}).map(function(value,index){
    return value.value;
});
```

[php 函数参数过多](https://segmentfault.com/q/1010000008749617)
```js
    /**
     * @see 可变数量的参数列表
     * 因函数调用顺序和类型，需要使用可变参数类型的传入形式，或者直接使用func_get_args
     *
     * @link http://php.net/manual/zh/functions.arguments.php#functions.variable-arg-list
     *
     * @param array ...$_p 可变参数列表
     * @return mixed
     * @throws Exception
     */
    protected function request(...$_p)
    {
        // 无效请求
        if (!count($_p)) {
            throw new Exception("empty params\n");
        }

        $actionName = array_shift($_p);

        // 记录日志用
        $p_ = implode(',', $_p);
        do {
            try {
                $response = json_decode(call_user_func_array([self::$_client, $actionName], $_p), true);
                if (isset($response['code']) && $response['code'] == 0) {
                    return $response['data'];
                }
                error_log("{$this->serviceName}->{$actionName}({$p_}) Error Times({$this->times}) Message: {$response['message']}");
            } catch (Exception $e) {
                error_log("Exception Times({$this->times}), {$this->serviceName}->{$actionName}({$p_}): {$e->getMessage()}");
                sleep(2);
            }
        } while ($this->times--);
        throw new Exception("{$this->serviceName}->{$actionName}({$p_}) Repeat Failed\n");
    }
    fn( [
  'name' => '',
  'age' => 10,
  'sex' => MALE,
  'height' => 180,
  'weight' => 110,
  ....
]);
```
[sql问题（店铺 商家 活动的sql）](https://segmentfault.com/q/1010000008744776)

select shopname,level,group_concat(actname) from(select shop.shopname,user.level,activity.actname from shop inner join user on shop.shopid = user.shopid inner join activity on shop.shopid = activity.shopid) group by shopname,level

[一道关于集合的算法问题](https://segmentfault.com/q/1010000008780141)
[git 本地项目上传到远程仓库出错](https://segmentfault.com/q/1010000008587914)
远程remote master有更新，先执行 git pull origin master
rebase 代码有冲突

先git status 看看冲突的文件，核对下，解决掉冲突

再git rebase --continue

再git pull origin master

再git push origin master
退出之前的rebase过程

git rebase --abort
[如何在不使用ajax的情况下，使用原生js实现对服务器的请求？](https://segmentfault.com/q/1010000008724115)
你了解AJAX是怎么兴起的就会明白了，远古时代的程序员不使用ajax如何异步的从服务器获取数据？答案很简单，就是使用隐藏iframe技术，正是这种技术的广泛使用才产生了XMLHttpRequest。

你只需要动态创建一个iframe，改变他的src为请求地址，在服务器返回响应后，通过innerHTML等js操作获取响应内容即可。

在ajax2.0出来之前，它是不支持上传文件的，而当时许多流行的异步文件上传jQuery插件就是动态创建iframe结点，等返回响应后再将其删除。现在因为一些兼容性的问题，这些插件仍然在大量使用。相关的资料可
[这么优美的代码格式](https://segmentfault.com/q/1010000008709847)
```js
1.多个参数用逗号分隔，且逗号后加一个空格；参数的结束括号和大括号之间加一个空格；运算符前后各加一个空格。

function testFunc(arg1, arg2) {
    return arg1 + arg2;
}
2.同行内的分号后加一个空格

for(var i = 0; i < 10; i++) {
    console.log('Index:', i);
}
3.如果使用ES6的解构取值，在大括号内的两边各一个空格

import React, { Component, PropTypes } from 'react';

const { params } = this.props;
4.Object对象的key、value书写的时候，在“:”后加一个空格

const obj = {
    loading: false,
    params: {
        page: 1,
        page_size: 20,
        keyword: ''
    }
};
5.Object对象的key、value写在同一行时

const obj = { loading: false, params: { page: 1, page_size:20, keyword: '' } };
```
[js小数相加问题](https://segmentfault.com/q/1010000008724656)
```js
假设十进制数字为整数10，在计算机中表示方式为 : 1010,二进制转换十进制的方法为:

1 * 2^3 + 0 * 2^2 + 1* 2^1 + 0* 2^0 = 10
即为：

8 + 0 + 2 + 0 = 10
那么小数的表示方法,假设10进制数为0.5，在计算机中表示为0.1，因为计算机只有0和1这两位，而换算方法为:

1 * 2^-1 = 0.5
同理可见计算机能表示的浮点数有哪些 ：

    0.5 = 1 * 2^-1
    0.75 = 1 * 2^-1 ＋1 * 2^-2
    0.25 = 0 * 2^-1 ＋1 * 2^-2
    0.875 = 1 * 2^-1 ＋1 * 2^-2 + 1 * 2^-3
    0.9375 = 1 * 2^-1 ＋1 * 2^-2 + 1 * 2^-3 + 1 * 2^-4 
同理可见，0.2在计算机中表示为 :

 0.00110011000110...  后续位数你可以自己算，所以在计算机中0.2的表示方法只是一个无线接近于0.2的小数，但永远无法精确的表示出0.2，所以0.2 + 0.1 ≈ 0.3，而永远不会等于0.3
```

[腾讯alloyteam团队前端代码规范](http://www.kancloud.cn/digest/code-guide/42600)
[PHP打印预览](https://segmentfault.com/q/1010000008728432)
http://www.lodop.net/LodopDemo.html
[npm install [-g] prettier](https://github.com/prettier/prettier)


[go语言可以用来做桌面软件](https://segmentfault.com/q/1010000007518617)
如果只兼容windows，那么只有一个选择：

https://github.com/lxn/walk
[php session redis](https://segmentfault.com/q/1010000008721376)
[2个空数组相加会得到一个空字符串](https://segmentfault.com/q/1010000008707667)
```js
[] + [] = "";
[] + [] * 5 = "0";
[]+[]=''        在+运算中 []被转化为''
1+'1'='11'
1+'n'='1n'
+在进行默认转化时，会往字符串转化，简单来说就是能转字符串的通通都转化成字符串，所以在运算时小心+号。
因为这是一个表现独特的运算符。（毕竟js获取到的用户输入通常都是字符串，容易误操作）

[]-[]=0        在-，*运算中[]被转化为0
1-[]=0
1*[]=0
'1'-0=1
'n'-1=NaN
'1'*1=1
上面可以看出来，-号*号啊等其他一些常用运算符，都会进行偏向数字的转化。
所以通常还能用n*1或n-0进行字符串转数字。

在其他地方，比如 if 中，[]因为是一个对象，所以会转化成true.
```
[PHP设计模式(二)：抽象类和接口](https://segmentfault.com/a/1190000004699158)

https://segmentfault.com/q/1010000008801822
[mysql5.7 安装后无法设置密码](https://segmentfault.com/q/1010000008801677)
```js
对于MySQL 5.7：在服务器的初始启动时，出现以下情况，假定服务器的数据目录为空：
服务器已初始化。
SSL证书和密钥文件在数据目录中生成。
该 validate_password插件安装并启用。
'root'@'localhost' 创建 超级用户帐户。超级用户的密码被设置并存储在错误日志文件中。要显示它，请使用以下命令：
shell> sudo grep 'temporary password' /var/log/mysqld.log
通过使用生成的临时密码登录并为超级用户帐户设置自定义密码，尽快更改root密码：
shell> mysql -uroot -p 
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'MyNewPass4!';
注意
默认情况下 安装MySQL的 validate_password插件。这将要求密码至少包含一个大写字母，一个小写字母，一个数字和一个特殊字符，并且总密码长度至少为8个字符。
```
[背包算法问题。运用动态规划就可以解决](https://segmentfault.com/q/1010000008804655)
```js
<?php

$bag     = array();
$objects = array(
    array('w' => 100, 'p' => 100),
    array('w' => 200, 'p' => 200),
    array('w' => 300, 'p' => 300),
    array('w' => 400, 'p' => 400),
    array('w' => 500, 'p' => 500)
);

//初始化包的状态,-1没有组合成这个大小的包的组合方案
for ($i = 1; $i <= 1000; $i++) {
    $bag[$i] = -1;
}

//空包肯定是存在解决方案的,放入0件物品
$bag[0] = 0;
for ($i = 0; $i <= 4; $i++) {
    for ($j = 1000; $j >= $objects[$i]['w']; $j--) {
        //假如$bag[$j - $objects[$i]['w']]存在组合方案,那就与当前$bag[$j]的组合方案比较,取其中物品件数较多的那种
        if($bag[$j - $objects[$i]['w']] != -1) {
            $bag[$j] = $bag[$j - $objects[$i]['w']] + 1 > $bag[$j] ? $bag[$j - $objects[$i]['w']] + 1 : $bag[$j];
        }
    }
}

echo $bag[1000] == -1 ? "不存在装满包的解决方案" : "在保证装满的前提下,最多可以装{$bag[1000]}件物品";
```
[PHP:用Face++ 接口人脸识别](https://segmentfault.com/q/1010000008807273/a-1020000008808251)
```js
$api_key = "cK25pkbERhS8UoPWw2dBKWsNnGPdn6vG";
$api_secret = "oo8swPRXW3bwV_JxSBGO6sjK-b-wemyI";

$detect_api_url  ="https://api-cn.faceplusplus.com/facepp/v3/detect";

//image_url 
$image_url = "https://bj-mc-prod-asset.oss-cn-beijing.aliyuncs.com/mc-official/images/demo/demo-pic11.jpg";

//image_file
$image_file = "chen.jpg";
// $image_info = getimagesize($image_file);
// $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
// $image_file = base64_encode($image_data);

$return_landmark = "1";
$return_attributes="gender";

$url = "{$detect_api_url}";

$data = [
    "api_key" => "{$api_key}",
    "api_secret" => "{$api_secret}",
    "image_url" => "$image_url",
    // "image_file" => "$image_file",
    "image_file" => new CURLFile(realpath($image_file)),
    "return_landmark" => "{$return_landmark}",
    "return_attributes" => "{$return_attributes}"
];
// $data= http_build_query($data);
//初始化一个cURL会话
$ch = curl_init();

//
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在

//设置请求选项
curl_setopt($ch, CURLOPT_URL, $detect_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER,0);

//这是请求类型
curl_setopt($ch, CURLOPT_POST, TRUE);
//添加post数据到请求中
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);

//错误处理
if($response == FALSE){
    echo "错误信息:".curl_error($ch)."<br/>";
}
//获取curl请求的具体信息
$curl_info = curl_getinfo($ch);
echo "收到的http回复的code:".$curl_info["http_code"]."<br/>";
//

echo '<pre>';
curl_close($ch);
//输出返回信息
print_r(json_decode($response,1));
```


[json文本换行 \n符](https://segmentfault.com/q/1010000008807399)
分清字符串“\n”和换行符\n，在原始的字符串中，\n表示一个字符，一个换行符，而你在用正则匹配的是一个字符串“\n”，自然匹配失败

var content="纤云弄巧，飞星传恨，银汉迢迢暗度。\n金风玉露一相逢，便胜却、人间无数。";
console.log(content.replace(/\n/g,'<br />'));
//纤云弄巧，飞星传恨，银汉迢迢暗度。<br />金风玉露一相逢，便胜却、人间无数。
//不过得到的是普通字符串哦


定时跑数据，每次1000
```js
$lastKey = 'lastid';
$minId = \RedisFacade::get($lastKey);
        if (!$minId) {
            $minId = 0;
            \RedisFacade::set($lastKey, $minId);
        }
while (true) {
            $demands = user::where('id', '>', $minId)->where('user_id', 14)
                ->select('id', 'vid', 'user_id')
                ->orderBy('id')
                ->take($limit)
                ->get();

            $selectCount = count($demands);
            if (!$selectCount) {
                \RedisFacade::set($lastKey, $minId);
                break;
            }

            foreach ($demands as $value) {
            	// if (!($record = RedisFacade::get('demand:records:push:'. $value['id']))) {
                	\Queue::push(new DemandRecords($value['vid'], $value['baoli']['baoli_id'], $value['baoli']['secretkey']));
                	// RedisFacade::setEx('demand:records:push:'. $value['id'], 86400, $value['id']);
            	// }
            }

            if ($selectCount < $limit) {
                break;
            }

            $minId = $demands->last()->id;
            unset($demands);

            if ($usleep > 0) {
                usleep($usleep);
            }
        }

```



[清博指数的API接口](https://segmentfault.com/q/1010000008796281)
清博指数获取公众号文章API
[算法问题，2个数组，数组a保存1000W条手机号，数组b保存5000W条，找出两个数组相同的手机号](https://segmentfault.com/q/1010000008169527)
[假定有json数据多条记录，如何根据KEY的值返回一条记录](https://segmentfault.com/q/1010000008793933)
```js
s = """
[
  {
    "Name": "A1", 
    "No": "3111", 
    "createDate": "9999/12/31 00:00:00", 
    "lastUpdDate": "9999/12/31 00:00:00"
  }, 
  {
    "Name": "B2", 
    "No": "2222", 
    "createDate": "9999/12/31 00:00:00", 
    "lastUpdDate": "9999/12/31 00:00:00"
  }, 
  {
    "Name": "C3", 
    "No": "1444", 
    "createDate": "9999/12/31 00:00:00", 
    "lastUpdDate": "9999/12/31 00:00:00"
  }, 
  {
    "Name": "C4", 
    "No": "0542", 
    "createDate": "9999/12/31 00:00:00", 
    "lastUpdDate": "9999/12/31 00:00:00"
  }
]
"""
# code for python3

import json

def search(json_str, no):
    return [datum for datum in json.loads(s) if datum['No']==no]

datum = search(s, '0542')
print(datum)
```
[微信中，复制内容添加到剪贴板！](https://segmentfault.com/q/1010000008789082)
clipboard实际是调用 document.execCommand('copy'); 来达到复制的目的。

而对于微信内的浏览器嘛，你自己看移去端的兼容性吧，IOS下并不支持，总之支持的极少。
[document mouseup 事件](https://segmentfault.com/q/1010000008794799)
```js
 你每按下一次鼠标就加了一个mouseup事件，然后就越来越多越来越多。
可以在mouseup的回调里把mouseup事件绑定解除了。

或者这样,做个简单的判断

document.addEventListener('mousedown',function(){
    if(document.eventMouseup){
        return false
    }else{
        document.addEventListener('mouseup',(event)=>{
            console.log(1);
        },false);
        document.eventMouseup = true;
    }   
},false)

```
[如何判断浏览器是否支持localstorage](https://segmentfault.com/q/1010000008793630)
```js
typeof localStorage 和 if(window.localstorage) 的检测都太弱
假如我就故意设置 window.localStorage = {} 一样没有存储效果。

另外据说Safari隐私模式下 localStorage 依然有效但是无法存储，没验证过，有mac的同学可以验证一下我的道听途说。

window.localStorage && (window.localStorage.setItem('a', 123) , window.localStorage.getItem('a') == 123)
```
[Sql union 操作](https://segmentfault.com/q/1010000008793674)
```js
(select  du.day,du.apptoken ,du.version, du.channel,du.city,du.count,concat(apptoken, 

version,channel,city) as joinkey from day_new_users_count du where day='20170319') as dayUsers 

 union 

(select tu.day,tu.apptoken,tu.version,tu.channel,tu.city,tu.count,concat(apptoken,version,channel,city) as joinkey from total_users tu where day='20170318') as toUsers

select  du.day,du.apptoken ,du.version, du.channel,du.city,du.count,concat(apptoken, version,channel,city) as joinkey from day_new_users_count du where day='20170319'
 union 

select tu.day,tu.apptoken,tu.version,tu.channel,tu.city,tu.count,concat(apptoken,version,channel,city) as joinkey from total_users tu where day='20170318'

select * from (
select
du.day, du.apptoken , du.version, du.channel, du.city, du.count,
concat(apptoken, version,channel,city) as joinkey
from day_new_users_count du
where day='20170319'
) as dayUsers
union
select * from (
select
tu.day,  tu.apptoken, tu.version, tu.channel, tu.city, tu.count,
concat(apptoken,version,channel,city) as joinkey
from total_users tu
where day='20170318'
) as toUsers
```
[php 登录界面session问题](https://segmentfault.com/q/1010000008793648)
```js
$.ajax({
   url : 'functions/php/login.php?action=get_login_info',
   type : 'get',
   success : function(data){
     if( '' != data){
       //更新导航
       $(".user-menu").append(data);
     }
   }
});
functions/php/login.php 中：

if( isset($_GET['action']) && 'get_login_info' == $_GET['action'] ){
    if( isset($_SESSION['id']) ){
        //链接数据库
        $sql = "SELECT * FROM user WHERE email= '" . $_SESSION['id'] . "'";
        //查找用户信息
        
        //你的代码，输出登陆后的导航
    }
    die();
}
```
[]()


[前端图片压缩成base64文件上传问题](https://segmentfault.com/q/1010000008790807)
```js
var canvas = document.getElementById("canvas");

canvas.toBlob(function(blob) {
  var formData = new FormData();
  formData.append('img', blob, 'canvas.jpg');
  //然后把这个formData扔给ajax就好了。babababa
});https://www.noway.pub/p/94.html
```

[js从数组中取出来数组的一半让他们的和最接近整个数组的和的一半](https://segmentfault.com/q/1010000008789474)
https://www.zhihu.com/question/27896075
[浏览器的两个页面之间通信的问题](https://segmentfault.com/q/1010000008792568)
postMessage API
支持两个页面跨域；只能传递字符串数据；参考 window.open；

直接引用
适用于两个页面在同一域；可以传递对象数据（对象数据使用 instanceof 做类型判断时有坑）；参考 window.open；

WebSocket 服务器中转
需要页面都与服务器建立 WebSockets 连接；支持跨域；参考 WebSocket

localStorage 事件
要求两页面在同一域；数据可以通过 localStorage 传递；参考 localStorage 的 'storage' 事件；
[为什么递归里 return后方法会继续循环,用dd打印反倒是可以输出正确的数组形式?](https://segmentfault.com/q/1010000008755555)

```js
    public static function foreachComments($comments, $arr_id = array(0), $arr_comments = [])
    {
        $arr = $comments;
        $s_comments = &$arr;
//        //一个全局的变量 保存循环出来的数组,
//        //一个全局的ID变量数组,保存每次循环出来的数组的ID
        foreach ($comments as $key => $value) {
            $a = $value->father_id;
            //数组取值为空??!!
            $b = $arr_id[count($arr_id) - 1];
            if ($a == $b) {
                $arr_comments[count($arr_comments)] = $comments[$key];
                $arr_id[count($arr_id)] = $value->id;
                $s_comments = array_except($comments, $key);
                self::foreachComments($s_comments, $arr_id, $arr_comments);//这里也是在调用自身
            }

        }

        $arr_id = array_except($arr_id, count($arr_id) - 1);
        if (count($arr)==0) {
            dd($arr_comments);//在这里return后会继续往下执行...
        }
       self::foreachComments($s_comments, $arr_id, $arr_comments);//这里也是在调用自身
    }
      
    函数return 后会把执行权交给函数调用处. dd函数是终止程序并打印结果,所以你用DD当然可以打印出结果啊.
```
[做了一题JS面试题](https://segmentfault.com/q/1010000008703575)
```js
var o = [].reduce.call('cbaacfdeaebb',function(p,n){
          return p[n] = (p[n] || 0) + 1,p;
       },{}),
   s = Object.keys(o).reduce(function(p,n){
       return o[p] <= o[n] ? p : n;
   });
   console.log(s,o[s]); 
   
https://segmentfault.com/q/1010000008745355   
 LazyMan('Hank'); 输出
Hi Hank!

LazyMan('Hank').eat('dinner');输出
Hi Hank!
Eat dinner!

LazyMan('Hank').sleep(5).eat('dinner'); 输出：
Hi Hank!
//等待五秒
Eat dinner!

LazyMan('Hank').sleepFirst(5).eat('dinner');输出：
//等待五秒
Hi Hank!
Eat dinner!  
 function LazyMan(nick){
    var obj = {
        task : {
            list : [],
            add : function(fun, timer){
                timer = timer || 0;
                this.task.list.push({
                    fun : fun,
                    timer : timer
                });
                return this;
            },
            run : function(){
                if( this.task.list.length > 0 ){
                    setTimeout( (function(){
                        this.task.list.shift().fun.call(this);
                    }).bind(this), this.task.list[0].timer );
                }else{
                    this.echo("[Task]", "==========Stop==========");
                }
            }
        },
        echo : function( str , str2 ){
            console.log( str + ' ' + str2 );
            return this;
        },
        hello : function( nick ){
            return this.task.add.call(this, function(){
                this.echo('Hi', nick);
                this.task.run.call(this);
            });
        },
        eat : function( eat ){
            return this.task.add.call(this, function(){
                this.echo('Eat', eat);
                this.task.run.call(this);
            });
        },
        sleep : function( timer ){
            return this.task.add.call(this, function(){
                this.echo("[Timer( sleep )]", timer);
                this.task.run.call(this);
            }, timer * 1000);
        },
        sleepFirst : function( timer ){
            var fun = this.task.list[0].fun;
            this.task.list[0].fun = function(){
                setTimeout((function(){
                    this.echo("[Timer( sleepFirst) ]", timer);
                    fun.call(this);
                }).bind(this), timer * 1000);
            };
            return this;
        }
    };
    obj.echo("[Task]", "==========Start==========").hello(nick).task.run.call(obj);
    return obj;
};

LazyMan("A").sleepFirst(1).eat("abc").sleep(4).sleep(5).eat("A").eat("B").eat("C")  
```
[如何对10亿个QQ号进行去重？](https://segmentfault.com/q/1010000008798404)

[mysql将这过去24小时分成10等分，一条SQL查询出10条记录](https://segmentfault.com/q/1010000008098144)
[call_user_func()函数](https://segmentfault.com/q/1010000008797338)
```js
function test() {
    echo "hello test";
}
call_user_func(function(){
    test();
});
//或者以字符串形式传入函数名
call_user_func("test");

class Foo {
    public function bar() {
        echo "Hello bar!";
    }
}
$obj = new Foo();
call_user_func(array($obj, "bar"));

class Foo {
    public static function getInitializer() {
        return "hello";
    }
}

function hello() {
    echo "world!";
}

call_user_func(Foo::getInitializer());
```
[深入学习的前端知识](https://segmentfault.com/q/1010000008796151)
```js
function DecideToLeave(){
    if( Are_U_Sure_U_Are_Not_Gonna_Learn_What_U_Want(in_this_company) == true ){
        if(No_Financial_Dep_On_ThisJob){
            if( Can_U_Find_The_Target_Company(ur_current_background, company_situation) == true ){
                return true;
            } else {
                if( Will_Work_In_This_Company_Affect_Ur_Learning(ur_learning_plan) == true ) {
                    return true
                } else {
                    setTimeout( DecideToLeave, SOMETIME_LATER)
                    return undefined;
                }
            }
        } else {
            return false;
        }
    } else {
        setTimeout( DecideToLeave, SOMETIME_LATER)
        return undefined;
    }
}
《程序员的成长路线》

```
[在国内如何快速部署docker开放环境？](https://segmentfault.com/q/1010000008700675)
[windows下用WPF制作的nginx，php，mysql集成环境](https://github.com/salamander-mh/SalamanderWnmp)
https://segmentfault.com/q/1010000008795166 

[如何根据数据库中的某一个字段查询其在表中相同值所对应的另外一个字段的和？](https://segmentfault.com/q/1010000008798524)
select '藏品编号',sum('交易总额') from tablename where '创建时间'>'时间1' and '创建时间'<'时间2' group by '藏品编号';
[python else](https://segmentfault.com/q/1010000008798723)
```js
n = 17
for d in range(2,n):
    if n % d == 0:
        print(n, '是合数')
        break
else:
    print(n, '是素数')
    
    没有else的话我们应该加个bool变量，for循环后还加个if/else。用for/else的话简单多了。
```
[pandas读取中文的时候乱码 要如何解决](https://segmentfault.com/q/1010000008108689)
```js
#coding=utf-8

import pandas as pd
import sys

reload(sys)
sys.setdefaultencoding("utf-8")

df = pd.read_csv('week1.csv', encoding='utf-8', nrows=10)

print df
```
[python selenium](https://segmentfault.com/q/1010000008796785)
```js
from selenium import webdriver

browser = webdriver.Chrome()
browser.get('http://www.manhuatai.com/doupocangqiong/191.html')
img=browser.find_element_by_xpath('//img[@data-bd-imgshare-binded="1"]')
print img.get_attribute('src')
# 即打印出:
# http://mhpic.zymk.cn/comic/D%2F%E6%96%97%E7%A0%B4%E8%8B%8D%E7%A9%B9%2F191%E8%AF%9DSM%2F1.jpg-mht.middle
```
