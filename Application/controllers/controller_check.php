<?php
class Controller_Check extends Controller { 
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Check();        
    }

    function action_index() {
        $this->view->generate('check_view.php', 'template_view.php');
        $this->model->checkUser();
    }
}
?>