<?php

namespace App\Models;

use App\Database\Database;

abstract class Model {

	protected $conn;
	protected $table_name;

	public function __construct($conn) 
	{
		$this->conn = $conn;
	}

	function getAll() 
	{

		$query = "SELECT * FROM " . $this->table_name . "";

		return $this->conn->query($query);
	}
}