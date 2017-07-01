[tp5基于workerman实现browsersync开发利器](http://www.thinkphp.cn/extend/1006.html)
composer require workerman/workerman  github地址：https://github.com/skj198568/browser_sync

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

