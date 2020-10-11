<?php
	include 'config.php';
	include 'functions.php';
	
    $operand1 = (int)$_POST['operand1'];
    $operand2 = (int)$_POST['operand2'];

	$operation = $operations[$_POST['operation']];
	
	$response['result'] = $operation($operand1, $operand2);

	echo json_encode($response);