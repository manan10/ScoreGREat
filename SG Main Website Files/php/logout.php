<?php 
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // $stmt = $con->prepare("UPDATE scoregreat.users_main SET isActive = 0 WHERE EMAIL=:EMAIL");
    // $stmt->bindParam(':EMAIL', $_SESSION['email'], PDO::PARAM_STR);
    // $stmt->execute();
    // $con = null;
    
    session_unset();
    session_destroy();
    header('Location: ../index.html');
?>