<?php
    class Model_Upload extends Model {
        function uploadPic() {
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
                }
            }
        }
    }
 
?>