<?php
	include '../config/config.php';
	include '../engine/class_simple_image.php';
	include '../engine/upload.php';
	include '../engine/db.php';
	include '../engine/gallery.php';
	include '../engine/functions.php';

	$db = getDb();
	$images = getImages($db);

?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Моя галерея</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="./scripts/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="./scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function(){
		$("a.photo").fancybox({
			transitionIn: 'elastic',
			transitionOut: 'elastic',
			speedIn: 500,
			speedOut: 500,
			hideOnOverlayClick: false,
			titlePosition: 'over'
		});	}); </script>

</head>

<body>
<div id="main">
<div class="post_title"><h2>Моя галерея</h2></div>

	<div class="gallery">
	    <?php foreach ($images as $image): ?>
			<a rel="gallery" class="photo" href="<?=PATH_BIG_IMAGES . '/' . $image['filename'] ?>" >
			    <img src="<?=PATH_SMALL_IMAGES . '/' . $image['filename'] ?>" width="150" height="100" alt="Просмотров: <?=$image['views']?>"/></a>
        <?php endforeach; ?>
	</div>
	
	<?php if ($config[$message]): ?>
	<p class="error_text"><?=$config[$message]?></p>
	<?php endif; ?>
	
	<p>Загрузить новое изображение в галерею:</p>
	
	<form method="post" enctype="multipart/form-data">
       <input type="file" name="myfile">
	   <input type="submit" value="Загрузить..." name="load">
    </form>

</div>

</body>
</html>
