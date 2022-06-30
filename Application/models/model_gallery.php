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
            $commentArr = scandir('../Application/data/comments');
            if (count($commentArr) > 2) {
                //цикл записи эл-ов массива в $this начиная со второго (ибо 0=>'.' , 1=>'..')
                for ($i = 2; $i < count($commentArr); $i++) {
                    //открываем файл для чтения комментария
                    $file = fopen('../Application/data/comments/' . $commentArr[$i], 'r');
                    //построчно читаем файл
                    $fileText = file('../Application/data/comments/' . $commentArr[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    //декодируем из JSON
                    foreach ($fileText as $line) {
                        $result[] = json_decode($line, true);
                    }
                    //записываем в массив
                    $comment = [
                        'pic_id' => $result[0],
                        'login' => $result[1],
                        'text' => $result[2],
                        'date' => $result[3],
                    ];
                    $result = null;
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
            //сканируем директорию файлов с комментариями
            $commentArr = scandir('../Application/data/comments');
            for ($i = 2; $i < count($commentArr); $i++) {
                //открываем файл
                $file = fopen('../Application/data/comments/' . $commentArr[$i], 'r');
                //построчно читаем файл
                $fileText = file('../Application/data/comments/' . $commentArr[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                //декодируем из JSON
                foreach ($fileText as $line) {
                    $result[] = json_decode($line, true);
                };
                //записываем в массив
                $comment = [
                    'pic_id' => $result[0],
                    'login' => $result[1],
                    'text' => $result[2],
                    'date' => $result[3],
                ];
                $result = null;
                //по тексту и дате запоминаем файл для удаления
                if($_POST['text'] === $comment['text'] && $_POST['date'] === $comment['date']) {
                    $deleteFiles[] = $commentArr[$i];
                };
            }

            //цикл для удаления файлов
            for ($j = 0; $j < count($deleteFiles); $j++) {
                unlink('../Application/data/comments/' . $deleteFiles[$j]);
            }
            header('Location: ?url=gallery_auth');
        }
    }
?>