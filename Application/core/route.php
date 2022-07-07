<?php
class Route
{
	public static function start()
	{
		//действия по умолчанию
		$controller_name = 'main';
		$action_name = 'index';

        //проверка наличия имя контроллера в GET
		if (isset($_GET['url'])) {
			switch ($_GET['url']) {
				case 'regPage':
					$controller_name = 'registration';
					$action_name = 'open_reg';
					break;
				case 'regSuccessPage':
					$controller_name = 'registration';
					$action_name = 'reg_success';
					break;
				case 'gallery_auth':
					$controller_name = 'gallery';
					$action_name = 'index_auth';
					break;
				case 'check':
					$controller_name = $_GET['url'];
					break;
				case 'gallery':
					$controller_name = 'gallery';
					session_start();
					if(isset($_SESSION['login'])) {
						$action_name = 'index_auth';
					};
					break;
				case 'logout':
					$controller_name = 'logout';
					$action_name ='logout';
					break;
				case 'error':
					$controller_name = 'login';
					$action_name = 'error';
					break;
				case 'cookie':
					$controller_name = 'login';
					$action_name = 'set_cookie';
					break;
			};
		};

		//логин
		if (isset($_POST['submitLogin'])) {
			$controller_name = $_POST['submitLogin'];
		};

		//регистрация
		if (isset($_POST['registration'])) {
			$controller_name = $_POST['registration'];
			$action_name = 'index';
		};	

		//загрузка изображения
		if (isset($_POST['submitUpload'])) {
			$content = $_POST['submitUpload'];
			$controller_name = 'upload';
			$action_name = 'upload';
		};
		
		//отправить комментарий
		if (isset($_POST['comment'])) {
			$controller_name = 'comment';
			$action_name = 'comment';
		};

		//удалить комментарий
		if (isset($_POST['delete_comment'])) {
			$controller_name = 'gallery';
			$action_name = 'delete_comment';
		};

		//удалить изображение
		if (isset($_POST['delete_pic'])) {
			$controller_name = 'gallery';
			$action_name ='delete_pic';
		};
		
		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		
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
		};
	}

	public static function ErrorPage404() {
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 not found');
		header('Location'.$host.'404');
	}
}
?>