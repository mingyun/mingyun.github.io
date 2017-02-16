###[PHP引用(&)各种使用方法实例详解](http://www.jb51.net/article/48267.htm)
```js
 1.变量的引用
 $a="ABC";
    $b =&$a;
    echo $a;//这里输出:ABC
    echo $b;//这里输出:ABC
    $b="EFG";
    echo $a;//这里$a的值变为EFG 所以输出EFG
    echo $b;//这里输出EFG
 2.函数的引用传递（传址调用）     
      
      function test(&$a)
    {
        $a=$a+100;
    }
    $b=1;
    echo $b;//输出１
    test($b);   //这里$b传递给函数的其实是$b的变量内容所处的内存地址，通过在函数里改变$a的值　就可以改变$b的值了
    在这里test(１);的话就会出错，原因是：PHP规定传递的引用不能为常量（可以看错误提示）。http://www.cnblogs.com/thinksasa/p/3334492.html
    echo "<br>";
    echo $b;//输出101
    但是在函数“call_user_func_array”中，若要引用传参，就得需要 & 符号，如下代码所示：
    
    function a(&$b){
    $b++;
}
$c=0;
call_user_func_array('a',array(&$c));
echo $c;
//输出 1
function &test()
{
    static $b=0;//申明一个静态变量
    $b=$b+1;
    echo $b;
    return $b;
}
$a=test();//这条语句会输出　$b的值　为１
$a=5;
$a=test();//这条语句会输出　$b的值　为2
$a=&test();//这条语句会输出　$b的值　为3
$a=5;
$a=test();//这条语句会输出　$b的值　为6

```
###[手握两亿条密码，我都干了些什么！](https://zhuanlan.zhihu.com/p/25056106)
