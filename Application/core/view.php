<?php
class View
{
	function generate($content_view, $template_view, $data = null)
	{
		include '../Application/views/'.$template_view;	
	}

	function generateAuth($content_view, $template_view, $comments_view, $adds_view) {
		include '../Application/views/'.$template_view;
		include '../Application/views/'.$adds_view;
		include '../Application/views/'.$comments_view;
	}
}
?>