<? 
	include '../inc/SAMP_config.php';
?>

<tr><td class="middel"><div class="box"><div class="boxtitle">Информация о доме</div>
<?php
	if (isset($_POST['query'])) $id=$_POST['query']; 
	else $id=$_GET['id']; 

	$result = $base_server -> query("SELECT * FROM  houses WHERE ID = '$id'");
	while( $row = mysqli_fetch_array($result) )
		
	echo '<div class ="textstyle"><p>Номер дома<b>'.$row['ID'].'</b><br>
	Владелец<b><a href=../pages/user?name='.$row['Owner'].'>'.$row['Owner'].'</a></b><br>
	Гос. Цена<b>'.$row['Cost'].'</b></p><br></div>';

	$result = $base_server -> query("SELECT * FROM  houses WHERE ID = '$id'");
	
	while($mysql = mysqli_fetch_array($result))
	$string = ''.$mysql['Items'].''.$mysql['ItemsKolvo'].'';
	$array = explode(",", $string);

	echo 'Шкаф дома №:'.$id.'<br><br>';

	echo '<br>
	<table width="100%"><tr>
	<td><b>ID слота</b></td>
	<td><b>Предмет</b></td>
	<td><b>Количество</b></td></tr><br>';

	for($i = 0; $i < 90; $i++)
	{
		if (!$array[$i]) continue;

		echo '<tr>
		<td>'.$i.'</td>
		<td>'.$SAMP_ARIZONA_ITEM_NAME[$array[$i]].'</td>
		<td>'.$array[$i+90].'</td></tr>';
	}

	echo '</table>';

	$result = $base_logs -> query("SELECT * FROM ".$TABLE_LOG." WHERE ((`Text` LIKE '%дом%') AND ((`Text` LIKE '%ID: $id%') OR (`Text` LIKE '%№$id%'))) ORDER BY Date DESC, Time DESC LIMIT 0,200");
	$num = mysqli_num_rows($result);
	if ($num)
	{
	 echo 'Недавние действия с домом:<br>';
	 while($row = mysqli_fetch_array($result))
	 echo '<p>'.$row['Date'].' '.$row['Time'].'&nbsp;&nbsp;&nbsp;&nbsp;<a href=../pages/user?name=' .$row['NickName1']. '>' .$row['NickName1']. '</a> '.$row['Text'].'</p></pre>';
	}
 ?>