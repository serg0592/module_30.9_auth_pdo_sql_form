<?php
    class Model_Gallery extends Model {
        private $imgArr = [];

        public function checkFiles() {
            //сканируем директорию для изображений
            $imgArr = scandir('../img/uploads');
            //проверка массива на наличие эл-ов помимо '.' и '..'
            if (count($imgArr) > 3) {
                //цикл записи эл-ов массива в $this начиная со третьего (исключаем '.', '..', 'conf')
                for ($i = 3; $i < count($imgArr); $i++) {
                    //эл-ты в $this начнутся с 0
                    //читаем id и автора из файла
                    $filePicConf = file('../img/uploads/conf/'.substr($imgArr[$i], 0, strlen($imgArr[$i]) - 4).'_conf', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach($filePicConf as $line) {
                        $result[] = json_decode($line, true);
                    }
                    $this->imgArr[$i - 3]['id'] = $result[1];
                    $this->imgArr[$i - 3]['auth'] = $result[0];
                    $this->imgArr[$i - 3]['file'] = $imgArr[$i];
                    $result = null;
                };
            };
            
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
                    };
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
                };                
            };
        }

        //функция-геттер изображений
        public function getImg() {
            if(isset($this->imgArr)) {
                return $this->imgArr;
            };
        }

        //функция-геттер комментариев
        public function getComments() {
            if(isset($this->commentArr)) {
                return $this->commentArr;
            };
        }

        //функция для удаления комментариев сканирует директорию с файлами комментариев, выбирает подходящие по переданным
        //из формы дате и тексту и удаляет их
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
            };

            //цикл для удаления файлов
            for ($j = 0; $j < count($deleteFiles); $j++) {
                unlink('../Application/data/comments/' . $deleteFiles[$j]);
            };
            header('Location: ?url=gallery_auth');
        }

        //функция для удаления изображений
        public function deletePic() {
            //сканируем директорию файлов с конфигурациями изображений
            $confArr = scandir('../img/uploads/conf');
            for ($i = 3; $i < count($confArr); $i++) {
                //открываем файл
                $confFile = fopen('../img/uploads/conf/' . $confArr[$i], 'r');
                //читаем построчно
                $fileText = file('../img/uploads/conf/' . $confArr[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                //декодируем из JSON
                foreach ($fileText as $line) {
                    $result[] = json_decode($line, true);
                };
                //записываем в массив
                $config = [
                    'pic_id' => $result[1],
                    'auth' => $result[0],
                ];
                $result = null;
                //по тексту и дате запоминаем файл для удаления
                if($_POST['id'] === $config['pic_id'] && $_POST['auth'] === $config['auth']) {
                    $deleteConf[] = $confArr[$i];
                    $deletePic[] = substr($confArr[$i], 0, strlen($confArr[$i]) - 5);
                };

                //цикл для удаления файлов
                for ($j = 0; $j < count($deleteConf); $j++) {
                    //удаляем файл конфигурации изображения
                    unlink('../img/uploads/conf/' . $deleteConf[$j]);
                };
                //сканируем директорию с изображениями
                $scanPic = scandir('../img/uploads');
                for ($j = 3; $j < count($scanPic); $j++) {
                    //подставляем формат к имени и удаляем
                    if(($deletePic[$j - 3].'.jpg') == $scanPic[$j]) {
                        unlink('../img/uploads/' . $deletePic[$j - 3].'.jpg');
                    } elseif (($deletePic[$j - 3].'.png') == $scanPic[$j]) {
                        unlink('../img/uploads/' . $deletePic[$j - 3].'.png');
                    } elseif (($deletePic[$j - 3].'.gif') == $scanPic[$j]) {
                        unlink('../img/uploads/' . $deletePic[$j - 3].'.gif');
                    };
                };
                header('Location: ?url=gallery_auth');
            }
        }
    }
?>