    $( "#search-form" ).on('submit', function(event) {
    			
        let donateAccountName = $('#find-text').val();
        var select = $('#Type').val();
        
        
        const b = document.querySelector('finder');
        
        b.innerHTML = '...';                
        
        $.ajax({
				type: 'POST',
				url: '../js/data',
				data: $('#search-form').serialize(),
				cache: false,
				success: function(data) {
				    
				
                     Swal.fire({
                        title: '<h1>Обновление<h1>',
                        timer: 650,
                        icon: "success",
                        width: 400,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                        
                        })
				
				        setTimeout(function(){
                            b.innerHTML = data;
                        }, 700);
				        
				    return false;
				          
				}
		});
			
        return false;
    			
    });