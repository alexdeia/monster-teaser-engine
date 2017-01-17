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
require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');

require_once(CLASSES_PATH.'template.php');
require_once(CLASSES_PATH.'dbobject.php');
require_once(CLASSES_PATH.'storage/mysql.php');
require_once(CLASSES_PATH.'session.php');
require_once(CLASSES_PATH.'user.php');
require_once(CLASSES_PATH.'admin.php');

header('Content-Type: text/html; charset=utf-8');

$tpl = new Template();
$DBM = new MysqlDBM();
$session = new Session();
$user = new user();
$tpl->__construct();
$admin = new Admin();

if ($_REQUEST['admin_login'] == 1) {	if ($sys['admin_user'] ==  $_REQUEST['login'] && $sys['admin_pass'] ==  $_REQUEST['password']) {
		$session->setVariable('_admin_in',TRUE);
	}
}

if (isset($_REQUEST['exit'])) {	$session->setVariable('_admin_in',FALSE);
}

if (!$session->getVariable('_admin_in')) {	echo $tpl->out('admin/login');
	exit();}

$tpl->set('left_menu',$tpl->out('left.login'));

if (isset($_REQUEST['action'])) {
	$action_function = 'action_'.$_REQUEST['action'];
	if (method_exists(&$admin,$action_function)) {
		$tpl->set('content',call_user_func(array($admin,$action_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($admin).'::'.$action_function.'()',E_USER_NOTICE);
	}
}

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists(&$admin,$show_function)) {
		$tpl->set('content',call_user_func(array($admin,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($admin).'::'.$show_function.'()',E_USER_NOTICE);
	}
}

echo $tpl->out('admin/main');
?>
