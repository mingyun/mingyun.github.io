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
###
