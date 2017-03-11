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

require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');

require_once(CLASSES_PATH.'template.php');
require_once(CLASSES_PATH.'dbobject.php');
require_once(CLASSES_PATH.'storage/mysql.php');
require_once(CLASSES_PATH.'session.php');
require_once(CLASSES_PATH.'user.php');

//header('Content-Type: text/html; charset=utf-8');

$tpl = new Template();
$DBM = new MysqlDBM();
$session = new Session();
$user = new user();
$tpl->__construct();

$tpl->set('left_menu',$tpl->out('left.login'));
if ($session->getVariable('_user_in')) {	if ($user->get($session->getVariable('_user_in'))) {		$user->load_tpl_vars();		$tpl->set('left_menu',$tpl->out('account/left.menu_'.$user->getVariable('type')));
	}
}


if (isset($_REQUEST['handler'])) {	if (file_exists(HANDLERS_PATH.$_REQUEST['handler'].'.php')) {
    	require_once(HANDLERS_PATH.$_REQUEST['handler'].'.php');
	}else{		echo 'no handler: '.HANDLERS_PATH.$_REQUEST['handler'];	}
}

if (!$_REQUEST['show'] && !$_REQUEST['page']) {	$_REQUEST['page'] = 'index';
}
if ($_REQUEST['page']) {	if (file_exists('pages/'.$_REQUEST['page'].'.php')) {		require_once('pages/'.$_REQUEST['page'].'.php');
		$tpl->set('content',$str);
	}
}

$SQL = "SELECT * FROM `news` ORDER BY `time` DESC LIMIT 3";
$rs = $DBM->ExecuteQuery($SQL);
if ($DBM->NumberOfRows($rs)) {	$news = '';	while($data=$DBM->GetNextRow($rs)) {		$news .= '<b>'.date('Y.m.d',$data['time']).'</b><br/>';
		$news .= '<a href="/news/'.$data['id'].'.html">'.$data['short'].'</a><br />';
	}
	$tpl->set('news',$news);
}

$tpl->set('notice',$session->get_notice());
$SQL = "SELECT COUNT(`id`) FROM `sites` LIMIT 1";
list($tpl->vars['total_sites']) = $DBM->SingleRowQuery($SQL);
$SQL = "SELECT COUNT(`id`) FROM `users` WHERE `type` = 2 LIMIT 1";
list($tpl->vars['total_advertisers']) = $DBM->SingleRowQuery($SQL);
$SQL = "SELECT COUNT(`id`) FROM `informers`";
list($tpl->vars['total_tizers']) = $DBM->SingleRowQuery($SQL);
echo $tpl->out('main');
