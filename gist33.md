[laravel的依赖注入http://blog.csdn.net/gaoxuaiguoyi/article/details/50042829]()
```js
public function register()  
 {          
     //$this->app->bind(App\Services\IUserService::class, App\Services\IUserServiceImpl::class);  
 //单例模式创建对象  
     $this->app->singleton('\App\Services\IUserService', function()  
             {  
                 return new \App\Services\IUserServiceImpl();  
             });  
 } 
 /** 
 * 控制器 
 */  
class UserController extends Controller{  
 private  $UserService;  
//注入接口的实例对象IUserServiceImpl,其实laravel框架帮助我们实现了 IUserService  $service = new IUserServiceImpl();这一步。  
 public function __construct(IUserService $service){  
   
  $this->UserService = $service;  
  
 }  
```
[适配器模式的优点既没有修改原来的类，又扩展了原来的类](http://blog.csdn.net/gaoxuaiguoyi/article/details/62991893)
```js
class OldClient  
{  
  
    public function oldRequest()  
    {  
  
        echo '老方法不满足现在的需求<br/>';  
    }  
  
}  
  
/** 
 * 新的需求接口 
 * Interface Target 
 */  
interface Target  
{  
  
    public function newRequest();  
  
}  
  
  
class Adapter extends OldClient implements Target  
{  
    public function newRequest()  
    {  
  
        echo '新方法满足现在的需求';  
    }  
  
}  
//测试  
$Adapter1 = new Adapter();  
$Adapter1->oldRequest();  
$adapter = new Adapter();  
$adapter->newRequest(); 
```
[ PHP工厂模式和单例模式](http://blog.csdn.net/gaoxuaiguoyi/article/details/50859596)
```js
namespace Factory;  
  工厂模式的好处就是我们创建对象的方法是统一的，不是在我们需要的地方直接使用new进行创建，降低了模块之间的耦合度，并且当我们修改了类的名称我们只需要在工厂类里面修改一处即可完成。
单例模式好处是我们使用对象的时候不是每次使用都去new一个新对象出来，这样造成很大的开支和浪费，单例模式保证我们程序运行过程中对象产生一次，节省了开支。
  
class ObjectFactory {  
  
    /** 
     * 工厂模式 
     */  
  
    public static function createObject(){  
  
  
        $obj = Object::getInstance();  
  
          
      return $obj;  
    }  
  
}  

spl_autoload_register('autoload');  
  
function autoload($className){  
  
  
    $classFile = ROOT.'/'.str_replace('\\','/',$className).'.php';  
  
    include $classFile;  
  
} define('ROOT',__DIR__);  
  
  require 'autoload.php';  
  
  $obj =  Factory\ObjectFactory::createObject();  
  
  $obj->say();
  //这个控制器直接在根目录下面，如果定义的控制器又加了一层文件夹的话可以使用namespace进行控制 Route::group(['namespace'=>'xxxxx','middleware'=>['checkuser','dealuser']]);

Route::group(['middleware'=>['checkuser','dealuser']],function(){

    Route::post('user/addUser','UserController@postAdduser');
});
```
[PHP实现双端队列](http://blog.csdn.net/gaoxuaiguoyi/article/details/45723757)
```js
class Deque    
{   
    public $queue = array();   
      
    /**（尾部）入队  **/   
    public function addLast($value)    
    {   
        return array_push($this->queue,$value);   
    }   
    /**（尾部）出队**/   
    public function removeLast()    
    {   
        return array_pop($this->queue);   
    }   
    /**（头部）入队**/   
    public function addFirst($value)    
    {   
        return array_unshift($this->queue,$value);   
    }   
    /**（头部）出队**/   
    public function removeFirst()    
    {   
        return array_shift($this->queue);   
    }   
    /**清空队列**/   
    public function makeEmpty()    
    {   
        unset($this->queue);  
    }   
      
    /**获取列头**/  
    public function getFirst()    
    {   
        return reset($this->queue);   
    }   
   
    /** 获取列尾 **/  
    public function getLast()    
    {   
        return end($this->queue);   
    }  
   
    /** 获取长度 **/  
    public function getLength()    
    {   
        return count($this->queue);   
    }  
      
}  
```
[ PHP csv大量数据导出分割处理](http://blog.csdn.net/gaoxuaiguoyi/article/details/47108129)
```js
后台管理系统总是成百万的数据导出，使用excel导出根本不能实现，excel只支持65536，2007和2010的是1048576，所以无论哪一种都不能满足需求，csv就符合需求，
 error_reporting(0);  
        header ( "Content-type:application/vnd.ms-excel" );  
                header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", "topic" ) . ".csv" );      
        //连接数据库   
        $link = mysql_connect('localhost','root','root') or die('连接错误');  
            //选择数据库  
            mysql_select_db("bbs",$link);  
            //设置字符集  
            mysql_query("set names utf8");  
            //查询函数  
            function get_res($sql,$link){  
                  
                $res  = mysql_query($sql,$link);  
                  
                if(!$res){  
                      
                    die("操作失败".mysql_error());  
                }  
                $arr=array();  
                while ($row = mysql_fetch_assoc($res)) {                
                        $arr[]=$row;  
                    }  
                return $arr;  
            }  
            //查询记录总数  
            function getTotalCount(){  
                  
                $result = mysql_query("SELECT count(*) as count FROM medsci_edu_public_medsciedu_topic", $link);  
                  
                return $result['count'];  
            }  
               // 打开PHP文件句柄，php://output 表示直接输出到浏览器  
                $fp = fopen('php://output', 'a');   
                //表头  
        $column_name = array('topic_id','cat_id','user_id','is_best','is_top','topic_title',  
                 'topic_content','topic_img','hits','total_reply_count','created_time','last_updated_time','topic_status','last_reply_name');  
                // 将中文标题转换编码，否则乱码  
              foreach ($column_name as $i => $v) {    
                   $column_name[$i] = iconv('utf-8', 'gbk', $v);    
              }  
        // 将标题名称通过fputcsv写到文件句柄    
              fputcsv($fp, $column_name);  
              $pagecount = 10000;//一次读取多少条  
        $totalcount = getTotalCount();//总记录数  
        $sql = "select * from medsci_edu_public_medsciedu_topic";  
           for ($i=0;$i<intval($totalcount/$pagecount)+1;$i++){  
            $data = get_res($sql." limit ".strval($i*$pagecount).",{$pagecount}",$link);  
            foreach ( $data as $item ) {  
                $rows = array();  
                foreach ( $item as $v){  
                    $rows[] = iconv('utf-8', 'GBK', $v);  
                }  
                fputcsv($fp, $rows);  
            }  
            // 将已经写到csv中的数据存储变量销毁，释放内存占用  
            unset($data);  
            //刷新缓冲区  
            ob_flush();  
            flush();  
        }  
    exit;  
```

[CURL下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47104945)
```js
$url = 'http://pic1.nipic.com/2008-09-08/200898163242920_2.jpg';    
    
    function http_get_data($url) {    
            
        $ch = curl_init ();    
        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );    
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );    
        curl_setopt ( $ch, CURLOPT_URL, $url );   
        //打开输出控制缓冲  
        ob_start ();    
        curl_exec ( $ch );    
        //返回输出缓冲区的内容  
        $return_content = ob_get_contents ();   
        //清空（擦除）缓冲区并关闭输出缓冲  
        ob_end_clean ();    
            
        $return_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );    
        return $return_content;    
    }    
        
    $return_content = http_get_data($url);    
    $filename = 'my.jpg';    
    $fp= @fopen($filename,"a"); //将文件绑定到流  
    fwrite($fp,$return_content); //写入文件
```

[PHP手机获取6为不重复验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/46621971)
```js
//存数字数组  
                $code = array();  
           
         while(count($code) < 6){  
             //产生随机数1-9  
             $code[] = rand(1,9);  
                         //去除数组中的重复元素  
                         $code = array_unique($code);  
         }  
         echo "<pre>";  
         print_r($code);  
```

[ laravel事件创建以及使用](http://blog.csdn.net/gaoxuaiguoyi/article/details/50043021)
```js
5.0版本的还可以使用2条命令进行生成事件，还可以分开执行创建事件。
php artisan make:event PupUserchange（事件的类名）
php artisan handler:event UserManagerd(事件处理类) --event=PupUserchange

protected $listen = [  
       'App\Events\SomeEvent' => [  
           'App\Listeners\EventListener',  
       ],  
       'App\Events\PupUserchange'=>[  
       'App\Handlers\Events\UserManagerd'  
       ],  
   ];  
   php artisan event:generate
   Event::fire(new PupUserchange(Users::find(2)));
```
[PHP二维数组根据某个元素去重](http://blog.csdn.net/gaoxuaiguoyi/article/details/53127386)
```js
function array_unset_tt($arr,$key){     
        //建立一个目标数组  
        $res = array();        
        foreach ($arr as $value) {           
           //查看有没有重复项  
           $tmp = array();  
           if(isset($res[$value[$key]])){  
                 //有：销毁  
                  
                 unset($value[$key]);  
                   
           }  
           else{  
                  
                $res[$value[$key]] = $value;  
           }    
        }  
        return $res;  
    }  
    $arr = array(  
              
            array(  
            'title'=>'1111','date'=>'ddddd'  
                  
            ),  
            array('title'=>'22222','date'=>'fffffff'),  
            array('title'=>'1111','date'=>'ggggggg')  
);  
$newArr = array_unset_tt($arr,'title');  
echo '<pre>';  
  
print_r(array_values($newArr));  
//本月第一天  
$beginDate = date('Y-m-01', strtotime(date("Y-m-d")));  
//本月最后一天  
$endDate = date('Y-m-d', strtotime("$beginDate +1 month -1 day"));  
$begintime = strtotime($beginDate);  
$endtime = strtotime($endDate);  
//输出每一天  
for ($start = $begintime; $start <= $endtime; $start += 24 * 3600)  
{  
        echo date('Y-m-d',$start).'<br>';  
}  
```
[PHP self与static区别](http://blog.csdn.net/gaoxuaiguoyi/article/details/49758757)
```js
class Boo {  
        
      protected static $str = "This is class Boo";  
      /* 
      public static function get_info(){ 
           
          echo get_called_class()."<br>"; 
          echo self::$str; 
      }  
      */  
      public static function get_info(){  
            
          echo get_called_class()."<br>";  
          echo static::$str;  
      }   
        
  }  
  class Foo extends Boo{  
        
      protected static $str = "This is class Foo";  
        
  }  
    
    
   Foo::get_info(); 
   大概意思是说self调用的就是本身代码片段这个类，而static调用的是从堆内存中提取出来，访问的是当前实例化的那个类，那么 static 代表的就是那个类，例子比较容易明白些。

其实static就是调用的当前调用的类，比较抽象吧。
```
[PHP 按一定比例压缩图片，保持清晰度](http://blog.csdn.net/gaoxuaiguoyi/article/details/49592151)
```js
 class Image{  
         
       private $src;  
       private $imageinfo;  
       private $image;  
       public  $percent = 0.1;  
       public function __construct($src){  
             
           $this->src = $src;  
             
       }  
       /** 
       打开图片 
       */  
       public function openImage(){  
             
           list($width, $height, $type, $attr) = getimagesize($this->src);  
           $this->imageinfo = array(  
                  
                'width'=>$width,  
                'height'=>$height,  
                'type'=>image_type_to_extension($type,false),  
                'attr'=>$attr  
           );  
           $fun = "imagecreatefrom".$this->imageinfo['type'];  
           $this->image = $fun($this->src);  
       }  
       /** 
       操作图片 
       */  
       public function thumpImage(){  
             
            $new_width = $this->imageinfo['width'] * $this->percent;  
            $new_height = $this->imageinfo['height'] * $this->percent;  
            $image_thump = imagecreatetruecolor($new_width,$new_height);  
            //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度  
            imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);  
            imagedestroy($this->image);    
            $this->image =   $image_thump;  
       }  
       /** 
       输出图片 
       */  
       public function showImage(){  
             
            header('Content-Type: image/'.$this->imageinfo['type']);  
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image);  
             
       }  
       /** 
       保存图片到硬盘 
       */  
       public function saveImage($name){  
             
            $funcs = "image".$this->imageinfo['type'];  
            $funcs($this->image,$name.'.'.$this->imageinfo['type']);  
             
       }  
       /** 
       销毁图片 
       */  
       public function __destruct(){  
             
           imagedestroy($this->image);  
       }  
         
   }  
   
   $src = "001.jpg";  
        $image = new Image($src);  
        $image->percent = 0.2;  
        $image->openImage();  
        $image->thumpImage();  
        $image->showImage();  
        $image->saveImage(md5("aa123"));
```
[PHP使用Screw把源代码加密](http://blog.csdn.net/gaoxuaiguoyi/article/details/53466860)
https://sourceforge.net/projects/php-screw/files/php-screw/
find ./ -name "*.php" -print|xargs -n1 screw //加密所有的.php文件
find ./ -name "*.screw" -print|xargs -n1 rm //删除所有的.php源文件的备份文件
[PHP实现验证码](http://blog.csdn.net/gaoxuaiguoyi/article/details/48805451)
get参数进行urlencode转换一下，数据可以正确显示了 使用urlencode进行转换之后  &变成十六进制的%26  空格会变成+  如果使用rawurlencode 空格变成%20：
[PHP多线程读写文件操作](http://blog.csdn.net/gaoxuaiguoyi/article/details/48731035)
[PHP二维数组根据某个数组元素排序](http://blog.csdn.net/gaoxuaiguoyi/article/details/48261653)
```js
$grade = array("score" => array(70, 95, 70.0, 60, "70"),
"name" => array("Zhang San", "Li Si", "Wang Wu",
"Zhao Liu", "Liu Qi"));
array_multisort($grade["score"], SORT_NUMERIC, SORT_DESC,
// 将分数作为数值，由高到低排序
$grade["name"], SORT_STRING, SORT_ASC);
// 将名字作为字符串，由小到大排序
var_dump($grade);
```
[PHP读取大文件小技巧](http://blog.csdn.net/gaoxuaiguoyi/article/details/47951115)
```js
ini_set('memory_limit','-1');  
$file = 'access.log';  
$data = file($file);  
$line = $data[count($data)-1];
$fp = fopen($file, "r");  
$line = 10;  
$pos = -2;  
$t = " ";  
$data = "";  
while ($line > 0) {  
    while ($t != "\n") {  
        fseek($fp, $pos, SEEK_END);  
        $t = fgetc($fp);  
        $pos --;  
    }  
    $t = " ";  
    $data .= fgets($fp);  
    $line --;  
}  
fclose ($fp);  
echo $data  

如果 t2.column1 的值是 NULL 的话，WHERE 子句的结果就是假了：

   SELECT * FROM t1 LEFT JOIN t2 ON (column1) WHERE t2.column2=5;

   因此，这就可以安全的转换成一个普通的连接查询：

  SELECT * FROM t1,t2 WHERE t2.column2=5 AND t1.column1=t2.column1;

  这查询起来就更快了，因为如果能有一个更好的查询计划的话，MySQL就会在 t1 之前就用到 t2 了。
```
[PHP安全下载文件](http://blog.csdn.net/gaoxuaiguoyi/article/details/47952443)
```js
$file_name = "pigcms.rar";     //下载文件名      
    $file_dir = "./file/";        //下载文件存放目录      
    //检查文件是否存在      
    if (! file_exists ( $file_dir . $file_name )) {      
        echo "文件找不到";      
        exit ();      
    } else {      
        //打开文件      
        $fp= fopen ( $file_dir . $file_name, "r" );      
        //输入文件标签       
        Header ( "Content-type: application/octet-stream" );      
        Header ( "Accept-Ranges: bytes" );      
        Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );      
        Header ( "Content-Disposition: attachment; filename=" . $file_name );      
        //输出文件内容       
        //读取文件内容并直接输出到浏览器      
        while(!feof($fp)) {  
                         set_time_limit(0);  
                         echo fread($fp,1024);  
                         flush();  
                         ob_flush();  
                    }   
     
        fclose ( $fp);      
        exit ();      
    }    
```
分批处理数据
```js
$count = 140000;
        $take = 2000;
        $s    = floor($count/$take);
	    for ($i =0 ;$i <= $s; $i++ ){
            $skip   = $take*$i;
            echo 'start ---'.$skip.'---'.$take."---\n";
            $ret = WebinarSwitch::groupBy('webinar_id')->skip($skip)->take($take)->get();
            if(!empty($ret)){
                $list = $ret->toArray();
                foreach ($list as $row){
                    $webinar = Webinars::withTrashed()->find($row['webinar_id']);
                    if(!empty($webinar)){
                        $sql = "update webinar_switch set user_id ='{$webinar['user_id']}' where webinar_id={$row['webinar_id']}; \n";
                        file_put_contents($file,$sql,FILE_APPEND);
                    }
                }
            }
        }
	
30分钟支付
$second = strtotime($order['created_at']) + 60*30 - time();
        if ($second>0) {
            $order['expire'] = date('i:s', $second);
        } else {
            $order['expire'] = '00:00';
        }
	
```
时间相差几天
```js
$a=new \Carbon\carbon()
 <Carbon\Carbon #00000000142cb4980000000048d664ed> {
       date: "2017-04-16 16:07:58.000000",
       timezone_type: 3,
       timezone: "PRC"
   }
 $d=$a->diff(new \carbon\carbon('2017-01-03 11:11:11'),true)
 <DateInterval #00000000142cb4a50000000048d665bd> {
       y: 0,
       m: 3,
       d: 13,
       h: 4,
       i: 56,
       s: 47,
       weekday: 0,
       weekday_behavior: 0,
       first_last_day_of: 0,
       invert: 0,
       days: 103,
       special_type: 0,
       special_amount: 0,
       have_weekday_relative: 0,
       have_special_relative: 0
   }
//输出js数组
  function consoleLog($data, $log = false)
    {
        // 数据预处理json
        if (is_string($data) && $preJsonMsg = json_decode($data, true)) {
            if (count($preJsonMsg) > 1) {
                $data = $preJsonMsg;
            }
        }

        $logFunc = $log ? 'console.log' : 'console.dir';

        if (is_array($data) || is_object($data)) {
            echo("<script>".$logFunc."(".json_encode($data).");</script>");
        } else {
            echo("<script>".$logFunc."('".$data."');</script>");
        }
    }
```
