###[倒计时](https://segmentfault.com/q/1010000008054913)
```php

    console.log(time_to_str(-60850977));
    function time_to_str(time){
        var time = Math.abs(time/1000);
        var h = Math.floor(time/3600);
        var m = Math.floor(time%3600/60);
        var s = Math.floor(time%3600%60);
        return '还剩' + h + '小时' + m + '分钟' + s + '秒';
    }
function toStr(n) {
    n = n.toString();
    return n[1] ? n : '0' + n;
}

switch (string) {
        case "yyyy-mm-dd":
            time = [year, month, date].map(toStr).join('-');
            break;
        ...
    }
```    
###php单例
```php
//public修饰的方法才可以在类的外部访问，protected方法和private方法只能在类中访问，区别在与protected方法可以在子类中访问而private方法不可以
在线demohttps://www.bytelang.com/o/s/c/NQbmUaRIXyA=
class ClassName {
    static $instance;
    
    private function __construct(){}
    
    public static function getInstance() {
        if (static::$instance instanceof static) {
            return static::$instance;
        }
        
        return static::$instance = new static();
    }
}
```
###[++[[]][+[]]+[+[]] = 10](https://segmentfault.com/q/1010000008051509)
```php
数组解构赋值的话，右值必需是iterable(可迭代的)，下面的例子的错误与[] = 1是一样错误，所以应该会先检查右值是否为iterable时，先抛出类型错误:
[] = '1'不会有错误，是因为字符串是属于iterable(可迭代的)。
```
###[省市数据库联动表](https://segmentfault.com/q/1010000008066261)
```php
CREATE TABLE `ecs_region` (
  `region_id` smallint(5) unsigned NOT NULL auto_increment,
  `parent_id` smallint(5) unsigned NOT NULL default '0',
  `region_name` varchar(120) NOT NULL default '',
  `region_type` tinyint(1) NOT NULL default '2',
  `agency_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`region_id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_type` (`region_type`),
  KEY `agency_id` (`agency_id`)
)  TYPE=MyISAM;
sql:https://git.oschina.net/xujian_jason/codes/3bqvj8s7wkupeitmy0cl252 
http://www.stats.gov.cn/tjsj/tjbz/xzqhdm/201608/t20160809_1386477.html
小程序 http://www.php.cn/toutiao-348128.html
```
###[基本字符串 和 字符串对象](https://segmentfault.com/q/1010000008065245)
```php
var str='hello';

str.len=5;
console.log(str.len);    //undefined

var str=new String("Hello");

str.len=5;
console.log(str.len);    //5
```
###[jsonp是get形式，承载的信息量有限 fastcgi request record is too big](https://segmentfault.com/q/1010000008062067)
```php
header("Access-Control-Allow-Origin：* "); // * 可改为[域名|ip], 多个地址用逗号,分割
header("Access-Control-Request-Method: POST"); // 设置只允许POST请求跨域
$.ajax({
    ...,
    dataType: 'json'
});
```
###[canvas做图片压缩上传](https://segmentfault.com/q/1010000007675294)
```php
var compress = function(source_img_obj, quality, output_format){
    var mime_type = "image/jpeg";

    if(output_format!=undefined && output_format=="png"){
        mime_type = "image/png";
    }
    alert(source_img_obj);
    var cvs = document.createElement('canvas');
        //naturalWidth真实图片的宽度
        cvs.width = source_img_obj.naturalWidth;
        cvs.height = source_img_obj.naturalHeight;
    var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
    var newImageData = cvs.toDataURL(mime_type, quality/100);
    var result_image_obj = new Image();
        result_image_obj.src = newImageData;
    return result_image_obj;
}
```
###[setInterval](https://segmentfault.com/q/1010000008065929)
```php
var a = function(){
};
// 或者 
function a() {}


setInterval(a, 1000);
var a = function(){
};
// 或者
function a() {

}

setInterval("a", 1000);
setInterval(function(){
}, 1000);
如果setInterval(foo(), 1000); 最终timer执行的是这个foo的return
这个参数对于setInterval来说实际上是对timeShow函数的引用，支持以函数名，函数名称字符串的方式，但是timeShow()就不行了，直接使用timeShow()的话这个timeShow函数会直接执行，传给setInterval的参数就不是该函数，而是该函数的返回值了
```
###[python-selenium-open-tab](https://gist.github.com/lrhache/7686903)
```php
import selenium.webdriver as webdriver
import selenium.webdriver.support.ui as ui
from selenium.webdriver.common.keys import Keys
from time import sleep    
browser = webdriver.Firefox()
browser.get('https://www.google.com?q=python#q=python')
first_result = ui.WebDriverWait(browser, 15).until(lambda browser: browser.find_element_by_class_name('rc'))
first_link = first_result.find_element_by_tag_name('a')

# Save the window opener (current window, do not mistaken with tab... not the same)
main_window = browser.current_window_handle

# Open the link in a new tab by sending key strokes on the element
# Use: Keys.CONTROL + Keys.SHIFT + Keys.RETURN to open tab on top of the stack 
first_link.send_keys(Keys.CONTROL + Keys.RETURN)

# Switch tab to the new tab, which we will assume is the next one on the right
browser.find_element_by_tag_name('body').send_keys(Keys.CONTROL + Keys.TAB)
browser.execute_script('''window.open("about:blank", "_blank");''')
# Put focus on current window which will, in fact, put focus on the current visible tab
browser.switch_to_window(main_window)

# do whatever you have to do on this page, we will just got to sleep for now
sleep(2)

# Close current tab
browser.find_element_by_tag_name('body').send_keys(Keys.CONTROL + 'w')

# Put focus on current window which will be the window opener
browser.switch_to_window(main_window)

```
###[postman 设置参数]()
```php
var param="dt=IM-A900S&uid=13753541&sid=13131432-3b20c3fb2c2f68d64&pf=android&cn=3G&imei=359678051085074&pn=&imsi=460004660651885&cv=4.1&cc=qq";
var atom = btoa(param);

postman.setGlobalVariable("atom", atom);请求url text.com/index.php?atom={{atom}}
```
###[Number.isNaN](https://segmentfault.com/q/1010000008067590)
```php
Number.isNaN = Number.isNaN || function(value) {
    return typeof value === "number" && isNaN(value);
}
因为Number(null)会返回0，isNaN()内部会先调用Number(value)转换下值,然后再比较，所以 
isNaN(null)，即isNaN(0),会返回false
```
###把每个对象加一个逗号放一行
`notepad++ 然后查找 '},' 替换成'},\n'  str.replace(/},/g,'},\n');`
###更新nodejs
```php
列出安装npm包npm list -g --depth=0  ls `npm root -g` 
下载https://npm.taobao.org/mirrors/node/latest-v6.x/node-v6.9.3-x64.msi 
 
npm config set registry=https://registry.npm.taobao.org

```
###[ js把php的内置函数都实现一遍 ](https://github.com/niklasvh/php.js)
```php
http://locutus.io/php  http://phpjs.hertzen.com/console.html?gist=3171392 http://pdfmyurl.com/
```
###[JSON 重组](https://segmentfault.com/q/1010000008006459)
```php
 var src = {
    "title": "限制标题字数",
    "desc": "",
    "tagInput": "",
    "interest": "1",
    "fwb": "这是富文本11111",
    "goodImg01": "",
    "goodTitle01": "富文本1下面礼物名字1",
    "goodPrice01": "富文本1下面礼物1的价格",
    "goodId01": "富文本1下面礼物1的ID",
    "goodImg02": "",
    "goodTitle02": "富文本1下面礼物2名字2",
    "goodPrice02": "富文本1下面礼物2的价格",
    "goodId02": "富文本1下面礼物2的ID",
    "goodImg03": "",
    "goodTitle03": "富文本1下面礼物3名字",
    "goodPrice03": "富文本1下面礼物3的价格",
    "goodId03": "富文本1下面礼物3的ID",
    "fwb1": "这是富文本2222",
    "goodImg11": "",
    "goodTitle11": "富文本2下面的礼物名字",
    "goodPrice11": "富文本2下面的礼物价格",
    "goodId11": "富文本2下面的礼物ID"
}
     [{
         "fwb": "这是富文本11111",
         "good": [{
                 "goodImg": "",
                 "goodTitle": "富文本1下面礼物名字1",
                 "goodPrice": "富文本1下面礼物1的价格",
                 "goodId": "富文本1下面礼物1的ID"
             },
             {
                 "goodImg": "",
                 "goodTitle": "富文本1下面礼物2名字2",
                 "goodPrice": "富文本1下面礼物2的价格",
                 "goodId": "富文本1下面礼物2的ID"
             },
             {
                 "goodImg": "",
                 "goodTitle": "富文本1下面礼物3名字",
                 "goodPrice": "富文本1下面礼物3的价格",
                 "goodId": "富文本1下面礼物3的ID"
             }
         ]
     },
     {
         "fwb": "这是富文本2222",
         "good": [{
                 "goodImg": "",
                 "goodTitle": "富文本2下面礼物名字1",
                 "goodPrice": "富文本2下面礼物1的价格",
                 "goodId": "富文本2下面礼物1的ID"
             },
             {
                 "goodImg": "",
                 "goodTitle": "富文本2下面礼物2名字2",
                 "goodPrice": "富文本2下面礼物2的价格",
                 "goodId": "富文本2下面礼物2的ID"
             },
             {
                 "goodImg": "",
                 "goodTitle": "富文本2下面礼物3名字",
                 "goodPrice": "富文本2下面礼物3的价格",
                 "goodId": "富文本2下面礼物3的ID"
             }
         ]
     }
 ]
 var srcStr=JSON.stringify(src);
//加fwb
srcStr=srcStr.replace(/("goodId\d{2}":"[^"]*",)("goodImg\d{2}":)/g,'$1"fwb":"",$2');
//自定义一个符号比如::分隔
srcStr=srcStr.replace(/,("fwb[^"]*")/g,'::"fwb"');
srcStr=srcStr.split('::');

var srcRes=[];
var i=1;
var temp={};
//一项一项取就好了
while(srcStr[i]){
    srcStr[i]=srcStr[i].replace(/,"([a-zA-Z]+)\d{2}"/g,',"$1"');
    srcStr[i]= srcStr[i+1]?('{'+srcStr[i]+'}'):('{'+srcStr[i]);
    temp=JSON.parse(srcStr[i]);
    temp.mark=i;
    srcRes.push(temp);
    i++;
}
console.log(srcRes);
```
###[正则表达式`replace`](https://segmentfault.com/q/1010000007965483)
```php
String.prototype.replace.call('223322', /22(\d{2})22/, 'replaced!')
//"replaced!"
String.prototype.replace是会搜寻整个正则表达式/22(d{2})22/的内容并用'replaced!'字符串来替换, 不管正则内有没有分组;
String.prototype.replace.call('223322', /22(\d{2})22/, '$1')
//"33"
'$1'则指代捕获组1的内容, 在这里就是'33'. 因此整个正则所匹配的内容会被替换成为'$1'的内容.

具体到这里, /((d{3}))/g匹配的是'(555)', 捕获组1捕获到的则是'555', 因此'(555)'会被替换为'555' + '-'.
```
###redis sAdd数组不能为空
```php
var apiMenu = $.parseJSON('{!! $jsonListArray !!}'); #将php数组转为js数组对象
if (!empty($tmpList)) {
                $keyWord = array_column($tmpList, 'keywords');
                RedisFacade::sAdd(Kwd::WHOLE_KEY_LIMIT, $keyWord);
            }
```
###数组扁平化
```php
>>> vec = [[1,2,3], [4,5,6], [7,8,9]]
>>> [num for elem in vec for num in elem]
[1, 2, 3, 4, 5, 6, 7, 8, 9]
```
###[$_GET 和 $_POST](http://www.restran.net/2016/09/26/php-security-notes/)
```php
http://ctf4.shiyanbar.com/web/false.php?name[]=a&password[]=b
如果 GET 参数中设置 name[]=a，那么 $_GET['name'] = [a]，php 会把 []=a 当成数组传入， $_GET 会自动对参数调用 urldecode。

$_POST 同样存在此漏洞，提交的表单数据，user[]=admin，$_POST['user'] 得到的是 ['admin'] 是一个数组
md5([]) === false
echo is_numeric(233333);       # 1
echo is_numeric('233333');    # 1
echo is_numeric(0x233333);    # 1
echo is_numeric('0x233333');   # 1
echo is_numeric('233333abc');  # 0
变量覆盖 extract
//var.php?var=new  
$var='init';  
parse_str($_SERVER['QUERY_STRING']);  
print $var;
```
###比较
```php
// 0x 开头会被当成16进制54975581388的16进制为 0xccccccccc
// 十六进制与整数，被转换为同一进制比较
'0xccccccccc' == '54975581388' 
// 字符串在与数字比较前会自动转换为数字，如果不能转换为数字会变成0
1 == '1'
1 == '01'
10 == '1e1'
100 == '1e2' 
0 == 'a' // a 转换为数字为 0
// 十六进制数与带空格十六进制数，被转换为十六进制整数
'0xABCdef' == '     0xABCdef'
'0010e2' == '1e3'
// 0e 开头会被当成数字，又是等于 0*10^xxx=0
// 如果 md5 是以 0e 开头，在做比较的时候，可以用这种方法绕过
'0e509367213418206700842008763514' == '0e481036490867661113260034900752'
'0e481036490867661113260034900752' == '0' 

var_dump(md5('240610708') == md5('QNKCDZO'));
var_dump(md5('aabg7XSs') == md5('aabC9RqS'));
var_dump(sha1('aaroZmOk') == sha1('aaK1STfY'));
var_dump(sha1('aaO8zKZF') == sha1('aa3OFF9m'));
```
###python发送邮件
```php
#! /usr/bin/env python
# -*- coding: utf-8 -*-
#http://www.restran.net/2015/02/12/python-postfix-email/
import smtplib
import time, traceback, sys, os
from email.mime.text import MIMEText

def send_mail(mail_from, password, mail_to, subject, content):

    handle = smtplib.SMTP('smtp.163.com', 25)
    handle.login(mail_from, password)
    time_str = time.strftime('%Y-%m-%d %X', time.localtime(time.time()))
    msg = '<html><body>' + content + "<br><br><span style='color:#999;font-size:"\
                        + "10px;font-family:Verdana;'>" \
                        + time_str + " by " + mail_from + "</span>"+'</body></html>'
    send_msg = MIMEText(msg, 'html', 'utf-8')
    send_msg['Subject'] = subject
    handle.sendmail(mail_from, mail_to, send_msg.as_string())
    handle.close()

if __name__ == '__main__':
    send_mail('your_name@163.com', 'your_password', 'Hello Python!', 'Say hello to Python! :)')

```
###[Python 中一个逗号引发的悲剧](http://www.restran.net/2015/11/07/python-comma-issue/)
```php
>>> a = [
...     'foo'
...     'bar',
...     'tree'
... ]
>>>
>>> b = 'foo' 'bar'
>>>
>>> print a
['foobar', 'tree']
>>> print b
foobar
只要把两个字符串放在一起，中间有空白或者没有空白，两个字符串自动连接为一个字符串。

也就是说 'foo' + 'bar' 等价于 'foo' 'bar'
>>> a = {'foo': 'bar'}
>>> b = a.get('foo'),
>>> c = a.get('foo')
>>> print(b)
('bar',)
>>> print(c)
bar
```
###[linux commands]()
```php
把 mydata.zi p解压到 mydatabak 目录里面

unzip mydata.zip -d mydatabak
sudo pkill -f uwsgi -9
cd /proc ll 进程号
# -p 后面跟的是端口
ssh 192.168.1.102 -l root -p 22
```
###[Python 对小整数的定义是 [-5, 257)](http://www.restran.net/2015/10/22/how-python-code-run/)
```php
所有位于这个范围内的整数使用的都是同一个对象 id 函数可以用来查看一个对象的唯一标志，可以认为是内存地址
>>> a = 1
>>> id(a)
40059744
>>> b = 1
>>> id(b)
40059744
>>> c = 257
>>> id(c)
41069072
>>> d = 257
>>> id(257)
41069096

```
###[nginx 反向代理](http://www.restran.net/2015/08/19/nginx-frontend-helper/)
```php
server {
  listen  *:5000;
  access_log  logs/mysite_access.log;
  error_log   logs/mysite_error.log;

  # 为了调试方便，我不缓存
  expires 0;
  
  # 开启 gzip，跟真实环境一样
  gzip on;
  
  # 网站的路径 
  location / {
    root  "D:/path/to/mysite/html";
    index  index.html index.htm;
  }
  
  # 静态文件的路径 
  location /static {
    alias "D:/path/to/mysite/static"; 
  } 
  
  # 我们的 api 接口会使用特殊前缀 @ 来区分
  # 把所有 uri 以 /@api_some_data 开头的转发到接口服务器
  location /@api_some_data {
    # 看情况，是否需要重写 uri
    # rewrite /@api_some_data/(.*) /$1  break;
    # 转发到接口服务器的地址
    proxy_pass http://192.168.1.2:8000;
    proxy_set_header Cookie $http_cookie;
  }
}
$.ajax({
    url: '/@api_some_data/get_data/',
    type: 'POST',
    cache: false,
    dataType: 'json',
    contentType: 'application/json; charset=utf-8',
    data: JSON.stringify(post_data),
    success: function (response) {
        // handle success
    },
    error: function () {
        // handle error
    }
});
```
###[zhihu-card](https://laike9m.com/blog/fa-bu-zhihu-card-020,95/)
```php
<div class="zhihu-card" data-userhash="your hash"></div>
<script src="//cdn.jsdelivr.net/zhihu-card/latest/widget.js"></script>
```
###[互联网公司GitHub repo 语言使用情况](https://laike9m.com/blog/hu-lian-wang-gong-si-github-repo-yu-yan-shi-yong-qing-kuang,56/)
```php
import requests
from collections import defaultdict
from os.path import join
from pprint import pprint


class GetLangStat():

    api_url = "https://api.github.com/orgs"
    ORGANIZATIONS = (
        'Microsoft', 'aws', 'google', 'twitter', 'facebook',
        'alibaba'
    )
    stats = {org: defaultdict(int) for org in ORGANIZATIONS}

    @classmethod
    def get_one_org_repos(cls, org):
        print(org)
        url = join(cls.api_url, org, 'repos')
        r = requests.get(url)
        for repo in r.json():
            cls.stats[org][repo['language']] += 1

    @classmethod
    def get_all_org_repos(cls):
        for org in cls.ORGANIZATIONS:
            cls.get_one_org_repos(org)
        pprint(cls.stats)


if __name__ == '__main__':
    GetLangStat.get_all_org_repos()
```
###获取登录用户
`echo $username = getenv("username");`
###[文件夹上传](https://laike9m.com/blog/wen-jian-jia-shang-chuan-cong-qian-duan-dao-hou-duan,59/)
```php
<form method="POST" enctype=multipart/form-data>
  <input type='file' name="file" webkitdirectory >
  <button>upload</button>
</form> 
<input type='file' webkitdirectory >  
<button id="upload-btn" type="button">upload</button> 

var files = [];
$(document).ready(function(){
  $("input").change(function(){
    files = this.files;
  });
});
$("#upload-btn").click(function(){
  var fd = new FormData();
  for (var i = 0; i < files.length; i++) {
    fd.append("file", files[i]);
  }
  $.ajax({
    url: "/upload/",
    method: "POST",
    data: fd,
    contentType: false,
    processData: false,
    cache: false,
    success: function(data){
      console.log(data);
    }
  });
});
```
###[laravel 配合 angular跨域问题](https://segmentfault.com/q/1010000008059752)
```php
去掉VerifyCsrfToken中间件，也可以在app/Http/Middleware/VerifyCsrfToken.php的$except数组中加上要跳过Csrf验证的路由
$http({
    method: 'post',
    url: 'http://www.b.com/test/index',
    data: {
        //withCredentials: true,
        customers: 'testname',
        email: 'testemail@qq.com'
    },
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
}).success(function (r) {
    console.log(r);
});

```
