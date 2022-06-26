<?php
    class Model_Gallery extends Model {
        function chechFiles() {
            var_dump(count(scandir('../img/uploads')));
            
            if (count(scandir('../img/uploads')) != 2) {
                //заполнить grid изображениями
            }
        }
    }
?>