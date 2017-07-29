[笛卡尔乘积](https://www.v2ex.com/t/378599#reply7)
```js
from itertools import product 

>>> list(product(['Red','Black','White'], ['64G','128G'], ['USB','Type-C']))
[('Red', '64G', 'USB'), ('Red', '64G', 'Type-C'), ('Red', '128G', 'USB'), ('Red'
, '128G', 'Type-C'), ('Black', '64G', 'USB'), ('Black', '64G', 'Type-C'), ('Blac
k', '128G', 'USB'), ('Black', '128G', 'Type-C'), ('White', '64G', 'USB'), ('Whit
e', '64G', 'Type-C'), ('White', '128G', 'USB'), ('White', '128G', 'Type-C')]
```
[PHP 什么情况下 5.590 小于 5.59](https://www.v2ex.com/t/378136)
```js
floatval(5.590) < floatval(5.59)
比较的时候乘 100 按整数比吧
php > var_dump(floatval(5.590) < floatval(5.59)); 
php shell code:1: 
bool(false) 
php > var_dump(floatval(5.590) == floatval(5.59)); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 == 5.59); 
php shell code:1: 
bool(true) 
php > var_dump(5.590 < 5.59); 
php shell code:1: 
bool(false) 
1、从数据库里面查询出来的浮点数，请使用 string。 
2、http://php.net/manual/en/book.bc.php 
3、个人癖好，有段时间，金钱我用 int 来存储，单位是分。不过现在都用 string 来做了。
 floor(8.29 * 100 * 100 / 100) //828
if (fabs(a - b) > 1e-3 && a < b)
写个专门运算的函数，全部乘以 100 之后运算，把结果再除以 100 返回，可以参考微信支付的做法 http://de2.php.net/manual/en/ref.bc.php
```
[AJAX 跨域请求](https://www.v2ex.com/t/378681)
```js
后来发现前端使用 CORS 请求时content-type取值为application/json; charset=utf-8，也就是说发送跨域请求时会发送 OPTIONS 预检请求，而我没有对设置 OPTIONS 路由
app.all('*',function (req, res, next) {
	res.header('Access-Control-Allow-Origin', '*');
	res.header('Access-Control-Allow-Headers', 'Content-Type, Content-Length, Authorization, Accept, X-Requested-With , yourHeaderFeild');
	res.header('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, OPTIONS');

	if (req.method == 'OPTIONS') {
	   console.log('you can do that!!');
	   res.send(200); // 让 options 请求快速返回
	} else {
		next();
	}
});
```

