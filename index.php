<?
	// Подключаем подгрузку страниц
	session_start();
	
	if (!isset($_SESSION['URL_ACTIVE_DATA']))
		$_SESSION['URL_ACTIVE_DATA'] = '/data/index.php';
	
	header('Location: /upload/');