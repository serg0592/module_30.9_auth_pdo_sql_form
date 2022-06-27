<h1>Авторизация</h1>
<form method="POST" action="">
    Логин <input name="login" type="text" required><br>
    Пароль <input name="password" type="password" required><br>
    <input name="submitLogin" type="submit" value="login">
</form>
<p>
    <a href="?url=regPage">Регистрация</a>
</p>
<h1>Вход без авторизации</h1>
<form method="GET" action="">
    <input name="url" type="submit" value="gallery">
</form>