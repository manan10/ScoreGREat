<?php 
    session_start();
    try {
	    $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	 
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("DELETE FROM scoregreat.notes WHERE noteid=:ID");
        $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(); 
    }
    catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;
?>