<?php
session_start();
require_once __DIR__.'/../../vendor/autoload.php';

use App\Models\Bet;
use App\Models\Balance;
use App\Database\Database;
use App\Exceptions\FormException;
use App\Exceptions\UserException;

if($_POST)
{
	// db connection
	$database = new Database();
	$db = $database->getConnection();

	$balance = new Balance($db);

	// get user balance
	$user_balance = $balance->getById($_POST['user_id']);

	// check user balance and sum from 1 to 500
	try 
	{
		FormException::checkSum($_POST['sum']);
		UserException::checkBalance($user_balance, $_POST['currency'], $_POST['sum']);
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}

	$sum = $_POST['sum'] * 100;

	if($_POST['bet_result'] == '1')
	{
		// calculate win sum
		$win = $sum * $_POST['ratio'] - $sum;

		// put win sum and save
		$user_balance->{$_POST['currency']} = $user_balance->{$_POST['currency']} + $win;
		$user_balance->save();
	}
	elseif($_POST['bet_result'] == '0')
	{
		// take away the bet and save
		$user_balance->{$_POST['currency']} = $user_balance->{$_POST['currency']} - $sum;
		$user_balance->save();
	}
	else
	{
		// if bet_result not 0 and not 1
		$_SESSION['error'] = 'Техническая Ошибка!';
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}

	$bet = new Bet($db);
	
	// create log
	$bet->create([
		"user_id" => $_POST['user_id'],
		"bet_amount" => $sum,
		"ratio" => $_POST['ratio'],
		"currency" => $_POST['currency'],
		"win" => $_POST['bet_result'] == '1' ? $sum * $_POST['ratio'] : 0,
		"is_win" => $_POST['bet_result'],
		"status" => 1,
		"created_at" => date('Y-m-d H:i:s', time()),
		"updated_at" => date('Y-m-d H:i:s', time())
	]);

	$balance = $user_balance->{$_POST['currency']} / 100;
	$result = $_POST['bet_result'] == '1' ? 'Победа' : 'Поражение';
	$currency = strtoupper($_POST['currency']);
	$win = $_POST['bet_result'] == '1' ? $_POST['sum'] * $_POST['ratio'] : 0;

	// redirect back with result alert
	$_SESSION['result'] = "Сумма ставки: $_POST[sum], Коэффицент: $_POST[ratio], Выигрыш: $win, Баланс: $balance $currency, Исход: $result";
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


?>