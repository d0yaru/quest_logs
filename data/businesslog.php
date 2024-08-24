<tr><td class="middel"><div class="box"><div class="boxtitle">Информация о бизнесе</div>
<table width="100%" border="0">

<?php
	if (isset($_POST['query'])) $id= $_POST['query']; 
	else $id=$_GET['id']; 
	
	$result = $base_server -> query("SELECT * FROM  businesses WHERE ID= '$id'");
	while($row = mysqli_fetch_array($result))
		
	echo '<p>ID бизнеса<b style = "margin-left: 324px;">'.$row['ID'].'</b><br>
	Бизнес<b style = "margin-left: 350px;">'.$row['Name'].'</a></b><br>
	Владелец<b style = "margin-left: 333px;"><a href=/pages/user?name='.$row['Owner'].'>'.$row['Owner'].'</a></b><br>
	Заместитель<b style = "margin-left: 318px;"><a href=/pages/user?name='.$row['Zam'].'>'.$row['Zam'].'</a></b><br>
	Гос. Цена<b style = "margin-left: 332px;">'.$row['Cost'].'</b></p><br>';
	//Налог<b style = "margin-left: 354px;">'.$row['Level'].'</b><br>
 ?>