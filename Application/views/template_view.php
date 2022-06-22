<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="../Css/style.css">       
        <title>30.9_Practice</title>
    </head>
    <body>
        <header>
            
        </header>
        <main>
            <?php
                if (isset($authUserData_view)) {
                    include $authUserData_view;
                }
                //подгружаем содержимое страницы
                include $content_view;
                //опционально подгружаем интерфейс загрузки изображений
                if (isset($interface_1_view)) {
                    include $interface_1_view;
                }
                //опционально подгружаем интерфейс редактирования комментариев
                if (isset($interface_2_view)) {
                    include $interface_2_view;
                }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>