<?php  
	namespace controllers;
	use \views\mainView;
	use \models\homeModel;

	class homeController {

		private $model;
		private $mainView;
		private $erro;

		public function __construct() {
			$this->model    = new homeModel();
			$this->mainView = new mainView(); 
		}

		public function index() {
			if(\Painel::logado() === true)
				\Painel::redirect(INCLUDE_PATH.'me');

			if(isset($_COOKIE['lembrar_login'])) {
				$email = $_COOKIE['username'];
				$senha = $_COOKIE['password'];

				$query = "SELECT id FROM `tb_site.membros` WHERE ? IN (usuario, email) AND (senha = ?)";
				$sql   = \MySql::conectar()->prepare($query);
				$sql->execute(array($email, md5($senha)));
				if($sql->rowCount() == 1) {
					$user_id 			 = $sql->fetch()['id'];
					$_SESSION['user_id'] = $user_id;
					$_SESSION['logged']  = true;
					\Painel::redirect(INCLUDE_PATH.'me');
				}
			}

			if(isset($_POST['acao_login'])) {
				$email = $_POST['user_email'];
				$senha = $_POST['password'];
				if(!empty($email) or !empty($senha)) {
					$email = \Painel::checkInput($email);
					$senha = \Painel::checkInput($senha);
					if($this->model->login($email, $senha) === false)
						\Painel::alertJS('Email ou senha incorretos!');
				}
			}

			if(isset($_POST['cadastro'])) {
				$email   = \Painel::checkInput($_POST['email']);
				$nome    = \Painel::checkInput($_POST['nome']);
				$usuario = \Painel::checkInput($_POST['usuario']);
				$senha   = \Painel::checkInput($_POST['senha']);

				if(empty($email) or empty($nome) or empty($usuario) or empty($senha)) {
					$this->erro = 'Todos os campos devem ser preenchidos!';
				} else {
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$this->erro = 'Email inválido!';
					} else if(!(strlen($nome) >= 3 && strlen($nome) <= 32)) {
						$this->erro = 'Nome completo deve ter entre 3 há 32 caracteres!';
					} else if(!(strlen($usuario) >= 3 && strlen($usuario) <= 32)) {
						$this->erro = 'Nome de usuário deve ter entre 3 há 32 caracteres!';
					} else if(!(strlen($senha) >= 6 && strlen($senha) <= 30)) {
						$this->erro = 'Sua senha deve ter entre 6 há 30 caracteres!';
					} else if(!preg_match('/^[a-zA-Z0-9]+/', $usuario)) {
						$this->erro = 'Nome de usuário inválido!';
					} else if(preg_match("/\s/", $usuario)) {
						$this->erro = 'Nome de usuário inválido!';
					} else if(!preg_match('/^[a-zA-Z0-9]+/', $nome)) {
						$this->erro = 'Nome completo não pode conter caracteres especiais!';
					} else if(\Painel::imagemValida($_FILES['img']) === false) {
						$this->erro = 'A imagem é inválida!';
					} else {
						if($this->model->checkEmail($email) === true) {
							$this->erro = 'Email já está em uso!';
						} else if($this->model->checkUsername($usuario) === true) {
							$this->erro = 'Nome de usuário já existente!';
						} else {
							$idImagem = \Painel::uploadFile($_FILES['img']); 
							$data 	  = ['usuario' => $usuario, 'nome'  => $nome,
								 	 	 'email'   => $email,	'senha' => md5($senha), 'imagem' => $idImagem];
							$this->model->create('`tb_site.membros`', $data);
							foreach($_POST as $value) $_POST = '';
							\Painel::alertJS('Cadastro realizado com sucesso');
						}
					}
					
				}
			}
			$this->mainView::render('home', array('erro' => $this->erro));
		}


	}

?>