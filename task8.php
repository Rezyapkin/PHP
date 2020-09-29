<?php

/*
*Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
*/

// Не совсем понял вывод оставлять как был раньше, просто отфильтровать?

$regions = [
    "Московская область" => ["Москва", "Зеленоград", "Клин"],
    "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
    "Рязанская область" => ["Рязань", "Шацк"]
];

function filter_cities($city) {
    //Можно конечно в верхний регистры было не приводить
    return (mb_strtoupper(mb_substr($city, 1 , 1)) === "К"); 
}

foreach ($regions as $region => $cities) {
    echo $region;
    $first = true;
    foreach (array_filter($cities, "filter_cities") as $city) {
        if ($first) {
            echo ": <br>";
            $first = false;
        } else {
            echo ', ';
        }
        echo ($city);
    }
    echo ". <br>";
}