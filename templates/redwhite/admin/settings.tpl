<div class="page_content">
	<h2 class="title">��������� �������</h2>
    <div id="cont">
		<form action="/admin.php?show=settings&action=save_settings" method="post">
		<table width="500">
			<tr><td colspan="2" align="center" bgcolor="#e4e4e4"><b>����� ���������</b></td></tr>

			<tr>
				<td class="frm">�������� �����</td>
				<td class="frm"><input type="text" name="sys[title]" value="<SYS>title</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">������ �����</td>
				<td class="frm"><input type="text" name="sys[template]" value="<SYS>template</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">�������� � �������\������</td>
				<td class="frm"><input type="text" name="sys[perc]" value="<SYS>perc</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">ICQ</td>
				<td class="frm"><input type="text" name="sys[admin_icq]" value="<SYS>admin_icq</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">����������� ������� � �����</td>
				<td class="frm"><input type="text" name="sys[login_chars]" value="<SYS>login_chars</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm" valign="top">������� �������</td>
				<td class="frm"><textarea style="width: 200px;" name="sys[tizer_formats]"><TVAR>tizer_formats</TVAR></textarea></td>
			</tr>
			<tr><td colspan="2" align="center" bgcolor="#e4e4e4"><b>Email ������ �������</b></td></tr>
			<tr>
				<td class="frm">email ������</td>
				<td class="frm"><input type="text" name="sys[admin_email]" value="<SYS>admin_email</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">email �����. ������</td>
				<td class="frm"><input type="text" name="sys[passrobot_email]" value="<SYS>passrobot_email</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">email ��������</td>
				<td class="frm"><input type="text" name="sys[massmail_email]" value="<SYS>massmail_email</SYS>" style="width: 200px;"></td>
			</tr>

			<tr><td colspan="2" align="center" bgcolor="#e4e4e4"><b>WebMoney ���������</b></td></tr>
			<tr>
				<td class="frm">WMID</td>
				<td class="frm"><input type="text" name="sys[wmid]" value="<SYS>wmid</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">WMZ</td>
				<td class="frm"><input type="text" name="sys[wmz]" value="<SYS>wmz</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">���� � ��������</td>
				<td class="frm"><input type="text" name="sys[payout_info]" value="<SYS>payout_info</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td class="frm">������ ������</td>
				<td class="frm"><TVAR>s_pt</TVAR></td>
			</tr>
			<tr><td colspan="2" align="center" bgcolor="#e4e4e4"><b>����������� �������</b></td></tr>
			<tr>
				<td class="frm">% ��� ��������</td>
				<td class="frm"><input type="text" name="sys[ref_perc]" value="<SYS>ref_perc</SYS>" style="width: 200px;"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="��������� ���������" class="button">
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>