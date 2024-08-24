<?php
    
    $check_post = array(
        'find-text', 
        'Type', 
        'search_0',
        'search_1',
        'dateInput',
        'timeInput',
        'Showed'
    );
    
    include '../inc/config.php';
    
    $base_logs = new mysqli(Config::DB_HOST_LOG, Config::DB_USER_LOG, Config::DB_PASS_LOG, Config::DB_NAME_LOG) or die("Ошибка BD #2!");
	$base_logs -> query("SET character_set_results = utf8");  
	$base_logs -> query("SET NAMES 'utf8'");
    
    for ($i = 0; $i < count($check_post); $i++) {
        
        $Search[$check_post[$i]] = $base_logs -> real_escape_string(stripslashes(htmlspecialchars(trim($_POST[$check_post[$i]]))));
    }
    
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
	    $user = $_SESSION["account_log_name"];
	    $password = $_SESSION["account_log_password"];
	
	    $sql = "SELECT * FROM user WHERE login = '".$user."' AND password = '".$password."'";
	}
	
	$query = $base_logs -> query($sql);
	
    $row = mysqli_num_rows($query);
	
	$data = mysqli_fetch_array($query);
	
	$subscription = $data['sub'];
	
	if (!$row && $_SERVER['SCRIPT_NAME'] !== '/login/') 
	{
		unset($_SESSION['account_log_name']);
		unset($_SESSION['account_log_password']);
		session_destroy();
		die('#Auth close connection.');
	}
	
	else if ($row && $subscription < time() && $_SERVER['SCRIPT_NAME'] !== '/pages/subscription.php')
	{
		die('#Auth close connection.');
	}
	
    settype($Search[search_0], 'integer');
    settype($Search[search_1], 'integer');
    
    $date = date_create( $_POST[dateInput].' '.$_POST[timeInput] );
    
    if ($_POST[timeInput] !== '' AND $_POST[dateInput] !== '')
        $date = date_format($date, 'Y-m-d H:i');
    else if ($_POST[timeInput] !== '' AND $_POST[dateInput] == '')
        $date = date_format($date, 'H:i');
    else if ($_POST[timeInput] == '' AND $_POST[dateInput] !== '')
        $date = date_format($date, 'Y-m-d');
    else
        $date = '';
    
    switch ($Search[Type])
    {
        case '1':
        {
            $result = $base_logs -> query("SELECT * FROM ".Config::DB_LOG_TABLE." WHERE Text LIKE '%".$Search['find-text']."%' AND Date LIKE '%$date%' ORDER BY Date ".($Search[Showed] == 2 ? 'ASC':'DESC')." LIMIT $Search[search_0],$Search[search_1]; ");
            break;
        }
        
        case '2':
        {
            $result = $base_logs -> query("SELECT * FROM ".Config::DB_LOG_TABLE." WHERE Text LIKE '%".$Search['find-text']."%' AND Type = '5' AND Date LIKE '%$date%' ORDER BY Date ".($Search[Showed] == 2 ? 'ASC':'DESC')." LIMIT $Search[search_0],$Search[search_1]; ");
            break;
        }
        
        case '99':
        {
            $result = $base_logs -> query("SELECT * FROM ".Config::DB_LOG_TABLE." WHERE Text LIKE '%".$Search['find-text']."%' AND Type = '5' AND Date LIKE '%$date%' ORDER BY Date ".($Search[Showed] == 2 ? 'ASC':'DESC')." LIMIT $Search[search_0],$Search[search_1]; ");
            break;
        }
        
        default:
        {
            die('Invalid SearchId');
        }
    }
    
    while($getLink = mysqli_fetch_array($result))
    {
        $str .="<p>$getLink[Date] - $getLink[Text]</p>";
    }
    
    $i = $result -> num_rows;
    
    $str .="<br />Показаны строки с $Search[search_0] до $i";
    
    die($str);
?>