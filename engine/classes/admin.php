<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://chronodev.ru | http://aklykov.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/
require_once('engine/security.php');

class Admin{

	public $acc_types = array(1=>'Вебмастер', 2=>'Рекламодатель');

	public function __construct($id=FALSE) {		global $DBM,$session,$tpl,$sys;
		$this->sys = $sys;
		$this->DBM = $DBM;
		$this->tpl = $tpl;
		$this->session = $session;
	}

	public function show_settings() {
		$this->tpl->set('s_pt',$this->tpl->get_select_form('sys[payout_type]',array('mp'=>'MassPay Service',
			'x2'=>'Автоматически через X2 интерфейс'), $this->sys['payout_type']));
		foreach($this->sys['tizer_formats'] as $i => $f) {
			$tf .= $f['w'].'x'.$f['h']."\r\n";
		}
		$this->tpl->set('tizer_formats',$tf);
		$this->tpl->set('version_mte', VERSION_MTE);

		return $this->tpl->out('admin/settings');
	}

	public function action_save_settings() {		$str = "<?php\r\n";
		foreach($_REQUEST['sys'] as $key => $val) {
			$str .= "\$sys['".$key."'] = '".$val."';\r\n";
		}
		$tf = explode("\r\n",$_REQUEST['sys']['tizer_formats']);
		$str .= "\$sys['tizer_formats'] = array(";

		foreach($tf as $i => $val) {			preg_match("|^([0-9]{2,3}).{1}([0-9]{2,3})$|Uims",$val,$m);
			$w = $m[1];
			$h = $m[2];
			if ($w > 0 && $h > 0) {				$str .= $i."=>array('w'=>".$w.",'h'=>".$h."),";
			}
		}
		$str .= ");\r\n";
		$str .= '?>';
		$f = fopen('config/main.php','w');
		fwrite($f,$str);
		fclose($f);
		header("Location:/admin.php?show=settings");
	}

	public function show_users() {		$SQL = "SELECT * FROM `users` WHERE 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$this->tpl->set('total_users',$this->DBM->NumberOfRows($rs));
		$str = $this->tpl->out('admin/users/list.start');
		require_once(CLASSES_PATH.'user.php');
		$user = new user();
		while($data=$this->DBM->GetNExtROw($rs)) {			$user->load($data);
			$user->load_tpl_vars();
			$this->tpl->set('user_acc_type',$this->acc_types[$user->getVariable('type')]);
			$str .= $this->tpl->out('admin/users/list.row');
		}
		$str .= $this->tpl->out('admin/users/list.end');
		return $str;
	}

	public function show_edit_user() {		require_once(CLASSES_PATH.'user.php');
		$user = new user();
		if ($user->get($_REQUEST['id'])) {			$user->load_tpl_vars();
			return $this->tpl->out('admin/users/edit');
		}
	}

	public function action_save_user() {		require_once(CLASSES_PATH.'user.php');
		$user = new user();
		if ($user->get($_REQUEST['id'])) {
			$user->setVariable('login',$_REQUEST['login']);
			$user->setVariable('email',$_REQUEST['email']);
			$user->setVariable('name',$_REQUEST['name']);
			$user->setVariable('wmid',$_REQUEST['wmid']);
			$user->setVariable('wmz',$_REQUEST['wmz']);
			$user->setVariable('statinf',$_REQUEST['statinf']);
			$user->setVariable('balance',$_REQUEST['balance']);
			if (isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 0) {				$user->setVariable('password',md5($_REQUEST['password']));
			}
			$user->update();
			return $this->tpl->out('admin/users/edit');
		}
	}

	public function action_delete_user() {		$SQL = "DELETE FROM `users` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);

		$SQL = "SELECT * FROM `informers` WHERE `owner` = '".$_REQUEST['id']."' LIMIT 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			while($data=$this->DBM->GetNextRow($rs)) {				$this->delete_dir_tree('data/informers/'.$data['id']);
			}
		}
		$SQL = "DELETE FROM `informers` WHERE `owner` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);

		$SQL = "SELECT * FROM `sites` WHERE `owner` = '".$_REQUEST['id']."' LIMIT 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			while($data=$this->DBM->GetNextRow($rs)) {
				$this->delete_dir_tree('data/sites/'.$data['id']);
			}
		}
		$SQL = "DELETE FROM `sites` WHERE `owner` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);


		$SQL = "SELECT * FROM `companies` WHERE `owner` = '".$_REQUEST['id']."' LIMIT 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {			while($data=$this->DBM->GetNextRow($rs)) {				$this->delete_dir_tree('data/companies/'.$data['id']);
			$SQL = "DELETE FROM `tar_cat` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "DELETE FROM `tar_day` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "DELETE FROM `tar_hrs` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
		}
		}
	}

	public function delete_dir_tree($path) {		if (file_exists($path)) {			if (is_dir($path)) {				$dir = scandir($path);
		unset($dir[0],$dir[1]);
		foreach($dir as $key => $val) {    				$file = $path.'/'.$val;    				if (is_dir($file)) {    					$this->delete_dir_tree($file);
		}else{						unlink($file);
		}
		}
		rmdir($path);
	}else{    			unlink($path);
	}
	}
	}

	public function get_users_logins() {		$SQL = "SELECT `id`,`login` FROM `users`";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$this->users_logins = array();
		while($data=$this->DBM->GetNextRow($rs)) {
			$this->users_logins[$data['id']] = $data['login'];
		}
	}

	public function show_sites() {		$SQL = "SELECT * FROM `sites`";
		if ($_REQUEST['byuserid']) {			$SQL .= " WHERE `owner` = '".$_REQUEST['byuserid']."'";
		}
		if ($_REQUEST['pending'] == 1) {			$SQL .= " WHERE `status` = '0'";
			$this->tpl->set('pend_app','&pending=1');
		}else{			$this->tpl->set('pend_app',FALSE);
		}
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfROws($rs)) {			$this->tpl->set('total_sites',$this->DBM->NumberOfRows($rs));
			$str = $this->tpl->out('admin/sites/list.start');
			require_once(CLASSES_PATH.'site.php');
			$site = new Site();
			$this->get_users_logins();
			while($data=$this->DBM->GetNExtROw($rs)) {
				$site->load($data);
				$site->load_tpl_vars();
				$this->tpl->set('site_owner_user',$this->users_logins[$data['owner']]);
				$str .= $this->tpl->out('admin/sites/list.row');
			}
			$str .= $this->tpl->out('admin/sites/list.end');
			return $str;
		}
	}

	public function action_stat_site() {		$SQL = "UPDATE `sites` SET `status` = '".(int)$_REQUEST['stat']."' WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function action_stat_com() {
		$SQL = "UPDATE `companies` SET `status` = '".(int)$_REQUEST['stat']."' WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get($_REQUEST['id'])) {        	$com->update_tar_tables();
		}

	}

	public function show_edit_site() {		require_once(CLASSES_PATH.'site.php');
		$site = new Site();
		if ($site->get($_REQUEST['id'])) {
			$site->load_tpl_vars();
			$tar_cat = '';
			$com_cats = unserialize($site->getVariable('categories'));
			if (!count($cats)) {
				$cats = array();
			}
			$SQL = "SELECT * FROM `categories` WHERE 1";
			$rs = $this->DBM->ExecuteQuery($SQL);
			if ($this->DBM->NumberOfRows($rs)) {				$i=0;
				while($data=$site->DBM->GetNextRow($rs)) {					$tar_cat .= '<tr><td><input type="checkbox" id="c_'.$i.'" name="cat['.$data['id'].']"';
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
			$this->tpl->set('cats',$tar_cat);			return $this->tpl->out('admin/sites/edit');
		}
	}

	public function action_save_site() {		require_once(CLASSES_PATH.'site.php');
		$site = new Site();
		if ($site->get($_REQUEST['id'])) { 			$site->setVariable('url',$_REQUEST['url']);
			foreach($_REQUEST['cat'] as $c => $val) {
				$cats[] = $c;
			}
			$site->setVariable('categories',serialize($cats));
			$site->setVariable('status',1);
			$site->update();
		}
	}

	public function action_delete_site() {		$this->delete_dir_tree('data/sites/'.intval($_REQUEST['id']));
		$SQL = "DELETE FROM `sites` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function show_tizers() {
		require_once(CLASSES_PATH.'informer.php');
		$inf = new Informer();		$SQL = "SELECT * FROM `informers`";
		if ($_REQUEST['byuserid']) {
			$SQL .= " WHERE `owner` = '".$_REQUEST['byuserid']."'";
		}
		$rs = $this->DBM->ExecuteQuery($SQL);
		$str = $this->tpl->out('admin/tizers/my.list.start');
		if ($this->DBM->NumberOfRows($rs)) {
			$i=0;
			$this->get_users_logins();
			while($data=$this->DBM->GetNextRow($rs)) {
				if ($i%2==0) {
					$this->tpl->set('inf_row_color','#F8F8F8');
				}else{
					$this->tpl->set('inf_row_color','#F0F0F0');
				}
				$i++;
				$inf->load($data);
				$inf->load_tpl_vars();
				$this->tpl->set('inf_owner_user',$this->users_logins[$data['owner']]);
				$str .= $this->tpl->out('admin/tizers/my.list.row');
			}
		}
		$str .= $this->tpl->out('admin/tizers/my.list.end');
		return $str;
	}

	public function show_edit_tizer() {		require_once(CLASSES_PATH.'informer.php');
		$inf = new Informer();
		if ($inf->get($_REQUEST['id'])) {   			$inf->load_tpl_vars();
			return $this->tpl->out('admin/tizers/edit');
		}
	}

	public function action_save_tizer() {		require_once(CLASSES_PATH.'informer.php');
		$inf = new Informer();
		if ($inf->get(intval($_REQUEST['id']))) {
			$inf->previous_image = $inf->getVariable('image');
			$inf->setVariable('text',$_REQUEST['text']);
			$inf->setVariable('url',$_REQUEST['url']);
			if ($inf->upload_image()) {				$inf->setVariable('image',$_FILES['image']['name']);
				@unlink($_SERVER['DOCUMENT_ROOT'].'/data/informers/'.$this->objectId.'/'.$this->previous_image);
			}
			$inf->update();
		}
	}

	public function action_delete_tizer() {
		$SQL = "DELETE FROM `informers` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQUery($SQL);		$this->delete_dir_tree('data/informers/'.intval($_REQUEST['id']));
	}

	public function show_site_reports() {
		require_once(CLASSES_PATH.'site.php');
		$site = new Site();		if ($site->get(intval($_REQUEST['id']))) {
			$site->load_tpl_vars();
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
			$log = 'data/sites/'.$site->objectId.'/logs/'.$_REQUEST['year'].'/'.$_REQUEST['month'].'/'.$_REQUEST['day'].'.log';
			$str = $this->tpl->out('admin/sites/reports/start');
			if (file_exists($log)) {
				$data = file($log);
				foreach($data as $i => $line) {
					list($time,$type,$show_uniq,$show,$ip,$ref) = explode("\t",$line);
					if ($type == $_REQUEST['type'] || $_REQUEST['type'] == 'all') {
						$site->tpl->set('l_time',date('H:i:s',$time));
						if ($type == 'show') {
							$site->tpl->set('l_shows',$show.'/'.$show_uniq);
						}else{
							$site->tpl->set('l_clicks',$show.'/'.$show_uniq);
						}
						$site->tpl->set('l_ip',$ip);
						$site->tpl->set('l_ref',$ref);
						$str .= $site->tpl->out('admin/sites/reports/row');
					}
				}
			}else{
				$str .= $site->tpl->out('admin/sites/reports/row2');
			}
			$str .= $site->tpl->out('admin/sites/reports/end');
			return $str;
		}
	}

	public function show_tizer_reports() {
		require_once(CLASSES_PATH.'informer.php');
		$inf = new Informer();
		if ($inf->get(intval($_REQUEST['id']))) {
			$inf->load_tpl_vars();
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
			$log = 'data/informers/'.$inf->objectId.'/logs/'.$_REQUEST['year'].'/'.$_REQUEST['month'].'/'.$_REQUEST['day'].'.log';
			$str = $this->tpl->out('admin/tizers/reports/start');
			if (file_exists($log)) {
				$data = file($log);
				foreach($data as $i => $line) {
					list($time,$type,$show_uniq,$show,$com,$ip,$site,$ref) = explode("\t",$line);
					if ($type == $_REQUEST['type'] || $_REQUEST['type'] == 'all') {
						$this->tpl->set('l_time',date('H:i:s'));
						if ($type == 'show') {
							$this->tpl->set('l_shows',$show.'/'.$show_uniq);
						}else{
							$this->tpl->set('l_clicks',$show.'/'.$show_uniq);
						}
						$this->tpl->set('l_ip',$ip);
						$this->tpl->set('l_ref',$ref);
						$str .= $this->tpl->out('admin/tizers/reports/row');
					}
				}

			}else{
				$str .= $inf->tpl->out('admin/tizers/reports/row2');
			}
			$str .= $inf->tpl->out('admin/tizers/reports/end');
			return $str;
		}
	}

	public function show_payouts() {		$SQL = "SELECT * FROM `users` WHERE `balance` > 1 AND `type` = 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {			$this->tpl->set('payments_waiting',$this->DBM->NumberOfRows($rs));
			$str = $this->tpl->out('admin/funds/webmasters/list.start');
			require_once(CLASSES_PATH.'user.php');
			$user = new user();
			$money = 0;
			while($data=$this->DBM->GetNextROw($rs)) {
				$user->load($data);
				$user->load_tpl_vars();
				$money += $data['balance'];
				$this->tpl->set('user_balance2',number_format($user->getVariable('balance'),2));
				$this->tpl->set('user_acc_type',$this->acc_types[$user->getVariable('type')]);
				$str .= $this->tpl->out('admin/funds/webmasters/list.row');
			}
			$str .= $this->tpl->out('admin/funds/webmasters/list.end');
		}
		$this->tpl->set('list',$str);
		$this->tpl->set('total_money',$money);    	return $this->tpl->out('admin/funds/payments');
	}

	public function action_form_mptf() {		$SQL = "SELECT * FROM `users` WHERE `balance` > 1 AND `type` = 1";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			while($data=$this->DBM->GetNextRow($rs)) {				if (preg_match("/(Z[0-9]*)/i",$data['wmz'])) {					$str .= "\t<payment>\r\n";
				$str .= "\t\t<Destination>".$data['wmz']."</Destination>\r\n";
				$str .= "\t\t<Amount>".$data['balance']."</Amount>\r\n";
				$str .= "\t\t<Description>Вывод средств из сервиса ".$this->sys['url']."</Description>\r\n";
				$str .= "\t\t<Id>".$data['id']."</Id>\r\n";
				$str .= "\t</payment>\r\n";
				$SQL = "UPDATE `users` SET `balance` = balance-".$data['balance']." WHERE `id` = '".$data['id']."' LIMIT 1";
				$this->DBM->ExecuteQuery($SQL);
				if ($data['referrer']) {						$perc = (($data['balance']/100)*$this->sys['ref_perc']);
					$SQL = "UPDATE `users` SET `balance`=balance+".(float)$perc.",`ref_balance`=ref_balance+".(float)$perc." WHERE `id` = '".$data['referrer']."' LIMIT 1";
					$this->DBM->ExecuteQuery($SQL);
				}
				$SQL = "INSERT DELAYED INTO `wm_payout` SET `type` = 1, `user` = '".$data['id']."', `time` = '".time()."', `status` = 1, `summ` = '".$data['balance']."'";
				$this->DBM->ExecuteQuery($SQL);
			}
			}
		}
		$f = fopen('data/mptf/'.date('Y-m-d H_i').'.xml','w');
		fwrite($f,$str);
		fclose($f);
	}

	public function show_payments() {		if (!$_REQUEST['from']) {			$_REQUEST['from'] = date('Y-m-d');
	}
		if (!$_REQUEST['to']) {
			$_REQUEST['to'] = date('Y-m-d');
		}
		list($fy,$fm,$fd) = explode('-',$_REQUEST['from']);
		list($ty,$tm,$td) = explode('-',$_REQUEST['to']);
		$this->tpl->set('s_type',$this->tpl->get_select_form('type',array(2=>'Ввод средств'),$_REQUEST['type']));
		$SQL = "SELECT * FROM `wm_pay` WHERE `time` BETWEEN ".mktime(0,0,0,$fm,$fd,$fy)." AND ".mktime(59,59,23,$tm,$td,$ty)." AND `status` = 2";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {			while($data=$this->DBM->GetNextRow($rs)) {				$this->tpl->set('log_time',date('Y-m-d H:i:s',$data['time']));
			$this->tpl->set('log_summ',$data['summ']);
			$SQL = "SELECT `login` FROM `users` WHERE `id` = '".$data['user']."' LIMIT 1";
			list($this->tpl->vars['log_user']) = $this->DBM->SingleRowQuery($SQL);				$str .= $this->tpl->out('admin/payments/row');
		}
			$this->tpl->set('reports',$str);
		}
		return $this->tpl->out('admin/payments/main');
	}

	public function show_payouts_reports() {
		if (!$_REQUEST['from']) {
			$_REQUEST['from'] = date('Y-m-d');
		}
		if (!$_REQUEST['to']) {
			$_REQUEST['to'] = date('Y-m-d');
		}
		if (!$_REQUEST['type']) {			$_REQUEST['type'] = 1;
		}
		list($fy,$fm,$fd) = explode('-',$_REQUEST['from']);
		list($ty,$tm,$td) = explode('-',$_REQUEST['to']);
		$this->tpl->set('s_type',$this->tpl->get_select_form('type',array(1=>'MassPay выплаты',2=>'Автоматические выплаты'),$_REQUEST['type']));
		$SQL = "SELECT * FROM `wm_payout` WHERE `type` = ".(int)$_REQUEST['type']." AND `time` BETWEEN ".mktime(0,0,0,$fm,$fd,$fy)." AND ".mktime(59,59,23,$tm,$td,$ty);
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			while($data=$this->DBM->GetNextRow($rs)) {
				$this->tpl->set('log_time',date('Y-m-d H:i:s',$data['time']));
				$this->tpl->set('log_summ',$data['summ']);
				$SQL = "SELECT `login` FROM `users` WHERE `id` = '".$data['user']."' LIMIT 1";
				list($this->tpl->vars['log_user']) = $this->DBM->SingleRowQuery($SQL);
				$str .= $this->tpl->out('admin/payout/row');
			}
			$this->tpl->set('reports',$str);
		}
		return $this->tpl->out('admin/payout/main');
	}


	public function show_news() {		$SQL = "SELECT * FROM `news` ORDER BY `time` DESC";
		$rs = $this->DBM->ExecuteQuery($SQL);
		if ($this->DBM->NumberOfRows($rs)) {
			$news = '';
			while($data=$this->DBM->GetNextRow($rs)) {
				$news .= '<li><b>'.date('Y.m.d',$data['time']).'</b><br/>'.$data['short'];
				$news .= '<a href="admin.php?action=delete_news&show=news&id='.$data['id'].'">[Удалить]</a></li><br>';
			}
		}
		$this->tpl->set('news',$news);
		return $this->tpl->out('admin/news');;
	}

	public function action_add_news() {		$SQL = "INSERT DELAYED INTO `news` SET `time` = '".time()."', `short` = '".$_REQUEST['short']."',`full` = '".$_REQUEST['full']."'";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function action_delete_news() {		$SQL = "DELETE FROM `news` WHERE `id` = '".$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function show_massmail() {  		return $this->tpl->out('admin/mass.mail');
	}

	public function action_massmail() {		$SQL = "SELECT * FROM `users`";
		$rs = $this->DBM->ExecuteQuery($SQL);
		while($data=$this->DBM->GetNextRow($rs)) {			$msg = $_REQUEST['body'];			$msg = str_ireplace('%NAME%',$data['name'],$msg);
			$msg = str_ireplace('%LOGIN%',$data['login'],$msg);
			mail($data['email'],$this->sys['title'].' > '.$_REQUEST['title'],$msg,"From: ".$this->sys['massmail_email']."\r\nContent-type: text/html; charset=utf-8\r\n");
		}
	}

	public function show_cats() {  		$SQL = "SELECT * FROM `categories`";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$str = $this->tpl->out('admin/cats/list.start');
		while($data=$this->DBM->GetNextRow($rs)) {  			foreach($data as $key => $val) {  				$this->tpl->set('cat_'.$key,$val);
		}	  		$str .= $this->tpl->out('admin/cats/list.row');
		}
		$str .= $this->tpl->out('admin/cats/list.end');
		return $str;
	}

	public function action_add_cat() {		$SQL = "INSERT INTO `categories` SET
			`price_show` = '".(float)$_REQUEST['price_show']."',
			`price_show_uniq` = '".(float)$_REQUEST['price_show_uniq']."',
			`price_click` = '".(float)$_REQUEST['price_click']."',
			`price_click_uniq` = '".(float)$_REQUEST['price_click_uniq']."',
			`name` = '".$_REQUEST['name']."'";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function action_delete_cat() {  		$SQL = "DELETE FROM `categories` WHERE `id` = '".(int)$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
	}

	public function show_companies() {		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		$SQL = "SELECT * FROM `companies`";
		if ($_REQUEST['byuserid']) {
			$SQL .= " WHERE `owner` = '".$_REQUEST['byuserid']."'";
		}
		if ($_REQUEST['bycat']) {
			$SQL .= " WHERE `tar_category` = '".$_REQUEST['bycat']."'";
		}
		if ($_REQUEST['pending'] == 1) {
			$SQL .= " WHERE `status` = '0'";
			$this->tpl->set('pend_app','&pending=1');
		}else{
			$this->tpl->set('pend_app',FALSE);
		}
		$rs = $this->DBM->ExecuteQuery($SQL);
		$str = $this->tpl->out('admin/companies/my.list.start');
		if ($this->DBM->NumberOfRows($rs)) {
			$i=0;
			$this->get_users_logins();
			$this->load_cats();
			while($data=$this->DBM->GetNextRow($rs)) {
				if ($i%2==0) {
					$this->tpl->set('com_row_color','#F8F8F8');
				}else{
					$this->tpl->set('com_row_color','#F0F0F0');
				}
				$i++;
				$com->load($data);
				$com->load_tpl_vars();
				$a = unserialize($data['informers']);
				if (is_array($a)) {					$c = count($a);
				}else{					$c = 0;
				}
				$this->tpl->set('com_infs',$c);
				$this->tpl->set('com_cat',$this->categories[$data['tar_category']]);
				$this->tpl->set('com_cat_id',$data['tar_category']);
				$this->tpl->set('com_owner_user',$this->users_logins[$data['owner']]);
				$str .= $this->tpl->out('admin/companies/my.list.row');
			}
		}
		$str .= $this->tpl->out('admin/companies/my.list.end');
		return $str;
	}

	public function load_cats() {
		$SQL = "SELECT `id`,`name` FROM `categories`";
		$rs = $this->DBM->ExecuteQuery($SQL);
		$this->categories = array();
		while($data=$this->DBM->GetNextRow($rs)) {
			$this->categories[$data['id']] = $data['name'];
		}
	}



	public function show_com_info() {		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get($_REQUEST['id'])) {			$com->load_tpl_vars();
			$ca = unserialize($com->getVariable('categories'));
			if (count($ca) && is_array($cs)) {				$cats = implode(',',$ca);
				$SQL = "SELECT * FROM `categories` WHERE `id` IN (".$cats.")";
				$rs = $this->DBM->ExecuteQuery($SQL);
				while($data=$this->DBM->GetNextRow($rs)) {					$cats_str .= $data['name'].',';
				}
				$this->tpl->set('cats',$cats_str);
			}
			$ia = unserialize($com->getVariable('categories'));
			if (count($ca)) {
				$infs = @implode(',',$ia);
				$SQL = "SELECT * FROM `categories` WHERE `id` IN (".$infs.")";
			}
			return $this->tpl->out('admin/companies/info');
		}
	}

	public function action_delete_com() {		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get($_REQUEST['id'])) {				$com->delete_dir_tree('data/companies/'.$com->objectId);
			$SQL = "DELETE FROM `tar_cat` WHERE `id` = '".$com->objectId."'";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "DELETE FROM `tar_day` WHERE `id` = '".$com->objectId."'";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "DELETE FROM `tar_hrs` WHERE `id` = '".$com->objectId."'";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `users` SET `balance` = balance+".(float)$com->getVariable('funds')." WHERE `id` = '".$com->getVariable('owner')."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
			$com->delete();
		}
	}

	public function show_com_tar() {
		require_once(CLASSES_PATH.'company.php');		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {
			$com->load_tpl_vars();
			$SQL = "SELECT * FROM `categories` WHERE 1";
			$rs = $this->DBM->ExecuteQuery($SQL);
			$tar_cat = '';
			$com_cat = $com->getVariable('tar_category');
			if (!$com_cat) {
				$com_cat = 1;
			}
			$com_days = unserialize($com->getVariable('tar_days'));
			if (!count($com_days)) {
				for($i=1;$i<8;$i++) {
					$com_days[] = $i;
				}
			}
			$com_times = unserialize($com->getVariable('tar_times'));
			if (!count($com_times)) {
				for($i=1;$i<24;$i++) {
					$com_times[] = $i;
				}
			}
			$i=0;
			if ($this->DBM->NumberOfRows($rs)) {
				while($data=$this->DBM->GetNextRow($rs)) {
					$i++;
					$tar_cat .= '<tr><td><input type="radio" id="tc_'.$i.'" name="tar_cat" value="'.$data['id'].'"';
					if ($data['id'] == $com->getVariable('tar_category')) {
						$tar_cat .= ' checked';
					}
					$tar_cat .= '></td><td><label class="labelsimple" for="tc_'.$i.'">'.$data['name'].'</label></td>';
					$tar_cat .= '<td width="50">'.(($data['price_show']/100*(100-$this->sys['perc']))).' / '.(($data['price_show_uniq']/100*(100-$this->sys['perc']))).'</td>';
					$tar_cat .= '<td width="50">'.(($data['price_click']/100*(100-$this->sys['perc']))).' / '.(($data['price_click_uniq']/100*(100-$this->sys['perc']))).'</td>';
					$tar_cat .= '</tr>';
				}
			}
			for($i=1;$i<8;$i++) {
				$tar_day .= '<input type="checkbox" id="td_'.$i.'" name="tar_day['.$i.']"';
				if (@in_array($i,$com_days)) {
					$tar_day .= ' checked';
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
			$tar_uniq .= '<td>Только уникальные показы</td><td><input type="checkbox" name="uniq_shows"';
			if ($com->getVariable('uniq_shows') == 1) {
				$tar_uniq .= ' checked';
			}
			$tar_uniq .= ' /></td><td width="50"></td>';
			$tar_uniq .= '<td>Только уникальные клики</td><td><input type="checkbox" name="uniq_clicks"';
			if ($com->getVariable('uniq_clicks') == 1) {
				$tar_uniq .= ' checked';
			}
			$tar_uniq .= ' /></td></tr>';
			$this->tpl->set('tar_cat',$tar_cat);
			$this->tpl->set('tar_time',$tar_time);
			$this->tpl->set('tar_day',$tar_day);
			$this->tpl->set('tar_uniq',$tar_uniq);
			return $this->tpl->out('admin/companies/targeting.edit');
		}
	}

	public function action_save_com_tar() {
		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {
			$com->load_tpl_vars();
			if (!$_REQUEST['tar_day']) {
				$_REQUEST['tar_day'] = array(0);
			}else{
				foreach($_REQUEST['tar_day'] as $key => $val) {
					$tar_day[] = $key;
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
			if ($_REQUEST['uniq_shows'] == 'on') {
				$us = 1;
			}
			if ($_REQUEST['uniq_clicks'] == 'on') {
				$uc = 1;
			}
			$com->setVariable('tar_category',$_REQUEST['tar_cat']);
			$com->setVariable('tar_days',serialize($tar_day));
			$com->setVariable('tar_times',serialize($tar_time));
			$com->setVariable('uniq_shows',$us);
			$com->setVariable('uniq_clicks',$uc);
			$com->setVariable('status',0);
			$com->update();
			$com->update_tar_tables();
		}
	}

	public function show_com_tizers_add() {		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {			$SQL = "SELECT * FROM `informers` WHERE `owner` = '".$com->getVariable('owner')."'";
			$infz = unserialize($com->getVariable('informers'));
			if (count($infz)) {
				$SQL .= " AND `id` NOT IN (".implode(',',$infz).")";
			}
			$rs = $this->DBM->ExecuteQuery($SQL);
			$str = $this->tpl->out('admin/companies/informers/list.start');
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
					$str .= $this->tpl->out('admin/companies/informers/list.row');
				}
			}
			$str .= $this->tpl->out('admin/companies/informers/list.end');
			return $str;
		}
	}

	public function show_com_tizers_delete() {
		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {
			$com->load_tpl_vars();
			$SQL = "SELECT * FROM `informers` WHERE `owner` = '".$com->getVariable('owner')."'";
			$infz = unserialize($com->getVariable('informers'));
			if (count($infz)) {
				$SQL .= " AND `id` IN (".implode(',',$infz).")";
				$rs = $this->DBM->ExecuteQuery($SQL);
				$str = $this->tpl->out('admin/companies/informers/delete.list.start');
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
						$str .= $this->tpl->out('admin/companies/informers/delete.list.row');
					}
				}
				$str .= $this->tpl->out('admin/companies/informers/delete.list.end');
			}else{
				$str = $this->tpl->out('admin/companies/informers/delete.list.start');
				$str .= $this->tpl->out('admin/companies/informers/delete.list.end');
			}
		}
		return $str;
	}

	public function action_delete_tizers() {
		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {			$infs2del = $_REQUEST['inf'];
			$infs = unserialize($com->getVariable('informers'));
			foreach($infs as $key => $val) {
				if ($infs2del[$val] == 'on') {
					unset($infs[$key]);
				}
			}
			echo serialize($infs);
			$com->setVariable('informers',serialize($infs));
			$com->update();
			$com->update_tar_tables();
		}
	}

	public function action_com_add_tizer() {
		require_once(CLASSES_PATH.'company.php');
		$com = new Company();
		if ($com->get(intval($_REQUEST['id']))) {
			$com->load_tpl_vars();
			if (is_array($_REQUEST['inf'])) {
				$infs = array();
				foreach ($_REQUEST['inf'] as $key => $val) {
					if ($val == 'on') {
						$infs[] = $key;
					}
				}
				$infz = unserialize($com->getVariable('informers'));
				foreach($infz as $key => $val) {
					$infs[] = $val;
				}
				$com->setVariable('informers',serialize($infs));
				$com->update();
			}
		}
	}

	public function show_edit_cat() {		require_once(CLASSES_PATH.'category.php');
		$cat = new Category();
		if ($cat->get(intval($_REQUEST['id']))) {			$cat->load_tpl_vars();
			return $cat->tpl->out('admin/cats/edit');
		}
	}

	public function action_save_cat() {
		$SQL = "UPDATE `categories` SET
			`price_show` = '".(float)$_REQUEST['price_show']."',
			`price_show_uniq` = '".(float)$_REQUEST['price_show_uniq']."',
			`price_click` = '".(float)$_REQUEST['price_click']."',
			`price_click_uniq` = '".(float)$_REQUEST['price_click_uniq']."',
			`name` = '".$_REQUEST['name']."' WHERE `id` = '".(int)$_REQUEST['id']."' LIMIT 1";
		$this->DBM->ExecuteQuery($SQL);
	}

}
?>
