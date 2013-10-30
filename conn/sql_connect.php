<?php
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