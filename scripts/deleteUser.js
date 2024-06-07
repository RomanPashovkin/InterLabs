document.querySelector('button.deleteButton').addEventListener('click', function(event) {
	//Поиск активных чекбоксов и id их пользователей
	var checkboxes = document.querySelectorAll('#deleteUserCb');
	usersToDelete = [];
	for(i = 0; i < checkboxes.length; i++){
		if(checkboxes[i].checked) {
			let userId = checkboxes[i].previousElementSibling.value;
			usersToDelete.push(userId);
		}
	}

	//Отправление Ajax-запроса
	var request = new XMLHttpRequest();
	request.open('POST', '/deleteFormHandler.php', true);
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	request.send(JSON.stringify(usersToDelete));

	request.onload = function() {
		if (request.status === 200) {
			location.reload();
		}
		else {
			alert('Произошла ошибка. Попробуйте ещё раз.');
		}
	}
});