<div class="page_content">
	<h2 class="title">�������������� ���������</h2>
    <div id="cont">
		<form action="/account/informers/<TVAR>inf_id</TVAR>/save.html" method="post" enctype="multipart/form-data">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="image">����������� ������</label></td><td>
					<input name="image" id="image" type="file" style="height: 26px; font-weight: bold;">
					<br />
					<img src="/images/informers/<TVAR>inf_image</TVAR>" border="0">
				<div class="help">�������� ���������. ������������ ������ 60*60 ��������. ��������� ������� gif,jpeg,png</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="url">������</label></td><td><TVAR>tizer_formats</TVAR>
				<div class="help">�������� ���� �� �������� ������</div></td>
			</tr>
				<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="url">URL</label></td><td><input type="text" name="url" id="url" value="<TVAR>inf_url</TVAR>">
				<div class="help">������� URL �� ������� ����� �������� �������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td><label for="text">�����</label></td><td><input type="text" name="text" id="text" value="<TVAR>inf_text</TVAR>">
				<div class="help">����� ������</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="��������� ���������" class="button"></td></tr>
		</table>
		</form>
	</div>
</div>