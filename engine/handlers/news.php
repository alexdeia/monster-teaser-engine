<?
require_once(CLASSES_PATH.'news.php');

$news = new News();

if (isset($_REQUEST['show'])) {
	$show_function = 'show_'.$_REQUEST['show'];
	if (method_exists(&$news,$show_function)) {
		$tpl->set('content',call_user_func(array($news,$show_function)));
	}else{
		trigger_error('Обращение к несуществующему методу '.get_class($news).'::'.$show_function.'()',E_USER_NOTICE);
	}
}
?>