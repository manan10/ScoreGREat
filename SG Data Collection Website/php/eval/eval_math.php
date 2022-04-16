<?php

	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}
	
	$sel_op = $_POST['op'];
	$que_id = $_POST['queid'];
	$ans = $_POST['answer'];
	$timest = $_POST['timestamp'];
	$diff = $_POST['diff'];
	$user = $_SESSION['uid'];

	if(strcmp($sel_op, $ans)==0)
		$result = 1;
	else
		$result = 0;

	try {
	    $conn = new PDO("mysql:host=project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;dbname=scoregreat","admin","admin1234");
	 
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO math_data VALUES ('".$que_id."','".$user."','".$result."','".$diff."','".$timest."')";
	    
	    $conn->exec($sql);
	    
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;	      
	header('Location: ../math.php');
?>