<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
        
    $section = $_SESSION['section'];
    
    if($_SESSION['counter'] == $_SESSION['set-size']){
        header('Location: set-marks.php');
    }
    

    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $diffi=$_SESSION['difficulty'];
    
    if(strcmp($diffi,"adaptive")==0){
       $flag=0;
       while($flag==0){
           $nextq = $_SESSION['nextq'];
           if(strcmp($nextq,"easyq")==0){
                $difficult = ["mediumq","hardq","vhardq"];
                $ques = json_decode($_SESSION['easyq']);
                $flag=1;
                
                if(count($ques) == 0){
                    $_SESSION['nextq'] = $difficult[mt_rand(0,2)];
                    $flag=0;
                }
           } 
           else if(strcmp($nextq,"mediumq")==0){
                $difficult = ["easyq","hardq","vhardq"];
                $ques = json_decode($_SESSION['mediumq']);
                $flag=1;
                
                if(count($ques) == 0){
                    $_SESSION['nextq'] = $difficult[mt_rand(0,2)];
                    $flag=0;
                }
           }
           else if(strcmp($nextq,"hardq")==0){
                $difficult = ["mediumq","easyq","vhardq"];
                $ques = json_decode($_SESSION['hardq']);
                $flag=1;
                
                if(count($ques) == 0){
                    $flag=0;
                    $_SESSION['nextq'] = $difficult[mt_rand(0,2)];
                }
           }
           else{
                $difficult = ["easyq","hardq","mediumq"];
                $ques = json_decode($_SESSION['vhardq']);
                $flag=1;
                
                if(count($ques) == 0){
                    $flag=0;
                    $_SESSION['nextq'] = $difficult[mt_rand(0,2)];
                }
           }
       }
       $id = $ques[0];
    }
    else{
        $sques = json_decode($_SESSION['sques']);
        $id = $sques[$_SESSION['counter']];
    }
    $_SESSION['que'] = $id;
    
    if(strcmp($_SESSION['section'],"ques_math")==0){    
        $str="SELECT * FROM scoregreat.ques_math where id = :ID";
    }
    else{
        $str="SELECT * FROM scoregreat.ques_verbal where id = :ID";
    }
    $stmt = $con->prepare($str);
    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    
    $options = json_decode($row['opt']);
    
    if((strcmp($_SESSION['section'],"ques_math")==0)){
        $validform = "checkmath()";
    }
    else{
        if(count($options)==9){
            $validform = "checkverbal9()";
        }
        else{
            $validform = "checkverbal6()";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Practice</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <style>

            body {
                font-family: 'Raleway', sans-serif;
                font-size: large;
                font-weight: 700;
                background-color: rgba(228, 228, 228, 0.4);
            }

            nav {
                background-image: linear-gradient(to right, #e6e600, #ffa31a); 
            }
            
            nav > a > span, .chat-popup > span {
            	font-family: 'Kaushan Script', cursive;
            	font-weight: 550;
            	font-size: x-large;
            }

            .number{
                font-family: Source Serif Pro;
            }
            
            a, a:hover {
                color: black;
            }
            
            #home:hover{
                background-color:#ffa31a;
                color:black;
            }
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            .form-check {
                width: 90% !important;
            }
            
            #notes > form > button {
                font-size: large;
            }

            .chat-popup {
                display: none;
                position: fixed;
                top: 170px;
                right: 20px;
                background-image: linear-gradient(to right, #e6e600, #ffa31a);
                z-index: 9;
                border-radius: 10px;
            }
            
            .note-popup {
                display: none;
                position: fixed;
                top: 170px;
                right: 20px;
                border: 0;
                border-radius: 10px;
            }

            .btn-calc-note {
                border-radius: 10px;
            }

            .calc-btns {
                background-color: black;
                color: white;
                border: 0;
                border-radius: 5px;
                width: 45px;
                font-size: larger;
            }

            #history-scr {
                text-align: right;
                display: flex; 
                width: 100%; 
                height: 30px; 
                border: 0; 
                border-radius:7px 7px 0 0;
                font-size: larger;
                background-color: silver;
            }

            #cal-scr {
                text-align: right;
                display: flex; 
                width: 100%; 
                height: 50px; 
                border: 0; 
                border-radius: 0 0 7px 7px;
                font-size: x-large;
            }

            button:disabled {
                background-color: rgba(32, 32, 32, 0.85);
            }
 
            @media screen and (min-width: 768px) {
                li > a:hover, li > .active, .dropdown-item:hover {
                    background-color: black;
                    color: white;
                    border-radius: 5px;
                }
            }
            
            @media screen and (max-width: 767px) {
                li {
                    width: 100%;
                }
                .chat-popup {
                    top:200px;
                } 
            }
            
            .form-check{
                font-family:Source Serif Pro;
            }
        </style>
    </head>
    
    <body class="bg-light">
        <nav class="navbar navbar-expand-md shadow sticky-top" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="../dashboard.php">
                <img src="./../../../image/logo.png" alt="Logo" style="width:45px;"><span class="mx-2">Score GREat</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class='fas fa-ellipsis-v' style="font-size:24px"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                       <a class="nav-link"  id="home" href="practice-dashboard.php">Home</a>   
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="./../multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
                                <a class="dropdown-item" href="./../saved-notes/saved-notes.php">Saved Notes</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"> 
                        <div class="dropdown">
                            <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                                <span class="ml-2">
                                    <?php echo $_SESSION['name']; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../my-profile/my-profile.php"><i class='fas fa-user-circle pr-2'></i>My Profile</a>
                                <a class="dropdown-item" href="./../../logout.php"><i class='fas fa-sign-out-alt pr-2'></i> Log Out</a>
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
        
           
        <div class="container py-4 mx-auto mt-5">
            <form action="eval.php" onsubmit="return <?php echo $validform;?>" method="POST">
                <div class="form-group">
                    <label for="que"><b class="number">Question <?php echo ($_SESSION['counter'] + 1); ?></b></label>
                     <div class='float-right'>
                     <?php 
                         if(strcmp($_SESSION['section'],"ques_math")==0){
                            echo"<button type='button' class='btn btn-success btn-calc-note shadow-lg pt-2'><i class='fas   fa-calculator' style='font-size: larger;'></i></button>
                                 <button type='button' class='btn btn-danger btn-calc-note shadow-lg pt-2'><i class='fas fa-sticky-note' style='font-size: larger;'></i></button>";
                         }
                         else{
                             echo "<button type='button' class='btn btn-danger btn-calc-note shadow-lg pt-2'><i class='fas fa-sticky-note' style='font-size: larger;'></i></button>";
                         }
                    ?>    
                     </div>
                    <p></p>
                   
                    <textarea class="form-control mt-1 py-2 number" name="que" rows="1" id="que" readonly><?php   
                        if((strcmp($_SESSION['section'],"ques_verbal")==0)&&(count($options)==6)){
                            echo $row['ques']."  (Choose the 2 most appropriate options.)";
                        }
                        else{
                             echo $row['ques'];
                        }
                        $_SESSION['ques'] = $row['ques'];
                            
                        echo "</textarea></div>";
                
                        
                       if(strcmp($_SESSION['section'],"ques_math")==0){
                            shuffle($options);
                            for($o = 0; $o < count($options); $o++) {
                                echo "<div class='form-check ml-3'>
                                        <label class='form-check-label' for='ans'>
                                            <input type='radio' class='form-check-input' name='ans' value='" . $options[$o]. "'> &nbsp;" . $options[$o]."
                                        </label>
                                    </div>";
                            }
                            echo "<input type='hidden' name='ans1' value='".$row['ans']."'>";
                            
                       }
                       else if(strcmp($_SESSION['section'],"ques_verbal")==0){
                            $answers = json_decode($row['ans']);
                            if(count($options)==6){
                                shuffle($options);
                                for($o = 0; $o < count($options); $o++) {
                                    echo "<div class='form-check ml-3'>
                                            <label class='form-check-label' for='ans'>
                                                <input type='checkbox' class='form-check-input' name='ans[]' value='" . $options[$o]. "'> &nbsp;" . $options[$o]."
                                            </label>
                                        </div>";
                                }
                                echo "<input type='hidden' name='ans1' value='" .$answers[0]."'>";
                                echo "<input type='hidden' name='ans2' value='" .$answers[1]. "'>";
                                echo "<input type='hidden' name='noofop' value='6'>";
                            }
                            else{
                                echo "<div class='row'>
                                        <div class='col-md-4'>
                                            <br>
                                             <p>Blank (i)</p>";
                                 
                                for($o = 0; $o < 9; $o++) {
                                    if($o < 3)
                                        $opt1[$o] = $options[$o];
                                    else if($o > 2 && $o < 6)
                                        $opt2[$o-3] = $options[$o];
                                    else
                                        $opt3[$o-6] = $options[$o];
                                }       
                                
                                shuffle($opt1);
                                for($o = 0; $o < 3; $o++) {
                                    echo "<div class='form-check ml-3'>
                                                <label class='form-check-label' for='ans1'>
                                                    <input type='radio' class='form-check-input' name='ans1' value='" .$opt1[$o]. "'> &nbsp;" .$opt1[$o] . "
                                                </label>
                                            </div>";
                                }  

                                echo "</div>
                                    <div class='col-md-4'>
                                        <br>
                                        <p>Blank (ii)</p>";
                                
                                shuffle($opt2);
                                for($o = 3; $o < 6; $o++) { 
                                    echo "<div class='form-check ml-3'>
                                                <label class='form-check-label' for='ans1'>
                                                    <input type='radio' class='form-check-input' name='ans2' value='" .$opt2[$o-3]. "'> &nbsp;" .$opt2[$o-3] . "
                                                </label>
                                            </div>";
                                }

                                echo "</div>
                                    <div class='col-md-4'>
                                        <br>
                                        <p>Blank (iii)</p>";
                                shuffle($opt3);
                                for($o = 6; $o < 9; $o++) { 
                                    echo "<div class='form-check ml-3'>
                                                <label class='form-check-label' for='ans1'>
                                                    <input type='radio' class='form-check-input' name='ans3' value='" .$opt3[$o-6]. "'> &nbsp;" .$opt3[$o-6]. "
                                                </label>
                                            </div>";
                                }

                                echo "</div>
                                    </div>";

                                echo "<input type='hidden' name='ans4' value='" . $answers[0]. "'>";
                                echo "<input type='hidden' name='ans5' value='" . $answers[1]. "'>";
                                echo "<input type='hidden' name='ans6' value='" . $answers[2]. "'>";    
                                echo "<input type='hidden' name='noofop' value='9'>";

                            }
                       }
                       $con = null;
                       
                    ?>

                    <button type="submit" class="btn my-4 float-right" style="color: white; background-color: black; width: 120px;"><span>Next&nbsp;</span>  <i class='fas fa-angle-right'></i></button>
                    <?php 
                        if(strcmp($_SESSION['difficulty'],"random")==0){
                               echo '<button type="button" class="btn my-4" onclick="end()" style="color: white; background-color: black; width: 120px;">Submit</button>';
                               echo '<input type="hidden" name="timestamp">';
                           }
                    ?>       
            </form>
        </div>

        
        <div class="chat-popup p-3" id="calculator" style="font-family: 'teko';">
            <span style="color: black;">Score GREat</span>
            <button class="px-0 float-right" type="button" style="background-color: rgba(0, 0, 0, 0); border: 0;">
                <i class='far fa-window-close' style="font-size:28px"></i>
            </button>
            <input class="px-2 number" type="text" id="history-scr" readonly>
            <input class="px-2 number" type="text" id="cal-scr" value="0" readonly>
            <div class="row px-4 pt-2 mt-1">
                <button type="button" class="calc-btns" value="clear">C</button>
                <button type="button" class="ml-3 calc-btns" value="root">ROOT</button>
                <button type="button" class="ml-3 calc-btns" value="mod">MOD</button>
                <button type="button" class="ml-3 calc-btns" value="delete">DEL</button>
            </div>
            <div class="row px-4 pt-2 mt-1">
                <button type="button" class="calc-btns" value="1">1</button>
                <button type="button" class="ml-3 calc-btns" value="2">2</button>
                <button type="button" class="ml-3 calc-btns" value="3">3</button>
                <button type="button" class="ml-3 calc-btns" value="add">+</button>
            </div>
            <div class="row px-4 pt-2 mt-1">
                <button type="button" class="calc-btns" value="4">4</button>
                <button type="button" class="ml-3 calc-btns" value="5">5</button>
                <button type="button" class="ml-3 calc-btns" value="6">6</button>
                <button type="button" class="ml-3 calc-btns" value="sub">-</button>
            </div>
            <div class="row px-4 pt-2 mt-1">
                <button type="button" class="calc-btns" value="7">7</button>
                <button type="button" class="ml-3 calc-btns" value="8">8</button>
                <button type="button" class="ml-3 calc-btns" value="9">9</button>
                <button type="button" class="ml-3 calc-btns" value="multi">*</button>
            </div>
            <div class="row px-4 pt-2 mt-1">
                <button type="button" class="calc-btns" value=".">.</button>
                <button type="button" class="ml-3 calc-btns" value="0">0</button>
                <button type="button" class="ml-3 calc-btns" value="ans">=</button>
                <button type="button" class="ml-3 calc-btns" value="div">/</button>
            </div>
        </div>
        <iframe src="notes.html" class="note-popup" id="notes" height="260"></iframe>
    </body>
    <script src="../../../js/calculator.js"></script>
    <script>
    
        st = Number(Date.now());
        
        function checkmath(){
			var a=$("input[name=ans]:checked").val()
			if(a==null){
				alert("Please select an option.")
				return false;
			}
		}
		
		function checkverbal6(){
		    var cb = $("input[name='ans[]']:checked");
		    if(cb.length>2){
		        alert("Select Only 2 options");
		        return false;
		    }
		    if(cb.length<2){
		        alert("Select 2 options");
		        return false;
		    }
		    if(cb.length==2){
		        return true;
		    }
		    
		}
		
		function checkverbal9(){
			var a=$("input[name=ans1]:checked").val()
			var b=$("input[name=ans2]:checked").val()
			var c=$("input[name=ans3]:checked").val()
			if(a==null || b==null || c==null){
				alert("Please select one option for every blank")
				return false;	
			}
			return true;
		}
		
		function end()
		{
			et=Number(Date.now());
			var dif=0;
			dif = et - st;
			$("input[name=timestamp]").val(dif);
		}
			
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });

            $("textarea").height($("textarea")[0].scrollHeight);
            
            $(".fa-calculator").parent().click(function(){
                $("#calculator").css("display", "block");
                $(".btn-calc-note").hide();
            });
            
            $(".fa-sticky-note").parent().click(function(){
                $("#notes").css("display", "block");
                $(".btn-calc-note").hide();
            });

            $(".fa-window-close").click(function(){
                $("#calculator").css("display", "none");
                $("#notes").css("display", "none");
                $(".btn-calc-note").show();  
            });
        });        
    </script>
</html>