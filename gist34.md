
[FRP内网穿透工具](https://www.diannaobos.com/frp/)
[PHP百科全书](http://php.swoole.com/wiki/%E9%A6%96%E9%A1%B5)
[投资意向生成书](http://wltermsheet.applinzi.com/)
微信红包
```js
$sum = 10;  //总价钱
 
        $num = 8 ;  //人数
 
        $min = 0.01;    //最少值
 
        for($i=1;$i<$num;$i++){
 
            $row = ($sum-($num-$i)*$min)/($num-$i);// 安全值
 
            $money = mt_rand($min*100,$row*100)/100;
 
            $sum -= $money;
 
            echo '第'.$i.'人，领取'.$money.'元，剩下'.$sum.'元<br/>';
 
        }
 
        echo '第'.$num.'人，领取'.$sum.'元，剩下'.$sum.'元';
        第1人，领取1.15元，剩下8.85元
第2人，领取1.16元，剩下7.69元
第3人，领取1.45元，剩下6.24元
第4人，领取1.25元，剩下4.99元
第5人，领取0.3元，剩下4.69元
第6人，领取0.51元，剩下4.18元
第7人，领取0.89元，剩下3.29元
第8人，领取3.29元，剩下3.29元

print_r(getRand([4,7,2,8,1]));
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
过滤用户昵称里面的emoji特殊字符
```js
/** +----------------------------------------------------------
 * 过滤用户昵称里面的emoji特殊字符 +----------------------------------------------------------
 * @param string    $str   待输出的用户昵称 +----------------------------------------------------------
 */
 function jsonName($str) {
    if($str){
        $tmpStr = json_encode($str);
        $tmpStr2 = preg_replace("#(\\\ud[0-9a-f]{3})#ie","",$tmpStr);
        $return = json_decode($tmpStr2);
        if(!$return){
            return jsonName($return);
        }
    }else{
        $return = '微信用户-'.time();
    }    
    return $return;
 }
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
```
保存远程文件
```js
function getImage($url,$save_dir='',$filename='',$type=0){
            if(trim($url)==''){
                return array('file_name'=>'','save_path'=>'','error'=>1);
            }
            if(trim($save_dir)==''){
                $save_dir='./';
            }
            if(trim($filename)==''){//保存文件名
                $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'&&$ext!='.png'&&$ext!='.jpeg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
                $filename=time().rand(0,10000).$ext;
            }
            if(0!==strrpos($save_dir,'/')){
                $save_dir.='/';
            }
            //创建保存目录
            if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
                return array('file_name'=>'','save_path'=>'','error'=>5);
            }
            //获取远程文件所采用的方法
            if($type){
                $ch=curl_init();
                $timeout=5;
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
                //当请求https的数据时，会要求证书，加上下面这两个参数，规避ssl的证书检查
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                $img=curl_exec($ch);
                curl_close($ch);
            }else{
                ob_start();
                readfile($url);
                $img=ob_get_contents();
                ob_end_clean();
            }
            //$size=strlen($img);
            //文件大小
            $fp2=@fopen($save_dir.$filename,'a');
            fwrite($fp2,$img);
            fclose($fp2);
            unset($img,$url);
            return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
        }
        
$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=xxxxx';
parse_str(parse_url($url, PHP_URL_QUERY), $data);
[
    "access_token" => "xxxxx"
]

/**
 * 舍去法取整 版本的 number_format() 函数
 * @author leeyi <leeyisoft@qq.com>
 */
 function number_format_floor($number, $decimals=0, $dec_point='.', $thousands_sep=',') {
    $tmp = pow(10,$decimals);
    return number_format(floor($tmp*($number))/$tmp, $decimals, $dec_point, $thousands_sep);
 }
 function is_assoc_array($array)
{
    return array_keys($array) !== range(0, count($array) - 1);
}
```
单例
```js
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
数字格式化
```js
$str =2228282829299292;
 //失败
echo (string)$str;  //2.2282828292993E+15  失败
echo '<br>';
echo ' '.$str; //2.2282828292993E+15
echo '<br>';
echo strval($str); //2.2282828292993E+15
echo '<br>';
 //成功
echo sprintf("%.0f", $str);2228282829299292
echo '<br>';
echo number_format($str);// 三位逗号分隔
/**
     * 函数说明：验证身份证是否真实
     * 注：加权因子和校验码串为互联网统计  尾数自己测试11次 任意身份证都可以通过
     * 传递参数：
     * $number身份证号码
     * 返回参数：http://www.thinkphp.cn/code/1873.html
     * true验证通过
     * false验证失败
     */
    function isIdCard($number) {
        $sigma = '';
        //加权因子 
        $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码串 
        $ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        //按顺序循环处理前17位 
        for ($i = 0;$i < 17;$i++) { 
            //提取前17位的其中一位，并将变量类型转为实数 
            $b = (int) $number{$i}; 
            //提取相应的加权因子 
            $w = $wi[$i]; 
            //把从身份证号码中提取的一位数字和加权因子相乘，并累加 得到身份证前17位的乘机的和 
            $sigma += $b * $w;
        }
    //echo $sigma;die;
        //计算序号  用得到的乘机模11 取余数
        $snumber = $sigma % 11; 
        //按照序号从校验码串中提取相应的余数来验证最后一位。 
        $check_number = $ai[$snumber];
        if ($number{17} == $check_number) {
            return true;
        } else {
            return false;
        }
    }
    //eg
    if (!isIdCard('000000000000000001')) {
    echo "身份证号码不合法";
    } else {
    echo "身份证号码正确";
    }
```
php获取一个月的第一天和最后一天
```js
// php获取一个月的第一天和最后一天
 $date = date('Y-m-d H:i:s'); //当前时间
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
```
按概率抽奖
```js
function get_rand($arr){
 
            $arr_sum = array_sum($arr);
 
            $arr_rand = mt_rand(1,$arr_sum);
 
            foreach($arr as $key => $arr_num){
 
                $arr_sum -= $arr_num;
 
                if($arr_rand>$arr_sum){
 
                    return $key;
 
                }
 
            }
 
        }
 
        $p = array(
 
            '0' => array('id'=>1,'info'=>'一等奖','v'=>1),
 
            '1' => array('id'=>2,'info'=>'二等奖','v'=>5),
 
            '2' => array('id'=>3,'info'=>'三等奖','v'=>10),
 
            '3' => array('id'=>4,'info'=>'四等奖','v'=>34)
 
            );
 
        foreach($p as $key => $value){
 
            $arr[$value['id']] = $value['v'];
 
        }
 
        $rid = get_rand($arr);
 
        $res['yes'] = $p[$rid-1]['info'];
 
        unset ($p[$rid-1]) ;
 
        shuffle ($p);
 
        for($i=0;$i<count($p);$i++){
 
            $pr[]= $p[$i]['info'];
 
        }
 
        $res['no'] = $pr;
 echo '<pre>';
        print_r($res);
        Array
(
    [yes] => 一等奖
    [no] => Array
        (
            [0] => 三等奖
            [1] => 四等奖
            [2] => 二等奖
        )

)
```
导出doc文件
```js
function actionDlresume(){
        
        //数据查询http://www.thinkphp.cn/code/1654.html  将内容放到word文档city_name
            $re=['u_name'=>'php','g_sex'=>'na','school_type'=>1,'work_year'=>10,'g_school'=>'66','city_name'=>'ggg','work_email'=>'hhh','work_phone'=>'888','work_type'=>'555','edutation'=>'888','g_workj'=>'333','g_zuo'=>'000'];
            // print_r($re);die;
            $html ='<table width=800  align="center"  border="1" cellpadding="0" cellspacing="1" >
    <tr height="50"> 
      <td width=70 > 姓名</td> 
      <td width=300 >  '.$re['u_name'].'</td> 
      <td width=60 >性别</td> 
      <td width=100 >'.$re['g_sex'].'</td> 
      <td width=100 >学历</td> 
      <td width=240 >'.$re['school_type'].'</td> 
    </tr> 
    <tr> 
      <td width=70 >工作时间</td> 
      <td width=40 >'.$re['work_year'].'</td> 
      <td width=40 >毕业<br/>学校</td> 
      <td width=150 >'.$re['g_school'].'</td> 
      <td width=40 >所在<br/>城市</td> 
      <td width=390 >'.$re['city_name'].'</td> 
    </tr> 
    <tr> 
      <td width=110 >联系邮箱</td> 
      <td width=200 >'.$re['work_email'].'</td> 
      <td width=110 >联系<br/>电话</td> 
      <td width=280 >'.$re['work_phone'].'</td>
      <td width=110 >当前<br/>状态</td> 
      <td width=280 >'.$re['work_type'].'</td>
    </tr> 
    <tr> 
      <td width=120 ><br/><br/>教育<br/>背景<br/><br/></td> 
      <td width=580 >'.$re['edutation'].'</td>     
    </tr> 
    <tr> 
      <td width=120 ><br/><br/>工作<br/>经历<br/><br/></td> 
      <td width=580 >'.$re['g_workj'].'</td>     
    </tr> 
    <tr> 
      <td width=120 ><br/><br/><br/>作品<br/>展示<br/><br/><br/><br/></td> 
      <td width=580 >'.$re['g_zuo'].'</td> 
    </tr> 
    </table> <br/><br/><br/><br/>
';
 
 // print_r($html);die;
     // $word->start();
     
     ob_start();
        echo "<html xmlns:o='urn:schemas-microsoft-com:office:office'
        xmlns:w='urn:schemas-microsoft-com:office:word'
        xmlns='http://www.w3.org/TR/REC-html40'>";
     
     echo $html;
     echo "</html>";
      // $word->save($filename);
      $data = ob_get_contents();
      // print_r($data);die;
      // die;
        ob_end_clean();
        $filename = $re['u_name'].'.doc';
        $fp=fopen($filename,"wb");
        fwrite($fp,$data);
        fclose($fp);
      //文件的类型
      header('Content-type: application/word');
      header("Content-Disposition: attachment; filename=".$filename);
      readfile($filename);
      ob_flush();
      flush();
     exit();
    
    }
```
中文占2字节
```js
function getByteLen(val){    //传入一个字符串
            var len = 0;
            for (var i = 0; i < val.length; i++) {
                if (/^([\u4E00-\u9FA5]+，?)+$/.test(val[i])) //全角
                    len += 2; //如果是全角，占用两个字节
                else
                    len += 1; //半角占用一个字节
            }
            return len;
         }
```

[laravel 在线数据库字典导出](http://github.com/jormin/laravel-ddoc)

```js
namespace Jormin\DDoc\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class DDocController extends Controller
{

    /**
     * 读取数据库信息
     */
    private function initTablesData()
    {
        //获取数据库表名称列表
        $tables = DB::select('SHOW TABLE STATUS ');
        foreach ($tables as $key => $table) {
            //获取改表的所有字段信息
            $columns = DB::select("SHOW FULL FIELDS FROM ".$table->Name);
            $table->columns = $columns;
            $tables[$key] = $table;
        }
        return $tables;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->initTablesData();
        return view('ddoc::index',compact('tables'));
    }

    /**
     * 导出文档
     *
     * @param $type
     */
    public function export($type)
    {
        if(!in_array($type,array('html','pdf'))){
            return null;
        }
        $tables = $this->initTablesData();
        $filename = config('app.name').'数据字典';
        switch($type){
            case 'html':
                $zippath = __DIR__.'/'.$filename.'.zip';
                $zip = new \ZipArchive;
                $res = $zip->open($zippath, \ZipArchive::CREATE);
                if ($res === TRUE) {
                    // 添加静态资源文件
                    $this->addFileToZip('vendor/laravel-ddoc',$zip);
                    // 生成Html文件
                    require_once (__DIR__.'/../Lib/simple_html_dom.php');
                    $obj = View::make('ddoc::index', compact('tables'),array())->render();
                    $protocol = 'http://';
                    if(Request::secure()){
                        $protocol = 'https://';
                    }
                    $obj = str_replace($protocol.$_SERVER['HTTP_HOST'].'/vendor/laravel-ddoc','.',$obj);
                    $html = new \simple_html_dom();
                    $html->load($obj);
                    $html->find('div[class=export-wrap]',0)->outertext = '';
                    $zip->addFromString($filename.'.html', $html);
                    $zip->close();
                } else {
                    return null;
                }

                $response =  new Response(file_get_contents($zippath), 200, array(
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' =>  'attachment; filename="'.$filename.'.zip"'
                ));
                unlink($zippath);
                return $response;
                break;
            case 'pdf':
                $filename .= '.pdf';
                $pdf = SnappyPdf::loadView('ddoc::index', compact('tables'));
                return $pdf->download($filename);
                break;
        }
    }

    /**
     * 添加文件夹
     *
     * @param $path
     * @param $zip
     */
    private function addFileToZip($path, $zip) {
        $handler = opendir(public_path($path));
        while (($filename = readdir($handler)) !== false) {
            if (!in_array($filename,array('.','..','.DS_Store'))) {
                if (is_dir($path . "/" . $filename)) {
                    $this->addFileToZip($path . "/" . $filename, $zip);
                } else { //将文件加入zip对象
                    $fullname = public_path($path) . "/" . $filename;
                    $localname = str_replace('vendor/laravel-ddoc/','','/'.$path.'/'.$filename);
                    $zip->addFile($fullname,$localname);
                }
            }
        }
        @closedir($path);
    }
}
```

