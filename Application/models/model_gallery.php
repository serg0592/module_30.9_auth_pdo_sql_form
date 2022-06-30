<?php
    class Model_Gallery extends Model {
        private $imgArr = [];

        public function checkFiles() {
            //сканируем директорию для изображений
            $imgArr = scandir('../img/uploads');
            //проверка массива на наличие эл-ов помимо '.' и '..'
            if (count($imgArr) > 2) {
                //цикл записи эл-ов массива в $this начиная со второго (ибо 0=>'.' , 1=>'..')
                for ($i = 2; $i < count($imgArr); $i++) {
                    //эл-ты в $this начнутся с 0
                    $this->imgArr[$i - 2]['id'] = $i - 2;
                    $this->imgArr[$i - 2]['file'] = $imgArr[$i];
                }
            }
            
            //проверка директории для комментариев на наличие эл-ов помимо '.' и '..'
            if (count(scandir('../Application/data/comments')) > 2) {
                //цикл записи эл-ов массива в $this начиная со второго (ибо 0=>'.' , 1=>'..')
                for ($i = 2; $i < count(scandir('../Application/data/comments')); $i++) {
                    //открываем файл для чтения комментария
                    $file = fopen('../Application/data/comments/comment' . $i - 2, 'r');
                    //построчно читаем файл
                    $fileText = file('../Application/data/comments/comment' . $i - 2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($fileText as $line) {
                        $result[] = json_decode($line, true);
                    }
                    $comment = [
                        'pic_id' => $result[0],
                        'login' => $result[1],
                        'text' => $result[2],
                        'date' => $result[3],
                    ];
                    //запишем массив комментария в $this, начинающийся с 0
                    $j = $i - 2;
                    $this->commentArr[$j] = $comment;
                }                
            }
        }

        //функция-геттер изображений
        public function getImg() {
            return $this->imgArr;
        }

        //функция-геттер комментариев
        public function getComments() {
            return $this->commentArr;
        }

        public function deleteComment() {
            $deleteComment = [$_POST['text'], $_POST['date']];
            for ($i = 2; $i < count(scandir('../Application/data/comments')); $i++) {

            }
        }
    }
?>