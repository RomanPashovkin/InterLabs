<?php
include('Connection.php');
include('User.php');

	//Получаем данные из Ajax-запроса
	if(isset($_POST['fio']) && isset($_POST['address']) && isset($_POST['email'])){
		$user = new User($_POST['fio'], $_POST['email'], $_POST['address']);
	}

	//Выполняем запросы к БД и возвращаем данные нового пользователя
	$connection->createUser($user->fio, $user->email, $user->address);
	$insertedId = $connection->connection->lastInsertId();
	$resultOne = $connection->getOne($insertedId);
	foreach($resultOne as $row){
		echo json_encode($row, JSON_UNESCAPED_UNICODE);
	}

?>