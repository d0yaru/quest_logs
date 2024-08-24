<?php  
	
	include 'config.php';
	
	$base_logs = new mysqli(Config::DB_HOST_LOG, Config::DB_USER_LOG, Config::DB_PASS_LOG, Config::DB_NAME_LOG) or die("Ошибка BD #2!");
	$base_logs -> query("SET character_set_results = utf8");  
	$base_logs -> query("SET NAMES 'utf8'");
	
	$TABLE_LOG = Config::DB_LOG_TABLE;
	
	$base_server = new mysqli(Config::DB_HOST_SERVER, Config::DB_USER_SERVER, Config::DB_PASS_SERVER, Config::DB_NAME_SERVER) or die("Ошибка BD #1!");
	$base_server -> query("SET character_set_results = utf8"); 
	$base_server -> query("SET NAMES 'utf8'");
	
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
    		header('Location: ../check/authorization'); 
    		die();
	    }
	}
    else
	{
	    $user = $_SESSION["account_log_name"];
	    $password = $_SESSION["account_log_password"];
	
	    $sql = "SELECT * FROM user WHERE login = '".$user."' AND password = '".$password."'";
	}
	
	$query = $base_logs -> query($sql);
	$row = mysqli_num_rows($query);
	
	$data = mysqli_fetch_assoc($query);
	
	$subscription = $data['sub'];
	
	if (!$row && $_SERVER['SCRIPT_NAME'] !== '/check/authorization') 
	{
		unset($_SESSION['account_log_name']);
		unset($_SESSION['account_log_password']);
		session_destroy();
		header('Location: ../check/authorization'); 
		die();
	}
	
	else if (!$data[status])
	{
		die('<html><head><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"></head></html><center><b>Внимание ошибка авторизации:<br />Ваш аккаунт проходит модерацию</b><br /><a href = ../check/authorization>Вернуться на раздел авторизации</a></center>');
		
		return false;
	}
	
	$query -> close();
	
	$query = $base_logs -> query('SELECT * FROM `settings`');
	$server = mysqli_fetch_assoc($query);
	
	if (!$server[status])
	{
		include '../404/close.php';
		die();
		return false;
	}
	
	else if ($row && $subscription < time() && $_SERVER['SCRIPT_NAME'] !== '/pages/subscription.php')
	{
		header('Location: ../pages/subscription'); 
		die();
	}
	
?>