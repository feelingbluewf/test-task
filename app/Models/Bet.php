<?php

namespace App\Models;

class Bet extends Model
{
	protected $conn;
	protected $table_name = "bets";

	public $user_id;
	public $bet_amount;
	public $ratio;
	public $currency;
	public $win;
	public $status;
	public $created_at;
	public $updated_at;

	public function create($data) 
	{

		$query = "INSERT INTO 
		" . $this->table_name . " 
		SET ";

		foreach ($data as $key => $value)
		{
			$query .= "$key = '$value', ";
		}

		$query = substr($query,0,-2);

		if($this->conn->query($query))
		{
			return true;
		}

		return false;

	}
}