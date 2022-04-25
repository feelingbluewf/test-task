<?php 

namespace App\Exceptions;

use App\Models\Balance;

class UserException extends \Exception
{
	public static function checkBalance(Balance $balance, $currency, $sum)
	{
		if($balance->{$currency} / 100 < $sum)
		{
			throw new \Exception('Пополните баланс!');
		}
		
		return true;
	}
}