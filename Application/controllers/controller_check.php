<?php
class Controller_Check extends Controller { 
    function __construct() {
        $this->model = new Model_Check();
        $this->view = new View();        
    }

    //проверка пользователя
    function action_index() {
        $this->model->checkUser();
        $this->view->generate('check_view.php', 'template_view.php');
    }
}
?>