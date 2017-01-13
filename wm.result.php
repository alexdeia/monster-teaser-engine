<?php
require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');
require_once(CLASSES_PATH.'storage/mysql.php');
$DBM = new MysqlDBM();
$SQL = "SELECT * FROM `wm_pay` WHERE `id` = '".$_REQUEST['LMI_PAYMENT_NO']."' LIMIT 1";
$data = $DBM->SingleRowQuery($SQL);
if ($data['user']) {	if ($data['summ'] == $_REQUEST['LMI_PAYMENT_AMOUNT']) {		if ($_REQUEST['LMI_PREREQUEST'] <> 1) {			$SQL = "UPDATE `users` SET `balance` = balance+".$data['summ']." WHERE `id` = '".$data['user']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);
			$SQL = "UPDATE `wm_pay` SET `status` = 2 WHERE `id` = '".$data['id']."' LIMIT 1";
			$DBM->ExecuteQuery($SQL);

			/* Платим % реферерам */
			$SQL = "SELECT `referrer` FROM `users` WHERE `id` = '".$data['user']."' LIMIT 1";
			list($referrer) = $DBM->SingleRowQuery($SQL);
			if ($referrer > 0) {				$perc = (($_REQUEST['summ']/100)*$sys['ref_perc']);
 				$SQL = "UPDATE `users` SET `balance`=balance+".(float)$perc.",`ref_balance`=ref_balance+".(float)$perc." WHERE `id` = '".$referrer."' LIMIT 1";
 			 	$DBM->ExecuteQuery($SQL);
 			}
 		}
 		echo 'YES';
 		exit();
 	}else{    	echo 'NO - Invalid sum';
 	}
}else{	echo 'NO - Invalid order id';
}
?>