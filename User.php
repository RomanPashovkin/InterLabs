<?php
//Класс "пользователь" в таблице
class User 
{
	public $id, $fio, $email, $address;
	
	public function __construct($fio, $email, $address, $id = null)
	{
		if($id === null){
			$this->fio = $fio;
			$this->email = $email;
			$this->address = $address;
		}
		else {
			$this->id = $id;
			$this->fio = $fio;
			$this->email = $email;
			$this->address = $address;
		}

	}
}

//Класс "пользователь" для работы с системой
class SystemUser
{
	public $username, $password;

	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
}
?>