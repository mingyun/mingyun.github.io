###[ 根据字符串生成对应数组方法](http://blog.csdn.net/fdipzone/article/details/38589841)
```php
$config = array(  
    'project|page|index' => 'content',  
    'project|page|nav' => array(  
            array(  
                'image' => '1.jpg',  
                'name' => 'home'  
            ),  
            array(  
                'image' => '2.jpg',  
                'name' => 'about'  
            )  
    ),  
    'project|page|open' => true  
);  
  
$result = array();  
foreach($config as $key=>$val){  
      
    $tmp = '';  
    $keys = explode('|', $key);  
      
    for($i=0,$len=count($keys); $i<$len; $i++){  
        $tmp .= "['".$keys[$i]."']";  
    }  
      
    if(is_array($val)){  
        eval('$result'.$tmp.'='.var_export($val,true).';');  
    }elseif(is_string($val)){  
        eval('$result'.$tmp.'='.$val.';');  
    }else{  
        eval('$result'.$tmp.'=$val;');  
    }  
  
}  
  
print_r($result); 
$result = array(  
    'project' => array(  
        'page' => array(  
            'index' => 'content',  
            'nav' => array(  
                    array(  
                        'image' => '1.jpg',  
                        'name' => 'home'  
                    ),  
                    array(  
                        'image' => '2.jpg',  
                        'name' => 'about'  
                    )  
            ),  
            'open' => true  
        )      
    )  
);  
```
