<?php
    class Model_LogOut extends Model {
        function logoutUser() {
            // Страница разавторизации 
            // Удаляем куки
            setcookie("id", "", time() - 3600*24*30*12, "/", "localhost", false, true);
            setcookie("hash", "", time() - 3600*24*30*12, "/", "localhost", false, true); // httponly !!!
            session_destroy();
            // Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: ?url=main");
        }
    }
?>