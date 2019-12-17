<?php
	if($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
		die('404 Forbidden');

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$autoload = function($class) {
		$class = str_replace('\\', '/', $class);
		if(file_exists('views/mainView.php'))
			require_once('views/mainView.php');
			include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH', 'http://localhost:8080/rede_social/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');
	define('BASE_DIR_PAINEL', __DIR__.'/pages');
	define('BD', array('host' => 'localhost', 'dbname' => 'socialnetwork_kamy', 'root' => 'root', 'password' => ''));
	

?>