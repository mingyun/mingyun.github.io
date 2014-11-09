//PHP MySQL操作类
/**
 * MySQL 数据库操作工具类, 方便数据库操作.
 * 示例见底部注释.
 * @author: http://www.ideawu.net/blog/
 */
class Mysql{
    var $conn;
    var $query_list = array();
    public $query_count = 0;

    public function __construct($c){
        if(!isset($c['port'])){
            $c['port'] = '3306';
        }
        $server = $c['host'] . ':' . $c['port'];
        $this->conn = mysql_connect($server, $c['username'], $c['password'], true) or die('connect db error');
        mysql_select_db($c['dbname'], $this->conn) or die('select db error');
        if($c['charset']){
            mysql_query("set names " . $c['charset'], $this->conn);
        }
    }

    /**
     * 执行 mysql_query 并返回其结果.
     */
    public function query($sql){
        $stime = microtime(true);

        $result = mysql_query($sql, $this->conn);
        $this->query_count ++;
        if($result === false){
            throw new Exception(mysql_error($this->conn)." in SQL: $sql");
        }

        $etime = microtime(true);
        $time = number_format(($etime - $stime) * 1000, 2);
        $this->query_list[] = $time . ' ' . $sql;
        return $result;
    }

    /**
     * 执行 SQL 语句, 返回结果的第一条记录(是一个对象).
     */
    public function get($sql){
        $result = $this->query($sql);
        if($row = mysql_fetch_object($result)){
            return $row;
        }else{
            return null;
        }
    }

    /**
     * 返回查询结果集, 以 key 为键组织成关联数组, 每一个元素是一个对象.
     * 如果 key 为空, 则将结果组织成普通的数组.
     */
    public function find($sql, $key=null){
        $data = array();
        $result = $this->query($sql);
        while($row = mysql_fetch_object($result)){
            if(!empty($key)){
                $data[$row->{$key}] = $row;
            }else{
                $data[] = $row;
            }
        }
        return $data;
    }

    public function last_insert_id(){
        return mysql_insert_id($this->conn);
    }

    /**
     * 执行一条带有结果集计数的 count SQL 语句, 并返该计数.
     */
    public function count($sql){
        $result = $this->query($sql);
        if($row = mysql_fetch_array($result)){
            return (int)$row[0];
        }else{
            return 0;
        }
    }

    /**
     * 开始一个事务.
     */
    public function begin(){
        mysql_query('begin');
    }

    /**
     * 提交一个事务.
     */
    public function commit(){
        mysql_query('commit');
    }

    /**
     * 回滚一个事务.
     */
    public function rollback(){
        mysql_query('rollback');
    }


    /**
     * 获取指定编号的记录.
     * @param int $id 要获取的记录的编号.
     * @param string $field 字段名, 默认为'id'.
     */
    function load($table, $id, $field='id'){
        $sql = "select * from `{$table}` where `{$field}`='{$id}'";
        $row = $this->get($sql);
        return $row;
    }

    /**
     * 保存一条记录, 调用后, id被设置.
     * @param object $row
     */
    function save($table, &$row){
        $sqlA = '';
        foreach($row as $k=>$v){
            $sqlA .= "`$k` = '$v',";
        }

        $sqlA = substr($sqlA, 0, strlen($sqlA)-1);
        $sql  = "insert into `{$table}` set $sqlA";
        $this->query($sql);
        if(is_object($row)){
            $row->id = $this->last_insert_id();
        }else if(is_array($row)){
            $row['id'] = $this->last_insert_id();
        }
    }

    /**
     * 更新$arr[id]所指定的记录.
     * @param array $row 要更新的记录, 键名为id的数组项的值指示了所要更新的记录.
     * @return int 影响的行数.
     * @param string $field 字段名, 默认为'id'.
     */
    function update($table, &$row, $field='id'){
        $sqlA = '';
        foreach($row as $k=>$v){
            $sqlA .= "`$k` = '$v',";
        }

        $sqlA = substr($sqlA, 0, strlen($sqlA)-1);
        if(is_object($row)){
            $id = $row->{$field};
        }else if(is_array($row)){
            $id = $row[$field];
        }
        $sql  = "update `{$table}` set $sqlA where `{$field}`='$id'";
        return $this->query($sql);
    }

    /**
     * 删除一条记录.
     * @param int $id 要删除的记录编号.
     * @return int 影响的行数.
     * @param string $field 字段名, 默认为'id'.
     */
    function remove($table, $id, $field='id'){
        $sql  = "delete from `{$table}` where `{$field}`='{$id}'";
        return $this->query($sql);
    }

    function escape(&$val){
        if(is_object($val) || is_array($val)){
            $this->escape_row($val);
        }
    }

    function escape_row(&$row){
        if(is_object($row)){
            foreach($row as $k=>$v){
                $row->$k = mysql_real_escape_string($v);
            }
        }else if(is_array($row)){
            foreach($row as $k=>$v){
                $row[$k] = mysql_real_escape_string($v);
            }
        }
    }

    function escape_like_string($str){
        $find = array('%', '_');
        $replace = array('\%', '\_');
        $str = str_replace($find, $replace, $str);
        return $str;
    }
}  
// 保存
$db->save('table_1', $row);
// 更新
$db->update('table_1', $row);
// 删除
$db->remove('table_1', 1);
// 查询
$rows = $db->find($sql, 'id')
