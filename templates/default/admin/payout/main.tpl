<h2 class="title">Отчеты о выплатах</h2>
		<form action="/admin.php?show=payouts_reports" method="post">
        Показать <TVAR>s_type</TVAR> c <input type="text" name="from" value="<REQ>from</REQ>" size="10">
        по <input type="text" name="to" value="<REQ>to</REQ>" size="10">
        <input type="submit" class="btn btn-primary" value="Формировать отчеты">
        </form>
        <br/>
		<table class="table">
			<thead>
				<tr>
					<th>Дата</th>
					<th>Пользователь</th>
					<th>Сумма</th>
				</tr>
			</thead>
           <TVAR>reports</TVAR>
		</table>