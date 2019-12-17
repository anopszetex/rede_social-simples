<?php  
	namespace models;

	class comunidadeModel {

		public function solicitarAmizade($idAmigo) {
			if($idAmigo != $_SESSION['user_id']) {
				$sql = \MySql::conectar()->prepare('INSERT INTO `tb_site.solicitacoes` VALUES (null,?,?,?)');
				$sql->execute(array($_SESSION['user_id'], $idAmigo, 0));
			}
		}

		public function removerAmizade($idAmigo) {
			if($idAmigo != $_SESSION['user_id']) {
				$query = "DELETE FROM `tb_site.solicitacoes` WHERE id_from = ? AND id_to = ? AND status = 0";
				$sql   = \MySql::conectar()->prepare($query);
				$sql->execute(array($_SESSION['user_id'], $idAmigo));
			}
		}

		public function removerLista($idAmigo) {
			if($idAmigo != $_SESSION['user_id']) {
				$query = "DELETE FROM `tb_site.solicitacoes` 
						  WHERE id_from = ? AND id_to = ? AND status = 1 
						  OR id_from = ? AND id_to = ? AND status = 1";
				$sql   = \MySql::conectar()->prepare($query);
				$sql->execute(array($_SESSION['user_id'], $idAmigo, $idAmigo, $_SESSION['user_id']));
			}
		}


	}

?>