###[Python requests SSL: CERTIFICATE_VERIFY_FAILED](https://www.v2ex.com/t/334435)
```php
requests.packages.urllib3.disable_warnings()
requests.get(url,verify=False )
```
###[判断一个值是否存在于一个多维关联数组](https://segmentfault.com/q/1010000008105523)
```php
https://github.com/VikinDev/v-collect
$collect = vcollect([
    ['id'=>1,'product'=>['name'=>['v'=>'i'],'sku'=>15]],
    ['id'=>2,'product'=>['name'=>'bibi','sku'=>10]],
]);

if($collect->where('product.name', 'aa')->toArray() == NULL) {
    echo 'Not in the array';
} else {
    echo 'In the array';
};
var_dump(in_array(2,array_dot($arr)));//true
var_dump(in_array(5,array_dot($arr)));//false
function array_dot($array, $prepend = '')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results = array_merge($results, array_dot($value, $prepend.$key.'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }
```
###[laravel 密码验证](https://segmentfault.com/q/1010000008109472)
```php
public function make($value, array $options = array())
    {
        $cost = isset($options['rounds']) ? $options['rounds'] : $this->rounds;

        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if ($hash === false)
        {
            throw new RuntimeException("Bcrypt hashing not supported.");
        }

        return $hash;
    }
public function check($value, $hashedValue, array $options = array())
    {
        return password_verify($value, $hashedValue);
    }

$password = Input::get('password_from_user'); 
$hash = Hash::make($password );//保存数据库

//对比
$input = 'password_from_user';
if(Hash::check($input, $hash)){
    
}
```
###[将任意内容的字符串唯一均匀地转换为1～n之间的一个整数]()
```php
$str = 'Created by PhpStorm.';

$crc32 = crc32($str);

// 因为crc32求出来的是一个32位整数，可为负数，所以abs一下
// 要多少范围内，就求余多少就行
$result = abs($crc32) % 100;

var_dump($result);//59

```
