<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $username = $_SESSION['name'];
    $email = $_SESSION['email'];

    try {
	    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
        $stmt = $con->prepare("SELECT * FROM scoregreat.public_discussion_data WHERE pdid=:ID");
        $stmt->bindParam(":ID", $_COOKIE['c-row'], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
	    
	    if($row['answers'] != null) {
	        $cmnts = json_decode($row['answers'], true);
	    }
	    else {
	        $cmnts = [];
	    }
	    
	    if(!empty($_POST['cmnt'])) {
            $cmntss = array(["username" => $_SESSION['name'], "value" => $_POST['cmnt']]);
            $cmnts = array_merge($cmnts, $cmntss);
	    }
	    
	    $cmnts = json_encode($cmnts);
	    
	    $stmt = $con->prepare("UPDATE scoregreat.public_discussion_data SET answers=:ANS WHERE pdid=:ID;");
	    $stmt->bindParam(":ANS", $cmnts, PDO::PARAM_STR);
        $stmt->bindParam(":ID", $_COOKIE['c-row'], PDO::PARAM_INT);
        $stmt->execute();
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$con = null;
	header('Location: pd-particular-que.php?propic='.$_GET['propic']);
?>