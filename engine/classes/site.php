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

class Site Extends DBObject{

	public $__table = 'sites';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'site';

	public function __construct($id=FALSE) {		global $DBM,$session,$user;
		$this->user = &$user;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	public function build_dir_tree() {
		mkdir($_SERVER['DOCUMENT_ROOT'].'/data/sites/'.$this->objectId.'/logs',0777,TRUE);
	}

	public function action_add() {		$this->user->have_access();
		if (count($_REQUEST['cat'])) {			foreach($_REQUEST['cat'] as $c => $val) {
				$cats[] = $c;
			}
		}
		$this->setVariable('categories',serialize($cats));   		$this->setVariable('owner',$this->user->objectId);
   		$this->setVariable('url',$_REQUEST['url']);
   		$this->setVariable('status',0);
   		$this->setVariable('price_click',$cat['price_click']);
   		$this->setVariable('price_click_uniq',$cat['price_click_uniq']);
   		$this->setVariable('price_show',$cat['price_show']);
   		$this->setVariable('price_show_uniq',$cat['price_show_uniq']);
		$this->objectId = $this->insert();
		$this->build_dir_tree();
		$this->session->set_notice('Сайт успешно добавлен и ожидает проверки модератором',OK);
		return TRUE;
	}

	public function action_save() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {			if ($this->getVariable('owner') == $this->user->objectId) {  				if ($_REQUEST['cat']) {  					$this->setVariable('owner',$this->user->objectId);
  		  			$this->setVariable('url',$_REQUEST['url']);
  		  			foreach($_REQUEST['cat'] as $c => $val) {  		  				$cats[] = $c;	  				}
  		  			$this->setVariable('categories',serialize($cats));
  		  			$this->setVariable('status',0);
    				$this->setVariable('price_click',$cat['price_click']);
    				$this->setVariable('price_click_uniq',$cat['price_click_uniq']);
    				$this->setVariable('price_show',$cat['price_show']);
    				$this->setVariable('price_show_uniq',$cat['price_show_uniq']);
    				$this->update();
					$this->session->set_notice('Сайт успешно сохранен и ожидает проверки модератором',OK);
					return TRUE;
				}else{					$this->session->set_notice('Не указана ни одна категория',ERROR);
					return FALSE;
				}
			}else{				$this->session->set_notice('Вы не являетесь владельцем сайта',ERROR);
				return FALSE;
			}
		}
		$this->session->set_notice('Нет такого сайта',ERROR);
		return FALSE;
	}

	public function action_delete() {		$this->user->have_access();		if ($this->get(intval($_REQUEST['id']))) {			if ($this->getVariable('owner') == $this->user->objectId) {				$this->delete_dir_tree('data/sites/'.$this->objectId);				if ($this->delete()) {		        	$this->session->set_notice('���� ������� ������',OK);
	 		       	return TRUE;
	 			}else{	 				$this->session->set_notice('Сайт не может быть удален',ERROR);
	 			}
	 		}
		}
		$this->session->set_notice('Нет такого сайта',ERROR);
		return FALSE;
	}

	public function show_edit() {
		$this->user->have_access();		if ($this->get(intval($_REQUEST['id']))) {			if ($this->getVariable('owner') == $this->user->objectId) {				$this->load_tpl_vars();
				$tar_cat = '';
				$com_cats = unserialize($this->getVariable('categories'));
				if (!count($cats)) {
					$cats = array();
				}
				$SQL = "SELECT * FROM `categories` WHERE 1";
				$rs = $this->DBM->ExecuteQuery($SQL);
				if ($this->DBM->NumberOfRows($rs)) {					$i=0;
					while($data=$this->DBM->GetNextRow($rs)) {
						$tar_cat .= '<tr><td><input type="checkbox" id="c_'.$i.'" name="cat['.$data['id'].']"';
						if (@in_array($data['id'],$com_cats)) {
							$tar_cat .= ' checked';
						}
						$tar_cat .= '></td><td><label class="labelsimple" for="c_'.$i.'">'.$data['name'].'</label></td>';
						$tar_cat .= '<td width="50">'.(($data['price_show']/100)*(100-$this->sys['perc'])).' / '.(($data['price_show_uniq']/100)*(100-$this->sys['perc'])).'</td>';
						$tar_cat .= '<td width="50">'.(($data['price_click']/100)*(100-$this->sys['perc'])).' / '.(($data['price_click_uniq']/100)*(100-$this->sys['perc'])).'</td>';
						$tar_cat .= '</tr>';
						$i++;
		    		}
		    	}
		    	$this->tpl->set('i_max',$i);
		    	$this->tpl->set('cats',$tar_cat);				return $this->tpl->out('account/sites/edit');
			}
		}
	}

	public function show_add() {
		$this->user->have_access();		$tar_cat = '';
		$com_cats = unserialize($this->getVariable('categories'));
		if (!count($cats)) {
			$cats = array();
		}
		$SQL = "SELECT * FROM `categories` WHERE 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			$i=0;
			while($data=$this->DBM->GetNextRow($rs)) {
				if ($i%3==0) {
					$tar_cat .= '<tr>';
				}
				$tar_cat .= '<td><input type="checkbox" id="c_'.$i.'" name="cat['.$data['id'].']"';
				if (@in_array($data['id'],$com_cats)) {
					$tar_cat .= ' checked';
				}
				$tar_cat .= '></td><td><label class="labelsimple" for="c_'.$i.'">'.$data['name'].'</label></td>';
				$tar_cat .= '<td width="50">'.(($data['price_show']/10*9)).' / '.(($data['price_show_uniq']/10*9)).'</td>';
				$tar_cat .= '<td width="50">'.(($data['price_click']/10*9)).' / '.(($data['price_click_uniq']/10*9)).'</td>';
				$tar_cat .= '</tr>';
				$i++;
    		}
    	}
    	$this->tpl->set('i_max',$i);
    	$this->tpl->set('cats',$tar_cat);
		return $this->tpl->out('account/sites/add');
	}

	public function show_my_list() {		$this->user->have_access();		$SQL = "SELECT * FROM `sites` WHERE `owner` = '".$this->user->objectId."'";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($rs) {
			$str = $this->tpl->out('account/sites/my.list.start');
			$i = 0;
			while($data=$this->DBM->GetNextRow($rs)) {				if ($i%2==0) {					$this->tpl->set('site_row_color','#F8F8F8');
				}else{
                	$this->tpl->set('site_row_color','#F0F0F0');
				}
				$i++;
            	$this->load($data);
 				$this->load_tpl_vars();
				$str .= $this->tpl->out('account/sites/my.list.row');
			}
			$str .= $this->tpl->out('account/sites/my.list.end');
			return $str;
		}	}

	public function show_reports() {		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->getVariable('owner') == $this->user->objectId) {            	$this->load_tpl_vars();
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
            	$log = 'data/sites/'.$this->objectId.'/logs/'.$_REQUEST['year'].'/'.$_REQUEST['month'].'/'.$_REQUEST['day'].'.log';
            	#$str = $this->tpl->out('account/sites/reports/start');
            	if (file_exists($log)) {
            		$data = file($log);
            		foreach($data as $i => $line) {
               			list($time,$type,$show_uniq,$show,$ip,$ref) = explode("\t",$line);
               			if ($type == $_REQUEST['type'] || $_REQUEST['type'] == 'all') {               				$this->tpl->set('l_time',date('H:i:s',$time));
               				if ($type == 'show') {	               				$g[date('H',$time)]['show']++;
               					$this->tpl->set('l_shows',$show.'/'.$show_uniq);
               				}else{	               				$g[date('H',$time)]['click']++;
                            	$this->tpl->set('l_clicks',$show.'/'.$show_uniq);
               				}
							$this->tpl->set('l_ip',$ip);
							$this->tpl->set('l_ref',$ref);
							$str .= $this->tpl->out('account/sites/reports/row');
						}
            		}
            	}else{
            		$str .= $this->tpl->out('account/sites/reports/row2');
            	}
				$str .= $this->tpl->out('account/sites/reports/end');
   				$str = $this->tpl->out('account/sites/reports/start').$str;
				return $str;
			}
		}
	}

	public function show_code() {  		$this->user->have_access();
		if ($this->get(intval($_REQUEST['id']))) {
			if ($this->getVariable('owner') == $this->user->objectId) {				$this->load_tpl_vars();
				if (!$_REQUEST['cols']) {					$_REQUEST['cols'] = 4;
				}
				for($i=1;$i<20;$i++) {					$t[$i] = $i;
				}
				$this->tpl->set('s_cols',$this->tpl->get_select_form('cols',$t,$_REQUEST['cols'],'cols'));
				if (!$_REQUEST['rows']) {
					$_REQUEST['rows'] = 1;
				}
				if (!$_REQUEST['bgcolor']) {
					$_REQUEST['bgcolor'] = '#f5f5f5';
				}
				if (!$_REQUEST['acolor']) {
					$_REQUEST['acolor'] = '#000000';
				}
				if (!$_REQUEST['ahover']) {
					$_REQUEST['ahover'] = '#777777';
				}
				if (!$_REQUEST['font']) {
					$_REQUEST['font'] = 'Verdana';
				}
				if (!$_REQUEST['font_size']) {
					$_REQUEST['font_size'] = '12px';
				}
				if (!$_REQUEST['font_type']) {
					$_REQUEST['font_type'] = 'regular';
				}
				if (!$_REQUEST['text_dir']) {
					$_REQUEST['text_dir'] = '0';
				}
				if (!$_REQUEST['decoration']) {
					$_REQUEST['decoration'] = 'none';
				}
				if (!$_REQUEST['iw']) {
					$_REQUEST['iw'] = 75;
				}
				if (!$_REQUEST['ih']) {
					$_REQUEST['ih'] = 75;
				}
				if (!$_REQUEST['tizer_formats']) {					$_REQUEST['tizer_formats'] = $this->sys['tizer_formats'][0]['w'].'x'.$this->sys['tizer_formats'][0]['h'];
				}
				foreach($this->sys['tizer_formats'] as $i => $f) {
					$tf[$f['w'].'x'.$f['h']] = $f['w'].'x'.$f['h'];
				}
				list($iw,$ih) = explode('x',$_REQUEST['tizer_formats']);
				$this->tpl->set('tizer_formats',$this->tpl->get_select_form('tizer_formats',$tf,$_REQUEST['tizer_formats']));

				$this->tpl->set('s_rows',$this->tpl->get_select_form('rows',array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6),$_REQUEST['rows'],'rows'));
				$this->tpl->set('s_text_dir',$this->tpl->get_select_form('text_dir',array('Справа от картинки','Слева от картинки','Под картинкой','Над картинкой'),$_REQUEST['text_dir'],'text_dir'));
				$this->tpl->set('s_font',$this->tpl->get_select_form('font',array('Verdana'=>'Verdana','Arial'=>'Arial','Tahoma'=>'Tahoma','Times New Roman'=>'Times New Roman'),$_REQUEST['font'],'font'));
				$this->tpl->set('s_font_type',$this->tpl->get_select_form('font_type',array('Regular'=>'Обычный','Bold'=>'Полужирный'),$_REQUEST['font_type'],'font_type'));
				$this->tpl->set('s_decoration',$this->tpl->get_select_form('decoration',array('underline'=>'Да','none'=>'Нет'),$_REQUEST['decoration'],'decoration'));
				$this->tpl->set('s_font_size',$this->tpl->get_select_form('font_size',array(10=>'10px',11=>'11px',12=>'12px',13=>'13px',14=>'14px',16=>'16px',),$_REQUEST['font_size'],'font_size'));
				$code = "<!---Tizer Start " . $this->sys['title'] . "-->\r\n";
				$code .= '<iframe src="'.$this->sys['url'].'get_tizer.php?site='.$this->objectId.'&';
				$code .= 'cols='.$_REQUEST['cols'].'&rows='.$_REQUEST['rows'].'&bgcolor='.str_replace('#','',$_REQUEST['bgcolor']).'&';
				$code .= 'acolor:'.str_replace('#','',$_REQUEST['acolor']).'&ahover='.str_replace('#','',$_REQUEST['ahover']).'&font='.$_REQUEST['font'].'&';
				$code .= 'font_type='.$_REQUEST['font_type'].'&font_size='.$_REQUEST['font_size'].'&text_dir='.$_REQUEST['text_dir'].'&';
				$code .= 'decoration='.$_REQUEST['decoration'].'&iw='.$_REQUEST['iw'].'&ih='.$_REQUEST['ih'].'&iborder='.str_replace('#','',$_REQUEST['iborder']).'&format='.$_REQUEST['tizer_formats'].'"';
				$code .= ' width="100%" height="'.(($ih+20)*$_REQUEST['rows']).'" ';
				$code .= 'marginwidth="0" marginheight="0" scrolling="no" frameborder="0"></iframe>';
				$code .= "\r\n<!---Tizer End-->\r\n";
				/*
				$code = "<!--Tizer Start-->\r\n";
				$code .= '<iframe src="'.$this->sys['url'].'tizers/'.$this->objectId.'/';
				$code .= 'cols:'.$_REQUEST['cols'].';rows:'.$_REQUEST['rows'].';bgcolor:'.str_replace('#','',$_REQUEST['bgcolor']).';';
				$code .= 'acolor:'.str_replace('#','',$_REQUEST['acolor']).';ahover:'.str_replace('#','',$_REQUEST['ahover']).';font:'.$_REQUEST['font'].';';
				$code .= 'font_type:'.$_REQUEST['font_type'].';font_size:'.$_REQUEST['font_size'].';text_dir:'.$_REQUEST['text_dir'].';';
				$code .= 'decoration:'.$_REQUEST['decoration'].';iw:'.$_REQUEST['iw'].';ih:'.$_REQUEST['ih'].';iborder:'.str_replace('#','',$_REQUEST['iborder']).'"';
				$code .= ' width="100%" height="'.(100*$_REQUEST['rows']).'" ';
				$code .= 'marginwidth="0" marginheight="0" scrolling="no" frameborder="0"></iframe>';
				$code .= "\r\n<!--Tizer End-->\r\n";
				*/
				$this->tpl->set('code',$code);
				$this->tpl->set('code2',str_replace('.php?','.php?test=1&',$code));
   				return $this->tpl->out('account/sites/code');
			}
		}
	}

}
?>
