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
require_once(CLASSES_PATH.'storage/mysql.php');
require_once(CLASSES_PATH.'template.php');
require_once(CLASSES_PATH.'session.php');
$DBM = new MysqlDBM();
$tpl = new Template();
$session = new Session();
error_reporting(E_ALL & ~ E_NOTICE);
ini_set('display_errors','on');
$SQL = "SELECT `url` FROM `informers` WHERE `id` = '".$_REQUEST['inf_id']."' LIMIT 1";
list($url) = $DBM->SingleRowQuery($SQL);
$referer = $session->getVariable('_ste_referer');
if ($url) {	$tizers = unserialize($session->getVariable('_ste_last_tizers'));
	if ($session->getVariable('_ste_referer') && @in_array($_REQUEST['inf_id'],$tizers)) {		$session->setVariable('_ste_last_tizers',FALSE);		$from = parse_url(getenv('HTTP_REFERER'));
		$ipdb_file = 'data/informers/'.$_REQUEST['inf_id'].'/click_ip.db';
		if (!file_exists($ipdb_file)) {			fclose(fopen($ipdb_file,'w'));
		}
		$ips = file($ipdb_file);
		$SQL = "SELECT `tar_category`,`uniq_clicks`,`calc_clicks` FROM `companies` WHERE `id` = '".(int)$_REQUEST['com_id']."' LIMIT 1";
		list($cat,$uc,$cc) = $DBM->SingleRowQuery($SQL);
		if ($cat) {			$SQL = "SELECT `price_click`,`price_click_uniq` FROM `categories` WHERE `id` = '".$cat."' LIMIT 1";
			list($price_click,$price_click_uniq) = $DBM->SingleRowQuery($SQL);
		}
		$SQL = "SELECT `owner` FROM `sites` WHERE `id` = '".(int)$_REQUEST['site_id']."' LIMIT 1";
		list($owner) = $DBM->SingleRowQuery($SQL);
		if (@in_array($IP."\n",$ips)) {			$SQL = "UPDATE `sites` SET `clicks` = clicks+1 WHERE `id` = '".intval($_REQUEST['site_id'])."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `informers` SET `clicks` = clicks+1 WHERE `id` = '".$_REQUEST['inf_id']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `companies` SET ";
			if ($uc == 0 && $cc == 1) {				$SQL .= "`funds` = funds-".(float)$price_click.", ";
			}
			$SQL .= "`clicks` = clicks+1 WHERE `id` = '".$_REQUEST['com_id']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);

			if ($uc == 0 && $cc == 1) {				$SQL = "UPDATE `users` SET `balance` = balance+".(float)(($price_click/100)*(100-$sys['perc']))." WHERE `id` = ".(int)$owner." LIMIT 1";
				$DBM->ExecuteQuery($SQL);
			}
			$site_log .= time()."\tclick\t0\t1\t".$IP."\t".$referer."\n";
			$inf_log = time()."\tclick\t0\t1\t".$_REQUEST['com_id']."\t".$IP."\t".$IP."\t".$referer."\n";
			$com_log = time()."\tclick\t0\t1\t".$IP."\t".$referer."\n";
		}else{			/* Уникальный клик */
			$SQL = "UPDATE `sites` SET `clicks` = clicks+1, `clicks_uniq` = clicks_uniq+1 WHERE `id` = '".intval($_REQUEST['site_id'])."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `informers` SET `clicks` = clicks+1, `clicks_uniq` = clicks_uniq+1 WHERE `id` = '".$_REQUEST['inf_id']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `companies` SET ";
			if ($cc == 1) {				$SQL .= "`funds` = funds-".(float)$price_click_uniq.", ";
			}
			$SQL .= " `clicks` = clicks+1, `clicks_uniq` = clicks_uniq+1 WHERE `id` = '".$_REQUEST['com_id']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);

			$SQL = "UPDATE `users` SET `balance` = balance+".(float)(($price_click_uniq/100)*(100-$sys['perc']))." WHERE `id` = ".(int)$owner." LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$f = fopen($ipdb_file,RWC);
			fwrite($f,$IP."\n");
            fclose($f);
            $site_log .= time()."\tclick\t1\t1\t".$IP."\t".$referer."\n";
            $com_log .= time()."\tclick\t1\t1\t".$IP."\t".$referer."\n";
            $inf_log = time()."\tclick\t1\t1\t".$_REQUEST['com_id']."\t".$IP."\t".$IP."\t".$referer."\n";
		}
		$log_file = 'data/sites/'.$_REQUEST['site_id'].'/logs/'.date('Y').'/'.date('n').'/';
		if (!file_exists($log_file)) {
			mkdir($log_file,0777,TRUE);
		}
		$f = fopen($log_file.date('j').'.log',RWC);
		fwrite($f,$site_log);
		fclose($f);

		$log_file = 'data/informers/'.$_REQUEST['inf_id'].'/logs/'.date('Y').'/'.date('n').'/';
		if (!file_exists($log_file)) {
			mkdir($log_file,0777,TRUE);
		}
		$f = fopen($log_file.date('j').'.log',RWC);
		fwrite($f,$inf_log);
		fclose($f);

		$log_file = 'data/companies/'.$_REQUEST['com_id'].'/logs/'.date('Y').'/'.date('n').'/';
		if (!file_exists($log_file)) {
			mkdir($log_file,0777,TRUE);
		}
		$f = fopen($log_file.date('j').'.log',RWC);
		fwrite($f,$com_log);
		fclose($f);

	}
	header("Location:http://".$url);
}

?>
