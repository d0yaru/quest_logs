<?php
   
   $check_post = array(
        'username', 
		'email',
		'vkontakte',
        'password_0',
		'password_0'
    );
    
    $Data_get = $_POST;

    include '../inc/config.php';
    $database = @new mysqli(Config::DB_HOST_LOG, Config::DB_USER_LOG, Config::DB_PASS_LOG, Config::DB_NAME_LOG) or die("Ошибка BD #2!");

    for ($i = 0; $i < count($check_post); $i++) {
        if (!isset($Data_get[$check_post[$i]]) or $Data_get[$check_post[$i]] == '')
        {
			$database -> close();
			
            die('ER');
        }
        else
        {
            $Data_get[$check_post[$i]] = $database -> real_escape_string(stripslashes(htmlspecialchars(trim($Data_get[$check_post[$i]]))));
        }
    }
	
	$Data = json_decode(json_encode($Data_get));
	
	$sql = $database -> query("SELECT * FROM user WHERE login = BINARY('".$Data -> username."') LIMIT 1;");
	
	if (($sql -> num_rows)) {
	
		$database -> close();
		
		die('Аккаунт '.$Data -> username.' уже зарегистрирован!');
		
	}
	else
	{
		$database -> query("INSERT INTO user (`vk`, `login`, `password`, `mail`, `sub`, `ip`) VALUES ('".$Data -> vkontakte."', '".$Data -> username."', '".($Data -> password_0)."', '".$Data -> email."', '".(time() + 86400 * 30)."', '".$_SERVER['HTTP_X_FORWARDED_FOR']."')");
		$database -> close();
		
		die('YES');
	}
?>