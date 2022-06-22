<?php
class Controller_Gallery extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Gallery();
    }

    function action_index() { 
        $this->view->generate('gallery_view.php', 'template_view.php');
        //$this->model->userAuth(); 
    }
    
    function action_index_auth() {
        $this->view->generateAuth('gallery_auth_view.php', 'template_view.php', 'comments_view.php');
    }
}
?>