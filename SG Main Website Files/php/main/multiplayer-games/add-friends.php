<?php 
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare("select requests from scoregreat.user_friends where id=:ID");
    $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();
    $requests = $stmt->fetch();
    
    $newrequest = json_decode($requests['requests']);
    array_splice($newrequest,array_search($_POST['id'], $newrequest),1);
    $newreq = json_encode($newrequest);
    
    if($_GET['mode']==1){
        $stmt = $con->prepare("select friends from scoregreat.user_friends where id=:ID");
        $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $yourfriends = $stmt->fetch();
        
        $stmt = $con->prepare("select friends from scoregreat.user_friends where id=:ID");
        $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
        $reqfriends = $stmt->fetch();

        if($yourfriends['friends'] == NULL)
                $newfriends = json_encode(array(intval($_POST['id'])));
        else{
            $newf = json_decode($yourfriends['friends']);
            array_push($newf,(intval($_POST['id'])));
            $newfriends = json_encode($newf);
        }
        
        $stmt = $con->prepare("update scoregreat.user_friends set friends=:FRIENDS,requests=:REQ where id=:ID");
        $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->bindParam(":FRIENDS", $newfriends, PDO::PARAM_STR);
        $stmt->bindParam(":REQ", $newreq, PDO::PARAM_STR);
        $stmt->execute();
        
        if($reqfriends['friends'] == NULL)
                $newfriends1 = json_encode(array(intval($_SESSION['userid'])));
        else{
            $newf1 = json_decode($reqfriends['friends']);
            array_push($newf1,(intval($_SESSION['userid'])));
            $newfriends1 = json_encode($newf1);
        }
        
        $stmt = $con->prepare("update scoregreat.user_friends set friends=:FRIENDS where id=:ID");
        $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
        $stmt->bindParam(":FRIENDS", $newfriends1, PDO::PARAM_STR);
        $stmt->execute();
    }
    else{
        $stmt = $con->prepare("update scoregreat.user_friends set requests=:REQ where id=:ID");
        $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->bindParam(":REQ", $newreq, PDO::PARAM_STR);
        $stmt->execute(); 
    }
?>
        