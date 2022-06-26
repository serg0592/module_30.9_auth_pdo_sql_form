<?php
class Controller_Gallery extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Gallery();
    }

    function action_index() {
        $this->model->chechFiles(); 
        $this->view->generate('gallery_view.php', 'template_view.php');
    }
    
    function action_index_auth() {
        $this->model->chechFiles();
        $this->view->generateAuth('gallery_view.php', 'template_view.php', 'upload_form_view.php', 'comment_form_view.php', 'user_greating_view.php');
    }
}
?>