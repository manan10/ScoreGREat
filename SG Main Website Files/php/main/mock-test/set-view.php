<?php
    session_start();
    $_SESSION['q-marked'] = 1;
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
        
    if($_SESSION['setid'] == 1) {
        $_SESSION['rq-set1'] = $_SESSION['r-ques'];
    }
    else if($_SESSION['setid'] == 2) {
        $_SESSION['rq-set2'] = $_SESSION['r-ques'];
    }
    else if($_SESSION['setid'] == 3) {
        $_SESSION['rq-set3'] = $_SESSION['r-ques'];
    }
    else if($_SESSION['setid'] == 4) {
        $_SESSION['rq-set4'] = $_SESSION['r-ques'];
    }
    else if($_SESSION['setid'] == 5) {
        $_SESSION['rq-set5'] = $_SESSION['r-ques'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Set View</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px|Rajdhani&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
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
            
            .list-group-item:hover{
                background-color:black;
                color:white;
                
            }
            
            .list-group-item{
                background-color:white;
                color:black;
                border-color:black;
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
                       <a class="nav-link"  id="home" href="mt-dashboard.php">Home</a>   
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
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
        
        <div class='float-right mr-4 mt-4' style='padding: 0px 8px 2px 8px; border: 2px inset #d6c9a4; background-color: #ffd84b;'>
            <div class=''>
                <h4 class='timer'></h4>
            </div>
        </div>
        
        <div class="container mt-5">
            <h2 class="my-5 text-center"><b>Marked Questions</b></h2>
            <div class="list-group m-5 text-center">
                <?php 
                    $rques = json_decode($_SESSION['r-ques'], true);
                    if(count($rques) == 0){
                        echo "<div class='text-center'>You have not marked any questions";
                    }
                    
                    for($c=0;$c<count($rques);$c++){
                        $cmnt = $rques[$c];
                        foreach($cmnt as $key => $value) {
                            if(strcmp($key, "sno") == 0) 
                                $sno = $value;
                            else if(strcmp($key, "qid") == 0)
                               $qid = $value;
                        }
                        if(!isset($_GET['time'])){
                            echo "<a href='mock-test.php?m-id=". $qid . "&sno=" . $sno . "' class='list-group-item list-group-item-action'>Question " . $sno . "</a>";
                        }
                        else{
                            echo "<a href='mock-test.php?m-id=". $qid . "&sno=" . $sno . "' class='list-group-item list-group-item-action disabled'>Question " . $sno . "</a>";
                        }
                    }
                ?>
            </div>
            <div class='mt-5 justify-content-center d-flex'>
                <a href='set.php' class='btn btn-lg' style='background-color: black; color: white'>Submit Set</a>
            </div>
            <div class='mt-3 mb-3 justify-content-center d-flex'>
                 <p class='text-ce text-muted' style="font-size:14px;"><b>Note:</b> <em>Once you submit the set, You can not come back to your marked questions.</em></p>
            </div>
        </div>

    </body>
    <script>
        var time= sessionStorage.getItem('timer');
        var now = Date.parse(new Date());
        var sec = (time-now)/1000;
        
        $('.timer').attr('data-seconds-left', sec);
        $('.timer').startTimer();
			
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
        });        
    </script>
</html>