<?php
    class Model_Comment extends Model {
        function saveComment() {
            session_start();
            $_SESSION['comment'] = $_POST['text'];
            $_SESSION['comment_pic'] = $_POST['comment_pic'];

            if(strlen($_SESSION['comment']) < 1 or strlen($_SESSION['comment']) > 500) {
                echo "Комментарий не может быть пустым и быть длиннее 500 символов<br>
                        <a href='?url=gallery_auth'>Назад</a><br>";
            } else {
                $commentCount = (count(scandir('../Application/data/comments'))) - 2;                
                $date = date("F j, Y, G:i");
                $tmpArr = [$_SESSION['comment_pic'], $_SESSION['login'], $_SESSION['comment'], $date];
                $file = fopen('../Application/data/comments/comment' . $commentCount, 'w+');
                foreach ($tmpArr as $tmp) {
                    $string = json_encode($tmp).PHP_EOL;
                    fwrite($file, $string);
                }
                /*fwrite($file, $_SESSION['comment_pic']);
                fwrite($file, $_SESSION['login']);
                fwrite($file, $_SESSION['comment']);
                fwrite($file, $date);*/
                fclose($file);
                header('Location: ?url=gallery_auth');
            }
        }
    }
?>