<?php
    class Model_Comment extends Model {
        function saveComment() {
            session_start();
            //передаем текст комментария и id изображения
            $_SESSION['comment'] = $_POST['text'];
            $_SESSION['comment_pic'] = $_POST['comment_pic'];

            //проверяем длину комментария
            if(strlen($_SESSION['comment']) < 1 or strlen($_SESSION['comment']) > 500) {
                echo "Комментарий не может быть пустым и быть длиннее 500 символов<br>
                        <a href='?url=gallery_auth'>Назад</a><br>";
            } else {
                //сканируем директорию с файлами комментариев
                $commentCount = (count(scandir('../Application/data/comments'))) - 2;        
                //сохраняем текущую дату        
                $date = date("F j, Y, G:i");
                //заполняем временный массив
                $tmpArr = [
                    $_SESSION['comment_pic'], 
                    $_SESSION['login'],
                    $_SESSION['comment'], 
                    $date
                ];
                //создаем файл для комментария с именем "comment+порядковый номер"
                $file = fopen('../Application/data/comments/comment' . $commentCount, 'w+');
                //заполняем файл из временного массива
                foreach ($tmpArr as $tmp) {
                    $string = json_encode($tmp).PHP_EOL;
                    fwrite($file, $string);
                }
                fclose($file);
                //переходим в галерею
                header('Location: ?url=gallery_auth');
            }
        }
    }
?>