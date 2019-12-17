<?php
	if($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
		die('404 Forbidden');

	if(!isset($view))
		die('404 Forbidden');

	$user = $arr['perfil']->userData($_SESSION['user_id']);
?>


<section class="perfil-info">
	<div style="max-width: 1280px;" class="container">
		<div class="w30">
			<h2 class="title"><?php echo $user['nome']; ?></h2>
			<div class="container-img">
				<img src="<?php echo INCLUDE_PATH; ?>pages/includes/uploads/<?php echo $user['imagem']; ?>">
			</div><!--container-img-->
			<div class="lista-amigos">
				<?php 
					$amigos = $arr['perfil']->listarAmigos();
					if(is_array($amigos) or is_object($amigos)) {
				?>
				<h3><i class="fa fa-users" aria-hidden="true"></i> Minhas amizades (<?php echo count($amigos); ?>)</h3>
				<?php
					foreach($amigos as $value) {
					$membros = $arr['perfil']->userData($value);
				?>

				<div class="img-single-amigo">
					<div style="background-image: url('<?php echo INCLUDE_PATH.'pages/includes/uploads/'.$membros['imagem']; ?>');" class="img-single-amigo-wraper">
					</div><!--img-single-amigo-wrapper-->
				</div><!--img-single-amigo-->

				<?php } } ?>
				<div class="clear"></div><!--clear-->
			</div><!--lista-amigos-->
		</div><!--w40-->

	</div><!--container-->
</section><!--perfil-info w40-->

<section class="feed">
	<div style="max-width: 1280px;" class="container">
		<div class="w70">
			<h2 class="title">O que está pensando hoje?</h2>
			<form method="post">
				<textarea name="mensagem"></textarea>
				<input type="submit" name="feed_post" value="Publicar">
			</form>
			<!--feed-->
			<br />
			<?php  
				$postsFeed = $arr['perfil']->listarPosts();
				foreach($postsFeed as $key => $value) {
				$membros   = $arr['perfil']->userData($value['membro_id']);

				if($membros['id'] != $_SESSION['user_id']) {
					$query = "SELECT id FROM `tb_site.solicitacoes` 
							  WHERE (id_from = ? AND id_to = ? AND status = 1) OR
							  	    (id_from = ? AND id_to = ? AND status = 1)";
					$sql   = \MySql::conectar()->prepare($query);
					$sql->execute(array($_SESSION['user_id'], $value['membro_id'], $value['membro_id'], $_SESSION['user_id']));
					if ($sql->rowCount() == 0)
						continue;
				}
			?>

			<div class="post-single-user">
				<div class="img-user-post">
					<img src="<?php echo INCLUDE_PATH; ?>pages/includes/uploads/<?php echo $membros['imagem']; ?>">
				</div><!--img-user-post-->
				<div class="post-user-single">
					<p style="color: blue;"><?php echo $membros['nome']; ?></p>
					<p><?php echo $value['post']; ?></p>
				</div><!--post-user-single-->
				<div class="clear"></div><!--clear-->
			</div><!--post-single-user-->
			<?php  } ?>
		</div><!--w70-->
	</div><!--container-->
</section><!--feed-->