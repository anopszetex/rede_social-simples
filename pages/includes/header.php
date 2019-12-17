<?php
	\Painel::preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
		 
	if(!isset($view))
		die('404 Forbidden');

	if(Painel::logado() === true)
		Painel::redirect(INCLUDE_PATH); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kamy</title>
	<meta charset="viewport" content="width=device-width;initial-scale=1.0;maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>pages/includes/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>pages/includes/css/style.css">
</head>
<body>

<base base="<?php echo INCLUDE_PATH; ?>" />
<header>
	<div class="container">
		<div class="logo"><a href="<?php echo INCLUDE_PATH; ?>">Kamy</a></div><!--logo-->
		<div class="form-login">
			<form method="post">
				<input type="text" name="user_email" placeholder="Nome de usuário ou email">
				<input type="password" name="password" placeholder="Senha">
				<input type="submit" name="acao_login" value="Entrar">
			</form>
		</div><!--form-login-->
		<div class="clear"></div><!--clear-->
	</div><!--container-->
</header>



