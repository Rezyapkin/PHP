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
<link rel="stylesheet" type="text/css" href="./scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
</head>

<body>
<div id="main">
<div class="post_title"><h2>Моя галерея</h2></div>

	<div class="gallery">
	    <?php foreach ($images as $image): ?>
			<a rel="gallery" class="photo" href="image.php?id=<?= $image['ID'] ?>" >
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
