		$( "#form-signin" ).on('submit', function(event) {
			event.preventDefault();
			
			let user = $('#username').val();
			let password = $('#password_0').val();
			let password_1 = $('#password_1').val();
			let email = $('#email').val();
			let vk = $('#vkontakte').val();
			
			if (user.length < 3) {
			    
				Swal.fire({
				    title: "<h1>Ошибка</h1>",
				    html: "<h10>Неправильно указан логин<br>Длина логина должна быть не менее 3-х символов.</h10>",
				    icon: "error",
				    confirmButtonText: "Закрыть",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
				
				return false;
			}
			
			else if (password.length < 6)
			{
				Swal.fire({
				    title: "<h1>Ошибка</h1>",
				    html: "<h10>Длина пароля должна быть не меньше 6 символов</h10>",
				    icon: "error",
				    confirmButtonText: "Закрыть",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
				
				return false;
			}
			
			else if (password_1 !== password)
			{
				Swal.fire({
				    title: "<h1>Ошибка</h1>",
				    html: "<h10>Не удалось пройти подтверждение пароля</h10>",
				    icon: "error",
				    confirmButtonText: "Закрыть",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
				
				return false;
			}
			
			else if (vk.length == 0 || email.length == 0)
			{
				Swal.fire({
				    title: "<h1>Ошибка</h1>",
				    html: "<h10>Вы заполнили не всю информацию</h10>",
				    icon: "error",
				    confirmButtonText: "Закрыть",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
				
				return false;
			}
				
			$.ajax({
				type: 'POST',
				url: 'create_account.php',
				data: $('#form-signin').serialize(),
				cache: false,
				success: function(data) {
				    
					if (data == 'YES') {
					
						let timerInterval
						Swal.fire({
							  title: '<h1>Successful<h1>',
							  timer: 1200,
							  icon: "success",
							  width: 400,
							  timerProgressBar: true,
							  willClose: () => {
								clearInterval(timerInterval)
							  }
						}).then((result) => {
							
						  if (result.dismiss === Swal.DismissReason.timer) {
							console.log('Reddirect to payment and closed alert.')
						  }
						})
						
						setTimeout(function(){
                                
                            window.location.href = '/check/authorization';
                                
                        }, 1250);
					}
					
					else
					{
						Swal.fire({
        				    title: "<h1>Ошибка</h1>",
        				    html: "<h10>" + data + "</h10>",
        				    icon: "error",
        				    confirmButtonText: "Закрыть",
        				    confirmButtonColor: "#4676D7",
        				    timer: 5000
        			   });
				
				       return false;
					}
					
				}
			});
			
            
			return false;
		});