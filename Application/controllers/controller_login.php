<?php
class Controller_Login extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Login();
    }

    function action_index() { 
        $this->model->userAuth();
    }

    function action_error() { 
        $this->view->generate('error_view.php', 'template_view');
    }

    function action_set_cookie() { 
        $this->view->generate('set_cookie_view.php', 'template_view');
    }
}
?>