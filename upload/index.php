<?
	session_start();	

	if (strpos($_SERVER['REQUEST_URI'], 'pages') == true)
	{
		$url = str_replace('/pages/', '/data/', $_SERVER['REQUEST_URI']);
		
		$url = explode('?', $url);
	
		$_SESSION['URL_ACTIVE_DATA'] = $url[0].'.php';
		
		header('Location: ../upload/?'.$url[1]);
		
		die();
	}
	else if(strpos($_SERVER['REQUEST_URI'], 'upload') == false)
	{
		include '../404/index.php';
		die();
	}
	
	include '../inc/header.php';
	
	if (isset($_SESSION['URL_ACTIVE_DATA']))
	{
		include '../inc/header_html.php';
		$path = '..'.$_SESSION['URL_ACTIVE_DATA'];
	}
	else
		$path = '../404/index.php';
		
	include $path;
	
	
	$base_logs -> close(); 
	$base_server -> close();