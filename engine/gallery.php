<?php

function getImages($db) {
    return mysqli_query($db, 'SELECT * FROM gallery ORDER BY views DESC');
}

function getIdByFilename($db, $filename) {
    $result = mysqli_query($db, 'SELECT ID FROM gallery WHERE filename = "' . $filename . '"');  
    return ($result) ? mysqli_fetch_assoc($result)['ID'] : NULL;  
}    

function addImageToDB($db, $filename) {
    //Файл уже добавлен в галерею ранее
    if (getIdByFilename($db, $filename)) {
        return false;
    }

    $filesize = filesize(PATH_BIG_IMAGES . '/' . $filename);

    if (isset($filesize)) {
        return mysqli_query($db, 'INSERT INTO gallery (filename, size) VALUES ("' . $filename . '", ' . $filesize . ')');
    } else {
        return false;
    }    

}
