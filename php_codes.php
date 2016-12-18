###数组扁平化
```php
$arr=[[1,2,3],[4,5,[6]]];
print_R(flatten($arr));//[1,2,3,4,5,6]
function flatten($arr){
    $result= [];
    foreach($arr as $k => $v){
        if(is_array($v)){
            $result = array_merge($result,flatten($v));
        }else if(is_numeric($k)){
            $result[] = $v;
        }else{
            $result[$k] = $v;
        }
    }
    return $result;
}
```
###生成不重复数字
```php
function getNum()
    {
        do {
            $num = sprintf('%10d', rand(1000000000, 9999999999));
            $arr = User::where("code",$num)->first();//laravel query
        } while ($arr);

        return $num;
    }
```
###获取周所在日期
```php
function weekday($year, $week = 1){
    $year_start = mktime(0,0,0,1,1,$year);
    $year_end = mktime(0,0,0,12,31,$year);

    if (intval(date('w',$year_start)) === 1){
        $start = $year_start;
    }else{
        $start = strtotime('+1 monday',$year_start);
    }

    if ($week === 1){
        $weekday['start'] = $start;
    }else{
        $weekday['start'] = strtotime('+'.($week-0).' monday',$start);
    }

    $weekday['end'] = strtotime('+1 sunday',$weekday['start']);
     //如果跨年，取最后一天
    if (date('Y',$weekday['end'])!=$year){
        $weekday['end'] = $year_end;
    }
    return array_map(function($i){
        return date('Y-m-d',$i);
    },$weekday);
}
```
###数组排序,类似sql order by a,b
```php
function multiSort(&$data, $fields){
    //$fields = ['id'=>'desc', 'time'=>'asc'];
    usort($data, function($a, $b) use ($fields) {
        $cmp = 0;
        foreach ($fields as $field => $direction) {
            //循环比较
            if($a[$field] == $b[$field]){
                $cmp = 0;
            }else{
                if ($direction == 'desc') { //降序
                    $cmp = $a[$field] > $b[$field] ? -1 : 1;
                } else {
                    $cmp = $a[$field] < $b[$field] ? -1 : 1;
                }
            }
            // 如果第一个字段就比较出来了，直接结束
            if ($cmp == 0) {
                continue;
            } else {
                break;
            }
        }
        return $cmp;
    });
    return $data;
}
```
###保留中文数字字母
```php
echo matchChinese('&^%123php最好的语言');//123php最好的语言
function matchChinese($chars, $encoding = 'utf8')
    {
        $pattern = ($encoding == 'utf8') ? '/[\x{4e00}-\x{9fa5}a-zA-Z0-9]/u' : '/[\x80-\xFF]/';
        preg_match_all($pattern, $chars, $result);
        $temp = join('', $result[0]);
        return $temp;
    }
```
###多数组合并相加
```php
$r1=['10'=>1,'18'=>4,'12'=>8];
 $r2=['10'=>10,'1'=>4,'12'=>1]; 
$r3=['15'=>10,'11'=>4,'2'=>1];  
function array_sum_with_key(array $arr1, array $arr2, array $_ = null)
{
    $args = array_slice(func_get_args(), 1);

    foreach ($args as $arr) {
        foreach ($arr as $k => $v) {
            if (isset($arr1[$k])) {
                $arr1[$k] += $v;
            } else {
                $arr1[$k] = $v;
            }
        }
    }

    return $arr1;
}
 array_sum_with_key($r1,$r2,$r3)
 [
     10 => 11,
     18 => 4,
     12 => 9,
     1  => 4,
     15 => 10,
     11 => 4,
     2  => 1
 ]
```
###单例 
```php
class test{
static protected $_instance;
public static function getInstance() {
        if (!static::$_instance instanceof static) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }
}
$instance = test::getInstance();
```
###变量交换
```php
list($a,$b)=array($b,$a);
a=a+b,b=a-b,a=a-b;
```
###数组去重
```php
array_keys(array_flip($arr));  
array_merge(array_flip(array_flip($arr)));
```
###pdo like
```php
$stmt = $db->prepare("SELECT * FROM REGISTRY where name LIKE ?");
$stmt->execute(array("%$_GET[name]%"));

//下面这样有问题
$stmt = $db->prepare("SELECT * FROM REGISTRY where name LIKE '%?%'");
$stmt->execute(array($_GET['name']));
```
###导出excel
```php
 function export_csv($filename){
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
    }
    export_csv('mycsv.csv');
    echo $str =  iconv('utf-8','GBK//IGNORE',"js,php,js");
    ob_flush();
    flush();
```
###图片生成base64
```php
function base64EncodeImage ($image_file) {
  $base64_image = '';
  $image_info = getimagesize($image_file);
  $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
  $base64_image = 'data:' . $image_info['mime'] . ';base64,' .
 chunk_split(base64_encode($image_data));
  return $base64_image;
}
```
###方便sql中拼接字符串
```php
$str="'".implode("','",['a','b'])."'";
"'a','b'"
explode(',',$str)
[
    "'a'",
    "'b'"
]
$sql = "select *from user where name in (".$str.")";
```
###php数组转js数组
`var arr = <?php echo json_encode($arr); ?>`
###5345678986到5,345,678,986
` number_format('5345678986', 0, '.', ',');`
###curl post file
```php
// form field separator //http://stackoverflow.com/questions/3085990/post-a-file-string-using-curl-in-php
$delimiter = '-------------' . uniqid();
// file upload fields: name => array(type=>'mime/type',content=>'raw data')
$fileFields = array(
    'file1' => array(
        'type' => 'text/plain',
        'content' => '...your raw file content goes here...'
    ), /* ... */
);
// all other fields (not file upload): name => value
$postFields = array(
    'otherformfield'   => 'content of otherformfield is this text',
    /* ... */
);
 
$data = '';
 
// populate normal fields first (simpler)
foreach ($postFields as $name => $content) {
   $data .= "--" . $delimiter . "\r\n";
    $data .= 'Content-Disposition: form-data; name="' . $name . '"';
    // note: double endline
    $data .= "\r\n\r\n";
}
// populate file fields
foreach ($fileFields as $name => $file) {
    $data .= "--" . $delimiter . "\r\n";
    // "filename" attribute is not essential; server-side scripts may use it
    $data .= 'Content-Disposition: form-data; name="' . $name . '";' .
             ' filename="' . $name . '"' . "\r\n";
    // this is, again, informative only; good practice to include though
    $data .= 'Content-Type: ' . $file['type'] . "\r\n";
    // this endline must be here to indicate end of headers
    $data .= "\r\n";
    // the file itself (note: there's no encoding of any kind)
    $data .= $file['content'] . "\r\n";
}
// last delimiter
$data .= "--" . $delimiter . "--\r\n";
 
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_HTTPHEADER , array(
    'Content-Type: multipart/form-data; boundary=' . $delimiter,
    'Content-Length: ' . strlen($data)));  
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
curl_exec($handle);
```
###两个数组根据id合并
```php
$arr = array(
    array(
    'id' => 1,
    'user_name'=>'test1'
    ),
    array(
    'id' => 2,
    'user_name'=>'test2'
    ),
    array(
    'id' => 3,
    'user_name'=>'test3'
    )
);
 
$arr2 = array(
     array(
    'id' => 1,
    'shop_name'=>'shop1'
    ),
    array(
    'id' => 5,
    'shop_name'=>'shop2'
    ),
    array(
    'id' => 3,
    'shop_name'=>'shop3'
    ),
    array(
    'id' => 4,
    'shop_name'=>'shop4'
    )
);
 
$goods_arr = array();
foreach ($arr as $data) {
    $goods_arr[$data['id']] = array('id'=>$data['id'],'shop_name'=>'','user_name'=>$data['user_name']);
}
foreach ($arr2 as $data) {
    if(isset($goods_arr[$data['id']])){
        $goods_arr[$data['id']]['shop_name'] = $data['shop_name'];
    }else{
        $goods_arr[$data['id']] = array('id'=>$data['id'],'shop_name'=>$data['shop_name'],'user_name'=>'',);
    }
}
 
var_dump(array_values($goods_arr));
/*
Array
(
    [0] => Array
        (
            [id] => 1
            [shop_name] => shop1
            [user_name] => test1
        )
 
    [1] => Array
        (
            [id] => 2
            [shop_name] => 
            [user_name] => test2
        )
 
    [2] => Array
        (
            [id] => 3
            [shop_name] => shop3
            [user_name] => test3
        )
 
    [3] => Array
        (
            [id] => 5
            [shop_name] => shop2
            [user_name] => 
        )
 
    [4] => Array
        (
            [id] => 4
            [shop_name] => shop4
            [user_name] => 
        )
 
)
 
*/
function mergeArr($a,$b,$c) {
        return array_merge($a,$b,$c);
}
$a = ['0'=>['account' => '6'],'1'=>['account' => '3']];
$b = ['0'=>['netfile' => '7'],'1'=>['netfile' => '2']];
$c = ['0'=>['cf' => '9'],'1'=>['cf' => '2']];
>>> array_map('mergeArr', $a,$b,$c)
=> [
     [
       "account" => "6",
       "netfile" => "7",
       "cf" => "9",
     ],
     [
       "account" => "3",
       "netfile" => "2",
       "cf" => "2",
     ],
   ]
```
###Unicode转换utf8
```php
function unicode_to_utf8($unicode) {
    $utf8_str = '';
    $code = intval(hexdec($unicode));
    $ord_1 = decbin(0xe0 | ($code >> 12));
    $ord_2 = decbin(0x80 | (($code >> 6) & 0x3f));
    $ord_3 = decbin(0x80 | ($code & 0x3f));
    $utf8_str = chr(bindec($ord_1)) . chr(bindec($ord_2)) . chr(bindec($ord_3));
    return $utf8_str;
}
echo unicode_to_utf8('\u611f');//感
```
###json_decode 后，数字转换成了科学计数
```php
$obj='{"order_id":213477815351175,"buyer":100001169269154}';
$obj=json_decode($obj,TRUE);
print_r($obj);

Array
(
    [order_id] => 2.1347781535118E+14
    [buyer] => 1.0000116926915E+14
)

$obj='{"order_id":213477815351175,"buyer":100001169269154}';
$obj=json_decode($obj,TRUE);
foreach ($obj as $key=>$val){
$obj[$key]=number_format($val,0,'','');
}
print_r($obj);

Array
(
    [order_id] => 213477815351175
    [buyer] => 100001169269154
)
```
###解析非正常json
```php 
function json_decode_new($str, $m=false) {
   if(preg_match('/\w:/', $str))

   $str = preg_replace('/(\w+):/is', '"$1":', $str);
   return json_decode($str, $m);
}
json_decode_new('{result:133,total:154,Page:0,list:[{Prdh:"abcde"}]}')

[
"result" => 133,
"total" => 154,
"Page" => 0,
"list" => [
[
  "Prdh" => "abcde",
],
],]
```
