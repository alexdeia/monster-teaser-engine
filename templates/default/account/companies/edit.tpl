	<h2 class="title">Редактирование компании</h2>
		<form action="/account/companies/<TVAR>com_id</TVAR>/edit.html" method="post">
		<input type="hidden" name="action" value="save">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Название</label></td><td>
					<input class="form-control" type="text" name="name" id="name" value="<TVAR>com_name</TVAR>">
				<div class="help">Введите краткое название рекламной компании. Оно будет отображаться только Вам.</div></td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="btn btn-secondary"></td></tr>
		</table>
		</form>