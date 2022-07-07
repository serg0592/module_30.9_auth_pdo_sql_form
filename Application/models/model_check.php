<?php
    class Model_Check extends Model {
        function checkUser() {
            session_start();
            // Скрипт проверки 
            // Соединяемся с БД
            $link=mysqli_connect("localhost", "root", "", "30.9_practice");
            
            if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
            {
                $query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
                $userdata = mysqli_fetch_assoc($query);
            
                //сверяем хэш и id в куки и базе
                if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
                {
                    //удаляем куки с id пользователя
                    setcookie("id", $userdata['user_id'], time() - 3600*24*30*12, "/", "localhost", false, true);
                    //хэш пользователя
                    setcookie("hash", $userdata['user_hash'], time() - 3600*24*30*12, "/", "localhost", false, true);
                    session_destroy();
                    //переходим на страницу с ошибкой
                    header('Location: ?url=error');
                    exit();
                }
                else
                {
                    //передаем приветствие
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!";
                    //переходим в галерею
                    header("Location: ?url=gallery_auth");
                    exit();
                };
            }
            else
            {
                //переходим на страницу с сообщением про куки
                header('Location: ?url=cookie');
            };
        }
    }
?>