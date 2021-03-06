<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><SYS>title</SYS> - Админ панель</title>

    <!-- Bootstrap core CSS -->
    <link href="/templates/default/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/templates/default/admin/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="admin.php?admin_login=1" method="post">
        <h2 class="form-signin-heading">Авторизация</h2>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="email" id="inputEmail" class="form-control" name="login" placeholder="Логин" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Запомнить пароль
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      </form>
    </div> <!-- /container -->
		<div class="footer">
			<p><a href="http://chronodev.ru" target="_blank">Made in chronodev</a></p>
			<p>Powered by Monster Teaser Engine</p>
		</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
