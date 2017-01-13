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

if (isset($_REQUEST['action'])) {
	$action_function = 'action_'.$_REQUEST['action'];
	if (method_exists(&$user,$action_function)) {		$tpl->set('content',call_user_func(array($user,$action_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($user).'::'.$action_function.'()',E_USER_NOTICE);
	}
}

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists(&$user,$show_function)) {
		$tpl->set('content',call_user_func(array($user,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($user).'::'.$show_function.'()',E_USER_NOTICE);
	}
}
?>
