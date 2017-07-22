[PHP开发接口如何将null值转字符串的空?](https://segmentfault.com/q/1010000010171343)
```js
// 注意&引用赋值
array_walk_recursive($array, function (& $val, $key ) {
    if ($val === null) {
        $val = '';
    }    

});
function ttt($val) {
    return is_null($val) ? '' : $val;
}
$tt = array(1, 2, 3, null, 4, null, 5);
var_dump(array_map('ttt', $tt));
/**
 * 将数组中的null转为字符串''
 * @param $arr
 */
function nulltostr($arr)
{

    foreach ($arr as $k=>$v){
        if(is_null($v)) {
            $arr [$k] = '';
        }
        if(is_array($v)) {
            $arr [$k] = nulltostr($v);
        }
    }
    return $arr;
}
array_filter是只能去除掉一维的数组的null
print_r(nulltostr([1,null,[3,4,null]]));
function null_filter($arr)
{
    foreach($arr as $key=>&$val) {
        if(is_array($val)) {
            $val = null_filter($val);
        } else {
            if($val === null){
                unset($arr[$key]);// 不能unset($val)
              }
        }
    }
    return $arr;
}
```
[163 邮箱钓鱼网站](https://www.v2ex.com/t/376725)
```js
#!/bin/bash 
# filename: test.sh 

while true 
do 
curl -X POST 'http://flumw.nxusepd.pw/laqhmu/a.asp' --data $'qqid=test&qqpwd=123&face=163\u90ae\u7bb1'
done 



seq 1 20 | xargs -n 1 -P 20 sh test.sh
https://whois.aliyun.com/whois/domain/nxusepd.pw?spm=5176.8076989.763973.115.665faf4b4Qcyvk&file=nxusepd.pw 

详细英文信息里 的手机和邮箱
```
[ping google, 但是不能 ping youtube](https://www.v2ex.com/t/374188)
```js
Terminal 一般不使用系统代理，所以你需要找一下 Terminal 使用代理的方法。 

可以 Ping Google 并不代表翻出去了，一种可能就是 DNS 污染  ping 用的是 ICMP，而 ss 只能代理 TCP 和 UDP，所以用 ping 来测试能否代理是不可行的。要让终端走 ss-local 代理的话可以先执行 export ALL_PROXY=socks5://127.0.0.1:1080。这个命令在 macOS 下亲测有效，如果所用的系统不支持的话恐怕得先转换成 http 代理。这样的话终端应该就可以通过代理连接了，不过该 ping 不通的依然不行。（实在想 ping 的话可以考虑一下走 TCP 的 httping / psping ）
proxychain 之类的工具让命令行应用也能走 ss 代理
使用 privoxy 将代理转成 HTTP，然后在命令行输入 export http_proxy=http://127.0.0.1:端口号 。 
之后输入命令，都是使用代理连接网络  
shadowsocks实质上也是一种socks5代理服务，类似于ssh代理。与vpn的全局代理不同，shadowsocks仅针对浏览器代理，不能代理应用软件，比如youtube、twitter客户端软件。如果把vpn比喻为一把屠龙刀，那么shadowsocks就是一把瑞士军刀，轻巧方便，功能却非常强大https://segmentfault.com/a/1190000004607285 
brew install proxychains-ng
socks5 127.0.0.1 1080
proxychains4 curl google.com 

```




[gitbook](https://www.gitbook.com/@ninghao)
如何查看 Linux是32位还是64位http://justcode.ikeepstudying.com/2015/06/%e5%a6%82%e4%bd%95%e6%9f%a5%e7%9c%8b-linux%e6%98%af32%e4%bd%8d%e8%bf%98%e6%98%af64%e4%bd%8d%ef%bc%9f/
执行命令 file /sbin/init 即是32位的 Linux, 若是64位的, 显示的是 64-bit
uname -a
如何直接在github上预览html网页效果 http://justcode.ikeepstudying.com/2016/08/%e5%a6%82%e4%bd%95%e7%9b%b4%e6%8e%a5%e5%9c%a8github%e4%b8%8a%e9%a2%84%e8%a7%88html%e7%bd%91%e9%a1%b5%e6%95%88%e6%9e%9c/
http://htmlpreview.github.com/?https://github.com/aisinvon/VerticalMiddleForUnknownHeightDiv/blob/master/Set-Unknown-Height-Div-to-Vertical-Middle.html
Linux umask限制导致php的mkdir 0777无效http://justcode.ikeepstudying.com/2015/04/linux-umask%e9%99%90%e5%88%b6%e5%af%bc%e8%87%b4php%e7%9a%84mkdir-0777%e6%97%a0%e6%95%88/
这两天在写一个缓存模块，需要把生成的缓存目录和文件设置成777权限，好让ftp用户可以直接登录删除缓存，蛋疼的事也就这么发生了，明明用了mkdir($path, 0777);用ftp用户登录却删除不了，为什么呢？
重试3次
```js
public function handle()
    {
        if (!$this->keyword) {
            return;
        }

        $search = SearchHistory::getInfoByUserIdAndKeyword($this->userId, $this->keyword);
        if ($search) {
            $search->increment('times', 1);
        } else {
            try{
                SearchHistory::create(['user_id' => $this->userId, 'keyword' => $this->keyword, 'times' => 1]);
            }catch (\Exception $e){
                if($this->retryCount < 3){
                    \Log::info('app search keyword retry', ['userId'=>$this->userId, 'keyword'=>$this->keyword, 'retryCount'=>$this->retryCount]);
                    sleep(1);
                    $this->retryCount = $this->retryCount + 1;
                    return $this->handle();
                }else{
                    \Log::warning('app search keyword error', ['msg'=>$e->getMessage(), 'file'=>__FILE__, 'line'=>__LINE__]);
                    return false;
                }
            }
        }
        RedisFacade::zIncrBy('user:search:history', 1, $this->keyword);
    }
    
    public static function getInfoByUserIdAndKeyword($userId, $keyword){
        return \Cache::remember(self::CACHE_KEY_USER_ID_KEYWORD . $userId.':'.$keyword, self::CACHE_KEY_USER_ID_KEYWORD_TIME, function() use($userId, $keyword) {
            return SearchHistory::where(['user_id' => $userId, 'keyword' => $keyword])->first();
        });
    }
    加锁
    public function waitByEmail($webinarId, $email){
        $redis = Redis::getInstance();
        $cacheKey = self::CACHE_WEBINAR_WAIT_BY_EMAIL . $webinarId . ':' . $email;
        $concurrent = $redis->inc($cacheKey);
        $redis->setTimeout($cacheKey, 1);//http://www.cnblogs.com/weafer/archive/2011/09/21/2184059.html 
        if($concurrent > 1){
            usleep(200000);
        }
    }
    //$redis->setTimeout(997, 10);//设置10秒自动超时过期
$redis->expireAt(997, time()+10);//设置具体的时间戳后过期
$arr = [1,2,3];
$res = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
    ];
    
    
    
    print_r(array_combine($arr,$res));
    Array
(
    [1] => Array
        (
            [id] => 1
            [name] => test
        )

    [2] => Array
        (
            [id] => 2
            [name] => test2
        )

    [3] => Array
        (
            [id] => 3
            [name] => test3
        )

)
$items = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
        ['id'=>3,'name'=>'test3'],
        
    ];
    $res = [];
        // 分组
        foreach ($items as $key => $value) {
            if (isset($res[$value['id']])) {
                $res[$value['id']][] = $value;
            } else {
                $res[$value['id']] = [$value];
            }
        }
    print_r($res);
Array
(
    [1] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => test
                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [id] => 2
                    [name] => test2
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => test2
                )

        )

    [3] => Array
        (
            [0] => Array
                (
                    [id] => 3
                    [name] => test3
                )

            [1] => Array
                (
                    [id] => 3
                    [name] => test3
                )

        )

)
```
 

查看了一下建立的目录的权限，发现mkdir建立的目录权限都是755的，我明明用的是777，立马google了一下，才知道原来是受Linux 系统的 umask限制了，Linux的umask默认值是0022，所以php 的 mkdir 函数只能建立出755权限的文件夹出来。

小Tips：查看Linux的umask值直接在终端输入命令umask就可以看到
$oldmask = umask(0);
mkdir("test", 0777);
umask($oldmask);

PHPCoverage是一款基于xdebug实现的PHP代码覆盖率统计工具](https://packagist.org/packages/woojean/php-coverage)
composer require woojean/php-coverage 安装失败 把 "lokielse/omnipay-alipay": "1.0.1", 改为 1.0.4 版本就好了
[Linux/Ubuntu: 使用 trash-cli 防止 rm 命令误删除重要文件](http://justcode.ikeepstudying.com/2015/11/ubuntu-%e4%bd%bf%e7%94%a8-trash-cli-%e9%98%b2%e6%ad%a2-rm-%e5%91%bd%e4%bb%a4%e8%af%af%e5%88%a0%e9%99%a4%e9%87%8d%e8%a6%81%e6%96%87%e4%bb%b6/)
pip install trash-cli
![php](https://i.loli.net/2017/07/19/596ec2f497afa.jpg)
[Ngrok NatApp 微信本地化调试利器](http://www.54php.cn/default/211.html)
[PHP命令行参数](http://php.swoole.com/wiki/PHP%E5%91%BD%E4%BB%A4%E8%A1%8C%E5%8F%82%E6%95%B0)
```js
php --re swoole
显示某个扩展提供了哪些类和函数。

php --ri swoole
显示扩展的phpinfo信息
php --rf file_get_contents
显示某个PHP函数的信息，一般用于检测函数是否存在

生产者消费者模式http://php.swoole.com/wiki/PHP_%E4%B8%8E_%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F
//生产者，每秒钟向queue写入一个数字
$n = 1;
while(1){
	echo $n.chr(10);//chr(10)  \n
	file_put_contents('queue', $n.chr(10));
	$n++;
	sleep(1);
}
//消费者，每秒消费queue文件中的数据
$file = 'queue';
while (1){
	if(is_file($file)){
		$tmp_file = 'queue_tmp';
		rename('queue', $tmp_file);//重命名文件，保证在读取不被生产者程序干扰
		//读取文件，进行处理
		$content = file($tmp_file);
		foreach ($content as $value){
			echo $value;//输出结果
		}
		unlink($tmp_file);
	}
	sleep(1);
}


```
[线上PHP问题排查思路与实践](http://www.bo56.com/%E7%BA%BF%E4%B8%8Aphp%E9%97%AE%E9%A2%98%E6%8E%92%E6%9F%A5%E6%80%9D%E8%B7%AF%E4%B8%8E%E5%AE%9E%E8%B7%B5/)
[工具（草稿）](https://ninghao.net/blog/3502)
https://git.ninghao.net/commit.html 
[API 开发者福利--API 在线管理](https://laravel-china.org/topics/3086/api-developer-welfare-api-online-management-simulation-request-test-the-documentation-tool-apizza)
http://apizza.cc/?f=lv 
[【php爬虫】百万级别知乎用户数据爬取与分析](http://www.hoohack.me/2015/09/30/php-spider-millons-of-zhihu-user-analyze)
[Laravel的核心概念](https://lufficc.com/blog/the-core-conception-of-laravel)
[Redis持久化-RDB](https://wenchao.ren/archives/165)
手动触发RBD主要使用save和bgsave命令 redis配置文件中使用了save m n （表示m秒内进行了n次数据修改）
从节点执行全量复制操作的时候，主节点会自动触发bgsave命令生存rdb文件并发送给从节点
 RDB文件是一个压缩过的二进制文件 没办法做到实时/准实时的持久化 非常适合备份，全量复制等场景
 背包问题，背包总容量 80 ，每次放东西的权重 a1*b1 ，求解正好放满背包的方案
 http://ss.ishadowx.com/ 
 
