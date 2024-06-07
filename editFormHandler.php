<?php
include('Connection.php');
include('User.php');

	//Получаем данные из Ajax-запроса
	if(isset($_POST['hideId']) && isset($_POST['fio']) && isset($_POST['address']) && isset($_POST['email'])){
		$user = new User($_POST['fio'], $_POST['email'], $_POST['address'], $_POST['hideId']);
	}

	//Выполняем запросы к БД и возвращаем данные обновленного пользователя
	$connection->editUser($user->id, $user->fio, $user->email, $user->address);
	$resultOne = $connection->getOne($user->id);
	foreach($resultOne as $row){
		echo json_encode($row, JSON_UNESCAPED_UNICODE);
	}

?>