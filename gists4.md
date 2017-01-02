###[文字倒过来](https://www.zhihu.com/question/29676030)
`console.log(String.fromCharCode(0x202E) + '一段文字') `
###[Javascript 中的 UTF-8](https://www.v2ex.com/t/331142#reply4)
```php
function encode_utf8(s) {
  return unescape(endcodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}
> btoa(encode_utf8('\u0227'));
"yKc=="
```
###[python 字符串形式的列表转列表](https://www.v2ex.com/t/330389)
```php
>>> a = [1, 2, 3, 4]
>>> str(a)
'[1, 2, 3, 4]'
>>> import json 
>>> a = '[1,2,2]' 
>>> b = json.loads(a) 
>>> b 
[1, 2, 2] 
>>> a = '[1,2,2]' 
>>> b = list(a)[1::2] 
>>> b 
['1', '2', '2']
>>> b
'[1, 2, 3, 4]'
>>> ast.literal_eval(b)
[1, 2, 3, 4]
a = '[1, 2, 3, 4]'.strip('[').strip(']').split(',')
```
###[同一台电脑下如何进行 Python 2 与 3 的切换](https://www.zhihu.com/question/22846291)
```php
Windows 上的 Python 自带启动器 py.exe，默认安装到系统盘的 system32 文件夹里。如果你同时安装了 Python 2 和 Python 3，用的时候直接在终端里输入：
py -3
就是打开 Python 3 的 REPL，或者
py -3 example.py
就可以运行 Python 3 的脚本了。
同理，直接输入
py example.py
使用 Python 2 来运行脚本。
py -2.7，出来2.7
py -3,出来3
py -3 -m pip install 也是可以的 可以直接pip3 install
手動把 python27下面的python.exe改成python2.exe
python35下面的python.exe改成python3.exe
你的腳本第一行就加上類似
#! D:\python27\python2.exe
這樣的一行就是調用python2
若是你想通过双击py文件运行程序，那么首先确保py文件关联执行的程序是py.exe。其次在你的源文件头部添加
#! python
或
#! python3
或
#! /usr/bin/env python3
```
###[mysql_real_escape_string() sql注入](http://stackoverflow.com/questions/5741187/sql-injection-that-gets-around-mysql-real-escape-string/12118602#12118602)
```php
$iId = mysql_real_escape_string("1 OR 1=1");    
$sSql = "SELECT * FROM table WHERE id = $iId";

$iId = (int)"1 OR 1=1";
$sSql = "SELECT * FROM table WHERE id = $iId";
mysql_query('SET NAMES gbk');
$var = mysql_real_escape_string("\xbf\x27 OR 1=1 /*");//縗' OR 1=1 /* SELECT * FROM test WHERE name = '縗' OR 1=1 /*' LIMIT 1
mysql_query("SELECT * FROM test WHERE name = '$var' LIMIT 1");

$pdo->query('SET NAMES gbk');
$stmt = $pdo->prepare('SELECT * FROM test WHERE name = ? LIMIT 1');
$stmt->execute(array("\xbf\x27 OR 1=1 /*"));
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//Safe Examples
mysql_query('SET NAMES utf8');
$var = mysql_real_escape_string("\xbf\x27 OR 1=1 /*");
mysql_query("SELECT * FROM test WHERE name = '$var' LIMIT 1");
```###[javascript抓取v2ex头像代码](https://www.v2ex.com/t/331524)
```php
var htmlURL = window.location.href;
var baselink = htmlURL.match(/.*=/g);
var toplink = "https://www.v2ex.com/recent?p=";
var toplinkNaN  = "https://www.v2ex.com/recent?p=NaN";
if ( baselink != toplink || htmlURL==toplinkNaN )
{
window.open("https://www.v2ex.com/recent?p=1");
localStorage.setItem("message",'');
}
function getLastNumberStr(str)
{
 var strs = str.replace(/.*=/g,'');
 return strs;
}
var i = getLastNumberStr(htmlURL);
i++;
self.location=toplink+i.toString();
var singlereg= /(\/\/cdn\.v2ex\.co\/avatar).*(png)/g;
var html = document.documentElement.innerHTML;
var htmlele = html.match(singlereg).toString().replace(/normal/g,"large").replace(/\,/g," ").replace(/\/\//g,"https://").replace(/png/g,"png\n");
var localdata=localStorage.getItem("message");
htmlele += localdata;
localStorage.setItem("message",htmlele);
console.log(htmlele);
```
###[sql注入必备知识](http://blog.spoock.com/2016/06/28/sql-injection-1/)
```php
mysql常用注释

#
--[空格]或者是--+
/*…*/
在注意过程中，这些注释可能都需要进行urlencode
```
###[0e开头MD5值小结](http://www.219.me/posts/2884.html)
```php
<?php
echo "-------------------------------------------\r\n";

while(1){
$s=rand();
$s.="a";
$s="s".$s;
if(md5($s)=="0") {
echo $s;
echo "\r\n";
echo md5($s)."\r\n";
}
}
```
###[无需编译的文档撰写工具](https://github.com/egoist/docute)
```php
npm i -g docute-cli

docute init ./docs
docute
```
###[Laravel 中的 model 里面能对某个属性进行过滤操作](https://laravel-china.org/topics/3526)

```php
public function getImagesAttribute($value)
{
    return json_decode($value);
}
$data         = Template::latest()->forPage($current_page, $page_size)->get();
```
###[引入第三方类](https://laravel-china.org/topics/3525)
```php
function model($name)
{
       $class = 'App\\'.$name;
       return new $class;
}
```
###[终端显示 Git 当前所在分支](https://pigjian.com/article/linux-git)
```php
编辑.bashrc文件
function git_branch {
  branch="`git branch 2>/dev/null | grep "^\*" | sed -e "s/^\*\ //"`"
  if [ "${branch}" != "" ];then
      if [ "${branch}" = "(no branch)" ];then
          branch="(`git rev-parse --short HEAD`...)"
      fi
      echo "->$branch"
  fi
}

export PS1='\[\e[37;40m\][\[\033[01;36m\]\u\[\e[37;40m\]@\[\e[0m\]\h \[\033[01;36m\]\W\[\033[01;32m\]$(git_branch)\[\033[00m\]\[\e[37;40m\]]\[\e[0m\]\$ '
source ./.bashrc
```
###[开启mysql远程连接](https://pigjian.com/article/centos-mysql)
```php
grant all privileges on *.* to 'root'@'%' identified by '123456' with grant option;
# root是用户名，%代表任意主机，'123456'指定的登录密码（这个和本地的root密码可以设置不同的，互不影响）
flush privileges; # 重载系统权限
exit;
允许3306端口

iptables -I INPUT -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
# 查看规则是否生效
iptables -L -n # 或者: service iptables status

# 此时生产环境是不安全的，远程管理之后应该关闭端口，删除之前添加的规则
iptables -D INPUT -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
service iptables save # 或者: /etc/init.d/iptables save
```
###[VarDumper高亮提示](https://pigjian.com/article/vardumper)
```php
composer require symfony/var-dumper
require 'vendor/autoload.php';

$var = array(
  'a simple string'=>'in an array of 5 elements',
  'a float' => 1.0,
  'an integer' => 1,
  'a boolean' => true,
  'an empty array' => array(),
);

dump($var);

composer global require symfony/var-dumper;
配置php.ini auto_prepend_file = ${HOME}/.composer/vendor/autoload.php
composer global update
```###斐波那契数列
```php
function fib($n)
{
$cur = 1;
$prev = 0;
for ($i = 0; $i < $n; $i++) {
yield $prev;

    $temp = $cur;
    $cur = $prev + $cur;
    $prev = $temp;
}
}

$fibs = fib(9);
foreach ($fibs as $fib) {
echo $fib.PHP_EOL;
}
```
###[Eloquent ORM 模型中添加自定义值](https://laravel-china.org/topics/3521)
```php
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'text'];

    /**
     * 文章对应多条评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
public function getCountCommentsAttribute()
{
    return $this->comments()->count();
}
protected $appends = ['count_comments'];
```###[Laravel collect 的 PHP Extension](https://laravel-china.org/topics/3528)
```php
git clone https://github.com/VikinDev/v-collect.git
phpize
./configure
make && make install
$vcollect = vcollect([
    ['developer' => ['name' => 'Taylor', 'option' => ['test' => 'one'] ] ],
    ['developer' => ['name' => 'Abigail', 'option' => ['test' => 'two'] ] ]
]);

$vcollect->where('developer.option.test', 'one')->toArray();

// ['developer' => ['name' => 'Taylor', 'option' => ['test' => 'one'] ] ]
```###[项目所依赖的组件的require-dev是不会安装到你的项目](https://segmentfault.com/q/1010000007967298)
```php
"require-dev": {
        "phpunit/phpunit": "~4.0",
    },
    "require": {
        "phpunit/phpunit": "5.7.*",
    },
```
###[读取/dev/urandom生成指定长度的随机数](https://segmentfault.com/q/1010000007959046)
```php
$pr_bits = '';
// Unix/Linux platform?
$fp = @fopen('/dev/urandom','rb');
if ($fp !== FALSE) {
    $pr_bits .= @fread($fp, 16);
    @fclose($fp);
}

echo $pr_bits;
```
###[php数组重组](https://segmentfault.com/q/1010000007943712)
```php

$array = [
     1 => [ 'k' => 0 ],
     2 => [ 'k' => 1 ],
     3 => [ 'k' => 1 ],
     4 => [ 'k' => 2 ],
     5 => [ 'k' => 4 ],
     6 => [ 'k' => 3 ],
     7 => [ 'k' => 0 ],
     8 => [ 'k' => 6 ]
];


$tree  = [];
$refer = $array;

foreach($array as $key => $val) {
    if (isset($refer[$val['k']])) {
        $refer[$val['k']]['children'][$key] = &$refer[$key];
    } else {
        $tree[$key] = &$refer[$key];
    }
}

print_r($tree);
[
    1 => [
      'k' => 0,
      'children' => [
          2 => [
            'k' => 1,
            'children' => [
                4 => [
                    'k' => 2
                    'children' => [
                        5 => ['k' => 4]
                    ]
                ]
            ]
          ],
          3 => [
              'k' => 1,
              'children' => [
                  6 => [
                  'k' => 3,
                  'children' => [
                      8 => ['k' => 6]
                  ]
              ]
          ]
      ]
    ],
    7 => [ 'k' => 0 ]
]

```
###[实现无限级分类](https://segmentfault.com/q/1010000007933292)
```php
$categories = [
  ['id'=>1,'cat_id'=>1,'cat_name'=>'a','pid'=>0],
  ['id'=>2,'cat_id'=>2,'cat_name'=>'b','pid'=>1],
  ['id'=>3,'cat_id'=>3,'cat_name'=>'c','pid'=>1],
  ['id'=>4,'cat_id'=>4,'cat_name'=>'d','pid'=>2],
  ['id'=>5,'cat_id'=>5,'cat_name'=>'e','pid'=>3],
];
    
    
$tree = [];

foreach($categories as $v){
    $tree[$v['id']] = $v;
    $tree[$v['id']]['children'] = array();
}

foreach ($tree as $k=>$v) {
    if ($v['pid'] > 0) {
        $tree[$v['pid']]['children'][] = &$tree[$k];
    }
}    
print_r($tree);
function _data_to_tree(&$items, $topid = 0, $with_id = TRUE)
{
    $result = [];
    foreach($items as $v)
        if ($topid == $v['parent'])  {
            $r = $v + ['children' => _data_to_tree($items, $v['id'], $with_id)];
            if ($with_id)
                $result[$v['id']] = $r;
            else
                $result[] = $r;
        }
            
    return $result;
}
//使用PHP的指针特性
function _data_to_tree($items, $topid = 0, $with_id = TRUE)
{
    if ($with_id)
        foreach ($items as $item)
            $items[ $item['parent'] ]['children'][ $item['id'] ] = &$items[ $item['id'] ];
    else
        foreach ($items as $item)
                $items[ $item['parent'] ]['children'][] = &$items[ $item['id'] ];

         return isset($items[ $topid ]['children']) ? $items[ $topid ][ 'children' ] : [];
}
//注意本算法 不会输出 0 的根节点
//并且数据必须有KEY，并且需要与id相等，也就是如下格式：
// 1 => ['id' => 1]
// 2 => ['id' => 2] 
$data = [
  4 => ['id' => 4, 'parent' => 1 , 'text' => 'Parent1'], 
  1 => ['id' => 1, 'parent' => 0 , 'text' => 'Root'],
  2 => ['id' => 2, 'parent' => 1 , 'text' => 'Parent2'], 
  3 => ['id' => 3, 'parent' => 2 , 'text' => 'Sub1'], 
];
print_r ( _data_to_tree($data, 0) );


```
###[联合查询如何无缝使用limit翻页](https://segmentfault.com/q/1010000007957291)
```php
SELECT id,title,time,flag FROM (
select id,title,time,'zhuan' flag from zhuan 
UNION ALL
select id,title,time,'post' from post) a GROUP BY time DESC LIMIT 0,10;

select id,title,cdn,time FROM (
(select id,title,111 as cdn,time from set_gif where zhuanid = 0) 
UNION ALL
(select id,name as title,222 as cdn,time from set_zhuan) order by time desc) a LIMIT 0,100
```###[php全局变量](https://segmentfault.com/q/1010000007920887)
```php
function global_references($flag)
{
    $var1 = &$GLOBALS['var1'];
    $var2 = &$GLOBALS['var2'];
    if ($flag) {
        $var2 = &$var1; //1
    } else {
        $var2 = '1'; //2
    }
}
```
###[数组转换](https://segmentfault.com/q/1010000007913647)
```php
<?php
// +----------------------------------------------------------------------
// | lmxdawn [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 .
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Byron Sampson <lmxdawn@gmail.com>
// +----------------------------------------------------------------------

/*
//设，有数组：
    $arr = [3, 1, 2, 4, 8, 7, 9, 10, 13, 15];
//写一个函数，使其输出格式为:
    $arr = array(
        0 => '1~4',
        1 => '7~10',
        2 => '13',
        3 => '15'
    );
 //*/

class Test {

    private $test_array;//需要操作的数组

    private $ico = '~';//分隔符

    private static $_instance;//

    private function __construct($test_array = array()) {
        $this->test_array = $test_array;
    }

    private function __clone() {
        // TODO: Implement __clone() method.
    }

    public static function getInstance($test_array = array()){
        if (is_null(self::$_instance) || !isset(self::$_instance)){
            self::$_instance = new self($test_array);
        }
        return self::$_instance;
    }

    /**
     * 数组分组
     * @return array 返回分好的数组
     */
    public function array_group(){

        //首先 升序对数组排序
        sort($this->test_array);
        // 去重数组
        $test_array = array_unique($this->test_array);
        //定义临时数组
        $tmp_array = array();
        $one = $test_array[0];//记录第一次的值
        $tmp_array_key = -1;//临时数组的下标 （初始值为 -1）不然临时数组的下标会从 1 开始
        foreach ($test_array as $key => $val){
            // 取出临时数组的最后一个元素
            $last_val = end($tmp_array);
            // 用分隔符把字符串转换为数组
            $last_array = explode($this->ico,$last_val);
            //如果最后一个元素为数组 就去最后一个元素的最后一个元素，否则就是取第一个
            $tmp_last_val = (is_array($last_array)) ? end($last_array) : $last_array[0];
            //判断是否是连续值
            if (!empty($tmp_last_val) && ($tmp_last_val + 1) == $val){
                $val = $one.$this->ico.$val;
            }else{
                // 如果不连续，更改第一次记录的值
                $one = $val;
                // 临时数组的值加一
                $tmp_array_key++;
            }
            //存入临数组
            $tmp_array[$tmp_array_key] = $val;
        }

        return $tmp_array;//返回临时数组

    }


    /**
     * 格式化输出数组
     * @param      $var
     * @param bool $echo
     * @param null $label
     * @param bool $strict
     * @return mixed|null|string
     */
    public static function dump($var, $echo=true, $label=null, $strict=true) {
        header("Content-type: text/html; charset=utf-8");
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }

}

$test_array = array(3, 1, 2, 4, 8, 7, 9, 10, 13, 15,3,1,2,4,23,56,85,24);
$test = Test::getInstance($test_array);

// 打印数组
Test::dump($test->array_group());
$arr = array(
        0 => '1~4',
        1 => '7~10',
        2 => '13',
        3 => '15'
);
```
