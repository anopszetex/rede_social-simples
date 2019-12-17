<?php  
	namespace models;

	class perfilModel {

		public function loggout() {
			setcookie('lembrar_login', 'true', time() - 1, '/');
			setcookie('username', 'true', time() - 1, '/');
			setcookie('password', 'true', time() - 1, '/');
			session_unset();
			session_destroy();
			\Painel::redirect(INCLUDE_PATH);
		}

		public function userData($user_id) {
			$sql = \MySql::conectar()->prepare('SELECT * FROM `tb_site.membros` WHERE id = ?');
			$sql->execute(array($user_id));
			return $sql->fetch();
		}

		public static function UserIdByUsername($username) {
			$sql = \MySql::conectar()->prepare('SELECT id FROM `tb_site.membros` WHERE usuario = ?');
			$sql->execute(array($username));
			return $sql->fetch()['id'];
		}

		public function listarAmigos() {
			$sql = \MySql::conectar()->prepare('SELECT * FROM `tb_site.solicitacoes` WHERE (id_to = ? AND status = 1) OR
				 (id_from = ? AND status = 1)');
			$sql->execute(array($_SESSION['user_id'], $_SESSION['user_id']));
			$sql = $sql->fetchAll();

			$arr 	   = [];
			$idMembro  = $_SESSION['user_id'];
			foreach($sql as $membros) {
				if($membros['id_from'] == $idMembro) {
					$arr[] = $membros['id_to'];
				 } else {
					$arr[] = $membros['id_from'];
				}
			}
			return $arr;
		}

		public function listarPosts() {
			$sql = \MySql::conectar()->prepare('SELECT * FROM `tb_site.feed` ORDER BY id DESC ');
			$sql->execute();
			return $sql->fetchAll();
		}

	}

?>