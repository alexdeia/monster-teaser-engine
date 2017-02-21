<h2 class="title">Редактирование сайта</h2>
	<form action="/account/sites/<TVAR>site_id</TVAR>/save.html" method="post">
		<input type="hidden" name="action" value="save">
		<table class="table" cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="url">URL сайта</label></td><td><input class="form-control" type="text" name="url" id="url" value="<TVAR>site_url</TVAR>">
				<div class="help">Адрес Вашего сайта, без http:// и www</div></td>
			</tr>
			<tr>
				<td valign="top">
					<label>Выберите какие категории<br/>показывать на своем сайте</label>
					<br/>
					<a href="javascript:;" onClick="select_all_cats();">Выбрать все</a>
					<br/>
					<a href="javascript:;" onClick="deselect_all_cats();">Убрать все</a>

				</td>
				<td>
					<table border="0" width="80%">
						<thead>
							<tr>
								<th width="20"></th>
								<th width="200">Категория</th>
								<th width="150">Цена показов</th>
								<th width="150">Цена кликов</th>
							</tr>
						</thead>
						<TVAR>cats</TVAR>
					</table>
					<div class="help">В поле "Цена показов" указанны цена для простого и уникального показа, в поле "Цена кликов" соответственно также. Выбирайте как можно больше категорий, это повысит количество показываемых тизеров на Вашем сайте</div>
				</td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="btn btn-secondary"></td></tr>
		</table>
		<br/>
		<b>Внимание!!!</b> Перед сохранением изменений внимательно прочитайте "<a href="/rules.html">Правила</a>". Если Ваш сайт не соответствует им, модератор не одобрит Ваш сайт.
	</form>
<script type="text/javascript">
function select_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById("c_"+i).checked = true;
	}
}

function deselect_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById("c_"+i).checked = false;
	}
}
</script>