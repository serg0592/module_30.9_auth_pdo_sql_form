<?php
class Controller_Registration extends Controller { 
    function __construct() {
        $this->model = new Model_Registration();
        $this->view = new View();
        
    }

    function action_index() { 
        $this->model->userReg();
        $this->view->generate('registration_view.php', 'template_view.php');
    } 
}
?>