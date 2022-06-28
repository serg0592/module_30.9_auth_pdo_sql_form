<?php
    class Model_Comment extends Model {
        function saveComment() {
            $_SESSION['comment'] = $_POST['text'];

            if(strlen($_SESSION['comment']) < 1 or strlen($_SESSION['comment']) > 500) {
                echo "Комментарий не может быть пустым и быть длиннее 500 символов<br>
                        <a href='?url=gallery_auth'>Назад</a><br>";
            } else {
                $commentCount = (count(scandir('../Application/data/comments'))) - 1;
                $file = fopen('../Application/data/comments/comment' . $commentCount, 'w+');
                fwrite($file, $_SESSION['login'] . "\n");
                fwrite($file, $_SESSION['comment']);
                fclose($file);
                header('Location: ?url=gallery_auth');
            }
        }
    }
?>