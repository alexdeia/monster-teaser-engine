<?php
$str = '
<div class="page_content">
	<h1 class="title">Контакты</h1>
    <div id="cont">
    	Вы всегда можете связаться с нами по следующим координатам:
    	<br/><br/>
    	<div style="padding-left: 20px;">
    		<b>email:</b> <a href="mailto:'.$sys['admin_email'].'">'.$sys['admin_email'].'</a>
     		<br/>
     		<b>ICQ:</b> <img src="http://status.icq.com/online.gif?icq='.$sys['admin_icq'].'&img=5"> '.$sys['admin_icq'].'
     		<br/>
			<b>Webmoney ID:</b> <a href="wmk:msgto?to='.$sys['wmid'].'&amp;subject=contact">'.$sys['wmid'].'</a> BL:<img src="http://stats.wmtransfer.com/Levels/pWMIDLevel.aspx?wmid='.$sys['wmid'].'&amp;w=35&amp;h=18&amp;bg=0XDBE2E9" alt="" border="0" height="18" width="35">
     		<br/>
     	</div>
     		Вы также можете отправить нам сообщение используя следующую форму:
     		<div style="padding-left: 20px;">
	     		<form action="/send-message.html" method="post">
				<table cellpadding="0" width="520" cellspacing="5">
					<tr>
						<td><label for="name">Ваше имя</label></td><td><input type="text" name="name" id="name" autocomplete="off" style="width: 200px;"></td>
					</tr>
					<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
					<tr>
						<td><label for="email">Ваш email</label></td><td><input type="text" name="email" id="email" autocomplete="off" style="width: 200px;"></td>
					</tr>
					<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
					<tr>
						<td valign="top"><label for="email">Ваше сообщение</label></td>
						<td><textarea name="message" id="message" style="width: 400px; height: 200px;"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="button" value="Отправить сообщение"></td>
					</tr>
				</table>
	     		</form>
     		</div>
     	</div>
	</div>
';
?>