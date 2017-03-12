###[解压文件](http://stackoverflow.com/questions/3263129/unzipping-larger-files-with-php)
```js
图片解压后导致 php 内存溢出
$filename = 'c:\kosmas.zip';
        $archive = zip_open($filename);
        while($entry = zip_read($archive)){
            $size = zip_entry_filesize($entry);
            $name = zip_entry_name($entry);
            $unzipped = fopen('c:/unzip/'.$name,'wb');
            while($size > 0){
                $chunkSize = ($size > 10240) ? 10240 : $size;
                $size -= $chunkSize;
                $chunk = zip_entry_read($entry, $chunkSize);
                if($chunk !== false) fwrite($unzipped, $chunk);
            }

            fclose($unzipped);
        }
        
        $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
 fwrite($fp,"$buf");
浮点数 http://0.30000000000000004.com/
 
```
###[前端的甩锅指南](https://zhuanlan.zhihu.com/p/25649277)
如果不在浏览器上，写爬虫脚本的话需要自己把 Cookie 这个 header 带上。很多的 web server 是借助 Cookie 作为用户会话的凭证的，比如存一个唯一的 sessionid 值到 Cookie，每次请求都带上，来判断是哪个用户。如果不用 Cookie 作为会话认证，还有其他方式吗？其实说到底认证就是需要传给服务端有个字段标识哪个用户，那我们可以在头里面加个 Authorization 的字段，其他名字也行，只要跟服务端商量好。
加一些 http 的头也能有效的防御攻击，比如 csp(Content Security Policy)
###[php原生的引擎](https://www.zhihu.com/question/39711044)
```js
作者：鲍国枭
链接：https://www.zhihu.com/question/39711044/answer/83008437
来源：知乎
著作权归作者所有，转载请联系作者获得授权。

这个是模板文件
<h1><?=$title?></h1>
<ul>
	<?php foreach($list as $value): ?>
		<li><?=$value?></li>
	<?php endforeach; ?>
</ul>

这个是解析文件：
<?php
/**
 * 模板解析
 */
class View{
	protected $path;
	protected $vars;
	public function __construct($path, $vars = []){
		if (is_file($path)) {
			$this->path = $path;
		}
		$this->vars = $vars;
	}

	public function fetch(){
		ob_start();
		ob_implicit_flush(0);
		extract($this->vars, EXTR_OVERWRITE);
		require_once $this->path;
		return ob_get_clean();
	}
}

$view = new View('./index.html', ['title' => 'test', 'list' => ['a', 'b', 'c']]);
echo $view->fetch();

```
###[Git基础(二)--常见撤销操作](http://goldenera.me/2017/02/23/Git%E5%9F%BA%E7%A1%80(%E4%BA%8C)--%E5%B8%B8%E8%A7%81%E6%92%A4%E9%94%80%E6%93%8D%E4%BD%9C/)
撤销工作区文件

git checkout filename
撤销暂存区文件至工作区

git reset filename
撤销本地仓库的某次至工作区

git reset commit
Git 命令行输入如下命令，禁止自动转换换行符

 
git config --global core.autocrlf false
pull 失败 解决方案：取消 Pull 操作然后手动合并
git merge --abort
git reset --merge
checkout : Unable to create ‘/path/project/.git/index.lock’ rm -f ./.git/index.lock
###[不小心敲了rm -rf后](https://www.zhihu.com/question/29438735)
不允许用rm命令的，要删除文件，需要mv文件到指定目录/delete/，会有一个定时任务，每周清空/delete/下文件
mv 文件(夹) /tmp 

(/tmp 下的文件在每次关机后都会被清理干净)
使用了以下命令：brew install safe-rm
echo 'alias rm=/usr/local/safe-rm' >> ~/.profile
不过不是root应该还是删不掉/的吧，反正我没试过。 命令行的回收站，设置alias rm=trash
###[Pandas速查手册中文版](https://zhuanlan.zhihu.com/p/25630700)
###[最新任意命令执行漏洞)批量检测工具精简版 ](https://zhuanlan.zhihu.com/p/25628971)
###[我所依赖的记忆方法](https://zhuanlan.zhihu.com/p/25603437)
https://faded12.github.io/conversion/ 记忆转换工具（中/英）
###[Python Web导出有排版要求的PDF文件](https://zhuanlan.zhihu.com/p/25691170)
xhtml2pdf 安装

pip install xhtml2pdf
pip install html5lib==1.0b8
中文字体问题

xhtml2pdf默认不支持中文字体，所以需要下载中文字体，比如:

宋体: simsun
同时要指定html页面的charset， 如：

<meta charset='utf8'/>
###[requests模块的response.text与response.content有什么区别](https://www.zhihu.com/question/56816991)
```js
requests.content返回的是二进制响应内容

而requests.text则是根据网页的响应来猜测编码，如果服务器不指定的话，默认编码是"

ISO-8859-1"
用response.encoding看一下他猜测的编码是啥。我猜应该是ISO-8859-1

然后你用response.encoding = 'utf-8'

然后再 response.text ，返回的内容应该是正常的了.
url = 'http://www.23us.com/class/9_11.html'
  response = requests.get(url)
response.encoding = response.apparent_encoding
resp.text返回的是Unicode型的数据。
resp.content返回的是bytes型也就是二进制的数据。
如果你想取文本，可以通过r.text。 如果想取图片，文件，则可以通过r.content。
（resp.json()返回的是json格式数据）

 # 例如下载并保存一张图片  
import requests  
jpg_url = 'http://img2.niutuku.com/1312/0804/0804-niutuku.com-27840.jpg'  
content = requests.get(jpg_url).content  
with open('demo.jpg', 'wb') as fp:     
    fp.write(content) 
```
###[APACHE VirtualHost的配置](http://goldenera.me/2017/02/16/%E4%BB%8E%E9%9B%B6%E5%BC%80%E5%A7%8B%E5%BB%BA%E7%AB%99(%E4%BA%8C)--VirtualHost%E7%9A%84%E9%85%8D%E7%BD%AE/)
```js
sudo mkdir -p /var/www/mysite.com
sudo chown -R $USER:$USER /var/www/mysite.com
cp /etc/apache2/site-available/default /etc/apache2/site-available/mysite.com
vi mysite.com.conf 
建议的配置文件内容

<VirtualHost *:80>
    ServerAdmin yourEmail@gmail.com
    ServerName www.yoursite.com
    DocumentRoot /var/www/example.com
    ErrorLog ${APACHE_LOG_DIR}/mysite.com/error.log
    CustomLog ${APACHE_LOG_DIR}/mysite.com/access.log
</VirtualHost>
激活配置文件

sudo a2ensite mysite.com.conf
重启apahce

sudo service apache2 restart
```
###[微信消息防撤回工具](https://zhuanlan.zhihu.com/p/25706692)
http://link.zhihu.com/?target=https%3A//pan.baidu.com/s/1c2mWSVm 
如果有朋友发消息给你并撤回你就会收到文件传输助手的通知了。
https://zhuanlan.zhihu.com/p/25689314?utm_source=zhihu&utm_medium=social 
###[cookies 转换 python dict](https://zhuanlan.zhihu.com/p/23208898)
```js
from http.cookies import SimpleCookie

#浏览器中的原始cookies字符串
rawdata = '''omg_first_visit_completed=1; __utmt=1; __utma=114157465.1493803552.1477441810.1477441810.1477441810.1; __utmb=114157465.1.10.1477441810; __utmc=114157465; __utmz=114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'''

from http.cookies import SimpleCookie
cookie = SimpleCookie(rawdata)
cookies = {i.key:i.value for i in cookie.values()}
{'__utmt': '1', 
'omg_first_visit_completed': '1', 
'__utmc': '114157465',
'__utmb': '114157465.1.10.1477441810', '__utma': '114157465.1493803552.1477441810.1477441810.1477441810.1', 
'__utmz': '114157465.1477441810.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)'}
```






