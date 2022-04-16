<?php 
    session_start();
    $email = null;
    
    if(isset($_SESSION['email']))
        $email =  $_SESSION['email'];
    else if(isset($_SESSION['fpEmail']))
        $email =  $_SESSION['fpEmail'];
    else
        header('Location: ./../../index.html');
    
	try {
	    $conn = new PDO("mysql:host=project.czr79hmop85p.ap-south-1.rds.amazonaws.com;db=scoregreat","admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
	    $stmt = $conn->prepare("UPDATE scoregreat.users_main SET PWD = :PWD WHERE EMAIL = :EMAIL;");
	    $stmt->bindParam(":EMAIL", $_POST['email'], PDO::PARAM_STR);
	    $stmt->bindParam(":PWD", $pwd, PDO::PARAM_STR);
	    $stmt->execute();
	    $conn = null;
	    if(isset($_SESSION['email']))
            header('Location: ./../main/dashboard.php');
        else if(isset($_SESSION['fpEmail']))
            header('Location: ./../../index.html');
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }
?>