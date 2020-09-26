<?php

/*
Присвоить переменной $а значение в промежутке [0..15]. 
С помощью оператора switch организовать вывод чисел от $a до 15. 
При желании сделайте это задание через рекурсию.
*/


// Желаю при помощи рекурсии)
function printing_15($a) {
    echo "{$a}<br>";
    if ($a < 15) {
        printing_15($a + 1);
    }    
}

$a = rand(0,15);
echo "<i>a = {$a}</i> <br><br>";
printing_15($a);

echo "<br><strong>Вариант 2:</strong><br>";
//При помощи свитч - это жестоко))) Надеюсь это имел в виду постановщик задачи)

switch ($a) {
    case 0:
        print_a();
    case 1:
        print_a();
    case 2:
        print_a();
    case 3:
        print_a();
    case 4:
        print_a();
    case 5:
        print_a();
    case 6:
        print_a();
    case 7:
        print_a();
    case 8:
        print_a();
    case 9:
        print_a();
    case 10:
        print_a();
    case 11:
        print_a();
    case 12:
        print_a();
    case 13:
        print_a();
    case 14:
        print_a();
    case 15:
        print_a();
} 

function print_a() {
    global $a;
    echo "{$a}<br>";
    $a += 1;
}
