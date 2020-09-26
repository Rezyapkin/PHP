
<?php
/*
Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
Обязательно использовать оператор return. В делении проверьте деление на 0 и верните текст ошибки.
*/

function sum($x, $y) {
    return $x + $y;
}

function sub($x, $y) {
    return $x - $y;
}

function mul($x, $y) {
    return $x * $y;
}

function dev($x, $y) {
    return ($y == 0) ? "Деление на 0": $x / $y;
}

$x = rand(-10,10);
$y = rand(-10,10);

echo "x = {$x} <br>";
echo "y = {$y} <br>";

echo "x + y = ".sum($x,$y)."<br>";
echo "x - y = ".sub($x,$y)."<br>";
echo "x * y = ".mul($x,$y)."<br>";
echo "x / y = ".dev($x,$y)."<br>";
