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
http://blog.41ms.com/post/26.html
ssh-keygen -t rsa
scp id_rsa.pub root@www.example.com:/root/.ssh
mv id_rsa.pub authorized_keys
chmod 700 /root/.ssh/authorized_keys
chmod 600 /root/.ssh
把密码放到本地用户的.ssh目录下，并分别命令，并创建config文件。
Host 别名

HostName 服务器地址

User 用户名

IdentifyFile 密钥路径
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
###[ 把数组随机插入到另一个给定有序数组中](http://blog.41ms.com/post/7.html)
```js
$a = array(0,1,2,3,4,5,6,7,8,9);
$b = array('wang', 'yu', 'peng');

$count_b = count($b);
$count_a = count($a);

for ($i=0; $i<$count_b; $i++) {
    $offset = mt_rand(0, $count_a-1);
    array_splice($a, $offset, 0, $b[$i]);
}

$count_b = count($b);
$rand_keys = array_rand($a, $count_b);
$count_rand_keys = count($rand_keys);

// 排序随机键标，使其从大到小
rsort($rand_keys);

$box = array();
foreach ($a as $k=>$v) {
    $box[] = $v;

    if (!$count_rand_keys) continue;
    // 取随机键标，从小到大依次取
    $rand_key = $rand_keys[$count_rand_keys-1];

    if ($k == $rand_key) {
        $count_rand_keys--;
        $box[] = array_pop($b);
    }
}
Array
(
    [0] => 0
    [1] => 1
    [2] => 2
    [3] => 3
    [4] => peng
    [5] => 4
    [6] => 5
    [7] => yu
    [8] => 6
    [9] => 7
    [10] => 8
    [11] => wang
    [12] => 9
)
```
###[http请求，简单的数据完整性校对思路](http://blog.41ms.com/post/29.html)
```js
/**
 * 加密请求数据
 * @param array $data
 * @return array
 */
function encrypt_http_data($data = array())
{
    if (empty($data)) {
        return $data;
    }

    $now = time();
    $data['time'] = $now;
    ksort($data);
    $sData = implode($data);

    $length = ($now % 10) + 10;

    $data['token'] = substr(md5($sData), 0, $length);

    return $data;
}

$data['uid'] = 123456789;
$data['order_id'] = 12345678;

$data = encrypt_http_data($data);

$url = 'http://blog.41ms.com/api/test.php?' . http_build_query($data);

$result = file_get_contents($url);
/**
 * 检测数据完整性
 * @param $data
 * @return bool
 */
function check_data($data)
{
    if (empty($data) || !isset($data['token'])) {
        return false;
    }

    $token = $data['token'];
    unset($data['token']);
    ksort($data);
    $sData = implode($data);
    $length = ($data['time'] % 10) + 10;

    if (substr(md5($sData), 0, $length) !== $token) {
        return false;
    }

    return true;
}

// 验证数据完整性

$data = $_REQUEST;

if (!check_data($data)) {
    exit('error');
}
```
###[利用office online 在线查看excel，word，ppt文档](http://blog.41ms.com/post/37.html)
```js
https://products.office.com/en-us/office-online/view-office-documents-online?legRedir=true&redir=0&CorrelationId=d491f26f-cf70-4177-9b1a-d1b02204806e# 
http://view.officeapps.live.com/op/view.aspx?src=你的文档路径
在线浏览Office文档：http://blogs.office.com/2013/04/10/office-web-viewer-view-office-documents-in-a-browser/
查看docx文档：http://view.officeapps.live.com/op/view.aspx?src=newteach.pbworks.com%2Ff%2Fele%2Bnewsletter.docx
查看xlsx文档：http://view.officeapps.live.com/op/view.aspx?src=http%3A%2F%2Flearn.bankofamerica.com%2Fcontent%2Fexcel%2FWedding_Budget_Planner_Spreadsheet.xlsx
查看PPT文档：http://view.officeapps.live.com/op/view.aspx?src=http%3a%2f%2fvideo.ch9.ms%2fbuild%2f2011%2fslides%2fTOOL-532T_Sutter.ppt
```
###[西方公历换算天干地支纪年法，生肖换算](http://blog.41ms.com/post/43.html)
```js
/**
 * 根据西方公历年获取天干地支纪年法和生肖信息
 * @param $year 西方公历年，例：2015 默认当年
 * @return array
 */
public function getTgdzInfo($year=null){

    $year = empty($year) ? date('Y') : $year;

    $tiangan_list = array('庚', '辛', '壬', '癸', '甲', '乙', '丙', '丁', '戊', '己');
    $dizhi_list = array('申', '酉', '戌', '亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未');
    $shengxiao = array(
        '申'=>'猴',
        '酉'=>'鸡',
        '戌'=>'狗',
        '亥'=>'猪',
        '子'=>'鼠',
        '丑'=>'牛',
        '寅'=>'虎',
        '卯'=>'兔',
        '辰'=>'龙',
        '巳'=>'蛇',
        '午'=>'马',
        '未'=>'羊'
    );

    $tiangan = $tiangan_list[$year % 10];
    $dizhi = $dizhi_list[$year % 12];

    $info = array(
        'tiangan'=>$tiangan,
        'dizhi'=>$dizhi,
        'shengxiao'=>$shengxiao[$dizhi]
    );

    return $info;
}
```
###[PHP 余弦相似性，实现字符串相似度提取异已字符串](http://blog.41ms.com/post/32.html)
```js
/**
 * 根据余弦相似性计算两个字符串相似度，0-1之间，越大越相似
 * @param $s1
 * @param $s2
 * @return float|int 相似度
 */
function similarity($s1, $s2)
{
    $tmp = array();

    for ($i=0; $i<=strlen($s1); $i++) {
        $a = ord($s1[$i]);
        $tmp[$a][0] = $tmp[a][0]+1;
    }

    for ($i=0; $i<=strlen($s2); $i++) {
        $a = ord($s2[$i]);
        $tmp[$a][1] = $tmp[a][1]+1;
    }

    $a1 = 0;
    $a2 = 0;
    $a3 = 0;


    if (count($tmp) > 0) {
        foreach ($tmp as $i => $v) {
            $a1 += $v[0] * $v[1];
            $a2 += $v[0] * $v[0];
            $a3 += $v[1] * $v[1];
        }
    } else {
        return 0;
    }

    return $a1 / sqrt($a2 * $a3);
}


/**
 * 只提取中文，英文，数字
 * @param $str
 * @return string
 */
function filter_str( $str )
{
    $pattern = '/[^\x{4e00}-\x{9fa5}\d\w]+/u';
    $res = preg_replace($pattern, '', $str);
    return $res;
}


// 读取一个文件，每行一个字符串
$files = file('content.txt');

// 模拟数据库结构数据
$str_list = array();
foreach ($files as $k => $v) {
    list($id, $content) = explode(',', trim($v));
    $item = array(
        'id' => $id,
        'content' => filter_str($content)
    );
    $str_list[] = $item;
}


foreach ($str_list as $k => $v) {

    // 提取异己数据
    $other_contents = '';
    foreach ($str_list as $k2 => $v2) {
        if ($k != $k2) {
            $other_contents .= $v2['content'];
        }
    }

    // 相似度与数据关联
    $str_list[$k]['score'] = similarity($v['content'], $other_contents);
}

// 相似度降序排序
$score_list = array();
foreach ($str_list as $v) {
    $score_list[] = $v['score'];
}

array_multisort($score_list, SORT_ASC, $str_list);

// 获取中位数
$middle_key = floor(count($str_list)/2);

// 提取结果
$box = array();
foreach ($str_list as $v) {

    // 中位数据
    $middle_item = $str_list[$middle_key];
    // 中位数与最大值的距离
    $middle_score_distance = max($score_list) - $middle_item['score'];

    if (abs($v['score']-$middle_item['score']) > abs($middle_score_distance)) {
        $box[] = $v;
    }
}

var_dump($box);
```
###[git log 太多日志时直接全部输出](https://segmentfault.com/q/1010000007977721)
```js
禁用 pager 分页就行了

git --no-pager log
```
###[php扩展trie_filter，利用词库，过滤敏感词]()
```js
https://github.com/wulijun/php-ext-trie-filter
$ tar zxvf libdatrie-0.2.4.tar.gz
$ cd libdatrie-0.2.4
$ make clean
$ ./configure --prefix=$LIB_PATH
$ make
$ make install
$ $INSTALL_PHP_PATH/bin/phpize
$ ./configure --with-php-config=$INSTALL_PHP_PATH/bin/php-config --with-trie_filter=$LIB_PATH
$ make
$ make install
修改php.ini，增加一行：extension=trie_filter.so，然后重启PHP。
ini_set('memory_limit', '512M');
$arrWord = file('dict.txt');

$resTrie = trie_filter_new();

foreach ($arrWord as $k => $v) {
    trie_filter_store($resTrie, $v);
}
trie_filter_save($resTrie, __DIR__ . '/blackword.tree');
$resTrie = trie_filter_load(__DIR__ . '/blackword.tree');

$str = '王玉鹏的媳妇叫刘敏，王玉鹏的邮箱地址是wangyupeng@jiayuan.com，想不想知道他的QQ号呢？';
$arrRet = trie_filter_search_all($resTrie, $str);

print_all($str, $arrRet);

function print_all($str, $res) {//print_r($res);
    echo "$str\n";
    foreach ($res as $k => $v) {
        echo $k."=>{$v[0]}-{$v[1]}-".substr($str, $v[0], $v[1])."\n";
    }
}
http://blog.41ms.com/post/41.html

```
###[python脚本库，实现一些简单功能的脚本]( https://github.com/iloster/PythonScripts)
###[pyton 结巴中文分词 完成敏感词过滤系统](http://blog.41ms.com/post/40.html)
```js
#!/usr/bin/python
# encoding=utf-8
import tornado.ioloop
import tornado.web
import jieba
import jieba.posseg as pseg
import json

jieba.load_userdict('dict.txt')

class MainHandler(tornado.web.RequestHandler):
    def get(self):
        content = self.get_argument('content')
        words = pseg.cut(content) 
        result = []
        // 只获取自定义词库中的分词
        for word, flag in words:
            if flag=="custom" :
                result.append(word) 
        
        self.write(json.dumps(result))
            
application = tornado.web.Application([
    (r"/", MainHandler),
])

if __name__ == "__main__":
    application.listen(8888)
    tornado.ioloop.IOLoop.instance().start()
   // 支持PHP的结巴项目地址：https://github.com/fukuball/jieba-php
```
