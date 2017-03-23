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









