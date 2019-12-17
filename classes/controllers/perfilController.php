<?php  
	namespace controllers;
	use \views\mainView;
	use \models\homeModel;
	use \models\perfilModel;

	class perfilController {

		private $model;
		private $mainView;
		private $perfilModel;

		public function __construct() {
			$this->model       = new homeModel();
			$this->mainView    = new mainView(); 
			$this->perfilModel = new perfilModel(); 
		}

		public function index() {
			if(\Painel::logado() === false)
				\Painel::redirect(INCLUDE_PATH); 

			if(isset($_GET['sair'])) {
				$this->perfilModel->loggout();
				\Painel::redirect(INCLUDE_PATH);
			}

			if(isset($_POST['feed_post'])) {
				$mensagem = \Painel::checkInput($_POST['mensagem']);
				if(!empty($mensagem)) {
					$data = ['membro_id' => $_SESSION['user_id'], 'post' => $mensagem, 'data_post' => date('Y-m-d H:i:s')];
					$this->model->create('`tb_site.feed`', $data);
				}
			}

			$this->mainView::render('me', array('perfil' => $this->perfilModel), 'headerLogado.php');
			/*$this->mainView::render('me', $this->perfilModel->userData($_SESSION['user_id']), 'headerLogado.php');*/
		}


	}

?>