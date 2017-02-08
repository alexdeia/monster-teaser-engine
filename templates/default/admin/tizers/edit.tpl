<h2 class="title">Редактирование информера</h2>
	<form action="/admin.php?action=save_tizer&id=<TVAR>inf_id</TVAR>&show=tizers" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td><label for="image">Изображение тизера</label></td><td>
					<input name="image" id="image" type="file" style="height: 26px; font-weight: bold;">
					<br /><br />
					<img src="/data/informers/<TVAR>inf_id</TVAR>/<TVAR>inf_image</TVAR>" border="0">
				<div class="help">Картинка информера. Максимальный размер 60*60 пикселей. Допустимы форматы gif, jpeg, png</div></td>
			</tr>
			<tr>
				<td><label for="url">URL</label></td><td><input class="form-control" type="text" name="url" id="url" value="<TVAR>inf_url</TVAR>">
				<div class="help">Введите URL на который будет совершен переход</div></td>
			</tr>
			<tr>
				<td><label for="text">Текст</label></td><td><input class="form-control" type="text" name="text" id="text" value="<TVAR>inf_text</TVAR>">
				<div class="help">Текст тизера</div></td>
			</tr>
			<tr><td colspan="2" align="right"><input class="btn btn-outline-success" type="submit" value="Сохранить изменения" class="button"></td></tr>
		</table>
	</form>