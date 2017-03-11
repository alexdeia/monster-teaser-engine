<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
eTeaser @ 2017
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://e-dev.ru | http://aklykov.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

define('ENGINE_PATH', 'engine/');
define('CLASSES_PATH', 'engine/classes/');
define('HANDLERS_PATH', 'engine/handlers/');
define('CONFIG_PATH', 'config/');
define('ERROR', 'err');
define('OK', 'ok');
define('RO', 'r');
define('RWC', 'a+');

require_once('mysql.conf.php');
require_once('main.php');

$sys['url'] = 'http://'.getenv('HTTP_HOST').'/';
$sys['admin_user'] = 'admin';
$sys['admin_pass'] = 'admin';
?>
