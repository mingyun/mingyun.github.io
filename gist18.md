###[PHP 输出 json乱码](https://www.v2ex.com/t/340206#reply28)
echo 之前加 ob_clear(); 

代码有顶格,无 bom, 是 utf-8.
后面是 C3 AF C2 BB 么？仍然是 BOM 头，只是转换过。而如果是 EF BB BF 则是没有转换过的。 
一个典型的 PHP 程序文件应该以“<?php 开头”。这个标签开始之前不应该有任何东西，包括不可见字符。 

当然还有一种可能性，就是你手头上的程序主动输出了那些内容。如果是这样， Debug 会变得很复杂：你需要去掉所有的 Output Buffer 控制（就是让内容直接输出），然后用 headers_list 以及 headers_sent 函数检查到底是谁发送了“ï”字符。
###[代码表白](https://www.zhihu.com/question/55736593)
算法题目 http://hmbb.hustoj.com/  
>>> print('\x42\x65\x20\x77\x69\x74\x68\x20\x6d\x65')
Be with me
>>> print(''.join(['\\'+hex(ord(i))[1:] for i in 'be with me']))
\x62\x65\x20\x77\x69\x74\x68\x20\x6d\x65
![zhihu](https://pic4.zhimg.com/v2-5f14d4f3f57e54b804a864a895f02dc3_b.png)

