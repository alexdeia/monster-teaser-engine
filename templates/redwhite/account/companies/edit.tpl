<div class="page_content">
	<h2 class="title">Редактирование компании</h2>
    <div id="cont">
		<form action="/account/companies/<TVAR>com_id</TVAR>/edit.html" method="post">
		<input type="hidden" name="action" value="save">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Название</label></td><td>
					<input type="text" name="name" id="name" value="<TVAR>com_name</TVAR>">
				<div class="help">Введите краткое название рекламной компании. Оно будет отображаться только Вам.</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>