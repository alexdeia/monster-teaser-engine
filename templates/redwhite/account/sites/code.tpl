<div class="page_content">
	<h2 class="title">Выбор и получение кода для сайта</h2>
    <div id="cont">
		<form action="/account/sites/<TVAR>site_id</TVAR>/code.html" method="post">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="cols">Количество столбцов</label></td><td><TVAR>s_cols</TVAR></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="rows">Количество строк</label></td><td><TVAR>s_rows</TVAR></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="text_dir">Расположение текста</label></td><td><TVAR>s_text_dir</TVAR></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="bgcolor">Цвет фона блока</label></td><td><input id="c_bgcolor" type="text" name="bgcolor" value="<REQ>bgcolor</REQ>"></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="acolor">Цвет ссылки</label></td><td><input type="text" name="acolor" value="<REQ>acolor</REQ>"></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="ahover">Цвет ссылки при наведении</label></td><td><input type="text" name="ahover" value="<REQ>ahover</REQ>"></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="ahover">Рамка вокруг картинки</label></td><td><input type="text" name="iborder" value="<REQ>iborder</REQ>"></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="ahover">Формат тиеров</label></td><td><TVAR>tizer_formats</TVAR></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="cols">Шрифт и начертание</label></td><td>
					<TVAR>s_font</TVAR>
					<TVAR>s_font_type</TVAR>
					<TVAR>s_font_size</TVAR>
				</td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="cols">Подчеркивание текста</label></td><td>
					<TVAR>s_decoration</TVAR>
				</td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Получить код" class="button"></td></tr>
		</table>
		</form>
		<h4>Код для установки на сайте</h4>
		<textarea style="width: 100%; height: 120px;"><TVAR>code</TVAR></textarea>
		<h4>Образец тизерного блока</h4>
		<TVAR>code2</TVAR>
	</div>
</div>