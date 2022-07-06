<?php
    session_start();
    $greating = $_SESSION['message'];
    echo    $greating."<br>
            <a href='?url=logout'>Logout</a>";
?>