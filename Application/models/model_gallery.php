<?php
    class Model_Gallery extends Model {
        function chechFiles() {
            $imgArr = scandir('../img/uploads');
            return $imgArr;
        }
    }
?>