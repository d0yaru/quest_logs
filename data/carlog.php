<? 
	include '../inc/SAMP_config.php';
?>

<td class="middel"><div class="box"><div class="boxtitle">Информация об автомобиле</div>
<?php

	if (isset($_POST['query'])) $id=$_POST['query']; 
	else $id = $_GET['id']; 
	
	if(isset($id))
	{
		$result = $base_server -> query("SELECT * FROM  ownable WHERE ID = '$id'");
		
		while($row = mysqli_fetch_array($result))
		{
			$id=$row['ID'];
			$owner=$row['Owner'];
			$keyer=$row['Keyer'];
			$shtrafer=$row['Shtrafer'];
			$cost=$row['Cost'];
			$number=$row['Number'];
			$register=$row['Register'];
			$color_1=$row['Color_1'];
			$color_2=$row['Color_2'];
			$model=$row['Model'];
		}
		switch($color_1)
		{
			case 0: $color_1 = 'Черный';
			case 1: $color_1 = 'Белый';
			default: $color_1;
		}
		switch($color_2)
		{
			case 0:  $color_2 = 'Черный';
			case 1: $color_2 = 'Белый';
			default: $color_2;
		}
	}
	echo '<p>' .$SAMP_VEHICLE_NAME[SAMP_GET_VEHICLE_NAME($model)]. ' - ['.$model.']</p></pre> ';
	
	$idcar = file_exists('../img/vehicle/'.$model.'.jpg') ? ''.$model.'.jpg' : 'noveh.gif';
	
	echo '<img border="0" src="../img/vehicle/' .$idcar. '" width="204" height="125" alt=""></pre>    ';
	echo '<div class = "textstyle"><p>ID автомобиля<b>'.$id.'</b></p> 
	<p>Владелец<b><a href=../pages/user?name='.$owner.'>'.$owner.'</a></b></p> 
	<p>Доступ имеется<b><a href=../pages/user?name='.$keyer.'>'.$keyer.'</a></b></p>
	<p>Цвет #1<b>'.$color_1.'</b></p>
	<p>Цвет #2<b>'.$color_2.'</b></p>
	<p>Штраф<b>'.$shtrafer.'</b></p>
	<p>Гос. Цена<b>'.$cost.'</b></p>
	<p>Номера<b>'.$number.'</b></p>
	<p>Регистрация<b>'.$register.'</b></p></div>';
 ?>