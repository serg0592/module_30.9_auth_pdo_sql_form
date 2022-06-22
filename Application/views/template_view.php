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
                //подгружаем содержимое страницы
                include $content_view;
                //опционально подгружаем интерфейс загрузки изображений
                if (isset($adds_view)) {
                    include $adds_view;
                }
                //опционально подгружаем интерфейс редактирования комментариев
                if (isset($comments_view)) {
                    include $comments_view;
                }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>