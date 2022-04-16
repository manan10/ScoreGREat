<?php
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $con->prepare("SELECT mscore,mqscore,mvscore FROM scoregreat.users_score where EMAIL=:EMAIL");
    $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    
    $marray = json_decode($row['mscore']);
    $qarray = json_decode($row['mqscore']);
    $varray = json_decode($row['mqscore']);

    $seq = json_decode($_SESSION['seq']);
    $i = 0;
    $avgPercent = 0;
    
    $marks = 260;
    $mMarks = 130;
    $vMarks = 130;
    $ratio = 20 / $_SESSION['set-size'];
    $setScore = json_decode($_SESSION['setScore']);
    foreach($setScore as $score) {
        $percent[$i] = ($score/$_SESSION['set-size'])*100;
        if($_SESSION['dummy'] != $i) {
            $marks += $score*$ratio;
            $avgPercent += $percent[$i];
            if($seq[$i]  == 0) {
                $mMarks += $score*$ratio;
            }
            else {
                $vMarks += $score*$ratio;
            }
        }
        $i++;
    }
    $avgPercent = $avgPercent / 4;
    $_SESSION['marks']=$marks;
    $_SESSION['qmarks']=$mMarks;
    $_SESSION['vmarks']=$vMarks;
    $_SESSION['percent'] = json_encode($percent);
    $_SESSION['avgPercent'] = $avgPercent;

    array_push($marray,$marks);
    array_push($qarray,$mMarks);
    array_push($varray,$vMarks);

    if($marray[0]==0){
        array_shift($marray);
        array_shift($qarray);
        array_shift($varray);
    }
    
    $str = "update scoregreat.users_score set mscore='".json_encode($marray)."',mqscore='".json_encode($qarray)."',mvscore='".json_encode($varray)."' where EMAIL='".$_SESSION['email']."'";
    $stmt1 = $con->prepare($str);
    $stmt1->execute();
   
    header('Location:performance-review.php');
?>    