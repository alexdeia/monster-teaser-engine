<h2 class="title">Отчеты</h2>
    	<center>
		<form action="/admin.php?show=payments" method="post">
        Показать <TVAR>s_type</TVAR> c <input type="text" name="from" value="<REQ>from</REQ>" size="10">
        по <input type="text" name="to" value="<REQ>to</REQ>" size="10">
        <input type="submit" class="btn btn-primary" value="Формировать отчеты">
        </form>
        </center>
        <br/>
		<table class="table">
			<thead>
				<tr>
					<th width="20" align="center">Дата</th>
					<th width="50" align="center">Пользователь</th>
					<th width="200" align="center">Сумма</th>
				</tr>
			</thead>
           <TVAR>reports</TVAR>
		</table>