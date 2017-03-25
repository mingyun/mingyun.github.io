[PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js

$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve($list) {
    $newList = $manages = $deeps = $inDeeps = array();
    foreach ($list as $row) {
        $newList[$row['id']] = $row;
    }
    $list = null;
    foreach ($newList as $row) {
        if (! isset($manages[$row['pid']]) || ! isset($manages[$row['pid']]['children'][$row['id']])) {
            if ($row['pid'] > 0 && ! isset($manages[$row['pid']]['children'])) $manages[$row['pid']] = $newList[$row['pid']];
            $manages[$row['pid']]['children'][$row['id']] = $row;
        }
        if (! isset($inDeeps[$row['deep']]) || ! in_array($row['id'], $inDeeps[$row['deep']])) {
            $inDeeps[$row['deep']][] = array($row['pid'], $row['id']);
        }
    }
    krsort($inDeeps);
    array_shift($inDeeps);
    foreach ($inDeeps as $deep => $ids) {
        foreach ($ids as $m) {
            // 存在子栏目的进行转移
            if (isset($manages[$m[1]])) {
                $manages[$m[0]]['children'][$m[1]] = $manages[$m[1]];
                $manages[$m[1]] = null;
                unset($manages[$m[1]]);
            }
        }
    }
    return $manages[0]['children'];
}
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
Array
(
    [1] => Array
        (
            [id] => 1
            [pid] => 0
            [deep] => 0
            [name] => test1
            [children] => Array
                (
                    [2] => Array
                        (
                            [id] => 2
                            [pid] => 1
                            [deep] => 1
                            [name] => test2
                            [children] => Array
                                (
                                    [4] => Array
                                        (
                                            [id] => 4
                                            [pid] => 2
                                            [deep] => 2
                                            [name] => test4
                                        )

                                    [5] => Array
```
[PHP5.6通过CURL上传图片@符无效的兼容问题](http://blog.csdn.net/zhouzme/article/details/51050980)
```js
CURL 的一个配置参数 CURLOPT_SAFE_UPLOAD 
CURLOPT_SAFE_UPLOAD 在 PHP5.5中默认值是 false 
而在 PHP5.6中已经默认为 true 了。 
所以只需要增加一行强制设置为 false 就行，如下： 
注意：该参数的设置顺序，必须在设置 CURLOPT_POSTFIELDS 参数之前才有效哦
$url = 'http://127.0.0.1/test3.php';
$file = __DIR__ .'/0634134726bc5b8b.jpg';
$data = array('mypic'=>new CURLFile($file));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$content = curl_exec($curl);
curl_close($curl);
print_r($content);
```
[PhpMyAdmin+Opcache出现无响应，500错误](http://blog.csdn.net/zhouzme/article/details/54345932)

设置 opcache 黑名单打开 php.ini 
搜索 blacklist_filename，设置为你的文件绝对路径就可以了，若没有则添加一条
[opcache]
opcache.blacklist_filename="C:/ProgramFiles(x86)/php_opcache_blacklist"
[ Windows RunHiddenConsole 后台运行 nginx，php，redis](http://blog.csdn.net/zhouzme/article/details/53613594)
start-redis.bat
C:\RunHiddenConsole\RunHiddenConsole redis-server.exe redis-union.conf --loglevel verbose 
[ PHP5.5在windows 安装使用 memcached 服务端的方法以及 php_memcache.dll 下载](http://blog.csdn.net/zhouzme/article/details/22231931)
[ phpDocumentor2安装配置和使用](http://blog.csdn.net/zhouzme/article/details/25816753)
[PHP截取含中文的混合字符串长度的函数](http://blog.csdn.net/zhouzme/article/details/18909537)
```js
/** 
 * 截取中文混合字符串指定长度 
 *  
 * @param string $string 
 * @param integer $length 
 * @param string $etc 超过长度时的省略符 
 * @param string $charset 字符编码 utf-8 或者 gbk 
 * @return string 
 */  
public function truncateCn($string, $length = 80, $etc = '...', $charset = 'utf-8')  
{  
    if ($length == 0) {  
        return '';  
    }  
         
    if (function_exists('mb_substr')) {  
        $etc = mb_strlen($string, $charset) > $length ? $etc : '';  
        return mb_substr($string, 0, $length, $charset) . $etc;  
    }  
         
    if ($charset == 'utf-8') {  
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";  
    }  
    else {  
        $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";  
    }  
    preg_match_all($pa, $string, $t_string);  
    if (count($t_string[0]) > $length) {  
        return join('', array_slice($t_string[0], 0, $length)) . $etc;  
    }  
         
    return join('', array_slice($t_string[0], 0, $length));  
}  
```
[PHP全角半角转换函数](http://blog.csdn.net/zhouzme/article/details/18909523)
```js
/** 
  * 全角字符转换为半角 
  *  
  * @param string $str 
  * @return string 
  */  
 public function Sbc2Dbc($str)  
 {  
     $arr = array(  
             '０'=>'0', '１'=>'1', '２'=>'2', '３'=>'3', '４'=>'4','５'=>'5', '６'=>'6', '７'=>'7', '８'=>'8', '９'=>'9',   
             'Ａ'=>'A', 'Ｂ'=>'B', 'Ｃ'=>'C', 'Ｄ'=>'D', 'Ｅ'=>'E','Ｆ'=>'F', 'Ｇ'=>'G', 'Ｈ'=>'H', 'Ｉ'=>'I', 'Ｊ'=>'J',   
             'Ｋ'=>'K', 'Ｌ'=>'L', 'Ｍ'=>'M', 'Ｎ'=>'N', 'Ｏ'=>'O','Ｐ'=>'P', 'Ｑ'=>'Q', 'Ｒ'=>'R', 'Ｓ'=>'S', 'Ｔ'=>'T',   
             'Ｕ'=>'U', 'Ｖ'=>'V', 'Ｗ'=>'W', 'Ｘ'=>'X', 'Ｙ'=>'Y','Ｚ'=>'Z', 'ａ'=>'a', 'ｂ'=>'b', 'ｃ'=>'c', 'ｄ'=>'d',   
             'ｅ'=>'e', 'ｆ'=>'f', 'ｇ'=>'g', 'ｈ'=>'h', 'ｉ'=>'i','ｊ'=>'j', 'ｋ'=>'k', 'ｌ'=>'l', 'ｍ'=>'m', 'ｎ'=>'n',   
             'ｏ'=>'o', 'ｐ'=>'p', 'ｑ'=>'q', 'ｒ'=>'r', 'ｓ'=>'s', 'ｔ'=>'t', 'ｕ'=>'u', 'ｖ'=>'v', 'ｗ'=>'w', 'ｘ'=>'x',   
             'ｙ'=>'y', 'ｚ'=>'z',  
             '（'=>'(', '）'=>')', '〔'=>'(', '〕'=>')', '【'=>'[','】'=>']', '〖'=>'[', '〗'=>']', '“'=>'"', '”'=>'"',   
             '‘'=>'\'', '’'=>'\'', '｛'=>'{', '｝'=>'}', '《'=>'<','》'=>'>','％'=>'%', '＋'=>'+', '—'=>'-', '－'=>'-',   
             '～'=>'~','：'=>':', '。'=>'.', '、'=>',', '，'=>',', '、'=>',',  '；'=>';', '？'=>'?', '！'=>'!', '…'=>'-',   
             '‖'=>'|', '”'=>'"', '’'=>'`', '‘'=>'`', '｜'=>'|', '〃'=>'"','　'=>' ', '×'=>'*', '￣'=>'~', '．'=>'.', '＊'=>'*',  
             '＆'=>'&','＜'=>'<', '＞'=>'>', '＄'=>'$', '＠'=>'@', '＾'=>'^', '＿'=>'_', '＂'=>'"', '￥'=>'$', '＝'=>'=',  
             '＼'=>'\\', '／'=>'/'  
         );  
     return strtr($str, $arr);  
 }  
```
[PHP 获取指定日期对应的星座名称](http://blog.csdn.net/zhouzme/article/details/18909505)
```js
public function getConstellation($month, $day)  
    {  
        $day   = intval($day);  
        $month = intval($month);  
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;  
        $signs = array(  
                array('20'=>'宝瓶座'),  
                array('19'=>'双鱼座'),  
                array('21'=>'白羊座'),  
                array('20'=>'金牛座'),  
                array('21'=>'双子座'),  
                array('22'=>'巨蟹座'),  
                array('23'=>'狮子座'),  
                array('23'=>'处女座'),  
                array('23'=>'天秤座'),  
                array('24'=>'天蝎座'),  
                array('22'=>'射手座'),  
                array('22'=>'摩羯座')  
        );  
        list($start, $name) = each($signs[$month-1]);  
        if ($day < $start)  
            list($start, $name) = each($signs[($month-2 < 0) ? 11 : $month-2]);  
        return $name;  
    }  
```
[ mysql连接失败或出现“Too many connections”错误](http://blog.csdn.net/zhouzme/article/details/20015887)
修改为：max_connections = 1000


默认值：100

最大值：16384

即该参数最大值不能超过16384，即使超过也以16384为准
[PHP的ip2long和long2ip函数的实现原理](http://blog.csdn.net/zhouzme/article/details/35285831)
```js
$ip = '12.34.56.78';  
$ips = explode('.', $ip);  
$result = 0;  
$result += $ips[0]<<24;  
$result += $ips[1]<<16;  
$result += $ips[2]<<8;  
$result += $ips[3];  
echo bindec(decbin($result));  
echo '<br>';  
echo bindec(decbin(ip2long($ip)));  
echo '<br>';  
  
$str = '';  
$str .= intval($result/intval(pow(2, 24))) .'.';  
$str .= intval(($result&0x00FFFFFF)/intval(pow(2, 16))) .'.';  
$str .= intval(($result&0x0000FFFF)/intval(pow(2, 8))) .'.';  
$str .= intval($result&0x000000FF);  
  
echo $str;  
echo '<br>';  
echo long2ip($result); 
```
[Redis 数据序列化方法 serialize, msgpack, json, hprose 比较](http://blog.csdn.net/zhouzme/article/details/46863709)
```js
 Msgpack 都是非常牛逼的，只不过需要自己单独安装 Msgpack 的扩展，不过安装也很简单的。

服务器上可以直接 pecl install msgpack 
如果不行的话，就手动下载 tgz 包: 
在这里下载最新版本 https://pecl.php.net/package/msgpack 
然后 pecl install msgpack-0.5.6.tgz 即可


```
