<?php 
	include('config.php');
		
	$homeController         = new controllers\homeController();
	$perfilController       = new controllers\perfilController();
	$comunidadeController   = new controllers\comunidadeController();
	$soliticacoesController = new controllers\solicitacoesController();

	Router::get('/', function() use($homeController) {
		$homeController->index();
	});

	Router::get('/me', function() use($perfilController) {
		$perfilController->index();
	});

	Router::get('/comunidade', function() use($comunidadeController) {
		$comunidadeController->index();
	});

	Router::get('/solicitacoes', function() use($soliticacoesController) {
		$soliticacoesController->index();
	});

	if(Router::isExecuted() == false) {
		header('Location: '.INCLUDE_PATH);
		die();
	}

?>