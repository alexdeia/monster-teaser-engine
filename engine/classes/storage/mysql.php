<?php
class MysqlDBM {
	private $db = null;
	public $queries = 0;
	private $showQueries = FALSE;

	public function __construct() {		global $sys;
		$this->sys = $sys;		$this->connect();
	}

	function connect() {
		$this->db = mysql_connect($this->sys['mysql_host'],$this->sys['mysql_user'],$this->sys['mysql_pass']);
		if ($this->db) {
			if (mysql_select_db($this->sys['mysql_db'],$this->db)) {
				mysql_query("SET NAMES CP1251");
				mysql_query("SET COLLATION_CONNECTION=CP1251_GENERAL_CI");
			}else{
				trigger_error('Hевозможно выбрать базу данных <b>"'.$this->sys['mysql_db'].'"</b>');
			}
		}
	}

	function ExecuteQuery($SQL) {
		if ($this->db == null) {
			$this->__construct();
		}
		$this->queries++;
		$rs = mysql_query($SQL);
#		echo $this->queries.'. '.$SQL.'<br/><br/>';
		if ($rs) {			return $rs;
		}else{
			trigger_error('Ошибка SQL запроса<br><b>Запрос:</b> '.$SQL.'<br><b>Ошибка:</b> '.mysql_error(),E_USER_NOTICE);
		}
	}

	function insert_id() {
      	return mysql_insert_id();
	}

	function SingleRowQuery($SQL)	{
		$rs = $this->ExecuteQuery($SQL);
		if ($rs) {
			return $this->GetNextRow($rs);
		}
	}

	function NumberOfRows($rs){
		return mysql_num_rows($rs);
	}

	function free($rs) {
		 mysql_free_result($rs);
	}

	function GetNextRow($rs) {
		return mysql_fetch_array($rs);
	}

	public function affected() {		return mysql_affected_rows();
	}

	public function GetArray($rs) {		if (mysql_num_rows($rs)) {			while($row=mysql_fetch_array($rs,MYSQL_ASSOC)) {  	 			$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	function __destruct() {
		mysql_close();
		$this->db = null;
	}
}
?>