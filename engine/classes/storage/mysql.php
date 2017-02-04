<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://chronodev.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

class MysqlDBM {
	private $db = null;
	public $queries = 0;
	private $showQueries = false;

	public function __construct() {
		global $sys;
		$this->sys = $sys;
		$this->connect();
	}

	function connect()
	{
		$this->db = mysqli_connect($this->sys['mysql_host'], $this->sys['mysql_user'], $this->sys['mysql_pass'], $this->sys['mysql_db']);
		//	if ($this->db) {
		mysqli_query($this->db, "SET NAMES UTF8");
		mysqli_set_charset($this->db, "UTF8");
			//} else {
		//		trigger_error('Невозможно выбрать базу данных <b>"'.$this->sys['mysql_db'].'"</b>');
	//		}
	}

	function ExecuteQuery($SQL)
	{
		if ($this->db == null) {
			$this->__construct();
		}
		$this->queries++;
		$rs = mysqli_query($this->db, $SQL);
		#echo $this->queries.'. '.$SQL.'<br/><br/>';

		return $rs;
	}

	function insert_id()
	{
  	return mysqli_insert_id($this->db);
	}

	function SingleRowQuery($SQL)
	{
		$rs = $this->ExecuteQuery($SQL);
		if ($rs) {
			return $this->GetNextRow($rs);
		}
	}

	function NumberOfRows($rs)
	{
		return mysqli_num_rows($rs);
	}

	function free($rs)
	{
		mysqli_free_result($rs);
	}

	function GetNextRow($rs)
	{
		return mysqli_fetch_array($rs);
	}

	public function affected()
	{
		return mysqli_affected_rows($this->db);
	}

	public function GetArray($rs)
	{
		if (mysqli_num_rows($rs)) {
			while ($row=mysqli_fetch_array($rs, MYSQL_ASSOC)) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	function __destruct()
	{
		mysqli_close($this->db);
		$this->db = null;
	}
}
?>
