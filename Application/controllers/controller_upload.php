<?php
class Controller_Upload extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Upload();
    }

    function action_upload() {
        $this->model->uploadPic(); 
        $this->view->generate('upload_check_view.php', 'template_view.php');
    }
}
?>