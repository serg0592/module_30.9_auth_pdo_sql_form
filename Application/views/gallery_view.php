<?php
    if ($dataPic) {
        echo "<h1>Галерея</h1><br>";
        //заполнить grid изображениями
        for ($i = 3; $i <= count($dataPic); $i++) {
            echo "<div class='container'><br>
                        <img class='image' src='../img/uploads/". $dataPic[$i - 1] ."' alt='что-то пошло не так'>
                    </div>";
        }
    } else {
        echo "<h1>Галерея пока пуста...</h1>";
    }

    if ($dataComment) {
        echo "<h1>Комментарии</h1><br>";
        for ($i = 1; $i <= count($dataComment); $i++) {
            echo "<div class='comment_container'>
                        <p class='user'>" . $dataComment[$i]['login'] . "</p>
                        <p class='comment'>" . $dataComment[$i]['text'] . "</p>
                    </div>";
        }
    } else {
        echo "<h1>Комментариев пока нет...</h1>";
    }
?>