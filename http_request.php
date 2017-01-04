<?php  
/** HttpRequest class, HTTP请求类，支持GET,POST,Multipart/form-data 
*   Date:   2013-09-25 
*   Author: fdipzone 
*   Ver:    1.0 
* http://blog.csdn.net/fdipzone/article/details/12180523
*   Func: 
*   public  setConfig     设置连接参数 
*   public  setFormdata   设置表单数据 
*   public  setFiledata   设置文件数据 
*   public  send          发送数据 
*   private connect       创建连接 
*   private disconnect    断开连接 
*   private sendGet       get 方式,处理发送的数据,不会处理文件数据 
*   private sendPost      post 方式,处理发送的数据 
*   private sendMultipart multipart 方式,处理发送的数据,发送文件推荐使用此方式 
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
                $filedata .= implode('', file($val['path']))."\r\n";  
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
            'ip' => 'demo.fdipzone.com', // 如空则用host代替  
            'host' => 'demo.fdipzone.com',  
            'port' => 80,  
            'errno' => '',  
            'errstr' => '',  
            'timeout' => 30,  
            'url' => '/getapi.php',  
            //'url' => '/postapi.php',  
            //'url' => '/multipart.php'  
);  
  
$formdata = array(  
    'name' => 'fdipzone',  
    'gender' => 'man'  
);  
  
$filedata = array(  
    array(  
        'name' => 'photo',  
        'filename' => 'photo.jpg',  
        'path' => 'photo.jpg'  
    )  
);  
  
$obj = new HttpRequest();  
$obj->setConfig($config);  
$obj->setFormData($formdata);  
$obj->setFileData($filedata);  
$result = $obj->send('get');  
//$result = $obj->send('post');  
//$result = $obj->send('multipart');  
