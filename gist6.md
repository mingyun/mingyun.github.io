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
