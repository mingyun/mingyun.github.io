[喜马拉雅在线json](http://www.ximalaya.com/tracks/1099713.json)
[php在线库](http://www.ctolib.com/article/wiki/11055)
[larave session问题，为什么每次session_id都要变](https://segmentfault.com/q/1010000009694886)
[github怎么提交回退旧版本代码并更改后的文件到主分支上](https://segmentfault.com/q/1010000009800764)
[让git命令行保存github的登录状态](https://segmentfault.com/q/1010000009785643)
echo命令本身默认会在输出字符串后面追加一个换行符，可以通过增加一个选项-n来阻止此默认行为echo -ne "\n"
 删除当前目录下 10天前的子目录 find . -maxdepth 1 -type d -mtime +10|xargs rm -rf
[将100之内的数字中文转换..](https://segmentfault.com/q/1010000009760061)
[正则表达式问题](https://segmentfault.com/q/1010000009745638)
# coding: utf8
filename = '2.txt'
with open(filename) as f:
    for i in f:
        result = i.split()
        print result[1], result[-1]
        
[php 如何解析既有值又有属性的 xml 标签？](https://segmentfault.com/q/1010000009762137)        
$xml = simplexml_load_string($content);
foreach($xml->attributes() AS $a => $b) {

echo "$a = $b <br />";
}
[数字变为文字](https://segmentfault.com/q/1010000009747721)   
[python中eval的问题](https://segmentfault.com/q/1010000009808234)
```js
python有 decimal 和 fraction 2个模块用来进行高精度浮点计算
>>> from fractions import Fraction
>>> Fraction('0.3')-Fraction('0.1') == Fraction('0.2')
True
>>> from decimal import Decimal
>>> Decimal('0.3')-Decimal('0.1') == Decimal('0.2')
True
>>> 
eval('0.3-0.1==0.2')  # 输出为False, 是因为0.3-0.1=0.19999999999999998
eval('%d - %d == %d'%(0.3, 0.1, 0.2))  # 输出为True, 是因为你%d传入是整数，相当于0-0=0
eval('%s - %s == %s'%(0.3, 0.1, 0.2))  # 输出为False, 参考1
eval('%s - %s == %s'%('0.3', '0.1', '0.2'))  # 输出为False, 参考1
```
[python如何转换时间戳到"2017年6月12日 18点24分"这样的格式](https://segmentfault.com/q/1010000009748841)
```js
import time
print('%s年%s月%s日 %s时%s分' % time.localtime(1497254119.69407)[:5])
timestamp = time.time() - 3600   # 时间戳
print(time.strftime('%Y{y}%m{m}%d{d} %H{H}%M{M}', time.localtime(timestamp)).format(y='年', m='月', d='日', H='时', M='分'))
#统计出现次数
lst = [1,1,2,2,3,3,4,4,5,6]
print len(set(lst))

#统计每种各出现几次
from collections import Counter
print dict(Counter(lst))
```
[php字符串比较](https://segmentfault.com/q/1010000009794813)
[Python 爬虫中完成 JavaScript 函数翻页?](https://segmentfault.com/q/1010000009753395)
[一段不减的整数，如11111223333，怎么快速计算重复次数最多的那个数](https://segmentfault.com/q/1010000009695220)
```js
其实这种标准字典格式的，eval是最简单的。https://segmentfault.com/q/1010000009813506
t='''{"status": "0", "msg": "ok", "result": {"name": "露水", "content": 
"<p>释名在秋露重的时候，早晨去花草间收取。</p><p>气味甘、平、无毒。</p><p>主治用以煎煮润肺杀虫的药剂，或把治疗疥癣、虫癞的散剂调成外敷药，可以增强疗效。白花露：止消渴。百花露：能令皮肤健好。柏叶露、菖蒲露：每天早晨洗眼睛，能增强视力。韭叶露：治白癜风。每天早晨涂患处。</p>", "commentary": "", "translation": "", "appreciation": "", "interpretation": ""}}'''

a=eval(t)
```
[请教linux的find命令如何按正则表达式过滤](https://segmentfault.com/q/1010000009776190)
find . -regex '\./[0-9]+_[0-9]+\.zip'
如果需要将找到的文件删除则利用xargs(注意确定之后再删除)：

find . -regex '\./[0-9]+_[0-9]+\.zip'|xargs rm -f
如果不仅要删除还要得到删除的数量，可以这样：

find . -regex '\./[0-9]+_[0-9]+\.zip'|tee >(wc -l 1>&2)|xargs rm -f

[PHP二维数组根据某字段排序](https://tiicle.com/items/288/php-two-dimensional-array-ordered-according-to-a-certain-field)
```js
$array=[
    ['name'=>'张三','age'=>'23'],['name'=>'李四','age'=>'64'],
['name'=>'王五','age'=>'55'],['name'=>'赵六','age'=>'66'],
['name'=>'孙七','age'=>'17']];
$sort = array(
    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
    'field'     => 'age',       //排序字段
);
$arrSort = array();
foreach($array as $uniqid => $row){
    foreach($row AS $key=>$value){
        $arrSort[$key][$uniqid] = $value;
    }
}
array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
print_r($array);
Array
(
    [0] => Array
        (
            [name] => 孙七
            [age] => 17
        )

    [1] => Array
        (
            [name] => 张三
            [age] => 23
        )

    [2] => Array
        (
            [name] => 王五
            [age] => 55
        )

    [3] => Array
        (
            [name] => 李四
            [age] => 64
        )

    [4] => Array
        (
            [name] => 赵六
            [age] => 66
        )

)
//定义一个学生数组
$students  = array (
     256=> array ( 'name' => 'jon' , 'grade' =>98.5),
     2=> array ( 'name' => 'vance' , 'grade' =>85.1),
     9=> array ( 'name' => 'stephen' , 'grade' =>94.0),
     364=> array ( 'name' => 'steve' , 'grade' =>85.1),
     68=> array ( 'name' => 'rob' , 'grade' =>74.6),
);
//按照名称进行排序
function name_sort( $x , $y )
{
 return strcasecmp ( $x [ 'name' ], $y [ 'name' ]);
}

//按照成绩进行排序
function grade_sort( $x , $y )
{
 return ( $x [ 'grade' ] > $y [ 'grade' ]);
}
uasort( $students , name_sort);
 
uasort( $students , grade_sort);
```
[php 数组改造](https://segmentfault.com/q/1010000009729734)
```js
$arrayOld = array(
    '17' => array('1'),
    '11' => array('2'),
    '10' => array('6'),
    '9' => array('1'),
);
$arrayNew = [];

foreach($arrayOld as $key => $value){
    $arrayNew[] = [(string)$key,$value[0]];
}

//print_r ($arrayNew);
 function maps(&$array,$key) {
    array_unshift($array, $key);
  }

  array_walk($arrayOld, 'maps');
  print_r($arrayOld);
```
[mysql文档生成PHP程序](https://git.oschina.net/mjw/sqlDoc/blob/master/sql.php?dir=0&filepath=sql.php&oid=cb5db581bdb2e378a8207383c8534396c9f7bb05&sha=114c111a9b7ac5314e73977505ee4743e67a4f87)
```js
$sql="SHOW TABLE STATUS FROM " . DB_NAME; 
$sql_tab='show full fields from `' . $array[$i]['Name'].'`'
中文字符字数读取  mb_strlen($data['content'],'utf8');  对于中文来说，第二个参数请加上。
替换函数  用于隐私处理
$data['mobile'] = substr_replace($data['mobile'],'******',3,5);  //将电话号码中间5位用*代替
$data['email'] = substr_replace($data['email'],'******',0,5);  //将前位用*代替
```
[如何合并数组里某个key值一样的对象](https://segmentfault.com/q/1010000009819805)
```js
var new = Array.from(
  old.reduce((dict, item)=> {
    if (dict.has(item.name)) {
      dict.get(item.name).push(item.id)
    } else {
      dict.set(item.name, [item.id])
    }
    return dict
  }, new Map())
).map(item => ({a: item[1], b: item[0]}))
var old = [
    {
        id: 1,
        name: "first"
    },
    {
        id: 2,
        name: "first"
    },
    {
        id: 3,
        name: "second"
    },
    {
        id: 4,
        name: "second"
    }
]new = [
    {
        a: [1, 2],
        b: "first"
    },
    {
        a: [3, 4],
        b: "second"
    }
]
var getNew = old => {
    let temp = old.reduce((acc, cur) => {
        if (acc[cur.name]){
            acc[cur.name].push(cur.id); 
        } else {
            acc[cur.name] = [cur.id]
        }
        return acc; 
    }, {});
    
    return Object.keys(temp).map(key => {
        return {
            a: temp[key],
            b: key
        }
    })
}
//https://segmentfault.com/q/1010000009821632 
var hash = {};
var i = 0;
var res = [];
old.forEach(function(item) {
    var name = item.name;
    hash[name] ? res[hash[name] - 1].id.push(item.id) : hash[name] = ++i && res.push({
        id: [item.id],
        name: name,
        type: item.type
    })

});
console.log(JSON.stringify(res))
```
[无限分类之无限方法](http://www.majianwei.com/%e6%97%a0%e9%99%90%e5%88%86%e7%b1%bb%e4%b9%8b%e6%97%a0%e9%99%90%e6%96%b9%e6%b3%95/)
[基于chrome扩展的脚本注入工具](https://zhuanlan.zhihu.com/p/27427557?group_id=859108597462859776)
[来自新浪微博的面试题](https://laravel-china.org/topics/4941/interview-questions-from-sina-and-micro-blog)
```js
function king ($n, $m){
    $s = 0;
    for($i=1;$i<=$n;$i++) {
        $s = ($s+$m)%$i;
    }
    return $s+1;
}

echo king(5,2);     // 3
$arr=
[
'赵','钱','孙','李',
'周','吴','郑','王',
'冯','陈','褚','魏',
'蒋','沈','韩','杨'
];

function countM($arr,$step)
{
$i=1;

while (count($arr)>1)
{
    if ($i==$step)
    {
        array_shift($arr);
        $i=0;
    }else
    {
        array_push($arr,array_shift($arr));
    }

    $i++;
}

echo array_shift($arr);
}
function monkey($monkey, $x) {
    $arr = range(1, $monkey);
    $i   = 0;
    while (count($arr) > 1) {
        if (($i+1) % $x !== 0) {
            array_push($arr, $arr[$i]);
        }
        unset($arr[$i]);
        $i++;
    }
    return implode('', $arr);
}

echo 'The winner is ' . monkey(5, 5);
```
[Notadd 商城模块 ](https://laravel-china.org/articles/5002/notadd-mall-module-product-documentation-apache-open-source)
https://github.com/notadd/notadd
[2017 第三届PHP全球开发者大会PPT/Keynote](https://github.com/devlinkcn/ppts_for_php2017)
[利用 ngrok 代替 在线测试服务器 进行开发的简单使用](https://laravel-china.org/articles/4978/use-ngrok-instead-of-online-test-server-for-simple-development)
Laravel 的命令 php artisan cache:clear 用来清除各种缓存，如页面，Redis，配置文件等缓存，它会清空 Redis 数据库的全部数据，比如默认使用的 Redis 的数据库是 db0，那么执行这个命令后，会清空 db0 中所有数据。Laravel的话，在Controller中要使用$msg = $request->getContent()获取原始数据。
[ThinkSNS+ 是如何计算字符显示长度的](https://laravel-china.org/articles/4803/how-does-thinksns-calculate-the-character-display-length-using-the-laravel-custom-validation-rule)
[如何创建一个自己的 Composer 库](https://laravel-china.org/articles/4982/how-do-i-create-my-own-composer-library)
[Zttp 发送 form params 请求 而非 JSON 请求](https://laravel-china.org/articles/4959/zttp-sends-form-params-requests-instead-of-json-requests)
$response = Zttp::withHeaders(['Fancy' => 'Pants'])->post($url, [
    'foo' => 'bar',
    'baz' => 'qux',
]);

$response->json();
Zttp::asFormParams()->post(bd_api_url(), $params);

[Laravel 中调试输出 SQL 语句的简便方法](https://laravel-china.org/articles/4812/a-simple-way-to-debug-and-output-sql-statements-in-laravel)
```js
\DB::listen(function($sql, $bindings, $time) {
     foreach ($bindings as $replace){
         $value = is_numeric($replace) ? $replace : "'".$replace."'";
         $sql = preg_replace('/\?/', $value, $sql, 1);
     }
     dd($sql);
 })
```
[查看公网出口IP](https://laravel-china.org/topics/4772/the-composer-image-collection-problem-caton-welcome-feedback)
```js
# 1. curl 命令方法
curl http://ipv4.icanhazip.com

# 2. 或者 php
php -r "readfile('http://ipv4.icanhazip.com');"

Trait 在我理解是一个不能实例化的class，用于实现多继承的关系。 你有一个杯子，空值代表杯子是真空的，NULL代表杯子中装满了空气，虽然杯子看起来都是空的，但是区别是很大的。
$user = User::find(1);
$user->touch();
用 touch() 方法可以不需要更新其他字段就用当前时间戳对 updated_at 进行更新。这个方法用来保存 最后一次处理时间 亦或者是 用户最近一次活跃时间 是极好的。
```
[使用 ngrok 让外网也能访问本地](https://laravel-china.org/articles/4339/use-ngrok-to-allow-access-to-the-local-network)
git clone https://github.com/HanSon/ngrok-script.git
cd ngrok-script
// if linux or mac
./ngrok.sh domain
// if windows
ngrok.bat domain
[简单快速的开发 Web 应用， PHP 框架 Lemon 介绍](https://laravel-china.org/topics/4671/write-a-small-project-for-the-php-framework-to-support-regular-routing-database-query-chain)
[Laravel 核心——IoC 服务容器源码解析（服务器解析）](https://laravel-china.org/articles/4700/laravel-core-ioc-service-container-source-code-analysis-server-resolution)

[Composer 系列：autoload](https://laravel-china.org/articles/4802/composer-series-autoload)

[Allowed memory size of 134217728 bytes 错误解决心得](https://laravel-china.org/articles/4736/allowed-memory-size-of-134217728-bytes-error-resolution)
不下二十个字段，所有字段都查询出来肯定撑爆内存。
最后修改代码：$*****->get(["uid","loginid","steamid","created_at","name"]);
[简单的初级压力测试](https://laravel-china.org/articles/4765/simple-primary-stress-test)

