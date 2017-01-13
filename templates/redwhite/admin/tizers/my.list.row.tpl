<tr>
	<td bgcolor="<TVAR>inf_row_color</TVAR>" align="center"><TVAR>inf_id</TVAR></td>
	<td bgcolor="<TVAR>inf_row_color</TVAR>" align="center">
		<a href="/admin.php?show=edit_user&id=<TVAR>inf_owner</TVAR>"><TVAR>inf_owner_user</TVAR></a>
	</td>
	<td bgcolor="<TVAR>inf_row_color</TVAR>" align="center">
		<img src="/data/informers/<TVAR>inf_id</TVAR>/<TVAR>inf_image</TVAR>" border="0">
	</td>
	<td bgcolor="<TVAR>inf_row_color</TVAR>">
		<TVAR>inf_text</TVAR>
		<br/>
		<a href="http://<TVAR>inf_url</TVAR>" target="_blank"><TVAR>inf_url</TVAR></a></td>
	<td bgcolor="<TVAR>inf_row_color</TVAR>">
    	Простых: <TVAR>inf_clicks</TVAR>/<TVAR>inf_shows</TVAR>
    	<br/>
    	Уникальных: <TVAR>inf_shows_uniq</TVAR>/<TVAR>inf_clicks_uniq</TVAR>
	</td>
	<td bgcolor="<TVAR>inf_row_color</TVAR>" align="center">
		<a href="/admin.php?show=edit_tizer&id=<TVAR>inf_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/edit.gif" border="0"></a>
		<a onClick="return confirm('Вы уверены, что хотите удалить тизер?');" href="/admin.php?action=delete_tizer&id=<TVAR>inf_id</TVAR>&show=tizers"><img src="/templates/<SYS>template</SYS>/img/delete.gif" border="0"></a>
		<a href="/admin.php?show=tizer_reports&id=<TVAR>inf_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/reports.gif" border="0"></a>
	</td>
</tr>

