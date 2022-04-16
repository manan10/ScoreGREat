<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');

    $question = $_SESSION['ques'];
    $section = $_SESSION['section'];
    $id = $_SESSION['que'];
    
    if(strcmp($section,"ques_math")==0){
        $sel_ans = $_POST['ans'];
        $ans = $_POST['ans1'];
        
        if(strcmp($sel_ans, $ans)==0){
            $result = "Correct";
        }
        else{
            $result="Incorrect";
        }
    }    
    else{
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
    	    
    	    if((strcmp($sel_op1,$ans1) == 0)&&(strcmp($sel_op2,$ans2) == 0)&&(strcmp($sel_op3,$ans3) == 0))
        		$result = "Correct";
        	else
        		$result = "Incorrect";
        }
    }
   
    $_SESSION['counter'] = $_SESSION['counter']+1;
    if((strcmp($result,"Correct") == 0)){
         $_SESSION['correct'] = $_SESSION['correct']+1;
    }
    
    if((strcmp($_SESSION['difficulty'],"random") == 0)){
        
        $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    if(strcmp($result,"Correct")==0){
	        $myresult = 1;
	    }
	    else{
	         $myresult = 0;
	    }
	    
        if((strcmp($section,"ques_math") == 0)){
            $sql = "INSERT INTO scoregreat.math_data VALUES ('".$id."','".$myresult."','".$_POST['timestamp']."')";
        }
        else{
            $sql = "INSERT INTO scoregreat.verbal_data VALUES ('".$id."','".$myresult."','".$_POST['timestamp']."')";
        }
        $conn->exec($sql);
        $conn = null;
    }
    else if(strcmp($_SESSION['difficulty'],"adaptive") == 0){
        if(strcmp($_SESSION['nextq'],"easyq")==0){
            $myques = json_decode($_SESSION['easyq']);
            if(!is_null($myques)){
                array_shift($myques);
                $_SESSION['easyq'] = json_encode($myques);
            }
            if(strcmp($result,"Correct")==0)
                $_SESSION['nextq']="mediumq";
        }
        else if(strcmp($_SESSION['nextq'],"mediumq")==0){
            $myques = json_decode($_SESSION['mediumq']);
            if(!is_null($myques)){
                array_shift($myques);
                $_SESSION['mediumq'] = json_encode($myques);
            }
            
            if(strcmp($result,"Correct")==0)
                $_SESSION['nextq']="hardq";
            else    
                $_SESSION['nextq']="easyq";
        }
        else if(strcmp($_SESSION['nextq'],"hardq")==0){
            $myques = json_decode($_SESSION['hardq']);
            if(!is_null($myques)){
                array_shift($myques);
                $_SESSION['hardq'] = json_encode($myques);
            }
            
            if(strcmp($result,"Correct")!=0)
                $_SESSION['nextq']="mediumq";
            else    
                $_SESSION['nextq']="vhardq";
        }
        else{
            $myques = json_decode($_SESSION['vhardq']);
            if(!is_null($myques))
                array_shift($myques);
                $_SESSION['vhardq'] = json_encode($myques);
            
            if(strcmp($result,"Incorrect")==0)
                $_SESSION['nextq']="hardq";
        }
    }
?>

<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Practice</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <style>
           body {
                font-family: 'Raleway', sans-serif;
                font-size: large;
                font-weight: 700;
                background-color: #ffffff;
            } 
            
            #link,#link:hover{
                color:white;
                text-decoration:none;
                border-bottom-right-radius:10px;
                border-bottom-left-radius:10px;
            }
            
            .number{
                font-family: Source Serif Pro;
            }
            
            #main{
               margin-top:150px;
            }
            
            .card{
                width:70%;
            }
            
            .card-body{
                background-color:#ffffff;
            }
            @media screen and (max-width: 767px) {
                #main{
                    margin-top:80px;
                }    
                .card{
                    width:95%;
                }
                .card-body{
                    background-color:#ffffff;
                }
            }    
        </style>
    </head>

    <body>
        <div class="container" id="main">
            <div class="card my-5 mx-auto shadow-lg" style="border-radius: 10px !important;">
                <div class="p-3 shadow text-center" style="font-size: larger;background-image: linear-gradient(to right, #e6e600, #ffa31a); border-radius: 10px 10px 0 0;">Result</div>
                <div class="card-body container" style="line-height: 1.8;">
                    <div class="text-center p-2 number"><?php echo $question; ?></div>
                    <div class="text-center pt-2 number">
                        Result : &nbsp;&nbsp;&nbsp;&nbsp; <?php
                                    if(strcmp($result,"Correct") == 0)
                                        echo "<span class='badge badge-success' style='font-size: large'>" . $result . "</span>";
                                    else
                                        echo "<span class='badge badge-danger' style='font-size: large'>" . $result . "</span>";
                                 ?><br><br>
                        <?php
                            if(strcmp($section,"ques_math")==0){
                                echo "Your Answer : &nbsp;&nbsp;     <b>" . $sel_ans . "</b><br>";
                                echo "Correct Answer :&nbsp;&nbsp;      <b>" . $ans . "</b>";
                            }    
                            else{
                                if($_POST['noofop']=='6'){
                                    echo "Your Answer :&nbsp;&nbsp; <b> ".$sel_ans[0]."</b>  , <b> ".$sel_ans[1]."</b>";
                                    echo "<p>Correct Answer :&nbsp;&nbsp; <b>  ".$ans1."</b>  , <b> ".$ans2."</b></p>";
                                }    
                                else{
                                     echo "Your Answer :&nbsp;&nbsp; <b> ".$sel_op1."</b>  , <b> ".$sel_op2."</b>  , <b> ".$sel_op3."</b>";
                                     echo "<p>Correct Answer :&nbsp;&nbsp; <b>  ".$ans1."</b>  , <b> ".$ans2."</b>  , <b> ".$ans3."</b></p>";
                                }
                            }
                        ?>   
                    </div>
                </div>
                <a id="link" class="card-footer text-center" href="practice.php" style="background-color:#000000;">Done</a>
            </div>
        </div>
    </body>    
</html>        