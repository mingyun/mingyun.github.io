###[Python里对list用sort和sorted排序的一个问题](https://www.zhihu.com/question/55371008)
```js
A=[2,1,3,4,2,2,3]

A.sort(key=lambda x:A.count(x))
print A 
[2,1,3,4,2,2,3]

B=sorted(A,key=lambda x:A.count(x))
print B
[1, 4, 3, 3, 2, 2, 2]
```
###[Python编写多线程爬虫抓取百度贴吧邮箱与手机号](https://zhuanlan.zhihu.com/p/25039408)
```js
 github.com/cw1997/get-email-by-tieba/blob/master/get-email-by-tieba-multithreading.py 
```
###[Pandas学习笔记](https://zhuanlan.zhihu.com/p/25013519)
```js
s = pd.Series({‘a’=1,’b’=2,’d’=3},index = [‘a’,’d’,’c’,b’])
输出：a  1	
      d  3
      c  NaN
      b  2
      dtype：int64
```
###[微信拜年群发](https://zhuanlan.zhihu.com/p/25034403)
```js
#扫不到二维码的在enableCmdQR的值改成2就好了，我原来都扫不到，看了文档改了一下就好了
import itchat, time, re
from itchat.content import *

@itchat.msg_register([TEXT])
def text_reply(msg):
    match = re.search('年', msg['Text']).span()
    if match:
      itchat.send(('那我就祝你鸡年大吉吧'), msg['FromUserName'])

@itchat.msg_register([PICTURE, RECORDING, VIDEO, SHARING])
def other_reply(msg):
    itchat.send(('那我就祝你鸡年大吉吧'), msg['FromUserName'])

itchat.auto_login(enableCmdQR=True,hotReload=True)
itchat.run()
```



