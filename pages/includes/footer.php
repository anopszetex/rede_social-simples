<?php  
	\Painel::preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__), realpath($_SERVER['SCRIPT_FILENAME']));
		 
	if(!isset($view))
		die('404 Forbidden'); 
?>
</body>
</html>
