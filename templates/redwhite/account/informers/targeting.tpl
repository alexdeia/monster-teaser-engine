<div class="page_content">
	<h2 class="title">Настрока таргетинга рекламной компании</h2>
    <div id="cont">
		<form action="/account/companies/<TVAR>com_id</TVAR>/targeting.html" method="post">
		<input type="hidden" name="action" value="targeting_save">
		<h5>Таргетинг по категории рекламы</h5>
					<table border="0" width="80%">
						<tr>
							<th width="20"></th>
							<th width="200">Категория</th>
							<th width="150">Цена показов</th>
							<th width="150">Цена кликов</th>
						<TVAR>tar_cat</TVAR>
					</table>
        <h4>Таргетинг по дням недели(<a href="javascript:;" onClick="select_all_days();">Выбрать все</a> | <a href="javascript:;" onClick="deselect_all_days();">Убрать все</a>)</h4>
		<TVAR>tar_day</TVAR>
		<h4>Таргетинг по времени суток(<a href="javascript:;" onClick="select_all_hours();">Выбрать все</a> | <a href="javascript:;" onClick="deselect_all_hours();">Убрать все</a>)</h4>
		<table border="0">
	        <TVAR>tar_time</TVAR>
		</table>
		<h4>Принимать неуникальных посетителей?</h4>
		<table border="0">
	        <TVAR>tar_uniq</TVAR>
		</table>
		<div style="text-align: right; margin-top: 10px;">
			<input type="submit" value="Закончить создание рекламной компании" class="button">
		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
function select_all_days() {
	for(i=1;i<8;i++) {
		document.getElementById("td_"+i).checked = true;
	}
}

function deselect_all_days() {
	for(i=1;i<8;i++) {
		document.getElementById("td_"+i).checked = false;
	}
}

function select_all_hours() {
	for(i=0;i<24;i++) {
		document.getElementById("tt_"+i).checked = true;
	}
}

function deselect_all_hours() {
	for(i=0;i<24;i++) {
		document.getElementById("tt_"+i).checked = false;
	}
}
</script>