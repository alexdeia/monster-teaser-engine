<h2 class="title">Отчеты для тизера #<TVAR>inf_id</TVAR></h2>
	<form action="/admin.php?show=tizer_reports&id=<TVAR>inf_id</TVAR>" method="post">
		<table class="table">
			<tr>
				<td>Выберите дату для формирования отчета</td>
				<td>
					<select name="year"><FUNC>get_years_opts{<REQ>year</REQ>}</FUNC></select>
					<select name="month"><FUNC>get_monthes_opts{<REQ>month</REQ>}</FUNC></select>
					<select name="day"><FUNC>get_days_opts{<REQ>day</REQ>}</FUNC></select>

				</td>
			</tr>
			<tr>
				<td>Установите фильтры отчета</td>
				<td>
					<select name="type">
						<option value="all">Клики и показы</option>
						<option value="show">Только показы</option>
						<option value="click">Только клики</option>
					</select>
				</td>
			</tr>
		</table>
		<p align="right"><input type="submit" value="Формировать отчет" class="btn btn-outline-success"></p>
		<table class="table">
			<thead>
				<tr>
					<th>Время</th>
					<th>Показ/Уникальный</th>
					<th>Клик/Уникальный</th>
					<th>IP адрес</th>
					<th>Реферер</th>
				</tr>
			</thead>