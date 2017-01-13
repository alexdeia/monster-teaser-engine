<div class="page_content">
	<h2 class="title">Массовая рассылка писем</h2>
    <div id="cont">
    	<form action="/admin.php?action=massmail&show=massmail" method="post">
    	<table width="100%">
    		<tr>
    			<td>Заголовок письма</td>
    			<td width="100%"><input type="text" name="title" style="width: 100%;"></td>
    		</tr>
    			<td>Тело письма</td>
    			<td><textarea name="body" style="width: 100%; height: 400px;"></textarea>
    			    				Используйте %NAME% и %LOGIN% для подстановки имени пользователя и логина соответственно</td>
    		</tr>
    		<tr>
    			<td></td><td><input type="submit" value="Разослать" class="button"></td>
    		</tr>
    	</table>
    	</form>
    </div>
</div>