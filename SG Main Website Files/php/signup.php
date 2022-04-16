<?php 
	try {
	    $mscore = "[0]";
	    $conn = new PDO("mysql:host=project.czr79hmop85p.ap-south-1.rds.amazonaws.com;db=scoregreat","admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("select count(*) from scoregreat.users_main");
        $stmt->execute();
        $row = $stmt->fetch();
        $id =  $row['count(*)'] + 1;
        
        $stmt = $conn->prepare("select id from scoregreat.users_main where EMAIL = :EMAIL");
        $stmt->bindParam(":EMAIL", $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        
        if(!isset($row['id'])) {
    	    $stmt = $conn->prepare("INSERT INTO scoregreat.users_main (id,FNAME,LNAME,EMAIL,PWD) VALUES (:ID,:FNAME, :LNAME, :EMAIL, :PWD);");
    	    
    	    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    	    $stmt->bindParam(":FNAME", $_POST['fname'], PDO::PARAM_STR);
    	    $stmt->bindParam(":LNAME", $_POST['lname'], PDO::PARAM_STR);
    	    $stmt->bindParam(":EMAIL", $_POST['email'], PDO::PARAM_STR);
    	    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    	    $stmt->bindParam(":PWD", $pwd, PDO::PARAM_STR);
    	    $stmt->execute();
    	    
    	    $stmt = $conn->prepare("INSERT INTO scoregreat.users_score (id,email,mscore,mqscore,mvscore) VALUES (:ID,:EMAIL, :SCORE,:SCORE,:SCORE);");
    	    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    	    $stmt->bindParam(":EMAIL", $_POST['email'], PDO::PARAM_STR);
    	    $stmt->bindParam(":SCORE", $mscore, PDO::PARAM_STR);
    	    $stmt->execute();
    	    
    	    $stmt = $conn->prepare("INSERT INTO scoregreat.user_friends (id) VALUES (:ID);");
    	    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    	    $stmt->execute();
    
    	    $conn = null;
    	    header('Location: ../index.html');
        }
        else {
            echo "<script> alert('User already exist!!!'); window.open('./../index.html', '_self'); </script>";
        }
	}
	catch(PDOException $e)
    {
    	//echo $sql . "<br>" . $e->getMessage();
    }
?>