	<h2 class="title">Баланс рекламной компании</h2>
		<form action="/account/companies/<TVAR>com_id</TVAR>/balance.html" method="post">
		<input type="hidden" name="action" value="save_balance">
		<table class="table" cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Текущий баланс компании</label></td><td>
					<TVAR>com_funds</TVAR>
				<div class="help">Текущий баланс рекламной компании</div></td>
			</tr>
			<tr>
			<tr>
				<td valign="top"><label for="funds_put">Пополнить средства</label></td><td>
					<input type="text" class="form-control" name="funds_put" id="funds_put" value="">
					<br/>
					<b>Ваш текущий баланс:</b> <CFUNC>user::getVariable{balance}</CFUNC>
				<div class="help">Укажите сумму которую хотите добавить в пользу рекламной компаниии</div></td>
			<tr>
				<td valign="top"><label for="funds_take">Снять средства</label></td><td>
					<input type="text" class="form-control" name="funds_take" id="funds_take" value="">
				<div class="help">Укажите сумму которую снять с рекламной компаниии</div></td>
			<tr><td colspan="2" align="right"><input type="submit" value="Произвести расчеты" class="btn btn-secondary"></td></tr>
		</table>
		</form>
	</div>
</div>