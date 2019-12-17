<?php  
	namespace models;

	class solicitacoesModel {

		public function listarSolicitacoes() {
			$sql = \MySql::conectar()->prepare('SELECT * FROM `tb_site.solicitacoes` WHERE id_to = ? AND status = 0');
			$sql->execute(array($_SESSION['user_id']));
			return $sql->fetchAll();
		}

		public static function totalSolicitacoes() {
			$sql = \MySql::conectar()->prepare('SELECT * FROM `tb_site.solicitacoes` WHERE id_to = ? AND status = 0');
			$sql->execute(array($_SESSION['user_id']));
			return $sql->rowCount();
		}

		public function getMembroById($id) {
			$info = \MySql::conectar()->prepare('SELECT * FROM `tb_site.membros` WHERE id = ?');
			$info->execute(array($id));
			return $info->fetch();
		}

		public function aceitarSolicitacao($idSolicitacao) {
			$query 		   = "UPDATE `tb_site.solicitacoes` SET status = 1 WHERE id_from = ? AND id_to = ?"; 
			$sql   		   = \MySql::conectar()->prepare($query);
			$sql->execute(array($idSolicitacao, $_SESSION['user_id']));
			\Painel::redirect(INCLUDE_PATH.'solicitacoes');
		}

		public function rejeitarSolicitacao($idSolicitacao) {
			$query 		   = "DELETE FROM `tb_site.solicitacoes` WHERE id_from = ? AND id_to = ?"; 
			$sql   		   = \MySql::conectar()->prepare($query);
			$sql->execute(array($idSolicitacao, $_SESSION['user_id']));
			\Painel::redirect(INCLUDE_PATH.'solicitacoes');
		}

	}

?>