<h2 class="title">Добавление новой кампании</h2>
		<form action="/account/companies/add.html" method="post">
		<input type="hidden" name="action" value="add">
	    <input type="hidden" name="redlist" value="0">
		<table class="table" cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Название</label></td><td>
					<input class="form-control" type="text" name="name" id="name" value="">
				<div class="help">Введите краткое название рекламной компании. Оно будет отображаться только Вам.</div></td>
			</tr>
			<tr>
				<td><label for="url">Размер</label></td><td><TVAR>tizer_formats</TVAR>
				<div class="help">Выберите один из форматов тизеров</div></td>
			</tr>
<p>Перед созданием рекламной компании вам необходимо загрузить изображения 
тизеров соответствующего формата по следующей ссылке &quot;Мои информеры&quot; - &quot;Добавить 
новый информер&quot; или добавить на следующей странице из имеющихся уже у вас 
тизеров такого же формата.<br>
<br>
&nbsp;</p>
			<tr><td colspan="2" align="right"><input type="submit" value="Продолжить создание рекламной компании" class="btn btn-secondary"></td></tr>
		</table>
		</form>