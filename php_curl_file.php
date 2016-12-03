###form表单上传

最开始接触html上传文件是一个表单，然后一个input `<input name="file" type="file" id="file"/>` ,点击直接上传，服务器端通过`$_FILES` 接收处理，一个简单的demo：
```php
//upload.php 
$uploaddir = './pic/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "上传成功";
} else {
    echo "上传失败";
}
?>

<form action="upload.php" method="post" name="frmUpload" enctype="multipart/form-data">
<tr>
  <td>Upload</td>
  <td align="center">:</td>
  <td><input name="file" type="file" id="file"/></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td><input name="btnUpload" type="submit" value="上传" /></td>
</tr>
```
###base64上传
可以将图片文件转为base64编码，然后提交字符串的形式上传，服务器端只需要简单处理即可
```php
file_put_contents($file, $_POST['base64']);

```
###[curl上传](https://github.com/php-curl-class/php-curl-class)
[php文档](http://www.php.net/manual/zh/function.curl-setopt.php) 传递一个数组到CURLOPT_POSTFIELDS，cURL会把数据编码成 multipart/form-data，而然传递一个URL-encoded字符串时，数据会被编码成 application/x-www-form-urlencoded 
```php

$ch = curl_init();
$data = ['name' => 'foo', 'file' => '@/home/test.png'];
curl_setopt($ch, CURLOPT_URL, 'http://localhost/curl/upload_file.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);// php5.6改成 true
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_exec($ch);
//命令行测试下 curl -F "@/home/test.png" http://localhost/curl/upload_file.php

```
[PHP从5.5开始引入了新的CURLFile类用来指向文件](https://segmentfault.com/a/1190000000725185) 
CURLFile类也可以详细定义MIME类型、文件名等可能出现在multipart/form-data数据中的附加信息。PHP推荐使用CURLFile替代旧的@语法
```php
if (class_exists('\CURLFile')) {
    $field = array('fieldname' => new \CURLFile(realpath($filepath)));
} else {
    $field = array('fieldname' => '@' . realpath($filepath));
}
```
###拼接字符模拟文件上传
```php
/** HttpRequest class, HTTP请求类，支持GET,POST,Multipart/form-data 
*  代码来自osc
*  Func: 
*  public setConfig   设置连接参数 
*  public setFormdata  设置表单数据 
*  public setFiledata  设置文件数据 
*  public send     发送数据 
*  private connect    创建连接 
*  private disconnect  断开连接 
*  private sendGet    get 方式,处理发送的数据,不会处理文件数据 
*  private sendPost   post 方式,处理发送的数据 
*  private sendMultipart multipart 方式,处理发送的数据,发送文件推荐使用此方式 
*/
class HttpRequest{ // class start 
  
  private $_ip = ''; 
  private $_host = ''; 
  private $_url = ''; 
  private $_port = ''; 
  private $_errno = ''; 
  private $_errstr = ''; 
  private $_timeout = 15; 
  private $_fp = null; 
    
  private $_formdata = array(); 
  private $_filedata = array(); 
  
  
  // 设置连接参数 
  public function setConfig($config){ 
    $this->_ip = isset($config['ip'])? $config['ip'] : ''; 
    $this->_host = isset($config['host'])? $config['host'] : ''; 
    $this->_url = isset($config['url'])? $config['url'] : ''; 
    $this->_port = isset($config['port'])? $config['port'] : ''; 
    $this->_errno = isset($config['errno'])? $config['errno'] : ''; 
    $this->_errstr = isset($config['errstr'])? $config['errstr'] : ''; 
    $this->_timeout = isset($confg['timeout'])? $confg['timeout'] : 15; 
  
    // 如没有设置ip，则用host代替 
    if($this->_ip==''){ 
      $this->_ip = $this->_host; 
    } 
  } 
  
  // 设置表单数据 
  public function setFormData($formdata=array()){ 
    $this->_formdata = $formdata; 
  } 
  
  // 设置文件数据 
  public function setFileData($filedata=array()){ 
    $this->_filedata = $filedata; 
  } 
  
  // 发送数据 
  public function send($type='get'){ 
  
    $type = strtolower($type); 
  
    // 检查发送类型 
    if(!in_array($type, array('get','post','multipart'))){ 
      return false; 
    } 
  
    // 检查连接 
    if($this->connect()){ 
  
      switch($type){ 
        case 'get': 
          $out = $this->sendGet(); 
          break; 
  
        case 'post': 
          $out = $this->sendPost(); 
          break; 
  
        case 'multipart': 
          $out = $this->sendMultipart(); 
          break; 
      } 
  
      // 空数据 
      if(!$out){ 
        return false; 
      } 
  // echo $out;
      // 发送数据 
      fputs($this->_fp, $out); 
  
      // 读取返回数据 
      $response = ''; 
  
      while($row = fread($this->_fp, 4096)){ 
        $response .= $row; 
      } 
  
      // 断开连接 
      $this->disconnect(); 
  
      $pos = strpos($response, "\r\n\r\n"); 
      $response = substr($response, $pos+4); 
  
      return $response; 
  
    }else{ 
      return false; 
    } 
  } 
  
  // 创建连接 
  private function connect(){ 
    $this->_fp = fsockopen($this->_ip, $this->_port, $this->_errno, $this->_errstr, $this->_timeout); 
    if(!$this->_fp){ 
      return false; 
    } 
    return true; 
  } 
  
  // 断开连接 
  private function disconnect(){ 
    if($this->_fp!=null){ 
      fclose($this->_fp); 
      $this->_fp = null; 
    } 
  } 
  
  // get 方式,处理发送的数据,不会处理文件数据 
  private function sendGet(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata){ 
      return false; 
    } 
  
    // 处理url 
    $url = $this->_url.'?'.http_build_query($this->_formdata); 
      
    $out = "GET ".$url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
  
    return $out; 
  } 
  
  // post 方式,处理发送的数据 
  private function sendPost(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata && !$this->_filedata){ 
      return false; 
    } 
  
    // form data 
    $data = $this->_formdata? $this->_formdata : array(); 
  
    // file data 
    if($this->_filedata){ 
      foreach($this->_filedata as $filedata){ 
        if(file_exists($filedata['path'])){ 
          $data[$filedata['name']] = file_get_contents($filedata['path']); 
        } 
      } 
    } 
  
    if(!$data){ 
      return false; 
    } 
  
    $data = http_build_query($data); 
  
    $out = "POST ".$this->_url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "content-type: application/x-www-form-urlencoded\r\n"; 
    $out .= "content-length: ".strlen($data)."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
    $out .= $data; 
  
    return $out; 
  } 
  
  // multipart 方式,处理发送的数据,发送文件推荐使用此方式 
  private function sendMultipart(){ 
  
    // 检查是否空数据 
    if(!$this->_formdata && !$this->_filedata){ 
      return false; 
    } 
  
    // 设置分割标识 
    srand((double)microtime()*1000000); 
    $boundary = '---------------------------'.substr(md5(rand(0,32000)),0,10); 
  
    $data = '--'.$boundary."\r\n"; 
  
    // form data 
    $formdata = ''; 
  
    foreach($this->_formdata as $key=>$val){ 
      $formdata .= "content-disposition: form-data; name=\"".$key."\"\r\n"; 
      $formdata .= "content-type: text/plain\r\n\r\n"; 
      if(is_array($val)){ 
        $formdata .= json_encode($val)."\r\n"; // 数组使用json encode后方便处理 
      }else{ 
        $formdata .= rawurlencode($val)."\r\n"; 
      } 
      $formdata .= '--'.$boundary."\r\n"; 
    } 
  
    // file data 
    $filedata = ''; 
  
    foreach($this->_filedata as $val){ 
      if(file_exists($val['path'])){ 
        $filedata .= "content-disposition: form-data; name=\"".$val['name']."\"; filename=\"".$val['filename']."\"\r\n"; 
        $filedata .= "content-type: ".mime_content_type($val['path'])."\r\n\r\n"; 
        // $filedata .= implode('', file($val['path']))."\r\n"; 
        $filedata .= file_get_contents($val['path'])."\r\n"; 
        $filedata .= '--'.$boundary."\r\n"; 
      } 
    } 
  
    if(!$formdata && !$filedata){ 
      return false; 
    } 
  
    $data .= $formdata.$filedata."--\r\n\r\n"; 
  
    $out = "POST ".$this->_url." http/1.1\r\n"; 
    $out .= "host: ".$this->_host."\r\n"; 
    $out .= "content-type: multipart/form-data; boundary=".$boundary."\r\n"; 
    $out .= "content-length: ".strlen($data)."\r\n"; 
    $out .= "connection: close\r\n\r\n"; 
    $out .= $data; 
  
    return $out; 
  } 
} // class end 
$config = array( 
      'ip' => '',
      'host' => 'www.example.com', 
      'port' => 80, 
      'errno' => '', 
      'errstr' => '', 
      'timeout' => 30, 
      'url' => '/upload.php',
); 
  
$formdata = array( 
  'name' => 'wechat', 
  'gender' => 'man'
); 
  
$filedata = array( 
  array( 
    'name' => 'photo', 
    'filename' => 'wechat.jpg', 
    'path' => 'wechat.jpg'
  ) 
); 
  
$obj = new HttpRequest(); 
$obj->setConfig($config); 
$obj->setFormData($formdata); 
$obj->setFileData($filedata); 
$result = $obj->send('get'); 
/*
get请求数据结构
GET /upload.php?name=wechat&gender=man http/1.1
host: www.vhallapp.com
connection: close

*/
$result = $obj->send('post');

/*
post请求数据结构
POST /upload.php http/1.1
host: www.vhallapp.com
content-type: application/x-www-form-urlencoded
content-length: 255810
connection: close
name=wechat&gender=man&photo=%89PNG%0D%0A%1A%0A%00%00%00%0DIHD
upload.php 处理
if ($_REQUEST['photo']) {
file_put_contents('photos.jpg',$_REQUEST['photo']);
}
 */
$result = $obj->send('multipart'); 
/*
multipart 请求数据结构

POST /upload.php http/1.1
host: www.vhallapp.com
content-type: multipart/form-data; boundary=---------------------------252e346444
content-length: 102588
connection: close
-----------------------------252e346444
content-disposition: form-data; name="name"
content-type: text/plain
wechat
-----------------------------252e346444
content-disposition: form-data; name="gender"
content-type: text/plain
man
-----------------------------252e346444
content-disposition: form-data; name="photo"; filename="wechat.jpg"
content-type: image/png
以下为二进制乱码

upload.php 处理
$uploaddir = './public/';
$uploadfile = $uploaddir . basename($_FILES['photo']['name']);

if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
    echo "上传成功";
} else {
    echo "上传失败";
}

 */  

```
今天文章是通过一个[markdown工具](https://phodal.github.io/mdpub/)来编写的，支持代码高亮，如果你也喜欢可以尝试下。

每篇文章推荐一个好工具：在线ppt制作，推荐一个[教程](http://greyli.com/html-for-impress-js-write-slides/) 前提是需要前端基础，因为喜欢杰伦多年，所以做了个jay的页面，简直酷炫，[地址](https://sushengbuhuo.github.io/jay.html#/start)。一定使用chrome或Firefox访问，否则看不到效果的。
当然还有在线工具如[prezi](http://prezi.com)  [ipresst](http://ipresst.com) [baomitu](https://ppt.baomitu.com/)

The End


