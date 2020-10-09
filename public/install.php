<?php

include '../engine/db.php';
include '../engine/gallery.php';
include '../engine/functions.php';
include '../config/config.php';

function getImages($path) {
    $files = scandir($path);
    return array_filter($files, 'isImage');
}

$images = getImages(PATH_SMALL_IMAGES);

$db = getDb();

$count = 0;

foreach ($images as $image) {
    if (addImageToDB($db, $image)) {
        $count++;
    }
}

?>

<p>Изображений в папке : <?=count($images)?></p>
<p>Добавлено изображений в базу данных: <?=$count?></p>