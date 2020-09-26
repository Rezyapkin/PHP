<?php

/*
Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), 
где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. 
В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3)
и вернуть полученное значение (использовать switch)
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

function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case '+':
            return sum($arg1, $arg2);
        case '-':
            return sub($arg1, $arg2);
        case '*':
            return mul($arg1, $arg2);
        case '/':
            return dev($arg1, $arg2);                            
    }
    return "Не известная операция";
}

$x = rand(-10,10);
$y = rand(-10,10);

echo "x = {$x} <br>";
echo "y = {$y} <br>";

echo "x + y = ".mathOperation($x,$y,"+")."<br>";
echo "x - y = ".mathOperation($x,$y,"-")."<br>";
echo "x * y = ".mathOperation($x,$y,"*")."<br>";
echo "x / y = ".mathOperation($x,$y,"/")."<br>";
