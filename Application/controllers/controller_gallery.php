<?php
class Controller_Gallery extends Controller {
    function __construct() {
        $this->view = new View();
        $this->model = new Model_Gallery();
    }

    //проверить файлы изображений и комментариев для галереи без авторизации
    function action_index() {
        $this->model->checkFiles(); 
        $this->view->generate('gallery_view.php', 'template_view.php', $this->model->getImg(), $this->model->getComments());
    }
    
    //проверить файлы изображений для галереи с авторизацией
    function action_index_auth() {
        $this->model->checkFiles();
        $this->view->generateAuth('gallery_view.php', 'template_view.php', 'upload_form_view.php', 
                                    'user_greating_view.php', 
                                    $this->model->getImg(), $this->model->getComments());
    }

    //метод удаления комментариев
    function action_delete_comment() {
        $this->model->deleteComment($_POST['text'], $_POST['date']);
    }

    //метод удаления изображений
    function action_delete_pic() {
        $this->model->deletePic();
        $this->model->deleteComment(null, null, $_POST['id']);
    }
}
?>