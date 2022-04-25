<?php

namespace App\Models;

class User extends Model
{
	protected $conn;
	protected $table_name = "users";

	public $id;
	public $name;
	public $login;
	public $password;
	public $gender;
	public $birth_date;
	public $address;
	public $status;
	public $created_at;
	public $updated_at;

}