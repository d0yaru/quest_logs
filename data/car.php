<td class="middel">
	<div class="box">
		<div class="boxtitle">Логи машин</div></td>
		    <br />
			<?php

			$result = $base_logs -> query("SELECT * FROM ".$TABLE_LOG." WHERE `Text` LIKE '%автомобиль%' ORDER BY Date DESC LIMIT 0,200");
			// берем результаты из каждой строки
			while($row = mysqli_fetch_array($result))
				
			 echo '<tr>
			<td>'.$row['Date'].' -</td>
			<td> <a href=../pages/user?name=' .$row['NickName1']. '>' .$row['NickName1']. '</a></td>
			<td>' .$row['Text'].' </td>
			<td> <a href=../pages/user?name=' .$row['NickName2']. '>' .$row['NickName2']. '</a></td>
			<br>
			</tr>';
			 ?>
	</div>