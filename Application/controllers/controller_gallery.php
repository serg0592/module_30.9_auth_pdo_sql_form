<?php
class Controller_Gallery extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Gallery();
    }

    function action_index() {
        $this->model->checkFiles(); 
        $this->view->generate('gallery_view.php', 'template_view.php', $this->model->getImg(), $this->model->getComments());
    }
    
    function action_index_auth() {
        $this->model->checkFiles();
        $this->view->generateAuth('gallery_view.php', 'template_view.php', 'upload_form_view.php', 
                                    'user_greating_view.php', 
                                    $this->model->getImg(), $this->model->getComments());
    }

    function action_delete_comment() {
        $this->model->deleteComment();
    }
}
?>