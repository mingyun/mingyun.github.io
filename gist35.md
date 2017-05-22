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

functiontest($i) 
{  
$i-=4;  if($i<3) 
{
return$i; 
}  
else 
{  
test($i); 
}   
}   
echotest(30);  else里面是有问题的。在这里执行的test没有返回值。所以虽然满足条件$i<3时return$i整个函数还是不会返回值的
functiontest($i)
{  
$i-=4;  if($i<3)  
{  
return$i;  
}  
else  
{  
returntest($i);//增加return,让函数返回值  
}  
}   
echotest(30);  
function summation ($count) {
   if ($count != 0) :
     return $count + summation($count-1);
   endif;
}
$sum = summation(10);

function unreverse($str){
  for($i=1;$i<=strlen($str);$i++){
    echo substr($str,-$i,1);
  }
}
unreverse("abcdefg");//gfedcbc
 
function reverse($str){
  if(strlen($str)>0){
    reverse(substr($str,1));
    echo substr($str,0,1);
    return;
  }
}
reverse("abcdefg");//gfedcbc

```
[ PHP不使用递归的无限级分类](http://blog.csdn.net/zhouzme/article/details/50097669)
```js
$list = array(
    array('id'=>1, 'pid'=>0, 'deep'=>0, 'name'=>'test1'),
    array('id'=>2, 'pid'=>1, 'deep'=>1, 'name'=>'test2'),
    array('id'=>3, 'pid'=>0, 'deep'=>0, 'name'=>'test3'),
    array('id'=>4, 'pid'=>2, 'deep'=>2, 'name'=>'test4'),
    array('id'=>5, 'pid'=>2, 'deep'=>2, 'name'=>'test5'),
    array('id'=>6, 'pid'=>0, 'deep'=>0, 'name'=>'test6'),
    array('id'=>7, 'pid'=>2, 'deep'=>2, 'name'=>'test7'),
    array('id'=>8, 'pid'=>5, 'deep'=>3, 'name'=>'test8'),
    array('id'=>9, 'pid'=>3, 'deep'=>2, 'name'=>'test9'),
);
function resolve2(& $list, $pid = 0) {
    $manages = array();
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $manages[$row['id']] = $row;
            $children = resolve2($list, $row['id']);
            $children && $manages[$row['id']]['children'] = $children;
        }
    }
    return $manages;
}
```



[PHP递归实现无限级分类](http://www.helloweba.com/view-blog-204.html)
```js
function get_str($id = 0) { 
    global $str; 
    $sql = "select id,title from class where pid= $id";  
    $result = mysql_query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        $str .= '<ul>'; 
        while ($row = mysql_fetch_array($result)) { //循环记录集 
            $str .= "<li>" . $row['id'] . "--" . $row['title'] . "</li>"; //构建字符串 
            get_str($row['id']); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
        $str .= '</ul>'; 
    } 
    return $str; 
} 
function get_array($id=0){ 
    $sql = "select id,title from class where pid= $id"; 
    $result = mysql_query($sql);//查询子类 
    $arr = array(); 
    if($result && mysql_affected_rows()){//如果有子类 
        while($rows=mysql_fetch_assoc($result)){ //循环记录集 
            $rows['list'] = get_array($rows['id']); //调用函数，传入参数，继续查询下级 
            $arr[] = $rows; //组合数组 
        } 
        return $arr; 
    } 
} 

```

[纯js格式化货币：currencyFmatter.js](http://www.helloweba.com/view-blog-392.html)
OSREC.CurrencyFormatter.format(2534234, { currency: 'INR' }); // Returns ? 25,34,234.00
