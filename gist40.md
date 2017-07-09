[快捷打印 Laravel 中的数据库查询（SQL）语句](https://laravel-china.org/articles/5166/quick-print-laravel-database-query-sql-statement)
```js
当你的 APP_ENV 设置为 local、请求 URL 后面紧跟 ?sql-debug=1 时，就会打印出请求处理逻辑中涉及到的所有数据库查询语句。

配置#

AppServiceProvider 的 boot 方法内写入

use DB;
use Event;

if ( env('APP_ENV') === 'local' ) {
    DB::connection()->enableQueryLog();
    Event::listen('kernel.handled', function ( $request, $response ) {
        if ( $request->has('sql-debug') ) {
            $queries = DB::getQueryLog()；
            if (!empty($queries)) {
                foreach ($queries as &$query) {
                    $query['full_query'] = vsprintf(str_replace('?', '%s', $query['query']), $query['bindings']);
                }
            }
            dd($queries);
        }
    });
}
```
