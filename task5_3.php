<?php
$title = 'Главная страница - страница обо мне';
$h1 = 'Информация обо мне';
$year = date('Y');

$content = file_get_contents("template_3.php");

$content = str_replace('{{ TITLE }}',$title, $content);
$content = str_replace('{{ H1 }}',$h1, $content);
$content = str_replace('{{ YEAT }}',$year, $content);

echo $content;