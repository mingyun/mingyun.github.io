###MySQL行转列
+--------+----------+-----------+
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
```php
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
###


