<div class="page_content">
	<h2 class="title">������ ��� ������ #<TVAR>inf_id</TVAR></h2>
    <div id="cont">
		<form action="/account/informers/<TVAR>inf_id</TVAR>/reports.html" method="post">
		<table align="center">
			<tr>
			<p>&nbsp;</p>
				<td>�������� ���� ��� ������������ ������</td>
				<td>
					<select name="year"><FUNC>get_years_opts{<REQ>year</REQ>}</FUNC></select>
					<select name="month"><FUNC>get_monthes_opts{<REQ>month</REQ>}</FUNC></select>
					<select name="day"><FUNC>get_days_opts{<REQ>day</REQ>}</FUNC></select>

				</td>
			</tr>
			<tr>
				<td>���������� ������� ������</td>
				<td>
					<select name="type">
						<option value="all">����� � ������</option>
						<option value="show">������ ������</option>
						<option value="click">������ �����</option>
					</select>
				</td>
			</tr>
		</table>
		<p align="right"><input type="submit" value="����������� �����" class="button"></p>
		<table width="100%" cellspadding="2" cellspacing="1" bgcolor="#D7D7D7">
			<tr>
				<th>�����</th>
				<th>�����/����������</th>
				<th>����/����������</th>
				<th>IP �����</th>
				<th>�������</th>
			</tr>
