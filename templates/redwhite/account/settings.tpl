<div class="page_content">
	<h2 class="title">���������</h2>
    <div id="cont">
		<form action="/account/save.html" method="post">
		<input type="hidden" name="action" value="save_settings">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="login">�����</label></td><td><b><TVAR>user_login</TVAR></b>
				<div class="help">��������� ��� ������������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="password">������</label></td><td><input type="password" name="password" id="password" autocomplete="off">
				<div class="help">���������� ������ � ������, ���� ������� �������� ������� ������!</div></td>
			</tr>
			<tr>
				<td><label for="password2">��������� ������</label></td><td><input type="password" name="password2" id="password2">
				<div class="help">�� ��������� ������, ��������� �������� ���� ������ ���� �� ������� ������� ���</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="email">����� email</label></td><td><input type="text" name="email" id="email" value="<TVAR>user_email</TVAR>">
				<div class="help">����������, ������� ���������� �����</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">���� ���</label></td><td><input type="text" name="name" id="name" value="<TVAR>user_name</TVAR>">
				<div class="help">���� ��������� ���</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="wmid">WMID</label></td><td><input type="text" name="wmid" id="wmid" value="<TVAR>user_wmid</TVAR>">
				<div class="help">WebMoney �������������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="wmz">WMZ</label></td><td><input type="text" name="wmz" id="wmz" value="<TVAR>user_wmz</TVAR>">
				<div class="help">��� Z ������� � ������� WebMoney</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top"><label for="statinf">���������� � ����������</label></td><td><textarea cols="60" eows="4" name="statinf" id="statinf"><TVAR>user_statinf</TVAR></textarea>
				<div class="help">����������, ������� ������ ������� � ���������� ������ �����</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="��������� ���������" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>