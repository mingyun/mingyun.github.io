###[python将文本转化成gif图片阅读 ](http://blog.csdn.net/iloster/article/details/25463563)
```js
 import pygame  
from pygame.locals import *  
from sys import exit  
import time  
import codecs  
#获得文字  https://github.com/iloster/PythonScripts
def get_text():  
    with open('test.txt','r') as fp:  
        #print fp.read()  
        return fp.read()  
if __name__=='__main__':     
    text=get_text()  
    print type(text)  
    text = text.decode('gbk')  
    length=len(text) #字符串长度  
    #print text  
    print length  
    sum=0  
    #初始化pygame  
    pygame.init()  
    #创建一个窗口  
    screen=pygame.display.set_mode((500,500),0,32)  
    #设置标题  
    pygame.display.set_caption('loster v0.1')  
    #设置文字属性  
    my_font=pygame.font.SysFont('SimHei',64)  
    while True:  
        for event in pygame.event.get():  
            if event.type == QUIT:  
                pygame.quit()  
                exit()  
        for i in range(length):  
            print text[i]  
              
            text_surface=my_font.render(text[i],True,(0,0,0),(255,255,255))  
            #绘制文字  
            screen.blit(text_surface,(200,200))  
            #暂停1000ms  
            pygame.time.wait(1000)  
            #刷新  
            pygame.display.update() 
```
###[笑看Websocket](https://wowphp.com/post/wqz8env1d3vm.html)
```js
GET /chat HTTP/1.1
Host: xxxx.com
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Key: XXXXXX 一个Base64 encode的值，这个是浏览器随机生成的
Sec-WebSocket-Protocol: XXXX 一个用户定义的字符串
Sec-WebSocket-Version: X
Origin:http://xxxx.com

HTTP/1.1101Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: XXXX
Sec-WebSocket-Protocol: B
```
###[多个密钥 ssh key 登录不同linux服务器](http://blog.41ms.com/post/55.html)
```js
Host 41ms    // host别名
    HostName www.41ms.com    // 连接服务的地址或ip
    User wangyupeng    // 用户名
    IdentityFile ~/.ssh/id_rsa.aliyun    // 使用指定的密钥

Host 41ms
    HostName www.41ms.com
    User git
    IdentityFile ~/.ssh/id_rsa.aliyun
    
Host github.com
    HostName github.com
    User wangyupeng129@126.com
    IdentityFile ~/.ssh/id_rsa.github
```
###[清理目录下的过期文件](http://blog.41ms.com/post/59.html)
```js
function delTree($dir, $seconds_old) {
    $files = array_diff(scandir($dir), array('.','..'));

    foreach ($files as $file) {
        if (is_dir("$dir/$file")) {
            delTree("$dir/$file", $seconds_old);
            return rmdir("$dir/$file");
        } elseif ((time() - filemtime("$dir/$file")) > $seconds_old) {
            unlink("$dir/$file");
        }
    }
}

// 指定清楚的目录
$dir = '/Users/wangyupeng/Documents/my/code';
// 设置清理过期文件的时间，单位秒
$seconds_old = 60;

delTree($dir, $seconds_old);
```
###[检测程序正常运行，遇故障则重启服务](http://blog.41ms.com/post/42.html)
```js
* * * * * /data/script/check_server.sh
#!/usr/bin/bash
cmd="/application/php/bin/php /data/www/filter/http_server.php"
count=`ps aux |grep "$cmd" | grep -v "grep" | wc -l`

echo $count
if [ $count -lt 1 ]; then
ps aux |grep "$cmd" | grep -v "grep"| awk '{print $2}'|xargs kill -9
sleep 2
$cmd
echo "restart "$(date +%Y-%m-%d_%H:%M:%S) >/data/log/restart.log
fi
```
###[服务器登录用户报警邮件通知](http://blog.41ms.com/post/49.html)
```js
vim /etc/profile
USER_IP=`who -u am i 2>/dev/null| awk '{print $NF}'|sed -e 's/[()]//g'`

echo [`date "+%Y-%m-%d %H:%M:%S"`] [`id -un`] is login from [$USER_IP]  | mail -s "sshd login message" wangyupeng@41ms.com
```
###[curl post请求的报错处理](http://blog.41ms.com/post/48.html)
```js
function curl_post($url, $post = NULL, array $options = array())
{
    $defaults = array(
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_TIMEOUT => 4
    );

    if (is_array($post)) {
        $defaults[CURLOPT_POSTFIELDS] = http_build_query($post);
    } else {
        $defaults[CURLOPT_POSTFIELDS] = $post;
    }
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));

    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpcode>=200 && $httpcode<300) {
        curl_close($ch);
        return array('error'=>false, 'content'=>$result);
    }

    $notice_data[] = $url;
    if (empty($result)) {
        $notice_data[] = curl_error($ch);
    } else {

        if (empty($httpcode)) {
            $notice_data[] = 'No HTTP code was returned';
        } else {
            $http_codes = parse_ini_file(dirname(__FILE__)."/above.ini");

            $notice_data[] = $httpcode.' '.$http_codes[$httpcode];
        }
    }

    curl_close($ch);

    return array('error'=>true, 'content'=>$notice_data);
}

```
###[保证PHP脚本一直在运行，如果脚本意外中断后，能自启动](http://blog.41ms.com/post/35.html)
```js
function array_diff_fast($array1, $array2) { 
    $array1 = array_flip($array1); 
    $array2 = array_flip($array2);
    foreach($array2 as $hash => $key) { 
        if(isset($array1[$hash])){
            unset($array1[$hash]); 
        }
    } 
    return array_flip($array1); 
}
#! /bin/sh
if [ $# -lt 1 ]
then
        echo "this file is used to run thoses commands which only need one running instance"
        echo "Usage: $0 singleton_cmd"
        exit
fi
CMD=$*
PID=$(ps x  | grep "$CMD" | grep -v -P "(grep|$0)" | awk '{print $1}')
if [ -n "$PID" ]
then
        echo "$CMD already running with pid($PID)"
else
        $CMD
fi

* * * * * /home/wyp/start_service.sh /usr/bin/php /home/wyp/test.php >> /tmp/test.log 2>&1
```
###[composer报错 Failed to decode response: zlib_decode(): dat](http://blog.41ms.com/post/36.html)
```js
Failed to decode response: zlib_decode(): data error
Retrying with degraded mode, check https://getcomposer.org/doc/articles/troubleshooting.md#degraded-mode for more info
composer self-update
```
###[列出指定目录下所有文件](http://blog.41ms.com/post/22.html)
```js
$dirs = "C:/Windows/Temp";
function fileshow($dirs, &$box = array()) {
    $dir = opendir ( $dirs );
    while ( $f = readdir ( $dir ) ) {
        if ($f != '.' && $f != '..') {
            $file = $dirs . '/' . $f;
            if (is_file ( $file )) {
                $box [] = $file;
            } else {
                fileshow ( $file, $box );
            }
        }
    }
    
    return $box;
}
```
###PHP提取字符串 中文，英文，数字
```js
$pattern = '/[^\x{4e00}-\x{9fa5}\d\w]+/u';
$res = preg_replace($pattern, '', $str);
```
###[php byte KB MB GB TB PB 转换](http://blog.41ms.com/post/21.html)
```js
function _format_bytes($a_bytes)
{
    if ($a_bytes < 1024) {
        return $a_bytes .' B';
    } elseif ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 2) .' KiB';
    } elseif ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 2) . ' MiB';
    } elseif ($a_bytes < 1099511627776) {
        return round($a_bytes / 1073741824, 2) . ' GiB';
    } elseif ($a_bytes < 1125899906842624) {
        return round($a_bytes / 1099511627776, 2) .' TiB';
    } elseif ($a_bytes < 1152921504606846976) {
        return round($a_bytes / 1125899906842624, 2) .' PiB';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round($a_bytes / 1152921504606846976, 2) .' EiB';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
    } else {
        return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
    }
}
```
###关闭redis持久化
```
注释掉原来的持久化规则
#save 900 1
#save 300 10
#save 60 10000
save ""
```
###[在一堆数字中找出和其他数字不同的数字](http://blog.41ms.com/post/20.html)
```js
123,123,14,123,123,123这堆数字中找出14来
/*
 读取前3个数字:
1. 如果3个数字不都一样，给出不一样的那个，结束。
2. 如果都一样=X，整个数组扫过去，找到一个不等于X的数字，结束。
*/
function uniqNum($nums) {
    $n = count ( $nums );
    $a = $nums [0];
    $b = $nums [1];
    $c = $nums [2];

    if ($a == $b && $b == $c)
        for($i = 3; $i < $n; $i ++)
            if ($nums [$i] != $a) {
                return $nums [$i];
            }

    if ($a == $b)
        return $c;

    if ($a == $c)
        return $b;

    return $a;
}

echo uniqNum ( [
        123,
        123,
        14,
        123,
        123,
        123
] );
```
###[PHP按字符串长度分割成数组,支持中文](http://blog.41ms.com/post/24.html)
```js
/**

 * 将unicode字符串按传入长度分割成数组

 * @param  string  $str 传入字符串

 * @param  integer $l   字符串长度

 * @return mixed      数组或false

 */

function str_split_unicode($str, $l = 0) {

    if ($l > 0) {

        $ret = array();

        $len = mb_strlen($str, "UTF-8");

        for ($i = 0; $i < $len; $i += $l) {

            $ret[] = mb_substr($str, $i, $l, "UTF-8");

        }

        return $ret;

    }

    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);

}
$str = "还未如愿sss见gfg者不rtret不朽";
var_dump(str_split_unicode($str, 5));
array(4) {    
[0]=>    
string(9) "我也hel"    
[1]=>    
string(11) "lo不知道"    
[2]=>    
string(5) "world"    
[3]=>    
string(15) "该说些什么"    
}
```
