<div class="page_content">
	<h2 class="title">�������� ���������� ��������� ��������</h2>
    <div id="cont">
		<form action="/admin.php?action=save_com_tar&show=companies&id=<TVAR>com_id</TVAR>" method="post">
		<h4>��������� �� ��������� �������</h4>
					<table border="0" width="80%">
						<tr>
							<th width="20"></th>
							<th width="200">���������</th>
							<th width="150">���� �������</th>
							<th width="150">���� ������</th>
						<TVAR>tar_cat</TVAR>
					</table>
        <h4>��������� �� ���� ������(<a href="javascript:;" onClick="select_all_days();">������� ���</a> | <a href="javascript:;" onClick="deselect_all_days();">������ ���</a>)</h4>
		<TVAR>tar_day</TVAR>
		<h4>��������� �� ������� �����(<a href="javascript:;" onClick="select_all_hours();">������� ���</a> | <a href="javascript:;" onClick="deselect_all_hours();">������ ���</a>)</h4>
		<table border="0">
	        <TVAR>tar_time</TVAR>
		</table>
		<h4>��������� ������������ �����������?</h4>
		<table border="0">
	        <TVAR>tar_uniq</TVAR>
		</table>
		<div style="text-align: right; margin-top: 10px; padding-bottom: 30px;">
			<input type="submit" value="��������� ���������" class="button">
		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
function select_all_days() {	for(i=1;i<8;i++) {		document.getElementById("td_"+i).checked = true;
	}
}

function deselect_all_days() {
	for(i=1;i<8;i++) {
		document.getElementById("td_"+i).checked = false;
	}
}

function select_all_hours() {
	for(i=0;i<24;i++) {
		document.getElementById("tt_"+i).checked = true;
	}
}

function deselect_all_hours() {
	for(i=0;i<24;i++) {
		document.getElementById("tt_"+i).checked = false;
	}
}
</script>