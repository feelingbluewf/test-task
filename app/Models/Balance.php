<?php

namespace App\Models;

class Balance extends Model
{
	protected $conn;
	protected $table_name = "balance";

	public $user_id;
	public $eur;
	public $usd;
	public $rub;
	public $created_at;
	public $updated_at;

	public function getByid($id)
	{

		$query = "SELECT * FROM 
		" . $this->table_name . "
		WHERE 
		user_id = $id";

		$res = $this->conn->query($query);

		if($res) 
		{
			foreach ($res as $row)
			{
				$this->user_id = $row['user_id'];
				$this->eur = $row['eur'];
				$this->usd = $row['usd'];
				$this->rub = $row['rub'];
				$this->created_at = $row['created_at'];
				$this->updated_at = $row['updated_at'];
			}
			return $this;
		}

		return false;
	}

	public function save()
	{

		$query = "UPDATE
		" . $this->table_name . "
		SET
		eur = :eur,
		usd = :usd,
		rub = :rub,
		updated_at  = :updated_at
		WHERE
		user_id = :user_id";

		$stmt = $this->conn->prepare($query);

		$timestamp = date('Y-m-d H:i:s', time());

		$stmt->bindParam(':eur', $this->eur);
		$stmt->bindParam(':usd', $this->usd);
		$stmt->bindParam(':rub', $this->rub);
		$stmt->bindParam(':updated_at', $timestamp);
		$stmt->bindParam(':user_id', $this->user_id);

		if ($stmt->execute()) 
		{
			return true;
		}

		return false;
	}

}