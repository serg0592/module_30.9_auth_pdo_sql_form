<?php
    class Model_Check extends Model {
        function checkUser() {
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
                    setcookie("id", "", time() - 3600*24*30*12, "/");
                    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
                    print "Хм, что-то не получилось";
                }
                else
                {
                    //print "Привет, ".$userdata['user_log'].". Всё работает!";
                    header("Location: ./public/?url=gallery_auth");
                    exit();
                }
            }
            else
            {
                print "Включите куки";
            }
        }        
    }
?>