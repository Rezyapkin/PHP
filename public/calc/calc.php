<?php
	include 'config.php';
	include 'functions.php';
	
    $operand1 = (int)$_POST['operand1'];
    $operand2 = (int)$_POST['operand2'];

	//Вызывать функцию по $_POST['operation'] опасно, т.к. могут подменить. Поэтому ищем ее в массиве
	$operation = $_POST['operation'];

	$response['result'] = (in_array($operation, $operations)) ? $operation($operand1, $operand2) : "Ай-яй-яй! Нехорошо ломать наш сайт)))";

	echo json_encode($response);