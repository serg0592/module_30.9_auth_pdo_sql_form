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
            
                if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
            //or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
                {
                    setcookie("id", $userdata['user_id'], time() - 3600*24*30*12, "/", "localhost", false, true);
                    setcookie("hash", $userdata['user_hash'], time() - 3600*24*30*12, "/", "localhost", false, true);
                    session_destroy();
                    header('Location: ?url=error');
                    exit();
                }
                else
                {
                    $_SESSION['message'] = "Привет, ".$userdata['user_log']."!";
                    header("Location: ?url=gallery_auth");
                    exit();
                };
            }
            else
            {
                header('Location: ?url=cookie');
            };
        }
    }
?>