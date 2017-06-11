[关于不同的商品总价计算的问题](https://segmentfault.com/q/1010000009685623)
```js
 $math = '%s*%s';
    $str  = sprintf($math, 5, 6);
    $result=eval("return $str;");
    var_dump($result);
```
[php 批量插入10w 条内容导致内存撑爆128mb 怎么处理](https://segmentfault.com/q/1010000009644725)
```js
自己生成一张id表(只存id一个字段),记录10w条(0-10w)
mysql做法:

insert into table t
select i.id, concat('名字', i.id) name, 
    concat('随机生成码7-12:',FLOOR(7 + (RAND() * 6))) rand,
    ifnull(a.nickname, 'No nickname') nickname,
    uuid() descript, --随机字符串
    from_unixtime(unix_timestamp("20170101000000")+FLOOR((RAND()*60*60*24*365)))  --2017年中随机日期
from table_id i
left join table_account a on a.id=FLOOR((RAND()*12)) --如果数据来源另外一些表
where i.id < 1000  --如果只要生成1000条
```
[mysql中You can't specify target table for update in FROM clause错误](https://segmentfault.com/q/1010000009615307)
```js
delete from tbl where id in 
(
        select max(id) from tbl a where EXISTS
        (
            select 1 from tbl b where a.tac=b.tac group by tac HAVING count(1)>1
        )
        group by tac
)

改写成下面就行了：
delete from tbl where id in 
(
    select a.id from 
    (
        select max(id) id from tbl a where EXISTS
        (
            select 1 from tbl b where a.tac=b.tac group by tac HAVING count(1)>1
        )
        group by tac
    ) a
)
```
如何降低Laravel artisan 报错级别https://segmentfault.com/q/1010000009623981
框架代码位置：Illuminate\Foundation\Bootstrap\HandleExceptions::bootstrap()
[php 解压.gz文件格式的方法。](https://segmentfault.com/q/1010000009691227)
```js
$file_name = 'file.txt.gz';

// Raising this value may increase performance
$buffer_size = 4096; // read 4kb at a time
$out_file_name = str_replace('.gz', '', $file_name);

// Open our files (in binary mode)
$file = gzopen($file_name, 'rb');
$out_file = fopen($out_file_name, 'wb');

// Keep repeating until the end of the input file
while(!gzeof($file)) {
    // Read buffer-size bytes
    // Both fwrite and gzread and binary-safe
    fwrite($out_file, gzread($file, $buffer_size));
}

// Files are done, close files
fclose($out_file);
gzclose($file);
```
[laravel的Baum怎么获得某一条记录的最终父类id](https://segmentfault.com/q/1010000009658954)
```js
    $arr = array(
                array(
                    'id'        => 10,
                    'parent_id' => 9
                    ),
                array(
                    'id'        => 9,
                    'parent_id' => 5
                    ),
                array(
                    'id'        => 5,
                    'parent_id' => null
                    ),
        
        
        );
    function getParentId($arr, $id = 10) {
        foreach ($arr as $val) {
            if($val['id'] == $id) {
                if(!empty($val['parent_id'])) {
                    $id = $val['parent_id'];
                    getParentId($arr, $id);
                }else {
                    return $id;
                }
            }
        }
        return $id;
    }
    
    echo getParentId($arr, 10);
```
[larave session问题，为什么每次session_id都要变](https://segmentfault.com/q/1010000009694886)
一切都是在EncryptCookies中进行的

\App\Http\Middleware\EncryptCookies::class

larave_session

先经过base64_decode，在json_decode在进行一些列验证 然后通过openssl_decrypt解密出真正存储在redis或其他drive里面的session_id

[php使用curl处理文件下载url连接](https://segmentfault.com/q/1010000009708754)
一般返回数据的使用curl处理数据的方法会使用
把返回的content用file_put_contents写入就行了

file_put_contents(__DIR__.'/yourfilename.ext', $response);

[python每隔10秒运行一个指定函数怎么实现呢](https://segmentfault.com/q/1010000009706708)
[Python如何把两个列表相减呢？](https://segmentfault.com/q/1010000009706425)
A = [item for item in A if item not in set(B)]
a = ['2016-01-01','2016-01-02','2016-01-03','2017-06-01', '2016-03-08']
b = ['2016-03-02','2016-03-08',]
print set(a) - set(b)
[如何测试ip响应时间，可以设置毫秒级超时](https://segmentfault.com/q/1010000009681356)
```js
#coding=utf8
import os
ip_list=['192.168.0.1','192.168.0.2','192.168.0.3','192.168.0.106']
for each in ip_list:
    a=os.popen('ping -n 1 %s'%each).read().decode('gbk')
    b=a.find('=')
    c=a.find('ms')
    time=a[b+7:c]
    try:
        if int(str(time))>=500:
            print 'time >= 500ms'
        else:
            print each+'  :  '+time+'ms'
    except Exception as e:
        print 'lost'
        
  proxies在你访问http时用http的设置，访问https时用https的设置所以你的proxy需要同时包含http及https的配置，这样才能生效

proxy = {
    'http': 'http://117.85.105.170:808',
    'https': 'https://117.85.105.170:808'
}      
```
[如何用Python计算100以内的素数](https://segmentfault.com/q/1010000009670976)
从 2 到 sqrt(n):
   存在一个 n 为因数,不为素数,返回 False
不存在,为素数,返回 true
[正常输出中文没有乱码，zip函数之后出现中文编程unicode编码的问题，我是遍历输出的啊。](https://segmentfault.com/q/1010000009697159)
```js
因为zip将每两个独立的字符串, 组合成了一个元组, 而中文在元组,列表等等这些数据结构中, 是按照unicode或者十六进制存储, 所以你看到的会是这个结果, 这些不影响使用, 也不是乱码, 因为直接遍历出来, 将元素单独打印出来, 就能看到人可识别的内容了, 可以用下面的代码帮助理解:

# coding: utf8
a = u'你好'
print a          # 独立打印

s = []           # 创建列表, 并存入列表
s.append(a)   
print s          # 将整个列表打印, 看到unicode编码存储的内容
print s[0]       # 将元素单独打印, 看到正常的内容

#### 输出  ###
你好
[u'\u4f60\u597d']
你好
 '&lt;abc&gt;' 遇到这样的html转义符如何自动转义呢？
from html.parser import HTMLParser
html_parser = HTMLParser()
s = '&lt;abc&gt;&nbsp;'
txt = html_parser.unescape(s)
print(txt)
# 结果：<abc>

Python 3 转成Python 2,安装 3to2

安装: pip install 3to2, 运行: 3to2 file.py, 具体怎么用 看3to2 --help

r'(?<=[A-Z]{3})([a-z])(?=[A-Z]{3})'

>>> import re
>>> rawstring = 'aAFDdADDdDFDsDFS'
>>> reg = r'(?<=[A-Z]{3})([a-z])(?=[A-Z]{3})'
>>> pattern = re.compile(reg)
>>> pattern.findall(rawstring)
['d', 'd', 's']
如果是numpy的话,可以使用numpy.savetxt直接进行保存为文件。
建议使用生产消费者模式，生产者多个线程向队列里写log,消费者从队列里取log写入日志
```
算法高手看过来https://segmentfault.com/q/1010000009551198
关于json中获取多个key-value对中多层嵌套key的namehttps://segmentfault.com/q/1010000009698900
使用pip3 install lxml -v 打印更多信息,我估计系统没装libXXXdev所致
Python的一个列表赋值问题https://segmentfault.com/q/1010000009674963
编程，算法的问题https://segmentfault.com/q/1010000009642781
[python 如何将字符串转换成列表](https://segmentfault.com/q/1010000009225510)
```js
# 第一种:
>>> a = u"我是中国人"
>>> s = list(a)
>>> print s
[u'\u6211', u'\u662f', u'\u4e2d', u'\u56fd', u'\u4eba']
>>> print s[1]
是

# 第二种
>>> a = "我是中国人"
>>> s = a.decode('utf8')
>>> s = list(a.decode('utf8'))
>>> s
[u'\u6211', u'\u662f', u'\u4e2d', u'\u56fd', u'\u4eba']
>>> print s[1]
是
var_export(preg_split('##u', '中国人民银行', null, PREG_SPLIT_NO_EMPTY));
// array(0=>'中',1=>'国',2=>'人',3=>'民',4=>'银',5=>'行')
strip是去除左右两端的空格，中间的空格去除不了。 
replace不能用正则表达式做参数，要用 re模块。

import re
re.sub('\s+', ';', 'w w')
函数里有两个值a、b，要求，返回a的概率是65%，b返回的概率35%
if random(0,1) < 0.65
    return a
else
    return b
```
php如何将字符串的网址替换成a标签,求完善https://segmentfault.com/q/1010000009732553
php 数组改造https://segmentfault.com/q/1010000009729734
```js
$old = array(
    '17' => '1',
    '11' => '2',
    '10' => '6',
    '9' => 1 
);

$new = array_chunk($old, 1, true);
foreach ($new as $key => &$val) {
    array_unshift($val, $key);
}
```
Python 如何匹配汉语拼音？https://segmentfault.com/q/1010000009553095
import re
regex = re.compile(r'\b[a-z]*[āáǎàōóǒòêēéěèīíǐìūúǔùǖǘǚǜüńňǹɑɡ]+[a-z]*\b')
text = "Thǐs ís à pìnyin abóut shá"
m = regex.findall(text)
print(m)
我提交的Composer包无法requirehttps://segmentfault.com/q/1010000009724384
 Could not find package changwei/array2text at any version for your minimum-
  stability (stable). Check the package spelling or your minimum-stability
  你要在github发布release才可以，不然你只能用dev-master版本
为什么php 可以通过 :: 直接调用类的非静态方法https://segmentfault.com/q/1010000009702914
```js
class Demo
{
    public function testing()
    {
        echo "testing\n";
    }
}

Demo::testing();
```
php 大神看看一个数组问题https://segmentfault.com/q/1010000009691691
```js
$a = "[['7','2'],['8','2'],['11','2'],['10','2'],['9','2']]";
$result = array();
preg_match_all("/'(\d*)'/", $a, $matches);
for ($i = 0; $i < count($matches[1]); $i += 2){
   $result[(int)$matches[1][$i]] = (int) $matches[1][$i+1];
}
$str = "[['7','2'],['8','2'],['11','2'],['10','2'],['9','2']]";
var_dump(eval('return '.$str.';'));
$sqldata = "[['7','2'],['8','2'],['11','2'],['10','2'],['9','2']]";
$sqldata = str_replace('\'', '\"', $sqldata );
$data = json_decode($sqldata);
echo $data[0][1]; // >> 2
```
composer不知什么原因，遇到https，就会报SSL: Handshake timed out，Google也没结果https://segmentfault.com/q/1010000009709439
打开php.ini, 将default_socket_timeout值调大。如：default_socket_timeout=360(默认为-1或60)
拖曳排序保存問題 php mysqlhttps://segmentfault.com/q/1010000009720109
拖拽的结果只是改变排序字段的数值，删掉一个肯定不会乱掉的，逻辑有问题
[三元运算符结合方向的问题https://segmentfault.com/q/1010000009685491]()
java 从右向左。等效于3<8?(9<6?7:5):(2>0?4:1)
php 从做向右。等效于(3<8?(9<6?7:5):2)>0?4:1

js怎么用正则找出一个字符串里两个特定字符之间的字符串呢？https://segmentfault.com/q/1010000009676831
```js
function pick(str){
    var reg = /@([^\s]*?)\s/g, ret = [];
    while(arr = reg.exec(str)) ret.push(arr[1]);
    return ret;
}
pick("@3131 @aba21bas @zxcc@213wd cccaf21212" )
```
请问php中如何将查询出来的结果数组转化成自己想要的格式https://segmentfault.com/q/1010000009674939
https://github.com/TIGERB/easy-tips 
php版本在5.6及之后，且在保证$Myconfig['Cookie']的下标顺序与setcookie的参数顺序一致的情况下，可以写成setcookie(...$Myconfig['Cookie'])
//定义各个数组
$MyConfig['Cookie'] = array(
    'name' => $cookie_name,
    'value' => $cookie_value,
    'expire' => $cookie_expire,
    'path' => $cookie_path,
    'domain' => $cookie_domain,
    'secure' => $cookie_secure,
    'httponly' => $cookie_httponly,
);
ThinkPHP无限分类https://segmentfault.com/q/1010000009620383
```js
public function gettree($items, $parent_id = 'parent_id', $id = 'id'){
    $tree = array(); //格式化好的树
    if(empty($items)){
        return $tree;
    }
    foreach ($items as $item){
        if (isset($items[$item[$parent_id]])){
            $items[$item[$parent_id]]['son'][] = &$items[$item[$id]];
        }else{
            $tree[] = &$items[$item[$id]];
        }
    }
    return $tree;

}
private function getTreeList($data, $pid = 0)
    {
        $resultarr = array();
        foreach ($data as $teamdata) {
            if ($teamdata['pid'] == $pid) {
                $team_data = $teamdata;
                $children_data = $this->getTreeList($data, $teamdata['id']);
                $team_data['children'] = $children_data;
                $resultarr[] = $team_data;
            }
        }
        return $resultarr;
    }
```
PHP use 命名空间时，为什么要精确到命名空间下的一个类https://segmentfault.com/q/1010000009664741
