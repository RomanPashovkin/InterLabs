document.querySelector('form#createForm').addEventListener('submit', function(event) {
	event.preventDefault(); // Предотвращение дефолтного поведения

	//Получение данных по форме
	var formData = new FormData(this);

	//Копирование строки (формы) для нового пользователя
	var originalForm = document.getElementById('editForm');
	var newForm = originalForm.cloneNode(true);
	var cell1 = newForm.querySelector('span#cell1');
	var cell2 = newForm.querySelector('span#cell2');
	var cell3 = newForm.querySelector('span#cell3');
	var cell4 = newForm.querySelector('span#cell4');
	var input1 = cell1.querySelector('input');
	var input2 = cell2.querySelector('input');
	var input3 = cell3.querySelector('input');
	var input4 = cell4.querySelector('input[name="hideId"]');

	var nextRow = document.getElementById("createForm"); //Форма перед которой добавляется новая строка (форма) с пользователем

	//Отправление Ajax-запроса
	var request = new XMLHttpRequest();
	request.open('POST', '/createFormHandler.php', true);
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	request.send(formData);

	request.onload = function() {
		//Получение ответа
		if (request.status === 200) {
			var responce = JSON.parse(request.responseText);
			for(let key in responce)
				{
					if(responce.hasOwnProperty(key)) {
						switch(key) {
							case 'fio':
								input1.value = responce[key];
								break;
							case 'email':
								input2.value = responce[key];
								break;
							case 'address':
								input3.value = responce[key];
								break;
							case 'id':
								input4.value = responce[key];
								break;
						}
					}
				}
			nextRow.parentNode.insertBefore(newForm, nextRow);
			var message = document.createElement("a");
			message.setAttribute('id', 'successMessage');
			message.innerHTML = "Пользователь был успешно добавлен!";
			var messageExists = !!document.getElementById("successMessage");
			if (messageExists) {
					return;
				}
			else {
				document.body.append(message);
			}
			document.getElementById("createForm").reset();
		}

		else {
			alert('Произошла ошибка. Попробуйте ещё раз.');
		}
	};

});