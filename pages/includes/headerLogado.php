<?php
	\Painel::preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME'])); 

	if(!isset($view))
		die('404 Forbidden');

	if(Painel::logado() === false)
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
<header style="padding: 0; box-shadow: none;">
	<div class="container">
		<div style="margin-top: 8px;" class="logo"><a href="<?php echo INCLUDE_PATH; ?>">Kamy</a></div><!--logo-->
		<div class="btn-opt-menu">
			<?php $amount = \models\solicitacoesModel::totalSolicitacoes(); ?>
			<a style="background: transparent;" href="<?php echo INCLUDE_PATH; ?>solicitacoes">Solicitações(<?php echo $amount; ?>)</a>
			<a style="background: transparent;" href="<?php echo INCLUDE_PATH; ?>comunidade">Comunidade</a>
			<a href="<?php echo INCLUDE_PATH; ?>me/?sair"><i class="fa fa-times"></i> Sair</a>
		</div><!--fbtn-opt-menu-->
		<div class="clear"></div><!--clear-->
	</div><!--container-->
</header>



