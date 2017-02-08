<h2 class="title">Настрока таргетинга рекламной компании</h2>
	<form action="/admin.php?action=save_com_tar&show=companies&id=<TVAR>com_id</TVAR>" method="post">
		<h4>Таргетинг по категории рекламы</h4>
					<table class="table" border="0" width="80%">
						<thead>
							<tr>
								<th width="20"></th>
								<th width="200">Категория</th>
								<th width="150">Цена показов</th>
								<th width="150">Цена кликов</th>
							</tr>
						</thead>
						<TVAR>tar_cat</TVAR>
					</table>
        <h4>Таргетинг по дням недели (<a href="javascript:;" onClick="select_all_days();">Выбрать все</a> | <a href="javascript:;" onClick="deselect_all_days();">Убрать все</a>)</h4>
		<TVAR>tar_day</TVAR>
		<br /><br>
		<h4>Таргетинг по времени суток (<a href="javascript:;" onClick="select_all_hours();">Выбрать все</a> | <a href="javascript:;" onClick="deselect_all_hours();">Убрать все</a>)</h4>
		<table class="table" border="0">
	        <TVAR>tar_time</TVAR>
		</table>
		<h4>Принимать неуникальных посетителей?</h4>
		<table class="table" width="30%">
	        <TVAR>tar_uniq</TVAR>
		</table>
		<div style="text-align: right; margin-top: 10px; padding-bottom: 30px;">
			<input type="submit" value="Сохранить изменения" class="btn btn-outline-success">
		</div>
	</form>
<script type="text/javascript">
function select_all_days() {	for(i=1;i<8;i++) {		document.getElementById("td_"+i).checked = true;
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