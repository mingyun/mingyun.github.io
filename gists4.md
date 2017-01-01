###[文字倒过来](https://www.zhihu.com/question/29676030)
`console.log(String.fromCharCode(0x202E) + '一段文字') `
###[Javascript 中的 UTF-8](https://www.v2ex.com/t/331142#reply4)
```php
function encode_utf8(s) {
  return unescape(endcodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}
> btoa(encode_utf8('\u0227'));
"yKc=="
```
###[python 字符串形式的列表转列表](https://www.v2ex.com/t/330389)
```php
>>> a = [1, 2, 3, 4]
>>> str(a)
'[1, 2, 3, 4]'
>>> import json 
>>> a = '[1,2,2]' 
>>> b = json.loads(a) 
>>> b 
[1, 2, 2] 
>>> a = '[1,2,2]' 
>>> b = list(a)[1::2] 
>>> b 
['1', '2', '2']
>>> b
'[1, 2, 3, 4]'
>>> ast.literal_eval(b)
[1, 2, 3, 4]
a = '[1, 2, 3, 4]'.strip('[').strip(']').split(',')
```






