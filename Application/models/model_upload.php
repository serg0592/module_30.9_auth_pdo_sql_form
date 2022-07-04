<?php
    class Model_Upload extends Model {
        function uploadPic() {
            session_start();

            define('URL', '/'); // URL текущей страницы
            define('UPLOAD_MAX_SIZE', 1048576); // 1mb
            define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
            define('UPLOAD_DIR', '../img/uploads');
            
            $errors = [];
            
            if (!empty($_FILES)) {
            
                for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {
            
                    $fileName = $_FILES['userfile']['name'][$i];
            
                    if ($_FILES['userfile']['size'][$i] > UPLOAD_MAX_SIZE) {
                        $errors[] = 'Недопустимый размер файла ' . $fileName;
                        continue;
                    }
            
                    if (!in_array($_FILES['userfile']['type'][$i], ALLOWED_TYPES)) {
                        $errors[] = 'Недопустимый формат файла ' . $fileName;
                        continue;
                    }
            
                    $filePath = UPLOAD_DIR . '/' . basename($fileName);
            
                    if (!move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $filePath)) {
                        $errors[] = 'Ошибка загрузки файла ' . $fileName;
                        continue;
                    }

                    $id_file = fopen('../img/uploads/conf/id_conf', "w+");
                    $id = fread($id_file, 1024);
                    if((int)$id == null) {
                        $id = 0;
                    } else {
                        $id = (int)$id + 1;
                    };
                    fwrite($id_file, $id);
                    fclose($id_file);

                    //отрезаем из имени файла .jpg, .png, .gif
                    $config_file_path = substr(basename($fileName), 0, strlen(basename($fileName)) - 4);
                    //задаем имя конф. файлу изображения
                    $config_file = fopen('../img/uploads/conf/'.$config_file_path.'_conf', 'w+');
                    fwrite($config_file, json_encode($_SESSION['login']).PHP_EOL); //записываем автора
                    fwrite($config_file, json_encode($id).PHP_EOL); //записываем id
                    fclose($config_file);
                }
            }
        }
    }
 
?>