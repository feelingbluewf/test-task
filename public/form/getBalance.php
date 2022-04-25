<?php

require_once __DIR__.'/../../vendor/autoload.php';

use App\Models\Balance;
use App\Database\Database;

if (isset($_POST['userId']) && $_POST['currency']) 
{
	$database = new Database();
	$db = $database->getConnection();
	$balance = new Balance($db);

	$user_balance = $balance->getById($_POST['userId']);

	echo json_encode([
		'balance' => $user_balance->{$_POST['currency']} / 100,
		'currency' => $_POST['currency']
	]);
	die();
}

