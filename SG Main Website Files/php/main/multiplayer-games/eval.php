<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $question = $_SESSION['ques'];
    $id = $_SESSION['que'];
    
    $_SESSION['counter'] = $_SESSION['counter']+1;
    
    $sel_ans = $_POST['ans'];
    $ans = $_POST['ans1'];
    if(strcmp($sel_ans, $ans)==0)
        $_SESSION['correct'] = $_SESSION['correct']+1;
         
    if($_SESSION['game']==1)     
        header('Location: wp.php');
    else
        header('Location: btc.php');
?>    
    