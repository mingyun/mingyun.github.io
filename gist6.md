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
