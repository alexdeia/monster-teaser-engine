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
require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');
require_once(CLASSES_PATH.'storage/mysql.php');
$DBM = new MysqlDBM();

$DBM->ExecuteQuery("DELETE FROM `ips` WHERE `time` < ".(time()-86400));

?>