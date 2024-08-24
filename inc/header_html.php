<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta charset="cp1251">
		<title>Unlimited Log</title>
		<link rel="shortcut icon" href="../img/favicon_new.png" type="image/x-icon">
		<link href="../css/styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery.form.js"></script>
		<h1 style="text-align: center;"><font color="1168a6"><font size="6"><font face="Tahoma, Geneva, sans-serif"> </font></font></font></h1>	
	</head>
</html>

<body>
<div class="loaderArea">
	<div id="loader"></div>
</div>    

<script src="../js/script.js"></script>
</body>


<style>
   .intput_pos {
	display: inline-block;
   }
</style>
  
<div class = "menu">
	<table width="100%">
		<tr><td><ul>
			<button class="c-button" name = "redirect-key" value = 'index.php' >Главная</button>

<?
	//<a href=../pages/server><li>Выбор сервера</li></a>'
	if ( isset($data[login]) )
	{
		echo '<button class = "c-button" name = "redirect-key" value = "search.php">Поиск аккаунтов</button>
		<button class = "c-button" name = "redirect-key" value = "admin.php">Админы</button>
		<button class = "c-button" name = "redirect-key" value = "lid.php">Лидеры</button>
		<button class = "c-button" name = "redirect-key" value = "biz.php">Бизнесы</button>
		<button class = "c-button" name = "redirect-key" value = "car.php">Машины</button>
		<button class = "c-button" name = "redirect-key" value = "logsdbsearch.php">Поиск</button>';

		/*
		echo '<div class="intput_pos">
			<form name="search" method="post" action="../pages/logsdbsearch"  id="searchform">
					<input maxlength="50" name="query" size="20" type="search" placeholder="">
				<form method="GET">
					<input type="submit" name="search" value="Поиск"/>
				</form>
			</form>
		</div>';*/
	}

?>

<a><ul><td valign = "top" align="right">

<?
	if ( isset($data[login]) )
		echo "<button class = 'c-button'>$data[login]</button>";
?>

	</td>
		</tr>
	</table>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">

	window.onload = function() {
		
		  function strPad() {
				
				let params = 'url=' + this.value; 
				
				$.ajax({
				type: 'POST',
				url: 'redirect',
				data: params,
				cache: false,
				success: function(data) {
						
						return window.location.href = '../upload/';
					}	
				});
		  }

		  var bt = document.getElementsByName("redirect-key");
		  
		  for (var i = 0; i < bt.length; i++) {
			  
				bt[i].onclick = strPad;
		  
		}
	}
	

</script>