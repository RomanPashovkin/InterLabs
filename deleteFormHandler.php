<?php
include('Connection.php');

// Получаем айдишники для удаления в json
$data = json_decode(file_get_contents('php://input'), true);

//Удаление и отправка ответа
foreach($data as $userId) {
	$connection->deleteById($userId);
}
http_response_code(200);
?>