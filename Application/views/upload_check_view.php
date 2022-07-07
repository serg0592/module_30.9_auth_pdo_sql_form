<?php
    //выводим массив ошибок, если есть
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo    "<div class='upload_check'><br>
                        " . $error . "<br>
                        <a href='?url=gallery_auth'>Назад</a><br>
                    </div><br>";
        };
    };
    //если есть загружаемые файлы и нет ошибок
    if (!empty($_FILES) && empty($errors)) {
        echo    "<div class='upload_check'><br>
                    Файлы успешно загружены<br>
                    <a href='?url=gallery_auth'>OK</a><br>
                </div><br>";
    };
?>
