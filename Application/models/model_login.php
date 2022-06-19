<?php
    class Model_Login extends Model {
        public function userAuth() {
            // Страница авторизации 
            // Функция для генерации случайной строки
            function generateCode($length=6) {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
                $code = "";
                $clen = strlen($chars) - 1;
                while (strlen($code) < $length) {
                        $code .= $chars[mt_rand(0,$clen)];
                }
                return $code;
            } 
            // Соединяемся с БД
            $link=mysqli_connect("localhost", "root", "", "30.9_practice");

            if(isset($_POST['submitLogin'])) {
                // Вытаскиваем из БД запись, у которой логин равняется введенному
                $query = mysqli_query($link,"SELECT user_id, user_pas FROM users WHERE user_log='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
                $data = mysqli_fetch_assoc($query); 
                // Сравниваем пароли

                if($data['user_pas'] === md5(md5($_POST['password']))) {
                    // Генерируем случайное число и шифруем его
                    $hash = md5(generateCode(10));
                    // Записываем в БД новый хеш авторизации
                    mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'"); 
                    // Ставим куки
                    setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
                    setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!! 
                    // Переадресовываем браузер на страницу проверки нашего скрипта
                    header("Location: model_check.php"); exit();
                } else {
                    print "Вы ввели неправильный логин/пароль";
                }
            }
        }
    }
?>