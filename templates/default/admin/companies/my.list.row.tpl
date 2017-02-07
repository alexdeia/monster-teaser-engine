<tr>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center"><TVAR>com_id</TVAR></td>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center"><img src="/templates/<SYS>template</SYS>/img/status_<TVAR>com_status</TVAR>.gif" border="0"></td>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center">
		<a href="/admin.php?show=edit_user&id=<TVAR>com_owner</TVAR>"><TVAR>com_owner_user</TVAR></a>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center">
		<TVAR>com_infs</TVAR>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>">
		<a href="/admin.php?show=companies&bycat=<TVAR>com_cat_id</TVAR>"><TVAR>com_cat</TVAR></a>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>">
		<a onClick="return confirm('Вы уверены, что хотите удалить компанию');" href="/admin.php?show=companies&action=delete_com&id=<TVAR>com_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/delete.gif"></a>
		<a title="Настройка таргетинга" href="/admin.php?show=com_tar&id=<TVAR>com_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/tar.gif" border="0"></a>
		<a title="Добавить тизеры" href="/admin.php?show=com_tizers_add&id=<TVAR>com_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/tiz_add.gif" border="0"></a>
		<a title="Удалить тизеры" href="/admin.php?show=com_tizers_delete&id=<TVAR>com_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/tiz_del.gif" border="0"></a>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>">
		<a href="/admin.php?action=stat_com&stat=0&id=<TVAR>com_id</TVAR>&show=companies<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_0.gif" border="0"></a>
		<a href="/admin.php?action=stat_com&stat=1&id=<TVAR>com_id</TVAR>&show=companies<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_1.gif" border="0"></a>
		<a href="/admin.php?action=stat_com&stat=2&id=<TVAR>com_id</TVAR>&show=companies<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_2.gif" border="0"></a>
	</td>
</tr>

