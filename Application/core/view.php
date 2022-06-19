<?php
class View
{
	function generate($content_view, $template_view, $data = null)
	{
		include '../Application/views/'.$template_view;	
	}
}
?>