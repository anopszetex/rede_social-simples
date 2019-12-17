<?php  
	if(!isset($view))
		die('404 Forbidden');
?>
<section class="comunidade">
<div class="container">
	<div class="w100">
		<h2 class="title">Solicitações Pendentes</h2><!--title-->
		<table class="solicitacoes-table">
		<?php
			$solicitacoesPendentes = $arr['solicitacoes']->listarSolicitacoes();
			foreach($solicitacoesPendentes as $value):
			$membro = $arr['solicitacoes']->getMembroById($value['id_from']);
		?>

		<tr>
			<td>
				<img src="<?php echo INCLUDE_PATH.'pages/includes/uploads/'.$membro['imagem']; ?>">
				<p><?php echo $membro['nome']; ?></p>
			</td>

			<td style="text-align: right;">
				<a href="<?php echo INCLUDE_PATH; ?>solicitacoes?aceitar=<?php echo $value['id_from']; ?>">Aceitar</a>
				<a href="<?php echo INCLUDE_PATH; ?>solicitacoes?rejeitar=<?php echo $value['id_from']; ?>">Rejeitar</a>
			</td>
		</tr>
		<?php endforeach; ?>

		</table>

	</div><!--w100-->
</div><!--container-->
</section><!--comunidade-->