document.querySelector('form.sortForm').addEventListener('submit', function(event) {
	event.preventDefault();

	const forms = document.querySelectorAll('form#editForm');
	var rows = [];
	var formData = new FormData(this);

	//Копирование в массив и удаление всех записей в таблице
	forms.forEach(form => {
		var newForm = form.cloneNode(true);
		newForm.reset();
		rows.push(newForm);
		form.parentNode.removeChild(form);
	});

	//Отправление Ajax-запроса
	var request = new XMLHttpRequest();
	request.open('POST', '/sortFormHandler.php', true);
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	request.send(formData);

	//Получение ответа
	request.onload = function() {
		if (request.status === 200) {
			var responce = JSON.parse(request.responseText);
			var count = 0;

			responce.forEach(user => {

				var row = rows[count];
				var cell1 = row.querySelector('span#cell1');
				var cell2 = row.querySelector('span#cell2');
				var cell3 = row.querySelector('span#cell3');
				var cell4 = row.querySelector('span#cell4');
				var input1 = cell1.querySelector('input[name="fio"]');
				var input2 = cell2.querySelector('input[name="email"]');
				var input3 = cell3.querySelector('input[name="address"]');
				var input4 = cell4.querySelector('input[name="hideId"]');
				var nextRow = document.getElementById("createForm");

				input1.value = user.fio;
				input2.value = user.email;
				input3.value = user.address;
				input4.value = user.id;
				
				//Добавление этой строки и переход к следующей
				count++;
				nextRow.parentNode.insertBefore(row, nextRow);
		});
		}
		
		else {
			alert('Произошла ошибка. Попробуйте ещё раз.');
		}
	};
});