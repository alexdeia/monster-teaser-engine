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

class User Extends DBObject{

	public $__table = 'users';
	public $__keyColumn = 'id';
	public $tpl_prefix = 'user';

	public function __construct($id=false) {
		global $DBM, $session;
		$this->DBM = $DBM;
		$this->session = $session;
		$this->DBObject($DBM,$id);
	}

	/* Проверка корректности e-mail */
	public function check_email($email) {
		if (!preg_match("/[a-zA-Z0-9\_]+@[a-zA-Z0-9\-]+\.[a-z]{2,4}/i", $email)) {
			return false;
		}
		return true;
	}

	public function check_is_email_used($email,$type=0)
	{
		$SQL = "SELECT `id` FROM `".$this->__table."` WHERE `email` = '".$email."' AND `id` <> '".$this->objectId."'";
		if ($type > 0) {
			$SQL .= " AND `type` = '".$type."'";
		}
		$SQL .= " LIMIT 1";
		list($id) = $this->DBM->SingleRowQuery($SQL);
  		if ($id > 0) {
				return true;
  		}
  		return false;
	}

	public function get_password_hash($password) {		return md5($password);
	}

	public function have_access($redirect=TRUE) {		if ($this->objectId) {			return TRUE;
		}else{			if ($redirect) {				header("Location:/index.html");
			}
		}
		return FALSE;
	}

	public function show_restore_password() {		return $this->tpl->out('account/restore.password');
	}

	public function action_send_password() {		$SQL = "SELECT * FROM `users` WHERE `login` = '".$_REQUEST['login']."' LIMIT 1";
		$data = $this->DBM->SingleRowQuery($SQL);
		if ($data['id']) {			$code = md5(microtime());
			$link = '<a href="'.$this->sys['url'].'restore-password/'.$code.'.html" target="_blank">';
			$link.= $this->sys['url'].'/restore-password/'.$code.'.html</a>';
			$msg = 'Здравствуйте, '.$data['name']."<br/>\r\n";
			$msg .= "Кем-то, возможно Вами, был запрошен новый пароль. Если вы желаете сменить пароль, пройдите по следующей ссылке ".$link."</b><br/>\r\n";
			$msg .= "Просим вас принять во внимание, что ссылка действительна в течении трех суток, затем вам придется заново запросить пароль<br/>\r\n";
			$msg .= 'С уважением, администрация '.$this->sys['title'];
			mail($data['email'],$this->sys['title'].' > Ваш новый пароль',$msg,"From: ".$this->sys['massmail_email']."\r\nContent-type: text/html; charset=utf-8\r\n");
			$SQL = "DELETE FROM `pass_rest` WHERE `user` = '".$data['id']."'";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "INSERT DELAYED INTO `pass_rest` SET `id` = '".$code."', `user` = '".$data['id']."', `time` = '".time()."'";
			$this->DBM->ExecuteQuery($SQL);
			$this->session->set_notice('Новый пароль выслан на указанный email при регистрации',OK);
		}
	}

	public function show_pass_set() {		$SQL = "SELECT * FROM `pass_rest` WHERE `id` = '".$_REQUEST['code']."'";
		$data = $this->DBM->SingleRowQuery($SQL);
		if ($data['time'] < (time()-(3*86400))) {			$SQL = "DELETE FROM `pass_rest` WHERE `time` < ".(time()-(3*86400));
			$this->DBM->ExecuteQuery($SQL);			return $this->tpl->out('account/set.password2');
		}  		return $this->tpl->out('account/set.password');
	}

	public function action_pass_set() {		$SQL = "SELECT * FROM `pass_rest` WHERE `id` = '".$_REQUEST['code']."'";
		$data = $this->DBM->SingleRowQuery($SQL);
		if ($data['time'] > (time()-(3*86400))) {
			$SQL = "UPDATE `users` SET `password` = '".md5($_REQUEST['password'])."' WHERE `id` = '".$data['user']."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
			$SQL = "DELETE FROM `pass_rest` WHERE `id` = '".$data['id']."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);
		}
	}

	public function get_by_login($login) {		$SQL = "SELECT * FROM `users` WHERE `login` = '".$login."' LIMIT 1";
		$data = $this->DBM->SingleRowQuery($SQL);
		if ($data['id']) {			return $data;
		}else{			return FALSE;
		}
	}

	public function action_register() {
		$err = false;
		/* Проверка логина */
		if (strlen($_REQUEST['login']) >= 4) {
			if (preg_match("/^[".$this->sys['login_chars']."]*$/i", $_REQUEST['login'])) {
				if ($this->get_by_login($_REQUEST['login'])) {
					$this->session->set_notice('Выбранный вами логин уже занят',ERROR);
					$err = true;
				}
			}else{
				$this->session->set_notice('Выбранный вами логин содержит недопустимые символы', ERROR);
				$err = true;
			}
		}else{			$this->session->set_notice('Длина логина не может быть менее 4 символов', ERROR);
			$err = true;
		}

		/* Проверка пароля */
		if (strlen($_REQUEST['password']) <= 6) {
			$this->session->set_notice('Длина пароля не может быть менее 6 символов', ERROR);
			$err = TRUE;
		} elseif ($_REQUEST['password'] <> $_REQUEST['password2']) {
			$this->session->set_notice('Пароли не совпадают',ERROR);
			$err = TRUE;
		}

		/* Проверка почты */
		if (!$this->check_email($_REQUEST['email'])) {
			$this->session->set_notice('Указан некорректный email',ERROR);
		}elseif ($this->check_is_email_used($_REQUEST['email'],$_REQUEST['type'])) {
			$this->session->set_notice('Указанный email уже используется в системе',ERROR);
			$err = TRUE;
		}

		if ($_REQUEST['type'] <> '1' && $_REQUEST['type'] <> '2') {			$this->session->set_notice('Не получены данные',ERROR);			$err = true;
		}

		if ($err) {			return FALSE;
		}else{			$this->setVariable('login',$_REQUEST['login']);
			$this->setVariable('password',$this->get_password_hash($_REQUEST['password']));
			$this->setVariable('email',$_REQUEST['email']);
			$this->setVariable('name',$_REQUEST['name']);
			$this->setVariable('type',$_REQUEST['type']);
			$this->setVariable('wmid',$_REQUEST['wmid']);
			$this->setVariable('wmz',$_REQUEST['wmz']);
			$this->setVariable('referrer',$_REQUEST['referrer']);
			$this->setVariable('statinf',$_REQUEST['statinf']);
			$this->insert();
			$this->session->set_notice('Вы успешно прошли регистрацию.<br/> Теперь вы можете войти в свой аккаунт и начать работу',OK);
			$this->action_login();
		}
	}

	public function action_login() {		if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {        	$SQL = "SELECT * FROM `".$this->__table."` WHERE `login` = '".$_REQUEST['login']."' AND `password` = '".$this->get_password_hash($_REQUEST['password'])."' LIMIT 1";
        	$data = $this->DBM->SingleRowQuery($SQL);
        	if ($data['id']) {				$this->load($data);
				$this->session->setVariable('_user_in',$data['id']);
				if ($_REQUEST['remeberme'] == 'on') {					setCookie('_tic_user_in_',$data['id'],(time()+time()));
				}
				header("Location:/account/index.html");
        	}
		}else{			$this->session->set_notice('Неправильный логин или пароль',ERROR);
			return FALSE;
		}
	}

	public function action_logout() {
		$this->session->removeVariable('_user_in');
		setCookie('_tic_user_in_',0);
		header("Location:/index.html");
	}

	public function action_save_settings() {
		$this->have_access();		if ($this->objectId) {
			$update_pass = false;			if (!empty($_REQUEST['password'])) {				/* Проверка пароля */
				if (strlen($_REQUEST['password']) < 6) {
					$this->session->set_notice('Пароль не может быть короче 6 символов',ERROR);
					return FALSE;
				}elseif($_REQUEST['password'] <> $_REQUEST['password2']) {
					$this->session->set_notice('Пароли не совпадают',ERROR);
					return FALSE;
				}
				$update_pass = true;
			}

			/* �������� ����� */
			if (!$this->check_email($_REQUEST['email'])) {
				$this->session->set_notice('Указан некорректный email',ERROR);
			}elseif ($this->check_is_email_used($_REQUEST['email'])) {
				$this->session->set_notice('Указанный email уже используется в системе',ERROR);
				return FALSE;
			}

            if ($update_pass) {
            	$this->setVariable('password',$this->get_password_hash($_REQUEST['password']));
            }
			$this->setVariable('email',$_REQUEST['email']);
			$this->setVariable('name',$_REQUEST['name']);
			$this->setVariable('wmid',$_REQUEST['wmid']);
			$this->setVariable('wmz',$_REQUEST['wmz']);
			$this->setVariable('statinf',$_REQUEST['statinf']);
			$this->update();
			$this->session->set_notice('Изменения сохранены',OK);
			header("Location:/account/settings.html");
			return TRUE;
		}
	}

	public function action_reset_password() {		if ($this->check_email($_REQUEST['email'])) {  			if ($this->check_is_email_used($_REQUEST['email'])) {  				$password = '';       			for($i=0;$i<10;$i++) {                	switch(rand(1,3)) {                		case 1:
                			$password .= $this->tpl->letters[array_rand($this->tpl->letters)];
                		break;
                		case 2:
                			$password .= $this->tpl->symbols[array_rand($this->tpl->symbols)];
                		break;
                		case 3:
                			$password .= rand(0,9);
                		break;
                	}
       			}
       			mail($_REQUEST['email'],'Восстановление пароля','Здравствуйте. Ваш новый пароль  <b>'.$password.'</b>.');
  			}
		}
		$session->setNotice('Новый пароль выслан на указанный email',OK);
	}

	public function show_registration() {		$this->tpl->set('acc_type_select',$this->tpl->get_select_form('type',array(1=>'Владелец сайта',2=>'Рекламодатель'),$_REQUEST['type']));		return $this->tpl->out('registration');
	}

	public function show_login() {		return $this->tpl->out('login');
	}

	public function show_account() {
		$this->have_access();		return $this->tpl->out('account/index');
	}

	public function show_settings() {		$this->have_access();		return $this->tpl->out('account/settings');
	}

	public function show_funds() {		$this->have_access();
		if ($this->sys['payout_type'] == 'mp') {			$this->tpl->set('payout_info',$this->sys['payout_info']);
		}else{			$this->tpl->set('payout_info',$this->tpl->out('account/funds/order.wm'));
		}
		return $this->tpl->out('account/funds/index_'.$this->getVariable('type'));
	}

	public function action_order_wm() {
		$this->have_access();
		if ($this->getVariable('balance') >= $_REQUEST['summ'] && $_REQUEST['summ'] > '0.01' && strlen($this->getVariable('wmz')) > 5) {
			$SQL = "INSERT INTO `wm_payout` SET  `type` = 2,`desc`, = 'Автоматический вывод средств', `user` = '".$this->objectId."', `time` = '".time()."', `summ` = '".$_REQUEST['summ']."', `wmz` = '".$this->getVariable('wmz')."'";
			$this->DBM->ExecuteQuery($SQL);
			$id = $this->DBM->insert_id();
			require_once(CLASES_PATH.'wm/wmxml.php');
			$wm = new WMI();
			$code = rand(1000,9999);
			$a = $wm->x2($id,$id,$this->sys['wmz'],$this->getVariable('wmz'),$_REQUEST['summ'],3,$code,'Вывод средств из сервиса '.$this->sys['title'],0);
			if ($a['retval'] == 0) {				$this->decreaseVariable('balance',$_REQUEST['summ']);
				$this->load_tpl_vars();
				$this->update();

				/* Платим % реферерам */
				if ($this->getVariable('referrer')) {
					$perc = (($_REQUEST['summ']/100)*$this->sys['ref_perc']);
		  			$SQL = "UPDATE `users` SET `balance`=balance+".(float)$perc.",`ref_balance`=ref_balance+".(float)$perc." WHERE `id` = '".$this->getVariable('referrer')."' LIMIT 1";
		  	 		$this->DBM->ExecuteQuery($SQL);
		  	 	}
			}
			$SQL = "UPDATE `wm_payout` SET `code` = '".$code."',`errno` = ".(int)$a['retval'].",`errstr` = '".$a['retdesc']."' WHERE `id` = '".$id."' LIMIT 1";
			$this->DBM->ExecuteQuery($SQL);

		}
	}

	public function show_referrals() {		$this->have_access();  		$SQL = "SELECT * FROM `users` WHERE `referrer` = '".$this->objectId."'";
  		$rs = $this->DBM->ExecuteQuery($SQL);
  		$refs = $this->DBM->NumberOfRows($rs);

		$this->tpl->set('total_refs',$refs);
		#$this->tpl->set('refs_1',(int)$refs[1]);
		#$this->tpl->set('refs_2',(int)$refs[2]);
		#$this->tpl->set('refs_3',(int)$refs[3]);
		return $this->tpl->out('account/referrals/main');
	}

	public function show_add_wm() {		return $this->tpl->out('account/funds/wm.accept');
	}

	public function action_add_wm() {
		$this->have_access();		$SQL = "INSERT INTO `wm_pay` SET `user` = ".$this->objectId.", `summ` = '".(float)$_REQUEST['summ']."', `time` = '".time()."'";
		$this->DBM->ExecuteQuery($SQL);
		$this->wm_order = $this->DBM->insert_id();
		$this->tpl->set('wm_order_id',$this->wm_order);
		$this->tpl->set('wm_order_sum',(float)$_REQUEST['summ']);
	}

	public function show_wm_failed() {		return $this->tpl->out('account/funds/wm.failed');
	}

	public function show_wm_sucessfull() {
		return $this->tpl->out('account/funds/wm.sucessfull');
	}
}
?>
