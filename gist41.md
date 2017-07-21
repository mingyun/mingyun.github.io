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
 
