<?php  
	namespace controllers;
	use \views\mainView;
	use \models\comunidadeModel;

	class comunidadeController {
		
		private $mainView;
		public $comunidadeModel;

		public function __construct() {
			$this->comunidadeModel = new comunidadeModel();
			$this->mainView    	   = new mainView();
		}

		public function index() {
			if(\Painel::logado() === false)
				\Painel::redirect(INCLUDE_PATH);

			if(isset($_GET['addFriend'])) {
				$idAmigo = (int)$_GET['addFriend'];
				if($this->amigoPendente($idAmigo) === false) {
					$this->comunidadeModel->solicitarAmizade($idAmigo);
					\Painel::redirect(INCLUDE_PATH.'comunidade');
				}
			} else if(isset($_GET['delFriend'])) {
				$idAmigo = (int)$_GET['delFriend'];
				if($this->amigoPendente($idAmigo) === true) {
					$this->comunidadeModel->removerAmizade($idAmigo);
					\Painel::redirect(INCLUDE_PATH.'comunidade');
				}
			} else if(isset($_GET['removeFriend'])) {
				$idAmigo = (int)$_GET['removeFriend'];
				if($this->amigoPendente($idAmigo) === false) {
					$this->comunidadeModel->removerLista($idAmigo);
					\Painel::redirect(INCLUDE_PATH.'comunidade');
				}
			}

			$this->mainView::render('comunidade', ['controller' => $this], 'headerLogado.php');
		}

		public function amigoPendente($idAmigo) {
			$query = "SELECT id FROM `tb_site.solicitacoes` WHERE (id_from = ? AND id_to = ? AND status = 0) OR
					  (id_from = ? AND id_to = ? AND status = 0)";
			$sql   = \MySql::conectar()->prepare($query);
			$sql->execute(array($_SESSION['user_id'], $idAmigo, $idAmigo, $_SESSION['user_id']));
			if($sql->rowCount() == 1)
				return true;
				return false;
		}

		public function amigoVerifica($idAmigo) {
			$query = "SELECT id FROM `tb_site.solicitacoes` WHERE (id_from = ? AND id_to = ? AND status = 0)";
			$sql   = \MySql::conectar()->prepare($query);
			$sql->execute(array($_SESSION['user_id'], $idAmigo));
			if($sql->rowCount() == 1)
				return true;
				return false;
		}

		public function isFriend($idAmigo) {
			$query = "SELECT id FROM `tb_site.solicitacoes` WHERE (id_from = ? AND id_to = ? AND status = 1) OR 
					 (id_from = ? AND id_to = ? AND status = 1)"; 
			$sql   = \MySql::conectar()->prepare($query);
			$sql->execute(array($_SESSION['user_id'], $idAmigo, $idAmigo, $_SESSION['user_id']));
			if($sql->rowCount() == 1)
				return true;
				return false;
		}


	}

?>