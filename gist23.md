###[理解PHP延迟静态绑定](https://blog.haitun.me/late-static-bindings/)
static::中的static其实是运行时所在类的别名，并不是定义类时所在的那个类名。这个东西可以实现在父类中能够调用子类的方法和属性。
使用(static)关键字来表示这个别名，和静态方法，静态类没有半毛钱的关系，static::不仅支持静态类，还支持对象（动态类）。
```js
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        static::who(); // 后期静态绑定从这里开始
    }
}
class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}
B::test();
class Model 
{ 
    public static function find() 
    { 
        echo static::$name; 
    } 
} 

class Product extends Model 
{ 
    protected static $name = 'Product'; 
} 

Product::find(); 
```
