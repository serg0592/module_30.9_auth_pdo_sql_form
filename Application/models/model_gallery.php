<?php
    class Model_Gallery extends Model {
        private $imgArr = [];
        private $commentArr = [];

        public function checkFiles() {
            $imgArr = scandir('../img/uploads');
            if (count($imgArr) > 2) {
                $this->imgArr = $imgArr;
            }
            
            if (count(scandir('../Application/data/comments')) > 2) {
                for ($i = 3; $i <= count(scandir('../Application/data/comments')); $i++) {
                    $file = fopen('../Application/data/comments/comment' . $i - 2, 'r');
                    $comment = [
                        'login' => fgets($file),
                        'text' => fgets($file),
                    ];
                    $j = $i - 2;
                    $commentArr[$j] = $comment;
                }
                $this->commentArr = $commentArr;
            }
        }

        public function getImg() {
            return $this->imgArr;
        }

        public function getComments() {
            return $this->commentArr;
        }
    }
?>