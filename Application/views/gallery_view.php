<?php
    //$_SESSION['login'] = 'serg';
    //формирование оболочки для галлереи
    echo    "<div class='gallery_shell'>
                <div class='gallery_header'>
                    <h4 class='img_placer'>Галерея
                    <h4 class='comment_placer'>Комментарии
                </div>";
    //проверка наличия изображений
    if ($dataPic) {
        //вывод изображений
        for ($i = 0; $i < count($dataPic); $i++) {
            echo    "<div class='gallery_item_placer'>
                        <div class='img_placer'>Автор: " . $dataPic[$i]['auth'];
            if (isset($_SESSION['login']) && $dataPic[$i]['auth'] === $_SESSION['login']) {
                echo        "<form method='post' class='delete_pic_btn_placer'>
                                <input type='hidden' name='id' value='" . $dataPic[$i]['id'] . "'>
                                <input type='hidden' name='auth' value='" . $dataPic[$i]['auth'] . "'>
                                <input type='submit' name='delete_pic' value='Удалить' class='delete_pic_btn'>
                            </form>";
                        
            } else {
                echo "<br>";
            }; 
            echo            "<img class='image' src='../img/uploads/". $dataPic[$i]['file'] ."' alt='что-то пошло не так'><br>
                        </div>
                        <div class='comment_placer'>
                        <div class='comment_content'>"; //оставим тэг не закрытым для переборки и печати комментариев
            //проверка и печать комментариев к изображению
            if ($dataComment) {
                for ($j = 0; $j < count($dataComment); $j++) {
                    if ($dataComment[$j]['pic_id'] === $dataPic[$i]['id']) {
                        echo    "<div class='comment'>
                                    <div class='user'>" . $dataComment[$j]['login'] . "</div>
                                    <div class='date'>" . $dataComment[$j]['date'] . "</div><br>
                                    <div class='comment_text'>" . $dataComment[$j]['text'] . "</div>                                    
                                </div>";
                        if (isset($_SESSION['login']) && $dataComment[$j]['login'] === $_SESSION['login']) {
                            echo    "<form method='post' class='delete_comment_btn_placer'>
                                        <input type='hidden' name='text' value='" . $dataComment[$j]['text'] . "'>
                                        <input type='hidden' name='date' value='" . $dataComment[$j]['date'] . "'>
                                        <input type='submit' name='delete_comment' value='X' class='delete_comment_btn'>
                                    </form>";
                        };
                    };                    
                };
            } else {
                echo    "<h4>Комментариев пока нет...</h4>";
            };

            echo "</div>"; //закрываем тэг с классом comment_content
            
            //подключаем форму для отправки комментариев
            include 'comment_form_view.php';

            echo "</div>"; //закрываем тэг с классом comment_placer
            echo "</div>"; //закрываем тэг с классом gallery_item_placer
        }
    } else {
        echo    "<h4>Галерея пока пуста...</h4>";
        echo "</div>"; //закрываем тэг с классом gallery_shell
    };
?>