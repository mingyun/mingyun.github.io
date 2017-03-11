###一行代码可以看到所有页面元素
```js
[].forEach.call($$("*"),function(a){a.style.outline="1px solid #"+(~~(Math.random()*(1<<24))).toString(16)})
[...document.querySelectorAll('*')].forEach( element => element.style.outline = `2px #${((Math.random()*0xFFFFFF)>>0).toString(16)} solid` )


```
###获取网页所有url
```js
$x('//a').map(function(i){return i.href})
```
###99乘法表
```js
//需要支持es6的浏览器
document.write([1,2,3,4,5,6,7,8,9].map( e => Array.from({length:e}).map( (_e,i) => `${e} * ${i + 1} = ${e*(i+1)}`).join('&nbsp;&nbsp;&nbsp;') ).join('<br/>'));

1 * 1 = 1
2 * 1 = 2   2 * 2 = 4
3 * 1 = 3   3 * 2 = 6   3 * 3 = 9
4 * 1 = 4   4 * 2 = 8   4 * 3 = 12   4 * 4 = 16
5 * 1 = 5   5 * 2 = 10   5 * 3 = 15   5 * 4 = 20   5 * 5 = 25
6 * 1 = 6   6 * 2 = 12   6 * 3 = 18   6 * 4 = 24   6 * 5 = 30   6 * 6 = 36
7 * 1 = 7   7 * 2 = 14   7 * 3 = 21   7 * 4 = 28   7 * 5 = 35   7 * 6 = 42   7 * 7 = 49
8 * 1 = 8   8 * 2 = 16   8 * 3 = 24   8 * 4 = 32   8 * 5 = 40   8 * 6 = 48   8 * 7 = 56   8 * 8 = 64
9 * 1 = 9   9 * 2 = 18   9 * 3 = 27   9 * 4 = 36   9 * 5 = 45   9 * 6 = 54   9 * 7 = 63   9 * 8 = 72   9 * 9 = 81
 
```
###获取浏览器记住的密码
```js
document.querySelectorAll("input[type=password]")[0].value
```
###任意修改网页
```js
document.body.setAttribute('contenteditable', true);
document.body.contentEditable=true
document.designMode='on'

```
###下载当前页面里的所有图片
```js
$$('img').forEach(item => Object.assign(document.createElement('a'),{href:item.src,download:"download"}).click());

```
###取消禁止复制
```js
[...document.getElementsByTagName('*')].forEach(x => x.oncopy = function(){})
```
###设默认值
```js
function foo(bar){
    var foobar = bar || 'default'; 
    //bar 为 undefined, null, "", 0, false, NaN 时最后都得到'default'
}
```
###数组传递和复制
```js
var a = [1,2,3];
var b = a;
delete b[1];
console.log(a);//[1, undefined × 1, 3]

var a = [4,5,6];
var b = a.slice(0);
delete b[1];
console.log(a);//[4,5,6]
console.log(b);//[4, undefined × 1,6]
```
###switch代替if else
```js
switch (true) {  
        case (a > 10):  
            do_something();
            break;
        case (a < 100):  
            others();  
            break;  
        default:
            ;  
            break;  
    };
```
###数组重复
```js
['<table>', new Array(11).join(['<tr>', new Array(9).join('<td>-</td>'), '</tr>'].join('')), '</table>'].join('');
"<table><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr><tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr></table>"
```
###类数组对象转数组
```js

var arr = Array.prototype.slice.call(arguments);
var arr = [].slice.call(arguments);
```
###随机数
```js
Math.random().toString(16).substring(2);  
Math.random().toString(36).substring(2);  
```
###合并数组
```js
var a = [1,2,3];
var b = [4,5,6];
Array.prototype.push.apply(a, b);
console.log(a); //[1,2,3,4,5,6]
```
###界限
```js
function limit(number,min,max){
    return  Math.min(max,Math.max(min,number));
}
limit(10, 0, 100);  //10
limit(-7, 0, 100);  //0
limit(110, 0, 100);  //100
```
###
```js
var a = JSON.parse(JSON.stringify(b)) 
```
###数组中的最大数
```js
var  numbers = [5, 458 , 120 , -215 , 228 , 400 , 122205, -85411];
var maxNumber = Math.max.apply(null, numbers);
console.log(maxNumber);

```
###数组求和
function sum(arr){
  return arr.reduce(function(s,n){
     return s+n
  });
}

var arr = new Array(1,2,3,4);
console.log(sum(arr)); // 10
去除数组中重复的值：
function removeRepeat(arr){
  return arr.filter(function(elem, pos) {
    return arr.indexOf(elem) == pos;
  });
}

var arr = new Array("1","2","3","4","4","4","4","5");
var newArr = removeRepeat(arr);
console.log(newArr); //1,2,3,4,5
位移符的应用
var num = 10 >> 1; // 相当于10 / 2，但是效率更高 
console.log(num) // 5;

var num = 2 << 3; // 2的四次方
console.log(num) // 16;
timeout中获取其作用域外的变量
//以下这段无法取到正确的i结果
for(var i = 0; i < 10; i++) {
	setTimeout(function(){
		console.log(i);
	},100);
}

//修改后的代码
for(var i = 0; i < 10; i++) {
	(function(i){
		setTimeout(function(){
			console.log(i);
		},100)
	})(i);
}
function isArray(arr){
    return arr ? Object.prototype.toString.call(arr) === '[object Array]' : false
}
得到这个变量对应的Boolean类型
Person.prototype.isStudent = function () {
    return !!this.studentId;
};
Person.prototype.isStudent = function () {
    return this.studentId ? true : false;
};
Person.prototype.isStudent = function () {
    if (this.studentId) {
        return true;
    }
    return false;
};
数组最大和最小值
Math.max.apply(Math, [1,2,3]); //3
Math.min.apply(Math, [1,2,3]); //1
data:text/html, <html contenteditable>

交换值：
a= [b, b=a][0];
a=a+b;
b=a-b;
a=a-b;
用0补全位数：
function prefixInteger(num, length) {
  return (num / Math.pow(10, length)).toFixed(length).substr(2);
}

https://link.zhihu.com/?target=http%3A//runjs.cn/  $(".count").trigger("click")

$("[data-aid='16571841']").find("button.up").trigger("click")
for(;$i<101;$i++)echo$i%15?$i%3?$i%5?$i:"Buzz":"Fizz":"FizzBuzz","\n";

作者：天猪(刘勇)
链接：https://www.zhihu.com/question/26483508/answer/32954811
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
“短”化你的代码
Function("‍‌‌‍‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‍‍‍‌‌‍‌‌‌‍‌‍‌‍‌‌‍‌‌‍‌‍‌‌‍‍‌‍‌‍‌‌‍‌‌‌‍‍‌‌‌‍‌‍‍‍‍‌‍‌‌‌‍‍‌‌‌‍‍‍‌‍‌‌‌‍‌‍‌‍‌‌‍‍‌‍‌‍‌‌‌‍‍‌‍‍‌‌‌‌‍‍‌‍‌‍‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‌‍‌‌‍‍‍‌‌‍‍‌‍‌‍‌‌‍‍‍‌‌‍‌‌‌‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‌‍‍‌‍‍‍‌‍‌‍‍‍‍‍‌‍‍‍‌‍‍‌‌‍‍‌‍‍‍‌‌‍‌‍‍‌‍‌‌‌‍‌‌‍‍‌‍‌‌‍‌‌‍‌‌‍‍‌‍‍‍‌‌‍‍‍‍‌‍‌‌‌‍‌‍‍‍‌‌‍‍‍‍‌‍‍‌‍‌‌‍‌‍‌‌‍‍‍‍‌‍‌‌‍‌‍‍‌‍‌‌‍‍‌‍‍‍‍‌‌‌‌‍‌‍‌‍‌‌‌‍‍‍‍‌‍‍‍‌‍‍‍‌‌‌‍‍‍‍‍‌‌‍‌‍‌‍‍‌‌‍‌‌‍‍‍‌‌‌‍‍‍‍‍‌‌‍‌‌‍‍‍‌‌‍‌‍‍‍‍‌‌‍‍‍‌‍‌‍‌‌‌‍‍‍‍‌‍‍‍‌‍‍‌‍‌‌‌‍‌‍‍‌‍‍‍‍‍‍‌‌‍‍‍‌‍‍‌‌‌‍‌‍‌‍‌‌‌‍‌‍‍‍‌‌‌‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‍‌‌‌‍‍‍‌‍‌‌‌‍‍‌‌‌‍‌‍‌‍‌‌‌‍‍‍‍‍‌‍‌‌‍‌‌‍‌‌‍‍‍‍‌‍‌‌‌‍‍‌‍‍‌‌‍‌‍‍‌‍‌‌‍‍‍‍‌‍‍‌‍‌‌‍‌‍‌‌‌‍‍‍‍‍‌‌‌‍‍‌‍‍‌‌‍‍‌‍‌‍‌‌‌‍‍‌‌‍‌‌‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‌‍‍‌‍‍‍‍‌‌‌‌‍‌‍‌‌‍‍‌‌‍‍‌‌‍‍‍‍‌‍‌‌‍‌‌‍‍‍‌‌‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‍‌‌‌‍‌‍‍‌‍‍‍‌‍‍‍‌‍‌‍‍‌‍‍‌‍‌‌‌‍‍‌‌‍‍‍‌‌‍‌‌‍‌‌‍‍‍‌‌‍‌‍‍‌‍‌‌‍‍‍‌‌‍‌‌‍‌‍‌‌‍‍‌‍‌‍‍‍‍‍‌‍‌‍‍‌‍‍‌‌‌‍‌‌".replace(/.{8}/g,function(u){return String.fromCharCode(parseInt(u.replace(/\u200c/g,1).replace(/\u200d/g,0),2))}))();
https://link.zhihu.com/?target=http%3A//ucren.com/blog/archives/549

console.log("‍‌‌‍‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‍‍‍‌‌‍‌‌‌‍‌‍‌‍‌‌‍‌‌‍‌‍‌‌‍‍‌‍‌‍‌‌‍‌‌‌‍‍‌‌‌‍‌‍‍‍‍‌‍‌‌‌‍‍‌‌‌‍‍‍‌‍‌‌‌‍‌‍‌‍‌‌‍‍‌‍‌‍‌‌‌‍‍‌‍‍‌‌‌‌‍‍‌‍‌‍‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‌‍‌‌‍‍‍‌‌‍‍‌‍‌‍‌‌‍‍‍‌‌‍‌‌‌‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‌‍‍‌‍‍‍‌‍‌‍‍‍‍‍‌‍‍‍‌‍‍‌‌‍‍‌‍‍‍‌‌‍‌‍‍‌‍‌‌‌‍‌‌‍‍‌‍‌‌‍‌‌‍‌‌‍‍‌‍‍‍‌‌‍‍‍‍‌‍‌‌‌‍‌‍‍‍‌‌‍‍‍‍‌‍‍‌‍‌‌‍‌‍‌‌‍‍‍‍‌‍‌‌‍‌‍‍‌‍‌‌‍‍‌‍‍‍‍‌‌‌‌‍‌‍‌‍‌‌‌‍‍‍‍‌‍‍‍‌‍‍‍‌‌‌‍‍‍‍‍‌‌‍‌‍‌‍‍‌‌‍‌‌‍‍‍‌‌‌‍‍‍‍‍‌‌‍‌‌‍‍‍‌‌‍‌‍‍‍‍‌‌‍‍‍‌‍‌‍‌‌‌‍‍‍‍‌‍‍‍‌‍‍‌‍‌‌‌‍‌‍‍‌‍‍‍‍‍‍‌‌‍‍‍‌‍‍‌‌‌‍‌‍‌‍‌‌‌‍‌‍‍‍‌‌‌‍‌‍‍‍‌‌‍‌‌‌‌‍‌‌‍‌‌‌‍‍‍‌‍‌‌‌‍‍‌‌‌‍‌‍‌‍‌‌‌‍‍‍‍‍‌‍‌‌‍‌‌‍‌‌‍‍‍‍‌‍‌‌‌‍‍‌‍‍‌‌‍‌‍‍‌‍‌‌‍‍‍‍‌‍‍‌‍‌‌‍‌‍‌‌‌‍‍‍‍‍‌‌‌‍‍‌‍‍‌‌‍‍‌‍‌‍‌‌‌‍‍‌‌‍‌‌‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‌‍‍‌‍‍‍‍‌‌‌‌‍‌‍‌‌‍‍‌‌‍‍‌‌‍‍‍‍‌‍‌‌‍‌‌‍‍‍‌‌‌‍‍‌‌‍‌‌‍‍‌‍‌‍‌‍‌‌‌‍‌‍‍‌‍‍‍‌‍‍‍‌‍‌‍‍‌‍‍‌‍‌‌‌‍‍‌‌‍‍‍‌‌‍‌‌‍‌‌‍‍‍‌‌‍‌‍‍‌‍‌‌‍‍‍‌‌‍‌‌‍‌‍‌‌‍‍‌‍‌‍‍‍‍‍‌‍‌‍‍‌‍‍‌‌‌‍‌‌".length);
 www.jsfuck.com/
颜文字编码 http://utf-8.jp/public/aaencode.html
https://link.zhihu.com/?target=http%3A//wtfjs.com/

https://www.zhihu.com/question/27428135 

'0'+date.slice(0,-2)

http://blog.nokey.me/2015/01/07/JavaScript%E5%A5%87%E6%8A%80%E6%B7%AB%E5%B7%A745%E6%8B%9B/ 
https://chensd.com/2015-01/45-useful-javascript-tips-tricks-and-best-practices.html 














###[基于 4 个 8 撸了一个 CDN 友好的 DNS](https://www.v2ex.com/t/336726)
https://github.com/lbp0200/PRCDNS  https://github.com/holyshawn/overture 
###[离线版类 CodePen 的 Electron 应用， SketchCode](https://www.v2ex.com/t/339804)
https://github.com/qingww/SketchCode 

https://github.com/qingww/SketchCode/releases/
收发微信消息的 bot 框架 https://github.com/blueset/ehForwarderBot 
###[饥人谷出品：一个会动的简历](https://github.com/jirengu-inc/animating-resume)
###[image-to-ascii](https://helloacm.com/tools/image-to-ascii/)
###[Python 如何在图片上 添加 带格式的文本](https://www.v2ex.com/t/342171#reply3)
使用 PIL 的 text 方法可以加文本，但无法对文本进行格式化 https://github.com/vbauer/manet   渲染成网页，然后用 PhantomJS 来截图
###[ redis 的 RPOPLPUSH 实现安全队列](https://www.v2ex.com/t/341774#reply5)

你队列中的某个 item 操作完了的时候 会删除 lpush 进的队列的数据,但是万一没有完成或者超时或者突然程序挂掉了呢?所以你需要另外一个操作,间隔一段时间读取下 lpush 进的那个队列,然后查看这些操作是否已经完成,如果完成,干掉,没完成,要不重新放入队列要不...看你业务咯
存储在你的 node 中,比如说队列的这个 key 对应一个 hash,那么这个 hash 可以存储一个叫做 last_op 的时间戳,然后你的那个客户端判断时读取这个值
###[数据爬取、Ajax 探讨](https://www.v2ex.com/t/342608#reply17)
设定 Referer 就可以请求到数据 $ curl -se "https://detail.tmall.com/item.htm" "https://mdskip.taobao.com/core/initItemDetail.htm?itemId=543399704177&callback=setMdskip" | grep -Po "\"sellCount\":\d+," 
"sellCount":8308, 
![img](http://ww4.sinaimg.cn/large/0060lm7Tgy1fd0fa9fq35j31kw02u3z5.jpg)
###[PHP 7.0, PHP 7.1.2, PHP -jit 的性能](https://www.v2ex.com/t/343299#reply9)
```js
$t1 = microtime(true);
for ($i = 0; $i < 10000000; $i++) {
    aaa($i);
}
$t2 = microtime(true);
echo 'php time:' . ($t2 - $t1) * 1000 . "ms\n";
function aaa($i) {
    $a = $i + 1;
    $b = 2.3;
    $s = "abcdefkkbghisdfdfdsfds";

    if ($a > $b) {
        ++$a;
    } else {
        $b = $b + 1;
    }

    if ($a == $b) {
        $b = $b + 1;
    }
    $c = $a * $b + $a / $b - pow($a, 2);
    $d = substr($s, 0, strpos($s, 'kkb')) . strval($c);
}
https://github.com/php/php-src/blob/master/Zend/bench.php

```



###[模拟桌面的前端框架了；](https://segmentfault.com/q/1010000008649281)
NW.js：https://nwjs.io/ https://electron.atom.io/ https://github.com/os-js/OS.js

###[console.log()结果的疑问](https://segmentfault.com/q/1010000008635507)
```js
function fn(){
    console.log(1);
}

fn.toString = function(){
    return 30;
}

console.log(fn);在浏览器里面console.log("%s",fn) 才会调用 toString

console.log输出函数时调用其toString方法。因为你复写了函数的toString并return 30所以才会输出30呀。不然应该是function function。应该是前者表示类型后者表示值。console.log()参数如果是对象的话，会转化为字符串形式，也就是调用这个tostring方法
```
###[ Mysql group by 后对分组数据的处理问题](https://www.v2ex.com/t/340250#reply18)
```js
|id |col1|col2|col3|col4|
|---|----|----|--- |----|
| 1 |  1 |  1 |  1 |  1 |
| 2 |  1 |  1 |  1 |  2 |
| 3 |  1 |  1 |  1 |  1 |
| 4 |  1 |  1 |  2 |  1 |
| 5 |  1 |  1 |  2 |  2 |
| 6 |  1 |  2 |  1 |  1 |
| 7 |  1 |  2 |  1 |  1 |
| 8 |  1 |  3 |  2 |  2 |
| 9 |  1 |  3 |  2 |  2 |
现在我需要按 col1 和 col2 对表进行分组，然后对每个分组进行统计，统计 col3=1,col4 不重复值的数量 ps:count(distinct(col4)), 统计 col3=2 ， col4 值的数量 ps:count(col4)

即结果为

|id |col1|col2|distinct(col4)|count(col4)|
|---|----|----|--------------|-----------|
| 1 |  1 |  1 |       2      |         2 |
| 2 |  1 |  2 |       1      |         0 |
| 3 |  1 |  3 |       0      |         2 |

SELECT 
col1, 
col2, 
count(DISTINCT if(col3 = 1, col4, NULL)), 
count(if(col3 = 2, col4, NULL)) 
FROM table 
GROUP BY col1, col2 
ORDER BY col2;
SELECT 
col1, col2, col4, COUNT(col4) 
FROM 
(SELECT DISTINCT 
col1, col2, col3, col4 
FROM 
temp 
WHERE 
col3 = 1) T 
GROUP BY col1 , col2
```
###[python-markdown2](https://github.com/trentm/python-markdown2)
```js
>>> import markdown2
>>> markdown2.markdown("*boo!*")  # or use `html = markdown_path(PATH)`
u'<p><em>boo!</em></p>\n'

>>> from markdown2 import Markdown
>>> markdowner = Markdown()
>>> markdowner.convert("*boo!*")
u'<p><em>boo!</em></p>\n'
>>> markdowner.convert("**boom!**")
u'<p><strong>boom!</strong></p>\n'

python markdown2.py foo.md > foo.html

```
###[网页截屏](https://github.com/vbauer/manet)
curl http://localhost:8891/?url=github.com > github.png
curl -H "Content-Type: application/json" -d '{"url":"github.com"}' http://localhost:8891/ > github.png
curl -H "Content-Type: application/x-www-form-urlencoded" -d 'url=github.com' http://localhost:8891/ > github.png
wget http://localhost:8891/?url=github.com -O github.png


###[检测网站链接有效性工具](https://www.v2ex.com/t/338598#reply18)
curl -s -o /dev/null -w "%{http_code}" http://www.example.org/ 

返回的值不是 200 可以判断为死链 http://tool.chinaz.com/links/
加上-I, 只需要获取 header ，不需要下载整个页面 

curl -sI -o /dev/null -w "%{http_code}" http://www.example.org/
https://helloacm.com/tools/can-visit/ URL Status Checker with API support
https://helloacm.com/api/can-visit/?url=https://helloacm.com/top
It will return JSON-encoded data:
{"result":true,"code":200}
If $_GET parameter s is not specified, this API will use the $_POST variable s instead.
curl -X POST https://helloacm.com/api/can-visit/ -d "url=https://codingforspeed.com"

http://stackoverflow.com/questions/2804467/spider-a-website-and-return-urls-only 
http://stackoverflow.com/questions/6136022/script-to-get-the-http-status-code-of-a-list-of-urls
###[Python3 如何正确处理超时并重试](https://www.v2ex.com/t/342795#reply13)
 https://pypi.python.org/pypi/retrying
```js
requests 有 timeout 和 retry 的配置。可以分别设置连接超时和读取超时。

import random
from retrying import retry

@retry
def do_something_unreliable():
    if random.randint(0, 10) > 1:
        raise IOError("Broken sauce, everything is hosed!!!111one")
    else:
        return "Awesome sauce!"

print do_something_unreliable()

a = 2**999999999999 

这一行代码不到一秒钟就可以计算完毕。 
但是如果你加上一行 
print(a) 

那么你需要等几个小时才能看到有东西显示出来。
$ pip -V # 看看使用的 pip 对不对 

$ pip show <installed-package> # 看看 Location 字段的值
vim `which pip` -> 修改第一行指向的 python pip 本身就是个 python script 然后给了 x 权限而已
```
###[爬虫]( https://www.figotan.org/2016/08/10/pyspider-as-a-web-crawler-system/)

###[获取一个数组中的连续数字](https://segmentfault.com/q/1010000008646343)
```js
function fn(arr){
  var result = [],
      i = 0;
  result[i] = [arr[0]];
  arr.reduce(function(prev, cur){
    cur-prev === 1 ? result[i].push(cur) : result[++i] = [cur];
    return cur;
  });
  return result;
}
var oldArr = [1,2,3,7,8,9,15,17,18,19];
var pre=undefined,arr=[],newArr=[];
for(var i=0;i<oldArr.length;i++){
    if(typeof pre == "undefined") {
       arr.push(oldArr[i]);
       pre = oldArr[i];
       continue;
    }
    if(oldArr[i] === pre+1){
       pre++;
       arr.push(pre);
    }else{
       newArr.push(arr);
       arr = [oldArr[i]];
       pre = oldArr[i];
    }
}
 newArr.push(arr);
```
###[js空字符串的问题](https://segmentfault.com/q/1010000008644024)
```js
elem.addEventListener("keyup", function(e) {
    if (e.keyCode === 32) {
        this.value = this.value.replace(/\s*/gi, "")
    }
});
```
###[关于冒泡排序可视化中的 JSON ](https://segmentfault.com/q/1010000008645992)
```js
for (var i = divs_value.length-1; i>0;i--) {
    for (var j = 0; j < i; j++) {
        if (divs_value[j] > divs_value[j+1]) {
            var smaller = divs_value[j+1];
            divs_value[j+1] = divs_value[j];
            divs_value[j] =  smaller;
            state.push(JSON.parse(JSON.stringify(divs_value)))
            // state.push(divs_value)
        }
    }
}
```
###[利用原生php配合html5做的实时聊天室](https://github.com/EastHuang/php-websocket-demo)
###[练习写javascript的网站](https://segmentfault.com/q/1010000008645239)

https://www.codewars.com/trainer/setup https://jsfiddle.net/
###[html5移动端音乐播放](https://segmentfault.com/q/1010000008641889)
```js
var music = document.getElementById("music");

$(".start").click(function(){
    setTimeout(function(){
        music.play();
    },5000);
});
var music = document.getElementById("music");

$(".start").click(function(){
    alert(1);
    setTimeout(function(){
        alert(2);
        music.play();
    },5000);
});
输出1，证明点击事件触发没问题
输出2，证明定时器没问题
```
###[文档中的tab换为4个空格](https://segmentfault.com/q/1010000008641856)

代码格式化工具吧～

php的话，指定编码规范

phpcfb [项目目录]

例如：
./vendor/bin/phpcbf --standard=PSR1,PSR2  ../path
###[JS数组递归遍历](https://segmentfault.com/q/1010000008641909)
```js
var arr = [{
                    "id": 35,
                    "code": "110100",
                    "name": "北京市",
                    "type": 1,
                    "regions": [{
                        "id": 373,
                        "code": "110101",
                        "name": "东城区",
                        "type": 2,
                        "regions": [],
                        "latitude": 0,
                        "longitude": 0
                    }],
                    "latitude": 0,
                    "longitude": 0
                },
                {
                    "id": 36,
                    "code": "120100",
                    "name": "天津市",
                    "type": 1,
                    "regions": [{
                        "id": 389,
                        "code": "120101",
                        "name": "和平区",
                        "type": 2,
                        "regions": [],
                        "latitude": 0,
                        "longitude": 0
                    }],
                    "latitude": 0,
                    "longitude": 0
                },
                {
                    "id": 37,
                    "code": "130100",
                    "name": "石家庄市",
                    "type": 1,
                    "regions": [{
                        "id": 405,
                        "code": "130102",
                        "name": "长安区",
                        "type": 2,
                        "regions": [],
                        "latitude": 0,
                        "longitude": 0
                    }],
                    "latitude": 0,
                    "longitude": 0
                }
            ];
            var arr1 = [];
            for(var i = 0, l = arr.length; i < l; i++) {
                arr1[i] = {
                    text: arr[i].name,
                    value: arr[i].name,
                    children: [{
                        text: arr[i].regions[0].name,
                        value: arr[i].regions[0].name
                    }]
                }
            }
            console.log(arr1)
	function fnArr(a){
        return a.length ? a.map(function(o){
            var oNew = {
                text : o.name,
                value : o.name,
                children : fnArr(o.regions) 
            };
            if (oNew.children === undefined) delete oNew.children;
            return oNew;
        }) : undefined;
     }    
	    
	    
```
###[文件在线高清预览](https://segmentfault.com/q/1010000008638129)
###[如何获取优酷的原网页地址](https://segmentfault.com/q/1010000008635649)
###[http请求建立连接的时候为啥是tcp三次握手](https://segmentfault.com/q/1010000008631792)
```js
无论多少次握手都不能满足传输的绝对可靠。
TCP的核心思想：保证数据可靠传输
其次：保证传输效率。

那么，就可以开始回答了：

为什么要握手(为什么不是2次握手)？

**为了保证传输的可靠。**
第一次握手CLIENT告诉SERVER“我将要开始传输数据了”。
第二次握手SERVER告诉CLIENT“我已经知道你将要传输数据了，我已经做好准备”。
第三次握手CLIENT告诉SERVER“我已经知道你已经知道'我知道你已经做好准备'”，SERVER端收到这个信号，开始传输数据。
但是此时CLIENT并不知道SERVER已经知道“CLIENT 已经知道SERVER已经知道”(有点绕，可以忽略这一句)。

为什么是3次而不是4次?

**为了提高传输的效率**
总之不管多少次握手，总会有一方不知道对方已经知道。因此为了传输效率，只要3次握手就认为已经可以开始传输数据，三次握手之后，
CLIENT和SERVER就进入ESTABLISHED状态，开始数据传输
```
###[Jquery的Ajax上传文件](https://www.blog8090.com/ru-he-yun-yong-jqueryde-ajaxshang-chuan-wen-jian/)
```js
<img src="{{url('/file.png')}}" id="pic" style="cursor: pointer;"/>

<input type="file" name="photo" id="photo_upload" style="display: none;" />  
<script type="text/javascript">  
// 这里是Ajax 全局token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    // 图片上传
    $('#pic').on('click', function(){

      $('#photo_upload').trigger('click');

      $('#photo_upload').on('change', function(){
        var obj = this;
        var formData = new FormData();
        formData.append('photo', this.files[0]);
        $.ajax({
          url: 'upload',
          type: 'post',
          data: formData,
          // 因为data值是FormData对象，不需要对数据做处理
          processData: false,
          contentType: false,
          beforeSend:function(){
              // 菊花转转图
              $('#pic').attr('src', '/load.gif');
          },
          success: function(data){
              if(data['ServerNo']=='200'){
                // 如果成功
              $('#pic').attr('src', '/uploads/'+data['ResultData']);
                $('input[name=pic]').val(data);
                $(obj).off('change');
              }else{
                // 如果失败
                  alert(data['ResultData']);
              }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
                var number = XMLHttpRequest.status;
                var info = "错误号"+number+"文件上传失败!";
                // 将菊花换成原图
                                $('#pic').attr('src', '/file.png');
                alert(info);
            },
          async: true
        });
      });
    });
</script>  
/**
     * 文件上传 demo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('photo');
        // 验证
        $check = $this->checkFile($file);
        if(!$check['status']){
            return response()->json(['ServerNo' => '400','ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path('uploads');
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        $fileName = md5(time().rand(0,10000)).'.'.$postfix;
        // 移动
        if(!$file->move($path,$fileName)){
            return response()->json(['ServerNo' => '400','ResultData' => '文件保存失败']);
        }
        // 这里处理 数据库逻辑
        /**
        *Store::uploadFile(['fileName'=>$fileName]);
        **/
        return response()->json(['ServerNo' => '200','ResultData' => $fileName]);
    }


    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }

        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }

        return ['status' => true];
    }
```
###[vue](https://museui.github.io/#/radio)
https://www.iviewui.com  
###[这段JS代码的作用域为什么是window了](https://segmentfault.com/q/1010000008632480)
```js
//这个函数声明提升啦
function f(){ console.log(3); }

var a=1;
var b={
  a:2,
  b:function(){
    console.log(this.a);
  }(), 
  f:this.f=function(){
    console.log(this.a);
  }
};
//function f(){ console.log(3); }
f();
b.f();
(b.f)();
(0,b.f)();
```
###[转化成JSON格式](https://segmentfault.com/q/1010000008632520)
var obj = '{ name :"hello", age:12}';
var objJStr=obj.replace(/([{,])\s*(\w+)\s*:/g,'$1"$2":');
console.log(JSON.parse(objJStr));//Object {name: "hello", age: 12}

###[关于八进制的parseInt();](https://segmentfault.com/q/1010000008630344)
070是个数，不是字符串，对解释器来说和写下56是一样的。这样做只是为了更适合人读代码，比如，有时候写0xF比15更易读懂。

paseInt 第一个参数是字符串。
第一个 070 即 56 --toString--> "56" --parseInt10--> 56
第二个 070 即 56 --toString--> "56" --parseInt8--> 46
parseInt(070, 8)不等于parseInt(70, 8)而是等于parseInt(parseInt(70, 8), 8)
###[curl 如何传递多参数并进行urlencode](https://segmentfault.com/q/1010000008630196)
curl -G --data-urlencode "port=4546" --data-urlencode "content=哈哈哈" www.test.com
curl进行urlencode的方式为curl --data-urlencode "port=4546&content=hello" www.test.com

但是这样服务器并不能正常获取port和content参数，反而获得的参数是port，值为4546&content=hello
###[php 在线打开word文档](https://segmentfault.com/q/1010000008623235)
1.借助第三方：http://www.idocv.com/index.html http://www.officeweb365.com
2.自己转换成swf http://www.print2flash.com
###[打印RegExp对象](https://segmentfault.com/q/1010000008626133)

var reg=new RegExp('\w');
console.log(reg);

输出 /w/
###[把一个 name 数组 和 value 数组 组成这个多维数组](https://segmentfault.com/q/1010000008625086)
var data = [];
for (var i = 0; i < name.length; i++) {
    data.push({
        'name': name[i],
        'value': value[i]
    });
}
https://segmentfault.com/q/1010000008506557/a-1020000008506804
###[web服务器只能本机访问](https://segmentfault.com/q/1010000008624550)
防火墙

chkconfig iptables off
要重启后生效

service iptables stop

###[mysql 不能在子查询中使用limit](http://blog.csdn.net/tsxw24/article/details/44994835)
```js
mysql 不能在子查询中使用limit，如select * from table where id in (select id from table limit 10)，
但是再来一层就可以了 select * from table where id in (select id from (select * from table limit 10))
从文章点击前50名中随机抽出10名列出来，于是构造如下SQL语句：

SELECT * FROM article where id IN(SELECT id FROM article ORDER BY counter DESC LIMIT 50) ORDER BY rand() LIMIT 10

执行该语句，MySQL提示错误：

#1235 - This version of MySQL doesn't yet support 'LIMIT & IN/ALL/ANY/SOME subquery'

 

无奈Google之，发现解决办法就是再子查询中再嵌套一层查询：

SELECT * FROM article where id IN(select id from(SELECT id FROM article ORDER BY counter DESC LIMIT 50)) ORDER BY rand() LIMIT 10

一测试居然可以，不由得感叹，人民群众真是智慧的群体啊，于是记录于此。
```
###[js格式转换](https://segmentfault.com/q/1010000008620305)
```js
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<input type="" name="">
<button>ok</button>
<div></div>
<script type="text/javascript">
    //q1
    (function() {
        var ipt = document.getElementsByTagName('input')[0],
                btn = document.getElementsByTagName('button')[0],
                div = document.getElementsByTagName('div')[0],
                obj = {};
        document.addEventListener('keyup', function(e) {
            if (e.keyCode === 13) {
                btn.click();
            }
        });

        btn.addEventListener('click', function(e) {
            var temp; //增加
            obj = temp ={};//增加
            var v = ipt.value;
            if (v === "") {
                div.innerHTML = ('no input!');
            } else {
                var arr = v.split(/[, _]/);
                console.log(arr);
                for (var i = 0; i < arr.length; i++) {
                    temp[arr[i]]={};//增加
                    temp=temp[arr[i]];//增加
                }
                div.innerHTML = ('obj = ' + JSON.stringify(obj));
            }
        });
    }());
    //q2
</script>
</body>
</html>

    var str ="key3,key2,key3,key1";
    var obj ={};
    var strList = str.split(",");
    for(var i = strList.length;i >= 0;--i){
        var obj2={};
        obj2[strList[i]]=obj;
        obj = obj2;
    }
    console.log(obj);
```
###[没有延迟执行呢](https://segmentfault.com/q/1010000008623047)
```js
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <script src="http://4g.ruxiancom.com/skin/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".nihao").click(
                    function(){
                        setTimeout("test()",50000); "test()" 改为 test
                        function test(){
                            $(".keyi").hide("slow",function(){
                                alert("我要隐藏了");
                            });
                        }
                    }
                )
            }
        )
    </script>
</head>
<body>
    <div class="nihao">我可以点击一下吗</div>
    <div class="keyi">你要是点击我就隐藏了</div>
</body>

参数需要一个回调函数, 即为setTimeout中, 你可以理解为setTimeout要执行的函数,
test()//此处为立即调用了test, 如果test()有返回函数, 则在立即调用之后, setTimeout的回调函数为test()的返回值.
例:

function test(){
  console.log("first");
  return  function(){
    console.log("secend");
  }
}
setTimeout(test(), 1000)
$(document).ready(function () {
    $(".nihao").click(function () {
        setTimeout(function() { test(); }, 1000);

        function test() {
            $(".keyi").hide("slow", function () {
                alert("我要隐藏了");
            });
        }
    })
});
</html>
```
###[关联查询的sql查询不全的问题](https://segmentfault.com/q/1010000008615512)
SELECT attop_article_type.id,COUNT(attop_article.type)FROM attop_article_type LEFT JOIN attop_article ON attop_article_type.id=attop_article.type GROUP BY attop_article.type ORDER BY attop_article_type.id;

select id,title,(select count(*) from attop_article where attop_article.type = attop_article_type.id) as count from attop_article_type;

###[多行超出省略最好的解决办法](https://segmentfault.com/q/1010000008623091)
```js
p {
    position:relative;
    line-height:1.4em;
    /*三倍line-height去显示三行*/
    height:4.2em;
    /*多余的隐藏*/
    overflow:hidden;
}
p::after {
    content:"...";
    font-weight:bold;
    position:absolute;
    bottom:0;
    right:0;
    padding:0 20px 1px 45px;
    background:url(http://css88.b0.upaiyun.com/css88/2014/09/ellipsis_bg.png) repeat-y;
}
text-overflow: ellipsis;
```
###[闭包](https://segmentfault.com/q/1010000008621480)

###[女神](https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxgeticon?seq=666763777&username=@4f873dc74aadf84024d98e388ce128ca&skey=@crypt_62a633fb_209bfde195bcf54b88f99ce2646e0a1d&type=big)
###[求windows下git bash配色方案及方法](https://segmentfault.com/q/1010000008603023)
$ cd ~

$ vim .minttyrc https://github.com/mavnn/mintty-colors-solarized
###[TCP的三次握手和HTTP的返回状态](https://segmentfault.com/q/1010000008610755)
1xx：请求收到，继续处理
2xx：操作成功收到，分析、接受
3xx：完成此请求必须进一步处理
4xx：请求包含一个错误语法或不能完成
5xx：服务器执行一个完全有效请求失败
HTTP 是基于TCP协议的。
只有在TCP协议三次握手成功之后，上层协议（本例为HTTP）才会工作。
HTTP状态码是定义HTTP请求响应状态码，能正常发出/接收响应，证明HTTP协议工作正常
没有关系。分层就是为了让层与层之间没有关系。

TCP 的三次握手是为了保证通信的可靠性。HTTP 的状态码是对服务器返回的对请求的处理状态。

HTTP 建立在 TCP 的基础上，TCP 建立了通信链路，HTTP 通过这个链路让服务器和浏览器通信。能进行HTTP通信了，就是说明 TCP 已经建立好了。

如果 TCP 建立失败，浏览器显示的是无法找到找服务，或者是服务器响应时间过长。如果是服务器处理错误，浏览器显示的就是 HTTP 返回的内容，即服务器返回给浏览器的信息。
###[]()
```js
pip install git+https://github.com/mstamy2/PyPDF2
def getDataUsingPyPdf2(filename):  
    pdf = PdfFileReader(open(filename, "rb"))  
    content = ""  
    for i in range(0, pdf.getNumPages()):  
        extractedText = pdf.getPage(i).extractText()  
        content +=  extractedText + "\n"  
    #return content.encode("ascii", "ignore")  
    return content
from PyPDF2 import PdfFileWriter, PdfFileReader

output = PdfFileWriter()
input1 = PdfFileReader(open("document1.pdf", "rb"))

# print how many pages input1 has:
print "document1.pdf has %d pages." % input1.getNumPages()

# add page 1 from input1 to output document, unchanged
output.addPage(input1.getPage(0))

# add page 2 from input1, but rotated clockwise 90 degrees
output.addPage(input1.getPage(1).rotateClockwise(90))

# add page 3 from input1, rotated the other way:
output.addPage(input1.getPage(2).rotateCounterClockwise(90))
# alt: output.addPage(input1.getPage(2).rotateClockwise(270))

# add page 4 from input1, but first add a watermark from another PDF:
page4 = input1.getPage(3)
watermark = PdfFileReader(open("watermark.pdf", "rb"))
page4.mergePage(watermark.getPage(0))
output.addPage(page4)


# add page 5 from input1, but crop it to half size:
page5 = input1.getPage(4)
page5.mediaBox.upperRight = (
    page5.mediaBox.getUpperRight_x() / 2,
    page5.mediaBox.getUpperRight_y() / 2
)
output.addPage(page5)

# add some Javascript to launch the print window on opening this PDF.
# the password dialog may prevent the print dialog from being shown,
# comment the the encription lines, if that's the case, to try this out
output.addJS("this.print({bUI:true,bSilent:false,bShrinkToFit:true});")

# encrypt your new PDF and add a password
password = "secret"
output.encrypt(password)

# finally, write "output" to document-output.pdf
outputStream = file("PyPDF2-output.pdf", "wb")
output.write(outputStream)
```
###[使用第三方的守护程序启动，比如 forever 、 pm2](https://segmentfault.com/q/1010000008567492)
```js
npm install pm2 -g
2.用pm2运行你的项目入口文件

pm2 start [项目入口文件].js
3.如果需要热更新，需要加上参数--watch

pm2 start [项目入口文件].js --watch
###[求教使用python库提取pdf](https://segmentfault.com/q/1010000008611030)
使用过pypdf 对英文pdf文档处理比较简单，但是对中文的支持好像不太好
import textract
import pyPdf
import pdf2text
import pdfminer
import chardet

text = textract.process("F:ll.pdf",method = 'pdfminer')print text
import textract
import pyPdf
import pdfminer
import chardet

text = textract.process("F:ll.pdf",method = 'pdfminer')print text
```
###[有没有适配移动页面的pdf转html工具](https://segmentfault.com/q/1010000008611494)
###[javascript动态插入DOM节点详细过程如何](https://segmentfault.com/q/1010000008604339)
```js
<iframe src="A.html" width="" height=""></iframe>
<iframe src="null" name="frame" id="frame" width="" height=""></iframe>
<ul>
    <li><a href="B.html" target="frame">我是主角，点我右边跳到页B</a><b onclick="new A()">点我new A()</b></li>
    <li><a href="C.html" target="frame">我是配角，点我右边跳刀页C</a></li>
</ul>
<script type="text/javascript">
    function A() {
        if (!this.dom) {
            this.dom = this.create()
            this.bindEvent()
            this.append()
        } else {
            /* OOXX */
            this.append()
        }
    }
    A.prototype.create = function() {
        /* 创建DOM对象 append到右侧iFrame */
        return document.createElement('div');
    }
    A.prototype.append = function() {
        /* 把this.dom追加到父容器 假定是body */
        top.document.getElementById('frame').contentDocument.body.appendChild(this.dom);
    }
    A.prototype.bindEvent = function() {
        /* 绑定事件 click, alert(123)*/
        this.dom.addEventListener('click', function() {
            alert(1)
        }, false);
    }
</script>
```

###[一个表只能有一个 自增键](https://segmentfault.com/q/1010000008610794)
```js
如果你的主键已经是自增了，那么这个表不能再有自增键了。
如果你的主键是非自增的，那么可以设置一个

ALTER TABLE `weibo`
ADD COLUMN `serial`  bigint UNSIGNED NOT NULL AUTO_INCREMENT AFTER `id`,
ADD INDEX `serial` (`serial`) USING BTREE,
AUTO_INCREMENT=94381;

create table test(
   id int not null,
   noid int not null auto_increment,
   primary key(id), --如果主键设置了自增长，那么其他列就不能在设置自增长了
   key(noid) -- 如果给其他列设置自增长，那么必须为其创建一个索引，索引类型有很多，自行查资料
)engine=xxx auto_increment=10000;
```

###[内部函数调用对象的问题](https://segmentfault.com/q/1010000008603916)
```js
function Person(name){
    var name=name;
    function getName(){
        return name;
    }
    getName();
}
Person("Nicholas");
在全局作用域中，调用Person("Nicholas")对象是window,那么在Person函数的内部，
调用getName()函数的对象该是谁呢？？？

补充:
 function Person(name){
    var name=name;
    function getName(){
        alert(name);
    }
    window.getName();//window.getName is not a function 
}
Person("Nicholas");
```
###[腾讯视频播放页地址怎么得到视频的真实地址](https://segmentfault.com/q/1010000008626828)
document.querySelector('.mod_episode').querySelectorAll('.item').forEach(item=>{console.log(item.id)})
https://h5vv.video.qq.com/getinfo?callback=txplayerJsonpCallBack_getinfo_336358&charge=0&vid=f0157y2e83y&defaultfmt=auto&otype=json&guid=fd59d5ff4c6123d34abef67d8fc15506&platform=10901&defnpayver=1&appVer=3.0.0&sdtfrom=v1010&host=v.qq.com&_rnd=1489037475&defn=&fhdswitch=0&show1080p=1&isHLS=0&newplatform=10901&_qv_rmt=GOWWn6AmA18077APA%3D&_qv_rmt2=LTukpg0E149345heg%3D&_1489037475190= 
```js
function get_url($url)
{
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result=curl_exec($ch);
    $code=curl_getinfo($ch,CURLINFO_HTTP_CODE);
    if($code!='404' && $result)
    {
        return $result;
    }
    curl_close($ch);
}
function get_tc_video($url)
{
    if(!$url) { return false; }
    $sp = explode('/', $url);
    $code = end($sp);
    $code = explode('.', $code)[0];
    $res = get_url('http://vv.video.qq.com/getinfo?otype=json&platform=11001&vid='.$code);
    $res = mb_substr(mb_strcut($res, 13),0,-1);
    $res = json_decode($res, true);
    $u = $res['vl']['vi'][0];
    $p0 = $u['ul']['ui'][0]['url'];
    $p1 = $u['fn'];
    $p2 = $u['fvkey'];
    return $p0.$p1.'?vkey='.$p2;  
}
```
###[引用返回](https://segmentfault.com/q/1010000008626085)
```js
class foo {
    public $value = 42;

    public function &getValue() {
        return $this->value;
    }
}

$obj = new foo;
$referenceValue = &$obj->getValue();
$myValue = $obj->getValue();
$obj->value = 2;
echo $referenceValue; // 输出2
echo $myValue; // 输出42 http://php.net/manual/zh/language.references.return.php 
```
###[php 2的n次方](https://segmentfault.com/q/1010000008625910)
```js
function sum($n){
  $i = 0;
  $t = 0;
  $arr = [];
   while(++$i && $i < $n){
     $tmp = pow(2,$i);
     $t+=$tmp;
     $arr[] = $tmp;
     if($t == $n) {
        return $arr;
     }
   }
}
print_r( sum(254));
Array
(
    [0] => 2
    [1] => 4
    [2] => 8
    [3] => 16
    [4] => 32
    [5] => 64
    [6] => 128
)
```
###[文章、分类、标签的mysql查询问题](https://segmentfault.com/q/1010000008601655)

```js
CREATE TABLE `articles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

CREATE TABLE `tags` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

CREATE TABLE `tag_links` (
    `aid` int(11) NOT NULL,
    `tid` int(11) NOT NULL,
    PRIMARY KEY (`aid`,`tid`)
);

-- insert demo data

INSERT INTO `articles` (`id`,`title`) VALUES (1,'xxx'),(2,'a'),(3,'b');
INSERT INTO `tags` (`id`,`name`) VALUES (1,'php'),(2,'java'),(3,'sql');

INSERT INTO `tag_links` (`aid`,`tid`) VALUES (1,2),(1,3);
INSERT INTO `tag_links` (`aid`,`tid`) VALUES (2,1),(2,3);

-- query statement

SELECT a.title as 'title',
(
    SELECT GROUP_CONCAT(t.name,' ') FROM `tags` t 
    LEFT JOIN `tag_links` tl 
    ON t.id=tl.tid 
    WHERE tl.aid=a.id
) as 'tags'
FROM `articles` a;

```
###[判断每个月的每一周是几号到几号](https://segmentfault.com/q/1010000008608311)

```js
class GetWeeksOfMonths
{
    public $_month;

    public $_week =array( '1'=>'first','2'=>'second','3'=>'third','4'=>'fourth','5'=>'fifth');

    public $_months = array('january','february','march','april','may','june','july','august ','september','october','november','december');
    public function __construct($month)
    {
        header('Content-Type:text/html;charset:utf-8');
    
        $this->_month = $this->_months[$month];

    }
    //return array
    public function get_weeks_of_months()
    {
        $week = $this->get_total_weeks();
        //$total = array();
        for($i=1;$i<=$week;$i++)
        {
            if($i==$week)
            {
                $start ='第 '.$i.' 周: ';
                $monday =  date('Y-m-d', strtotime( $this->_week[$i].' monday of '.$this->_month));
                $sunday =  date('Y-m-d', strtotime('last day of '.$this->_month));
            }
            else
            {
                $start ='第 '.$i.' 周: ';
                $monday =  date('Y-m-d', strtotime( $this->_week[$i].' monday of '.$this->_month));
                $sunday =  date('Y-m-d', strtotime( $monday.' +6 day'));
            }
            
            $total[]=$monday.' to '.$sunday;
            
            

print_r(date('Y-m-d', strtotime('first mon of january'))); 
for($i=1;$i<=52;$i++){
    $month = ($i < 10) ? '0'.$i : $i;
    echo '第'.$i.'周开始：';
    $monday = date('Y-m-d', strtotime('2017W'.$month));
    echo $monday;
    echo '第'.$i.'周结束：';
    $sunday = date('Y-m-d' ,strtotime($monday . '+6day'));
    echo $sunday;
    echo '<br>';
}

function get_weekinfo($month){
    $weekinfo = array();
    $end_date = date('d',strtotime($month.' +1 month -1 day'));
    for ($i=1; $i <$end_date ; $i=$i+7) { 
        $w = date('N',strtotime($month.'-'.$i));
 
        $weekinfo[] = array(date('Y-m-d',strtotime($month.'-'.$i.' -'.($w-1).' days')),date('Y-m-d',strtotime($month.'-'.$i.' +'.(7-$w).' days')));
    }
    return $weekinfo;
}
print_r(get_weekinfo('2013-11'));
 
//执行结果
Array    
(    
   [0] => Array    
       (    
           [0] => 2013-11-25    
           [1] => 2013-12-01    
       )    
   [1] => Array    
       (    
           [0] => 2013-12-02    
           [1] => 2013-12-08    
       )    
   [2] => Array    
       (    
           [0] => 2013-12-09    
           [1] => 2013-12-15    
       )    
   [3] => Array    
       (    
           [0] => 2013-12-16    
           [1] => 2013-12-22    
       )    
   [4] => Array    
       (    
           [0] => 2013-12-23    
           [1] => 2013-12-29    
       )    
)


/**
 * @param DateTime|int|string|null $date 可以是DateTime对象、时间戳、字符串形式的日期或者空值表示当前月份
 * @return array [[1,2,3,4,5], ...] 分别表示这月每一周都是几号到几号
 */
function getWeeksOfMonth($date=null){
    if (is_numeric($date)){
        $d = new DateTime();
        $d->setTimestamp($date);
        $date = $d;
    } else if (is_string($date)){
        $date = new DateTime($date);
    } else if ($date instanceof DateTime){
        // nothing to do
    } else if (!$date){
        $date = new DateTime();
    } else {
        throw new InvalidArgumentException("Invalid type of date!");
    }


    // 当前日期是在一个月里面是第几天
    //  j: 月份中的第几天，没有前导零    1 到 31
    $dateDay = (int)$date->format('j');

    // 这个月1号是星期几
    // N: 1（表示星期一）到 7（表示星期天）
    $beginWeekDay = (int)$date->sub(new DateInterval("P" . ($dateDay - 1) . "D"))->format('N');

    // 这个月最后一天是几号
    // j    月份中的第几天，没有前导零    1 到 31
    $endMonthDay = (int)($date->add(new DateInterval('P1M'))->sub(new DateInterval("P1D"))->format('j'));

    $weeks = [];
    $indexOfWeek = 0;
    $weekDay = $beginWeekDay;

    for ($day = 1; $day <= $endMonthDay; $day++){
        if (!isset($weeks[$indexOfWeek])){
            $weeks[$indexOfWeek] = [];
        }

        $weeks[$indexOfWeek][] = $day;

        $weekDay++;
        if ($weekDay > 7){
            $weekDay = $weekDay - 7;
            $indexOfWeek++;
        }
    }

    // 只要一个星期里面的第一天和最后一天？
    foreach ($weeks as &$week) {
        $week = [$week[0], end($week)];
    }

    return $weeks;
}

// 测试一下：
foreach (getWeeksOfMonth() as $week){
    echo implode(", ", $week) . "\n";
}

// 输出：（今天是2017-03-08）
// 1, 5
// 6, 12
// 13, 19
// 20, 26
// 27, 31
// 



```
###[请问那个带授权的视频怎么下载](https://segmentfault.com/q/1010000008607901)

让视频加载结束，到浏览器缓存目录中找到大小时间吻合的文件
我是 win10 chrome 中测试缓存目录是 C:\Users\当前登录用户名\AppData\Local\Google\Chrome\User Data\Default\Cache ，然后把找到吻合的文件添加上后缀就可以正常使用了
###[获取网页默认字体的字号大小?](https://segmentfault.com/q/1010000008605788)
getComputedStyle(document.getElementsByTagName("p")[0],undefined).fontSize就可以

刚刚试了用getComputedStyle(document.getElementsByTagName("p")[0],undefined).getPropertyValue("font-size")也可以,你这个更方便
###[PHP多维数组排序问题](https://segmentfault.com/q/1010000008605080)
```js
如果a相等，那么比较b，b相等再比较c，排序完在生成个新字段sort 作为标识
        $arr = [
            0 =>[
                a=>1,
                b=>3,
                c=>3
            ],
            1=>[
                a=>2,
                b=>2,
                c=>3
            ],
            2=>[
                a=>1,
                b=>2,
                c=>3
            ]
        ];
        for($i = 0;$i < count($arr); $i++){
            for($j = $i+1;$j <count($arr);$j++){
                $temp1 = $arr[$i];
                $temp2 = $arr[$j];
                if($temp1["a"] > $temp2["a"] || ($temp1["a"] == $temp2["a"] && $temp1["b"] > $temp2["b"]) || ($temp1["a"] == $temp2["a"] && $temp1["b"] == $temp2["b"] && $temp1["c"] > $temp2["c"])){
                    $arr[$i] = $temp2;
                    $arr[$j] = $temp1;
                }
            }
        }
        var_dump($arr);
	<?php

$a = $b = $c = [];

array_map(function( $value ) use ( &$a,&$b,&$c ){
      array_push($a, $value['a']);
      array_push($b, $value['b']);
      array_push($c, $value['c']);
} , $arr);

$count = $arr;

var_dump($count);
array_multisort(
    $a,SORT_ASC,
    $b,SORT_ASC,
    $c,SORT_ASC,
    $arr
);

var_dump($arr);
```
###[如何使用html5的FileApi上传大文件](https://segmentfault.com/q/1010000008603884)

https://github.com/recca0120/upload  https://famanoder.com/bokes/5867fddf4aee37201fb4d1d3 
###[如何在浏览器上启动本地的应用程序](https://segmentfault.com/q/1010000008596199)
http://geeklu.com/2011/01/start-application-from-url-talk-about-wangwang/
###[正则表达式匹配@和空格之间的字符](https://segmentfault.com/q/1010000008594625)
```js
preg_match('/@(.*) /', 'AAA@XXX YYYY', $result);
if(preg_match_all(
    '%@(\w+)%u', 
    '@张全蛋 含泪质检@三星Note7 被炸飞,听说@炸机 跟@啤酒 更配哦!', 
    $arr
)) {
    var_export($arr);
}
//输出
array (
  0 => 
  array (
    0 => '@张全蛋',
    1 => '@三星Note7',
    2 => '@炸机',
    3 => '@啤酒',
  ),
  1 => 
  array (
    0 => '张全蛋',
    1 => '三星Note7',
    2 => '炸机',
    3 => '啤酒',
  ),
)
正则表达式 %@(\w+)%u 中:
%是分隔符.
u是修饰符,表示unicode.
\w是元字符,在ASCII下等价于[A-Za-z0-9_],在unicode下表示字符(包括中文)和数字和下划线.
+是量词,表示1个或多个,等价于{1,}的写法.
()表示子模式,体现在匹配结果中的$arr[1]里.
区别于主模式,体现在匹配结果中的$arr[0]里.

另外,也可以试试下面这个正则表达式:

%@(\S+)\s%
其中:
\s   匹配空白字符,包括:空格,制表符(\t,\v),回车(\r),换行(\n),换页(\f),等价于[ \t\r\n\v\f]
\S   匹配除空白字符外的任意字符,等价于[^ \t\r\n\v\f]
另外:

preg_match:     返回模式的匹配次数,0次(不匹配)或1次,因为preg_match在第1次匹配后会停止搜索.
preg_match_all: 返回完整匹配次数,如果发生错误返回FALSE.
也就是说,如果上面的例子使用preg_match,那只能匹配到字符串中的"张全蛋".
```
###[php56-redis 安装出错](https://segmentfault.com/q/1010000008594306)

brew install php56-igbinary --build-from-source



###[python list 写进txt中的问题](https://segmentfault.com/q/1010000008604099)
```js
# -*- coding: utf-8 -*-
import sys

reload(sys)
sys.setdefaultencoding('utf-8')

from bs4 import BeautifulSoup
import requests
url = 'http://news.qq.com/'
wb_data = requests.get(url).text
soup = BeautifulSoup(wb_data,'lxml')
news_titles = soup.select('div.text > em.f14 > a.linkto')
file = open('新闻.txt', 'a')
for n in news_titles:
    title = n.get_text()

    link = n.get("href")
    b = str(title) + ' 链接: ' + link +"\n"
    file.write(str(b))

file.close()

for n in news_titles:
    title = n.get_text()

    link = n.get("href")


    b = []
    b.append(title + '链接' + link)
    
with open('/Users/sufan/Desktop/新闻.txt', 'w') as file:
    file.write(str(b))
```

###[大家有javascript检测回文](https://segmentfault.com/q/1010000008606309)
```js
function isHuiwen(text) {
  if(text.length <= ) return true;
  if(text.charAt(0) != text.chatAt(text.length - 1)) return false;
  return isHuiwen(text.substr(1, text.length - 2));
}
function isHuiwen(str){
     str = str.replace(/\W\s_/gi,'');
     return str.toLowerCase == str.split('').reverse().join('').toLowerCase();
}
return  text.split('').reverse().join('')==text;
function palindrome(str) {
    if (!str) return false; // null或undefined
    for ( var i = 0, len = str.length; i < Math.floor(len/2); i++ ) {
        if (str[i] !== str[len - 1 - i]) {
            return false;
        }
    }
    return true;
}
['1', null, '121', '111', undefined, '1a1', 'asdf', '', '我为人人人人为我'].forEach(function(v) {
    console.log(v, palindrome(v) ? '是回文' : '不是回文');
});
```
###[Python 练习实例2](http://www.runoob.com/python/python-exercise-example2.html)
```js
利润(I)低于或等于10万元时，奖金可提10%；利润高于10万元，低于20万元时，低于10万元的部分按10%提成，高于10万元的部分，可提成7.5%；20万到40万之间时，高于20万元的部分，可提成5%；40万到60万之间时高于40万元的部分，可提成3%；60万到100万之间时，高于60万元的部分，可提成1.5%，高于100万元时，超过100万元的部分按1%提成，从键盘输入当月利润I，求应发放奖金总数
i = int(raw_input('净利润:'))
arr = [1000000,600000,400000,200000,100000,0]
rat = [0.01,0.015,0.03,0.05,0.075,0.1]
r = 0
for idx in range(0,6):
    if i>arr[idx]:
        r+=(i-arr[idx])*rat[idx]
        print (i-arr[idx])*rat[idx]
        i=arr[idx]
print r
输入某年某月某日，判断这一天是这一年的第几天

year = int(raw_input('year:\n'))
month = int(raw_input('month:\n'))
day = int(raw_input('day:\n'))
 
months = (0,31,59,90,120,151,181,212,243,273,304,334)
if 0 < month <= 12:
    sum = months[month - 1]
else:
    print 'data error'
sum += day
leap = 0
if (year % 400 == 0) or ((year % 4 == 0) and (year % 100 != 0)):
    leap = 1
if (leap == 1) and (month > 2):
    sum += 1
print 'it is the %dth day.' % sum

斐波那契数列。
def fib(n):
	a,b = 1,1
	for i in range(n-1):
		a,b = b,a+b
	return a
 # 使用递归
def fib(n):
	if n==1 or n==2:
		return 1
	return fib(n-1)+fib(n-2)
def fib(n):
    if n == 1:
        return [1]
    if n == 2:
        return [1, 1]
    fibs = [1, 1]
    for i in range(2, n):
        fibs.append(fibs[-1] + fibs[-2])
    return fibs
输出 9*9 乘法口诀表
for i in range(1, 10):
    print 
    for j in range(1, i+1):
        print "%d*%d=%d" % (i, j, i*j),    
print time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))

古典问题：有一对兔子，从出生后第3个月起每个月都生一对兔子，小兔子长到第三个月后每个月又生一对兔子，假如兔子都不死，问每个月的兔子总数为多少？
兔子的规律为数列1,1,2,3,5,8,13,21....
f1 = 1
f2 = 1
for i in range(1,21):
    print '%12ld %12ld' % (f1,f2),
    if (i % 3) == 0:
        print ''
    f1 = f1 + f2
    f2 = f1 + f2
判断101-200之间有多少个素数，并输出所有素数。
程序分析：判断素数的方法：用一个数分别去除2到sqrt(这个数)，如果能被整除，则表明此数不是素数，反之是素数。    
h = 0
leap = 1
from math import sqrt
from sys import stdout
for m in range(101,201):
    k = int(sqrt(m + 1))
    for i in range(2,k + 1):
        if m % i == 0:
            leap = 0
            break
    if leap == 1:
        print '%-4d' % m
        h += 1
        if h % 10 == 0:
            print ''
    leap = 1
print 'The total is %d' % h
所谓"水仙花数"是指一个三位数，其各位数字立方和等于该数本身。例如：153是一个"水仙花数"，因为153=1的三次方＋5的三次方＋3的三次方。

for n in range(100,1000):
    i = n / 100
    j = n / 10 % 10
    k = n % 10
    if n == i ** 3 + j ** 3 + k ** 3:
        print n
一球从100米高度自由落下，每次落地后反跳回原高度的一半；再落下，求它在第10次落地时，共经过多少米？第10次反弹多高？
tour = []
height = []
 
hei = 100.0 # 起始高度
tim = 10 # 次数
 
for i in range(1, tim + 1):
    tour.append(hei)
    hei /= 2
    height.append(hei)
 
print('总高度：tour = {0}'.format(sum(tour)))
print('第10次反弹高度：height = {0}'.format(height[-1]))
有一分数序列：2/1，3/2，5/3，8/5，13/8，21/13...求出这个数列的前20项之和
a = 2.0
b = 1.0
s = 0
for n in range(1,21):
    s += a / b
    t = a
    a = a + b
    b = t
print s

a = 2.0
b = 1.0
l = []
for n in range(1,21):
    b,a = a,a + b
    l.append(a / b)
print reduce(lambda x,y: x + y,l)
求1+2!+3!+...+20!的和。
n = 0
s = 0
t = 1
for n in range(1,21):
    t *= n
    s += t
print '1! + 2! + 3! + ... + 20! = %d' % s
1 2 6 24 120 720 5040 40320 362880 3628800 39916800 479001600 6227020800 8717829
1200 1307674368000 20922789888000 355687428096000 6402373705728000 1216451004088
32000 2432902008176640000
利用递归方法求5!
def fact(j):
    sum = 0
    if j == 0:
        sum = 1
    else:
        sum = j * fact(j - 1)
    return sum

for i in range(5):
    print '%d! = %d' % (i,fact(i))

有5个人坐在一起，问第五个人多少岁？他说比第4个人大2岁。问第4个人岁数，他说比第3个人大2岁。问第三个人，又说比第2人大两岁。问第2个人，说比第一个人大两岁。最后问第一个人，他说是10岁。请问第五个人多大
def age(n):
    if n == 1: c = 10
    else: c = age(n - 1) + 2
    return c
print age(5)
x = int(raw_input("计算个十百千万数字:\n"))
a = x / 10000
b = x % 10000 / 1000
c = x % 1000 / 100
d = x % 100 / 10
e = x % 10
一个5位数，判断它是不是回文数。即12321是回文数，个位与万位相同，十位与千位相同。
求100之内的素数。
for num in range(2,101):
	# 素数大于 1
	if num > 1:
		for i in range(2,num):
			if (num % i) == 0:
				break
		else:
			print(num)
将一个数组逆序输出。
a = [9,6,5,4,1]
    N = len(a) 
    print a
    for i in range(len(a) / 2):
        a[i],a[N - i - 1] = a[N - i - 1],a[i]用第一个与最后一个交换。
    print a
MAXIMUM = lambda x,y :  (x > y) * x + (x < y) * y
MINIMUM = lambda x,y :  (x > y) * y + (x < y) * x
MAXIMUM(a,b)
求0—7所能组成的奇数个数。
sum = 4
    s = 4
    for j in range(2,9):
        print sum
        if j <= 2:
            s *= 7
        else:
            s *= 8
        sum += s
    print 'sum = %d' % sum
  有n个人围成一圈，顺序排号。从第一个人开始报数（从1到3报数），凡报到3的人退出圈子，问最后留下的是原来第几号的那位。
  nmax = 50
    n = int(raw_input('请输入总人数:'))
    num = []
    for i in range(n):
        num.append(i + 1)

    i = 0
    k = 0
    m = 0

    while m < n - 1:
        if num[i] != 0 : k += 1
        if k == 3:
            num[i] = 0
            k = 0
            m += 1
        i += 1
        if i == n : i = 0

    i = 0
    while num[i] == 0: i += 1
    print num[i]
```









###[TensorFlow 是一个用于人工智能的开源神器](http://www.tensorfly.cn/)
###[笔记1: 介绍TensorFlow](http://xinqiu.me/2017/01/20/cs20si-1/)

四舍六入五成双 的算法  小于等于4的时候舍去
大于等于6的时候进位
5的时候，看5前面是基数还是偶数  偶舍基进位 适合浮点计算中有强迫症的同学

四舍六入五凑偶 PHP_ROUND_HALF_EVEN 这个参数就就是：四舍五入六成双吧 parse_url() 函数可以解析 URL，获取顶级域名。

###&
```js
 $a=1;
function fun1($a){
$a=$a+1;echo $a;
}
function fun2(&$a){
  $a=$a+3;
}
echo $a;echo '<br>';1
fun1($a);echo '<br>';2
echo $a;echo '<br>';1
fun2($a);echo '<br>';4
echo $a;echo '<br>';
```
###[开源文档](http://dokuwiki.org/)
查看忘记密码 
内置的 web 服务器  nodejs anywhere 
php -S localhost:8000 python -m 
###[PHP 之道 ](http://laravel-china.github.io/php-the-right-way/)
```js
http://php.net/features.commandline.webserver https://github.com/phpbrew/phpbrew
http://pear.php.net/package/PHP_CodeSniffer/ https://github.com/benmatselby/sublime-phpcs
https://psr.phphub.org/  http://www.php-fig.org/psr/psr-0/ 
PHP-FIG 废弃了上一个自动加载标准： PSR-0，而采用新的自动加载标准 PSR-4。但 PSR-4 要求 PHP 5.3 以上的版本http://www.php-fig.org/psr/psr-4/ 
PHP 会在脚本运行时根据参数设置两个特殊的变量，$argc 是一个整数，表示参数个数，$argv 是一个数组变量，包含每个参数的值
curl -s https://getcomposer.org/composer.phar -o $HOME/local/bin/composer
chmod +x $HOME/local/bin/composer

Composer 会建立一个 composer.lock 文件，在你第一次执行 php composer install 时，存放下载的每个依赖包精确的版本编号。假如你要分享你的项目给其他开发者，并且 composer.lock 文件也在你分享的文件之中的话。 当他们执行 php composer.phar install 这个命令时，他们将会得到与你一样的依赖版本。 当你要更新你的依赖时请执行 php composer update。请不要在部署代码的时候使用 composer update，只能使用 composer install 命令，否则你会发现你在生产环境中用的是不同的扩展包依赖版本。
$end = clone $start;
$end->add(new DateInterval('P1M6D'));

$diff = $end->diff($start);
echo 'Difference: ' . $diff->format('%m month, %d days (total: %a days)') . "\n";
// Difference: 1 month, 6 days (total: 37 days)

if ($start < $end) {
    echo "Start is before end!\n";
}
在操作 Unicode 字符串时，请你务必使用 mb_* 函数。例如，如果你对一个 UTF-8 字符串使用 substr()，那返回的结果中有很大可能会包含一些乱码。正确的方式是使用 mb_substr()。
strpos() 和 strlen()，确实需要特别的处理。这些函数名中通常包含 mb_*：比如，mb_strpos() 和 mb_strlen()。
$pdo = new PDO('sqlite:/path/db/users.db');
$stmt = $pdo->prepare('SELECT name FROM users WHERE id = :id');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); // <-- filter your data first (see [Data Filtering](#data_filtering)), especially important for INSERT, UPDATE, etc.
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
$stmt->execute();
三个最常见的的信息类型是错误（error）、通知（notice）和警告（warning）。它们有不同的严重性: E_ERROR 、E_NOTICE和 E_WARNING。error_reporting(E_ERROR | E_WARNING);
基本上你可以利用 ErrorException 类抛出「错误」来当做「异常」，这个类是继承自 Exception 类。
try
{
    $email->send();
}
catch(Fuel\Email\ValidationFailedException $e)
{
    // 验证失败
}
catch(Fuel\Email\SendingFailedException $e)
{
    // 这个驱动无法发送 email
}
finally
{
    // 无论抛出什么样的异常都会执行，并且在正常程序继续之前执行
}
display_errors = On
display_startup_errors = On
error_reporting = -1将值设为 -1 将会显示出所有的错误
log_errors = On

如果黑客将一个构造的 id 参数通过像 http://domain.com/?id=1%3BDELETE+FROM+users 这样的 URL 传入。这将会使 $_GET['id'] 变量的值被设为 1;DELETE FROM users 然后被执行从而删除所有的 user 记录
PHP 5.5 中自带了 opcode 缓存工具，叫做OPcache 当一个 PHP 文件被解释执行的时候，首先是被编译成名为 opcode 的中间代码，然后才被底层的虚拟机执行。 如果PHP文件没有被修改过，opcode 始终是一样的。这就意味着编译步骤白白浪费了 CPU 的资源。
```
