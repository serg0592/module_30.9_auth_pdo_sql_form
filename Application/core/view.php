<?php
class View {
	
	function generate($content_view, $template_view, $dataPic= null, $dataComment = null)
	{
		include '../Application/views/'.$template_view;	
	}

	function generateAuth($content_view, $template_view, $interface_1_view, $interface_2_view, 
							$authUserData_view, $dataPic = null, $dataComment = null) {
		include '../Application/views/'.$template_view;
	}
}
?>