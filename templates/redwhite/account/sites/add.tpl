<div class="page_content">
	<h2 class="title">���������� ������ �����</h2>
    <div id="cont">
		<form action="/account/sites/add.html" method="post">
		<input type="hidden" name="action" value="add">
		<table cellpadding="0" width="100%" cellspacing="5">
			<tr>
				<td><label for="url">URL �����</label></td><td><input type="text" name="url" id="url">
				<div class="help">����� ������ �����, ��� http:// � www</div></td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr>
				<td valign="top">
					<label>�������� ����� ���������<br/>���������� �� ����� �����</label>
					<br/>
					<a href="javascript:;" onClick="select_all_cats();">������� ���</a>
					<br/>
					<a href="javascript:;" onClick="deselect_all_cats();">������ ���</a>

				</td>
				<td>
					<table border="0" width="80%">
						<tr>
							<th width="20"></th>
							<th width="200">���������</th>
							<th width="150">���� �������</th>
							<th width="150">���� ������</th>
						<TVAR>cats</TVAR>
					</table>
					<div class="help">� ���� "���� �������" �������� ���� ��� �������� � ����������� ������, � ���� "���� ������" �������������� ����� ��������� ��� ����� ������ ���������, ��� ������� ���������� ������������ ������� �� ����� �����</div>
				</td>
			</tr>
			<tr><td colspan="2" height="1" bgcolor="#e4e4e4"></td></tr>
			<tr><td colspan="2" align="right"><input type="submit" value="�������� ����" class="button"></td></tr>
		</table>
		<br/>
		<b>��������!!!</b> ����� ����������� ����� � ������� ����������� ���������� "<a href="/rules.html">�������</a>". ���� ��� ���� �� ������������� ��, ��������� �� ������� ��� ����.
		</form>
	</div>
</div>
<script type="text/javascript">
function select_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById("c_"+i).checked = true;
	}
}

function deselect_all_cats() {
	for(i=0;i<<TVAR>i_max</TVAR>;i++) {
		document.getElementById("c_"+i).checked = false;
	}
}
</script>