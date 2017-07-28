[在MySQL中阻止UPDATE语句没有添加WHERE条件的发生](http://www.cnblogs.com/wjoyxt/p/5620827.html)
```js
# sql_safe_updates=1,即开启
root@127.0.0.1 : test 08:00:00> set sql_safe_updates=1;
Query OK, 0 rows affected (0.00 sec)

root@127.0.0.1 : test 08:00:11> show variables like 'sql_safe_updates';
+------------------+-------+
| Variable_name    | Value |
+------------------+-------+
| sql_safe_updates | ON    |
+------------------+-------+
1 row in set (0.00 sec)

root@127.0.0.1 : test 08:00:16> select * from t;
+-------+
| pd    |
+-------+
| hello |
| mysql |
+-------+
2 rows in set (0.00 sec)

root@127.0.0.1 : test 08:00:25> begin;
Query OK, 0 rows affected (0.00 sec)

root@127.0.0.1 : test 08:00:27> update t set pd='MySQL';
ERROR 1175 (HY000): You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column
如上属的例子所示，当参数sql_safe_updates开启的时候，UPDATE语句不携带WHERE条件将会爆出一个错误。。所以小心使用UPDATE语句是真的很重要哇。。。

 
```
[Mysql 一条SQL语句实现批量更新数据，update结合case、when和then的使用案例](http://blog.csdn.net/xiaoxiaodongxie/article/details/51773219)
```js
UPDATE categories SET 
display_order = CASE id 
        WHEN 1 THEN 3 
        WHEN 2 THEN 4 
        WHEN 3 THEN 5 
END, 
title = CASE id 
        WHEN 1 THEN 'New Title 1'
        WHEN 2 THEN 'New Title 2'
        WHEN 3 THEN 'New Title 3'
END
WHERE id IN (1,2,3);
$display_order = array( 
    1 => 4, 
    2 => 1, 
    3 => 2, 
    4 => 3, 
    5 => 9, 
    6 => 5, 
    7 => 8, 
    8 => 9 
); 

$ids = implode(',', array_keys($display_order)); 
$sql = "UPDATE categories SET display_order = CASE id "; 
foreach ($display_order as $id => $ordinal) { 
    $sql .= sprintf("WHEN %d THEN %d ", $id, $ordinal); 
} 
$sql .= "END WHERE id IN ($ids)"; 
echo $sql;
基于角色的访问控制RBAC的mysql表设计 http://blog.csdn.net/xiaoxiaodongxie/article/details/52400488 
```
[警惕 MySql 更新 sql 的 WHERE 从句中的 IN() 子查询时出现的陷阱](http://blog.csdn.net/defonds/article/details/46745143)
```js
update mer_stage set editable = 1 where stage_id in(
	select associated_id from proc where proc_id in(6446 , 6447 , 6450));
select associated_id from proc where proc_id in(6446 , 6447 , 6450) and associated_id = '外查询结果.stage_id';  

update mer_stage m join proc p on m.stage_id = p.associated_id set m.editable = 1  
        where p.proc_id =6446 or p.proc_id =6447 or p.proc_id =6450;  

```
[Mysql中exists子查询语句的使用，取出每组中最高的前n名的信息](http://blog.csdn.net/xiaoxiaodongxie/article/details/52606915)
```js
create table cat(  
    id int not null auto_increment primary key,  
    cat_id int,  
    value int,  
    name varchar(30)  
);  
insert into cat (cat_id,name,value) values ('1','name1', '2');  
insert into cat (cat_id,name,value) values ('1','name2', '21');  
insert into cat (cat_id,name,value) values ('1','name3', '1');  
insert into cat (cat_id,name,value) values ('1','name4', '3');  
insert into cat (cat_id,name,value) values ('2','name5', '54');  
insert into cat (cat_id,name,value) values ('2','name6', '4');  
insert into cat (cat_id,name,value) values ('2','name7', '24');   
insert into cat (cat_id,name,value) values ('2','name8', '23');  
insert into cat (cat_id,name,value) values ('3','name9', '57');  
insert into cat (cat_id,name,value) values ('3','name10','45');  
insert into cat (cat_id,name,value) values ('3','name11','12');  
insert into cat (cat_id,name,value) values ('3','name12','23');  

select a.* from cat a where exists (select count(*) from cat where cat_id = a.cat_id and value > a.value having Count(*) < 3) order by a.cat_id,a.value desc;

```
[Python 爬虫：把廖雪峰的教程转换成 PDF 电子书](https://github.com/lzjun567/crawler_html2pdf)
[ip](https://github.com/nelsonking/ip_location/tree/master/src)
https://github.com/maxmind/GeoIP2-php 
[阿里鉴黄](https://github.com/vhall/check_picture/tree/master/src)
```js
跨库查询
class UserOnline extends Model {
    protected $table = 'user_onlines';

    protected $guarded = ['id'];

    public function __construct(array $attributes = array()) {
        $this->setConnection('webinar');
        parent::__construct($attributes);
    }

}
config/database.php
/* 活动主从库 */
        'webinar' => [
            'driver'    => env('DB_MYSQL_DRIVER', 'mysql'),
            'read'      => [
                'host'  => env('DB_WEBINAR_SLAVE_HOST','localhost'),
            ],
            'write'     => [
                'host'  => env('DB_WEBINAR_HOST', 'localhost'),
            ],
            'database'  => env('DB_WEBINAR_DATABASE', 'forge'),
            'username'  => env('DB_WEBINAR_USERNAME', 'forge'),
            'password'  => env('DB_WEBINAR_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ] ,
	                        $sql = "UPDATE `webinar_tracks` SET `t_end` = '".$this->t_end."',`duration` = TIMESTAMPDIFF(MINUTE,`t_start`,`t_end`) WHERE `id` IN('".$ids."')";
                        \DB::connection('webinar')->update($sql);
config/filesystem.php
        'local_static' => [
			'driver' => 'aliyunoss',
            'key'    => env('OSS_ACCESSKEYID'),
            'secret' => env('OSS_ACCESSKEYSECRET'),
            'endpoint' => env('OSS_ENDPOINT'),
            'bucket' => env('OSS_BUCKET'),
			'root'   => 'upload',
		],
namespace App\Providers;
use Storage;
use League\Flysystem\Filesystem;
use OSS\OssClient;
use App\Core\Aliyun\OssAdapter ;
use Illuminate\Support\ServiceProvider;

class AliyunOssFilesystemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Storage::extend('aliyunoss', function($app, $config)
        {
            $client = new OssClient($config['key'], $config['secret'], $config['endpoint']);

            return new Filesystem(new OssAdapter($client, $config['bucket'], $config['root']));
        });
    }
}
        Storage::disk('local_static')->put($filename, $file);


DB::table('user_onlines')->  \DB::connection('webinar')->table('user_onlines');  UserOnline->where
           $ios_msg = \App\Services\Upload::getUploadFileAddress(\Request::file('ios'),'app_launch','image');
关于这个上传文件的写法
 $file=Input::file("pic");

         $cont=new MenuCont;

         $entension = $file -> getClientOriginalExtension();

         $clientName = $file -> getClientOriginalName();

         $name = md5(date('ymdhis').$clientName).".".$entension;

         $file->move("uploads",$name);

         $cont->fill(Input::all());

         $cont->pic=$name;

         $cont->save();

        return back();
 id 不连续分批处理
 		$webinarMinId = WebinarModel::min('id');
		$webinarMaxId = WebinarModel::max('id');

		while($webinarMinId <= $webinarMaxId){
			$webinserObj = WebinarModel::select($listField)->where('id','>=',$webinarMinId)->take($takeNum)->orderBy('id')->get();
			foreach ($webinserObj as $key => $value) {
				if ($value->type == 3 && $value->auto_record != '1') {
					continue;
				}

				$time = $value['start_time'] == '0000-00-00 00:00:00' ? 1388505601 : strtotime($value['start_time']);
				$sortTime = $value['type'] == 2 ? log($time) / 1000 : 1 - log($time) /1000;
				$sort = $value['type'] + $sortTime;
			}

			$addNum = $webinarMinId + $takeNum;

			$webinarMinId = isset($value->id) ? ($addNum > $value->id ? $addNum : $value->id) : $addNum;

			if (empty($tmpArray)) {
				continue;
			}

			usleep(100000);
		}
	public function fire()
	{
        // 处理拥有者主持人为空的情况
        $dealFile = '';
        $fileName = '/tmp/update_webinar_user_reg.sql';

        $result = \DB::select("SELECT
	`webinars`.user_id, `webinar_user_regs`.`id` AS `reg_id`, webinars.id
FROM
	`webinars`
LEFT JOIN `webinar_user_regs` ON `webinar_user_regs`.`webinar_id` = `webinars`.`id` and role_name = 'host'
WHERE
webinars.id not in (
    select webinar_id from webinar_user_regs where role_name = 'host'
)
AND `webinars`.`deleted_at` IS NULL
AND `webinar_user_regs`.`id` IS NULL");


        foreach($result as $key => $webinarObj) {
            $userRegExist = WebinarUserReg::where('webinar_id', $webinarObj->id)->where('user_id',$webinarObj->user_id)->first();
            if (!empty($userRegExist)) {
                $dealFile .= "update webinar_user_regs set role_name = 'host' where id = ".$userRegExist->id.";\n";
            }

            if ($key%1000 == 0 ){
                file_put_contents($fileName, $dealFile, FILE_APPEND);
                $dealFile = '';
            }
            echo $key ."\n";
        }

        file_put_contents($fileName, $dealFile, FILE_APPEND);
	}

        $lastId = 4085069;
        $take   = 1000;
        $true   = true;
        $i      = 0;
        while($true){
            $i++;
            $list = VodTable::selectRaw('ID,src_ip,aid')->whereRaw('ID >'.$lastId)->orderBy('ID','asc')->take($take)->get()->toArray();
            if(!empty($list) && is_array($list)){
                echo "lastId|".$lastId."|".$i."\n";
                foreach ($list as $row){
                    if(!empty($row['src_ip'])){
                        $ipData = self::geoIp($row['src_ip']);
                        $hostId = $this->_getHostId($row['aid']);
                        $sql = "UPDATE vodtable set host_user_id = ".$hostId.",country='".$ipData['country']."',region='".$ipData['region']."',city='".$ipData['city']."' WHERE ID='".$row['ID']."';\n";
                        file_put_contents($this->file,$sql,FILE_APPEND);
                    }
                    $lastId = $row['ID'];
                }
            }else{
                $true = false;
            }
        }
    /**
     * 同步用户信息
     * 
     */
    protected function actionSync()
    {
        if ($this->option('target') != 'redis') {
            $this->error('Undefined target.');
            return;
        }

        $redis = RedisFacade::connection();

        $usleep = $this->option('usleep');
        $limit = $this->option('size');
        $minId = 0;
        while (true) {
            $userInfos = UserModel::where('id', '>', $minId)
                ->select('id', 'nick_name', 'avatar')
                ->orderBy('id')
                ->take($limit)
                ->get();

            $selectCount = count($userInfos);
            if (!$selectCount) {
                break;
            }

            $redis->pipeline(function($pipe) use($userInfos) {
                foreach ($userInfos as $userInfo) {
                    $pipe->hmset('com:user:info:basic:' . $userInfo['id'], [
                        'uid' => (string)$userInfo['id'],
                        'nick_name' => $userInfo['nick_name'],
                        'avatar' => $userInfo['avatar'],
                    ]);
                }
            });

            if ($selectCount < $limit) {
                break;
            }

            $minId = $userInfos->last()->id;
            unset($userInfos);

            if ($usleep > 0) {
                usleep($usleep);
            }
        }

        $this->info('Done.');
    }

echo  mb_strimwidth ( "Hello World" ,  0 ,  10 ,  "..." );// 输出 Hello W...
    echo  mb_strimwidth ( "中文截取字符串" ,  0 ,  7 ,  "..." );//输出中文...
    // return debug_backtrace();
http://mockbin.com/bin/bbe7f656-12d6-4877-9fa8-5cd61f9522a9/view
$url = 'http://101.201.236.181:8081/ip?ip='.$ip;
        $ret =  Common::curlGetRequest($url);
        if(!empty($ret)){
            $resData = json_decode($ret,true);
            if(!empty($resData) && $resData['ret'] == 'ok'){
                $ipData['country']  = $resData['data'][0];
                $ipData['area']     = $resData['data'][1];
                $ipData['region']   = $resData['data'][1];
                $ipData['city']     = $resData['data'][2];
                $ipData['isp']      = $resData['data'][4];
            }
        }
$database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'test',
        'server' => 'localhost',
        'username' => 'root',
        'password' => null,
        'charset' => 'utf8'
    ]);
    // http://lonewolf.oschina.io/medoo/api/where.html
    /*$database->insert('t1', [
        'c1' => '88',
        'c2' => 'foo@bar.com',
    ]);*/
    $res=$database->select("t1", "*", [
        "c1" => "2"
    ]);
    $res=$database->select("t1", "*", [
    "c1[><]" => [100, 500]
    ]);
    // 你不仅可以用于单个的字符串或数值，也可用于数组
$database->select("t1", "*", [
    "OR" => [ 
        "c1" => [2, 123, 234, 54],
        "c2" => ["foo@bar.com", "cat@dog.com", "admin@medoo.in"]
    ]

$reader = new Reader('GeoIP2-City.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
$record = $reader->city('180.149.132.47');//百度 ip
print_r($record);

City {#1899 ▼
  #city: City {#1908 ▶}
  #location: Location {#1909 ▶}
  #postal: Postal {#1910 ▶}
  #subdivisions: array:1 [▶]
  #continent: Continent {#1902 ▶}
  #country: Country {#1903 ▶}
  #locales: array:1 [▶]
  #maxmind: MaxMind {#1904 ▶}
  #registeredCountry: Country {#1905 ▶}
  #representedCountry: RepresentedCountry {#1906 ▶}
  #traits: Traits {#1907 ▶}
  #raw: array:7 [▼
    "city" => array:2 [▼
      "geoname_id" => 1816670
      "names" => array:8 [▼
        "de" => "Peking"
        "en" => "Beijing"
        "es" => "Pekín"
        "fr" => "Pékin"
        "ja" => "北京市"
        "pt-BR" => "Pequim"
        "ru" => "Пекин"
        "zh-CN" => "北京"
      ]
    ]
    "continent" => array:3 [▼
      "code" => "AS"
      "geoname_id" => 6255147
      "names" => array:8 [▼
        "de" => "Asien"
        "en" => "Asia"
        "es" => "Asia"
        "fr" => "Asie"
        "ja" => "アジア"
        "pt-BR" => "Ásia"
        "ru" => "Азия"
        "zh-CN" => "亚洲"
      ]
    ]
    "country" => array:3 [▼
      "geoname_id" => 1814991
      "iso_code" => "CN"
      "names" => array:8 [▼
        "de" => "China"
        "en" => "China"
        "es" => "China"
        "fr" => "Chine"
        "ja" => "中国"
        "pt-BR" => "China"
        "ru" => "Китай"
        "zh-CN" => "中国"
      ]
    ]
    "location" => array:4 [▼
      "accuracy_radius" => 50
      "latitude" => 39.9289
      "longitude" => 116.3883
      "time_zone" => "Asia/Shanghai"
    ]
    "registered_country" => array:3 [▼
      "geoname_id" => 1814991
      "iso_code" => "CN"
      "names" => array:8 [▼
        "de" => "China"
        "en" => "China"
        "es" => "China"
        "fr" => "Chine"
        "ja" => "中国"
        "pt-BR" => "China"
        "ru" => "Китай"
        "zh-CN" => "中国"
      ]
    ]
    "subdivisions" => array:1 [▼
      0 => array:3 [▼
        "geoname_id" => 2038349
        "iso_code" => "11"
        "names" => array:3 [▼
          "en" => "Beijing"
          "fr" => "Municipalité de Pékin"
          "zh-CN" => "北京市"
        ]
      ]
    ]
    "traits" => array:1 [▼
      "ip_address" => "180.149.132.47"
    ]
  ]
}
CN China 中国 Beijing 11 Beijing 39.9289
"116.3883\n"
composer require 		"vhall/check_picture": "dev-master",
$checkObj = new CheckPicture('7JKcOIySkNC95NEu','s1x47CPbi18yuWF7gt82ysO4prA2gT');
			$result = $checkObj->check($imageUrl);//https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=476277235,3481968713&fm=116&gp=0.jpg
			$result['url'] = $imageUrl;

			if($result && isset($result['rate']) && isset($result['label'])) {
				$webinarExist = WebinarGreenCheck::where('webinar_id',$webinarId)->first();

				if (!empty($webinarExist)) {
					// 只记录最坏情况
					if ($webinarExist['rate'] < $result['rate']) {
						$webinarExist->update($result);
					}
				} else {
					$result['webinar_id'] = $webinarId;
					WebinarGreenCheck::create($result);
				}

				if ($result['label'] == 1) {
					$content = '发现黄色视频，活动ID为'.$webinarId.' 图片地址为'.$imageUrl;

```
[为什么选择本书学习PHP](http://phpbook.phpxy.com/33183)
[vpn 翻  墙](http://www.fkwall.com/)
[PHP代码规范与质量检查工具PHPCS,PHPMD的安装与配置](https://www.phpxy.com/article/3.html)
```js
composer global require phpmd/phpmd composer global require "squizlabs/php_codesniffer=*"
$  phpcs --report=summary downloadexcel.php

PHP CODE SNIFFER REPORT SUMMARY
--------------------------------------------------------------------------------

FILE                                                            ERRORS  WARNINGS

--------------------------------------------------------------------------------

D:\soft\wamp\www\downloadexcel.php                              51      5
--------------------------------------------------------------------------------

A TOTAL OF 51 ERROR(S) AND 5 WARNING(S) WERE FOUND IN 1 FILE(S)
--------------------------------------------------------------------------------


Time: 1 second, Memory: 2.50Mb


vhalllsp@VHALLLSP-PC /d/soft/wamp/www
$ phpcs downloadexcel.php --standard=PSR2
ERROR: the "PSR2" coding standard is not installed. The installed coding standar
ds are MySource, PEAR, PHPCS, Squiz and Zend

vhalllsp@VHALLLSP-PC /d/soft/wamp/www
$ phpcs downloadexcel.php

FILE: D:\soft\wamp\www\downloadexcel.php
--------------------------------------------------------------------------------

FOUND 51 ERROR(S) AND 5 WARNING(S) AFFECTING 40 LINE(S)
--------------------------------------------------------------------------------

   1 | ERROR   | End of line character is invalid; expected "\n" but found
     |         | "\r\n"
   1 | ERROR   | Missing file doc comment
   3 | WARNING | Line exceeds 85 characters; contains 153 characters
 178 | WARNING | Line exceeds 85 characters; contains 115 characters
 179 | ERROR   | Doc comment for var [ UNKNOWN ] does not match actual variable
     |         | name &$data at position 1
 179 | ERROR   | Missing parameter name at position 1
 179 | ERROR   | Missing comment for param "[ UNKNOWN ]" at position 1
 179 | ERROR   | There must be exactly one blank line before the tags in
     |         | function comment
 180 | ERROR   | Last parameter comment requires a blank newline after it
 180 | ERROR   | The variable names for parameters UNKNOWN (1) and [ UNKNOWN ]
     |         | (2) do not align
 180 | ERROR   | Doc comment for var [ UNKNOWN ] does not match actual variable
     |         | name $fields at position 2
 180 | ERROR   | Missing parameter name at position 2
 180 | ERROR   | Missing comment for param "[ UNKNOWN ]" at position 2
 183 | ERROR   | Opening brace should be on a new line
 186 | WARNING | Line exceeds 85 characters; contains 142 characters
 187 | ERROR   | Opening parenthesis of a multi-line function call must be the
     |         | last content on the line
 190 | ERROR   | Expected "if (...) {\n"; found "if(...){\n"
 190 | ERROR   | There must be a single space between the closing parenthesis
     |         | and the opening brace of a multi-line IF statement; found 0
     |         | spaces
 192 | ERROR   | Expected "} else {\n"; found "}else{\n"
 207 | ERROR   | Closing parenthesis of a multi-line function call must be on a
     |         | line by itself
 210 | ERROR   | Spaces must be used to indent lines; tabs are not allowed
 210 | ERROR   | Doc comment for "$filename" missing
 212 | ERROR   | Missing @return tag in function comment
 213 | ERROR   | Function name "export_csv" is prefixed with a package name but
     |         | does not begin with a capital letter
 213 | ERROR   | Line indented incorrectly; expected 0 spaces, found 4
 225 | ERROR   | Spaces must be used to indent lines; tabs are not allowed
 226 | ERROR   | Spaces must be used to indent lines; tabs are not allowed
 226 | ERROR   | Line indented incorrectly; expected 0 spaces, found 2
 227 | ERROR   | Spaces must be used to indent lines; tabs are not allowed
 228 | ERROR   | Closing brace indented incorrectly; expected 2 spaces, found 8
 229 | ERROR   | Line indented incorrectly; expected 0 spaces, found 8
 232 | ERROR   | Line indented incorrectly; expected 4 spaces, found 12
 233 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 234 | WARNING | Line exceeds 85 characters; contains 148 characters
 237 | ERROR   | Line indented incorrectly; expected 4 spaces, found 12
 243 | ERROR   | Line indented incorrectly; expected 0 spaces, found 8
 247 | ERROR   | Line indented incorrectly; expected 0 spaces, found 8
 248 | ERROR   | Line indented incorrectly; expected 4 spaces, found 12
 250 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 252 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 258 | ERROR   | Line indented incorrectly; expected 0 spaces, found 8
 265 | ERROR   | Line indented incorrectly; expected 0 spaces, found 8
 266 | ERROR   | Expected "if (...) {\n"; found "if(...){\n"
 266 | ERROR   | Line indented incorrectly; expected 4 spaces, found 12
 266 | ERROR   | There must be a single space between the closing parenthesis
     |         | and the opening brace of a multi-line IF statement; found 0
     |         | spaces
 269 | WARNING | Line exceeds 85 characters; contains 94 characters
 270 | ERROR   | Line indented incorrectly; expected 4 spaces, found 12
 271 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 272 | ERROR   | Line indented incorrectly; expected 12 spaces, found 20
 274 | ERROR   | Expected "} elseif (...) {\n"; found "} elseif(...) {\n"
 274 | ERROR   | Line indented incorrectly; expected 12 spaces, found 20
 277 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 279 | ERROR   | No space found after comma in function call
 281 | ERROR   | Line indented incorrectly; expected 8 spaces, found 16
 285 | ERROR   | No space found after comma in function call
 285 | ERROR   | No space found after comma in function call
--------------------------------------------------------------------------------


Time: 1 second, Memory: 2.50Mb

$ phpcbf downloadexcel.php  --suffix=.fixed

PHPCBF RESULT SUMMARY
----------------------------------------------------------------------
FILE                                                  FIXED  REMAINING
----------------------------------------------------------------------
D:\soft\wamp\www\downloadexcel.php                    57     16
----------------------------------------------------------------------
A TOTAL OF 57 ERRORS WERE FIXED IN 1 FILE
----------------------------------------------------------------------

Time: 5.36 secs; Memory: 5Mb https://github.com/overtrue/phpmd-rulesets
```
自定义server
```js
 app\Providers\ResponseMacroServiceProvider.php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /** 
     * Bootstrap the application services.
     */
    public function boot()
    {   
        Response::macro('jsonOutput', function ($data, $code = 200, $msg = 'success') {
            return Response::json(['code' => $code, 'msg' => $msg, 'data' => $data]);
        });
        Response::macro('jsonError', function ($code = 400, $msg = 'error', $data = []) {
            return Response::json(['code' => $code, 'msg' => $msg, 'data' => $data]);
        });
    }   

    /** 
     * Register the application services.
     */
    public function register()
    {   
        //
    }   
}

config/app.php

'providers'=>['App\Providers\ResponseMacroServiceProvider',]

return response()->jsonOutput($chartData);
```
[自定义md5加密](https://laravel-china.org/topics/3415/laravel-control-inversion-and-facade-mode-concept)
```js
>>> \App::make('hash')->make('123456')
=> "e10adc3949ba59abbe56e057f20f883e"
>>> \Hash::make('123456')
=> "e10adc3949ba59abbe56e057f20f883e"
>>> md5('123456')
=> "e10adc3949ba59abbe56e057f20f883e"
<?php

namespace Illuminate\Support\Facades;

/**
 * @see \Illuminate\Hashing\BcryptHasher
 */
class Hash extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hash';
    }
}

<?php

namespace App\Providers\Hashing;

use Illuminate\Support\ServiceProvider;

class Md5ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('hash', function () { return new Md5Hasher(); });
    }
}
<?php

namespace App\Providers\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Md5Hasher implements HasherContract
{
    /**
     * Hash the given value.
     *
     * @param string $value
     * @param array  $options
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function make($value, array $options = array())
    {
        $md5 = md5($value);

        return $md5;
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param string $value
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function check($value, $hashedValue, array $options = array())
    {
        return md5($value) === $hashedValue ? true : false;
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = array())
    {
        return false;
    }
}

config/app.php
'providers'=>['App\Providers\Hashing\Md5ServiceProvider',]
'Hash'      =>[ 'Illuminate\Support\Facades\Hash'],

```


[php ngrok natapp.cn 内网穿透服务 PHP 版](https://github.com/dosgo/ngrok-php/blob/master/natapp.php#L34)
[shadowsocks](https://github.com/breakwa11/shadowsocks-rss)
[Shadowsocks各平台客户端使用方法](http://muye.me/archives/101.html)
[php中浮点数位数截取性能大比拼](https://helei112g.github.io/2017/02/16/PHP%E4%B8%AD%E6%B5%AE%E7%82%B9%E6%95%B0%E4%BD%8D%E6%95%B0%E6%88%AA%E5%8F%96%E6%80%A7%E8%83%BD%E5%A4%A7%E6%AF%94%E6%8B%BC/)
```js
如果用户的订单价格是：6.666元，那么在向支付宝或者微信发起支付时，第三方只会保留两位数，也就是用户实际付款：6.66元。

那么问题来了，支付成功第三方回调系统接口，在接口中的逻辑需要比对支付的金额，会发现 6.666≠6.66，然后后面的逻辑无法运行，处理失败
number_format — 以千位分隔符方式格式化一个数字
round — 对浮点数进行四舍五入 (通过传入第三个参数，可以控制舍、入的方式)
sprintf — Return a formatted string
bcadd — 2个任意精度数字的加法计算
    number_format(10000, 2, '.', '');sprintf('%.2f',$num)
所以通过对比，推荐使用 sprintf 来处理浮点数位数的问题。
同步通知不做服务端的更新，可用于客户端的显示，异步收到通知时才做相关的更新处理。原因有三：

并不是所有的支付模块都有同步通知这个概念；
同步通知的参数在url中，就算采用https协议，也存在更大被篡改的风险；
异步通知提供完整的失败重发机制，更值得信耐。
```
[PHP设计模式：模板方法真的很有用](https://helei112g.github.io/2016/09/09/PHP%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F%EF%BC%9A%E6%A8%A1%E6%9D%BF%E6%96%B9%E6%B3%95%E7%9C%9F%E7%9A%84%E5%BE%88%E6%9C%89%E7%94%A8/)
```js
将具体的一些实现延迟到子类，可以减少父类初始化的压力
父类只定义调用步骤，具体每一步的实现由子类自己决定
这样的结构利用了一种反射的思路，由父类来调用子类的具体实现方法
很好的进行了代码的复用
abstract class AbstractClass {
 
    /**
     * 顶层组织逻辑的方法
     */
    public function method() {
        $this->primitiveOperation1();
        $this->primitiveOperation2();
    }
 
    /**
     * 基本方法1
     */
    abstract protected function primitiveOperation1();
 
     /**
     * 基本方法2
     */
    abstract protected function primitiveOperation2();
}


class ConcreteClass extends AbstractClass{
    /**
     * 基本方法1
     */
    protected function primitiveOperation1() {
        echo 'primitiveOperation1<br />';
    }
 
     /**
     * 基本方法2
     */
    protected function primitiveOperation2(){
        echo 'primitiveOperation2<br />';
    }
}
(new ConcreteClass)->method();
if(count($array) == count($array, 1)){
　　echo '一维数组';
}else{
　　echo '多维数组';
}
模拟来源

curl_setopt($ch, CURLOPT_REFERER, '来源');

模拟ip

curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP: 模拟ip','X-FORWARDED-FOR: 模拟ip'));
```
[谈谈php依赖注入和控制反转](http://www.cnblogs.com/phpper/p/6716375.html)
```js
class Ioc {
/**
* @var 注册的依赖数组
*/
  
  protected static $registry = array();
  
  /**
  * 添加一个resolve到registry数组中
  * @param string $name 依赖标识
  * @param object $resolve 一个匿名函数用来创建实例
  * @return void
  */
  public static function register($name, Closure $resolve)
  {
   static::$registry[$name] = $resolve;
  }
  
  /**
   * 返回一个实例
   * @param string $name 依赖的标识
   * @return mixed
   */
  public static function resolve($name)
  {
    if ( static::registered($name) )
    {
     $name = static::$registry[$name];
     return $name();
    }
    throw new Exception('Nothing registered with that name, fool.');
  }
  /**
  * 查询某个依赖实例是否存在
  * @param string $name id
  * @return bool 
  */
  public static function registered($name)
  {
   return array_key_exists($name, static::$registry);
  }
}
class Book {
  private $db_conn;
  
  public function setdb($db_conn) {
    echo $db_conn;
  }
}
$book = Ioc::register('book', function(){
$book = new Book;
$book->setdb('mysql');
 
return $book;
});
  
//注入依赖
$book = Ioc::resolve('book');
```

[优化php性能的一点总结](http://www.cnblogs.com/phpper/p/6613863.html)
[xhprof安装&&使用](http://www.cnblogs.com/bluefrog/archive/2012/03/01/2374922.html)
[Swoole入门指南：PHP7安装Swoole详细教程（一）](https://helei112g.github.io/2017/02/08/Swoole%E5%85%A5%E9%97%A8%E6%8C%87%E5%8D%97%EF%BC%9APHP7%E5%AE%89%E8%A3%85Swoole%E8%AF%A6%E7%BB%86%E6%95%99%E7%A8%8B%EF%BC%88%E4%B8%80%EF%BC%89/)
[如何实现PHP版本共存](https://segmentfault.com/q/1010000010252140)
```js
配置下让Nginx监听不同的端口或文件就可以实现了。大体思路如下：因为Nginx是通过PHP-FastCGI与PHP交互的，然后，PHP-FastCGI运行后会通过文件、或本地端口两种方式进行监听，在Nginx中配置相应的FastCGI监听端口或文件即实现Nginx请求对PHP的解释。因此，Nginx中根据需求配置调用不同的PHP-FastCGI端口或文件，便实现不同版本PHP共存了。

修改php-fpm.conf，监听端口：
http://elk.vhallops.com/app/kibana
<value name="listen_address">127.0.0.1:8001</value>
或者

<value name="listen_address">/path/to/unix/socket</value>
修改好后，配置好php.ini相关的参数后重启一下然后，再修改Nginx

location ~ .*.(php|php5)?$
    {
      fastcgi_pass 127.0.0.1:8001;
      fastcgi_index index.php;
      include fcgi.conf;
    }
就可以通过监听不同端口来实现，不同版本的php-fpm调用了
mysql：如果一个结果集里包含另一个结果集，就显示1 否则显示0https://segmentfault.com/q/1010000010150767
select 
  t.name,
  if((select count(*) from l where l.name = t.name)> 0, 1, 0)
from t
表关联的方式，在大数据的时候效率会更高一些

select 
  t.name,
  IFNULL(t2.cnt, 0)
from t left join (
  select name, 1 as cnt
  from l
  group by name
) t2 on t.name = t2.name
Python中如何禁止导入某个模块https://segmentfault.com/q/1010000010221186
import sys
blacklist = ['os','datetime']
for mod in blacklist:
    i = __import__(mod)
    sys.modules[mod] = None
   
# 尝试导入模块
import os
import datetime
把博客托管在 github 无法访问https://segmentfault.com/q/1010000010264567

GitHub Pages有两种用法：
如果你的仓库名为用户名.github.io的话，会自动开启GitHub Pages功能，且所有提交到master分支的代码，会当做网站内容被挂载起来，且网站访问地址为http://用户名.github.io
另外一种方法参见：https://help.github.com/artic...
第二种用法，可以手动指定一个仓库的master分支，或者master分支下的/docs目录，或者gh-pages分支为网站的根目录，其下的内容为网站内容，此方法需要在仓库设置里手动开启GitHub Pages功能，并指定网站挂载方式
用第二种方法的话，挂载之后的服务器地址，在设置之后会显示在后台，具体操作步骤可以参见：https://segmentfault.com/q/1010000009847036/a-1020000009849681
然而，根据你现在的这个情况，并不属于上面任何一种情况，你创建的是你用户名下的名为github.io的仓库，并非用户名下名为用户名.github.io的仓库，所以不会自动开启GitHub Pages；而且在这情况下，你也没有在后台手动开启GitHub Pages，因此线上的GitHub Pages站点是无法访问的
crontab 每 16 分钟运行一次 的执行计划https://segmentfault.com/q/1010000010290756
 crontab */16 * * * * 是从加入执行计划时间开始，每16分钟运行一次

实际执行计划其实是每小时的 0分，16分，32分，48分执行的。。。
用15条crontab做到: 16分和60分的最小公倍数是240
于是我特意在http://tool.lu/crontab/测试了一下
$template='您好，欢迎注册[ce2]，您的验证[fong1]码为{value}，重复一次，验证码为{value}，谢谢。';
$template='册[ce2]';
$template=preg_replace_callback('/([\x{4e00}-\x{9fa5}]\[(.*)\])/u',function ($match) use ($template){
var_dump($match);
},$template);

php --ini

查看cli的配置文件位置

Loaded Configuration File:         /etc/php.ini

进入页面phpinfo();

Loaded Configuration File    /etc/php.ini

看下web的php的配置文件位置

这个原因可能是cli模式和web模式使用的php.ini配置文件不是同一个引起的
端口在系统中是唯一的 http://IP:端口 IP就如同大楼 端口如果门牌号

所以可以肯定问题的答案: 同一台主机上不能配置多个80端口的服务, 一个端口只能对应一系统上的一个服务.

如果你是想运行多个WEB项目的话，可以通过虚拟主机来解决

A项目 => a.xxx.com

B项目 => b.xxx.com
redis库存控制问题https://segmentfault.com/q/1010000010217722
两种方案：
1、redis中的库存在网站上线前初始化到redis中，保证缓存不过期。
2、当redis中的缓存过期了，用行锁的方式读取数据库中的库存并写入到redis中。

第一种是比较好的解决方案。第二种因为用到了数据库行锁，所以效率比较差。

最优方案是，前端减库存以队列方式发到队列中，后端再依次处理队列中的请求实际减库存。
分布式锁 如：redis锁 set('key', 'value', ['nx', 'ex'=>10])

PHP是不需要redis扩展的，在laravel下安装predis/predis就足够了 只不过predis是用PHP写的扩展

PHP 使用的socket与redis通讯 所以无需扩展
laravel默认使用的是predis，也是可以使用phpredis[是用C写的扩展][https://github.com/phpredis/phpredis]，可以通过修改配置。记得laravel 文档中说：如果对速度有要求，用phpredis性能会提升很多
https://segmentfault.com/q/1010000010234381    mysql如何分组取top10？
select 起始时间,线路,进站总人数 
from (
select @gn:=case when @起始时间=起始时间 then @gn+1 else 1 end gn,@起始时间:=起始时间 起始时间,线路,进站总人数 from (
select 起始时间,线路,sum(进站人数) 进站总人数
from roadnet_monitor_flowdata2
group by 起始时间,线路) aa,(select @gn:=1) bb
order by 起始时间,进站总人数 desc) aaa
where gn<=10;

只展示具有相同typenum的这些标题内容的话，就用下面的

select a.title,a.content from lv_content a join (select typenum,count(1) cc from lv_content group by typenum having cc>1) b on a.typenum=b.typenum;
怎么连表查订单列表和其操作记录https://segmentfault.com/q/1010000010206579

select o.*, ol.id log_id, ol.message, ol.time log_time  from 
`order` o left join `order_log`  ol on ol.`orderId` = (
select MAX(ol.id) from `order_log` ol where ol.orderId = o.id
);
https://segmentfault.com/q/1010000010209593 
laravel driver 应该是pdo或者mysql吧，pdo_mysql不支持这样写吧
Laravel中使用ajax方式登录如何实现登录成功跳转页面？
$.post(_url, _data, function(res){
    
    // 成功
    if (res.errno == 0)
    {
        location.href = res.url;
    }
    else
    {
        // 提示错误消息
        console.log(res.errmsg);
    }
// 路由
route::any('input', 'YourController@input')

// 测试方法
public function input(Request $request)
{
    // get方法
    echo $request->get('id');
    // get方法
    echo $request->query('id');
    // get方法
    echo $request->query->get('id');
    // 有post会覆盖get improve by amu(题主)
    echo $request->id;
    // 有post会覆盖get
    echo $request->input('id');
}一般情况下，如果post／get键名一样，post过来的数据，$request->xxx和$request->input('xxx')会覆盖掉get的取值。https://segmentfault.com/q/1010000010235547
按照指定区间进行分组https://segmentfault.com/q/1010000010262775
from itertools import groupby

data = [10,11,23,14,45,23,4,5,20,34,29,42,52,7,57]
data.sort()

for k, g in groupby(data, key=lambda x: (x - 1) / 11):
    print '{}-{}'.format(k * 11, (k + 1) * 11), list(g)
    
#得出的结果应该是：
0-11  [4, 5, 7, 10, 11]
11-22 [14, 20]
22-33 [23, 23, 29]
33-44 [34, 42]
44-55 [45, 52]
55-66 [57]
Python 发送邮件模块的封装https://github.com/hezhiming/hezhiming.github.io/issues/24
from __future__ import absolute_import, unicode_literals
from envelopes import Envelope, SMTP

# 这一组常量, 可以单独用 enum 管理
FROM_ADDR = ""
FROM_ADDR_PASSWORD = ""
SMTP_SERVER = ""
SMTP_PORT = ""

class MailUtils(object):
    @classmethod
    def send_mail(cls, mail_body, subject, from_addr, to_addrs, cc_addrs, attachments, headers=None):  #这里的参数组织顺序, 看个人喜好
        """发送邮件

        :param mail_body: 邮件mail body(默认html格式)
        :param subject: 主题
        :param from_addr: 发件人( 最好的格式: ("xxx@xx.com", "nick name")  )
        :param to_addrs: 收件人列表
        :param cc_addrs: 抄送人列表
        :param attachments: 附件列表, 基本是文件路径名
        :param headers: 额外的邮件头
        :return:
        """
        
        envelope = Envelope(
            from_addr=from_addr,
            to_addr=to_addrs,
            subject=subject,
            html_body=mail_body,
            cc_addr=cc_addrs or None
        )

        if headers is not None:
            for header_key, header_value in headers:
                envelope.add_header(header_key, header_value)

        for attachment in attachments:
            envelope.add_attachment(attachment)

        server = SMTP(
            host=SMTP_SERVER,
            port=SMTP_PORT,
            login=FROM_ADDR,
            password=FROM_ADDR_PASSWORD,

            tls=True,
            timeout=10
        )

        server.send(envelope)
import pandas as pd

df = pd.DataFrame(in_cnt)
df.to_csv('a.txt')  如果觉得Anaconda太大, 安装很多不必要的包, 那么你可以选择miniconda/
https://segmentfault.com/a/1190000006053618
https://github.com/shangheguang/alipay_php  https://github.com/shangheguang/weixinpay APP支付宝
https://segmentfault.com/q/1010000010261608
有没有PHP zip压缩的类支持 zip 加密的类https://segmentfault.com/q/1010000010279519

$cmd = "cd /home/wwwroot/test; zip -q -r -P 123456 sss.zip aaa.txt";
$a = exec($cmd); https://github.com/Ne-Lexa/php-zip
用phpmailer类开发邮件发送https://segmentfault.com/q/1010000010285504
get_defined_vars() 可以获得当前上下文中所有定义的变量，转换成一个和符号表差不多的数组，把这个数据传到函数里就行。稍加处理再配上extract()，简直是完美的解决方法  https://segmentfault.com/q/1010000010279775 
PHP接口大总结
php写android和ios的接口https://segmentfault.com/q/1010000010267846
多个数组处理 当date和customer的值一样 求和https://segmentfault.com/q/1010000010266486
https://segmentfault.com/q/1010000010266651
https://segmentfault.com/q/1010000010264534 
正则匹配日期https://segmentfault.com/q/1010000010226432
PHP如何动态传入参数https://segmentfault.com/q/1010000010264534
移动app与服务器端进行身份认证https://segmentfault.com/q/1010000010242689
https://segmentfault.com/q/1010000010223638  php 使用use 和直接传参的区别
实现同一个账户只能在一个地方登录？如果已经在其他地方登录，将其踢出登录。https://github.com/zhangrenjie/single_account_only_login  https://segmentfault.com/q/1010000010215796   https://segmentfault.com/q/1010000010032189
三元运算符结合方向的问题： 
java 从右向左。等效于3<8?(9<6?7:5):(2>0?4:1)
php 从做向右。等效于(3<8?(9<6?7:5):2)>0?4:1
```




[使用PHP_XLSXWriter代替PHPExcel](https://segmentfault.com/a/1190000010178094)
```js
https://github.com/mk-j/PHP_XLSXWriter  http://www.mysqltutorial.org/mysql-delete-join/ 火车票 https://github.com/protream/tickets  https://github.com/jkchao/books  https://github.com/yuanliangding/books  getproxy 是一个抓取发放代理网站pip install getproxy
```
[PHP 该多维数组如何递归循环](https://segmentfault.com/q/1010000010304022)
```js
<?php


$arr = [
    [
        'id' => 1,
        'children' => [
            'id' => 2,
            'children' => [
                'id' => 3,
                'children' => [
                    'id' => 4
                ]
            ]
        ]
    ],
    [
        'id' => 5,
        'children' => [
            'id' => 6,
        ]
    ],
    [
        'id' => 7
    ]
];

function pushChild($children, &$container) 
{
    $container[] = $children['id'];
    if (! isset($children['children'])) {
        return;
    }
    pushChild($children['children'], $container);
}

$arr2 = [];

foreach ($arr as $item) {
    $result = [];
    pushChild($item, $result);
    $arr2[] = $result;
}

var_dump($arr2); 
$arr2 = [
    [1,2,3,4],
    [5,6],
    [7]
];
```
[优雅的重试功能。](https://www.zhihu.com/question/24590883/answer/201698987)
```js
from tenacity import retry, stop_after_attempt@retry(stop=stop_after_attempt(3))def extract(url):    info_json = requests.get(url).content.decode()    info_dict = json.loads(info_json)    data = info_dict['data']    save(data)


 
```


[numpy和pandas入门](https://zhuanlan.zhihu.com/p/27624814)
 [A chatbot in wxpy for wechat group chats](https://github.com/locoda/connector-wechat-bot.git)
[微信的语音聊天记录可以从手机提取出来保存到PC](https://www.zhihu.com/question/19909162/answer/80640430)
https://link.zhihu.com/?target=https%3A//github.com/alexyangfox/wechat_silk/tree/master  http://mindstore.io/mind/13191/
[从零开始写Python爬虫 --- 爬虫应用： 12306火车票信息查询](https://zhuanlan.zhihu.com/p/27969976)
```js
'''
获取12306城市名和城市代码的数据 在终端输入： python3 parse_stations.py >> stations.py
文件名： parse_station.py
'''
import requests
import re

#关闭https证书验证警告
requests.packages.urllib3.disable_warnings()
# 12306的城市名和城市代码js文件url
url = 'https://kyfw.12306.cn/otn/resources/js/framework/station_name.js?station_version=1.9018'
r = requests.get(url,verify=False)
pattern = u'([\u4e00-\u9fa5]+)\|([A-Z]+)'
result = re.findall(pattern,r.text)
station = dict(result)
print(station)
```
[70个Python练手项目列表](https://zhuanlan.zhihu.com/p/27931879)
[Python中list()方法的疑问](https://segmentfault.com/q/1010000010305364)
list()构造函数通过可以传递iterable对象. 而string就是 iterable.  至于reverse()对列表操作, 本身返回值是 none. 因为 list 是 mutable 对象(可变对象), 对可变对象进行操作, Python 中大多数会对其本身进行操作, 返回值为 none
[PHP 最佳实践之数据库](https://laravel-china.org/articles/5330/php-database-of-best-practices)
```js
//把预处理语句获得的结果当成关联数组处理
$sql = 'SELECT id, email FROM users WHERE email = :email';
$statement = $pdo->prepare($sql);
$email = filter_input(INPUT_GET, 'email');
$statement->bindValue(':email', $email);
$statement->execute();
//迭代结果
while(($result = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
echo $result['email'];
}
cat .git/config 查看是否已经设置忽略文件权限跟踪，filemode=true 的时候即跟踪修改权限的文件 。 git config core.filemode false
在 启动队列时，最好是指定 tries 的值，同时 在 定义job 中 添加 failed 方法来 处理 队列失败时 的操作

php artisan queue:work redis --tries=3
 public function failed(Exception $exception)
    {
        // 给用户发送失败通知，等等...
    }
    优雅地在 Mac+Valet 环境下本地部署 PHPHubhttps://laravel-china.org/articles/5316/gracefully-deploying-phphub-locally-in-a-macvalet-environment
     windows下听说有一个Laragon和Mac下的Valet差不多
    Chrome 修改 user agent 简单模拟微信内置浏览器https://laravel-china.org/articles/5319/chrome-modify-user-agent-simple-simulation-of-wechats-built-in-browser
    快马加鞭使用 certbot 为你的网站免费上 https https://laravel-china.org/articles/5266/the-use-of-certbot-at-top-speed-for-your-website-for-free-on-https
 wget https://dl.eff.org/certbot-auto
chmod a+x certbot-auto
service nginx stop
./certbot-auto certonly --standalone --email `你的邮箱地址` -d `你的域名地址`

tree /etc/letsencrypt/live/
 # TLS 基本设置
ssl_certificate /etc/letsencrypt/live/www.just4fun.site/fullchain.pem;#证书位置
ssl_certificate_key /etc/letsencrypt/live/www.just4fun.site/privkey.pem;# 证书位置
service nginx start
 ss免费账号https://github.com/Alvin9999/new-pac/wiki/ss%E5%85%8D%E8%B4%B9%E8%B4%A6%E5%8F%B7
 最好的GitHub代码浏览插件https://juejin.im/entry/597025d9518825419f7b65ba
chrom商店里 搜索 就可以了 php offline manual
http://cn.office-converter.com/  https://smallpdf.com/ http://www.ilovepdf.com/ PDF、WORD、PPT、TXT转换方法 强大的OCR和PDF处理软件：ABBYY FineReader，可识别图片上的文字 http://ocr.abbyy.cn/  https://uzer.me/ 直接在线使用包括office、PS、SPSS、CAD等等各种大型软件
一个自动更新chrome的小工具 http://chrome.wbdacdn.com/
为预防「重大突发事件」下断网的情况，给大家推荐一款 app 吧：FireChat
http://zh.wikihow.com/%E9%A6%96%E9%A1%B5  安利一个超级强大的干货搜索引擎
这是一条知乎优秀回帖大集合，赞同数在1000以上的问答。http://weibo.com/5823997358/Fd5Z54Op4
https://www.apowersoft.cn/video-download-capture 视频下载王 https://www.apowersoft.cn/online-video-downloader
http://127.0.0.1:43110/1FRQLoQqnAziCyhmAp8Ev3sVNNkcS1hXYT/
免费全平台的文件分享利器：SendAnywhere  https://sspai.com/post/40047
https://gitlab.com/kornelski/babel-preset-php.git  PHP语法转JS
PHP 命令行工具框架 Laravel Zerohttps://github.com/nunomaduro/laravel-zero/blob/stable/readme.md 推荐一个有效存储和展示自己 PGP
永远都不要看轻自己，马云、李嘉诚、王健林、马化腾，还有你，你们5个人的资产加起来，足以撼动整个亚洲甚至全世界的经济体系。 ​​​​在电脑之间传文件的命令行工具，支持主流操作系统 https://github.com/warner/magic-wormhole/blob/master/README.md
微信号「一分钟的编程知识」
http://www.bilibili.com/video/av3504428/index_1.html#page=1 神速学会视频剪辑，up主必备Premiere技能 doyoudo.com  科普一下短信报警，编辑信息发送到12110即可http://weibo.com/1756672641/Fcu3Shhui
《Go入门指南》https://github.com/Unknwon/the-way-to-go_ZH_CN  非常强大的应用：Office Lens Modern task runner for PHPhttp://robo.li/
set names utf8b4 程序员应该掌握的10个搜索技巧http://www.codeceo.com/article/10-search-tips-for-programmer.html 《nginx从入门到精通PDF》http://pan.baidu.com/s/1o6KCn7W?
0xbug写的一个GitHub 泄露监控系统 https://github.com/0xbug/Hawkeye
微信公众号----软件编程之路 random_int() 在php用这个函数 windows下听说有一个Laragon和Mac下的Valet差不多 微信公众号：Jimmy的技术乐园
```
[PHP系列总结](https://github.com/xx19941215/webBlog)
[swoole 服务端120行代码构建一个websocket 聊天室](https://segmentfault.com/a/1190000010247505)
https://github.com/buffge/buffchat http://www.bilibili.com/video/av12418026/ 
[我是怎么做App token认证的](http://blog.githuber.cn/posts/3018)
基于 ItChat 开发的机器人https://github.com/PY-Learning/wbot
[ ROT13 密码算法](https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650367149&idx=1&sn=5b9bc4a8029e7eb9b8a4b71d06524da9&chksm=be9cdff989eb56ef143d5b03fab7e825f08ea6a96d041aa1da50e78e765a75e60d49b42d9bf6&mpshare=1&scene=1&srcid=0721yrbY93iVEEROCSr1bWdN&pass_ticket=nibRL4OOwqqlqGUBQ8mnsaXsv6niSYSnG%2BPhy3uP%2BvD3386ssTy5UjDfLlo6aNGq#rd)
```js
d = {}
for c in (65, 97):
    for i in range(26):
        d[chr(i+c)] = chr((i+13) % 26 + c)

print("".join([d.get(c, c) for c in s]))
ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
                | |
NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm
它是凯撒加密的一种变体。一段文字按照字母顺序只需把当前字母用13位之后的对应字母进行替代，超过第13位的字母（从N开始）则重新绕回到字母表的开头即可。而对于非字母字符还是保持原样不变。
正向代理的过程，它隐藏了真实的请求客户端，服务端不知道真实的客户端是谁，客户端请求的服务都被代理服务器代替来请求，科学上网工具 Shadowsocks 扮演的就是典型的正向代理角色。在天朝访问 www.google.com 时会被无情的墙掉，要想翻越这堵墙，你可以在国外用 Shadowsocks 来搭建一台代理服务器，代理帮我们请求 www.google.com，代理再把请求响应结果再返回给我 「正向代理」代理的对象是客户端，「反向代理」代理的对象是服务端https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650366790&idx=1&sn=3b5d390d07445745e067334365873a18&chksm=be9cd81289eb510499dd029f91a302a2e08f0c4bbed13c7a47d33d2f1b6a91eebc6199b141b9&scene=21#wechat_redirect 
bytes 类型提供的操作和 str 一样，支持分片、索引、基本数值运算等操作。但是 str 与 bytes 类型的数据不能执行 + 操作
encode 负责字符到字节的编码转换。默认使用 UTF-8 编码准换。
>>> c = b'a'
>>> s = "Python之禅"
>>> s.encode()
b'Python\xe4\xb9\x8b\xe7\xa6\x85'
>>> s.encode("gbk")
b'Python\xd6\xae\xec\xf8'
>>> b'Python\xe4\xb9\x8b\xe7\xa6\x85'.decode()
'Python之禅'
>>> b'Python\xd6\xae\xec\xf8'.decode("gbk")
'Python之禅'  print(keyword.kwlist)
if 18 < age < 60:
    print("yong man")
    >>> payload = {'key1': 'value1', 'key2': 'value2'}
>>> r = requests.post("http://httpbin.org/post", json=payload)
>>> r.json() 作为 json 格式的字符串格式传输给服务器
{'url': 'http://httpbin.org/post', 'files': {}, 'data': '{"key2": "value2", "key
1": "value1"}', 'args': {}, 'form': {}, 'headers': {'Host': 'httpbin.org', 'Cont
ent-Type': 'application/json', 'User-Agent': 'python-requests/2.13.0', 'Accept':
 '*/*', 'Connection': 'close', 'Content-Length': '36', 'Accept-Encoding': 'gzip,
 deflate'}, 'json': {'key2': 'value2', 'key1': 'value1'}, 'origin': '36.102.227.
115'}
content 是 byte 类型，适合直接将内容保存到文件系统或者传输到网络中
```
[Mysql 数据类型隐式转换规则](http://blog.githuber.cn/posts/2893)
mysql> explain select * from convert_test where areacode=0001 and period>='20170511' and period<='20170511';
[关于JavaScript调试的十来个小Tips](https://www.shiyanlou.com/questions/4275)
你可以在JavaScript代码中加入一句debugger;来手工造成一个断点效果
console.trace就要起作用咯，它可以帮你进行函数调用的追踪
mointor(func)在Chrome中可以监测指定函数的调用情况以及参数

在console中使用debug(funcName)然后脚本会在指定到对应函数的地方自动停止
[python模拟http请求遇到的一个坑 ](https://www.testwo.com/article/1002)
使用python做接口测试同学如果在遇到参数中是json那就绕行requests模块，有时候看似好模块库反而容易出问题
透传的ctx参数是一个json格式  通过curl 请求就是正常的，经过一番折腾原来requests模块自动给url 做了encode编码才造成如此现象，解码后恢复正常json串，要不后台改要不我找其他解决办法,后台不能改，所以只能找其他办法更换python请求的api 更换urllib2，urllib2不会主动对url进行编码，如果你想给url编码自己调用：urllib.encode（）方法
>>> r = requests.get("http://httpbin.org/get", params='{"a":2}')
>>> r.url
'http://httpbin.org/get?%7B%22a%22:2%7D'
[PHP红包算法](https://segmentfault.com/a/1190000010210451)
```js
/*
 * 获取随机红包
 * min<k<max
 * min(n-1) <= money - k <= (n-1)max
 * k <= money-(n-1)min
 * k >= money-(n-1)max
 */
function getRedPackage($money, $num, $min, $max)
{
    $data = array();
    if ($min * $num > $money) {
        return array();
    }
    if($max*$num < $money){
        return array();
    }
    while ($num >= 1) {
        $num--;
        $kmix = max($min, $money - $num * $max);
        $kmax = min($max, $money - $num * $min);
        $kAvg = $money / ($num + 1);
        //获取最大值和最小值的距离之间的最小值
        $kDis = min($kAvg - $kmix, $kmax - $kAvg);
        //获取0到1之间的随机数与距离最小值相乘得出浮动区间，这使得浮动区间不会超出范围
        $r = ((float)(rand(1, 10000) / 10000) - 0.5) * $kDis * 2;
        $k = round($kAvg + $r);
        $money -= $k;
        $data[] = $k;
    }
    return $data;
}
一行代码，炫酷效果：

<pre id=p>n=setInterval("for(n+=7,i=k,P='p.\\n';i-=1/k;P+=P[i%2?(i%2*j-j+n/k^j)&1:2])j=k/i;p.innerHTML=P",k=64) ​​​​
```
[这十二行代码是如何让浏览器爆炸的？](http://www.0xroot.cn/demo.html)
http://www.codeceo.com/article/12-line-code-browser-die.html
```js
<html>
<body>
<script>
var total="";
for (var i=0;i<1000000;i++)
{
    total= total+i.toString ();
    history.pushState (0,0,total);
}
</script>
</body>
</html>
```
[用Python&Tesseract识别图片文字](https://mp.weixin.qq.com/s?__biz=MjM5MzgyODQxMQ==&mid=2650367001&idx=1&sn=dc8ea91ba4a83e23b5524a37aab5db73&chksm=be9cdf4d89eb565b1179c9d89030c512afa691dcf9480a0f604ebc658ddea2434658c8c184ef&scene=21#wechat_redirect)
```js
# pip install pytesseract 先安装依赖包
try:
    import Image
except ImportError:
    from PIL import Image
import pytesseract
# lang 指定中文简体
text = pytesseract.image_to_string(Image.open('dufu-denggao1.jpeg'), lang='chi_sim')
print(text)
```
[PHP开发接口如何将null值转字符串的空?](https://segmentfault.com/q/1010000010171343)
```js
// 注意&引用赋值
array_walk_recursive($array, function (& $val, $key ) {
    if ($val === null) {
        $val = '';
    }    

});
function ttt($val) {
    return is_null($val) ? '' : $val;
}
$tt = array(1, 2, 3, null, 4, null, 5);
var_dump(array_map('ttt', $tt));
/**
 * 将数组中的null转为字符串''
 * @param $arr
 */
function nulltostr($arr)
{

    foreach ($arr as $k=>$v){
        if(is_null($v)) {
            $arr [$k] = '';
        }
        if(is_array($v)) {
            $arr [$k] = nulltostr($v);
        }
    }
    return $arr;
}
array_filter是只能去除掉一维的数组的null
print_r(nulltostr([1,null,[3,4,null]]));
function null_filter($arr)
{
    foreach($arr as $key=>&$val) {
        if(is_array($val)) {
            $val = null_filter($val);
        } else {
            if($val === null){
                unset($arr[$key]);// 不能unset($val)
              }
        }
    }
    return $arr;
}
```
[163 邮箱钓鱼网站](https://www.v2ex.com/t/376725)
```js
#!/bin/bash 
# filename: test.sh 

while true 
do 
curl -X POST 'http://flumw.nxusepd.pw/laqhmu/a.asp' --data $'qqid=test&qqpwd=123&face=163\u90ae\u7bb1'
done 



seq 1 20 | xargs -n 1 -P 20 sh test.sh
https://whois.aliyun.com/whois/domain/nxusepd.pw?spm=5176.8076989.763973.115.665faf4b4Qcyvk&file=nxusepd.pw 

详细英文信息里 的手机和邮箱
```
[ping google, 但是不能 ping youtube](https://www.v2ex.com/t/374188)
```js
Terminal 一般不使用系统代理，所以你需要找一下 Terminal 使用代理的方法。 

可以 Ping Google 并不代表翻出去了，一种可能就是 DNS 污染  ping 用的是 ICMP，而 ss 只能代理 TCP 和 UDP，所以用 ping 来测试能否代理是不可行的。要让终端走 ss-local 代理的话可以先执行 export ALL_PROXY=socks5://127.0.0.1:1080。这个命令在 macOS 下亲测有效，如果所用的系统不支持的话恐怕得先转换成 http 代理。这样的话终端应该就可以通过代理连接了，不过该 ping 不通的依然不行。（实在想 ping 的话可以考虑一下走 TCP 的 httping / psping ）
proxychain 之类的工具让命令行应用也能走 ss 代理
使用 privoxy 将代理转成 HTTP，然后在命令行输入 export http_proxy=http://127.0.0.1:端口号 。 
之后输入命令，都是使用代理连接网络  
shadowsocks实质上也是一种socks5代理服务，类似于ssh代理。与vpn的全局代理不同，shadowsocks仅针对浏览器代理，不能代理应用软件，比如youtube、twitter客户端软件。如果把vpn比喻为一把屠龙刀，那么shadowsocks就是一把瑞士军刀，轻巧方便，功能却非常强大https://segmentfault.com/a/1190000004607285 
brew install proxychains-ng
socks5 127.0.0.1 1080
proxychains4 curl google.com 

```




[gitbook](https://www.gitbook.com/@ninghao)
如何查看 Linux是32位还是64位http://justcode.ikeepstudying.com/2015/06/%e5%a6%82%e4%bd%95%e6%9f%a5%e7%9c%8b-linux%e6%98%af32%e4%bd%8d%e8%bf%98%e6%98%af64%e4%bd%8d%ef%bc%9f/
执行命令 file /sbin/init 即是32位的 Linux, 若是64位的, 显示的是 64-bit
uname -a
如何直接在github上预览html网页效果 http://justcode.ikeepstudying.com/2016/08/%e5%a6%82%e4%bd%95%e7%9b%b4%e6%8e%a5%e5%9c%a8github%e4%b8%8a%e9%a2%84%e8%a7%88html%e7%bd%91%e9%a1%b5%e6%95%88%e6%9e%9c/
http://htmlpreview.github.com/?https://github.com/aisinvon/VerticalMiddleForUnknownHeightDiv/blob/master/Set-Unknown-Height-Div-to-Vertical-Middle.html
Linux umask限制导致php的mkdir 0777无效http://justcode.ikeepstudying.com/2015/04/linux-umask%e9%99%90%e5%88%b6%e5%af%bc%e8%87%b4php%e7%9a%84mkdir-0777%e6%97%a0%e6%95%88/
这两天在写一个缓存模块，需要把生成的缓存目录和文件设置成777权限，好让ftp用户可以直接登录删除缓存，蛋疼的事也就这么发生了，明明用了mkdir($path, 0777);用ftp用户登录却删除不了，为什么呢？
重试3次
```js
public function handle()
    {
        if (!$this->keyword) {
            return;
        }

        $search = SearchHistory::getInfoByUserIdAndKeyword($this->userId, $this->keyword);
        if ($search) {
            $search->increment('times', 1);
        } else {
            try{
                SearchHistory::create(['user_id' => $this->userId, 'keyword' => $this->keyword, 'times' => 1]);
            }catch (\Exception $e){
                if($this->retryCount < 3){
                    \Log::info('app search keyword retry', ['userId'=>$this->userId, 'keyword'=>$this->keyword, 'retryCount'=>$this->retryCount]);
                    sleep(1);
                    $this->retryCount = $this->retryCount + 1;
                    return $this->handle();
                }else{
                    \Log::warning('app search keyword error', ['msg'=>$e->getMessage(), 'file'=>__FILE__, 'line'=>__LINE__]);
                    return false;
                }
            }
        }
        RedisFacade::zIncrBy('user:search:history', 1, $this->keyword);
    }
    
    public static function getInfoByUserIdAndKeyword($userId, $keyword){
        return \Cache::remember(self::CACHE_KEY_USER_ID_KEYWORD . $userId.':'.$keyword, self::CACHE_KEY_USER_ID_KEYWORD_TIME, function() use($userId, $keyword) {
            return SearchHistory::where(['user_id' => $userId, 'keyword' => $keyword])->first();
        });
    }
    加锁
    public function waitByEmail($webinarId, $email){
        $redis = Redis::getInstance();
        $cacheKey = self::CACHE_WEBINAR_WAIT_BY_EMAIL . $webinarId . ':' . $email;
        $concurrent = $redis->inc($cacheKey);
        $redis->setTimeout($cacheKey, 1);//http://www.cnblogs.com/weafer/archive/2011/09/21/2184059.html 
        if($concurrent > 1){
            usleep(200000);
        }
    }
    //$redis->setTimeout(997, 10);//设置10秒自动超时过期
$redis->expireAt(997, time()+10);//设置具体的时间戳后过期
$arr = [1,2,3];
$res = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
    ];
    
    
    
    print_r(array_combine($arr,$res));
    Array
(
    [1] => Array
        (
            [id] => 1
            [name] => test
        )

    [2] => Array
        (
            [id] => 2
            [name] => test2
        )

    [3] => Array
        (
            [id] => 3
            [name] => test3
        )

)
$items = [
        ['id'=>1,'name'=>'test'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>2,'name'=>'test2'],
        ['id'=>3,'name'=>'test3'],
        ['id'=>3,'name'=>'test3'],
        
    ];
    $res = [];
        // 分组
        foreach ($items as $key => $value) {
            if (isset($res[$value['id']])) {
                $res[$value['id']][] = $value;
            } else {
                $res[$value['id']] = [$value];
            }
        }
    print_r($res);
Array
(
    [1] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => test
                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [id] => 2
                    [name] => test2
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => test2
                )

        )

    [3] => Array
        (
            [0] => Array
                (
                    [id] => 3
                    [name] => test3
                )

            [1] => Array
                (
                    [id] => 3
                    [name] => test3
                )

        )

)
```
 

查看了一下建立的目录的权限，发现mkdir建立的目录权限都是755的，我明明用的是777，立马google了一下，才知道原来是受Linux 系统的 umask限制了，Linux的umask默认值是0022，所以php 的 mkdir 函数只能建立出755权限的文件夹出来。

小Tips：查看Linux的umask值直接在终端输入命令umask就可以看到
$oldmask = umask(0);
mkdir("test", 0777);
umask($oldmask);

PHPCoverage是一款基于xdebug实现的PHP代码覆盖率统计工具](https://packagist.org/packages/woojean/php-coverage)
composer require woojean/php-coverage 安装失败 把 "lokielse/omnipay-alipay": "1.0.1", 改为 1.0.4 版本就好了
[Linux/Ubuntu: 使用 trash-cli 防止 rm 命令误删除重要文件](http://justcode.ikeepstudying.com/2015/11/ubuntu-%e4%bd%bf%e7%94%a8-trash-cli-%e9%98%b2%e6%ad%a2-rm-%e5%91%bd%e4%bb%a4%e8%af%af%e5%88%a0%e9%99%a4%e9%87%8d%e8%a6%81%e6%96%87%e4%bb%b6/)
pip install trash-cli
![php](https://i.loli.net/2017/07/19/596ec2f497afa.jpg)
[Ngrok NatApp 微信本地化调试利器](http://www.54php.cn/default/211.html)
[PHP命令行参数](http://php.swoole.com/wiki/PHP%E5%91%BD%E4%BB%A4%E8%A1%8C%E5%8F%82%E6%95%B0)
```js
php --re swoole
显示某个扩展提供了哪些类和函数。

php --ri swoole
显示扩展的phpinfo信息
php --rf file_get_contents
显示某个PHP函数的信息，一般用于检测函数是否存在

生产者消费者模式http://php.swoole.com/wiki/PHP_%E4%B8%8E_%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F
//生产者，每秒钟向queue写入一个数字
$n = 1;
while(1){
	echo $n.chr(10);//chr(10)  \n
	file_put_contents('queue', $n.chr(10));
	$n++;
	sleep(1);
}
//消费者，每秒消费queue文件中的数据
$file = 'queue';
while (1){
	if(is_file($file)){
		$tmp_file = 'queue_tmp';
		rename('queue', $tmp_file);//重命名文件，保证在读取不被生产者程序干扰
		//读取文件，进行处理
		$content = file($tmp_file);
		foreach ($content as $value){
			echo $value;//输出结果
		}
		unlink($tmp_file);
	}
	sleep(1);
}


```
[线上PHP问题排查思路与实践](http://www.bo56.com/%E7%BA%BF%E4%B8%8Aphp%E9%97%AE%E9%A2%98%E6%8E%92%E6%9F%A5%E6%80%9D%E8%B7%AF%E4%B8%8E%E5%AE%9E%E8%B7%B5/)
[工具（草稿）](https://ninghao.net/blog/3502)
https://git.ninghao.net/commit.html 
[API 开发者福利--API 在线管理](https://laravel-china.org/topics/3086/api-developer-welfare-api-online-management-simulation-request-test-the-documentation-tool-apizza)
http://apizza.cc/?f=lv 
[【php爬虫】百万级别知乎用户数据爬取与分析](http://www.hoohack.me/2015/09/30/php-spider-millons-of-zhihu-user-analyze)
[Laravel的核心概念](https://lufficc.com/blog/the-core-conception-of-laravel)
[Redis持久化-RDB](https://wenchao.ren/archives/165)
手动触发RBD主要使用save和bgsave命令 redis配置文件中使用了save m n （表示m秒内进行了n次数据修改）
从节点执行全量复制操作的时候，主节点会自动触发bgsave命令生存rdb文件并发送给从节点
 RDB文件是一个压缩过的二进制文件 没办法做到实时/准实时的持久化 非常适合备份，全量复制等场景
 背包问题，背包总容量 80 ，每次放东西的权重 a1*b1 ，求解正好放满背包的方案
 http://ss.ishadowx.com/ 
 
