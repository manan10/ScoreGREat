<?php
	session_start();
	
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
	
	$_SESSION['set-size'] = $_POST['size'];
	
	if(!isset($_POST['diffi']))
	    $_SESSION['difficulty'] = 'easy';
	else
	    $_SESSION['difficulty'] = $_POST['diffi'];
	
	header('Location: practice-dashboard.php');
?>