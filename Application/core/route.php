<?php
class Route
{
	public static function start()
	{
		//действия по умолчанию
		$controller_name = 'main';
		$action_name = 'index';

        //проверка наличия имя контроллера в GET
        //$_GET['url'] = 'login';
		if (isset($_GET['url'])) {
            $controller_name = $_GET['url'];
		}

		//$_POST['login'] = 'login';
		if (isset($_POST['login'])) {
			echo 'login<br>';
		}
		
		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		echo "Model: $model_name <br>";
		echo "Controler: $controller_name <br>";
		echo "Action: $action_name <br>";
		
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "../models/".$model_file;
		if(file_exists($model_path))
		{
			include "../models/".$model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php'; //в нижний регистр
		$controller_path = "../controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "../controllers/".$controller_file;
		}
		else
		{
			
			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
		    Route::ErrorPage404();
		}
	}

	public static function ErrorPage404() {
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 not found');
		header('Location'.$host.'404');
	}
}
?>