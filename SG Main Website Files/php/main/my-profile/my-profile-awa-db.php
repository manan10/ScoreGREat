<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $username = $_SESSION['name'];
    $email = $_SESSION['email'];

    try {
	    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    if(isset($_POST['cmnt'])) {
            $stmt = $con->prepare("SELECT * FROM scoregreat.awa_data WHERE awaid=:ID");
            $stmt->bindParam(":ID", $_COOKIE['p-c-row'], PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
    	    
    	    if($row['comments'] != null) {
    	        $cmnts = json_decode($row['comments'], true);
    	    }
    	    else {
    	        $cmnts = [];
    	    }
    	    
    	    if(!empty($_POST['cmnt'])) {
                $cmntss = array(["username" => $_SESSION['name'], "value" => $_POST['cmnt']]);
                $cmnts = array_merge($cmnts, $cmntss);
    	    }
    	    
    	    $cmnts = json_encode($cmnts);
    	    $stmt = $con->prepare("UPDATE scoregreat.awa_data SET comments=:CMNTS WHERE awaid=:ID;");
            $stmt->bindParam(":ID", $_COOKIE['p-c-row'], PDO::PARAM_INT);
            $stmt->bindParam(":CMNTS", $cmnts, PDO::PARAM_STR);
            $stmt->execute();
            header('Location: my-profile-awa.php');
	    }
	    else {
	        $stmt = $con->prepare("DELETE FROM scoregreat.awa_data WHERE awaid=:ID");
            $stmt->bindParam(":ID", $_COOKIE['p-c-row'], PDO::PARAM_INT);
            $stmt->execute();
            header('Location: my-profile.php');
	    }
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$con = null;
	
?>