<div class="page_content">
	<h2 class="title">�����������</h2>
    <div id="cont">
		<form action="/register.html" method="post">
		<input type="hidden" name="referrer" value="<REQ>referrer</REQ>">
		<input type="hidden" name="action" value="register">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="login">�����</label></td><td><input type="text" name="login" id="login" value="<REQ>login</REQ>">
				<div class="help">�������� ��� ������������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="password">������</label></td><td><input type="password" name="password" id="password" autocomplete="off">
				<div class="help">��������� ������</div></td>
			</tr>
			<tr>
				<td><label for="password2">��������� ������</label></td><td><input type="password" name="password2" id="password2">
				<div class="help">�� ��������� ������, ��������� �������� ���� ������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="email">����� email</label></td><td><input type="text" name="email" id="email" value="<REQ>email</REQ>">
				<div class="help">����������, ������� ���������� �����</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">���� ���</label></td><td><input type="text" name="name" id="name" value="<REQ>name</REQ>">
				<div class="help">���� ��������� ���</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="type">��� ��������</label></td><td><TVAR>acc_type_select</TVAR>
				<div class="help">�������� ��� ��������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">WMID</label></td><td><input type="text" name="wmid" id="wmid" value="<REQ>wmid</REQ>">
				<div class="help">WebMoney �������������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="name">WMZ</label></td><td><input type="text" name="wmz" id="wmz" value="<REQ>wmz</REQ>">
				<div class="help">��� Z ������� � ������� WebMoney</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top"><label for="statinf">���������� � ����������</label></td><td><textarea cols="60" eows="4" name="statinf" id="statinf"><REQ>statinf</REQ></textarea>
				<div class="help">����������, ������� ������ ������� � ���������� ������ �����</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
	
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="���������� �����������" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>
