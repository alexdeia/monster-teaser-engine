<div class="page_content">
	<h2 class="title">Редатирование новости</h2>
    <div id="cont">
    	<form action="/admin.php?action=save_news&show=news&id=<TVAR>news_id</TVAR>" method="post">
    	<table width="100%">
    		<tr>
    			<td>Заголовок</td>
    			<td width="100%"><input type="text" name="short" style="width: 100%;" value="<TVAR>news_short</TVAR>" /></td>
    		</tr>
    			<td>Новость</td>
    			<td>
    				<textarea name="full" style="width: 100%; height: 60px;"><TVAR>news_full</TVAR></textarea>
    			</td>
    		</tr>
    		<tr>
    			<td></td><td><input type="submit" value="Сохранить новость" class="button"></td>
    		</tr>
    	</table>
    	</form>
    	<br/>
    	<TVAR>news</TVAR>
    </div>
</div>