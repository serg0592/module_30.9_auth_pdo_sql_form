<?php
class Controller_Logout extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Logout();
    }

    //метод разовтаризации
    function action_logout() { 
        $this->model->logoutUser();
    }
}
?>