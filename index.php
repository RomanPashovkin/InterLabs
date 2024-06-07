<?php
include_once("Connection.php");
include_once("User.php");

//Проверка сессии (что пользователь авторизован в системе)
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

$resultAll = $connection->getAll();
$usersArray = array();

foreach ($resultAll as $row)
{
	$user = new User($row['fio'], $row['email'], $row['address'], $row['id']);
	array_push($usersArray, $user);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Администрирование</title>
	<link rel = "stylesheet" href = "/style/main.css">
</head>

<body>
	<div class = 'userSort'>
		<form method = "post" class = "sortForm">
			<label for = "sortingTypes">Сортировать таблицу по:&nbsp</label>
			<select id = "sortingTypes" name = "sortingTypes">
				<option value = "fio">ФИО</option>
				<option value = "email">Электронной почте</option>
				<option value = "address">Адресу</option>
				<option value = "old">Сначала старые</option>
				<option value = "new">Сначала новые</option>
			</select>
			<input class = 'sortButton' type = 'submit' name = 'sortUsers' value = "Отсортировать">
		</form>
	</div>

	<div class = "userTable">
	<div class="userColgroup">
		<div class="userCol"></div>
		<div class="userCol"></div>
		<div class="userCol"></div>
		<div class="userCol"></div>
	</div>
	<div class = "userCaption">
		Таблица пользователей
	</div>
	<div class = userHead>
		<div class = userRow>
			<div class = "userTh">ФИО</div>
			<div class = "userTh">Электронная почта</div>
			<div class = "userTh">Адрес</div>
			<div class = "userTh">Действия</div>
		</div>
	</div>
	<?php foreach ($usersArray as $user): ?>
			<form method = "post" class = "userRow" id = "editForm">
				<span class = "userCell" id = "cell1"><input type = "text" name = "fio" value = "<?php echo $user->fio; ?>" required></span>
				<span class = "userCell" id = "cell2"><input type = "email" name = "email" value = "<?php echo $user->email; ?>" required></span>
				<span class = "userCell" id = "cell3"><input type = "text" name = "address" value = "<?php echo $user->address; ?>" required></span>
				<span class = "userCell" id = "cell4">
					<input class = 'editButton' type = 'submit' name = 'editUser' value = "Изменить">
					<input type = 'hidden' name = 'hideId' value = "<?php echo $user->id; ?>">
					<input type = 'checkbox' id = 'deleteUserCb' name = 'deleteUserCb'>
				</span>
			</form>
	<?php endforeach; ?>

	<form method = "post" class = "userRow" id = "createForm">
		<span class = "userCell"><input type = "text" name = "fio" value = "" required placeholder = "ФИО"></span>
		<span class = "userCell"><input type = "email" name = "email" value = "" required placeholder = "Электронная почта"></span>
		<span class = "userCell"><input type = "text" name = "address" value = "" required placeholder = "Адрес"></span>
		<span class = "userCell">
			<input class = 'editButton' type = 'submit' name = 'createUser' value = "Добавить">
		</span>
	</form>

	</div>
	<button class = deleteButton><a>Удалить выбранных</a></button>
</body>

<script src="/scripts/editUser.js"></script>
<script src="/scripts/createUser.js"></script>
<script src="/scripts/deleteUser.js"></script>
<script src="/scripts/sorting.js"></script>
</html>