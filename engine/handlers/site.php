<?
require_once(CLASSES_PATH.'site.php');
$site = new Site();
if (isset($_REQUEST['action'])) {
	$action_function = 'action_'.$_REQUEST['action'];
	if (method_exists(&$site,$action_function)) {		call_user_func(array($site,$action_function));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($site).'::'.$action_function.'()',E_USER_NOTICE);
	}
}

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists(&$site,$show_function)) {
		$tpl->set('content',call_user_func(array($site,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($site).'::'.$show_function.'()',E_USER_NOTICE);
	}
}
?>