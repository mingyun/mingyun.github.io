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
