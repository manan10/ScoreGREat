<?php 
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $con->prepare("select requests from scoregreat.user_friends where id=:ID");
    $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();
    $requests = $stmt->fetch();
    
    if($_GET['req']==1){
        if($requests['requests'] == NULL)
            $newreq = json_encode(array(intval($_SESSION['userid'])));
        else{
            $newrequest = json_decode($requests['requests']);
            array_push($newrequest,(intval($_SESSION['userid'])));
            $newreq = json_encode($newrequest);
        }
    }
    else{

        $newrequest = json_decode($requests['requests']);
        array_splice($newrequest,array_search($_SESSION['userid'], $newrequest),1);
        $newreq = json_encode($newrequest);
    }
    
    $stmt = $con->prepare("update scoregreat.user_friends set requests=:REQ where id=:ID");
    $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(":REQ", $newreq, PDO::PARAM_STR);
    $stmt->execute();
?>
