<?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo    "<div class='upload_check'><br>
                        " . $error . "<br>
                        <a href='?url=gallery_auth'>Назад</a><br>
                    </div><br>";
        }
    }
    
    if (!empty($_FILES) && empty($errors)) {
        echo    "<div class='upload_check'><br>
                    Файлы успешно загружены<br>
                    <a href='?url=gallery_auth'>OK</a><br>
                </div><br>";
    }
?>
