<h2 class="title">Список категорий</h2>
	<form class="form-inline" action="/admin.php?show=cats&action=add_cat" method="post">
		<div class="form-group">
			<b>Название</b> <input class="form-control" type="text" name="name">
		</div>
		<div class="form-group">
			<b>Показ</b> <input class="form-control" type="text" name="price_show" size="4">
		</div>
		<div class="form-group">
			<b>Уникальный показ</b> <input class="form-control" type="text" name="price_show_uniq" size="4">
		</div>
		<div class="form-group">
			<b>Клик</b> <input class="form-control" type="text" name="price_click" size="4">
		</div>
		<div class="form-group">
			<b>Уникальный клик</b> <input class="form-control" type="text" name="price_click_uniq" size="4">
		</div>
			<br><br><input type="submit" value="Добавить категорию" class="btn btn-outline-success">
	</form>
		<br/>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>Название</th>
				<th>Показ</th>
				<th>Уникальный показ</th>
				<th>Клик</th>
				<th>Уникальный клик</th>
				<th>Действия</th>
			</tr>