<?php
    if ($data) {
        echo "<h1>Галерея</h1><br>";
        //заполнить grid изображениями
        for ($i = 3; $i <= count($data); $i++) {
            echo "<div class='container'><br>
                        <img class='image' src='../img/uploads/". $data[$i - 1] ."' alt='что-то пошло не так'>
                    </div>";
        }
    } else {
        echo "<h1>Галерея пока пуста...</h1>";
    }
?>