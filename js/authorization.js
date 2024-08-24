		$( "#form-signin" ).on('submit', function(event) {
			event.preventDefault();
			
			let user = $('#username').val();
			let password = $('#password').val();
			
			if (user.length < 3) {
			    
				Swal.fire({
				    title: "<h1>Ошибка</h1>",
				    html: "<h10>Неправильно указан логин<br>Длина логина должна быть не менее 3-х символов.</h10>",
				    icon: "error",
				    confirmButtonText: "Хорошо",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
				
				return false;
			}
			
			else if (password.length == 0)
			{
				Swal.fire({
				    title: "<h1>😞</h1>",
				    html: "<h10>Мне кажется или поле пароля пустое?<br>Попробуйте заного.</h10>",
				    icon: "error",
				    confirmButtonText: "Хорошо",
				    confirmButtonColor: "#4676D7",
				    timer: 5000
				});
			}
				
			$.ajax({
				type: 'POST',
				url: 'in.php',
				data: $('#form-signin').serialize(),
				cache: false,
				success: function(data) {
				    
					if (data.search('#Ошибка') != -1) {
				       
				       data = data.replace('#Ошибка', ''); 
				       
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
					else if (data == 'YES') {
					
						let timerInterval
						Swal.fire({
							  title: '<h1>Successful<h1>',
							  timer: 950,
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
                                
                            window.location.href = '../';
                                
                        }, 1000);
					}
					
				}
			});
			
            
			return false;
		});