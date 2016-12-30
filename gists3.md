###[ 根据字符串生成对应数组方法](http://blog.csdn.net/fdipzone/article/details/38589841)
```php
$config = array(  
    'project|page|index' => 'content',  
    'project|page|nav' => array(  
            array(  
                'image' => '1.jpg',  
                'name' => 'home'  
            ),  
            array(  
                'image' => '2.jpg',  
                'name' => 'about'  
            )  
    ),  
    'project|page|open' => true  
);  
  
$result = array();  
foreach($config as $key=>$val){  
      
    $tmp = '';  
    $keys = explode('|', $key);  
      
    for($i=0,$len=count($keys); $i<$len; $i++){  
        $tmp .= "['".$keys[$i]."']";  
    }  
      
    if(is_array($val)){  
        eval('$result'.$tmp.'='.var_export($val,true).';');  
    }elseif(is_string($val)){  
        eval('$result'.$tmp.'='.$val.';');  
    }else{  
        eval('$result'.$tmp.'=$val;');  
    }  
  
}  
  
print_r($result); 
$result = array(  
    'project' => array(  
        'page' => array(  
            'index' => 'content',  
            'nav' => array(  
                    array(  
                        'image' => '1.jpg',  
                        'name' => 'home'  
                    ),  
                    array(  
                        'image' => '2.jpg',  
                        'name' => 'about'  
                    )  
            ),  
            'open' => true  
        )      
    )  
);  
```
[求余出现负数处理方法](http://blog.csdn.net/fdipzone/article/details/9247727)
```php
php int 的范围是 -2147483648 ~ 2147483647，可用常量 PHP_INT_MAX 查看
echo 3701256461%62; // -13  
$res = floatval(3701256461);  
echo fmod($res,62); // 53
```
[文件转base64](http://blog.csdn.net/fdipzone/article/details/9183487)
```php
/** 文件转base64输出 
* @param  String $file 文件路径 
* @return String base64 string 
*/  
function fileToBase64($file){  
    $base64_file = '';  
    if(file_exists($file)){  
        $mime_type= mime_content_type($file);  
        $base64_data = base64_encode(file_get_contents($file));  
        $base64_file = 'data:'.$mime_type.';base64,'.$base64_data;  
    }  
    return $base64_file;  
}  
  
/** base64转文件输出 
* @param  String $base64_data base64数据 
* @param  String $file        要保存的文件路径 
* @return boolean 
*/  
function base64ToFile($base64_data, $file){  
    if(!$base64_data || !$file){  
        return false;  
    }  
    return file_put_contents($file, base64_decode($base64_data), true);  
}  
//file to base64  
<img src="<?=fileToBase64('1.jpg') ?>" />  
  
//base64 to file  
$file = "test.jpg";  
$data = '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGrWFKrNK9z//2Q==';  
  
if(base64ToFile($data, $file)){  
    echo '<img src="'.$file.'" />';  
}  
``` 
[获取一个变量的名字](http://blog.csdn.net/fdipzone/article/details/14643331)
```php 
$a = '100';  
  
echo '$a name is:'.get_variable_name($a).' value:'.$a; // $a name is: a value: 100  
  
/** 
* @param String $var   要查找的变量 
* @param Array  $scope 要搜寻的范围 
* @param String        变量名称 
*/  
function get_variable_name(&$var, $scope=null){  
  
    $scope = $scope==null? $GLOBALS : $scope; // 如果没有范围则在globals中找寻  
  
    // 因有可能有相同值的变量,因此先将当前变量的值保存到一个临时变量中,然后再对原变量赋唯一值,以便查找出变量的名称,找到名字后,将临时变量的值重新赋值到原变量  
    $tmp = $var;  
      
    $var = 'tmp_value_'.mt_rand();  
    $name = array_search($var, $scope, true); // 根据值查找变量名称  
  
    $var = $tmp;  
    return $name;  
}  
function test(){  
    $a = '100';  
    echo '$a name is:'.get_variable_name($a);  
}  
  
test(); // $a name is: undefined  
//因为在function中定义的变量globals会找不到  
  
function test2(){  
    $a = '100';  
    echo '$a name is:'.get_variable_name($a, get_defined_vars());  
}  
  
test2(); // $a name is: a   
// 将scope设定为 get_defined_vars() 可以找到

/** 延时输出内容 
* @param int $sec 秒数，可以是小数例如 0.3 
*/  
function cache_flush($sec=2){  
    ob_flush();  
    flush();  
    usleep($sec*1000000);  
}  
/** 文件加密,使用key与原文异或(XOR)生成密文,解密则再执行一次异或即可 
* @param String $source 要加密或解密的文件 
* @param String $dest   加密或解密后的文件 
* @param String $key    密钥 
*/  
function file_encrypt($source, $dest, $key){  
    if(file_exists($source)){  
          
        $content = '';          // 处理后的字符串  
        $keylen = strlen($key); // 密钥长度  
        $index = 0;  
  
        $fp = fopen($source, 'rb');  
  
        while(!feof($fp)){  
            $tmp = fread($fp, 1);  
            $content .= $tmp ^ substr($key,$index%$keylen,1);  
            $index++;  
        }  
  
        fclose($fp);  
  
        return file_put_contents($dest, $content, true);  
  
    }else{  
        return false;  
    }  
}  
/** 删除所有空目录 
* @param String $path 目录路径 
*/  
function rm_empty_dir($path){  
    if($handle = opendir($path)){  
        while(($file=readdir($handle))!==false){     // 遍历文件夹  
            if($file!='.' && $file!='..'){  
                $curfile = $path.'/'.$file;          // 当前目录  
                if(is_dir($curfile)){                // 目录  
                    rm_empty_dir($curfile);          // 如果是目录则继续遍历  
                    if(count(scandir($curfile))==2){ // 目录为空,=2是因为. 和 ..存在  
                        rmdir($curfile);             // 删除空目录  
                    }  
                }  
            }  
        }  
        closedir($handle);  
    }  
}  
/* unicode 转 中文 
* @param  String $str unicode 字符串 
* @return String 
*/  
function unescape($str) {  
    $str = rawurldecode($str);  
    preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);  
    $ar = $r[0];  
  
    foreach($ar as $k=>$v) {  
        if(substr($v,0,2) == "%u"){  
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));  
        }elseif(substr($v,0,3) == "&#x"){  
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));  
        }elseif(substr($v,0,2) == "&#") {  
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));  
        }  
    }  
    return join("",$ar);  
}  
```
###[img标签加载php文件，记录页面访问讯息](http://blog.csdn.net/fdipzone/article/details/9842887)
```php
<img src="sitestat.php?url=www.domain.com&userid=1" />  

// 获取参数  
$param = array();  
$param['url'] = isset($_GET['url'])? $_GET['url'] : '';  
$param['userid'] = isset($_GET['userid'])? $_GET['userid'] : 0;  
  
// 写入log文件  
file_put_contents('sitestat.log', json_encode($param)."\r\n", FILE_APPEND);  
  
header('content-type:image/png');  
  
$im = imagecreate(1, 1);                    // 创建1x1px的空白图像  
imagecolorallocatealpha($im, 0, 0, 0, 127); // 透明图像  
imagepng($im);                              // 输出图片  
imagedestroy($im);  
```
