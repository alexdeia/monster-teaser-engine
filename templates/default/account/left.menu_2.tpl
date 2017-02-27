<li class="nav-item"><a class="nav-link" href="/index.php?handler=user&show=settings">Мои настройки</a></li>
<li class="nav-item"><a class="nav-link" href="/index.php?handler=informer&show=my_list">Мои тизеры</a></li>
<li class="nav-item"><a class="nav-link" href="/index.php?handler=company&show=my_list">Рекламные кампании</a></li>
<li class="nav-item"><a class="nav-link" href="/index.php?handler=user&show=funds">Бухгалтерия</a></li>
<li class="nav-item"><a class="nav-link" href="/index.php?handler=user&show=referrals">Рефералы</a></li>
<div class="dropdown">
	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Привет, <CFUNC>user::getVariable{name}</CFUNC></button>
	<ul class="dropdown-menu">
		<li><a class="dropdown-item" href="/index.php?handler=user&show=settings">Настройки</a></li>
		<li><a class="dropdown-item disabled" href="#">Поддержка</a></li>
		<li class="dropdown-divider"></li>
		<li><a class="dropdown-item" href="/index.php?handler=user&action=logout">Выход</a></li>
	</ul>
</div>