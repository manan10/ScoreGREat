<?php
    session_start();

	$_SESSION['section']="ques_math";
    $_SESSION['counter']=0;
    $_SESSION['correct']=0;
    
    
    if(!isset($_SESSION['difficulty'])){
        $_SESSION['difficulty'] = 'adaptive';
    }
    
    if(!isset($_SESSION['set-size'])){
        $_SESSION['set-size'] = 5;
    }
            
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(strcmp($_SESSION['difficulty'],"adaptive")==0){
        $diffi = ["easy","medium","hard","very hard"];
        $i=0;
        foreach($diffi as $diff){
            $str = "select id from scoregreat.ques_math where difficulty='".$diff."';";
            $stmt = $con->prepare($str);
            $stmt->execute();
            $rows[$i] = $stmt->fetchAll();
            $i++;
        }
        
        $vhard = [];
        for($j=0;$j<4;$j++){
            $i=0;
            foreach($rows[$j] as $row){
                if($j==0)
                    $easy[$i] = $row['id'];
                else if($j==1)
                    $medium[$i] = $row['id'];
                else if($j==2)
                    $hard[$i] = $row['id'];
                else if($j==3)
                    $vhard[$i] = $row['id'];   
                $i++;    
            }
        }
        
        shuffle($easy);
        shuffle($medium);
        shuffle($hard);
        shuffle($vhard);
        
        $_SESSION['easyq'] = json_encode($easy);
        $_SESSION['mediumq'] = json_encode($medium);
        $_SESSION['hardq'] = json_encode($hard);
        $_SESSION['vhardq'] = json_encode($vhard);
        
        $diffiq = ["easyq","mediumq","hardq","vhardq"];
        $_SESSION['nextq'] = $diffiq[mt_rand(0,2)];
    }
    else{
        if(strcmp($_SESSION['difficulty'],"random")==0){
            $str = "select id from scoregreat.ques_math where id > 30";
        }
        else{
            $str = "select id from scoregreat.ques_math where difficulty='".$_SESSION['difficulty']."'";
        }
        $stmt = $con->prepare($str);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        $ques = [];
        $i=0;
        foreach($rows as $row){
            $ques[$i] = $row['id'];
            $i++;
        }
        
        shuffle($ques);
    
        if(count($rows) < $_SESSION['set-size']){
            $_SESSION['set-size'] = count($rows);
        }
        
        $_SESSION['sques'] = json_encode($ques);
    }
    header('location:practice.php');
?>