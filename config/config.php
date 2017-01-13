<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Автор: Алексей Deia
Сайт: http://eternal-web.ru | http://services.eternal-web.ru
icq 389336729
=============================================================
=============================================================
*/

define('ENGINE_PATH','engine/');
define('CLASSES_PATH','engine/classes/');
define('HANDLERS_PATH','engine/handlers/');

define('ERROR','err');
define('OK','ok');
define('RO','r');
define('RWC','a+');
require_once('mysql.conf.php');
require_once('main.php');
$sys['url'] = 'http://'.getenv('HTTP_HOST').'/';
$sys['admin_user'] = 'admin';
$sys['admin_pass'] = 'admin';
?>