<?php  
	namespace models;

	class homeModel {

		public function create($table, $fields = array()) {
			$columns = implode(',', array_keys($fields));
			$values  = ':'.implode(', :', array_keys($fields));
			$sql 	 = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
			if($sql  = \MySql::conectar()->prepare($sql)) {
				foreach($fields as $key => $values) {
					$data[':'.$key] = $values;
				}
				$sql->execute($data);
				return \MySql::conectar()->lastInsertId();
			}
		}

		public function login($email, $senha) {
			$sql   = \MySql::conectar()->prepare('SELECT id FROM `tb_site.membros` WHERE ? IN (usuario, email) AND (senha = ?)');
			$sql->execute(array($email, md5($senha)));
			if($sql->rowCount() > 0) {
				$infoUsuario 		 = $sql->fetch();
				$user_id 			 = $infoUsuario['id'];
				$_SESSION['user_id'] = $user_id;
				$_SESSION['logged']  = true;
				setcookie('lembrar_login', true, time() + (3600*24*30*12*1), '/');
				setcookie('username', $email, time() + (3600*24*30*12*1), '/');
				setcookie('password', $senha, time() + (3600*24*30*12*1), '/');
				\Painel::redirect(INCLUDE_PATH.'me');
			} else {
				return false;
			}
		}

		public function checkEmail($email) {
			$sql = \MySql::conectar()->prepare('SELECT email FROM `tb_site.membros` WHERE email = ?');
			$sql->execute(array($email));
			if($sql->rowCount() > 0)
				return true;
				return false;
		}

		public function checkUsername($usuario) {
			$sql = \MySql::conectar()->prepare('SELECT usuario FROM `tb_site.membros` WHERE usuario = ?');
			$sql->execute(array($usuario));
			if($sql->rowCount() > 0)
				return true;
				return false;
		}

	}

?>