<?php

abstract class BaseClass extends Controller
{
	protected $title;		
	protected $content;		
	
	protected function before()
	{
		$this->title = 'Шаблон';
		$this->content = '';
	}
		
	public function render()
	{
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template('view/v_main.php', $vars);				
		echo $page;
	}	
}