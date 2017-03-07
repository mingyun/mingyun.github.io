###[Python 练习实例2](http://www.runoob.com/python/python-exercise-example2.html)
```js
利润(I)低于或等于10万元时，奖金可提10%；利润高于10万元，低于20万元时，低于10万元的部分按10%提成，高于10万元的部分，可提成7.5%；20万到40万之间时，高于20万元的部分，可提成5%；40万到60万之间时高于40万元的部分，可提成3%；60万到100万之间时，高于60万元的部分，可提成1.5%，高于100万元时，超过100万元的部分按1%提成，从键盘输入当月利润I，求应发放奖金总数
i = int(raw_input('净利润:'))
arr = [1000000,600000,400000,200000,100000,0]
rat = [0.01,0.015,0.03,0.05,0.075,0.1]
r = 0
for idx in range(0,6):
    if i>arr[idx]:
        r+=(i-arr[idx])*rat[idx]
        print (i-arr[idx])*rat[idx]
        i=arr[idx]
print r
输入某年某月某日，判断这一天是这一年的第几天

year = int(raw_input('year:\n'))
month = int(raw_input('month:\n'))
day = int(raw_input('day:\n'))
 
months = (0,31,59,90,120,151,181,212,243,273,304,334)
if 0 < month <= 12:
    sum = months[month - 1]
else:
    print 'data error'
sum += day
leap = 0
if (year % 400 == 0) or ((year % 4 == 0) and (year % 100 != 0)):
    leap = 1
if (leap == 1) and (month > 2):
    sum += 1
print 'it is the %dth day.' % sum

斐波那契数列。
def fib(n):
	a,b = 1,1
	for i in range(n-1):
		a,b = b,a+b
	return a
 # 使用递归
def fib(n):
	if n==1 or n==2:
		return 1
	return fib(n-1)+fib(n-2)
def fib(n):
    if n == 1:
        return [1]
    if n == 2:
        return [1, 1]
    fibs = [1, 1]
    for i in range(2, n):
        fibs.append(fibs[-1] + fibs[-2])
    return fibs
输出 9*9 乘法口诀表
for i in range(1, 10):
    print 
    for j in range(1, i+1):
        print "%d*%d=%d" % (i, j, i*j),    
print time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time()))

古典问题：有一对兔子，从出生后第3个月起每个月都生一对兔子，小兔子长到第三个月后每个月又生一对兔子，假如兔子都不死，问每个月的兔子总数为多少？
兔子的规律为数列1,1,2,3,5,8,13,21....
f1 = 1
f2 = 1
for i in range(1,21):
    print '%12ld %12ld' % (f1,f2),
    if (i % 3) == 0:
        print ''
    f1 = f1 + f2
    f2 = f1 + f2
判断101-200之间有多少个素数，并输出所有素数。
程序分析：判断素数的方法：用一个数分别去除2到sqrt(这个数)，如果能被整除，则表明此数不是素数，反之是素数。    
h = 0
leap = 1
from math import sqrt
from sys import stdout
for m in range(101,201):
    k = int(sqrt(m + 1))
    for i in range(2,k + 1):
        if m % i == 0:
            leap = 0
            break
    if leap == 1:
        print '%-4d' % m
        h += 1
        if h % 10 == 0:
            print ''
    leap = 1
print 'The total is %d' % h
所谓"水仙花数"是指一个三位数，其各位数字立方和等于该数本身。例如：153是一个"水仙花数"，因为153=1的三次方＋5的三次方＋3的三次方。

for n in range(100,1000):
    i = n / 100
    j = n / 10 % 10
    k = n % 10
    if n == i ** 3 + j ** 3 + k ** 3:
        print n
一球从100米高度自由落下，每次落地后反跳回原高度的一半；再落下，求它在第10次落地时，共经过多少米？第10次反弹多高？
tour = []
height = []
 
hei = 100.0 # 起始高度
tim = 10 # 次数
 
for i in range(1, tim + 1):
    tour.append(hei)
    hei /= 2
    height.append(hei)
 
print('总高度：tour = {0}'.format(sum(tour)))
print('第10次反弹高度：height = {0}'.format(height[-1]))
有一分数序列：2/1，3/2，5/3，8/5，13/8，21/13...求出这个数列的前20项之和
a = 2.0
b = 1.0
s = 0
for n in range(1,21):
    s += a / b
    t = a
    a = a + b
    b = t
print s

a = 2.0
b = 1.0
l = []
for n in range(1,21):
    b,a = a,a + b
    l.append(a / b)
print reduce(lambda x,y: x + y,l)
求1+2!+3!+...+20!的和。
n = 0
s = 0
t = 1
for n in range(1,21):
    t *= n
    s += t
print '1! + 2! + 3! + ... + 20! = %d' % s
1 2 6 24 120 720 5040 40320 362880 3628800 39916800 479001600 6227020800 8717829
1200 1307674368000 20922789888000 355687428096000 6402373705728000 1216451004088
32000 2432902008176640000
利用递归方法求5!
def fact(j):
    sum = 0
    if j == 0:
        sum = 1
    else:
        sum = j * fact(j - 1)
    return sum

for i in range(5):
    print '%d! = %d' % (i,fact(i))

有5个人坐在一起，问第五个人多少岁？他说比第4个人大2岁。问第4个人岁数，他说比第3个人大2岁。问第三个人，又说比第2人大两岁。问第2个人，说比第一个人大两岁。最后问第一个人，他说是10岁。请问第五个人多大
def age(n):
    if n == 1: c = 10
    else: c = age(n - 1) + 2
    return c
print age(5)
x = int(raw_input("计算个十百千万数字:\n"))
a = x / 10000
b = x % 10000 / 1000
c = x % 1000 / 100
d = x % 100 / 10
e = x % 10
一个5位数，判断它是不是回文数。即12321是回文数，个位与万位相同，十位与千位相同。
求100之内的素数。
for num in range(2,101):
	# 素数大于 1
	if num > 1:
		for i in range(2,num):
			if (num % i) == 0:
				break
		else:
			print(num)
将一个数组逆序输出。
a = [9,6,5,4,1]
    N = len(a) 
    print a
    for i in range(len(a) / 2):
        a[i],a[N - i - 1] = a[N - i - 1],a[i]用第一个与最后一个交换。
    print a
MAXIMUM = lambda x,y :  (x > y) * x + (x < y) * y
MINIMUM = lambda x,y :  (x > y) * y + (x < y) * x
MAXIMUM(a,b)
求0—7所能组成的奇数个数。
sum = 4
    s = 4
    for j in range(2,9):
        print sum
        if j <= 2:
            s *= 7
        else:
            s *= 8
        sum += s
    print 'sum = %d' % sum
  有n个人围成一圈，顺序排号。从第一个人开始报数（从1到3报数），凡报到3的人退出圈子，问最后留下的是原来第几号的那位。
  nmax = 50
    n = int(raw_input('请输入总人数:'))
    num = []
    for i in range(n):
        num.append(i + 1)

    i = 0
    k = 0
    m = 0

    while m < n - 1:
        if num[i] != 0 : k += 1
        if k == 3:
            num[i] = 0
            k = 0
            m += 1
        i += 1
        if i == n : i = 0

    i = 0
    while num[i] == 0: i += 1
    print num[i]
```









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
