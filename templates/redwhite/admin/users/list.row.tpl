<tr bgcolor="#f5f5f5">
	<td><TVAR>user_id</TVAR></td>
	<td><TVAR>user_login</TVAR></td>
	<td><TVAR>user_acc_type</TVAR></td>
	<td>
		<a href="/admin.php?show=edit_user&id=<TVAR>user_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/edit.gif" border="0"></a>
		<a onClick="return confirm('Вы уверены, что хотите удалить пользователя <TVAR>user_login</TVAR>?');" href="/admin.php?action=delete_user&show=users&id=<TVAR>user_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/delete.gif" border="0"></a>
		<a title="Сайты пользователя" href="/admin.php?show=sites&byuserid=<TVAR>user_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/admin/sites_16.gif" border="0"></a>
		<a title="Тизеры пользователя" href="/admin.php?show=tizers&byuserid=<TVAR>user_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/admin/tizers_16.gif" border="0"></a>
		<a title="Компании пользователя" href="/admin.php?show=companies&byuserid=<TVAR>user_id</TVAR>"><img src="/templates/<SYS>template</SYS>/img/admin/companies_16.gif" border="0"></a>


	</td>
</tr>