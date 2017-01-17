<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><SYS>title</SYS> - Админ панель</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="/templates/<SYS>template</SYS>/admin/engine.css" rel="stylesheet" type="text/css" />
<link href="/templates/<SYS>template</SYS>/admin/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
		<table width="100%" border="0">
                        <td valign='center' align='center' valign='top'>
                                <div style='width: 400px;'><div class='message'><img src='templates/redwhite/img/admin/icon_warning.png' align='middle' /> Данная страница доступна только для администраторов</div><br /></div>
                                <table width='200' style='border: 1px solid #ececec; color: gray;'>
                                       <tr>
                                                <td style='background-color: #ececec; font-size: 12px; font-family: arial; color: gray; padding: 5px'>Вход</td>
                                       </tr>
                                       <tr>
                                                <td style='padding: 5px; font-size: 12px; font-family: arial; color: gray;'>

				<form action="admin.php?admin_login=1" method="post">
				<table>
					<tr>
						<td>Логин:</td><td><input type="text" name="login"></td>
					</tr><tr>
						<td>Пароль:</td><td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td></td><td><input type="submit" class="button" value="Вход"></td>
					</tr>
				</table>
                                                        </form>
                                                </td>
                                       </tr>
                                </table>
                        </td>
                </tr>
        </table>
<!-- end page -->
<div id="footer">
	<center><p id="legal">Дизайн и разработка <a href="http://eternal-web.ru">Студия Eternal Web (Deia)</a>
	<br/>
	Все права защищены</p></center>
</div>
</body>
</html>
