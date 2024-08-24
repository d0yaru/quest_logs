<? include '../inc/header.php'; ?>

<form name="search" method="post" action="search_ip.php"  id="searchform" ><tr><form name="search" method="post" >
<h1 style="text-align: center;"><font color="1168a6"><font size="6"><font face="Tahoma, Geneva, sans-serif"> </font></font></font></h1>
<p style="text-align: center;"><input maxlength="50" name="query" size="50" type="search" placeholder="Введите IP" /></p>
<form style="text-align: center;" method="GET"><center><input type="submit" name="search" value="Поиск"/></center></form><tbody></form><html>

<td class="middel"><div class="box">
<div class="boxtitle">Аккаунты с одинаковыми IP</div></td>
<?
echo '<br>
<table width="100%"><tr>
<td><b>Ник</b></td>
<td><b>Уровень</b></td>
<td><b>RegIP</b></td>
<td><b>LastIP</b></td>
<td><b>Последний вход</b></td></tr><br>';
?>

<?php
if(isset($_POST['query']) || isset($_GET['ip']))
{    
    if (isset($_GET['ip'])) { $ip = $_GET['ip']; }
    else { $ip = $_POST['query']; }

    $result = $base_server -> query("SELECT * FROM  accounts WHERE LastIP = '$ip' OR RegIP = '$ip'");

	//$nicknameAr = array();
    while($row = mysqli_fetch_array($result))
    {
		//array_push($nicknameAr, $row['NickName']);
		echo '<tr>
		<td> <a href=../pages/user?name=' .$row['NickName']. '>' .$row['NickName']. '</a></td>
		<td>'.$row['Level'].'</a></td>
		<td> <a href=/logsdbtypeipsearch.php?ip='.$row['RegIP'].'>'.$row['RegIP'].'</a></td>
		<td> <a href=/logsdbtypeipsearch.php?ip='.$row['LastIP'].'>'.$row['LastIP'].'</a></td>
		<td>'.$row['LastLogin'].'</td></tr>';
    }
	echo '</table>';
	$num = mysqli_num_rows($result);
	echo '<b>Всего аккаунтов: ' .$num. '</b>';
}
else { echo '</table>'; }

/*
$i = 0;
while ($i != count($nicknameAr)) 
{
	echo '<br>/banoff '.$nicknameAr[$i].' 2000 Взломан / Махинации';
	$i++;
}*/

?>
</div>

<? $base_logs -> close(); $base_server - close(); ?>
