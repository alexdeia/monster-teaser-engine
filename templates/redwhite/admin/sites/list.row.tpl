<tr bgcolor="#f5f5f5">
	<td><img src="/templates/<SYS>template</SYS>/img/status_<TVAR>site_status</TVAR>.gif" border="0"></td>
	<td><TVAR>site_id</TVAR></td>
	<td><TVAR>site_url</TVAR></td>
	<td>
		<a href="/admin.php?show=edit_user&id=<TVAR>site_owner</TVAR>"><TVAR>site_owner_user</TVAR></a>
		<a href="/admin.php?show=sites&byuserid=<TVAR>site_owner</TVAR>"><img src="/templates/<SYS>template</SYS>/img/admin/sites_16.gif" border="0"></a>
	</td>
	<td>
		<a href="/admin.php?show=edit_site&id=<TVAR>site_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/edit.gif" border="0"></a>
		<a onClick="return confirm('Вы уверены, что хотите удалить сайт <TVAR>site_url</TVAR>?');" href="/admin.php?action=delete_site&show=sites&id=<TVAR>site_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/delete.gif" border="0"></a>
		<a href="/admin.php?show=site_reports&id=<TVAR>site_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/reports.gif" border="0"></a>
	</td>
	<td>
		<a href="/admin.php?action=stat_site&stat=0&id=<TVAR>site_id</TVAR>&show=sites<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_0.gif" border="0"></a>
		<a href="/admin.php?action=stat_site&stat=1&id=<TVAR>site_id</TVAR>&show=sites<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_1.gif" border="0"></a>
		<a href="/admin.php?action=stat_site&stat=2&id=<TVAR>site_id</TVAR>&show=sites<TVAR>pend_app</TVAR>"><img src="/templates/<SYS>template</SYS>/img/status_2.gif" border="0"></a>
	</td>
</tr>