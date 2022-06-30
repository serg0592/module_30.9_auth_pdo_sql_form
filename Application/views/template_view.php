<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="../css/style.css">       
        <title>30.9_Practice</title>
    </head>
    <body>
        <header class="header">
            
        </header>
        <main class="main">
            <div class="navigation_shell">
                <ul class="navigation_list">
                    <li><a href="?url=main">На главную</a></li>
                    <li><a href="?url=gallery">В галерею</a></li>
                </ul>
                <div class='auth_shell'>
                    <?php
                        if (isset($authUserData_view)) {
                            include $authUserData_view;
                        } elseif ($content_view = 'main_view.php') {
                            include $content_view;
                        }
                    ?>
                </div>
            </div>
            <?php
                //опционально подгружаем интерфейс загрузки изображений
                if (isset($interface_1_view)) {
                    include $interface_1_view;
                }

                //подгружаем содержимое страницы
                if ($content_view != 'main_view.php') {
                    include $content_view;
                }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>