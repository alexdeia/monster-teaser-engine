<h2 class="title">Редактирование категории</h2>
	<form action="/admin.php?action=save_cat&show=cats&id=<TVAR>cat_id</TVAR>" method="post">
		<table class="table">
			<tr>
				<td><label for="name">Название</label></td><td><input class="form-control" type="text" name="name" id="name" value="<TVAR>cat_name</TVAR>">
				<div class="help">Название категории</div></td>
			</tr>
			<tr>
				<td><label for="price_show">Простой показ</label></td><td><input class="form-control" type="text" name="price_show" id="price_show" value="<TVAR>cat_price_show</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_show_uniq">Уникальный показ</label></td><td><input class="form-control" type="text" name="price_show_uniq" id="price_show_uniq" value="<TVAR>cat_price_show_uniq</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_click">Простой клик</label></td><td><input class="form-control" type="text" name="price_click" id="price_click" value="<TVAR>cat_price_click</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_click_uniq">Уникальный клик</label></td><td><input class="form-control" type="text" name="price_click_uniq" id="price_click_uniq" value="<TVAR>cat_price_click_uniq</TVAR>"></td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="btn btn-outline-success"></td></tr>
		</table>
		<br/>
	</form>