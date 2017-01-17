<div class="page_content">
	<h2 class="title">Управление новостями</h2>
    <div id="cont">
    	<form action="/admin.php?action=add_news&show=news" method="post">
    	<table width="100%">
    		<tr>
    			<td>Заголовок</td>
    			<td width="100%"><input type="text" name="short" style="width: 100%;"></td>
    		</tr>
    			<td>Новость</td>
    			<td>
    				<textarea name="full" style="width: 100%; height: 60px;"></textarea>
    			</td>
    		</tr>
    		<tr>
    			<td></td><td><input type="submit" value="Добавить новость" class="button"></td>
    		</tr>
    	</table>
    	</form>
    	<br/>
    	<TVAR>news</TVAR>
    </div>
</div>