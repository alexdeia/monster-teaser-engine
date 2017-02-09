	<h2 class="title">Настройка системы</h2>
		<form action="/admin.php?show=settings&action=save_settings" method="post">
		<table class="table" width="500">
			<tr><td colspan="2" align="center"><b>Общие настройки</b></td></tr>
			<tr>
				<td class="frm">Версия движка</td>
				<td class="frm"><b><TVAR>version_mte</TVAR></b></td>
			</tr>
			<tr>
				<td class="frm">Название сайта</td>
				<td class="frm"><input class="form-control" type="text" name="sys[title]" value="<SYS>title</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Шаблон сайта</td>
				<td class="frm"><input class="form-control" type="text" name="sys[template]" value="<SYS>template</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Проценты с показов\кликов</td>
				<td class="frm"><input class="form-control" type="text" name="sys[perc]" value="<SYS>perc</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">ICQ</td>
				<td class="frm"><input class="form-control" type="text" name="sys[admin_icq]" value="<SYS>admin_icq</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Разрешенные символы в логинах</td>
				<td class="frm"><input class="form-control" type="text" name="sys[login_chars]" value="<SYS>login_chars</SYS>"></td>
			</tr>
			<tr>
				<td class="frm" valign="top">Размеры тизеров</td>
				<td class="frm"><textarea class="form-control" style="height: 75px;" name="sys[tizer_formats]"><TVAR>tizer_formats</TVAR></textarea></td>
			</tr>
			<tr><td colspan="2" align="center"><b>Email адреса системы</b></td></tr>
			<tr>
				<td class="frm">Email админа</td>
				<td class="frm"><input class="form-control" type="text" name="sys[admin_email]" value="<SYS>admin_email</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Email восст. пароля</td>
				<td class="frm"><input class="form-control" type="text" name="sys[passrobot_email]" value="<SYS>passrobot_email</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Email рассылки</td>
				<td class="frm"><input class="form-control" type="text" name="sys[massmail_email]" value="<SYS>massmail_email</SYS>"></td>
			</tr>

			<tr><td colspan="2" align="center"><b>WebMoney настройки</b></td></tr>
			<tr>
				<td class="frm">WMID</td>
				<td class="frm"><input class="form-control" type="text" name="sys[wmid]" value="<SYS>wmid</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">WMZ</td>
				<td class="frm"><input class="form-control" type="text" name="sys[wmz]" value="<SYS>wmz</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Информация о выплатах</td>
				<td class="frm"><input class="form-control" type="text" name="sys[payout_info]" value="<SYS>payout_info</SYS>"></td>
			</tr>
			<tr>
				<td class="frm">Способ выплат</td>
				<td class="frm"><TVAR>s_pt</TVAR></td>
			</tr>
			<tr><td colspan="2" align="center"><b>Реферальная система</b></td></tr>
			<tr>
				<td class="frm">% для реферера</td>
				<td class="frm"><input class="form-control" type="text" name="sys[ref_perc]" value="<SYS>ref_perc</SYS>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Сохранить настройки" class="btn btn-success">
				</td>
			</tr>
		</table>
			</div>
		</form>

