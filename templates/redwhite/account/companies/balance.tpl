<div class="page_content">
	<h2 class="title">Баланс рекламной компании</h2>
    <div id="cont">
		<form action="/account/companies/<TVAR>com_id</TVAR>/balance.html" method="post">
		<input type="hidden" name="action" value="save_balance">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Текущий баланс компании</label></td><td>
					<TVAR>com_funds</TVAR>
				<div class="help">Текущий баланс рекламной компании</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
			<tr>
				<td valign="top"><label for="funds_put">Пополнить средства</label></td><td>
					<input type="text" name="funds_put" id="funds_put" value="">
					<br/>
					<b>Ваш текущий баланс:</b> <CFUNC>user::getVariable{balance}</CFUNC>
				<div class="help">Укажите сумму которую хотите добавить в пользу рекламной компаниии</div></td>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top"><label for="funds_take">Снять средства</label></td><td>
					<input type="text" name="funds_take" id="funds_take" value="">
				<div class="help">Укажите сумму которую снять с рекламной компаниии</div></td>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Произвести расчеты" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>