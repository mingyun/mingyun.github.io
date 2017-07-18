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






