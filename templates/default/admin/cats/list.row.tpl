<tr bgcolor="#f5f5f5">
	<td><TVAR>cat_id</TVAR></td>
	<td><TVAR>cat_name</TVAR></td>
	<td><TVAR>cat_price_show</TVAR></td>
	<td><TVAR>cat_price_show_uniq</TVAR></td>
	<td><TVAR>cat_price_click</TVAR></td>
	<td><TVAR>cat_price_click_uniq</TVAR></td>
	<td>
		<a onClick="return confirm('¬ы уверены, что хотите удалить категорию <TVAR>cat_name</TVAR>?');" href="/admin.php?action=delete_cat&id=<TVAR>cat_id</TVAR>&show=cats"><img src="/templates/<SYS>template</SYS>/img/delete.gif" border="0"></a>
		<a href="/admin.php?show=edit_cat&id=<TVAR>cat_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/edit.gif" border="0"></a>
	</td>
</tr>