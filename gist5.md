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
