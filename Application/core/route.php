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
            //$controller_name = $_GET['url'];
			
			if ($_GET['url'] == 'regPage') {
				$controller_name = 'registration';
				$action_name = 'open_reg';
			} else {
				if ($_GET['url'] == 'regSuccessPage') {
					$controller_name = 'registration';
					$action_name = 'open_reg';
				}
			}
		}

		//$_POST['submitLogin'] = 'login';
		//$_POST['login'] = 'serg';
		//$_POST['password'] = 'serg123';
		if (isset($_POST['submitLogin'])) {
			$controller_name = $_POST['submitLogin'];
		}

		/*$_GET['registration'] = 'registration';
		if (isset($_GET['regPage'])) {
			$controller_name = 'registration';
			$action_name = 'open_reg';
		}*/

		//$_POST['registration'] = 'registration';
		//$_POST['login'] = 'asd';
		//$_POST['password'] = '123';
		if (isset($_POST['registration'])) {
			$controller_name = $_POST['registration'];
			$action_name = 'index';
		}
		
		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		//выводим информацию для себя
		echo "Model: $model_name <br>";
		echo "Controler: $controller_name <br>";
		echo "Action: $action_name <br>";
		
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "../Application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "../Application/models/".$model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php'; //в нижний регистр
		$controller_path = "../Application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "../Application/controllers/".$controller_file;
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