<div class="page_content">
	<h2 class="title">Добавление новой компании</h2>
    <div id="cont">
		<form action="/account/companies/add.html" method="post">
		<input type="hidden" name="action" value="add">
	    <input type="hidden" name="redlist" value="0">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td valign="top"><label for="name">Название</label></td><td>
					<input type="text" name="name" id="name" value="">
				<div class="help">Введите краткое название рекламной компании. Оно будет отображаться только Вам.</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
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
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Продолжить создание рекламной компании" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>