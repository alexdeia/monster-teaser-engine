<h2 class="title">Массовая рассылка писем</h2>
	<form action="/admin.php?action=massmail&show=massmail" method="post">
    	<table class="form-control">
    		<tr>
    			<td>Заголовок письма</td>
    			<td width="100%"><input class="form-control" type="text" name="title" style="width: 100%;"></td>
    		</tr>
    			<td>Тело письма</td>
    			<td><textarea class="form-control" name="body" style="height: 400px;"></textarea>
					Используйте %NAME% и %LOGIN% для подстановки имени пользователя и логина соответственно</td>
    		</tr>
    		<tr>
    			<td></td><td><input type="submit" value="Разослать" class="btn btn-primary"></td>
    		</tr>
    	</table>
	</form>