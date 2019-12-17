<?php  
	namespace controllers;
	use \views\mainView;
	use \models\perfilModel;
	use \models\solicitacoesModel;

	class solicitacoesController {

		private $perfilModel;
		private $solicitacoesModel;
		private $mainView;

		public function __construct() {
			$this->perfilModel 		 = new perfilModel();
			$this->mainView    		 = new mainView();
			$this->solicitacoesModel = new solicitacoesModel();
		}

		public function index() {
			if(\Painel::logado() === false)
				\Painel::redirect(INCLUDE_PATH); 

			if(isset($_GET['sair'])) {
				$this->perfilModel->loggout();
				\Painel::redirect(INCLUDE_PATH);
			}

			if(isset($_GET['aceitar'])) {
				$idSolicitacao = (int)$_GET['aceitar'];
				$this->solicitacoesModel->aceitarSolicitacao($idSolicitacao);
			} else if(isset($_GET['rejeitar'])) {
				$idSolicitacao = (int)$_GET['rejeitar'];
				$this->solicitacoesModel->rejeitarSolicitacao($idSolicitacao);
			}

			$this->mainView::render('solicitacoes', ['solicitacoes' => $this->solicitacoesModel], 'headerLogado.php');
		}


	}

?>