

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
