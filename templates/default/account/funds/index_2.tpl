<h2 class="title">Моя бухгалтерия</h2>
	<input type="hidden" name="action" value="save_settings">
	<table class="table" cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="login">Текущий баланс</label></td><td>$ <TVAR>user_balance</TVAR>
				<div class="help">Ваш текущий баланс</div></td>
			</tr>
			<tr><td height="50"></td></tr>
			<tr>
				<td>
					<label for="summ">Пополнить баланс</label>
				</td><td>
						<form action="/account/funds/add-wm.html" method="post">
						<div class="col-lg-2">
							<input type="text" class="form-control" name="summ" id="summ">
						</div>
						<div class="col-lg-2">
							<input type="submit" value="Продолжить" class="btn btn-secondary">
						</div>
					<div class="help">Введите сумму которую Вы хотите внести на баланс.</div>
					</form>
				</td>
			</tr>
		</table>
	</form>