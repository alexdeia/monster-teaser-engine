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
$w = array('Sun'=>7,'Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6);
require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');
require_once(CLASSES_PATH.'storage/mysql.php');
require_once(CLASSES_PATH.'template.php');
require_once(CLASSES_PATH.'session.php');
$DBM = new MysqlDBM();
$tpl = new Template();
$session = new Session();
$referer = getenv('HTTP_REFERER');
$session->setVariable('_ste_referer',$referer);
if (!$_REQUEST['test']) {
	$SQL = "SELECT * FROM `sites` WHERE `id` = '".$_REQUEST['site']."' AND `status` = 1 LIMIT 1";
	$site = $DBM->SingleRowQuery($SQL);
	if ($site['id']) {
		$site_cats = unserialize($site['categories']);
		if (!count($site_cats)) {			exit();
		}
		$SQL = "SELECT `com` FROM `ips` WHERE `ip` = '".ip2long($IP)."'";
		$rs = $DBM->ExecuteQuery($SQL);
		if ($DBM->NumberOfROws($rs)) {			while($data=$DBM->GetNextROw($rs)) {				$tmp[] = $data[0];
			}
			$IPS_SQL = implode(',',$tmp);
		}
		if (!$_REQUEST['format']) {
			$_REQUEST['format'] = $sys['tizer_formats'][0]['w'].'x'.$sys['tizer_formats'][0]['h'];
		}
		/* Этот запрос выбирает рекламную компанию по таргетингу из 4х таблиц */
		$SQL = "SELECT `companies`.*,`tar_cat`.`val` AS category FROM `tar_cat`,`tar_day`,`tar_hrs`,`companies` WHERE ";
		$SQL .= "`tar_cat`.`val` IN (".implode(',',$site_cats).") AND `tar_day`.`val` = '".$w[date('D')]."' AND `tar_hrs`.`val` = '".date('G')."'";
		$SQL .= " AND (`tar_cat`.`id` = `tar_day`.`id` AND `tar_cat`.`id` = `tar_hrs`.`id`) AND `companies`.`id` = `tar_cat`.`id` AND ";
		$SQL .= "`companies`.`uniq_shows` = 1 AND `companies`.`format` = '".$_REQUEST['format']."' ";
		if (strlen($IPS_SQL) > 0) {			$SQL .= "AND `companies`.`id` NOT IN (".$IPS_SQL.") ";
		}
		$SQL .= "ORDER BY RAND() LIMIT 1";
		$com = $DBM->SingleRowQuery($SQL);
		if (!$com['id']) {			/* Этот запрос выбирает рекламную компанию по таргетингу из 4х таблиц */
			$SQL = "SELECT `companies`.*,`tar_cat`.`val` AS category FROM `tar_cat`,`tar_day`,`tar_hrs`,`companies` WHERE ";
			$SQL .= "`tar_cat`.`val` IN (".implode(',',$site_cats).") AND `tar_day`.`val` = '".$w[date('D')]."' AND `tar_hrs`.`val` = '".date('G')."'";
			$SQL .= " AND (`tar_cat`.`id` = `tar_day`.`id` AND `tar_cat`.`id` = `tar_hrs`.`id`) AND `companies`.`id` = `tar_cat`.`id` AND ";
			$SQL .= "`companies`.`uniq_shows` = 0  AND `companies`.`format` = '".$_REQUEST['format']."' ";
			$SQL .= "ORDER BY RAND() LIMIT 1";
			$com = $DBM->SingleRowQuery($SQL);
		}
		if (abs(intval($com['id']))) {			if ($com['funds'] <= 0.0001) {
				$SQL = "DELETE FROM `tar_cat` WHERE `id` = '".$com['id']."'";
				$DBM->ExecuteQuery($SQL);
				$SQL = "DELETE FROM `tar_day` WHERE `id` = '".$com['id']."'";
				$DBM->ExecuteQuery($SQL);
				$SQL = "DELETE FROM `tar_hrs` WHERE `id` = '".$com['id']."'";
				$DBM->ExecuteQuery($SQL);
			}			if ($com['uniq_shows'] == 1) {				$SQL = "INSERT INTO `ips` SET `ip` = '".ip2long($IP)."', `time` = ".time().", `com` = ".$com['id'];
				$DBM->ExecuteQuery($SQL);
			}			$SQL = "SELECT * FROM `categories` WHERE `id` = '".$com['category']."' LIMIT 1";
			$cat = $DBM->SingleRowQuery($SQL);

			$SQL = "SELECT * FROM `informers` WHERE";
			$com_infs = unserialize($com['informers']);
	        if (count($com_infs)) {
				foreach($com_infs as $key => $val) {
					$SQL .= " `id` = ".$val." OR";
				}
				$SQL = substr($SQL,0,strlen($SQL)-2);
				$SQL .= " ORDER BY RAND() LIMIT ".intval($_REQUEST['cols']*$_REQUEST['rows']);
				$rs = $DBM->ExecuteQuery($SQL);
				$infs = $DBM->GetArray($rs);

				if (count($infs)) {
					$shows = 0;
					$shows_uniq = 0;
					$log = '';
					$money = 0;
					$tizers = array();
					foreach($infs as $key => $val) {						$ipdb_file = 'data/informers/'.$val['id'].'/show_ip.db';
						if (file_exists($ipdb_file)) {
							$ips = file($ipdb_file);
						}else{
							$ips = array();
						}
						if (in_array($IP."\n",$ips)) {							$money += ($cat['price_show']);
							if ($com['funds'] <= $money) {								$money -= ($cat['price_show']);								break;
							}
							$shows++;
							$SQL = "UPDATE `informers` SET `shows` = shows+1 WHERE `id` = '".$val['id']."' LIMIT 1";
							$log = time()."\tshow\t0\t1\t".$com['id']."\t".$IP."\t".$site['url']."\t".$referer."\n";
							$com_log = time()."\tshow\t0\t1\t".$val['id']."\t".$IP."\t".$site['url']."\t".$referer."\n";
						}else{
							$money += ($cat['price_show_uniq']);
							if ($com['funds'] <= $money) {
								$money -= ($cat['price_show_uniq']);
								break;
							}
							$shows++;
							$shows_uniq++;
							$SQL = "UPDATE `informers` SET `shows` = shows+1, `shows_uniq` = shows_uniq+1 WHERE `id` = '".$val['id']."' LIMIT 1";
							$f = fopen($ipdb_file,RWC);
							fwrite($f,$IP."\n");
	      					fclose($f);
							$log = time()."\tshow\t1\t1\t".$com['id']."\t".$IP."\t".$site['url']."\t".$referer."\n";
							$com_log = time()."\tshow\t1\t1\t".$val['id']."\t".$IP."\t".$site['url']."\t".$referer."\n";
						}
						$tizers[] = array(
							'image'=>'/data/informers/'.$val['id'].'/'.$val['image'],
							'id'=>$val['id'],
							'text'=>$val['text'],
							'url'=>$sys['url'].'go/'.$val['id'].'/'.$_REQUEST['site'].'/'.$com['id']
						);
						$log_file = 'data/informers/'.$val['id'].'/logs/'.date('Y').'/'.date('n').'/';
						if (!file_exists($log_file)) {
							mkdir($log_file,0777,TRUE);
						}
						$f = fopen($log_file.date('j').'.log',RWC);
						fwrite($f,$log);
						fclose($f);
						$DBM->ExecuteQuery($SQL);
						$site_log = time()."\tshow\t".$shows_uniq."\t".$shows."\t".$IP."\t".$referer."\n";

						$log_file = 'data/companies/'.$com['id'].'/logs/'.date('Y').'/'.date('n').'/';
						if (!file_exists($log_file)) {
							mkdir($log_file,0777,TRUE);
						}
						$f = fopen($log_file.date('j').'.log',RWC);
						fwrite($f,$com_log);
						fclose($f);

					}
					$SQL = "UPDATE `sites` SET `shows` = shows+".$shows.", `shows_uniq` = shows_uniq+".$shows_uniq." WHERE `id`= '".$site['id']."' LIMIT 1";
					$DBM->ExecuteQuery($SQL);
					if ($com['calc_shows'] == 1) {						$SQL = "UPDATE `companies` SET `funds` = funds-".$money.", `spent` = spent+".$money.", `shows` = shows+".$shows.", `shows_uniq` = shows_uniq+".$shows_uniq." WHERE `id`= '".$com['id']."' LIMIT 1";
						$DBM->ExecuteQuery($SQL);
						$SQL = "UPDATE `users` SET `balance` = balance+".(($money/100)*(100-$sys['perc']))." WHERE `id` = '".$site['owner']."' LIMIT 1";
						$DBM->ExecuteQuery($SQL);
					}else{						$SQL = "UPDATE `companies` SET `shows` = shows+".$shows.", `shows_uniq` = shows_uniq+".$shows_uniq." WHERE `id`= '".$com['id']."' LIMIT 1";
						$DBM->ExecuteQuery($SQL);
					}
				}
			}
			$log_file = 'data/sites/'.$site['id'].'/logs/'.date('Y').'/'.date('n').'/';
			if (!file_exists($log_file)) {
				mkdir($log_file,0777,TRUE);
			}
			$f = fopen($log_file.date('j').'.log',RWC);
			fwrite($f,$site_log);
			fclose($f);
			$str .= $tpl->out('informers/footer');
		}
	}
}else{
	for($i=0;$i<intval($_REQUEST['cols']*$_REQUEST['rows']);$i++) {		$tizers[] = array(
			'image'=>'/images/tizer.jpg',
			'id'=>0,
			'text'=>'Пример текста тизера',
			'url'=>'/'
		);
	}
}
$i=0;

if (count($tizers)) {
	list($w,$h) = explode('x',$_REQUEST['format']);	$str = '<html><head>';
	$str .= '<style type="text/css">html,body {margin:0px; padding:0px; background-color:#'.$_REQUEST['bgcolor'].';}';
	$str .= 'a:link { font-family: '.$_REQUEST['font'].'; font-size: '.$_REQUEST['font_size'].'px; TEXT-DECORATION: '.$_REQUEST['decoration'].'; color:#'.$_REQUEST['acolor'].'; font-weight: '.$_REQUEST['font_type'].';}';
	$str .= 'a:hover { font-family: '.$_REQUEST['font'].'; font-size: '.$_REQUEST['font_size'].'px; color:#'.$_REQUEST['ahover'].'; font-weight: '.$_REQUEST['font_type'].'; TEXT-DECORATION: '.$_REQUEST['decoration'].';}';
	$str .= 'a:visited { font-family: '.$_REQUEST['font'].'; font-size: '.$_REQUEST['font_size'].'px; color:#'.$_REQUEST['acolor'].'; font-weight: '.$_REQUEST['font_type'].'; TEXT-DECORATION: '.$_REQUEST['decoration'].';}';
	$str .= '.img {border: ';
	if ($_REQUEST['iborder']) {		$str .= '1px solid #'.$_REQUEST['iborder'].';';
	}else{		$str .= '0px;';
	}
	$str .= 'width: '.$w.'px; height: '.$h.'px;}';
	$str .= '</style>';
	$str .= '<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /></head><body>';
	$str .= '<table align="center">';	foreach($tizers as $key => $val) {		if ($i%$_REQUEST['cols']==0) {
			$str .= '</tr><tr>';
		}
        $t[] = $val['id'];
        $text = '';
        for($i=0;$i<strlen($val['text']);$i++) {        	if ($i == 25 || $i == 50) {        		$text .= '<br>';
        	}        	$text .= $val['text'][$i];
        }
	    switch($_REQUEST['text_dir']) {	    	case 0:
	    		$str .= '<td><a href="'.$val['url'].'" target="_blank">';
	        	$str .= '<img class="img" border="0" align="middle" src="'.$val['image'].'" width="'.$w.'" height="'.$h.'" /></a></td>';
	        	$str .= '<td valign="middle"><a href="'.$val['url'].'" target="_blank">'.$text.'<a/></td>';
	    	break;
	    	case 1:
		    	$str .= '<td><a href="'.$val['url'].'" target="_blank">'.$text.'</a></td>';
				$str .= '<td><a href="'.$val['url'].'" target="_blank"><img class="img" align="middle" border="0" src="'.$val['image'].'" width="'.$w.'" height="'.$h.'" /></a></td>';
	    	break;
	    	case 2:
		    	$str .= '<td style="padding-right: 20px; text-align:center;"><a href="'.$val['url'].'" target="_blank">';
 		   		$str .= '<img class="img" border="0" src="'.$val['image'].'" width="'.$w.'" height="'.$h.'" /><br/>'.$text.'</td>';
	    	break;
	    	case 3:
		    	$str .= '<td style="padding-right: 20px; text-align:center;"><a href="'.$val['url'].'" target="_blank">';
	    		$str .= $text.'<br/><img class="img" border="0" src="'.$val['image'].'" width="'.$w.'" height="'.$h.'" /></td>';
	    	break;
	    }
		$i++;
	}
	$session->setVariable('_ste_last_tizers',serialize($t));
	$str .= '</table></body></html>';
}
echo $str;
?>