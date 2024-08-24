<?php

   $check_post = array(
        'username', 
        'password',
    );
    
    $Data_get = $_POST;
    
    include '../inc/config.php';
    $database = @new mysqli(Config::DB_HOST_LOG, Config::DB_USER_LOG, Config::DB_PASS_LOG, Config::DB_NAME_LOG) or die("Ошибка BD #2!");

    for ($i = 0; $i < count($check_post); $i++) {
        if (!isset($Data_get[$check_post[$i]]) or $Data_get[$check_post[$i]] == '')
        {
            die('ER');
        }
        else
        {
            $Data_get[$check_post[$i]] = $database -> real_escape_string(stripslashes(htmlspecialchars(trim($Data_get[$check_post[$i]]))));
        }
    }
	
	$Data = json_decode(json_encode($Data_get));
	
	$sql = $database -> query("SELECT * FROM user WHERE login = BINARY('".$Data -> username."') LIMIT 1;");
	
	if (!($sql -> num_rows)) {
	
		die('#Ошибка Аккаунта '.$Data -> username.' не существует!');
		
	}
	else
	{
		$a = mysqli_fetch_assoc($sql);
		
		if ($a[password] !== $Data -> password) {
			
			die('#Ошибка Неправильный пароль от аккаунта.');
			return false;
			
		}
		else if (!$a[status])
		{
			die('#Ошибка Аккаунт проходит модерацию.');
			return false;
		}
					
		$ip = explode( (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ':') == true ? ':':'.' ), $_SERVER['HTTP_X_FORWARDED_FOR'] );
		
		$a[ip] = $ip[0].'^'.$ip[1].'^'.$ip[2];
		
	    $sign = hash('sha512', implode ( '|', $a ), false);
	    	
	    setcookie("hash", $sign, time() + 86400 * 30, "/", "", 1);
	    	
	    $database -> query("INSERT INTO coookie (`hash`, `user_id`) VALUES ('$sign', '$a[id]')");
		
	    //$_SESSION['account_log_name']= $a[login];
		//$_SESSION['account_log_password'] =  $a[password];
		
		$database -> query("UPDATE user SET ip = '".$_SERVER['HTTP_X_FORWARDED_FOR']."' WHERE login = BINARY('".$Data -> username."') LIMIT 1;");
	
		die('YES');
	}
?>