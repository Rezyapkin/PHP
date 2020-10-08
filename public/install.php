<?php

include '../engine/db.php';
include '../config/config.php';
include '../engine/get_images.php';	

$images = getImages(PATH_SMALL_IMAGES, EXT_IMAGES);

$db = getDb();

$count = 0;

foreach ($images as $image) {
    if (addImageToDB($db, $image)) {
        $count++;
    }
}

?>

<p>Добавлено изображений в галлерею: <?=$count?></p>