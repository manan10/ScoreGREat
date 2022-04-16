<?php 
    session_start();
    
    $sques = json_decode($_SESSION[strcmp($_SESSION['section'], 'ques_math') == 0 ? 'm-ques' : 'v-ques']);
    $rques = json_decode($_SESSION['r-ques'], true);
    
    if(!isset($_GET['time'])){
        $rque = array_shift($sques);
        $que = array(["sno" => ($_SESSION['counter']+1), "qid" => $rque]);
        $_SESSION['counter'] = $_SESSION['counter']+1;
        $rques = array_merge($rques, $que);
        $_SESSION[strcmp($_SESSION['section'], 'ques_math') == 0 ? 'm-ques' : 'v-ques'] = json_encode($sques);
        $_SESSION['r-ques'] = json_encode($rques);
    } 
    else{
        $id = $_SESSION['counter'];
        $size = $_SESSION['set-size'];
        
        for($i = $id; $i < $size ; $i++){
            $rque = array_shift($sques);
            $que = array(["sno" => ($i + 1), "qid" => $rque]);
            $rques = array_merge($rques, $que);
        }
        
        $_SESSION[strcmp($_SESSION['section'], 'ques_math') == 0 ? 'm-ques' : 'v-ques'] = json_encode($sques);
        $_SESSION['r-ques'] = json_encode($rques);
        header('Location: set-view.php?time=0');
    }
?>