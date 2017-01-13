<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Автор: Алексей Deia
icq 389336729
=============================================================
=============================================================
*/
if (file_exists('install')) {
	require_once('install/delete.php');
	exit();
}
error_reporting(0);
$part_time = explode (' ', microtime());
$sys['begin_time'] = $part_time[1].substr($part_time[0],1);
header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
header('Content-type: text/html; charset=windows-1251');
function check_var (&$var,$key) {
	if (is_array($var)) {
    	array_walk($var, 'check_var');
    	return TRUE;
	}
	$var = trim(strip_tags($var));
	$var = str_ireplace("&","&amp;",$var);
	$var = str_ireplace("\"","&quot;",$var);
	$var = str_ireplace("'","&#039;",$var);
	$var = str_ireplace("<","&lt;",$var);
	$var = str_ireplace(">","&gt;",$var);
	$var = str_ireplace("+union+","",$var);
	$var = str_ireplace("+select+","",$var);
	$var = str_ireplace("+join+","",$var);
	$var = str_ireplace("/*","*",$var);
	return TRUE;
}
array_walk($_REQUEST, 'check_var');
define('VERSION','2.1');
$IP = getenv('REMOTE_ADDR');
?>