	<h2 class="title">Отчеты для рекламной компании #<TVAR>com_id</TVAR></h2>
		<form action="/account/informers/<TVAR>com_id</TVAR>/reports.html" method="post">
		<table class="table" align="center">
			<tr>
				<td>Выберите дату для формирования отчета</td>
				<td>
					<select name="year"><FUNC>get_years_opts{<REQ>year</REQ>}</FUNC></select>
					<select name="month"><FUNC>get_monthes_opts{<REQ>month</REQ>}</FUNC></select>
					<select name="day"><FUNC>get_days_opts{<REQ>day</REQ>}</FUNC></select>

				</td>
			</tr>
			<tr>
				<td>Установите фильры отчета</td>
				<td>
					<select name="type">
						<option value="all">Клики и показы</option>
						<option value="show">Только показы</option>
						<option value="click">Только клики</option>
					</select>
				</td>
			</tr>
		</table>
		<p align="right"><input type="submit" value="Формировать отчет" class="btn btn-secondary"></p>
		<table class="table" width="100%" cellspadding="2" cellspacing="1" bgcolor="#D7D7D7">
			<thead>
				<tr>
					<th>Время</th>
					<th>Показ/Уникальный</th>
					<th>Клик/Уникальный</th>
					<th>IP адрес</th>
				</tr>
			</thead>