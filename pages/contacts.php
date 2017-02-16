<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
eTeaser @ 2017
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://chronodev.ru | http://aklykov.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

$str = '
	<h1 class="title">Контакты</h1>
    	Вы всегда можете связаться с нами по следующим контактам:
    	<br/><br/>
    	<p>
    		<b>email:</b> <a href="mailto:'.$sys['admin_email'].'">'.$sys['admin_email'].'</a>
     		<br/>
     		<b>ICQ:</b> <img src="http://status.icq.com/online.gif?icq='.$sys['admin_icq'].'&img=5"> '.$sys['admin_icq'].'
     		<br/>
			<b>Webmoney ID:</b> <a href="wmk:msgto?to='.$sys['wmid'].'&amp;subject=contact">'.$sys['wmid'].'</a> BL:<img src="https://bl.wmtransfer.com/img/bl/'.$sys['wmid'].'?w=45&h=18&bg=0XDBE2E9" alt="" border="0" height="18" width="35">
     		<br/>
     	</p>
     		<p>Вы также можете отправить нам сообщение, используя следующую форуму:</p>
     		<div style="padding-left: 20px;">
	     		<form action="/send-message.html" method="post">
				<table class="table">
					<tr>
						<td><label for="name">Имя</label></td><td><input class="form-control" type="text" name="name" id="name" autocomplete="on" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><label for="email">Email</label></td><td><input class="form-control" type="text" name="email" id="email" autocomplete="on" style="width: 200px;"></td>
					</tr>
					<tr>
						<td valign="top"><label for="email">Ваше сообщение</label></td>
						<td><textarea class="form-control" name="message" id="message" style="width: 400px; height: 200px;"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="btn btn-primary" value="Отправить сообщение"></td>
					</tr>
				</table>
	     		</form>
     		</div>
';
?>
