<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://e-dev.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

class Company extends DBObject{

	public $__table = 'companies';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'com';

	public function __construct($id=FALSE) {		global $DBM,$session,$user,$tpl;
		$this->tpl = $tpl;
		$this->user = $user;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	public function show_my_list() {
		$this->user->have_access();
		$SQL = "SELECT * FROM `".$this->__table."` WHERE `owner` = '".$this->user->objectId."'";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$str = $this->tpl->out('account/companies/my.list.start');
		if ($this->DBM->NumberOfROws($rs)) {
			$i=0;
			while($data=$this->DBM->GetNextRow($rs)) {
				if ($i%2==0) {
					$this->tpl->set('com_row_color','#F8F8F8');
				}else{
                	$this->tpl->set('com_row_color','#F0F0F0');
				}
				$i++;
				foreach ($data as $key => $val) {					$this->tpl->set('com_'.$key,$val);
				}
				$str .= $this->tpl->out('account/companies/my.list.row');
			}
		}
		$str .= $this->tpl->out('account/companies/my.list.end');
		return $str;
	}

	public function show_add() {
		$this->user->have_access();
		foreach($this->sys['tizer_formats'] as $i => $f) {
			$tf[$f['w'].'x'.$f['h']] = $f['w'].'x'.$f['h'];
		}
		$this->tpl->set('tizer_formats',$this->tpl->get_select_form('tizer_formats',$tf,$this->getVariable('format')));		return $this->tpl->out('account/companies/add');
	}

	public function show_edit() {		$this->user->have_access();
		if ($this->get(abs(intval($_REQUEST['id'])))) {			if ($this->getVariable('owner') == $this->user->objectId) {				$this->load_tpl_vars();
				foreach($this->sys['tizer_formats'] as $i => $f) {
					$tf[$f['w'].'x'.$f['h']] = $f['w'].'x'.$f['h'];
				}
				$this->tpl->set('tizer_formats',$this->tpl->get_select_form('tizer_formats',$tf,$this->getVariable('format')));				return $this->tpl->out('account/companies/edit');
			}
		}
	}

	public function action_delete() {
		$this->user->have_access();
		if ($this->get(abs(intval($_REQUEST['id'])))) {
			if ($this->getVariable('owner') == $this->user->objectId) {
				$this->delete_dir_tree('data/companies/'.$this->objectId);
				$SQL = "DELETE FROM `tar_cat` WHERE `id` = '".$this->objectId."'";
				$this->DBM->ExecuteQuery($SQL);
				$SQL = "DELETE FROM `tar_day` WHERE `id` = '".$this->objectId."'";
				$this->DBM->ExecuteQuery($SQL);
				$SQL = "DELETE FROM `tar_hrs` WHERE `id` = '".$this->objectId."'";
				$this->DBM->ExecuteQuery($SQL);
				$this->user->increaseVariable('balance',$this->getVariable('funds'));
				$this->user->update();
				$this->delete();
				header("Location:/account/companies/index.html");
				$this->session->set_notice('Компания удалена',OK);
			}
		}
		$this->session->set_notice('Нет такой компании',ERROR);
	}

	public function action_save() {
		$this->user->have_access();
		if ($this->get(abs(intval($_REQUEST['id'])))) {
			if ($this->getVariable('owner') == $this->user->objectId) {
				$this->setVariable('name',$_REQUEST['name']);
				$this->setVariable('format',$_REQUEST['tizer_formats']);
				$this->update();
				$this->session->set_notice('Изменения сохранены',OK);
			}
		}else{			$this->session->set_notice('Нет такой компании',ERROR);
		}
	}

	public function action_add() {
    	$this->user->have_access();
    	$this->setVariable('name',$_REQUEST['name']);
    	$this->setVariable('owner',$this->user->objectId);
    	$this->setVariable('format',$_REQUEST['tizer_formats']);
    	$this->setVariable('status',0);
    	$this->objectId = $this->insert();
    	header("Location:/account/companies/".$this->objectId."/add-informers.html");
	}

	public function show_add_informers() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
				$SQL = "SELECT * FROM `informers` WHERE `owner` = '".$this->user->objectId."'";
				$infz = unserialize($this->getVariable('informers'));
					if (count($infz)>1) {
						$SQL .= " AND `id` NOT IN (".implode(',',$infz).")";
					}
				$SQL .= " AND `format` = '".$this->getVariable('format')."'";
				$rs = $this->DBM->ExecuteQuery($SQL);
				$str = $this->tpl->out('account/companies/informers/list.start');
				if ($this->DBM->NumberOfRows($rs)) {
					$i=0;
					while($data=$this->DBM->GetNextRow($rs)) {
						if ($i%2==0) {
							$this->tpl->set('inf_row_color','#F8F8F8');
						} else {
							$this->tpl->set('inf_row_color','#F0F0F0');
						}
						$i++;
							foreach ($data as $key => $val) {
								$this->tpl->set('inf_'.$key,$val);
							}
						$str .= $this->tpl->out('account/companies/informers/list.row');
		    	}
		    }
				$str .= $this->tpl->out('account/companies/informers/list.end');
			}
		}
		return $str;
	}

	public function show_delete_informers() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
				$SQL = "SELECT * FROM `informers` WHERE `owner` = '".$this->user->objectId."'";
				$infs = unserialize($this->getVariable('informers'));
				if (count($infs) && is_array($infs)) {
					$SQL .= " AND `id` IN (".implode(',',$infs).")";
					$rs = $this->DBM->ExecuteQuery($SQL);
					$str = $this->tpl->out('account/companies/informers/delete.list.start');
					if ($this->DBM->NumberOfRows($rs)) {
						$i=0;
						while($data=$this->DBM->GetNextRow($rs)) {
							if ($i%2==0) {
								$this->tpl->set('inf_row_color','#F8F8F8');
							}else{
		  	              	$this->tpl->set('inf_row_color','#F0F0F0');
							}
							$i++;
							foreach ($data as $key => $val) {
								$this->tpl->set('inf_'.$key,$val);
							}
		  		          	$str .= $this->tpl->out('account/companies/informers/delete.list.row');
		  		  		}
		  		  	}
					$str .= $this->tpl->out('account/companies/informers/delete.list.end');
				}else{
					$str = $this->tpl->out('account/companies/informers/delete.list.start');
					$str .= $this->tpl->out('account/companies/informers/delete.list.end');
				}
			}
		}
		return $str;
	}

	public function action_delete_informers() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
				$infs2del = $_REQUEST['inf'];
				$infs = unserialize($this->getVariable('informers'));
				if (count($infs) && is_array($infs)) {					foreach($infs as $key => $val) {
						if ($infs2del[$val] == 'on') {
							unset($infs[$key]);
						}
					}
				}
				$this->setVariable('informers',serialize($infs));
				$this->update();
				$this->update_tar_tables();
				header("Location:/account/companies/index.html");
			}
		}
	}

	public function action_add_informers() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
                if (is_array($_REQUEST['inf'])) {
                	$infs = array();
                	foreach ($_REQUEST['inf'] as $key => $val) {
                		if ($val == 'on') {
                			$SQL = "SELECT `owner` FROM `informers` WHERE `id` = '".$key."' LIMIT 1";
                			list($owner) = $this->DBM->SingleRowQuery($SQL);
                			if ($owner == $this->user->objectId) {
								$infs[] = $key;
                			}
        				}
                	}
                	$infz = unserialize($this->getVariable('informers'));
                	if (count($infz) && is_array($infz)) {                		array_merge($infs,$infz);
                	}
                	$this->setVariable('informers',serialize($infs));
                	$this->update();
                	if (!$_REQUEST['redlist']) {
                		header("Location:/account/companies/".$this->objectId."/targeting.html");
                	}else{
                    	header("Location:/account/companies/index.html");
                	}
                }
			}
		}
		return $str;
	}

	public function show_targeting() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
				$SQL = "SELECT * FROM `categories` WHERE 1";
				$rs = $this->DBM->ExecuteQuery($SQL);
				$tar_cat = '';
				$com_cat = $this->getVariable('tar_category');
				if (!$com_cat) {					$com_cat = 1;
				}
				$com_days = unserialize($this->getVariable('tar_days'));
				if (!count($com_days)) {					for($i=1;$i<8;$i++) {						$com_days[] = $i;
					}
				}
				$com_times = unserialize($this->getVariable('tar_times'));
				if (!count($com_times)) {					for($i=1;$i<24;$i++) {
						$com_times[] = $i;
					}
				}
				$i=0;
				if ($this->DBM->NumberOfRows($rs)) {
					while($data=$this->DBM->GetNextRow($rs)) {						$i++;
						$tar_cat .= '<tr><td><input type="radio" id="tc_'.$i.'" name="tar_cat" value="'.$data['id'].'"';
						if ($data['id'] == $this->getVariable('tar_category')) {
							$tar_cat .= ' checked';
						}
						$tar_cat .= '></td><td><label class="labelsimple" for="tc_'.$i.'">'.$data['name'].'</label></td>';
						$tar_cat .= '<td width="50">'.$data['price_show'].' / '.$data['price_show_uniq'].'</td>';
						$tar_cat .= '<td width="50">'.$data['price_click'].' / '.$data['price_click_uniq'].'</td>';
						$tar_cat .= '</tr>';
					}
		    	}
		    	for($i=1;$i<8;$i++) {					$tar_day .= '<input type="checkbox" id="td_'.$i.'" name="tar_day['.$i.']"';
					if (@in_array($i,$com_days)) {						$tar_day .= ' checked';
					}
					$tar_day .= '>'.$this->tpl->week_days[$i].'&nbsp;&nbsp;&nbsp;';
		    	}
				$tar_time = '';
				$e=0;
				for($i=0;$i<24;$i++) {
					if ($e%4==0) {
						$tar_time .= '</tr><tr>';
					}
					$tar_time .= '<td><input type="checkbox" id="tt_'.$i.'" name="tar_time['.$i.']"';
					if (@in_array($i,$com_times)) {
						$tar_time .= ' checked';
					}
					$tar_time .= '></td><td>'.$i.':00 - '.$i.':59</td><td width="30"></td>';
					$e++;
		    	}
		    	$tar_uniq = '<tr>';
		    	$tar_uniq .= '<td>Считать показы ?</td><td><input type="checkbox" name="calc_shows"';
		    	if ($this->getVariable('calc_shows')) {		    		$tar_uniq .= ' checked';
		    	}
		    	$tar_uniq .= '> </td><td width="50"></td><td> Только уникальные показы</td><td><input type="checkbox" name="uniq_shows"';
		    	if ($this->getVariable('uniq_shows') == 1) {					$tar_uniq .= ' checked';
		    	}
		    	$tar_uniq .= ' /></td></tr>';
		    	$tar_uniq .= '<tr>';
		    	$tar_uniq .= '<td>Считать клики ?</td><td><input type="checkbox" name="calc_clicks"';
		    	if ($this->getVariable('calc_clicks')) {
		    		$tar_uniq .= ' checked';
		    	}
		    	$tar_uniq .= '> </td><td width="50"></td><td> Только уникальные клики</td><td><input type="checkbox" name="uniq_shows"';
		    	if ($this->getVariable('uniq_shows') == 1) {
					$tar_uniq .= ' checked';
		    	}
		    	$tar_uniq .= ' /></td></tr>';
				$this->tpl->set('tar_cat',$tar_cat);
				$this->tpl->set('tar_time',$tar_time);
				$this->tpl->set('tar_day',$tar_day);
				$this->tpl->set('tar_uniq',$tar_uniq);
			}
		}
		return $this->tpl->out('account/companies/targeting.edit');
	}

	public function action_targeting_save() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
				if (!$_REQUEST['tar_day']) {     				$_REQUEST['tar_day'] = array(0);
				}else{					foreach($_REQUEST['tar_day'] as $key => $val) {						$tar_day[] = $key;
					}
				}
				if (!$_REQUEST['tar_cat']) {
     				$_REQUEST['tar_cat'] = 1;
				}
				if (!$_REQUEST['tar_time']) {
     				$_REQUEST['tar_time'] = array(0);
				}else{
					foreach($_REQUEST['tar_time'] as $key => $val) {
						$tar_time[] = $key;
					}
				}
				$us = 0;
				$uc = 0;
				if ($_REQUEST['uniq_shows'] == 'on') {					$us = 1;
				}
				if ($_REQUEST['uniq_clicks'] == 'on') {
					$uc = 1;
				}
				if ($_REQUEST['calc_shows'] == 'on') {
					$cs = 1;
				}
				if ($_REQUEST['calc_clicks'] == 'on') {
					$cc = 1;
				}
				$this->setVariable('tar_category',$_REQUEST['tar_cat']);
				$this->setVariable('tar_days',serialize($tar_day));
				$this->setVariable('tar_times',serialize($tar_time));
				$this->setVariable('uniq_shows',$us);
				$this->setVariable('uniq_clicks',$uc);
				$this->setVariable('calc_shows',$cs);
				$this->setVariable('calc_clicks',$cc);
				$this->setVariable('status',0);
				$this->update();

				$this->update_tar_tables();

				$this->session->set_notice('Рекламная компания успешно создана',OK);
				header("Location:/account/companies/index.html");
			}
		}
		$this->session->set_notice('Нет такой компании',ERROR);
	}

	public function update_tar_tables() {		$tar_day = unserialize($this->getVariable('tar_days'));
		if (!count($tar_day)) {
			for($i=1;$i<8;$i++) {
				$tar_day[] = $i;
			}
		}
		$tar_time = unserialize($this->getVariable('tar_times'));
		if (!count($tar_time)) {
			for($i=1;$i<24;$i++) {
				$tar_time[] = $i;
			}
		}
		$SQL = "DELETE FROM `tar_cat` WHERE `id` = '".$this->objectId."'";
		$this->DBM->ExecuteQuery($SQL);
		$SQL = "DELETE FROM `tar_day` WHERE `id` = '".$this->objectId."'";
		$this->DBM->ExecuteQuery($SQL);
		$SQL = "DELETE FROM `tar_hrs` WHERE `id` = '".$this->objectId."'";
		$this->DBM->ExecuteQuery($SQL);

		if ($this->getVariable('status') == 1 && $this->getVariable('tar_category') > 0 && strlen($this->getVariable('informers')) > 4 && $this->getVariable('funds') > 0) {			$SQL = "INSERT DELAYED INTO `tar_cat` SET `id` = '".$this->objectId."', `val` = '".$this->getVariable('tar_category')."'";
  	     	$this->DBM->ExecuteQuery($SQL);
			foreach($tar_day as $key => $val) {
  		      	$SQL = "INSERT DELAYED INTO `tar_day` SET `id` = '".$this->objectId."', `val` = '".$val."'";
  		       	$this->DBM->ExecuteQuery($SQL);
			}
			foreach($tar_time as $key => $val) {
   		       	$SQL = "INSERT DELAYED INTO `tar_hrs` SET `id` = '".$this->objectId."', `val` = '".$val."'";
    	       	$this->DBM->ExecuteQuery($SQL);
			}
		}
	}

	public function show_balance() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {				$this->load_tpl_vars();            	return $this->tpl->out('account/companies/balance');
			}
		}
	}

	public function show_reports() {  		$this->user->have_access();
  		if ($this->get(intval($_REQUEST['id']))) {
  			if ($this->getVariable('owner') == $this->user->objectId) {
            	if (!$_REQUEST['year']) {
            		$_REQUEST['year'] = date('Y');
            	}
            	if (!$_REQUEST['month']) {
            		$_REQUEST['month'] = date('n');
            	}
            	if (!$_REQUEST['day']) {
            		$_REQUEST['day'] = date('j');
            	}
            	if (!$_REQUEST['type']) {
            		$_REQUEST['type'] = 'all';
            	}
            	$log = 'data/companies/'.$this->objectId.'/logs/'.$_REQUEST['year'].'/'.$_REQUEST['month'].'/'.$_REQUEST['day'].'.log';
            	$str = $this->tpl->out('account/companies/reports/start');
            	if (file_exists($log)) {
            		$data = file($log);
            		foreach($data as $i => $line) {
               			list($time,$type,$show_uniq,$show,$com,$ip,$site,$ref) = explode("\t",$line);
               			if ($type == $_REQUEST['type'] || $_REQUEST['type'] == 'all') {
               				$this->tpl->set('l_time',date('H:i:s',$time));
               				if ($type == 'show') {
               					$this->tpl->set('l_shows',$show.'/'.$show_uniq);
               				}else{
                            	$this->tpl->set('l_clicks',$show.'/'.$show_uniq);
               				}
							$this->tpl->set('l_ip',$ip);
							$this->tpl->set('l_ref',$ref);
							$str .= $this->tpl->out('account/companies/reports/row');
						}
            		}
            	}else{
            		$str .= $this->tpl->out('account/companies/reports/row2');
            	}

				$str .= $this->tpl->out('account/companies/reports/end');
  			}else{  				echo 'ERROR #147';
  			}
  		}else{  			echo 'ERROR #146';
  		}
  		return $str;
	}

	public function action_save_balance() {
		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->user->objectId == $this->getVariable('owner')) {
				$this->load_tpl_vars();
                if ($_REQUEST['funds_put'] > 0) {                	$f = $_REQUEST['funds_put'];
                	if ($this->user->getVariable('balance') >= $f) {                		$this->increaseVariable('funds',$f);
                		$this->user->decreaseVariable('balance',$f);
                		$this->update();
                		$this->user->update();
                		$SQL = "SELECT * FROM `tar_cat` WHERE `id` = '".$this->objectId."' LIMIT 1";
                		list($ex) = $this->DBM->SingleRowQuery($SQL);
                		if(!$ex) {                        	$this->update_tar_tables();
                		}
	               	} else {                		$this->session->set_notice('Запрошенная сумма превышает ваш баланс',ERROR);
                	}
                } elseif($_REQUEST['funds_take'] > 0) {                	$f = $_REQUEST['funds_take'];
                		if ($this->getVariable('funds') >= $f) {
	                		$this->decreaseVariable('funds',$f);
	                		$this->user->increaseVariable('balance',$f);
	                		$this->update();
	                		$this->user->update();
                	} else {
                		$this->session->set_notice('Запрошенная сумма превышает ваш баланс',ERROR);
                	}
                } else {                	$this->session->set_notice('Недопустимая операция',ERROR);
                }
			}
		}
	}

}
?>
