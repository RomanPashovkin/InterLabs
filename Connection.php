<?php
//Класс для подключения к БД и выполнения запросов
class Connection
{
	private $dbname, $host, $username, $password;
	public $connection;
	
	public function __construct($dbname, $host, $username, $password)
	{
		$this->dbname = $dbname;
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
	}

	public function connectDb()
	{
		try {
			$this->connection = new PDO("mysql:dbname=$this->dbname; host = $this->host", $this->username, $this->password);
		}
		catch(PDOException $e) {
			die("Ошибка соединения: $e");
		}
	}

	public function getOne($id)
	{
		$queryOne = sprintf("Select * from users where id = %s ", $this->connection->quote($id));
		$result = $this->connection->prepare($queryOne);
		$result->execute();
		return $result;
	}

	public function getAll()
	{
		$queryAll = "Select * from users";
		$result = $this->connection->prepare($queryAll);
		$result->execute();
		return $result;
	}

	public function editUser($id, $fio, $email, $address)
	{
		$editQuery = sprintf("Update users set fio = %s, email = %s, address = %s where id = %s ",
		$this->connection->quote($fio), $this->connection->quote($email), $this->connection->quote($address), $this->connection->quote($id));
		$stmt = $this->connection->prepare($editQuery);
		$stmt->execute();
	}

	public function createUser($fio, $email, $address)
	{
		$insertQuery = sprintf("Insert into users (fio, email, address) values(%s, %s, %s)",
		$this->connection->quote($fio), $this->connection->quote($email), $this->connection->quote($address));
		$stmt = $this->connection->prepare($insertQuery);
		$stmt->execute();
	}

	public function deleteById($id)
	{
		$deleteQuery = sprintf("Delete from users where id = %s",
		$this->connection->quote($id));
		$stmt = $this->connection->prepare($deleteQuery);
		$stmt->execute();
	}

	public function checkSystemUser($username, $password)
	{
		$checkQuery = sprintf("Select * from systemusers where username = %s and password = %s", $this->connection->quote($username), $this->connection->quote($password));
		$result = $this->connection->prepare($checkQuery);
		$result->execute();
		if($result->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function getAllOrder($sortType)
	{
		if ($sortType == 'new') {
			$orderQuery = "Select * from users order by id DESC";
		}
		elseif ($sortType == 'old') {
			$orderQuery = "Select * from users order by id";
		}
		else {
			$orderQuery = "Select * from users order by $sortType";
		}
		$result = $this->connection->prepare($orderQuery);
		$result->execute();
		return $result;
	}
}

//Конфигурация подключения к БД
$connection = new Connection("pashrosf_baza", "localhost", "pashrosf_baza", "28051980MySQL+");
$connection->connectDb();
?>