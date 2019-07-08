<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8 />
    <title>Каталог</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">  type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css">
    <script>
        $(document).ready(function(){
            $('#show_more').click(function(){

				let btn_more = $(this);
                let count_show = parseInt($(this).attr('count_show'));
                let count_add  = $(this).attr('count_add');
				btn_more.val('Подождите...');
				$.ajax({
                    url: "ajax.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "count_show":	count_show,
                        "count_add":	count_add
                    },
                    // после получения ответа сервера
                    success: function(data){
						if(data.result == "success"){
							$('#content').append(data.html);
							btn_more.val('Показать еще');
							btn_more.attr('count_show', (count_show+10));
						}else{
							btn_more.val('Больше нечего показывать');
						}
                    }
                });
            });
			
        });		
    </script>
	
</head>
<body>
	<div id="content">
		<?php
			include "../config/database.php";
			
			$sql = mysqli_query($connect,"SELECT * FROM `goods` LIMIT 24") or die(mysqli_error($connect));
			$goodsData = array();
			while($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
				$goodsData[] = $result;
			}			
			foreach($goodsData as $oneGood):
		?>
		<div class="good">
			<b class="goodsName"><?=$oneGood['nameFull'];?></b>
			<p class="goodsParam"><?=$oneGood['param'];?></p>
            <div class='goodsWrap'><img class='goodImg'src="<?=$oneGood['miniPhoto'] ?>"></div>
            <div class='goodsPrice'><?=$oneGood['price'] ?><b> &#8381;</b></div>
		</div>
		<?php endforeach; ?>
	</div>
	
	<input id="show_more" count_show=24 count_add=10 type="button" value="Показать еще" />
</body>
</html>