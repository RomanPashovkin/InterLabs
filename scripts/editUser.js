document.body.addEventListener('DOMSubtreeModified', function() {

	// Получаем все формы с одинаковым id "editForm"
	const forms = document.querySelectorAll('form#editForm');
	
	forms.forEach(form => {
		form.addEventListener('submit', function(event) {
			event.preventDefault(); // Предотвращение дефолтного поведения
	
			//Получение данных по форме
			var formData = new FormData(this);
			var form = event.target;
			var fio = form.querySelector("input[name='fio']");
			var email = form.querySelector("input[name='email']");
			var address = form.querySelector("input[name='address']");
		
				//Отправление Ajax-запроса
				var request = new XMLHttpRequest();
				request.open('POST', '/editFormHandler.php', true);
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
										fio.value = responce[key];
										break;
									case 'email':
										email.value = responce[key];
										break;
									case 'address':
										address.value = responce[key];
										break;
								}
							}
						}
					var message = document.createElement("a");
					message.setAttribute('id', 'successMessage');
					message.innerHTML = "Изменения были сохранены!";
					var messageExists = !!document.getElementById("successMessage");
					if (messageExists) {
							return;
						}
					else {
						document.body.append(message);
					}
				}
				
				else {
					alert('Произошла ошибка. Попробуйте ещё раз.');
				}
			};
		});
	});
});
