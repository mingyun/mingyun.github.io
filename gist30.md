[为什么递归里 return后方法会继续循环,用dd打印反倒是可以输出正确的数组形式?](https://segmentfault.com/q/1010000008755555)

```js
    public static function foreachComments($comments, $arr_id = array(0), $arr_comments = [])
    {
        $arr = $comments;
        $s_comments = &$arr;
//        //一个全局的变量 保存循环出来的数组,
//        //一个全局的ID变量数组,保存每次循环出来的数组的ID
        foreach ($comments as $key => $value) {
            $a = $value->father_id;
            //数组取值为空??!!
            $b = $arr_id[count($arr_id) - 1];
            if ($a == $b) {
                $arr_comments[count($arr_comments)] = $comments[$key];
                $arr_id[count($arr_id)] = $value->id;
                $s_comments = array_except($comments, $key);
                self::foreachComments($s_comments, $arr_id, $arr_comments);//这里也是在调用自身
            }

        }

        $arr_id = array_except($arr_id, count($arr_id) - 1);
        if (count($arr)==0) {
            dd($arr_comments);//在这里return后会继续往下执行...
        }
       self::foreachComments($s_comments, $arr_id, $arr_comments);//这里也是在调用自身
    }
      
    函数return 后会把执行权交给函数调用处. dd函数是终止程序并打印结果,所以你用DD当然可以打印出结果啊.
```
[做了一题JS面试题](https://segmentfault.com/q/1010000008703575)
```js
var o = [].reduce.call('cbaacfdeaebb',function(p,n){
          return p[n] = (p[n] || 0) + 1,p;
       },{}),
   s = Object.keys(o).reduce(function(p,n){
       return o[p] <= o[n] ? p : n;
   });
   console.log(s,o[s]); 
   
https://segmentfault.com/q/1010000008745355   
 LazyMan('Hank'); 输出
Hi Hank!

LazyMan('Hank').eat('dinner');输出
Hi Hank!
Eat dinner!

LazyMan('Hank').sleep(5).eat('dinner'); 输出：
Hi Hank!
//等待五秒
Eat dinner!

LazyMan('Hank').sleepFirst(5).eat('dinner');输出：
//等待五秒
Hi Hank!
Eat dinner!  
 function LazyMan(nick){
    var obj = {
        task : {
            list : [],
            add : function(fun, timer){
                timer = timer || 0;
                this.task.list.push({
                    fun : fun,
                    timer : timer
                });
                return this;
            },
            run : function(){
                if( this.task.list.length > 0 ){
                    setTimeout( (function(){
                        this.task.list.shift().fun.call(this);
                    }).bind(this), this.task.list[0].timer );
                }else{
                    this.echo("[Task]", "==========Stop==========");
                }
            }
        },
        echo : function( str , str2 ){
            console.log( str + ' ' + str2 );
            return this;
        },
        hello : function( nick ){
            return this.task.add.call(this, function(){
                this.echo('Hi', nick);
                this.task.run.call(this);
            });
        },
        eat : function( eat ){
            return this.task.add.call(this, function(){
                this.echo('Eat', eat);
                this.task.run.call(this);
            });
        },
        sleep : function( timer ){
            return this.task.add.call(this, function(){
                this.echo("[Timer( sleep )]", timer);
                this.task.run.call(this);
            }, timer * 1000);
        },
        sleepFirst : function( timer ){
            var fun = this.task.list[0].fun;
            this.task.list[0].fun = function(){
                setTimeout((function(){
                    this.echo("[Timer( sleepFirst) ]", timer);
                    fun.call(this);
                }).bind(this), timer * 1000);
            };
            return this;
        }
    };
    obj.echo("[Task]", "==========Start==========").hello(nick).task.run.call(obj);
    return obj;
};

LazyMan("A").sleepFirst(1).eat("abc").sleep(4).sleep(5).eat("A").eat("B").eat("C")  
```
[如何对10亿个QQ号进行去重？](https://segmentfault.com/q/1010000008798404)

[mysql将这过去24小时分成10等分，一条SQL查询出10条记录](https://segmentfault.com/q/1010000008098144)
[call_user_func()函数](https://segmentfault.com/q/1010000008797338)
```js
function test() {
    echo "hello test";
}
call_user_func(function(){
    test();
});
//或者以字符串形式传入函数名
call_user_func("test");

class Foo {
    public function bar() {
        echo "Hello bar!";
    }
}
$obj = new Foo();
call_user_func(array($obj, "bar"));

class Foo {
    public static function getInitializer() {
        return "hello";
    }
}

function hello() {
    echo "world!";
}

call_user_func(Foo::getInitializer());
```
[深入学习的前端知识](https://segmentfault.com/q/1010000008796151)
```js
function DecideToLeave(){
    if( Are_U_Sure_U_Are_Not_Gonna_Learn_What_U_Want(in_this_company) == true ){
        if(No_Financial_Dep_On_ThisJob){
            if( Can_U_Find_The_Target_Company(ur_current_background, company_situation) == true ){
                return true;
            } else {
                if( Will_Work_In_This_Company_Affect_Ur_Learning(ur_learning_plan) == true ) {
                    return true
                } else {
                    setTimeout( DecideToLeave, SOMETIME_LATER)
                    return undefined;
                }
            }
        } else {
            return false;
        }
    } else {
        setTimeout( DecideToLeave, SOMETIME_LATER)
        return undefined;
    }
}
《程序员的成长路线》

```
[在国内如何快速部署docker开放环境？](https://segmentfault.com/q/1010000008700675)
[windows下用WPF制作的nginx，php，mysql集成环境](https://github.com/salamander-mh/SalamanderWnmp)
https://segmentfault.com/q/1010000008795166 

[如何根据数据库中的某一个字段查询其在表中相同值所对应的另外一个字段的和？](https://segmentfault.com/q/1010000008798524)
select '藏品编号',sum('交易总额') from tablename where '创建时间'>'时间1' and '创建时间'<'时间2' group by '藏品编号';
[python else](https://segmentfault.com/q/1010000008798723)
```js
n = 17
for d in range(2,n):
    if n % d == 0:
        print(n, '是合数')
        break
else:
    print(n, '是素数')
    
    没有else的话我们应该加个bool变量，for循环后还加个if/else。用for/else的话简单多了。
```
[pandas读取中文的时候乱码 要如何解决](https://segmentfault.com/q/1010000008108689)
```js
#coding=utf-8

import pandas as pd
import sys

reload(sys)
sys.setdefaultencoding("utf-8")

df = pd.read_csv('week1.csv', encoding='utf-8', nrows=10)

print df
```
[python selenium](https://segmentfault.com/q/1010000008796785)
```js
from selenium import webdriver

browser = webdriver.Chrome()
browser.get('http://www.manhuatai.com/doupocangqiong/191.html')
img=browser.find_element_by_xpath('//img[@data-bd-imgshare-binded="1"]')
print img.get_attribute('src')
# 即打印出:
# http://mhpic.zymk.cn/comic/D%2F%E6%96%97%E7%A0%B4%E8%8B%8D%E7%A9%B9%2F191%E8%AF%9DSM%2F1.jpg-mht.middle
```
