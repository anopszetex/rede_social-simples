<?php  
	namespace views;

	class mainView {

		public static function render($fileName, $arr = [], $header = 'header.php', $footer = 'footer.php') {
			$view = true;
			include('pages/includes/'.$header);
			include('pages/'.$fileName.'.php');
			include('pages/includes/'.$footer);
			die();
		}

	}
?>