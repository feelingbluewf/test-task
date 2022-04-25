<?php

namespace App\Database;

class Database
{
	private $host = "";
	private $db_name = "";
	private $username = "";
	private $password = "";
	public $conn;

	public function getConnection() 
	{
		try {
			$this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
		} catch(\PDOException $exception) {
			return "Ошибка соединения: " . $exception->getMessage();
		}
		
		return $this->conn;
	}
}