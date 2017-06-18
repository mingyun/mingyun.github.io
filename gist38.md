[PHP二维数组根据某字段排序](https://tiicle.com/items/288/php-two-dimensional-array-ordered-according-to-a-certain-field)
```js
$array=[
    ['name'=>'张三','age'=>'23'],['name'=>'李四','age'=>'64'],
['name'=>'王五','age'=>'55'],['name'=>'赵六','age'=>'66'],
['name'=>'孙七','age'=>'17']];
$sort = array(
    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
    'field'     => 'age',       //排序字段
);
$arrSort = array();
foreach($array as $uniqid => $row){
    foreach($row AS $key=>$value){
        $arrSort[$key][$uniqid] = $value;
    }
}
array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
print_r($array);
Array
(
    [0] => Array
        (
            [name] => 孙七
            [age] => 17
        )

    [1] => Array
        (
            [name] => 张三
            [age] => 23
        )

    [2] => Array
        (
            [name] => 王五
            [age] => 55
        )

    [3] => Array
        (
            [name] => 李四
            [age] => 64
        )

    [4] => Array
        (
            [name] => 赵六
            [age] => 66
        )

)

```
