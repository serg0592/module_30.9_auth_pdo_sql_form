<?php
    class Model_LogOut extends Model {
        function logoutUser() {
            // скрипт разавторизации 
            // Удаляем куки
            setcookie("id", "", time() - 3600*24*30*12, "/", "localhost", false, true);
            setcookie("hash", "", time() - 3600*24*30*12, "/", "localhost", false, true); // httponly !!!
            session_destroy();
            // переход на главную страницу
            header("Location: ?url=main");
        }
    }
?>