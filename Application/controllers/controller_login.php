<?php
class Controller_Login extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Login();
    }

    function action_index() { 
        $this->model->userAuth();
    }
}
?>