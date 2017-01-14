<?php
require_once('config/config.php');

if (eregi("[a-zA-Z0-9\_]+@[a-zA-Z0-9\-]+\.[a-z]{2,4}",$_REQUEST['email'])) {
	if (strlen($_REQUEST['name']) > 3 && strlen($_REQUEST['message']) > 3) {
		$msg = 'Сообщение от '.$_REQUEST['name'].' ('.$_REQUEST['email'].')<br/>'."\r\n".$_REQUEST['message'];
		mail($sys['admin_email'], 'Сообщение с сайта '.$sys['url'], $msg, "Content-type: text/html; charset=windows-1251\r\n");
	}
}
header("Location:/contacts.html");
?>
