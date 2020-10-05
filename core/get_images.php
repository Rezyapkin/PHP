<?php

function get_file_extension($filename) {
    $file_info = pathinfo($filename);
    return $file_info['extension'];
 }

function isImage($value) {
    return in_array(get_file_extension($value), EXT_IMAGES);
}

function getImages($path) {
    $files = scandir($path);
    return array_filter($files, 'isImage');
}