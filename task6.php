<?php

/*

*С помощью рекурсии организовать функцию возведения числа в степень. 
Формат: function power($val, $pow), где $val – заданное число, $pow – степень.

*/

//Работает только для целых $pow. Писал сам с нуля))) Думаю в интернете масса решений!
function power($val, $pow) {
    //Проверка на ошибки и отсутствие необходимости работы с $val = 0;
    if ($val == 0) {
        return 0;
    } else if (gettype($pow) != "integer") {
        throw new Exception('Функция power() умеет возводить только в целую степень.');
    }

    if ($pow == 0) {
        return 1;
    } else {
        return ($pow > 0) ? $val * power($val, $pow - 1) : power($val, $pow + 1) / $val;
    }
}

$val = rand(-10, 10);
$pow = rand(-10, 10);

echo "{$val} ^ {$pow} = ".power($val, $pow);
