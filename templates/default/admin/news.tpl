<h2 class="title">Управление новостями</h2>
	<form action="/admin.php?action=add_news&show=news" method="post">
    	<table class="table">
    		<tr>
    			<td>Заголовок</td>
    			<td width="100%"><input class="form-control" type="text" name="short" style="width: 100%;"></td>
    		</tr>
    			<td>Новость</td>
    			<td>
    				<textarea class="form-control" name="full" style="height: 90px;"></textarea>
    			</td>
    		</tr>
    		<tr>
    			<td></td><td><input type="submit" value="Добавить новость" class="btn btn-primary"></td>
    		</tr>
    	</table>
	</form>
    	<br/>
    	<TVAR>news</TVAR>