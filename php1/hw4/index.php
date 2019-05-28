
<html>
<head>
<script src="public/js/jquery-1.9.1.min.js"></script>
<script src="public/js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="public/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
	<script type="text/javascript">
$(document).ready(function() {
$(".myfancybox").fancybox({  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
//Iframe
$(".myframe").fancybox({
iframe : {
scrolling : 'yes',
},
});

});
</script>

<hr/>
<div class="gallery">
    <?php
    $dir = 'public/img/';
$images = scandir($dir);
for ($i = 0; $i < count($images); $i++) {
  if ($images[$i] != '.' && $images[$i] != '..') {
    echo '<a href="' . $dir . $images[$i] . '" data-fancybox="example_group"><img src=' . $dir . $images[$i] . '></a>';
  }
}
    ?>
</div>
</body>   
</html>
