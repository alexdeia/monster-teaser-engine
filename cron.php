<?php
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

require_once('config/config.php');
require_once(ENGINE_PATH.'security.php');
require_once(CLASSES_PATH.'storage/mysql.php');
$DBM = new MysqlDBM();

$DBM->ExecuteQuery("DELETE FROM `ips` WHERE `time` < ".(time()-86400));
