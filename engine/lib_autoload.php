<?php
$files = scandir(ENGINE_DIR);
$file_name = basename(__FILE__);//Думаю, что правильнее так делать
$lib_files = array_splice($files, 2);

foreach ($lib_files as $file) {
    if ($file != $file_name) {
        include_once ENGINE_DIR . "/" . $file;
    }
}
