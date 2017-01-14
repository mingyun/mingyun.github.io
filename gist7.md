###[Python requests SSL: CERTIFICATE_VERIFY_FAILED](https://www.v2ex.com/t/334435)
```php
requests.packages.urllib3.disable_warnings()
requests.get(url,verify=False )
```
###[判断一个值是否存在于一个多维关联数组](https://segmentfault.com/q/1010000008105523)
```php
https://github.com/VikinDev/v-collect
$collect = vcollect([
    ['id'=>1,'product'=>['name'=>['v'=>'i'],'sku'=>15]],
    ['id'=>2,'product'=>['name'=>'bibi','sku'=>10]],
]);

if($collect->where('product.name', 'aa')->toArray() == NULL) {
    echo 'Not in the array';
} else {
    echo 'In the array';
};
var_dump(in_array(2,array_dot($arr)));//true
var_dump(in_array(5,array_dot($arr)));//false
function array_dot($array, $prepend = '')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results = array_merge($results, array_dot($value, $prepend.$key.'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }
```
###[laravel 密码验证](https://segmentfault.com/q/1010000008109472)
```php
public function make($value, array $options = array())
    {
        $cost = isset($options['rounds']) ? $options['rounds'] : $this->rounds;

        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if ($hash === false)
        {
            throw new RuntimeException("Bcrypt hashing not supported.");
        }

        return $hash;
    }
public function check($value, $hashedValue, array $options = array())
    {
        return password_verify($value, $hashedValue);
    }

$password = Input::get('password_from_user'); 
$hash = Hash::make($password );//保存数据库

//对比
$input = 'password_from_user';
if(Hash::check($input, $hash)){
    
}
```
###[将任意内容的字符串唯一均匀地转换为1～n之间的一个整数](https://segmentfault.com/q/1010000008113634)
```php
$str = 'Created by PhpStorm.';

$crc32 = crc32($str);

// 因为crc32求出来的是一个32位整数，可为负数，所以abs一下
// 要多少范围内，就求余多少就行
$result = abs($crc32) % 100;

var_dump($result);//59

```
###[无限节点的树结构插件](https://segmentfault.com/q/1010000008113650)
```php
  var data = [{name: '水果', id: 1, children: [
            {name:'水果1',id:2,children:[
                {name:'水果2',id:3,children:[
                    {name:'水果2',id:3,children:[]}        
                ]}
            ]}
        ]
    }];
    
 function render(data){
         
    data.forEach(function(item,index){
        item.status = false;
        if(item.children){
            render(item.children);
        }
    }); 
    console.log(JSON.stringify(data));
    return data;
 }
 
 render(data);
 JSON.stringify(data)
"[{"name":"水果","id":1,"children":[{"name":"水果1","id":2,"children":[{"name":"水果2","id":3,"children":[{"name":"水果2","id":3,"children":[],"status":false}],"status":false}],"status":false}],"status":false}]"
```
###[mysql 插入1百万条数据](https://segmentfault.com/q/1010000008115511)
```php
mysql对sql长度有限制
要么分批100次每次插入一万，
mysql的配置文件（my.ini）中的max_allowed_packet = 1M 默认1M，修改成10M试试
或者用LOAD指令来加载数据文件。
source test.sql
```
###[moment.js](https://segmentfault.com/q/1010000008111757)
```php
  months: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'),
  monthsShort: '1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月'.split('_'),
  weekdays: '星期日_星期一_星期二_星期三_星期四_星期五_星期六'.split('_'),
  weekdaysShort: '周日_周一_周二_周三_周四_周五_周六'.split('_'),
  weekdaysMin: '日_一_二_三_四_五_六'.split('_'),
  longDateFormat: {
    LT: 'Ah点mm分',
    LTS: 'Ah点m分s秒',
    L: 'YYYY-MM-DD',
    LL: 'YYYY年MMMD日',
    LLL: 'YYYY年MMMD日Ah点mm分',
    LLLL: 'YYYY年MMMD日ddddAh点mm分',
    l: 'YYYY-MM-DD',
    ll: 'YYYY年MMMD日',
    lll: 'YYYY年MMMD日Ah点mm分',
    llll: 'YYYY年MMMD日ddddAh点mm分'
  },
  meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
  meridiemHour: function (h, meridiem) {
    let hour = h;
    if (hour === 12) {
      hour = 0;
    }
    if (meridiem === '凌晨' || meridiem === '早上' ||
      meridiem === '上午') {
      return hour;
    } else if (meridiem === '下午' || meridiem === '晚上') {
      return hour + 12;
    } else {
      // '中午'
      return hour >= 11 ? hour : hour + 12;
    }
  },
  meridiem: function (hour, minute, isLower) {
    const hm = hour * 100 + minute;
    if (hm < 600) {
      return '凌晨';
    } else if (hm < 900) {
      return '早上';
    } else if (hm < 1130) {
      return '上午';
    } else if (hm < 1230) {
      return '中午';
    } else if (hm < 1800) {
      return '下午';
    } else {
      return '晚上';
    }
  },
  calendar: {
    sameDay: function () {
      return this.minutes() === 0 ? '[今天]Ah[点整]' : '[今天]LT';
    },
    nextDay: function () {
      return this.minutes() === 0 ? '[明天]Ah[点整]' : '[明天]LT';
    },
    lastDay: function () {
      return this.minutes() === 0 ? '[昨天]Ah[点整]' : '[昨天]LT';
    },
    nextWeek: function () {
      let startOfWeek, prefix;
      startOfWeek = moment().startOf('week');
      prefix = this.diff(startOfWeek, 'days') >= 7 ? '[下]' : '[本]';
      return this.minutes() === 0 ? prefix + 'dddAh点整' : prefix + 'dddAh点mm';
    },
    lastWeek: function () {
      let startOfWeek, prefix;
      startOfWeek = moment().startOf('week');
      prefix = this.unix() < startOfWeek.unix() ? '[上]' : '[本]';
      return this.minutes() === 0 ? prefix + 'dddAh点整' : prefix + 'dddAh点mm';
    },
    sameElse: 'LL'
  },
  ordinalParse: /\d{1,2}(日|月|周)/,
  ordinal: function (number, period) {
    switch (period) {
      case 'd':
      case 'D':
      case 'DDD':
        return number + '日';
      case 'M':
        return number + '月';
      case 'w':
      case 'W':
        return number + '周';
      default:
        return number;
    }
  },
  relativeTime: {
    future: '%s内',
    past: '%s前',
    s: '几秒',
    m: '1 分钟',
    mm: '%d 分钟',
    h: '1 小时',
    hh: '%d 小时',
    d: '1 天',
    dd: '%d 天',
    M: '1 个月',
    MM: '%d 个月',
    y: '1 年',
    yy: '%d 年'
  },
  week: {
    // GB/T 7408-1994《数据元和交换格式·信息交换·日期和时间表示法》与ISO 8601:1988等效
    dow: 1, // Monday is the first day of the week.
    doy: 4  // The week that contains Jan 4th is the first week of the year.
  }
});
```
###[1天前](http://timeago.org/)
```php
<script src="dist/timeago.js" type="text/javascript"></script>
new timeago().format(new Date());             //=> "just now"
new timeago(null, 'zh_CN').format('2016-09-07')           //=> "4月前"
new timeago().format(1473245023718);          //=> "4 months ago"
```
###[Python 解数学方程](https://zhuanlan.zhihu.com/p/24840337)
```php
sudo pip install sympy
from sympy import *
x, y = symbols('x y')
print solve(x * 2 - 4, x)#[2]
print solve([2 * x - y - 3, 3 * x + y - 7],[x, y])#{y: 1, x: 2}
```
