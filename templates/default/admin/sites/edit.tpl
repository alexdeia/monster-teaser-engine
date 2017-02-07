<div class="page_content">
	<h2 class="title">Редактирование сайта</h2>
    <div id="cont">
		<form action="/admin.php?action=save_site&show=sites&id=<TVAR>site_id</TVAR>" method="post">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="url">URL сайта</label></td><td><input type="text" name="url" id="url" value="<TVAR>site_url</TVAR>">
				<div class="help">Адрес Вашего сайта, без http:// и www</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top">
					<label>Выберите какие категории<br/>показывать на своем сайте</label>
					<br/>
					<a href="javascript:;" onClick="select_all_cats();">Выбрать все</a>
					<br/>
					<a href="javascript:;" onClick="deselect_all_cats();">Убрать все</a></td>
				<td>
					<table border="0" width="80%">
						<tr>
							<th width="20"></th>
							<th width="200">Категория</th>
							<th width="150">Цена показов</th>
							<th width="150">Цена кликов</th>
						<TVAR>cats</TVAR>
					</table>
					<div class="help">В поле "Цена показов" указанны цена для простого и уникального показа, в поле "Цена кликов" соответственно также</div>
				</td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Сохранить изменения" class="button"></td></tr>
		</table>
		<br/>
		</form>
	</div>
</div>
<script type="text/javascript">
function select_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById('c_'+i).checked = true;
	}
}

function deselect_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById('c_'+i).checked = false;
	}
}
</script>