[php 递归函数的三种实现方式 ](http://www.cnblogs.com/DeanChopper/p/4707757.html)
```js
function test($a=0,&$result=array()){
$a++;
if ($a<10) {
    $result[]=$a;
    test($a,$result);
}
echo $a;
return $result;

}print_r(test());
function test($a=0,$result=array()){
    global $result;
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    return $result;
}
function test(){
static $count=0;
echo $count;

$count++;
}
function test($a=0){
    static $result=array();
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a);
    }
    return $result;
}

10987654321Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
    [5] => 6
    [6] => 7
    [7] => 8
    [8] => 9
)

$area = array(
array('id'=>1,'area'=>'北京','pid'=>0),
array('id'=>2,'area'=>'广西','pid'=>0),
array('id'=>3,'area'=>'广东','pid'=>0),
array('id'=>4,'area'=>'福建','pid'=>0),
array('id'=>11,'area'=>'朝阳区','pid'=>1),
array('id'=>12,'area'=>'海淀区','pid'=>1),
array('id'=>21,'area'=>'南宁市','pid'=>2),
array('id'=>45,'area'=>'福州市','pid'=>4),
array('id'=>113,'area'=>'亚运村','pid'=>11),
array('id'=>115,'area'=>'奥运村','pid'=>11),
array('id'=>234,'area'=>'武鸣县','pid'=>21)
);
function t($arr,$pid=0,$lev=0){
static $list = array();
foreach($arr as $v){
if($v['pid']==$pid){
echo str_repeat(" ",$lev).$v['area']."<br />";
//这里输出，是为了看效果
$list[] = $v;
t($arr,$v['id'],$lev+1);
}
}
return $list;
}
$list = t($area);
echo "<hr >";
print_r($list);
```


