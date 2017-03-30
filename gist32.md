[在线手册学习网站请前往](http://www.shouce.ren)
```js
执行1000用户并发时就出现502或504错误，若用户数较多时，App上相关功能会大大受影响
1、首页，最大支持2000用户并发，超过2000后会出现502/504等错误，5000用户时会有50%的用户无法访问；
2、活动页-移动端UA，最大支持2000用户并发，但响应时间在25秒左右，需要优化；
3、Info接口，1000用户并发响应时间6秒，每秒处理事务数160个；Info优化前后的对比见附件。
4、List接口，2000用户并发相应时间13秒，每秒处理事务数130个。
mysql> select count(*) from users;
+----------+
| count(*) |
+----------+
|  5008300 |
+----------+
1 row in set (1.25 sec)
不翻墙  avtb123  后缀自己想去吧 https://oneinstack.com   我用的这个
```
[Simple browser detection for PHP ](http://www.flamecore.org)
[ip本地库解析地理位置](https://packagist.org/packages/geoip2/geoip2)
```js
/**
     * ip本地库解析地理位置
     * @param $ip
     * @return array|bool
     */
    public static function geoIp($ip){
        try{
            $file = base_path('storage').'/ipdata/GeoLite2-City.mmdb';
            $reader = new Reader($file);
            $record = $reader->city($ip);
            if(empty($record)){
                throw new \Exception('ip解析失败',5000);
            }
            $cityName = '';
            if(!empty($record->city->names)){
                $cityName = !empty($record->city->names['zh-CN']) ? $record->city->names['zh-CN'] : $record->city->names['en'];
            }
            $countryName = $record->country->names['zh-CN'];
            $areaName = !empty($record->subdivisions[0]->names['zh-CN']) ? $record->subdivisions[0]->names['zh-CN'] : $countryName;
            if(!empty($cityName) && !empty($countryName)){
                if(in_array($countryName,['台湾','澳门','香港'])){
                    $countryName = '中国';
                }
                return ['country' => $countryName, 'area' => $areaName, 'region' =>$areaName, 'city' => $cityName, 'isp' => '未知'];
            }else{
                return false;
            }
        }catch (\Exception $e){
            //print_r($e->getMessage());
        }
        return false;
    }
$reader = new Reader('/usr/local/share/GeoIP/GeoIP2-City.mmdb');//下载地址https://www.maxmind.com/en/geoip2-city

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city('128.101.101.101');

print($record->country->isoCode . "\n"); // 'US'
print($record->country->name . "\n"); // 'United States'
print($record->country->names['zh-CN'] . "\n"); // '美国'    
// http://geoip2.readthedocs.io/en/latest/  http://dev.maxmind.com/zh-hans/geoip/geoip2/geolite2-%e5%bc%80%e6%ba%90%e6%95%b0%e6%8d%ae%e5%ba%93/
>>> import geoip2.database
>>>
>>> # This creates a Reader object. You should use the same object
>>> # across multiple requests as creation of it is expensive.
>>> reader = geoip2.database.Reader('/path/to/GeoLite2-City.mmdb')
>>>
>>> # Replace "city" with the method corresponding to the database
>>> # that you are using, e.g., "country".
>>> response = reader.city('128.101.101.101')

>>> r=reader.city('1.119.129.17')
>>> print r.country.names['zh-CN']
中国
>>> print r.city.name
Beijing
>>> print r.city.names['zh-CN']
北京

redis队列用6379端口 因为用 keys * 
```

[Python 招聘信息爬取及可视化](http://bigborg.github.io/2016/09/12/Scrapy-Pythonjobs/)
```js
https://github.com/BigBorg/Scrapy-playground
rpub是一个专门用于发布R语言分析报告的网站http://7xshuq.com1.z0.glb.clouddn.com//githubrepo/scrapy/RAnalysis.html ggplot可以是R语言可视化最著名的包 https://mirrors.tuna.tsinghua.edu.cn/CRAN/bin/windows/base/R-3.3.3-win.exe  https://mirrors.tuna.tsinghua.edu.cn/anaconda/archive/ 
age <- c(1,3,5,2,11,9,3,9,12,3)
weight <- c(4.4,5.3,7.2,5.2,8.5,7.3,6.0,10.4,10.2,6.1)
mean(weight)
plot(age,weight)
q()
http://www.cnblogs.com/shyustc/p/4003225.html http://vdisk.weibo.com/s/yVFSlzgEVkvFA

desc select id,user_id,created_at,sum(nums) a,count(*) s from webinar_onlines where id>10000 and id<20000 group by user_id,created_at order by id \G
http://music.163.com/#/playlist?id=564322156
导入sql文件
load data infile 'd:/soft/wamp/www/laravel_web/saas_user_onlines.sql' into table user_onlines_bak fields terminated by ',' (user_id,parent_id,nums,online_min,online_hour,online_day,online_week) ; 
// $str = "insert into vhall_webinar.user_onlines_bak(user_id,nums,parent_id,online_min,online_hour,online_day,online_week) values({$row['user_id']},{$row['nums']},{$row['parent_id']},{$row['online_min']},{$row['online_hour']},{$row['online_day']},{$row['online_week']});".PHP_EOL;
                    // \Storage::disk('local_static')->append(date('Y-m-d').'onlines.sql', $str);
                    $s = "{$row['user_id']},{$row['parent_id']},{$row['nums']},{$row['online_min']},{$row['online_hour']},{$row['online_day']},{$row['online_week']}".PHP_EOL;
                    // file_put_contents(storage_path().'/'.date('Y-m-d-H').'onlines.sql',$str,FILE_APPEND);
                    file_put_contents(storage_path().'/onlines.sql',$s,FILE_APPEND);

//先排序后分组  获取每个分组最后的id
select id,user_id,created_at,sum(nums) from (select *from webinar_onlines
 order by id desc) a where id>40 and id<110 group by user_id,created_at order by id;
            // $lastCount = WebinarOnline::where(['user_id' => $data[$rowCount-1]->user_id, 'created_at' => $data[$rowCount-1]->created_at])->count();
            // $lastWebinarId = $data[$rowCount-1]->id+$lastCount-1;

```
[mysql笔记](http://bigborg.github.io/2016/09/29/mysql-notes/)
[pandas出毛病了](https://segmentfault.com/q/1010000008762657)
推荐使用Python的发行版Anaconda，自带各种数据处理包，不用额外安装
该发行版使用conda包管理工具，可以有效避免pip安装导致的依赖错误，无法安装等问题
如果觉得安装包比较大，可以试用精简版的Miniconda,需要额外下载安装。

如果使用conda下载速度比较慢，可以使用清华的镜像，清华conda镜像配置https://conda.io/miniconda.html  https://mirrors.tuna.tsinghua.edu.cn/help/anaconda/
[对文件夹内文件处理](https://segmentfault.com/q/1010000008777127)
```js
import glob
import shutil
file_list = glob.glob('*.htm')  # ['1.htm', '2.htm', '3.htm']
得到列表之后就可以遍历列表进行你想要的处理

for i in file_list：
    old_fileName = i
    new_fileName = i + '.tmp'
    #另存为：
    shutil.copy(old_fileName, new_fileName)
    with open(new_fileName, 'r+') as f:
       #光标移动到末尾
       f.seek(0,2)
       f.write('\nwrite something')
       #f.flush()
```
[PHP &变量问题](https://segmentfault.com/q/1010000008780130)
[取消composer全局代理设置。](https://laravel-china.org/topics/3984/phpcomposer-domestic-mirror-pills)
composer config -g repo.packagist composer https://packagist.org
composer config -g repo.packagist composer https://packagist.composer-proxy.org 
[命令行下执行 PHP artisan 相关命令没有效果且没有错误提示](https://laravel-china.org/articles/4070/command-line-execution-of-the-php-artisan-command-has-no-effect-and-no-error)
alias phpe="php -d display_errors" 
phpe artisan make:migration create_foo_table --create=foo
[Laravel 5.3 下捕捉 PDOException 异常](https://laravel-china.org/articles/4132/laravel-53-to-catch-pdoexception-exceptions)
use PDOException;
然后，这样处理即可：

try {
    $record = Foo::create(['name' => '王义国', 'sex' => 'male']);
 } catch (PDOException $e) {
    var_dump($e->getMessage());
 }
[Laragon 是一个 windows 下一个集 lnmp 为一体的web服务器](https://laravel-china.org/articles/3994/laragon-allows-you-to-happy-coding-under-windows)
下载地址：https://laragon.org/download.html
[数据库表设计范式 笔记](https://laravel-china.org/articles/4137/database-table-design-paradigm-notes)
https://page94.ctfile.com/fs/omy177170690 
[Laravel Debugbar 不用走宝的调试器](https://laravel-china.org/articles/4185/laravel-debugbar-do-not-go-to-the-treasure-debugger)
新增内置函数不一定自己定义的一样。
尽量不要定义全局函数，定义类静态方法。
[frp 内网穿透简单教程](https://laravel-china.org/articles/4200/frp-network-through-a-simple-tutorial)
载地址：http://www.diannaobos.com/frp/
安利一个 Composer 的源管理工具 slince/crmhttps://laravel-china.org/topics/4134/amway-composer-source-management-tool-slincecrm
https://github.com/slince/crm 
