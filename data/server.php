<? 
	include '../inc/header.php'; 

	if (isset($_GET['selec_serv']))
	{
		switch ($_GET['selec_serv'])
		{
			case 0: $_SESSION["server"] = 'logs'; break;
			case 1: $_SESSION["server"] = 'supremenew';
		}
	}
?>

	<td class="middel">
	<div class="box"><div class="boxtitle">Выбор DB:</div>
		<li><a href = /pages/server?selec_serv=0>DB #1 [name: logs, size ~= 10kk, last active: 27.08.2021]</a></li>
		<li><a href = /pages/server?selec_serv=1>DB #2 [name: supremenew, NEWDB, create: 27.08.2021]</a></li>
	
	<? 
		if (isset($_GET['selec_serv']))
			echo '<br><a>Вы выбрали базу: '.$_SESSION["server"].'</a>';
	?>
	</div>

<? $base_logs -> close(); $base_server -> close(); ?>