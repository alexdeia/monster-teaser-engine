<div class="page_content">
	<h2 class="title">Список категорий</h2>
    <div id="cont">
		<form action="/admin.php?show=cats&action=add_cat" method="post">
		<b>Название</b> <input type="text" name="name">
		<b>Показ</b> <input type="text" name="price_show" size="7">
		<b>Уникальный показ</b> <input type="text" name="price_show_uniq" size="7">
		<b>Клик</b> <input type="text" name="price_click" size="7">
		<b>Уникальнй клик</b> <input type="text" name="price_click_uniq" size="7">
		<input type="submit" value="Добавить категорию" class="button">
		</form>
		<br/>
		<table width="100%" bgcolor="#aaaaaa" cellspacing="1">
			<tr>
				<th>ID</th>
				<th>Название</th>
				<th>Показ</th>
				<th>Уникальный показ</th>
				<th>Клик</th>
				<th>Уникальнй клик</th>
				<th>Действия</th>
			</tr>

