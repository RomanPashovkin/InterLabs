<?php
include('Connection.php');
include('User.php');

	//Получаем данные из Ajax-запроса
	if(isset($_POST['sortingTypes'])){
		$userArray = [];
		$sortType = $_POST['sortingTypes'];
		$resultOrder = $connection->getAllOrder($sortType);
		foreach($resultOrder as $row) {
			$user = new User($row['fio'], $row['email'], $row['address'], $row['id']);
			array_push($userArray, $user);
		}
		echo json_encode($userArray, JSON_UNESCAPED_UNICODE);
	}

	// $userArray = [];
	// $sortType = 'address';
	// $resultOrder = $connection->getAllOrder($sortType);
	// 	foreach($resultOrder as $row) {
	// 		$user = new User($row['fio'], $row['email'], $row['address'], $row['id']);
	// 		array_push($userArray, $user);
	// 	}
	// echo json_encode($userArray, JSON_UNESCAPED_UNICODE);
?>