<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $username = $_SESSION['name'];
    $email = $_SESSION['email'];

    try {
	    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
        $stmt = $con->prepare("SELECT * FROM scoregreat.awa_data WHERE awaid=:ID");
        $stmt->bindParam(":ID", $_COOKIE['c-row'], PDO::PARAM_INT);
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
	    
        if(isset($_POST['rating'])){
            if($_POST['rating'] > 0){
                if($row['rating'] > 0) {
                    $row['rating'] = (($_POST['rating'] + $row['rating']) / 2);
                }
                else{
                    $row['rating'] = $_POST['rating'];   
                }
            }
        }
	    
	    $sql = "UPDATE scoregreat.awa_data SET rating=" . round($row['rating'], 2) . " WHERE awaid='" . $_COOKIE['c-row'] . "';";
	    $con->exec($sql);
	    $cmnts = json_encode($cmnts);
	    $stmt = $con->prepare("UPDATE scoregreat.awa_data SET comments=:CMNTS WHERE awaid=:ID;");
        $stmt->bindParam(":ID", $_COOKIE['c-row'], PDO::PARAM_INT);
        $stmt->bindParam(":CMNTS", $cmnts, PDO::PARAM_STR);
        $stmt->execute();
	        
    }
	catch(PDOException $e)
    {
    	echo $sql . "<br>" . $e->getMessage();
    }

	$con = null;
	header('Location: awa-particular-review.php?propic='.$_GET['propic']);
?>