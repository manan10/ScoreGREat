<?php 
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $con->prepare("select friends from scoregreat.user_friends where id=:ID or id=:ID1");
    $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindParam(":ID1", $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();
    $friends = $stmt->fetchAll();
   
    if(intval($_SESSION['userid']) < intval($_POST['id'])){
        $yourfriends = $friends[0]['friends'];
        $otherfriends = $friends[1]['friends'];
    }
    else{
        $yourfriends = $friends[1]['friends'];
        $otherfriends = $friends[0]['friends'];
    }
    
    $newfriends = json_decode($yourfriends);
    array_splice($newfriends,array_search($_POST['id'], $newfriends),1);
    $newfri = json_encode($newfriends);
    
    $newfriends1 = json_decode($otherfriends);
    array_splice($newfriends1,array_search($_SESSION['userid'], $newfriends1),1);
    $newfri1 = json_encode($newfriends1);
    
    $stmt = $con->prepare("update scoregreat.user_friends set friends=:FRIENDS where id=:ID");
    $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->bindParam(":FRIENDS", $newfri, PDO::PARAM_STR);
    $stmt->execute();
    
    $stmt = $con->prepare("update scoregreat.user_friends set friends=:FRIENDS where id=:ID");
    $stmt->bindParam(":ID", $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(":FRIENDS", $newfri1, PDO::PARAM_STR);
    $stmt->execute();
?>    