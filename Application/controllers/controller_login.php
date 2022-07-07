<?php
class Controller_Login extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Login();
    }

    //метод авторизации пользователя
    function action_index() { 
        $this->model->userAuth();
    }

    //метод генерации страницы с ошибкой при проверке пользователя
    function action_error() { 
        $this->view->generate('error_view.php', 'template_view');
    }

    //метод генерации страницы с ошибкой cookie при проверке пользователя
    function action_set_cookie() { 
        $this->view->generate('set_cookie_view.php', 'template_view');
    }
}
?>