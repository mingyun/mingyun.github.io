[关于不同的商品总价计算的问题](https://segmentfault.com/q/1010000009685623)
```js
 $math = '%s*%s';
    $str  = sprintf($math, 5, 6);
    $result=eval("return $str;");
    var_dump($result);
```
[php 批量插入10w 条内容导致内存撑爆128mb 怎么处理](https://segmentfault.com/q/1010000009644725)
```js
自己生成一张id表(只存id一个字段),记录10w条(0-10w)
mysql做法:

insert into table t
select i.id, concat('名字', i.id) name, 
    concat('随机生成码7-12:',FLOOR(7 + (RAND() * 6))) rand,
    ifnull(a.nickname, 'No nickname') nickname,
    uuid() descript, --随机字符串
    from_unixtime(unix_timestamp("20170101000000")+FLOOR((RAND()*60*60*24*365)))  --2017年中随机日期
from table_id i
left join table_account a on a.id=FLOOR((RAND()*12)) --如果数据来源另外一些表
where i.id < 1000  --如果只要生成1000条
```
[mysql中You can't specify target table for update in FROM clause错误](https://segmentfault.com/q/1010000009615307)
```js
delete from tbl where id in 
(
        select max(id) from tbl a where EXISTS
        (
            select 1 from tbl b where a.tac=b.tac group by tac HAVING count(1)>1
        )
        group by tac
)

改写成下面就行了：
delete from tbl where id in 
(
    select a.id from 
    (
        select max(id) id from tbl a where EXISTS
        (
            select 1 from tbl b where a.tac=b.tac group by tac HAVING count(1)>1
        )
        group by tac
    ) a
)
```
如何降低Laravel artisan 报错级别https://segmentfault.com/q/1010000009623981
框架代码位置：Illuminate\Foundation\Bootstrap\HandleExceptions::bootstrap()
[php 解压.gz文件格式的方法。](https://segmentfault.com/q/1010000009691227)
```js
$file_name = 'file.txt.gz';

// Raising this value may increase performance
$buffer_size = 4096; // read 4kb at a time
$out_file_name = str_replace('.gz', '', $file_name);

// Open our files (in binary mode)
$file = gzopen($file_name, 'rb');
$out_file = fopen($out_file_name, 'wb');

// Keep repeating until the end of the input file
while(!gzeof($file)) {
    // Read buffer-size bytes
    // Both fwrite and gzread and binary-safe
    fwrite($out_file, gzread($file, $buffer_size));
}

// Files are done, close files
fclose($out_file);
gzclose($file);
```
[laravel的Baum怎么获得某一条记录的最终父类id](https://segmentfault.com/q/1010000009658954)
```js
    $arr = array(
                array(
                    'id'        => 10,
                    'parent_id' => 9
                    ),
                array(
                    'id'        => 9,
                    'parent_id' => 5
                    ),
                array(
                    'id'        => 5,
                    'parent_id' => null
                    ),
        
        
        );
    function getParentId($arr, $id = 10) {
        foreach ($arr as $val) {
            if($val['id'] == $id) {
                if(!empty($val['parent_id'])) {
                    $id = $val['parent_id'];
                    getParentId($arr, $id);
                }else {
                    return $id;
                }
            }
        }
        return $id;
    }
    
    echo getParentId($arr, 10);
```
[larave session问题，为什么每次session_id都要变](https://segmentfault.com/q/1010000009694886)
一切都是在EncryptCookies中进行的

\App\Http\Middleware\EncryptCookies::class

larave_session

先经过base64_decode，在json_decode在进行一些列验证 然后通过openssl_decrypt解密出真正存储在redis或其他drive里面的session_id

[php使用curl处理文件下载url连接](https://segmentfault.com/q/1010000009708754)
一般返回数据的使用curl处理数据的方法会使用
把返回的content用file_put_contents写入就行了

file_put_contents(__DIR__.'/yourfilename.ext', $response);

