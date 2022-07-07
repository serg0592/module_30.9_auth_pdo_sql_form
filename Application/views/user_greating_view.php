<?php
    //приветствие авторизованного пользователя
    session_start();
    $greating = $_SESSION['message'];
    echo    "<div class='great_text'>".$greating."</div>
            <a class='logout_link' href='?url=logout'>Logout</a>";
?>