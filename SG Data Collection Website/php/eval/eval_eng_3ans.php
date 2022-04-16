<?php

	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}

	$sel_op1 = $_POST['op1'];
	$sel_op2 = $_POST['op2'];
	$sel_op3 = $_POST['op3'];
	$que_id = $_POST['queid'];
	$ans1 = $_POST['answer1'];
	$ans2 = $_POST['answer2'];
	$ans3 = $_POST['answer3'];
	$timest = $_POST['timestamp'];
	$diff = $_POST['diff'];
	$user = $_SESSION['uid'];

	if((strcmp($sel_op1,$ans1) == 0)&&(strcmp($sel_op2,$ans2) == 0)&&(strcmp($sel_op3,$ans3) == 0))
		$result = 1;
	else
		$result = 0;

	try {
	    $conn = new PDO("mysql:host=project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;dbname=scoregreat","admin","admin1234");
	 
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO verbal_data VALUES ('".$que_id."','".$user."','".$result."','".$diff."','".$timest."')";
	    
	    $conn->exec($sql);
	    
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;	      
	header('Location: ../eng_3ans.php');
?>