<?php

	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}

	if(!empty($_POST['op'])) {
		//$checked_count = count($_POST['op']);
		$i=0;
		foreach($_POST['op'] as $selected) {
			$sel_ans[$i] = $selected;
			$i++; 
	}

	$que_id = $_POST['queid'];
	$ans1 = $_POST['answer1'];
	$ans2 = $_POST['answer2'];
	$timest = $_POST['timestamp'];
	$diff = $_POST['diff'];
	$user = $_SESSION['uid'];
		
	if($checked_count !=2) {
		$result = 0;
	}
		else {
			if(((strcmp($sel_ans[0],$ans1)==0)&&(strcmp($sel_ans[1],$ans2)==0))||((strcmp($sel_ans[0],$ans2)==0)&&(strcmp($sel_ans[1],$ans1)==0)))
				$result = 1;
			else
				$result = 0;
		}

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
//	header('Location: ../eng.php');
?>