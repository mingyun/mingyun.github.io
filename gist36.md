[php解决中文截取乱码问题](http://www.cnblogs.com/loveyoume/p/6081930.html)
```js
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
