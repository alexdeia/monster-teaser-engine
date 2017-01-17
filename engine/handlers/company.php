<?
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

require_once(CLASSES_PATH.'company.php');
$com = new Company();
if (isset($_REQUEST['action'])) {
	$action_function = 'action_'.$_REQUEST['action'];
	if (method_exists($com,$action_function)) {
		call_user_func(array($com,$action_function));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($com).'::'.$action_function.'()',E_USER_NOTICE);
	}
}

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists($com,$show_function)) {
		$tpl->set('content',call_user_func(array($com,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($com).'::'.$show_function.'()',E_USER_NOTICE);
	}
}
?>
