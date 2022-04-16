<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../../index.html');

    $queid = $_POST['que'];
    $username = $_SESSION['name'];
    $essay = $_POST['content'];
    $email = $_SESSION['email'];

    try {
	    $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	 
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $stmt = $conn->prepare("INSERT INTO scoregreat.awa_data (queid,username,essay,email) VALUES (:ID, :NAME, :CONTENT, :EMAIL);");
	    $stmt->bindParam(":ID", $queid, PDO::PARAM_INT);
	    $stmt->bindParam(":NAME", $username, PDO::PARAM_STR);
	    $stmt->bindParam(":CONTENT", $essay, PDO::PARAM_STR);
	    $stmt->bindParam(":EMAIL", $email, PDO::PARAM_STR);
	    $stmt->execute();    
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;
	header('Location: awa.php');
?>