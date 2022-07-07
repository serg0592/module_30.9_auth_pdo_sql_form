<?php
class Controller_Comment extends Controller { 
    function __construct() {
        $this->model = new Model_Comment();
        $this->view = new View();
    }

    //сохранить комментарий
    function action_comment() {
        $this->model->saveComment();
    }
}
?>