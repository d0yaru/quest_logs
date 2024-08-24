<?php
	include '../inc/SAMP_config.php';
	
	echo '<table width="100%" border="0">';
	
	if(isset($_GET['id']) || isset($_GET['name']) || isset($_POST['query']))
	{
		if(isset($_GET['id'])) { 
			$id=$_GET['id'];
			$result = $base_server->query("SELECT * FROM  accounts WHERE ID= '$id' ");
		}
		else if(isset($_GET['name'])) 
		{
			$name = $base_server->real_escape_string($_GET['name']);
			$result = $base_server->query("SELECT * FROM  accounts WHERE BINARY NickName='$name'");
		}
		else 
		{
			$name = $base_server->real_escape_string($_POST['query']); 
			$result = $base_server->query("SELECT * FROM  accounts WHERE BINARY NickName='$name'");
		}
		
		while($row = mysqli_fetch_array($result))
		{
			$id=$row['ID'];
			$nickname=$row['NickName'];
			$regip=$row['RegIP'];
			$regdata=$row['RegData'];
			$lastip=$row['OldIP'];
			$lastlogin=$row['LastLogin'];
			$admin=$row['Admin'];
			$level=$row['Level'];
			$virmoney=$row['VirMoney'];
			$money=$row['Money'];
			$bank=$row['Bank'];
			$leader=$row['Leader'];
			$rank=$row['Rank'];
			$status=$row['Online_status'];
			$vip=$row['VIP'];
			$viptime=$row['VipTime'];
			$jtime=$row['Demorgan'];
			$playhours=$row['PlayerTimess'];
			$referals=$row['Referal'];
			$donat=$row['Roubles'];
			$playerid=$row['PlayerID'];
		}
	}
		$result3 = $base_server->query("SELECT * FROM  bannames WHERE BINARY `Name`='$nickname'");
		
		while($rowa = mysqli_fetch_array($result3))
		{
			$reason=$rowa['BanReason'];
			$bantime=$rowa['BanSeconds'];
			$banadmin=$rowa['BanAdmin'];
		}
		
		$num = mysqli_num_rows($result3);
	$t=time();
	if($viptime<=0) $vtime='';
	else if(($viptime-$t)/60/60/24>1) { $vt=($viptime-$t)/60/60/24;
		$text1 = 'дней'; 
		$vtime = round($vt); }
	else { $vt=($viptime-$t)/60/60;
		$text1 = 'час(ов)'; 
		$vtime = round($vt); }
	if($jtime<=0) $jailtime = '';
	else if(($jtime-$t)/60/60/24>1) { $jt=($jtime-$t)/60/60/24;
		$text2 = 'дней'; 
		$jailtime = round($jt); }
	else { $jt=($jtime-$t)/60/60;
		$text2 = 'час(ов)'; 
		$jailtime = round($jt); }
	if($bantime<=0) $btime = '';
	else if(($bantime-$t)/60/60/24>1) { $bt=($bantime-$t)/60/60/24;
		$text3 = 'дней'; 
		$btime = round($bt); }
	else { $bt=($bantime-$t)/60/60;
		$text3 = 'час(ов)'; 
		$btime = round($bt); }
	if($num==0) $statusban = 'Аккаунт не забанен';
	else $statusban = 'Аккаунт заблокирован';
	switch($vip)
	{
		case 0: $statusvip = 'None'; break;
		case 1: $statusvip = 'VIP 1 уровня'; break;
		case 2: $statusvip = 'VIP 2 уровня'; break;
		case 3: $statusvip = 'VIP 3 уровня'; break;
		case 5: $statusvip = 'Titan VIP'; break;
		case 6: $statusvip = 'PREMIUM VIP'; break;
		case 8: $statusvip = 'SUPREME VIP'; break;
		case 9: $statusvip = 'SOLUTION VIP'; break;
		default: $statusvip = 'Удаленная';
	}
	if($status==0) $statusid = '(<img src=http://arcanumclub.ru/smiles/smile206.gif>был в сети '.$lastlogin.')';
	else $statusid = '(<img src=http://arcanumclub.ru/smiles/smile31.gif>'.$playerid.')';
	echo'<td class = "top"><h1><a href=../pages/user?id='.$id.'>'.$nickname.'</a></h1></td></tr><tr><td class="middel">
	<div class="box"><div class="boxtitle"><a href=../pages/user?id='.$id.'>'.$nickname.'</a> '.$statusid.' </div><div class = "textstyle">';
	
	if ($num)
		echo '<p>До истечения бана<b>'.$btime.' '.$text3.'</b></p>
			  <p>&#12288;</p>';
	
	echo'<p>Уровень администратора<b>'.$admin.'</b></p>
	<p>Уровень<b>'.$level.'</b></p>
	<p>Деньги<b>'.$money.'</b></p>
	<p>Деньги(БАНК)<b>'.$bank.'</b></p>
	<p>Донат<b>'.$virmoney.'</b></p>
	<p>Fraction<b>'.$leader.'</b></p>
	<p>Rank<b>'.$rank.'</b></p>
	<p>RegIP<b><a href=/search_ip.php?ip='.$regip.'>'.$regip.'</a></b></p>
	<p>LastIP<b><a href=/search_ip.php?ip='.$lastip.'>'.$lastip.'</a></b></p>
	<p>Последняя активность<b>'.$lastlogin.'</b></p>
	<p>Регистраци аккаунта<b>'.$regdata.'</b></p>
	<p>Обнуление профиля<b>0000-00-00 00:00:00</b></p></div>
	<form style="text-align:" method = "post" action="../pages/user?name='.$nickname.'"><input type="submit" name="show_dop" value="Обновить профиль из бд сервера"/></form>
	<form style="text-align:" method = "post" action="../pages/user?name='.$nickname.'"><input type="submit" name="show_cars" value="Обновить список авто из бд сервера"/></form>
	</td></tr>';
?>

<?
    if (isset($_POST['show_dop']))
    {
        echo '<td class="middel">
        <div class="box">
        <div class="boxtitle">Доп. Информация</div>
        <p>VIP Статус<b style = "margin-left: 436px;">'.$statusvip.'</b></p>
        <p>VIP Time<b style = "margin-left: 450px;">'.$vtime.' '.$text1.'</b></p>
        <p>Статус аккаунта<b style = "margin-left: 400px;">'.$statusban.'</b></p>
        <p>Причина блокировки/ник_админа<b style = "margin-left: 289px;">'.$reason.' - '.$banadmin.'</b></p>
        <p>До разбана<b style = "margin-left: 425px;">'.$btime.' '.$text3.'</b></p>
        <p>Деморган<b style = "margin-left: 397px;">'.$jailtime.' '.$text2.'</b></p>
        <p>Реферал<b style = "margin-left: 446px;">'.$referals.'</b></p>
        <p>Отыграл часов<b style = "margin-left: 407px;">'.$playhours.'</b></p>
        <p>Реальный донат<b style = "margin-left: 403px;">'.$donat.'</b></p>
        <br>Недвижимость:
        <p>Дом(а)<b style = "margin-left: 457px;">';
        
        $result = $base_server->query("SELECT * FROM  houses WHERE BINARY  `Owner`='$nickname'"); 
        while($row = mysqli_fetch_array($result))
        echo 'ID:[ <a href=../pages/houselogs?id='.$row['ID'].'><b>' .$row['ID']. '</b></a> ]  </pre>';
        ?>
        <? echo '</a></b><br>Бизнес(ы)<b style = "margin-left: 440px;">' ?>
        <?
        $result= $base_server->query("SELECT * FROM  businesses WHERE BINARY  `Owner`='$nickname'"); 
        while($row = mysqli_fetch_array($result))
        echo 'ID:[ <a href=/logsbusiness.php?id='.$row['ID'].'><b>' .$row['ID']. '</b></a> ]  </pre>';
        echo '</div>';
    }
    if (isset($_POST['show_cars']))
    {
        echo '</p><tr><td class="middel"><div class="box"><div class="boxtitle">Авто</div>';
        echo '<br>';
        $result= $base_server->query("SELECT * FROM  ownable WHERE BINARY  `Owner`='$nickname'");
        while($row = mysqli_fetch_array($result))
        
		switch($row['Model'])
        {
        	case $row['Model']: 
				$idcar = file_exists('../img/vehicle/'.$row['Model'].'.jpg') ? ''.$row['Model'].'.jpg' : 'noveh.gif';
        		echo '<a href=../pages/carlog?id='.$row['ID'].'><img border="0" src="../img/vehicle/'.$idcar.'" width="204" height="125" alt=""></a><li>'.$SAMP_VEHICLE_NAME[SAMP_GET_VEHICLE_NAME($row['Model'])].'</li></pre>    ';
        		break;
        }
		
        echo '<p>' .$row['Model']. '</p></pre></td>';
    }
?>

<tr>
<td class="middel">
	<div class="box">
		<div class="boxtitle">Время</div>
		
		<form action="../pages/user">
			<p>Укажите дату
			<input type="date" name="date" id="date">
			<br>День
			<input type="hidden" name="name" value= "<? echo $nickname; ?>">
			<input type="hidden" name="type" value= "<? echo $_GET['type']; ?>">
			<br>
			<input type="submit" value="Показать"></p>
		</form>
		

		<div class="TableTimeBlock">
		<?
			$sql = $base_logs -> query("SELECT DATE_FORMAT(`Date`, '%Y-%m-%d (%H:%i:%S)'), DATE_FORMAT(`Date`, '%Y-%m-%d') AS date_create FROM $TABLE_LOG WHERE Text LIKE '%>$nickname</a>%' GROUP BY date_create ORDER BY `Date` DESC;");
		
			$Date_DESC = array();
			$Time_DESC = array();

			while ( $data = mysqli_fetch_array($sql) )
			{
				if ( !in_array($data[1], $Date_DESC, TRUE) )
				{
					if (count($Date_DESC) >= 40) break;

					array_push($Date_DESC, $data[1]);
					echo '<a href = "../pages/user?id='.$id.'&date='.$data[1].'"><li>'.$data[0].'</li></a>';
				}
			}
		?>
		</div>
		
	</div>
</td>

<?
  echo '<tr>
    <td class="middel"><div class="box">
    <div class="boxtitle">'.Config::DB_NAME_LOG.'</div>
    <a href=../pages/user?id='.$id.'&type=all><li>Все</li></a>
    <a href=../pages/user?id='.$id.'&type=ban_unban><li>Бан / Разбан</li></a>
    <a href=../pages/user?id='.$id.'&type=login><li>Входы</li></a>
    <a href=../pages/user?id='.$id.'&type=report><li>Репорт</li></a>';
?>
<?
	echo 'Resource id #2';
	switch($_GET['type'])
    {
        case "ban_unban": $str = "SELECT * FROM ".$TABLE_LOG." WHERE BINARY `Text` LIKE '%>$nickname</a>%' AND `Text` LIKE '%забанил%' ORDER BY Date DESC"; break;
        case "login": $str = "SELECT * FROM ".$TABLE_LOG." WHERE BINARY `Text` LIKE '%>$nickname</a>%' AND ((`Text` LIKE '%вошёл%') OR (`Text` LIKE '%вышел%') OR (`Text` LIKE '%неудачный вход%')) ORDER BY Date DESC"; break;
        case "report": $str = "SELECT * FROM ".$TABLE_LOG." WHERE BINARY `Text` LIKE '%>$nickname</a>%' AND `Text` LIKE '%ответил%' ORDER BY Date DESC"; break;
        default: $str = "SELECT * FROM ".$TABLE_LOG." WHERE BINARY `Text` LIKE '%>$nickname</a>%' AND (DATE(Date) <= NOW() AND Date >= DATE_SUB(NOW(), INTERVAL 7 DAY)) ORDER BY Date DESC";
    }
	
	$date = $_GET['date'];
	
	if (isset($date))
		$str = "SELECT * FROM ".$TABLE_LOG." WHERE BINARY `Text` LIKE '%>$nickname</a>%' AND Date LIKE '%$date%' ORDER BY Date DESC";
	
	$result = $base_logs -> query($str);
	
    while( $row = mysqli_fetch_array($result) )
	{
	  echo '<p>'.$row['Date'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$row['Text'].'</p></pre>';
	}
?>
	
</table>
</div></div></body>

