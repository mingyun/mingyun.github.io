###php导出excel
```php
header("Content-type:text/csv");   
header("Content-Disposition:attachment;filename=".$filename);   
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
header('Expires:0');   
header('Pragma:public');
$str='第一行,第二行';
$str =  iconv('utf-8','GBK//IGNORE',$str);
echo $str;
ob_flush();
flush();
sleep(1); 
```
###[利用pytesser模块识别图像文字](http://www.cnblogs.com/chenbjin/p/4147564.html)
```php
from pytesser import *
im = Image.open('fonts_test.png')
text = image_to_string(im)
print "Using image_to_string(): "
print text
text = image_file_to_string('fonts_test.png', graceful_errors=True)
print "Using image_file_to_string():"
print text
```
###[pdf转中文](https://www.zhihu.com/question/47480852/answer/121215315)
```php
 
# python3 安装使用pip install pdfminer3k
import os import subprocess from os.path import isfile,join ef = 'D:/xpdf/pdftotext.exe' cfg = 'D:/xpdf/xpdfrc' file = 'D:/xpdf/1.pdf' def convert(file): bo = subprocess.check_output([ef,'-f','1','-l','1','-cfg',cfg,'-raw',file,'-']) #这个命令中的所有调用文件参数必须使用full path.否则调用出错。 return bo.decode('utf-8') dr = r'M:\0700 SPEC&GAD' files = [f for f in os.listdir(dr) if isfile(join(dr,f)) and f.endswith('.pdf')] for file in files: bo = convert(join(dr,file)) if len(bo)!=0: print(bo.split('\r\n'))
```
###[使用浏览器打开网页](http://gohom.win/2015/12/22/pyWebbrowser/)
```php
import webbrowser
a=webbrowser.get('safari')
#a=webbrowser.MacOSX('safari')
a.open("http://www.baidu.com")
```
###npm包列表
```php
$ ls `npm root -g`
anywhere       browser-sync  json-server  nodeppt     spy-debugger
apidoc         dredd         jstophp      phantomjs   tianqi
asciify        gulp          livepool     puer        tldr
baidu-ocr-api  hexo          m-console    sails       webpack
bower          http-server   markdown     spawn-sync  weinre
```
###[音乐audio 的 play()](https://segmentfault.com/q/1010000007479793)
```php
#需要用户主动去触发才得行
    <div>
        <audio controls="true" id="audio">
            <source src="http://i.dxlfile.com/app/music/27.mp3" />
            <!-- <source src="http://i.dxlfile.com/app/music/27.ogg" /> -->
            <!-- <source src="http://i.dxlfile.com/app/music/27.ogg" /> -->
        </audio>
        <a href="javascript:;" id="fakeClick"></a>
    </div>
    <script>
    var audio = document.getElementById("audio");
    var aEle = document.getElementById("fakeClick");

    aEle.addEventListener('click', function(e) {
        e.preventDefault();
        audio.play();
    })

    function fakeClick(fn) {
        var evt;
        if (document.createEvent) {
            evt = document.createEvent("MouseEvents");
            if (evt.initMouseEvent) {
                evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                aEle.dispatchEvent(evt);
            }
        }
    }

    audio.addEventListener("canplay", fakeClick);
    </script>
```
###[返回100条不重复的记录](https://segmentfault.com/q/1010000008024825)
```php
'UPDATE `list` SET `State` = '1', `pid` = ' . getmypid() . '  WHERE `State` = '0' LIMIT 100;'
'SELECT * FROM `list` WHERE `pid` = ' . getmypid() . ' LIMIT 100'
'UPDATE `list` SET `pid` = ' . getmypid() . ' WHERE `pid` = '0''
```
###随机红包
```php
function randomRed($total,$num,$min = 0.01){
        $list = [];
        for($i= 1;$i< $num;$i++){
            $safe_total = ($total-($num-$i)*$min)/($num-$i);//随机安全上限
            $money      = mt_rand($min*100,$safe_total*100)/100;
            $total      = $total-$money;
            $list[$i]   = round($money,2);
        }
        $list[$num] = round($total,2);
        return $list;
    }
```
###[html5lib](https://www.v2ex.com/t/331908#reply6)
```php
# -*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup

def get_info_from(url):
    headers = {
        "User-Agent":"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36"
    }
    web_data = requests.get(url, headers=headers)
    web_data.encoding = 'utf-8'
    # print(web_data.text)    # 输出的结果中，搜索 t_con ，可以搜到
    soup = BeautifulSoup(web_data.text, 'lxml')#xml 改成 html5lib,解析器对非标准的 html 格式的解析结果不一样， lxml 会忽略掉不符合规则的标签， html5lib 会自动补全不正确的
    # print(soup)     # 输出的结果中，搜索 t_con, 搜不到了，为什么经过处理后却搜索不到了呢？

if __name__ == "__main__":
    test_url = "http://tieba.baidu.com/f?kw=%E4%B8%BA%E7%9F%A5%E7%AC%94%E8%AE%B0&ie=utf-8&pn=0"
    get_info_from(test_url)
```
###jquery eq
```php
 var a = Math.ceil($("li").length/2)
    for (var i=0; i<a; i++) { 
    //循环5次
        var j = i + Math.floor($("li").length/2)
        console.log(j) 
    // j = 5，6，7，8，9
        $("li:eq(j)").addClass("display") 
    //失败
        //$("li").eq(j).addClass("display") //或者$("li:eq("+j+")")
    //成功
    }
```
###[顺序读取JSON中的数据](https://segmentfault.com/q/1010000000327993)
```php
var triangle = {a:1, b:2, c:3};
for (var x in triangle) {
    console.log(x)
}
//应尽量避免编写依赖对象属性顺序的代码。如果想顺序遍历一组数据，请使用数组并使用 for 语句遍历。 如果想按照定义的次序遍历对象属性
先把所有 key 取出来，比如用 Object.keys()

var keys = Object.keys(triangle);
然后再把 keys 数组排序，然后再遍历这个数组
```
###[I Don't Know HTML](https://zhuanlan.zhihu.com/p/24748391)
```php
浏览器不支持 JavaScript 时 “隐藏” JavaScript 代码
<script type="text/javascript">
<!--
function displayMsg() {
    alert("Hello World!")
}
//-->
</script> 
<base href="www.zhihu.com/" target="_blank"><a href="liukanshan.gif">

www.zhihu.com/liukanshan.gif 并且有 target 属性，值为 _blank
通过其 dir 属性改变被其包围的文字的书写方向
<bdo dir="rtl">
Thanks for watching my blog.
</bdo>
输出是：

.golb ym gnihctaw rof sknahT
<details>
  <!-- 默认显示 summary 中的内容 -->
  <summary>页面加载后会显示summary包围的内容</summary>
  <!-- 默认以下内容是隐藏的,可以通过点击展开-->
  <p>这里可以放任何内容，但是默认是隐藏的</p>
  <p>也可以通过设置 <details open>默认展开所有内容<p>
</details>


```
###[home目录下所有的文件列表](https://zhuanlan.zhihu.com/p/24722347)
```php
[ item for item in os.listdir(os.path.expanduser('~')) if os.path.isfile(item) ]
home目录下所有目录的目录名到绝对路径之间的字典
{ item: os.path.realpath(item) for item in os.listdir(os.path.expanduser('~')) if os.path.isdir(item) }

```
###[map 有返回值（返回修改后的数组），forEach 没有返回值](https://segmentfault.com/q/1010000007977209)
```php
for 是循环的基础语法，可以有 for...in, foo...of,for(let i = 0; i < len; i++) 等。在for循环中可以使用 continue, break 来控制循环。

forEach 可以当做是for(let i = 0; i < len; i++)的简写，但是不能完成 i + n 这种循环，同时也不支持 continue 和 break，只能通过 return 来控制循环。另外，使用forEach的话，是不能退出循环本身的。

map的用法应该是循环当前可循环对象，并且返回新的可循环对象，跟for和forEach是不同的。
forEach相比普通的for循环的优势在于对稀疏数组的处理，会跳过数组中的空位
var arr = new Array(1000);

arr[0] = 1;
arr[99] = 3;
arr[999] = 5;
// for循环
for (var i = 0, l = arr.length; i < l; i++) {
    console.log('arr[%s]', i, arr[i]);
}
console.log('i :' , i);
// ...
// arr[0] 1
// ...
// arr[99] 3
// ...
// arr[999] 5
// i : 1000

// for - in 循环
var count = 0;
for(var j in arr){
    count ++ ;
    if(arr.hasOwnProperty(j)){
        console.log('arr[%s]', j, arr[j]);
    }
}
console.log('count : ', count);
// arr[0] 1
// arr[99] 3
// arr[999] 5
// i : 1000
var arr = new Array(1000);
arr[0] = 1;
arr[99] = 3;
arr[999] = 5;

var count = 0;
arr.forEach(function(value, index) {
    count++;
    console.log(typeof index);
    console.log(index, value);
});
console.log('count', count);
// number
// 0 1
// number
// 99 3
// number
// 999 5
// count 3
```
###[JavaScript数组去重](https://zhuanlan.zhihu.com/p/24753549)
```php
function unique(arr) {
    var ret = [];
    arr.forEach(function(item){
        if(ret.indexOf(item) === -1){
            ret.push(item);
        }
    });
    return ret;
}
function unique(arr) {
    return arr.filter(function(item, index){
        // indexOf返回第一个索引值，indexOf()使用的是严格比较，也就是===
        // 如果当前索引不是第一个索引，说明是重复值
        return arr.indexOf(item) === index;
    });
}
利用了对象（tmp）的key不可以重复的特性来进行去重
function unique(arr) {
    var ret = [];
    var len = arr.length;
    var tmp = {};
    for(var i=0; i<len; i++){
        if(!tmp[arr[i]]){
            tmp[arr[i]] = 1;
            ret.push(arr[i]);
        }
    }
    return ret;
}
function unique(arr){
    var set = new Set(arr);
    return Array.from(set);
}
```
###php自动执行
```php
$start = 1;
for ($i = 0; $i < 10; $i++) {
    print_r(
        (function ($hello) use (&$start) {
            return json_encode([$start, $hello, $start += rand(1, 5)]);
        })('黑PHP真的好玩吗？') . "\n");
}
```
###[print 打印嵌在其它结构里的字符串会默认 escape 模式](https://www.v2ex.com/t/332933#reply2)
```php
cur.execute(sql+entering) 
results = cur.fetchone() 

print results 
print results[0]
改成 
cur.execute(sql+entering) 
results = cur.fetchone() 

 
#print 中文的话还要加一个 str 
for result in results: 
    print str(result)    
```
###iconv 转换编码
如果出现错误 illegal input sequence at position，可以尝试忽略（iconv -f UTF-8 -t GBK//IGNORE ...）或转换（iconv -f UTF-8 -t GBK//TRANSLIT ...）无效字符。
###[微信如何查看页面源码](http://www.w3cmark.com/2017/weixin-debug-open.html)
在微信会话列表页点击右上角“加号按钮”，选择菜单中的”添加朋友”，在添加朋友界面的搜索框中输入字符串：“:help”，然后点击搜索
里面有四个调试功能：上传日子/修复数据/上传文件/js调试功能
###[词云工具wordcloud2](https://github.com/timdream/wordcloud2.js/)
`WordCloud(document.getElementById('my_canvas'), { list: list } );`
###页面翻转
```php
body{
    -webkit-transform: rotate(3deg);
    -moz-transform: rotate(3deg);
    -o-transform: rotate(3deg);
	padding-top:20px;
    }
    ```
    ###[一行js代码破解百度云大文件下载限制](http://blog.jarjar.cn/one-line-js-crack-baidu-yun/)
    ```php
    Object.defineProperty(this , 'navigator' , {value: { platform: "" }});

Object.defineProperty(navigator,'platform',{get:function(){return 'Android';}});

    ```
###[is_writeable函数bug问题](http://blog.csdn.net/u013474436/article/details/50674040)
```php
function is_really_writable($file)
    {
        // If we're on a Unix server with safe_mode off we call is_writable
        if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
        {
            return is_writable($file);
        }

        // For windows servers and safe_mode "on" installations we'll actually
        // write a file then read it.  Bah...
        if (is_dir($file))
        {
            $file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

            if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
            {
                return FALSE;
            }

            fclose($fp);
            @chmod($file, DIR_WRITE_MODE);
            @unlink($file);
            return TRUE;
        }
        elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
        {
            return FALSE;
        }

        fclose($fp);
        return TRUE;
    }
```
###[斐波那契数列](https://www.v2ex.com/t/331932)
```php
$total = [0, 1];

for ($i = 2; $i < 10; $i++)
{
	$total[] = $total[$i - 1] + $total[$i - 2];
}
>>> $total
=> [
     0,
     1,
     1,
     2,
     3,
     5,
     8,
     13,
     21,
     34,
   ]
   a, b = b , a+b
   import numpy 

def mm_fib(n): 
    return (numpy.matrix([[2,1],[1,1]])**(n//2))[0,(n+1)%2] 

[mm_fib(i) for i in range(20)]

def fib1(n):
    if n == 0:
        return 0
    elif n == 1:
        return 1
    return fib1(n-1) + fib1(n-2)
```
###[git add . 仅仅记录了增加或修改的文件，要用 git add -A](https://www.v2ex.com/t/332492)
```php
Git Version 1.x git add 时候 add 没 add 删除的部分
ignorecase=false
git add -A = git add . + git add -u 
Git v.2.x 中 `git add .`会跟踪删除记录
http://stackoverflow.com/questions/572549/difference-between-git-add-a-and-git-add 
```
###[代理服务器](https://zhuanlan.zhihu.com/p/24382606)
```php
server {
    location / {
        proxy_pass http://localhost:8080/;
    }

    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```
###[@加标签](https://segmentfault.com/q/1010000007971440)
```php
$text = preg_replace_callback('(@[^\s]+)',function($matches){
    //这里直接把要替换的结果return出去就可以了
    return "<a href='javascript:;'>{$matches[0]}</a> ";
},'是否订购@刘一届 @测试 @zxldev');

print_r($text);
是否订购<a href="javascript:;">@刘一届</a> <a href="javascript:;">@测试</a> <a href="javascript:;">@zxldev</a>
```
###填充0
```php
//格式化函数
function formatString($i){
    return str_pad(substr("$i",0,1),strlen($i),'0',STR_PAD_RIGHT);
}
//测试调用
$result = array();
foreach(array(120,560,2360,12345) as $item){
        $result[] = formatString($item);
}
//打印结果
print_r($result);[100,500,2000,10000]
```
###[update时怎么排除当前记录](https://segmentfault.com/q/1010000007981653)
```php
use Illuminate\Validation\Rule;

Validator::make($data, [
    'email' => [
        'required',
        Rule::unique('users')->ignore($user->id),
    ],
]);
backend/user/{id}
public function rules()
    {
        $id = $this->route('id'); //获取当前需要排除的id
        return [
            'email' => "required|email|unique:users,email,".$id,
        ];
    }
```
###ajax post json
```php
$data=json_decode(file_get_contents('php://input'));
先encode然后decode一遍才行$data=json_decode(json_encode($request->all()))
```
###[解决分页效率问题](http://www.moell.cn/article/17)
```php
select name from user where sex='女' order by last_login_time limit 10000000,10
select 字段列...... from table inner join (
            select  主键 from table
            where x.sex='女' order by last_login_time limit 1000000,10
 ) as x using(主键);
```
###[PHP中global的问题](https://segmentfault.com/q/1010000007244617)
```php
function test_global() {
    global $vars;
    $vars='OK';  
}
 
test_global();  
echo $vars;      //OK
<?php
//#1全局的时候$GLOBALS['var']就是$var。
$var=999;
unset($GLOBALS['var']);
var_dump($var); //报错 NULL


//#2在函数内部，$GLOBALS['var']就是外部全局的$var
$var=999;
function test(){
    unset($GLOBALS['var']);
}
test();
var_dump($GLOBALS['var']); //报错 NULL
var_dump($var); //报错 NULL


//#3没有全局$var的时候，函数内部执行global $var;会创建一个空值的内部$var和一个空值的外部$var，在链接起来。
function test2(){
    global $var;
    var_dump($var); //NULL
    var_dump($GLOBALS['var']); //NULL
    $var = 999;
}
test2();
var_dump($var); //999
var_dump($GLOBALS['var']); //999
```
###[SplFixedArray ](https://segmentfault.com/q/1010000007979799)
```php
$arrA = SplFixedArray ::fromArray(array(true));
$arrB = SplFixedArray ::fromArray(array(false));

//json_encode($arrB);

$equal = ($arrA == $arrB);
var_export($equal);
注释掉json_encode($arrB)时，$equal为true，去掉注释，$equal为false

```
###[print的时候实际上调用了tuple的__str](https://segmentfault.com/q/1010000007950587)
```php
>>> h = u'你好'
>>> (h, 8).__str__()
"(u'\\u4f60\\u597d', 8)"
```
###[MySQL之ROUND函数四舍五入的陷阱](https://segmentfault.com/a/1190000008042499)
使用两个字段相乘的时候，最终的结果是按照float类型处理的，而在计算机中float类型不是精确的数，因此处理结果会按照第二条来，而直接整数字段与1.005这样的小数运算的结果是因为两个参与运算的值都是精确数，因此按照第一条规则计算。从field5和field6执行ROUND函数的结果可以明确的看确实是转换为了最近的偶数
###[json_decode null](https://segmentfault.com/q/1010000008049796)
```php
 $string = '{"user_info_list":[{"subscribe":1,"openid":"oXd_Ftx6jQ7MMMOitkfjM9KQUTnQ","nickname":"Grace 阿欢","sex":2,"language":"zh_CN","city":"U\q","province":"l³S","country":"","headimgurl":"http://wx.qlogo.cn/mmopen/ajNVdqHZLLDcN5f9gjLJMpnHYJuRbJVeBsMibByNHsyuUCLEBEWGhhlH5EkvzGLibN7ic3TMDUVOnkHOBJLf8mZGQ/0","subscribe_time":1465995165,"remark":"","groupid":0,"tagid_list":[]}]}';

$str = str_replace('\\','\\\\',$string);

 $result = json_decode($str, true);
 var_dump($result);

```
###[Curl模拟提交数据](https://segmentfault.com/a/1190000008041341)
```php
<?php


 //模拟登录
 function login_post($url, $cookie, $post) {
     $curl = curl_init();//初始化curl模块
     curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
     curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
     curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
     curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
     curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
     curl_exec($curl);//执行cURL
     curl_close($curl);//关闭cURL资源，并且释放系统资源
 }

 // 登录成功后获取数据
 function get_content($url, $cookie) {
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
     $rs = curl_exec($ch); //执行cURL抓取页面内容
     curl_close($ch);
     return $rs;
 }

 // 登录成功后模拟发帖
 function post_thread($url, $cookie, $post)
 {
   $curl = curl_init();//初始化curl模块
   curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
   curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
   curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie); //读取cookie
   curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
   curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
   curl_exec($curl);//执行cURL
   curl_close($curl);//关闭cURL资源，并且释放系统资源
 }

 //设置post的数据
$post = array (
    'user_id' => '123456@qq.com',
    'password' => '123456',
    'goto_page' => 'http://m.app.cn/index.php',
    'act' => 'login',
    't' => time(),
);

//登录地址
$url = "http://m.app.cn/account/login.php";

//设置cookie保存路径
$cookie = dirname(__FILE__) . '/cookie_curl.txt';

//登录后要获取信息的地址
$url2 = "http://m.app.cn/user/wap/my_index.php";

// 1.模拟登录
 login_post($url, $cookie, $post);

// 2.获取登录页的信息
// $content = get_content($url2, $cookie);


//匹配页面信息
// $preg = "/<td class='portrait'>(.*)<\/td>/i";
// preg_match_all($preg, $content, $arr);
// $str = $arr[1][0];
//输出内容
// echo $content;

// 3.模拟发帖
$thread_info = array(
  'action'   => 'pub',
  'title'    => 'Test curl',
  'content'  => 'Hello, world.',
  't'        => time(),
);
$pub_thread_url = 'http://m.app.cn/thread/api/pub_thread.php';

$ret = post_thread($pub_thread_url, $cookie, $thread_info);
print_r($ret);

//删除cookie文件
@ unlink($cookie);
?>

```
###[PHP生成CSV之内部换行](https://segmentfault.com/a/1190000008016567)
`$description_value = '"'.str_replace(array(',','&nbsp;','<br>','<br/>','<br />'),array('，',' ',PHP_EOL,PHP_EOL,PHP_EOL),$description_value).'"';`
###[分类树函数](https://segmentfault.com/a/1190000008029990)
```php
/**
 * 定义分类树函数
 *     @param     items         需要分类的二维数组 
 *     @param     $id         主键（唯一ID）
 *     @param     $belong_id     关联主键的PID
 *  @son 可以自定义往里面插入就行
 */
    function catagory($items,$id='id',$belong_id='belong_id',$son = 'children'){
        $tree = array(); //格式化的树
        $tmpMap = array();  //临时扁平数据
     
        foreach ($items as $item) {
            $tmpMap[$item[$id]] = $item;
        }
     
        foreach ($items as $item) {
            if (isset($tmpMap[$item[$belong_id]])) {
                $tmpMap[$item[$belong_id]][$son][] = &$tmpMap[$item[$id]];
            } else {
                $tree[] = &$tmpMap[$item[$id]];
            }
        }
        unset($tmpMap);
        return $tree;
    }
    ```
###[重定向后怎么获取真实地址](https://segmentfault.com/a/1190000007968941)
```php
$url="http://dwz.cn/4Ww6cV";//
        
        /** $url="http://g.cn";//实际会跳转到google.cn,
            在此次贴下部分http头：注意看Status Code 和Location部分
                    Request URL:http://g.cn/
                    Request Method:GET
                    Status Code:301 Moved Permanently (from cache)
                    Remote Address:203.208.39.242:80
                    Response Headers
                    Cache-Control:private, max-age=2592000
                    Content-Length:218
                    Content-Type:text/html; charset=UTF-8
                    Date:Fri, 30 Dec 2016 05:58:51 GMT
                    Expires:Fri, 30 Dec 2016 05:58:51 GMT
                    Location:http://www.google.cn/
                    Server:gws
                    X-Frame-Options:SAMEORIGIN
                    X-XSS-Protection:1; mode=bloc
         **/
                    
                    
        $headers = get_headers($url,true);//加true更友好

        var_dump($headers['Location']);
/**
output=>["Location"]=>
  string(188) "https://www.taobao.com/markets/promotion/niandushengdian2016neiyi?spm=a21bo.50862.201862-1.d1.JGeGgF&pos=1&acm=20140506001.1003.2.1437526&scm=1003.2.20140506001.OTHER_1481324141839_1437526"
**/

$ch=  curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//看名字就知道，follow location,去掉此选项无效
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_exec($ch);
$info = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
echo $info;
```
###[导入Excel文件](https://segmentfault.com/a/1190000007977937)
```php
function import(){
    $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
    Excel::load($filePath, function($reader) {
        $data = $reader->all();
        dd($data);
    });
}
Excel::create('学生成绩',function($excel) use ($cellData){
     $excel->sheet('score', function($sheet) use ($cellData){
         $sheet->rows($cellData);
     });
})->store('xls')->export('xls');将该Excel文件保存到服务器上，可以使用 store 方法
//=>output:https://www.taobao.com/markets/promotion/niandushengdian2016neiyi?spm=a21bo.50862.201862-1.d1.JGeGgF&pos=1&acm=20140506001.1003.2.1437526&scm=1003.2.20140506001.OTHER_1481324141839_1437526
```
###[ssh login](https://segmentfault.com/a/1190000008029990)
```php
$user="root";//远程用户名
$pass="******";//远程密码
$connection=ssh2_connect('10.10.10.10',22);
ssh2_auth_password($connection,$user,$pass);
$cmd="ps aux";//命令
$ret=ssh2_exec($connection,$cmd);
stream_set_blocking($ret, true);
echo (stream_get_contents($ret));
```
