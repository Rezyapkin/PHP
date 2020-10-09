<?php

function getDb()
{
    static $db = null;

    if (is_null($db)) {
        $db = @mysqli_connect('localhost', 'test', '12345', 'geekbrains') or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}

