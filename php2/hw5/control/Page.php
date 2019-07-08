<?php

include_once('model/model.php');
class Page extends BaseClass
{
	public function action_index(){
		$this->title .= '::Чтение';
		$text = text_get();
		//$today = date();
		$this->content = $this->Template('view/v_index.php', array('text' => $text));	
	}
	
	public function action_edit(){
		$this->title .= '::Редактирование';
		
		if($this->isPost())
		{
			text_set($_POST['text']);
			header('location: index.php');
			exit();
		}
		
		$text = text_get();
		$this->content = $this->Template('view/v_edit.php', array('text' => $text));		
	}
}