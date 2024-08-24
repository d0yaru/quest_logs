<tr><td class="middel"><div class="box"><div class="boxtitle" style = 'text-align: center;'>Поиск аккаунта</div>

<style>
::-webkit-input-placeholder {
   color:  RGBA(255.0, 255.0, 255.0, 0.7);
}
:-moz-placeholder { 
   color:    white;
}
::-moz-placeholder {
   color:    white;
}
:-ms-input-placeholder {
   color:    white;
}

input {

	text-align: center;
	
};

</style>
<form id = 'search-form'>
<center>
	<select name = "VIP">
    <option value = '0'>None</option>
	<option value = '1'>VIP-1</option>
	<option value = '2'>VIP-2</option>
	<option value = '3'>VIP-3</option>
	<option value = '4'>VIP-4</option>
	<option value = '5'>Titan</option>
	<option value = '6'>Premium</option>
	<option value = '7'>Supreme</option>
	<option value = '8'>BlastHack</option>
</select> 
<br />
<input name="name" size="25" type = 'text' placeholder = "Никнейм (содержит)"/><br>
<input name="phone" size="25" type = 'number' placeholder = "Номер телефона (содержит)"/><br>
<input name="level_0" type = 'number' placeholder = "Уровень от"/>
<input name="level_1" type = 'number' placeholder = "до уровня"/><br>
<input name="money_0" type = 'number' placeholder = "от Деньги (На руках)"/>
<input name="money_1" type = 'number' placeholder = "до Деньги (На руках)"/><br>
<input name="bank_0" type = 'number' placeholder = "от Деньги (Банк)"/>
<input name="bank_1" type = 'number' placeholder = "до Деньги (Банк)"/><br>
<input name="deposit_0" type = 'number' placeholder = "от Деньги (Депозит)"/>
<input name="deposit_1" type = 'number' placeholder = "до Деньги (Депозит)"/><br>
<input name="az_rub_0" type = 'number' placeholder = "от AZ-Рубли"/>
<input name="az_rub_1" type = 'number' placeholder = "до AZ-Рубли"/><br>
<input name="az_coin_0" type = 'number' placeholder = "от AZ Coins"/>
<input name="az_coin_1" type = 'number' placeholder = "до AZ Coins"/><br>
<input name = "IP" placeholder = "Совпадения с IP"/>

<br / >
</center>
<br />
<center>
<button class = 'c-button'>Поиск</button></center><tbody>
</form>

<script src = '../js/sweetalert2.all.min.js' type="text/javascript"></script>
<script type = "text/javascript">

	$( "#search-form" ).on('submit', function(event) {
    			
		Swal.fire({
            icon: "success",
            width: 400,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
			}
                        
        })
						
        $.ajax({
				type: 'POST',
				url: '../js/search',
				data: $('#search-form').serialize(),
				cache: false,
				success: function(data) {
				    
				
					Swal.fire({
						icon: "none",
						width: '100%',
						timerProgressBar: true,
						
						showCloseButton: true,
						showConfirmButton: false,
						
						html: data
					})
								
				    return false;
				          
				}
		});
			
        return false;
    			
    });

</script>