###[服务器不解析PHP](https://segmentfault.com/q/1010000008223801)
1：检查php-fpm服务是否打开
2：如果php-fpm服务确认打开，请看nginx.conf是否正确将php文件交给了php-fpm解析（重点检查端口，ip等等）
3：最佳建议是直接看nginx提供的success/error .log。

图示的问题其实就是nginx正确接受到请求PHP文件了，但是把该文件转发给php-fpm解析的时候出了某些意外。
###[canvas刮开](https://segmentfault.com/q/1010000008268192)
```js
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>http://runjs.cn/detail/uk9ho4ad
		<img src="http://sandbox.runjs.cn/uploads/rs/167/jg8rzhfj/lf.jpg" />
		<canvas id="myCanvas" width="400" height="400"></canvas>
	</body>
</html>
* {
	margin: 0;
}

img {
	position: absolute;
	width:400px;
	height:400px;
}

#myCanvas {
	position: absolute;
	transition: 1s;
}

	var myc = document.getElementById("myCanvas");
		var ctx = myc.getContext("2d");

		ctx.fillStyle = "#ccc";
		ctx.fillRect(0, 0, 400, 400);
		ctx.globalCompositeOperation = "destination-out";

		myc.onmousedown = function(e) {
			document.onmousemove = function(e) {
				var ev = e || window.event;
				var x = ev.clientX;
				var y = ev.clientY;
				
				ctx.beginPath();
				ctx.arc(x,y,30,0,Math.PI*2);
				ctx.fill();

				var obj = ctx.getImageData(0, 0, 400, 400);
				var arr = obj.data;
				var n = 0;
				for(var i = 0; i < arr.length; i += 4) {
					if(arr[i + 3] == 0) {
						n++;
					}
				}
				//大于50%时显示全部
				if(n / (arr.length / 4) > 0.5) {
					myc.style.opacity = 0;
				}
			}

			document.onmouseup = function() {
				document.onmousemove = "";
			}
		}
```
