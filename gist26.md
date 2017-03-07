###[TensorFlow 是一个用于人工智能的开源神器](http://www.tensorfly.cn/)
###[笔记1: 介绍TensorFlow](http://xinqiu.me/2017/01/20/cs20si-1/)

四舍六入五成双 的算法  小于等于4的时候舍去
大于等于6的时候进位
5的时候，看5前面是基数还是偶数  偶舍基进位 适合浮点计算中有强迫症的同学

四舍六入五凑偶 PHP_ROUND_HALF_EVEN 这个参数就就是：四舍五入六成双吧 parse_url() 函数可以解析 URL，获取顶级域名。

###&
```js
 $a=1;
function fun1($a){
$a=$a+1;echo $a;
}
function fun2(&$a){
  $a=$a+3;
}
echo $a;echo '<br>';1
fun1($a);echo '<br>';2
echo $a;echo '<br>';1
fun2($a);echo '<br>';4
echo $a;echo '<br>';
```
###[开源文档](http://dokuwiki.org/)
查看忘记密码 
内置的 web 服务器  nodejs anywhere 
php -S localhost:8000 python -m 
###[PHP 之道 ](http://laravel-china.github.io/php-the-right-way/)
```js
http://php.net/features.commandline.webserver https://github.com/phpbrew/phpbrew
http://pear.php.net/package/PHP_CodeSniffer/ https://github.com/benmatselby/sublime-phpcs
https://psr.phphub.org/  http://www.php-fig.org/psr/psr-0/ 
PHP-FIG 废弃了上一个自动加载标准： PSR-0，而采用新的自动加载标准 PSR-4。但 PSR-4 要求 PHP 5.3 以上的版本http://www.php-fig.org/psr/psr-4/ 
PHP 会在脚本运行时根据参数设置两个特殊的变量，$argc 是一个整数，表示参数个数，$argv 是一个数组变量，包含每个参数的值
curl -s https://getcomposer.org/composer.phar -o $HOME/local/bin/composer
chmod +x $HOME/local/bin/composer

Composer 会建立一个 composer.lock 文件，在你第一次执行 php composer install 时，存放下载的每个依赖包精确的版本编号。假如你要分享你的项目给其他开发者，并且 composer.lock 文件也在你分享的文件之中的话。 当他们执行 php composer.phar install 这个命令时，他们将会得到与你一样的依赖版本。 当你要更新你的依赖时请执行 php composer update。请不要在部署代码的时候使用 composer update，只能使用 composer install 命令，否则你会发现你在生产环境中用的是不同的扩展包依赖版本。
$end = clone $start;
$end->add(new DateInterval('P1M6D'));

$diff = $end->diff($start);
echo 'Difference: ' . $diff->format('%m month, %d days (total: %a days)') . "\n";
// Difference: 1 month, 6 days (total: 37 days)

if ($start < $end) {
    echo "Start is before end!\n";
}
在操作 Unicode 字符串时，请你务必使用 mb_* 函数。例如，如果你对一个 UTF-8 字符串使用 substr()，那返回的结果中有很大可能会包含一些乱码。正确的方式是使用 mb_substr()。
strpos() 和 strlen()，确实需要特别的处理。这些函数名中通常包含 mb_*：比如，mb_strpos() 和 mb_strlen()。
$pdo = new PDO('sqlite:/path/db/users.db');
$stmt = $pdo->prepare('SELECT name FROM users WHERE id = :id');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); // <-- filter your data first (see [Data Filtering](#data_filtering)), especially important for INSERT, UPDATE, etc.
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // <-- Automatically sanitized for SQL by PDO
$stmt->execute();
三个最常见的的信息类型是错误（error）、通知（notice）和警告（warning）。它们有不同的严重性: E_ERROR 、E_NOTICE和 E_WARNING。error_reporting(E_ERROR | E_WARNING);
基本上你可以利用 ErrorException 类抛出「错误」来当做「异常」，这个类是继承自 Exception 类。
try
{
    $email->send();
}
catch(Fuel\Email\ValidationFailedException $e)
{
    // 验证失败
}
catch(Fuel\Email\SendingFailedException $e)
{
    // 这个驱动无法发送 email
}
finally
{
    // 无论抛出什么样的异常都会执行，并且在正常程序继续之前执行
}
display_errors = On
display_startup_errors = On
error_reporting = -1将值设为 -1 将会显示出所有的错误
log_errors = On

如果黑客将一个构造的 id 参数通过像 http://domain.com/?id=1%3BDELETE+FROM+users 这样的 URL 传入。这将会使 $_GET['id'] 变量的值被设为 1;DELETE FROM users 然后被执行从而删除所有的 user 记录
PHP 5.5 中自带了 opcode 缓存工具，叫做OPcache 当一个 PHP 文件被解释执行的时候，首先是被编译成名为 opcode 的中间代码，然后才被底层的虚拟机执行。 如果PHP文件没有被修改过，opcode 始终是一样的。这就意味着编译步骤白白浪费了 CPU 的资源。
```
