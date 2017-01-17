###[Image()对象实例化获取图片宽高](https://segmentfault.com/q/1010000008138930)
```php
imgitem.forEach(function(item){
    var img = new Image();
    img.src = item.url;
    img.onload = function(){
        var w = img.width, 
            h = img.height;

        console.log(item, img, w, h);

        if(h/w >= 1.5){
                //...
        }
    }
});
```
###[js递归遍历](https://segmentfault.com/q/1010000008139179)
```php
var tree = {
    name: 'root',
    children: [{
        name: 'child1',
        children: [{
            name: 'child1_1',
            children: [{
                name: 'child1_1_1'
            }]
        }]
    }, {
        name: 'child2',
        children: [{
            name: 'child2_1'
        }]
    }, {
        name: 'child3'
    }]
};
function traverseTree(node){
  var child = node.children,
      arr = [];

  arr.push({ name: node.name });
  if(child){
    child.forEach(function(node){
      arr = arr.concat(traverseTree(node));
    });
  }
  return arr;
}
JSON.stringify(traverseTree(tree))
"[{"name":"root"},{"name":"child1"},{"name":"child1_1"},{"name":"child1_1_1"},{"name":"child2"},{"name":"child2_1"},{"name":"child3"}]"
```
###[js字典排序](https://segmentfault.com/q/1010000008141620)
```php
var myObject = {
    code: 'jonyqin_1434008071',
    timestamp: '1404896688',
    card_id: 'pjZ8Yt1XGILfi-FUsewpnnolGgZk',
    api_ticket: 'ojZ8YtyVyr30HheH3CM73y7h4jJE',
    nonce_str: 'jonyqin'
}

var arr=[];

for(var a in myObject){
    arr.push(myObject[a])
}
arr.sort();
console.log(arr);
```
###[配置机器之间免密码登录](https://segmentfault.com/q/1010000008143786)
```php
先在登录机上安装一个sshpass软件，然后执行脚本
cd /etc/yum.repos.d/ 
wget http://download.opensuse.org/repositories/home:Strahlex/CentOS_CentOS-6/home:Strahlex.repo
yum install sshpass
#!/bin/bash
#设置SSHPASS环境变量
export SSHPASS='对端密码'
#ip.txt中每行为一台机器的IP地址
for IP in `cat ip.txt`
do
    sshpass -e ssh-copy-id -o StrictHostKeyChecking=no $IP
done
```
###[分别是取变量的 个位、十位、百位、千位](https://www.v2ex.com/t/47288)
```php
Math.floor(1234 % 10) 个
Math.floor(1234 / 10 %10) 十
Math.floor(1234 / 100 %10) 百
Math.floor(1234 / 1000 % 10) 千 
str_split(""+228)
```
###[处理未定义变量](https://www.v2ex.com/t/196697)
```php
$params = array_merge(['id' => ''], $_GET);

if ($params['id']) 
$_GET += [
'id' => 0,
'page' => 1,
]; array_get($arr, 'foo.bar') 
	function array_get($array, $key, $default = null)
	{
		return Arr::get($array, $key, $default);
	}
```
