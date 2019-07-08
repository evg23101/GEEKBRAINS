<?php

include_once('model/M_User.php');
class User extends BaseClass
{
	
	public function action_auth(){
		$this->title .= '::Чтение';
		$text = text_get();
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
	
	public function action_login(){
		$this->title .= '::Личный кабинет';
		if($this->isPost()){
			if (M_User::login($_POST['login'],$_POST['pass'])){
				$_SESSION['user'] = M_User::getName();
				header('location: index.php');
				exit();
			} else {
				$error = 'Неверное имя пользователя / пароль';
			}
			
		}		
		$this->content = $this->Template('view/v_login.php', ['error' => $error]);		
	}

	public function action_logout(){
		unset($_SESSION['user']);
		header('location: index.php');
		exit();	
	}		
}