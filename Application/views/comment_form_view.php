<?php
    require_once 'gallery_view.php';
    echo    "<div class='comment_form'>
                <h4>Оставьте комментарий</h4>
                <form method='post' action=''>
                    <textarea name='text'></textarea><br>
                    <input type='hidden' name='comment_pic' value='" . $dataPic[$i]['id'] . "'>
                    <input type='submit' name='comment' value='comment'>
                </form>
            </div>";
?>