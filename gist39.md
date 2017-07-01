[您的用户遇到BUG了吗](https://fundebug.com/dashboard/594ccc061e2fb100144b983e/errors/inbox?filters=%7B%7D)
[]()
```js
Math.min() < Math.max() // false 因为Math.min() 返回 Infinity, 而 Math.max()返回 -Infinity。
const Greeters = []

for (var i = 0 ; i < 10 ; i++) {
 Greeters.push(function () { return console.log(i) })
}
Greeters[0]() // 10
Greeters[1]() // 10
Greeters[2]() // 10
有两种方法：
- 使用`let`而不是`var`。备注：可以参考Fundebug的另一篇博客[ES6之"let"能替代"var"吗?](https://blog.fundebug.com/2017/05/04/why-you-should-not-use-var/)
- 使用`bind`函数。备注：可以参考Fundebug的另一篇博客[JavaScript初学者必看“this”](https://blog.fundebug.com/2017/05/17/javascript-this-for-beginners/)
 
Greeters.push(console.log.bind(null, i))
typeof [] === 'object' // true 需要使用`Array.isArray(var)`。
1 === 1 // true
// 然而这些不行
[1,2,3] === [1,2,3] // false
{a: 1} === {a: 1} // false
{} === {} // false
`new Date(2016, 1, 1)`不会在1900年的基础上加2016，而只是表示2016年。
JavaScript默认使用字典序(alphanumeric)来排序。因此，[1,2,5,10].sort()的结果是[1, 10, 2, 5]。

如果你想正确的排序，应该这样做：[1,2,5,10].sort((a, b) => a - b)
node -e 'console.log(3 + 2)'
node -p '3 + 2'



```
[Layer 子域名挖掘机4.1 全新重构 + 175万大字典](http://paper.seebug.org/113/)
[电商购物网站 - 需求与设计](https://segmentfault.com/a/1190000009926042)
[基于浏览器插件的数据抓取工具](https://github.com/easychen/catgate)
[Feigong - 针对各种情况自由变化的 mysql 注入工具](http://paper.seebug.org/124/)
https://github.com/LoRexxar/Feigong/tree/old
[brut3k1t - 一款模块化的服务端暴力破解工具](http://paper.seebug.org/119/)
[Web 前端代码规范](https://segmentfault.com/a/1190000009935766)
[Solutions collection of my LeetCode submissions](https://github.com/hijiangtao/LeetCodeOJ)
[linux Bash-Snippets](https://github.com/alexanderepstein/Bash-Snippets)
[tp5基于workerman实现browsersync开发利器](http://www.thinkphp.cn/extend/1006.html)
composer require workerman/workerman  github地址：https://github.com/skj198568/browser_sync
[看看大家在上线了上创建的精彩网站吧](https://www.sxl.cn/s/discover)
[当你难过的想死的时候回来看一眼这条微博。 ​​​​](http://weibo.com/5650770554/F8Zy6tfFC?type=comment)
[JavaScript中的数据结构和算法学习](http://caibaojian.com/learn-javascript.html?)
[深入理解 Python 浮点数](https://mp.weixin.qq.com/s/FTZT2x5TeZTmlKqGLDh0JQ)
```js

```
[JavaScript 常用的简写技术](https://segmentfault.com/p/1210000009906328/read)

[itchat+pillow实现微信好友头像爬取和拼接](https://github.com/15331094/wxImage)
```js
from numpy import *
import itchat
import urllib
import requests
import os

import PIL.Image as Image
from os import listdir
import math

itchat.auto_login(enableCmdQR=True)

friends = itchat.get_friends(update=True)[0:]

user = friends[0]["UserName"]

print(user)

os.mkdir(user)

num = 0

for i in friends:
	img = itchat.get_head_img(userName=i["UserName"])
	fileImage = open(user + "/" + str(num) + ".jpg",'wb')
	fileImage.write(img)
	fileImage.close()
	num += 1

pics = listdir(user)

numPic = len(pics)

print(numPic)

eachsize = int(math.sqrt(float(640 * 640) / numPic))

print(eachsize)

numline = int(640 / eachsize)

toImage = Image.new('RGBA', (640, 640))


print(numline)

x = 0
y = 0

for i in pics:
	try:
		#打开图片
		img = Image.open(user + "/" + i)
	except IOError:
		print("Error: 没有找到文件或读取文件失败")
	else:
		#缩小图片
		img = img.resize((eachsize, eachsize), Image.ANTIALIAS)
		#拼接图片
		toImage.paste(img, (x * eachsize, y * eachsize))
		x += 1
		if x == numline:
			x = 0
			y += 1


toImage.save(user + ".jpg")


itchat.send_image(user + ".jpg", 'filehelper')
```
[百度网盘之家](http://wowenda.com/)
[Python编写的文字到语音的转换。](https://pythonprogramminglanguage.com/text-to-speech/)

[微博加密神器](http://resource.haorenao.cn/tse.html)
```js
  <h1>微博加密神器 by 斌叔</h1>
    <h3>使用方法：将想发的内容填入加密。对方查看时到这个网址用同样的钥匙解密。</h3>

    <p>钥匙（记住你的钥匙，解密时需要一个钥匙才能解密）</p>
    <input type="" name="" id="key">
    <p>输入</p>
    <textarea id="input1" cols="50" rows="10"></textarea>
    <br>
    <button id="encode">加密</button> <button id="decode">解密</button>
    <p>输出</p>
    <div id="after">
    </div>
  $("#encode").click(function() {
    var myString   = $('#input1').val().trim();
    var myPassword = $('#key').val().trim();
    console.log(myString);
    console.log(myPassword);

    if (myPassword == "" || myString == "") {
      alert('输入不全！');
      return;
    }

    var encrypted = CryptoJS.AES.encrypt(myString, myPassword);

    $('#after').html(encrypted.toString());
    console.log(encrypted);
  });

    $("#decode").click(function() {
    var myString   = $('#input1').val();
    var myPassword = $('#key').val();
    console.log(myString);
    console.log(myPassword);
        if (myPassword == "" || myString == "") {
      alert('输入不全！');
      return;
    }

    var decrypted = CryptoJS.AES.decrypt(myString,myPassword).toString(CryptoJS.enc.Utf8);

    $('#after').html(decrypted);
    console.log(decrypted);
  });
  
  
```
[给定一个整数数组，其中有两项之和为一个特定的数字，假设每次 input 只有一个唯一解，不允许两次使用同一个元素，返回这两个数的索引。](https://github.com/barretlee/daily-algorithms/issues/1)
```js
给定 nums = [2, 7, 11, 15]，target = 9

由于 nums[0] + nums[1] = 9
所以返回 [0, 1]
const resolveTwoSum = (nums, target) => {
  for (let i = 0; i < nums.length - 1; i++) {
    for (let j = i; j < nums.length; j++) { 
      if (nums[i] + nums[j] === target) {
        return [i,j]; 
      }
    }
  }
}
```
[文字转换器, 将文字转成倒序](http://old.haorenao.cn/reverse/)
```js
$(document).ready(function() {
	$('#reverse').click(function() {
		var text = $('#orig').val();
		var ll = [];
		for (var i = 0;i < text.length;i++) {
			var c = text.charAt(i);
			ll.push(c);
		}
		ll.reverse();
		var s = ll.join("");
		$('#result').val(s);
	});
});
```

