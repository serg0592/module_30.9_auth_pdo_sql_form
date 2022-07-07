<?php
    class Model_Upload extends Model {
        function uploadPic() {
            session_start();
            
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

                    //ищем файл-счетчик id изображений
                    $scanImgConf = scandir('../img/uploads/conf');
                    //если есть, то открываем
                    if(file_exists('../img/uploads/conf/id_conf')) {
                        $id_file = fopen('../img/uploads/conf/id_conf', 'r+');
                        //читаем построчно
                        $id = file('../img/uploads/conf/id_conf');
                        //если строка не пустая, то +1; если пустая, то 0
                        if(isset($id[0])) {
                            $id[0] = ''. (int)$id[0] + 1;
                        } else {
                            
                            $id[0] = '0';
                        };
                        //закрываем файл				
                        fclose($id_file);
                        //перезаписываем файл
                        file_put_contents('../img/uploads/conf/id_conf', $id[0]);
                    } else {
                        //если файла нет, то создаем и пишем внутрь 0
                        $id[0] = '0';
                        file_put_contents('../img/uploads/conf/id_conf', $id[0]);
                    };

                    //отрезаем из имени файла .jpg, .png, .gif
                    $config_file_path = substr(basename($fileName), 0, strlen(basename($fileName)) - 4);
                    //задаем имя конф. файлу изображения
                    $config_file = fopen('../img/uploads/conf/'.$config_file_path.'_conf', 'w+');
                    fwrite($config_file, json_encode($_SESSION['login']).PHP_EOL); //записываем автора
                    fwrite($config_file, json_encode($id[0]).PHP_EOL); //записываем id
                    fclose($config_file);
                }
            }
        }
    }
 
?>