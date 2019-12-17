<?php  
	if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
		die('404 Forbidden');
		 
	if(!isset($view))
		die('404 Forbidden'); 
?>
</body>
</html>
