<?php 

namespace App\Exceptions;

class FormException extends \Exception
{
	public static function checkSum($sum)
	{
		if($sum > 500 || $sum < 1)
		{
			throw new \Exception('Сумма ставки должна
				быть в пределах от 1 до 500 текущих денежных единиц.');
		}
		
		return true;
	}
}