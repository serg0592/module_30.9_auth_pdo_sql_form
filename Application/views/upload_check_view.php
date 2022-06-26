<?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error;
        }
    }
    
    if (!empty($_FILES) && empty($errors)) {
        echo "Файлы успешно загружены";
    }
?><br>
<a href="?url=gallery_auth">OK</a>