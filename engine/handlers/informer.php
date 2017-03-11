<?
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

require_once(CLASSES_PATH.'informer.php');
$inf = new Informer();
if (isset($_REQUEST['action'])) {
	$action_function = 'action_'.$_REQUEST['action'];
	if (method_exists($inf,$action_function)) {
		call_user_func(array($inf,$action_function));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($inf).'::'.$action_function.'()',E_USER_NOTICE);
	}
}

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists($inf,$show_function)) {
		$tpl->set('content',call_user_func(array($inf,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($inf).'::'.$show_function.'()',E_USER_NOTICE);
	}
}
?>
