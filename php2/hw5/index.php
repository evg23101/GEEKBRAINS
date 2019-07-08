<?php
session_start();
function __autoload($classname){
	include_once("control/$classname.php");
}

$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';
switch ($_GET['c'])
{
	case 'articles':
		$controller = new Page();
	case 'user':
		$controller = new User();
		break;
	default:
		$controller = new Page();
}
$controller->Request($action);