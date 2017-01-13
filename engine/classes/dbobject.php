<?
abstract class DBObject {
    public $__table;
    public $__keyColumn;
    public $objectId = NULL;
    public $data = array();
    public $_isLoaded = false;
    public $_changedColumns = array();


    public function DBObject(&$DBM,$id=0) {
	    global $sys,$tpl;
	    $this->tpl = &$tpl;
	    $this->sys = $sys;        $this->DBM = &$DBM;
        if ($id) {        	$this->objectId = $id;
        	return $this->get();
        }
        $this->url = "http://".$_SERVER["HTTP_HOST"]."/";

    }

    public function get($objectId=null,$SQL=null) {
        if ($objectId !== null) {
            $this->objectId = $objectId;
        }
        if ($this->objectId) {        	if (!$SQL) {        		$SQL = "SELECT * FROM `".$this->__table."` WHERE `".$this->__table."`.`".$this->__keyColumn."` = '".$this->objectId."' LIMIT 1";
        	}
			$this->data = $this->DBM->SingleRowQuery($SQL);
            if ($this->data) {
                $this->_isLoaded = true;
                if ($this->tpl_prefix) {                	$this->load_tpl_vars();
                }
                return true;
            }
            $this->objectId = 0;
			return false;
        }
        return false;
    }

    public function load($data) {
		$this->data = $data;
		$this->objectId = $data[$this->__keyColumn];
		$this_isLoaded = true;
		return true;
    }

    public function un_load() {		$this->data = array();
		$this->objectId = FALSE;
		$this->_isLoaded = FALSE;
		$this->_changedColumns = array();
		return TRUE;
    }

    public function __destruct() {    	$this->data = array();
    	$this->_isLoaded = FALSE;
    	$this->objectId = FALSE;
    	$this->_changedColumns = array();
    	$this->vars = array();
    }

    public function insert($keyval='',$debug=FALSE) {    	if ($keyval) {    		$keyClause = "`".$this->__keyColumn."` = '".$keyval."',";
    	}else{    		$keyClause = '';
    	}
        $setClause = $this->_prepareSetClause($debug);
        if (strlen($setClause)>0) {
			$SQL = "INSERT INTO `".$this->__table."` SET ".$keyClause." ".$setClause;
	 		if ($this->DBM->ExecuteQuery($SQL)) {	 			$insertId = mysql_insert_id();
	 			return $insertId;
	 		}
        }
        return false;
    }

    public function update() {        if (isset($this->objectId)) {
            $setClause = $this->_prepareSetClause();
            if (strlen($setClause)>0) {				$SQL = "UPDATE `".$this->__table."` SET ".$setClause." WHERE `".$this->__keyColumn."` = '".$this->objectId."' LIMIT 1";
                return $this->DBM->ExecuteQuery($SQL);
            }

        }
        return false;
    }

    public function delete() {        if (isset($this->objectId)) {
			$SQL = "DELETE FROM `".$this->__table."` WHERE ".$this->__keyColumn." = '{$this->objectId}' LIMIT 1";
            return $this->DBM->ExecuteQuery($SQL);
        }
        return false;
    }

    public function getVariable($var) {
    	if (isset($this->data[$var])) {
    		return $this->data[$var];
    	}
    	return FALSE;
    }

    public function setVariable($variableName, $variableValue) {
        $this->_changedColumns[] = $variableName;
        $this->data[$variableName] = $variableValue;
    }

    public function increaseVariable($variableName, $increaseValue) {        $this->setVariable($variableName, $this->getVariable($variableName)+$increaseValue);
    }

    public function decreaseVariable($variableName, $decreaseValue) {        $this->setVariable($variableName, $this->getVariable($variableName)-$decreaseValue);
    }

    public function removeVariable($variableName) {
        if ($variableName) {
            if (in_array($variableName, array_keys($this->data))) {
                unset($this->data[$variableName]);
            }
        }
    }

    public function _prepareSetClause() {
        $setClause = '';
        if ($this->_isLoaded) {            if (sizeof($this->_changedColumns)>0) {
                foreach ($this->_changedColumns as $columnName) {
                    if ($columnName != $this->__keyColumn && strval(intval($columnName))!=$columnName) {
                        $setClause .= "`".$columnName."` = '".mysql_escape_string($this->getVariable($columnName))."', ";
                    }
                }
                $setClause = substr($setClause,0,-2);
            }
        }else{
            if (sizeof($this->data)>0) {
                foreach ($this->data as $columnName=>$columnValue) {
                    if ($columnName != $this->__keyColumn && strval(intval($columnName))!=$columnName) {
                        $setClause .= "`".$columnName."` = '".mysql_escape_string($columnValue)."', ";
                    }
                }
                $setClause = substr($setClause,0,-2);
            }
        }
        return $setClause;
    }

    public function load_tpl_vars() {		if ($this->tpl_prefix && $this->data[$this->__keyColumn]) {			foreach ($this->data as $key => $val) {    			$this->tpl->set($this->tpl_prefix.'_'.$key,$val);
			}
			return TRUE;
		}
		return FALSE;
    }

	public function delete_dir_tree($path) {
		if (file_exists($path)) {
			if (is_dir($path)) {
				$dir = @scandir($path);
  				unset($dir[0],$dir[1]);
   			 	foreach($dir as $key => $val) {
    				$file = $path.'/'.$val;
    				if (is_dir($file)) {
    					$this->delete_dir_tree($file);
    				}else{
						@unlink($file);
    				}
    			}
    			@rmdir($path);
    		}else{
    			@unlink($path);
    		}
    	}
	}

}

?>