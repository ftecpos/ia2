<?php
require_once('C:\ia2\lib\poslib.php');
class sql_connect
{

    protected $link_id;

    public function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $charset =
        'utf8')
    {
        if (!($this->link_id = mysql_connect($dbhost, $dbuser, $dbpw))) {
            $this->ErrorMsg("Can't pConnect MySQL Server($dbhost)!");
        }

        mysql_query("SET NAMES " . $charset, $this->link_id);

        if ($dbname) {
            if (mysql_select_db($dbname, $this->link_id) === false) {
                $this->ErrorMsg("Can't select MySQL database($dbname)!");

                return false;
            } else {
                return true;
            }
        }

    }

    public function select_database($dbname)
    {
        return mysql_select_db($dbname, $this->link_id);
    }

    public function fetch_array($query, $result_type = MYSQL_ASSOC)
    {
        return mysql_fetch_array($query, $result_type);
    }

    public function query($sql)
    {
        return 	mysql_query($sql, $this->link_id);
			
    }
    
	
    public function affected_rows()
    {
        return mysql_affected_rows($this->link_id);
    }
    

    
    public function closeConn(){
    	return mysql_close($this->link_id);
    	$this->closeConn();
    }
    
    public function num_rows($query)
    {
        return mysql_num_rows($query);
    }

    public function insert_id()
    {
        return mysql_insert_id($this->link_id);

    }
    public function getLastIndex(){
    	$sql = 'select LAST_INSERT_ID()';
    	return $this->query($sql);
    }

    public function selectLimit($sql, $num, $start)
    {
        if ($start == 0) {
            $sql .= ' LIMIT ' . $num;
        } else {
            $sql .= ' LIMIT ' . $start . ', ' . $num;
        }
        return $this->query($sql);
    }
    public function select($sql)
    {
        return $this->query($sql);
    }

    public function getOne($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false) {
            $row = mysql_fetch_row($res);

            return $row[0];
        } else {
            return false;
        }
    }
    public function get_record_sql($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false) {
            $row = mysql_fetch_assoc($res);

            return sql_connect::arrayToObject($row);
        } else {
            return false;
        }
    }
    public function get_records_sql($sql, $idxfield)
    {   
        $recordarr = array();
        $res = $this->query($sql);
        if ($res !== false) {
            while ($row = mysql_fetch_assoc($res)) {
                $recordarr[$row[$idxfield]] = sql_connect::arrayToObject($row);
            }
            return $recordarr ;
        } else {
            return false;
        }
    }
    public function insert_record($table, $dataobject, $returnid=true, $bulk=false) {
        $dataobject = (array)$dataobject;

        $columns = $this->get_columns($table);
        $cleaned = array();

        foreach ($dataobject as $field=>$value) {
            if ($field === 'id') {
                continue;
            }
            if (!isset($columns[$field])) {
                continue;
            }
            $column = $columns[$field];
            $cleaned[$field] = $value;
        }
        
        return $this->insert_record_raw($table, $cleaned, $returnid, $bulk);
    }
    public function insert_record_raw($table, $params, $returnid=true, $bulk=false, $customsequence=false) {
        if (!is_array($params)) {
            $params = (array)$params;
        }
        if (empty($params)) {
            print_error('database::insert_record_raw() no fields found');
        }
        $fields = implode(',', array_keys($params));
        $qms    = array_fill(0, count($params), '?');
        $qms    = implode(',', $qms);
        $sql = "INSERT INTO $table ($fields) VALUES($qms)";
        $rawsql = $this->emulate_bound_params($sql, $params);
        $this->query($rawsql);
        $last_insert_id = $this->insert_id();
        return $last_insert_id;
    }
    protected function emulate_bound_params($sql, array $params=null){
        if (empty($params)) {
            return $sql;
        }
        //emulate_bound_params
        $parts = array_reverse(explode('?', $sql));
        $return = array_pop($parts);
        foreach ($params as $param) {
            if (is_bool($param)) {
                $return .= (int)$param;
            } else if (is_null($param)) {
                $return .= 'NULL';
            } else if (is_number($param)) {
                $return .= "'".$param."'"; // we have to always use strings because mysql is using weird automatic int casting
            } else if (is_float($param)) {
                $return .= $param;
            } else {
                $param = $param;
                $return .= "'$param'";
            }
            $return .= array_pop($parts);
        }
        return $return;
    }
    public function get_columns($table){        
        
        $sql = "SHOW COLUMNS FROM $table";
        $res = $this->getAll($sql);
        $columns=array();
        foreach($res as $key => $value){
            $columns[$value['Field']]=0;
        }
        return $columns;
    }
    public function update_record($table, $dataobject, $tableididx){
        $dataobject = (array)$dataobject;
        
        $columns = $this->get_columns($table);
        $cleaned = array();
        foreach ($dataobject as $field=>$value) {
            if (!isset($columns[$field])) {
                continue;
            }
            $column = $columns[$field];
            $cleaned[$field] = $value;
        }
        
        return $this->update_record_raw($table, $cleaned, $tableididx);
    }
    public function update_record_raw($table, $params, $tableididx) {
        $params = (array)$params;
        
        if (!isset($params[$tableididx])) {
            print_error('database::update_record_raw() '.$tableididx.' field must be specified.');
        }
        $id = $params[$tableididx];
        unset($params[$tableididx]);
        
        if (empty($params)) {
            print_error('database::update_record_raw() no fields found');
        }
        
        
        $sets = array();
        foreach ($params as $field=>$value) {
            $sets[] = "$field = ?";
        }
        $params[] = $id; // last ? in WHERE condition
        $sets = implode(',', $sets);
        $sql = "UPDATE " . $table . " SET $sets WHERE $tableididx = ?";
        $rawsql = $this->emulate_bound_params($sql, $params);
        $this->query($rawsql);
        return true;
    }
    public function arrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }

        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name=>$value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = sql_connect::arrayToObject($value);
                }
            }
            return $object;
        }
        else {
            return FALSE;
        }
    }
    public function getrow($sql)
    {
        $res = $this->query($sql);
        if ($res !== false) {
            return mysql_fetch_assoc($res);
        } else {
            return false;
        }
    }

    public function getAll($sql)
    {
        $res = $this->query($sql);
        if ($res !== false) {
            $arr = array();
            while ($row = mysql_fetch_assoc($res)) {
                $arr[] = $row;
            }

            return $arr;
        } else {
            return false;
        }
    }
    public function records_sql($sql)
    {
        $fielddata = $this->get_sql_fields($sql, 0); //first field
        $pk_field = $fielddata->name; //first field name
        $res = $this->query($sql);
        if ($res !== false) {
            $dataarrobj = array();
            while ($row = mysql_fetch_object($res)) {
                $dataarrobj[$row->$pk_field] = $row;
            }

            return $dataarrobj;
        } else {
            return false;
        }
			
    }
    
    public function get_sql_fields($sql, $field_offset = 0){
        $result = $this->query($sql);
        if (!$result) {
            $this->ErrorMsg();
        }
        return mysql_fetch_field($result, $field_offset);
    }

    function ErrorMsg($message = '', $sql = '')
    {
        if ($message) {
            echo "<b>error info</b>: $message\n\n";
        } else {
            echo "<b>MySQL server error report:";
            print_r($this->error_message);
        }

        exit;
    }

}
?>