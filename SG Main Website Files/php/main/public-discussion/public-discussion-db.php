<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $que = $_POST['que'];
    $username = $_SESSION['name'];
    $email = $_SESSION['email'];

    try {
	    $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $stmt = $conn->prepare("INSERT INTO scoregreat.public_discussion_data (que,username,email) VALUES (:QUE, :NAME, :EMAIL);");
	    $stmt->bindParam(":QUE", $que, PDO::PARAM_STR);
	    $stmt->bindParam(":NAME", $username, PDO::PARAM_STR);
	    $stmt->bindParam(":EMAIL", $email, PDO::PARAM_STR);
	    $stmt->execute();
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;
	header('Location: public-discussion.php');
?>