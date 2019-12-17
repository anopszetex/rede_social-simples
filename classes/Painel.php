<?php  

	class Painel {

		public static function logado() {
			return isset($_SESSION['logged']) ? true : false;
		}


		public static function alert($tipo, $mensagem) {
			switch($tipo) {
				case 'sucesso';
					echo '<div class="box-alerta sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
				break;
				case 'erro';
					echo '<div class="box-alerta erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
				break;
			}
		}

		public static function redirect($url) {
			echo '<script>location.href = "'.$url.'"</script>';
			die();
		}

		public static function checkInput($var) {
			return htmlspecialchars(trim(stripcslashes($var)));
		}

		public static function alertJS($text) {
			echo '<script>alert("'.$text.'");</script>';
		}

		public static function recoverPost($post) {
			if(isset($_POST[$post]))
				echo $_POST[$post];
		}

		public static function imagemValida($imagem) {
			if($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/png' || $imagem['type'] == 'image/jpg') {
				$tamanho = intval($imagem['size']/1024);
				if($tamanho <= 999)
					return true;
				else
					return false;
			} else {
				return false;
			}
		}

		public static function uploadFile($file) {
			$formatoArquivo = explode('.', $file['name']);
			$imagemNome 	= uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];

			if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/includes/uploads/'.$imagemNome))
				return $imagemNome;
			else
				false;
		}

	}
?>