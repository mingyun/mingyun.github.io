###[python编码](https://zhuanlan.zhihu.com/p/25272901)
```js
print sys.getdefaultencoding()    #系统默认编码 ascii
当需要将unicode格式的字符串存入到文件时，python内部会默认将其先转换为Str格式的系统编码，然后再执行存入步骤。而在这过程中，容易引发ascii异常。
#! -*- coding:utf-8 -*-
#python程序开头加上这句代码，指定python源代码编码格式为utf-8。
a=u"中文"
f=open("test.txt","w")
f.write(a)
报错异常信息：UnicodeEncodeError: ‘ascii’ codec can’t encode characters in position 0-1……
说明：因为ascii不支持中文，而变量a为unicode格式的中文字符串，因此无法进行编码而引发异常。
windows控制台为gbk编码，而变量a本身为utf-8编码。
变量a是str格式，编码为utf-8的字符串，我们要将之转化为str格式，GBK编码的字符串。
在python内部无法直接转化，需要借助decod()与encode()函数。decode()函数先将str格式的字符串a转化为unicode，再将unicode编码为str格式GBK。


#! -*- coding:utf-8 -*-
a='你好'
b=a.decode("utf-8").encode("gbk")
print b

python2.x从外部获取的内容都是string编码，其内部分为String编码与Unicode编码，而String编码又分为UTF-8，GBK，GB2312等等
。因此为了避免不同编码造成的报错，python内部最好都转化为unicode编码，在输出时再转化为str编码 。
可以用encode()/decode()函数，将string与unicode编码互换。
 在windows下，最好将文件内容转为unicode，可以使用codecs：

f=codecs.open("test.txt", encoding='gbk').read()

#! -*- coding:utf-8 -*-
a=u"中文"  #a为unicode格式编码
f=open("test.txt","w")
f.write(a.encode("gbk"))
python代码内部请全部使用unicode编码，在获取外部内容时，先decode为unicode，向外输出时再encode为Str

a="\\u8fdd\\u6cd5\\u8fdd\\u89c4" # unicode转化为中文
b=a.decode('unicode-escape')
print b
```
###[PyShell 木马后门](http://thief.one/2016/09/05/PyShell-%E6%9C%A8%E9%A9%AC%E5%90%8E%E9%97%A8/)

https://github.com/tengzhangchao/PyShell/
###[基于Python的WebServer](http://thief.one/2016/09/14/%E5%9F%BA%E4%BA%8EPython%E7%9A%84WebServer/)
```js
https://github.com/tengzhangchao/PyWebServer 
python PyWebServer.py -h
python PyWebServer.py -i 10.0.0.1 -p 8888   ##指定ip与端口,默认为8888
PyWebServer.exe -h  
PyWebServer.exe -p 8888      ##指定端口,默认为8888
[*Tag]  Http Server is runing on 172.16.11.179:8888
#!coding=utf-8
import sys
import socket
import argparse
import BaseHTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler


def run(ip,port):
	Handler = SimpleHTTPRequestHandler
	Server = BaseHTTPServer.HTTPServer
	Protocol = "HTTP/1.0"	
	server_address = (ip, port)
	Handler.protocol_version = Protocol
	try:
		httpd = Server(server_address, Handler)
		print "[*Tag]	Http Server is runing on %s:%s" % (ip,port)

	except:
		print "[*Tag]	%s PORT Employ or IP Address Error" % str(port)

	try:
		httpd.serve_forever()
	except:
		sys.exit()


def get_ip():
	try:
		myname=socket.getfqdn(socket.gethostname())
		myaddr=socket.gethostbyname(myname)
	except:
		print "[*Error]	Get IP address Faile"
	return myaddr


if __name__=="__main__":

	parser=argparse.ArgumentParser()
	parser.add_argument("-p","--port",help="Server Port ,Default:8888",default=8888,type=int)
	parser.add_argument("-i","--ip",help="Server IP Address",default="")
	args=parser.parse_args()

	port=args.port
	ip=args.ip
	
	if ip=="":
		ip=get_ip()          #自动获取本机ip地址

	run(ip,port)         #运行主函数
	php获取本机ip echo gethostbyname('');
	function get_local_ip() {  
    $preg = "/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";  
//获取操作系统为win2000/xp、win7的本机IP真实地址  
    exec("ipconfig", $out, $stats);  
    if (!empty($out)) {  
        foreach ($out AS $row) {  
            if (strstr($row, "IP") && strstr($row, ":") && !strstr($row, "IPv6")) {  
                $tmpIp = explode(":", $row);  
                if (preg_match($preg, trim($tmpIp[1]))) {  
                    return trim($tmpIp[1]);  
                }  
            }  
        }  
    }  
//获取操作系统为linux类型的本机IP真实地址  
    exec("ifconfig", $out, $stats);  
    if (!empty($out)) {  
        if (isset($out[1]) && strstr($out[1], 'addr:')) {  
            $tmpArray = explode(":", $out[1]);  
            $tmpIp = explode(" ", $tmpArray[1]);  
            if (preg_match($preg, trim($tmpIp[0]))) {  
                return trim($tmpIp[0]);  
            }  
        }  
    }  
    return '127.0.0.1';  
}  
```
###[PyCmd 加密隐形木马](http://thief.one/2016/09/18/PyCmd-%E5%8A%A0%E5%AF%86%E9%9A%90%E5%BD%A2%E6%9C%A8%E9%A9%AC/)

https://github.com/tengzhangchao/PyCmd
python PyCmd.py -u http://10.0.3.13/test/p.php -p test [--proxy]
python PyCmd.py -u http://192.168.10.149:8080/Test/1.jsp -p test [--proxy]
###[windows服务器信息收集工具](http://thief.one/2016/09/04/windows%E6%9C%8D%E5%8A%A1%E5%99%A8%E4%BF%A1%E6%81%AF%E6%94%B6%E9%9B%86%E5%B7%A5%E5%85%B7/)
https://github.com/tengzhangchao/InForMation 
information.exe -i start -L start -s start  运行所有功能
information.exe -i start  运行收集系统信息功能
###[算法分析](https://github.com/facert/python-data-structure-cn/tree/master/2.%E7%AE%97%E6%B3%95%E5%88%86%E6%9E%90/2.2.%E4%BB%80%E4%B9%88%E6%98%AF%E7%AE%97%E6%B3%95%E5%88%86%E6%9E%90)
```js
import time

def sumOfN2(n):
    start = time.time()

    theSum = 0
    for i in range(1,n+1):
        theSum = theSum + i

    end = time.time()

    return theSum, end-start
    
    def sumOfN3(n):
   return (n*(n+1))/2

print(sumOfN3(10))
```
###[根据ip获取地理位置](https://github.com/maxmind/GeoIP2-php)
```js
php composer.phar require geoip2/geoip2:~2.0

require_once 'vendor/autoload.php';
use GeoIp2\Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader('/usr/local/share/GeoIP/GeoIP2-City.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city('128.101.101.101');

print($record->country->isoCode . "\n"); // 'US'
print($record->country->name . "\n"); // 'United States'
print($record->country->names['zh-CN'] . "\n"); // '美国'

print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

print($record->city->name . "\n"); // 'Minneapolis'

print($record->postal->code . "\n"); // '55455'

print($record->location->latitude . "\n"); // 44.9733
print($record->location->longitude . "\n"); // -93.2323
```
###[简单轻量的HTTP 客户端工具库](https://github.com/toohamster/ws-http/)
```js
composer require toohamster/ws-http
$httpRequest = \Ws\Http\Request::create();
$headers = array('Accept' => 'application/json');
$query = array('foo' => 'hello', 'bar' => 'world');

$response = $httpRequest->post('http://mockbin.com/request', $headers, $query);

$response->code;        // 请求响应码(HTTP Status code)
$response->curl_info;   // curl信息(HTTP Curl info)
$response->headers;     // 响应头(Headers)
$response->body;        // 处理后的响应消息体(Parsed body), 默认为 false
$response->raw_body;    // 原始响应消息体(Unparsed body)

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://mockbin.com/request?foo=bar&foo=baz",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"foo\": \"bar\"}",
  CURLOPT_COOKIE => "foo=bar; bar=baz",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json",
    "x-pretty-print: 2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
import requests

url = "http://mockbin.com/request"

querystring = {"foo":["bar","baz"]}

payload = "{\"foo\": \"bar\"}"
headers = {
    'cookie': "foo=bar; bar=baz",
    'accept': "application/json",
    'content-type': "application/json",
    'x-pretty-print': "2"
    }

response = requests.request("POST", url, data=payload, headers=headers, params=querystring)

print(response.text)
curl --request POST \
  --url 'http://mockbin.com/request?foo=bar&foo=baz' \
  --header 'accept: application/json' \
  --header 'content-type: application/json' \
  --header 'x-pretty-print: 2' \
  --cookie 'foo=bar; bar=baz' \
  --data '{"foo": "bar"}'
```
###[python煎蛋妹子图下载](https://github.com/picasso250/jiandan)
https://www.zhihu.com/question/28485416 
