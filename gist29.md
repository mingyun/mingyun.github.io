[微信公众平台开发工具集](http://www.cnblogs.com/txw1958/p/weixin-tools-list.html)
###[生成自己的词性词典](邓旭东 天善大数据http://mp.weixin.qq.com/s?src=3&timestamp=1489907873&ver=1&signature=mPVOF3R4tcsLs1L1Phi9*juQlHCeGtA4kbe8bgSyrJVW7msRydAK1ggmQMUBfPJ5ti-82g9Edo33VwXGCwnoSKdefoxNNYd4NOC1whlrQOA3owzlgqS-P4TQaIuvvNQLCZNs5s-Nz5VySSIOnCy9iMrdxmtGBZFKoPzIuVZjnpU=)
```js
import re
1、应先使用正则表达式，匹配含有‘adj’的行字符串，返回的是list。
2、获得adj结尾处的索引值
3、对行字符串进行切片处理，获得索引值后的全部字符
4、如果获得的字符串有 ‘，’ 那再用正则表达式，匹配中文字符，获得的是中文的list
strs = open(r'C:/Users/myl/Desktop/SegChineseToWords/英汉词典TXT格式.txt','r',encoding='utf-8').readlines()

for str in strs:

# 形容词典
    adj_re = re.search('adj', str)
    if adj_re != None:
        adj_num = adj_re.end()+1
        adj_str = str[adj_num:]
        adj_list = re.findall("[\u4e00-\u9fa5]+", adj_str)
        for ele_adj in adj_list:
            ele_adj = ele_adj + '\n'
            with open(r'C:/Users/myl/Desktop/SegChineseToWords/Dict/adj_dict.txt', 'a+',encoding='utf-8') as f:
                f.write(ele_adj)
```

###[有哪些老鸟程序员知道而新手不知道的小技巧？](https://www.zhihu.com/question/36426051/answer/152115740)
```js
>>> x = 5
>>> 1 < x < 10
True
>>> 10 < x < 20 
False
>>> x < 10 < x*10 < 100
True
>>> 10 > x <= 9
True
>>> 5 == x > 4
True
x = [n for n in foo if bar(n)]
>>> type(x)
<type 'list'>

d = {value: foo(value) for value in sequence if bar(value)}
>>> def foo(x=None):
...     if x is None:
...         x = []
...     x.append(1)
...     print x
>>> foo()
[1]
>>> foo()
[1]
如果你不喜欢使用空格缩进，那么可以使用C语言花括号{}定义函数：

>>> from __future__ import braces   #这里的braces 指的是：curly braces（花括号）
  File "<stdin>", line 1
SyntaxError: not a chance
当然这仅仅是一个玩笑，想用花括号定义函数？没门。感兴趣的还可以了解下：

from __future__ import barry_as_FLUFL
装饰器使一个函数或方法包装在另一个函数里头，可以在被包装的函数添加一些额外的功能，比如日志，还可以对参数、返回结果进行修改。

>>> def print_args(function):
>>>     def wrapper(*args, **kwargs):
>>>         print 'Arguments:', args, kwargs
>>>         return function(*args, **kwargs)
>>>     return wrapper

>>> @print_args
>>> def write(text):
>>>     print text

>>> write('foo')
Arguments: ('foo',) {}
foo
@是语法糖，它等价于：

>>> write = print_args(write)
>>> write('foo')
arguments: ('foo',) {}
foo




```







