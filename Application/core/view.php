<?php
class View {
	
	//метод генерации страницы без авторизации
	function generate($content_view, $template_view, $dataPic= null, $dataComment = null)
	{
		include '../Application/views/'.$template_view;	
	}

	//метод генерации страци с авторизацией
	function generateAuth($content_view, $template_view, $interface_1_view, 
							$authUserData_view, $dataPic = null, $dataComment = null) {
		include '../Application/views/'.$template_view;
	}
}
?>