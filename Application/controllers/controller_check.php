<?php
class Controller_Check extends Controller { 
    function __construct() {
        $this->model = new Model_Check();
        $this->view = new View();        
    }

    function action_index() {
        $this->model->checkUser();
        $this->controllerMessage = $this->model->modelMessage;
        $this->view->generate('check_view.php', 'template_view.php');
    }
}
?>