<div class="page_content">
	<h2 class="title">Моя бухгалтерия</h2>
    <div id="cont">
		<input type="hidden" name="action" value="save_settings">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="login">Текущий баланс</label></td><td>$ <TVAR>user_balance</TVAR>
				<div class="help">Ваш текущий баланс</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td height="50"></td></tr>
			<tr>
				<td>
					<label for="summ">Пополнить баланс</label>
				</td><td>
                    <form action="/account/funds/add-wm.html" method="post">
					<input type="text" name="summ" id="summ">
					<input type="submit" value="Продолжить" class="button">
					<div class="help">Введите сумму которую Вы хотите внести на баланс.</div>
					</form>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>