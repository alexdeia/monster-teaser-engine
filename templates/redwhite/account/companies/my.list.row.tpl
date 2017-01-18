<tr>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center">
		<img src="/templates/<SYS>template</SYS>/img/status_<TVAR>com_status</TVAR>.gif" border="0">
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center">
		<TVAR>com_name</TVAR>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>">
		<TVAR>com_funds</TVAR>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>">
		<TVAR>com_spent</TVAR>
	</td>
	<td bgcolor="<TVAR>com_row_color</TVAR>" align="center">
		<a title="Редактировать компанию" href="/account/companies/<TVAR>com_id</TVAR>/edit.html"><img src="/templates/<SYS>template</SYS>/img/edit.gif" border="0"></a>
		<a title="Настройка таргетинга" href="/account/companies/<TVAR>com_id</TVAR>/targeting.html"><img src="/templates/<SYS>template</SYS>/img/tar.gif" border="0"></a>
		<a title="Добавить тизеры" href="/account/companies/<TVAR>com_id</TVAR>/add-informers.html"><img src="/templates/<SYS>template</SYS>/img/tiz_add.gif" border="0"></a>
		<a title="Удалить тизеры" href="/account/companies/<TVAR>com_id</TVAR>/delete-informers.html"><img src="/templates/<SYS>template</SYS>/img/tiz_del.gif" border="0"></a>
		<a title="Удалить компанию" onClick="return confirm('Вы уверены, что хотите удалить компанию?');" href="/account/companies/<TVAR>com_id</TVAR>/delete.html"><img src="/templates/<SYS>template</SYS>/img/delete.gif" border="0"></a>
		<a title="Отчеты" href="/account/companies/<TVAR>com_id</TVAR>/reports.html"><img src="/templates/<SYS>template</SYS>/img/reports.gif" border="0"></a>
		<IF <TVAR>com_status</TVAR> == 1>
			<a title="Баланс компании" href="/account/companies/<TVAR>com_id</TVAR>/balance.html"><img src="/templates/<SYS>template</SYS>/img/bucks_<TVAR>com_status</TVAR>.gif" border="0"></a>
		<ELSE>
			<img src="/templates/<SYS>template</SYS>/img/bucks_<TVAR>com_status</TVAR>.gif" border="0">
		</IF>
	</td>
</tr>

