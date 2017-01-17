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

class Informer Extends DBObject{

	public $__table = 'informers';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'inf';

	public function __construct($id = false) {		global $DBM,$session,$user,$tpl;
		$this->tpl = $tpl;
		$this->user = $user;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	public function show_my_list() {
		$this->user->have_access();		$SQL = "SELECT * FROM `".$this->__table."` WHERE `owner` = '".$this->user->objectId."'";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$str = $this->tpl->out('account/informers/my.list.start');
		if ($this->DBM->NumberOfROws($rs)) {			$i=0;			while($data=$this->DBM->GetNextRow($rs)) {				if ($i%2==0) {
					$this->tpl->set('inf_row_color','#F8F8F8');
				}else{
                	$this->tpl->set('inf_row_color','#F0F0F0');
				}
				$i++;
				$this->load($data);				$this->load_tpl_vars();
				$str .= $this->tpl->out('account/informers/my.list.row');
			}
		}
		$str .= $this->tpl->out('account/informers/my.list.end');
		return $str;
	}

	public function show_add() {
    	$this->user->have_access();
		foreach($this->sys['tizer_formats'] as $i => $f) {
			$tf[$f['w'].'x'.$f['h']] = $f['w'].'x'.$f['h'];
		}
		$this->tpl->set('tizer_formats',$this->tpl->get_select_form('tizer_formats',$tf));
    	return $this->tpl->out('account/informers/add');
	}

	public function show_edit() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->getVariable('owner') == $this->user->objectId) {
				foreach ($this->data as $key => $val) {
					$this->tpl->set('inf_'.$key,$val);
				}
				foreach($this->sys['tizer_formats'] as $i => $f) {
					$tf[$f['w'].'x'.$f['h']] = $f['w'].'x'.$f['h'];
				}
				$this->tpl->set('tizer_formats',$this->tpl->get_select_form('tizer_formats',$tf,$this->getVariable('format')));
				return $this->tpl->out('account/informers/edit');
			}
		}
	}

	public function action_delete() {    	$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->getVariable('owner') == $this->user->objectId) {				$this->delete_dir_tree('data/informers/'.$this->objectId);
				$this->delete();
				$this->session->set_notice('Информер удален',OK);
				return TRUE;
			}
		}
		$this->session->set_notice('Нет такого информера',ERROR);
		return FALSE;
	}

	public function action_save() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {			if ($this->getVariable('owner') == $this->user->objectId) {				$this->previous_image = $this->getVariable('image');
				$this->setVariable('text',substr($_REQUEST['text'],0,75));
				$this->setVariable('format',$_REQUEST['tizer_formats']);
				$this->setVariable('url',str_ireplace('http://','',str_ireplace('https://','',$_REQUEST['url'])));
				$this->build_dir_tree();
				if (isset($_FILES['image']['name']) && $_FILES['image']['name']) {					if ($this->upload_image()) {						$this->setVariable('image',$_FILES['image']['name']);						@unlink($_SERVER['DOCUMENT_ROOT'].'/data/informers/'.$this->objectId.'/'.$this->previous_image);
						$this->session->set_notice('Изображение загружено',OK);
						$this->session->set_notice('Информер успешно сохранен',OK);
					}
				}
				$this->update();
				return TRUE;
			}
		}
		$this->session->set_notice('Нет такого информера',ERROR);
		return FALSE;
	}

	public function action_add() {
    	$this->user->have_access();
    	$this->setVariable('image',$_FILES['image']['name']);
    	$this->setVariable('url',str_ireplace('http://','',str_ireplace('https://','',$_REQUEST['url'])));
		$this->setVariable('text',substr($_REQUEST['text'],0,75));
		$this->setVariable('owner',$this->user->objectId);
		$this->setVariable('format',$_REQUEST['tizer_formats']);
		$this->objectId = $this->insert();
		$this->build_dir_tree();
		if ($this->upload_image()) {			$this->session->set_notice('Информер успешно добавлен',OK);
		}
		return TRUE;
	}

	public function build_dir_tree() {
		if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/data/informers/'.$this->objectId.'/logs')) {			mkdir($_SERVER['DOCUMENT_ROOT'].'/data/informers/'.$this->objectId.'/logs',0777,TRUE);
		}
	}

	public function upload_image() {    	if (isset($_FILES['image']['name'])) {    		list($sw,$sh) = explode('x',$this->getVariable('format'));        	$data = getimagesize($_FILES['image']['tmp_name']);
        	list($width,$height) = $data;
        	if ($data['mime'] == 'image/jpeg' || $data['mime'] == 'image/gif') {        		if ($width > $sw || $height > $sh) {					$new = imagecreatetruecolor($sw,$sh);
					if ($data['mime'] == 'image/jpeg' || $data['mime'] == 'image/jpg') {						$old = imagecreatefromjpeg($_FILES['image']['tmp_name']);
						imagecopyresized($new,$old,0,0,0,0,$sw,$sh,$width,$height);
						imagejpeg($new,$_FILES['image']['tmp_name'],100);
					}else{						$old = imagecreatefromgif($_FILES['image']['tmp_name']);
						imagecopyresized($new,$old,0,0,0,0,$sw,$sh,$width,$height);
						imagegif($new,$_FILES['image']['tmp_name']);
					}
        		}
				if (!copy($_FILES['image']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/data/informers/'.$this->objectId.'/'.$_FILES['image']['name'])) {					$this->session->set_notice('���������� ��������� ��������',ERROR);
					return FALSE;
				}
        		@unlink($_FILES['image']['tmp_name']);
        		return TRUE;
        	}else{
				$this->session->set_notice('Изображение имеет неподдерживаемый формат',ERROR);
				return FALSE;
        	}
    	}else{        	$this->session->set_notice('Нет картинки',ERROR);
        	return FALSE;
    	}
	}

	public function show_reports() {  		$this->user->have_access();
  		if ($this->get(intval($_REQUEST['id']))) {  			if ($this->getVariable('owner') == $this->user->objectId) {            	if (!$_REQUEST['year']) {            		$_REQUEST['year'] = date('Y');
            	}
            	if (!$_REQUEST['month']) {
            		$_REQUEST['month'] = date('m');
            	}
            	if (!$_REQUEST['day']) {
            		$_REQUEST['day'] = date('j');
            	}
            	if (!$_REQUEST['type']) {
            		$_REQUEST['type'] = 'all';
            	}
            	$log = 'data/informers/'.$this->objectId.'/logs/'.$_REQUEST['year'].'/'.intval($_REQUEST['month']).'/'.$_REQUEST['day'].'.log';
            	$str = $this->tpl->out('account/informers/reports/start');
            	if (file_exists($log)) {            		$data = file($log);
            		foreach($data as $i => $line) {               			list($time,$type,$show_uniq,$show,$com,$ip,$site,$ref) = explode("\t",$line);
               			if ($type == $_REQUEST['type'] || $_REQUEST['type'] == 'all') {               				$this->tpl->set('l_time',date('H:i:s'));
               				if ($type == 'show') {               					$this->tpl->set('l_shows',$show.'/'.$show_uniq);
               				}else{                            	$this->tpl->set('l_clicks',$show.'/'.$show_uniq);
               				}
							$this->tpl->set('l_ip',$ip);
							$this->tpl->set('l_ref',$ref);
							$str .= $this->tpl->out('account/informers/reports/row');
						}
            		}
            	}else{            		$str .= $this->tpl->out('account/informers/reports/row2');
            	}

				$str .= $this->tpl->out('account/informers/reports/end');
  			}
  		}
  		return $str;
	}
}
?>
