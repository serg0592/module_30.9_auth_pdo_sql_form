<h1>Авторизация</h1>
<form method="POST">
    Логин <input name="login" type="text" required><br>
    Пароль <input name="password" type="password" required><br>
    <input name="submit" type="submit" value="Войти">
</form>
<form method="POST" action="../views/registration_view.php">
    <input name="submit" type="submit" value="Регистрация">
</form>