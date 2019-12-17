<?php  
	if(!isset($view))
		die('404 Forbidden');
?>
<section class="comunidade">
	<div class="container">
		<div class="w100">
			<h2 class="title">Comunidade</h2>
			<?php
				$select = MySql::conectar()->prepare('SELECT * FROM `tb_site.membros`');
				$select->execute();
				$select = $select->fetchAll();
				foreach($select as $key => $value):
				if($value['id'] == $_SESSION['user_id'])
					continue;
			?>
			<div class="membro-listagem">
				<div class="box-imagem">
					<div style="background-image: url('<?php echo INCLUDE_PATH ?>pages/includes/uploads/<?php echo $value['imagem']; ?>');" class="box-imagem-wraper"></div>
				</div><!--box-imagem-->
				<p><i class="fa fa-user"></i> <?php echo $value['nome']; ?></p>
				<?php  
					if($arr['controller']->isFriend($value['id'])) {
						echo '<a style="display:inline-block; opacity: 0.4; background: green; color: white; padding: 4px 5px;" href="'.INCLUDE_PATH.'comunidade?removeFriend='.$value['id'].'"><i class="fa fa-check"></i> Amigo</a>';

					} else if($arr['controller']->amigoPendente($value['id']) == false) {
				?>
					<a href="<?php echo INCLUDE_PATH; ?>comunidade?addFriend=<?php echo $value['id']; ?>"> Adicionar como amigo</a>
				<?php } else { ?>

					<?php if($arr['controller']->amigoVerifica($value['id']) === true) { ?>
					<a style="opacity: 0.4; background: gray;" href="<?php echo INCLUDE_PATH; ?>comunidade?delFriend=<?php echo $value['id']; ?>"> Solicitação pendente</a>
				<?php } else { ?>
					<a style="opacity: 0.4;" href="#"> Solicitação pendente</a>
				<?php } ?>
				
				<?php } ?>
			</div><!--membro-listagem-->
			<?php endforeach; ?>
			<div class="clear"></div>
		</div><!--w100-->
	</div><!--container-->
</section><!--comunidade-->