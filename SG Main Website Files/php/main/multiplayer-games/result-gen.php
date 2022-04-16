<?php
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
        
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $con->prepare('select * from scoregreat.games where id = :ID');
    $stmt->bindParam(":ID", $_SESSION['game-id'], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    
    if($row['round']==1 && $row['turn']==$row['p1']){
        
        $ques = json_decode($_SESSION['game-ques']);
        if($_SESSION['game'] == 2){
            $nques = [];
            $len = $_SESSION['counter'] + 10;
            for($i=0; $i < $len + 1; $i++)
                $nques[$i] = $ques[$i];
            $newques = json_encode($nques);
        } 
        $stmt = $con->prepare('update scoregreat.games set questions=:QUES where id = :ID');
        $stmt->bindParam(":ID", $_SESSION['game-id'], PDO::PARAM_INT);
        if($_SESSION['game'] == 2)
            $stmt->bindParam(":QUES", $newques, PDO::PARAM_STR);
        else{
            $nques = json_encode($ques);
            $stmt->bindParam(":QUES", $nques, PDO::PARAM_STR);
        }
         $stmt->execute();
    }
    
    if($row['p1'] == $_SESSION['userid']){
        $your = 'p1';
        $oppo = 'p2';
        $opp = $row['p2'];
        $score = $row['score_p1'] + $_SESSION['correct'];
        $stmt = $con->prepare('update scoregreat.games set score_p1=:score,turn=:turn where id = :ID');
        $stmt->bindParam(":turn", $row['p2'], PDO::PARAM_INT);
    }
    else{    
        $your = 'p2';
        $oppo = 'p1';
        $opp = $row['p1'];
        $score = $row['score_p2'] + $_SESSION['correct'];
        
        $stmt = $con->prepare('update scoregreat.games set score_p2=:score,turn=:turn,round=:round,finished=:fin where id = :ID');
        $stmt->bindParam(":turn", $row['p1'], PDO::PARAM_INT);
        
        
        if($_SESSION['game']==1){
            $round = $row['round']+1;
            $stmt->bindParam(":round", $round, PDO::PARAM_INT);
            
            if($row['round'] == 3)
                $fin = 1;
            else
                $fin = 0;
            $stmt->bindParam(":fin", $fin, PDO::PARAM_INT);
        }
        else{
            $fin = 1;
            $stmt->bindParam(":round", $row['round'], PDO::PARAM_INT);
            $stmt->bindParam(":fin", $fin, PDO::PARAM_INT);
        }
    }
    $stmt->bindParam(":ID", $_SESSION['game-id'], PDO::PARAM_INT);
    $stmt->bindParam(":score", $score, PDO::PARAM_INT);
    $stmt->execute();
    
    $stmt = $con->prepare('select finished,score_p1,score_p2 from scoregreat.games where id = :ID');
    $stmt->bindParam(":ID", $_SESSION['game-id'], PDO::PARAM_INT);
    $stmt->execute();
    $row1 = $stmt->fetch();
    
    $mssg = "Wait for Opponents Turn";
    
    if($row1['finished']==1){
        if($row1['score_p1'] > $row1['score_p2'])
            $winner = $row['p1'];
        else if($row1['score_p2'] > $row1['score_p1'])
            $winner = $row['p2'];
        else
            $winner = 0;
            
        $stmt = $con->prepare('update scoregreat.games set winner=:win where id = :ID'); 
        $stmt->bindParam(":ID", $_SESSION['game-id'], PDO::PARAM_INT);
        $stmt->bindParam(":win", $winner, PDO::PARAM_INT);    
        $stmt->execute();
        
        if($winner == $_SESSION['userid'])
            $mssg = "Congrats ! You Won.";
        else if($winner == 0)
            $mssg = "Damn ! Its a Draw";
        else
            $mssg = "Alas ! You Lost";
    }
    
    $stmt = $con->prepare('select FNAME,LNAME from scoregreat.users_main where id = :ID'); 
    $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();
    $yours = $stmt->fetch();
    
    $stmt = $con->prepare('select FNAME,LNAME from scoregreat.users_main where id = :ID'); 
    $stmt->bindParam(":ID", $opp, PDO::PARAM_INT);
    $stmt->execute();
    $opponent = $stmt->fetch();
    
    $_SESSION['mssg'] = $mssg;
    $_SESSION['yourname'] = $yours['FNAME']." ".$yours['LNAME'];
    $_SESSION['oppname'] = $opponent['FNAME']." ".$opponent['LNAME'];
    if(strcmp($your,'p1')==0){
        $_SESSION['yourscore'] = $row1['score_p1'];
        $_SESSION['oppscore'] = $row1['score_p2'];
    }
    else{
        $_SESSION['yourscore'] = $row1['score_p2'];
        $_SESSION['oppscore'] = $row1['score_p1'];
    }
    header('Location: result.php');
?>