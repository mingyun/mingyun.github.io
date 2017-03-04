###[正则取出其中的 IP 地址](https://www.v2ex.com/t/344344#reply19)
```js
print 'jdbc:mysql://10.0.151.205:3306 -> 10.0.151.205:3306'.split('->')[1].split(':')[0].strip()
>>> import urlparse 
>>> a = 'jdbc:mysql://10.0.151.205:3306' 
>>> urlparse.urlparse(urlparse.urlparse(a).path).hostname 
'10.0.151.205'
 split rsplit lsplit 是一组函数 他第二个参数非常有用的 

>>> a.rsplit(':', 1)[0].rsplit('/', 1)[-1] 
'10.0.151.205'
print '''jdbc:mysql://10.0.151.205:3306'''.split('/')[-1].split(':')[0]
https://www.v2ex.com/t/344404 
 https://regex101.com/r/aQUufT/1 http://regex.alf.nu/ 

```
###[「特别的」短网址](https://www.v2ex.com/t/344247#reply29)
地址: https://advertics.io/
###[性能研究专栏小组](https://www.v2ex.com/t/344364#reply22)
https://github.com/barretlee/performance-column/issues 
###[微信公众号菜单编辑器](https://www.v2ex.com/t/344534#reply0)
https://handsomeone.github.io/WeChatMenuManager/

###[防止 MySQL 的 ibdata1 文件过大](https://www.v2ex.com/t/344695#reply2)
```js
在 MySQL 5.6.6 版本以前， MySQL 默认会把所有的 innodb 的表都放在同一个文件中(ibdata1)，当该文件过大的时候， MySQL 容易出错，维护性能差。一个简单的办法是修改 MySQL 配置文件 /etc/my.cnf 后重启 [mysqld]

innodb_file_per_table=1
 mysqldump 备份所有数据库后重建所有数据库，步骤如下

mysqldump -u user -p password --all-databases > backup.sql 导出所有数据
删除所有数据库 drop database database_N
停止 MySQL 服务 service mysql stop 如果是 Mariadb 就是 service mariadb stop
删除文件 ibdata1, ib_logfile0, ib_logfile1
重启 MySQL 服务 service mysql start 如果是 Mariadb 就是 service mariadb start
导入备份数据 mysql -u user -p password --all-databases < backup.sql
另一种办法是把已经储存在 ibdata1 里面的 innodb 表拿出来放到它自己的路径上 mysql -sN -u user -p -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb'" | awk -F" " '{print "alter table"$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql

如果要排除 MySQL 自带的 table ，可以修改上面脚本中的 where 部分的语句。下面是在 Plesk 中使用的一个例子 MYSQL_PWD=cat /etc/psa/.psa.shadow mysql -sN -u admin -e "SELECT table_schema, table_name FROM INFORMATION_SCHEMA.TABLES WHERE engine = 'innodb' and table_schema != 'apsc' and table_schema != 'mysql' and table_schema != 'psa' and table_schema != 'information_schema' and table_schema != 'horde' and table_schema != 'performance_schema' and table_schema != 'roundcubemail' and table_schema not like 'phpmyadmin_%' " | awk -F" " '{print "alter table "$1"."$2" engine innodb;"}' | tee prepare.sql

mysql -u user -p < prepare.sql
```
###[国内的 composer 镜像](https://www.v2ex.com/t/344430#reply37)
https://pkg.phpcomposer.com/ 
git 也学会 -c HTTP_PROXY=http://127.0.0.1:1080
composer config -g repo.packagist composer https://p.staticq.com 
国内还有其它镜像 ThinkPHP 目前推荐的是 https://packagist.composer-proxy.org
###[HTML5 的匿名聊天室，试试 socket.io](https://www.v2ex.com/t/344540#reply19)
https://github.com/sheila1227/ChatRoom-AngularJS

###[wxpy: 优雅的微信个人号 机器人/API，用 Python 玩微信](https://www.v2ex.com/t/343685#reply48)
###[StackOverflow 上整理的 Python 2 和 3 之间的一些兼容性方面的细节问题](https://www.v2ex.com/t/344107#reply1)
http://stackoverflow.com/documentation/python/809/incompatibilities-between-python-2-and-python-3
###[静态网站生成器： Pagic](https://www.v2ex.com/t/344182#reply33)
GitHub: https://github.com/xcatliu/pagic
###[获取ip](https://www.v2ex.com/t/344470)
ifconfig.me 连不上 
ifconfig.co 太慢 

我用 Go 写了一个 ifconfig.cat 

curl ifconfig.cat 
wget -q ifconfig.cat 
http -b ifconfig.cat 
curl http://ip-api.com/line http://ip-api.com/docs/  
curl ipecho.net/plain https://ifconfig.minidump.info/ 

