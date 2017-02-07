<!DOCTYPE html>
<html lang="ru">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<title><SYS>title</SYS></title>
	<!-- Bootstrap CSS -->
	<link href="/templates/default/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="/templates/default/admin/css/dashboard.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#">ChronoEngine - AdminPanel</a>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">FAQ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Контакты</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#">Disabled</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
		</ul>
		<!-- login form -->
		<TVAR>left_menu</TVAR>
	</div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="container-fluid">
	<div class="row">
		<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<a class="nav-link active" href="#">Главная <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=settings">Настройки</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=cats">Категории</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=users">Пользователи</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=news">Новости</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=massmail">Рассылка</a>
				</li>
			</ul>

			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=sites">Сайты</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=payouts">Выплаты</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=payouts_reports">Отчеты</a>
				</li>
			</ul>

			<ul class="nav nav-pills flex-column">
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=companies">Рекламные кампании</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=tizers">Тизеры</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin.php?show=payments">Пополнения</a>
				</li>
			</ul>

			<hr>

			<footer>
				<p>&copy; ChronoEngine 2017</p>
			</footer>
		</nav>

		<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
			<TVAR>notice</TVAR>
			<TVAR>content</TVAR>
		</main>
	</div>
</div> <!-- /container -->

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>