<?php  

	class MySql {
		private static $pdo;

		public static function conectar() {
			if(self::$pdo == NULL) {
				try {
					self::$pdo = new PDO('mysql:host='.BD['host'].';dbname='.BD['dbname'].';charset=utf8', BD['root'], BD['password']);
				} catch(Exception $e) {
					die('<h2 style="text-align: center;">Erro ao conectar</h2>');
				}
			}
			return self::$pdo;
		}

	}

?>