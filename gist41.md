[PHPCoverage是一款基于xdebug实现的PHP代码覆盖率统计工具](https://packagist.org/packages/woojean/php-coverage)
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
 
