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
                    <li class="nav_item"><a class="nav_link main_link" href="?url=main">На главную</a></li>
                    <li class="nav_item"><a class="nav_link" href="?url=gallery">В галерею</a></li>
                </ul>
                <div class='auth_shell'>
                    <?php
                        //выбираем содержимое нав. бара
                        if (isset($authUserData_view)) {
                            //если есть авторизованный пользователь, подгружаем приветствие
                            include $authUserData_view;
                        } elseif ($content_view == 'main_view.php') {
                            //если контент - главная страница, то размещаем здесь
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
                if ($content_view !== 'main_view.php') {
                    include $content_view;
                }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>