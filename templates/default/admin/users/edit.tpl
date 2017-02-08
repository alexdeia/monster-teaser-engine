<h2>Редактировение пользователя</h2>
<form action="/admin.php?action=save_user&show=users&id=<TVAR>user_id</TVAR>" method="post">
<table class="table">
	<tr>
		<td><label for="login">Логин</label></td><td><b><input class="form-control" type="text" name="login" id="login" value="<TVAR>user_login</TVAR>"></b>
		<div class="help">Выбранное имя пользователя</div></td>
	</tr>
	<tr>
		<td><label for="password">Пароль</label></td><td><input class="form-control" type="password" name="password" id="password" autocomplete="off">
		<div class="help">Заполняйте ТОЛЬКО в случае, если желаете изменить текущий пароль!</div></td>
	</tr>
	<tr>
		<td><label for="password2">Повторите пароль</label></td><td><input class="form-control" type="password" name="password2" id="password2">
		<div class="help">Во избежание ошибок, повторите введеный выше пароль если Вы желаете сменить его</div></td>
	</tr>
	<tr>
		<td><label for="email">Адрес email</label></td><td><input class="form-control" type="text" name="email" id="email" value="<TVAR>user_email</TVAR>">
		<div class="help">Пожалуйста, вводите корректный адрес</div></td>
	</tr>
	<tr>
		<td><label for="name">Ваше имя</label></td><td><input class="form-control" type="text" name="name" id="name" value="<TVAR>user_name</TVAR>">
		<div class="help">Ваше настоящее имя</div></td>
	</tr>
	<tr>
		<td><label for="name">Текущий баланс</label></td><td><input class="form-control" type="text" name="balance" id="balance" value="<TVAR>user_balance</TVAR>">
		<div class="help">Баланс пользователя, без учета баланса в компаниях</div></td>
	</tr>
	<tr>
		<td><label for="wmid">WMID</label></td><td><input class="form-control" type="text" name="wmid" id="wmid" value="<TVAR>user_wmid</TVAR>">
		<div class="help">WebMoney идентификатор</div></td>
	</tr>
	<tr>
		<td><label for="wmz">WMZ</label></td><td><input class="form-control" type="text" name="wmz" id="wmz" value="<TVAR>user_wmz</TVAR>">
		<div class="help">Ваш Z кошелек в системе WebMoney</div></td>
	</tr>
	<tr>
		<td valign="top"><label for="statinf">Информация о статистике</label></td><td><textarea class="form-control" cols="60" eows="4" name="statinf" id="statinf"><TVAR>user_statinf</TVAR></textarea>
		<div class="help">Пожалуйста, введите данные доступа к статистике вашего сайта</div></td>
	</tr>
	<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="btn btn-outline-success"></td></tr>
</table>
</form>
