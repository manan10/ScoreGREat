<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

     $title = $_POST['ntitle'];
     $content = $_POST['ntext'];
     $username = $_SESSION['name'];

     try {
	    $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	 
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $stmt = $conn->prepare("INSERT INTO scoregreat.notes (username,ntitle,ncontent) VALUES (:NAME, :TITLE, :CONTENT);");
	    $stmt->bindParam(":NAME", $username, PDO::PARAM_STR);
	    $stmt->bindParam(":CONTENT", $content, PDO::PARAM_STR);
	    $stmt->bindParam(":TITLE", $title, PDO::PARAM_STR);
		$stmt->execute();    
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;
// 	$_SESSION['que'] = $_SESSION['que']-1;
	header('Location: notes.html');    
?>     