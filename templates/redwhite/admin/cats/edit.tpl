<div class="page_content">
	<h2 class="title">�������������� ���������</h2>
    <div id="cont">
		<form action="/admin.php?action=save_cat&show=cats&id=<TVAR>cat_id</TVAR>" method="post">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="name">��������</label></td><td><input type="text" name="name" id="name" value="<TVAR>cat_name</TVAR>">
				<div class="help">�������� ���������</div></td>
			</tr>
			<tr>
				<td><label for="price_show">������� �����</label></td><td><input type="text" name="price_show" id="price_show" value="<TVAR>cat_price_show</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_show_uniq">���������� �����</label></td><td><input type="text" name="price_show_uniq" id="price_show_uniq" value="<TVAR>cat_price_show_uniq</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_click">������� ����</label></td><td><input type="text" name="price_click" id="price_click" value="<TVAR>cat_price_click</TVAR>"></td>
			</tr>
			<tr>
				<td><label for="price_click_uniq">���������� ����</label></td><td><input type="text" name="price_click_uniq" id="price_click_uniq" value="<TVAR>cat_price_click_uniq</TVAR>"></td>
			</tr>

			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="��������� ���������" class="button"></td></tr>
		</table>
		<br/>
		</form>
	</div>
</div>