<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
       
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    
    $questions = json_decode($_SESSION['game-ques']);
    $id = $questions[$_SESSION['counter']];
    $_SESSION['que'] = $id ;
    
    $str="SELECT * FROM scoregreat.ques_math where id = :ID";
    $stmt = $con->prepare($str);
    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    
    $options = json_decode($row['opt']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Games</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px|Rajdhani&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="./../../../js/jquery-countdown/jquery.simple.timer.js"></script>
        
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

            a, a:hover, a.disabled {
                color: black !important;
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

            .chat-popup {
                display: none;
                position: fixed;
                top: 170px;
                right: 20px;
                background-image: linear-gradient(to right, #e6e600, #ffa31a);
                z-index: 9;
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
            
            .jst-hours {
                display: none;
            }
            
            .jst-minutes {
                float: left;
            }
            
            .jst-seconds {
                float: left;
            }
            
            .timer {
                font-family: 'Rajdhani', sans-serif;
                font-size: xx-large;
            }
            
            input[type='radio'] {
                display: none;
            }
            
            #opts label {
                background-color: #c1c1c1;
                padding: 5px 10px;
                border-radius: 8px;
                cursor: pointer;
                width: inherit;
            }
            
            #correct {
                border-width: 0 1px 0 0;
                border-color: black;
                border-style: solid;
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

    <body>
        <nav class="navbar navbar-expand-md" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="./../dashboard.php">
                <img src="./../../../image/logo.png" alt="Logo" style="width:45px;"><span class="mx-2">Score GREat</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class='fas fa-ellipsis-v' style="font-size:24px"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mg-dashboard.php">Home</a>
                    </li>    
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="./../saved-notes/saved-notes.php">Saved Notes</a>
                            </div>
                        </div>
                    </li>
                    </li>
                    <li class="nav-item"> 
                        <div class="dropdown">
                            <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                                <span class="ml-2">
                                    <?php echo $_SESSION['name']; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../../new-password/new-password.php"> Change Password</a>
                                <a class="dropdown-item" href="./../../logout.php"><i class='fas fa-sign-out-alt pr-2'></i> Log Out</a>
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
        
        <div class='float-right mr-2 mt-2' style='padding: 0px 8px 2px 8px; border: 2px inset #d6c9a4; background-color: #ffd84b;'>
            <div class=''>
                <h4 class='timer'></h4>
            </div>
        </div>
        <div class="container py-4 mx-auto mt-5">
            <form action="eval.php" method="POST">
                <div class="form-group">
                    <label for="que"><b>Question <?php echo ($_SESSION['counter'] + 1); ?></b></label>
                     <div class='float-right'>
                         <button type='button' class='btn btn-success btn-calc-note shadow-lg pt-2'><i class='fas   fa-calculator' style='font-size: larger;'></i></button>
                     </div>
                     
                    <p></p>
                   
                    <textarea class="form-control mt-1 py-2" name="que" rows="1" id="que" readonly><?php   
                        echo $row['ques'];
                        $_SESSION['ques'] = $row['ques'];
                            
                        echo "</textarea></div>";
                
                        shuffle($options);
                        echo "<div class='row justify-content-center d-flex'>";
                        for($o = 0; $o < count($options); $o++) {
                            echo "<div class='form-check col-lg-5 m-2 justify-content-center d-flex' id='opts'>
                                    <label class='form-check-label' for='opt" . ($o + 1) . "'>
                                        <input type='radio' class='form-check-input' name='ans' id='opt" . ($o + 1) . "' value='" . $options[$o]. "'> &nbsp;" . $options[$o]."
                                    </label>
                                </div>";
                        }
                        echo "</div>"; 
                        echo "<input type='hidden' id='ans1' name='ans1' value='".$row['ans']."'>";
                        $con = null;
                    ?>
                    <div class='row mt-5'>
                        <div class='col-6 col-sm-6 text-center' id='correct'>
                            <label>Correct</label>
                            <div class=''><?php echo $_SESSION['correct']; ?></div>
                        </div>
                        <div class='col-6 col-sm-6 text-center'>
                            <label>Incorrect</label>
                            <div class=''><?php echo ($_SESSION['counter'] - $_SESSION['correct']); ?></div>
                        </div>
                    </div>
                    <button type="submit" id='sBtn' style="display: none;"></button>
            </form>
        </div>

        <div class="chat-popup p-3" id="calculator" style="font-family: 'teko';">
            <span style="color: black;">Score GREat</span>
            <button class="px-0 float-right" type="button" style="background-color: rgba(0, 0, 0, 0); border: 0;">
                <i class='far fa-window-close' style="font-size:28px"></i>
            </button>
            <input class="px-2" type="text" id="history-scr" readonly>
            <input class="px-2" type="text" id="cal-scr" value="0" readonly>
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
    </body>
     <script src="../../../js/calculator.js"></script>
    <script>
        // st = Number(Date.now());
        
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });

            $("textarea").height($("textarea")[0].scrollHeight);
            $('.nav-link, .navbar-brand').addClass('disabled');
            
            $(".fa-calculator").parent().click(function(){
                $("#calculator").css("display", "block");
                $(".btn-calc-note").hide();
            });

            $(".fa-window-close").click(function(){
                $("#calculator").css("display", "none");
                $(".btn-calc-note").show();  
            });
            
            var time= sessionStorage.getItem('time');
            var now = Date.parse(new Date());
            var sec = (time-now)/1000;
            
            $('.timer').attr('data-seconds-left', sec);
            var refreshId = setInterval(function() {
                if($('.jst-seconds').text()==0 && $('.jst-minutes').text()=="00:"){
                    alert("Time's up");
                    window.open('result-gen.php','_self');
                    exitInterval();
                }
            }, 1000);
            
            function exitInterval(){
                clearInterval(refreshId);
            }
            $('.timer').startTimer();
            
            $('[name="ans"]').click(function() {
                if(!$(this).attr('disabled')) {
                    if($(this).val() === $('#ans1').val()) {
                        $(this).parent().css("background-color", "limegreen");
                    }
                    else {
                        $(this).parent().css("background-color", "red");
                    }
                }
                
                $("#sBtn").click();
                $('[name="ans"]').attr('disabled', 'disabled');
                // setTimeout(function() {
                //     $("#sBtn").click();
                // }, 500);
            });
        });        
    </script> 
</html>    