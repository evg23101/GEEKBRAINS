<?php
	include "../config/database.php"; // подключение к базе данных
	
	$countView = (int)$_POST['count_add'];
	$startIndex = (int)$_POST['count_show'];
	
	// запрос к бд
	$sql = mysqli_query($connect, "SELECT * FROM `goods` LIMIT $startIndex, $countView") or die(mysqli_error($connect));
	$goodsData = array();
	while($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		$goodsData = $result;
	}
	
	if(empty($goodsData)){
		// если товаров нет
		echo json_encode(array(
			'result' 	=> 'finish'
		));
	}else{
		// если товары получили из базы, то свормируем html элементы
		// и отдадим их клиенту
		$html = "";
		foreach($goodsData as $oneGood){
			$html .= "
				<div>
					<b>{$oneGood['nameFull']}</b>
					<p>{$oneGood['param']}</p>
					<p>{$oneGood['price']}</p>
				</div>
			";
		}
		echo json_encode(array(
			'result' 	=> 'success',
			'html'		=> $html
		));
	}
	
	