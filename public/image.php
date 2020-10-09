<?php

include '../config/config.php';
include '../engine/db.php';
include '../engine/gallery.php';

$id = (int)$_GET['id'];

$db = getDb();

addViewImage($db, $id);

$image = getImageById($db, $id);

if (is_null($image)) {
    echo 'Изображение в галерее не найдено. <a href="index.php">Вернуться на главну</a>';
    die();
}


?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Просмотр изображения</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<div id="main">
<div class="menu">
    <a href="index.php">На главную</a>
</div>
<div>
    <img src="<?=PATH_BIG_IMAGES . '/' . $image['filename']?>">
    <p>Просмотров: <?=$image['views']?></p>
</div>
</div>
</body>