###[python指定utf-8编码](https://segmentfault.com/q/1010000008093604)
https://www.python.org/dev/peps/pep-0263/
只要符合下面这个正则即可：

^[ \t\v]*#.*?coding[:=][ \t]*([-_.a-zA-Z0-9]+)
###[shell调试](https://segmentfault.com/q/1010000008183336)
set -xv
ls -rlt 'file_name_not_exits.txt'
echo "$?" && if [ "$?" == "1" ]; then echo "错误存在" fi
###[ajax fetch](https://segmentfault.com/q/1010000008185107)
```js
fetch('http://hq.sinajs.cn/list=s_sz399001', {
    method: 'GET',
    headers: {
      'Accept': 'application/json, text/javascript, */*; q=0.01',
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    },
    mode: 'cors',
    credentials: 'credentials',
    cache: 'default'
  })
  .then((resp) => {
    return resp.text();
  })
  .then((str) => {
    console.log(str);
    console.log(str.match(/\=\"(.*?)\"/)[1])
  })
  .catch((err) => {
    console.error(err);
  });
  function getStr(str) {
  eval(str.replace(/var (.*?)( ?)=/, function(a, b, c) {
    return 'var aa' + c + '=';
  }))
  return aa;
}

console.log(getStr(`var hq_str_s_sz399001="深证成指,9906.14,137.565,1.41,126388534,18146230";`))
```
###[下载excel文件](https://segmentfault.com/q/1010000008182958)
```js
function fake_click(obj) {
  var ev = document.createEvent('MouseEvents');
  ev.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
  obj.dispatchEvent(ev);
}
https://segmentfault.com/q/1010000008187200 
function export_raw(name, data) {
  var urlObject = window.URL || window.webkitURL || window;
  var export_blob = new Blob([data]);
  var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a')
  save_link.href = urlObject.createObjectURL(export_blob);
  save_link.download = name;
  fake_click(save_link);
}
```
###[unicode转中文](https://segmentfault.com/q/1010000008185071)
```js
function convert2Unicode(str) {
    return str.replace(/[\u0080-\uffff]/g,
    function($0) {
        var tmp = $0.charCodeAt(0).toString(16);
        return "\u" + new Array(5 - tmp.length).join('0') + tmp;
    });
}
decodeURIComponent('\u6211\u662F')
function unicode2ch($str)
{
    if (!$str) {
        return false;
    }
    if($decode=json_decode($str)){
        return $decode;
    }
    $str = '['.$str.']';
    $decode = json_decode($str);
    if(count($decode)===1){
        return $decode[0];
    }
    return false;
}

$st = '中';
$en = json_encode($st);//"\u4e2d"
echo unicode2ch($en);//中
```
###[php将unicode编码转为utf-8方法](http://www.welefen.com/post/php-unicode-to-utf8.html)
```js
function unicode2utf8($str){
        if(!$str) return $str;
        $decode = json_decode($str);
        if($decode) return $decode;
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
        if(count($decode) == 1){
                return $decode[0];
        }
        return $str;
}
js将汉字转为实体字符
function convert2Entity(str) {
    var len = str.length;
    var re = [];
    for (var i = 0; i < len; i++) {         
        var code = str.charCodeAt(i);         if (code > 256) {
            re.push('&#' + code + ';');
        } else {
            re.push(str.charAt(i));
        }
    }
    return re.join('');
}
php将实体字符转为utf-8汉字的方法
function entity2utf8onechar($unicode_c){
    $unicode_c_val = intval($unicode_c);
    $f=0x80; // 10000000
    $str = "";
    // U-00000000 - U-0000007F:   0xxxxxxx
    if($unicode_c_val <= 0x7F){         $str = chr($unicode_c_val);     }     //U-00000080 - U-000007FF:  110xxxxx 10xxxxxx     else if($unicode_c_val >= 0x80 && $unicode_c_val <= 0x7FF){         $h=0xC0; // 11000000         $c1 = $unicode_c_val >> 6 | $h;
        $c2 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2);
    }
    //U-00000800 - U-0000FFFF:  1110xxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x800 && $unicode_c_val <= 0xFFFF){         $h=0xE0; // 11100000         $c1 = $unicode_c_val >> 12 | $h;
        $c2 = (($unicode_c_val & 0xFC0) >> 6) | $f;
        $c3 = ($unicode_c_val & 0x3F) | $f;
        $str=chr($c1).chr($c2).chr($c3);
    }
    //U-00010000 - U-001FFFFF:  11110xxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x10000 && $unicode_c_val <= 0x1FFFFF){         $h=0xF0; // 11110000         $c1 = $unicode_c_val >> 18 | $h;
        $c2 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c3 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c4 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4);
    }
    //U-00200000 - U-03FFFFFF:  111110xx 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x200000 && $unicode_c_val <= 0x3FFFFFF){         $h=0xF8; // 11111000         $c1 = $unicode_c_val >> 24 | $h;
        $c2 = (($unicode_c_val & 0xFC0000)>>18) | $f;
        $c3 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c4 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c5 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4).chr($c5);
    }
    //U-04000000 - U-7FFFFFFF:  1111110x 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx 10xxxxxx
    else if($unicode_c_val >= 0x4000000 && $unicode_c_val <= 0x7FFFFFFF){         $h=0xFC; // 11111100         $c1 = $unicode_c_val >> 30 | $h;
        $c2 = (($unicode_c_val & 0x3F000000)>>24) | $f;
        $c3 = (($unicode_c_val & 0xFC0000)>>18) | $f;
        $c4 = (($unicode_c_val & 0x3F000) >>12) | $f;
        $c5 = (($unicode_c_val & 0xFC0) >>6) | $f;
        $c6 = ($unicode_c_val & 0x3F) | $f;
        $str = chr($c1).chr($c2).chr($c3).chr($c4).chr($c5).chr($c6);
    }
    return $str;
}
function entities2utf8($unicode_c){
    $unicode_c = preg_replace("/\&\#([\da-f]{5})\;/es", "entity2utf8onechar('\\1')", $unicode_c);
    return $unicode_c;
}
```
###[按字节截取字符串](http://www.welefen.com/post/substr-by-byte.html)
```js
baidu.string.subByte1 = function(source, length) {
    return (source + '').substr(0, length).replace(/([^\x00-\xff])/g, '$1 ').substr(0, length).replace(/([^\x00-\xff]) /g, '$1');
}
```
###[相似图片搜索的php实现](http://www.welefen.com/post/similar-image-search-in-php.html)
```js
class Imghash{


 private static $_instance = null;


 public $rate = 2;


 public static function getInstance(){


 if (self::$_instance === null){
     self::$_instance = new self();
 }
 return self::$_instance;

 }
 public function run($file){


 if (!function_exists('imagecreatetruecolor')){
     throw new Exception('must load gd lib', 1);
 }
 $isString = false;
 if (is_string($file)){
     $file = array($file);
     $isString = true;
 }
 $result = array();
 foreach ($file as $f){
     $result[] = $this->hash($f);
 }
 return $isString ? $result[0] : $result;

 }
 public function checkIsSimilarImg($imgHash, $otherImgHash){


 if (file_exists($imgHash) && file_exists($otherImgHash)){
     $imgHash = $this->run($imgHash);
     $otherImgHash = $this->run($otherImgHash);
 }
 if (strlen($imgHash) !== strlen($otherImgHash)) return false;
 $count = 0;
 $len = strlen($imgHash);
 for($i=0;$i<$len;$i++){
     if ($imgHash{$i} !== $otherImgHash{$i}){
         $count++;
     }
 }
 return $count <= (5 * $rate * $rate) ? true : false;

 }
 public function hash($file){


 if (!file_exists($file)){
     return false;
 }
 $height = 8 * $this->rate;
 $width = 8 * $this->rate;
 $img = imagecreatetruecolor($width, $height);
 list($w, $h) = getimagesize($file);
 $source = $this->createImg($file);
 imagecopyresampled($img, $source, 0, 0, 0, 0, $width, $height, $w, $h);
 $value = $this->getHashValue($img);
 imagedestroy($img);
 return $value;

 }
 public function getHashValue($img){


 $width = imagesx($img);
 $height = imagesy($img);
 $total = 0;
 $array = array();
 for ($y=0;$y<$height;$y++){
     for ($x=0;$x<$width;$x++){
         $gray = ( imagecolorat($img, $x, $y) >> 8 ) & 0xFF;
         if (!is_array($array[$y])){
             $array[$y] = array();
         }
         $array[$y][$x] = $gray;
         $total += $gray;
     }
 }
 $average = intval($total / (64 * $this->rate * $this->rate));
 $result = '';
 for ($y=0;$y<$height;$y++){
     for ($x=0;$x<$width;$x++){
         if ($array[$y][$x] >= $average){
             $result .= '1';
         }else{
             $result .= '0';
         }
     }
 }
 return $result;

 }
 public function createImg($file){


 $ext = $this->getFileExt($file);
 if ($ext === 'jpeg') $ext = 'jpg';
 $img = null;
 switch ($ext){
     case 'png' : $img = imagecreatefrompng($file);break;
     case 'jpg' : $img = imagecreatefromjpeg($file);break;
     case 'gif' : $img = imagecreatefromgif($file);
 }
 return $img;

 }
 public function getFileExt($file){


 $infos = explode('.', $file);
 $ext = strtolower($infos[count($infos) - 1]);
 return $ext;

 }
}
$instance = ImgHash::getInstance();
$result = $instance->checkIsSimilarImg('chenyin/IMG_3214.png', 'chenyin/IMG_3212.JPG');
```
###[PJAX](http://www.welefen.com/post/use-ajax-and-pushstate.html)
```js
http://www.welefen.com/post/pjax-for-ajax-and-pushstate.html
function is_pjax(){
    return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] === 'true';
}
$('#container').bind('start.pjax', function(){
    $('#loading').show();
})
$('#container').bind('end.pjax', function(){
    $('#loading').hide();
})
```
###[JS类型转换](https://zhuanlan.zhihu.com/p/24967321)
```js
var bool = new Boolean(false);
if (bool) {
	alert('true');
} else {
	alert('false');
}
有哪些东西是假值？

共6个：

0或+0、-0，NaN
""
false
undefined
null
上面的顺序是按照基本类型来排列的。

除此之外的一律不是！！哪怕是如下形式：

Infinity
'0'、'false'、" "（空格字符）
任何引用类型:[],{},function(){}
if (a && b)的正确理解方式是：a && b进行表达式求值后，然后再转换为Boolean类型。

&&是种短路语法，求值后不一定是个Boolean类型，更不是两边转化布尔值再运算。
比如 2&&3 的结果是3，不是true。
引用类型转换为布尔，始终为true

引用类型转换为字符串

1.优先调用toString方法（如果有），看其返回结果是否是原始类型，如果是，转化为字符串，返回。
2.否则，调用valueOf方法（如果有），看其返回结果是否是原始类型，如果是，转化为字符串，返回。
3.其他报错。
引用类型转化为数字
1.优先调用valueOf方法（如果有），看其返回结果是否是基本类型，如果是，转化为数字，返回。
2.否则，调用toString方法（如果有），看其返回结果是否是基本类型，如果是，转化为数字，返回。
3.其他报错。
```
###[js语言中最常用的单词](https://zhuanlan.zhihu.com/p/24949254)
```js
https://anvaka.github.io/common-words/#?lang=php
this\function\if/var/return/the/i/a/to/value
```
###[Pandas | 表格整合三大神技](https://zhuanlan.zhihu.com/p/24892205)
```js
#暴走大事件四名同学的政治,英语,语文得分,索引为0,1,2,4(学号)
df1=pd.DataFrame({'名字':['王尼玛','张全蛋','赵铁柱','李小花'],
                 '语文':[95,88,23,66],
                 '政治':[96,64,33,66],
                 '英语':[66,100,33,66]}
                  ,index=[0,1,2,4])

frame=[df1,df2]
df3=pd.concat(frame,keys=['暴走大事件','NBA'],axis=0,join='outer').fillna(0)
```
###数组用第二个元素排序
```js
s = [('a', 3), ('b', 2), ('c', 1)]
sorted(s, key=lambda x:x[1])
```
###[打印出九九乘法表](https://www.zhihu.com/question/20125256/answer/141795902)
```js
for x in range(1,10):
    for y in range(x,10):
        print('{}*{}= {} '.format(x,y,x*y),end='')
    print('')
    
    1*1= 1 1*2= 2 1*3= 3 1*4= 4 1*5= 5 1*6= 6 1*7= 7 1*8= 8 1*9= 9
2*2= 4 2*3= 6 2*4= 8 2*5= 10 2*6= 12 2*7= 14 2*8= 16 2*9= 18
3*3= 9 3*4= 12 3*5= 15 3*6= 18 3*7= 21 3*8= 24 3*9= 27
4*4= 16 4*5= 20 4*6= 24 4*7= 28 4*8= 32 4*9= 36
5*5= 25 5*6= 30 5*7= 35 5*8= 40 5*9= 45
6*6= 36 6*7= 42 6*8= 48 6*9= 54
7*7= 49 7*8= 56 7*9= 63
8*8= 64 8*9= 72
9*9= 81
```
###[Python 正则匹配跨行 HTML](https://www.v2ex.com/t/335684)
```js
[\s\S]+.*?p>(.*?)<\/p>
re.search("<p.*p>", text, re.S)
```
###[Python 解方程](https://zhuanlan.zhihu.com/p/24893371)
```js
x + 2y = 3
4x ＋ 5y = 6
In [1]: import numpy as np
   ...: A = np.mat('1,2; 4,5')    # 构造系数矩阵 A
   ...: b = np.mat('3,6').T       # 构造转置矩阵 b （这里必须为列向量）
   ...: r = np.linalg.solve(A,b)  # 调用 solve 函数求解
   ...: print r
   ...:
Out[1]: [[-1.]
         [ 2.]]

x + 2 * (x ** 2) + 3 * (x ** 3) - 6 = 0
In [4]: from sympy import *
   ...: x = symbols('x')
   ...: solve(x + 2 * (x ** 2) + 3 * (x ** 3) - 6, x)
Out[4]: [1, -5/6 - sqrt(47)*I/6, -5/6 + sqrt(47)*I/6]


```
###[imagemagick 水印 gif](https://www.v2ex.com/t/335293)
`convert -coalesce name.gif -gravity SouthEast -geometry +0+0 null: watermark.png -layers composite -layers optimize output.gif` 
###[key 里面有不可见字符](https://www.v2ex.com/t/335582#reply48)
```js
$a = []; 

$a["hell\u{2060}o"] = 1; 
$a["hello"] = 2; 
print_r($a); 

输出 
Array 
( 
[hell ⁠ o] => 1 
[hello] => 2 
)
foreach($ret as $key=>$value){ 
var_dump($key); 
var_dump(bin2hex($key)); 
}
OPcache 的锅 

https://bugs.php.net/bug.php?id=73871 
https://bugs.php.net/bug.php?id=73847
是 opcache 导致的，我用循环生成数组，且键值加 md5 解决了
```
