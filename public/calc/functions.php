<?php

function sum($a, $b) {
    return $a + $b;
}

function sub($a, $b) {
    return $a - $b;
}

function mul($a, $b) {
    return $a * $b;
}

function dev($a, $b) {
    return ($b == 0) ? "Деление на 0!" : $a / $b;
}