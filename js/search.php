<?

	$check_post = array(
		
		'name',
        'VIP', 
        'level_0', 
        'level_1',
		'money_0',
		'money_1',
		'bank_0',
		'bank_1',
		'deposit_0',
		'deposit_1',
		'az_rub_0',
		'az_rub_1',
		'az_coin_0',
		'az_coin_1',
		'IP'
    );
	
    include '../inc/config.php';
    
	$base_logs = new mysqli(Config::DB_HOST_LOG, Config::DB_USER_LOG, Config::DB_PASS_LOG, Config::DB_NAME_LOG) or die("Ошибка BD #2!");
	$base_logs -> query("SET character_set_results = utf8");  
	$base_logs -> query("SET NAMES 'utf8'");
    
	session_start();
	
	$TABLE_LOG = Config::DB_LOG_TABLE;
	
	if (isset($_COOKIE[hash]))
	{
	    
	    $result = $base_logs -> query("SELECT user_id FROM coookie WHERE hash = '".$_COOKIE[hash]."' LIMIT 1; ");
	    
	    $data = mysqli_fetch_array($result);
	    
	    $sql = "SELECT * FROM user WHERE id = '".$data[user_id]."' LIMIT 1;";
	    
	    $result -> close();
	    
	    $result = $base_logs -> query($sql);
	    
	    $cookie = mysqli_fetch_assoc($result);
	    
	    $result -> close();
	    
	    $ip = explode( (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ':') == true ? ':':'.' ), $_SERVER['HTTP_X_FORWARDED_FOR'] );
		
		$cookie[ip] = $ip[0].'^'.$ip[1].'^'.$ip[2];
		
	    $sign = hash('sha512', implode ( '|', $cookie ), false);
	       
	    if ($sign !== $_COOKIE[hash])
	    {
	        $base_logs -> query("DELETE FROM coookie WHERE hash = '".$_COOKIE[hash]."'");
	        setcookie("hash", "", time() - 30, "/", "", 1);
	        unset($_SESSION['account_log_name']);
    		unset($_SESSION['account_log_password']);
    		session_destroy();
    		header('Location: ../login/'); 
    		die();
	    }
	}
    else
	{
	    die('#Auth close connection.');
	}
	
	$base_logs -> close();
	
?>

<style>
	
	
	.table {
	width: 100%;
	margin-bottom: 20px;
	border: 1px solid #dddddd;
	border-collapse: collapse; 
}
.table th {
    color: #FFF;
	font-weight: normal;
	padding: 5px;
	background: #4676D7;
	border: 1px solid #dddddd;
}
.table td {
	border: 1px solid #dddddd;
	padding: 5px;
	text-align: center;
}

.table a {

	color: #000;
	text-decoration: none;
	font-size: 15px;
}

</style>

<center>
<table class="table">
	<thead>
		<tr>
			<th>Ник</th>
			<th>Админ ур.</th>
			<th>Телефон</th>
			<th>Level</th>
			<th>LastIP</th>
			<th>RegIP</th>
			<th>Auth/Reg</th>
			<th>Деньги</th>
			<th>AZ-Coins</th>
			<th>Донат счет</th>
			<th>ID VK</th>
		</tr>
	</thead>
	<tbody>
	    
<?
	
    $base = new mysqli(Config::DB_HOST_SERVER, Config::DB_USER_SERVER, Config::DB_PASS_SERVER, Config::DB_NAME_SERVER) or die("Ошибка BD #2!");
	$base -> query("SET character_set_results = utf8");  
	$base -> query("SET NAMES 'utf8'");
    
    for ($i = 0; $i < count($check_post); $i++) {
		
        $Search[$check_post[$i]] = $base -> real_escape_string(stripslashes(htmlspecialchars(trim($_POST[$check_post[$i]]))));
    
	}
	
	function separation_get($str)
	{
		if (($str == 'SELECT `ID`, `NickName`, `TelNum`, `Level`, `LastIP`, `RegIP`, `Money`, `Bank`, `Deposit`, `Vkontakte`, `Roubles`, `VirMoney`, `Admin`, `LastLogin`, `datareg` FROM accounts WHERE'))
			return ' ';
		
		return ' AND ';
	}
	
	$SQL = 'SELECT `ID`, `NickName`, `TelNum`, `Level`, `LastIP`, `RegIP`, `Money`, `Bank`, `Deposit`, `Vkontakte`, `Roubles`, `VirMoney`, `Admin`, `LastLogin`, `datareg` FROM accounts WHERE';

	if ( $_POST[name] !== '')
	{
		$SQL .= separation_get($SQL)."`NickName` LIKE BINARY('%$_POST[name]%')";
	}
	
	if ( $_POST[VIP] != 0)
	{
		$SQL .= separation_get($SQL)."`VIP` = '$_POST[VIP]'";
	}
	
	if ( isset($_POST[phone]) && $_POST[phone] != 0)
	{
		$SQL .= separation_get($SQL)."`TelNum` LIKE '%$_POST[phone]%'";
	}
	
	if ( $_POST[level_0] != 0)
	{
		$SQL .= separation_get($SQL)."`Level` >= $_POST[level_0]";
	}
	
	if ( $_POST[level_1] != 0)
	{
		$SQL .= separation_get($SQL)."`Level` <= $_POST[level_1]";
	}
	
	if ($_POST[money_0] != 0)
	{
		$SQL .= separation_get($SQL)."`Money` >= $_POST[money_0]";
	}
	
	if ($_POST[money_1] != 0)
	{
		$SQL .= separation_get($SQL)."`Money` <= $_POST[money_1]";
	}
	
	if ($_POST[bank_0] != 0)
	{
		$SQL .= separation_get($SQL)."`Bank` >= $_POST[bank_0]";
	}
	
	if ($_POST[bank_1] != 0)
	{
		$SQL .= separation_get($SQL)."`Bank` <= $_POST[bank_1]";
	}
	
	if ($_POST[deposit_0] != 0)
	{
		$SQL .= separation_get($SQL)."`Deposit` >= $_POST[deposit_0]";
	}
	
	if ($_POST[deposit_1] != 0)
	{
		$SQL .= separation_get($SQL)."`Deposit` <= $_POST[deposit_1]";
	}
	
	if ($_POST[az_rub_0] != 0)
	{
		$SQL .= separation_get($SQL)."`Roubles` >= $_POST[az_rub_0]";
	}
	
	if ($_POST[az_rub_1] != 0)
	{
		$SQL .= separation_get($SQL)."`Roubles` <= $_POST[az_rub_1]";
	}
	
	if ($_POST[az_coin_0] != 0)
	{
		$SQL .= separation_get($SQL)."`VirMoney` >= $_POST[az_coin_0]";
	}
	
	if ($_POST[az_coin_1] != 0)
	{
		$SQL .= separation_get($SQL)."`VirMoney` <= $_POST[az_coin_1]";
	}
	
	if ($_POST[IP] !== '')
	{
		$SQL .= separation_get($SQL)."(`LastIP` LIKE '%$_POST[IP]%' OR `RegIP` LIKE '%$_POST[IP]%');";
	}
	
	if (separation_get($SQL) == ' ')
	{
		$base -> close();
		die('Введите хоть 1 параметр для поиска!');
	}
	
	$data = $base -> query($SQL);
	
	while ( $result = mysqli_fetch_array($data) )
	{
		echo "<tr><td><a href = '../pages/user?id=$result[ID]'>$result[NickName]</a></td>
			<td>$result[Admin]</td>
			<td>$result[TelNum]</td>
			<td>$result[Level]</td>
			<td>$result[LastIP]</td>
			<td>$result[RegIP]</td>
			<td>$result[LastLogin] / $result[datareg]</td>
			<td>$result[Money]$ / $result[Bank]$ / $result[Deposit]$</td>
			<td>$result[VirMoney]</td>
			<td>$result[Roubles]₽</td>
			<td><a href = 'https://vk.com/id$result[Vkontakte]'>$result[Vkontakte]</a></td></tr>";
			
		$NickNames .= "
		$result[NickName]";
	}
	
	$base -> close();

	echo '</tbody></table>
</center>';

	echo '<br /><br />Всего найдено аккаунтов: '.$data -> num_rows;
	
	die();

?>