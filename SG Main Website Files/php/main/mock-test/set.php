<?php
    session_start();
    $_SESSION['r-ques'] = json_encode([]);
    $_SESSION['q-marked'] = 0;
    $_SESSION['counter'] = 0;
    $setScore = json_decode($_SESSION['setScore']);
    if($_SESSION['setid'] > 0) {
        $setScore[$_SESSION['setid']-1] = $_SESSION['correct'];
    }
    $_SESSION['setScore'] = json_encode($setScore);
    $_SESSION['correct'] = 0;
    if($_SESSION['setid'] <= 5)
        $_SESSION['setid'] += 1;
    
    if($_SESSION['setid']==1) {
        $no = mt_rand(0, 1);
        if($no == 0) {
            $seq = [0, 1, 0, 1, mt_rand(0, 1)];   
        }
        else {
            $seq = [1, 0, 1, 0, mt_rand(0, 1)];   
        }
        $_SESSION['seq'] = json_encode($seq);
        
        $index = [];
        $a = 0;
        for($s=0;$s<5;$s++) {
            if($seq[$s] == $seq[4]) {
                $index[$a] = $s;
                $a++;
            }
        }
        
        $_SESSION['dummy'] = $index[array_rand($index)];
    }
    
    if($_SESSION['setid'] <= 5) {
        $sequence = json_decode($_SESSION['seq']);
        if($sequence[$_SESSION['setid']-1] == 0)
            $_SESSION['section']='ques_math';
        else
            $_SESSION['section']="ques_verbal";
    }    
    if($_SESSION['setid']==1 || $_SESSION['setid']==2) {
        $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if($sequence[$_SESSION['setid']-1] == 0)
            $str = "select id from scoregreat.ques_math where id > 30";
        else
            $str = "select id from scoregreat.ques_verbal where id < 40";
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
        // print_r($ques);
        if($sequence[$_SESSION['setid']-1] == 0)
            $_SESSION['m-ques'] = json_encode($ques);
        else
            $_SESSION['v-ques'] = json_encode($ques);
    }
    
    if($_SESSION['setid'] == 6) 
        header('location: set-marks.php');
    else
        header('location: set-instructions.php');
?>