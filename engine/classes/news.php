<?php
class News Extends DBObject{

	public $__table = 'news';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'news';

	public function __construct($id=FALSE) {		global $DBM,$session,$tpl;
		$this->tpl = $tpl;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	public function show_news() {		if ($this->get(intval($_REQUEST['id']))) {			return $this->tpl->out('news.full');
		}
	}

	public function show_all_news() {  		$SQL = "SELECT * FROM `news` WHERE 1";
  		$rs = $this->DBM->ExecuteQuery($SQL);
  		if ($this->DBM->NumberOfROws($rs)) {  			$str = $this->tpl->out('news/start');     		while($data=$this->DBM->GetNExtROw($rs)) {     			$this->load($data);
     			$this->load_tpl_vars();
     			$this->tpl->set('date',date('d.m.Y',$data['time']));				$str .= $this->tpl->out('news/row');
     		}
			$str .= $this->tpl->out('news/end');
  		}
  		return $str;
	}

}
?>