<?php
    session_start();
    $greating = $_SESSION['message'];
    echo $greating;
?>