<?php
	\Painel::preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));

	if(!isset($view))
		die('404 Forbidden');

?>
<section class="cadastro">
	<div class="container box">
		<h2><i class="fa fa-pencil"></i> Inscreva-se</h2>
		<form method="post" enctype="multipart/form-data">
			<input type="text" name="email" placeholder="Email" value="<?php echo \Painel::recoverPost('email'); ?>">
			<input type="text" name="nome" placeholder="Nome completo" value="<?php echo \Painel::recoverPost('nome'); ?>">
			<input type="text" name="usuario" placeholder="Nome de usuário" value="<?php echo \Painel::recoverPost('usuario'); ?>">
			<input type="password" name="senha" placeholder="Senha">
			<p>Escolha sua foto de perfil:</p>
			<input type="file" name="img">
			<input type="submit" name="cadastro" value="Cadastre-se">
		</form>
		<?php 
			if(isset($arr['erro']) && $arr['erro'] !== '')
				\Painel::alert('erro', $arr['erro']);
		?>
	</div><!--cointainer-->
</section><!--cadastro-->
