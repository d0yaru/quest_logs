<td class="middel">
	<div class="box">
		<div class="boxtitle">Список Администрации</div></td>
			<?
			echo '<br>
			<table width="100%"><tr>
			<td><b>Ник</b></td>
			<td><b>Админ</b></td>
			<td><b>Уровень</b></td>
			<td><b>Деньги(На руках)</b></td>
			<td><b>Деньги(Банк)</b></td>
			<td><b>Донат</b></td>
			<td><b>Номер</b></td>
			<td><b>Випка</b></td>
			<td><b>Заходил</b></td>
			<td><b>Почта</b></td>
			<td><b>ВКонтакте</b></td></tr><br>';
			?>
			<?php

			$result = $base_server -> query('SELECT * FROM  accounts WHERE Admin > 0 ORDER BY Admin DESC LIMIT 0,200');
			// берем результаты из каждой строки
			while($row = mysqli_fetch_array($result))
			 echo '<tr>
			<td> <a href=../pages/user?name=' .$row['NickName']. '>' .$row['NickName']. '</a></td>
			<td>' .$row['Admin'].' уровень</td>
			<td>' .$row['Level']. ' lvl</td>
			<td> <a href=/logsdbtype5search?name=' .$row['NickName']. '>' .$row['Money']. '</a></td>
			<td> <a href=/logsdbtype5search?name=' .$row['NickName']. '>' .$row['Bank']. '</a></td>
			<td>' .$row['VirMoney'].'</td>
			<td>' .$row['TelNum']. '</td>
			<td>' .$row['VIP']. '</td>
			<td>' .$row['LastLogin']. '</td>
			<td>' .$row['Mail'] . '</td>
			<td>' .$row['Vkontakte'] . '</td></tr>';
			?>
			</div>
			<?
				$result = $base_server -> query('SELECT * FROM  accounts WHERE Admin > 0');
				echo '</table><p><b>Всего администраторов: ' .$result -> num_rows. '</b>';
			
			?>
</div>