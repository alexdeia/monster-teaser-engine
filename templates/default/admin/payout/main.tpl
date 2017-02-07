<div class="page_content">
	<h2 class="title">Отчеты о выплатах</h2>
    <div id="cont">
    	<center>
		<form action="/admin.php?show=payouts_reports" method="post">
        Показать <TVAR>s_type</TVAR> c <input type="text" name="from" value="<REQ>from</REQ>" size="10">
        по <input type="text" name="to" value="<REQ>to</REQ>" size="10">
        <input type="submit" class="button" value="Формировать отчеты">
        </form>
        </center>
        <br/>
		<table width="100%" bgcolor="#aaaaaa" cellspacing="1">
			<tr>
				<th width="20" align="center">Дата</th>
				<th width="50" align="center">Пользователь</th>
				<th width="200" align="center">Сумма</th>
			</tr>
           <TVAR>reports</TVAR>
		</table>
	</div>
</div>