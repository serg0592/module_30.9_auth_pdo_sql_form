<?php
class Controller_Gallery extends Controller { 
    function action_index() { 
        $this->view->generate('gallery_view.php', 'template_view.php'); 
    } 
}
?>