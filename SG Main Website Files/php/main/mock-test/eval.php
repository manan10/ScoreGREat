<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $question = $_SESSION['ques'];
    $section = $_SESSION['section'];
    $id = $_SESSION['que'];
    
    if($_SESSION['setid'] == 1)
        $userAnss = json_decode($_SESSION['set1']);
    else if($_SESSION['setid'] == 2)
        $userAnss = json_decode($_SESSION['set2']);
    else if($_SESSION['setid'] == 3)
        $userAnss = json_decode($_SESSION['set3']);
    else if($_SESSION['setid'] == 4)
        $userAnss = json_decode($_SESSION['set4']);
    else if($_SESSION['setid'] == 5)
        $userAnss = json_decode($_SESSION['set5']);
    
    $userAns = [];
    $userAns['que'] = $id;
    
    if(strcmp($section,"ques_math")==0){
        $sel_ans = $_POST['ans'];
        $ans = $_POST['ans1'];
        
        $userAns['ans'] = $sel_ans;
        
        if(strcmp($sel_ans, $ans)==0){
            $result = "Correct";
        }
        else{
            $result="Incorrect";
        }
    }    
    else{
        $userAns['ans'] = [];
        if($_POST['noofop']=='6'){
           if(isset($_POST['ans']) && is_array($_POST['ans'])) {
        		$i=0;
        		foreach($_POST['ans'] as $selected) {
        			$sel_ans[$i] = $selected;
        			$i++; 
        		}
        	}
            
    	    $ans1 = $_POST['ans1'];
    	    $ans2 = $_POST['ans2'];
    	    
    	    $userAns['ans'][0] = $sel_ans[0];
    	    $userAns['ans'][1] = $sel_ans[1];
    	    
    	    if(((strcmp($sel_ans[0],$ans1)==0)||(strcmp($sel_ans[0],$ans2)==0))&&((strcmp($sel_ans[1],$ans1)==0)||(strcmp($sel_ans[1],$ans2)==0))){
                $result = "Correct";
            }
            else{
                $result="Incorrect";
            }
        }
        else{
            $sel_op1 = $_POST['ans1'];
            $sel_op2 = $_POST['ans2'];
            $sel_op3 = $_POST['ans3'];
            $ans1 = $_POST['ans4'];
    	    $ans2 = $_POST['ans5'];
    	    $ans3 = $_POST['ans6'];
    	    
    	    $userAns['ans'][0] = $sel_op1;
    	    $userAns['ans'][1] = $sel_op2;
    	    $userAns['ans'][2] = $sel_op3;
    	    
    	    if((strcmp($sel_op1,$ans1) == 0)&&(strcmp($sel_op2,$ans2) == 0)&&(strcmp($sel_op3,$ans3) == 0))
        		$result = "Correct";
        	else
        		$result = "Incorrect";
        }
    }
    $userAns['result'] = $result;
    
    array_push($userAnss, $userAns);
    if($_SESSION['setid'] == 1)
        $_SESSION['set1'] = json_encode($userAnss);
    else if($_SESSION['setid'] == 2)
        $_SESSION['set2'] = json_encode($userAnss);
    else if($_SESSION['setid'] == 3)
        $_SESSION['set3'] = json_encode($userAnss);
    else if($_SESSION['setid'] == 4)
        $_SESSION['set4'] = json_encode($userAnss);
    else if($_SESSION['setid'] == 5)
        $_SESSION['set5'] = json_encode($userAnss);
    
    if((strcmp($result,"Correct") == 0)){
         $_SESSION['correct'] = $_SESSION['correct']+1;
    }
    
    if($_SESSION['q-marked'] == 0) {
        $_SESSION['counter'] = $_SESSION['counter']+1;
        $sques = json_decode($_SESSION[strcmp($_SESSION['section'], 'ques_math') == 0 ? 'm-ques' : 'v-ques']);
        array_shift($sques);
        $_SESSION[strcmp($_SESSION['section'], 'ques_math') == 0 ? 'm-ques' : 'v-ques'] = json_encode($sques);
        header('Location: mock-test.php');
    }
    else {
        $rques = json_decode($_SESSION['r-ques'], true);
        for($i=0;$i<count($rques);$i++) {
            $q = $rques[$i];
            foreach($q as $key => $value) {
                if(strcmp($key, "qid") == 0) {
                    if($value == $_GET['m-id']) {
                        array_splice($rques, $i, 1);
                    }
                }
            }
        }
        $_SESSION['r-ques'] = json_encode($rques);
        header('Location: set-view.php');
    }
?>