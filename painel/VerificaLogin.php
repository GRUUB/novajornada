<?php	
	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['UserID']) && !isset($_SESSION['UserName'])){
		session_destroy();
		header("Location: login.php");
		exit;
	}
?>