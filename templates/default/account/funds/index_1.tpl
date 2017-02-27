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
					<label for="summ">Вывод средств</label>
				</td><td>
                    <TVAR>payout_info</TVAR>
				</td>
			</tr>
		</table>
	</form>