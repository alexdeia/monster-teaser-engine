<div class="page_content">
	<h2 class="title">Регистрация</h2>
    <div id="cont">
		<form action="/register.html" method="post">
		<input type="hidden" name="referrer" value="<REQ>referrer</REQ>">
		<input type="hidden" name="action" value="register">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="login">Логин</label></td><td><input type="text" name="login" id="login" value="<REQ>login</REQ>">
				<div class="help">Выберите имя пользователя</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="password">Пароль</label></td><td><input type="password" name="password" id="password" autocomplete="off">
				<div class="help">Придмайте пароль</div></td>
			</tr>
			<tr>
				<td><label for="password2">Повторите пароль</label></td><td><input type="password" name="password2" id="password2">
				<div class="help">Во избежание ошибок, повторите введеный выше пароль</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="email">Адрес email</label></td><td><input type="text" name="email" id="email" value="<REQ>email</REQ>">
				<div class="help">Пожалуйста, вводите корректный адрес</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">Ваше имя</label></td><td><input type="text" name="name" id="name" value="<REQ>name</REQ>">
				<div class="help">Ваше настоящее имя</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="type">Тип аккаунта</label></td><td><TVAR>acc_type_select</TVAR>
				<div class="help">Выберите тип аккаунта</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">WMID</label></td><td><input type="text" name="wmid" id="wmid" value="<REQ>wmid</REQ>">
				<div class="help">WebMoney идентификатор</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">WMZ</label></td><td><input type="text" name="wmz" id="wmz" value="<REQ>wmz</REQ>">
				<div class="help">Ваш Z кошелек в системе WebMoney</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top"><label for="statinf">Информация о статистике</label></td><td><textarea cols="60" eows="4" name="statinf" id="statinf"><REQ>statinf</REQ></textarea>
				<div class="help">Пожалуйста, введите данные доступа к статистике вашего сайта</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
	
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Продолжить регистрацию" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>
