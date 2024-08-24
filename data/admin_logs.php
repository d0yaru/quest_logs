<td class="middel">
	<div class="box">
		<div class="boxtitle">Действия администрации [последние 200 логов]:</div></td>
		<br />
		<?php
			
			$result = $base_logs -> query("SELECT * FROM $TABLE_LOG WHERE Type = 5 ORDER BY Date DESC LIMIT 0,200");
			
			while($row = mysqli_fetch_array($result))
			{
				echo '<tr><td>'.$row['Date'].' &nbsp;&nbsp;&nbsp;&nbsp;' .$row['Text'].' </td><br></tr>';
			}
		?>
	</div>
</div>