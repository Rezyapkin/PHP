<?php

$message = strip_tags($_GET['message']);

$config = [
       'OK' => 'Файл загружен!',
       'ERROR' => 'Ошибка загрузки файла!',
       'ERROR_EXT' => 'Не верное расширение файла!',
       'ERROR_SIZE' => 'Превышен максимально допустимый размер файла!',
];

if (isset($_POST['load'])) 
{
    $path = PATH_BIG_IMAGES . "/" . $_FILES['myfile']['name'];
    $path_small = PATH_SMALL_IMAGES . "/" . $_FILES['myfile']['name'];

    if (!in_array(get_file_extension($_FILES['myfile']['name']), EXT_IMAGES)) {
        header("Location: index.php?message=ERROR_EXT");
    } else if ( $_FILES['myfile']['size'] > MAX_IMAGE_SIZE) {
        header("Location: index.php?message=ERROR_SIZE");
    } else if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToWidth(150);
        $image->save($path_small);     
        addImageToDB($db, $_FILES['myfile']['name']);   
        header("Location: index.php?message=OK");
    } else {
        header("Location: index.php?message=ERROR");
    }

    exit;
}
