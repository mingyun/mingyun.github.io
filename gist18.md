###[PHP 输出 json乱码](https://www.v2ex.com/t/340206#reply28)
echo 之前加 ob_clear(); 

代码有顶格,无 bom, 是 utf-8.
后面是 C3 AF C2 BB 么？仍然是 BOM 头，只是转换过。而如果是 EF BB BF 则是没有转换过的。 
一个典型的 PHP 程序文件应该以“<?php 开头”。这个标签开始之前不应该有任何东西，包括不可见字符。 

当然还有一种可能性，就是你手头上的程序主动输出了那些内容。如果是这样， Debug 会变得很复杂：你需要去掉所有的 Output Buffer 控制（就是让内容直接输出），然后用 headers_list 以及 headers_sent 函数检查到底是谁发送了“ï”字符。
###[代码表白](https://www.zhihu.com/question/55736593)
```js
算法题目 http://hmbb.hustoj.com/  
>>> print('\x42\x65\x20\x77\x69\x74\x68\x20\x6d\x65')
Be with me
>>> print(''.join(['\\'+hex(ord(i))[1:] for i in 'be with me']))
\x62\x65\x20\x77\x69\x74\x68\x20\x6d\x65
```
###[一个循环语句输出九九乘法表](https://www.zhihu.com/question/55768263)
```js
n = 9

for i in range(n * n):
    x = i % n + 1
    y = i // n + 1

    a = lambda: print(str(x) + '*' + str(y) + '=' + str(x * y), end=chr(10 + 22 * int(x != y)))
    b = lambda: 1
    [a, b][int(x > y)]()

import math
R = map(lambda x: (int( (math.sqrt( 8 * x + 1 ) + 1) / 2), x),range(0,45))
RC = map(lambda x: (x[0], x[1] + 1 - (x[0] - 1) * x[0] / 2), R)
T = map(lambda x: ("%d*%d=%d"%(x[1],x[0],x[0]*x[1]) + ("\n" if(x[0]==x[1]) else " ")), RC)
print "".join(T)

print '\n'.join([' '.join([str(i * j) for i in xrange(1,j+1)]) for j in xrange(1,10)])
print ' '.join([x % 10 and ((x / 10 < x % 10) and ' ' or (chr((x / 10) + ord('0')) + "x" + chr((x % 10) + ord('0')))) or '\n' for x in range(1, 101 , 1)])
print str.join('',[str((i-i%9)/9+1)+'*'+str(i%9+1)+'='+str((i%9+1)*((i-i%9)/9+1))+' \n'[i%9] for i in xrange(80)])
console.log([...Array(9)].reduce((m, _, x) => m + [...Array(x + 1)].reduce((m, _, y) => m + `${y + 1}*${x + 1}=${(x + 1) * (y + 1)} `, "") + "\n", ""))




console.log([...Array(45)].reduce(([x, y, s]) => [[x + 1, y, s + `${x}*${y}=${x*y} `], [1, y + 1, s + `${x}*${y}=${x*y}\n`]][1 + Math.sign(x - y)], [1, 1, ""])[2])

// 同上，加了换行，好读点
console.log(
    [...Array(45)].reduce(
        ([x, y, s]) => [
            [x + 1, y, s + `${x}*${y}=${x*y} `],
            [1, y + 1, s + `${x}*${y}=${x*y}\n`]
        ][1 + Math.sign(x - y)],
        [1, 1, ""])
    [2]
)

// 或者这样
console.log(
    [...Array(45)].reduce(
        ([x, y, s]) => ({
            "true":  [x + 1, y, s + `${x}*${y}=${x*y} `],
            "false": [1, y + 1, s + `${x}*${y}=${x*y}\n`]
        })[String(x < y)],
        [1, 1, ""])
    [2]
)
```
###[nginx跨域的设置](https://www.v2ex.com/t/340648#reply7)
if ($http_origin ~* ( https?://.*\.example\.com(:[0-9]+)?$)) { 
add_header Access-Control-Allow-Origin: $http_origin; 
}
###[mysql select count(*)](https://www.v2ex.com/t/339758#reply15)
select （*）在 myiaam 中是常数级的， innodb 却不是的 http://dba.stackexchange.com/questions/17926/why-doesnt-innodb-store-the-row-count
###[解决Python2.x编码之殇](https://zhuanlan.zhihu.com/p/25272901)
```js
print sys.getdefaultencoding()    #系统默认编码
print sys.getfilesystemencoding() #文件系统编码
print locale.getdefaultlocale()   #系统当前编码
print sys.stdin.encoding          #终端输入编码
print sys.stdout.encoding         #终端输出编码
 
```
###[PHP 就碰到 PDO 扩展的一个大坑](https://www.v2ex.com/t/339840#reply74)
PDO 的参数绑定 bindParam 方法第二个参数是传递一个引用类型，而不是值
###[查看 js 中一个变量值是怎样一步一步生成](https://www.v2ex.com/t/338996#reply5)
```js
如果你知道变量名，可以通过 Object.defineProperty(obj,变量名，{set: function(){console.trace();}} );可以追踪到何时被赋值，何时被修改
o._value = o.value 

Object.defineProperty(o, 'value', { 
get: function() { 
console.trace(); 
return o._value; 
}, 
set : function(val) { 
console.trace(); 
o._value = val; 
} 
});
```
###[Ostagram：一款强大的图片艺术滤镜工具](https://link.zhihu.com/?target=http%3A//ostagram.ru/)
