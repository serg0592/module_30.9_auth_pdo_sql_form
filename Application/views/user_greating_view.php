<div class="auth_shell">
    <?php
        session_start();
        $greating = $_SESSION['message'];
        echo $greating;
    ?>
</div>