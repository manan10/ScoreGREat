<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
    
    $percent = ($_SESSION['correct']/$_SESSION['set-size'])*100;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Performance Review</title>
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
            
            .number{
                font-family: Source Serif Pro;
            }
            
            #link,#link:hover{
                color:white;
                text-decoration:none;
                border-bottom-right-radius:10px;
                border-bottom-left-radius:10px;
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
            
            .data {
                width: 50%;
                border-radius: 15px;
                padding-top: 10px;
                padding-left: 5px;
                padding-right: 5px;
                background-color: #efc736;
            }
            
            .progress-bar { 	
                background-color: #FCBC51; 
                width: 100%; 
                background-image: linear-gradient(
                    45deg, rgb(252,163,17) 25%, 
                    transparent 25%, transparent 50%, 
                    rgb(252,163,17) 50%, rgb(252,163,17) 75%,
                    transparent 75%, transparent); 
                animation: progressAnimationStrike 5s;
            }
            
            @keyframes progressAnimationStrike {
                from { width: 0 }
                to { width: <?php echo $percent . "%";?> }
            }
            
            .pb-text {
                font-size: larger;
                text-align: center;
                border: 1px solid rgb(252,163,17);
                width: 20%;
                /*background-color: rgba(252,163,17,0.3);*/
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
                
                .card{
                    width:95%;
                }
                
                .pb-text {
                    width: 100%;
                }
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

        <div class="container-fluid" id="main">
            <h1 class='text-center my-4 font-weight-bold'>Performance Review</h1>
            <div class='row mt-5'>
                <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                    <div class='text-center shadow data'>
                        <h2 class="number"><?php echo $_SESSION['set-size'];?></h2>
                        <p>Total Questions</p>
                    </div>
                </div>
                <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                    <div class='text-center shadow data'>
                        <h2 class="number"><?php echo $_SESSION['correct'];?></h2>
                        <p>Correctly Answered</p>
                    </div>
                </div>
                <?php 
                    if($percent > 60 && $percent <= 80){
                        $quote = "Great job with this set. A little more practice and you'll be perfect in no time";
                    }   
                    else if($percent > 80 && $percent <= 100){
                        $quote = "Wow ! You just got everything correct. Kudos ! Keep it up !";
                    }
                        
                    else if(($percent > 40) && ($percent <= 60)){
                        $quote = "Nicely done. You have shown great potential on this set and with some more practice, there is only one way your scores could go !";
                    }
                        
                    else if(($percent > 20) && ($percent <= 40)){
                        $quote = "You're almost halfway to perfection. Worry not and push a little harder.";
                    }   
                         
                    else{
                        $quote = "Not your best performance. Make sure this is your worst. Things can only get better.";
                    }
                ?>
                <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                    <div class='text-center shadow data'>
                        <h2 class="number"><?php echo ceil($percent) . "%";?></h2>
                        <p>Percentage</p>
                    </div>
                </div>
            </div>
            <div class='mt-5'>
                <h2 class='text-center'>Progress</h2>
                <div class='progress m-4'>
                    <div class='progress-bar progress-bar-striped active' role="progressbar" aria-valuenow="50" aria    -valuemin="0" aria-valuemax="100" style="width:<?php echo $percent . "%";?>">
                    </div>
                </div>
                <div class='mx-4 row'>
                    <div class='pb-text'>Need Improvement</div>
                    <div class='pb-text'>Average</div>
                    <div class='pb-text'>Can Do Better</div>
                    <div class='pb-text'>Good</div>
                    <div class='pb-text'>Exellent</div>
                </div>
            </div>
            <div class='text-center' style="margin-top: 50px;">
                <h4><b><?php echo "$quote"; ?></b></h4>
            </div>
            <div class='mt-5 mb-3 justify-content-center d-flex'>
                <a href='practice-dashboard.php' class='btn btn-lg' style='background-color: black; color: white'>Back To Dashboard</a>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $(".pb-text").eq(0).parent().width($(".progress").width());

            var w20 = ($(".progress").width() * 20) / 100;
            var w40 = ($(".progress").width() * 40) / 100;
            var w60 = ($(".progress").width() * 60) / 100;
            var w80 = ($(".progress").width() * 80) / 100;
            var w100 = $(".progress").width();
            
            var i=0;
            var progress = setInterval(function(){
                if($(".progress-bar").width() > 0 && $(".progress-bar").width() <= w20) {
                    $(".pb-text").eq(0).show();
                    $(".pb-text").eq(0).css('background-color', 'rgb(252,163,17)');
                }
                
                if($(".progress-bar").width() > w20 && $(".progress-bar").width() <= w40) {
                    $(".pb-text").eq(1).show();
                    $(".pb-text").eq(0).css('background-color', '');
                    $(".pb-text").eq(1).css('background-color', 'rgb(252,163,17)');
                }
                
                if($(".progress-bar").width() > w40 && $(".progress-bar").width() <= w60) {
                    $(".pb-text").eq(2).show();
                    $(".pb-text").eq(1).css('background-color', '');
                    $(".pb-text").eq(2).css('background-color', 'rgb(252,163,17)');
                }
                
                if($(".progress-bar").width() > w60 && $(".progress-bar").width() <= w80) {
                    $(".pb-text").eq(3).show();
                    $(".pb-text").eq(2).css('background-color', '');
                    $(".pb-text").eq(3).css('background-color', 'rgb(252,163,17)');
                }
                
                if($(".progress-bar").width() > w80 && $(".progress-bar").width() <= w100) {
                    $(".pb-text").eq(4).show();
                    $(".pb-text").eq(3).css('background-color', '');
                    $(".pb-text").eq(4).css('background-color', 'rgb(252,163,17)');
                }
                
                if(i >= 20){
                    stopInt();
                }
                i++;
            }, 500);
            
            function stopInt() {
                clearInterval(progress);
            }
        });
    </script>
</html>    