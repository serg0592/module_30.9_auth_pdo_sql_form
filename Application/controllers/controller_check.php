<?php
class Controller_Check extends Controller { 
    function __construct() {
        $this->model = new Model_Check();        
    }

    function action_index() { 
        $this->model->checkUser();
    }
}
?>