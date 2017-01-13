<?php
class Category Extends DBObject{

	public $__table = 'categories';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'cat';

	public function __construct($id=FALSE) {		global $DBM,$session;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	public function get_short_list() {		$SQL = "SELECT * FROM `".$this->__table."` WHERE 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$cats = array();
		while ($data=$this->DBM->GetNextRow($rs,MYSQL_ASSOC)) {			$cats[$data['id']] = $data['name'];
		}
		return $cats;
	}

}
?>