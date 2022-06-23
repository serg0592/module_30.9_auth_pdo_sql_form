<?php
class Controller_Gallery extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Gallery();
    }

    function action_index() { 
        $this->view->generate('gallery_view.php', 'template_view.php');
    }
    
    function action_index_auth() {
        $this->view->generateAuth('gallery_view.php', 'template_view.php', 'download_pic_view.php', 'comment_form_view.php', 'user_greating_view.php');
    }
}
?>