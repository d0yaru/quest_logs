<div class = "box">
	<td class="middel">
			<div class="boxtitle">Список Лидеров</div>
	</td>
	<?
	echo '<br>
	<table width="100%"><tr>
	<td><b>Ник</b></td>
	<td><b>Фракция</b></td>
	<td><b>Деньги</b></td>
	<td><b>Ранг#1</b></td>
	<td><b>Ранг#2</b></td>
	<td><b>Ранг#3</b></td>
	<td><b>Ранг#4</b></td>
	<td><b>Ранг#5</b></td>
	<td><b>Ранг#6</b></td>
	<td><b>Ранг#7</b></td>
	<td><b>Ранг#8</b></td>
	<td><b>Ранг#9</b></td><br>';
	?>
	<?php
	$result = $base_server -> query("SELECT * FROM  orgsinfo WHERE Leader != 'None' ORDER BY Leader DESC LIMIT 0,200");
	while($row = mysqli_fetch_array($result))
	echo '<tr>
	<td> <a href=../pages/user?name=' .$row['Leader']. '>' .$row['Leader']. '</a></td>
	<td>' .$row['Name']. '</td>
	<td>' .$row['Bank']. ' </td>
	<td>' .$row['Rank_1']. '</a></td>
	<td>' .$row['Rank_2']. '</a></td>
	<td>' .$row['Rank_3']. '</a></td>
	<td>' .$row['Rank_4'].'</td>
	<td>' .$row['Rank_5']. '</td>
	<td>' .$row['Rank_6']. '</td>
	<td>' .$row['Rank_7']. '</td>
	<td>' .$row['Rank_8']. '</td>
	<td>' .$row['Rank_9']. '</td>';
	?>
	<?
	// echo '<p><a href=/logsaccount?name='.$row['NickName'].'>'.$row['NickName'].'</a> - '.$row['Level'].'(lvl) - '.$row['Admin'].' - '.$row['AdminPrefix'].'</p></pre>';
	 ?>
	<?
	
		$result = $base_server -> query("SELECT * FROM  orgsinfo WHERE Leader != 'Свободна'");
		echo '</table><p><b>Всего лидеров: ' .$result -> num_rows. ' из 28</b>';
	?>

</div>