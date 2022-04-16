<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
        
    if(strcmp($_SESSION['difficulty'],"easy")==0)
        $x = 2;
    else if(strcmp($_SESSION['difficulty'],"medium")==0)
        $x = 4;
    else if(strcmp($_SESSION['difficulty'],"hard")==0)
        $x = 6;
    else if(strcmp($_SESSION['difficulty'],"very hard")==0)
        $x = 8;
    else if(strcmp($_SESSION['difficulty'],"random")==0)
        $x = 5;
    else if(strcmp($_SESSION['difficulty'],"adaptive")==0)
        $x = 5;    
        
        
    
    $percent = ($_SESSION['correct']/$_SESSION['set-size'])*100;
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    $str="SELECT pscore,ppercent FROM scoregreat.users_score where EMAIL = :EMAIL";
    $stmt = $con->prepare($str);
    $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    
    if($row['ppercent']!=0)
        $npercent = ceil((ceil($percent) + $row['ppercent'])/2);
    else
        $npercent = ceil($percent);
    $nscore = $row['pscore'] + ($_SESSION['correct'] * $x);
    
    $str1 = "update scoregreat.users_score set pscore=:PSCORE,ppercent=:PPERCENT where EMAIL=:EMAIL";
    $stmt1 = $con->prepare($str1);
    $stmt1->bindParam(":PSCORE", $nscore, PDO::PARAM_INT);
    $stmt1->bindParam(":PPERCENT",$npercent, PDO::PARAM_INT);
    $stmt1->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
    $stmt1->execute();
    $con = null;

    header("Location: performance-review.php");
?>